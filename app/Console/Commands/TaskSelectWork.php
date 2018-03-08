<?php

namespace App\Console\Commands;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskTypeModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\CommentModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TaskSelectWork extends Command
{
    
    protected $signature = 'taskSelectWork';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $taskTypeId = TaskTypeModel::getTaskTypeIdByAlias('xuanshang');
        
        $tasks = TaskModel::where('type_id',$taskTypeId)->where('status',5)->get()->toArray();

        
        $expireTasks = self::expireTasks($tasks);

        $task_sys_help_switch = \CommonClass::getConfig('task_sys_help_switch');

        
        if($task_sys_help_switch==1)
        {
            
            $task_sys_help_rule = \CommonClass::getConfig('task_sys_help_rule');
            switch($task_sys_help_rule){
                case 1:
                    Self::workFirst($expireTasks);
                    break;
                case 2:
                    Self::commentFirst($expireTasks);
                    break;
                case 3:
                    Self::taskFirst($expireTasks);
                    break;
            }
        }elseif($task_sys_help_switch==0)
        {
            foreach($expireTasks as $k=>$v)
            {
                $status = DB::transaction(function() use($v)
                {
                    
                    TaskModel::where('id',$v)->update(['status'=>10,'end_at'=>date('Y-m-d H:i:s',time())]);
                    $task = TaskModel::where('id',$v)->first();
                    
                    
                    $task_fail_percentage = $task['task_fail_draw_ratio'];
                    if($task_fail_percentage!=0)
                    {
                        $balance = $task['bounty']*(1-$task_fail_percentage/100);
                    }else{
                        $balance = $task['bounty'];
                    }
                    UserDetailModel::where('uid',$task['uid'])->increment('balance',$balance);
                    
                    $finance_data = [
                        'action'=>7,
                        'pay_type'=>1,
                        'cash'=>$balance,
                        'uid'=>$task['uid'],
                        'created_at'=>date('Y-m-d H:i:s',time()),
                        'updated_at'=>date('Y-m-d H:i:s',time()),
                    ];
                    FinancialModel::create($finance_data);

                });
                if(is_null($status))
                {
                    Self::sendMassage($v);
                }
            }
        }
          
          

    }

    private function expireTasks($data)
    {
        
        $task_select_work = \CommonClass::getConfig('task_select_work');
        $time = time();
        $expireTasks = [];
        foreach($data as $v)
        {
            if((strtotime($v['selected_work_at'])+$task_select_work)<=$time)
            {
                $expireTasks[] = $v['id'];
            }
        }

        return $expireTasks;
    }

    private function workFirst($data)
    {
        
        foreach($data as $v)
        {
            $status = DB::transaction(function() use($v){
                
                $task = TaskModel::where('id',$v)->first()->toArray();
                
                $works = Self::workTime($task);
                
                WorkModel::whereIn('id',$works)->update(['status'=>1,'bid_at'=>date('Y-m-d H:i:s',time()),'bid_by'=>1]);
                
                TaskModel::where('id',$v)->update(['status'=>6,'publicity_at'=>date('Y-m-d H:i:s',time())]);
            });
            if(is_null($status))
            {
                Self::sendMassage($v);
            }
        }
    }
    private function commentFirst($data)
    {
        
        foreach($data as $v)
        {
            $status = DB::transaction(function() use($v){
                
                $task = TaskModel::where('id',$v)->first()->toArray();
                
                $works = Self::applyRate($task);
                
                WorkModel::whereIn('id',$works)->update(['status'=>1,'bid_at'=>date('Y-m-d H:i:s',time()),'bid_by'=>1]);
                
                TaskModel::where('id',$v)->update(['status'=>6,'publicity_at'=>date('Y-m-d H:i:s',time())]);
            });
            if(is_null($status))
            {
                Self::sendMassage($v);
            }
        }
    }
    private function taskFirst($data)
    {
        
        foreach($data as $v)
        {
            $status = DB::transaction(function() use($v)
            {
                
                $task = TaskModel::where('id',$v)->first()->toArray();
                
                $works = Self::taskNum($task);
                
                WorkModel::whereIn('id',$works)->update(['status'=>1,'bid_at'=>date('Y-m-d H:i:s',time()),'bid_by'=>1]);
                
                TaskModel::where('id',$v)->update(['status'=>6,'publicity_at'=>date('Y-m-d H:i:s',time())]);
            });
            if(is_null($status))
            {
                Self::sendMassage($v);
            }
        }
    }
    
    private function applyRate($data)
    {
        
        $works = WorkModel::where('task_id',$data['id'])->where('status',0)->get()->toArray();

        
        if($data['worker_num']<count($works)){
            
            foreach($works as $k=>$v)
            {
                $works[$k]['applause_rate'] = CommentModel::applauseRate($v['uid']);
            }
            
            $works = array_values(array_sort($works,function($value){
                return $value['applause_rate'];
            }));
            $works = array_slice($works,0,$data['worker_num']);
        }
        
        $works_id = [];
        foreach($works as $v){
            $works_id[] = $v['id'];
        }
        return $works_id;
    }
    
    private function workTime($data)
    {
        
        $works = WorkModel::where('task_id',$data['id'])->where('status',0)->orderBy('created_at','asc')->get()->toArray();
        if(count($works)>$data['worker_num'])
        {
            $works = array_slice($works,0,$data['worker_num']);
        }
        $works_id=[];
        foreach($works as $v)
        {
            $works_id[] = $v['id'];
        }
        return $works_id;
    }
    
    private function taskNum($data)
    {
        
        $works = WorkModel::where('task_id',$data['id'])->where('status',0)->get()->toArray();
        if(count($works)>$data['worker_num'])
        {
            foreach($works as $k=>$v)
            {
                $works[$k]['task_num'] = WorkModel::where('uid',$v['uid'])->count();
            }
            
            $works = array_values(array_sort($works,function($value){
                return $value['task_num'];
            }));
            $works = array_slice($works,0,$data['worker_num']);
        }
        $works_id = [];
        foreach($works as $v)
        {
            $works_id[] = $v['id'];
        }

        return $works_id;
    }
    
    private function sendMassage ($task_id)
    {
        $domain = \CommonClass::getDomain();
        
        $ids = WorkModel::where('task_id',$task_id)->where('status',0)->lists('uid');
        $ids = array_flatten($ids);
        foreach($ids as $v)
        {
            $task_publish_success = MessageTemplateModel::where('code_name','Automatic_choose')->where('is_open',1)->where('is_on_site',1)->first();
            if($task_publish_success)
            {
                $task = TaskModel::where('id',$task_id)->first();
                $user = UserModel::where('id',$v)->first();
                $site_name = \CommonClass::getConfig('site_name');
                
                $messageVariableArr = [
                    'username'=>$user['name'],
                    'task_number'=>$task['id'],
                    'href' => $domain.'/task/'.$task_id,
                    'task_titles'=>$task['title'],
                    'website'=>$site_name,
                ];
                $message = MessageTemplateModel::sendMessage('Automatic_choose',$messageVariableArr);
                $data = [
                    'message_title'=>$task_publish_success['name'],
                    'code'=>'Automatic_choose',
                    'message_content'=>$message,
                    'js_id'=>$user['id'],
                    'message_type'=>2,
                    'receive_time'=>date('Y-m-d H:i:s',time()),
                    'status'=>0,
                ];
                MessageReceiveModel::create($data);
            }
        }

    }
}
