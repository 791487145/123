<?php
namespace App\Modules\User\Http\Controllers;


use App\Http\Controllers\UserCenterController;
use App\Http\Requests;
use App\Modules\Employ\Models\UnionAttachmentModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\ServiceModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\Task\Model\TaskAttachmentModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\Task\Model\TaskFocusModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskTypeModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Http\Requests\PubGoodsRequest;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\CommentModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\User\Model\TagsModel;
use App\Modules\User\Model\UserFocusModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Theme;
use App\Modules\User\Model\UserDetailModel;

class UserMoreController extends UserCenterController
{
    public function __construct()
    {
        parent::__construct();
        $this->user = Auth::user();
    }

    /**
     * 我的收藏任务
     * @return mixed
     */
    public function myTocusTask(Request $request)
    {
        $data = $request->all();
        $this->initTheme('usercenter');//主题初始化
        $this->theme->setTitle('用户收藏');

        //查询我收藏的任务
        $query = TaskFocusModel::select('task_focus.id as focus_id','tk.*','tc.name as category_name','ud.avatar')
            ->where('task_focus.uid',$this->user['id'])->orderby('task_focus.created_at','DESC')
            ->join('task as tk','tk.id','=','task_focus.task_id');
        if(!empty($data['search']))
        {
            $query->where('tk.title','like','%'.e($data['search'])."%");
        }
        $query = $query->leftjoin('cate as tc','tc.id','=','tk.cate_id')
            ->leftjoin('user_detail as ud','ud.uid','=','tk.uid');

        $task = $query->paginate(5);
        $task_focus = $task->toArray();
        if(!empty($task_focus['data']) && is_array($task_focus['data'])){
            foreach($task_focus['data'] as $k => $v){
                $provinceName = DistrictModel::getDistrictName($v['province']);
                $cityName = DistrictModel::getDistrictName($v['city']);
                $task_focus['data'][$k]['province_name'] = $provinceName;
                $task_focus['data'][$k]['city_name'] = $cityName;
            }
        }
        $status = [
            'status'=>[
                0=>'暂不发布',
                1=>'已经发布',
                2=>'赏金托管',
                3=>'审核通过',
                4=>'威客交稿',
                5=>'雇主选稿',
                6=>'任务公示',
                7=>'交付验收',
                8=>'双方互评'
            ]
        ];
        $task_focus['data'] = \CommonClass::intToString($task_focus['data'],$status);
        $domain = \CommonClass::getDomain();

        $view = [
            'task'=>$task,
            'task_focus'=>$task_focus,
            'domain'=>$domain,
        ];
        return $this->theme->scope('user.myfocus', $view)->render();
    }

    /**
     * ajax删除关注任务
     */
    public function ajaxDeleteFocus($id)
    {
        $result = TaskFocusModel::where('uid',$this->user['id'])
            ->where('id',$id)->delete();
        if(!$result) return response()->json(['errCode'=>0,'errMsg'=>'删除失败！']);

        return response()->json(['errCode'=>1,'id'=>$id]);
    }

    /**
     * 用户关注
     */
    public function userFocus()
    {
        $this->initTheme('usercenter');//主题初始化
        $this->theme->setTitle('用户关注');
        //关注的人
        $focus = UserFocusModel::select('user_focus.*','ud.avatar','us.name as nickname')
            ->where('user_focus.uid',$this->user['id'])
            ->join('user_detail as ud','user_focus.focus_uid','=','ud.uid')
            ->leftjoin('users as us','user_focus.focus_uid','=','us.id')
            ->with('tags')
            ->paginate(10);
        $tags_data = TagsModel::findAll();
        $tags = array();
        foreach($tags_data as $v)
        {
            $tags[$v['id']] = $v;
        }

        //关注的人的标签
        $focus_data = $focus->toArray();
        foreach($focus_data['data'] as $k=>$v)
        {
            foreach($v['tags'] as $key=>$value)
            {
                if(!empty($tags[$value['tag_id']]['tag_name']))
                {
                    $focus_data['data'][$k]['tags'][$key]['tag_name'] = $tags[$value['tag_id']]['tag_name'];
                }
            }
        }

        //取得用户的标签数据

        $domain = \CommonClass::getDomain();

        $view = [
            'focus'=>$focus,
            'focus_data'=>$focus_data,
            'domain'=>$domain,
        ];
        return $this->theme->scope('user.userfocus', $view)->render();
    }

