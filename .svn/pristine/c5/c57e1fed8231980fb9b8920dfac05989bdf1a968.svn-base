<?php
namespace App\Modules\Mobile\Http\Controllers;

use App\Http\Requests;
use App\Modules\Finance\Model\CashoutModel;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\UserGoldRecordModel;
use App\Modules\User\Model\AlipayAuthModel;
use App\Modules\User\Model\RealnameAuthModel;
use App\Modules\User\Model\UserBalanceModel;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Config;
use App\Modules\Manage\Model\ConfigModel;
use Validator;
use Toplan\PhpSms\Sms;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Manage\Model\AddressModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\Task\Model\DistrictRegionModel;
use App\Modules\User\Model\UserModel;
use Cache;
use DB;
use Socialite;
use Auth;
use Log;
use Illuminate\Support\Facades\Redis;

class PurseController extends ApiBaseController
{
    protected $uid;

    public function __construct(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $this->uid = $tokenInfo['uid'];
        $this->school = $tokenInfo['school'];
        $this->username = $tokenInfo['name'];
        $this->mobile = $tokenInfo['mobile'];

    }

    /**我的钱包首页（get:/fincial/myPurse）
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function myPurse(Request $request)
    {
        //余额
        $data['balance_today'] = FinancialModel::amountTotalOfToday($this->uid);
        $data['balance_amount'] =  Redis::ZSCORE('userFinancialSort',$this->uid);
        //金币
        $data['gold_today'] = UserGoldRecordModel::amountGoldOfUserToday($this->uid);
        $data['gold_amount'] =  Redis::ZSCORE('userGoldSort',$this->uid);
        //我的余额
        $data['my_purse'] = UserBalanceModel::where('user_id',$this->uid)->pluck('balance');

        return $this->formateResponse(1000, 'success', $data);
    }


    /**提现记录(post:/fincial/stiffLog)
     * @param Request $request
     * @param pageNuw
     * @param limit
     * @return \Illuminate\Http\Response
     */
    public function stiffLog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pageNuw' => 'required',
            'limit' => 'required|min:1',

        ],[
            'pageNuw.required' => '输入页数',
            'limit.required' => '输入每页显示数量',
            'limit.min' => '至少每页显示1条数据',
        ]);
        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }
        $limit = $request->input('limit');
        $pageNum = $request->input('pageNuw',1);
        $offset = $limit * ($pageNum - 1);

        $stillLogs = FinancialModel::whereUid($this->uid)->whereAction(4)->select('cash','created_at','id')->orderBy('id','desc')->limit($limit)->offset($offset)->get();

        if($stillLogs->isEmpty()){
            return $this->formateResponse(2000, '暂无数据');
        }

        if(!$stillLogs->isEmpty()){
            $stillLogs = $stillLogs->toArray();
        }

        return $this->formateResponse(1000, 'success', $stillLogs);
    }


    /*
     *  提现申请
     * @param Request $request
     * @param token
     * */
    public function getWithdrawal(Request $request)
    {
        //查询实名认证是否已认证
        $realname_auth = RealnameAuthModel::whereUid($this->uid)->select('status')->first();
        if($realname_auth == null || $realname_auth->status != 1){
            return $this->formateResponse(1001, '请先实名认证');
        }
        //查询支付宝是否已绑定
        $alipay_auth = AlipayAuthModel::whereUid($this->uid)->select('status')->first();
        if($alipay_auth == null || $alipay_auth->status != 2){
            return $this->formateResponse(1001, '请先绑定支付宝');
        }
        //查询余额
        $balance = UserBalanceModel::where('user_id',$this->uid)->select('balance')->first();
        //查询提现配置
        $cashInfo = ConfigModel::getConfigByAlias('cash')->toArray();
        $cash = json_decode($cashInfo['rule'], true);
        $data = [
            'balance' => $balance['balance'],
            'withdraw_min'  =>  $cash['withdraw_min'],//最低提现金额
            'per_charge'  =>  $cash['per_charge'],  //提现百分比
            'per_low'   =>  $cash['per_low'],   //最低提现费
            'per_high'  =>  $cash['per_high'],  //最高提现费
        ];

        return $this->formateResponse(1000, '成功',$data);

    }

    /*
     * 提现
     * @param cash
     * @param cashout_type
     * */
    public function postWithdrawal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cash' => 'required',
         ],[
            'cash.required' => '输入提现金额',
        ]);
        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }
        //查询实名认证是否已认证
        $realname_auth = RealnameAuthModel::whereUid($this->uid)->select('status')->first();
        if($realname_auth == null || $realname_auth->status != 1){
            return $this->formateResponse(1001, '请先实名认证');
        }

        //查询支付宝是否已绑定
        $alipay_auth = AlipayAuthModel::whereUid($this->uid)->select('alipay_account','status')->first();
        if($alipay_auth == null || $alipay_auth->status != 2){
            return $this->formateResponse(1001, '请先绑定支付宝');
        }

        //查询提现配置
        $cashInfo = ConfigModel::getConfigByAlias('cash')->toArray();
        $cash = json_decode($cashInfo['rule'], true);
        //如果提现金额小于最小提现金额的话拒绝提现
        if($request->get('cash') < $cash['withdraw_min']){
            return $this->formateResponse(1000, '提现金额不能小于'.$cash['withdraw_min'].'元');
        }

        $cash['cash'] = $request->get('cash');
        $cash['alipay_account'] = $alipay_auth->alipay_account;
        $info = CashoutModel::createCashoutRecord($cash,$this->uid);
        if($info){
            return $this->formateResponse(1000,'提交成功，请耐心等待');
        }else{
            return $this->formateResponse(1001,'网络错误，请稍候重试');
        }

    }



}
