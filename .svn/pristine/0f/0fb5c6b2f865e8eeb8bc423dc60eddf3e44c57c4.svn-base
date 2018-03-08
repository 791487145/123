<?php

namespace App\Modules\User\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;

class UserAmountModel extends Model
{


    
    protected $table = 'user_amount';
    public $timestamps = true;
    protected $primaryKey = 'id';

    
    protected $fillable = [
       'uid','employee_num','publish_task_num','receive_task_num','employer_praise_rate','employee_praise_rate'
    ];



    

}
