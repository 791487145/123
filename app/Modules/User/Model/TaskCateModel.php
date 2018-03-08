<?php

namespace App\Modules\Task\Model;

use Illuminate\Database\Eloquent\Model;

class TaskCateModel extends Model
{

    
    protected $table = 'cate';

    protected $fillable = [
       'name','pid','sort','type','path','choose_num'
    ];

    public function parentTask()
    {
        return $this->belongsTo('App\Modules\Task\Model\TaskCateModel', 'pid', 'id');
    }
    
    public function childrenTask()
    {
        return $this->hasMany('App\Modules\Task\Model\TaskCateModel', 'pid', 'id');
    }

    
    static function findAll()
    {
        $data = Self::with('childrenTask')->where('pid','=',0)->get()->toArray();

        return $data;
    }

    
    static function parentCate()
    {
        $data = Self::with('parentTask')->get()->toArray();

        return $data;
    }

    
    static function findById($id)
    {
        $data = Self::where('id','=',$id)->first();

        return $data;
    }

    
    static function findByPid($pid)
    {
        return Self::where('pid','=',$pid)->get()->toArray();
    }

    
    static function findCateIds($pid)
    {
        return Self::where('path','like','%'.$pid.'%')->lists('id')->toArray();
    }
}
