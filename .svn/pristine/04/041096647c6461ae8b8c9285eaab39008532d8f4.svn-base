<?php
namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\UserCenterController;
use App\Modules\User\Http\Requests\AlipayAuthRequest;
use App\Modules\User\Http\Requests\EmailAuthRequest;
use App\Modules\User\Http\Requests\VerifyAlipayCashRequest;
use App\Modules\User\Http\Requests\VerifyBankCashRequest;
use App\Modules\User\Model\AlipayAuthModel;
use App\Modules\User\Model\BankAuthModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\User\Http\Requests\BankAuthRequest;
use App\Modules\User\Http\Requests\RealnameAuthRequest;
use App\Modules\User\Model\RealnameAuthModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use Auth;
use Crypt;
use Illuminate\Support\Facades\Session;

class AuthController extends UserCenterController
{

    public function __construct()
    {
        parent::__construct();
        $this->initTheme('userinfo');
    }

    
    public function getEmailAuth()
    {
        $this->theme->setTitle('邮箱认证');
        $user = Auth::User();
        switch ($user->email_status){
            case 0:
                $data = array(
                    'email' => $user->email,
                    'step' => 1
                );
                break;
            case 1:
                $data = array(
                    'email' => $user->email,
                    'step' => 2,
                    'emailType' => substr($user->email, strpos($user->email, '@') + 1)
                );
                break;
            case 2:
                $data = array(
                    'email' => $user->email,
                    'step' => 3
                );
                break;
        }
        return $this->theme->scope('user.emailauth', $data)->render();
    }

    
    public function getPhoneAuth()
    {
        $user = UserModel::where('id', Auth::id())->first();

        $data = [
            'mobile' => $user->mobile ? $user->mobile : ''
        ];

        return $this->theme->scope('user.phoneauth', $data)->render();
    }

    
    public function postPhoneAuth(Request $request)
    {
        $data = $request->except('_token');

        $auth = Session::get('mobile_bind_info');
        if ($data['mobile'] == $auth['mobile'] && $data['code'] == $auth['code']){
            $status = UserModel::where('id', Auth::id())->update(['mobile' => $data['mobile']]);
            UserDetailModel::where('uid', Auth::id())->update(['mobile' => $data['mobile']]);

            if ($status){
                Session::forget('mobile_bind_info');
                return redirect('user/phoneAuth');
            }
        }
        return back()->withInput()->withErrors(['code' => '请输入正确的验证码']);
    }

    
    public function sendBindSms(Request $request)
    {
        $arr = $request->except('_token');
        $mobile = $arr['mobile'];

        $res = [
            'id' => 'e20876c0cecee2f36887c48eaf85639d',
            'key' => '28f1e7dcd36e1af44273146ea8a19605'
        ];
        session_start();
        $data = array(
            "user_id" => $_SESSION['user_id'], 
            "client_type" => "web", 
            "ip_address" => $_SERVER["SERVER_ADDR"] 
        );
        $GtSdk = $this->GtSdk = new \GeetestLib($res['id'], $res['key']);
        
        if ($_SESSION['gtserver'] == 1) {
            $result = $GtSdk->success_validate($request->geetest_challenge, $request->geetest_validate, $request->geetest_seccode, $data);
            if ($result) {
                
                $templates = [
                    'YunTongXun' => '208993'
                ];

                $tempData = [
                    'code' => rand(1000, 9999),
                    'time' => '5'
                ];

                $status = \SmsClass::sendSms($mobile, $templates, $tempData);

                if ($status['success']){
                    $info = [
                        'mobile' => $mobile,
                        'code' => $tempData['code']
                    ];
                    Session::put('mobile_bind_info', $info);
                    return ['code' => 1000, 'msg' => '短信发送成功'];

                } else {
                    return ['code' => 1001, 'msg' => '短信发送失败'];
                }
            } else {
                return ['info' => 0, 'msg' => '请先通过滑块验证'];
            }
        } else {
            
            if ($GtSdk->fail_validate($request->geetest_challenge, $request->geetest_validate, $request->geetest_seccode)) {

                
                $templates = [
                    'YunTongXun' => '153940'
                ];

                $tempData = [
                    'code' => rand(1000, 9999),
                    'time' => '5'
                ];

                $status = \SmsClass::sendSms($mobile, $templates, $tempData);

                if ($status['success']){
                    $info = [
                        'mobile' => $mobile,
                        'code' => $tempData['code']
                    ];
                    Session::put('mobile_bind_info', $info);
                    return ['code' => 1000, 'msg' => '短信发送成功'];

                } else {
                    return ['code' => 1001, 'msg' => '短信发送失败'];
                }
            } else {
                return ['info' => 0, 'msg' => '请先通过滑块验证'];
            }
        }




    }

    
    public function getUnbindMobile()
    {
        $user = UserModel::where('id', Auth::id())->whereNotNull('mobile')->first();

        if (!empty($user)){
            $data = [
                'mobile' => $user->mobile
            ];
            return $this->theme->scope('user.unbindmobile', $data)->render();
        }

    }

    
    public function postUnbindMobile(Request $request)
    {
        $data = $request->except('_token');

        $info = Session::get('mobile_unbind_info');

        if ($data['mobile'] == $info['mobile'] && $data['code'] == $info['code']){
            $status = UserModel::where('id', Auth::id())->update(['mobile' => '']);
            if ($status){
                Session::forget('mobile_unbind_info');
                return redirect('user/phoneAuth');
            }
        }

        return back()->withErrors(['code' => '请输入正确的验证码']);
    }

    
    public function sendUnbindSms(Request $request)
    {
        $arr = $request->except('_token');
        $mobile = $arr['mobile'];

        $res = [
            'id' => 'e20876c0cecee2f36887c48eaf85639d',
            'key' => '28f1e7dcd36e1af44273146ea8a19605'
        ];
        session_start();
        $data = array(
            "user_id" => $_SESSION['user_id'], 
            "client_type" => "web", 
            "ip_address" => $_SERVER["SERVER_ADDR"] 
        );
        $GtSdk = $this->GtSdk = new \GeetestLib($res['id'], $res['key']);

        
        if ($_SESSION['gtserver'] == 1) {
            $result = $GtSdk->success_validate($request->geetest_challenge, $request->geetest_validate, $request->geetest_seccode, $data);
            if ($result) {

                
                $templates = [
                    'YunTongXun' => '208994'
                ];

                $tempData = [
                    'code' => rand(1000, 9999),
                    'time' => '5'
                ];

                $status = \SmsClass::sendSms($mobile, $templates, $tempData);

                if ($status['success']){
                    $info = [
                        'mobile' => $mobile,
                        'code' => $tempData['code']
                    ];
                    Session::put('mobile_unbind_info', $info);
                    return ['code' => 1000, 'msg' => '短信发送成功'];
                } else {
                    return ['code' => 1001, 'msg' => '短信发送失败'];
                }
            } else {
                return ['info' => 0, 'msg' => '请先通过滑块验证'];
            }
        } else {
            
            if ($GtSdk->fail_validate($request->geetest_challenge, $request->geetest_validate, $request->geetest_seccode)) {

                
                $templates = [
                    'YunTongXun' => '153942'
                ];

                $tempData = [
                    'code' => rand(1000, 9999),
                    'time' => '5'
                ];

                $status = \SmsClass::sendSms($mobile, $templates, $tempData);

                if ($status['success']){
                    $info = [
                        'mobile' => $mobile,
                        'code' => $tempData['code']
                    ];
                    Session::put('mobile_unbind_info', $info);
                    return ['code' => 1000, 'msg' => '短信发送成功'];
                } else {
                    return ['code' => 1001, 'msg' => '短信发送失败'];
                }
            } else {
                return ['info' => 0, 'msg' => '请先通过滑块验证'];
            }
        }


    }


    
    public function sendEmailAuth(EmailAuthRequest $request)
    {
        $user = Auth::User();
        $email = $user->email;
        if (empty($user->email)){
            $email = $request->get('email');
        }
        $res = UserModel::where(['email' => $email, 'email_status' => 2])->first();
        if (!empty($res)){
            return back()->withErrors(['email' => '当前邮箱已绑定']);
        }
        $data = array(
            'email' => $email,
            'email_status' => 1,
            'validation_code' => \CommonClass::random(4),
            'overdue_date' => date('Y-m-d H:i:s', time() + 60*10)
        );
        $status = $user->update($data);
        if ($status){
            $status = \MessagesClass::sendEmailAuth($email);
            if ($status){
                return redirect('user/emailAuth');
            }
        }
    }

