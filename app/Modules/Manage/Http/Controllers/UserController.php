<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Modules\Manage\Model\ManagerModel;
use App\Modules\Manage\Model\MenuPermissionModel;
use App\Modules\Manage\Model\ModuleTypeModel;
use App\Modules\Manage\Model\Permission;
use App\Modules\Manage\Model\PermissionRoleModel;
use App\Modules\Manage\Model\Role;
use App\Modules\Manage\Model\RoleUserModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\Task\Model\DistrictRegionModel;
use App\Modules\User\Model\RealnameAuthModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use App\Modules\User\Model\UserBalanceModel;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends ManageController
{
	//
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');
        $this->theme->setTitle('用户管理');
        $this->theme->set('manageType', 'User');
        //用户账号状态 1-激活 2-已激活 3-禁用
        $this->status = array('1'=>'未激活','2'=>'已激活','3'=>'已禁用');
    }

    /**
     * 普通用户列表
     *
     * @param Request $request
     * @return mixed
     */
    public function getUserList(Request $request)
    {
        $list = UserModel::select('users.name', 'user_detail.created_at', 'user_balance.balance', 'users.id', 'users.last_login_time', 'users.status')
            ->leftJoin('user_detail', 'users.id', '=', 'user_detail.uid')
            ->leftJoin('user_balance','users.id','=','user_balance.user_id');

        if ($request->get('uid')){
            $list = $list->where('users.id', $request->get('uid'));
        }
        if ($request->get('username')){
            $list = $list->where('users.name','like', '%'.$request->get('username').'%');
        }
        if ($request->get('email')){
            $list = $list->where('users.email', $request->get('email'));
        }
        if ($request->get('mobile')){
            $list = $list->where('user_detail.mobile', $request->get('mobile'));
        }
        if ($request->get('status') && $request->get('status') != '-1'){
            $list = $list->where('users.status',$request->get('status'));
        }

        $order = $request->get('order') ? $request->get('order') : 'desc';
        if ($request->get('by')){
            switch ($request->get('by')){
                case 'id':
                    $list = $list->orderBy('users.id', $order);
                    break;
                case 'created_at':
                    $list = $list->orderBy('users.created_at', $order);
                    break;
            }
        } else {
            $list = $list->orderBy('users.created_at', $order);
        }

        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;
        //时间筛选
        $timeType = 'users.created_at';
        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $list = $list->where($timeType,'>',$start);

        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $list = $list->where($timeType,'<',$end);
        }
        $list = $list->paginate($paginate);

        foreach ($list as &$list_s){
            $list_s['state'] = $this->status[$list_s['status']];
        }

        $data = [
            'status'=>$request->get('status'),
            'list' => $list,
            'paginate' => $paginate,
            'order' => $order,
            'by' => $request->get('by'),
            'uid' => $request->get('uid'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'mobile' => $request->get('mobile')
        ];
        $search = [
            'status'=>$request->get('status'),
            'paginate' => $paginate,
            'order' => $order,
            'by' => $request->get('by'),
            'uid' => $request->get('uid'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'mobile' => $request->get('mobile'),
            'start' => $request->get('start'),
            'end' => $request->get('end')
        ];
        $data['search'] = $search;
        $this->theme->setTitle('普通用户');
 		return $this->theme->scope('manage.userList', $data)->render();
    }

    /**
     * 处理用户
     *
     * @param $uid
     * @param $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleUser($uid, $action)
    {
        switch ($action){
            case 'enable':
                $status = 2;
                break;
            case 'disable':
                $status = 3;
                break;
        }
        $status = UserModel::where('id', $uid)->update(['status' => $status]);
        if ($status)
            return back()->with(['message' => '操作成功']);
    }

    /**
     * 添加普通用户视图
     *
     * @return mixed
     */
    public function getUserAdd()
    {
        $province = DistrictModel::findTree(0);
        $data = [
            'province' => $province
        ];
 		return $this->theme->scope('manage.userAdd', $data)->render();
    }

    /**
     * 添加用户表单提交
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUserAdd(Request $request)
    {
        //dd($request->all());
        $salt = \CommonClass::random(4);
        $data = [
            'name' => $request->get('name'),
            'realname' => $request->get('realname'),
            'mobile' => $request->get('mobile'),
            'qq' => $request->get('qq'),
            'email' => $request->get('email'),
            'province' => $request->get('province'),
            'city' => $request->get('city'),
            'area' => $request->get('area'),
            'password' => UserModel::encryptPassword($request->get('password'), $salt),
            'salt' => $salt
        ];
        $status = UserModel::addUser($data);
        if ($status)
            return redirect('manage/userList')->with(['message' => '操作成功']);
    }

    /**
     * 检查用户名
     *
     * @param Request $request
     * @return string
     */
    public function checkUserName(Request $request){
        $username = $request->get('param');
        $status = UserModel::where('name', $username)->first();
        if (empty($status)){
            $status = 'y';
            $info = '';
        } else {
            $info = '用户名不可用';
            $status = 'n';
        }
        $data = array(
            'info' => $info,
            'status' => $status
        );
        return json_encode($data);
    }

    /**
     * 检测邮箱是否可用
     *
     * @param Request $request
     * @return string
     */
    public function checkEmail(Request $request){
        $email = $request->get('param');

        $status = UserModel::where('email', $email)->first();
        if (empty($status)){
            $status = 'y';
            $info = '';
        } else {
            $info = '邮箱已占用';
            $status = 'n';
        }
        $data = array(
            'info' => $info,
            'status' => $status
        );
        return json_encode($data);
    }

    /**
     * 编辑用户资料视图
     *
     * @param $uid
     * @return mixed
     */
    public function getUserEdit($uid)
    {
        $select = array(
                'users.name',
                'users.id',
                'users.head_img',
                'users.last_login_time',

                'user_detail.realname',
                'user_detail.sex',
                'user_detail.nickname',
                'user_detail.mobile',
                'user_detail.province',
                'user_detail.city',
                'user_detail.area',
                'user_detail.region',
                'user_detail.school_province',
                'user_detail.school',
                'user_detail.system',
                'user_detail.class',
                'user_detail.majors',
                'user_detail.employee_praise_rate',
                'user_detail.employer_praise_rate',
                'user_detail.receive_task_num',
                'user_detail.publish_task_num',
                'user_detail.qq',
                'user_detail.wechat',
                'user_detail.autograph',
                'user_detail.native_place',
                'user_detail.birthday',
                'user_detail.year_old',
                'user_detail.card_number',
                'user_balance.balance',
                'user_balance.gold',
        );

        $info = UserModel::select($select)
                         ->where('users.id', $uid)
                         ->leftJoin('user_detail', 'users.id', '=', 'user_detail.uid')
                         ->leftJoin('user_balance','users.id','=','user_balance.user_id')
                         ->first()->toArray();

        $province = DistrictModel::findTree(0);
        $region = DistrictRegionModel::findTree(0);

            $province_city = DistrictModel::findTree($info['province']);
            $city_area = DistrictModel::findTree($info['city']);
            $region_province = DistrictRegionModel::findTree($info['region']);
            $province_school = DistrictRegionModel::findTree($info['school_province']);


        $auth = RealnameAuthModel::whereUid($uid)->first();

        $data = [
            'info' => $info,
            'province' => $province,
            'region' => $region,
            'province_city' => $province_city,
            'city_area' => $city_area,
            'city' => DistrictModel::getDistrictName($info['city']),
            'area' => DistrictModel::getDistrictName($info['area']),
            'region_province' => $region_province,
            'province_school' => $province_school,
        ];

        if(!is_null($auth)){
            $param1 = [
                'auth_status' => $auth->status,
                'auth_type' => $auth->type,
                'auth_card_type' => $auth->card_type,
            ];
            $data = array_merge($data,$param1);
        }

 		return $this->theme->scope('manage.userDetail', $data)->render();
    }

    /**
     * 编辑用户资料
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUserEdit(Request $request)
    {
        //查询手机号码是否可设置
        if(!empty($request->get('mobile'))){
            $isExistsUser = UserModel::where('id','!=',$request->get('uid'))->where('mobile',$request->get('mobile'))->exists();
            $isExistsDetail = UserDetailModel::where('uid','!=',$request->get('uid'))->where('mobile',$request->get('mobile'))->exists();
            if($isExistsUser || $isExistsDetail){
                return redirect('/manage/userEdit/'.$request->get('uid'))->with(['message' => '手机号已经被占用']);
            }
        }
        $request = $request->all();

        $userArr = array(
                'name' => $request['name'],
                'mobile' => $request['mobile'],
            );
        $u_res = UserModel::where('id',$request['uid'])->update($userArr);

        if($u_res === false) redirect('manage/userList')->with(array('message' => '用户操作失败'));

        $userDetailArr = array(
                'realname' => $request['realname'],
                'mobile' => $request['mobile'],
                'sex' => $request['sex'],
                // 'sex' => '1',
                'nickname' => $request['nickname'],
                // 'birthday' => $request['birthday'],
                // 'year_old' => $request['year_old'],
                'province' => $request['province'],
                'city' => $request['city'],
                'area' => $request['area'],
                'region' => $request['region'],
                'school_province' => $request['school_province'],
                'school' => $request['school'],
                'native_place' => $request['native_place'],
                'system' => $request['system'],
                'class' => $request['class'],
                'majors' => $request['majors'],
            );
        $u_d_res = UserDetailModel::where('uid',$request['uid'])->update($userDetailArr);

        if($u_d_res === false) redirect('manage/userList')->with(array('message' => '用户详情操作失败'));

        $userBalanceArr = array(
                'balance' => $request['balance'],
                /*'gold' => $request['gold'],*/
            );

        $userBalanceDate = UserBalanceModel::where('user_id',$request['uid'])->select('balance','gold')->first();

        if($request['balance'] != $userBalanceDate['balance']){
            $balance_change = $request['balance'] - $userBalanceDate['balance'];
            //判断金额正负
            if($balance_change > 0){
                $add = "1";
                $action = "11";
            }else{
                $add="2";
                $action = "12";
            }
            $amount1 = abs($balance_change);
            $u_b_res1 = UserBalanceModel::addUserBalance($amount1,$request['uid'],$action,$add);
            if($u_b_res1['code'] != 200){
                redirect('manage/userList')->with(array('message' => $u_b_res1['msg']));
            }
        }

       /* if($request['gold'] != $userBalanceDate['gold']){
            $gold_change = $request['gold'] - $userBalanceDate['gold'];
            if($gold_change > 0) $add = '1'; else $add= '2';
            $amount2 = abs($gold_change);
            $u_b_res2 = UserBalanceModel::addUserGold($amount2,$request['uid'],'','5',$add);
            if($u_b_res2['code'] != 200){
                redirect('manage/userList')->with(array('message' => $u_b_res2['msg']));
            }
        }*/

        return redirect('manage/userList')->with(['message' => '操作成功']);
    }

    /**
     * 系统用户列表
     *
     * @param Request $request
     * @return mixed
     */
   	public function getManagerList(Request $request)
   	{
        $merge = $request->all();
        $list = ManagerModel::select('manager.id','manager.username','roles.display_name','manager.status','manager.email','manager.telephone','manager.QQ')->leftJoin('role_user','manager.id','=','role_user.user_id')
           ->leftJoin('roles','roles.id','=','role_user.role_id');
        $roles = Role::get();
        if($request->get('uid')){
            $list = $list->where('manager.id',$request->get('uid'));
        }
        if($request->get('username')){

            $list = $list->where('manager.username','like','%'. $request->get('username').'%');
        }
        if($request->get('QQ')){

            $list = $list->where('manager.QQ','like','%'. $request->get('QQ').'%');
        }
        if($request->get('email')){

            $list = $list->where('manager.email','like','%'. $request->get('email').'%');
        }
        if($request->get('display_name') && $request->get('display_name') != '全部'){
            $list = $list->where('roles.id',$request->get('display_name'));
        }
        if($request->get('telephone')){

            $list = $list->where('manager.telephone','like','%'. $request->get('telephone').'%');
        }
        if ($request->get('status')!=""){
            $list = $list->where('manager.status', $request->get('status'));
        }
        if($request->get('role_id')!=""){
            $list = $list->where('roles.id', $request->get('role_id'));
        }

        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;
        $list = $list->orderBy('manager.id',$order)->paginate($paginate);
        $listArr = $list->toArray();
        $data = array(
            'merge' => $merge,
            'listArr' => $listArr,
            'status'=>$request->get('status'),
            'by' => $request->get('by'),
            'order' => $order,
            'display_name'=>$request->get('display_name'),
            'uid'=>$request->get('uid'),
            'username'=>$request->get('username'),
            'QQ'=>$request->get('QQ'),
            'email'=>$request->get('email'),
            'telephone'=>$request->get('telephone'),
            'list'=>$list,
            'roles'=>$roles,
            'role_id'=>$request->get('role_id'),
       );
        $this->theme->setTitle('系统用户');
		return $this->theme->scope('manage.managerList',$data)->render();
   	}

    /**
     * 处理用户
     *
     * @param $uid
     * @param $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleManage($uid, $action)
    {
        switch ($action){
            case 'enable':
                $status = 1;
                break;
            case 'disable':
                $status = 2;
                break;
        }
        $status = ManagerModel::where('id', $uid)->update(['status' => $status]);
        if ($status)
            return back()->with(['message' => '操作成功']);
    }

    /**
     * 验证系统用户名
     *
     * @param Request $request
     * @return string
     */
    public function checkManageName(Request $request){
        $username = $request->get('param');
        $status = ManagerModel::where('username', $username)->first();
        if (empty($status)){
            $status = 'y';
            $info = '';
        } else {
            $info = '用户名不可用';
            $status = 'n';
        }
        $data = array(
            'info' => $info,
            'status' => $status
        );
        return json_encode($data);
    }

    /**
     * 验证系统用户邮箱
     *
     * @param Request $request
     * @return string
     */
    public function checkManageEmail(Request $request){
        $email = $request->get('param');

        $status = ManagerModel::where('email', $email)->first();
        if (empty($status)){
            $status = 'y';
            $info = '';
        } else {
            $info = '邮箱已占用';
            $status = 'n';
        }
        $data = array(
            'info' => $info,
            'status' => $status
        );
        return json_encode($data);
    }

    /**
     * 批量删除用户
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postManagerDeleteAll(Request $request){
       // dd($request->all());
        $data = $request->except('_token');
        //var_dump($data['chk']);exit;
        if(!$data['chk']){
            return  redirect('manage/managerList')->with(array('message' => '操作失败'));
        }
        $status = DB::transaction(function () use ($data) {
            foreach ($data['chk'] as $id) {
                ManagerModel::where('id', $id)->delete();
               RoleUserModel::where('user_id', $id)->delete();
            }
        });
        if(is_null($status))
        {
            return redirect()->to('manage/managerList')->with(array('message' => '操作成功'));
        }
        return  redirect()->to('manage/managerList')->with(array('message' => '操作失败'));
    }

    /**
     *删除用户
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function managerDel($id){
        $status = DB::transaction(function () use ($id){
            ManagerModel::where('id',$id)->delete();
            RoleUserModel::where('user_id',$id)->delete();
        });

        if (is_null($status))
            return redirect()->to('manage/managerList')->with(['message' => '操作成功']);
    }
    /**
     * 添加用户视图
     *
     * @return mixed
     */
   	public function managerAdd()
   	{
        $roles = Role::get();
        $data = array(
            'roles'=>$roles
        );
		return $this->theme->scope('manage.managerAdd',$data)->render();
   	}

    /**
     * 系统用户表单提交
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postManagerAdd(Request $request)
    {
        $status = DB::transaction(function () use ($request) {
            $salt = \CommonClass::random(4);
            $data = [
                'username' => $request->get('username'),
                'realname' => $request->get('realname'),
                'telephone' => $request->get('telephone'),
                'QQ' => $request->get('QQ'),
                'email' => $request->get('email'),
                'password' => ManagerModel::encryptPassword($request->get('password'), $salt),
                'birth' => $request->get('birth'),
                'salt' => $salt,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ];
            ManagerModel::insert($data);
            $user = ManagerModel::where('username',$request->get('username'))->first();
            if($request->get('role_id'))
              $user->attachRole($request->get('role_id'));
        });
        if (is_null($status))
            return redirect('manage/managerList')->with(['message' => '操作成功']);
    }

    /**
     * 系统用户详情
     *
     * @param $id
     * @return mixed
     */
   	public function managerDetail($id)
   	{
        $info = ManagerModel::select('manager.id','manager.username','manager.status','manager.email','manager.telephone','manager.QQ','manager.password','role_user.role_id')->leftJoin('role_user','manager.id','=','role_user.user_id')
            ->leftJoin('roles','roles.id','=','role_user.role_id')->where('manager.id',$id)->first();
        $roles = Role::get();
        $data = array(
            'roles'=>$roles,
            'info'=>$info,

        );
		return $this->theme->scope('manage.managerDetail',$data)->render();
   	}

    /**
     * 编辑用户资料
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postManagerDetail(Request $request)
    {
        $status = DB::transaction(function () use ($request) {
            $id = $request->get('uid');
            if(!ManagerModel::where('id',$id)->where('password',$request->get('password'))->first()) {
                $salt = \CommonClass::random(4);
                $data = array(
                    'realname' => $request->get('realname'),
                    'telephone' => $request->get('telephone'),
                    'QQ' => $request->get('QQ'),
                    'password' => ManagerModel::encryptPassword($request->get('password'), $salt),
                    'birth' => $request->get('birth'),
                    'salt' => $salt,
                    'updated_at' => date('Y-m-d H:i:s', time())
                );
            }else{
                $data = array(
                    'realname' => $request->get('realname'),
                    'telephone' => $request->get('telephone'),
                    'QQ' => $request->get('QQ'),
                    'birth' => $request->get('birth'),
                    'updated_at' => date('Y-m-d H:i:s', time())
                );
            }
            ManagerModel::where('id', $id)->update($data);
            $user = ManagerModel::where('id',$id)->first();
            RoleUserModel::where('user_id',$id)->delete();
            $user->attachRole($request->get('role_id'));
//            if(!RoleUserModel::where('user_id',$id)->where('role_id',$request->get('role_id'))->first())
//                $user->attachRole($request->get('role_id'));

        });
       if (is_null($status))
            return redirect('manage/managerList')->with(['message' => '操作成功']);
    }


    /**
     * 系统组列表
     *
     * @return mixed
     */
    public function getRolesList()
    {
        $list =  Role::select('roles.id','roles.display_name','roles.updated_at')->orderBy('roles.id','DESC')->paginate(10);
        $data = array(
            'list'=>$list
        );
        $this->theme->setTitle('角色管理');
        return $this->theme->scope('manage.rolesList',$data)->render();
    }

    /**
     * 添加系统组视图
     *
     * @return mixed
     */
    public function getRolesAdd()
    {
        $tree_menu = Permission::getPermissionMenu();

        $data = array(
            'list' =>$tree_menu,
        );
        return $this->theme->scope('manage.rolesAdd',$data)->render();
    }
    /**
     * 添加系统组
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRolesAdd(Request $request)
    {
          if(!count($request->get('id'))){
            return redirect('manage/rolesAdd')->with(['message' => '请设置用户组权限']);
        }
        $status = DB::transaction(function () use ($request) {
            $data = array(
                'name' => $request->get('name'),
                'display_name'=>$request->get('display_name'),
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            );
            $role_id = Role::insertGetId($data);
            foreach ($request->get('id') as $id) {
                $role_id = $role_id;
                $data2 = array(
                    'permission_id' => $id,
                    'role_id' => $role_id
                );
                $re2 = PermissionRoleModel::insert($data2);
            }
        });
        if (is_null($status))
            return redirect('manage/rolesList')->with(['message' => '操作成功']);
    }

    /**
     * 删除系统组列表
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getRolesDel($id)
    {
        $status = DB::transaction(function () use ($id) {
            Role::where('id', $id)->delete();
            PermissionRoleModel::where('role_id',$id)->delete();
        });
        if (is_null($status))
            return redirect()->to('manage/rolesList')->with(['message' => '操作成功']);
    }

    /**
     * 系统组详情页
     *
     * @param $id
     * @return mixed
     */
    public function getRolesDetail($id)
    {
        $tree_menu = Permission::getPermissionMenu();

        $info1 = Role::where('id',$id)->first();
        $info = Role::select('roles.name','permissions.id','permissions.display_name')->join('permission_role','roles.id','=','permission_role.role_id')
            ->join('permissions','permissions.id','=','permission_role.permission_id')->where('roles.id',$id)->get();
        $ids = array();
        foreach ($info as $v) {
            $ids[] .= $v['id'];
        }
        $data = array(
            'ids'=>$ids,
            'info1'=>$info1,
            'info'=>$info,
            'list'=>$tree_menu,
        );
        return $this->theme->scope('manage.rolesDetail',$data)->render();
    }

    /**
     * 更新系统组详情页
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRolesDetail(Request $request)
    {
        $status = DB::transaction(function () use ($request) {
            $rid = $request->get('rid');
            $data = array(
                'name' => $request->get('name'),
                'display_name'=>$request->get('display_name'),
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            );
            Role::where('id', $rid)->update($data);

            PermissionRoleModel::where('role_id', $rid)->delete();

            if($request->get('id')) {
                foreach ($request->get('id') as $id) {
                    $role_id = $rid;
                    $data2 = array(
                        'permission_id' => $id,
                        'role_id' => $role_id
                    );
                    PermissionRoleModel::insert($data2);
                }
            }
        });
        if (is_null($status))
            return redirect('manage/rolesList')->with(['message' => '操作成功']);
    }

    /**
     * 权限列表
     *
     * @return mixed
     */
    public function getPermissionsList(Request $request)
    {
        $merge = $request->all();
        $list = Permission::select('permissions.id','permissions.name','permissions.display_name','permissions.module_type','menu.name as menu_name')
            ->leftJoin('menu','menu.id','=','permissions.module_type');
        if ($request->get('id')){
            $list = $list->where('permissions.id', $request->get('id'));
        }
        if ($request->get('display_name')){
            $list = $list->where('permissions.display_name','like','%'. $request->get('display_name').'%');
        }
        if ($request->get('name')){
            $list = $list->where('permissions.name','like','%'.  $request->get('name').'%');
        }
        $order = $request->get('order') ? $request->get('order') : 'desc';
        if ($request->get('module_type')!=""){
            $list = $list->where('permissions.module_type', $request->get('module_type'));
        }
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;
        $list = $list->orderBy('permissions.id',$order)->paginate($paginate);
        $listArr = $list->toArray();
        $type = ModuleTypeModel::get();
        $data = array(
            'merge' => $merge,
            'listArr' => $listArr,
            'id'=>$request->get('id'),
            'display_name'=>$request->get('display_name'),
            'name'=>$request->get('name'),
            'module_type'=>$request->get('module_type'),
            'type'=>$type,
            'list'=>$list,
            'paginate' => $paginate,
        );
        $this->theme->setTitle('权限设置');
        return $this->theme->scope('manage.permissionsList',$data)->render();
    }

    /**
     * 添加权限视图
     *
     * @return mixed
     */
    public function getPermissionsAdd()
    {
        $modules = ModuleTypeModel::get();
        $data = array(
            'modules'=>$modules
        );
        return $this->theme->scope('manage.permissionsAdd',$data)->render();
    }

    /**
     * 添加权限
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postPermissionsAdd(Request $request)
    {
        $data = $request->except('_token');
        $status = DB::transaction(function() use($data){
            $re =  Permission::insertGetId($data);
            //创建权限和菜单之间的关系
            $permission_user = ['menu_id'=>$data['module_type'],'permission_id'=>$re];
            MenuPermissionModel::insert($permission_user);
        });

        if(is_null($status))
            return redirect('manage/permissionsList')->with(['message' => '操作成功']);
    }

    /**
     * 删除权限
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getPermissionsDel($id){
        $re = Permission::where('id',$id)->delete();
        if($re)
            return redirect()->to('manage/permissionsList')->with(['message' => '操作成功']);
    }

    /**
     * 权限详情页
     *
     * @param $id
     * @return mixed
     */
    public function getPermissionsDetail($id)
    {
        //获取上一项id
        $preId = Permission::where('id', '>', $id)->min('id');
        //获取下一项id
        $nextId = Permission::where('id', '<', $id)->max('id');
        $info = Permission::select('permissions.*','mp.menu_id')
            ->where('permissions.id',$id)
            ->join('menu_permission as mp','permissions.id','=','mp.permission_id')
            ->first();
        $modules = ModuleTypeModel::get();
        $data = array(
            'modules'=>$modules,
            'info'=>$info,
            'preId'=>$preId,
            'nextId'=>$nextId
        );
        return $this->theme->scope('manage.permissionsDetail',$data)->render();
    }

    /**
     * 更新权限
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postPermissionsDetail(Request $request)
    {
        $id = $request->get('id');
        $menu_id = $request->get('menu_id');
        $data = $request->except('id','_token','menu_id');
        $re = Permission::where('id',$id)->update($data);
        $permission = Permission::where('id',$id)->first();
        //删除原有的权限菜单关系
        $result1 = MenuPermissionModel::where('permission_id',$permission['id'])->delete();
        $result = MenuPermissionModel::firstOrCreate(['menu_id'=>$menu_id,'permission_id'=>$permission['id']]);
        if($re || $result)
            return redirect('manage/permissionsList')->with(['message' => '操作成功']);

    }
}
