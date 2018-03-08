<?php

namespace App\Modules\User\Http\Controllers\Auth;

use App\Http\Controllers\IndexController;
use App\Modules\Manage\Model\AgreementModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\User\Http\Requests\LoginRequest;
use App\Modules\User\Http\Requests\RegisterPhoneRequest;
use App\Modules\User\Http\Requests\RegisterRequest;
use App\Modules\User\Model\OauthBindModel;
use App\Modules\User\Model\PromoteModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Validator;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Theme;
use Crypt;
use Socialite;
use App\Modules\Advertisement\Model\AdTargetModel;
use Toplan\PhpSms;
use SmsManager;

class AuthController extends IndexController
{

    


    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    
    protected $redirectPath = '/user/index';

    
    protected $loginPath = '/login';

    

    public function __construct()
    {
        parent::__construct();
        $this->initTheme('auth');
        $this->theme->setTitle('威客|系统—客客出品,专业威客建站系统开源平台');
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    
    protected $code;

    protected function validator(array $data)
    {

    }

    
    protected function  create(array $data)
    {
        
        return UserModel::createUser($data);
    }


    
    public function getLogin()
    {
        $code = \CommonClass::getCodes();
        $oauthConfig = ConfigModel::getConfigByType('oauth');
        
        $ad = AdTargetModel::getAdInfo('LOGIN_LEFT');

        $view = array(
            'code' => $code,
            'oauth' => $oauthConfig,
            'ad' => $ad
        );

        $this->theme->set('authAction', '欢迎登录');
        $this->theme->setTitle('欢迎登录');
        return $this->theme->scope('user.login', $view)->render();
    }

    public function getRegisteraaa()
    {
        return 345;
    }

    
    public function postLogin(LoginRequest $request)
    {
        $error = array();
        if ($request->get('code') && !\CommonClass::checkCode($request->get('code'))) {
            $error['code'] = '请输入正确的验证码';
        } else {
            if (!UserModel::checkPassword($request->get('username'), $request->get('password'))) {
                $error['password'] = '请输入正确的帐号或密码';
            } else {
                $user = UserModel::where('name', $request->get('username'))->first();
                if (!empty($user) && $user->status == 2){
                    $error['username'] = '该账户已禁用';
                }
            }
        }
        if (!empty($error)) {
            return redirect($this->loginPath())->withInput($request->only('username', 'remember'))->withErrors($error);
        }
        $throttles = $this->isUsingThrottlesLoginsTrait();
        $user = UserModel::where('email', $request->get('username'))
            ->orWhere('name', $request->get('username'))
            ->orWhere('mobile', $request->get('username'))->first();

        if ($user && !$user->status) {
            return redirect('waitActive/' . Crypt::encrypt($user->email))->withInput(array('email' => $request->get('email')));
        }
        Auth::loginUsingId($user->id);
        UserModel::where('email', $request->get('email'))->update(['last_login_time' => date('Y-m-d H:i:s')]);

        
        PromoteModel::settlementByUid($user->id);

        return $this->handleUserWasAuthenticated($request, $throttles);

    }

    
    public function getRegister(Request $request)
    {
        if($request->get('uid')){
            $uid = Crypt::decrypt($request->get('uid'));
        }else{
            $uid = '';
        }

        $code = \CommonClass::getCodes();
        
        $ad = AdTargetModel::getAdInfo('LOGIN_LEFT');
        
        $agree = AgreementModel::where('code_name','register')->first();

        $view = array(
            'code' => $code,
            'ad' => $ad,
            'agree' => $agree,
            'from_uid' => $uid
        );

        $this->initTheme('auth');
        $this->theme->set('authAction', '欢迎注册');
        $this->theme->setTitle('欢迎注册');
        return $this->theme->scope('user.register', $view)->render();
    }

    
    public function postRegister(RegisterRequest $request)
    {

        $user = $this->create($request->except('from_uid'));
        if ($user){
            if(!empty($request->get('from_uid'))){
                
                PromoteModel::createPromote($request->get('from_uid'),$user);
            }
            return redirect('waitActive/' . Crypt::encrypt($request->get('email')));
        }
        return back()->with(['message' => '注册失败']);
    }

    
    public function phoneRegister(RegisterPhoneRequest $request)
    {
        $authMobileInfo = session('auth_mobile_info');
        $data = $request->except('_token');
        if ($data['code'] == $authMobileInfo['code'] && $data['mobile'] == $authMobileInfo['mobile']){
            Session::forget('auth_mobile_info');

            $status = UserModel::mobileInitUser($data);

            if ($status){
                if(!empty($request->get('from_uid'))){
                    
                    PromoteModel::createPromote($request->get('from_uid'),$status);
                }
                $user = UserModel::where('mobile', $data['mobile'])->first();
                Auth::loginUsingId($user->id);
                return $this->theme->scope('user.activesuccess')->render();
            }
        }
        return back()->withErrors(['code' => '请输入正确的验证码']);
    }

    
    public function sendMobileCode(Request $request)
    {
        $arr = $request->except('_token');

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
                
                $code = rand(100000, 999999);

                $templates = [
                    'YunTongXun' => '208989',
                ];

                $tempData = [
                    'code' => $code,
                    'time' => '30分钟',
                ];

                $content = '【客客信息】你注册的验证码为' . $code;

                $status = \SmsClass::sendSms($arr['mobile'], $templates, $tempData, $content);


                if ($status['success'] == true) {  
                    $data = [
                        'code' => $code,
                        'mobile' => $arr['mobile']
                    ];
                    Session::put('auth_mobile_info', $data);
                    return ['code' => 1000, 'msg' => '短信发送成功'];
                } else {
                    return ['code' => 1001, 'msg' => '短信发送失败'];
                }
            } else {
                return ['info' => 0, 'msg' => '请先通过滑块验证'];
            }
        } else {
            
            if ($GtSdk->fail_validate($request->geetest_challenge, $request->geetest_validate, $request->geetest_seccode)) {
                
                $code = rand(100000, 999999);

                $templates = [
                    'YunTongXun' => '208989',
                ];

                $tempData = [
                    'code' => $code,
                    'time' => '30分钟',
                ];

                $content = '【赏金联盟】你注册的验证码为' . $code;

                $status = \SmsClass::sendSms($arr['mobile'], $templates, $tempData, $content);

                if ($status['success'] == true) {
                    $data = [
                        'code' => $code,
                        'mobile' => $data['mobile']
                    ];
                    Session::put('auth_mobile_info', $data);
                    return ['code' => 1000, 'msg' => '短信发送成功'];
                } else {
                    return ['code' => 1001, 'msg' => '短信发送失败'];
                }
            } else {
                return ['info' => 0, 'msg' => '请先通过滑块验证'];
            }
        }




    }

    
    public function activeEmail($validationInfo)
    {
        $info = Crypt::decrypt($validationInfo);
        $user = UserModel::where('email', $info['email'])->where('validation_code', $info['validationCode'])->first();

        $this->initTheme('auth');
        $this->theme->set('authAction', '欢迎注册');
        $this->theme->setTitle('欢迎注册');
        
        if ($user && time() > strtotime($user->overdue_date) || !$user) {
            return $this->theme->scope('user.activefail')->render();
        }
        
        $user->status = 1;
        $user->email_status = 2;
        $status = $user->save();
        if ($status){
            Auth::login($user);
            return $this->theme->scope('user.activesuccess')->render();
        }
    }

    
    public function waitActive($email)
    {
        $email = Crypt::decrypt($email);

        $emailType = substr($email, strpos($email, '@') + 1);
        $view = array(
            'email' => $email,
            'emailType' => $emailType
        );
        $this->initTheme('auth');
        $this->theme->set('authAction', '欢迎注册');
        $this->theme->setTitle('欢迎注册');
        return $this->theme->scope('user.waitactive', $view)->render();
    }


    
    public function flushCode()
    {
        $code = \CommonClass::getCodes();

        return \CommonClass::formatResponse('刷新成功', 200, $code);
    }

    
    public function checkUserName(Request $request)
    {
        $username = $request->get('param');

        $status = UserModel::where('name', $username)->first();
        if (empty($status)){
            $status = 'y';
            $info = '';
        } else {
            $info = '用户名不可用';
            $status = 'n';
        }
        $data = array(
            'info' => $info,
            'status' => $status
        );
        return json_encode($data);
    }

    
    public function checkEmail(Request $request)
    {
        $email = $request->get('param');

        $status = UserModel::where('email', $email)->first();
        if (empty($status)){
            $status = 'y';
            $info = '';
        } else {
            $info = '邮箱已占用';
            $status = 'n';
        }
        $data = array(
            'info' => $info,
            'status' => $status
        );
        return json_encode($data);
    }



    
    public function reSendActiveEmail($email)
    {
        $email = Crypt::decrypt($email);
        $status = UserModel::where('email', $email)->update(array('overdue_date' => date('Y-m-d H:i:s', time() + 60*60*3)));
        if ($status){
            $status = \MessagesClass::sendActiveEmail($email);
            if ($status){
                $msg = 'success';
            } else {
                $msg = 'fail';
            }
            return \CommonClass::formatResponse($msg);
        }
    }

    
    public function oauthLogin($type)
    {
        switch ($type){
            case 'qq':
                $alias = 'qq_api';
                break;
            case 'weibo':
                $alias = 'sina_api';
                break;
            case 'weixinweb':
                $alias = 'wechat_api';
                break;
        }
        $oauthConfig = ConfigModel::getOauthConfig($alias);
        $clientId = $oauthConfig['appId'];
        $clientSecret = $oauthConfig['appSecret'];
        $redirectUrl = url('oauth/' . $type . '/callback');
        $config = new \SocialiteProviders\Manager\Config($clientId, $clientSecret, $redirectUrl);

        return Socialite::with($type)->setConfig($config)->redirect();
    }

    
    public function handleOAuthCallBack($type)
    {
        switch ($type){
            case 'qq':
                $service = 'qq_api';
                break;
            case 'weibo':
                $service = 'sina_api';
                break;
            case 'weixinweb':
                $service = 'wechat_api';
                break;
        }
        $oauthConfig = ConfigModel::getOauthConfig($service);
        Config::set('services.' . $type . '.client_id', $oauthConfig['appId']);
        Config::set('services.' . $type . '.client_secret', $oauthConfig['appSecret']);
        Config::set('services.' . $type . '.redirect', url('oauth/' . $type . '/callback'));

        $user = Socialite::driver($type)->user();

        $userInfo = [];
        switch ($type){
            case 'qq':
                $userInfo['oauth_id'] = $user->id;
                $userInfo['oauth_nickname'] = $user->nickname;
                $userInfo['oauth_type'] = 0;
                break;
            case 'weibo':
                $userInfo['oauth_id'] = $user->id;
                $userInfo['oauth_nickname'] = $user->nickname;
                $userInfo['oauth_type'] = 1;
                break;
            case 'weixinweb':
                $userInfo['oauth_nickname'] = $user->nickname;
                $userInfo['oauth_id'] = $user->user['unionid']; 
                $userInfo['oauth_type'] = 2;
                break;
        }
        
        $oauthStatus = OauthBindModel::where(['oauth_id' => $userInfo['oauth_id'], 'oauth_type' => $userInfo['oauth_type']])
                    ->first();
        if (!empty($oauthStatus)){
            Auth::loginUsingId($oauthStatus->uid);
        } else {
            
            $uid = OauthBindModel::oauthLoginTransaction($userInfo);
            Auth::loginUsingId($uid);
        }
        return redirect()->intended($this->redirectPath());
    }

}
