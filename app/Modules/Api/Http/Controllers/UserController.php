<?php
namespace App\Modules\Api\Http\Controllers;

use App\Http\Requests;
use App\Modules\Im\Model\ImAttentionModel;
use App\Modules\Im\Model\ImMessageModel;
use App\Modules\Manage\Model\EmployerGradeModel;
use App\Modules\Manage\Model\HunterGradeModel;
use App\Modules\Manage\Model\InstallPackageModel;
use App\Modules\Manage\Model\InvitationModel;
use App\Modules\Manage\Model\UserActiveModel;
use App\Modules\Manage\Model\UserGameLogModel;
use App\Modules\Manage\Model\UserGameModel;
use App\Modules\Manage\Model\UserRodeFeeModel;
use App\Modules\Manage\Model\UserSystemTaskModel;
use App\Modules\Manage\Model\UserTeamModel;
use App\Modules\Order\Model\OrderModel;
use App\Modules\User\Model\UserBalanceModel;
use App\Modules\User\Model\UserFocusModel;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use Omnipay;
use Validator;
use Toplan\PhpSms\Sms;
use App\Modules\User\Model\UserModel;
use App\Modules\User\Model\PhoneCodeModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\User\Model\RealnameAuthModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\DistrictRegionModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\Manage\Model\AgreementModel;
use App\Modules\Manage\Model\InvitationCodeModel;
use App\Modules\User\Model\PromoteModel;
use Illuminate\Support\Facades\Crypt;
use Cache;
use DB;
use Socialite;
use Auth;
use Log;
use Input;

class UserController extends ApiBaseController
{
    const LIMIT = 10;
    private $fileCharset;
    private $postCharset;

    public function __construct()
    {
        $this->sex = array('0'=>'未设置','1'=>'女','2'=>'男');
    }

    /**获取验证码短信
     *  $phone
     *  $sms_code 短信模板编号  模 板 验证码：218093 超过当日发送上限提示:160040
     *  $method   验证码类型：1-注册 2-重置密码 3-重置支付密码 4-手机登录 5-绑定手机
     */
    public function sendCode(Request $request){
        $validator0 = Validator::make($request->all(),[
            'phone' => 'required|mobile_phone',
            'method' => 'required'
        ],[
            'phone.required' => '请输入手机号',
            'phone.mobile_phone' => '请输入正确的手机号码格式',
            'method.required' => '请输入获取类型',
        ]);
        $error0 = $validator0->errors()->all();
        if(count($error0)) return $this->formateResponse(1001,$error0[0],$error0);

        $method = intval($request->get('method'));
        
        $code = mt_rand(100000,999999);
        $tempData = [];
        $tempData['code'] = $code;

        if($method == 1){
            //注册获取验证码
            $validator = Validator::make($request->except('method'), [
                'phone' => 'required|mobile_phone|unique:users,mobile',
            ],[
                'phone.required' => '请输入手机号码',
                'phone.mobile_phone' => '请输入正确的手机号码格式',
                'phone.unique' => '该手机号已注册',
            ]);

            $yuntongxun = 208989;
            $tempData['minutes'] = '30分钟';
        }
        else{
            //重置密码获取验证码
            $validator = Validator::make($request->except('method'), [
                'phone' => 'required|mobile_phone',
            ],[
                'phone.required' => '请输入手机号码',
                'phone.mobile_phone' => '请输入正确的手机号码格式',
            ]);
            
            $user = UserModel::where('mobile',$request->get('phone'));
            if(!count($user)){return $this->formateResponse(1001,'该手机号尚未注册，请先注册');}

            if($method == 2){
                $yuntongxun = 208991;
            }
            elseif($method == 3){
                $yuntongxun = 217403;
            }
            elseif($method == 4){
                // $tempData['msg'] = '手机登录';
                // $yuntongxun = 218093;
                $yuntongxun = 221836;
            }
            elseif($method == 5){
                $yuntongxun = 208993;
            }
            elseif($method == 6){
                //此处仅为测试激活赠送激活码  可用
                $yuntongxun = 224265;
                unset($tempData['code']);
                $tempData['content'] = '邀请一个好友免费激活';

                if(empty($request->get('code'))){
                    return $this->formateResponse(1001,'请输入赠送的激活码');
                }

                $code = $request->get('code');

                $tempData['code'] = $code;
            }
        }

        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001, $error[0],$error);

        $to = $request->get('phone');
        $sms_code = $request->input('sms_code');

        $templates = [
            'YunTongXun' => $yuntongxun
        ];

        $tempData['minutes'] = '30分钟';

        $result = Sms::make()->to($to)->template($templates)->data($tempData)->send();
        
