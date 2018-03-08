<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Modules\User\Model\UserBalanceModel;
use App\Http\Controllers\ManageController;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\Manage\Model\PunishGradeModel;
use App\Modules\Manage\Model\PunishModel;
use App\Modules\Manage\Model\UserSystemTaskModel;
use App\Modules\Task\Model\TaskAttachmentModel;
use App\Modules\Task\Model\TaskExtraModel;
use App\Modules\Task\Model\TaskExtraSeoModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskTypeModel;
use App\Modules\Task\Model\WorkCommentModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Theme;
use Illuminate\Support\Facades\Redis;

class TaskController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('任务列表');
        $this->theme->set('manageType', 'task');
    }

    /**
     * 任务列表
     *
     * @param Request $request
     * @return mixed
     */
    public function taskList(Request $request)
    {
        $search = $request->all();
        //$by = $request->get('by') ? $request->get('by') : 'id';
        //$order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;
        $taskType=TaskTypeModel::select('id')->where('alias',"xuanshang")->first();
        $taskList = TaskModel::select('task.id', 'us.name', 'task.title', 'task.created_at', 'task.status', 'task.verified_at', 'task.bounty_status')
                    ->where('type_id',$taskType['id']);

        if ($request->get('task_title')) {
            $taskList = $taskList->where('task.title', 'like', '%' . $request->get('task_id') . '%');
        }
        if ($request->get('username')) {
            $taskList = $taskList->where('us.name', 'like', '%' . e($request->get('username')) . '%');
        }
        //状态筛选
        if ($request->get('status') && $request->get('status') != 0) {
            $taskList = $taskList->where('task.status', $request->get('status'));
        }else{
            $taskList = $taskList->whereNotIn('task.status', array(8, 10));
        }
        //时间筛选
        if ($request->get('time_type')) {
            if ($request->get('start')) {
                $start = date('Y-m-d H:i:s', strtotime($request->get('start')));
                $taskList = $taskList->where($request->get('time_type'), '>', $start);
            }
            if ($request->get('end')) {
                $end = date('Y-m-d H:i:s', strtotime($request->get('end')));
                $taskList = $taskList->where($request->get('time_type'), '<', $end);
            }
        }
        //->orderBy($by, $order)
        $taskList = $taskList->leftJoin('users as us', 'us.id', '=', 'task.uid')
            ->paginate($paginate);

        $data = array(
            'task' => $taskList,
        );
        $data['merge'] = $search;//dd($data);
        return $this->theme->scope('manage.tasklist', $data)->render();
    }

    //任务审核失败
    public function taskNotPass($id)
    {
        $info = TaskModel::where('id',$id)->update(array('status'=>9,'verified_at'=>date('Y-m-d H:i:s')));
        if($info){
            $site_name = \CommonClass::getConfig('site_name');
            //任务违规
            // $audit_punishment = MessageTemplateModel::where('code_name', 'task_audit_failure')->where('is_open', 1)->where('is_on_site', 1)->first();
            //审核失败和成功 发送系统消息
            $task = TaskModel::where('id', $id)->first();
            $user = UserModel::where('id', $task['uid'])->first();
            $messageVariableArr = [
                'username' => $user['name'],
                'task_title' => $task['title'],
            ];
            // $message = MessageTemplateModel::sendMessage('task_audit_failure', $messageVariableArr);
            // $data = [
            //     'message_title' => $audit_punishment['name'],
            //     'code' => 'task_audit_failure',
            //     'message_content' => $message,
            //     'js_id' => $user['id'],
            //     'message_type' => 3,
            //     'receive_time' => date('Y-m-d H:i:s', time()),
            //     'status' => 0,
            // ];
            // MessageReceiveModel::create($data);
            //站内信
            $message_res = MessageTemplateModel::sendToUser($user['id'],'task_audit_failure',$messageVariableArr);

            return redirect()->back()->with(['message' => '操作成功！']);
        }else{
            return redirect()->back()->with(['message' => '操作失败！']);
        }
    }

    /**
     * 任务违法惩罚处理
     * @param $id
     * @param $action
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function taskHandle(Request $request)
    {
        $data = $request->all();
        $info = TaskModel::where('id',$data['id'])->update(array('status'=>9,'verified_at'=>date('Y-m-d H:i:s')));
        if($info){
            $status = DB::transaction(function() use($data)
            {
                $punish = PunishGradeModel::select('id','experience','penalty_time')->where('id',$data['punish_grade'])->first()->toArray();
                //任务违规惩罚
                $audit_punishment = MessageTemplateModel::where('code_name', 'audit_punishment')->where('is_open', 1)->where('is_on_site', 1)->first();
                //审核失败和成功 发送系统消息
                $task = TaskModel::where('id', $data['id'])->first();
                if($data['object'] == '雇主' || $data['object'] == '猎人') {
                    if ($data['object'] == '雇主') {
                        $user = UserModel::where('id', $task['uid'])->first();
                        UserBalanceModel::where('user_id',$user['id'])->decrement('emp_value',$punish['experience']);
                        UserBalanceModel::where('user_id',$user['id'])->increment('balance',$task['bounty']);
                    } elseif ($data['object'] == '猎人') {
                        $uid = WorkModel::select('uid')->where('task_id', $task['id'])->first();
                        $user = UserModel::where('id', $uid['uid'])->first();
                        UserBalanceModel::where('user_id',$user['id'])->decrement('hunt_value',$punish['experience']);
                    }
                    $messageVariableArr = [
                        'username' => $user['name'],
                        'task_title' => $task['title'],
                        'type' => $data['type'],
                        'experience' => $punish['experience'],
                        'penalty_time' => $punish['penalty_time'],
                    ];
                    $message = MessageTemplateModel::sendMessage('audit_punishment', $messageVariableArr);
                    $receive_data = [
                        'message_title' => $audit_punishment['name'],
                        'code' => 'task_audit_failure',
                        'message_content' => $message,
                        'js_id' => $user['id'],
                        'message_type' => 3,
                        'receive_time' => date('Y-m-d H:i:s', time()),
                        'status' => 0,
                    ];
                    MessageReceiveModel::create($receive_data);
                    $punish_data = array(
                        'uid' => $user['id'],
                        'task_id'   => $data['id'],
                        'task_title' => $task['title'],
                        'punish_type'  => $data['type'],
                        'punish_grade_id' => $punish['id'],
                        'penalty_time'  => date('Y-m_d H:i:s',time()+$punish['penalty_time']*60),
                        'create_at' => date('Y-m-d H:i:s')
                    );
                    PunishModel::create($punish_data);
                }else{
                    $uid = WorkModel::select('uid')->where('task_id',$task['id'])->first();
                    $user = UserModel::whereIn('id', array($uid['uid'],$task['uid']))->get();
                    UserBalanceModel::where('uid',$task['id'])->decrement('emp_value',$punish['experience']);
                    UserBalanceModel::where('uid',$uid['uid'])->decrement('hunt_value',$punish['experience']);
                    foreach($user as $v){
                        $messageVariableArr = [
                            'username' => $v['name'],
                            'task_title' => $task['title'],
                            'type' => $data['type'],
                            'experience' => $punish['experience'],
                            'penalty_time' => $punish['penalty_time'],
                        ];
                        $message = MessageTemplateModel::sendMessage('audit_punishment', $messageVariableArr);
                        $receive_data = [
                            'message_title' => $audit_punishment['name'],
                            'code' => 'task_audit_failure',
                            'message_content' => $message,
                            'js_id' => $v['id'],
                            'message_type' => 3,
                            'receive_time' => date('Y-m-d H:i:s', time()),
                            'status' => 0,
                        ];
                        MessageReceiveModel::create($receive_data);
                        $punish_data = array(
                            'uid' => $v['id'],
                            'task_id'   => $data['id'],
                            'task_title' => $task['title'],
                            'punish_type'  => $data['type'],
                            'punish_grade_id' => $punish['id'],
                            'penalty_time'  => date('Y-m_d H:i:s',time()+$punish['penalty_time']*60),
                            'create_at' => date('Y-m-d H:i:s')
                        );
                        PunishModel::create($punish_data);
                    }
                }
            });
            if(is_null($status)){
                return redirect()->back()->with(['message' => '操作成功！']);
            }else{
                TaskModel::where('id',$data['id'])->update(array('status'=>$data['status']));
                return redirect()->back()->with(['message' => '操作失败！']);
            }
        }else{
            return redirect()->back()->with(['message' => '操作失败！']);
        }
    }


    /**
     * 任务批量处理
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function taskMultiHandle(Request $request)
    {
        if (!$request->get('ckb')) {
            return \CommonClass::adminShowMessage('参数错误');
        }

        $info = TaskModel::whereIn('id', $request->get('ckb'))->update(array('status' => 2));
        if($info)
            return redirect()->back()->with(['error'=>'操作成功！']);
        else
           return redirect()->back()->with(['error'=>'操作失败！']);
	}

	/**
	 *  审核通过
	 *  用户发布任务 ：kppw_type表  ID = 11
	 **/
	public function taskPass($id)
    {
        $info = TaskModel::where('id', $id)->update(array('status' => 2));
        if($info){
            //调用偶发事件发布任务完成
            $taskInfo = TaskModel::where('id',$id)->select('uid','title')->first()->toArray();
            $u_b_res = UserBalanceModel::contigencyCreated($taskInfo['uid'],'1');
            //系统任务（历练）之完成发布任务 kppw_type 表ID ：11  不要删
            // $user_system_task = UserSystemTaskModel::where('uid','=',$taskInfo['uid'])->where('status','1')->where('systerm_task_type',11)->first();
            // if($user_system_task){
            //     $u_s_t_res = UserSystemTaskModel::completed($taskInfo['uid'],11);
            //     if($u_s_t_res['code'] != 200) return redirect()->back()->with(['error'=>$u_s_t_res['msg']]);
            // }
            //站内信通知
            $userInfo = UserModel::where('id',$taskInfo['uid'])->select('name','id')->first();
            $messageVariableArr = array(
                    'username' => $userInfo['name'],
                    'task_title' => $taskInfo['title'],
                );
            $message_res = MessageTemplateModel::sendToUser($userInfo['id'],'audit_success',$messageVariableArr);

            Redis::lpush('task',$id);
            return redirect()->back()->with(['error'=>'操作成功！']);
        } else{
            return redirect()->back()->with(['error'=>'操作失败！']);
        }
    }

    /**
     * 任务详情
     * @param $id
     */
    public function taskDetail($id)
    {
        $task = TaskModel::where('id', $id)->first();
        if (!$task) {
            return redirect()->back()->with(['error' => '当前任务不存在，无法查看！']);
        }
        $query = TaskModel::select('task.*', 'us.name as nickname', 'ud.avatar')->where('task.id', $id);
        $taskDetail = $query->join('user_detail as ud', 'ud.uid', '=', 'task.uid')
                            ->leftjoin('users as us', 'us.id', '=', 'task.uid')
                            ->first();
        if (!$taskDetail) {
            return redirect()->back()->with(['error' => '当前任务已经被删除！']);
        }else{
            $taskDetail = $taskDetail->toArray();
        }
        $status = [
            1 => '待审核',
            2 => '已发布',
            3 => '经行中',
            4 => '申请超时',
            5 => '提交完成',
            6 => '完成',
            7 => '失败',
            8 => '维权',
            9 => '审核失败',
        ];
        $taskDetail['status_text'] = $status[$taskDetail['status']];
        //判断任务是否被领取
        if($taskDetail['status'] >2 && $taskDetail['status'] != 9 && $taskDetail['status'] != 10){
             $to_user =  WorkModel::select('u.name','u.mobile')
                                    ->where('work.task_id',$taskDetail['id'])
                                    ->leftjoin('users as u','work.uid','=','u.id')
                                    ->first();
            $taskDetail['to_name'] = $to_user['name'];
            $taskDetail['to_mobile'] = $to_user['mobile'];
        }

        //惩罚等级
        $punish_grade = PunishGradeModel::get();
        $data = [
            'punish_grade' => $punish_grade,
            'task' => $taskDetail,
        ];
        return $this->theme->scope('manage.taskdetail', $data)->render();
    }

    /**
     * 任务详情提交
     * @param Request $request
     */
    public function taskDetailUpdate(Request $request)
    {
        $data = $request->except('_token');
        $task_extra = [
            'task_id' => intval($data['task_id']),
            'seo_title' => $data['seo_title'],
            'seo_keyword' => $data['seo_keyword'],
            'seo_content' => $data['seo_content'],
        ];
        $result = TaskExtraSeoModel::firstOrCreate(['task_id' => $data['task_id']])
            ->where('task_id', $data['task_id'])
            ->update($task_extra);
        //修改任务数据
        $task = [
            'title' => $data['title'],
            'desc' => $data['desc'],
            'phone' => $data['phone']
        ];
        //修改任务数据
        $task_result = TaskModel::where('id', $data['task_id'])->update($task);

        if (!$result || !$task_result) {
            return redirect()->back()->with(['error' => '更新失败！']);
        }

        return redirect()->back()->with(['massage' => '更新成功！']);
    }

    /**
     * 删除任务留言
     */
    public function taskMassageDelete($id)
    {
        $result = WorkCommentModel::destroy($id);

        if (!$result) {
            return redirect()->to('/manage/taskList')->with(['error' => '留言删除失败！']);
        }
        return redirect()->to('/manage/taskList')->with(['massage' => '留言删除成功！']);
    }

    /**下载附件
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id)
    {
        $pathToFile = AttachmentModel::where('id', $id)->first();
        $pathToFile = $pathToFile['url'];
        return response()->download($pathToFile);
    }
}
