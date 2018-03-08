<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Modules\Manage\Model\SjlmGoodsModel;
use App\Modules\User\Model\UserBalanceModel;

class UserSjlmGoodsModel extends Model
{
    
    protected $table = 'user_sjlm_goods';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','uid','goods_id','amount','created_at','updated_at','kind'
    ];

    public $timestamps = true;

    //method 获取途径：1-签到  2-礼品兑换  3-系统任务  4-偶发事件
    static function addUserGoods($uid,$goods_id,$amount,$sign_record_id = "",$action = "8",$method = "1")
    {
        $goods = SjlmGoodsModel::where('id',$goods_id)->first();//goods.ability为9时是金币  为18时是余额
        if($goods->ability == 9)
        {
            //金币添加用户金币
            $u_s_b_res = UserBalanceModel::addUserGold($goods['gold'],$uid,$sign_record_id,$method);
            if($u_s_b_res['code'] == 200) return true;
        }elseif($goods->ability == 18){
            //用户添加余额
            $u_s_b_res = UserBalanceModel::addUserBalance($goods['price'],$uid,$action);
            if($u_s_b_res['code'] == 200) return true;
        }else{
            //实物或者道具添加用户物品
            $user_goods = self::where('uid',$uid)->where('goods_id',$goods_id)->first();
            if(count($user_goods)){
                $amount = $user_goods->amount + $amount;
                $u_s_g_res = self::where('uid',$uid)->where('goods_id',$goods_id)->update(['amount'=>$amount]);
            }else{
                $data = array(
                        'uid' => $uid,
                        'goods_id' => $goods_id,
                        'kind' => $goods->kind,
                        'amount' => $amount
                    );
                $u_s_g_res = self::create($data);
            }
            if($u_s_g_res) return true;
        }
        return false;
    }
}
