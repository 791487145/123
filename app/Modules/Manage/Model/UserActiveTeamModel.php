<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserActiveTeamModel extends Model
{
    const TEAM_STATUS_OPEN = 2;//战队审核开启
    const TEAM_STATUS_CLOSE = 1;//审核关闭

    //报名状态
    const TEAM_REPORT_STATUS_NULL = 0;//未报名
    const TEAM_REPORT_STATUS_SUCCESS = 1;//报名成功

    //比赛结果
    const MATCH_RESULT_NOT_BEGIN = 0;//未开始

    //队伍真假
    const TYPE_TRUE = 1;//真
    const TYPE_FALSE = 0;//假

    const COMPETITION_NOT_START = 1;//海选

    protected $table = 'user_active_team';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','team_name','logo','captain_id','captain_name','tel','school','member','created_at','status','user_no','team_no','report_status',
        'remark','match_result','competition','group_id'
    ];

    public $timestamps = true;

    //创建某一战队
    static function createOne($data)
    {
        $team = new UserActiveTeamModel();
        $team->team_name = $data['team_name'];
        $team->captain_id = isset($data['captain_id']) ? $data['captain_id'] : 0;
        $team->captain_name = $data['captain_name'];
        $team->tel = isset($data['tel']) ? $data['tel'] : 0;
        $team->school = isset($data['school']) ? $data['school'] : 0;
        $team->user_no = isset($data['user_no']) ? $data['user_no'] : 0;
        $team->status = self::TEAM_STATUS_OPEN;
        $team->remark = isset($data['remark'])? 5:'';
        $team->report_status = self::TEAM_REPORT_STATUS_NULL;
        if(!empty($data['logo'])){
            $team->logo = $data['logo'];
        }
        $team->save();

        $team = self::whereId($team->id)->first();
        $team->team_no = self::team_no($team->captain_id,$team->id);
        $team->save();
       /* $where = [
            'team_no'=>self::team_no($data['captain_id'],$team->id)
        ];
        self::updateOfId($team->id,$where);*/
        return $team;
    }

    //查找某一战队信息
    static function getInfoById($id)
    {
        $data = self::whereId($id)->first();
        return $data;
    }

    //查找某一战队信息
    static function getInfoByCaptainId($captain_id)
    {
        $data = self::where('captain_id',$captain_id)->select('id','team_name','logo','captain_name','report_status','tel')->first();
        $data['total'] = UserActiveModel::getTeamPeopleTotal($data->id);
        return $data;
    }

    //战队编号
    static function team_no($uid,$team_id)
    {
        $data = date("Ymd");
        $team_no = $data.bcadd($uid, $team_id);
        return $team_no;
    }

    //根据id更改数据
    static function updateOfId($id,$where)
    {
        self::whereId($id)->update($where);
        $data = self::whereId($id)->first();
        return $data;
    }

    //属于组别
    static function sectionalization($group_id,$user_active_team)
    {

        self::where('id',$user_active_team->id)->update(['group_id'=>$group_id]);
        UserActiveModel::where('pid',$user_active_team->id)->update(['group_id'=>$group_id]);

        $user_active_team = UserActiveTeamModel::where('user_active_team.id',$user_active_team->id)
            ->leftJoin('user_game_group','user_game_group.id','=','user_active_team.group_id')
            ->select('user_active_team.id','user_active_team.group_id','user_game_group.group','user_game_group.num')
            ->orderBy('group_id','asc')
            ->first();

        /*$user_actives = [];

        for($i=0;$i<count($user_active_team);$i=$i+2){
            if(!isset($user_active_team[$i])){
                break;
            }
            if(isset($user_active_team[$i]) && !isset($user_active_team[$i+1])){
                $user_actives[$user_active_team[$i]['group']][] = $user_active_team[$i];
                break;
            }
            if($user_active_team[$i]['group'] == $user_active_team[$i+1]['group']){
                $user_actives[$user_active_team[$i]['group']][] = $user_active_team[$i];
                $user_actives[$user_active_team[$i]['group']][] = $user_active_team[$i+1];
            }
            if($user_active_team[$i]['group'] != $user_active_team[$i+1]['group']){
                $user_actives[$user_active_team[$i]['group']][] = $user_active_team[$i];
                $user_actives[$user_active_team[$i+1]['group']][] = $user_active_team[$i+1];
            }
        }*/

        return $user_active_team;

    }


}
