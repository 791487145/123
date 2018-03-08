<?php

namespace App\Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Crypt;
use Validator;
use DB;
use Omnipay;

class AlipayController extends ApiBaseController
{

    public function pay(){

        $gateway = Omnipay::gateway('alipay');

        $options = [
            'out_trade_no' => date('YmdHis') . mt_rand(1000,9999),
            'subject' => 'Alipay Test',
            'total_fee' => '0.01',
        ];

        $response = $gateway->purchase($options)->send();
        $response->redirect();

       /* $options = [
            'out_trade_no' => date('YmdHis') . mt_rand(1000,9999),  // 订单号
            'subject' => 'Alipay Test',   // 商品名称
            'total_fee' => '0.01',  // 订单支付金额
        ];
        $gateway = Omnipay::gateway();  //获取支付网关
        $response = $gateway->purchase($options)->send();
        $response->redirect();    // 直接跳转到支付宝支付*/
    }


}