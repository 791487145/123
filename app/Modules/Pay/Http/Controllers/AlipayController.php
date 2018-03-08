<?php
namespace App\Modules\Pay\Http\Controllers;

use App\Http\Controllers\UserCenterController;
use App\Http\Requests;
use App\Modules\Pay\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Omnipay;

class AlipayController extends UserCenterController
{
    
    public function getAlipay()
    {
        $objOminipay = Omnipay::gateway('alipay');
        $siteUrl = \CommonClass::getConfig('site_url');
        $objOminipay->setReturnUrl($siteUrl . '/pay/alipay/return');
        $objOminipay->setNotifyUrl($siteUrl . '/pay/alipay/notify');

        $response = Omnipay::purchase([
            'out_trade_no' => OrderModel::randomCode(), 
            'subject' => \CommonClass::getConfig('site_name'), 
            'total_fee' => '0.01', 
        ])->send();

        $response->redirect();
    }

    
    public function result()
    {
        $gateway = Omnipay::gateway('alipay');

        $options = [
            'request_params' => $_REQUEST,
        ];

        $response = $gateway->completePurchase($options)->send();

        if ($response->isSuccessful() && $response->isTradeStatusOk()) {
            
            exit('支付成功');
        } else {
            
            exit('支付失败');
        }

    }

    
    public function notify()
    {
        $gateway = Omnipay::gateway('alipay');

        $options = [
            'request_params' => $_REQUEST,
        ];

        $response = $gateway->completePurchase($options)->send();

        if ($response->isSuccessful() && $response->isTradeStatusOk()) {
            
            exit('支付成功');
        } else {
            
            exit('支付失败');
        }
    }


}