<?php

namespace App\Console\Commands;

use App\Modules\Task\Model\TaskDelayModel;
use App\Modules\Task\Model\TaskModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TaskApplyDelay extends Command
{
    
    protected $signature = 'taskApplyDelay';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        $time = strtotime("now");
        $tasks = TaskModel::whereStatus(TaskModel::TASK_APPLY_DELAY)->get();

        foreach($tasks as $task){
            $taskDelay = TaskDelayModel::where('task_id',$task->id)->whereStatus(TaskDelayModel::TASK_DELAY_DOING)->first();
            if(!is_null($taskDelay) && (strtotime($taskDelay->created_at) + 5*60) <= $time){
                TaskDelayModel::whereId($taskDelay->id)->update(['status'=> TaskDelayModel::TASK_DELAY_AUTO_CONFIM]);
                TaskModel::whereId($task->id)->update(['status'=>TaskModel::TASK_DOING,'work_time'=>date("Y-m-d H:i:s",(strtotime($task->work_time) + $taskDelay->delay_time * 60))]);
            }
        }
    }
}