    public function reSendEmailAuth($email)
    {
        $status = \MessagesClass::sendEmailAuth($email);

        if ($status){
            return response()->json([
                'status' => 'success'
            ]);
        }

        return response()->json([
            'status' => 'fail',
        ]);
    }

    
    public function verifyEmail($validatonInfo)
    {
        $validatonInfo = Crypt::decrypt($validatonInfo);
        $info = UserModel::where('email', $validatonInfo['email'])->where('validation_code', $validatonInfo['validationCode'])->first();
        if (!empty($info)){
            if (time() < strtotime($info->overdue_date)){
                $user = Auth::User();
                $status = $user->update(array('email_status' => 2));
                if ($status)
                    return redirect('user/emailAuth');
            }
        }

    }

    
    public function getPayList()
    {
        $this->theme->setTitle('支付认证');
        $user = Auth::User();
        
        $bankAuth = BankAuthModel::where('uid', $user->id)->count();
        $alipayAuth = AlipayAuthModel::where('uid', $user->id)->count();
        $data = array(
            'bankAuth' => $bankAuth,
            'alipayAuth' => $alipayAuth
        );

        return $this->theme->scope('user.paylist', $data)->render();
    }


    
    public function getRealnameAuth()
    {
         $this->theme->setTitle('实名认证');

        $user = Auth::User();
        $realnameInfo = RealnameAuthModel::where('uid', $user->id)->orderBy('created_at', 'desc')->first();

        $data = array();
        if (isset($realnameInfo->status)) {
            $data = array(
                'realname' => $realnameInfo->realname,
                'card_number' => \CommonClass::starReplace($realnameInfo->card_number, 4, 10)
            );
            switch ($realnameInfo->status) {
                case 0:
                    $view = 'user.waitrealnameauth';
                    break;
                case 1:
                    $view = 'user.realnameauthsuccess';
                    break;
                case 2:
                    $view = 'user.realnameauthfail';
                    break;
            }
        } else {
            $view = 'user.realnameauth';
        }

        return $this->theme->scope($view, $data)->render();
    }


    
    public function postRealnameAuth(RealnameAuthRequest $request)
    {
        $card_front_side = $request->file('card_front_side');
        $card_back_dside = $request->file('card_back_dside');
        $validation_img = $request->file('validation_img');

        $realnameInfo = array();
        $authRecordInfo = array();
        $error = array();
        $allowExtension = array('jpg', 'gif', 'jpeg', 'bmp', 'png');
        if ($card_front_side) {
            $uploadMsg = json_decode(\FileClass::uploadFile($card_front_side, 'user', $allowExtension));
            if ($uploadMsg->code != 200) {
                $error['card_front_side'] = $uploadMsg->message;
            } else {
                $realnameInfo['card_front_side'] = $uploadMsg->data->url;
            }
        }
        if ($card_back_dside) {
            $uploadMsg = json_decode(\FileClass::uploadFile($card_back_dside, 'user', $allowExtension));
            if ($uploadMsg->code != 200) {
                $error['card_back_dside'] = $uploadMsg->message;
            } else {
                $realnameInfo['card_back_dside'] = $uploadMsg->data->url;
            }
        }
        if ($validation_img) {
            $uploadMsg = json_decode(\FileClass::uploadFile($validation_img, 'user', $allowExtension));
            if ($uploadMsg->code != 200) {
                $error['validation_img'] = $uploadMsg->message;
            } else {
                $realnameInfo['validation_img'] = $uploadMsg->data->url;
            }
        }

        if (!empty($error)) {
            return back()->withErrors($error)->withInput();
        }

        $user = Auth::User();

        $now = time();

        $realnameInfo['uid'] = $user->id;
        $realnameInfo['username'] = $user->name;
        $realnameInfo['realname'] = $request->get('realname');
        $realnameInfo['card_number'] = $request->get('card_number');
        $realnameInfo['created_at'] = date('Y-m-d H:i:s', $now);
        $realnameInfo['updated_at'] = date('Y-m-d H:i:s', $now);

        $authRecordInfo['uid'] = $user->id;
        $authRecordInfo['username'] = $user->name;
        $authRecordInfo['auth_code'] = 'realname';

        $RealnameAuthModel = new RealnameAuthModel();
        $status = $RealnameAuthModel->createRealnameAuth($realnameInfo, $authRecordInfo);

        if ($status)
            return redirect('user/realnameAuth');
    }

    
    public function reAuthRealname()
    {
        $this->theme->setTitle('实名认证');
        $user = Auth::User();
        $realnameInfo = RealnameAuthModel::where('uid', $user->id)->where('status', 2)->orderBy('created_at', 'desc')->first();

        if ($realnameInfo){
            return $this->theme->scope('user.realnameauth')->render();
        }
    }


    
    public function getBankAuth()
    {
        $this->theme->setTitle('银行卡认证');

        $bankname = array(
            '农业银行', '交通银行', '招商银行', '工商银行', '建设银行', '中国银行', '工商银行', '邮政储蓄银行', '民生银行', '浦发银行', '华夏银行'
        );
        $province = DistrictModel::findTree(0);

        $data = array(
            'province' => $province,
            'bankname' => $bankname
        );

        return $this->theme->scope('user.bankauth', $data)->render();
    }

    
    public function getZone(Request $request)
    {
        $id = intval($request->get('id'));
        if (!$id) {
            return \CommonClass::formatResponse('参数错误', 1001);
        }

        $arrZones = DistrictModel::findTree($id);
        $html = '';
        if ($arrZones) {
            foreach ($arrZones as $k => $v) {
                $html .= "<option value='" . $v['id'] . "'>" . $v['name'] . "</option>";
            }
        } else {
            $html .= "<option value=''>没有了</option>";
        }

        return \CommonClass::formatResponse('success', 200, $html);
    }


    
    public function postBankAuth(BankAuthRequest $request)
    {
        $user = Auth::User();
        $userDetail = UserDetailModel::where('uid', $user->id)->first();
        
        

        
        $depositArea = $request->get('province') . ',' . $request->get('city') . ',' . $request->get('area');
        $bankAuthInfo = array();
        $authRecordInfo = array();
        $now = time();
        $bankAuthInfo['uid'] = $user->id;
        $bankAuthInfo['username'] = $user->name;
        $bankAuthInfo['realname'] = $userDetail['realname'];
        $bankAuthInfo['bank_name'] = $request->get('bankname');
        $bankAuthInfo['bank_account'] = $request->get('bankAccount');
        $bankAuthInfo['deposit_name'] = $request->get('depositName');
        $bankAuthInfo['deposit_area'] = $depositArea;
        $bankAuthInfo['created_at'] = date('Y-m-d H:i:s', $now);
        $bankAuthInfo['updated_at'] = date('Y-m-d H:i:s', $now);

        $authRecordInfo['uid'] = $user->id;
        $authRecordInfo['username'] = $user->name;
        $authRecordInfo['auth_code'] = 'bank';
        
        $status = BankAuthModel::createBankAuth($bankAuthInfo, $authRecordInfo);
        if ($status)
            return redirect('/user/bankAuthSchedule/' . Crypt::encrypt($status));
    }

    
    public function getBankAuthSchedule($bankAuthId)
    {
        $this->theme->setTitle('银行认证');
        $bankAuthId = Crypt::decrypt($bankAuthId);
        $user = Auth::User();

        $authInfo = BankAuthModel::where('id', $bankAuthId)->where('uid', $user->id)->first();
        if (!empty($authInfo)){
            $arrDistrict = explode(',', $authInfo->deposit_area);

            $authInfo['districtname'] = DistrictModel::getDistrictName($arrDistrict);

            switch ($authInfo['status']) {
                
                case 0:
                    $path = 'user.waitbankauth';
                    break;
                
                case 1:
                    $path = 'user.bankauthcash';
                    break;
                
                case 2:
                    $path = 'user.bankauthsuccess';
                    break;
                
                case 3:
                    $path = 'user.bankauthfail';
                    break;
            }
            $view = array(
                'authInfo' => $authInfo,
                'authId' => $bankAuthId
            );
            return $this->theme->scope($path, $view)->render();
        }
    }

    
    public function verifyBankAuthCash(VerifyBankCashRequest $request)
    {
        $this->theme->setTitle('银行认证');
        $authId = Crypt::decrypt($request->get('bankAuthId'));
        
        $user = Auth::User();
        $bankAuthInfo = BankAuthModel::where('uid', $user->id)->where('id', $authId)->first();

        if ($bankAuthInfo) {
            
            $bankAuthInfo->user_get_cash = $request->get('cash');
            if ($bankAuthInfo['pay_to_user_cash'] == $request->get('cash')) {
                
                $res = BankAuthModel::bankAuthPass($authId);
                if ($res) {
                    $tpl = 'user.bankauthsuccess';
                }
            } else {
                $res = BankAuthModel::bankAuthDeny($authId);
                if ($res) {
                    $tpl = 'user.bankauthfail';
                }
            }
            $bankAuthInfo['districtname'] = DistrictModel::getDistrictName(explode(',', $bankAuthInfo->deposit_area));
            $data = array(
                'authInfo' => $bankAuthInfo
            );
            return $this->theme->scope($tpl, $data)->render();
        }
    }

    
    public function listBankAuth()
    {
        $this->theme->setTitle('银行认证');

        $user = Auth::User();

        $arrBankAuth = BankAuthModel::where('uid', $user->id)->get();

        $view = array(
            'arrBankAuth' => $arrBankAuth
        );

        return $this->theme->scope('user.bankauthlist', $view)->render();
    }

    
    public function changeBankAuth(Request $request)
    {
        $authId = Crypt::decrypt($request->get('authId'));
        $bankAuthInfo = BankAuthModel::where('id', $authId)->first();
        if (!empty($bankAuthInfo) && $bankAuthInfo->status == 2 || $bankAuthInfo->status == 4){
            if ($bankAuthInfo->status == 2){
                $status = 4;
            } else {
                $status = 2;
            }
            $status = BankAuthModel::changeBankAuth($authId, $status);

            if ($status)
                return redirect('/user/bankAuthList');
        }
    }

    
    public function getAlipayAuth()
    {
        $this->theme->setTitle('支付宝认证');

        return $this->theme->scope('user.alipayauth')->render();
    }


    
    public function postAlipayAuth(AlipayAuthRequest $request)
    {
        
        $user = Auth::User();
        $userDetail = UserDetailModel::where('uid', $user->id)->first();
        $alipayAuthInfo = array();
        $alipayAuthInfo['uid'] = $user->id;
        $alipayAuthInfo['username'] = $user->name;
        $alipayAuthInfo['realname'] = $userDetail['realname'];
        $alipayAuthInfo['alipay_name'] = $request->get('alipayName');
        $alipayAuthInfo['alipay_account'] = $request->get('alipayAccount');
        $alipayAuthInfo['created_at'] = date('Y-m-d H:i:s');
        $alipayAuthInfo['updated_at'] = date('Y-m-d H:i:s');

        $authRecordInfo = array();
        $authRecordInfo['uid'] = $user->id;
        $authRecordInfo['username'] = $user->name;
        $authRecordInfo['auth_code'] = 'alipay';

        $status = AlipayAuthModel::createAlipayAuth($alipayAuthInfo, $authRecordInfo);

        if ($status)
            return redirect('/user/alipayAuthSchedule/' . Crypt::encrypt($status));
    }


    
    public function getAlipayAuthSchedule($alipayAuthId)
    {
        $this->theme->setTitle('支付宝认证');
        $alipayAuthId = Crypt::decrypt($alipayAuthId);
        
        $user = Auth::User();
        $alipayAuthInfo = AlipayAuthModel::where('id', $alipayAuthId)->where('uid', $user->id)->first();

        if (!empty($alipayAuthInfo)){
            $view = array();
            $view['alipayAuthInfo'] = $alipayAuthInfo;
            switch ($alipayAuthInfo['status']) {
                
                case 0:
                    $path = 'user.waitalipayauth';
                    break;
                case 1:
                    $path = 'user.alipayauthcash';
                    break;
                case 2:
                    $path = 'user.alipayauthsuccess';
                    break;
                case 3:
                    $path = 'user.alipayauthfail';
                    break;
            }
            return $this->theme->scope($path, $view)->render();
        }

    }

    
    public function verifyAlipayAuthCash(VerifyAlipayCashRequest $request)
    {
        $this->theme->setTitle('支付宝认证');
        $authId = Crypt::decrypt($request->get('alipayAuthId'));
        
        $user = Auth::User();
        $alipayAuthInfo = AlipayAuthModel::where('uid', $user->id)->where('id', $authId)->first();

        if ($alipayAuthInfo) {
            
            $view = array();
            $view['alipayAuthInfo'] = $alipayAuthInfo;
            $alipayAuthInfo->user_get_cash = $request->get('cash');
            if ($alipayAuthInfo['pay_to_user_cash'] == $request->get('cash')) {
                $res = AlipayAuthModel::alipayAuthPass($authId);
                $tpl = 'user.alipayauthsuccess';
            } else {
                $res = AlipayAuthModel::alipayAuthDeny($authId);
                $tpl = 'user.alipayauthfail';
            }
            if ($res) {
                return $this->theme->scope($tpl, $view)->render();
            }
        }

    }

    
    public function listAlipayAuth()
    {
        $this->theme->setTitle('支付宝认证');

        $user = Auth::User();

        $arrAlipayAuth = AlipayAuthModel::where('uid', $user->id)->get();

        $view = array(
            'arrAlipayAuth' => $arrAlipayAuth
        );

        return $this->theme->scope('user.alipayauthlist', $view)->render();
    }

    
    public function changeAlipayAuth(Request $request)
    {
        $id = Crypt::decrypt($request->get('authId'));
        $alipayAuthInfo = AlipayAuthModel::where('id', $id)->first();

        if (!empty($alipayAuthInfo) && $alipayAuthInfo->status == 2 || $alipayAuthInfo->status == 4){
            if ($alipayAuthInfo->status == 2){
                $status = 4;
            } else {
                $status = 2;
            }
            $res = AlipayAuthModel::changeAlipayAuth($id, $status);

            if ($res)
                return redirect('/user/alipayAuthList');
        }
    }



}