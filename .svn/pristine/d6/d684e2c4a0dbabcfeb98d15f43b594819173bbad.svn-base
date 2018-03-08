<?php

namespace App\Modules\Article\Model;

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

class ArticleModel extends Model
{
    const ARTICLE_INDEX = 90;//首页
    const ARTICLE_ZIXUN = 99;//咨询

    protected $table = 'article';
    protected $fillable = ['user_id','userName','title','summary','author','form','addTime','content','thumb_up_number'];
    public  $timestamps = false;  

}














