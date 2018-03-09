<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserActiveModel extends Model
{
    const ACTIVE_TYPE_WX = 1;//微信

    const ACTIVE_CANTAIN_ONE = 1;//1v1
    const ACTIVE_CANTAIN_FIVE = 2;//5v5

    //参赛结果
    const MATCH_RESULT_SUCCESS = 3;//赢
    const MATCH_RESULT_FAIL = 2;//输
    const MATCH_RESULT_NOT_START = 1;//未开始

    protected $table = 'user_active';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','uid','type','pid','cantain','active_type','created_at','user_no','match_result'
    ];

    public $timestamps = true;

    //创建角色
    static function createOne($data)
    {
        $data = self::create($data);
        return $data;
    }

    //判断某条件下某角色是否存在
    static function userIsExist($where)
    {
        $data = self::where($where)->first();
        return $data;
    }

    //某战队人员总数
    static function getTeamPeopleTotal($team_id)
    {
        $data = self::where('pid',$team_id)->count();
        return $data;
    }

    //抽签
    static function sectionalization($group_id,$user_active,$type)
    {
        $uesr_game_rules = UserGameRulesModel::where('name','报名')->first();
        //$user_game_relus_first = UserGameRulesModel::where('pid',$uesr_game_rules->id)->orderBy('id','asc')->first();
        $param = array(
            'u_a_id' => $user_active->id,
            'u_g_g_id' => $group_id,
            'type' => $type,
            'competition' => $uesr_game_rules->id
        );
        UserActiveGroupModel::createOne($param);

        $data = array(
            'u_a_id' => $user_active->id,
            'u_g_r_id' => $uesr_game_rules->id,
            'type' => $type
        );
        UserActiveGameRuleModel::createOne($data);

        return true;
    }


    static function getAllList($param,$userActive,$page)
    {
        $user_active = $userActive->where('pid',0)
                        ->where('cantain',UserActiveModel::ACTIVE_CANTAIN_ONE)
                        ->where('active_type',UserActiveModel::ACTIVE_TYPE_WX)
                        ->where('user_active.type','=',1)
                        ->leftJoin('users','users.id','=','user_active.uid')
                        ->leftJoin('user_game_info','user_game_info.uid','=','user_active.uid')
                        ->select('user_active.id','user_active.created_at','user_active.match_result','user_active.uid','user_game_info.game_name','user_game_info.game_server','users.name')
                        ->orderBy('id','asc')
                        ->paginate($page);
       /* foreach($user_active as $value){
            if($value->group_id == 0){
                $value->group = '未分组';
                continue;
            }
            if($value->group_id != 0 && $value->match_result == UserActiveModel::MATCH_RESULT_NOT_START){
                $value->match_result = '暂无结果';
            }
            if($value->group_id != 0 && $value->match_result == UserActiveModel::MATCH_RESULT_FAIL){
                $value->match_result = '失败';
            }
            if($value->group_id != 0 && $value->match_result == UserActiveModel::MATCH_RESULT_SUCCESS){
                $value->match_result = '获胜';
            }

            $user_game_group = UserGameGroupModel::where('id',$value->group_id)->where('type',UserGameGroupModel::TYPE_SINGLE)
                                                    ->select('group','num')->first();
            $value->group = $user_game_group->group.'组'.$user_game_group->num.'号';
        }*/

        return $user_active;
    }

    static function getListAll($param,$userActive,$page)
    {
        $user_active = $userActive->where('pid',0)
            ->where('cantain',UserActiveModel::ACTIVE_CANTAIN_ONE)
            ->where('active_type',UserActiveModel::ACTIVE_TYPE_WX)
            ->where('user_active.type','=',1)
            ->leftJoin('users','users.id','=','user_active.uid')
            ->leftJoin('user_game_info','user_game_info.uid','=','user_active.uid')
            ->select('user_game_group.group','user_game_group.num','user_active.id','user_active.created_at','user_active.match_result','user_active.uid','user_game_info.game_name','user_game_info.game_server','users.name')
            ->orderBy('id','asc')
            ->paginate($page);

        return $user_active;
    }

}
