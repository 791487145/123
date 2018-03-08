<?php

namespace App\Modules\Task\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class TaskRightsModel extends Model
{
    protected $table = 'task_rights';
    public $timestamps = false;
    protected $fillable = [
        'role','type','task_id','work_id','desc','status','from_uid','to_uid','created_at','handled_at'
    ];

    /**
     * 任务维权
     * @param $data
     * @return bool
     */
    public static function rightCreate($data)
    {
        $status = DB::transaction(function() use($data){
            Self::create($data);
            //将work的状态修改成4
            WorkModel::where(['task_id' => $data['task_id']])->whereIn('status',[2,3])->whereIn('uid',[$data['from_uid'],$data['to_uid']])->update(['status'=>4]);
            //判断当前任务是否是单人任务
            $task_data = TaskModel::where('id',$data['task_id'])->first();

            if($task_data['worker_num']==1)
            {
                TaskModel::where('id',$data['task_id'])->update(['status'=>8,'end_at'=>date('Y-m-d H:i:s',time())]);
            }
            //判断当前任务是否人数已满
            /*if($task_data['worker_num']!=1)
            {
                //判断当前任务的验收稿件已经全部处理
                $work_checked = WorkModel::where('status',2)->count();//当前未验收的稿件
                $work_checked_works = WorkModel::where('status',3)->count();//当前已经验收的稿件
                //判断当前任务的稿件，既没有等待验收的稿件，也没有已经验收的稿件
                if($work_checked_works==0 && $work_checked==0)
                {
                    TaskModel::where('id',$data['task_id'])->update(['status'=>11]);//表示维权状态
                }elseif($work_checked==0){
                    TaskModel::where('id',$data['task_id'])->update(['status'=>8,'comment_at'=>date('Y-m-d H:i:s',time())]);
                }
            }*/
        });
        return is_null($status)?true:false;
    }

    /**
     * 中标模式 任务维权
     * @param $data
     * @return bool
     */
    public static function bidRightCreate($data)
    {
        $status = DB::transaction(function() use($data){
            self::create($data);
            //将work的状态修改成4
            WorkModel::where(['task_id' => $data['task_id'],'status' => 2])->whereIn('uid',[$data['from_uid'],$data['to_uid']])->update(['status'=>4]);
            //修改支付阶段状态
            $paySectionInfo = [
                'section_status' => 2,//维权中
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            TaskPaySectionModel::where('task_id',$data['task_id'])
                ->where('work_id',$data['work_id'])->update($paySectionInfo);

            //任务状态变为维权中
            TaskModel::where('id',$data['task_id'])->update(['status'=>11,'updated_at' => date('Y-m-d H:i:s')]);
        });
        return is_null($status)?true:false;
    }
}
