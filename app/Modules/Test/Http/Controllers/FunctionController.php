<?php
namespace App\Modules\Test\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Config;
use Validator;
use Toplan\PhpSms\Sms;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Manage\Model\FunctionModel;
use App\Modules\User\Model\UserModel;
use Cache;
use DB;
use Socialite;
use Auth;
use Log;

class FunctionController extends ApiBaseController
{
    public function getList(Request $request)
    {
        if(!$request->get('token')){
            return $this->formateResponse(1001,'请先登录');
        }
        $list = FunctionModel::where('status','valid')->get();
        if(!empty($list)){
            $list = $list->toArray();
            return $this->formateResponse(1000,'success',$list);
        } 
        else{
            return $this->formateResponse(1001,'暂无可用功能');
        }
    }

    public function setUserFunction(Request $request)
    {
        if(!$request->get('token')){
            return $this->formateResponse(1001,'请先登录');
        }
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $mobile = $tokenInfo['mobile'];
        $function_arr = $request->fun_arr;
        $use_res = UserModel::where('mobile',$mobile)->update(['function_order'=>$function_arr]);
        if($use_res){
            return $this->formateResponse(1000,'success');
        }
        else{
            return $this->formateResponse(1001,'网络错误');
        }
    }
}
