<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserGameGroupModel extends Model
{
    const SERVER_WX = 1;//微信

    const TYPE_SINGLE = 1;//个人
    const TYPE_COUPLE = 2;//团队

    const COMPETITION_NOT_START = 1;//海选

    protected $table = 'user_game_group';
    protected $primaryKey = 'id';

    const X_GROUP = ['A','B','C','D','E','F','G','H'];

    protected $fillable = [
        'id','group','num','created_at','server','type','competition'
    ];

    public $timestamps = false;

    //分组
    static function createOne($num,$type,$competition)
    {
        $count = count($num);
        for($i=0;$i<$count;$i++){
            for($j=0;$j<$num[$i];$j++){
                $param['group'] = self::X_GROUP[$i];
                $param['num'] = $j + 1;
                $param['server'] = self::SERVER_WX;
                $param['type'] = $type;
                $param['competition'] = $competition;
                self::create($param);
            }
        }

        $user_game_group = self::where('server',self::SERVER_WX)->where('type',$type)->get()->toArray();
        return $user_game_group;
    }


}
