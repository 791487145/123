<?php
namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\UserCenterController;
use App\Modules\Shop\Models\ShopFocusModel;
use App\Modules\Task\Model\SuccessCaseModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\EnterpriseAuthModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\Shop\Models\ShopTagsModel;
use App\Modules\User\Model\RealnameAuthModel;
use App\Modules\User\Model\TagsModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\Vipshop\Models\PackageModel;
use App\Modules\Vipshop\Models\PrivilegesModel;
use App\Modules\Vipshop\Models\ShopPackageModel;
use Illuminate\Http\Request;
use Auth;
use Crypt;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class ShopController extends UserCenterController
{

    public function __construct()
    {
        parent::__construct();
        $this->initTheme('accepttask');
    }

    
    public function getShop(Request $request)
    {
        $uid = Auth::User()->id;
        
        $realName = RealnameAuthModel::where('uid',$uid)->where('status',1)->first();
        if(empty($realName)){
            return $this->theme->scope('user.usershopbefore')->render();
        }
        
        $companyAuth = EnterpriseAuthModel::isEnterpriseAuth($uid);
        
        $hotTag = TagsModel::findAll();
        
        $province = DistrictModel::findTree(0);
        
        $shopInfo = ShopModel::getShopInfoByUid($uid);
        if(!empty($shopInfo)){
            
            $tag = ShopTagsModel::shopTag($shopInfo['id']);
            $tags = array_flatten($tag);
            
            $city = DistrictModel::findTree($shopInfo['province']);
            $data = array(
                'shop_info'       => $shopInfo,
                'is_company_auth' => $companyAuth,
                'all_tag'         => $hotTag,
                'tags'            => $tags,
                'province'        => $province,
                'city'            => $city
            );
        }else{
            
            $city = DistrictModel::findTree($province[0]['id']);
            $data = array(
                'is_company_auth' => $companyAuth,
                'all_tag'         => $hotTag,
                'province'        => $province,
                'city'            => $city
            );
        }
        $this->theme->setTitle('店铺设置');
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.usershop',$data)->render();

    }


    
    public function postShopInfo(Request $request)
    {
        $data = $request->except('_token','shop_pic');
        $uid = Auth::User()->id;
        $data['uid'] = $uid;
        $data['shop_desc'] = trim($data['shop_desc']);
        if($request->get('id') && $request->get('id') != ''){
           
           $shop = ShopModel::where('id',$data['id'])->first();
           $file = $request->file('shop_pic');
           if ($file) {
               $result = \FileClass::uploadFile($file, 'user');
               $result = json_decode($result, true);
               $data['shop_pic'] = $result['data']['url'];
           }else{
               $data['shop_pic'] = $shop->shop_pic;
           }
            $res = ShopModel::updateShopInfo($data);
        }else{
           
           $file = $request->file('shop_pic');
           if ($file) {
               $result = \FileClass::uploadFile($file, 'user');
               $result = json_decode($result, true);
               $data['shop_pic'] = $result['data']['url'];
           }else{
               $data['shop_pic'] = '';
           }
            $res = ShopModel::createShopInfo($data);
            UserDetailModel::where('uid',$uid)->update(['shop_status' => 1]);
        }
        if($res){
            return redirect('/user/shop')->with(array('message' => '保存成功'));
        }else{
            return redirect('/user/shop')->with(array('message' => '保存失败'));
        }


    }


    
    public function ajaxGetCity(Request $request)
    {
        $id = intval($request->get('id'));
        if (!$id) {
            return response()->json(['errMsg' => '参数错误！']);
        }
        $province = DistrictModel::findTree($id);
        if($province){
            $area = DistrictModel::findTree($province[0]['id']);
        }else{
            $area = array();
        }
        $data = [
            'province' => $province,
            'area' => $area
        ];
        return response()->json($data);
    }

    
    public function ajaxGetArea(Request $request)
    {
        $id = intval($request->get('id'));
        if (!$id) {
            return response()->json(['errMsg' => '参数错误！']);
        }
        $area = DistrictModel::findTree($id);
        $data = [
            'area' => $area,
        ];
        return response()->json($data);
    }

    
    public function fileUpload(Request $request)
    {
        $file = $request->file('file');
        
        $attachment = \FileClass::uploadFile($file, 'user');
        $attachment = json_decode($attachment, true);
        
        if($attachment['code']!=200)
        {
            return response()->json(['errCode' => 0, 'errMsg' => $attachment['message']]);
        }
        $attachment_data = array_add($attachment['data'], 'status', 1);
        $attachment_data['created_at'] = date('Y-m-d H:i:s', time());
        
        $result = AttachmentModel::create($attachment_data);
        $result = json_decode($result, true);
        if (!$result) {
            return response()->json(['errCode' => 0, 'errMsg' => '文件上传失败！']);
        }
        
        return response()->json(['id' => $result['id']]);
    }

    
    public function fileDelete(Request $request)
    {
        $id = $request->get('id');
        
        $file = AttachmentModel::where('id',$id)->first()->toArray();
        if(!$file)
        {
            return response()->json(['errCode' => 0, 'errMsg' => '附件没有上传成功！']);
        }
        
        unlink($file['url']);
        $result = AttachmentModel::destroy($id);
        if (!$result) {
            return response()->json(['errCode' => 0, 'errMsg' => '删除失败！']);
        }
        return response()->json(['errCode' => 1, 'errMsg' => '删除成功！']);
    }

    
    public function getEnterpriseAuth()
    {
        $user = Auth::User();
        $companyInfo = EnterpriseAuthModel::where('uid', $user->id)->orderBy('created_at', 'desc')->first();

        
        $cateFirst = TaskCateModel::findByPid([0],['id','name']);
        if(!empty($cateFirst)){
            
            $cateSecond = TaskCateModel::findByPid([$cateFirst[0]['id']],['id','name']);
        }else{
            $cateSecond = array();
        }
        
        $province = DistrictModel::findTree(0);
        if(!empty($province)){
            
            $city = DistrictModel::findTree($province[0]['id']);
            if(!empty($city)){
                
                $area = DistrictModel::findTree($city[0]['id']);
            }else{
                $area = array();
            }
        }else{
            $city = array();
            $area = array();
        }
        $view = '';
        if (isset($companyInfo->status)) {
            $cateInfo = TaskCateModel::findById($companyInfo->cate_id);
            if($cateInfo){
                $cateName = $cateInfo['name'];
            }else{
                $cateName = '';
            }
            $data = array(
                'company_info' => $companyInfo,
                'cate_name' => $cateName,
            );
            switch ($companyInfo->status) {
                case 0:
                    $view = 'user.waitusershopauth';
                    break;
                case 1:
                    return redirect('/user/shop');
                    break;
                case 2:
                    $view = 'user.usershopauthfail';
                    break;
            }
        } else {
            $data = array(
                'cate_first'  => $cateFirst,
                'cate_second' => $cateSecond,
                'province'    => $province,
                'city'        => $city,
                'area'        => $area
            );
            $view = 'user.usershopqy';
        }
        $this->theme->setTitle('企业认证');
        $this->theme->set('TYPE',3);
        return $this->theme->scope($view, $data)->render();
    }

    
    public function postEnterpriseAuth(Request $request)
    {
        $data = $request->except('_token');
        $uid = Auth::id();
        $companyInfo = array(
            'uid'              => $uid,
            'company_name'     => $data['company_name'] ? $data['company_name'] : '',
            'cate_id'          => $data['cate_second'] ? $data['cate_second'] : '' ,
            'employee_num'     => $data['employee_num'] ? $data['employee_num'] : '',
            'business_license' => $data['business_license'] ? $data['business_license'] : '',
            'begin_at'         => $data['start'] ? date('Y-m-d H:i:s',strtotime($data['start'])) : '',
            'website'          => $data['website'] ? $data['website'] : '',
            'province'         => $data['province'] ? $data['province'] : '',
            'city'             => $data['city'] ? $data['city'] : '',
            'area'             => $data['area'] ? $data['area'] : '',
            'address'          => $data['address'] ? $data['address'] : '',
            'status'           => 0,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        );
        $authRecordInfo = array(
            'uid'       => $uid,
            'auth_code' => 'enterprise',
            'status'    => 0
        );
        $fileId = !empty($data['file_id']) ? $data['file_id'] : '';
        EnterpriseAuthModel::createEnterpriseAuth($companyInfo,$authRecordInfo,$fileId);
        return redirect('/user/enterpriseAuth');
    }

    
    public function ajaxGetSecondCate(Request $request)
    {
        $id = intval($request->get('id'));
        if (!$id) {
            return response()->json(['errMsg' => '参数错误！']);
        }
        $cate = TaskCateModel::findByPid([$id]);
        $data = [
            'cate' => $cate
        ];
        return response()->json($data);
    }

    
    public function enterpriseAuthAgain()
    {
        $uid = Auth::user()->id;
        $status = EnterpriseAuthModel::getEnterpriseAuthStatus($uid);
        if($status == 2){
            $res = EnterpriseAuthModel::removeEnterpriseAuth();
            if($res){
                return redirect('/user/enterpriseAuth');
            }
        }
    }


    
    public function shopSuccessCase(Request $request)
    {
        $uid = Auth::id();
        
        $isOpenShop = ShopModel::isOpenShop($uid);
        
        $shopId = ShopModel::getShopIdByUid($uid);
        $merge = $request->all();
        $uid = Auth::id();
        $successCase = SuccessCaseModel::getSuccessCaseListByUid($uid,$merge);
        $data = array(
            'success_list' => $successCase,
            'merge' => $merge,
            'is_open_shop' => $isOpenShop,
            'shop_id' => $shopId
        );
        $this->theme->setTitle('案例列表');
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.usershopalgl',$data)->render();
    }

    
    public function addShopSuccess()
    {
        $uid = Auth::id();
        
        $shopId = ShopModel::getShopIdByUid($uid);
        
        $isOpenShop = ShopModel::isOpenShop($uid);
        
        $cateFirst = TaskCateModel::findByPid([0],['id','name']);
        if(!empty($cateFirst)){
            
            $cateSecond = TaskCateModel::findByPid([$cateFirst[0]['id']],['id','name']);
        }else{
            $cateSecond = array();
        }
        $data = array(
            'cate_first'  => $cateFirst,
            'cate_second' => $cateSecond,
            'is_open_shop' => $isOpenShop,
            'shop_id' => $shopId
        );
        $this->theme->setTitle('添加案例');
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.usershopal',$data)->render();
    }

    
    public function postAddShopSuccess(Request $request)
    {
        $user = Auth::User();
        $file = $request->file('success_pic');
        if (!$file) {
            return redirect()->back()->with('error', '作品封面不能为空');
        }else{
            $result = \FileClass::uploadFile($file, 'sys');
            $result = json_decode($result, true);
            
            if($result['code']!=200)
            {
                return redirect()->back()->with('error', $result['message']);
            }else{
                $pic = $result['data']['url'];
            }
        }
        if (!$request->cate_id) {
            return redirect()->back()->with('error', '作品分类不能为空');
        }

        $data = array(
            'pic'        => $pic,
            'uid'        => $user->id,
            'username'   => $user->name,
            'title'      => $request->title,
            'desc'       => \CommonClass::removeXss($request->description),
            'type'       => 1, 
            'url'        => $request->url,
            'cate_id'    => $request->cate_id,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $res = SuccessCaseModel::insert($data);
        if (!$res){
            return redirect()->back()->with('error', '成功案例添加失败！');
        }else{
            return redirect('/user/myShopSuccessCase')->with('massage', '成功案例添加成功！');
        }

    }

    
    public function editShopSuccess($id)
    {
        $id = intval($id);
        $uid = Auth::id();
        
        $successInfo = SuccessCaseModel::getSuccessInfoById($id);
        
        $cateFirst = TaskCateModel::findByPid([0],['id','name']);
        if(!empty($successInfo->cate_pid)){
            
            $cateSecond = TaskCateModel::findByPid([$successInfo->cate_pid],['id','name']);
        }else{
            $cateSecond = TaskCateModel::findByPid([$cateFirst[0]['id']],['id','name']);
        }
        if($successInfo->uid == $uid){
            $data = array(
                'success_info' => $successInfo,
                'cate_first'   => $cateFirst,
                'cate_second'  => $cateSecond
            );
            $this->theme->setTitle('编辑案例');
            $this->theme->set('TYPE',3);
            return $this->theme->scope('user.usershopaledit',$data)->render();
        }else{
            return redirect()->back()->with('error', '案例错误！');
        }
    }

    
    public function postEditShopSuccess(Request $request)
    {
        $data = $request->except('_token');
        $successInfo = SuccessCaseModel::getSuccessInfoById($data['id']);
        $file = $request->file('success_pic');
        if (!$file) {
            $pic = $successInfo->pic;
        }else{
            $result = \FileClass::uploadFile($file, 'sys');
            $result = json_decode($result, true);
            
            if($result['code']!=200)
            {
                return redirect()->back()->with('error', $result['message']);
            }else{
                $pic = $result['data']['url'];
            }
        }
        if (!$request->cate_id) {
            return redirect()->back()->with('error', '作品分类不能为空');
        }

        $arr = array(
            'pic'        => $pic,
            'title'      => $request->title,
            'desc'       => \CommonClass::removeXss($request->description),
            'url'        => $request->url,
            'cate_id'    => $request->cate_id,
        );
        $res = SuccessCaseModel::where('id',$data['id'])->update($arr);
        if (!$res){
            return redirect()->back()->with('error', '成功案例编辑失败！');
        }else{
            return redirect('/user/myShopSuccessCase')->with('massage', '成功案例编辑成功！');
        }
    }

    
    public function deleteShopSuccess(Request $request)
    {
        $id = $request->get('id');
        $uid = Auth::id();
        
        $successInfo = SuccessCaseModel::getSuccessInfoById($id);
        if($successInfo->uid == $uid){
            $res = SuccessCaseModel::where('id',$id)->delete();
            if($res){
                $data = array(
                    'code' => 1,
                    'msg' => '删除成功'
                );
            }else{
                $data = array(
                    'code' => 0,
                    'msg' => '删除失败'
                );
            }
        }else{
            $data = array(
                'code' => 0,
                'msg' => '参数错误'
            );
        }
        return  response()->json($data);
    }

    
    public function myCollectShop(Request $request)
    {
        $uid = Auth::id();
        $merge = $request->all();
        $collectArr = ShopFocusModel::where('uid',$uid)->orderby('created_at','DESC')->get()->toArray();
        $shopList = array();
        if(!empty($collectArr))
        {
            $shopIds = array();
            foreach($collectArr as $k => $v){
                $shopIds[] = $v['shop_id'];
            }
            if(!empty($shopIds)){
                $shopIds = array_unique($shopIds);
                $shopList = ShopModel::getShopListByShopIds($shopIds,$merge);
            }
        }
        $data = array(
            'shop_list' => $shopList,
            'merge' => $merge
        );

        $this->initTheme('usercenter');
        $this->theme->setTitle('我收藏的店铺');
        return $this->theme->scope('user.myshop',$data)->render();
    }

    
    public function cancelCollect(Request $request)
    {
        $ShopId = $request->get('id');
        $uid = Auth::id();
        $res = ShopFocusModel::where('uid',$uid)->where('shop_id',$ShopId)->delete();
        if($res){
            $data = array(
                'code' => 1,
                'msg' => '操作成功'
            );
        }else{
            $data = array(
                'code' => 0,
                'msg' => '操作失败'
            );
        }
        return  response()->json($data);
    }

    

    public function myShopHint(Request $request)
    {
        return $this->theme->scope('user.myshophint')->render();
    }



    

    public function switchUrl()
    {
        $uid = Auth::id();
        $this->theme->setUserId($uid);
        
        $realName = RealnameAuthModel::where('uid',$uid)->where('status',1)->first();
        if(empty($realName)){
            return $this->theme->scope('user.usershopbefore')->render();
        }else{
            $shopInfo = ShopModel::where('uid',$uid)->first();
            if(empty($shopInfo)){
                return $this->theme->scope('user.myshophint')->render();
            }
            return redirect()->to('/shop/manage/'.$shopInfo['id']);
        }
    }


    

    public function userShopBefore(Request $request)
    {
        return $this->theme->scope('user.usershopbefore')->render();
    }


    
    public function vippaylist(Request $request)
    {
        $currentPage = 1;

        if (Input::get('page')){
            $currentPage = Input::get('page');
            $currentPage = $currentPage <= 0 ? 1 : $currentPage;
        }

        $paginate = 10;

        $where = [
            'uid' => Auth::id()
        ];

        $packageId = ShopPackageModel::where($where)->get()->map(function ($v, $k){
            return $v->package_id;
        })->toArray();

        $change = PackageModel::whereIn('id', $packageId)->distinct()->get(['id', 'title']);

        if (Input::get('package_id')){
            $where = array_add($where, 'package_id', Input::get('package_id'));
        }

        $arrShopPackage = ShopPackageModel::where($where)->get();

        $arrPackageId = $arrShopPackage->map(function ($v, $k){
            return $v->package_id;
        })->toArray();

        $arrPackage = PackageModel::withTrashed()->whereIn('id', $arrPackageId)
            ->get(['id', 'title', 'logo']);

        collect($arrShopPackage)->transform(function ($v, $k) use ($arrPackage){
            $arrPackage = collect($arrPackage)->first(function ($kk, $vv) use ($v){
                if ($vv->id == $v->package_id){
                    return $vv;
                }
            });
            $v['title'] = $arrPackage['title']; $v['logo'] = $arrPackage['logo'];
            return $v;
        });

        $arrShopPackage = $arrShopPackage->toArray();

        $item = array_slice($arrShopPackage, ($currentPage - 1) * $paginate, $paginate);
        $total = count($arrShopPackage);

        $paginator = new LengthAwarePaginator($item, $total, $paginate, $currentPage, [
            'path' => Paginator::resolveCurrentPath('user/vippaylist'),
            'pageName' => 'page'
        ]);

        $data = [
            'list' => $paginator,
            'change' => $change,
            'package_id' => Input::get('package_id')
        ];

        return $this->theme->scope('user.vippaylist', $data)->render();
    }

    
    public function vippaylog($id)
    {

        $goodsInfo = ShopPackageModel::findOrFail($id);

        $package = PackageModel::withTrashed()->find($goodsInfo->package_id);

        $goodsInfo = collect($goodsInfo)->put('package_name', $package->title)
            ->put('package_ico', $package->logo)
            ->toArray();

        $arrPrivilege = json_decode($goodsInfo['privileges_package'], true);

        $privileges = PrivilegesModel::withTrashed()->whereIn('id', $arrPrivilege)->get(['title', 'desc']);

        $data = [
            'packageInfo' => $goodsInfo,
            'privileges' => $privileges
        ];

        return $this->theme->scope('user.vippaylog', $data)->render();
    }

    
    public function vipshopbar()
    {

        $shopPackage = ShopPackageModel::where(['uid' => Auth::id(), 'status' => 0])->first();

        $havePrivilege = false;

        $nav = [
            ['id' => 1, 'name' => '首页', 'status' => 1],
            ['id' => 2, 'name' => '作品', 'status' => 1],
            ['id' => 3, 'name' => '服务', 'status' => 1],
            ['id' => 4, 'name' => '成功案例', 'status' => 1],
            ['id' => 5, 'name' => '交易评价', 'status' => 1],
            ['id' => 6, 'name' => '关于我们', 'status' => 1],
        ];

        $nav = json_encode($nav);

        $color = 'blue'; $initBanner = []; $initCentral = $initFooter = [];

        $countCentral = 0; $countFooter = 0; $countBanner = 0;

        if (!empty($shopPackage)){

            $arrPrivilege = json_decode($shopPackage['privileges_package'], true);

            $privilege = PrivilegesModel::whereIn('id', $arrPrivilege)->where('code', 'SHOP_DECORATION')->first();

            if (!empty($privilege)){
                $havePrivilege = true;

                $shopInfo = ShopModel::where('uid', Auth::id())->first();

                $nav = $shopInfo['nav_rules'] ? $shopInfo['nav_rules'] : $nav;

                $color = $shopInfo['nav_color'] ? $shopInfo['nav_color'] : $color;

                $arrBannerId = json_decode($shopInfo['banner_rules'], true);

                $banner_ad = AttachmentModel::whereIn('id', $arrBannerId)->get();
                $countBanner = count($arrBannerId);
                if (!empty($banner_ad)){
                    foreach ($banner_ad as $item){
                        $initBanner[] = [
                            'name' => $item['name'],
                            'size' => $item['size'],
                            'id' => $item['id'],
                            'url' => url($item['url'])
                        ];
                    }
                }

                $central_ad = $shopInfo['central_ad']; $footer_ad = $shopInfo['footer_ad'];

                $countCentral = $central_ad ? 1 : 0;

                $countFooter = $footer_ad ? 1 : 0;

                $central_ad = AttachmentModel::where('url', $central_ad)->first();
                if ($central_ad){
                    $initCentral[] = [
                        'name' => $central_ad['name'],
                        'size' => $central_ad['size'],
                        'id' => $central_ad['id'],
                        'url' => url($central_ad['url'])
                    ];
                }

                $footer_ad = AttachmentModel::where('url', $footer_ad)->first();
                if ($footer_ad){
                    $initFooter[] = [
                        'name' => $footer_ad['name'],
                        'size' => $footer_ad['size'],
                        'id' => $footer_ad['id'],
                        'url' => url($footer_ad['url'])
                    ];
                }

            }
        }

        $data = [
            'havePrivilege' => $havePrivilege,
            'nav' => $nav,
            'color' => $color,
            'initBanner' => json_encode($initBanner),
            'initCentral' => json_encode($initCentral),
            'initFooter' => json_encode($initFooter),
            'hiddenBanner' => $initBanner,
            'hiddenCentral' => $initCentral,
            'hiddenFooter' => $initFooter,
            'countCentral' => $countCentral,
            'countFooter' => $countFooter,
            'countBanner' => $countBanner
        ];

        return $this->theme->scope('user.vipshopbar', $data)->render();
    }


    
    public function postVipshopbar()
    {
        $privilege = false;

        $shopPackage = ShopPackageModel::where(['uid' => Auth::id(), 'status' => 0])->first();

        if (!empty($shopPackage)){

            $arrPrivilege = json_decode($shopPackage['privileges_package'], true);

            $privilege = PrivilegesModel::whereIn('id', $arrPrivilege)->where('code', 'SHOP_DECORATION')->first();

            if (!empty($privilege)) $privilege = true;
        }

        if (!$privilege) return back()->with(['error' => '无装修特权']);

        $data = Input::get();

        $checkNavArr = array_values(array_flip($data['nav']));

        $nav = $data['navt'];

        $nav_rules = [];
        foreach ($nav as $k => $v){
            if (in_array($k, $checkNavArr)){
                $nav_rules[] = [
                    'id' => $k,
                    'name' => $v,
                    'status' => true,
                ];
            } else {
                $nav_rules[] = [
                    'id' => $k,
                    'name' => $v,
                    'status' => false,
                ];
            }
        }

        if (isset($data['banner'])){
            $banner = AttachmentModel::whereIn('id', $data['banner'])->get();
        }

        $banner_rules = [];

        if (!empty($banner)){
            foreach ($banner as $item) {
                if (in_array($item['id'], $data['banner'])){
                    $banner_rules[] = $item['id'];
                }
            }
        }

        $centralAD = '';
        if (isset($data['centralAD'])){
            $centralAD = AttachmentModel::find($data['centralAD'][0]);
        }

        if (!empty($centralAD)) $centralAD = $centralAD['url'];

        $footerAD = '';
        if (isset($data['footerAD'])){
            $footerAD = AttachmentModel::find($data['footerAD'][0]);
        }

        if (!empty($footerAD)) $footerAD = $footerAD['url'];

        $updatetArr = [
            'nav_color' => $data['color'],
            'nav_rules' => json_encode($nav_rules),
            'banner_rules' => json_encode($banner_rules),
            'central_ad' => $centralAD,
            'footer_ad' => $footerAD
        ];

        $status = ShopModel::where('uid', Auth::id())->update($updatetArr);

        if ($status)
            return redirect('user/vipshopbar')->with(['message' => '保存成功']);

    }

    
    public function delVipshopFile()
    {
        $data = Input::get();
        $id = $data['id'];
        
        $file = AttachmentModel::where('id',$id)->first()->toArray();
        if(!$file)
        {
            return response()->json(['errCode' => 0, 'errMsg' => '附件没有上传成功！']);
        }
        
        if(is_file($file['url']))
            unlink($file['url']);
        $result = AttachmentModel::destroy($id);
        if (!$result) {
            return response()->json(['errCode' => 0, 'errMsg' => '删除失败！']);
        }
        $shopInfo = ShopModel::where('uid', Auth::id())->first();
        switch ($data['type']){
            case 'banner':
                $banner = json_decode($shopInfo['banner_rules'], true);
                foreach ($banner as $key => $item){
                    if ($item == $id){
                        unset($banner[$key]);
                    }
                }
                break;
            case 'central':
                $shopInfo['central_ad'] = ''; $shopInfo->save();
                break;
            case 'footer':
                $shopInfo['footer_ad'] = ''; $shopInfo->save();
                break;
        }
        return response()->json(['errCode' => 1, 'errMsg' => '删除成功！']);
    }
}