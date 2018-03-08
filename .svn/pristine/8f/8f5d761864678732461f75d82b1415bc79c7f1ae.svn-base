<?php

namespace App\Modules\Shop\Models;

use App\Modules\Employ\Models\EmployGoodsModel;
use App\Modules\Employ\Models\EmployModel;
use App\Modules\Employ\Models\UnionAttachmentModel;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Task\Model\ServiceModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GoodsModel extends Model
{
    
    protected $table = 'goods';

    protected $primaryKey = 'id';

    protected $fillable = [

        'uid', 'shop_id', 'cate_id', 'title', 'desc', 'unit', 'type', 'cash', 'cover', 'status', 'is_recommend','recommend_end',
        'sales_num', 'comments_num','view_num','is_delete','recommend_text','seo_title','seo_keyword','seo_desc','good_comment'

    ];

    static public function serviceList($uid,$data)
    {
        $service = self::select('goods.*','us.name')->where('goods.uid',$uid)->where('goods.type',2)->where('goods.is_delete',0);
        
        if(isset($data['status']) && $data['status']!='all')
        {
            $service->where('goods.status',intval($data['status']));
        }
        
        if(isset($data['time']) && $data['time']!='all')
        {
            $time = date('Y-m-d H:i:s',strtotime("-".intval($data['time'])." month"));
            $service->where('goods.created_at','>',$time);
        }

        $service = $service->leftjoin('users as us','us.id','=','goods.uid')
            ->orderBy('created_at','DESC')
            ->paginate(5);
        return $service;
    }

    
    static public function serviceStatistics($uid)
    {
        
        $added_service = self::where('type',2)->where('status',1)->where('uid',$uid)->count();

        $service_ids = self::where('type',2)->where('uid',$uid)->lists('id');
        $employ_ids = EmployGoodsModel::whereIn('service_id',$service_ids)->lists('employ_id');
        $success_service = EmployModel::whereIn('id',$employ_ids)->where('status',4)->count();
        $service_money = EmployModel::whereIn('id',$employ_ids)->sum('bounty');

        
        $balance = UserDetailModel::where('uid',$uid)->first();
        $balance = $balance['balance'];
        $data = [
            'added_service'=>$added_service,
            'success_service'=>$success_service,
            'service_money'=>$service_money,
            'balance'=>$balance
        ];
        return $data;
    }

    
    static public function getGoodsInfoById($id,$where=array())
    {
        if(isset($where['status'])){
            $goodsInfo = GoodsModel::where('id',$id)->where('is_delete',0)->where('status',$where['status'])->first();
        }elseif(isset($where['is_delete'])){
            $goodsInfo = GoodsModel::where('id',$id)->first();
        }else{
            $goodsInfo = GoodsModel::where('id',$id)->where('is_delete',0)->first();
        }

        if(!empty($goodsInfo)){
            
            if(!empty($goodsInfo->cate_id)){
                $cate = TaskCateModel::where('id',$goodsInfo->cate_id)->first();
                if(!empty($cate)){
                    $parentCate = TaskCateModel::where('id',$cate->pid)->first();
                    $goodsInfo['cate_name'] = $cate->name;
                    $goodsInfo['cate_pid'] = $cate->pid;
                    if(!empty($parentCate)){
                        $goodsInfo['cate_pname'] = $parentCate->name;
                    }else{
                        $goodsInfo['cate_pname'] = '';
                    }
                }else{
                    $goodsInfo['cate_name'] = '';
                    $goodsInfo['cate_pname'] = '';
                    $goodsInfo['cate_pid'] = '';
                }
            }else{
                $goodsInfo['cate_name'] = '';
                $goodsInfo['cate_pname'] = '';
                $goodsInfo['cate_pid'] = '';
            }
            
            $user = UserModel::where('id',$goodsInfo->uid)->first();
            if(!empty($user)){
                $goodsInfo['name'] = $user->name;
            }else{
                $goodsInfo['name'] = '';
            }
            
            if(!empty($goodsInfo->comments_num)){
                $goodsInfo['comment_rate'] = ($goodsInfo->good_comment/$goodsInfo->comments_num)*100;
            }else{
                $goodsInfo['comment_rate'] = 100;
            }
            
            $avgSpeed = round(GoodsCommentModel::where('goods_id', $id)->avg('speed_score'), 1);
            
            $avgQuality = round(GoodsCommentModel::where('goods_id', $id)->avg('quality_score'), 1);
            
            $avgAttitude = round(GoodsCommentModel::where('goods_id', $id)->avg('attitude_score'), 1);
            
            $goodsInfo['avg_score'] = round(($avgSpeed+$avgQuality+$avgAttitude)/3,1);
        }

        return $goodsInfo;
    }

    
    static public function getGoodsStatus($id)
    {
        $res = GoodsModel::where('id',$id)->where('is_delete',0)->select('status')->first();
        if(!empty($res)){
            $status = $res->status;
        }else{
            $status = null;
        }
        return $status;
    }


    
    static public function changeGoodsStatus($id,$type,$reason='')
    {
        
        $res = GoodsModel::getGoodsStatus($id);
        $re = '';
        switch($type){
            case 1 : 
                if($res == 2){
                    $arr = array('status' => 1);
                    $re = GoodsModel::where('id',$id)->update($arr);
                }
                break;
            case 2 : 
                 if($res == 1){
                     $arr = array('status' => 2);
                     $re = GoodsModel::where('id',$id)->update($arr);
                 }
                break;
            case 3 :
                if($res == 0){
                    $arr = array('status' => 1);
                    $re = GoodsModel::where('id',$id)->update($arr);
                }
                break;
            case 4 : 
                 if($res == 0){
                     
                     $serviceId = ServiceModel::where('identify','ZUOPINTUIJIAN')->orwhere('identify','FUWUTUIJIAN')->lists('id')->toArray();

                     $isService = GoodsServiceModel::where('goods_id',$id)->whereIn('service_id',$serviceId)->first();

                     if(!empty($isService)){

                         
                         $orderInfo = ShopOrderModel::where('object_id',$id)
                             ->whereIn('object_type',[1,3])->where('status',1)->first();

                         if(!empty($orderInfo)){
                             $status = DB::transaction(function () use ($orderInfo,$id,$reason) {
                                 
                                 $cash = $orderInfo->cash;
                                 
                                 UserDetailModel::where('uid', $orderInfo->uid)->increment('balance', $cash);
                                 
                                 ShopOrderModel::where('id',$orderInfo->id)->update(['status' => 5]);
                                 
                                 $finance_data = [
                                     'action' => 11, 
                                     'pay_type' => 1,
                                     'cash' => $cash,
                                     'uid' => $orderInfo->uid,
                                     'created_at' => date('Y-m-d H:i:s', time()),
                                 ];
                                 FinancialModel::create($finance_data);
                                 $arr = array('status' => 3 ,'recommend_text' => $reason);
                                 GoodsModel::where('id',$id)->update($arr);
                                 return true;
                             });
                             return $status;
                         }
                     }else{
                         $arr = array('status' => 3 ,'recommend_text' => $reason);
                         $re = GoodsModel::where('id',$id)->update($arr);
                     }
                 }
                break;
            case 5 : 
                 if($res == 0 || $res == 2 || $res == 3){
                     $arr = array('is_delete' => 1);
                     $re = GoodsModel::where('id',$id)->update($arr);
                 }
                break;
        }
        return $re;
    }

    
    static public function getGoodsListByUid($uid,$merge=array())
    {
        $goodsList = GoodsModel::whereRaw('1 = 1');
        
        if(isset($merge['status'])){
            switch($merge['status']){
                case 1:
                    $status = 0;
                    $goodsList = $goodsList->where('goods.status',$status);
                    break;
                case 2:
                    $status = 1;
                    $goodsList = $goodsList->where('goods.status',$status);
                    break;
                case 3:
                    $status = 2;
                    $goodsList = $goodsList->where('goods.status',$status);
                    break;
                case 4: 
                    $status = 3;
                    $goodsList = $goodsList->where('goods.status',$status);
                    break;

            }
        }
        
        if(isset($merge['sometime'])){
            switch($merge['sometime']){
                case 1:
                    $start = date('Y-m-d H:i:s',(time()-30*24*3600));
                    $goodsList = $goodsList->where('goods.created_at','>',$start);
                    break;
                case 2:
                    $start = date('Y-m-d H:i:s',(time()-90*24*3600));
                    $goodsList = $goodsList->where('goods.created_at','>',$start);
                    break;
                case 3:
                    $start = date('Y-m-d H:i:s',(time()-180*24*3600));
                    $goodsList = $goodsList->where('goods.created_at','>',$start);
                    break;
            }
        }
        $goodsList = $goodsList->where('goods.uid',$uid)->where('goods.type',1)->where('is_delete',0)
            ->leftJoin('cate','cate.id','=','goods.cate_id')
            ->select('goods.*','cate.name')
            ->orderBy('goods.created_at','DESC')
            ->paginate(5);
        return$goodsList;

    }

    
    static public function goodsStatistics($uid)
    {

        
        $goodsIds = self::where('type',1)->where('uid',$uid)->lists('id');
        
        $buyCount = ShopOrderModel::whereIn('object_id',$goodsIds)->where('object_type',2)
            ->whereIn('status',[2,4,5])->count();
        
        $onBuyCount = ShopOrderModel::whereIn('object_id',$goodsIds)->where('object_type',2)
            ->whereIn('status',[1,3])->count();
        
        $buyIncome = ShopOrderModel::whereIn('object_id',$goodsIds)->where('object_type',2)
            ->whereIn('status',[2,4])->sum('cash');
        
        $balance = UserDetailModel::where('uid',$uid)->first();
        $balance = $balance['balance'];
        $data = [
            'buy_count' => $buyCount,
            'on_buy_count' => $onBuyCount,
            'buy_income' => $buyIncome,
            'balance'=>$balance
        ];
        return $data;
    }

    static public function serviceCreate($data)
    {
        $status = DB::transaction(function() use($data)
        {
            $result = self::create($data);
            
            if (!empty($data['file_id'])) {
                
                $file_able_ids = AttachmentModel::fileAble($data['file_id']);
                $file_able_ids = array_flatten($file_able_ids);

                foreach ($file_able_ids as $v) {
                    $arrAttachment[] = [
                        'object_id' => $result->id,
                        'object_type' => 4,
                        'attachment_id' => $v,
                        'created_at' => date('Y-m-d H:i:s', time())
                    ];

                }
                UnionAttachmentModel::insert($arrAttachment);
                
                $attachmentModel = new AttachmentModel();
                $attachmentModel->statusChange($file_able_ids);
            }
            return $result;
        });

        return $status;
    }

    
    static public function updateService($service)
    {
        $status = DB::transaction(function() use($service){
            $update_data = [
                'title'=>e($service['title']),
                'desc'=>$service['desc'],
                'cate_id'=>$service['secondCate'],
                'cash'=>$service['cash'],
                'cover'=>$service['cover'],
                'updated_at'=>date('Y-m-d H-i:s',time()),
            ];

            self::where('id',$service['id'])->update($update_data);
            
            if (!empty($service['file_id']))
            {
                
                $file_able_ids = AttachmentModel::fileAble($service['file_id']);
                $file_able_ids = array_flatten($file_able_ids);

                foreach ($file_able_ids as $v) {
                    $arrAttachment[] = [
                        'object_id' => $service['id'],
                        'object_type' => 4,
                        'attachment_id' => $v,
                        'created_at' => date('Y-m-d H:i:s', time())
                    ];
                }
                
                UnionAttachmentModel::insert($arrAttachment);
                
                $attachmentModel = new AttachmentModel();
                $attachmentModel->statusChange($file_able_ids);
            }
        });

        return is_null($status)?true:false;
    }
    
    static public function servicePay($money,$uid,$goods_id,$order_id)
    {
        $status = DB::transaction(function() use($money,$uid,$goods_id,$order_id)
        {
            $time = time();
            $map = [
                0=>3600*24,
                1=>3600*24*30,
                2=>3600*24*90,
                3=>3600*24*180,
                4=>3600*24*365,
            ];
            
            UserDetailModel::where('uid',$uid)->decrement('balance',$money);
            
            $financial = [
                'action' => 5,
                'pay_type' => 1,
                'cash' => $money,
                'uid' => $uid,
                'created_at' => date('Y-m-d H:i:s', time())
            ];
            FinancialModel::create($financial);

            
            $unit = \CommonClass::getConfig('recommend_service_unit');
            $recommend_end = date('Y-m-d H:i:d',$time+$map[$unit]);
            
            
            $goods = self::where('id',$goods_id)->first();
            if($goods['is_recommend']==1)
            {
                
                if($time>strtotime($goods['recommend_end']))
                {
                    self::where('id',$goods_id)->update(['recommend_end'=>$recommend_end]);
                }else{
                    $recommend_end = date('Y-m-d',strtotime($goods['recommend_end'])+$map[$unit]);
                    self::where('id',$goods_id)->update(['recommend_end'=>$recommend_end]);
                }
            }else{
                self::where('id',$goods_id)->update(['is_recommend'=>1,'recommend_end'=>$recommend_end]);
            }
            
            $service = ServiceModel::where('identify','FUWUTUIJIAN')->first();
            GoodsServiceModel::create(['service_id'=>$service['id'],'goods_id'=>$goods['id']]);
            
            ShopOrderModel::where('id',$order_id)->update(['status'=>1,'pay_time'=>$time]);
        });

        return is_null($status)?true:false;
    }

    
    static public function getServiceEnd($goods_id)
    {
        $time = time();
        $map = [
            0=>3600*24,
            1=>3600*24*30,
            2=>3600*24*90,
            3=>3600*24*180,
            4=>3600*24*365,
        ];
        
        $unit = \CommonClass::getConfig('recommend_goods_unit');
        $recommend_end = $time+$map[$unit];
        
        
        $goods = self::where('id',$goods_id)->first();
        if($goods['is_recommend']==1)
        {
            
            if($time>strtotime($goods['recommend_end']))
            {
                $res = self::where('id',$goods_id)->update(['recommend_end'=>date('Y-m-d H:i:s',$recommend_end)]);
            }else{
                $recommend_end = strtotime($goods['recommend_end'])+$map[$unit];
                $res = self::where('id',$goods_id)->update(['recommend_end'=>date('Y-m-d H:i:s',$recommend_end)]);
            }
        }else{
            $res = self::where('id',$goods_id)->update(['is_recommend'=>1,'recommend_end'=>date('Y-m-d H:i:s',$recommend_end)]);
        }
        return $res;

    }
}
