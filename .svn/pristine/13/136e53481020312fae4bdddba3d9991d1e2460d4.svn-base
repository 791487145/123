<?php
namespace App\Modules\Test\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Config;
use Validator;
use Toplan\PhpSms\Sms;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\AddressModel;
use App\Modules\Manage\Model\SignModel;
use App\Modules\Manage\Model\SignPrizeModel;
use App\Modules\Manage\Model\UserSignRecordModel;
use App\Modules\Manage\Model\UserSjlmGoodsModel;
use App\Modules\Manage\Model\UserSjlmGoodsGetRecordModel;
use App\Modules\Manage\Model\UserSjlmGoodsUseRecordModel;
use App\Modules\Manage\Model\UserGoldRecordModel;
use App\Modules\Manage\Model\UserGradeModel;
use App\Modules\User\Model\UserModel;
use App\Modules\User\Model\UserBalanceModel;
use Cache;
use DB;
use Socialite;
use Auth;
use Log;

class SignController extends ApiBaseController
{
	//签到，采用累积签到，取消连续签到
    public function __construct(Request $request)
    {
    	$this->tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
    	//每轮签到可补签最大日期
    	$this->patch_max = 7;
    	//每次补签日期距离当前日期的差值
    	$this->patch_back_day = 1;
    	//非签到活动内赠送经验值
    	$this->active_value = 0;
    	//非签到活动内赠送金币值
    	$this->gold = 0;
    	//当前日期
    	$this->today = date('Y-m-d');
    	//kppw_sjlm_goods表中标识补签卡的物品为，需更改
    	$this->patch_card_ability = 4;
    }

    //签到
    public function sign(Request $request)
    {
    	$user_info = UserModel::where('id',$this->tokenInfo['uid'])->first();
    	//判断当天是否签到过
    	$sign_record = UserSignRecordModel::where('created_at','>',$this->today.' 00:00:00')->first();
    	if(count($sign_record)) return $this->formateResponse(1001,'今天已经签到');
    	$user_balance = UserBalanceModel::where('user_id',$this->tokenInfo['uid'])->first();
    	DB::beginTransaction();
    	$sign_status = true;
    	$gold = $this->gold;
    	$active_value = $this->active_value;
    	if($user_info['sign_num'] > 0){
    		//用户有签到	
    		$sign = SignModel::where('id',$user_info['sign_id'])->first();
    		//判断用户当前签到是否有效
    		if($sign['end_time'] < $this->today){
    			//活动已经失效
    			$sign_status = false;
    		}else{
    			//活动正常
    			$gold = $sign['gold'];
    			$active_value = $sign['active_value'];
    			$sign_num = $user_info->sign_num + 1;
    			$sign_id = $user_info->sign_id;
    		}
    	}
    	if($user_info['sign_num'] == 0 || !$sign_status){
    		//用户没有签到
    		$sign = SignModel::where('end_time','>',$this->today)->orderBy('start_time','asc')->first();
    		if(count($sign)){
    			$gold = $sign['gold'];
    			$active_value = $sign['active_value'];
    			$sign_num = 1;
				$sign_id = $sign['id'];
    		}else{
    			$sign_id = 0;
    			$sign_num = 0;
    		}
    	}
		//添加用户经验及金币
		$user_gold = $user_balance['gold'] + $gold;
		$user_active_value = $user_balance['act_value'] + $active_value;
		$g_s_g_res = self::getSignGive($sign_num,$sign_id,$user_gold,$user_active_value,$gold,$active_value,false);
		if($g_s_g_res['code'] != 200){
			DB::rollBack();
			return $this->formateResponse(1001,$g_s_g_res['msg']);
		}else{
			$sign_record_id = $g_s_g_res['data']['sign_record_id'];
		}
		//看看是不是到了该领奖品的时候
		if(isset($sign)){
			$g_s_p_res = self::getSignPrize($sign,$sign_num,$sign_record_id);
			if($g_s_p_res['code'] != 200){
				DB::rollBack();
				return $this->formateResponse(1001,$g_s_p_res['msg']);
			}
		}
		DB::commit();
		return $this->formateResponse(1000,'签到完成');
    }

