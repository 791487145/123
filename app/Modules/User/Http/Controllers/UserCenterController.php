<?php
namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\UserCenterController as BasicUserCenterController;
use App\Http\Controllers\AuthController;
use App\Http\Requests;
use App\Modules\Article\Model\ArticleModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Http\Requests\PasswordRequest;
use App\Modules\User\Http\Requests\UserInfoRequest;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\User\Model\PromoteModel;
use App\Modules\User\Model\TagsModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserFocusModel;
use App\Modules\User\Model\UserTagsModel;
use App\Modules\User\Model\UserModel;
use App\Modules\User\Model\AuthRecordModel;
use Auth;
use Illuminate\Http\Request;
use Gregwar\Image\Image;
use Illuminate\Support\Facades\Session;
use Theme;

class UserCenterController extends BasicUserCenterController
{

    public function __construct()
    {
        parent::__construct();
        $this->user = Auth::user();
    }

    /**
     * 用户中心首页页面
     */
    public function index()
    {
        $this->initTheme('userindex');//主题初始化
        $this->theme->setTitle('用户中心');
        $this->theme->set('keywords','用户中心,管理中心,用户管理中心');
        $this->theme->set('description','用户中心，用户管理中心。');

        //结算推广者赏金
        PromoteModel::settlementByUid(Auth::id());

        //关联查询用户的detail数据
        $user_data = UserModel::select('users.name as nickname', 'user_detail.avatar', 'user_detail.balance')
            ->where('users.id', $this->user['id'])
            ->join('user_detail', 'users.id', '=', 'user_detail.uid')
            ->first()->toArray();
        $domain = \CommonClass::getDomain();
        $user_data['avatar_url'] = $domain . '/' . $user_data['avatar'] . md5($this->user['id'] . 'large') . '.jpg';
        //查询用户三种银行信息绑定是否成功
        $userModel = new UserModel();
        $user_auth = $userModel->isAuth($this->user['id']);
        //查询用户的绑定关系
        $userAuthOne = AuthRecordModel::where('uid',$this->user['id'])->where('status',2)
            ->whereIn('auth_code',['bank','alipay'])->get()->toArray();
        $userAuthTwo = AuthRecordModel::where('uid',$this->user['id'])->where('status',1)
            ->whereIn('auth_code',['realname','enterprise'])->get()->toArray();
        $userAuth = array_merge($userAuthOne,$userAuthTwo);
        if (!empty($userAuth) && is_array($userAuth)) {
            foreach ($userAuth as $k => $v) {
                $authCode[] = $v['auth_code'];
            }
            if (in_array('realname', $authCode)) {
                $realName = true;
            } else {
                $realName = false;
            }
            if (in_array('bank', $authCode)) {
                $bank = true;
            } else {
                $bank = false;
            }
            if (in_array('alipay', $authCode)) {
                $alipay = true;
            } else {
                $alipay = false;
            }
            if (in_array('enterprise', $authCode)) {
                $enterprise = true;
            } else {
                $enterprise = false;
            }
        } else {
            $realName = false;
            $bank = false;
            $alipay = false;
            $enterprise = false;
        }
        $authUser = array(
            'realname' => $realName,
            'bank' => $bank,
            'alipay' => $alipay,
            'enterprise' => $enterprise

    );
        //关注和粉丝数量
        $focus_num = UserFocusModel::where('uid', $this->user['id'])->count();
        $fans_num = UserFocusModel::where('focus_uid', $this->user['id'])->count();

        //关注的人
        $focus_data = UserFocusModel::select('user_focus.*', 'ud.avatar', 'us.name as nickname')
            ->where('user_focus.uid', $this->user['id'])
            ->join('user_detail as ud', 'user_focus.focus_uid', '=', 'ud.uid')
            ->leftjoin('users as us','us.id','=','user_focus.focus_uid')
            ->get()->toArray();

        //我接受的任务id
        $my_task = WorkModel::where('uid', $this->user['id'])->lists('task_id')->toArray();
        $my_task_id = array_flatten($my_task);
        $my_task_id = array_unique($my_task_id);
        $my_task_data = TaskModel::select('task.*', 'ud.avatar', 'us.name as nickname', 'tc.name as category_name')
            ->whereIn('task.id', $my_task_id)
            ->join('user_detail as ud', 'ud.uid', '=', 'task.uid')
            ->leftjoin('cate as tc', 'tc.id', '=', 'task.cate_id')
            ->leftjoin('users as us','us.id','=','task.uid')
            ->orderBy('task.created_at','desc')->limit(5)->get()->toArray();
        $status = [
            'status' => [
                0 => '暂不发布',
                1 => '已经发布',
                2 => '赏金托管',
                3 => '审核通过',
                4 => '威客交稿',
                5 => '雇主选稿',
                6 => '任务公示',
                7 => '交付验收',
                8 => '双方互评',
                9 => '成功完成',
                10 => '任务失败',
                11=>'维权中'
            ]
        ];
        $my_task_data = \CommonClass::intToString($my_task_data, $status);

        //我发布的任务
        $tasks = TaskModel::select('task.*', 'us.name as nickname', 'tc.name as category_name', 'ud.avatar')
            ->where('task.status','>',2)
            ->where('task.uid', $this->user['id'])
            ->join('user_detail as ud', 'ud.uid', '=', 'task.uid')
            ->leftjoin('users as us','us.id','=','task.uid')
            ->leftjoin('cate as tc', 'tc.id', '=', 'task.cate_id')
            ->orderBy('task.created_at','desc')->limit(5)->get()->toArray();
        $tasks = \CommonClass::intToString($tasks, $status);

        $view = [
            'user_data' => $user_data,
            'user_auth' => $user_auth,
            'auth_user' => $authUser,
            'focus_num' => $focus_num,
            'fans_num' => $fans_num,
            'focus_data' => $focus_data,
            'task' => $tasks,
            'my_task' => $my_task_data,
            'domain' => $domain,
        ];
        $this->theme->set('TYPE',1);
        return $this->theme->scope('user.index', $view)->render();
    }


