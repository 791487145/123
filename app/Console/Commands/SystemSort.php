<?php

namespace App\Console\Commands;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\User\Model\UserBalanceModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Console\Command;
use Cache;
use Illuminate\Support\Facades\Redis;

class SystemSort extends Command
{
    
    protected $signature = 'SystemSort';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        Redis::del('userEmplaysSort');//雇主经验
        Redis::del('userHuntersSort');//猎人经验
        Redis::del('userGoldSort');//金币
        Redis::del('userGradesSort');//用户等级
        Redis::del('userFinancialSort');//收入
        Redis::del('userFinancialTopUpSort');//充值
        Redis::del('userFinancialSaleSort');//消费

        $users = UserModel::whereStatus(UserModel::USER_ACTIVITATE)->lists('id');
        foreach($users as $v){
            $userBalance = UserBalanceModel::where('user_id',$v)->first();
            if(!is_null($userBalance)){

                if($userBalance->emp_value != 0){
                    Redis::zincrby('userEmplaysSort',$userBalance->emp_value,$v);//雇主经验
                }
                if($userBalance->hunt_value != 0){
                    Redis::zincrby('userHuntersSort',$userBalance->emp_value,$v);//猎人经验
                }
                if($userBalance->gold != 0){
                    Redis::zincrby('userGoldSort',$userBalance->emp_value,$v);//金币
                }
                if($userBalance->act_value != 0){
                    Redis::zincrby('userGradesSort',$userBalance->emp_value,$v);//用户等级
                }
            }

            $fincial = FinancialModel::whereUid($v)->whereAction(FinancialModel::RECEIVE_TASK)->sum('cash');
            if($fincial != 0){
                Redis::zincrby('userFinancialSort',$fincial,$v);//收入
            }

            $fincials = FinancialModel::whereUid($v)->whereAction(FinancialModel::TOP_UP)->sum('cash');
            if($fincials != 0){
                Redis::zincrby('userFinancialTopUpSort',$fincials,$v);//充值
            }

            $action = [1,5,6];
            $fincialUp =  FinancialModel::whereUid($v)->whereIn('action',$action)->sum('cash');
            $fincialDown = FinancialModel::whereUid($v)->whereAction(7)->sum('cash');
            if(!is_null($fincialDown) && !is_null($fincialUp)){
                Redis::zincrby('userFinancialSaleSort',bcsub($fincialUp,$fincialDown),$v);//消费
            }

        }

    }




    

}
