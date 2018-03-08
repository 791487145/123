<?php

namespace App\Modules\Employ\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployCommentsModel extends Model
{
    protected $table = 'employ_comment';
    public $timestamps = false;
    protected $fillable = [
        'employ_id','from_uid','to_uid','comment','comment_by','speed_score','attitude_score','quality_score','type','created_at'
    ];


    static public function commentsCreate($data)
    {
        $status = DB::transaction(function() use($data)
        {
            
            self::create($data);
            
            $count = self::where('employ_id',$data['employ'])->count();
            
            if($count==2)
            {
                EmployModel::where('id',$data['employ_id'])->update(['status'=>4]);
            }
        });

        return is_null($status)?true:false;
    }
    
    static public function serviceComments($id,$data=[])
    {
        $query = self::select('employ_comment.*','ep.title','us.name as user_name')
            ->whereIn('employ_comment.employ_id',$id)
            ->where('employ_comment.comment_by',1);

        
        if(isset($data['type']) && $data['type']!=0)
        {
            $query = $query->where('employ_comment.type',intval($data['type']));
        }else
        {
            $query = $query->where('employ_comment.type',1);
        }

        $comments = $query->join('employ as ep','ep.id','=','employ_comment.employ_id')
            ->join('users as us','us.id','=','employ_comment.from_uid')
            ->paginate(1)->setPath('/shop/ajaxServiceComments');
        return $comments;
    }

    static public function serviceCommentsCreate($data,$employ_id)
    {
        $status = DB::transaction(function() use($data,$employ_id)
        {
            
            $is_comment = self::where('employ_id',$data['employ_id'])->where('from_uid')->first();
            if(!$is_comment)
            {
                self::create($data);
            }
            
            $count = self::where('employ_id',$employ_id)->count();
            if($count==2)
            {
                EmployModel::where('id',$employ_id)->update(['status'=>4]);
            }
        });

        return is_null($status)?true:false;
    }
}
