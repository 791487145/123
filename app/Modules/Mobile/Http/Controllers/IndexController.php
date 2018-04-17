<?php

namespace App\Modules\Mobile\Http\Controllers;

use App\Http\Requests;
use App\Modules\Manage\Model\AppNavigationModel;
use App\Modules\Manage\Model\CampusRecruitmentModel;
use App\Modules\Manage\Model\MenuIconModel;
use App\Modules\Manage\Model\UserFunctionModel;
use App\Modules\Task\Model\TaskModel;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Validator;
use Config;
use Illuminate\Support\Facades\Crypt;
use DB;
Use QrCode;
Use Cache;
use Illuminate\Support\Facades\Redis;



class IndexController extends ApiBaseController
{

    protected $uid;
    protected $username;
    protected $mobile;
    protected $school;
    //获取用户信息
    public function __construct(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $this->uid = $tokenInfo['uid'];
        $this->school = $tokenInfo['school'];
        $this->username = $tokenInfo['name'];
        $this->mobile = $tokenInfo['mobile'];
    }

    //首页主菜单
    public function indexMenu(Request $request)
    {
        //底部菜单
        $menu = MenuIconModel::whereStatus('valid')->get()->toArray();
        $data  = [
            'menu' => $menu,
        ];
        return $this->formateResponse(1000, 'success',$data);
    }

    //我的导航
    Public function indexNavigation(Request $request)
    {
        //导航
        $navigation_id = UserFunctionModel::where('uid',$this->uid)->pluck('navigation_id');
        if($navigation_id){
            $navigation_id = explode(',',$navigation_id);
            $navigation = AppNavigationModel::whereNotIn('id',$navigation_id)->select('id','name','sort')->get()->toArray();

        }else{
            $navigation = AppNavigationModel::where('is_default','yes')->select('id','name','sort')->get()->toArray();
        }

        $data  = [
            'navigation' => $navigation,
        ];
        return $this->formateResponse(1000, 'success',$data);
    }

    //所有导航
    public function navigationAll(Request $request)
    {
        $navigation_id = UserFunctionModel::where('uid',$this->uid)->pluck('navigation_id');
        if($navigation_id){
            $navigation_id = explode(',',$navigation_id);
            $navigation = AppNavigationModel::whereIn('id',$navigation_id)->select('id','name','sort')->get()->toArray();

        }else{
            $navigation = AppNavigationModel::whereStatus('valid')->select('id','name','sort')->get()->toArray();
        }

        $data  = [
            'navigation' => $navigation,
        ];
        return $this->formateResponse(1000, 'success',$data);
    }

    //首页信息
    public function index(Request $request)
    {
        $info = $request->all();
        //默认类型为任务
        $info['type'] = $request->input('type',3);
        $info['page'] = $request->input('page',1);
        //任务
        if($info['type'] == 3){
            $data['task'] = self::taskList($info);
        }
        //招聘
        if($info['type'] == 4){
            $data['recruitList'] = self::recruitList($info);
        }

        return $this->formateResponse(1000, 'success',$data);
    }

