<?php
namespace App\Modules\Finance\Http\Controllers;

use App\Modules\Finance\Http\Requests\CashoutInfoRequest;
use App\Modules\Finance\Http\Requests\CashoutRequest;
use App\Modules\Finance\Http\Requests\PayRequest;
use App\Modules\Finance\Model\CashoutModel;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\ServiceModel;
use App\Modules\Order\Model\OrderModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsServiceModel;
use App\Modules\User\Http\Controllers\UserCenterController;
use App\Modules\User\Model\AlipayAuthModel;
use App\Modules\User\Model\BankAuthModel;
use App\Modules\User\Model\PromoteModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Omnipay;
Use QrCode;
use File;

class PayController extends UserCenterController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('userfinance');

    }

    //充值页面
    public function getCash()
    {
        $this->theme->setTitle('我要充值');
        $user = Auth::User();
        $userInfo = UserDetailModel::select('balance')->where('uid', $user->id)->first();

        $payConfig = ConfigModel::getConfigByType('thirdpay');
        $cashConfig = ConfigModel::getConfigByAlias('cash');
        if (!empty($userInfo)){
            $data = array(
                'balance' => $userInfo->balance,
                'payConfig' => $payConfig,
                'recharge_min' => json_decode($cashConfig->rule,true)['recharge_min']
            );

            return $this->theme->scope('finance.cash', $data)->render();
        }
    }

    //充值接口
    public function postCash(PayRequest $request)
    {
        $user = Auth::User();
        $config = ConfigModel::getConfigByAlias('cash');
        $config->rule = json_decode($config->rule, true);
        if ($request->get('cash') < $config->rule['recharge_min']) {
            return \CommonClass::formatResponse('充值金额不得小于' . $config->rule['recharge_min'] . '元', 201);
        }
        $data = array(
            'code' => OrderModel::randomCode($user->id),
            'title' => '余额充值',
            'cash' => $request->get('cash'),
            'uid' => $user->id,
            'created_at' => date('Y-m-d H:i:s', time())
        );
        $order = OrderModel::create($data);

        if ($order) {
            $payType = $request->get('pay_type');

            switch ($payType) {
                case 'alipay':
                    $config = ConfigModel::getPayConfig('alipay');
                    $objOminipay = Omnipay::gateway('alipay');
                    $objOminipay->setPartner($config['partner']);
                    $objOminipay->setKey($config['key']);
                    $objOminipay->setSellerEmail($config['sellerEmail']);
                    $objOminipay->setReturnUrl(env('ALIPAY_RETURN_URL', url('/order/pay/alipay/return')));
                    $objOminipay->setNotifyUrl(env('ALIPAY_NOTIFY_URL', url('/order/pay/alipay/notify')));
                    $response = Omnipay::purchase([
                        'out_trade_no' => $order->code, 
                        'subject' => \CommonClass::getConfig('site_name') . '余额充值', 
                        'total_fee' => $order->cash, 
                    ])->send();
                    return \CommonClass::formatResponse('确认充值', 200, array('url' => $response->getRedirectUrl(), 'orderCode' => Crypt::encrypt($order->code)));
                    break;
                case 'wechat':
                    return \CommonClass::formatResponse('确认充值', 200, array('url' => '/finance/wechatPay/' . Crypt::encrypt($order), 'orderCode' => Crypt::encrypt($order->code)));
                    break;
                case 'unionbank':
                    
                    break;
            }
        }
    }

    //微信充值接口
    public function getWechatPay($order)
    {
        $this->theme->setTitle('我要充值');
        $order = Crypt::decrypt($order);
        if ($order) {
            $config = ConfigModel::getPayConfig('wechatpay');
            $wechat = Omnipay::gateway('wechat');
            $wechat->setAppId($config['appId']);
            $wechat->setMchId($config['mchId']);
            $wechat->setAppKey($config['appKey']);
            $params = array(
                'out_trade_no' => $order->code, 
                'notify_url' => env('WECHAT_NOTIFY_URL', url('order/pay/wechat/notify')), 
                'body' => \CommonClass::getConfig('site_name') . '余额充值', 
                'total_fee' => $order->cash, 
                'fee_type' => 'CNY', 
            );
            $response = $wechat->purchase($params)->send();

            $img = QrCode::size('280')->generate($response->getRedirectUrl()); 
            $view = array(
                'cash' => $order->cash,
                'img' => $img
            );
            return $this->theme->scope('pay.wechatpay', $view)->render();
        }

    }


    
    public function verifyOrder($orderCode)
    {
        $orderCode = Crypt::decrypt($orderCode);

        $orderInfo = OrderModel::where('code', $orderCode)->first();

        if (!empty($orderInfo) && $orderInfo->status) {
            return \CommonClass::formatResponse('success', 200, array('url' => 'cash'));
        }
        return \CommonClass::formatResponse('fail');
    }

    
    public function getCashout()
    {
        $this->theme->setTitle('我要提现');
        $user = Auth::User();
        $userInfo = UserDetailModel::select('balance')->where('uid', $user->id)->first();
        $cashRule = json_decode(ConfigModel::getConfigByAlias('cash')->rule, true);
        
        $alipayAccount = AlipayAuthModel::where('uid', $user->id)->where('status', 2)->orderBy('auth_time', 'desc')->get();
        $bankAccount = BankAuthModel::where('uid', $user->id)->where('status', 2)->orderBy('auth_time', 'desc')->get();
        $data = array(
            'balance' => $userInfo->balance,
            'alipayAccount' => $alipayAccount,
            'bankAccount' => $bankAccount,
            'cashRule' => $cashRule
        );
        return $this->theme->scope('finance.cashout', $data)->render();
    }

    
    public function postCashout(CashoutRequest $request)
    {
        $user = Auth::User();
        $userInfo = UserDetailModel::select('balance')->where('uid', $user->id)->first();
        
        $cashConfig = ConfigModel::getConfigByAlias('cash');
        $cashConfig->rule = json_decode($cashConfig->rule, true);

        $now = strtotime(date('Y-m-d'));
        $start = date('Y-m-d H:i:s', $now);
        $end = date('Y-m-d H:i:s', $now + 24 * 3600);
        
        $cashoutSum = CashoutModel::where('uid', $user->id)->whereBetween('created_at', [$start, $end])->sum('cash');

        $error = array();
        if ($request->get('cash') > $userInfo->balance) {
            $error['cash'] = '提现金额不得大于账户余额';
        }
        if ($cashConfig->rule['withdraw_min'] && $request->get('cash') < $cashConfig->rule['withdraw_min']) {
            $error['cash'] = '单笔提现金额不得小于' . $cashConfig->rule['withdraw_min'] . '元';
        }
        if ($cashConfig->rule['withdraw_max'] && ($cashoutSum + $request->get('cash')) > $cashConfig->rule['withdraw_max']) {
            $error['cash'] = '提现金额不得大于' . $cashConfig->rule['withdraw_max'] . '元';
        }
        if (!empty($error)) {
            return back()->withErrors($error);
        }
        $account = $request->get('cashout_account');
        $alipayInfo = AlipayAuthModel::where('alipay_account', $account)->where('status', 2)->first();
        $bankInfo = BankAuthModel::where('bank_account', $account)->where('status', 2)->first();

        if (!empty($alipayInfo) || !empty($bankInfo)) {
            if (!empty($alipayInfo)) {
                $cashout_type = 1;
                $account_name = $alipayInfo->alipay_name;
            } elseif (!empty($bankInfo)) {
                $cashout_type = 2;
                $account_name = $bankInfo->realname;
            }
            $data = array(
                'cashout_type' => $cashout_type,
                'cashout_account' => $account,
                'cash' => $request->get('cash'),
                'account_name' => $account_name
            );
            return redirect('finance/cashoutInfo/' . Crypt::encrypt($data));
        }

    }


    
    public function getCashoutInfo($cashoutInfo)
    {
        $cashoutInfo = Crypt::decrypt($cashoutInfo);

        $user = Auth::User();
        $userInfo = UserDetailModel::select('balance')->where('uid', $user->id)->first();

        $is_bank = BankAuthModel::select('bank_name')
            ->where(['bank_account' => $cashoutInfo['cashout_account'], 'status' => 2])->first();
        $data = array(
            'balance' => $userInfo->balance,
            'cashout_type' => $cashoutInfo['cashout_type'],
            'cashout_account' => $cashoutInfo['cashout_account'],
            'cash' => $cashoutInfo['cash'],
            'account_name' => $cashoutInfo['account_name'],
            'fees' => FinancialModel::getFees($cashoutInfo['cash']),
            'cashoutInfo' => Crypt::encrypt($cashoutInfo),
            'bank_name' => !empty($is_bank) ? $is_bank->bank_name : 'alipay'
        );

        return $this->theme->scope('finance.cashoutinfo', $data)->render();
    }

    
    public function postCashoutInfo(CashoutInfoRequest $request)
    {
        $alternate_password = $request->get('alternate_password');
        $cashoutInfo = Crypt::decrypt($request->get('cashInfo'));
        $user = Auth::User();
        if (UserModel::encryptPassword($alternate_password, $user->salt) === $user->alternate_password) {
            $data = array(
                'uid' => $user->id,
                'cash' => $cashoutInfo['cash'],
                'fees' => FinancialModel::getFees($cashoutInfo['cash']),
                'real_cash' => $cashoutInfo['cash'] - FinancialModel::getFees($cashoutInfo['cash']),
                'cashout_type' => $cashoutInfo['cashout_type'],
                'cashout_account' => $cashoutInfo['cashout_account'],
            );
            $status = CashoutModel::addCashout($data);

            if ($status)
                return redirect('finance/waitcashout');
        }
        return back()->withErrors(array('alternate_password' => '提现密码错误'));
    }

    
    public function waitCashout()
    {
        return $this->theme->scope('finance.waitcashout')->render();
    }

    
    public function getFinanceList(Request $request)
    {
        $user = Auth::User();

        
        PromoteModel::settlementByUid($user->id);

        if ($request->get('type')){
            switch ($request->get('type')){
                case 'cash':
                    $list = FinancialModel::where('uid', $user->id)->where('action', 3)->orderBy('created_at', 'desc')->paginate(10);
                    break;
                case 'cashout':
                    $list = CashoutModel::where('uid', $user->id)->orderBy('created_at', 'desc')->paginate(10);
                    break;
            }
        } else {
            $list = FinancialModel::where('uid', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        }
        $userDetail = UserDetailModel::select('balance')->where('uid', $user->id)->first();
        $data = [
            'balance' => $userDetail->balance,
            'list' => $list,
            'type' => $request->get('type') ? $request->get('type') : ''
        ];

        $this->initTheme('usercenterfinance');
        $this->theme->setTitle('收支明细');
        return $this->theme->scope('finance.financelist', $data)->render();
    }


    
    public function assetdetail(Request $request)
    {

        $user = Auth::User();
        $balance = UserDetailModel::where('uid', $user->id)->first()->balance;
        $list = FinancialModel::where('uid', $user->id);

        $cashIn = FinancialModel::where('uid', $user->id)->whereIn('action', [2, 3, 7, 8])->sum('cash');
        $cashOut = FinancialModel::where('uid', $user->id)->whereIn('action', [1, 4, 5, 6])->sum('cash');

        if ($request->get('start')) {
            $start = date('Y-m-d H:i:s', strtotime($request->get('start')));
            $list = $list->where('created_at', '>', $start);
        }
        if ($request->get('end')) {
            $end = date('Y-m-d H:i:s', strtotime($request->get('end')));
            $list = $list->where('created_at', '<', $end);
        }
        if ($request->get('type')) {
            $list = $list->where('action', $request->get('type'));
        }
        $list = $list->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'balance' => $balance,
            'list' => $list,
            'cashIn' => $cashIn,
            'cashOut' => $cashOut,
            'start' => $request->get('start'),
            'end' => $request->get('end'),
            'type' => $request->get('type'),
            'merge' => $request->all()
        ];
        $this->initTheme('userfinance');
        $this->theme->setTitle('资产明细');
        return $this->theme->scope('finance.assetdetail', $data)->render();
    }

    
    public function assetDetailminute($id)
    {

        $user = Auth::User();
        $avatar = UserDetailModel::where('uid', $user->id)->first()->avatar;
        $info = FinancialModel::where('uid', $user->id)->where('id', $id)->first();
        if (!empty($info)) {

            $data = [
                'info' => $info,
                'avatar' => $avatar
            ];

            $this->initTheme('userfinance');
            $this->theme->setTitle('收支详情');
            return $this->theme->scope('finance.assetDetailminute', $data)->render();
        }

    }

    
    public function getpay($id)
    {
        $uid = Auth::id();
        
        $userInfo = UserDetailModel::select('balance')->where('uid', $uid)->first();

        $payConfig = ConfigModel::getConfigByType('thirdpay');
        foreach ($payConfig as $k => $v){
            if ($v['status']){
                $pay[$k] = 1;
            }
        }
        
        $isOpenArr = ServiceModel::where('identify','ZUOPINTUIJIAN')->first();
        if(!empty($isOpenArr) && $isOpenArr->status == 1){
            $cash = $isOpenArr->price;
        }else{
            return redirect()->back()->with(array('message' => '没有开启该服务'));
        }

        $data = [
            'service_cash' => $cash,
            'pay_config' => $pay,
            'balance' => $userInfo->balance,
            'good_id' => $id
        ];
        $this->theme->setTitle('购买增值服务');
        return $this->theme->scope('finance.getpay', $data)->render();
    }

    
    public function balancePayment(Request $request)
    {
        if ($request->get('password')){
            $user = UserModel::find(Auth::id());
            $pwd = UserModel::encryptPassword($request->get('password'), $user->salt);

            if ($pwd == $user->alternate_password){
                $good_id = $request->get('good_id');
                
                $status = ShopOrderModel::buyShopService($good_id);
                if ($status){
                    return redirect('user/waitGoodsHandle/'.$good_id);
                }
            } else {
                return back()->withErrors(['password' => '请输入正确的支付密码']);
            }
        }
    }


    
    public function thirdPayment(Request $request)
    {
        $payType = $request->get('pay_type');
        $goodId = $request->get('good_id');
        
        $isOpenArr = ServiceModel::where('identify','ZUOPINTUIJIAN')->first();
        if(!empty($isOpenArr) && $isOpenArr->status == 1){
            $cash = $isOpenArr->price;
        }else{
            $cash = '';
        }
        
        $serviceGoodsId = GoodsServiceModel::insertGetId(['service_id' => $isOpenArr->id, 'goods_id' => $goodId]);
        
        $data = [
            'code' => ShopOrderModel::randomCode(Auth::id(), 'pg'),
            'title' => '购买商品推荐增值服务',
            'uid' => Auth::id(),
            'object_id' => $serviceGoodsId,
            'object_type' => 3,
            'cash' => $cash,
            'status' => 0,
            'created_at' => date('Y-m-d H:i:s',time())
        ];
        $shop = ShopOrderModel::create($data);



        switch ($payType){
            case 'alipay':
                $config = ConfigModel::getPayConfig('alipay');
                $objOminipay = Omnipay::gateway('alipay');
                $objOminipay->setPartner($config['partner']);
                $objOminipay->setKey($config['key']);
                $objOminipay->setSellerEmail($config['sellerEmail']);
                $objOminipay->setReturnUrl(env('ALIPAY_RETURN_URL', url('/order/pay/alipay/return')));
                $objOminipay->setNotifyUrl(env('ALIPAY_NOTIFY_URL', url('/order/pay/alipay/notify')));
                $response = Omnipay::purchase([
                    'out_trade_no' => $shop->code, 
                    'subject' => \CommonClass::getConfig('site_name'), 
                    'total_fee' => $shop->cash, 
                ])->send();

                $response->redirect();
                break;
            case 'wechatpay':
                $config = ConfigModel::getPayConfig('wechatpay');
                $wechat = Omnipay::gateway('wechat');
                $wechat->setAppId($config['appId']);
                $wechat->setMchId($config['mchId']);
                $wechat->setAppKey($config['appKey']);
                $params = array(
                    'out_trade_no' => $shop->code, 
                    'notify_url' => env('WECHAT_NOTIFY_URL', url('order/pay/wechat/notify')), 
                    'body' => \CommonClass::getConfig('site_name') . '余额充值', 
                    'total_fee' => $shop->cash, 
                    'fee_type' => 'CNY', 
                );
                $response = $wechat->purchase($params)->send();

                $img = QrCode::size('280')->generate($response->getRedirectUrl());
                $view = array(
                    'cash' => $shop->cash,
                    'img' => $img
                );
                return $this->theme->scope('pay.wechatpay', $view)->render();
                break;
        }

    }




    

    public function shopsuccess($id)
    {
        $data = array(
            'id' => $id
        );
        return $this->theme->scope('finance.shopsuccess', $data)->render();
    }
}
