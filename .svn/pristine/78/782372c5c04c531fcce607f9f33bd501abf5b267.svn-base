<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Http\Controllers\BasicController;
use App\Modules\Manage\Model\NavModel;
use Illuminate\Http\Request;
use App\Modules\Manage\Http\Requests\NavRequest;
use Illuminate\Support\Facades\Auth;


class NavController extends ManageController
{
	public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');
        $this->theme->set('manageType', 'nav');
        $this->theme->setTitle('自定义导航');

    }

    
    public function navList(Request $request)
    {
        
        $navRes = NavModel::whereRaw('1 = 1');
        $by = $request->get('by') ? $request->get('by') : 'updated_at';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;
        $navRes = $navRes->orderBy($by, $order)->paginate($paginate);
        $data = array(
            'nav_list' => $navRes,
            'paginate' => $paginate
        );
        return $this->theme->scope('manage.navlist', $data)->render();
    }

    
    public function addNav()
    {
        return $this->theme->scope('manage.addnav')->render();
    }

    
    public function postAddNav(NavRequest $request)
    {
        $data = $request->all();
        $data['created_at'] = date('Y-m-d H:i:s',time());
        $data['updated_at'] = date('Y-m-d H:i:s',time());
        
        $res = NavModel::create($data);
        if($res)
        {
            return redirect('manage/navList')->with(array('message' => '操作成功'));
        }
    }

    
    public function editNav($id)
    {
        $id = intval($id);
        
        $navInfo = NavModel::where('id',$id)->get()->toArray();
        $data = array(
            'navInfo' => $navInfo
        );
        return $this->theme->scope('manage.editnav',$data)->render();
    }

    
    public function postEditNav(NavRequest $request)
    {
        $data = $request->all();
        $arr = array(
            'title' => $data['title'],
            'link_url' => $data['link_url'],
            'sort' => $data['sort'],
            'is_new_window' => $data['is_new_window'],
            'is_show' => $data['is_show'],
            'updated_at' => date('Y-m-d H:i:s',time())
        );
        
        $res = NavModel::where('id',$data['id'])->update($arr);
        if($res)
        {
            return redirect('manage/navList')->with(array('message' => '操作成功'));
        }
    }

    
    public function deleteNav($id)
    {
        $id = intval($id);
        $res = NavModel::where('id',$id)->delete();
        if(!$res)
        {
            return redirect()->to('/manage/navList')->with(array('message' => '操作失败'));
        }
        return redirect()->to('/manage/navList')->with(array('message' => '操作成功'));
    }

    
    public function isFirst($id)
    {
        $id = intval($id);
        
        $navFirst = NavModel::where('is_first',1)->get()->toArray();
        if(!empty($navFirst))
        {
            $arr = array('is_first' => 0);
            $res = NavModel::where('id',$navFirst[0]['id'])->update($arr);
            if($res)
            {
                $nav = NavModel::where('id',$id)->update(array('is_first' => 1));
                if($nav)
                {
                    return redirect('/manage/navList')->with(array('message' => '操作成功'));
                }
                else
                {
                    return redirect('/manage/navList')->with(array('message' => '操作失败'));
                }
            }
            else
            {
                return redirect('/manage/navList')->with(array('message' => '操作失败'));
            }
        }
        else
        {
            $nav = NavModel::where('id',$id)->update(array('is_first' => 1));
            if($nav)
            {
                return redirect('/manage/navList')->with(array('message' => '操作成功'));
            }
            else
            {
                return redirect('/manage/navList')->with(array('message' => '操作失败'));
            }
        }
    }













}
