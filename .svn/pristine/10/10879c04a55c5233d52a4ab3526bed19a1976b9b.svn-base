<?php

namespace App\Console\Commands;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\UserDetailModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TaskNoStick extends Command
{
    
    protected $signature = 'taskNoStick';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        $stick_day = 3;
        
        $stickOffTask = TaskModel::where('begin_at','<',date('Y-m-d H:i:s',time()-$stick_day*24*3600))->where('top_status',1)->lists('id');
        
        TaskModel::whereIn('id',$stickOffTask)->update(['top_status'=>0]);
    }
}
