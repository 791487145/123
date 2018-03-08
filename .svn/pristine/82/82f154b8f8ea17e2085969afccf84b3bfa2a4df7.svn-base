<?php

namespace App\Modules\Task\Model;

use App\Modules\User\Model\AttachmentModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class TaskAttachmentModel extends Model
{

    
    protected $table = 'task_attachment';
    protected $fillable = ['task_id','attachment_id','created_at','work_id'];
    public $timestamps = false;

    
    static function createOne($task_id,$attachment_id)
    {
        if(is_array($attachment_id)){
            foreach($attachment_id as $v){
                $model = new TaskAttachmentModel;
                $model->task_id = $task_id;
                $model->attachment_id = $v;
                $model->created_at = date('Y-m-d H:i:s', time());
                $result = $model->save();
                if(!$result){
                    return false;
                }
            }
        }else{
            $model = new TaskAttachmentModel;
            $model->task_id = $task_id;
            $model->attachment_id = $attachment_id;
            $model->created_at = date('Y-m-d H:i:s', time());
            $result = $model->save();
            if(!$result){
                return false;
            }
        }

        return true;
    }

    
    static function findByTid($id)
    {
        $data = TaskAttachmentModel::select('task_attachment.attachment_id')
            ->where('task_id','=',$id)->get()->toArray();
        return $data;
    }
}
