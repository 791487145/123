<?php

use Illuminate\Support\Facades\Mail;
use App\Modules\User\Model\UserModel;

class MessagesClass
{
    /**
     * 发送邮件
     *
     * @param array $data
     * @param str $view
     * @return bool
     */
    static function sendMsg($data, $view)
    {
        $res = Mail::send(
            $view, ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });

        return $res ? true : false;
    }

    /**
     * 发送注册激活邮件
     *
     * @param str $email
     * @return bool
     */
    static function sendActiveEmail($email)
    {
        $user = UserModel::where('email',$email)->first();
        $siteArr = \App\Modules\Manage\Model\ConfigModel::getConfigByType('site');
        if($siteArr['site_name']){
            $siteName = $siteArr['site_name'];
            $title = $siteName.'注册激活';
        }else{
            $title = '客客威客系统注册激活';
        }

        $validationInfo = Crypt::encrypt([
            'email' => $email,
            'validationCode' => $user->validation_code
        ]);
        $data = array(
            'title' => $title,
            'username' => $user->name,
            'email' => $email,
            'validationInfo' => $validationInfo
        );
        if (self::sendMsg($data, 'email.active')){
            return true;
        }
        return false;
    }

    /**
     * 发送邮箱验证邮件
     *
     * @param $email
     * @return bool
     */
    static function sendEmailAuth($email)
    {
        $user = UserModel::where('email',$email)->first();
        $siteArr = \App\Modules\Manage\Model\ConfigModel::getConfigByType('site');
        if($siteArr['site_name']){
            $siteName = $siteArr['site_name'];
            $title = $siteName.'邮件验证';
        }else{
            $title = '客客威客系统邮件验证';
        }
        $validationInfo = Crypt::encrypt([
            'email' => $email,
            'validationCode' => $user->validation_code
        ]);
        $data = array(
            'title' => $title,
            'username' => $user->name,
            'email' => $email,
            'validationInfo' => $validationInfo
        );
        if (self::sendMsg($data, 'email.emailauth')){
            return true;
        }
        return false;
    }

    /**
     * 发送验证码邮件
     *
     * @param array $user
     * @return bool
     */
    static function sendCodeEmail($user)
    {
        $code = \CommonClass::random(5);
        $domain = \CommonClass::getDomain().'/themes/default/assets/images/mail-bg.jpg';
        $siteArr = \App\Modules\Manage\Model\ConfigModel::getConfigByType('site');
        if($siteArr['site_name']){
            $siteName = $siteArr['site_name'];
            $title = $siteName.'找回密码';
        }else{
            $title = '客客威客系统找回密码';
        }

        $data = array(
            'title' => $title,
            'username' => $user['name'],
            'email' => $user['email'],
            'code' => $code,
            'domain'=>$domain,
        );

        if (self::sendMsg($data, 'email.paypassword')) {
            Session::put('payPasswordCode', $code);
            return true;
        }
        return false;

    }

    /**
     * 发送找回密码验证邮件
     *
     * @param str $email
     * @return bool
     */
    static function sendPasswordEmail($email)
    {
        $data = array(
            'expire_date' => date('Y-m-d H:i:s', time() + 60*10),
            'reset_password_code' => \CommonClass::random(6)
        );
        $user = UserModel::where('email', $email)->first();

        $status = $user->update($data);

        $siteArr = \App\Modules\Manage\Model\ConfigModel::getConfigByType('site');
        if($siteArr['site_name']){
            $siteName = $siteArr['site_name'];
            $title = $siteName.'重置密码验证邮件';
        }else{
            $title = '客客威客系统重置密码验证邮件';
        }

        if ($status){
            $validationInfo = Crypt::encrypt([
                'email' => $email,
                'resetPasswordCode' => $user->reset_password_code
            ]);
            $data = array(
                'title' => $title,
                'username' => $user->name,
                'email' => $email,
                'validationInfo' => $validationInfo
            );
            if (self::sendMsg($data, 'email.password')){
                return true;
            }
            return false;
        }
    }

}