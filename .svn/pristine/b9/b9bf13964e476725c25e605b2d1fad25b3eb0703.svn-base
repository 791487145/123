<?php

namespace App\Modules\Order\Model;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\ServiceModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Shop\Models\GoodsServiceModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use App\Modules\Order\Model\OrderModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ShopOrderModel extends Model
{

    
    protected $table = 'shop_order';

    protected $fillable = [
        'code', 'title', 'uid', 'cash', 'status', 'invoice_status', 'note', 'object_type','object_id',
        'created_at','pay_time','trade_rate'
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $hidden = [

    ];


    
    static function randomCode($uid, $specific = '')
    {
        return $specific . time() . str_random(4) . $uid;
    }

    
    static function handleOrderCode($shopCode)
    {
        $specific = substr($shopCode, 0, 2);
        switch ($specific){
            case 'ps':
                $type = 'pub service';
                break;
            case 'pg':
                $type = 'pub goods';
                break;
            case 'bg':
                $type = 'buy goods';
                break;
            case 'bs':
                $type = 'buy service';
                break;
            case 'ss':
                $type = 'buy shop service';
                break;
            case 'ep':
                $type = 'employ';
                break;
            case 'vs':
                $type = 'vipshop';
                break;
            case 'ts': 
                $type  = 'task service';
                break;
            default:
                $info = OrderModel::where('code', $shopCode)->first();
                if (!empty($info)){
                    if (is_null($info->task_id)){
                        $type = 'cash';
                    } else {
                        $type = 'pub task';
                    }
                }
                break;
        }

        return $type;
    }

    static function employOrder($uid,$money,$data)
    {
        $employ_order = [
            'code'=>self::randomCode($uid,'ep'),
            'title'=>'雇佣托管',
            'uid'=>$uid,
            'object_id'=>$data['id'],
            'object_type'=>1,
            'cash'=>$money,
            'status'=>0,
        ];

        $result = self::create($employ_order);

        return $result;
    }

    
    static function serviceOrder($uid,$money,$id)
    {
        $employ_order = [
            'code'=>self::randomCode($uid,'ps'),
            'title'=>'购买增值工具',
            'uid'=>$uid,
            'object_id'=>$id,
            'object_type'=>1,
            'cash'=>$money,
            'status'=>0,
        ];

        $result = self::create($employ_order);

        return $result;
    }
    
    static function buyShopService($good_id)
    {
        $status = DB::transaction(function () use ($good_id){
            
            $serviceTool = ServiceModel::where('identify','ZUOPINTUIJIAN')->first();
            if(!empty($serviceTool) && $serviceTool->status == 1){
                $cash = $serviceTool->price;
            }else{
                $cash = 0.00;
            }
            
            UserDetailModel::where('uid', Auth::id())->decrement('balance', $cash);
            
            $orderInfo = ShopOrderModel::where('object_type',3)->where('object_id',$serviceTool->id)->where('status',0)->first();
            if(empty($orderInfo)){
                
                $serviceGoodsId = GoodsServiceModel::insertGetId(['service_id' => $serviceTool->id, 'goods_id' => $good_id]);
                
                $goods_order = [
                    'code' => self::randomCode(Auth::id(),'pg'),
                    'title' => '购买作品推荐增值服务',
                    'uid' => Auth::id(),
                    'object_id' => $serviceGoodsId,
                    'object_type' => 3,
                    'cash' => $cash,
                    'status' => 1,
                    'created_at'=> date('Y-m-d H:i:s'),
                    'pay_time' => date('Y-m-d H:i:s')
                ];
                ShopOrderModel::create($goods_order);

            }else{
                ShopOrderModel::where('id',$orderInfo->id)->update(['status' => 1,'pay_time' => date('Y-m-d H:i:s')]);
            }

            
            $finance = [
                'action' => 5,
                'pay_type' => 1,
                'cash' => $cash,
                'uid' => Auth::id(),
            ];
            FinancialModel::create($finance);
            
            GoodsModel::getServiceEnd($good_id);
        });
        return is_null($status) ? true : false;
    }


    
    static function thirdBuyShopService($orderCode, array $data)
    {
        $status = DB::transaction(function() use ($orderCode, $data){
            $shopOrder = ShopOrderModel::where('code', $orderCode)->first();
            
            $shopOrder->update(['status' => 1,'pay_time' => date('Y-m-d H:i:s')]);
            
            $goodsId = GoodsServiceModel::where('id',$shopOrder->object_id)->first()->goods_id;
            GoodsModel::getServiceEnd($goodsId);
            $finance = [
                'action' => 5,
                'pay_type' => $data['pay_type'],
                'pay_account' => $data['pay_account'],
                'pay_code' => $data['pay_code'],
                'cash' => $data['money'],
                'uid' => Auth::id()
            ];
            FinancialModel::create($finance);
        });

        return is_null($status) ? true : false;
    }

    
    static function isBuy($uid,$objectId,$objectType)
    {
        $shopOrderInfo = ShopOrderModel::where('uid',$uid)->where('object_id',$objectId)
            ->where('object_type',$objectType)->whereIn('status',[1,2,4])->first();
        if(!empty($shopOrderInfo)){
            $isBuy = true;
        }else{
            $isBuy = false;
        }
        return $isBuy;
    }

    
    static function isRights($uid,$objectId,$objectType)
    {
        $shopOrderInfo = ShopOrderModel::where('uid',$uid)->where('object_id',$objectId)
            ->where('object_type',$objectType)->where('status',3)->first();
        if(!empty($shopOrderInfo)){
            $isRights = true;
        }else{
            $isRights = false;
        }
        return $isRights;
    }

    
    static function buyShopGoods($uid,$orderId)
    {
        $status = DB::transaction(function () use ($uid,$orderId){
            $orderInfo = ShopOrderModel::where('id',$orderId)->first();
            
            UserDetailModel::where('uid', $uid)->decrement('balance', $orderInfo->cash);
            
            $array = array(
                'status' => 1,
                'pay_time' => date('Y-m-d H:i:s')
            );
            ShopOrderModel::where('id',$orderId)->update($array);

            
            $finance = [
                'action' => 6,
                'pay_type' => 1,
                'cash' => $orderInfo->cash,
                'uid' => $uid,
            ];
            FinancialModel::create($finance);
        });
        return is_null($status) ? true : false;
    }

    
    static function thirdBuyGoods($orderCode, array $data)
    {
        $status = DB::transaction(function() use ($orderCode, $data){
            $shopOrder = ShopOrderModel::where('code', $orderCode)->first();
            
            $shopOrder->update(['status' => 1,'pay_time' => date('Y-m-d H:i:s')]);
            $finance = [
                'action' => 6,
                'pay_type' => $data['pay_type'],
                'pay_account' => $data['pay_account'],
                'pay_code' => $data['pay_code'],
                'cash' => $data['money'],
                'uid' => Auth::id()
            ];
            FinancialModel::create($finance);

        });

        return is_null($status) ? true : false;
    }


    
    static function myBuyGoods($uid,$type,$merge=array(),$paginate=5)
    {
        $buyGoods = ShopOrderModel::whereRaw('1 = 1');
        
        if(isset($merge['type']) && $merge['type'] != 0){
            switch($merge['type']){
                case 2:
                    $status = 1;
                    $buyGoods = $buyGoods->where('shop_order.status',$status);
                    break;
                case 3:
                    $status = [2,4];
                    $buyGoods = $buyGoods->whereIn('shop_order.status',$status);
                    break;
                case 4:
                    $status = [0,3,5];
                    $buyGoods = $buyGoods->whereIn('shop_order.status',$status);
                    break;

            }
        }
        
        if(isset($merge['status']) && $merge['status'] != 0){
            switch($merge['status']){
                case 1:
                    $status = 0;
                    $buyGoods = $buyGoods->where('shop_order.status',$status);
                    break;
                case 2:
                    $status = 1;
                    $buyGoods = $buyGoods->where('shop_order.status',$status);
                    break;
                case 3:
                    $status = [2,4];
                    $buyGoods = $buyGoods->whereIn('shop_order.status',$status);
                    break;
                case 4:
                    $status = 3;
                    $buyGoods = $buyGoods->where('shop_order.status',$status);
                    break;
                case 5:
                    $status = 5;
                    $buyGoods = $buyGoods->where('shop_order.status',$status);
                    break;

            }
        }
        
        if(isset($merge['sometime'])){
            switch($merge['sometime']){
                case 1:
                    $start = date('Y-m-d H:i:s',(time()-30*24*3600));
                    $buyGoods = $buyGoods->where('shop_order.pay_time','>',$start);
                    break;
                case 2:
                    $start = date('Y-m-d H:i:s',(time()-90*24*3600));
                    $buyGoods = $buyGoods->where('shop_order.pay_time','>',$start);
                    break;
                case 3:
                    $start = date('Y-m-d H:i:s',(time()-180*24*3600));
                    $buyGoods = $buyGoods->where('shop_order.pay_time','>',$start);
                    break;
            }
        }
        $buyGoods = $buyGoods->where('shop_order.uid',$uid)->where('shop_order.object_type',$type)
            ->leftJoin('goods','goods.id','=','shop_order.object_id')
            ->leftJoin('users','users.id','=','shop_order.uid')
            ->select('shop_order.*','goods.title','goods.desc','goods.cate_id','goods.cover','goods.unit','users.name')
            ->orderBy('shop_order.created_at','DESC')
            ->paginate($paginate);
        if(!empty($buyGoods)){
            $cateIds = array();
            foreach($buyGoods as $k => $v){
                $cateIds[] = $v->cate_id;
            }
            if(!empty($cateIds)){
                $cateArr = TaskCateModel::whereIn('id',$cateIds)->select('id','name')->get();
            }else{
                $cateArr = array();
            }
            if(!empty($cateArr)){
                foreach($buyGoods as $k => $v){
                    foreach($cateArr as $a => $b){
                        if($v->cate_id == $b->id){
                            $v->cate_name = $b->name;
                        }
                    }
                }
            }
        }
        return$buyGoods;

    }

    
    static function getGoodsOrderInfoById($id)
    {
        $orderInfo = ShopOrderModel::where('id',$id)->where('object_type',2)->first();
        if(!empty($orderInfo)){
            
            $userInfo = UserModel::where('id',$orderInfo->uid)->first();
            if($userInfo){
                $orderInfo['username'] = $userInfo->name;
            }else{
                $orderInfo['username'] = '';
            }
            
            $goodsInfo = GoodsModel::where('id',$orderInfo->object_id)->first();
            if(!empty($goodsInfo)){
                $orderInfo['goods_name'] = $goodsInfo->title;
                
                $cateInfo = TaskCateModel::where('id',$goodsInfo->cate_id)->select('id','pid','name')->first();
                if(!empty($cateInfo)){
                    $orderInfo['cate_sec_name'] = $cateInfo->name;
                    $cateFirst = TaskCateModel::where('id',$cateInfo->pid)->select('id','name')->first();
                    if(!empty($cateFirst)){
                        $orderInfo['cate_fir_name'] = $cateFirst->name;
                    }else{
                        $orderInfo['cate_fir_name'] = '';
                    }
                }else{
                    $orderInfo['cate_sec_name'] = '';
                    $orderInfo['cate_fir_name'] = '';
                }
            }else{
                $orderInfo['goods_name'] = '';
                $orderInfo['cate_sec_name'] = '';
                $orderInfo['cate_fir_name'] = '';
            }
        }
        return $orderInfo;
    }


    
    static function confirmGoods($id,$uid)
    {
        $status = DB::transaction(function () use ($id,$uid) {
            $shopOrder = ShopOrderModel::where('id',$id)->where('uid',$uid)->where('status',1)->first();
            ShopOrderModel::where('id',$id)->update(['status' => 2,'confirm_time' => date('Y-m-d H:i:s')]);
            
            if(!empty($shopOrder->trade_rate)){
                $tradePay = $shopOrder->cash*$shopOrder->trade_rate*0.01;
            }else{
                $tradePay = 0;
            }
            
            $cash = $shopOrder->cash - $tradePay;
            
            $goodsInfo = GoodsModel::where('id', $shopOrder->object_id)->first();
            
            UserDetailModel::where('uid', $goodsInfo->uid)->increment('balance', $cash);
            
            $finance_data = [
                'action' => 9, 
                'pay_type' => 1,
                'cash' => $cash,
                'uid' => $goodsInfo->uid,
                'created_at' => date('Y-m-d H:i:s', time()),
            ];
            FinancialModel::create($finance_data);
            return true;
        });
        return $status;
    }

    
    static public function sellGoodsList($uid,$type,$merge,$paginate=5)
    {
        
        $goods = GoodsModel::where('uid',$uid)->where('type',1)->get()->toArray();
        if(!empty($goods) && is_array($goods)){
            foreach($goods as $k => $v){
                $goodsId[] = $v['id'];
            }
        }
        $buyGoods = ShopOrderModel::whereRaw('1 = 1');
        
        if(isset($merge['type']) && $merge['type'] != 0){
            switch($merge['type']){
                case 2:
                    $status = 1;
                    $buyGoods = $buyGoods->where('shop_order.status',$status);
                    break;
                case 3:
                    $status = [2,4];
                    $buyGoods = $buyGoods->whereIn('shop_order.status',$status);
                    break;
                case 4:
                    $status = [0,3,5];
                    $buyGoods = $buyGoods->whereIn('shop_order.status',$status);
                    break;

            }
        }
        
        if(isset($merge['status'])){
            switch($merge['status']){
                case 1:
                    $status = 0;
                    $buyGoods = $buyGoods->where('shop_order.status',$status);
                    break;
                case 2:
                    $status = 1;
                    $buyGoods = $buyGoods->where('shop_order.status',$status);
                    break;
                case 3:
                    $status = [2,4];
                    $buyGoods = $buyGoods->whereIn('shop_order.status',$status);
                    break;
                case 4:
                    $status = 3;
                    $buyGoods = $buyGoods->where('shop_order.status',$status);
                    break;
                case 5:
                    $status = 5;
                    $buyGoods = $buyGoods->where('shop_order.status',$status);
                    break;
                default:
                    $status = [1,2,3,4,5];
                    $buyGoods = $buyGoods->whereIn('shop_order.status',$status);
                    break;

            }
        }else{
            $status = [1,2,3,4,5];
            $buyGoods = $buyGoods->whereIn('shop_order.status',$status);
        }
        
        if(isset($merge['sometime'])){
            switch($merge['sometime']){
                case 1:
                    $start = date('Y-m-d H:i:s',(time()-30*24*3600));
                    $buyGoods = $buyGoods->where('shop_order.pay_time','>',$start);
                    break;
                case 2:
                    $start = date('Y-m-d H:i:s',(time()-90*24*3600));
                    $buyGoods = $buyGoods->where('shop_order.pay_time','>',$start);
                    break;
                case 3:
                    $start = date('Y-m-d H:i:s',(time()-180*24*3600));
                    $buyGoods = $buyGoods->where('shop_order.pay_time','>',$start);
                    break;
            }
        }
        if(!empty($goodsId)){
            $buyGoods = $buyGoods->whereIn('shop_order.object_id',$goodsId)->where('shop_order.object_type',$type)
                ->leftJoin('goods','goods.id','=','shop_order.object_id')
                ->leftJoin('users','users.id','=','shop_order.uid')
                ->leftJoin('user_detail','user_detail.uid','=','shop_order.uid')
                ->select('shop_order.*','goods.title','goods.desc','goods.cate_id','goods.cover','goods.unit','users.name','user_detail.avatar')
                ->orderBy('shop_order.created_at','DESC')
                ->paginate($paginate);
            if(!empty($buyGoods)){
                $cateIds = array();
                foreach($buyGoods as $k => $v){
                    $cateIds[] = $v->cate_id;
                }
                if(!empty($cateIds)){
                    $cateArr = TaskCateModel::whereIn('id',$cateIds)->select('id','name')->get();
                }else{
                    $cateArr = array();
                }
                if(!empty($cateArr)){
                    foreach($buyGoods as $k => $v){
                        foreach($cateArr as $a => $b){
                            if($v->cate_id == $b->id){
                                $v->cate_name = $b->name;
                            }
                        }
                    }
                }
            }
        }else{
            $buyGoods = array();
        }

        return$buyGoods;

    }

}
