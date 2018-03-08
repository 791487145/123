<?php

namespace App\Console\Commands;

use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskTypeModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\CommentModel;
use App\Modules\User\Model\UserDetailModel;
use Illuminate\Console\Command;

class TaskBidComment extends Command
{
    
    protected $signature = 'taskBidComment';

    
    protected $description = '招标任务系统自动评价';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $taskTypeId = TaskTypeModel::getTaskTypeIdByAlias('zhaobiao');
        
        $tasks = TaskModel::where('type_id',$taskTypeId)->where('status',8)->get()->toArray();

        
        $expired_tasks = self::expireTask($tasks);

        
        $expired_work_worker = self::expiredWorker($expired_tasks);
        foreach($expired_work_worker as $k=>$v)
        {
                foreach($v as $value)
                {
                    if(is_array($value))
                    {
                        $data = [
                            'task_id'=>$k,
                            'from_uid'=>$value['uid'],
                            'to_uid'=>$v['uid'],
                            'comment'=>'系统评价',
                            'comment_by'=>2,
                            'speed_score'=>5,
                            'quality_score'=>5,
                            'attitude_score'=>5,
                            'type'=>1,
                            'created_at'=>date('Y-m-d H:i:s',time()),
                        ];
                        CommentModel::commentCreate($data);
                        
                        UserDetailModel::where('uid',$v['uid'])->increment('employer_praise_rate');
                    }
                }
        }
        
        $expired_work_owner = Self::expiredOwner($expired_tasks);
        foreach($expired_work_owner as $k=>$v)
        {
            foreach($v as $value)
            {
                if(is_array($value))
                {
                    $data = [
                        'task_id'=>$k,
                        'to_uid'=>$value['uid'],
                        'from_uid'=>$v['uid'],
                        'comment'=>'系统评价',
                        'comment_by'=>2,
                        'speed_score'=>5,
                        'quality_score'=>5,
                        'attitude_score'=>5,
                        'type'=>1,
                        'created_at'=>date('Y-m-d H:i:s',time()),
                    ];
                    CommentModel::create($data);
                    
                    UserDetailModel::where('uid',$v['uid'])->increment('employee_praise_rate');
                }

            }
        }
        
        $expired_tasks_ids = array_column($expired_tasks,'id');
        TaskModel::whereIn('id',$expired_tasks_ids)->update(['status'=>9,'end_at'=>date('Y-m-d H:i:s',time())]);
    }

    
    private function expiredWorker($data)
    {
        $expired_works_id = [];
        foreach($data as $v)
        {
            
            $worker_comment_id = CommentModel::where('task_id',$v['id'])->where('to_uid',$v['uid'])->lists('from_uid')->toArray();
            $works_data = WorkModel::where('task_id',$v['id'])->whereNotIn('uid',$worker_comment_id)->where('status',3)->get()->toArray();

            if(!empty($works_data))
            {
                
                $expired_works_id[$v['id']] = $works_data[0];
                $expired_works_id[$v['id']]['uid'] = $v['uid'];
            }
        }
        return $expired_works_id;
    }
    
    private function expiredOwner($data)
    {
        $expired_works_id = [];
        foreach($data as $v)
        {
            
            $owner_comment_id = CommentModel::where('task_id',$v['id'])->where('from_uid',$v['uid'])->lists('to_uid')->toArray();
            
            $works_data = WorkModel::where('task_id',$v['id'])->whereNotIn('uid',$owner_comment_id)->where('status',3)->get()->toArray();

            if(!empty($works_data))
            {
                $expired_works_id[$v['id']] = $works_data[0];
                $expired_works_id[$v['id']]['uid'] = $v['uid'];
            }
        }
        return $expired_works_id;
    }

    private function expireTask($task)
    {
        
        $task_comment_time_limit = \CommonClass::getConfig('task_comment_time_limit');
        $task_comment_time_limit = $task_comment_time_limit*24*3600;
        $expire_task = [];
        foreach($task as $v)
        {
            
            if((strtotime($v['comment_at'])+$task_comment_time_limit)<=time())
            {
                $expire_task[] = $v;
            }
        }
        return $expire_task;
    }
}
