<?php
namespace App\Modules\Mobile\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Config;
use Validator;
use Toplan\PhpSms\Sms;
use Illuminate\Support\Facades\Crypt;
use App\Modules\User\Model\UserModel;
use App\Modules\User\Model\UserBalanceModel;
use App\Modules\Manage\Model\BoxesModel;
use App\Modules\Manage\Model\BoxGoodsModel;
use App\Modules\Manage\Model\UserSjlmGoodsModel;
use App\Modules\Manage\Model\UserSjlmGoodsGetRecordModel;
use App\Modules\Manage\Model\UserSystemTaskModel;
use App\Modules\Finance\Model\FinancialModel;
use Cache;
use DB;
use Socialite;
use Auth;
use Log;

class ContigencyController extends ApiBaseController
{
    public function __construct(Request $request)
    {
        $this->tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        //雇主发布任务通过审核触发区间
        $this->task_verified_node_a = 7;
        $this->task_verified_node_b = 15;
        //猎人完成任务触发区间
        $this->work_completed_node_a = 7;
        $this->work_completed_node_b = 15;
    }

    /**
     * 验证发布任务数量或者完成任务数量是否够开启宝箱数量
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'method' => 'required',
        ],[
            'method.required' => '请选择验证分类',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001, $error[0]);
        $method = $request->get('method');
        $userBalance = UserBalanceModel::where('user_id',$this->tokenInfo['uid'])->first();
        if($method == 1){
            //验证发布任务数量
            if($userBalance->contigency_created > 0 && $userBalance->get_contigency_created == $userBalance->contigency_created){
                return $this->formateResponse(1000,'可以开启宝箱了');
            }elseif($userBalance->get_contigency_created == 0 && $userBalance->contigency_created == 0){
                $number = mt_rand($this->task_verified_node_a,$this->task_verified_node_b);
                $u_b_res = UserBalanceModel::changeCreatedNum($this->tokenInfo['uid'],$number);
                if($u_b_res) {
                    return $this->formateResponse(2000,'还没有发布任务哦');
                }else{
                    return $this->formateResponse(1001,'网络错误');
                }
            }
            return $this->formateResponse(1001,'通过审核任务数量还不够开启宝箱');
        }elseif($method == 2){
            //验证完成任务数量
            if($userBalance->contigency_completed > 0 && $userBalance->get_contigency_completed == $userBalance->contigency_completed){
                return $this->formateResponse(1000,'可以开启宝箱了');
            }elseif($userBalance->get_contigency_completed == 0 && $userBalance->contigency_completed == 0){
                $number = mt_rand($this->work_completed_node_a,$this->work_completed_node_b);
                $u_b_res = UserBalanceModel::changeCompletedNum($this->tokenInfo['uid'],$number);
                if($u_b_res) {
                    return $this->formateResponse(2000,'还没有已完成任务哦');
                }else{
                    return $this->formateResponse(1001,'网络错误');
                }
            }
            return $this->formateResponse(1001,'发布任务数量还不够开启宝箱');
        }else{
            return $this->formateResponse(1001,'请选择正确的验证分类');
        }
    }

    public function openBox(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'method' => 'required',
        ],[
            'method.required' => '请选择获取分类',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001, $error[0]);
        $userBalance = UserBalanceModel::where('user_id',$this->tokenInfo['uid'])->select('get_contigency_created','contigency_created','get_contigency_completed','contigency_completed')->first();
        $boxes = BoxesModel::where('status','valid');
        $method = $request->get('method');
        DB::beginTransaction();
        if($method == 1){
            //发布任务数量及触发概率重置
            if($userBalance->get_contigency_created != $userBalance->contigency_created){
                DB::rollBack();
                return $this->formateResponse(3000,'发布任务数量还不够开启宝箱');
            }
            $number = mt_rand($this->task_verified_node_a,$this->task_verified_node_b);
            $u_b_res = UserBalanceModel::changeCreatedNum($this->tokenInfo['uid'],$number);
            if(!$u_b_res){
                DB::rollBack();
                return $this->formateResponse(1001,'网络错误');
            }
            $boxes = $boxes->where('grade','1');
        }elseif($method == 2){
            //完成任务数量及触发概率重置
            if($userBalance->get_contigency_completed != $userBalance->contigency_completed){
                DB::rollBack();
                return $this->formateResponse(3000,'完成任务数量还不够开启宝箱');
            }
            $number = mt_rand($this->work_completed_node_a,$this->work_completed_node_b);
            $u_b_res = UserBalanceModel::changeCompletedNum($this->tokenInfo['uid'],$number);
            if(!$u_b_res){
                DB::rollBack();
                return $this->formateResponse(1001,'网络错误');
            }
            $boxes = $boxes->where('grade','1');
        }elseif($method != 3){
            DB::rollBack();
            return $this->formateResponse(1001,'请选择有效的分类');
        }
        //系统任务之完成参与偶发任务条件 kppw_type 表ID : 13  不要删
        // $user_system_task = UserSystemTaskModel::where('uid',$this->tokenInfo['uid'])->where('status','1')->where('systerm_task_type',13)->first();
        // if($user_system_task){
        //     $u_s_t_res = UserSystemTaskModel::completed($this->tokenInfo['uid'],13);
        //     if($u_s_t_res['code'] != 200){
        //         DB::rollBack();
        //         return $this->formateResponse(1001,$u_s_t_res['msg']);
        //     }
        // }
        $boxes = $boxes->select('id')->get();
        $boxes_ids = array_flatten($boxes);
        $key = array_rand($boxes_ids,1);
        $boxes_id = $boxes_ids[$key];
        $goods = BoxGoodsModel::where('box_goods.status','valid')
                                ->leftJoin('sjlm_goods','sjlm_goods.id','=','box_goods.goods_id')
                                ->where('box_goods.box_id',$boxes_id['id'])
                                ->select('box_goods.probability','sjlm_goods.name','sjlm_goods.icon','sjlm_goods.kind','box_goods.goods_id','box_goods.g_amount')
                                ->get()
                                ->toArray();
        $proArr = [];
        $goodsInfo = [];
        foreach($goods as $goods_single){
            $proArr[$goods_single['goods_id']] = $goods_single['probability'];
            $goodsInfo[$goods_single['goods_id']] = $goods_single;
        }
        $goods_id = self::getRand($proArr);
        if($goods_id == 0){
            DB::commit();
            return $this->formateResponse(2000,'很遗憾未中奖，下次再接再厉哟');
        }
        //然后就是往个人的物品里面放了
        $u_s_g_res = UserSjlmGoodsModel::addUserGoods($this->tokenInfo['uid'],$goods_id,$goodsInfo[$goods_id]['g_amount']);
        if(!$u_s_g_res){
            DB::rollBack();
            return $this->formateResponse(1001,'网络错误');
        }
        //物品投放记录
        $data = array(
                'uid' => $this->tokenInfo['uid'],
                'goods_id' => $goods_id,
                'kind' => $goodsInfo[$goods_id]['kind'],
                'amount' => $goodsInfo[$goods_id]['g_amount'],
                'source' => '1',
            );
        $u_s_g_g_res = UserSjlmGoodsGetRecordModel::create($data);
        if(!$u_s_g_g_res){
            DB::rollBack();
            return $this->formateResponse(1001,'网络错误');
        }
        $returnArr = array(
                'name' => $goodsInfo[$goods_id]['name'],
                'icon' => $goodsInfo[$goods_id]['icon'],
            );
        DB::commit();
        return $this->formateResponse(1000,'恭喜中奖啦',$returnArr);
    }

    /**
     * 按照概率随机获取主键（测试方法）
     * @return [type] [description]
     */
    public function test(){
        $goods = BoxGoodsModel::where('box_goods.status','valid')
                                ->leftJoin('sjlm_goods','sjlm_goods.id','=','box_goods.goods_id')
                                ->select('box_goods.probability','sjlm_goods.name','sjlm_goods.icon','sjlm_goods.kind','box_goods.goods_id','box_goods.g_amount')
                                ->get()
                                ->toArray();

        $proArr = [];
        foreach($goods as $goods_single){
            $proArr[$goods_single['goods_id']] = $goods_single['probability'];
        }
        for($i=0;$i<1000;$i++){
            $goods_id = self::getRand($proArr);
            $f_res = FinancialModel::create(['cash'=>$goods_id]);    
        }
        if($f_res) return '对的';
        return '错了';
    }
}