    /**
     * 删除user关注
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function userFocusDelete($id)
    {
        $result = UserFocusModel::where('uid',$this->user['id'])
            ->where('id',$id)->delete();
        if(!$result) return response()->json(['errCode'=>0,'errMsg'=>'删除失败！']);

        return response()->json(['errCode'=>1,'id'=>$id]);
    }

    /**
     * 粉丝取消关注
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function userNotFocus($id)
    {
        $result = UserFocusModel::where('uid',$this->user['id'])
            ->where('focus_uid',$id)->delete();
        if(!$result) return response()->json(['errCode'=>0,'errMsg'=>'删除失败！']);

        return response()->json(['errCode'=>1,'id'=>$id]);
    }
    /*
     * 我发布的任务
     */
    public function myTasksList(Request $request)
    {
        $this->initTheme('usertask');//主题初始化
        $this->theme->setTitle('我发布的任务');

        $data = $request->all();

        $data['uid'] = $this->user['id'];
         //任务模式
		$taskType=TaskTypeModel::getTaskTypeAll();
		foreach($taskType as $Vtt){
			$Vtt->counts=TaskModel::where('uid',$data['uid'])->where('type_id',$Vtt['id'])->where('status','>',0)->count();
		}
		$data['type']=isset($data['type'])?$data['type']:$taskType[0]['id'];
		$data['status']=isset($data['status'])?$data['status']:0;
		if($taskType[0]['alias'] == 'xuanshang' && !isset($data['type'])){
			$taskStatus=[
				15=>'投标中',
				2=>'选标中',
				1=>'工作中',
				3=>'交付中',
				4=>'已结束',
				5=>'其他'
		    ];
		}else{
			$taskTM=TaskTypeModel::select('alias')->where('id',$data['type'])->first();
			switch($taskTM['alias']){
				case 'xuanshang':
				$taskStatus=[
                    15=>'投标中',
                    2=>'选标中',
					1=>'工作中',
					3=>'交付中',
					4=>'已结束',
					5=>'其他'
		        ];
				$status = [
					2=>'已发布',
					3=>'投标中',
					4=>'选标中',
					5=>'选标中',
					6=>'工作中',
					7=>'交付中',
					8=>'已结束',
					9=>'已结束',
					10=>'已结束',
					11=>'维权中'
				]; 
				if(isset($data['status']) && !in_array($data['status'],[1,2,3,4,5,15])){
					$data['status']=0;
				}
				break;
				case 'zhaobiao':
				$taskStatus=[
					6=>'待审核', 
					7=>'投标中',
					8=>'选标中',
					9=>'工作中',
					10=>'验收中',
					11=>'维权中',
					12=>'交易成功',
					13=>'交易关闭'
		        ];
				$status = [
					1=>'待审核',
					3=>'投标中',
					4=>'选标中',
					5=>'工作中',
					6=>'工作中',
					7=>'验收中',
					8=>'交易成功',
					9=>'交易成功',
					10=>'交易关闭',
					11=>'维权中'
				]; 
				if(isset($data['status']) && !in_array($data['status'],[6,7,8,9,10,11,12,13])){
					$data['status']=0;
				}
				break;
			}
		}
        $my_tasks = TaskModel::myTasks($data);	
		foreach($my_tasks as $key => $val){
                if((time()-strtotime($val['created_at']))> 0 && (time()-strtotime($val['created_at'])) < 3600){
                    $val['show_publish'] = intval((time()-strtotime($val['created_at']))/60).'分钟前';
                }
                if((time()-strtotime($val['created_at']))> 3600 && (time()-strtotime($val['created_at'])) < 24*3600){
                    $val['show_publish'] = intval((time()-strtotime($val['created_at']))/3600).'小时前';
                }
                if((time()-strtotime($val['created_at']))> 24*3600){
                    $val['show_publish'] = intval((time()-strtotime($val['created_at']))/(24*3600)).'天前';
                }
        }
        $domain = \CommonClass::getDomain();


//        $my_tasks['data'] = \CommonClass::intToString($my_tasks['data'],$status);
        $pie_data = \CommonClass::pie($this->user['id']);
        $view = [
            'my_tasks'=>$my_tasks,
            'domain'=>$domain,
            'pie_data'=>$pie_data,
            'status'=>$status,
			'task_type'=>$taskType,
			'merge'    =>$data,
			'task_status'=>$taskStatus
        ];
        $this->theme->set('TYPE',2);
        return $this->theme->scope('user.mytasklist', $view)->render();
    }
    /*
     * 我发布的任务时间轴
     */
    public function myTaskAxis(Request $request)
    {
        $this->initTheme('usertask');//主题初始化
        $this->theme->setTitle('我发布的任务');

        $data = $request->all();
        $query =  $query = TaskModel::select('task.*', 'tt.name as type_name', 'us.name as nickname','ud.avatar','tc.name as cate_name','province.name as province_name','city.name as city_name')
            ->where('task.status', '>', 1)
            ->where('task.status', '<=', 11)->where('task.uid',$this->user['id']);
        //搜索
        if(!empty($data['search']))
        {
            $query->where('task.title','like','%'.e($data['search']).'%');
        }

        $my_tasks = $query->join('task_type as tt','task.type_id','=','tt.id')
            ->leftjoin('district as province','province.id','=','task.province')
            ->leftjoin('district as city','city.id','=','task.city')
            ->leftjoin('users as us','us.id','=','task.uid')
            ->leftjoin('user_detail as ud','ud.uid','=','task.uid')
            ->leftjoin('cate as tc','tc.id','=','task.cate_id')
            ->orderBy('task.created_at','desc')
            ->paginate(5)->toArray();
        $status = [
            'status'=>[
                2=>'审核中',
                3=>'工作中',
                4=>'工作中',
                5=>'选稿中',
                6=>'工作中',
                7=>'交付中',
                8=>'已结束',
                9=>'已结束',
                10=>'已结束',
                11=>'维权中'
            ]
        ];
        $my_tasks['data'] = \CommonClass::intToString($my_tasks['data'],$status);
        $my_tasks_data = collect($my_tasks['data']);
        $my_tasks_data_group = $my_tasks_data->keyBy('created_at')->toArray();

        $my_tasks_group = array();
        foreach($my_tasks_data_group as $k=>$v)
        {
            $my_tasks_group[date('Ymd',strtotime($k))][] = $v;
        }
        $my_tasks['data'] = $my_tasks_group;

        $domain = \CommonClass::getDomain();
        $pie_data = \CommonClass::pie($this->user['id']);
        $view = [
            'my_tasks'=>$my_tasks,
            'num'=>0,
            'domain'=>$domain,
            'pie_data'=>$pie_data,
        ];
        $this->theme->set('TYPE',2);
        return $this->theme->scope('user.mytaskaxis', $view)->render();
    }

