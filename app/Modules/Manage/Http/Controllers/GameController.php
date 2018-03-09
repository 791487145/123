<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Modules\Manage\Model\UserActiveGameRuleModel;
use App\Modules\Manage\Model\UserActiveGroupModel;
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
use spec\PhpSpec\Formatter\Html\ReportPassedItemSpec;
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
        $param['competition'] = $request->input('competition',0);
        $param['group_child'] = $request->input('group_child',0);
        $user_game_rules = UserGameRulesModel::where('category',UserGameRulesModel::CATEGORY_KING_OF_GLORY)->where('pid',0)->orderBy('sort','asc')->get();

        $userActive = new UserActiveModel();

        if($param['competition'] == 0){
            $user_game_rule = UserGameRulesModel::where('name','报名')->first();
            $status = 1;
        }else{
            $user_game_rule = UserGameRulesModel::where('id',$param['competition'])->first();
            if($user_game_rule->name == "报名"){
                $status = 1;
            }
            if($user_game_rule->name == "抽签"){
                $status = 2;
            }
            if($user_game_rule->name == "海选"){
                $user_game_rule_hx_first = UserGameRulesModel::where('pid',$user_game_rule->id)->orderBy('sort','asc')->get()->toArray();
                if($param['group_child'] == 0){
                    $param['group_child'] = $user_game_rule_hx_first[0]['id'];
                }
                $status = 3;
            }
        }

        if($status == 1){
            $param['competition'] = $user_game_rule->id;
            $data = self::reportAndDrawLots($userActive,$param,$this->page,$status,$user_game_rules);
        }
        //抽签
        if($status == 2){
            $userActive = $userActive->where('user_active_group.competition',$param['competition'])
                                        ->leftJoin('user_active_group','user_active_group.u_a_id','=','user_active.id')
                                        ->leftJoin('user_game_group','user_game_group.id','=','user_active_group.u_g_g_id');
            $param['user_game_rule'] = $user_game_rule->status;
            $data = self::reportAndDrawLots($userActive,$param,$this->page,$status,$user_game_rules);
        }
        //海选
        if($status == 3){
            $userActive = $userActive->where('user_active_group.competition',$param['competition'])
                ->leftJoin('user_active_group','user_active_group.u_a_id','=','user_active.id')
                ->leftJoin('user_game_group','user_game_group.id','=','user_active_group.u_g_g_id');
            //$param['user_game_rule'] = $user_game_rule->status;

            self::audition($userActive,$param,$this->page,$status,$user_game_rules);
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
            $user_active->group = $user_game_group->group.'组'.$user_game_group->num.'号';

            $user_game_match_result = UserGameMatchResultModel::where('group_a',$user_active->group_id)->orWhere('group_b',$user_active->group_id)->first();
            if($user_game_match_result->group_a == $user_active->group_id){
                $group_id = $user_game_match_result->group_b;
            }else{
                $group_id = $user_game_match_result->group_a;
            }
            $user_game_group = UserGameGroupModel::where('id',$group_id)->first();
            $user_active->win =  $user_game_match_result->win;

            $user_active->group_b_id = $group_id;
            if(!is_null($user_game_group)){
                $user_active->group_b = $user_game_group->group.'组'.$user_game_group->num.'号';
            }

            $user_game_match_results = UserGameMatchResultModel::where('user_game_match_result.competition',$user_active->competition)
                                                    ->where('group_a','!=',$user_active->group_id)->where('user_game_match_result.type',UserGameMatchResultModel::TYPE_SINGLE)
                                                    ->leftJoin('user_game_group','user_game_group.id','=','user_game_match_result.group_a')
                                                    ->select('user_game_group.id','user_game_group.group','user_game_group.num','user_game_match_result.win','user_game_match_result.id as ugmg_id')
                                                    ->get();

            $data['user_game_match_results'] = $user_game_match_results;
        }

        if ($request->isMethod('post')) {
            $param = [
                'game_name' => $user_active->game_name,
                'game_server' => $user_active->game_server
            ];

            $date = $request->except('_token','match_result','group_b_id');
            $array = array_diff($date, $param);
            $group_b_id = $request->input('group_b_id');
            $match_result = $request->input('match_result');

            if (!empty($array)) {
                UserGameModel::where('uid', $user_active['uid'])->update($array);
            }
            if($group_b_id != $group_id){
                //UserGameMatchResultModel::
            }
            if($match_result != $user_active->win){

            }

            return  redirect('manage/game/single');
        }

        $data['user_active'] = $user_active;

        return $this->theme->scope('manage.gameSingelDetail', $data)->render();

    }

    //分组
    public function sectionalization(Request $request)
    {
        $data = $request->except('_token');
        $user_game_setting = UserGameSettingModel::where('type',$data['type'])->first();
        $group_ids = UserActiveGroupModel::where('competition',$data['competition'])->where('type',$data['type'])->orderBy('u_g_g_id','asc')->lists('u_g_g_id')->toArray();
        $user_ids = UserActiveGroupModel::where('competition',$data['competition'])->where('type',$data['type'])->orderBy('u_g_g_id','asc')->lists('u_a_id')->toArray();
        if($data['type'] == 1){

            if($data['status'] == 2){
                $user_game_rule_hx = UserGameRulesModel::where('name','海选')->first();
                $user_game_rule_hx_first = UserGameRulesModel::where('pid',$user_game_rule_hx->id)->orderBy('sort','asc')->first();
                $user_active_groups = UserActiveGroupModel::where('competition',$data['competition'])->get();
                foreach($user_active_groups as $k=>$user_active_group ){

                    $param = array(
                        'u_a_id' => $user_ids[$k],
                        'u_g_g_id' => $user_active_group->u_g_g_id,
                        'type' => $data['type'],
                        'competition' => $user_game_rule_hx->id,
                    );
                    UserActiveGroupModel::createOne($param);

                }
                UserGameRulesModel::where('id',$data['competition'])->update(['status' => 3]);
                UserGameRulesModel::whereIn('id',array($user_game_rule_hx->id,$user_game_rule_hx_first->id))->update(['status' => 2]);
            }

            for($i=0;$i<count($user_ids);$i++){
                $param = array(
                    'u_a_id' => $user_ids[$i],
                    'u_g_r_id' => $user_game_rule_hx_first->id,
                    'type' => $data['type']
                );
                UserActiveGameRuleModel::createOne($param);
            }
            UserGameMatchResultModel::detail($data['type'],$user_game_rule_hx_first->id,$group_ids,$user_game_setting);
        }

        return 1;
    }

    static function binarySectionalization($user_game_setting,$group_ids,$type)
    {
        if($user_game_setting->num == 4){
            for($i=1;$i<=4;$i++){
                $user_game_groups = UserGameGroupModel::whereIn('id',$group_ids)->where('group_mark',$i)->get();
                if(!$user_game_groups->isEmpty()){
                    $user_game_groups = $user_game_groups->toArray();

                }
            }

        }

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

    public function competitionEdit($id,Request $request)
    {
        $user_game_rule = UserGameRulesModel::where('id',$id)->first();
        if($request->isMethod('post')){
            $param = array(
                'sort' => $user_game_rule->sort,
                'name' => $user_game_rule->name
            );
            $data = $request->except('_token');
            $array = array_diff($data,$param);
            if(!empty($array)){
                UserGameRulesModel::where('id',$id)->update($array);
            }
            return  redirect('manage/game/competition');
        }
        $data = array(
            'user_game_rule' => $user_game_rule,
            'id' => $id
        );
        return $this->theme->scope('manage.gameCompetitionEdit',$data)->render();
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


        $couple_count = UserActiveTeamModel::where('report_status',UserActiveTeamModel::TEAM_REPORT_STATUS_SUCCESS)->where('type',UserActiveTeamModel::TYPE_TRUE)->count();

        $single_remainder = self::remainder($single_count,$single_num);
        $couple_remainder = self::remainder($couple_count,$couple_num);

        $single_remainder = self::theRemainder($single_remainder);
        $couple_remainder = self::theRemainder($couple_remainder);

        $user_game_rule_hx = UserGameRulesModel::where('name','海选')->first();
        $user_game_rule_hx_first = UserGameRulesModel::where('pid',$user_game_rule_hx->id)->orderBy('sort','asc')->first();

        $user_game_group_single = UserGameGroupModel::createOne($single_remainder['array'],UserGameGroupModel::TYPE_SINGLE,$user_game_rule_hx_first->id);
        $user_game_group_couple = UserGameGroupModel::createOne($couple_remainder['array'],UserGameGroupModel::TYPE_COUPLE,$user_game_rule_hx_first->id);

        /*$user_game_group_single = self::initQueue($user_game_group_single);
        $user_game_group_couple = self::initQueue($user_game_group_couple);*/

        /*UserGameMatchResultModel::detail(UserGameMatchResultModel::TYPE_SINGLE,UserGameGroupModel::COMPETITION_NOT_START,$user_game_group_single);
        UserGameMatchResultModel::detail(UserGameMatchResultModel::TYPE_COUPLE,UserGameGroupModel::COMPETITION_NOT_START,$user_game_group_couple);*/

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

    //报名
    static function reportAndDrawLots($userActive,$param,$page,$status,$user_game_rules)
    {
        if($status == 2){
            $user_active = UserActiveModel::getListAll($param,$userActive,$page);
        }
        if($status == 1){
            $user_active = UserActiveModel::getAllList($param,$userActive,$page);
        }

        if(isset($param['user_game_rule'])){
            $data['state'] = $param['user_game_rule'];
            unset($param['user_game_rule']);
        }

        $data['singles'] = $user_active;
        $data['param'] = $param;
        $data['status'] = $status;
        $data['user_game_rules'] = $user_game_rules;
        return $data;
    }

    //海选
    static function audition($userActive,$param,$page,$status,$user_game_rules)
    {
        $user_game_rules_child = UserGameRulesModel::where('pid',$param['competition'])->orderBy('id','asc')->get()->toArray();

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

        $userActive = $userActive->leftJoin('user_active_game_rule','users.id','=','user_active.uid');




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
            'user_game_rules_child' => $user_game_rules_child,
            'user_game_rule_ch' => $user_game_rule_ch
        );
        return $data;
    }


















}
