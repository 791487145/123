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

class TaskTemplateModel extends Model
{
    protected $table = 'task_template';
    public  $timestamps = false;  
    protected $fillable = [
        'title','content','cate_id','status','created_at'
    ];

    
    static function findAll()
    {
        return Self::where('status','=',0)->get()->toArray();
    }
    

    static function findById($id)
    {
        return Self::where('id','=',$id)->first();
    }
}
