<?php


namespace App\Modules\Mobile\Http\Controllers;

use App\Http\Controllers\ApiBaseController;
use App\Modules\Manage\Model\AgreementModel;
use App\Modules\Task\Model\ServiceModel;
use App\Modules\Task\Model\TaskAttachmentModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskRightsModel;
use App\Modules\Task\Model\WorkAttachmentModel;
use App\Modules\Task\Model\WorkCommentModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\CommentModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\Task\Model\DistrictRegionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Support\Facades\Crypt;
use DB;
use Cache;

class TaskOtherController extends ApiBaseController
{


    /**任务分类（get:/taskCate)
     * @param Request $request
     * @param $cateId 任务id
     * @return \Illuminate\Http\Response
     */
    public function tasksCates(Request $request)
    {
        $data = TaskCateModel::findAll();
        return $this->formateResponse(1000,'success',$data);
    }

    /**地区选择（get：/taskRegion）
     *
     */
    public function tasksRegion(Request $request)
    {
        $data = DistrictRegionModel::findTree(0);
        return $this->formateResponse(1000,'success',$data);
    }

    /**任务基本信息总汇（post:/task/taskInfoTotal）
     * @param Request $request
     * @return mixed
     */
    public function taskInfoTotal(Request $request)
    {
       if(Cache::has('task_total')) {
            $data = Cache::get('task_total');
       }else{
            $data['taskCate'] = TaskCateModel::findAll();

            $param = new DistrictRegionModel();
            $data['address'] = DistrictRegionModel::findAll($param);

            $data['task_server'] = ServiceModel::serviceList();
            $data['agreement_task'] = AgreementModel::where('code_name','task_publish')->select('name','content')->first()->toArray();
            Cache::put('task_total',$data,60*24);
       }
       return $data;
    }








}