<?php

namespace App\Http\Middleware;

use App\Modules\Manage\Model\ManagerModel;
use App\Modules\Manage\Model\UserActiveTeamModel;
use App\Modules\Manage\Model\UserGameLogModel;
use App\Modules\Manage\Model\UserGameModel;
use Closure;
use Illuminate\Support\Facades\Session;
use App\Modules\Manage\Model\SystemLogModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Manage\Model\Role;
class GameLog
{

    
    public function handle($request, Closure $next)
    {
        $param = $request->all();
        $path = Route::currentRouteName();
        $time = date("Y-m-d");
        $tokenInfo = Crypt::decrypt(urldecode($param['token']));
        $where = [
            'uid' => $tokenInfo['uid']
        ];

        $user_game_info = UserGameModel::userIsExist($where);
        $user_active_team = UserActiveTeamModel::where('captain_id',$tokenInfo['uid'])->first();

        if(is_null($user_game_info) && $path == 'report_game'){
            $type = UserGameLogModel::LOG_TYPE_CREATE_INFO;
            $content = UserGameLogModel::content($tokenInfo['name'],$type);
            UserGameLogModel::where('to_id',$tokenInfo['uid'])->where('type',$type)->delete();
        }

        if(is_null($user_active_team) && $path == 'createTeam'){
            $type = UserGameLogModel::LOG_TYPE_CREATE_TEAM;
            $content = UserGameLogModel::content($tokenInfo['name'],$type);
            UserGameLogModel::where('to_id',$tokenInfo['uid'])->where('type',$type)->delete();
        }

        if(!is_null($user_active_team) && $path == 'teamReport' && $user_active_team->report_status == UserActiveTeamModel::TEAM_REPORT_STATUS_NULL){
            $type = UserGameLogModel::LOG_TYPE_REPORT_TEAM;
            $content = UserGameLogModel::content($tokenInfo['name'],$type);
            UserGameLogModel::where('to_id',$tokenInfo['uid'])->where('type',$type)->delete();
        }


        if(isset($content) && isset($type)){
            UserGameLogModel::createOne($tokenInfo['uid'],$type,$content);
        }

        return $next($request);

    }
}
