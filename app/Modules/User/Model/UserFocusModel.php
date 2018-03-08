<?php

namespace App\Modules\User\Model;
use Illuminate\Database\Eloquent\Model;

class UserFocusModel extends Model
{
    protected $table = 'user_focus';

    public $timestamps = false;

    protected $fillable = [
         'uid','focus_uid','created_at'
    ];

    public function tags()
    {
        return $this->hasMany('App\Modules\User\Model\UserTagsModel','uid','focus_uid');
    }

    public function tagsfans()
    {
        return $this->hasMany('App\Modules\User\Model\UserTagsModel','uid','uid');
    }
}
