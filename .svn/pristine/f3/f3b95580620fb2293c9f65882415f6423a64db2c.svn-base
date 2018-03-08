<?php

namespace App\Console\Commands;

use App\Http\Controllers\ApiBaseController;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Task\Model\TaskWaterModel;
use App\Modules\User\Model\UserBalanceModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Console\Command;
use Cache;

class UpdateTaskWater extends Command
{
	
    
    protected $signature = 'Task:update_time';

    
    protected $description = '修改假任务时间';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        $begintime = date('Y-m-d',strtotime('-1 day'));
        $time = ApiBaseController::randomDate($begintime);
        TaskWaterModel::where('status',2)->update(['created_at'=>$time]);
    }




    

}
