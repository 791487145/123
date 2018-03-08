<?php

namespace App\Console\Commands;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskTypeModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TaskComplateTrue extends Command
{
    
    protected $signature = 'taskComplateTrue';

    
    protected $description = '雇主确认24h';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        $time = strtotime("now");
        $tasks = TaskModel::whereStatus(TaskModel::TASK_RECIEIVER_TRUE)->get();
        foreach($tasks as $task){

            if((strtotime($task->checked_at) + 24 *60*60) < $time){
                $works = WorkModel::where('task_id',$task->id)->whereStatus(WorkModel::WORK_PUSH)->first();

                if(!is_null($works)){
                    $data['uid'] = $works->uid;
                    $data['work_id'] = $works->id;
                    $data['task_id'] = $task->id;
                    WorkModel::workCheck($data);
                    TaskModel::whereId($task->id)->update(['status'=>TaskModel::TASK_COMPLATE]);
                }

            }
        }



    }

    

}
