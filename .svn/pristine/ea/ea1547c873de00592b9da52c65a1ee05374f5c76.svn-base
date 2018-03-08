<?php

namespace  App\Modules\Manage\Model;

use Cache;
use Illuminate\Database\Eloquent\Model;

class TypeModel extends Model
{
    
    protected $table = 'type';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','name','type'
    ];

    public $timestamps = false;

    //获取某类型所有数据
    static function selectAllofType($type)
    {
    	if($type == 'feedback'){
    		$data = self::whereType($type)->get();
    		if(!$data->isEmpty()){
    			$data = $data->toArray();
    			Cache::put('type_of_feedback',$data,24*60);
    			return $data;
    		}
    	}
    }

    //获取类型名称
    static function findTypeNameById($id)
    {
    	$typeName = self::whereId($id)->pluck('name');
    	return $typeName;
    }


}
