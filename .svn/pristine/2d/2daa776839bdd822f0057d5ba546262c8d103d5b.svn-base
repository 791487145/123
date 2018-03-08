<?php

namespace App\Modules\Task\Model;

use App\Modules\Employ\Models\EmployUserModel;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\Order\Model\OrderModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use App\Modules\Task\Model\TaskCateModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

//use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class TaskDelayModel extends Model
{
    const  TASK_DELAY_DOING = 1;//申请中
    const  TASK_DELAT_AGREE = 2;//同意
    const  TASK_DELAY_AUTO_CONFIM = 3;//系统自动确认
    const  TASK_DELAY_REFUEE = 4;//   拒绝

    protected $table = 'task_delay';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'task_id','delay_time','created_at','status','worker_id'
    ];

    static function createOne($data)
    {
        $taskDelay = new TaskDelayModel();
        $taskDelay->task_id = $data['task_id'];
        $taskDelay->delay_time = $data['time'];
        $taskDelay->created_at = date("Y-m-d H:i:s");
        $taskDelay->status = 1;
        $taskDelay->worker_id = $data['worker_id'];
        $taskDelay->save();

        return $taskDelay;
    }

    static function findOne($taskId)
    {

    }

}
