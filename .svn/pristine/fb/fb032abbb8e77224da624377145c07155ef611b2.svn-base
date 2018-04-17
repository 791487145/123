<?php

namespace App\Modules\Test\Http\Controllers;

use App\Http\Requests;
use App\Modules\Manage\Model\AppNavigationModel;
use App\Modules\Manage\Model\CampusRecruitmentModel;
use App\Modules\Manage\Model\MenuIconModel;
use App\Modules\Manage\Model\SecondhandTransactionModel;
use App\Modules\Manage\Model\UserFunctionModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\User\Model\UserBalanceModel;
use App\Modules\User\Model\UserModel;
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
        //默认导航
        $default = AppNavigationModel::where('is_default','yes')->select('id','name','is_default','layout','sort')->get()->toArray();
        $data['user_navigation']  = $default;
        //用户导航
        $navigation_id = UserFunctionModel::where('uid',$this->uid)->pluck('navigation_id');
        if($navigation_id){
            $navigation_id = explode(',',$navigation_id);

            foreach ($navigation_id as $key => $value) {
                $user[$key] = AppNavigationModel::where('id',$value)->select('id','name','is_default','layout','sort')->first()->toArray();
            }
            $data['user_navigation'] =  array_merge($default,$user);
        }

        return $this->formateResponse(1000, 'success',$data);           
    }

    //所有导航
    public function navigationAll(Request $request)
    {
        $navigation_id = UserFunctionModel::where('uid',$this->uid)->pluck('navigation_id');
        if($navigation_id){
            //获取默认导航ID
            $default = AppNavigationModel::where('is_default','yes')->lists('id')->toArray();

            $navigation_id = explode(',',$navigation_id);
            $default = array_merge($default,$navigation_id);

            $navigation = AppNavigationModel::whereNotIn('id',$default)->select('id','name','is_default','sort')->get()->toArray();
        }else{
            $navigation = AppNavigationModel::whereStatus('valid')->where('is_default','no')->select('id','name','is_default','sort')->get()->toArray();
        }
        $data  = [
            'navigation' => $navigation,
        ];
        return $this->formateResponse(1000, 'success',$data);
    }

    //导航设置
    public function setNavigation(Request $request)
    {
        $info = $request->all();
        $validator = Validator::make($info,[
            'id' => 'required',
        ],[
            'id.required' => '请输入id',
        ]);

        $error = $validator->errors()->all();
        if(count($error))  return $this->formateResponse(1001,$error[0]);

        $id = implode(',',$info['id']);

        $navigationInfo = UserFunctionModel::where('uid',$this->uid)->count();
        if($navigationInfo){
            $navigation = UserFunctionModel::where('uid',$this->uid)->update(['navigation_id'=>$id]);
        }else{
            $data['uid'] = $this->uid;
            $data['navigation_id'] = $id;
            $navigation = UserFunctionModel::create($data);
        }
        if($navigation){
            return $this->formateResponse(1000,'成功');
        }else{
            return $this->formateResponse(1001,'网络错误，请稍后重试');
        }

    }


    //首页信息
    public function index(Request $request)
    {
        $info = $request->all();
        //默认类型为任务
        $info['type'] = $request->input('type',3);
        $info['page'] = $request->input('page',1);
        //任务
//        if($info['type'] == 3){
//            $data['task'] = self::taskList($info);
//        }
//        //招聘
//        if($info['type'] == 4){
//            $data['recruitList'] = self::recruitList($info);
//        }

        //二手交易
        //if($info['type'] == 5){
            $data['transaction'] = self::getTransactionList($info);
       // }

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
                ->select('task.id','task.title','task.desc','task.bounty','task.uid','task.created_at','task.area','task.cate_id','users.name','users.head_img','type.name as type_name','district_region.name as schoolName')
                ->orderBy('id','desc')->get()->toArray();

            if(!empty($taskList['taskDinmond'])){
                foreach($taskList['taskDinmond'] as $key =>$value){
                    $taskList['taskDinmond'][$key]['modelType'] = 'task';
                    $taskList['taskDinmond'][$key]['time'] = self::timeShow($value['created_at']);

                }
            }

            //置顶任务
            $taskList['taskTops'] = TaskModel::where('top_status',TaskModel::TASK_TOP)->where('publicity_at','>=',$time)
                ->where('task.status',TaskModel::TASK_PUB)
                ->leftJoin('type','type.id','=','task.cate_id')
                ->leftJoin('users','users.id','=','task.uid')
                ->leftJoin('district_region','district_region.id','=','task.area')
                ->select('task.id','task.title','task.desc','task.bounty','task.uid','task.created_at','task.area','task.cate_id','users.name','users.head_img','type.name as type_name','district_region.name as schoolName')
                ->orderBy('id','desc')->get()->toArray();

            if(!empty($taskList['taskTops'])){
                foreach($taskList['taskTops'] as $k=>$v){
                    $taskList['taskTops'][$k]['modelType'] = 'task';
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
            ->select('task.id','task.title','task.desc','task.bounty','task.uid','task.created_at','task.area','task.cate_id','users.name','users.head_img','type.name as type_name','district_region.name as schoolName')
            ->orderBy('task.id','desc')->offset($offset)->limit($limit)->get()->toArray();

        if(!empty($taskList['task_pub'])){
            foreach($taskList['task_pub'] as $k=>$v){
                $taskList['task_pub'][$k]['modelType'] = 'task';
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
        if(!empty($recruitList)){
            foreach($recruitList as $k=>$v){
                $recruitList[$k]['created_at'] = self::timeShow($v->created_at);
                $recruitList[$k]['modelType'] = 'recruitList';
            }
        }
        return $recruitList;
    }

    //二手交易列表
    public function getTransactionList($info)
    {
        $limit = 20;
        $offset = ($info['page'] - 1) * $limit;//数据条数
        $transaction = SecondhandTransactionModel::select('secondhand_transaction.*','u.name as username','u.head_img','t.name')
            ->where('secondhand_transaction.status','valid')
            ->leftjoin('users as u','secondhand_transaction.uid','=','u.id')
            ->leftjoin('type as t','secondhand_transaction.type','=','t.id')
            ->orderBy('id','desc')->offset($offset)
            ->limit($limit)->get()->toArray();

        return $transaction;
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
            $data = self::taskDetails($info['id']);
            if($data['code'] == 1001){
                return $this->formateResponse(1001,$data['msg']);
            }else{
                unset($data['token']);
            }

        }

        //招聘详情
        if($info['type'] == 4){
            $taskDetails = self::taskDetails($info['id']);
            if($taskDetails['code'] == 1001){
                return $this->formateResponse(1001,$taskDetails['msg']);
            }else{
                $data['taskDetails'] = $taskDetails;
            }
        }
        return $this->formateResponse(1001,'success',$data);
    }


    /**任务详情（post:/taskDetial）
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function taskDetails($id)
    {
        //判断任务是否存在
        $task = TaskModel::whereId($id)->count();
        if($task == false){
            $data = [
                'code' => 1001,
                'msg' => '网络错误，请稍后后重试'
            ];
        }else{
            //判断任务状态
            $taskStatus = TaskModel::where('id',$id)->pluck('status');
            if($taskStatus != 2){
                $data = [
                    'code' => 1001,
                    'msg' => '该任务已被人领取，请查看别的任务'
                ];
            }else{
                //任务详情
                $taskDetail = TaskModel::where('task.id',$id)
                    ->select('task.id','task.uid','task.title','task.desc','task.cate_id','task.phone','task.region','task.status','task.bounty','task.publicity_at','task.created_at','task.area','t.name as type_name','xx.name as schoolName')
                    ->leftjoin('type as t','t.id','=','task.cate_id')
                    ->leftjoin('district_region as xx','xx.id','=','task.area')
                    ->first()->toArray();

                $taskDetail['created_at'] = self::timeShow($taskDetail['created_at']);

                //用户信息
                $userInfo = UserModel::whereId($taskDetail['uid'])->select('name','head_img')->first()->toArray();
                $userInfo['grade'] = UserBalanceModel::getUserGrade($taskDetail['uid']);
                $data['userInfo'] = $userInfo;
                $data['$taskDetail'] = $taskDetail;

                $data = [
                    'code' => 1000,
                    'taskDetail' => $taskDetail,
                    'userInfo' => $userInfo,
                ];
                /*if($data['uid'] != $this->uid){
                    $datas = array(
                        'uid' => $this->uid,
                        'task_id' => $id,
                        'status' => '1',
                        'type' => '1',
                        'add_time' => date('Y-m-d H:i:s'),
                    );
                    $bro_res = BrowesModel::create($datas);
                }*/
            }

        }
        return $data;
    }

    //招聘详情
    public function recruitDetail($id)
    {
        $recruit = CampusRecruitmentModel::whereId($id)->count();
        if($recruit == false) {
            $data = [
                'code' => 1001,
                'msg' => '网络错误，请稍后后重试'
            ];
        }else{
            $recruit = CampusRecruitmentModel::whereId($id)->first()->toArray();
            if($recruit['status'] != 'valid'){
                $data = [
                    'code' => 1001,
                    'msg' => '该公司已停止招聘，请查看别的招聘信息'
                ];
            }else{
                $data = [
                    'code' => 1000,
                    'recruit' => $recruit,
                ];
            }
        }
        return $data;
    }

    //二手交易详情
    public function postTransactionDetail($info)
    {

        $transaction = SecondhandTransactionModel::select('secondhan  d_transaction.*','u.name as username','u.head_img')
            ->where('secondhand_transaction.id',$info['id'])
            ->leftjoin('users as u','secondhand_transaction.uid','=','u.id')
            ->first();

        $transaction['type'] = TypeModel::where('id',$transaction['type'])->pluck('name');

        $img = SecondhandImgModel::where('sid',$transaction['id'])->get()->toArray();
        $transaction['img'] = $img;

        $comment = SecondhandCommentModel::select('secondhand_comment.*','u.name as username','u.head_img')
            ->where('secondhand_comment.sid',$transaction['id'])
            ->leftjoin('users as u','secondhand_comment.uid','=','u.id')
            ->offset(0)->limit(10)->get()->toArray();
        foreach($comment as $key=>$val){
            $reply = SecondhandCommentReplyModel::select('secondhand_comment_reply.*','u.name as username','u.head_img')
                ->where('comment_id',$val['id'])
                ->leftjoin('users as u','secondhand_comment_reply.uid','=','u.id')
                ->offset(0)->limit(10)->get()->toArray();
            $comment[$key]['reply'] = $reply;
        }

        $transaction['comment'] = $comment;

        return $this->formateResponse(1000,'成功',$transaction);

    }
}

















