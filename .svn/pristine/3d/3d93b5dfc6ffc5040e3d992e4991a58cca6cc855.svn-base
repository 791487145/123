<?php
namespace App\Modules\Api\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Config;
use Validator;
use Toplan\PhpSms\Sms;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\GoodsExchangeCodeModel;
use App\Modules\Manage\Model\UserSjlmGoodsGetRecordModel;
use App\Modules\Manage\Model\UserSjlmGoodsUseRecordModel;
use App\Modules\Manage\Model\SjlmGoodsModel;
use App\Modules\Manage\Model\UserSjlmGoodsModel;
use App\Modules\User\Model\UserModel;
use App\Modules\Manage\Model\AddressModel;
use Cache;
use DB;
use Socialite;
use Auth;
use Log;

class GiftController extends ApiBaseController
{
    public function __construct()
    {
        //物品获取路径  1-随机任务  2-礼物兑换  3-签到
        $this->method = array('1'=>'随机任务','2'=>'礼物兑换','3'=>'签到');
        //运费 1-到付 2-包邮
        $this->is_free = array('1'=>'到付','2'=>'包邮');
        //订单状态  1-已投递，待发货  2-已发货
        $this->order_status = array('1'=>'待发货','2'=>'已发货');
    }

    public function giftExchange(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'token' => 'required',
            'code' => 'required'
        ],[
            'token.required' => '请登录',
            'code.required' => '参数缺失：code'
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0]);
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        //验证兑换码
        $exchange_code = GoodsExchangeCodeModel::where('code',$request->get('code'))->where('is_valid','valid')->first();
        if(!empty($exchange_code)){
            DB::beginTransaction();
            //验证码失效处理
            $exchange_code_res = GoodsExchangeCodeModel::where('code',$request->get('code'))->update(['is_valid'=>'Invalid']);
            if(!$exchange_code_res){
                DB::rollBack();return '111';
                $this->formateResponse(1001,'网络错误');
            }
            $sign = substr($request->get('code'), -1);
            $maybe_goods = SjlmGoodsModel::where('sign',$sign)->select('id')->get();
            if(empty($maybe_goods)){
                DB::rollBack();
                return $this->formateResponse(1001,'兑换类型错误');
            }
            $maybe_goods = $maybe_goods->toArray();
            $maybe_goods = array_flatten($maybe_goods);
            $key = array_rand($maybe_goods,1);
            $goods_id = $maybe_goods[$key];
            $goods_detail = SjlmGoodsModel::where('id',$goods_id)->first()->toArray();
            //添加用户物品表
            $u_s_g_res = UserSjlmGoodsModel::addUserGoods($tokenInfo['uid'],$goods_id,$exchange_code->amount,"","8","2");
            if(!$u_s_g_res){
                DB::rollBack();return '222';
                return $this->formateResponse(1001,'网络错误');
            }
            //添加用户礼品获取记录
            $data2 = array(
                    'uid' => $tokenInfo['uid'],
                    'goods_id' => $goods_id,
                    'kind' => $goods_detail['kind'],
                    // 'amount' => $exchange_code->amount,
                    'source' => 2,
                );
            if($goods_id == 9){
                $data2['amount'] = $goods_detail['gold'];
            }elseif ($goods_id == 18) {
                $data2['amount'] = $goods_detail['price'];
            }else{
                $data2['amount'] = $exchange_code->amount;
            }
            $u_s_g_g_res = UserSjlmGoodsGetRecordModel::create($data2);
            if(!$u_s_g_g_res){
                DB::rollBack();return '33';
                return $this->formateResponse(1001,'网络错误');
            }
            DB::commit();
            $icon = $goods_detail['icon'];
            $returnArr = array('name'=>$goods_detail['name'],'icon'=>$icon);
            return $this->formateResponse(1000,'兑换成功',$returnArr);
        }else{
            return $this->formateResponse(1001,'无效的验证码');
        }
    }

    //礼物兑换记录
    public function exchangeRecord(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'token' => 'required',
            'per_page' => 'required',
            'page' => 'required'
        ],[
            'token.required' => '请登录',
            'per_page.required' => '参数缺失：per_page',
            'page.required' => '参数缺失：page'
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0],$error);
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        //status = 1 (未邮寄，默认) status = 2 (已邮寄) 
        $status_arr = array('1'=>'valid','2'=>'mailed');
        $status = $request->get('status');
        if(empty($status) || $status === 0) {
            $status = 1;
        }else{
            if(!in_array($status,array('1','2'))) return $this->formateResponse(1001,'请选择有效的物品类型');
            $status = 2;
        }
        $status = $status_arr[$status];

        $per_page = $request->get('per_page');
        $page = $request->get('page');
        $start = $per_page*($page-1);
        $records = UserSjlmGoodsGetRecordModel::where('user_sjlm_goods_get_record.uid',$tokenInfo['uid'])
                                                    ->leftJoin('sjlm_goods','sjlm_goods.id','=','user_sjlm_goods_get_record.goods_id')
                                                    ->where('user_sjlm_goods_get_record.is_valid',$status)
                                                    ->where('user_sjlm_goods_get_record.kind','1')
                                                    ->select('user_sjlm_goods_get_record.id','user_sjlm_goods_get_record.amount','sjlm_goods.name','sjlm_goods.icon','user_sjlm_goods_get_record.created_at')
                                                    ->orderBy('user_sjlm_goods_get_record.created_at')
                                                    ->skip($start)
                                                    ->take($per_page)
                                                    ->get();
        // $url = ConfigModel::getConfigByAlias('site_url');
        // foreach ($records as &$record_single){
        //     $record_single['icon'] = $url['rule'].$record_single['icon'];
        // }
        if(!$records->isEmpty()){
            return $this->formateResponse(1000,'success',array('list'=>$records));
        }else{
            if($page == 1){
                return $this->formateResponse(3000,'暂无数据');    
            }else{
                return $this->formateResponse(2000,'暂无更多数据');
            }
        }
    }

    //申请邮寄
    public function applyForMail(Request $request)
    {
        if(!$request->get('record_id')) return $this->formateResponse(1001,'请选择邮寄');
        if(!$request->get('address_id')) return $this->formateResponse(1001,'请选择邮寄地址');
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $record = UserSjlmGoodsGetRecordModel::where('uid',$tokenInfo['uid'])->where('id',$request->get('record_id'))->where('is_valid','valid')->first();
        if(!$record) return $this->formateResponse(1001,'请选择有效的邮寄');
        $user_add = AddressModel::where('id',$request->get('address_id'))->where('uid',$tokenInfo['uid'])->where('status','1')->first();
        if(!$user_add) return $this->formateResponse(1001,'请选择有效的邮寄地址');
        //物品使用
        $u_s_g_g_res = UserSjlmGoodsGetRecordModel::where('id',$request->get('record_id'))->update(['is_valid'=>'mailed']);
        if(!$u_s_g_g_res) return $this->formateResponse(1001,'网络错误');
        //添加使用记录
        $address_str = $user_add['province_cn'].$user_add['city_cn'].$user_add['area_cn'].$user_add['address'];
        $data = array(
                'uid' => $tokenInfo['uid'],
                'goods_id' => $record['goods_id'],
                'amount' => $record['amount'],
                'purpose' => '1',
                'address_id' => $request->get('address_id'),
                'address_str' => $address_str,
                'is_free' => '1',
                'status' => '1',
                'kind' => $record['kind'],
            );
        $remarks = $request->get('remarks');
        if(isset($remarks) && !empty($remarks)) $data['remarks'] = \CommonClass::removeXss($remarks);
        $u_s_g_u_res = UserSjlmGoodsUseRecordModel::create($data);
        if(!$u_s_g_u_res) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'申请成功，请耐心等待');
    }

    //申请列表
    public function applyList(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'per_page' => 'required',
            'page' => 'required',
        ],[
            'per_page.required' => '参数不完整：per_page',
            'page.required' => '参数不完整：page',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001, $error[0]);
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $status = $request->get('status');
        if($status == 0 && empty($status)){
            $status = 1;
        }else{
            $status = 2;
        }
        $page = $request->get('page');
        $per_page = $request->get('per_page');
        $start = $per_page*($page-1);
        $list = UserSjlmGoodsUseRecordModel::where('uid',$tokenInfo['uid'])
                                                ->where('status',$status)
                                                ->skip($start)
                                                ->take($per_page)
                                                ->orderBy('created_at','desc')
                                                ->get();
        foreach($list as &$list_s){
            $list_s['status_str'] = $this->order_status[$list_s['status']];
            $list_s['is_free_str'] = $this->is_free[$list_s['is_free']];
        }
        return $this->formateResponse(1000,'success',$list);
    }
}
