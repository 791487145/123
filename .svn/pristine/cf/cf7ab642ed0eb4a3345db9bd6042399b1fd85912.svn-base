<?php

namespace App\Console\Commands;

use App\Modules\User\Model\TaskModel;
use Illuminate\Console\Command;

class TaskPublicity extends Command
{
    
    protected $signature = 'taskPublicity';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $task = TaskModel::where('status',6)->get()->toArray();
        
        $expire = Self::expireTask($task);
        
        TaskModel::whereIn('id',$expire)->update(['status'=>7,'checked_at'=>date('Y-m-d H:i:s',time())]);
    }
    
    private function expireTask($task)
    {
        
        $task_publicity_day = \CommonClass::getConfig('task_publicity_day');
        $task_publicity_day = $task_publicity_day*24*3600;
        $expire_task = [];
        foreach($task as $v)
        {
            
            if((strtotime($v['publicity_at'])+$task_publicity_day)<=time())
            {
                $expire_task[] = $v['id'];
            }
        }
        return $expire_task;
    }
}
