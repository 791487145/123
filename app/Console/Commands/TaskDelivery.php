<?php

namespace App\Console\Commands;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Task\Model\TaskTypeModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\TaskModel;
use App\Modules\User\Model\UserDetailModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TaskDelivery extends Command
{
    
    protected $signature = 'taskDelivery';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $taskTypeId = TaskTypeModel::getTaskTypeIdByAlias('xuanshang');
        
        $task = TaskModel::where('type_id',$taskTypeId)->where('status',7)->get()->toArray();
        
        $filled_tasks = Self::filledTasks($task);
        
        if(count($filled_tasks)!=0)
        {
            foreach($filled_tasks as $v)
            {
                DB::transaction(function() use($v){
                    
                    TaskModel::where('id',$v['id'])->update(['status'=>10,'end_at'=>date('Y-m-d H:i:s',time())]);
                    
                    
                    $task_fail_percentage = TaskModel::where('id',$v['id'])->first();
                    $task_fail_percentage = $task_fail_percentage['task_fail_draw_ratio'];
                    if($task_fail_percentage!=0)
                    {
                        $balance = $v['bounty']*(1-$task_fail_percentage/100);
                    }else{
                        $balance = $v['bounty'];
                    }
                    UserDetailModel::where('uid',$v['uid'])->increment('balance',$balance);
                    
                    $finance_data = [
                        'action'=>7,
                        'pay_type'=>1,
                        'cash'=>$balance,
                        'uid'=>$v['uid'],
                        'created_at'=>date('Y-m-d H:i:s',time()),
                        'updated_at'=>date('Y-m-d H:i:s',time()),
                    ];
                    FinancialModel::create($finance_data);
                });
            }
        }
        $successed_tasks = Self::filledTasks($task,2);
        
            
        $woker_expired = Self::expireTaskWorker($successed_tasks);

        foreach($woker_expired as $k=>$v)
        {
            WorkModel::where('task_id',$k)->whereIn('uid',$v)->update(['status'=>5]);
        }
        
            
        $onwer_expired = Self::expireTaskOwner($successed_tasks);
        $onwer_expired = array_flatten($onwer_expired);
        foreach($onwer_expired as $v)
        {
            $work_data = WorkModel::where('id',$v)->first();
            
            $worker_num = TaskModel::where('id',$work_data['task_id'])->first();
            $worker_num = $worker_num['worker_num'];
            
            $win_check = WorkModel::where('work.task_id',$work_data['task_id'])->where('status','>',3)->count();

            $data['worker_num'] = $worker_num;
            $data['win_check'] = $win_check;
            $data['task_id'] = $work_data['task_id'];
            $data['uid'] = $work_data['uid'];
            $data['work_id'] = $v;

            $workModel = new WorkModel();
            $result = $workModel->workCheck($data);
        }
    }
    
    private function expireTaskWorker($data)
    {
        $task_delivery_max_time = \CommonClass::getConfig('task_delivery_max_time');
        $task_delivery_max_time = $task_delivery_max_time*24*3600;
        $expired_works = [];
        foreach($data as $v)
        {
            if((strtotime($v['checked_at'])+$task_delivery_max_time)>=time())
            {
                
                $works = WorkModel::where('task_id',$v['id'])
                    ->where('status',1)
                    ->orWhere('status',0)
                    ->lists('uid')
                    ->toArray();
                
                $works_delivery = WorkModel::where('task_id',$v['id'])
                    ->where('status','>',1)
                    ->where('forbidden',0)->lists('uid')->toArray();
                $works_diff = array_diff($works,$works_delivery);
                $expired_works[$v['id']][] = $works_diff;
            };
        }
        return $expired_works;
    }

    private function expireTaskOwner($data)
    {
        $task_check_time_limit = \CommonClass::getConfig('task_check_time_limit');
        $task_check_time_limit = $task_check_time_limit*24*3600;
        $expired_works = [];
        foreach($data as $v)
        {
            
            $works = WorkModel::where('task_id',$v['id'])->where('status',2)->get()->toArray();
            $works_expired = [];
            foreach($works as $v)
            {
                if((strtotime($v['created_at'])+$task_check_time_limit)<=time())
                {
                    $works_expired[] = $v['id'];
                }
            }
            
            $works_delivery = WorkModel::where('task_id',$v['id'])->where('status','>',2)->lists('id')->toArray();
            $works_diff = array_diff($works_expired,$works_delivery);
            if(count($works_diff)>0)
            {
                $expired_works[] = $works_diff;
            }
        }
        return $expired_works;
    }

    
    private function filledTasks($data,$type=1)
    {
        $task_delivery_max_time = \CommonClass::getConfig('task_delivery_max_time');

        $task_delivery_max_time = $task_delivery_max_time*24*3600;
        $filled = [];
        $successed = [];
        foreach($data as $k=>$v)
        {
            if((strtotime($v['checked_at'])+$task_delivery_max_time)<=time())
            {
                
                $query = WorkModel::where('task_id', $v['id']);
                $query = $query->where(function ($query) {
                    $query->where('status', 3)->orWhere('status', 4)->orWhere('status',2);
                });
                $work = $query->count();
                if ($work == 0) {
                    $filled[] = $v;
                } else {
                    $successed[] = $v;
                }
            }
        }
        if($type==1){
            return $filled;
        }else{
            return $successed;
        }
    }
}
