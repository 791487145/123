<?php

namespace App\Console\Commands;

use App\Modules\Task\Model\TaskModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TaskPayDelay extends Command
{
    
    protected $signature = 'taskPayDelay';

    
    protected $description = '任务付款超时';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        $time = strtotime("now");
        $tasks = TaskModel::whereStatus(TaskModel::TASK_NO_PAY)->get();
        foreach($tasks as $task){
            if((strtotime($task->created_at) + 15*60) < $time){
                TaskModel::whereId($task->id)->update(['status'=>TaskModel::TASK_FAIL]);
            }
        }
    }

}
