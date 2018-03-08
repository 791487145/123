<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Http\Controllers\BasicController;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskTypeModel;
use App\Modules\Task\Model\TaskReportModel;
use App\Modules\Task\Model\TaskRightsModel;
use App\Modules\Task\Model\TaskPaySectionModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use App\Modules\Manage\Model\ConfigModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modules\User\Model\UserBalanceModel;
class TaskRightsController extends ManageController
{
    public $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = $this->manager;
        $this->initTheme('manage');
        $this->theme->setTitle('交易维权');
        $this->theme->set('manageType', 'TaskRights');
    }

    /**
     * 维权列表
     */
    public function rightsList(Request $request)
    {
        $data = $request->all();
        $query = TaskRightsModel::select('task_rights.*', 'ud.name as from_nickname', 'userd.name as to_nickname', 'mg.username as handle_nickname');
        //维权人筛选
        if ($request->get('username')) {
            $query = $query->where('ud.name','like','%'.$request->get('username').'%');
        }
        //举报类型筛选
        if ($request->get('reportType') && $request->get('reportType') != 0) {
            $query = $query->where('task_rights.type', $request->get('reportType'));
        }
        //举报状态筛选
        if ($request->get('reportStatus') && $request->get('reportStatus') != 0) {

            $query = $query->where('task_rights.status', $request->get('reportStatus') - 1);
        }
        //时间筛选
        $timeType = 'task_rights.created_at';
        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $query = $query->where($timeType,'>',$start);

        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $query = $query->where($timeType,'<',$end);
        }
        //分页条数筛选
        $page_size = 20;
        $reports_page = $query->join('users as ud', 'ud.id', '=', 'task_rights.from_uid')
            ->leftjoin('users as userd', 'userd.id', '=', 'task_rights.to_uid')
            ->leftjoin('manager as mg', 'mg.id', '=', 'task_rights.handle_uid')
            ->orderBy('task_rights.id','DESC')
            ->paginate($page_size);
        $reports = $reports_page->toArray();
        //处理维权类型
        $rights_type = [
            'type'=>[
                1=>'违规信息',
                2=>'虚假交换',
                3=>'涉嫌抄袭',
                4=>'其他',
            ],
        ];
        $reports['data'] = \CommonClass::intToString($reports['data'],$rights_type);

        $view = [
            'rights' => $reports,
            'merge' => $data,
            'reports_page'=>$reports_page
        ];

        return $this->theme->scope('manage.taskrights', $view)->render();
    }

    /**
     * 维权详情
     * @param $id
     * @return mixed
     */
    public function rightsDetail($id)
    {
        //获取上一项id
        $preId = TaskRightsModel::where('id', '>', $id)->min('id');
        //获取下一项id
        $nextId = TaskRightsModel::where('id', '<', $id)->max('id');
        $rights = TaskRightsModel::where('id',$id)->first();
        $work = WorkModel::where('id',$rights['work_id'])->first();
        $field = array('title','bounty');
        $task = TaskModel::select($field)->where('id',$rights['task_id'])->first();
        $from_user = UserModel::select('users.id','users.name as nickname','users.mobile')
            ->where('users.id',$rights['from_uid'])
            ->leftjoin('user_detail as ud','ud.uid','=','users.id')
            ->first();
        $to_user = UserModel::select('users.id','users.name as nickname','users.mobile')
            ->where('users.id',$rights['to_uid'])
            ->leftjoin('user_detail as ud','ud.id','=','users.id')
            ->first();
        //查询所有的附件
        /*if(!empty(json_decode($rights['attachment_ids'])))
        {
            $attachment = AttachmentModel::whereIn('id',json_decode($rights['attachment_ids']))->get();
        }*/
        $view = [
            'report'=>$rights,
            'from_user'=>$from_user,
            'to_user'=>$to_user,
            'task'=>$task,
            'work'=>$work,
            'preId'=>$preId,
            'nextId'=>$nextId,
            //'attachment'=>$attachment
        ];
        return $this->theme->scope('manage.rightsdetail', $view)->render();
    }

    /**
     * 单个删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rightsDelet($id)
    {
        //删除指定id的举报记录
        $result = TaskRightsModel::destroy($id);
        if(!$result)
            return redirect()->to('/manage/rightsList')->with(['error'=>'删除失败！']);

        return redirect()->to('/manage/rightsList')->with(['massage'=>'删除成功！']);
    }

    /**
     * 批量删除
     * @param Request $request
     */
    public function rightsDeletGroup(Request $request)
    {
        $data = $request->except('_token');

        $result = TaskRightsModel::whereIn($data['id'])->delete();

        if(!$result)
            return redirect()->to('/manage/rightsList')->with(['error'=>'删除失败!']);

        return redirect()->to('/manage/rightsList')->with(['massage'=>'删除成功！']);
    }

    /**
     * 处理维权
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
	 * 2017-09-12 修改该方法 by heike
     */
    public function handleRights(Request $request)
    {
        $data = $request->except('_token');
		if($data['worker_bounty']=='' || $data['owner_bounty']==''){
			return redirect()->back()->with(['error'=>'雇主或威客分配金额不能为空']);
		}
        $rights = TaskRightsModel::select('task_id','role','from_uid','to_uid')->where('id',$data['id'])->first();
        //计算当前任务的赏金
        $task = TaskModel::where('id',$rights['task_id'])->first();
		if($task['status'] == 7){
			return redirect()->back()->with(['error'=>'该任务已处于失败中，金额已处理完']);
		}
        //判断赏金分配合理性
        if(($data['worker_bounty']+$data['owner_bounty'])>$task['bounty'])
        {
            return redirect()->back()->with(['error'=>'赏金分配超额']);
        }
        if($rights['role']==0)
        {
            $worker_id = $rights['from_uid'];
            $owner_id = $rights['to_uid'];
        }else{
            $worker_id = $rights['to_uid'];
            $owner_id = $rights['from_uid'];
        }
        //赏金分配
        $status = DB::transaction(function() use($data,$rights,$worker_id,$owner_id,$task)
        {
            //判断当前任务是否处于维权状态,修改成当前任务已经完成
            if($task['status']==8)
            {
                TaskModel::where('id',$task['id'])->update(['status'=>6,'end_at'=>date('Y-m-d',time())]);
            }
            //修改当前的jia交易维权记录
            $handle = [
                'status'=>1,
                'handle_uid'=>$this->user['id'],
                'handled_at'=>date('Y-m-d H:i:s',time())
            ];
            TaskRightsModel::where('id',$data['id'])->update($handle);
            $work = WorkModel::select('if_account')->where('task_id',$task['id'])->first();

                //雇主
                $amount1 = $data['owner_bounty'];
                $uid1 = $owner_id;
                $action1 = '7';
                //猎人
                $amount2 = $data['worker_bounty'];
                $uid2 = $worker_id;
                $action2 = '2';

            if($work['if_account'] == 1){   
                //如果未到猎人账号 雇主增加  猎人增加
                //雇主
                $add1 = '1';
                //猎人
                $add2 = '1';
                $work_res = WorkModel::where('task_id',$task['id'])->update(['if_account'=>2]);
            }elseif($work['if_account'] == 2){
                //如果到猎人账号  雇主增加  猎人减少
                //雇主
                $add1 = '1';
                //猎人
                $add2 = '2';
                $action2 = '13';
                $amount2 = $task['bounty'] - $amount2;
                
            }else{
                return redirect()->back()->with(['massage'=>'交易状态有问题！']);
            }
            //雇主
            $u_b_res1 = UserBalanceModel::addUserBalance($amount1,$owner_id,$action1,$add1);
            //猎人
            $u_b_res1 = UserBalanceModel::addUserBalance($amount2,$worker_id,$action2,$add2);
        });

        //事务处理失败
        if(!is_null($status))
        {
            return redirect()->back()->with(['error'=>'维权处理失败！']);
        }
        $trading_rights_result  = MessageTemplateModel::where('code_name','trading_rights_result')->where('is_open',1)->where('is_on_site',1)->first();
        if($trading_rights_result)
        {
            $task = TaskModel::select('title')->where('id',$rights['task_id'])->first();
            $worker_user = UserModel::select('id','name')->where('id',$worker_id)->first();//必要条件
            $owner_user = UserModel::select('id','name')->where('id',$owner_id)->first();//必要条件

            $messageVariableArr1 = array(
                    'username'=>$owner_user['name'],
                    'tasktitle'=>$task['title'],
                    'ownername'=>$owner_user['name'],
                    'ownermoney'=>$data['owner_bounty'],
                    'workername'=>$worker_user['name'],
                    'wokermoney'=>$data['worker_bounty'],
                );

            $message_res1 = MessageTemplateModel::sendToUser($owner_user['id'],'trading_rights_result',$messageVariableArr1,'','1','2');

            $messageVariableArr2 = array(
                    'username'=>$worker_user['name'],
                    'tasktitle'=>$task['title'],
                    'ownername'=>$owner_user['name'],
                    'ownermoney'=>$data['owner_bounty'],
                    'workername'=>$worker_user['name'],
                    'wokermoney'=>$data['worker_bounty'],
                );

            $message_res2 = MessageTemplateModel::sendToUser($worker_user['id'],'trading_rights_result',$messageVariableArr2,'','1','2');

        }
        return redirect()->back()->with(['massage'=>'维权处理成功！']);

    }

    /**
     * 处理维权
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 2017-09-12 修改该方法 by heike
     */
