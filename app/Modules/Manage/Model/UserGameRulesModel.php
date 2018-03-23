<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserGameRulesModel extends Model
{
    const CATEGORY_KING_OF_GLORY = 1;//王者荣耀赛制

    protected $table = 'user_game_rules';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','name','category','created_at','updated_at','pid'
    ];

    public $timestamps = true;

    //创建新数据
    static function createOne($param)
    {
        $user_game_rules = self::where('name',$param['name'])->where('category',$param['category'])->where('pid',$param['pid'])->first();
        if(is_null($user_game_rules)){
            self::insert($param);
        }

        return true;
    }



}
