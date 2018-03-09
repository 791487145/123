<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserGameMatchResultModel extends Model
{
    const  TYPE_SINGLE = 1;//个人
    const  TYPE_COUPLE = 2;//团队

    //比赛结果
    const  WIN_NOT_STAERT = 0;//未标记
    const  WIN_A = 1;//a获胜
    const  WIN_B = 2;//

    protected $table = 'user_game_match_result';
    protected $primaryKey = 'id';



    protected $fillable = [
        'id','win','type','created_at','group_a','group_b','remark','competition'
    ];

    public $timestamps = false;

    //对决详情展示
    static function detail($type,$competition,$group_ids,$user_game_setting)
    {
        if($user_game_setting->num == 4){
            for($i=1;$i<=4;$i++){
                $user_game_groups = UserGameGroupModel::whereIn('id',$group_ids)->where('group_mark',$i)->get();
                if(!$user_game_groups->isEmpty()){
                    $user_game_groups = $user_game_groups->toArray();
                    self::dataTreating($user_game_groups,$type,$competition);
                }
            }
        }

        return true;
    }

    static function dataTreating($user_game_groups,$type,$competition)
    {
        for($j=0;$j<count($user_game_groups);$j=$j+2){
            $param['type'] = $type;
            $param['competition'] = $competition;
            $param['group_a'] = $user_game_groups[$j]['id'];
            $param['created_at'] = date("Y-m-d H:i:s");
            if(isset($user_game_groups[$j+1])){
                $param['group_b'] = $user_game_groups[$j+1]['id'];
            }else{
                $param['group_b'] = 0;
            }
            self::insert($param);
        }

        return true;
    }
}
