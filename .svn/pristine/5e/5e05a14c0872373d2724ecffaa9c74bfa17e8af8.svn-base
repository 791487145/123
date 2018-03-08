<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Task\Model\TaskCateModel;
use Illuminate\Http\Request;

class Industryontroller extends ManageController
{
    
    public function industryList(Request $request)
    {
        $query = TaskCateModel::where('id','!=',0);
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;
        
        if($request->get('search'))
        {
            $query->where('name','like','%'.e($request->get('search')).'%');
        }
        
        if($request->get('pid'))
        {
            $query->where('pid',$request->get('pid'));
        }else{
            $query->where('pid',0);
        }
        $data = $query->paginate($paginate);

        return $this->theme->scope('manage.area', $data)->render();
    }

    
    public function industryDelete($id)
    {
        $result = TaskCateModel::destroy($id);
        if(!$result)
        {
            return redirect()->to('/manage/industry')->with('error','删除失败！');
        }
        return redirect()->to('/manage/industry')->with('massage','删除成功！');
    }

    
    public function industryUpdate(Request $request)
    {

    }




}
