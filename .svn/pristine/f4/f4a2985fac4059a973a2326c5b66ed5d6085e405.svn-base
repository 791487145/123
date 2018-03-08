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

class ServiceModel extends Model
{
    const SERVICE_TASK = 1;//任务服务

    const SERVICE_USE = 1;//可用

    protected $table = 'service';

    
    static public function serviceMoney($product_ids)
    {
        $money = 0;
        foreach($product_ids as $k=>$v)
        {
            $data = Self::where('id','=',$v)->first()->toArray();
            $money += $data['price'];
        }
        return $money;
    }

    static function  serviceList()
    {
        $data = ServiceModel::whereType(self::SERVICE_TASK)->whereStatus(self::SERVICE_USE)->get()->toArray();
        return $data;
    }

}
