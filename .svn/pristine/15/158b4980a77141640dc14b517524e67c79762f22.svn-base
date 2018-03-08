<?php

namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Manage\Http\Requests\PackageRequest;
use App\Modules\Manage\Http\Requests\PrivilegesRequest;
use App\Modules\Manage\Http\Requests\VipAuthRequest;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Vipshop\Models\InterviewModel;
use App\Modules\Vipshop\Models\PackageModel;
use App\Modules\Vipshop\Models\PrivilegesModel;
use App\Modules\Vipshop\Models\ShopPackageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cache;
use Validator;

class VipShopController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('VIP店铺管理');
        $this->theme->set('manageType', 'auth');
    }

    
    public function vipConfigUpdate(Request $request){
        $data = $request->except('_token');
        $config = ConfigModel::getVipConfigByType('vip');

        $file1 = $request->file('logo1');
        if ($file1) {
            
            $result1 = \FileClass::uploadFile($file1, 'sys');
            $result1 = json_decode($result1, true);
            $data['logo1'] = $result1['data']['url'];
        }else{
            $data['logo1'] = $config['logo1'];
        }
        $file2 = $request->file('logo2');
        if ($file2) {
            
            $result2 = \FileClass::uploadFile($file2, 'sys');
            $result2 = json_decode($result2, true);
            $data['logo2'] = $result2['data']['url'];
        }else{
            $data['logo2'] = $config['logo2'];
        }
        $vipConfig = array(
            'hot_line' => $data['hot_line'],
            'logo1' => $data['logo1'],
            'logo2' => $data['logo2']
        );
        $vipConfig = json_encode($vipConfig);
        ConfigModel::where('type','vip')->update(['rule' => $vipConfig]);
        Cache::forget('vip');
        return redirect('/manage/vipConfig')->with(array('message' => '保存成功'));
    }

    
    public function vipShopConfig()
    {
        $vipConfig = ConfigModel::getVipConfigByType('vip');
        $data = [
            'vipConfig' => $vipConfig
        ];
        return $this->theme->scope('manage.vipConfig',$data)->render();
    }

    
    public function vipPackageList()
    {
        $packageList = PackageModel::packageList();
        $data = [
            'package' => $packageList
        ];
        return $this->theme->scope('manage.vipPackageList',$data)->render();
    }
    
    public function addPackagePage()
    {
        $privileges = PackageModel::privileges();
        $data = [
            'privileges' => $privileges
        ];
        return $this->theme->scope('manage.addPackage',$data)->render();
    }
    
    public function vipInfoList(Request $request)
    {
        $data = $request->all();
        $privilegesList = PrivilegesModel::privilegesList($data);
        $privileges = [
            'privileges' => $privilegesList,
            'merge' => $data
        ];
        return $this->theme->scope('manage.vipInfoList',$privileges)->render();
    }

    
    public function addPrivileges(PrivilegesRequest $request)
    {
        $data = $request->except('_token');
        $file = $request->file('ico');
        if(empty($file)){
            return back()->with(['error'=>'请上传图片']);
        }
        
        $result = \FileClass::uploadFile($file,'sys');
        $result = json_decode($result,true);
        $privileges = [
            'title' => $data['title'],
            'desc' => $data['desc'],
            'list' => $data['list'],
            'ico' => $result['data']['url'],
            'status' => $request->get('status'),
            'is_recommend' => $request->get('is_recommend')
        ];
        $status = PrivilegesModel::addPrivileges($privileges);
        if($status){
            return redirect('/manage/vipInfoList')->with(['message' => '操作成功']);
        }
        return back()->with(['error' => '操作失败']);
    }

    
    public function privilegesDelete($id){
        $status = PrivilegesModel::deletePrivileges($id);
        switch($status){
            case '0':
                return back()->with(['error' => '删除失败']);
                break;
            case '1':
                return  back()->with(['message' => '删除成功']);
                break;
            case '2':
                return back()->with(['error' => '传送参数错误']);
                break;
        }
    }

    
    public function updateStatus($id){
        $status = PrivilegesModel::updateStatus($id);
        switch($status){
            case '0':
                return back()->with(['error' => '修改失败']);
                break;
            case '1':
                return  back()->with(['message' => '修改成功']);
                break;
            case '2':
                return back()->with(['error' => '传送参数错误']);
                break;
        }
    }


    
    public function updateRecommend($id){
        $status = PrivilegesModel::updateRecommend($id);
        switch($status){
            case '0':
                return back()->with(['error' => '修改失败']);
                break;
            case '1':
                return  back()->with(['message' => '修改成功']);
                break;
            case '2':
                return back()->with(['error' => '传送参数错误']);
                break;
            case '3':
                return back()->with(['error' => '推荐特权不能超过6个']);
                break;
        }
    }

    
    public function addPrivilegesPage(){
        return $this->theme->scope('manage.vipInfoAdd')->render();
    }


    
    public function editPrivilegesPage($id){
        $privilegesInfo = PrivilegesModel::privilegesDetail($id);
        if($privilegesInfo == false){
            return back()->with(['error' => '传送参数错误']);
        }
        $data = [
            'privilegesInfo' => $privilegesInfo
        ];
        return $this->theme->scope('manage.editPrivileges',$data)->render();
    }


    
    public function updatePrivileges(PrivilegesRequest $request,$id){
        $data = $request->except('_token');
        $file = $request->file('ico');

        $privileges = [
            'title' => $data['title'],
            'desc' => $data['desc'],
            'list' => $data['list'],
            'status' => $request->get('status'),
            'is_recommend' => $request->get('is_recommend')
        ];
        if(!empty($file)){
            
            $result = \FileClass::uploadFile($file,'sys');
            $result = json_decode($result,true);
            $privileges['ico'] = $result['data']['url'];
        }
        $status = PrivilegesModel::updatePrivileges($id,$privileges);
        if($status){
            return redirect('/manage/vipInfoList')->with(['message' => '修改成功']);
        }
        return back()->with(['error' => '修改失败']);
    }

    
    public function vipShopList(Request $request)
    {
        $data = $request->all();
        $packageInfo = ShopPackageModel::packageInfo();
        $shopPackageList = ShopPackageModel::shopPackageList($data);
        $shopPackage = [
            'package' => $packageInfo,
            'shopPackageList' => $shopPackageList,
            'merge' => $data
        ];
        return $this->theme->scope('manage.vipShopList',$shopPackage)->render();
    }
    
    public function vipShopAuth($id)
    {
        $vipShopInfo = ShopPackageModel::shopPackageInfo($id);
        if($vipShopInfo == false){
            return back()->with(['error'=>'传送参数错误']);
        }
        $data = [
            'vipShopInfo' => $vipShopInfo
        ];
        return $this->theme->scope('manage.vipShopAuth',$data)->render();
    }

    
    public function endTimeUpdate(Request $request){
        $end_time = date('Y-m-d H:i:s',strtotime($request->get('end_time')));
        $status = ShopPackageModel::updateEndTime($request->get('id'),$end_time);
        switch($status){
            case '0':
                return back()->with(['error' => '修改失败']);
                break;
            case '1':
                return back()->with(['message' => '修改成功']);
                break;
            case '2':
                return back()->with(['error' => '传送参数错误']);
                break;
            case '3':
                return back()->with(['error' => '到期时间只能延长不能缩短']);
                break;
        }
    }

    
    public function vipDetailsList(Request $request)
    {
        $data = $request->all();
        $interviewList = InterviewModel::interviewList($data);
        $interview = [
            'interview' => $interviewList,
            'merge' => $data
        ];
        return $this->theme->scope('manage.vipDetailsList',$interview)->render();
    }
    
    public function vipDetailsAuth()
    {
        $shopInfo = InterviewModel::interviewShop();
        $data = [
            'shopInfo' => $shopInfo
        ];
        return $this->theme->scope('manage.vipDetailsAuth',$data)->render();
    }

    
    public function updatePackageStatus($id){
        $status = PackageModel::updateStatus($id);
        switch($status){
            case '0':
                return back()->with(['message'=>'操作失败']);
                break;
            case '1':
                return back()->with(['message'=>'操作成功']);
                break;
            case '2':
                return back()->with(['message'=>'传送参数错误']);
                break;
            case '3':
                return back()->with(['message'=>'上架套餐不能不能超过5个']);
                break;
        }
    }

    
    public function packageDelete($id){
        $status = PackageModel::deletePackage($id);
        switch($status){
            case '0':
                return back()->with(['message'=>'删除失败']);
                break;
            case '1':
                return back()->with(['message'=>'删除成功']);
                break;
            case '2':
                return back()->with(['message'=>'传送参数错误']);
                break;
        }
    }

    
    public function addPackage(PackageRequest $request){
        $data = $request->except('_token');
        $file = $request->file('logo');
        if(empty($file)){
            return back()->with(['error'=>'请上传图片']);
        }
        
        $result = \FileClass::uploadFile($file,'sys');
        $result = json_decode($result,true);
        if(empty($request->get('privileges'))){
            return back()->with(['error' => '请选择套餐内容']);
        }
        if(empty($request->get('price_rules'))){
            return back()->with(['error' => '请设定套餐的时长金额']);
        }
        $privileges = [
            'title' => $data['title'],
            'price_rules' => $data['price_rules'],
            'list' => $data['list'],
            'logo' => $result['data']['url'],
            'status' => $request->get('status'),
            'privileges' => $data['privileges']
        ];
        $status = PackageModel::addPackage($privileges);
        if($status){
            return redirect('/manage/vipPackageList')->with(['message' => '操作成功']);
        }
        return back()->with(['error' => '操作失败']);

    }

    
    public function editPackagePage($id){
        $packageInfo = PackageModel::packageInfo($id);
        if($packageInfo == false){
            return back()->with(['error' => '传送参数错误']);
        }
        $privileges = PackageModel::privileges();
        $data = [
            'packageInfo' => $packageInfo,
            'privileges' => $privileges
        ];
        return $this->theme->scope('manage.editPackage',$data)->render();
    }

    
    public function editPackage(PackageRequest $request,$id){
        $data = $request->except('_token');
        if(empty($request->get('privileges'))){
            return back()->with(['error' => '请选择套餐内容']);
        }
        if(empty($request->get('price_rules'))){
            return back()->with(['error' => '请设定套餐的时长金额']);
        }
        $file = $request->file('logo');
        $privileges = [
            'title' => $data['title'],
            'price_rules' => $data['price_rules'],
            'list' => $data['list'],
            'status' => $request->get('status'),
            'privileges' => $data['privileges']
        ];
        if(!empty($file)){
            
            $result = \FileClass::uploadFile($file,'sys');
            $result = json_decode($result,true);
            $privileges['logo'] = $result['data']['url'];
        }


        $status = PackageModel::updatePackage($id,$privileges);
        if($status){
            return redirect('/manage/vipPackageList')->with(['message' => '操作成功']);
        }
        return back()->with(['error' => '操作失败']);
    }

    
    public function interviewDelete($id){
        $status = InterviewModel::deleteInterview($id);
        switch($status){
            case '0':
                return back()->with(['message'=>'删除失败']);
                break;
            case '1':
                return back()->with(['message'=>'删除成功']);
                break;
            case '1':
                return back()->with(['message'=>'传送参数错误']);
                break;
        }
    }

    
    public function addInterview(VipAuthRequest $request){
        $data = $request->except('_token');
        $shopUser = InterviewModel::shopInfo($data['shop_id']);
        if($shopUser == false){
            return  back()->with(['error'=>'传输参数错误']);
        }
        $data['shop_name'] = $shopUser['shop_name'];
        $data['shop_cover'] = $shopUser['shop_cover'];
        $data['uid'] = $shopUser['uid'];
        $data['username'] = $shopUser['username'];
        $res = InterviewModel::addInterview($data);
        if($res){
            return redirect('/manage/vipDetailsList')->with(['message'=>'创建成功！']);
        }
        return back()->with(['error'=>'创建失败！']);
    }


    
    public function editInterviewPage($id){
        $shopInfo = InterviewModel::interviewShop();
        $interviewInfo = InterviewModel::interviewDetail($id);
        if($interviewInfo == false){
            return back()->with(['error'=>'传送参数错误']);
        }
        $data = [
            'shopInfo' => $shopInfo,
            'interview' => $interviewInfo,
            'id' => $id
        ];
        return $this->theme->scope('manage.editInterview',$data)->render();
    }


    
    public function editInterview(VipAuthRequest $request,$id){
        $data = $request->except('_token');
        $shopUser = InterviewModel::shopInfo($data['shop_id']);
        if($shopUser == false){
            return  back()->with(['error'=>'传输参数错误']);
        }
        $data['shop_name'] = $shopUser['shop_name'];
        $data['shop_cover'] = $shopUser['shop_cover'];
        $data['uid'] = $shopUser['uid'];
        $data['username'] = $shopUser['username'];
        $res = InterviewModel::updateInterview($id,$data);
        if($res){
            return redirect('/manage/vipDetailsList')->with(['message'=>'修改成功！']);
        }
        return back()->with(['error'=>'修改失败！']);

    }

}