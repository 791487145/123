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
    static function detail($type,$competition,$groups)
    {
        $user_game_group = UserGameGroupModel::where('server',UserGameGroupModel::SERVER_WX)->where('type',$type)->where('competition',$competition)
                            ->distinct('group')->orderBy('id','asc')->lists('group');
        $i = 0;

        foreach($groups as $k=>$v){
            if($k == $user_game_group[$i]){
               for($j=0;$j<count($v);$j=$j+2){
                   $param['type'] = $type;
                   $param['competition'] = $competition;
                   $param['group_a'] = $v[$j]['id'];
                   $param['created_at'] = date("Y-m-d H:i:s");
                   if(isset($v[$j+1])){
                       $param['group_b'] = $v[$j+1]['id'];
                   }else{
                       $param['group_b'] = 0;
                   }
                   self::insert($param);
               }
            }
            $i = $i+1;
        }
        return true;
    }
}
