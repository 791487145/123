<?php

namespace App\Http\Middleware;

use App\Modules\Manage\Model\ManagerModel;
use Closure;
use Illuminate\Support\Facades\Session;
use App\Modules\Manage\Model\SystemLogModel;
use Illuminate\Support\Facades\Route;
use App\Modules\Manage\Model\Role;
class SystemLog
{

    
    public function handle($request, Closure $next)
    {

        
        $path = Route::currentRouteName();
        $params = $request->all();
        $operator = ManagerModel::getManager();
        if($path == 'loginCreate'){
            $username = $params['username'];
            $password = $params['password'];
            $userInfo = ManagerModel::where('username',$username)->select('id','password','salt')->first();
            if($userInfo){
                $password = ManagerModel::encryptPassword($password, $userInfo->salt);
                if ($userInfo->password == $password) {
                    $uid = $userInfo->id;
                }
                else{
                    $uid = 0;
                }
            }
            else{
                $uid = 0;
            }

        }
        else{
            $uid = $operator->id; 
            $username = $operator->username;
        }
        $log_time = date('Y-m-d H:i:s');
        $log_content = '';
        $common_content = $username.'于'.$log_time;

        switch($path){
            case 'loginCreate':
                $log_content = $common_content .'登录';
                break;
            case 'baseConfigCreate':
                $name = $params['name'];
                $desc = $params['desc'];
                if($params['status']){
                    $status = '开启';
                }
                else{
                    $status = '关闭';
                }
                $log_content = $common_content .'将模型名称：'.$name.'，是否开启：'.$status.'，模型说明：'.$desc.'修改成功';
                break;
            case 'rolesCreate':
                $log_content = $common_content .'创建了用户组';
                break;
            case 'managerCreate':
            case 'userCreate':
                if($path == 'managerCreate'){
                    $name = $params['username'];
                }
                else if($path == 'userCreate'){
                    $name = $params['name'];
                }
                $log_content = $common_content .'创建用户'.$name;
                break;
            case 'userStatusUpdate':
                $log_content = $common_content .'禁用/激活了用户';
                break;
            case 'managerDetailUpdate':
                $uid = $params['uid'];
                $userInfo = ManagerModel::find($uid);
                $name = $userInfo->username;
                $log_content = $common_content .'设置'.$name.'用户组';
                break;
            case 'messageUpdate': 
                $log_content = $common_content .'修改信息模板';
                break;
            case 'thirdLoginCreate':
                $log_content = $common_content .'配置第三方登陆接口';
                break;
            case 'cashoutUpdate':
                $log_content = $common_content .'进行提现审核处理';
                break;
            case 'articleUpdate':
                $log_content = $common_content .'编辑案例';
                break;
            case 'articleCreate':
                $log_content = $common_content .'添加案例';
                break;
            case 'articleDelete':
                $log_content = $common_content .'删除案例';
                break;
            case 'taskUpdate':
                $log_content = $common_content .'审核任务处理';
                break;
            case 'handleRightsCreate':
                $log_content = $common_content .'进行维权处理';
                break;
            case 'reportUpdate':
                $log_content = $common_content .'进行举报处理';
                break;
            case 'attachmentDelete':
                $log_content = $common_content .'删除附件';
                break;
        }
        

        
        if($log_content && $uid){
            $user_type = Role::where('name',$username)->select('id')->first();
            $newData = [
                'uid'           => $uid,
                'username'      => $username,
                'log_content'   => $log_content,
                'created_at'    => $log_time,
                'user_type'     => isset($user_type)?$user_type->id:0,
                'IP'            => $request->ip()
            ];
            $system = SystemLogModel::create($newData);
        }

        return $next($request);

    }
}
