<?php

namespace App\Modules\Employ\Models;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UnionRightsModel extends Model
{
    protected $table = 'union_rights';
    public $timestamps = false;
    protected $fillable = [
        'type','object_id','object_type','desc','status','from_uid','to_uid','handel_uid','created_at','handled_at','is_delete'
    ];

    
    static function employRights($data,$role)
    {
        $status = DB::transaction(function() use($data,$role){
            
            self::create($data);
            
            switch($role)
            {
                case 1:
                    $status = 7;
                    break;
                case 2:
                    $status = 8;
                    break;
                default:
                    $status = 7;
                    break;
            }
            EmployModel::where('id',$data['object_id'])->update(['status'=>$status]);
        });
        return is_null($status)?true:false;
    }

    
    static function buyGoodsRights($data,$orderId)
    {
        $status = DB::transaction(function() use($data,$orderId){
            
            self::create($data);
            
            ShopOrderModel::where('id',$orderId)->update(['status'=>3]);
        });
        return is_null($status)?true:false;
    }


    
    static function rightsInfoById($id)
    {
        $rightsInfo = UnionRightsModel::where('id',$id)->where('is_delete',0)->first();
        
        $fromUser = self::getUserInfo($rightsInfo->from_uid);

        $rightsInfo['from_name'] = $fromUser['name'];
        $rightsInfo['from_email'] = $fromUser['email'];
        $rightsInfo['from_qq'] = $fromUser['qq'];
        $rightsInfo['from_mobile'] = $fromUser['mobile'];
        if(!empty($rightsInfo)){
            
            if(!empty($rightsInfo->object_type)){
                switch($rightsInfo->object_type){
                    case 1:
                        
                        $employ = EmployModel::where('id',$rightsInfo->object_id)->first();
                        $toUser = UserModel::where('id',$rightsInfo['to_uid'])->first();
                        $rightsInfo['to_name'] = $toUser['name'];
                        $rightsInfo['employ_cash'] = $employ['bounty'];
                        break;
                    case 2:
                        
                        $orderInfo = ShopOrderModel::where('id',$rightsInfo->object_id)->first();
                        if($orderInfo){
                            $rightsInfo['title'] = $orderInfo->title;
                            $rightsInfo['cash'] = $orderInfo->cash;
                            
                            $goodsInfo = GoodsModel::where('id',$orderInfo->object_id)->first();
                            if(!empty($goodsInfo)){
                                
                                $attachment = UnionAttachmentModel::where('object_id',$goodsInfo->id)
                                    ->where('object_type',4)->get()->toArray();
                                if(!empty($attachment)){
                                    $attachmentId = array();
                                    foreach($attachment as $k => $v){
                                        $attachmentId[] = $v['attachment_id'];
                                    }
                                    
                                    $attachmentInfo = AttachmentModel::whereIn('id',$attachmentId)->get()->toarray();
                                    if(!empty($attachmentInfo)){
                                        $orderInfo['attachment'] = $attachmentInfo;
                                    }
                                }else{
                                    $orderInfo['attachment'] = array();
                                }
                                
                                $toUser = self::getUserInfo($goodsInfo->uid);
                                $rightsInfo['to_name'] = $toUser['name'];
                                $rightsInfo['to_email'] = $toUser['email'];
                                $rightsInfo['to_qq'] = $toUser['qq'];
                                $rightsInfo['to_mobile'] = $toUser['mobile'];
                            }
                        }else{
                            $rightsInfo['title'] = '';
                            $rightsInfo['cash'] = '';
                        }
                        break;
                }
            }
        }
        return $rightsInfo;
    }

    
    static function getUserInfo($uid)
    {
        $userInfo = array();
        
        $toUser = UserModel::where('id',$uid)->select('id','name','email')->first();
        if(!empty($toUser)){
            $userInfo['name'] = $toUser->name;
            $userInfo['email'] = $toUser->email;
        }else{
            $userInfo['name'] = '';
            $userInfo['email'] = '';
        }
        $toUserDetail = UserDetailModel::where('uid',$uid)
            ->select('qq','qq_status','mobile','mobile_status')->first();
        if(!empty($toUserDetail)){
            if($toUserDetail->qq_status == 1){
                $userInfo['qq'] = $toUserDetail->qq;
            }else{
                $userInfo['qq'] = '';
            }
            if($toUserDetail->mobile_status == 1){
                $userInfo['mobile'] = $toUserDetail->mobile;
            }else{
                $userInfo['mobile'] = '';
            }
        }else{
            $userInfo['qq'] = '';
            $userInfo['mobile'] = '';
        }
        return $userInfo;
    }

    
    static function dealGoodsRights($id,$fromPrice,$toPrice=0)
    {
        $status = DB::transaction(function() use($id,$fromPrice,$toPrice){
            $rightsInfo = UnionRightsModel::where('id',$id)->first();
            UnionRightsModel::where('id', $id)->update(['status' => 1,'to_price' => $toPrice,'from_price' => $fromPrice]);
            
            UserDetailModel::where('uid', $rightsInfo['from_uid'])->increment('balance', $fromPrice);
            
            $finance_data = [
                'action' => 10, 
                'pay_type' => 1,
                'cash' => $fromPrice,
                'uid' => $rightsInfo['from_uid'],
                'created_at' => date('Y-m-d H:i:s', time()),
            ];
            FinancialModel::create($finance_data);
            

            
            ShopOrderModel::where('id',$rightsInfo->object_id)->update(['status' => 5]);
        });
        return is_null($status)?true:false;
    }