    /**
     * ajax下一页功能
     * @param Request $request
     */
    public function myTaskAxisAjax(Request $request)
    {
        $data = $request->all();
        $query = TaskModel::select('task.*', 'tt.name as type_name', 'us.name as nickname','ud.avatar','tc.name as cate_name','province.name as province_name','city.name as city_name')
            ->where('task.status', '>', 1)
            ->where('task.status', '<=', 11)
            ->where('task.uid',$this->user['id']);

        $pageSize =  $data['page']*5;

        $my_tasks = $query->join('task_type as tt','task.type_id','=','tt.id')
            ->leftjoin('district as province','province.id','=','task.province')
            ->leftjoin('district as city','city.id','=','task.city')
            ->leftjoin('users as us','us.id','=','task.uid')
            ->leftjoin('user_detail as ud','ud.uid','=','task.uid')
            ->leftjoin('cate as tc','tc.id','=','task.cate_id')
            ->orderBy('task.created_at','desc')
            ->limit($pageSize)->get()->toArray();
        $status = [
            'status'=>[
                2=>'审核中',
                3=>'工作中',
                4=>'工作中',
                5=>'选稿中',
                6=>'工作中',
                7=>'交付中',
                8=>'已结束',
                9=>'已结束',
                10=>'已结束',
                11=>'维权中'
            ]
        ];
        $my_tasks = \CommonClass::intToString($my_tasks,$status);
        //处理创建时间
        foreach($my_tasks as $k=>$v)
        {
            $my_tasks[$k]['task_axis_time'] = date('m-d',strtotime($v['created_at']));
            $my_tasks[$k]['task_axis_endat'] = round((time()-strtotime($v['created_at']))/(3600*24));
        }
        $my_tasks_data = collect($my_tasks);
        $my_tasks_data_group = $my_tasks_data->keyBy('created_at')->toArray();
        $tasks_group = array();
        foreach($my_tasks_data_group as $k=>$v)
        {
            $tasks_group[date('Ymd',strtotime($k))][] = $v;
        }
        $my_tasks_group = array();
        $number = 0;
        $domain = \CommonClass::getDomain();
        foreach($tasks_group as $k=>$v)
        {
            foreach($v as $key=>$value)
            {
                $v[$key]['desc'] = str_limit(strip_tags(htmlspecialchars_decode($v[$key]['desc'])));
                if(empty($v[$key]['avatar']))
                {
                    $v[$key]['avatar'] = $this->theme->asset()->url('images/defauthead.png');
                }
            }
            $my_tasks_group[$number]['datas'] = $v;
            $my_tasks_group[$number]['times']['taskaxis_year'] = date('Y',strtotime($k));
            $my_tasks_group[$number]['times']['taskaxis_month'] = date('m',strtotime($k));
            $my_tasks_group[$number]['times']['taskaxis_day'] = date('d',strtotime($k));
            $number++;
        }
        $my_tasks = $my_tasks_group;


        $total_num = TaskModel::where('task.status','>',1)->where('task.uid',$this->user['id'])->count();

        $view = [
            'my_tasks'=>$my_tasks,
            'num'=>0,
            'domain'=>$domain,
            'pagesize'=>$pageSize,
            'total_num'=>$total_num
        ];
        return response()->json($view);
    }
    /**
     * 雇主交易评价
     */
    public function myCommentOwner(Request $request)
    {
        $this->initTheme('usertask');//主题初始化
        $this->theme->setTitle('雇主交易评价');
        $data = $request->all();
        //查询所有当前雇主的任务
        $query = CommentModel::select('comments.*','tk.title','tk.bounty','tk.created_at as task_create','us.name as nickname','ud.avatar')
            ->join('task as tk','tk.id','=','comments.task_id');

        //筛选类型 给威客的评价
        if(!empty($data['from']) && $data['from']=1){
            $query->where('comments.to_uid',$this->user['id'])->leftjoin('user_detail as ud','ud.uid','=','comments.from_uid')
            ->leftjoin('users as us','us.id','=','comments.from_uid');
        }else{
            $query->where('comments.from_uid',$this->user['id'])->leftjoin('user_detail as ud','ud.uid','=','comments.to_uid')
                ->leftjoin('users as us','us.id','=','comments.to_uid');
        }
        //筛选好中差评
        if(!empty($data['type']) && $data['type']!=0){
            $query->where('type',$data['type']);
        }
        $comment = $query->orderBy('created_at','desc')->paginate(5);
        $comment_data = $comment->toArray();
        foreach($comment_data['data'] as $k=>$v){
            $comment_data['data'][$k]['globle_score'] = round(($v['speed_score']+$v['quality_score']+$v['attitude_score'])/3,1);
        }

        $domain = \CommonClass::getDomain();

        $view = [
            'merge' => $data,
            'comment'=>$comment,
            'comment_data'=>$comment_data,
            'domain'=>$domain
        ];
        $this->theme->set('TYPE',2);
        return $this->theme->scope('user.mycommentowner', $view)->render();
    }

