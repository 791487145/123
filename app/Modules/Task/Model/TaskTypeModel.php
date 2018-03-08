<?php

namespace App\Modules\Task\Model;

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

class TaskTypeModel extends Model
{

    
    protected $table = 'task_type';
    public  $timestamps = false;  
    public $fillable = ['id','name','status','desc','created_at','alias'];

    
    static public function getTaskTypeAliasById($id)
    {
        $taskTypeAlias = 'xuanshang';
        $taskType = self::find($id);
        if(!empty($taskType)){
            $taskTypeAlias = $taskType['alias'];
        }
        return $taskTypeAlias;
    }

    
    static public function getTaskTypeIdByAlias($alias)
    {
        $taskTypeId = 1;
        $taskType = TaskTypeModel::where('alias',$alias)->first();
        if($taskType){
            $taskTypeId = $taskType['id'];
        }
        return $taskTypeId;
    }
	

	static public function getTaskTypeAll(){
		return self::select('id','name','alias')->where(function($query){
			  $query->where('alias','xuanshang')
			        ->orwhere('alias','zhaobiao');
		})->get();
	}
	
}