        if(isset($result['success']) && $result['success']){
            $vertifyInfo = PhoneCodeModel::where('phone',$to)->first();
            $overdueDate = time()+intval($tempData['minutes'])*60;

            $data = [
                'code' => $tempData['code'],
                'overdue_date' => date('Y-m-d H:i:s',$overdueDate),
                'created_at' => date('Y-m-d H:i:s',time()),
                'status' => '1'
            ];
            if(count($vertifyInfo)){
                $res = PhoneCodeModel::where('phone',$vertifyInfo->phone)->update($data);
            }
            else{
                $data['phone'] = $to;
                $res = PhoneCodeModel::create($data);
            }
            if(isset($res)){
                return $this->formateResponse(1000,'success');
            }
            else{
                return $this->formateResponse(1001,'网络错误');
            }
        }
        else{
            return $this->formateResponse(1001,'网络错误');
        }

    }

    //验证激活码:invitation_code 表
    public function invitationcode(Request $request)
    {
        $code = $request->get('code');
        if(empty($code)) return $this->formateResponse(1001,'请输入激活码');
        $invitation_code = InvitationCodeModel::where('invitation_code',$code)->first();
        if(count($invitation_code)){
            if($invitation_code->status == 'Invalid'){
                return $this->formateResponse(1001,'激活码已失效');
            }else{
                return $this->formateResponse(1000,'true');
            }
        }else{
            return $this->formateResponse(1001,'激活码不正确，请检查');
        }
    }

    //验证推广码
    public function extensioncode(Request $request)
    {
        $code = $request->get('code');
        if(empty($code)) return $this->formateResponse(1001,'请输入推广码');
        $user_promote_code = UserModel::where('promote_code',$code)->where('status',2)->first();
        if(count($user_promote_code)){
            return $this->formateResponse(1000,'true');
        }else{
            return $this->formateResponse(1001,'推广码不正确，请检查');
        }
    }

    //注册之前验证手机号是否已经注册或者手机号
    public function verifyphone(Request $request)
    {
        $validator = Validator::make($request->except('method'), [
            'phone' => 'required|mobile_phone',
        ],[
            'phone.required' => '请输入手机号',
            'phone.mobile_phone' => '请输入正确的手机号码格式'
        ]);

        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001, $error[0],$error);
        }else{
            $user = UserModel::where('mobile',$request->input('phone'))->first();
            if($user) return $this->formateResponse(2000,'failure',array('手机号已经注册'));
            return $this->formateResponse(1000,'correct',array('手机号尚未注册，可正常注册'));
        }
    }

    /**注册
     * @param Request $request
     * param  $username
     * param  $phone
     * param  $password
     * param  $code  短信验证码
     * param  $invitation_code  激活码
     * param  $promote_code  推广码
     * param  $source 1-来自pc 2-来自手机
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4|max:15|alpha_num|unique:users,name',
            'phone'    => 'required|mobile_phone|unique:users,mobile',
            'password' => 'required|min:6|max:12|alpha_num',
            'code'     => 'required',
        ],[
            'username.required' => '请输入用户名',
            'username.min' => '用户名长度不得小于4',
            'username.max' => '用户名长度不得大于15',
            'username.alpha_num' => '用户名请输入字母或数字',
            'username.unique' => '此用户名已存在',

            'phone.required' => '请输入手机号',
            'phone.mobile_phone' => '请输入正确的手机号码格式',
            'phone.unique' => '该手机号已注册',

            'password.required' => '请输入密码',
            'password.min' => '密码长度不得小于6',
            'password.max' => '密码长度不得大于12',
            'password.alpha_num' => '密码请输入字母或数字',

            'code.required' => '请输入验证码',

        ]);
        $error = $validator->errors()->all();

        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        
        $phoneAuth = PhoneCodeModel::wherePhone($request->input('phone'))->where('status','1')->first();

        $time = strtotime("now");
        //验证验证码
        $code = $request->input('code');
        if(is_null($phoneAuth)) return $this->formateResponse(1001,'请先获取验证码');

        if($time > strtotime($phoneAuth->overdue_date)){
            return $this->formateResponse(1001,'验证码过期');
        }

        if($code != $phoneAuth->code){
            return $this->formateResponse(1001,'验证码错误 ');
        }


        $salt = \CommonClass::random(4);
        $date = date('Y-m-d H:i:s');
        $now = time();
        $password = UserModel::encryptPassword($request->get('password'), $salt);
        $userArr = array(
            'name' => $request->get('username'),
            'password' => $password,
            'salt' => $salt,
            'last_login_time' => $date,
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1,
            'mobile' => $request->get('phone'),
            'head_img' => 'uploads\head_img\moren.png',
        );
        $this->mobile = $request->get('phone');
        $promote_code = $request->input('promote_code',0);
        $res =  DB::transaction(function() use ($userArr,$promote_code){
            //使用验证码
            $phonecode = PhoneCodeModel::where('phone',$this->mobile)->update(['status'=>'2']);
            if(!$phonecode){
                DB::rollBack();
                return array('code'=>'-1000','data'=>'网络错误');
            }

            $userInfo = UserModel::create($userArr);

            $userBalance = new UserBalanceModel();
            $userBalance->user_id = $userInfo->id;
            $userBalance->balance = 0;
            $userBalance->grade = 0;
            $userBalance->emp_value = 0;
            $userBalance->balance_status = 1;
           // $userBalance->balance_freeze = 0;
            $userBalance->save();

            $uses_promote_code = $userInfo->id;
            if(strlen($userInfo->id) < 6){
                $uses_promote_code += 100000 ;
            }
            UserModel::whereId($userInfo->id)->update(['promote_code' => $uses_promote_code]);//生成该用户的推广码

            //验证推广码
            if($promote_code !== 0 && !empty($promote_code)){
                $is_promote_code = UserModel::where('promote_code',$promote_code)->first();
                if(count($is_promote_code)){
                    if($is_promote_code->status != 2){
                        DB::rollBack();
                        return array('code'=>'-1000','data'=>'该推广用户账号无效，推广码无效');
                    }
                    //给推广人的推广总数加一
                    // $is_promote_num = $is_promote_code->promote_num + 1;
                    // UserModel::where('id',$is_promote_code->id)->update(['promote_code' => $is_promote_num]);
                    UserModel::where('id',$is_promote_code->id)->increment('promote_code','1');
                    // $promote_price = PromoteTypeModel::where('type','1')->first();
                    // //给推广人余额添加上系统设定的分成金额
                    // $user_balance = UserBalanceModel::where('user_id',$is_promote_code->id)->first();
                    // UserBalanceModel::where('user_id',$is_promote_code->id)->update(['balance'=>$user_balance->balance + $promote_price->price]);
                    //录入推广记录
                    // $promote_arr = array(
                    //     'form_uid' => $is_promote_code->id,
                    //     'to_uid' => $userInfo->id,
                    //     'price' => $promote_price,
                    //     'finish_conditions' => 3,
                    //     'type' => 1,
                    //     'status' => 1,//1、推广中 2、推广完成（用户支付成功激活后，更新为2）
                    // );
                    // PromoteModel::create($promote_arr);
                    $promote_res = PromoteModel::createPromote($is_promote_code->id, $userInfo->id);
                    if(!$promote_res){
                        DB::rollBack();
                        return array('code'=>'-1000','data'=>'网络错误');
                    }
                }else{
                    DB::rollBack();
                    return array('code'=>'-1000','data'=>'推广码不正确，请检查');    
                }
            }


            $data = [
                'uid' => $userInfo->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mobile' => $this->mobile
            ];

            UserDetailModel::create($data);
            return array('code'=>1000,'data'=>$userInfo);

        });

        if(!isset($res)){
            return $this->formateResponse(1001,'网络错误');;    
        }elseif($res['code'] == '1000'){
            return $this->formateResponse(1000,'注册成功，请支付激活账号');
        }elseif($res['code'] == '-1000'){
            return $this->formateResponse(1001,$res['data']);
        }
    }

    //判断用户激活时填写的激活码和注册时填写的邀请码是否属于同一人
    public function judgeInvitationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invitation_code' => 'required',
        ],[
            'invitation_code.required' => '请输入激活码',
        ]);
        $error = $validator->errors()->all();

        if(count($error)) {
            return $this->formateResponse(1001,$error[0], $error);
        }
        
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $promote = PromoteModel::where('to_uid',$tokenInfo['uid'])->select('from_uid','promote_code')->first();
        
        if(empty($promote)){
            return $this->formateResponse(1000,'用户可继续进行激活');
        }

        $invitation_code = $request->get('invitation_code');

        $promote_code = substr($invitation_code,-5)-100000;

        if($promote_code != $promote['promote_code']){
            return $this->formateResponse(2000,'信息不统一');
        }

        return $this->formateResponse(1000,'用户可继续进行激活');
    }

    //激活码激活账号
    public function invitationCodeAct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'invitation_code' => 'required',
            // 'uuid' => 'required',
        ],[
            'user.required' => '请输入用户信息',
            'invitation_code.required' => '请输入激活码',
            // 'uuid.required' => '请输入手机标识'
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        //验证用户
        $user = $request->get('user');
        $user_count = UserModel::where('name',$user)->where('status',1)->count();
        
        if($user_count){
            $method = 1;
            $userInfo = UserModel::where('name',$user)->where('status',1)->select('id','name','mobile')->first();
        }else{
            $validator = Validator::make($request->all(), [
                'user' => 'mobile_phone',
            ],[
                'user.mobile_phone' => '请检验的手机号码格式或者用户名',
            ]);
            $error0 = $validator->errors()->all();
            if(count($error0)) return $this->formateResponse(1001,$error0[0], $error0);
            $user_count = UserModel::where('mobile',$user)->where('status',1)->count();
            if(!$user_count) return $this->formateResponse(1001,'用户信息有误，请检查');
            $method = 2;
            $userInfo = UserModel::where('mobile',$user)->where('status',1)->select('id','name','mobile')->first();
        }
        //验证激活码
        $invitation_code = $request->get('invitation_code');
        if($invitation_code !== 0){
            $is_invitation_code = InvitationCodeModel::where('invitation_code',$invitation_code)->where('status','valid')->select('id','type','uid')->first();
            if(count($is_invitation_code)){
                DB::beginTransaction();
                //使用激活码
                $inv_res = InvitationModel::where('id',$is_invitation_code->id)->update(['status'=>'Invalid']);
                if(!$inv_res) {
                    DB::rollBack();
                    return $this->formateResponse(1001,'网络错误');
                }
                //用户状态更改
                if($method == 1){
                    $use_res = UserModel::where('name',$user)->update(['status'=>2,'activation_method'=>'2']);
                }elseif($method == 2){
                    $use_res = UserModel::where('mobile',$user)->update(['status'=>2,'activation_method'=>'2']);
                }
                if(!$use_res){
                    DB::rollBack();
                    return $this->formateResponse(1001,'网络错误');
                }

                $promoteInfo = PromoteModel::where('to_uid',$userInfo->id)->select('from_uid')->first();
                if(!empty($promoteInfo))
                {

                    if($promoteInfo['form_uid'] != $is_invitation_code['uid'])
                    {
                        //清除之前的推广信息
                        $p_res = PromoteModel::where('to_uid',$userInfo->id)->update(['from_uid'=>$is_invitation_code['uid']]);
                        if(!$p_res){
                            DB::rollBack();
                            return $this->formateResponse(1001,'网络错误');
                        }
                    }

                    //完成激活
                    $promote_res = PromoteModel::completePromote($userInfo['id'],'2',$is_invitation_code['type']);
                    if($promote_res['code'] != 200){
                        DB::rollBack();
                        return $this->formateResponse(1001,$promote_res['msg']);
                    }

                    //系统任务（历练）之推荐会员 kppw_type 表ID ：10  不要删
                    /* $user_system_task = UserSystemTaskModel::where('uid',$promoteInfo['from_uid'])
                                                             ->where('status','1')
                                                             ->where('systerm_task_type','10')
                                                             ->first();
                     if($user_system_task){
                         $u_s_t_res = UserSystemTaskModel::completed($promoteInfo['from_uid'],10);
                         if($u_s_t_res['code'] != 200){
                             DB::rollBack();
                             return $this->formateResponse(1001,$u_s_t_res['msg']);
                         }
                     }*/

                    //验证激活码

                    // 邀请好友送好礼及领取回家路费  不要删  
                    $user_system_task = UserSystemTaskModel::where('uid',$promoteInfo['from_uid'])
                                                             ->whereIn('status',array('1','2'))
                                                            ->where('systerm_task_type','10')
                                                             ->count();
                    if($user_system_task > 0){
                         $u_s_t_res1 = UserSystemTaskModel::systemTasksCompleted($promoteInfo['form_uid'],10);
                         if($u_s_t_res1['code'] != 200){
                             DB::rollBack();
                             return $this->formateResponse(1001,$u_s_t_res1['msg']);
                         }
                    }

                    $user_rode_fee = UserRodeFeeModel::where('uid',$promoteInfo['form_uid'])
                                                      ->whereIn('status',array('1','2'))
                                                      ->count();
                    if($user_rode_fee > 0){
                         $u_r_f_res = UserRodeFeeModel::rodeFeeCompleted($promoteInfo['form_uid']);
                         if($user_rode_fee['code'] != 200){
                             DB::rollBack();
                             return $this->formateResponse(1001,$u_r_f_res['msg']);
                         }
                    }
                }

                DB::commit();
                // $akey = md5(Config::get('app.key'));
                // // $tokenInfo = ['uid'=>$userInfo->id,'school' =>'' , 'name' => $userInfo->name,'mobile' => $userInfo->mobile, 'akey'=>$akey,'uuid'=>$request->get('uuid')];
                // $tokenInfo = ['uid'=>$userInfo->id,'school' =>'' , 'name' => $userInfo->name,'mobile' => $userInfo->mobile, 'akey'=>$akey];
                // $token = Crypt::encrypt($tokenInfo);
                // $userDetail = [
                //     'id' => $userInfo->id,
                //     'name' => $userInfo->name,
                //     'token' => $token,
                // ];
                // Cache::put($userInfo->id, $userDetail,Config::get('session.lifetime')*60);
                // UserModel::where('id',$userInfo->id)->update(['last_login_uuid'=>$request->get('uuid')]);
                $token = self::createToken($userInfo->id,$userInfo->school,$userInfo->name,$userInfo->mobile);
                return $this->formateResponse(1000,'success',array('token'=>$token));
            }else{
                return $this->formateResponse(1001,'激活码不正确，请检查');
            }
        }
        return $this->formateResponse(1001,'激活码信息错误');
    }


    //支付激活账号
    public function activate($id)
    {
        PromoteModel::completePromote($id);
        
    }

    //用户名密码登录
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:6|max:12|alpha_num',
            // 'uuid' => 'required'
        ],[
            'username.required' => '请输入用户名或手机号',
            'password.required' => '请输入密码',
            'password.min' => '密码长度不得小于6',
            'password.max' => '密码长度不得大于12',
            'password.alpha_num' => '请输入字母或数字',
            // 'uuid.required' => '请输入手机标识'
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        $username = $request->get('username');
        $error2 = Validator::make($request->except('password'),[
                            'username'=>'mobile_phone'
                        ],[
                            'username.mobile_phone'=>'请输入正确的手机号码格式'
                        ])->errors()->all();
        if(count($error2)){
            //用户名登陆
            $error3 = Validator::make($request->except('password'),[
                            'username'=>'min:4|max:15|alpha_num'
                        ],[
                            'username.min'=>'用户名长度不得小于4',
                            'username.max'=>'用户名长度不得大于15',
                            'username.alpha_num'=>'用户名请输入字母或数字'
                        ])->errors()->all();
            if(count($error3)) return $this->formateResponse(1001,$error3[0],$error3);
            $userInfo = UserModel::where('users.name',$username);
        }else{
            //电话登陆
            $userInfo = UserModel::where('users.mobile',$username);
        }
        $userInfo = $userInfo->leftjoin('user_detail','users.id','=','user_detail.uid')
                        ->select('users.*','user_detail.avatar','user_detail.school')
                        ->first();
        if(!count($userInfo)){
            return $this->formateResponse(1001,'用户不存在');
        }
        if($userInfo->status ==  1){
            return $this->formateResponse(2000,'用户还未激活，请激活');
        }
        if($userInfo->status == 3){
            return $this->formateResponse(1001,'用户账号已被禁用');
        }
        // $domain = ConfigModel::where('alias','site_url')->where('type','site')->select('rule')->first();
        // $userInfo->avatar = $domain->rule.'/'.$userInfo->avatar;
        $password = UserModel::encryptPassword($request->get('password'), $userInfo->salt);
        if($password != $userInfo->password){
            return $this->formateResponse(1001,'您输入的密码不正确');
        }
        // $akey = md5(Config::get('app.key'));
        // // $tokenInfo = ['uid'=>$userInfo->id,'school' =>$userInfo->school , 'name' => $userInfo->name,'email' => $userInfo->email,'akey'=>$akey,'uuid'=>$request->get('uuid')];
        // $tokenInfo = ['uid'=>$userInfo->id,'school' =>$userInfo->school , 'name' => $userInfo->name,'mobile' => $userInfo->mobile, 'akey'=>$akey];
        
        // $token = Crypt::encrypt($tokenInfo);
        // // UserModel::where('id',$userInfo->id)->update(['last_login_uuid'=>$request->get('uuid')]);

        // $userDetail = [
        //     'id' => $userInfo->id,
        //     'name' => $userInfo->name,
        //     'token' => $token,
        // ];
        // Cache::put($userInfo->id, $userDetail,Config::get('session.lifetime')*60);
        
        $token = self::createToken($userInfo->id,$userInfo->school,$userInfo->name,$userInfo->mobile);
        
        // $go_res = BasicController::appointment_tips('登录成功','user');

        // UserDetailModel::where('uid',$userInfo->id)->update(['shop_status' => 1]);
        return $this->formateResponse(1000, '登录成功',array('token'=>$token));

    }

    /**
     * [createToken 产生token]
     * @param  [type] $uid    [用户ID]
     * @param  [type] $school [用户学校ID]
     * @param  [type] $name   [用户姓名]
     * @param  [type] $mobile [用户手机]
     * @param  string $uuid   [用户设备UUID]
     * @return [type]         [string]
     */
    static function createToken($uid,$school,$name,$mobile,$uuid=''){
        $akey = md5(Config::get('app.key'));
        $tokenInfo = array(
                'uid' => $uid,
                'school' => $school,
                'name' => $name,
                'mobile' => $mobile,
                'akey' => $akey
            );
        if(!empty($uuid)){
            $tokenInfo['uuid']  = $uuid;
            UserModel::where('id',$uid)->update(['last_login_uuid'=>$uuid]);
        }
        $token = Crypt::encrypt($tokenInfo);
        $userDetail = array(
                'id' => $uid,
                'name' => $name,
                'token' => $token
            );
        Cache::put($uid,$userDetail,28800*60);
        return $token;
    }

    //网页登录
    public function webLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:6|max:12|alpha_num',
            // 'uuid' => 'required'
        ],[
            'username.required' => '请输入用户名或手机号',
            'password.required' => '请输入密码',
            'password.min' => '密码长度不得小于6',
            'password.max' => '密码长度不得大于12',
            'password.alpha_num' => '请输入字母或数字',
            // 'uuid.required' => '请输入手机标识'
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        $username = $request->get('username');
        $error2 = Validator::make($request->except('password'),[
            'username'=>'mobile_phone'
        ],[
            'username.mobile_phone'=>'请输入正确的手机号码格式'
        ])->errors()->all();
        if(count($error2)){
            //用户名登陆
            $error3 = Validator::make($request->except('password'),[
                'username'=>'min:4|max:15|alpha_num'
            ],[
                'username.min'=>'用户名长度不得小于4',
                'username.max'=>'用户名长度不得大于15',
                'username.alpha_num'=>'用户名请输入字母或数字'
            ])->errors()->all();
            if(count($error3)) return $this->formateResponse(1001,$error3[0],$error3);
            $userInfo = UserModel::where('users.name',$username);
        }else{
            //电话登陆
            $userInfo = UserModel::where('users.mobile',$username);
        }
        $userInfo = $userInfo->leftjoin('user_detail','users.id','=','user_detail.uid')
            ->select('users.*','user_detail.avatar','user_detail.school')
            ->first();
        if(!count($userInfo)){
            return $this->formateResponse(1001,'用户不存在');
        }
        if($userInfo->status ==  1){
            return $this->formateResponse(2000,'用户还未激活，请激活');
        }
        if($userInfo->status == 3){
            return $this->formateResponse(1001,'用户账号已被禁用');
        }
        // $domain = ConfigModel::where('alias','site_url')->where('type','site')->select('rule')->first();
        // $userInfo->avatar = $domain->rule.'/'.$userInfo->avatar;
        $password = UserModel::encryptPassword($request->get('password'), $userInfo->salt);
        if($password != $userInfo->password){
            return $this->formateResponse(1001,'您输入的密码不正确');
        }
        $akey = md5(Config::get('app.key'));
        $tokenInfo = ['uid'=>$userInfo->id,'school' =>$userInfo->school , 'name' => $userInfo->name,'mobile' => $userInfo->mobile, 'akey'=>$akey];

        $token = Crypt::encrypt($tokenInfo);

        $userDetail = [
            'id' => $userInfo->id,
            'name' => $userInfo->name,
            'token' => $token,
        ];

        $user_game_info = UserGameModel::where('uid',$userInfo->id)->first();
        $user_active = UserActiveModel::where('uid',$userInfo->id)->where('pid',0)->first();
        //status:0注册；1有信息；2个人报名
        $news = UserGameLogModel::where('to_id',$userInfo->id)->where('is_read',UserGameLogModel::LOG_IS_READ_NULL)->select('id','content')->orderBy('id','desc')->first();

        $data = [
            'mobile' =>$userInfo->mobile,
            'name' =>$userInfo->name,
            'school' =>DistrictRegionModel::getDistrictName($userInfo->school),
            'status'=>0//未注册
        ];

        if(!is_null($user_game_info)){
            $data['status'] = 1;
            $data['game_name'] = $user_game_info->game_name;
            $data['game_server'] = $user_game_info->game_server;
        }
        if(!is_null($user_active)){
            $data['status'] = 2;
        }
        if(!is_null($news)){
            $data['content'] = $news['content'];
            UserGameLogModel::where('to_id',$userInfo->id)->where('is_read',UserGameLogModel::LOG_IS_READ_NULL)->update(['is_read'=>UserGameLogModel::LOG_IS_READ_TRUE]);
        }
        Cache::put('a'.$userInfo->id, $userDetail,Config::get('session.lifetime')*60);

        return $this->formateResponse(1000, '登录成功',array('token'=>$token,'info'=>$data));

    }

    //手机验证码登录
    public function vertify(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|mobile_phone',
            'code' => 'required',
            // 'uuid' => 'required'
        ],[
            'phone.required' => '请输入手机号码',
            'phone.mobile_phone' => '请输入正确的手机号码格式',
            'code.required' => '请输入验证码',
            // 'uuid.required' => '请输入手机标识'
        ]);
        $error = $validator->errors()->all();

        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }
        $userInfo = UserModel::leftjoin('user_detail','users.id','=','user_detail.uid')
                             ->where('user_detail.mobile',$request->get('phone'))
                             ->first();

        if(!count($userInfo)){
            return $this->formateResponse(1001,'该手机号尚未注册');
        }

        if($userInfo->status ==1){
            return $this->formateResponse(2000,'用户还未激活，请激活');
        }

        $vertifyInfo = PhoneCodeModel::where('phone',$request->get('phone'))
                                     ->where('code',$request->get('code'))
                                     ->where('status','!=','2')
                                     ->first();
        
        if(empty($vertifyInfo)){
            return $this->formateResponse(1001,'验证码无效');
        }

        $phonecode = PhoneCodeModel::where('phone',$request->get('phone'))->update(['status'=>'2']);
        
        if(!$phonecode) {
            return $this->formateResponse(1001,'网络错误');
        }

        // $akey = md5(Config::get('app.key'));
        // // $tokenInfo = ['uid'=>$userInfo->id,'school' =>$userInfo->school, 'name' => $userInfo->name,'email' => $userInfo->email,'mobile' => $userInfo->mobile, 'akey'=>$akey,'uuid'=>$request->get('uuid')];
        // $tokenInfo = ['uid'=>$userInfo->id,'school' =>$userInfo->school, 'name' => $userInfo->name,'mobile' => $userInfo->mobile, 'akey'=>$akey];
        
        // $token = Crypt::encrypt($tokenInfo);
        // // UserModel::where('id',$userInfo->id)->update(['last_login_uuid'=>$request->get('uuid')]);

        // $userDetail = [
        //     'id' => $userInfo->id,
        //     'name' => $userInfo->name,
        //     'token' => $token,
        // ];
        
        // Cache::put($userInfo->id, $userDetail,Config::get('session.lifetime')*60);
        
        $token = self::createToken($userInfo->id,$userInfo->school,$userInfo->name,$userInfo->mobile);
        
        // UserDetailModel::where('uid',$userInfo->id)->update(['shop_status' => 1]);

        return $this->formateResponse(1000,'success',array('token' => $token));
    }

    //重置登录密码
    public function passwordReset(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|max:12|alpha_num',
            'repassword' => 'required|same:password',
            'code' => 'required',
            'phone' => 'required|mobile_phone',

        ],[
            'password.required' => '请输入密码',
            'password.min' => '密码长度不得小于6',
            'password.max' => '密码长度不得大于12',
            'password.alpha_num' => '请输入字母或数字',
            'repassword.required' => '请输入确认密码',
            'repassword.same' => '两次输入的密码不一致',
            'code.required' => '请输入验证码',
            'phone.required' => '请输入手机号码',
            'phone.mobile_phone' => '请输入正确的手机号码格式',
        ]);
        $error = $validator->errors()->all();

        if(count($error)) {
            return $this->formateResponse(1001,$error[0], $error);
        }
        
        $phone = $request->get('phone');
        $userInfo = UserModel::leftjoin('user_detail','users.id','=','user_detail.uid')
            ->where('user_detail.mobile',$phone)
            ->first();

        if(!count($userInfo)){
            return $this->formateResponse(1001,'手机号尚未注册');
        }

        $password = UserModel::encryptPassword($request->get('password'), $userInfo->salt);
        
        UserModel::where('mobile',$phone)->update(['password' => $password]);
        
        return $this->formateResponse(1000,'success');
    }

    //登录状态重置密码（验证原有密码重置密码）
    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'oldPass' => 'required|min:6|max:12|alpha_num',
            'password' => 'required|min:6|max:12|alpha_num',
            'repassword' => 'required|same:password',
            'token' => 'required'
        ],[
            'oldPass.required' => '请输入原密码',
            'oldPass.min' => '原密码长度不得小于6',
            'oldPass.max' => '原密码长度不得大于12',
            'oldPass.alpha_num' => '请输入字母或数字',
            'password.required' => '请输入新密码',
            'password.min' => '新密码长度不得小于6',
            'password.max' => '新密码长度不得大于12',
            'password.alpha_num' => '请输入字母或数字',
            'repassword.required' => '请输入确认密码',
            'repassword.same' => '两次输入的密码不一致',
            'token.required' => '参数不完整'
        ]);
        $error = $validator->errors()->all();

        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }
        
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $userInfo = UserModel::where('id',$tokenInfo['uid'])->first();
        
        if(!count($userInfo)) {
            return $this->formateResponse(1001,'用户信息错误');
        }

        $oldPass = UserModel::encryptPassword($request->get('oldPass'), $userInfo->salt);
        
        if($oldPass != $userInfo->password) {
            return $this->formateResponse(1001,'原密码不正确');
        }

        $newPass = UserModel::encryptPassword($request->get('password'), $userInfo->salt);
        $userInfo->update(['password' => $newPass]);
        
        return $this->formateResponse(1000,'success');
    }

    public function setPayCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|between:5,12',
            // 'repassword' => 'required|same:password',
            'token' => 'required',
        ],[
            'password.required' => '请输入新密码',
            // 'repassword.required' => '请输入确认密码',
            'token.required' => '参数不完整',
            'password.between' => '密码长度在:min - :max 位',
            'password.string' => '请输入数字',
            // 'repassword.same' => '两次输入的密码不一致',
        ]);
        $error = $validator->errors()->all();

        if(count($error)) {
            return $this->formateResponse(1001,$error[0], $error);
        }

        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserModel::where('id',$tokenInfo['uid'])->first();
        $newPayPass = UserModel::encryptPassword($request->get('password'), $user->salt);
        $user_detail_res = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['pay_code'=>$newPayPass]);
        
        if($user_detail_res){
            return $this->formateResponse(1000,'添加成功');
        }else{
            return $this->formateResponse(1001,'网络错误');
        }
    }

    //登录状态验证支付密码
    public function vertifyPayCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'code' => 'required|min:6|max:12|alpha_num',
            'code' => 'required|integer',
        ],[
            'code.required' => '请输入原密码',
            // 'code.min' => '原密码长度不得小于6',
            // 'code.max' => '原密码长度不得大于12',
            'code.integer' => '请输入数字',
        ]);
        $error = $validator->errors()->all();

        if(count($error)) {
            return $this->formateResponse(1001,$error[0], $error);
        }

        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $userInfo = UserModel::where('id',$tokenInfo['uid'])->select('salt')->first();

        if(!count($userInfo)) {
            return $this->formateResponse(1001,'用户信息错误');
        }

        $code = UserModel::encryptPassword($request->get('code'), $userInfo->salt);
        $user_detail = UserDetailModel::where('uid',$tokenInfo['uid'])->select('pay_code')->first();
        
        if($code != $user_detail->pay_code) {
            return $this->formateResponse(1001,'原密码不正确');
        }

        return $this->formateResponse(1000,'密码正确');
    }

    //登录状态重置支付密码
    public function updatePayCode(Request $request){
        $validator = Validator::make($request->all(), [
            // 'oldPass' => 'required|min:6|max:12|alpha_num',
            // 'password' => 'required|min:6|max:12|alpha_num',
            // 'oldPass' => 'required|alpha_num',
            'password' => 'required|integer',
            // 'repassword' => 'required|same:password',
        ],[
            // 'oldPass.required' => '请输入原密码',
            'password.required' => '请输入新密码',
            // 'repassword.required' => '请输入确认密码',
            // 'oldPass.min' => '原密码长度不得小于6',
            // 'oldPass.max' => '原密码长度不得大于12',
            // 'oldPass.alpha_num' => '请输入字母或数字',
            // 'password.min' => '新密码长度不得小于6',
            // 'password.max' => '新密码长度不得大于12',
            'password.integer' => '请输入数字',
            // 'repassword.same' => '两次输入的密码不一致',
        ]);
        $error = $validator->errors()->all();

        if(count($error)) {
            return $this->formateResponse(1001,$error[0], $error);
        }

        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $userInfo = UserModel::where('id',$tokenInfo['uid'])->select('salt')->first();
        
        if(!count($userInfo)) {
            return $this->formateResponse(1001,'用户信息错误');
        }

        // $oldPass = UserModel::encryptPassword($request->get('oldPass'), $userInfo->salt);
        // $user_detail = UserDetailModel::where('uid',$tokenInfo['uid'])->first();
        // if($oldPass != $user_detail->pay_code) return $this->formateResponse(1001,'原密码不正确');
        
        $newPass = UserModel::encryptPassword($request->get('password'), $userInfo->salt);
        $user_detail_res = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['pay_code'=>$newPass]);
        
        if($user_detail_res){
            return $this->formateResponse(1000,'更新成功');    
        }else{
            return $this->formateResponse(1001,'网络错误');
        }
    }

    //手机找回支付密码
    public function payCodeReset(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|mobile_phone',
            'code' => 'required',
            // 'password' => 'required|min:6|max:16|alpha_num',
            'password' => 'required|integer',
            'repassword' => 'required|same:password',
        ],[
            'phone.required' => '请输入手机号码',
            'code.required' => '请输入验证码',
            'password.required' => '请输入密码',
            'repassword.required' => '请输入确认密码',
            'phone.mobile_phone' => '请输入正确的手机号码格式',
            // 'password.min' => '密码长度不得小于6',
            // 'password.max' => '密码长度不得大于16',
            'password.integer' => '请输入数字',
            'repassword.same' => '两次输入的密码不一致',
        ]);
        $error = $validator->errors()->all();

        if(count($error)) {
            return $this->formateResponse(1001,$error[0], $error);
        }

        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $userInfo = UserModel::leftjoin('user_detail','users.id','=','user_detail.uid')
            ->where(['user_detail.mobile' => $request->get('phone'),'users.id' => $tokenInfo['uid']])
            ->first();
        
        if(!count($userInfo)){
            return $this->formateResponse(1001,'找不到对应的用户信息');
        }
        
        $vertifyInfo = PhoneCodeModel::where('phone',$request->get('phone'))->where('code',$request->get('code'))->where('status','1')->first();
        
        if(!count($vertifyInfo))  {
            return $this->formateResponse(1001,'手机验证码错误');
        }

        if(date('Y-m-d H:i:s') > $vertifyInfo['overdue_date']) {
            return $this->formateResponse(1001,'验证码已过期');
        }

        $phonecode = PhoneCodeModel::where('phone',$request->get('phone'))->update(['status'=>'2']);
        $password = UserModel::encryptPassword($request->get('password'), $userInfo->salt);
        $user_detail_res = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['pay_code'=>$password]);
        
        if($user_detail_res){
            return $this->formateResponse(1000,'更新成功');
        }else{
            return $this->formateResponse(1001,'网络错误');
        }
    }

    //登录状态验证安全密码
    public function vertifySafeCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|integer',
        ],[
            'code.required' => '请输入原密码',
            'code.integer' => '请输入数字',
        ]);
        $error = $validator->errors()->all();

        if(count($error)) {
            return $this->formateResponse(1001,$error[0], $error);
        }
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $userInfo = UserModel::where('id',$tokenInfo['uid'])->select('salt')->first();
        
        if(!count($userInfo)) {
            return $this->formateResponse(1001,'用户信息错误');
        }

        $code = UserModel::encryptPassword($request->get('code'), $userInfo->salt);
        $user_detail = UserDetailModel::where('uid',$tokenInfo['uid'])->select('safe_code')->first();
        
        if($code != $user_detail->safe_code) {
            return $this->formateResponse(1001,'原密码不正确');
        }
        
        return $this->formateResponse(1000,'密码正确');
    }

    //登录状态更新安全密码
    public function updateSafeCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_code' => 'required|integer',
        ],[
            'new_code.required' => '请输入原密码',
            'new_code.integer' => '请输入数字',
        ]);
        $error = $validator->errors()->all();

        if(count($error)) {
            return $this->formateResponse(1001,$error[0], $error);
        }

        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $userInfo = UserModel::where('id',$tokenInfo['uid'])->select('salt')->first();

        if(!count($userInfo)) {
            return $this->formateResponse(1001,'用户信息错误');
        }

        $new_code = UserModel::encryptPassword($request->get('new_code'), $userInfo->salt);
        $u_d_res = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['safe_code'=>$new_code]);

        if(!$u_d_res) {
            return $this->formateResponse(1001,'网络错误');
        }

        return $this->formateResponse(1000,'更新成功');
    }


    /**
     * 获取用户基本信息(get:/user/getUserInfo)
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getUserInfo(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        
        $select = array(
                'users.email',
                'users.head_img',
                'users.mobile',
                'user_detail.realname',
                'user_detail.realname_status',
                'user_detail.sex',
                'user_detail.mobile_status',
                'user_detail.card_number',
                'user_detail.region',
                'user_detail.province',
                'user_detail.city',
                'user_detail.school',
                'user_detail.system',
                'user_detail.class as classS',
                'user_detail.majors',
                'user_detail.native_place',
                'user_detail.birthday',
                'user_detail.autograph',
                'user_detail.introduce',
                'user_detail.sign',
                'user_detail.nickname',
                'user_detail.year_old',
                'user_balance.balance',
                'user_balance.grade',
                'user_balance.act_value',
                'user_balance.gold',
                'user_balance.hunter_grade',
                'user_balance.hunt_value',
                'user_balance.employer_grade',
                'user_balance.emp_value',
                'user_balance.create_task_num',
                'user_balance.work_task_num',
                'user_balance.balance_status',
        );

        $userInfo = UserModel::where('users.id',$tokenInfo['uid'])
                             ->leftJoin('user_detail','user_detail.uid','=','users.id')
                             ->leftJoin('user_balance','user_balance.user_id','=','users.id')
                             ->select($select)
                             ->first()->toArray();


        $userInfo['hunter_grade_logo'] = HunterGradeModel::where('grade',$userInfo['hunter_grade'] + 1)->where('status','valid')->pluck('grade_img');
        $userInfo['employ_grade_logo'] = EmployerGradeModel::where('grade',$userInfo['employer_grade'] + 1)->where('status','valid')->pluck('grade_img');

        $realNameAuth = RealnameAuthModel::where('uid',$tokenInfo['uid'])->select('status')->get()->toArray();

        if(isset($realNameAuth))
        {
            $realNameAuth = array_flatten($realNameAuth);
            if(in_array(1,$realNameAuth)){
                $userInfo['isRealName'] = 1;
            }elseif(in_array(2,$realNameAuth)){
                $userInfo['isRealName'] = 2;
            }else{
                $userInfo['isRealName'] = 0;
            }
        }else{
            $userInfo['isRealName'] = null;
        }

        if(!empty($userInfo))
        {
            $school = DistrictRegionModel::where('id',$userInfo['school'])->select('name')->first();
            $region = DistrictRegionModel::where('id',$userInfo['region'])->select('name')->first();
            $province = DistrictModel::where('id',$userInfo['province'])->select('name')->first();
            $city = DistrictModel::where('id',$userInfo['city'])->select('name')->first();
            $userInfo['school'] = $school['name'];
            $userInfo['region'] = $region['name'];
            $userInfo['province'] = $province['name'];
            $userInfo['city'] = $province['name'];

            return $this->formateResponse(1000,'success',$userInfo);
        }else{
            return $this->formateResponse(1001,'找不到对应的用户信息');
        }
    }

    //获取用户安全信息
    public function getUserSafeInfo(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));

        $select = array(
            'user_detail.safe_code',
            'user_detail.pay_code',
            'users.mobile',
            'users.wx_openid',
            'users.qq_openid',
            'users.sina_openid'
        );

        $userInfo = UserModel::where('users.id',$tokenInfo['uid'])
                            ->leftJoin('user_detail','user_detail.uid','=','users.id')
                            ->select($select)
                            ->first();

        if(empty($userInfo)) return $this->formateResponse('1001','无效的用户');

        if(!empty($userInfo['safe_code'])){
            $userInfo['safe_code'] = '1';
        }else{
            $userInfo['safe_code'] = '0';
        }

        if(!empty($userInfo['pay_code'])){
            $userInfo['pay_code'] = '1';
        }else{
            $userInfo['pay_code'] = '0';
        }

        if(!empty($userInfo['mobile'])){
            $start = substr($userInfo['mobile'],'0','3');
            $end = substr($userInfo['mobile'],'7','4');
            $userInfo['mobile'] = $start.'****'.$end;
        }else{
            $userInfo['mobile'] = '0';
        }

        if(!empty($userInfo['wx_openid'])){
            $userInfo['wx_openid'] = '1';
        }else{
            $userInfo['wx_openid'] = '0';
        }

        if(!empty($userInfo['qq_openid'])){
            $userInfo['qq_openid'] = '1';
        }else{
            $userInfo['qq_openid'] = '0';
        }

        if(!empty($userInfo['sina_openid'])){
            $userInfo['sina_openid'] = '1';
        }else{
            $userInfo['sina_openid'] = '0';
        }

        return $this->formateResponse(1000,'success',$userInfo);
    }

    //获取用户单条信息  method :1-用户名 2-邮箱 3-签名 4-简介 5-标签 6-真实姓名是否公开 7-手机号是否公开  8-昵称  9-性别 10-生日  11-专业  12-年龄 13-手机号
    public function getSingleInfo(Request $request)
    {
        if(!$request->get('method')) return $this->formateResponse(1001,'请选择获取内容类型');
        $method = $request->get('method');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $select = array(
            'users.name',
            'users.email',
            'user_detail.autograph',
            'user_detail.introduce',
            'user_detail.sign',
            'user_detail.realname_status',
            'user_detail.mobile_status',
            'user_detail.nickname',
            'user_detail.sex',
            'user_detail.birthday',
            'user_detail.majors',
            'user_detail.year_old',
            'users.mobile'
        );
        $user = UserModel::leftJoin('user_detail','user_detail.uid','=','users.id')
                            ->select($select)
                            ->where('users.id',$tokenInfo['uid'])
                            ->first();

        $status = array('0'=>'不公开','1'=>'公开');
        $sex = array('0'=>'女','1'=>'男');
        
        if(!empty($user)){
            if($method == 1){
                $content = $user->name;
            }elseif ($method == 2) {
                $content = $user->email;
            }elseif ($method == 3) {
                $content = $user->autograph;
            }elseif ($method == 4) {
                $content = $user->introduce;
            }elseif ($method == 5) {
                $content = $user->sign;
            }elseif ($method == 6) {
                $content['status'] = $user->realname_status;
                $content['str'] = $status[$user->realname_status];
            }elseif ($method == 7) {
                $content['status'] = $user->mobile_status;
                $content['str'] = $status[$user->mobile_status];
            }elseif ($method == 8){
                $content = $user->nickname;
            }elseif ($method == 9){
                $content['status'] = $user->sex;
                $content['str'] = $sex[$user->sex];
            }elseif ($method == 10){
                $content = $user->birthday;
            }elseif ($method == 11){
                $content = $user->majors;
            }elseif ($method == 12){
                $content = $user->year_old;
            }elseif ($method == 13){
                $content = $user->mobile;
            }else{
                return $this->formateResponse(1001,'无效的内容类型');
            }
            return $this->formateResponse(1000,'success',array('content'=>$content));
        }else{
            return $this->formateResponse(1001,'找不到对应的用户昵称');
        }

    }

    //用户名
    public function getUserName(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserModel::where('id',$tokenInfo['uid'])->select('name')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateUserName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4|max:15|alpha_num|unique:users,name',
        ],[
            'username.required' => '请输入用户名',
            'username.min' => '用户名长度不得小于4',
            'username.max' => '用户名长度不得大于15',
            'username.alpha_num' => '用户名请输入字母或数字',
            'username.unique' => '此用户名已存在',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $name = \CommonClass::removeXss($request->get('username'));
        $user = UserModel::where('id',$tokenInfo['uid'])->update(['name'=>$name]);
        if(!$user) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'success',array('username'=>$request->get('username')));
    }

    //邮箱
    public function getEmail(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserModel::where('id',$tokenInfo['uid'])->select('email')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ],[
            'email.required' => '请输入邮箱',
            'email.email' => '请输入正确格式的邮箱',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserModel::where('id',$tokenInfo['uid'])->update(['email'=>$request->get('email')]);
        if(!$user) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'success',array('email'=>$request->get('email')));
    }

    //个人签名
    public function getAutograph(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->select('autograph')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateAutograph(Request $request)
    {
        if(!$request->get('autograph')) return $this->formateResponse(1001,'请输入内容');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $autograph = \CommonClass::removeXss($request->get('autograph'));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['autograph'=>$autograph]);
        if(!$user) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'success',array('autograph'=>$autograph));
    }

    //简介
    public function getIntroduce(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->select('introduce')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateIntroduce(Request $request)
    {
        if(!$request->get('introduce')) return $this->formateResponse(1001,'请输入内容');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $introduce = \CommonClass::removeXss($request->get('introduce'));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['introduce'=>$introduce]);
        if(!$user) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'success',array('introduce'=>$request->get('introduce')));
    }

    //标签
    public function getSign(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->select('sign')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateSign(Request $request)
    {
        if(!$request->get('sign')) return $this->formateResponse(1001,'请输入内容');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $sign = \CommonClass::removeXss($request->get('sign'));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['sign'=>$sign]);
        if(!$user) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'success',array('sign'=>$request->get('sign')));
    }

    //昵称
    public function getNickName(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->select('nickname')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateNickName(Request $request)
    {
        //限定长度
        $validator = Validator::make($request->all(), [
            'nickname' => 'required|min:1|max:13|unique:user_detail,nickname',
        ],[
            'nickname.required' => '请输入昵称',
            'nickname.min' => '用户名长度不得小于1',
            'nickname.max' => '用户名长度不得大于13',
            'nickname.unique' => '此昵称名已存在',
        ]);
        $error = $validator->errors()->all();

        if(count($error)) {
            return $this->formateResponse(1001,$error[0], $error);
        }

        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $nickname = \CommonClass::removeXss($request->get('nickname'));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['nickname'=>$nickname]);
        
        if(!$user) {
            return $this->formateResponse(1001,'网络错误');
        }

        return $this->formateResponse(1000,'success',array('nickname'=>$request->get('nickname')));
    }

    //性别 $sex = array('0'=>'未设置','1'=>'女','2'=>'男');
    //
    public function getSex(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->select('sex')->first();
        $user['sex_cn'] = $this->sex[$user['sex']];
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateSex(Request $request)
    {
        if(!$request->get('sex')) return $this->formateResponse(1001,'请输入内容');
        if(!in_array($request->get('sex'),array(1,2))) return $this->formateResponse(1001,'请选择有效的性别');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['sex'=>$request->get('sex')]);
        if(!$user) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'success',array('sex'=>$this->sex[$request->get('sex')]));
    }

    //专业
    public function getMajors(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->select('majors')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateMajors(Request $request)
    {
        if(!$request->get('majors')) return $this->formateResponse(1001,'请输入内容');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $majors = \CommonClass::removeXss($request->get('majors'));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['majors'=>$majors]);
        if(!$user) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'success',array('majors'=>$request->get('majors')));
    }

    //班级和系
    public function getSystemClass(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->select('system','class as classS')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateSystemClass(Request $request)
    {
        if(!$request->get('system')) return $this->formateResponse(1001,'请输入系');
        if(!$request->get('class')) return $this->formateResponse(1001,'请输入班级');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $system = \CommonClass::removeXss($request->get('system'));
        $class = \CommonClass::removeXss($request->get('class'));
        $data = array(
                'system' => $system,
                'class' => $class,
            );
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update($data);
        if(!$user) return $this->formateResponse(1001,'网络错误');
        $returnArr = array(
                'system' => $request->get('system'),
                'classS' => $request->get('class'),
            );
        return $this->formateResponse(1000,'success',$returnArr);
    }

    //年龄
    public function getYearOld(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->select('year_old')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateYearOld(Request $request)
    {
        if(!$request->get('year_old')) return $this->formateResponse(1001,'请输入内容');
        // $request = $request->get('year_old');
        // $result = is_int($request->get('year_old'));
        // return $result;
        if(!intval($request->get('year_old'))) return $this->formateResponse(1001,'请输入正整数');
            if($request->get('year_old') > 100) return $this->formateResponse(1001,'您应该还没有100岁吧，如果有，请联系我们哦');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['year_old'=>$request->get('year_old')]);
        if(!$user) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'success',array('year_old'=>$request->get('year_old')));
    }

    //电话
    public function getMobile(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserModel::where('id',$tokenInfo['uid'])->select('mobile')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateMobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|mobile_phone',
            'code' => 'required',
        ],[
            'mobile.required' => '请输入手机号',
            'mobile.mobile_phone' => '请输入正确格式的手机号',
            'code.required' => '请输入验证码'
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);

        $vertifyInfo = PhoneCodeModel::where('phone',$request->get('mobile'))->where('status','1')->first();
        if(count($vertifyInfo)){
            if(time() > strtotime($vertifyInfo->overdue_date)){
                return $this->formateResponse(1001,'手机验证码已过期');
            }
            if($vertifyInfo->code != $request->get('code')){
                return $this->formateResponse(1001,'手机验证码错误');
            }
            $phonecode = PhoneCodeModel::where('phone',$request->get('mobile'))->update(['status'=>'2']);
            if(!$phonecode) return $this->formateResponse(1001,'网络错误');
            $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
            $user = UserModel::where('id',$tokenInfo['uid'])->update(['mobile'=>$request->get('mobile')]);
            if(!$user) return $this->formateResponse(1001,'网络错误');
            return $this->formateResponse(1000,'success',array('mobile'=>$request->get('mobile')));
         }
         else{
             return $this->formateResponse(1001,'找不到对应的验证码');
         }
    }

    //生日
    public function getBirthday(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->select('birthday')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateBirthday(Request $request)
    {
        if(!$request->get('birthday')) return $this->formateResponse(1001,'请输入内容');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        //随后改测试dateform
        $birthday = \CommonClass::removeXss($request->get('birthday'));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['birthday'=>$birthday]);
        if(!$user) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'success',array('birthday'=>$request->get('birthday')));
    }

    //籍贯
    public function getNativePlace(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->select('native_place')->first();
        return $this->formateResponse(1000,'success',$user);
    }

    public function updateNativePlace(Request $request)
    {
        if(!$request->get('native_place')) return $this->formateResponse(1001,'请输入内容');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $native_place = \CommonClass::removeXss($request->get('native_place'));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['native_place'=>$native_place]);
        if(!$user) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'success',array('native_place'=>$request->get('native_place')));
    }

    //学校
    public function getSchool(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $userInfo = UserDetailModel::where('uid',$tokenInfo['uid'])->select('school')->first();
        $school = DistrictRegionModel::where('id',$userInfo['school'])->select('name')->first();//学校
        $userInfo['school_name'] = $school['name'];
        return $this->formateResponse(1000,'success',$userInfo);
    }
    //只提交学校
    public function updateSchool(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'school' => 'required',
        ],[
            'school.required' => '请选择学校',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        $school = DistrictRegionModel::where('id',$request->school)->select('upid','name')->first();//学校
        if(!$school) return $this->formateResponse(1001,'学校信息错误');
        $school_province = DistrictRegionModel::where('id',$school['upid'])->select('id','upid')->first();//省份
        $region = DistrictRegionModel::where('id',$school_province['upid'])->select('id')->first();//大区
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $data = array(
                'school' => $request->school,
                'school_province' => $school_province['id'],
                'region' => $region['id'],
            );
        $u_d_res = UserDetailModel::where('uid',$tokenInfo['uid'])->update($data);
        if(!$u_d_res) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'更新成功',array('school'=>$request->get('school'),'school_name'=>$school['name']));
    }

    //获取推广码
    public function promoteCode(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $userInfo = UserModel::where('id',$tokenInfo['uid'])->select('promote_code')->first();
        return $this->formateResponse(1000,'success',$userInfo['promote_code']);
    }

    //更新用户单条信息 method :1-用户名 2-邮箱 3-签名 4-简介 5-标签 6-真实姓名是否公开 7-手机号是否公开  8-昵称  9-性别 10-生日  11-专业  12-年龄  13-手机号
    public function updateSingleInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'method' => 'required',
            'content' => 'required',
        ],[
            'method.required' => '请选择更新类型',
            'content.required' => '请输更新内容',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $content = $request->get('content');
        $method = $request->get('method');
        if($method == 1){
            //用户名
            $user = UserModel::where('id',$tokenInfo['uid'])->update(['name' => $content]);
        }elseif ($method == 2) {
            //邮箱
            $validator0 = Validator::make($request->all(), [
                'content' => 'email',
            ],[
                'content.email' => '输入正确的邮箱格式',
            ]);
            $error0 = $validator0->errors()->all();
            if(count($error0)) return $this->formateResponse(1001,$error0[0]);
            $user = UserModel::where('id',$tokenInfo['uid'])->update(['email' => $content]);
        }elseif ($method == 3) {
            //签名
            $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['autograph' => $content]);
        }elseif ($method == 4) {
            //简介
            $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['introduce' => $content]);
        }elseif ($method == 5) {
            //标签
            $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['sign' => $content]);
        }elseif ($method == 6) {
            //真实姓名是否公开
            if(!in_array($content,['1','0'])) return $this->formateResponse(1001,'参数错误，请检查');
            $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['realname_status' => $content]);
        }elseif ($method == 7) {
            //手机号是否公开
            if(!in_array($content,['1','0'])) return $this->formateResponse(1001,'参数错误，请检查');
            $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['mobile_status' => $content]);
        }elseif ($method == 8){
            //昵称
            $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['nickname'=>$content]);
        }elseif ($method == 9){
            //性别
            if(!in_array($content,['1','0'])) return $this->formateResponse(1001,'参数错误，请检查');
            $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['sex'=>$content]);
        }elseif ($method == 10){
            //生日
            //验证
            $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['birthday'=>$content]);
        }elseif ($method == 11){
            //专业
            $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update(['majors'=>$content]);
        }elseif ($method == 12){
            //年龄
            if(!is_int($content)) return $this->formateResponse(1001,'请输入正整数');
            if($content > 100) return $this->formateResponse(1001,'您应该还没有100岁吧，如果有，请联系我们哦');
            $user = UserDetailModel::where('uid',$uid)->update(['year_old'=>$content]);
        }elseif ($method == 13){
            //手机
            $validator0 = Validator::make($request->all(), [
                'content' => 'mobile_phone',
            ],[
                'content.mobile_phone' => '输入正确的手机格式',
            ]);
            $error0 = $validator0->errors()->all();
            if(count($error0)) return $this->formateResponse(1001,$error0[0]);
            $u_res = User::where('id',$uid)->update(['mobile'=>$content]);
            if(!$u_res) return $this->formateResponse(1001,'网络错误');
            $user = UserDetailModel::where('uid',$uid)->update(['mobile'=>$content]);
        }else{
            return $this->formateResponse(1001,'请选择有效的更新类型');
        }

        if(!empty($user)){
            return $this->formateResponse(1000,'success');
        }elseif($user == 0){
            return $this->formateResponse(1001,'无修改');
        }else{
            return $this->formateResponse(1001,'网络错误');
        }
    }

    //获取用户系及班级
    public function getClass(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->select('system','class')->first();
        if(!$user){
            return $this->formateResponse(1001,'用户信息错误');
        }
        return $this->formateResponse(1000,'success',$user);
    }

    //修改用户系及班级
    public function updateClass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'system' => 'required',
            'class' => 'required',
        ],[
            'system.required' => '请输入系',
            'class.required' => '请输班级',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $system = \CommonClass::removeXss($request->input('system'));
        $class = \CommonClass::removeXss($request->input('class'));
        $data = array(
                'system' => $system,
                'class' => $class,
            );
        $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update($data);
        if($user === false){
            return $this->formateResponse(1001,'网络错误');
        }
        return $this->formateResponse(1000,'修改成功');
    }

    //获取用户头像
    public function getAvatar(Request $request)
    {
        if(!$request->get('token')) return $this->formateResponse(1001,'请先登录');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user = UserModel::where('id',$tokenInfo['uid'])->first();
        // $url = ConfigModel::getConfigByAlias('site_url');
        if(!empty($user)){
            // $avatar =  $url['rule'].$user->head_img;
            if(empty($user->head_img)){
                $data = array(
                    'avatar' => "uploads/head_img/moren.png"
                );
            }else{
                $data = array(
                    'avatar' => $user->head_img
                );
            }
            return $this->formateResponse(1000,'success',$data);
        }else{
            return $this->formateResponse(1001,'找不到对应的用户头像');
        }
    }

    //更新用户头像
    public function updateAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'avatar' => 'required',
        ],[
            'token.required' => '请登录',
            'avatar.required' => '请上传头像',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $avatar = $request->avatar;
        $upload_res = self::uploadByBase64($avatar);
        if(!$upload_res){
            return $this->formateResponse(1001,'网络错误');
        }else{
            UserModel::where('id',$tokenInfo['uid'])->update(['head_img'=>$upload_res['url_path']]);
            //return $this->formateResponse(1000,'更换成功',$upload_res['url_path']);
            return response()->json(['code'=> 1000,'message'=>'更换成功','data'=>$upload_res['url_path']]);
        }
    }

    /**修改个人信息 
     * @param Request $request
     * * @param name 昵称
     * * @param realname 真实姓名
     * * @param region 大区
     * * @param province 省
     * * @param school 学校
     * @return \Illuminate\Http\Response
     */
    // public function updateUserInfo(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|min|max|alpha_num',
    //         'realname' => 'required',
    //         'region' => 'required',
    //         'province' => 'required',
    //         'school' => 'required'
    //     ],[
    //         'name.required' => '请输入用户名',
    //         'realname.required' => '请输入真实姓名',
    //         'region.required' => '请输入真实姓名',
    //         'province.required' => '请输入真实姓名',
    //         'school.required' => '请输入真实姓名',
    //         'name.min' => '用户名长度不得小于4',
    //         'name.max' => '用户名长度不得大于15',
    //         'name.alpha_num' => '用户名请输入字母或数字',
    //     ]);
    //     $error = $validator->errors()->all();
    //     if(count($error)) return $this->formateResponse(1001,$error[0], $error);
    //     $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
    //     $avatar = $request->file('avatar');
    //     $allowExtension = array('jpg', 'gif', 'jpeg', 'bmp', 'png');
    //     if ($avatar) {
    //         $uploadMsg = json_decode(\FileClass::uploadFile($avatar, 'user', $allowExtension));
    //         if ($uploadMsg->code != 200) {
    //             return $this->formateResponse(1001,$uploadMsg->message);
    //         } else {
    //             $userAvatar = $uploadMsg->data->url;
    //         }
    //     }

    //     $postInfo  = $request->except('token');
    //     $userInfo = UserDetailModel::where('uid',$tokenInfo['uid'])->first()->toArray();
    //     $user =  $userInfo;
    //     if(array_diff($postInfo,$userInfo)){
    //         $user = UserDetailModel::where('uid',$tokenInfo['uid'])->update($postInfo);
    //     }

    //     $domain = ConfigModel::where('alias','site_url')->where('type','site')->select('rule')->first();
    //     $userInfo['avatar'] = $userInfo['avatar']?$domain->rule.'/'.$userInfo['avatar']:$userInfo['avatar'];
    //     if(!empty($user)){
    //         return $this->formateResponse(1000,'success',$userInfo);
    //     }else{
    //         return $this->formateResponse(1001,'网络错误');
    //     }
    // }

    // 用户的站内信列表 
    public function messageList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => 'required',
            'per_page' => 'required',
            'messageType' => 'required',
        ],[
            'page.required' => '请输入页码',
            'per_page.required' => '请输入每页条数',
            'messageType.required' => '请选择信息类型',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);

        $per_page = $request->get('per_page');
        $page = $request->get('page');
        $start = $per_page*($page-1);

        if($request->get('messageType')){
            $messageType = intval($request->get('messageType'));
            $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
            switch($messageType)
            {
                //用户获取的系统消息 
                case 1:
                    $message = MessageReceiveModel::where('js_id',$tokenInfo['uid'])->where('message_type',1)
                        ->select('id','message_title','message_content','receive_time','status')
                        ->orderBy('receive_time','DESC')->skip($start)->take($per_page)->get();
                    $messageCount = MessageReceiveModel::where('js_id',$tokenInfo['uid'])->where('message_type',1)->where('status',0)->count();
                    break;
                //用户的交易动态
                case 2:
                    $message = MessageReceiveModel::where('js_id',$tokenInfo['uid'])->where('message_type',2)
                        ->select('id','message_title','message_content','receive_time','status')
                        ->orderBy('receive_time','DESC')->skip($start)->take($per_page)->get();
                    
                    $messageCount = MessageReceiveModel::where('js_id',$tokenInfo['uid'])->where('message_type',2)->where('status',0)->count();
                    break;
                //用户发送的站内信
                case 3:
                    $message = MessageReceiveModel::where('fs_id',$tokenInfo['uid'])->where('message_type',3)
                        ->select('id','message_title','message_content','receive_time','status')
                        ->orderBy('receive_time','DESC')->skip($start)->take($per_page)->get();
                    
                    $messageCount = MessageReceiveModel::where('fs_id',$tokenInfo['uid'])->where('message_type',3)->where('status',0)->count();
                    break;
                //用户接受的站内信
                case 4:
                    $message = MessageReceiveModel::where('js_id',$tokenInfo['uid'])->where('message_type',3)
                        ->select('id','message_title','message_content','receive_time','status')
                        ->orderBy('receive_time','DESC')->skip($start)->take($per_page)->get();
                    
                    $messageCount = MessageReceiveModel::where('js_id',$tokenInfo['uid'])->where('message_type',3)->where('status',0)->count();
                    break;

            }
            if(!$message->isEmpty()){
                $message = $message->toArray();
                foreach($message as $key => $value){
                    $message[$key]['message_content'] = htmlspecialchars_decode($value['message_content']);
                }
                $data = array(
                    'message_list' => $message,
                    'no_read' => $messageCount
                );
            }else{
                $data = array(
                    'message_list' => $message,
                    'no_read' => 0
                );
            }
            return $this->formateResponse(1000,'success',$data);
        }else{
            return $this->formateResponse(1001,'缺少参数');
        }
    }

    //获取站内信详情
    public function readMessage(Request $request)
    {
        if(empty($request->get('message_id'))) {
            return $this->formateResponse(1001,'请选择有效的站内信');
        }

        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        
        $message = MessageReceiveModel::where('js_id',$tokenInfo['uid'])
                                      ->where('id',$request->get('message_id'))
                                      ->select('message_title','message_content','receive_time','status')
                                      ->first();

        if(empty($message)){
            return $this->formateResponse(1001,'请选择有效的站内信');
        }

        if($message['status'] == 0){
            $message_res = MessageReceiveModel::where('id',$request->get('message_id'))
                                              ->update(['status'=>'1','read_time'=>date("Y-m-d H:i:s")]);
            if(!$message_res){
                return $this->formateResponse(1001,'网络错误');
            }
            unset($message['status']);
        }

        $message['message_content'] = htmlspecialchars_decode($message['message_content']);

        return $this->formateResponse(1000,'success',$message);
    }


    /**原三方登录（）
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    /*public function oauthLogin(Request $request){
        if(!$request->get('uid') or !$request->get('nickname') or $request->get('sex') == NULL or !$request->get('source')){
            return $this->formateResponse(1001,'传送数据不能为空');
        }
        if($request->get('type') == 'qq' || $request->get('type') == 'weibo' || $request->get('type') == 'weixinweb'){
            $oauthStatus = OauthBindModel::where(['oauth_id' => $request->get('uid'), 'oauth_type' => 3])
                ->first();
            if (!empty($oauthStatus)){

                $userInfo = UserModel::where('id',$oauthStatus->uid)->select('id','name','email','alternate_password','salt')->first();

                $password = UserModel::encryptPassword('123456', $userInfo->salt);
                if($password != $userInfo->alternate_password){
                    $status = false;
                }else{
                    $status = true;
                }
                $status = true;
                $akey = md5(Config::get('app.key'));

                $tokenInfo = ['uid'=>$userInfo->id, 'name' => $userInfo->name,'email' => $userInfo->email, 'akey'=>$akey, 'expire'=> time()+Config::get('session.lifetime')*60];
                $information = [
                    'uid' => $userInfo->id,
                    'status' => $status,
                    'token' => Crypt::encrypt($tokenInfo)
                ];
                Cache::put($userInfo->id, $information,Config::get('session.lifetime')*60);
                $res = $information;
            } else{
                $salt = \CommonClass::random(4);
                $validationCode = \CommonClass::random(6);
                $date = date('Y-m-d H:i:s');
                $now = time();
                $pass = '123456';
                $password = UserModel::encryptPassword($pass, $salt);
                $userInfo = UserModel::where('name',$request->get('nickname'))->get();
                $userName = isset($userInfo)?$request->get('nickname').$salt:$request->get('nickname');
                $userArr = array(
                    'name' => $userName,
                    'password' => $password,
                    'alternate_password' => $password,
                    'salt' => $salt,
                    'last_login_time' => $date,
                   'overdue_date' => date('Y-m-d H:i:s', $now + 60*60*3),
                    'validation_code' => $validationCode,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'source' => $request->get('source')
                );
                $this->sex = $request->get('sex');
                $this->oauth_id = $request->get('uid');
                $res =  DB::transaction(function() use ($userArr){
                    $userInfo = UserModel::create($userArr);
                    $data = [
                        'uid' => $userInfo->id,
                        'sex' => $this->sex,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    UserDetailModel::create($data);
                    $oauthInfo = [
                        'oauth_id' => $this->oauth_id,
                        'oauth_nickname' => $userInfo->name,
                        'oauth_type' => 3,
                        'uid' => $userInfo->id,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    OauthBindModel::create($oauthInfo);
                    $akey = md5(Config::get('app.key'));
                    $tokenInfo = ['uid'=>$userInfo->id, 'name' => $userInfo->name,'email' => $userInfo->email, 'akey'=>$akey, 'expire'=> time()+Config::get('session.lifetime')*60];
                    $information = [
                        'uid' => $userInfo->id,
                        'status' => true,
                        'token' => Crypt::encrypt($tokenInfo)
                    ];
                    Cache::put($userInfo->id, $information,Config::get('session.lifetime')*60);
                    return $information;
                });
            }

            if(isset($res)){
                return $this->formateResponse(1000,'创建第三方登录信息成功',$res);
            }
            return $this->formateResponse(1055,'创建第三方登录信息失败');
        }
        return $this->formateResponse(1054,'传送数据类型不符合要求');
    }*/

    /**
     * 第三方登录(post:/oauth)
     * @param Request $request
     */
    public function authThreePartiesSorts(Request $request)
    {
        $type = $request->input('type','');
        if(empty($type)){
            return $this->formateResponse(1001,'请选择登录方式');
        }
        
        if($type == 'qq'){
            $data['qq_openid'] = $request->input('qq_openid','');
            $url = $request->input('figureurl_qq_2');
            if($data['qq_openid'] == ''){
                return $this->formateResponse(1001,'qq_openid值为空');
            }

            $userInfo = UserModel::where('users.qq_openid',$data['qq_openid'])
                        ->leftjoin('user_detail','users.id','=','user_detail.uid')
                        ->select('users.*','user_detail.avatar','user_detail.school')
                        ->first();
            
            if(!is_null($userInfo)){
                $token = self::createToken($userInfo->id,$userInfo->school,$userInfo->name,$userInfo->mobile);
                return $this->formateResponse(1000, '登录成功',array('token'=>$token));
            }
        }

        if($type == 'weixin'){
            $data['wx_openid'] = $request->input('wx_openid');
            $data['wx_unionid'] = $request->input('wx_unionid');

            $url = $request->input('headimgurl');
            if($data['wx_openid'] == '' || $data['wx_unionid'] == ''){
                return $this->formateResponse(1001,'wx_openid或wx_unionid值为空');
            }

            $userInfo = UserModel::where('users.wx_openid',$data['wx_openid'])
                ->where('users.wx_unionid',$data['wx_unionid'])
                ->leftjoin('user_detail','users.id','=','user_detail.uid')
                ->select('users.*','user_detail.avatar','user_detail.school')
                ->first();
           
            if(!is_null($userInfo)){
                $token = self::createToken($userInfo->id,$userInfo->school,$userInfo->name,$userInfo->mobile);
                return $this->formateResponse(1000, '登录成功',array('token'=>$token));
            }
        }

        if($type != 'weixin' && $type != 'qq'){
            return $this->formateResponse(1001, '参数不正确');
        }

        if(empty($url)){
            return $this->formateResponse(1001, '无法获取头像信息');
        }

        $filePath = 'uploads/head_img/'.OrderModel::randomCode(mt_rand(1,1000)).'.jpg';
        $pic = self::curl($url);
        file_put_contents($filePath,$pic);
        /*$nickname = 'qqqq';
        $salt = \CommonClass::random(4);
        $password = UserModel::encryptPassword(123456, $salt);*/


        $data['head_img'] = $filePath;
        /*$data['salt'] = $salt;
        $data['password'] = $password;*/
        $data['status'] = UserModel::USER_ACTIVITATE;
        $ret = DB::transaction(function () use($data){
            $user = UserModel::create($data);
            $user_detail['uid'] = $user->id;
            UserDetailModel::insert($user_detail);
            $user_balance['user_id'] = $user->id;
            UserBalanceModel::insert($user_balance);

            return $user->id;
        });

        if(empty($ret)){
            return $this->formateResponse(1001, '登陆失败，请重试');
        }

        $nickname = $request->input('nickname');
        UserModel::whereId($ret)->update(['name'=> $nickname.'_'.$ret]);
        //UserModel::whereId($ret)->update(['name'=> $nickname]);

        $userInfo = UserModel::where('users.id',$ret)
            ->leftjoin('user_detail','users.id','=','user_detail.uid')
            ->select('users.*','user_detail.avatar','user_detail.school')
            ->first();

        $token = self::createToken($userInfo->id,$userInfo->school,$userInfo->name,$userInfo->mobile);
        return $this->formateResponse(1000, '登录成功',array('token'=>$token));
    }

    //退出登录
    public function loginOut(Request $request){
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        Cache::forget($tokenInfo['uid']);
        return $this->formateResponse(1000,'退出登录');
    }


    
    public function getTaskList(Request $request)
    {
        $data = $request->all();
        $tasks = TaskModel::whereIn('task.status',[3,4,5,6,7,8,9,10,11])
            ->where('task.begin_at','<=',date('Y-m-d H:i:s',time()))
            ->select('task.*','cate.name as cate_name')
            ->leftjoin('cate','task.cate_id','=','cate.id');
        if(isset($data['cate_id']) && $data['cate_id']){
            $tasks = $tasks->where('task.cate_id',$data['cate_id']);
        }
        if(isset($data['type']) && $data['type']){
            switch($data['type']){
                case 1:
                    $tasks = $tasks->orderBy('task.id','desc');
                    break;
                case 2:
                    $tasks = $tasks->orderBy('task.view_count','desc');
                    break;
                case 3:
                    $tasks = $tasks->orderBy('task.bounty','desc');
                    break;
                case 4:
                    $tasks = $tasks->orderBy('task.delivery_deadline','desc');
                    break;
            }
        }
        if($request->get('taskName')){
            $tasks = $tasks->where('task.title','like','%'.$request->get('taskName').'%');
        }

        $tasks = $tasks->orderBy('task.created_at','desc')->paginate()->toArray();
        if($tasks['total']){
            foreach($tasks['data'] as $k=>$v){
                if($tasks['data'][$k]['status'] == 3){
                    $tasks['data'][$k]['status'] = 4;
                }
            }
            return $this->formateResponse(1000,'success',$tasks);
        }else{
            return $this->formateResponse(1001,'暂无数据');
        }
    }


    
    public function agreementDetail(Request $request){
        if(!$request->get('code_name')){
            return $this->formateResponse(1001,'传送参数不能为空');
        }
        switch($request->get('code_name')){
            case '1':
                $agreeInfo = AgreementModel::where('code_name','register')->select('content')->first();
                break;
            case '2':
                $agreeInfo = AgreementModel::where('code_name','task_delivery')->select('content')->first();
                break;
            default:
                $agreeInfo = null;
        }

        if(isset($agreeInfo)){
            $agreeInfo = htmlspecialchars_decode('<html><body>'.$agreeInfo->content.'</body></html>');
        }
        return $this->formateResponse(1000,'获取协议信息成功',['agreeInfo' => $agreeInfo]);

    }

    
    public function hasIm(Request $request)
    {
        
        $basisConfig = ConfigModel::getConfigByType('basis');
        if(!empty($basisConfig)){
            if($basisConfig['open_IM'] == 1){
                $ImPath = app_path('Modules' . DIRECTORY_SEPARATOR . 'Im');
                
                if(is_dir($ImPath)){
                    $contact = 1;
                    $imIp = $basisConfig['IM_config']['IM_ip'];
                    $imPort = $basisConfig['IM_config']['IM_port'];
                    $data = array(
                        'is_IM' => $contact,
                        'IM_ip' => $imIp,
                        'IM_port' => $imPort
                    );
                }else{
                    $contact = 2;
                    $data = array(
                        'is_IM' => $contact
                    );
                }
            }else{
                $contact = 2;
                $data = array(
                    'is_IM' => $contact
                );
            }
            return $this->formateResponse(1000,'获取信息成功',$data);
        }else{
            return $this->formateResponse(1001,'网络错误');
        }
    }

    
    public function sendMessage(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $fromUid = $tokenInfo['uid'];
        if($request->get('to_uid') || $request->get('content') || $request->get('title')){
            $toUid = $request->get('to_uid');
            $content = $request ->get('content');
            $title = $request ->get('title');
            $data = array(
                'message_title' => $title,
                'message_content' => $content,
                'js_id' => $toUid,
                'fs_id' => $fromUid,
                'message_type' => 3,
                'receive_time' => date('Y-m-d H:i:s',time())
            );
            $res = MessageReceiveModel::create($data);
            if($res){
                return $this->formateResponse(1000,'success');
            }else{
                return $this->formateResponse(1001,'网络错误');
            }

        }else{
            return $this->formateResponse(1001,'缺少参数');
        }
    }

    
    public function ImMessageList(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $fromUid = $tokenInfo['uid'];
        if($request->get('to_uid')){
            
            $paginateNum = $request->get('paginate_num') ? $request->get('paginate_num') : 10;
            if($request->get('message_id')){
                if($paginateNum == -1){
                    
                    $messageList = ImMessageModel::where('id','>',$request->get('message_id'))->whereIn('from_uid',[$fromUid,$request->get('to_uid')])->whereIN('to_uid',[$fromUid,$request->get('to_uid')])
                        ->orderBy('id','DESC')->orderBy('created_at','DESC')
                        ->paginate(10000)->toArray();
                }else{
                    
                    $messageList = ImMessageModel::where('id','<',$request->get('message_id'))->whereIn('from_uid',[$fromUid,$request->get('to_uid')])->whereIN('to_uid',[$fromUid,$request->get('to_uid')])
                        ->orderBy('created_at','DESC')
                        ->paginate($paginateNum)->toArray();
                }
            }else{
                
                $messageList = ImMessageModel::whereIn('from_uid',[$fromUid,$request->get('to_uid')])->whereIN('to_uid',[$fromUid,$request->get('to_uid')])
                    ->orderBy('created_at','DESC')
                    ->paginate($paginateNum)->toArray();
            }
            $url = ConfigModel::getConfigByAlias('site_url');
            $fromUser = UserModel::select('name')->where('id',$fromUid)->first();
            $fromUserInfo = UserDetailModel::select('uid','nickname','avatar')->where('uid',$fromUid)->first();
            $fromUserAvatar = $url['rule'].'/'.$fromUserInfo->avatar;
            $toUser = UserModel::select('name')->where('id',$request->get('to_uid'))->first();
            $toUserInfo = UserDetailModel::select('uid','nickname','avatar')->where('uid',$request->get('to_uid'))->first();
            $toUserAvatar = $url['rule'].'/'.$toUserInfo->avatar;
            if($messageList['total'] > 0){
                foreach($messageList['data'] as $key => $value){
                    if($value['from_uid'] == $fromUid){
                        $messageList['data'][$key]['from_username'] = $fromUser->name;
                        $messageList['data'][$key]['from_avatar'] = $fromUserAvatar;
                    }elseif($value['from_uid'] == $request->get('to_uid')){
                        $messageList['data'][$key]['from_username'] = $toUser->name;
                        $messageList['data'][$key]['from_avatar'] = $toUserAvatar;
                    }
                    if($value['to_uid'] == $fromUid){
                        $messageList['data'][$key]['to_username'] = $fromUser->name;
                        $messageList['data'][$key]['to_avatar'] = $fromUserAvatar;
                    }elseif($value['to_uid'] == $request->get('to_uid')){
                        $messageList['data'][$key]['to_username'] = $toUser->name;
                        $messageList['data'][$key]['to_avatar'] = $toUserAvatar;
                    }
                }
            }
            return $this->formateResponse(1000,'success',$messageList);
        }else{
            return $this->formateResponse(1001,'缺少参数');
        }
    }

    
    public function becomeFriend(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $fromUid = $tokenInfo['uid'];
        if($request->get('to_uid')){
            $toUid = $request->get('to_uid');
            $toUserInfo = UserModel::select('name')->where('id', $toUid)->first();
            if(!empty($toUserInfo)){
                $res = ImAttentionModel::where(['uid' => $fromUid, 'friend_uid' => $toUid])->first();
                if(empty($res)){
                    $result = ImAttentionModel::insert([
                        [
                            'uid' => $toUid,
                            'friend_uid' => $fromUid
                        ],
                        [
                            'uid' => $fromUid,
                            'friend_uid' => $toUid
                        ]

                    ]);
                    if($result){
                        return $this->formateResponse(1000,'success');
                    }else{
                        return $this->formateResponse(1001,'网络错误');
                    }
                }else{
                    return $this->formateResponse(1000,'success');
                }
            }else{
                return $this->formateResponse(1001,'无效的好友');
            }
        }else{
            return $this->formateResponse(1001,'请选择好友');
        }
    }

    
    public function isFocusUser(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $uid = $tokenInfo['uid'];
        if($request->get('to_uid')){
            $focusUid = $request->get('to_uid');
            $res = UserFocusModel::where('uid',$uid)->where('focus_uid',$focusUid)->first();
            if(empty($res)){
                $data = array(
                    'is_focus' => 2
                );
                return $this->formateResponse(1000,'未关注',$data);
            }else{
                $data = array(
                    'is_focus' => 1
                );
                return $this->formateResponse(1000,'已关注',$data);
            }
        }else{
            return $this->formateResponse(1001,'请选择用户');
        }
    }


    //验证手机验证码
    public function phoneCodeVertiy(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|mobile_phone',
            'code' => 'required'
        ],[
            'phone.required' => '请输入手机号码',
            'phone.mobile_phone' => '请输入正确的手机号码格式',
            'code.required' => '请输入验证码'

        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);

        $vertifyInfo = PhoneCodeModel::where('phone',$request->get('phone'))->where('status','1')->first();
        if(count($vertifyInfo))
        {
            if(time() > strtotime($vertifyInfo->overdue_date)){
                return $this->formateResponse(1001,'手机验证码已过期');
            }
            if($vertifyInfo->code != $request->get('code')){
                return $this->formateResponse(1001,'手机验证码错误');
            }
            $phonecode = PhoneCodeModel::where('phone',$request->get('phone'))->update(['status'=>'2']);
            if(!$phonecode) return $this->formateResponse(1001,'网络错误');
            return $this->formateResponse(1000,'手机验证码验证成功');
         }
         else{
             return $this->formateResponse(1001,'验证码无效');
         }
    }


    
    public function headPic(Request $request){
        if(!$request->get('id')){
            return $this->formateResponse(1002,'传送数据不能为空');
        }
        $userInfo = UserDetailModel::where('uid',intval($request->get('id')))->select('avatar')->first();
        if(empty($userInfo)){
            return $this->formateResponse(1003,'传送参数错误');
        }
        $domain = ConfigModel::where('alias','site_url')->where('type','site')->select('rule')->first();
        $avatar = $userInfo->avatar?$domain->rule.'/'.$userInfo->avatar:$userInfo->avatar;
        return $this->formateResponse(1000,'获取头像成功',['avatar' => $avatar]);

    }


    
    public function version(){
        $versionInfo = ConfigModel::where(['alias' => 'app_android_version','type' => 'app_android'])->select('rule')->first();
        if(isset($versionInfo)){
            return $this->formateResponse(1000,'获取版本信息成功',['version' => $versionInfo->rule]);
        }
        return $this->formateResponse(1001,'获取版本信息失败');
    }

    
    public function iosVersion(){
        $versionInfo = ConfigModel::where(['alias' => 'app_ios_version','type' => 'app_ios'])->select('rule')->first();
        if(isset($versionInfo)){
            return $this->formateResponse(1000,'获取版本信息成功',json_decode($versionInfo->rule,true));
        }
        return $this->formateResponse(1001,'获取版本信息失败');
    }


    
    public function messageNum(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        
        $systemCount = MessageReceiveModel::where('js_id',$tokenInfo['uid'])->where('message_type',1)->where('status',0)->count();
        
        $tradeCount = MessageReceiveModel::where('js_id',$tokenInfo['uid'])->where('message_type',2)->where('status',0)->count();

        return $this->formateResponse(1000,'success',['systemCount' => $systemCount,'tradeCount' => $tradeCount]);

    }


    
    public function messageStatus(Request $request)
    {
        $res = MessageReceiveModel::where('id',intval($request->get('id')))->update(['status' => 1]);
        if($res){
            return $this->formateResponse(1000,'success');
        }else{
            return $this->formateResponse(1009,'状态更新失败');
        }
    }

    /**
     * app版本更新（post:/package）
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function appPackageUpdate(Request $request)
    {
        $version = $request->input('version',0);
       
        $install_package_old = InstallPackageModel::where('version',$version)->select('name','version')->orderBy('id','desc')->first();
        $install_package_now = InstallPackageModel::orderBy('id','desc')->select('name','version')->first();
       
        if(is_null($install_package_old)){
            return $this->formateResponse(1000,'更新中',$install_package_now);
        }

        if($install_package_now->version == $version){
            return $this->formateResponse(1001,'已是最新版本，无需更新');
        }

        $install_package_now->name = '/'.$install_package_now->name;

        return $this->formateResponse(1000,'更新中',$install_package_now);
    }



    /**排行（get:/user/statistics）
     * @param $week周排序0否
     * @param type种类
     */
    public function statistics(Request $request)
    {
        $data = '';
        $week = $request->input('week',0);
        $type = $request->input('type',1);
        //雇主等级排行
        //Redis::del('userEmplaysSort');
        // Redis::zincrby('userEmplaysSort',2,1);1：uid
        // Redis::ZSCORE('userEmplaysSort',1);
        //Redis::zrevrange('userEmplaysSort',0,9,'withscores');
        if($type == 1){
            if(Cache::has('userEmplaysSort')){
                $data = Cache::get('userEmplaysSort');
            }else{
                $userEmplaysSort = Redis::zrevrange('userEmplaysSort',0,9,'withscores');
                //dd($userEmplaysSort);
                $data = self::userInfo($userEmplaysSort,'employer_grade','emp_value');
                //dd($data);
                Cache::put('userEmplaysSort',$data ,24*60);
            }
        }

        //猎人等级排行
        if($type == 2){
            if(Cache::has('userHuntersSort')){
                $data = Cache::get('userHuntersSort');
            }else{
                $userHuntersSort = Redis::zrevrange('userHuntersSort',0,9,'withscores');
                $data = self::userInfo($userHuntersSort,'hunter_grade','hunt_value');
                Cache::put('userHuntersSort',$data ,24*60);
            }
        }

        //金币排行
        if($type == 3){
            if(Cache::has('userGoldSort')){
                $data = Cache::get('userGoldSort');
            }else{
                $userGoldSort = Redis::zrevrange('userGoldSort',0,9,'withscores');
                $data = self::userInfo($userGoldSort,'gold','bb');
                Cache::put('userGoldSort',$data ,24*60);
            }
        }

        //用户等级排行
        if($type == 4){
            if(Cache::has('userGrades')){
                $data = Cache::get('userGrades');
            }else{
                $userGrades = Redis::zrevrange('userGradesSort',0,9,'withscores');
                //dd($userGrades);
                $data = self::userInfo($userGrades,'grade','act_value');
                Cache::put('userGrades',$data ,24*60);
            }
        }

        //收入排行
        if($type == 5){
            if(Cache::has('userFinancialSort')){
                $data = Cache::get('userFinancialSort');
            }else{
                $userFinancialSort = Redis::zrevrange('userFinancialSort',0,9,'withscores');
                $data = self::userInfo($userFinancialSort,'aa','money');
                Cache::put('userFinancialSort',$data ,24*60);
            }
        }

        //充值排行
        if($type == 6){
            if(Cache::has('userFinancialTopUpSort')){
                $data = Cache::get('userFinancialTopUpSort');
            }else{
                $userFinancialTopUpSort = Redis::zrevrange('userFinancialTopUpSort',0,9,'withscores');
                $data = self::userInfo($userFinancialTopUpSort,'aa','money');
                //Cache::put('userFinancialTopUpSort',$data ,24*60);
            }
        }


        //消费
        if($type == 7){
            if(Cache::has('userFinancialSaleSort')){
                $data = Cache::get('userFinancialSaleSort');
            }else{
                $userFinancialSaleSort = Redis::zrevrange('userFinancialSaleSort',0,9,'withscores');
                $data = self::userInfo($userFinancialSaleSort,'aa','money');
                Cache::put('userFinancialSaleSort',$data ,24*60);
            }
        }

        if($type == 8){
           /* Cache::forget('userFinancialSaleSort');
            Cache::forget('userFinancialTopUpSort');
            Cache::forget('userFinancialSort');
            Cache::forget('userEmplaysSort');
            Cache::forget('userHuntersSort');
            Cache::forget('userGoldSort');
            Cache::forget('userGrades');*/
        }


        return $this->formateResponse(1000,'success',$data);
    }

    //每周开始与结束
    static function everyWeekOfStartAndEnd()
    {
        $first=1;
        $sdefaultDate = date("Y-m-d");
        $w=date('w',strtotime($sdefaultDate));
        $data['week_start']=date('Y-m-d',strtotime("$sdefaultDate -".($w ? $w - $first : 6).' days'));
        $data['week_end']=date('Y-m-d H:i:s',strtotime($data['week_start'] ."+7 days"));

        return $data;
    }

    private function userInfo($users,$one,$two)
    {
        $i = 0;
        $data = '';
        foreach($users as $k=>$user){
            if($i >= 10){
                break;
            }
            $usr = UserModel::whereId($k)->first();
            $userBalance = UserBalanceModel::where('user_id',$k)->first();

            if(is_null($userBalance)){
               UserBalanceModel::where('user_id',$k)->delete();
            }
            if(!is_null($userBalance)){
                $userBalance = $userBalance->toArray();
                $data[$i]['user_grade_show'] = $userBalance['grade'];
            }

            if($one != 'aa'){
                $data[$i]['grade_name'] = $userBalance[$one];
            }

            $data[$i]['name'] = isset($usr->name) ? $usr->name : '暂无姓名';

            if($two != 'bb'){
                $data[$i]['emp_value'] = $user;
            }
            $data[$i]['uid'] = $k;
            $i++;

        }

        return $data;
    }



    //获取用户的地域信息
    public function areaInfo(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $userInfo = UserDetailModel::where('uid',$tokenInfo['uid'])->select('province','city')->first();
        $province = DistrictModel::where('id',$userInfo['province'])->select('name')->first();//省
        $city = DistrictModel::where('id',$userInfo['city'])->select('name')->first();//市
        $userInfo['province_name'] = $province['name'];
        $userInfo['city_name'] = $province['name'];
        return $this->formateResponse(1000,'success',$userInfo);
    }

    //更新用户的地域信息
    public function updateAreaInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'province' => 'required',
            'city' => 'required'
        ],[
            'province.required' => '请选择省份',
            'city.required' => '请选择市'
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        $province = DistrictModel::where('id',$request->province)->count();//省
        if(!$province) return $this->formateResponse(1001,'省份信息错误');
        $city = DistrictModel::where('id',$request->city)->count();//市
        if(!$city) return $this->formateResponse(1001,'市信息错误');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $data = array(
                'province' => $request->province,
                'city' => $request->city
            );
        $u_d_res = UserDetailModel::where('uid',$tokenInfo['uid'])->update($data);
        if(!$u_d_res) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'更新成功');
    }

    //获取用户的学校信息
    public function schoolInfo(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $userInfo = UserDetailModel::where('uid',$tokenInfo['uid'])->select('region','school')->first();
        $school = DistrictRegionModel::where('id',$userInfo['school'])->select('name')->first();//学校
        $region = DistrictRegionModel::where('id',$userInfo['region'])->select('name')->first();//大区
        $userInfo['school_name'] = $school['name'];
        $userInfo['region_name'] = $region['name'];
        return $this->formateResponse(1000,'success',$userInfo);
    }

    //更新用户的学校信息
    public function updateSchoolInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'region' => 'required',
            'school' => 'required',
        ],[
            'region.required' => '请选择大区',
            'school.required' => '请选择学校',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        $school = DistrictRegionModel::where('id',$request->school)->count();//学校
        if(!$school) return $this->formateResponse(1001,'学校信息错误');
        $region = DistrictRegionModel::where('id',$request->region)->count();//大区
        if(!$region) return $this->formateResponse(1001,'大区信息错误');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $data = array(
                'school' => $request->school,
                'region' => $request->region,
            );
        $u_d_res = UserDetailModel::where('uid',$tokenInfo['uid'])->update($data);
        if(!$u_d_res) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'更新成功');
    }

    //获取用户uid
    public function getUid(Request $request){
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        return $this->formateResponse(1000,'成功',$tokenInfo['uid']);
    }

    //激活成功获取token
    public function getToken(Request $request){
        // if(!$request->get('uuid')) return $this->formateResponse(1001,'请输入手机标识');
        $userInfo = UserModel::where('mobile',$request->get('mobile'))->select('id','name','mobile','status')->first();
        if($userInfo == null){
            $userInfo = UserModel::where('name',$request->get('mobile'))->select('id','name','mobile','status')->first();
        }
        if($userInfo->status == 2){
            // $akey = md5(Config::get('app.key'));
            // // $tokenInfo = ['uid'=>$userInfo->id, 'name' => $userInfo->name,'mobile' => $userInfo->mobile, 'akey'=>$akey,'uuid'=>$request->get('uuid')];
            // $tokenInfo = ['uid'=>$userInfo->id, 'name' => $userInfo->name,'mobile' => $userInfo->mobile, 'akey'=>$akey];
            // $token = Crypt::encrypt($tokenInfo);
            // $userDetail = [
            //     'id' => $userInfo->id,
            //     'name' => $userInfo->name,
            //     'token' => $token,
            // ];
            // Cache::put($userInfo->id, $userDetail,Config::get('session.lifetime')*60);
            // UserModel::where('id',$userInfo->id)->update(['last_login_uuid'=>$request->get('uuid')]);
            $token = self::createToken($userInfo->id,$userInfo->school,$userInfo->name,$userInfo->mobile);
            return $this->formateResponse(1000, '登录成功',array('token'=>$token));
        }else{
            return $this->formateResponse(1001,'网络错误');
        }

    }

    //检查app版本
    public function checkUpdate(Request $request)
    {
        $version = $request->version;
        $package = InstallPackageModel::orderBy('id','desc')->first()->toArray();
        if($version == $package['version']){
            return $this->formateResponse(1001,'已经是最新版本了，无需更新');
        }else{
            return $this->formateResponse(1000,'发现新版本',array('name'=>$package['name']));
        }
    }

    public function functionImg(Request $request)
    {
        $data = [
            'menu' => [
                ['name' => '首页', 'img'=> 'uploads/icon/menu/tabbar_icon_21.png', 'selected' => 'uploads/icon/menu/tabbar_icon_45.png', 'sort'=> 1],
                ['name' => '任务大厅', 'img'=> 'uploads/icon/menu/tabbar_icon_24.png', 'selected' => 'uploads/icon/menu/tabbar_icon_46.png', 'sort'=> 2],
                ['name' => '信息中心', 'img'=> 'uploads/icon/menu/tabbar_icon_26.png', 'selected' => 'uploads/icon/menu/tabbar_icon_47.png', 'sort'=> 3],
                ['name' => '我的', 'img'=> 'uploads/icon/menu/tabbar_icon_28.png', 'selected' => 'uploads/icon/menu/tabbar_icon_48.png', 'sort'=> 4],
            ],
            'background' => '#ffffff',
            'line' => '#ececec',
            'word'  =>  '#929292',
        ];
        return $this->formateResponse(1000,'success',$data);
    }


    //----------------------------以下所有为测试使用，正常代码请写上面，以防误删-----------------------------
    /**
     * 仅供测试使用()
     * @param Request $request
     */
    public function createUserInfo(Request $request)
    {
        $names = ['zfy1','zfy2','zfy3','zfy4','zfy5','zfy6','zfy7','zfy8','zfy9','zfy10'];
        $mobile = [17696041230,17696041231,17696041232,17696041233,17696041234,17696041240,17696041236,17696041237,17696041238,17696041239];
        $password = 123456;
        foreach($names as $k=>$name){
            $phone = $mobile[$k];
            UserModel::createUserForTest($name,$password,$phone);
        }
        return $this->formateResponse(1000,'success');

    }

    public function delTestUser(Request $request)
    {
        $names = ['zfy1','zfy2','zfy3','zfy4','zfy5','zfy6','zfy7','zfy8','zfy9','zfy10'];
        foreach($names as $name){
            $user = UserModel::where('name',$name)->first();
            UserModel::whereId($user->id)->delete();
            UserDetailModel::whereUid($user->id)->delete();
            UserBalanceModel::where('user_id',$user->id)->delete();
            RealnameAuthModel::where('uid',$user->id)->delete();
            TaskModel::where('uid',$user->id)->delete();
            UserGameModel::where('uid',$user->id)->delete();
            UserActiveModel::where('uid',$user->id)->delete();
            UserTeamModel::where('form_id',$user->id)->delete();
            UserGameLogModel::where('to_id',$user->id)->delete();
        }
        return $this->formateResponse(1000,'success');
    }

    //----------------------------以下所有代码为测试使用，正常代码请写上面，以防误删-----------------------------

}