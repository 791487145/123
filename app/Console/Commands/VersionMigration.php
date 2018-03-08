<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class VersionMigration extends Command
{
    
    protected $signature = 'update:kppw27';

    
    protected $description = 'update KPPW2.7 database to KPPW3.0';

    
    protected $kppw27;
    
    protected $kppw30;


    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        $this->warn('转移数据前请先做好备份！并移动KPPW2.7 data目录及upload子目录移动到KPPW3.0 public目录下');

        
        $v27database = [];
        $v27database['host'] = $this->ask('请输入KPPW2.7数据库主机地址');
        $v27database['database'] = $this->ask('请输入KPPW2.7数据库名称');
        $v27database['username'] = $this->ask('请输入KPPW2.7数据库用户名');
        $v27database['password'] = $this->ask('请输入KPPW2.7数据库密码');
        $v27database['prefix'] = $this->ask('请输入KPPW2.7数据库表前缀');

        
        $v30database = [];
        $v30database['host'] = $this->ask('请输入KPPW3.0数据库主机地址');
        $v30database['database'] = $this->ask('请输入KPPW3.0数据库名称');
        $v30database['username'] = $this->ask('请输入KPPW3.0数据库用户名');
        $v30database['password'] = $this->ask('请输入KPPW3.0数据库密码');
        $v30database['prefix'] = $this->ask('请输入KPPW3.0数据库表前缀');

        $this->setDatabase('kppw27', $v27database);
        $this->setDatabase('kppw30', $v30database);

        $data = [
            'host' => [$v27database['host'], $v30database['host']],
            'database' => [$v27database['database'], $v30database['database']],
            'username' => [$v27database['username'], $v30database['username']],
            'password' => [$v27database['password'], $v30database['password']],
            'prefix' => [$v27database['prefix'], $v30database['prefix']]
        ];

        $this->table(['KPPW2.7', 'KPPW3.0'], $data);

        if ($this->confirm('确定开始迁移数据么?', true)){

            $this->kppw27 = DB::connection('kppw27'); 
            $this->kppw30 = DB::connection('kppw30'); 


            $this->info('正在执行迁移...');

            $this->kppw30->table('users')->truncate();
            $this->kppw30->table('user_detail')->truncate();

            
            $arrSpace = $this->kppw27->table('space')->leftJoin('auth_email','auth_email.uid','=','space.uid')->where('auth_email.auth_status',1)->get();
            $new_arr = array();
            $info_arr = array();
            if (!empty($arrSpace)){
                foreach ($arrSpace as $k => $v) {
                    $salt = \CommonClass::random(4);
                    $password = md5(md5('123456' . $salt));
                    $dateTime = date('Y-m-d H:i:s', time());
                    $new_arr[] = array(
                        'id' => $v->uid,
                        'name' => $v->username,
                        'email' => !empty($v->email)?$v->email:Null,
                        'password' => $password,
                        'alternate_password' => $password,
                        'salt' => $salt,
                        'status' => 1,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    );
                    $info_arr[] = array(
                        'uid' => $v->uid,
                        'realname' => $v->truename,
                        'mobile' => $v->mobile,
                        'qq' => $v->qq,
                        'balance' => $v->balance,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                        'introduce' => $v->summary,
                        'employee_praise_rate' => $v->seller_good_num,
                        'employer_praise_rate' => $v->buyer_good_num,
                        'receive_task_num' => $v->take_num,
                        'publish_task_num' => $v->pub_num,
                    );
                }
                
                $this->kppw30->table('users')->insert($new_arr);
                $this->kppw30->table('user_detail')->insert($info_arr);
            }

            $this->kppw30->table('article')->truncate();
            $this->kppw30->table('article_category')->truncate();

            
            $arrArticle = $this->kppw27->table('article')->get();
            $new_article_arr = array();
            if(!empty($arrArticle)){
                foreach($arrArticle as $k => $v){
                    $new_article_arr[] = array(
                        'id' => $v->art_id,
                        'cat_id' => $v->art_cat_id,
                        'user_id' => $v->uid,
                        'title' => $v->art_title,
                        'author' => $v->username,
                        'from' => $v->art_source,
                        'pic' => $v->art_pic,
                        'created_at' => date('Y-m-d H:i:s',$v->pub_time),
                        'content' => $v->content,
                        'view_times' => $v->views,
                        'seotitle' => $v->seo_title,
                        'keywords' => $v->seo_keyword,
                        'description' => $v->seo_desc,
                        'updated_at' => date('Y-m-d H:i:s', time()),
                        'display_order' => $v->listorder
                    );
                }
                
                $this->kppw30->table('article')->insert($new_article_arr);
            }

            
            $arrArticleCategory = $this->kppw27->table('article_category')->get();
            $new_article_category_arr = array();
            if(!empty($arrArticleCategory)){
                foreach($arrArticleCategory as $key => $value){
                    $new_article_category_arr[] = array(
                        'id' => $value->art_cat_id,
                        'pid' => $value->art_cat_pid,
                        'cate_name' => $value->cat_name,
                        'display_order' => $value->listorder,
                        'created_at' => date('Y-m-d H:i:s',$value->on_time),
                        'updated_at' => date('Y-m-d H:i:s', time()),
                        'seotitle' => $value->seo_title,
                        'keyword' => $value->seo_keyword,
                        'description' => $value->seo_desc
                    );
                }
                
                $this->kppw30->table('article_category')->insert($new_article_category_arr);
            }

            
            $this->kppw30->table('cate')->truncate();
            $arrIndustry = $this->kppw27->table('industry')->get();
            $new_cate_arr = [];
            if (!empty($arrIndustry)){
                foreach ($arrIndustry as $k => $v){
                    $new_cate_arr[] = [
                        'id' => $v->indus_id,
                        'name' => $v->indus_name, 
                        'pid' => $v->indus_pid,  
                        'sort' => $v->listorder,  
                        'choose_num' => 0,
                        'created_at' => date('Y-m-d H:i:s', time()),
                        'updated_at' => date('Y-m-d H:i:s', time())
                    ];
                }
                $this->kppw30->table('cate')->insert($new_cate_arr);
            }


            
            $this->kppw30->table('task')->truncate();

            $arrTask = $this->kppw27->table('task')->where('model_id', 1)->get();
            $new_task_arr = [];
            if (!empty($arrTask)){
                foreach ($arrTask as $k => $v){
                    if (!in_array($v->task_status, array(7, 11, 13))){
                        $task_id_arr[] = $v->task_id;

                        switch ($v->task_status){
                            case 0:
                                $status = 1;
                                break;
                            case 1:
                                $status = $v->is_trust == 1 ? 2 : 1;
                                break;
                            case 2:
                                $status = 4;
                                break;
                            case 3:
                                $status = 5;
                                break;
                            case 4:
                                $status = 5;
                                break;
                            case 5:
                                $status = 7;
                                break;
                            case 6:
                                $status = 7;
                                break;
                            case 8:
                                $status = 9;
                                break;
                            case 9:
                                $status = 10;
                                break;
                            case 10:
                                $status = 10;
                                break;
                        }
                        $new_task_arr[] = [
                            'id' => $v->task_id,
                            'title' => $v->task_title,
                            'desc' => $v->task_desc,
                            'type_id' => 1,  
                            'cate_id' => $v->indus_id,  
                            'phone' => '',
                            'region_limit' => 0,  
                            'status' => $status,
                            
                            'bounty' => $v->task_cash,
                            'bounty_status' => $v->is_trust, 
                            'created_at' => $v->start_time,
                            'updated_at' => $v->start_time,
                            'verified_at' => $v->start_time,  
                            'begin_at' => $v->start_time,  
                            'end_at' => '',  
                            'delivery_deadline' => $v->sub_time,  
                            'selected_work_at' => $v->sub_time,  
                            'publicity_at' => '',  
                            'checked_at' => date('Y-m-d H:i:s',time()),  
                            'comment_at' => '',  
                            'show_cash' =>  $v->task_cash,  
                            'real_cash' =>  $v->task_cash,  
                            'deposit_cash' =>  $v->task_cash,  
                            'province' => '',
                            'city' => '',
                            'area' => '',
                            'view_count' => $v->view_num,  
                            'delivery_count' => $v->work_num,  
                            'username' => '', 
                            'uid' => $v->uid,  
                            'worker_num' => 1,  
                            'top_status' => $v->is_top,  
                            'service' =>  ''
                        ];
                    }
                }
                $this->kppw30->table('task')->insert($new_task_arr);
            }

            
            $this->kppw30->table('work')->truncate();
            $new_work_arr = [];
            $arrWork = $this->kppw27->table('task_work')->whereIn('task_id', $task_id_arr)->get();
            if (!empty($arrWork)){
                foreach ($arrWork as $k => $v){
                    switch ($v->work_status){
                        case 0:
                        case 5:
                        case 7:
                            $status = 0;
                            break;
                        case 4:
                            $status = 1;
                            break;
                        case 8:
                            $status = 0;
                            $forbidden = 1;
                            break;
                    }

                    $new_work_arr[] = [
                        'id' => $v->work_id,
                        'desc' => $v->work_desc,
                        'task_id' => $v->task_id,
                        'status' => $status, 
                        'forbidden' => 0,  
                        'uid' => $v->uid, 
                        'bid_by' => 0,  
                        'bid_at' => $v->work_time,  
                        'created_at' => $v->work_time
                    ];
                }

                $this->kppw30->table('work')->insert($new_work_arr);
            }

            
            $this->kppw30->table('attachment')->truncate();
            $this->kppw30->table('task_attachment')->truncate();
            $this->kppw30->table('work_attachment')->truncate();

            $arr_file = $this->kppw27->table('file')->get();

            if (!empty($arr_file)){
                $new_attachment_arr = [];
                $new_task_attachment_arr = [];
                $new_work_attachment_arr = [];

                foreach ($arr_file as $k => $v){
                    $new_attachment_arr[] = [
                        'id' => $v->file_id,
                        'name' => $v->file_name,
                        'url' => $v->save_name,
                        'status' => 1,
                        'user_id' => $v->uid,
                        'disk' => 'public',
                        'created_at' => $v->on_time
                    ];

                    $new_task_attachment_arr[] = [
                        'task_id' => $v->task_id,
                        'attachment_id' => $v->file_id,
                        'created_at' => $v->on_time
                    ];

                    $new_work_attachment_arr[] = [
                        'task_id' => $v->task_id,
                        'work_id' => $v->work_id,
                        'attachment_id' => $v->file_id,
                        'created_at' => $v->on_time
                    ];

                }

                $this->kppw30->table('attachment')->insert($new_attachment_arr);
                $this->kppw30->table('task_attachment')->insert($new_task_attachment_arr);
                $this->kppw30->table('work_attachment')->insert($new_work_attachment_arr);

            }

            $this->info('转移完成');
        }
    }

    
    public function setDatabase($connectionParam, $databaseInfo)
    {
        Config::set('database.connections.' . $connectionParam . '.host', $databaseInfo['host']);
        Config::set('database.connections.' . $connectionParam . '.database', $databaseInfo['database']);
        Config::set('database.connections.' . $connectionParam . '.username', $databaseInfo['username']);
        Config::set('database.connections.' . $connectionParam . '.password', $databaseInfo['password']);
        Config::set('database.connections.' . $connectionParam . '.prefix', $databaseInfo['prefix']);
    }
}
