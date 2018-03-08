<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Config;
use Cache;
use Illuminate\Support\Facades\Crypt;
use Log;
use App\Modules\User\Model\UserModel;

class WebAutho
{
    
    public function handle(Request $request, Closure $next)
    {

        if (empty($request->get('token'))) {
            return $this->formateResponse(1011,'请先登录！');
        } else {
            //代码注释不要删！不要删！不要删。。。

            $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
            // if ( is_array($tokenInfo) && isset($tokenInfo['uid']) && isset($tokenInfo['name']) && isset($tokenInfo['akey']) && isset($tokenInfo['expire'] )) {
            if ( is_array($tokenInfo) && isset($tokenInfo['uid']) && isset($tokenInfo['name']) && isset($tokenInfo['akey'])) {
                $akey = md5(Config::get('app.key'));

                // if(!isset($tokenInfo['uuid'])){
                //     return $this->formateResponse(1013,'登录过期,请重新登录！');
                // }

                $last_login_uuid = UserModel::where('id',$tokenInfo['uid'])->pluck('last_login_uuid');

                $cache = Cache::get('a'.$tokenInfo['uid']);
                //dd($cache);
                // if ( $tokenInfo['expire'] > time() && $akey == $tokenInfo['akey'] && Cache::get($tokenInfo['uid'])) {
                // if ($akey == $tokenInfo['akey'] && $cache && $cache['token'] == $request->get('token') && $tokenInfo['uuid'] == $last_login_uuid) {
                if ($akey == $tokenInfo['akey'] && $cache && $cache['token'] == $request->get('token')) {
                    Cache::put('a'.$tokenInfo['uid'],$cache,28800*60);
                    return $next($request);
                } else {
                    return $this->formateResponse(1013,'登录过期,请重新登录！');
                }
            } else {
                
                return $this->formateResponse(1012,'不合法的token！');
            }
        }

    }

    
    public function formateResponse($code=1000, $message='success', $data=null, $statusCode=200){
        $result['code'] = $code;
        $result['message'] = $message;
        if (isset($data)) {
            $result['data'] = is_array($data) ? $data : json_decode($data,true);
        }
        return new Response($result,$statusCode);
    }

}
