<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;

use Illuminate\Http\Request;


class ApkDowloadController extends ManageController{

    public function __construct()
    {
        parent::__construct();
        $this->theme->setTitle('Apk下载');
        $this->initTheme('manage');
    }

    public function apkDowload()
    {
        $filename = 'C:\qampp\htdocs\vuehtml\sjlm.apk';
        $fileinfo = pathinfo($filename);
        header('Content-type: application/x-'.$fileinfo['extension']);
        header('Content-Disposition: attachment; filename='.$fileinfo['basename']);
        header('Content-Length: '.filesize($filename));
        readfile($filename);
        exit();
    }


}