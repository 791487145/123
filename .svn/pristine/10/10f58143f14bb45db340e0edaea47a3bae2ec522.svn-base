<?php

namespace App\Modules\User\Model;
use Illuminate\Database\Eloquent\Model;

class AttachmentModel extends Model
{
        protected $table = 'attachment';

    public $timestamps = false;

    protected $fillable = [
        'name', 'type', 'size', 'url', 'status', 'user_id', 'disk', 'created_at'
    ];

    public function work()
    {
        return $this->morphedByMany('App\Modules\Task\Model\WorkModel', 'work_attachment');
    }
    
    static function createOne($data)
    {
        if(isset($data['task_id'])){
            unset($data['task_id']);
            unset($data['token']);
            unset($data['image']);
        }

        //dd($result);
        //dd($data);
       $attatchment = new AttachmentModel();
        $attatchment->name = isset($data['name']) ? $data['name'] : '暂无名称';
        $attatchment->url = $data['url'];
        $attatchment->type = 'jpeg';
        $attatchment->size =0;
        $attatchment->user_id = $data['user_id'];
        $attatchment->status = $data['status'];
        $attatchment->created_at = date('Y-m-d H:i:s',time());
        $attatchment->save();
       //dd($attatchment);
        return $attatchment;
    }

    
    static function del($id,$uid)
    {
        $result = UserAttachmentModel::del($uid,$id);
        if(!$result)
        {
            return false;
        }
        $result2 = Self::where('id','=',$id)->delete();
        return $result2;
    }

    
    static function findByIds($ids)
    {
        $data = Self::whereIn('id',$ids)->get();
        return $data;
    }

    
    static function fileAble($ids)
    {
        $data = Self::select('attachment.id')->whereIn('id',$ids)->get()->toArray();
        return $data;
    }
    
    public function statusChange($ids)
    {
        $query = Self::where('status',0);
        if(is_array($ids))
        {
            $query = $query->whereIn('id',$ids);
        }else
        {
            $query = $query->where('id',$ids);
        }
        $result = $query->update(['status'=>1]);

        return $result;
    }
}