    //任务列表
    public function taskList($data)
    {
        $limit = 20;
        $time = date("Y-m-d H:i:s");
        $offset = ($data['page'] - 1) * $limit;//数据条数

        if($data['page'] == 1){
            //钻石置顶任务
            $taskList['taskDinmond'] = TaskModel::where('task.top_status',TaskModel::TASK_DIAMAND)->where('task.publicity_at','>=',$time)
                ->where('task.status',TaskModel::TASK_PUB)
                ->leftJoin('type','type.id','=','task.cate_id')
                ->leftJoin('users','users.id','=','task.uid')
                ->leftJoin('district_region','district_region.id','=','task.area')
                ->select('task.id','task.title','task.desc','task.bounty','task.uid','task.created_at','task.area','task.cate_id','users.head_img','type.name as type_name','district_region.name as schoolName')
                ->orderBy('id','desc')->get()->toArray();

            if(!empty($taskList['taskDinmond'])){
                foreach($taskList['taskDinmond'] as $key =>$value){
                    $taskList['taskDinmond'][$key]['time'] = self::timeShow($value['created_at']);
                }
            }

            //置顶任务
            $taskList['taskTops'] = TaskModel::where('top_status',TaskModel::TASK_TOP)->where('publicity_at','>=',$time)
                ->where('task.status',TaskModel::TASK_PUB)
                ->leftJoin('type','type.id','=','task.cate_id')
                ->leftJoin('users','users.id','=','task.uid')
                ->leftJoin('district_region','district_region.id','=','task.area')
                ->select('task.id','task.title','task.desc','task.bounty','task.uid','task.created_at','task.area','task.cate_id','users.head_img','type.name as type_name','district_region.name as schoolName')
                ->orderBy('id','desc')->get()->toArray();

            if(!empty($taskList['taskTops'])){
                foreach($taskList['taskTops'] as $k=>$v){
                    $taskList['taskTops'][$k]['time'] = self::timeShow($v['created_at']);

                }
            }
        }
        //普通任务
        $task = TaskModel::taskSelect($data);
        //$task->where('top_status',TaskModel::TASK_TOP_NULL)->where('task.publicity_at','>',$time)
        $taskList['task_pub'] =  $task->leftJoin('type','type.id','=','task.cate_id')
            ->leftJoin('users','users.id','=','task.uid')
            ->leftJoin('district_region','district_region.id','=','task.area')
            ->where('task.status',TaskModel::TASK_PUB)->where('task.publicity_at','>=',$time)
            ->select('task.id','task.title','task.desc','task.bounty','task.uid','task.created_at','task.area','task.cate_id','users.head_img','type.name as type_name','district_region.name as schoolName')
            ->orderBy('task.id','desc')->offset($offset)->limit($limit)->get()->toArray();

        if(!empty($taskList['task_pub'])){
            foreach($taskList['task_pub'] as $k=>$v){
                $taskList['task_pub'][$k]['time'] = self::timeShow($v['created_at']);
            }
        }

        return $taskList;
    }

    //招聘列表
    public function recruitList($data)
    {
        $limit = 20;
        $offset = ($data['page'] - 1) * $limit;//数据条数

        $recruitList = CampusRecruitmentModel::whereStatus('valid')
            ->select('id','post_name','salary','create_at','post_demand','company_name','thumb_pic')
            ->orderBy('id','desc')
            ->limit($limit)->offset($offset)->get()->toArray();
        if(!!empty($recruitList)){
            foreach($recruitList as $k=>$v){
                $recruitList[$k]['created_at'] = self::timeShow($v->created_at);
            }
        }
        return $recruitList;
    }

    //首页详情
    public function indexDetails(Request $request)
    {
        $info = $request->all();
        $validator = Validator::make($info,[
            'id' => 'required|integer',
            'type' => 'required',
        ],[
            'id.required' => '请输入id',
            'id.integer' => '请输入整数',
            'type.required' => '请输入类型',
        ]);

        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0]);
        }

        //任务详情
        if($info['type'] == 3){

        }



    }


    /**任务详情（post:/taskDetial）
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getTaskDetials(Request $request)
    {
        $task_id = $request->input('task_id',0);
        //$idd = $request->input('identify',1);
        if($task_id == 0){
            return $this->formateResponse(1001,'请填写任务id');
        }
        //判断任务状态
        $taskStatus = TaskModel::where('id',$task_id)->piuck('status');
        if($taskStatus != 2){
            return $this->formateResponse(1001,'该任务已被人领取，请查看别的任务');
        }

        $taskDetail = TaskModel::whereId($task_id)
            ->select('id','uid','title','desc','cate_id','phone','region','status','bounty','publicity_at','created_at','area')
            ->first()->toArray();

        $taskDetail['created_at'] = self::timeShow($taskDetail['created_at']);

        if($data['uid'] != $this->uid){
            $datas = array(
                'uid' => $this->uid,
                'task_id' => $taskId,
                'status' => '1',
                'type' => '1',
                'add_time' => date('Y-m-d H:i:s'),
            );
            $bro_res = BrowesModel::create($datas);
        }

        return $this->formateResponse(1000,'success',$data);
    }
}

















