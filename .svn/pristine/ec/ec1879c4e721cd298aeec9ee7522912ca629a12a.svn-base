<?php

namespace App\Modules\Task\Model;

use App\Modules\User\Model\AttachmentModel;
use App\Modules\Task\Model\TaskAttachmentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class WorkAttachmentModel extends Model
{
    protected $table = 'work_attachment';
    public  $timestamps = false;  
    public $fillable = ['task_id','work_id','attachment_id','type','created_at'];

    
    static function createOne($task_id,$work_id,$attachment_id)
    {
        if(is_array($attachment_id)){
            foreach($attachment_id as $v){
                $type = AttachmentModel::where('id',$v)->lists('type');
                $model = new WorkAttachmentModel();
                $model->task_id = $task_id;
                $model->work_id = $work_id;
                $model->attachment_id = $v;
                $model->created_at = date('Y-m-d H:i:s',time());
                $result = $model->save();
                if(!$result){
                    return false;
                }
            }
        }else{
            $type = AttachmentModel::where('id',$attachment_id)->lists('type');
            $model = new WorkAttachmentModel();
            $model->task_id = $task_id;
            $model->work_id = $work_id;
            $model->type = $type[0];
            $model->attachment_id = $attachment_id;
            $model->created_at = date('Y-m-d H:i:s', time());
            $result = $model->save();
            if(!$result){
                return false;
            }
        }

        return true;
    }
    
    static function isDownAble($attachment_id,$uid)
    {
        $attachment_data = Self::where('attachment_id',$attachment_id)->first();
        
        $task_data = TaskModel::findById($attachment_data['task_id']);
        if($task_data['uid']==$uid)
        {
            return true;
        }
        return false;
    }

    
    static function findById($id)
    {
        $data = WorkAttachmentModel::select('attachment_id')
            ->where('work_id',$id)
            ->get()->toArray();
        return $data;
    }
}
