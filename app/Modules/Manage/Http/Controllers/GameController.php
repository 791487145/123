<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Modules\Manage\Model\UserActiveModel;
use App\Modules\Manage\Model\UserActiveTeamModel;
use App\Modules\Manage\Model\UserGameGroupModel;
use App\Modules\Manage\Model\UserGameMatchResultModel;
use App\Modules\Manage\Model\UserGameModel;
use App\Modules\Manage\Model\UserGameRulesModel;
use App\Modules\Manage\Model\UserGameSettingModel;
use App\Http\Controllers\ManageController;
use App\Modules\Task\Model\TaskExtraModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Theme;
use Illuminate\Support\Facades\Redis;

class GameController extends ManageController
{

    protected $page = 20;   //分页信息
    protected $all = 999;

    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        //$this->theme->setTitle('参赛详情');
        //$this->theme->set('manageType', 'task');
    }

    /**
     * 单人列表
     * @param Request $request
     * @return mixed
     */
    public function single(Request $request)
    {
        $param = array();
        $status = $request->input('status',1);
        $param['competition'] = $request->input('competition',$this->all);
        $param['group_child'] = $request->input('group_child',0);
        $user_game_rules = UserGameRulesModel::where('category',UserGameRulesModel::CATEGORY_KING_OF_GLORY)->where('pid',0)->orderBy('sort','asc')->get();

        $userActive = new UserActiveModel();

        if($param['competition'] == $this->all || $param['competition'] == 0){
            $status = 1;
        }

        if($param['competition'] != $this->all && $param['competition'] != 0){
            $status = 2;
        }

        if($status == 1){
            $data = self::reportAndDrawLots($userActive,$param,$this->page,$status,$user_game_rules);
        }

        if($status != 1){
            $user_game_rule = UserGameRulesModel::where('id',$param['competition'])->first();
            if($user_game_rule->name == "海选"){
                $status = 2;
            }
        }

        if($status == 2){
            $data = self::audition($userActive,$param,$this->page,$status,$user_game_rules);
        }


        return $this->theme->scope('manage.gameSingleList', $data)->render();
    }

    //单人赛编辑
    public function singleEdit($id,Request $request)
    {
        $user_active = UserActiveModel::where('user_active.id', $id)
            ->leftJoin('users', 'users.id', '=', 'user_active.uid')
            ->leftJoin('user_game_info', 'user_game_info.uid', '=', 'user_active.uid')
            ->select('user_active.id', 'user_active.created_at','user_active.competition', 'user_active.group_id', 'user_active.uid', 'user_game_info.game_name', 'user_game_info.game_server', 'users.name')
            ->first();

        if ($user_active->group_id == 0) {
            $user_active->group = '未分组';
        }else{
            $user_game_group = UserGameGroupModel::where('id',$user_active->group_id)->first();
        }

        if ($request->isMethod('post')) {
            $param = [
                'game_name' => $user_active->game_name,
                'game_server' => $user_active->game_server
            ];
            $date = $request->except('_token');
            $array = array_diff($date, $param);

            if (!empty($array)) {
                UserGameModel::where('uid', $user_active['uid'])->update($array);
            }
            return  redirect('manage/game/single');
        }

        $data = array(
            'user_active' => $user_active,
        );

        return $this->theme->scope('manage.gameSingelDetail', $data)->render();

    }

    //团队列表
    public function team($type,Request $request)
    {
        $param['report_status'] = $request->input('report_status',$this->all);

        $userActiveTeam = new UserActiveTeamModel();

        if($param['report_status'] != $this->all){
            $userActiveTeam = UserActiveTeamModel::where('report_status',$param['report_status']);
        }

        if($type == 0){
            $userActiveTeam = $userActiveTeam->where('remark','');
        }

        if($type == 1){
            $userActiveTeam = $userActiveTeam->where('remark',5);
        }

        $user_active_teams = $userActiveTeam->orderBy('id','asc')->paginate($this->page);

        foreach($user_active_teams as $user_active_team){

            if($user_active_team->report_status == UserActiveTeamModel::TEAM_REPORT_STATUS_SUCCESS){
                $user_active_team->report_status = '已报名';
            }else{
                $user_active_team->report_status = '未报名';
            }

            $user_active_team->total = UserActiveModel::where('pid',$user_active_team->id)->count();
            if($user_active_team->remark == 5){
                $user_active_team->total = 5;
            }

        }

        $data = array(
            'teams' => $user_active_teams,
            'param' => $param,
            'type' => $type
        );
        return $this->theme->scope('manage.gameTeamList', $data)->render();
    }

    //删除
    public function teamDel(Request $request)
    {
        $id = $request->input('id');
        $ret = UserActiveTeamModel::whereId($id)->delete();
        if ($ret) {
            return $id;
        }
        return 0;
    }

    //团队详情
    public function teamDetail($id)
    {
        $user_active_team = UserActiveTeamModel::whereId($id)->select('id','team_name','logo','report_status','captain_id')->first();

        $user_active_team->report_status = '未报名';
        if($user_active_team->report_status == UserActiveTeamModel::TEAM_REPORT_STATUS_SUCCESS){
            $user_active_team->report_status = '已报名';
        }

        $user_active_team->total = UserActiveModel::where('pid',$user_active_team->id)->count();

        $user_actives = UserActiveModel::where('pid',$id)
                ->leftJoin('users', 'users.id', '=', 'user_active.uid')
                ->leftJoin('user_game_info', 'user_game_info.uid', '=', 'user_active.uid')
                ->select('user_active.id', 'user_active.uid', 'user_game_info.game_name', 'user_game_info.game_server', 'users.name')
                ->orderBy('id','asc')
                ->get();

        foreach($user_actives as $user_active){
            $user_active->identify = "队员";
            if($user_active_team->captain_id == $user_active->uid){
                $user_active->identify = "队长";
            }
        }

        if($user_active_team->total == 0){
            UserActiveTeamModel::where('id',$id)->delete();
        }

        $data = array(
            'user_active_team' => $user_active_team,
            'user_actives' => $user_actives
        );
        return $this->theme->scope('manage.gameTeamDetail', $data)->render();
    }

    //添加战队
    public function teamAdd(Request $request)
    {
        if($request->isMethod("post")){
            $data = $request->except('_token','pic');
            $file = $request->file('pic');

            $data['logo'] = 'uploads/game/moren/ZDlogo_01.png';
            if(!empty($file)){
                $result = \FileClass::uploadFile($file,'game');
                $result = json_decode($result,true);
                $data['logo'] = $result['data']['url'];
            }

            $ret = UserActiveTeamModel::createOne($data);

            return  redirect('manage/game/team/0');
        }

        return $this->theme->scope('manage.gameTeamAdd')->render();
    }

    public function teamEdit($id,Request $request)
    {
        $user_active_team = UserActiveTeamModel::whereId($id)->first();

        if($request->isMethod("post")){
            $data = $request->except('_token','pic');
            $file = $request->file('pic');

            if(!empty($file)){
                $result = \FileClass::uploadFile($file,'game');
                $result = json_decode($result,true);
                $data['logo'] = $result['data']['url'];
            }

            UserActiveTeamModel::whereId($id)->update($data);
            return  redirect('manage/game/team/1');
        }

        $data = array(
            'user_active_team' => $user_active_team,
        );
        return $this->theme->scope('manage.gameTeamEdit', $data)->render();
    }

    //赛制
    public function competition(Request $request)
    {
        $param['category'] = $request->input('category',1);
        $param['name'] = $request->input('name','');

        $user_game_rules = new UserGameRulesModel();
        if($param['name'] != ''){
            $user_game_rules = $user_game_rules->where('name', 'like', '%' . $param['name'] . '%');
        }

        $user_game_rules = $user_game_rules::where('category',$param['category'])->orderBy('sort','asc')->get()->toArray();

        $user_game_rules = \CommonClass::listToTree($user_game_rules,'id','pid','_child',0);

        $data = array(
            'user_game_rules' => $user_game_rules,
            'param' => $param
        );

        return $this->theme->scope('manage.gameCompetitionList', $data)->render();
    }

    public function competitionAdd($id,Request $request)
    {
        if($request->isMethod("post")){
            $param['name'] = $request->input('name');
            $param['category'] = $request->input('category');
            $param['sort'] = $request->input('sort');
            $param['pid'] = $request->input('pid',0);
            UserGameRulesModel::createOne($param);
            return  redirect('manage/game/competition');
        }

        $data = array(
            'pid' => $id
        );

        return $this->theme->scope('manage.gameCompetitionAdd',$data)->render();
    }

    public function competitionDel(Request $request)
    {
        $id = $request->input('id');
        $ret = UserGameRulesModel::whereId($id)->delete();
        UserGameRulesModel::where('pid',$id)->delete();
        if ($ret) {
            return $id;
        }
        return 0;
    }

    public function gameConfig()
    {
        $user_game_settings['single'] = UserGameSettingModel::where('type',UserGameSettingModel::TYPE_SINGLE)->first();
        $user_game_settings['couple'] = UserGameSettingModel::where('type',UserGameSettingModel::TYPE_COUPLE)->first();

        $data = array(
            'user_game_settings' => $user_game_settings
        );

        return $this->theme->scope('manage.gameconfig',$data)->render();
    }

    public function gameGroupInitialize(Request $request)
    {
        $single_num = $request->input('single_num');
        $couple_num = $request->input('couple_num');

        DB::table('user_game_group')->truncate();
        DB::table('user_game_match_result')->truncate();

        $single_count = UserActiveModel::wherePid(0)->where('cantain',UserActiveModel::ACTIVE_CANTAIN_ONE)->where('active_type',UserActiveModel::ACTIVE_TYPE_WX)->count();


        $couple_count = UserActiveTeamModel::where('competition',UserActiveTeamModel::COMPETITION_NOT_START)->where('report_status',UserActiveTeamModel::TEAM_REPORT_STATUS_SUCCESS)
                ->where('type',UserActiveTeamModel::TYPE_TRUE)->count();

        $single_remainder = self::remainder($single_count,$single_num);
        $couple_remainder = self::remainder($couple_count,$couple_num);

        $single_remainder = self::theRemainder($single_remainder);
        $couple_remainder = self::theRemainder($couple_remainder);


        $user_game_group_single = UserGameGroupModel::createOne($single_remainder['array'],UserGameGroupModel::TYPE_SINGLE,UserGameGroupModel::COMPETITION_NOT_START);
        $user_game_group_couple = UserGameGroupModel::createOne($couple_remainder['array'],UserGameGroupModel::TYPE_COUPLE,UserGameGroupModel::COMPETITION_NOT_START);

        $user_game_group_single = self::initQueue($user_game_group_single);
        $user_game_group_couple = self::initQueue($user_game_group_couple);

        UserGameMatchResultModel::detail(UserGameMatchResultModel::TYPE_SINGLE,UserGameGroupModel::COMPETITION_NOT_START,$user_game_group_single);
        UserGameMatchResultModel::detail(UserGameMatchResultModel::TYPE_COUPLE,UserGameGroupModel::COMPETITION_NOT_START,$user_game_group_couple);

        UserGameSettingModel::createOne(UserGameSettingModel::TYPE_SINGLE,$single_num);
        UserGameSettingModel::createOne(UserGameSettingModel::TYPE_COUPLE,$couple_num);

        return  redirect('manage/game/gameConfig');
    }

    //数组化
    static function remainder($count,$num)
    {
        $param = array();
        if($num == 4){
            $param['sorts'] = intval(floor($count/$num));
            $param['array'] = [$param['sorts'],$param['sorts'],$param['sorts'],$param['sorts']];
            $param['remainder'] = $count%$num;
        }
        if($num == 8){
            $param['sorts'] = intval(floor($count/$num));
            $param['array'] = [$param['sorts'],$param['sorts'],$param['sorts'],$param['sorts'],$param['sorts'],$param['sorts'],$param['sorts'],$param['sorts']];
            $param['remainder'] = $count%$num;
        }

        return $param;
    }

    //余数分析
    static function theRemainder($single_remainder)
    {
        if($single_remainder['remainder']){
            for($i = 1;$i<=$single_remainder['remainder'];$i++){
                $single_remainder['array'][$i-1] = $single_remainder['sorts'] + 1;
            }
        }

        return $single_remainder;
    }

    //队列化
    static function initQueue($user_active_team)
    {
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
        }
        return $user_actives;
    }

    //抽签报名
    static function reportAndDrawLots($userActive,$param,$page,$status,$user_game_rules)
    {
        if($param['competition'] == 0){
            $userActive = $userActive->where('user_active.group_id',$param['competition']);
        }
        $user_active = UserActiveModel::getAllList($param,$userActive,$page);

        $data = array(
            'singles' => $user_active,
            'param' => $param,
            'status' => $status,
            'user_game_rules' => $user_game_rules
        );
        return $data;
    }

    //海选
    static function audition($userActive,$param,$page,$status,$user_game_rules)
    {
        $user_game_rules_child = UserGameRulesModel::where('pid',$param['competition'])->orderBy('id','asc')->get()->toArray();
        if($param['group_child'] == 0){
            $param['group_child'] = $user_game_rules_child[0]['id'];
        }

        $user_game_rules_count = count($user_game_rules_child);
        if($user_game_rules_child[$user_game_rules_count -1]['id'] == $param['group_child']){
            $user_game_rule_ch = UserGameRulesModel::where('name','小组赛')->first();
        }else{
            for($i = 0;$i < $user_game_rules_count ;$i++){
                if($user_game_rules_child[$i]['id'] == $param['group_child']){
                    $user_game_rule_ch = UserGameRulesModel::where('id',$user_game_rules_child[$i+1]['id'])->first();
                }
            }
        }



        $userActive = $userActive->where('user_active.competition',$param['group_child'])->where('group_id','!=',0);




        $user_actives = UserActiveModel::getAllList($param,$userActive,$page);
        foreach($user_actives as $user_active){
            $user_game_match_result = UserGameMatchResultModel::where('group_a',$user_active->group_id)->orWhere('group_b',$user_active->group_id)->first();
            if($user_game_match_result->group_a == $user_active->group_id){
                $group_id = $user_game_match_result->group_b;
            }else{
                $group_id = $user_game_match_result->group_a;
            }
            $user_game_group = UserGameGroupModel::where('id',$group_id)->first();

            $user_active->group_b = '轮空';
            if(!is_null($user_game_group)){
                $user_active->group_b = $user_game_group->group.'组'.$user_game_group->num.'号';
            }
        }
        //dd($user_game_rules_child);
        $data = array(
            'singles' => $user_actives,
            'param' => $param,
            'status' => $status,
            'user_game_rules' => $user_game_rules,
            'user_game_rules_child' => $us