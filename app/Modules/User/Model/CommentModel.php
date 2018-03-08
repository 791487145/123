<?php

namespace App\Modules\User\Model;

use App\Modules\Task\Model\WorkModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommentModel extends Model
{

    protected $table = 'comments';
    public $timestamps = false;
    protected $fillable = [
        'task_id', 'from_uid', 'to_uid', 'comment','comment_by','speed_score','quality_score','attitude_score','created_at','type'
    ];



    static public function taskComment($id,$data=array())
    {
        $query = Self::select('comments.*','ud.avatar','us.name as nickname')->where('task_id',$id);
        
        if(!empty($data['evaluate_type']))
        {
            $query->where('type',$data['evaluate_type']);
        }
        
        if(!empty($data['evaluate_from']))
        {
            switch($data['evaluate_from'])
            {
                case 1:
                    $query->where('uid','<>',$data['task_user_id']);
                    break;
                case 2:
                    $query->where('uid',$data['task_user_id']);
            }
        }
        $data = $query->leftjoin('user_detail as ud','comments.to_uid','=','ud.uid')
            ->leftjoin('users as us','us.id','=','comments.to_uid')
            ->paginate(5)->setPageName('comment_page')->toArray();

        return $data;
    }
    
    static public function applauseRate($id)
    {
        $comments = self::where('to_uid',$id)->count();
        $good_comments = self::where('to_uid',$id)->where('type',1)->count();
        if($comments==0){
            $applause_rate = 100;
        }else{
            $applause_rate = ($good_comments/$comments)*100;
        }

        return floor($applause_rate);
    }

    static public function commentCreate($data)
    {
        $status = DB::transaction(function() use($data){
            
            Self::create($data);
            
            $worker_num = TaskModel::where('id',$data['task_id'])->first();
            
            $comment_count = self::where('task_id',$data['task_id'])->count();
            
            if(!empty($worker_num['worker_num']) && $worker_num['worker_num']*2==$comment_count)
            {
                TaskModel::where('id',$data['task_id'])->update(['status'=>9,'end_at'=>date('Y-m-d H:i:s',time())]);
            }
            
            if($data['comment_by']==0 && $data['type']==1)
            {
                
                UserDetailModel::where('uid',$data['to_uid'])->increment('employer_praise_rate',1);
            }elseif($data['comment_by']==1 && $data['type']==1)
            {
                
                UserDetailModel::where('uid',$data['to_uid'])->increment('employee_praise_rate',1);
            }
        });

        return is_null($status)?true:false;
    }
}

?>