    /**
     * 用户详细信息修改页面
     * @return mixed
     */
    public function info()
    {
        $this->initTheme('userinfo');//主题初始化
        $this->theme->setTitle('用户中心');
        //创建用户的信息
        $uinfo = UserDetailModel::findByUid($this->user['id']);
        //查询省信息
        $province = DistrictModel::findTree(0);
        //查询城市数据
        if (!is_null($uinfo['province'])) {
            $city = DistrictModel::findTree($uinfo['province']);
        } else {
            $city = DistrictModel::findTree($province[0]['id']);
        }
        //查询地区信息
        if (!is_null($uinfo['city'])) {
            $area = DistrictModel::findTree($uinfo['city']);
        } else {
            $area = DistrictModel::findTree($city[0]['id']);
        }
        //查找用户绑定手机号
        $user=UserModel::where('id', Auth::id())->first();
     


        $view = array(
            'uinfo' => $uinfo,
            'province' => $province,
            'city' => $city,
            'area' => $area,
            'user' => $this->user,
            'mobile'=>$user['mobile'],
        );

        return $this->theme->scope('user.info', $view)->render();
    }

    /**
     * 用户信息更新，在第一次的时候创建
     * @param UserInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function infoUpdate(UserInfoRequest $request)
    {
        $data = $request->except('_token','name','email');

        $result = UserDetailModel::where('uid', $this->user['id'])->update($data);

        if (!$result) {
            return redirect()->back()->with(['error' => '修改失败！']);
        }

        return redirect()->back()->with(['massage' => '修改成功！']);
    }

    /**
     * 用户修改密码页
     * @return mixed
     */
    public function loginPassword()
    {
        $this->initTheme('userinfo');
        $this->theme->setTitle('修改密码');

        $view = [
            'user' => $this->user,
        ];

        return $this->theme->scope('user.userpassword', $view)->render();
    }

    /**
     * 用户修改密码
     * @param PasswordRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function passwordUpdate(PasswordRequest $request)
    {
        //验证用户的密码
        $data = $request->except('_token');

        //验证原密码是否正确
        if (!UserModel::checkPassword($this->user['email'], $data['oldpassword'])) {
            return redirect()->back()->with('error', '原始密码错误！');
        }
        $result = UserModel::psChange($data, $this->user);

        if (!$result) {
            return redirect()->back()->with('error' . '密码修改失败！');  //回传错误信息
        }
        Auth::logout();
        return redirect('login')->with(['message' => '修改密码成功，请重新登录']);
    }

    /**
     * 用户修改支付密码
     * @return mixed
     */
    public function payPassword()
    {
        $this->initTheme('userinfo');
        $this->theme->setTitle('修改支付密码');
        UserDetailModel::closeTips();

        $view = [
            'user' => $this->user,
        ];
        return $this->theme->scope('user.paypassword', $view)->render();
    }

    /**
     * 检测发送邮件倒计时时间(修改支付密码)
     */
    public function checkInterVal(){
        $sendTime = Session::get('send_code_time');
        $nowTime = time();
        if(empty($sendTime)){
            return response()->json(['errCode'=>3]);
        }else{
            if($nowTime - $sendTime < 60 ){//时间在0-60
                return response()->json(['errCode'=>1,'interValTime'=>60-($nowTime - $sendTime)]);
            }else{
                return response()->json(['errCode'=>2]);//大于60
            }
        }
    }

