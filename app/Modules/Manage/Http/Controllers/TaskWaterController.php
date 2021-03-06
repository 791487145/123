<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ApiBaseController;
use App\Modules\Task\Model\DistrictRegionModel;
use App\Modules\Task\Model\TaskWaterModel;
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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Theme;
use Log;
use Illuminate\Support\Facades\Redis;

class TaskWaterController extends ManageController
{
    protected $page = 20;   //分页信息

    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('任务列表');
        $this->theme->set('manageType', 'task');
    }

    //假任务列表
    public function taskWaterList(Request $request)
    {
        $search = $request->all();
        $taskWater = new TaskWaterModel();

        $task_waters = $taskWater->paginate($this->page);

        $data = array(
            'task_waters' => $task_waters,
            'merge' => $search
        );

        return $this->theme->scope('manage.taskwaterlist', $data)->render();
    }

    public function taskwaterDetail($id,Request $request)
    {
        $task_water = TaskWaterModel::whereId($id)->first();

        $data = array(
            'task_water' => $task_water
        );
        return $this->theme->scope('manage.taskwaterDetail', $data)->render();
    }


    public function taskwaterAdd(Request $request)
    {

        $school = DistrictRegionModel::where('type',0)->get();
        if(Cache::has('image_store')){
            $image = Cache::get('image_store');
        }else{
            $image = '';
        }
        $data = array(
            'school' => $school,
            'image' => $image
        );

        if($request->isMethod("post")){
            $data = $request->except('_token');
            TaskWaterModel::createTaskOne($data);
           return redirect('/manage/taskWaterList');
        }

        return $this->theme->scope('manage.taskwateradd',$data)->render();
    }

    public function imageStore()
    {
        if(Cache::has('image_store')){
            $image = Cache::get('image_store');
        }else{
            //$image = [];
            for($i = 1;$i<=63;$i++){
                $image[] = 'uploads/head_img/'. $i.'.jpg';
            }
            Cache::forever("image_store",$image);
        }

        $data = array(
            'image' => $image
        );

        return $this->theme->scope('manage.taskwaterimage',$data)->render();
    }

    public function imageStoreAdd(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            if(Cache::has('image_store')){
                $image = Cache::get('image_store');
                $img = array_merge($data['image'],$image);
                $images = array_values($img);
                Cache::forever("image_store",$images);
            }else{
                Cache::forever("image_store",$data['image']);
            }

            return redirect('/manage/imageStore');
        }
        return $this->theme->scope('manage.taskwaterimageAdd')->render();
    }

    public function imageUpload(Request $request)
    {
        $base64 = $request->input('imgOne');
        $data = ApiBaseController::uploadByBase64($base64,$path = 'head_img');
        return $data['url_path'];
    }

    public function imageStoreDel(Request $request)
    {
        $image = Cache::get('image_store');
        $id = $request->input('id');
        $val = $image[$id];
        unlink($val);
        unset($image[$id]);
        $images = array_values($image);
        Cache::forever("image_store",$images);
        return $id;
    }





}
