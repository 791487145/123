<?php

namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\Task\Model\TaskAttachmentModel;
use App\Modules\Task\Model\TaskExtraModel;
use App\Modules\Task\Model\TaskExtraSeoModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Manage\Model\ConfigModel;
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

class BidController extends ManageController
{  
   public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('任务列表');
        $this->theme->set('manageType', 'task');
    }
    
    public function bidList(Request $request)
    {  
        $search = $request->all();
        $by = $request->get('by') ? $request->get('by') : 'id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;
		$taskType=TaskTypeModel::select('id')->where('alias',"zhaobiao")->first();
        $taskList = TaskModel::select('task.id', 'us.name', 'task.title', 'task.created_at', 'task.status', 'task.verified_at', 'task.bounty_status')
		            ->where('type_id',$taskType['id']);			
        if ($request->get('task_title')) {
            $taskList = $taskList->where('task.title', 'like', '%' . $request->get('task_id') . '%');
        }
        if ($request->get('username')) {
            $taskList = $taskList->where('us.name', 'like', '%' . e($request->get('username')) . '%');
        }
        
        if ($request->get('status') && $request->get('status') != 0) {
            switch ($request->get('status')) {
                case 1:
                    $status = [0];
                    break;
                case 2:
                    $status = [1, 2];
                    break;
                case 3:
                    $status = [3, 4, 5, 6, 7, 8];
                    break;
                case 4:
                    $status = [9];
                    break;
                case 5:
                    $status = [10];
                    break;
                case 6:
                    $status = [11];
                    break;
            }
            $taskList = $taskList->whereIn('task.status', $status);
        }
        
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
        $taskList = $taskList->orderBy($by, $order)
            ->leftJoin('users as us', 'us.id', '=', 'task.uid')
            ->paginate($paginate);

        $data = array(
            'task' => $taskList,
        );
        $data['merge'] = $search; 
		
        return $this->theme->scope('manage.bidList',$data)->render();
    }
    
    public function bidDetail($id)
    {    
        $task = TaskModel::where('id', $id)->first();
        if (!$task) {
            return redirect()->back()->with(['error' => '当前任务不存在，无法查看稿件！']);
        }
        $query = TaskModel::select('task.*', 'us.name as nickname', 'ud.avatar', 'ud.qq')->where('task.id', $id);
        $taskDetail = $query->join('user_detail as ud', 'ud.uid', '=', 'task.uid')
            ->leftjoin('users as us', 'us.id', '=', 'task.uid')
            ->first();
        if (!$taskDetail) {
            return redirect()->back()->with(['error' => '当前任务已经被删除！']);
        }else{
            $taskDetail = $taskDetail->toArray();
        }
        $status = [
            0 => '暂不发布',
            1 => '已经发布',
            2 => '赏金托管',
            3 => '审核通过',
            4 => '威客交稿',
            5 => '雇主选稿',
            6 => '任务公示',
            7 => '交付验收',
            8 => '双方互评',
            9 => '任务完成',
            10 => '失败',
            11 => '维权'
        ];
        $taskDetail['status_text'] = $status[$taskDetail['status']];

        
        $taskType = TaskTypeModel::all();
        
        $taskDelivery = WorkModel::where('task_id', $id)->where('status', 3)->count();
        
        $task_attachment = TaskAttachmentModel::select('task_attachment.*', 'at.url')->where('task_id', $id)
            ->leftjoin('attachment as at', 'at.id', '=', 'task_attachment.attachment_id')->get()->toArray();
        
        $task_seo = TaskExtraSeoModel::where('task_id', $id)->first();
        
        $works = WorkModel::select('work.*', 'us.name as nickname', 'ud.avatar')
            ->where('work.status', '<=', 1)
            ->where('work.task_id', $id)
            ->with('childrenAttachment')
            ->leftjoin('user_detail as ud', 'ud.uid', '=', 'work.uid')
            ->leftjoin('users as us', 'us.id', '=', 'work.uid')
            ->get()->toArray();

        
        $task_massages = WorkCommentModel::select('work_comments.*', 'us.name as nickname', 'ud.avatar')
            ->leftjoin('user_detail as ud', 'ud.uid', '=', 'work_comments.uid')
            ->leftjoin('users as us', 'us.id', '=', 'work_comments.uid')
            ->where('work_comments.task_id', $id)->paginate();
        
        $work_delivery = WorkModel::select('work.*', 'us.name as nickname', 'ud.mobile', 'ud.qq', 'ud.avatar')
            ->whereIn('work.status', [2, 3])
            ->where('work.task_id', $id)
            ->with('childrenAttachment')
            ->leftjoin('user_detail as ud', 'ud.uid', '=', 'work.uid')
            ->leftjoin('users as us', 'us.id', '=', 'work.uid')
            ->get()->toArray();
        
		$task_service=DB::table('task_service')->leftJoin('service','task_service.service_id','=','service.id')
		                                ->where('task_service.task_id',$id)->sum('service.price');
        $taskDetail['servicePrice']=$task_service;										
        $domain = \CommonClass::getDomain();

        $data = [
            'task' => $taskDetail,
            'domain' => $domain,
            'taskType' => $taskType,
            'taskDelivery' => $taskDelivery,
            'taskAttachment' => $task_attachment,
            'task_seo' => $task_seo,
            'works' => $works,
            'task_massages' => $task_massages,
            'work_delivery' => $work_delivery
        ];
         return $this->theme->scope('manage.bidDetail',$data)->render();
    }
    
    public function bidConfig($id)
    {   
	
	    $configs = ConfigModel::where('type','bid')->get()->toArray();
        $configs_data = array();
        foreach($configs as $k=>$v)
        {
            $configs_data[$v['alias']] = $v;
        }   
        $data = [
            'config'=>$configs_data,
            'id'=>$id
        ];
        return $this->theme->scope('manage.bidConfig', $data)->render();
    }
    

	public function bidConfigUpdate(Request $request){
		$data = $request->except('_token');
        if(!empty($data['change_ids'])){
			foreach($data as $Kda=>$Vta){
			ConfigModel::where('type','bid')->where('alias',$Kda)->update(['rule'=>$Vta]);
			
			}			
			return redirect()->back()->with(['error'=>'修改成功！']);
		}else{
			return redirect()->back()->with(['error'=>'修改失败！']);
		}
		
	}  
    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        
    }

    
    public function update(Request $request, $id)
    {
        
    }

    
    public function destroy($id)
    {
        
    }
}
