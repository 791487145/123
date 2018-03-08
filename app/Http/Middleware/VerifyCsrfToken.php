<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    
    protected $except = [
        

        'order/pay/alipay/notify',
        'order/pay/wechat/notify',

        
        'api/*'
    ];
}
