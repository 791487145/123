<?php

namespace App\Modules\User\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;
use App\Modules\Manage\Model\UserGoldRecordModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\Finance\Model\FinancialModel;
use Illuminate\Support\Facades\Redis;

class UserBalanceModel extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    
    protected $table = 'user_balance';
    public $timestamps = false;
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'user_id', 'balance','grade','act_value','gold','hunter_grade','hunt_value','employer_grade',
        'emp_value','create_task_num','work_task_num','balance_status','contigency_completed','contigency_created',
        'get_contigency_created','get_contigency_completed','balance_freeze'
    ];

    static function findByUid($id)
    {
        $data = self::where('user_id',$id)->where('balance_status',1)->first();
        return $data;
    }

    
    //protected $hidden = ['password', 'remember_token'];
    

    /**
     * 用户添加余额及余额记录
     * @param [type] $amount         添加的余额
     * @param [type] $action         获取途径 ：1-发布任务 2-接受任务 3-用户充值 4-用户提现 5-购买增值服务 6-购买用户商品 7-任务失败退款 8-系统任务（历练）收入  9-系统任务换一换支付 10-推广用户获取提成 11-管理后台操作增加  12-管理后台操作减少  13-维权扣除猎人金额  14-获取回家路费
     * @param [type] $uid            用户ID
     * @param [type] $add            标志增加或减少：1-增加 2-减少
     */
    static function addUserBalance($amount,$uid,$action,$add = '1',$paypassword = "")
    {
        //用户增加余额
        if($add == '1'){
            $u_b_res = self::where('user_id',$uid)->increment('balance',$amount);
            Redis::zincrby('userFinancialTopUpSort',$amount,$uid);
        }elseif($add == '2'){
            //验证支付密码
            // $user_detail = UserDetailModel::where('uid',$uid)->select('pay_code')->first();
            // if($user_detail['pay_code'] == $paypassword){
            //     $u_b_res = self::where('user_id',$uid)->decrement('balance',$amount);
            //     Redis::zincrby('userFinancialSaleSort',$amount,$uid);
            // }else{
            //     return array('code'=>'-1','msg'=>'支付密码有误，请检查');
            // }
            $user_detail = UserDetailModel::where('uid',$uid)->select('pay_code')->first();
            $u_b_res = self::where('user_id',$uid)->decrement('balance',$amount);
            $amount = '-'.$amount;
            Redis::zincrby('userFinancialSaleSort',$amount,$uid);
        }else{
            return array('code'=>'-2','msg'=>'不要搞笑');
        }
        if(!$u_b_res) return array('code'=>'-3','msg'=>'网络错误');
        //添加余额变动记录
        $f_res = FinancialModel::create(array('uid'=>$uid,'action'=>$action,'cash'=>$amount,'created_at'=>date('Y-m-d H:i:s')));
        if(!$f_res) return array('code'=>'-4','msg'=>'网络错误');
        return array('code'=>'200','msg'=>'success');
    }

    /**
     * 用户添加金币及金币记录
     * @param [type] $gold           添加的金币数量
     * @param [type] $uid            用户ID
     * @param [type] $method         获取途径：1-签到  2-礼品兑换  3-系统任务  4-偶发事件  5-后台系统更改 
     * @param [type] $add            标志增加或减少：1-增加 2-减少
     * @param string $sign_record_id 如果是签到获取金币，填写签到记录ID
     */
    static function addUserGold($gold,$uid,$sign_record_id='',$method="1",$add="1")
    {
        $data2 = array(
                'uid' => $uid,
                'gold' => $gold,
                'method' => $method
            );
        if($add == "1"){
            $u_b_res = self::where('user_id',$uid)->increment('gold',$gold); 
            $data2['crement'] = "1";   
        }elseif($add == "2"){
            $u_b_res = self::where('user_id',$uid)->decrement('gold',$gold);
            $gold = '-'.$gold;
            $data2['crement'] = "2";
        }else{
            return array('code'=>'-1','msg'=>'无效的修改');
        }
        if(!$u_b_res) return array('code'=>'-2','msg'=>'网络错误');

        Redis::zincrby('userGoldSort',$gold,$uid);

        if($sign_record_id) $data2['sign_record_id'] =  $sign_record_id;
        $u_g_r_res = UserGoldRecordModel::create($data2);
        if(!$u_g_r_res) return array('code'=>'-3','msg'=>'网络错误');
        return array('code'=>'200','msg'=>'添加成功');
    }

    /**
     * 添加偶发事件发布任务数量
     * @param  [type] $uid    [description]
     * @param  [type] $amount [description]
     * @return [type]         [description]
     */
    static function contigencyCreated($uid,$amount)
    {
        $u_b_res = self::where('user_id',$uid)->increment('contigency_created',$amount);
        if($u_b_res) return true;
        return false;
    }
    /**
     * 添加偶发事件完成任务数量
     * @param  [type] $uid    [description]
     * @param  [type] $amount [description]
     * @param  [type] $action :1-添加数量  2-减少数量
     * @return [type]         [description]
     */
    static function contigencyCompleted($uid,$amount,$action="1")
    {
        if($action == '1'){
            $u_b_res = self::where('user_id',$uid)->increment('contigency_completed',$amount);    
        }elseif($action == '2'){
            $u_b_res = self::where('user_id',$uid)->decrement('contigency_completed',$amount);
        }else{
            return false;
        }
        if($u_b_res) return true;
        return false;
    }

    /**
     * 开始新的一轮偶发事件触发计数：发布任务
     * @param  [type] $uid    [description]
     * @param  [type] $number [description]
     * @return [type]         [description]
     */
    static function changeCreatedNum($uid,$number)
    {
        $u_b_res = self::where('user_id',$uid)->update(['get_contigency_created'=>$number,'contigency_created'=>'0']);
        if($u_b_res) {
            //发送站内信？？不用
            return true;
        }
        return false;
    }

    /**
     * 开始新的一轮偶发事件触发计数：完成任务
     * @param  [type] $uid    [description]
     * @param  [type] $number [description]
     * @return [type]         [description]
     */
    static function changeCompletedNum($uid,$number)
    {
        $u_b_res = self::where('user_id',$uid)->update(['get_contigency_completed'=>$number,'contigency_completed'=>'0']);
        if($u_b_res) return true;
        return false;
    }
}
