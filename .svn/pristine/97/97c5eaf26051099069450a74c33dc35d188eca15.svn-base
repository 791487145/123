<?php

namespace App\Modules\User\Model;

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

class PhoneCodeModel extends Model
{
    protected $table = 'phone_auth';
    protected $fillable =
        [   'id',
            'phone',
            'code',
            'overdue_date',
            'created_at',
            'status'
        ];
    public  $timestamps = false;  

}
