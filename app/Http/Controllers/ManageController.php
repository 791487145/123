<?php

namespace App\Http\Controllers;

use App\Modules\Manage\Model\MenuModel;
use App\Modules\Manage\Model\MenuPermissionModel;
use App\Modules\Manage\Model\Permission;
use App\Modules\Manage\Model\ManagerModel;
use App\Modules\Manage\Model\ConfigModel;
use Illuminate\Support\Facades\Route;
use Cache;
use Image;

class ManageController extends BasicController
{
    public $manager;
    public function __construct()
    {
        if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'){
            parent::__construct();
            $this->themeName = 'admin';
            if (ManagerModel::getManager())
            {
                //dd(1);
                $this->manageBreadcrumb();
                $this->breadcrumb = $this->theme->breadcrumb();
                $this->manager = ManagerModel::getManager();//登录用户信息
                $this->theme->setManager($this->manager->username);

                $manageMenu = MenuModel::getMenuPermission();

                $this->theme->set('manageMenu', $manageMenu);
            }

            $route = Route::currentRouteName();
            if($route!='loginCreatePage')
            {
                $permission = Permission::where('name',$route)->first();
                if(!is_null($permission))
                {
                    $permission = MenuPermissionModel::where('permission_id',$permission['id'])->first();
                    $menu_data = MenuModel::getMenu($permission['menu_id']);
                    $this->theme->set('menu_data', $menu_data['menu_data']);
                    $this->theme->set('menu_ids',$menu_data['menu_ids']);
                }
            }

            $basisConfig = ConfigModel::getConfigByType('basis');
            if(!empty($basisConfig)){
                $this->theme->set('basis_config',$basisConfig);
            }
            if (isset($_SERVER['Authentication']) && 172 == strlen($_SERVER['Authentication'])){
                $isCertificate = 1;
            }else{
                $isCertificate = 0;
            }
            $this->theme->set('is_certificate',$isCertificate);
            $menuIcon = [
                '首页'=>'fa-home',
                '全局'=>'fa-cog',
                '用户'=>'fa-users',
                '店铺'=>'fa-home',
                '任务'=>'fa-tasks',
                '工具'=>'fa-user',
                '资讯'=>'fa-file-text',
                '财务'=>'fa-bar-chart-o',
                '消息'=>'fa-envelope',
                '应用'=>'fa fa-pencil-square-o',
            ];
            $this->theme->set('menuIcon',$menuIcon);
            $kppwAuthCode = config('kppw.kppw_auth_code');
            if(!empty($kppwAuthCode)){
                $kppwAuthCode = \CommonClass::starReplace($kppwAuthCode, 5, 4);
                $this->theme->set('kppw_auth_code',$kppwAuthCode);
            }
        }else{
            echo "<script>window.location.href='https://www.baidu.com'</script>";
        }


    }

    /**
     * 上传图片公共方法
     * @since 2016/11/22
     * @param  $file 文件
     * @param  $path 保存路径
     * @return $filename 文件名称
     */

    static function upload_img($file,$url_path,$rule)
    {
        if($file->isValid()){
            $ent = $file -> getClientOriginalExtension();

            if(!in_array($ent,$rule)){
                return '图片格式为jpg,png,gif';
            }
            $newName = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ent;

            $dir = iconv("UTF-8", "GBK", $url_path);

            if (!file_exists($dir)){
                mkdir ($dir,0777,true);
            }

            $file -> move($url_path,$newName);

            $namePath = $url_path.$newName;
            return ['name' => $namePath];
        }
    }
    
    //多图上传
    static function uploads_img($file,$url_path,$rule)
    {
        $name = array();
        foreach($file as $k=>$v){
            $ent = $v -> getClientOriginalExtension();

            if(!in_array($ent,$rule)){
                return '图片格式为jpg,png,gif';
            }
            $newName = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ent;

            $dir = iconv("UTF-8", "GBK", $url_path);

            if (!file_exists($dir)){
                mkdir ($dir,0777,true);
            }

            $v -> move($url_path,$newName);

            $namePath = $url_path.$newName;
            $name[$k] = $namePath;
        }
        return $name;
    }


    //图片加水印
    static function watermark($file)
    {
        $watermark = './logo.png';
        if(is_array($file)){
            foreach($file as $v){
                $img = Image::make('./'.$v);
                $img->insert($watermark, 'bottom-right',0, 0);
                $img->save();
            }
        }
    }

}
