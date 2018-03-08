<?php

namespace App\Modules\Task\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class WorkCommentModel extends Model
{
    protected $table = 'work_comments';
    public $timestamps = false;  
    public $fillable = ['work_id', 'comment','nickname', 'uid', 'task_id', 'pid', 'created_at'];

    public function childrenComment()
    {
        return $this->hasOne('App\Modules\Task\Model\WorkCommentModel', 'pid', 'id');
    }

    public function parentComment()
    {
        return $this->belongsTo('App\Modules\Task\Model\WorkCommentModel','pid','id');
    }
    public function user()
    {
        return $this->hasOne('App\Modules\User\Model\UserDetailModel','uid','uid');
    }
    public function users()
    {
        return $this->hasOne('App\Modules\User\Model\UserModel','id','uid');
    }
}
