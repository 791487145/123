<?php

namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\ManageController;
use App\Modules\Manage\Model\SystemLogModel;
use Illuminate\Http\Request;
use Theme;
use Validator;
use DB;
use App\Modules\Manage\Model\Role;

class SystemLogController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('系统日志');
    }

    
    public function systemLogList(Request $request){
        $by = $request->get('by') ? $request->get('by') : 'id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;

        $systemLog = SystemLogModel::select('*')->orderBy($by,$order);

        if($request->get('id')){
            $systemLog = $systemLog->where('id',intval($request->get('id')));
        }
        if ($request->get('username')) {
            $systemLog = $systemLog->where('username','like','%'.$request->get('username').'%');
        }
        if ($request->get('log_content')) {
            $systemLog = $systemLog->where('log_content','like','%'.$request->get('log_content').'%');
        }
        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $systemLog = $systemLog->where('created_at','>',$start);
        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $systemLog = $systemLog->where('created_at','<',$end);
        }
        $systemLog = $systemLog->paginate($paginate);
        if(isset($systemLog)){
           foreach($systemLog as $k=>$v){
               $roleInfo = Role::where('id',$v->user_type)->where('name',$v->username)->select('display_name')->first();
               if(isset($roleInfo)){
                   $systemLog[$k]['type_name'] = $roleInfo->display_name;
               }
               else{
                   $systemLog[$k]['type_name'] = '未定义';
               }
           }
        }

        $view = array(
            'systemLog'    => $systemLog,
            'id'           => $request->get('id'),
            'username'     => $request->get('username'),
            'log_content'  => $request->get('log_content'),
            'by'           => $by,
            'order'        => $order,
            'paginate'     => $paginate

        );
        $search = $request->all();
        $view['search'] = $search;

        return $this->theme->scope('manage.systemlog', $view)->render();
    }



}
