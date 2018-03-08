<?php

namespace App\Modules\Finance\Model;

use App\Modules\Manage\Model\ConfigModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class FinancialModel extends Model
{

    protected $table = 'financial';

    protected $fillable = [
        'order_code', 'action', 'pay_type', 'pay_account', 'pay_code', 'cash', 'uid', 'created_at'
    ];

    public $timestamps = false;

    const FINANCIAL_TASK = 1;//用户充值
    const RECEIVE_TASK = 2;//接受任务
    const TOP_UP = 3;//用户充值
    const FINANCIAL_STIFF = 4;//用户提现
    const FINANCIAL_BUY_SERVEWR = 5;//购买增值服务
    const FINANCIAL_BUY_SHOP = 6;//购买用户商品

    
    static function createOne($data)
    {
        $model = new FinancialModel();
        $model->action = $data['action'];
        $model->pay_type = isset($data['pay_type'])?$data['pay_type']:'';
        $model->pay_account = isset($data['pay_account'])?$data['pay_account']:'';
        $model->pay_code = isset($data['pay_code'])?$data['pay_code']:'';
        $model->cash = $data['cash'];
        $model->uid = $data['uid'];
        $model->created_at = date('Y-m-d H:i:s', time());
        $result = $model->save();

        return $result;
    }

    static function amountTotalOfToday($uid)
    {
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d",strtotime("+1 day"));
        $earningsOfToday =  self::whereAction(self::RECEIVE_TASK)->whereUid($uid)->where('created_at','>=',$today)->where('created_at','<',$tomorrow)->sum('cash');

        return $earningsOfToday;
    }

    /**返回状态信息
     * @param $state状态码
     * @return string
     */
    static function getStatusCN($state)
    {
        $stateArray = array(
            self::FINANCIAL_TASK=> '发布任务',
            self::RECEIVE_TASK=> '接受任务',
            self::TOP_UP=> '充值',
            self::FINANCIAL_STIFF=> '提现',
            self::FINANCIAL_BUY_SERVEWR=> '购买增值服务',
            self::FINANCIAL_BUY_SHOP=> '购买用户商品',
        );
        return  isset($stateArray[$state]) ? $stateArray[$state] : '';
    }

    
    static function getFees($cash)
    {
        $config = ConfigModel::getConfigByAlias('cash');
        $config->rule = json_decode($config->rule, true);

        if ($cash <= 200){
            $fee = $config->rule['per_low'];
        } elseif ($cash > 200){
            $fee = $cash * ($config->rule['per_charge'] / 100);
            if ($fee > $config->rule['per_high']){
                $fee = $config->rule['per_high'];
            }
        }
        return $fee;
    }

}
