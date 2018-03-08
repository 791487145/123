<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Modules\Manage\Model\MenuModel;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends ManageController
{
	
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');
        $this->theme->setTitle('用户管理');
        $this->theme->set('manageType', 'Menu');
    }

    
    public function getMenuList($id=0,$level=0)
    {
        
        $first_level_munus = MenuModel::where('pid',0)->get()->toArray();
        
        $all_menu = MenuModel::where('level','>=',$level)->get()->toArray();
        
        if($id!=0)
        {
            $root = MenuModel::where('id',$id)->first()->toArray();
            $root = $root['pid'];
        }else
        {
            $root = 0;
        }

        
        $tree_menu = \CommonClass::listToTree($all_menu,'id','pid','_child',$root);

        
        $keyby_tree_menu = \CommonClass::keyBy($tree_menu,'id');
        
        $menu_data = $keyby_tree_menu[$id];

        $view = [
            'menu_data'=>$menu_data,
            'first_level_munus'=>$first_level_munus,
            'id'=>$id,
            'level'=>$level,
        ];

        return $this->theme->scope('manage.menuList',$view)->render();
    }

    
    public function addMenu($id=0)
    {
        $view = [
            'id'=>$id,
        ];
        return $this->theme->scope('manage.addMenu',$view)->render();
    }

    
    public function menuCreate(Request $request)
    {
        $data = $request->except('_token');
        $data['created_at'] = date('Y-m-d H:i:s',time());
        
        if($data['pid']!=0)
        {
            $level = MenuModel::where('id',$data['pid'])->first();
            $data['level'] = $level['level']+1;
            $level = $level['level'];
        }else{
            $data['level'] = 1;
            $level = 1;
        }

        $result = MenuModel::create($data);

        if($data['pid']!=0)
        {
            $pid = $data['pid'];
        }else
        {
            $pid = $result['id'];
        }
        if(!$result)
            return redirect('manage/menuList')->with(['error'=>'菜单添加失败']);

        return redirect('manage/menuList/'.$pid.'/'.$level)->with(['message'=>'菜单添加成功']);
    }

    public function menuUpdate($id)
    {
        $menu = MenuModel::where('id',$id)->first();
        if(!$menu)
        {
            return redirect()->back()->with(['error'=>'参数错误']);
        }
        $view = [
            'menu'=>$menu,
        ];
        return $this->theme->scope('manage.menuUpdate',$view)->render();
    }

    public function UpdateMenu(Request $request)
    {
        $data = $request->except('_token');
        if(empty($data['id']))
        {
            return redirect()->back()->with(['error'=>'参数错误']);
        }

        $result = MenuModel::where('id',$data['id'])->update($data);

        if(!$result)
            return redirect()->back()->with(['error'=>'修改失败']);

        return redirect('manage/menuList/1/1')->with(['message'=>'修改成功！']);
    }
    
    public function menuDelete($id)
    {
        
        $child = MenuModel::where('pid',$id)->first();
        if($child)
        {
            return redirect()->back()->with(['error'=>'子菜单未删除不能删除父级菜单']);
        }
        if($id==1)
        {
            return redirect()->back()->with(['error'=>'首页菜单不能删除']);
        }

        $result = MenuModel::destroy($id);
        if(!$result)
            return redirect()->back()->with(['error'=>'删除失败']);

        return redirect()->to('manage/menuList/1/1')->with(['message'=>'删除成功']);
    }

}
