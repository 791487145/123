<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Demand\Model\DemandCateModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\NavigationModel;
use App\Modules\Manage\Model\IndustryModel;
use App\Modules\Manage\Model\ServiceObjectModel;
use App\Modules\Manage\Model\StyleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use Cache;
use Theme;


class ConfigController extends ManageController
{

    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');
    }


    
    public function getConfigSite()
    {
        $this->theme->setTitle('站点配置');
        $config = ConfigModel::getConfigByType('site');
        $basisConfig = ConfigModel::getConfigByType('basis');
        $data = array(
            'site' => $config,
            'basic' => $basisConfig
        );
        return $this->theme->scope('manage.config.site', $data)->render();
    }

    
    public function saveConfigSite(Request $request)
    {
        $data = $request->except('_token', 'web_logo_1','web_logo_2');
        $config = ConfigModel::getConfigByType('site');

        $file1 = $request->file('web_logo_1');
        if ($file1) {
            
            $result1 = \FileClass::uploadFile($file1, 'sys');
            $result1 = json_decode($result1, true);
            $data['web_logo_1'] = $result1['data']['url'];
        }else{
            $data['web_logo_1'] = $config['site_logo_1'];
        }
        $file2 = $request->file('web_logo_2');
        if ($file2) {
            
            $result2 = \FileClass::uploadFile($file2, 'sys');
            $result2 = json_decode($result2, true);
            $data['web_logo_2'] = $result2['data']['url'];
        }else{
            $data['web_logo_2'] = $config['site_logo_2'];
        }
        $file3 = $request->file('wechat_pic');
        if ($file3) {
            
            $result3 = \FileClass::uploadFile($file3, 'sys');
            $result3 = json_decode($result3, true);
            $data['wechat_pic'] = $result3['data']['url'];
        }else{
            $data['wechat_pic'] = $config['wechat']['wechat_pic'];
        }
        $siteRule = array(
            'site_name' => $data['web_site'],
            'site_url' => $data['web_url'],
            'site_logo_1' => $data['web_logo_1'],
            'site_logo_2' => $data['web_logo_2'],
            'company_name' => $data['company_name'],
            'company_address' => $data['company_address'],
            'record_number' => $data['site_record_code'],
            'copyright' => $data['footer_copyright'],
            'site_close' => $data['site_switch'],
            'phone' => $data['phone'],
            'Email' => $data['Email']
        );
        ConfigModel::updateConfig($siteRule);
        Cache::forget('site');
        $basicRule = array(

           'css_adaptive' => $data['css_adaptive'],
            'open_IM' => $data['open_IM'],
            'qq' => $data['customer_service_qq'],
            'IM_config' => json_encode(array(
                    'IM_ip' => $data['IM_ip'],
                    'IM_port' => $data['IM_port']
                )
            ),

       
        );
        ConfigModel::updateConfig($basicRule);
        Cache::forget('basis');
        return redirect('/manage/config/site')->with(array('message' => '保存成功'));
    }

    
    public function getConfigEmail()
    {
        $this->theme->setTitle('邮箱配置');
        
        $mailHost = \CommonClass::findEnvInfo('MAIL_HOST');
        
        $mailPort = \CommonClass::findEnvInfo('MAIL_PORT');
        
        $mailUsername = \CommonClass::findEnvInfo('MAIL_USERNAME');
        
        $mailPassword = \CommonClass::findEnvInfo('MAIL_PASSWORD');
        
        $mailFromAddress = \CommonClass::findEnvInfo('MAIL_FROM_ADDRESS');
        $mailFromName = \CommonClass::findEnvInfo('MAIL_FROM_NAME');
        $testEmail = \CommonClass::findEnvInfo('MAIL_TEST');
        $email = array(
            'send_mail_server' => $mailHost,
            'server_port' => $mailPort,
            'email_account' => $mailUsername,
            'account_password' => $mailPassword,
            'reply_email_address' => $mailFromAddress,
            'reply_email_name' => $mailFromName,
            'test_email_address' => $testEmail
        );
        $data = array(
            'email' => $email
        );
        return $this->theme->scope('manage.config.email', $data)->render();
    }

    //后台邮箱配置
    public function saveConfigEmail(Request $request)
    {
        $data = $request->except('_token');

        $validator = Validator::make($request->all(), [
            'send_mail_server' => 'required',
            'server_port' => 'required',
            'email_account' => 'required',
            'account_password' => 'required',
            'reply_email_name' => 'required',
        ],[
            'send_mail_server.required' => '请输入邮件发送服务器',
            'server_port.required' => '请输入服务器端口',
            'email_account.required' => '请输入发送邮件账号',
            'account_password.required' => '请输入账号密码',
            'reply_email_name.required' => '请输入邮件回复名称',
        ]);
        $error = $validator->errors()->all();
        if(count($error)){
            return  redirect('/manage/config/email')->with(array('message' => $error[0]));
        }

        $configData = [
            'MAIL_HOST' => $data['send_mail_server'] ? trim($data['send_mail_server']) : '',
            'MAIL_PORT' => $data['server_port'] ? trim($data['server_port']) : 25,
            'MAIL_USERNAME' => $data['email_account'] ? trim($data['email_account']) : '',
            'MAIL_PASSWORD' => $data['account_password'] ? trim($data['account_password']) : '',
            'MAIL_FROM_ADDRESS' => $data['reply_email_address'] ? trim($data['reply_email_address']) : '',
            'MAIL_FROM_NAME' => $data['reply_email_name'] ?  trim($data['reply_email_name']) : '',
            'MAIL_TEST' => $data['test_email_address'] ? trim($data['test_email_address']) : ''
        ];
        foreach ($configData as $key => $value){
            $path = base_path('.env');//获取网站根目录
            $originStr = file_get_contents($path);
            if(strstr($originStr,$key)){
                $str = $key . "=" . $value;
                $res = \CommonClass::checkEnvIsNull($key);
                if($res){
                    $newStr = $key."=".env($key);
                }else{
                    if(\CommonClass::findEnvInfo($key)){
                        $newStr = $key.'='.\CommonClass::findEnvInfo($key);
                    }else{
                        $newStr = $key.'=';
                    }
                }
                $updateStr = str_replace($newStr,$str,$originStr);
                file_put_contents($path,$updateStr);
            }else{
                $str = "\n" .$key . "=" . $value;
                file_put_contents($path,$str,FILE_APPEND);
            }
        }
        return redirect('/manage/config/email')->with(array('message' => '保存成功'));


    }

    
    public function getConfigBasic()
    {
        $this->theme->setTitle('基本配置');
        $config = ConfigModel::getConfigByType('basis');
        $data = array(
            'basic' => $config
        );
        return $this->theme->scope('manage.config.basic', $data)->render();
    }

    
    public function saveConfigBasic(Request $request)
    {
        $data = $request->except('_token');
        $basicRule = array(
          

            'css_adaptive' => $data['css_adaptive'],
            'open_IM' => $data['open_IM'],
            'qq' => $data['customer_service_qq'],
           

        );
        ConfigModel::updateConfig($basicRule);
        return redirect('/manage/config/basic')->with(array('message' => '保存成功'));
    }

    
    public function getConfigSEO()
    {
        $this->theme->setTitle('seo配置');
        $seoConfig = ConfigModel::getConfigByType('seo');
        $data = array(
            'seo' => $seoConfig
        );
        return $this->theme->scope('manage.config.seo', $data)->render();
    }

    
    public function saveConfigSEO(Request $request)
    {
        $data = $request->except('taken');
        $seoRule = array(
          

            'seo_index' => json_encode(array(
                'title' => $data['homepage_seo_title'],
                'keywords' => $data['homepage_seo_keywords'],
                'description' => $data['homepage_seo_desc']
            )),
            'seo_task' => json_encode(array(
                'title' => $data['task_seo_title'],
                'keywords' => $data['task_seo_keywords'],
                'description' => $data['task_seo_desc']
            )),
            'seo_service' => json_encode(array(
                'title' => $data['service_seo_title'],
                'keywords' => $data['service_seo_keywords'],
                'description' => $data['service_seo_desc']
            )),
            'seo_article' => json_encode(array(
                'title' => $data['article_seo_title'],
                'keywords' => $data['article_seo_keywords'],
                'description' => $data['article_seo_desc']
            )),
        );
        ConfigModel::updateConfig($seoRule);
        Cache::forget('seo');
        return redirect('/manage/config/seo')->with(array('message' => '保存成功'));
    }


    
    public function getConfigNav()
    {
        
        $navigation = NavigationModel::getAll();
        $data = array(
            'data' => $navigation
        );
        return $this->theme->scope('manage.config.nav', $data)->render();
    }

    public function deleteConfigNav($id)
    {
        
        NavigationModel::deleteNavigation($id);
        return redirect()->to('/manage/config/nav')->with(['massage'=>'删除成功！']);
    }

    public function postConfigNav(Request $request)
    {
        
        NavigationModel::updateConfigNav($request->all());
        return redirect('/manage/config/nav');
    }

    
    public function getAttachmentConfig()
    {
        $this->theme->setTitle('附件配置');
        $config = ConfigModel::getConfigByType('attachment');

        $data = [
            'config' => $config
        ];
        return $this->theme->scope('manage.config.attachment', $data)->render();
    }

    
    public function postAttachmentConfig(Request $request)
    {
        $data = $request->except('_token');
        ConfigModel::updateConfig($data);
        Cache::forget('attachment');
        return redirect('manage/config/attachment')->with(['message' => '操作成功']);
    }

    
    public function sendEmail(Request $request)
    {
        $email = $request->get('email');
        if(empty($email)){
            $data = array(
                'code' => 0,
                'msg' => '缺少测试邮箱地址'
            );
        }else{
            $flag = Mail::raw('这是一封测试邮件', function ($message) use ($email) {
                $to = $email;
                $message ->to($to)->subject('测试邮件');
            });
            if($flag == 1){
                $data = array(
                    'code' => 1,
                    'msg' => '发送邮件成功，请查收！'
                );
            }else{
                $data = array(
                    'code' => 0,
                    'msg' => '发送邮件失败，请重试！'
                );
            }
        }
        return response()->json($data);

    }
    public function aboutUs()
    {
        $this->theme->setTitle('关于我们');

        return $this->theme->scope('manage.config.aboutus')->render();
    }

    
    public function configLink()
    {
        $this->theme->setTitle('关注链接');
        $config = ConfigModel::getConfigByType('site');
        $data = array(
            'site' => $config,
        );
        return $this->theme->scope('manage.config.link',$data)->render();
    }

    public function link(Request $request)
    {
        $data = $request->except('_token');
        $config = ConfigModel::getConfigByType('site');
        $file3 = $request->file('wechat_pic');
        if ($file3) {
            
            $result3 = \FileClass::uploadFile($file3, 'sys');
            $result3 = json_decode($result3, true);
            $data['wechat_pic'] = $result3['data']['url'];
        }else{
            $data['wechat_pic'] = $config['wechat']['wechat_pic'];
        }
        $siteRule = array(
            'statistic_code' => $data['third_party_code'],
            'sina' =>  json_encode(array(
                    'sina_url' => $data['sina_url'],
                    'sina_switch' => $data['sina_switch']
                )
            ),
            'tencent' => json_encode(array(
                    'tencent_url' => $data['tencent_url'],
                    'tencent_switch' => $data['tencent_switch']
                )
            ),
            'wechat' => json_encode(array(
                    'wechat_pic' => $data['wechat_pic'],
                    'wechat_switch' => $data['wechat_switch']
                )
            ),
        );
        ConfigModel::updateConfig($siteRule);
        Cache::forget('site');
        return redirect('/manage/config/link')->with(array('message' => '保存成功'));
    }
}
