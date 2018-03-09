<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserActiveGameRuleModel extends Model
{
    protected $table = 'user_active_game_rule';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','u_a_id','u_g_r_id','type'
    ];

    public $timestamps = false;


    static function createOne($param)
    {
        self::insert($param);
        return true;
    }

}
