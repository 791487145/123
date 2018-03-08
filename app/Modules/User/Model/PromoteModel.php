<?php

namespace App\Modules\User\Model;
use App\Modules\Finance\Model\FinancialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Modules\User\Model\UserBalanceModel;
use DB;
use App\Modules\Manage\Model\MessageTemplateModel;

class PromoteModel extends Model
{
    protected $table = 'promote';

    public $timestamps = false;

    protected $fillable = [
        'id', 'from_uid','to_uid','price','finish_conditions','type','status','created_at','updated_at'
    ];

    
    public static function createPromoteUrl($uid)
    {
        $param = Crypt::encrypt($uid);
        $url = url('user/promote/'.$param);
        return $url;
    }


    
    public static function getUrlInfo($param)
    {
        $uid = Crypt::decrypt($param);
        return $uid;

    }


    
    public static function settlementByUid($uid)
    {
        
        $promote = PromoteModel::where('from_uid',$uid)->where('status',1)->get()->toArray();
        if(!empty($promote)){
            $realnameUid = array();
            $emailUid = array();
            $payUid = array();
            foreach($promote as $k => $v){
                if($v['finish_conditions'] == 1){
                    $realnameUid[] = $v['to_uid'];
                }
                if($v['finish_conditions'] == 2){
                    $emailUid[] = $v['to_uid'];
                }
                if($v['finish_conditions'] == 3){
                    $payUid[] = $v['to_uid'];
                }
            }
            if(!empty($realnameUid)){
                PromoteModel::getFinishPromoteByUid($uid,$realnameUid,1);
            }
            if(!empty($emailUid)){
                PromoteModel::getFinishPromoteByUid($uid,$emailUid,2);
            }
            if(!empty($payUid)){
                PromoteModel::getFinishPromoteByUid($uid,$payUid,3);
            }
        }else{
            return true;
        }
    }

    
    public static function getFinishPromoteByUid($uid,$toUid,$type)
    {
        switch($type){
            case 1:
                
                $res = RealnameAuthModel::whereIn('uid',$toUid)->where('status',1)->get()->toArray();
                if(!empty($res)){
                    $toUidArr = array();
                    foreach($res as $k => $v){
                        $toUidArr[] = $v['uid'];
                    }
                    if(!empty($toUidArr)){
                        $toUidArr = array_unique($toUid);
                        
                        PromoteModel::getFinishByUid($uid,$toUidArr);
                    }else{
                        return true;
                    }
                }else{
                    return true;
                }
                break;
            case 2:
                
                $res = UserModel::whereIn('id',$toUid)->where('email_status',2)->get()->toArray();
                if(!empty($res)){
                    $toUidArr = array();
                    foreach($res as $k => $v){
                        $toUidArr[] = $v['id'];
                    }
                    if(!empty($toUidArr)){
                        $toUidArr = array_unique($toUid);
                        
                        PromoteModel::getFinishByUid($uid,$toUidArr);
                    }else{
                        return true;
                    }
                }else{
                    return true;
                }
                break;
            case 3:
                
                $res = AuthRecordModel::where('uid',$toUid)->where('status',2)->whereIn('auth_code',['bank','alipay'])->get()->toArray();
                if(!empty($res)){
                    $toUidArr = array();
                    foreach($res as $k => $v){
                        $toUidArr[] = $v['uid'];
                    }
                    if(!empty($toUidArr)){
                        $toUidArr = array_unique($toUid);
                        
                        PromoteModel::getFinishByUid($uid,$toUidArr);
                    }else{
                        return true;
                    }
                }else{
                    return true;
                }
                break;
        }
    }

    
    public static function getFinishByUid($fromUid,$toUid)
    {
        $status = DB::transaction(function() use ($fromUid,$toUid){
            $price = PromoteModel::where('from_uid',$fromUid)->whereIn('to_uid',$toUid)->sum('price');
            
            UserDetailModel::where('uid', $fromUid)->increment('balance', $price);
            
            $financeData = [
                'action' => 14, 
                'pay_type' => 1,
                'cash' => $price,
                'uid' => $fromUid,
                'created_at' => date('Y-m-d H:i:s', time()),
            ];
            FinancialModel::create($financeData);
            $arr = array(
                'status' => 2,
                'updated_at' => date('Y-m-d H:i:s',time())
                );
            PromoteModel::where('from_uid',$fromUid)->whereIn('to_uid',$toUid)
                ->update($arr);
            return true;

        });
        return $status;

    }

    
    public static function createPromote($fromUid,$toUid)
    {
        $promoteType = PromoteTypeModel::where('is_open',1)->where('code_name','ZHUCETUIGUANG')->first();
        if($promoteType){
            $arr = array(
                'from_uid' => $fromUid,//推广人ID
                'to_uid' => $toUid,//被推广人ID
                'price' => $promoteType->price,
                'finish_conditions' => $promoteType->finish_conditions,
                'type' => $promoteType->type,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s',time())
            );
            
            $res = PromoteModel::create($arr);
            return $res;
        }
        return false;
    }

    //
    /**
     * [completePromote 支付成功给推广人添加提成]
     * @param  [type] $uid    [被推广人ID]
     * @param  [type] $method [被推广人激活方式] 1-支付激活  2-激活码激活
     * @param  [type] $type   [激活码的生成方式：1系统生成  2激活生成及被推广人支付激活]
     * @return [type]         [description]
     */
    public static function completePromote($uid,$method = '1',$type = '2')
    {
        //$uid被激活用户的uid
        $promote = PromoteModel::where('to_uid',$uid)->where('status','1')->first();
        if(!$promote) return array('code'=>'200','msg'=>'无推广关系');
        $promoteType = PromoteTypeModel::where('type',$promote['type'])->where('is_open','1')->first();
        if(!$promoteType) return array('code'=>'-2','msg'=>'无效的推广活动');

        //完成推广
        $promote_res = PromoteModel::where('to_uid',$uid)->where('status','1')->update(['status'=>'2']);
        if(!$promote_res) return array('code'=>'-3','msg'=>'网络错误');

        //推广人添加提成
        if($type == 2)
        {
            $promote_price = $promote['price'];
            if($method == 2){
                $promote_price = $promote_price/2;
            }
            
            $u_b_res = UserBalanceModel::addUserBalance($promote_price,$promote['from_uid'],'10');
            if(!$u_b_res) return array('code'=>'-4','msg'=>$u_b_res['msg']);
        }

        //站内信通知推广人
        $username = UserModel::where('id',$promote['from_uid'])->pluck('name');
        $pro_username = UserModel::where('id',$uid)->pluck('name');
        $messageVariableArr = array(
                'username' => $username,
                'pro_username' => $pro_username,
                'reward' => $promote_price,
            );
        $message_res = MessageTemplateModel::sendToUser($promote['from_uid'],'registration_activation',$messageVariableArr);
        if($message_res['code'] != 200) return array('code'=>'-5','msg'=>$message_res['msg']);
        return array('code'=>'200','msg'=>'success');
    }
}