<?php

namespace App\Http\Controllers;

use App\Modules\Manage\Model\ConfigModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Route;
use Theme;
use App\Modules\Task\Model\TaskCateModel;
use Cache;

class BasicController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public $theme;
    public $themeName;
    
    public $breadcrumb;


    public function __construct()
    {
        $this->checkInstall();
        
        $this->themeName = \CommonClass::getConfig('theme');


        $this->theme = $this->initTheme();
        
        $skin_color_config = \CommonClass::getConfig('skin_color_config');

        if($skin_color_config)
        {
            $this->theme->set('color', $skin_color_config);
        }
        
        $siteConfig = ConfigModel::getConfigByType('site');

        $this->theme->set('site_config',$siteConfig);

    }

    
    public function initTheme($layout = 'default')
    {
        return Theme::uses($this->themeName)->layout($layout);
    }

    
    public function manageBreadcrumb()
    {
        return $this->theme->breadcrumb()->setTemplate('
            <ul class="breadcrumb">
            @foreach ($crumbs as $i => $crumb)
                @if ($i != (count($crumbs) - 1))
                <li>
                <i class="ace-icon fa fa-tasks home-icon"></i>
                <a href="{{ $crumb["url"] }}">{{ $crumb["label"] }}</a>
                </li>
                @else
                <li class="active">{{ $crumb["label"] }}</li>
                @endif
            @endforeach
            </ul>
        ');
    }

    public function checkInstall()
    {
        if (!file_exists(base_path('kppw.install.lck'))){
            header('Location:' . \CommonClass::getDomain() . '/install');
            die('未检测到安装文件');
        }
    }

    /**
     * @param $url
     * @param $data
     * @return mixed|string
     */
    static function simple_post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla / 5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }

        curl_close($ch);
        return $tmpInfo;
    }

    /**
     **  发送消息提醒
     **  @param content【发送的内容】
     **　@param channel【频道】
     **/
    static function appointment_tips($content = '活动提示', $channel = '')
    {
        $Restful_api = 'https://goeasy.io/goeasy/publish';
        $appkey = 'BC-edfd6318266b4c208e160efe3c9baa23';

        $post_data = array(
            'appkey' => $appkey,
            'channel' => $channel,
            'content' => $content
        );
        $result = self::simple_post($Restful_api, $post_data);
    }
}