    /**
     * 用户修改密码发送邮件
     */
    public function sendEmail(Request $request)
    {
        $email = $request->get('email');
        //验证用户填写邮箱
        if ($email != $this->user['email']) {
            return response()->json(['errCode' => 0, 'errMsg' => '请输入注册时候填写的邮箱！']);
        }
        $result = \MessagesClass::sendCodeEmail($this->user);

        if (!$result) {
            return response()->json(['errCode' => 0, 'errMsg' => $result]);
        } else {
            Session::put('send_code_time', time());
            return response()->json(['errCode' => 1]);
        }
    }

    /**
     * 验证用户输入邮箱是否注册邮箱
     * @param Request $request
     * @return mixed
     */
    public function checkEmail(Request $request)
    {
        $sendTime = Session::get('send_code_time');
        $nowTime = time();
        if ($nowTime - $sendTime < 60) {
            return response()->json(['errCode' => 0, 'errMsg' => '请稍后点击发送验证码！']);
        }
        $email = $request->get('email');
        //验证用户填写邮箱
        if ($email != $this->user['email']) {
            return response()->json(['errCode' => 0, 'errMsg' => '请输入注册时候填写的邮箱！']);
        } else {
            return response()->json(['errCode' => 1]);
        }
    }

    /**
     * 验证用户的验证码跳转修改密码页面
     */
    public function validateCode(Request $request)
    {
        $this->initTheme('userinfo');
        $this->theme->setTitle('修改支付密码');
        //验证验证码
        $code = $request->get('code');
        $email = $request->get('email');
        $session_code = Session::get('payPasswordCode');
        if ($code != $session_code) {
            return redirect()->to('user/payPassword')->withInput(['email' => $email, 'code' => $code])->withErrors(['code' => '验证码错误']);
        }

        return $this->theme->scope('user.paypasswordupdate')->render();
    }

    /**
     * 用户修改支付密码提交
     * @param PasswordRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function payPasswordUpdate(PasswordRequest $request)
    {
        $data = $request->except('_token');

        $result = UserModel::payPsUpdate($data, $this->user);

        if (!$result) {
            return redirect()->back()->with('error', '密码修改失败！');  //回传错误信息
        }

        return redirect()->to('user/payPassword')->with('message', '密码修改成功！');
    }

    /**
     * 标签修改页面
     * @return mixed
     */
    public function skill()
    {
        $this->initTheme('userinfo');
        $this->theme->setTitle('标签设置');
        //查询用户原有的标签id
        $tag = UserTagsModel::myTag($this->user['id']);
        $tags = array_flatten($tag);
        //查询所有标签
        $hotTag = TagsModel::findAllSkill();

        $view = array(
            'hotTag' => $hotTag,
            'tags' => $tags,
            'user' => $this->user,
        );
        return $this->theme->scope('user.sign', $view)->render();
    }

    /**
     * 用户设置标签一次性添加
     * @param Request $request
     */
    public function skillSave(Request $request)
    {
        $data = $request->all();

        $tags = explode(',', $data['tags']);
        //查询用户所有的标签id
        $old_tags = UserTagsModel::myTag($this->user['id']);
        $old_tags = array_flatten($old_tags);
        //验证用户更改了标签
        if ((empty($data['tags']) && $data['tags'] != 'change')) {
            return redirect()->back()->withErrors(['tags_name' => '请更新标签后提交！']);
        }

        //判断是在添加标签还是在删除标签
        if (count($tags) > count($old_tags)) {
            //判断用户有多少个标签
            if (count($tags) > 5) {
                return redirect()->back()->withErrors(['tags_name' => '一个用户最多只能有五个标签']);
            }
            $dif_tags = array_diff($tags, $old_tags);
            $result = UserTagsModel::insert($dif_tags, $this->user['id']);
            if (!$result)
                return redirect()->back()->with('error', '更新标签错误');  //回传错误信息
        } else if (count($tags) < count($old_tags)) {
            $dif_tags = array_diff($old_tags, $tags);
            $result = UserTagsModel::tagDelete($dif_tags, $this->user['id']);
            if (!$result)
                return redirect()->back()->with('error', '更新标签错误');  //回传错误信息
        } else if (count($tags) == count($old_tags)) {
            //增加新标签
            $dif_tags = array_diff($tags, $old_tags);
            if(empty($dif_tags))
            {
                return redirect()->back()->withErrors(['tags_name' => '请更新标签后提交！']);
            }
            $result2 = UserTagsModel::insert($dif_tags, $this->user['id']);
            //删除老标签
            $dif_tags = array_diff($old_tags, $tags);
            $result = UserTagsModel::tagDelete($dif_tags, $this->user['id']);
            if (!$result && !$result2)
                return redirect()->back()->with('error', '更新标签错误');  //回传错误信息
        }

        return redirect()->back()->with('massage', '标签更新成功');
    }

