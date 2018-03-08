<?php

namespace App\Modules\Wechat\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function wechat()
    {
        $wechat = app('wechat');
        
        $wechatServer = $wechat->server;

        return $wechatServer->serve();
    }


}
