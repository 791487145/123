<?php

namespace App\Console\Commands;

use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsCommentModel;
use Illuminate\Console\Command;

class GoodsComment extends Command
{
    
    protected $signature = 'GoodsComment';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $goodsOrder = ShopOrderModel::where('object_type',2)->where('status',2)->get()->toArray();
        if(!empty($goodsOrder)){
            $expireGoodsOrder = self::expireGoodsComment($goodsOrder);
            if(!empty($expireGoodsOrder)){
                foreach($expireGoodsOrder as $key => $val){
                    
                    $res = GoodsCommentModel::where('uid',$val['uid'])->where('goods_id',$val['object_id'])->first();
                    if(empty($res)){
                        $arr = array(
                            'uid' => $val['uid'],
                            'goods_id' => $val['object_id'],
                            'comment_by' => 0,
                            'speed_score' => 5,
                            'quality_score' => 5,
                            'attitude_score' => 5,
                            'comment_desc' => '作品很棒!',
                            'type' => 0,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        GoodsCommentModel::createGoodsComment($arr,$val);
                    }
                }
            }
        }

    }


    
    private function expireGoodsComment($goodsOrder)
    {
        
        $commentDaysArr = ConfigModel::getConfigByAlias('comment_days');
        if(!empty($commentDaysArr) && $commentDaysArr->rule != 0){
            $commentDays = intval($commentDaysArr->rule);
        }else{
            $commentDays = 7;
        }
        $limitTime = $commentDays*24*60*60;
        $expireGoodsOrder = array();
        if(!empty($goodsOrder)){
            foreach($goodsOrder as $k => $v){
                
                if((strtotime($v['confirm_time'])+$limitTime)<= time()){
                    $expireGoodsOrder[] = $v;
                }
            }
        }
        return $expireGoodsOrder;

    }
}
