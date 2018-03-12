<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserActiveSortVoteModel extends Model
{
    protected $table = 'user_active_sort_vote';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','u_a_id','u_g_g_id','sort','competition','type','vote'
    ];

    public $timestamps = false;


    static function createOne($param)
    {
        self::insert($param);
        return true;
    }

}