    /**
     *我的投稿记录
     */
    public function myWorkHistory(Request $request)
    {
        $this->initTheme('usercenter');//主题初始化
        $this->theme->setTitle('雇主交易评价');
        $data = $request->all();

        $query = WorkModel::select(
            'work.*',
            'tk.title as task_title',
            'tk.bounty',
            'tk.uid as task_uid',
            'tk.desc as task_desc',
            'tk.view_count',
            'tk.delivery_count',
            'tk.bounty_status',
            'us.name as nickname',
            'ud.avatar',
            'tc.name as cate_name')
            ->where('work.uid',$this->user['id'])
            ->join('task as tk','tk.id','=','work.task_id')
            ->leftjoin('user_detail as ud','ud.uid','=','tk.uid')
            ->leftjoin('users as us','us.id','=','tk.uid')
            ->leftjoin('cate as tc','tc.id','=','tk.cate_id');

        //类别筛选
//        if (isset($data['category']) && $data['category']!=0)
//        {
//            //查询所有的底层id
//            $category_ids = TaskCateModel::where('path','like','%'.$data['category'].'%')->lists('id')->toArray();;
//            $query->whereIn('tk.cate_id', $category_ids);
//        }
        //状态筛选
        if (isset($data['status']) && $data['status']!=0)
        {
            switch($data['status'])
            {
                case 1:
                    $status = [3,4,6];
                    break;
                case 2:
                    $status = [5];
                    break;
                case 3:
                    $status = [7];
                    break;
                case 4:
                    $status = [8,9,10];
                    break;
                case 5:
                    $status = [2.11];
            }
            $query->whereIn('tk.status',$status);
        }
        //时间段筛选
        if(isset($data['time']))
        {
            switch($data['time'])
            {
                case 1:
                    $query->whereBetween('work.created_at',[date('Y-m-d H:i:s',strtotime('-1 month')),date('Y-m-d H:i:s',time())]);
                    break;
                case 2:
                    $query->whereBetween('work.created_at',[date('Y-m-d H:i:s',strtotime('-3 month')),date('Y-m-d H:i:s',time())]);
                    break;
                case 3:
                    $query->whereBetween('work.created_at',[date('Y-m-d H:i:s',strtotime('-6 month')),date('Y-m-d H:i:s',time())]);
                    break;
            }

        }
        $my_works = $query->paginate(5)->toArray();
        $domain = \CommonClass::getDomain();

        $view = [
            'my_works'=>$my_works,
            'domain'=>$domain
        ];

        return $this->theme->scope('user.myworkhistory', $view)->render();
    }

    public function myWorkHistoryAxis(Request $request)
    {
        $this->initTheme('usercenter');//主题初始化
        $this->theme->setTitle('我发布的任务');

        $data = $request->all();
        $query = WorkModel::select(
            'work.*',
            'tk.title as task_title',
            'tk.bounty',
            'tk.uid as task_uid',
            'tk.desc as task_desc',
            'tk.view_count',
            'tk.delivery_count',
            'tk.bounty_status',
            'ud.nickname',
            'ud.avatar',
            'tc.name as cate_name')
            ->where('work.uid',$this->user['id'])
            ->join('task as tk','tk.id','=','work.task_id')
            ->leftjoin('user_detail as ud','ud.uid','=','tk.uid')
            ->leftjoin('users as us','us.id','=','tk.uid')
            ->leftjoin('cate as tc','tc.id','=','tk.cate_id');
        //搜索
        if(!empty($data['search']))
        {
            $query->where('tk.title','like','%'.e($data['search']).'%');
        }

        $my_tasks = $query->paginate(5)->toArray();

        $my_tasks_data = collect($my_tasks['data']);
        $my_tasks_data_group = $my_tasks_data->keyBy('created_at')->toArray();
        $my_tasks_group = array();

        foreach($my_tasks_data_group as $k=>$v)
        {
            $my_tasks_group[date('Ym',strtotime($k))][] = $v;
        }
        $my_tasks['data'] = $my_tasks_group;

        $domain = \CommonClass::getDomain();
        $view = [
            'my_tasks'=>$my_tasks,
            'num'=>0,
            'domain'=>$domain
        ];

        return $this->theme->scope('user.myworkhistoryaxis', $view)->render();
    }

    /**
     * 未发布的任务
     */
    public function unreleasedTasks(Request $request)
    {
        $this->initTheme('usertask');//主题初始化
        $this->theme->setTitle('未发布的任务');
        //任务模式
		$taskType=TaskTypeModel::getTaskTypeAll();
        //查询我未发布的任务
        $unreleased = TaskModel::select('task.*','task_type.alias')->where('task.uid',$this->user['id'])
            ->whereIn('task.status',[0,1])
			->leftJoin('task_type','task.type_id','=','task_type.id')
			->orderBy('task.created_at','desc');
		 if($request->get('type') && $request->get('type') !=0){
			$unreleased=$unreleased->where('task.type_id',$request->get('type'));
		} 	
         $unreleased=$unreleased->paginate(5)->toArray();      
        foreach($unreleased['data'] as $k=>$v)
        {
            $cate = TaskCateModel::findById($v['cate_id']);
            if(!empty($cate['name'])){
                $unreleased['data'][$k]['cate_name'] = $cate['name'];
            }else{
                $unreleased['data'][$k]['cate_name'] = '';
            }

        }
        $view = [
            'unreleased'=>$unreleased,
			'task_type' =>$taskType,
			'type'      =>$request->get('type')
        ];
        $this->theme->set('TYPE',2);
        return $this->theme->scope('user.unreleasedtasks', $view)->render();
    }