    static function dealSeriviceRights($id,$fromPrice,$toPrice)
    {
        $status = DB::transaction(function() use($id,$fromPrice,$toPrice){
            $rightsInfo = UnionRightsModel::where('id',$id)->first();
            UnionRightsModel::where('id', $id)->update(['status' => 1,'to_price' => $toPrice,'from_price' => $fromPrice,'handled_at'=>date('Y-m-d H:i:s',time())]);
            
            UserDetailModel::where('uid', $rightsInfo['from_uid'])->increment('balance', $fromPrice);
            
            $finance_data = [
                'action' => 10, 
                'pay_type' => 1,
                'cash' => $fromPrice,
                'uid' => $rightsInfo['from_uid'],
                'created_at' => date('Y-m-d H:i:s', time()),
            ];
            FinancialModel::create($finance_data);
            
            UserDetailModel::where('uid', $rightsInfo['to_uid'])->increment('balance', $toPrice);
            
            $finance_data = [
                'action' => 10,
                'pay_type' => 1,
                'cash' => $toPrice,
                'uid' => $rightsInfo['to_uid'],
                'created_at' => date('Y-m-d H:i:s', time()),
            ];
            FinancialModel::create($finance_data);
            
            EmployModel::where('id',$rightsInfo['object_id'])->update(['status'=>4,'end_at'=>date('Y-m-d H:i:s',time())]);
        });
        return is_null($status)?true:false;
    }
    
    static function dealGoodsRightsFailure($id)
    {
        $status = DB::transaction(function() use($id){
            $rightsInfo = UnionRightsModel::where('id',$id)->first();
            UnionRightsModel::where('id', $id)->update(['status' => 2]);
            
            $shopOrder = ShopOrderModel::where('id',$rightsInfo->object_id)->first();
            ShopOrderModel::where('id',$rightsInfo->object_id)->update(['status' => 2,'confirm_time' => date('Y-m-d H:i:s')]);
            
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

        });
        return is_null($status)?true:false;
    }
    
    static function serviceRightsHandel($id)
    {
        $status = DB::transaction(function() use($id)
        {
            
            $rights = self::where('id',$id)->first();
            
            self::where('id',$id)->update(['status'=>2]);

            EmployModel::where('id',$rights['object_id'])->whereIn('status',[7,8])->update(['status'=>2]);

        });

        return (is_null($status))?true:false;
    }
}
