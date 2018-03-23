<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserGameSettingModel extends Model
{
    const TYPE_SINGLE = 1;//个人
    const TYPE_COUPLE = 2;//团队

    protected $table = 'user_game_setting';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','type','num'
    ];

    public $timestamps = false;


    static function createOne($type,$num)
    {
        $param['type'] = $type;
        $param['num'] = $num;
        self::insert($param);

        return true;
    }

}