    /**
     * 删除未发布的任务
     * @param $id
     */
    public function unreleasedTasksDelete($id)
    {
        //检查是否为任务发布者
        $task = TaskModel::where('id',$id)->first();
        if($task['uid']!=$this->user['id'])
        {
            return redirect()->back()->with('error','你不是任务的发布者不能删除！');
        }
        //删除任务和任务附件
        $result = DB::transaction(function() use($id){
            TaskModel::destroy($id);//删除任务
            $task_attachment = TaskAttachmentModel::where('task_id',$id)->lists('attachment_id');
            $task_attachment_ids = array_flatten($task_attachment);
            if(!empty($task_attachment_ids)){
                AttachmentModel::destroy([$task_attachment_ids]);
            }
        });

        if(!is_null($result))
            return redirect()->to('/user/unreleasedTasks')->with(['error'=>'删除失败！']);

        return redirect()->to('/user/unreleasedTasks')->with(['message'=>'删除成功！']);
    }

    //我承接的任务
    public function myTask(Request $request)
    {
        $this->initTheme('accepttask');//主题初始化
        $this->theme->setTitle('我承接的任务');

        //饼状图数据处理
        $pie_chart = \CommonClass::myTaskPie($this->user['id']);
        $domain = \CommonClass::getDomain();
        $my_tasks_group = array();

        $taskIDs = WorkModel::where('uid',$this->user['id'])->select('task_id')->get()->toArray();
        if(count($taskIDs)){
            $taskIDs = array_unique(array_flatten($taskIDs));
            $id = [2,3,4,5,6,7,8,9,10,11];
            $taskInfo = TaskModel::whereIn('id',$taskIDs)->whereIn('status',$id);
            if($request->get('search')){
                $taskInfo = $taskInfo->where('title','like','%'.$request->get('search').'%');
            }
            $taskInfo = $taskInfo->orderBy('created_at','desc')->select('*')->paginate(5)->toArray();
            $userInfo = UserDetailModel::where('uid',$this->user['id'])->select('avatar')->first();
            foreach($taskInfo['data'] as $k=>$v){
                $taskTypeInfo = TaskTypeModel::where('id',$v['type_id'])->select('name')->first();
                if($taskTypeInfo){
                   $v['type_name'] =  $taskTypeInfo->name;
                }
                else{
                    $v['type_name'] =  '';
                }
                $taskCateInfo = TaskCateModel::findById($v['cate_id']);
                if($taskCateInfo){
                    $v['cate_name'] =  $taskCateInfo['name'];
                }
                else{
                    $v['cate_name'] =  '';
                }
                $v['nickname'] = $this->user['name'];
                $v['avatar'] = $userInfo->avatar;
                $taskInfo['data'][$k] = $v;
            }
            $my_tasks_data = collect($taskInfo['data']);
            $my_tasks_data_group = $my_tasks_data->toArray();
            $status = [
                'status'=>[
                    2=>'审核中',
                    3=>'工作中',
                    4=>'工作中',
                    5=>'选稿中',
                    6=>'工作中',
                    7=>'交付中',
                    8=>'已结束',
                    9=>'已结束',
                    10=>'已结束',
                    11=>'维权中'
                ]
            ];
            $my_tasks_data_group = \CommonClass::intToString($my_tasks_data_group,$status);
            foreach($my_tasks_data_group as $k=>$v)
            {
                $my_tasks_group[date('YmdHis',strtotime($k))][] = $v;
            }
            $taskInfo['data'] = $my_tasks_group;

            $view = [
                'my_tasks'=>$taskInfo,
                'pie_data'=>$pie_chart,
                'num'=>0,
                'domain'=>$domain,
                'search'=>$request->get('search')
            ];

        }
        else{
            $view = [
                'my_tasks'=>$my_tasks_group,
                'pie_data'=>$pie_chart,
                'num'=>0,
                'domain'=>$domain
            ];

        }
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.mytask', $view)->render();
    }

