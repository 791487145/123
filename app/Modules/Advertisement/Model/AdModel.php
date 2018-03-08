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

class AdModel extends Model
{
    protected $table = 'ad';
    protected $fillable =
        [   'id',
            'target_id',
            'ad_type',
            'ad_position',
            'ad_name',
            'ad_file',
            'ad_content',
            'ad_url',
            'start_time',
            'end_time',
            'uid',
            'username',
            'listorder',
            'is_open',
            'created_at'
        ];
    public  $timestamps = false;  

}
