<?php

namespace App\Modules\Advertisement\Model;

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

class RePositionModel extends Model
{
    protected $table = 'recommend_position';
    protected $fillable =
        [   'id',
            'name',
            'code',
            'position',
            'num',
            'pic',
            'is_open'
        ];
    public  $timestamps = false;  

}