    //我接受的任务
    public function acceptTasksList(Request $request)
    {
        $this->initTheme('accepttask');//主题初始化
        $this->theme->setTitle('我承接的任务');

        $pie_chart = \CommonClass::myTaskPie($this->user['id']);
        $domain = \CommonClass::getDomain();
        $data=$request->all();
        $taskIDs = WorkModel::where('uid',$this->user['id'])->select('task_id')->get()->toArray();
        //$taskIDs = WorkModel::where('uid',$this->user['id'])->select('task_id')->get()->toArray();
        //获取任务模式
		$taskType=TaskTypeModel::getTaskTypeAll();
		$data['type']=$request->get('type')?$request->get('type'):$taskType[0]['id'];
		$data['status']=$request->get('status')?$request->get('status'):0;
		if($taskType[0]['alias'] == 'xuanshang' && !isset($data['type'])){
			$taskStatus=[
                15=>'投标中',
                2=>'选标中',
                1=>'工作中',
                3=>'交付中',
                4=>'已结束',
                5=>'其他'
		    ];
		}else{
			$taskTM=TaskTypeModel::select('alias')->where('id',$data['type'])->first();
			switch($taskTM['alias']){
				case 'xuanshang':
				$taskStatus=[
                    15=>'投标中',
                    2=>'选标中',
                    1=>'工作中',
                    3=>'交付中',
                    4=>'已结束',
                    5=>'其他'
		        ];
                    $tsStatus = [
                        'status'=>[
                            2=>'已发布',
                            3=>'投标中',
                            4=>'选标中',
                            5=>'选标中',
                            6=>'工作中',
                            7=>'交付中',
                            8=>'已结束',
                            9=>'已结束',
                            10=>'已结束',
                            11=>'维权中'
                        ]
                    ];
				if(isset($data['status']) && !in_array($data['status'],[1,2,3,4,5,15])){
					$data['status']=0;
				}
				break;
				case 'zhaobiao':
				$taskStatus=[ 
					7=>'投标中',
					8=>'选标中',
					9=>'工作中',
					10=>'验收中',
					11=>'维权中',
					12=>'交易成功',
					13=>'交易关闭'
		        ];
                    $tsStatus = [
                        'status'=>[
                            1=>'待审核',
                            3=>'投标中',
                            4=>'选标中',
                            5=>'选标中',
                            6=>'工作中',
                            7=>'验收中',
                            8=>'交易成功',
                            9=>'交易成功',
                            10=>'交易关闭',
                            11=>'维权中'
                        ]
                    ];
				if(isset($data['status']) && !in_array($data['status'],[6,7,8,9,10,11,12,13])){
					$data['status']=0;
				}
				break;
			}
		}
		if(count($taskIDs)){
            $taskIDs = array_unique(array_flatten($taskIDs));
            $id = [2,3,4,5,6,7,8,9,10,11];
            $taskInfo = TaskModel::whereIn('id',$taskIDs)->whereIn('status',$id);
			//计算任务模式下的任务个数
			foreach($taskType as $Vtt){
				$Vtt->counts=TaskModel::whereIn('id',$taskIDs)->whereIn('status',$id)->where('type_id',$Vtt->id)->count();
			}
            //类型筛选
            if($request->get('type')){
                $taskInfo = $taskInfo->where('type_id',$request->get('type'));
            }else{
				$taskInfo = $taskInfo->where('type_id',$taskType[0]['id']);
			}
            //状态筛选
            if ($request->get('status'))
            {
                switch($request->get('status'))
                {  
					case 1:
						$status = [3, 4, 6];
						break;
					case 2:
						$status = [4];
						break;
					case 3:
						$status = [7];
						break;
					case 4:
						$status = [8, 9, 10];
						break;
					case 5:
						$status = [2, 11];
						break;
					case 6:
						$status = [1];
						break;
					case 7:
						$status = [3,4];
						break;
					case 8:
						$status = [5];
						break;
					case 9:
						$status = [6];
						break;
					case 10:
						$status = [7];
						break;
					case 11:
						$status = [11];
						break;
					case 12:
						$status = [8,9];
						break;
					case 13:
						$status = [10];
						break; 
					case 14:
						$status = [8,9,10];
						break;
                    case 15:
                        $status = [3];
                        break;
					/* 
					
                    case 1:
                        $status = [3,4,6];
                        break;
                    case 2:
                        $status = [5];
                        break;
					case 4:
                        $status = [8,9,10];
                        break;	
                    case 7:
                        $status = [7];
                        break;
                    case 9:
                        $status = [8,9];
                        break;
					case 11:
                        $status = [11];
                        break;
                    case 12:
                        $status = [8,9];
                        break;
                    case 13:
						$status = [10];
						break; 
					case 14:
						$status = [8,9,10];
						break; */		
                }
                $taskInfo->whereIn('status',$status);
            }

            //时间段筛选
            if($request->get('time'))
            {
                switch($request->get('time'))
                {
                    case 1:
                        $taskInfo->whereBetween('created_at',[date('Y-m-d H:i:s',strtotime('-1 month')),date('Y-m-d H:i:s',time())]);
                        break;
                    case 2:
                        $taskInfo->whereBetween('created_at',[date('Y-m-d H:i:s',strtotime('-3 month')),date('Y-m-d H:i:s',time())]);
                        break;
                    case 3:
                        $taskInfo->whereBetween('created_at',[date('Y-m-d H:i:s',strtotime('-6 month')),date('Y-m-d H:i:s',time())]);
                        break;
                }

            }

            $taskInfoO = $taskInfo->with('province')->with('city')->orderBy('created_at','desc')->select('*')->paginate(5);
            $taskInfo = $taskInfoO->toArray();

            foreach($taskInfo['data'] as $k=>$v){
                $taskTypeInfo = TaskTypeModel::where('id',$v['type_id'])->select('name')->first();
                if($taskTypeInfo){
                    $v['type_name'] =  $taskTypeInfo->name;
                }
                else{
                    $v['type_name'] =  '';
                }
                $taskCateInfo = TaskCateModel::findById($v['cate_id']);
                if($taskCateInfo){
                    $v['cate_name'] =  $taskCateInfo['name'];
                }
                else{
                    $v['cate_name'] =  '';
                }
                $userInfo = UserDetailModel::where('uid',$v['uid'])->select('avatar')->first();
                if($userInfo){
                    $v['avatar'] =  $userInfo->avatar;
                }
                else{
                    $v['avatar'] =  '';
                }
                $username = UserModel::where('id',$v['uid'])->select('name')->first();
                if($username){
                    $v['nickname'] =  $username->name;
                }
                else{
                    $v['nickname'] =  '';
                }
                /*$v['nickname'] = $username->name;
                $v['avatar'] = $userInfo->avatar;*/
                $taskInfo['data'][$k] = $v;
            }
           /* $status = [
                'status'=>[
                    2=>'审核中',
                    3=>'工作中',
                    4=>'工作中',
                    5=>'选稿中',
                    6=>'工作中',
                    7=>'交付中',
                    8=>'已结束',
                    9=>'已结束',
                    10=>'已结束',
                    11=>'维权中'
                ]
            ];*/
            $taskInfo['data'] = \CommonClass::intToString($taskInfo['data'],$tsStatus);
            if(!empty($taskInfo['data'])){
				foreach($taskInfo['data'] as $key => $val){
					if((time()-strtotime($val['created_at']))> 0 && (time()-strtotime($val['created_at'])) < 3600){
						$taskInfo['data'][$key]['show_publish'] = intval((time()-strtotime($val['created_at']))/60).'分钟前';
					}
					if((time()-strtotime($val['created_at']))> 3600 && (time()-strtotime($val['created_at'])) < 24*3600){
						$taskInfo['data'][$key]['show_publish'] = intval((time()-strtotime($val['created_at']))/3600).'小时前';
					}
					if((time()-strtotime($val['created_at']))> 24*3600){
						$taskInfo['data'][$key]['show_publish'] = intval((time()-strtotime($val['created_at']))/(24*3600)).'天前';
					}
				}	
            }
            $view = [
                'my_tasks'  =>  $taskInfo,
                'taskInfo_obj' => $taskInfoO,
                'pie_data' =>  $pie_chart,
                'domain'    =>  $domain,
                'merge' => $data,
                'type'      =>  $request->get('type'),
                'status'    =>  $request->get('status'),
                'time'      =>  $request->get('time'),
				'task_type'  =>  $taskType,
				'task_status' => $taskStatus,
				'ts_status'   =>$tsStatus
            ];
        }
        else{
            $view = [
                'my_tasks'=>[],
                'taskInfo_obj' => [],
                'merge' => $data,
                'pie_data'=>$pie_chart,
                'domain'=>$domain,
				'task_type'  =>  $taskType,
				'task_status' => $taskStatus
            ];

        }
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.accepttaskslist', $view)->render();
    }