//    public function handleRights(Request $request)
//    {
//        $data = $request->except('_token');
//        if($data['worker_bounty']=='' || $data['owner_bounty']==''){
//            return redirect()->back()->with(['error'=>'雇主或威客分配金额不能为空']);
//        }
//        $rights = TaskRightsModel::where('id',$data['id'])->first();
//        //查询交付阶段 处于维权中的交付金额
//        $taskPaySection=TaskPaySectionModel::select('price')->where('task_id',$rights['task_id'])->where('status',0)->where('section_status',2)->first();
//        //计算当前任务的赏金
//        $task = TaskModel::where('id',$rights['task_id'])->first();
//        if($task['status'] == 10){
//            return redirect()->back()->with(['error'=>'该任务已处于失败中，金额已处理完']);
//        }
//        $bounty =$taskPaySection?floor($taskPaySection['price']/$task['worker_num']):floor($task['bounty']/$task['worker_num']);
//        //判断赏金分配合理性
//        if(($data['worker_bounty']+$data['owner_bounty'])>$bounty)
//        {
//            return redirect()->back()->with(['error'=>'赏金分配超额']);
//        }
//        if($rights['role']==0)
//        {
//            $worker_id = $rights['from_uid'];
//            $owner_id = $rights['to_uid'];
//        }else{
//            $worker_id = $rights['to_uid'];
//            $owner_id = $rights['from_uid'];
//        }
//        //赏金分配
//        $status = DB::transaction(function() use($data,$rights,$bounty,$worker_id,$owner_id,$task)
//        {
//            //判断当前任务是否处于维权状态,修改成当前任务已经完成
//            if($task['status']==11)
//            {
//                TaskModel::where('id',$task['id'])->update(['status'=>10,'end_at'=>date('Y-m-d',time())]);
//            }
//            //修改当前的jia交易维权记录
//            $handle = [
//                'status'=>1,
//                'handle_uid'=>$this->user['id'],
//                'handled_at'=>date('Y-m-d H:i:s',time())
//            ];
//            TaskRightsModel::where('id',$data['id'])->update($handle);
//            //查询所有的交付阶段
//            $taskPaySectionAll=TaskPaySectionModel::select('price')->where('task_id',$rights['task_id'])->where('status',0)->where('section_status',0)->get();
//            //查询交易模式
//            $taskType=TaskTypeModel::select('alias')->where('id',$task['type_id'])->first();
//            switch($taskType['alias']){
//                case 'xuanshang':
//                    $configType="task";
//                    //$configSuc="task_percentage";
//                    $configEro="task_fail_percentage";
//                    break;
//                case 'guyong':
//                    break;
//                case 'zhaobiao':
//                    $configType="bid";
//                    //$configSuc="bid_percentage";
//                    $configEro="bid_fail_percentage";
//                    break;
//            }
//            if(sizeof($taskPaySectionAll)){
//                //获取任务配置
//                $config=ConfigModel::select("rule")->where('type',$configType)->where('alias',$configEro)->first();
//                //二维数组进行处理
//                foreach($taskPaySectionAll as $Vtpsa){
//                    $data['owner_bounty']+=floor($Vtpsa['price']*(100-$config['rule'])*0.01);
//                }
//            }
//            //将赏金按照处理分给威客
//            if($data['worker_bounty']!=0)
//            {
//                UserDetailModel::where('uid',$worker_id)->increment('balance',$data['worker_bounty']);
//                //产生一笔财务流水，接受任务产生收益
//                $finance_data = [
//                    'action'=>2,
//                    'pay_type'=>1,
//                    'cash'=>$data['worker_bounty'],
//                    'uid'=>$worker_id,
//                    'created_at'=>date('Y-m-d H:i:s',time()),
//                ];
//                FinancialModel::create($finance_data);
//            }
//            //将赏金按照处理分给雇主
//            if($data['owner_bounty']!=0)
//            {
//                UserDetailModel::where('uid',$owner_id)->increment('balance',$data['owner_bounty']);
//                //产生一笔财务流水，任务失败产生的退款
//                $finance_data = [
//                    'action'=>7,
//                    'pay_type'=>1,
//                    'cash'=>$data['owner_bounty'],
//                    'uid'=>$owner_id,
//                    'created_at'=>date('Y-m-d H:i:s',time()),
//                ];
//                FinancialModel::create($finance_data);
//            }
//        });
//
//        //事务处理失败
//        if(!is_null($status))
//        {
//            return redirect()->back()->with(['error'=>'维权处理失败！']);
//        }
//        $trading_rights_result  = MessageTemplateModel::where('code_name','trading_rights_result')->where('is_open',1)->where('is_on_site',1)->first();
//        if($trading_rights_result)
//        {
//            $task = TaskModel::where('id',$rights['task_id'])->first();
//            $worker_user = UserModel::where('id',$worker_id)->first();//必要条件
//            $owner_user = UserModel::where('id',$owner_id)->first();//必要条件
//            $site_name = \CommonClass::getConfig('site_name');//必要条件
//            //组织好系统消息的信息
//            //发送系统消息
//            $ownerMessageVariableArr = [
//                'username'=>$owner_user['name'],
//                'tasktitle'=>$task['title'],
//                'ownername'=>$owner_user['name'],
//                'ownermoney'=>$data['owner_bounty'],
//                'workername'=>$worker_user['name'],
//                'wokermoney'=>$data['worker_bounty'],
//                'website'=>$site_name,
//            ];
//            $ownerMessage = MessageTemplateModel::sendMessage('trading_rights_result',$ownerMessageVariableArr);
//            $message1 = [
//                'message_title'=>$trading_rights_result['name'],
//                'code'=>'trading_rights_result',
//                'message_content'=>$ownerMessage,
//                'js_id'=>$owner_user['id'],
//                'message_type'=>2,
//                'receive_time'=>date('Y-m-d H:i:s',time()),
//                'status'=>0,
//            ];
//            MessageReceiveModel::create($message1);
//            //发送系统消息
//            $workerMessageVariableArr = [
//                'username'=>$worker_user['name'],
//                'tasktitle'=>$task['title'],
//                'ownername'=>$owner_user['name'],
//                'ownermoney'=>$data['owner_bounty'],
//                'workername'=>$worker_user['name'],
//                'wokermoney'=>$data['worker_bounty'],
//                'website'=>$site_name,
//            ];
//            $workerMessage = MessageTemplateModel::sendMessage('trading_rights_result',$workerMessageVariableArr);
//            $message2 = [
//                'message_title'=>$trading_rights_result['name'],
//                'code'=>'trading_rights_result',
//                'message_content'=>$workerMessage,
//                'js_id'=>$worker_user['id'],
//                'message_type'=>2,
//                'receive_time'=>date('Y-m-d H:i:s',time()),
//                'status'=>0,
//            ];
//            MessageReceiveModel::create($message2);
//        }
//        return redirect()->back()->with(['massage'=>'维权处理成功！']);
//
//    }


}
