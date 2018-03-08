<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserGameModel extends Model
{
    protected $table = 'user_game_info';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','game_name','game_server','school','num','uid','created_at','user_no','mobile'
    ];

    public $timestamps = true;

    //创建角色
    static function createOne($data)
    {
        $date = self::create($data);
        return $date;
    }

    //判断某条件下某角色是否存在
    static function userIsExist($where)
    {
        $data = self::where($where)->first();
        return $data;
    }

    //获取用户基本信息
    static function getUserInfo($uid)
    {
        //dd($uid);
        //$data = [];
        foreach($uid as $id){
            $data[] = self::where('uid',$id)
                ->leftJoin('users','user_game_info.uid','=','users.id')
                ->select('users.id','users.name','users.mobile','user_game_info.game_name','user_game_info.game_server')
                ->first();
        }
        //dd($data);
        return $data;
    }


}