    /**
     * 威客交易评价
     */
    public function workComment(Request $request)
    {
        $this->initTheme('accepttask');//主题初始化
        $this->theme->setTitle('威客交易评价');
        $data = $request->all();
        $query = CommentModel::select('comments.*','tk.title','tk.bounty','tk.created_at as task_create','users.name as nickname','ud.avatar')
            ->join('task as tk','tk.id','=','comments.task_id');

        //筛选类型
        if(!empty($data['from']) && $data['from']=1)
        {
            $query->where('comments.to_uid',$this->user['id'])->leftjoin('user_detail as ud','ud.uid','=','comments.from_uid')
            ->leftJoin('users','users.id','=','comments.from_uid');
        }else{
            $query->where('comments.from_uid',$this->user['id'])->leftjoin('user_detail as ud','ud.uid','=','comments.to_uid')
                ->leftJoin('users','users.id','=','comments.to_uid');
        }
        //筛选好中差评
        if(!empty($data['type']) && $data['type']!=0){
            $query->where('type',$data['type']);
        }
        $comment_page = $query->paginate(5);
        $comment = $comment_page->toArray();

        foreach($comment['data'] as $k=>$v){
            $comment['data'][$k]['globle_score'] = round(($v['speed_score']+$v['quality_score']+$v['attitude_score'])/3,1);
        }
        $domain = \CommonClass::getDomain();
        $view = [
            'merge' => $data,
            'comment'=>$comment,
            'domain'=>$domain,
            'comment_page'=>$comment_page
        ];
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.workcomment', $view)->render();
    }


