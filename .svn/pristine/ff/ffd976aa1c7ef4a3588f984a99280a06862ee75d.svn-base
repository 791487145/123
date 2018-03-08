<?php

namespace App\Modules\Task\Model;

use Illuminate\Database\Eloquent\Model;
use Cache;

class TaskCateModel extends Model
{

    
    protected $table = 'cate';

    protected $fillable = [
       'name','pid', 'type', 'path','id','pic','sort'
    ];

    public function parentTask()
    {
        return $this->belongsTo('App\Modules\Task\Model\TaskCateModel', 'pid', 'id');
    }
    
    public function childrenTask()
    {
        return $this->hasMany('App\Modules\Task\Model\TaskCateModel', 'pid', 'id');
    }

    //分类树
    static function findAll()
    {
        if(Cache::has('task_cate')){
            $data = Cache::get('task_cate');
        }else{
            $data = Self::findAllCache();
            $data = \CommonClass::listToTree($data,'id','pid','children_task');
            Cache::put('task_cate',$data,60*24);
        }

        return $data;
    }

    //获取某类任务名称
    static function findByIdGetName($id)
    {
        $data = self::whereId($id)->pluck('name');
        return $data;
    }



    
    static function parentCate()
    {
        $data = Self::with('parentTask')->get()->toArray();

        return $data;
    }
    
    static function hotCate($num)
    {
        $data = Self::where('pid','!=',0)->orderBy('choose_num')->limit($num)->get()->toArray();
        return $data;
    }
    
    static function findCateIds($pid)
    {
        $cate_data = TaskCateModel::findById($pid);

        if($cate_data && $cate_data['pid']!=0)
        {
            return [$cate_data['id']];
        }else{
            return Self::findByPid([$pid],['id']);
        }
    }

    
    static function findById($id)
    {
        $taskCate = self::findAllCache();

        $data = array();
        foreach($taskCate as $k=>$v)
        {
            if(is_array($id) && in_array($v['id'],$id))
            {
                $data[] = $v;
            }elseif($v['id']==$id)
            {
                $data = $v;
            }
        }
        return $data;
    }

    
    static function findByPid_bak($pid,$filds=array())
    {
        $taskCate = self::findAllCache();

        $data = array();
        foreach($taskCate as $k=>$v)
        {
            if(is_array($pid) && in_array($v['pid'],$pid))
            {
                if(is_null($filds))
                {
                    $data[] = $v;
                }elseif(is_string($filds))
                {
                    $data[] = $v[$filds];
                }elseif(is_array($filds))
                {
                    foreach($filds as $key=>$value)
                    {
                        if(isset($v[$value]))
                        {
                            $seed[$value] = $v[$value];
                        }
                    }
                    $data[] = $seed;
                }
            }elseif($v['pid']==$pid)
            {
                if(is_null($filds))
                {
                    $data[] = $v;
                }elseif(is_string($filds))
                {
                    $seed[$filds] = $v[$filds];
                    $data[] = $seed;
                }elseif(is_array($filds))
                {
                    foreach($filds as $key=>$value)
                    {
                        if(isset($v[$value]))
                        {
                            $seed[$value] = $v[$value];
                        }
                    }
                    $data[] = $seed;
                }
            }
        }
        return $data;
    }

    
    static function findByPid($pid,$filds=array())
    {
        $taskCate = self::findAllCache();
        $data = array();
        foreach($taskCate as $k=>$v)
        {
           if(in_array($v['pid'],$pid))
           {
               if(!empty($filds))
               {
                   foreach($filds as $key=>$value)
                   {
                       $seed[$value] = $v[$value];
                   }
                   $data[] = $seed;
               }else
               {
                   $data[] = $v;
               }
           }
        }

        return $data;
    }
    
    static function findAllCache()
    {
        $taskCate = TaskCateModel::select('id','name','pid')->orderBy('pid', 'ASC')->orderBy('sort', 'ASC')->get()->toArray();
        return $taskCate;
    }
}
