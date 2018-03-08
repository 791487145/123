<?php

namespace App\Modules\Test\Http\Controllers;
use App\Http\Controllers\BasicController;
use App\Http\Requests;
use App\Modules\Test\Model\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;
class TestCallbackController extends  BasicController{

    public function  testCallback(Request $request){




        $accessTokenArr = array(
            'client_id' => $request->get('client_id'),
            'grant_type' => 'authorization_code',
            'redirect_uri' => $request->get('redirect_uri'),
            'code' => $request->get('code'),
            'client_secret' => $request->get('client_secret'),
            'token' =>$request->get('token')
        );
        $accessTokenUrl = Common::KPPWACCESSTOKENURL;
      

        $accessTokenResult= json_decode(Common::sendPostRequest($accessTokenUrl,$accessTokenArr),true);
        dd($accessTokenResult);




    }

}