    /**
     * ajax请求威客下一页功能
     * @param Request $request
     */
    public function myAjaxTask(Request $request)
    {
        $data = $request->all();
        $taskIDs = WorkModel::where('uid',$this->user['id'])->select('task_id')->get()->toArray();
        $taskIDs = array_unique(array_flatten($taskIDs));
        $query = TaskModel::select('task.*', 'tt.name as type_name', 'us.name as nickname','ud.avatar','tc.name as cate_name','province.name as province_name','city.name as city_name')
            ->where('task.status', '>', 1)
            ->where('task.status', '<=', 11)
            ->whereIn('task.id',$taskIDs);

        $pageSize =  $data['page']*5;

        $my_tasks = $query->join('task_type as tt','task.type_id','=','tt.id')
            ->leftjoin('district as province','province.id','=','task.province')
            ->leftjoin('district as city','city.id','=','task.city')
            ->leftjoin('users as us','us.id','=','task.uid')
            ->leftjoin('user_detail as ud','ud.uid','=','task.uid')
            ->leftjoin('cate as tc','tc.id','=','task.cate_id')
            ->orderBy('task.created_at','desc')
            ->limit($pageSize)->get()->toArray();
        $status = [
            'status'=>[
                2=>'审核中',
                3=>'工作中',
                4=>'工作中',
                5=>'选稿中',
                6=>'工作中',
                7=>'交付中',
                8=>'已结束',
                9=>'已结束',
                10=>'已结束',
                11=>'维权中'
            ]
        ];
        $my_tasks = \CommonClass::intToString($my_tasks,$status);
        //处理创建时间
        foreach($my_tasks as $k=>$v)
        {
            $my_tasks[$k]['task_axis_time'] = date('m-d',strtotime($v['created_at']));
            $my_tasks[$k]['task_axis_endat'] = round((time()-strtotime($v['created_at']))/(3600*24));
        }
        $my_tasks_data = collect($my_tasks);
        $my_tasks_data_group = $my_tasks_data->keyBy('created_at')->toArray();
        $tasks_group = array();
        foreach($my_tasks_data_group as $k=>$v)
        {
            $tasks_group[date('Ymd',strtotime($k))][] = $v;
        }
        $my_tasks_group = array();
        $number = 0;
        $domain = \CommonClass::getDomain();
        foreach($tasks_group as $k=>$v)
        {
            foreach($v as $key=>$value)
            {
                $v[$key]['desc'] = str_limit(strip_tags(htmlspecialchars_decode($v[$key]['desc'])));
                if(empty($v[$key]['avatar']))
                {
                    $v[$key]['avatar'] = $this->theme->asset()->url('images/defauthead.png');
                }
            }
            $my_tasks_group[$number]['datas'] = $v;
            $my_tasks_group[$number]['times']['taskaxis_year'] = date('Y',strtotime($k));
            $my_tasks_group[$number]['times']['taskaxis_month'] = date('m',strtotime($k));
            $my_tasks_group[$number]['times']['taskaxis_day'] = date('d',strtotime($k));
            $number++;
        }
        $my_tasks = $my_tasks_group;


        $total_num = TaskModel::where('task.status','>',1)->where('task.uid',$this->user['id'])->count();

        $view = [
            'my_tasks'=>$my_tasks,
            'num'=>0,
            'domain'=>$domain,
            'pagesize'=>$pageSize,
            'total_num'=>$total_num
        ];
        return response()->json($view);
    }
    /**
     * 我的粉丝
     */
    public function userfans()
    {
        $this->initTheme('usercenter');//主题初始化
        $this->theme->setTitle('我的粉丝');
        //我的粉丝
        $focus = UserFocusModel::select('user_focus.*','ud.avatar','us.name as nickname')
            ->where('user_focus.focus_uid',$this->user['id'])
            ->leftjoin('users as us','user_focus.uid','=','us.id')
            ->leftjoin('user_detail as ud','ud.uid','=','user_focus.uid')
            ->with('tagsfans')
            ->paginate(10);
        //查询我关注的人的id
        $my_focus_ids = UserFocusModel::where('uid',$this->user['id'])->lists('focus_uid')->toArray();
        $tags_data = TagsModel::findAll();
        $tags = array();
        foreach($tags_data as $v)
        {
            $tags[$v['id']] = $v;
        }

        //我的粉丝的标签
        $focus_data = $focus->toArray();
        foreach($focus_data['data'] as $k=>$v)
        {
            foreach($v['tagsfans'] as $key=>$value)
            {
                if(!empty($tags[$value['tag_id']]['tag_name']))
                {
                    $focus_data['data'][$k]['tagsfans'][$key]['tag_name'] = $tags[$value['tag_id']]['tag_name'];
                }
            }
        }
        //取得用户的标签数据

        $domain = \CommonClass::getDomain();

        $view = [
            'focus'=>$focus,
            'focus_data'=>$focus_data,
            'domain'=>$domain,
            'my_focus_ids'=>$my_focus_ids
        ];

        return $this->theme->scope('user.userfans',$view)->render();
    }

    //店铺
    public function usershop()
    {
        $this->initTheme('usertask');//主题初始化
        return $this->theme->scope('user.usershop')->render();
    }
    //店铺企业认证
    public function usershopqy()
    {
        $this->initTheme('usertask');//主题初始化
        return $this->theme->scope('user.usershopqy')->render();
    }





    //店铺发布服务
    public function usershopfw()
    {
        $this->initTheme('usertask');//主题初始化
        return $this->theme->scope('user.usershopfw')->render();
    }
    //店铺发布案例
    public function usershopal()
    {
        $this->initTheme('usertask');//主题初始化
        return $this->theme->scope('user.usershopal')->render();
    }
    //店铺商品管理
    public function usershopspgl()
    {
        $this->initTheme('usertask');//主题初始化
        return $this->theme->scope('user.usershopspgl')->render();
    }

    //店铺案例管理
    public function usershopalgl()
    {
        $this->initTheme('usertask');//主题初始化
        return $this->theme->scope('user.usershopalgl')->render();
    }
    //店铺我购买的服务
    public function usershoppayfw()
    {
        $this->initTheme('usertask');//主题初始化
        return $this->theme->scope('user.usershoppayfw')->render();
    }
    //店铺我购买的商品
    public function usershoppaysp()
    {
        $this->initTheme('usertask');//主题初始化
        return $this->theme->scope('user.usershoppaysp')->render();
    }


    /**
     * 我收藏的店铺
     * @return mixed
     */
    public function myshop()
    {
        $this->initTheme('usercenter');//主题初始化
        return $this->theme->scope('user.myshop')->render();
    }
}