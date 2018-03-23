<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class MenuModel extends Model
{
    protected $table = 'menu';

    protected $fillable = [
        'name', 'pid', 'route','level','note', 'created_at', 'updated_at','sort'
    ];

    public  $timestamps = false;  


    static public function getMenuPermission()
    {
        $manager = \App\Modules\Manage\Model\ManagerModel::getManager();
        $uid = $manager->id;

        if($uid==1)
        {
            $menu = self::orderBy('sort')->get()->toArray();
            $manageMenu = \CommonClass::listToTree($menu);
        }else{
            $role_id = \App\Modules\Manage\Model\RoleUserModel::where('user_id',$uid)->first();
            $permission = \App\Modules\Manage\Model\PermissionRoleModel::where('role_id',$role_id['role_id'])->lists('permission_id')->toArray();
            $menu_ids = \App\Modules\Manage\Model\MenuPermissionModel::whereIn('permission_id',$permission)->lists('menu_id')->toArray();
            $menu_ids = array_unique($menu_ids);
            $manageMenuAll = self::all()->toArray();
            $third_menu = self::whereIn('id',$menu_ids)->where('level',3)->lists('id')->toArray();
            $second_menu = self::whereIn('id',$menu_ids)->where('level',2)->lists('id')->toArray();
            $first_menu = self::whereIn('id',$menu_ids)->where('level',1)->lists('id')->toArray();

            foreach($manageMenuAll as $k=>$v)
            {
                if($v['level']==3 && !in_array($v['id'],$third_menu))
                {
                    $manageMenuAll = array_except($manageMenuAll,[$k]);
                }
            }

            $manageMenuAllTree = \CommonClass::listToTree($manageMenuAll);

            foreach($manageMenuAllTree as $key=>$value)
            {
                if(!empty($value['_child'])) {
                    foreach ($value['_child'] as $menukey => $menu) {
                        if (empty($menu['_child']) && !in_array($menu['id'], $second_menu)) {
                            $manageMenuAllTree[$key]['_child'] = array_except($manageMenuAllTree[$key]['_child'], [$menukey]);
                        }
                    }
                }elseif(empty($value['_child']) && !in_array($value['id'],$first_menu))
                {
                    $manageMenuAllTree = array_except($manageMenuAllTree,[$key]);
                }
            }

            foreach($manageMenuAllTree as $m=>$n)
            {
                if(empty($n['_child']) && !in_array($n['id'],$first_menu))
                {
                    $manageMenuAllTree = array_except($manageMenuAllTree,[$m]);
                }
            }
            $manageMenu = $manageMenuAllTree;
        }

        return $manageMenu;
    }

    static public function getManageMenu ()
    {
        $menu = \App\Modules\Manage\Model\MenuModel::orderBy('sort')->get()->toArray();
        $tree_menu = \CommonClass::listToTree($menu);
        return $tree_menu;
    }

    
    static public function getMenu($id)
    {
        $menu = self::where('id',$id)->first();
        if($menu['level']==2)
        {
            $menu_secound = self::where('id',$menu['pid'])->first()->toArray();
            $menu_data = [$menu,$menu_secound];
            $menu_ids = [$menu['id'],$menu_secound['id']];
        }elseif($menu['level']==3)
        {
            $menu_secound = self::where('id',$menu['pid'])->first()->toArray();
            $menu_third = self::where('id',$menu_secound['pid'])->first()->toArray();
            $menu_data = [$menu,$menu_secound,$menu_third];
            $menu_ids = [$menu['id'],$menu_secound['id'],$menu_third['id']];
        }else
        {
            $menu_data = \CommonClass::listToTree($menu);
            $menu_ids = [$menu['id']];
        }
        $menu_data = \CommonClass::listToTree($menu_data);
        $data = [
            'menu_data'=>$menu_data,
            'menu_ids'=>$menu_ids
        ];
        return $data;
    }
}
