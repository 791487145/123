<?php

namespace App\Modules\Manage\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    
    protected $table = 'permissions';

    protected $fillable = [
        'name', 'display_name', 'description','module_types','created_at', 'updated_at', 'pid','sort','level','route'
    ];
    public  $timestamps = false;  

    static public function getPermissionMenu()
    {
        
        $menu_all = MenuModel::all()->toArray();
        foreach($menu_all as $k=>$v)
        {
            $menu_all[$k]['fid'] = $v['id'];
        }
        
        $permission_all = self::all()->toArray();
        
        $menu_permission = MenuPermissionModel::all()->toArray();
        $menu_permission = \CommonClass::keyBy($menu_permission,'permission_id');
        
        foreach($permission_all as $k=>$v)
        {
            $permission_all[$k]['pid'] = $menu_permission[$v['id']]['menu_id'];
            $permission_all[$k]['fid'] = 0;
            $permission_all[$k]['name'] = $v['display_name'];
        }
        
        $permission_menu = array_merge($menu_all,$permission_all);
        $permission_menu_tree = \CommonClass::listToTree($permission_menu,'fid','pid');
        return $permission_menu_tree;
    }
}