    /**
     * 用户头像设置页
     * @return mixed
     */
    public function userAvatar()
    {
        $theme = Theme::uses('default')->layout('usercenter');
        $theme->setTitle('头像设置');
        //查询用户的头像信息
        $user_detail = UserDetailModel::findByUid($this->user['id']);

        $view = [
            'avatar' => $user_detail['avatar'],
            'id' => $this->user['id']
        ];

        return $this->theme->scope('user.avatar', $view)->render();
    }

    /**
     * ajax头像裁剪
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatarEdit(Request $request)
    {
        $data = $request->except('_token');
        $data = $data['data'];
        //查询用户头像路径
        $user_head = UserDetailModel::findByUid($this->user['id']);
        $path = $user_head['avatar'] . md5($this->user['id'] . 'large') . '.jpg';
        $img = Image::open($path);
        $img->crop(intval($data['x']), intval($data['y']), intval($data['width']), intval($data['height']));
        $result = $img->save($path);
        $domain = \CommonClass::getDomain();
        $json = [
            'status' => 1,
            'message' => '成功保存',
            'url' => $path,
            'path' => $domain . '\\' . $path
        ];
        //生成三张图片
        $result2 = \FileClass::headHandle($json, $this->user['id']);

        if (!$result || !$result2) {
            array_replace($json, ['status' => 0, 'message' => '编辑失败']);
        }
        return response()->json($json);
    }

    /**
     * ajax头像上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxAvatar(Request $request)
    {
        $file = $request->file('avatar');
        //处理上传图片
        $result = \FileClass::uploadFile($file, $path = 'user');
        $result = json_decode($result, true);

        //判断文件是否上传
        if ($result['code'] != 200) {
            return response()->json(['code' => 0, 'message' => $result['message']]);
        }
        //产生一条新纪录
        $attachment_data = array_add($result['data'], 'status', 1);
        $attachment_data['created_at'] = date('Y-m-d H:i:s', time());
        //将记录写入到attchement表中
        $result2 = AttachmentModel::create($attachment_data);
        if (!$result2)
            return response()->json(['code' => 0, 'message' => $result['message']]);

        //删除原来的头像
        $avatar = \CommonClass::getAvatar($this->user['id']);
        if (file_exists($avatar)) {
            $file_delete = unlink($avatar);
            if ($file_delete) {
                AttachmentModel::where('url', $avatar)->delete();
            } else {
                AttachmentModel::where('url', $avatar)->update(['status' => 0]);
            }
        }
        //修改用户头像
        $data = [
            'avatar' => $result['data']['url']
        ];
        $result3 = UserDetailModel::updateData($data, $this->user['id']);
        if (!$result3) {
            return \CommonClass::formatResponse('文件上传失败');
        }

        return response()->json($result);
    }

    /**
     * ajax获取城市、地区数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxCity(Request $request)
    {
        $id = intval($request->get('id'));
        if (!$id) {
            return response()->json(['errMsg' => '参数错误！']);
        }
        $province = DistrictModel::findTree($id);
        //查询第一个市的数据
        $area = DistrictModel::findTree($province[0]['id']);
        $data = [
            'province' => $province,
            'area' => $area
        ];
        return response()->json($data);
    }

    /**
     * ajax获取地区的数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxArea(Request $request)
    {
        $id = intval($request->get('id'));
        if (!$id) {
            return response()->json(['errMsg' => '参数错误！']);
        }
        $area = DistrictModel::findTree($id);
        return response()->json($area);
    }



    /**
     * 滑块请求图片生成
     */
    public function StartCaptchaServlet()
    {
        $res = [
            'id' => 'e20876c0cecee2f36887c48eaf85639d',
            'key' => '28f1e7dcd36e1af44273146ea8a19605'
        ];
        $GtSdk = $this->GtSdk = new \GeetestLib($res['id'], $res['key']);
        session_start();
        $data = array(
            "user_id" => uniqid(), # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => $_SERVER["SERVER_ADDR"] # 请在此处传输用户请求验证时所携带的IP
        );
        $status = $GtSdk->pre_process($data, 1);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $data['user_id'];
        echo $GtSdk->get_response_str();
    }

}
