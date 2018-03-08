<?php

namespace App\Console\Commands;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskTypeModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\UserDetailModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TaskWork extends Command
{
    
    protected $signature = 'taskWork';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $taskTypeId = TaskTypeModel::getTaskTypeIdByAlias('xuanshang');
        
        $tasks = TaskModel::where('type_id',$taskTypeId)->where('status','=',3)->orWhere('status','=',4)->get()->toArray();

        
        $expireTasks = self::expireTasks($tasks);

        
        $works = WorkModel::whereIn('task_id',$expireTasks)->lists('task_id')->toArray();
        $worked = array_unique($works);
        $not_worked = array_diff($expireTasks,$worked);

        
        foreach($not_worked as $v){
            $status = DB::transaction(function() use($v){
                
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
                    'action'=>1,
                    'pay_type'=>1,
                    'cash'=>$balance,
                    'uid'=>$task['uid'],
                    'created_at'=>date('Y-m-d H:i:s',time()),
                    'updated_at'=>date('Y-m-d H:i:s',time()),
                ];
                FinancialModel::create($finance_data);
            });
        }
        
        $result2 = TaskModel::whereIn('id',$worked)->update(['status'=>5,'selected_work_at'=>date('Y-m-d H:i:s',time())]);
    }
    private function expireTasks($data)
    {
        $expireTasks = [];
        foreach($data as $k=>$v)
        {
            $time = time();
            
            if(strtotime($v['delivery_deadline'])<=$time)
            {
                $expireTasks[] = $v['id'];
            }
        }
        return $expireTasks;
    }

}