    //补签
    public function signPatch(Request $request)
    {
    	$validator = Validator::make($request->all(),[
            'date' => 'required|date'
        ],[
            'date.required' => '请选择补签日期',
            'date.date' => '日期格式不正确',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001, $error[0]);
        $the_date = substr($request->get('date'),0,10).' 00:00:00';
        $next_date = date('Y-m-d',strtotime("$the_date +1 day")).' 00:00:00';
        $sign_record = UserSignRecordModel::where('patch_time','>',$the_date)->where('patch_time','<',$next_date)->where('uid',$this->tokenInfo['uid'])->first();
    	if(count($sign_record)){
            if($sign_record['patch'] == 'normal'){
                return $this->formateResponse(1001,'已签到');
            }else{
                return $this->formateResponse(1001,'已补签');
            }
        }
    	//用户当前活动补签次数
    	$userInfo = UserModel::where('id',$this->tokenInfo['uid'])->first();
    	$user_balance = UserBalanceModel::where('user_id',$this->tokenInfo['uid'])->first();
    	$patch_number = UserSignRecordModel::where('uid',$this->tokenInfo['uid'])->where('sign_id',$userInfo['sign_id'])->where('patch','patch')->count();
    	if($patch_number > $this->patch_max || $patch_number == $this->patch_max) return $this->formateResponse(1001,'补签已经到达7次限制');
    	//补签的日期是否是昨天
    	$date = strtotime($request->get('date'));
    	$today = strtotime($this->today);
    	$interval_day = ($today - $date)/86400;
    	if($interval_day > $this->patch_back_day) return $this->formateResponse(1001,'抱歉，超出补签限制');
    	$user_patch_first = UserSignRecordModel::where('uid',$this->tokenInfo['uid'])->where('sign_id',$userInfo['sign_id'])->orderBy('created_at','asc')->first();
    	$patch_first_day = strtotime($user_patch_first['created_at']);
    	if($date < $patch_first_day) return $this->formateResponse(1001,'超出补签限制');
    	//使用用户的补签卡
    	$user_patch_card = UserSjlmGoodsModel::where('user_sjlm_goods.uid',$this->tokenInfo['uid'])
    											->leftJoin('sjlm_goods','sjlm_goods.id','=','user_sjlm_goods.goods_id')
    											->where('sjlm_goods.ability',$this->patch_card_ability)
    											->select('user_sjlm_goods.uid','sjlm_goods.ability','sjlm_goods.id','user_sjlm_goods.amount','sjlm_goods.kind')
    											->first();
    	DB::beginTransaction();
    	if(!count($user_patch_card)) return $this->formateResponse(1001,'您还没有补签卡');
		if($user_patch_card->amount == 0) return $this->formateResponse(1001,'补签卡不足');
		$amount = $user_patch_card->amount - 1;
		$u_s_g_res = UserSjlmGoodsModel::where('uid',$this->tokenInfo['uid'])->where('goods_id',$user_patch_card->id)->update(['amount'=>$amount]);
		if(!$u_s_g_res) {
			DB::rollBack();
			return $this->formateResponse(1001,'网络错误');
		}
		$data1 = array(
				'uid' => $this->tokenInfo['uid'],
				'goods_id' => $user_patch_card->id,
				'amount' => '1',
				'purpose' => '13',
                'kind' => $user_patch_card['kind'],
			);
		$u_s_g_u_res = UserSjlmGoodsUseRecordModel::create($data1);
		if(!$u_s_g_u_res){
			DB::rollBack();
			return $this->formateResponse(1001,'网络错误');
		}
		//添加用户经验及金币
		$sign = SignModel::where('id',$userInfo['sign_id'])->first();
		$sign_num = $userInfo['sign_num'];
		$user_gold = $user_balance['gold'] + $sign['gold'];
		$user_active_value = $user_balance['act_value'] + $sign['active_value'];
		$g_s_g_res = self::getSignGive($sign_num,$userInfo['sign_id'],$user_gold,$user_active_value,$sign['gold'],$sign['active_value'],true);
        if($g_s_g_res['code'] != 200){
			DB::rollBack();
			return $this->formateResponse(1001,$g_s_g_res['msg']);
		}else{
			$sign_record_id = $g_s_g_res['data']['sign_record_id'];
		}
		//看看是不是该领奖了
		$g_s_p_res = self::getSignPrize($sign,$sign_num,$sign_record_id);
		if($g_s_p_res['code'] != 200){
			DB::rollBack();
			return $this->formateResponse(1001,$g_s_p_res['msg']);
		}
		DB::commit();
		return $this->formateResponse(1000,'补签成功');
    }

    //签到记录
    public function signRecord(Request $request)
    {
    	$validator = Validator::make($request->all(),[
            'per_page' => 'required',
            'page' => 'required'
        ],[
            'per_page.required' => '请选择每页条数',
            'page.required' => '请选择页码',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001, $error[0]);
    	$userInfo = UserModel::where('id',$this->tokenInfo['uid'])->first();
    	$per_page = $request->get('per_page');
    	$page = $request->get('page');
    	$start = $per_page*($page-1);
    	$user_sign_record = UserSignRecordModel::where('user_sign_record.uid',$this->tokenInfo['uid'])
    												->where('user_sign_record.sign_id',$userInfo['sign_id'])
    												->leftJoin('user_sjlm_goods_get_record','user_sjlm_goods_get_record.sign_record_id','=','user_sign_record.id')
    												->leftJoin('sjlm_goods','sjlm_goods.id','=','user_sjlm_goods_get_record.goods_id')
    												->select('user_sign_record.patch_time','user_sign_record.patch_time','user_sign_record.created_at','user_sign_record.patch','user_sjlm_goods_get_record.goods_id','sjlm_goods.name','sjlm_goods.icon')
    												->orderBy('user_sign_record.patch_time','desc')
    												->skip($start)
                                                    ->take($per_page)
    												->get();
    	if(!empty($user_sign_record)){
    		$user_sign_record = $user_sign_record->toArray();
	    	$url = ConfigModel::getConfigByAlias('site_url');
    		foreach($user_sign_record as &$user_sign_record_single){
    			if($user_sign_record_single['goods_id'] > 0){
    				$user_sign_record_single['icon'] = $url['rule'].$user_sign_record_single['icon'];
    			}
    		}
    		//获取昨天是否签到
    		$yestoday = date('Y-m-d',strtotime('-1 day'));
    		$yestoday_sign = UserSignRecordModel::where('patch_time','>',$yestoday.' 00:00:00')->where('patch_time','<',$this->today.' 00:00:00');
    		if(count($yestoday_sign)) $yestoday_patch = 2; else $yestoday_patch = 1;
            //补充内容
            //当前签到每日赠送金币及活跃值
            $sign = SignModel::where('id',$userInfo['sign_id'])->first();
            //累计活跃值
            $userBalance = UserBalanceModel::where('user_id',$this->tokenInfo['uid'])->select('act_value')->first();
            //补签卡数量
            $user_patch_card = UserSjlmGoodsModel::where('user_sjlm_goods.uid',$this->tokenInfo['uid'])
                                                ->leftJoin('sjlm_goods','sjlm_goods.id','=','user_sjlm_goods.goods_id')
                                                ->where('sjlm_goods.ability',$this->patch_card_ability)
                                                ->select('user_sjlm_goods.amount')
                                                ->first();
            //当前签到活动信息
            $prize = SignPrizeModel::where('sign_prize.sign_id',$userInfo['sign_id'])
                                        ->where('sign_prize.status','valid')
                                        ->select('date','id')
                                        ->get()
                                        ->toArray();
            foreach ($prize as &$prize_s) {
                if($prize_s['date'] < $userInfo['sign_num'] || $prize_s['date'] == $userInfo['sign_num']){
                    //1代表已领取
                    $prize_s['if_recive'] = '1';
                }else{
                    //2代表未领取
                    $prize_s['if_recive'] = '2';
                }
            }
            $return_arr = array(
                    'record' => $user_sign_record,
                    'patch' => $yestoday_patch,
                    'add_active_value' => $sign->active_value,//也是当日签到赠送活跃值
                    'add_gold' => $sign->gold,
                    'user_active_value' => $userBalance->act_value,
                    'sign_days' => $userInfo['sign_num'],//累计签到天数
                    'begin_date' => substr($sign->start_time,'0','10'),//活动开始日期
                    'end_date' => substr($sign->end_time,'0','10'),//活动结束日期
                    'prize' => $prize,
                );
            if(!empty($user_patch_card)){
                $return_arr['patch_card_num'] = $user_patch_card->amount;
            }else{
                $return_arr['patch_card_num'] = 0;
            }
    		return $this->formateResponse(1000,'success',$return_arr);
    	}else{
    		return $this->formateResponse(2000,'未参与签到活动');
    	}
    }

    //当前签到奖励
    public function signPrize(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'sign_days_id' => 'required',
        ],[
            'sign_days_id.required' => '请选择查看的奖励',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001, $error[0]);
    	$userInfo = UserModel::where('id',$this->tokenInfo['uid'])->first();
    	if($userInfo['sign_id'] > 0){
            return $this->formateResponse(1001,'未参与签到活动');
    	}else{
            $prize = SignPrizeModel::where('sign_prize.id',$request->get('sign_days_id'))
                                        ->where('sign_prize.status','valid')
                                        ->leftJoin('sjlm_goods','sjlm_goods.id','=','sign_prize.sign_id')
                                        ->where('sjlm_goods.status','valid')
                                        ->select('sjlm_goods.name','sjlm_goods.icon','sign_prize.date')
                                        ->get();
            if(empty($prize)){
                return $this->formateResponse(1001,'无效的签到活动');
            }else{
                $prize = $prize->toArray();
            }
                                        
            return $this->formateResponse(1000,'success',$prize);
    	}
    }

    /**
     * 添加经验及金币
     * @param  [type] $sign_num          签到完成时用户的签到次数
     * @param  [type] $sign_id           签到ID：kppw_sign表ID
     * @param  [type] $user_gold         签到完成时用户的金币值
     * @param  [type] $user_active_value 签到完成时用户的经验值
     * @param  [type] $gold              签到获取的金币
     * @param  [type] $active_value      签到获取的经验值
     * @param  [type] $patch             true表示补签，false表示正常签到
     * @return [type]                    [description]
     */
    public function getSignGive($sign_num,$sign_id,$user_gold,$user_active_value,$gold,$active_value,$patch)
    {
    	//修改用户签到数据
		$u_res = UserModel::where('id',$this->tokenInfo['uid'])->update(['sign_num'=>$sign_num,'sign_id'=>$sign_id]);
		if(!$u_res) return array('code'=>'-1','msg'=>'网络错误');
        $u_act_res = UserBalanceModel::where('user_id',$this->tokenInfo['uid'])->increment('act_value',$active_value);
    	//用户添加签到记录及经验值
		$data1 = array(
				'uid' => $this->tokenInfo['uid'],
				'sign_id' => $sign_id,
				'act_value' => $active_value,
			);
		if($patch) {
			$data1['patch'] = 'patch';
			$data1['patch_time'] = date('Y-m-d H:i:s',strtotime("-1 day"));
		}else{
			$data1['patch']='normal';
			$data1['patch_time'] = date('Y-m-d H:i:s');
		}
		$u_s_r_res = UserSignRecordModel::create($data1);
		if(!$u_s_r_res) return array('code'=>'-2','msg'=>'网络错误');
        //看看用户的经验是不是该升级了
        $grade = UserGradeModel::vertifyGrade($user_active_value);
        $user_grade = UserBalanceModel::where('user_id',$this->tokenInfo['uid'])->pluck('grade');
        if($grade != $user_grade){
            $u_b_g_res = UserBalanceModel::where('user_id',$this->tokenInfo['uid'])->update(['grade'=>$grade]);
            if(!$u_b_g_res) return array('code'=>'-3','msg'=>'网络错误');
        }
    	//用户添加金币
        $u_b_res = UserBalanceModel::addUserGold($gold,$this->tokenInfo['uid'],$u_s_r_res->id);
        if($u_b_res['code'] != 200) return array('code'=>'-4','msg'=>$u_b_res['msg']);
		return array('code'=>'200','msg'=>'添加成功','data'=>array('sign_record_id'=>$u_s_r_res->id));
    }

    /**
     * 获取签到奖品
     * @param  [type] $sign           签到ID：kppw_sign表ID
     * @param  [type] $sign_num       签到完成时用户签到数量
     * @param  [type] $sign_record_id 签到记录ID：kppw_user_sign_record表ID
     * @return [type]                 [description]
     */
    public function getSignPrize($sign,$sign_num,$sign_record_id)
    {
		$winning_days = explode(',',$sign->winning_days);
		if(in_array($sign_num,$winning_days)){
			$sign_prize = SignPrizeModel::where('sign_id',$sign->id)->where('date',$sign_num)->where('status','valid')->first();
			//给用户添加礼品
			$u_s_g_res = UserSjlmGoodsModel::addUserGoods($this->tokenInfo['uid'],$sign_prize['goods_id'],$sign_prize['amount']);
            $goods_detail = SjlmGoodsModel::where('id',$sign_prize['goods_id'])->select('kind')->first();
			if(!$u_s_g_res) return array('code'=>'-2','msg'=>'网络错误');
			//奖品领取记录
			$data2 = array(
					'uid' => $this->tokenInfo['uid'],
					'goods_id' => $sign_prize['goods_id'],
                    'kind' => $goods_detail['kind'],
					'amount' => $sign_prize['amount'],
					'source' => '3',
					'sign_record_id' => $sign_record_id,
				);
			$u_s_g_g_r_res = UserSjlmGoodsGetRecordModel::create($data2);
			if(!$u_s_g_g_r_res) return array('code'=>'-1','msg'=>'网络错误');
			return array('code'=>'200','msg'=>'领取成功');
		}else{
			return array('code'=>'200','msg'=>'未到领奖时间');
		}
    }
}
