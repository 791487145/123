<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserActiveGroupModel extends Model
{
    protected $table = 'user_active_group';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','u_a_id','u_g_g_id','type'
    ];

    public $timestamps = false;


    static function createOne($param)
    {
        self::insert($param);
        return true;
    }

    static function groupInfo($uid,$type)
    {
        $data = self::where('user_active_group.u_a_id',$uid)->where('user_active_group.type',$type)
            ->leftJoin('user_game_group','user_game_group.id','=','user_active_group.u_g_g_id')
            ->select('user_game_group.group','user_game_group.num')
            ->first();

        return $data;
    }

}
