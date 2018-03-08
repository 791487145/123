<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Http\Controllers\BasicController;
use App\Modules\User\Model\DistrictModel;
use App\Modules\Task\Model\DistrictRegionModel;
use Illuminate\Http\Request;

class AreaController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('地区管理');
        $this->theme->set('manageType', 'area');
    }
    
	public function areaList(Request $request)
    {
        $province_data = DistrictModel::findTree(0);

        $data = [
            'province_data'=>$province_data,
        ];

        return $this->theme->scope('manage.arealist', $data)->render();
    }

    
    public function areaDelete($id)
    {
        $id = intval($id);
        $result = DistrictModel::destroy($id);
        if(!$result)
        {
            return response()->json(['errCode'=>0,'errMsg'=>'删除失败！']);
        }
        
        DistrictModel::refreshAreaCache();
        return response()->json(['errCode'=>1,'id'=>$id]);
    }

    
    public function areaCreate(Request $request)
    {
        $data = $request->except('_token');
        
        if(!empty($data['province']) && empty($data['city']))
        {
            $upid = $data['province'];
        }elseif(!empty($data['city']))
        {
            $upid = $data['city'];
        }else
        {
            $upid = 0;
        }
        
        if(count($data['change_ids'])>0)
        {
            foreach($data['name'] as $k=>$v)
            {
                $change_ids = explode(' ',$data['change_ids']);
                if(in_array($k,$change_ids)){
                    $result = DistrictModel::where('upid',$upid)->where('id',$k)->update(['name'=>$v,'displayorder'=>$data['displayorder'][$k]]);
                    if(!$result)
                    {
                        DistrictModel::firstOrCreate(['name'=>$v,'upid'=>$upid,'displayorder'=>$data['displayorder'][$k]]);
                    }
                }
            }
            
            DistrictModel::refreshAreaCache();
        }

        return redirect()->back()->with(['massage'=>'修改成功！']);
    }

    
    public function ajaxCity(Request $request)
    {
        $id = intval($request->get('id'));
        if(is_null($id)){
            return response()->json(['errMsg'=>'参数错误！']);
        }
        $province = DistrictModel::findTree($id);

        $data = [
            'province'=>$province,
            'id'=>$id
        ];
        return response()->json($data);
    }

    
    public function ajaxArea(Request $request)
    {
        $id = intval($request->get('id'));
        if(is_null($id)){
            return response()->json(['errMsg'=>'参数错误！']);
        }
        $area = DistrictModel::findTree($id);
        return response()->json($area);
    }

    public function ajaxRegionProvince(Request $request)
    {
        $id = intval($request->get('id'));
        if(is_null($id)){
            return response()->json(['errMsg'=>'参数错误！']);
        }

        $region = DistrictRegionModel::findTree($id);

        $data = [
            'region' => $region,
            'id' => $id
        ];

        return response()->json($data);
    }

    public function ajaxProvinceSchool(Request $request)
    {
        $id = intval($request->get('id'));
        if(is_null($id)){
            return response()->json(['errMsg'=>'参数错误！']);
        }
        $school = DistrictRegionModel::findTree($id);
        return response()->json($school);
    }
}
