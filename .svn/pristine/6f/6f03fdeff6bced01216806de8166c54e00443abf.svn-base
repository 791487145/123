<?php
namespace App\Modules\Api\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Config;
use Validator;
use Toplan\PhpSms\Sms;
use Illuminate\Support\Facades\Crypt;
use App\Modules\User\Model\UserModel;
use App\Modules\User\Model\BrowesModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Task\Model\DistrictRegionModel;
use Cache;
use DB;
use Socialite;
use Auth;
use Log;

class BrowesController extends ApiBaseController
{
    public function __construct()
    {
        //任务状态:1:审核中 2已发布 3经行中 4申请超时 5提交完成（猎人）6完成 7失败 8维权 9审核失败 10待付款
        $this->status = array('1'=>'审核中','2'=>'已发布','3'=>'进行中','4'=>'申请超时','5'=>'提交完成','6'=>'完成','7'=>'失败','8'=>'维权','9'=>'审核失败','10'=>'待付款');
    }
    public function add(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'token' => 'required',
            'task_id' => 'required',
        ],[
            'token.required' => '请登录',
            'task_id.required' => '参数不完整:task_id',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0],$error);
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $bro_res = BrowesModel::create(['uid'=>$tokenInfo['uid'],'task_id'=>$request->input('task_id'),'status'=>'1','type'=>'1','add_time'=>date('Y-m-d H:i:s')]);
        if($bro_res){
            return $this->formateResponse(1000,'success');
        }else{
            return $this->formateResponse(1001,'网络错误');
        }
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'browes_id' => 'required',
        ],[
            'token.required' => '请登录',
            'browes_id.required' => '参数不完整:browes_id',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0],$error);
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $bro_res = BrowesModel::where('id',$request->input('browes_id'))->update(['status'=>'2']);
        if($bro_res){
            return $this->formateResponse(1000,'success');
        }else{
            return $this->formateResponse(1001,'网络错误');
        }
    }

    public function list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'per_page' => 'required',
            'page' => 'required',
        ],[
            'token.required' => '请登录',
            'per_page' => '参数不完整:per_page',
            'page.required' => '参数不完整:page',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0],$error);
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $per_page = $request->get('per_page');
        $page = $request->get('page');
        $start = $per_page*($page-1);
        $list = BrowesModel::where('browes.uid',$tokenInfo['uid'])
                                ->where('browes.status','1')
                                ->leftJoin('task','browes.task_id','=','task.id')
                                ->leftJoin('users','users.id','=','browes.uid')
                                ->skip($start)
                                ->take($per_page)
                                ->select('task.title','users.name','users.head_img','browes.task_id','task.status','browes.add_time','task.area','task.created_at','task.show_cash')
                                ->orderBy('browes.add_time','desc')
                                ->get();
        if(count($list)){
            $list = $list->toArray();
            $today = [];
            $yestoday = [];
            $more = [];
            $today_date = date('Y-m-d',strtotime('-1 days')).' 23:59:59';
            $yestoday_date = date('Y-m-d',strtotime('-2 days')).' 23:59:59';
            foreach($list as &$list_single){
                //学校
                if($list_single['area']){
                    $school = DistrictRegionModel::where('id',$list_single['area'])->select('name')->first();
                    $list_single['school'] = $school['name'];    
                }
                //任务状态
                $list_single['state'] = $this->status[$list_single['status']];
                $list_single['created_at'] = substr($list_single['created_at'],'0','16');
                if($list_single['add_time'] > $today_date){
                    $list_single['add_time'] = substr($list_single['add_time'],'11','5');
                    $today[] = $list_single;
                }elseif($list_single['add_time'] > $yestoday_date){
                    $list_single['add_time'] = substr($list_single['add_time'],'11','5');
                    $yestoday[] = $list_single;
                }else{
                    $list_single['add_time'] = substr($list_single['add_time'],'0','16');
                    $more[] = $list_single;
                }
            }
            // if(!empty($today)) $returnArr['今天'] = $today;
            // if(!empty($yestoday)) $returnArr['昨天'] = $yestoday;
            // if(!empty($more)) $returnArr['更早'] = $more;
            
            // return $this->formateResponse(1000,'success',$returnArr);
            return $this->formateResponse(1000,'success',array('today'=>$today,'yestoday'=>$yestoday,'more'=>$more));
        }else{
            if($page == 1){
                return $this->formateResponse(3000,'暂无数据');
            }else{
                return $this->formateResponse(2000,'无更多数据');
            }
        }
    }
}
