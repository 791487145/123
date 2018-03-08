<?php

namespace App\Modules\Install\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Install\Http\Requests\CheckDatabaseRequest;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\ManagerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Theme;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Dotenv;

class IndexController extends Controller
{


    public $theme;

    public $fileLockPath;

    public function __construct()
    {
        error_reporting(0);
        $this->theme = Theme::uses()->layout('install');
        $this->fileLockPath = base_path('kppw.install.lck');
        if (file_exists($this->fileLockPath)){
            dd('你已安装KPPW3.0，请勿重复安装！！！');
        }
    }

    
    public function run(Request $request)
    {
        if ($request->get('step')){
            $step = Crypt::decrypt($request->get('step'));
        } else {
            $step = 1;
        }
        $data = [];
        switch ($step){
            case 1:
                $view = 'install.step1';
                break;
            case 2:
                $error = false;
                $limitEnv = [
                    'min' => [
                        'php_version' => '5.6',
                        'gd' => '2.0',
                        'disk_space' => '500M'
                    ],
                    'perfect' => [
                        'php_version' => '5.6',
                        'gd' => '2.0',
                        'disk_space' => '不限'
                    ]
                ];
                
                $check_gd = function_exists ( 'gd_info' ) ? gd_info () : array (); 
                $check_gd = $check_gd ['GD Version'] ? $check_gd ['GD Version'] : 0;
                $env = [
                    'OS' => PHP_OS,
                    'php_version' => PHP_VERSION,
                    'file_upload' => @ini_get('file_uploads') ? @ini_get('upload_max_filesize') : 'unknow',
                    'disk_space' => floor(disk_free_space(base_path()) / (1024*1024)).'M',
                    'gd' => $check_gd
                ];
                $fileRW = [
                    [
                        'path' => DIRECTORY_SEPARATOR . 'bootstrap',
                        'power' => 'w',
                        'type' => 'dir'
                    ],
                    [
                        'path' => DIRECTORY_SEPARATOR . 'storage',
                        'power' => 'w',
                        'type' => 'dir'
                    ],
                    [
                        'path' => DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR .  'attachment',
                        'power' => 'w',
                        'type' => 'dir'
                    ],
                    [
                        'path' => '.env',
                        'power' => 'w',
                        'type' => 'file'
                    ]
                ];

                foreach ($fileRW as $key => $value){
                    if ($value['type'] == 'dir'){
                        if (is_dir(base_path($value['path']))){
                            if (is_writable(base_path($value['path']))){
                                $fileRW[$key]['result'] = 1;
                            } else {
                                $fileRW[$key]['result'] = 0;
                                $error = true;
                            }
                        } else {
                            $fileRW[$key]['result'] = -1;
                            $error = true;
                        }
                    } else {
                        if (file_exists(base_path($value['path']))){
                            if (is_writable(base_path($value['path']))){
                                $fileRW[$key]['result'] = 1;
                            } else {
                                $fileRW[$key]['result'] = 0;
                                $error = true;
                            }
                        } else {
                            $fileRW[$key]['result'] = -1;
                            $error = true;
                        }
                    }

                }

                $needExtension = [
                    'curl', 'gd', 'iconv', 'mbstring', 'mcrypt', 'mysqli', 'mysqlnd', 'PDO', 'pdo_mysql', 'openssl', 'fileinfo'
                ];
                $functionArr = [];
                
                $localExtension = get_loaded_extensions();
                foreach ($needExtension as $key => $extension){
                    $functionArr[$key]['extension'] = $extension;
                    $functionArr[$key]['need'] = 'y';
                    if (!in_array($extension, $localExtension)){
                        if ($extension == 'mysqli' && in_array('mysqlnd', $localExtension) || $extension == 'mysqlnd' && in_array('mysqli', $localExtension)){
                            $functionArr[$key]['support'] = 'y';
                        } else {
                            $functionArr[$key]['support'] = 'n';
                            $error = true;
                        }
                    } else {
                        $functionArr[$key]['support'] = 'y';
                    }
                }
                if ($env['php_version'] < $limitEnv['min']['php_version']){
                    $error = true;
                }
                if ($env['gd'] < $limitEnv['min']['gd']){
                    $error = true;
                }
                if (intval($env['disk_space']) < intval($limitEnv['min']['disk_space'])){
                    $error = true;
                }
                $data = [
                    'env' => $env,
                    'error' => $error,
                    'fileRW' => $fileRW,
                    'limitEnv' => $limitEnv,
                    'functionArr' => $functionArr
                ];
                $view = 'install.step2';
                break;
            case 3:
                $preData = [
                    'site_url' => 'http://www.kppw.cn',
                    'db_host' => 'localhost',
                    'db_name' => 'kppw30',
                    'db_account' => 'root',
                    'db_password' => 'root',
                    'admin_account' => 'admin'
                ];
                $data = [
                    'preData' => $preData
                ];
                $view = 'install.step3';
                break;
            case 4:
                $lockContent = env('APP_KEY');
                File::put($this->fileLockPath, $lockContent);
                Artisan::call('key:generate');
                $view = 'install.step4';
                break;
        }


        return $this->theme->scope($view, $data)->render();
    }

    
    public function checkDatabase(CheckDatabaseRequest $request)
    {
        set_time_limit(1800);

        $arrRequest = $request->all();
			

        self::setSqlConfig($arrRequest);

        $link = mysqli_connect($arrRequest['db_host'], $arrRequest['db_account'], $arrRequest['db_password']);
        
        if ($link){
            
            if (!mysqli_select_db($arrRequest['db_name'], $link)){
                $sql = "CREATE DATABASE `" . $arrRequest['db_name'] . "`";
                mysqli_query($link, $sql) or mysqli_error($link);
            }

            $configData = [
                'APP_ENV' => 'local',
                'APP_DEBUG' => 'false',
                'APP_KEY' => env('APP_KEY'),
                'DB_HOST' => $arrRequest['db_host'],
                'DB_DATABASE' => $arrRequest['db_name'],
                'DB_USERNAME' => $arrRequest['db_account'],
                'DB_PASSWORD' => $arrRequest['db_password'],
                'CACHE_DRIVER' => 'file',
                'SESSION_DRIVER' => 'file',
                'QUEUE_DRIVER' => 'sync',
                'MAIL_DRIVER' => 'smtp',
                'MAIL_PORT' => 25,
                'MAIL_USERNAME' => 'null',
                'MAIL_PASSWORD' => 'null',
                'MAIL_ENCRYPTION' => 'tls',
                'ALIPAY_RETURN_URL' => $arrRequest['site_url'] . '/order/pay/alipay/return',
                'ALIPAY_NOTIFY_URL' => $arrRequest['site_url'] . '/order/pay/alipay/notify',
                'WECHAT_NOTIFY_URL' => $arrRequest['site_url'] . '/order/pay/wechat/notify'
            ];
            $data = '';
            foreach ($configData as $key => $value){
                if (empty($data)){
                    $data = $key . "=" . $value;
                } else {
                    $data = $data . "\n" . $key . '=' . $value ;
                }
            }
            $status = File::put(base_path('.env'), $data);
            
            if ($status){

                
                Artisan::call('install:kppw', [
                    '--data' => $arrRequest['is_data'] ? true : false
                ]);
                
                $status = DB::transaction(function() use ($arrRequest){
                    ConfigModel::where('alias', 'site_url')->update(['rule' => $arrRequest['site_url']]);
                    $salt = \CommonClass::random(4);
                    ManagerModel::where('id', 1)->update([
                        'username' => $arrRequest['admin_account'],
                        'salt' => $salt,
                        'password' => ManagerModel::encryptPassword($arrRequest['admin_password'], $salt)
                    ]);
                });
                if (!is_null($status)){
                    $error = [
                        'install_fail' => '安装失败'
                    ];
                }
            } else {
                $error = [
                    'install_fail' => '写入配置文件失败'
                ];
            }
        } else {
            $error = [
                'db_host' => '数据库配置信息不正确',
                'db_account' => '数据库配置信息不正确',
                'db_password' => '数据库配置信息不正确',
            ];
        }

        if (!empty($error)){
            return back()->withErrors($error);
        }
        return redirect('install?step=' . Crypt::encrypt(4));
    }


    static function setSqlConfig(array $config)
    {
        Config::set('database.connections.mysql.host', $config['db_host']);
        Config::set('database.connections.mysql.database', $config['db_name']);
        Config::set('database.connections.mysql.username', $config['db_account']);
        Config::set('database.connections.mysql.password', $config['db_password']);
    }

}
