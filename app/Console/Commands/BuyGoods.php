<?php

namespace App\Console\Commands;

use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Order\Model\ShopOrderModel;
use Illuminate\Console\Command;

class BuyGoods extends Command
{
    
    protected $signature = 'BuyGoods';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $goodsOrder = ShopOrderModel::where('object_type',2)->where('status',1)->get()->toArray();
        $expiredGoodsOrder = self::expireBuyGoods($goodsOrder);
        if(!empty($expiredGoodsOrder)){
            foreach($expiredGoodsOrder as $k => $v){
                
                ShopOrderModel::confirmGoods($v['id'],$v['uid']);
            }
        }
    }


    
    private function expireBuyGoods($goodsOrder)
    {
        
        $docConfirmArr = ConfigModel::getConfigByAlias('doc_confirm');
        if(!empty($docConfirmArr)){
            $docConfirm = intval($docConfirmArr->rule);
        }else{
            $docConfirm = 7;
        }
        $limitTime = $docConfirm*24*60*60;
        $expireGoodsOrder = array();
        if(!empty($goodsOrder)){
            foreach($goodsOrder as $k => $v){
                
                if((strtotime($v['pay_time'])+$limitTime)<= time()){
                    $expireGoodsOrder[] = $v;
                }
            }
        }
        return $expireGoodsOrder;

    }
}
