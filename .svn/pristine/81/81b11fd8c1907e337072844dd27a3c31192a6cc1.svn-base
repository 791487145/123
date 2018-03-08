<?php

namespace App\Modules\Shop\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\IndexController as BasicIndexController;
use App\Modules\Employ\Models\EmployCommentsModel;
use App\Modules\Employ\Models\EmployGoodsModel;
use App\Modules\Shop\Models\GoodsCommentModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use App\Modules\Task\Model\SuccessCaseModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\User\Model\AuthRecordModel;
use App\Modules\Shop\Models\ShopFocusModel;
use Auth;
use DB;
use Omnipay;
use Teepluss\Theme\Facades\Theme;

class IndexController extends BasicIndexController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('shop');
    }

    
    public function shop($shopId)
    {
        $shopId = intval($shopId);
        $this->theme->set('SHOPID', $shopId);
        
        $shopInfo = ShopModel::getShopInfoById($shopId, 1);
        $workInfo = $goodsInfo = $evaluateInfo = [];
        if (!empty($shopInfo)) {
            
            if ($shopInfo['total_comment']) {
                $shopInfo['percent'] = $shopInfo['good_comment'] / $shopInfo['total_comment'];
                if ($shopInfo['percent']) {
                    $shopInfo['percent'] = number_format($shopInfo['percent'], 1) * 100;
                } else {
                    $shopInfo['percent'] = 100;
                }
            } else {
                $shopInfo['percent'] = 100;
            }
            
            $shopInfo['shop_desc'] = htmlspecialchars_decode($shopInfo['shop_desc']);
            
            $shopInfo['serviceNum'] = GoodsModel::where(['shop_id' => $shopId, 'status' => 1])->select('id')->sum('sales_num');
            
            $authUser = AuthRecordModel::getAuthByUserId($shopInfo['uid']);
            
            $workInfo = GoodsModel::select('goods.id', 'goods.title', 'goods.cover', 'goods.cash', 'cate.name')
                ->join('cate', 'goods.cate_id', '=', 'cate.id')
                ->where(['goods.shop_id' => $shopId, 'goods.type' => 1, 'goods.status' => 1])
                ->orderBy('goods.created_at', 'desc')
                ->limit(4)->get()->toArray();
            
            $goodsInfo = GoodsModel::select('goods.id', 'goods.title', 'goods.cover', 'goods.cash', 'cate.name')
                ->join('cate', 'goods.cate_id', '=', 'cate.id')
                ->where(['goods.shop_id' => $shopId, 'goods.type' => 2, 'goods.status' => 1])
                ->orderBy('goods.created_at', 'desc')
                ->limit(4)->get()->toArray();
            
            $goodsComment = GoodsCommentModel::join('goods', 'goods_comment.goods_id', '=', 'goods.id')
                ->join('users', 'goods_comment.uid', '=', 'users.id')
                ->join('user_detail', 'users.id', '=', 'user_detail.uid')
                ->where('goods.shop_id', $shopId)
                ->select('goods_comment.*', 'goods.type as sort', 'goods.title', 'goods.desc', 'goods.cash', 'users.name', 'user_detail.avatar', 'goods.id as goodId')
                ->orderBy('goods_comment.created_at', 'desc')
                ->limit(3)->get()->toArray();
            if (!empty($goodsComment)) {
                foreach ($goodsComment as $k => $v) {
                    $goodsComment[$k]['total_score'] = number_format(($v['speed_score'] + $v['quality_score'] + $v['attitude_score']) / 3, 1);
                    $goodsComment[$k]['desc'] = htmlspecialchars_decode($goodsComment[$k]['desc']);
                }
                $evaluateInfo = $goodsComment;
            }
            
            $caseInfo = SuccessCaseModel::join('cate', 'success_case.cate_id', '=', 'cate.id')
                ->where('success_case.uid', $shopInfo['uid'])
                ->select('success_case.id', 'success_case.title', 'success_case.pic', 'success_case.view_count', 'cate.name')
                ->orderBy('success_case.created_at', 'desc')
                ->limit(4)->get()->toArray();

            
            $carouselIds = json_decode($shopInfo['banner_rules'],true);
            $carouselPics = AttachmentModel::whereIn('id',$carouselIds)->select('url')->get()->toArray();

        } else {
            abort('404');
        }
        $domain = \CommonClass::getDomain();

        $this->theme->setTitle('我的店铺');
        $data = array(
            'domain' => $domain,
            'shopInfo' => $shopInfo,
            'authUser' => $authUser,
            'workInfo' => $workInfo,
            'goodsInfo' => $goodsInfo,
            'caseInfo' => $caseInfo,
            'commentInfo' => $evaluateInfo,
            'carouselPics' => $carouselPics,
            'central_ad' => $shopInfo['central_ad'],
            'footer_ad' => $shopInfo['footer_ad'],
            'shopId' => $shopId
        );
        return $this->theme->scope('shop.shop', $data)->render();
    }

    
    public function shopabout($shopId)
    {
        $shopId = intval($shopId);
        $this->theme->set('SHOPID', $shopId);
        
        $shopInfo = ShopModel::getShopInfoById($shopId, 1);
        if (!empty($shopInfo)) {
            if (Auth::id() != $shopInfo['uid']) {
                $shopInfo = ShopModel::getShopInfoById($shopId);
            }
        }
        if (!empty($shopInfo)) {
            
            $shopInfo['shop_desc'] = htmlspecialchars_decode($shopInfo['shop_desc']);
            
            $shopInfo['serviceNum'] = GoodsModel::where(['shop_id' => $shopId, 'status' => 1])->sum('sales_num');
            
            $authUser = AuthRecordModel::getAuthByUserId($shopInfo['uid']);
            
            $contactInfo = UserDetailModel::where('uid', $shopInfo['uid'])->select('mobile', 'mobile_status', 'qq', 'qq_status', 'wechat', 'wechat_status')->first();
            
            $emailStatus = UserModel::where('id', $shopInfo['uid'])->select('email_status')->first()->email_status;
            $this->theme->setUserId($shopInfo['uid']);
        } else {
            abort('404');
        }
        
        $isFocus = ShopFocusModel::shopFocusStatus($shopId);
        $this->theme->setTitle('店铺介绍');


        $domain = \CommonClass::getDomain();

        $data = array(
            'domain' => $domain,
            'shopInfo' => $shopInfo,
            'authUser' => $authUser,
            'contactInfo' => $contactInfo,
            'shopId' => $shopId,
            'emailStatus' => $emailStatus,
            'isFocus' => $isFocus
        );
        return $this->theme->scope('shop.shopabout', $data)->render();
    }

    
    public function successstory(Request $request, $shopId)
    {
        $shopId = intval($shopId);
        $this->theme->set('SHOPID', $shopId);
        $shopInfo = ShopModel::where('id', $shopId)->select('uid')->first();
        if (!empty($shopInfo)) {
            $this->theme->setUserId($shopInfo['uid']);
        } else {
            abort('404');
        }
        $cateInfo = SuccessCaseModel::join('cate', 'success_case.cate_id', '=', 'cate.id')
            ->join('shop', 'success_case.uid', '=', 'shop.uid')
            ->where('shop.id', $shopId)
            ->select('success_case.cate_id', 'cate.name', 'success_case.uid')->distinct()->orderBy('success_case.created_at', 'desc')->get()->toArray();
        if (!empty($cateInfo)) {
            foreach ($cateInfo as $k => $v) {
                $num = SuccessCaseModel::join('shop', 'success_case.uid', '=', 'shop.uid')->where(['success_case.cate_id' => $v['cate_id'], 'success_case.uid' => $v['uid']])->count();
                $cateInfo[$k]['num'] = $num;
            }
        }
        $caseInfo = SuccessCaseModel::join('cate', 'success_case.cate_id', '=', 'cate.id')
            ->join('shop', 'success_case.uid', '=', 'shop.uid')
            ->where('shop.id', $shopId);
        if ($request->get('cate_id')) {
            $caseInfo = $caseInfo->where('success_case.cate_id', intval($request->get('cate_id')));
        }
        $caseInfo = $caseInfo->select('success_case.id', 'success_case.title', 'success_case.pic', 'success_case.view_count', 'cate.name')
            ->orderBy('success_case.created_at', 'desc')
            ->paginate(12);
        $domain = \CommonClass::getDomain();
        $this->theme->setTitle('店铺案例');
        $data = [
            'cateInfo' => $cateInfo,
            'caseInfo' => $caseInfo,
            'domain' => $domain,
            'shopId' => $shopId
        ];
        return $this->theme->scope('shop.successstory', $data)->render();
    }

    
    public function shopall(Request $request, $shopId)
    {
        $shopId = intval($shopId);
        $this->theme->set('SHOPID', $shopId);
        $shopInfo = ShopModel::where('id', $shopId)->select('uid')->first();
        if (!empty($shopInfo)) {
            $this->theme->setUserId($shopInfo['uid']);
        } else {
            abort('404');
        }
        $cateInfo = GoodsModel::join('cate', 'goods.cate_id', '=', 'cate.id')
            ->where(['goods.type' => 1, 'goods.status' => 1, 'goods.shop_id' => $shopId])
            ->select('goods.cate_id', 'cate.name')->distinct()->orderBy('goods.created_at', 'desc')->get()->toArray();
        if (!empty($cateInfo)) {
            foreach ($cateInfo as $k => $v) {
                $num = GoodsModel::where(['cate_id' => $v['cate_id'], 'type' => 1, 'status' => 1, 'shop_id' => $shopId])->count();
                $cateInfo[$k]['num'] = $num;
            }
        }
        $workInfo = GoodsModel::join('cate', 'goods.cate_id', '=', 'cate.id')
            ->where(['goods.type' => 1, 'goods.status' => 1, 'goods.shop_id' => $shopId]);
        if ($request->get('cate_id')) {
            $workInfo = $workInfo->where('goods.cate_id', intval($request->get('cate_id')));
        }
        if($request->get('keywords')){
            $workInfo = $workInfo->where('goods.title','like','%'.$request->get('keywords').'%');
        }
        $workInfo = $workInfo->select('goods.id', 'goods.title', 'goods.cover', 'goods.cash', 'cate.name')
            ->orderBy('goods.created_at', 'desc')
            ->paginate(12);
        $domain = \CommonClass::getDomain();
        $this->theme->setTitle('店铺作品');
        $data = [
            'cateInfo' => $cateInfo,
            'workInfo' => $workInfo,
            'domain' => $domain,
            'shopId' => $shopId
        ];
        return $this->theme->scope('shop.shopall', $data)->render();
    }

    
    public function rated(Request $request, $shopId)
    {
        $shopId = intval($shopId);
        $this->theme->set('SHOPID', $shopId);
        
        $shopInfo = ShopModel::getShopInfoById($shopId, 1);
        if (!empty($shopInfo)) {
            if (Auth::id() != $shopInfo['uid']) {
                $shopInfo = ShopModel::getShopInfoById($shopId);
            }
        }
        $evaluateInfo = $goodCateInfo = $serviceCateInfo = [];
        $goodsCount = $serviceCount = $speedScore = $qualityScore = $attitudeScore = 0;
        if (!empty($shopInfo)) {
            
            $shopInfo['serviceNum'] = GoodsModel::where(['shop_id' => $shopInfo->id, 'status' => 1])->sum('sales_num');
            
            $authUser = AuthRecordModel::getAuthByUserId($shopInfo['uid']);
            
            $emailStatus = UserModel::where('id', $shopInfo['uid'])->select('email_status')->first()->email_status;
            
            $goodsComment = GoodsCommentModel::join('goods', 'goods_comment.goods_id', '=', 'goods.id')
                ->join('users', 'goods_comment.uid', '=', 'users.id')
                ->join('user_detail', 'users.id', '=', 'user_detail.uid')
                ->where('goods.shop_id', $shopId);
            switch ($request->get('type')) {
                case '1':
                    $type = 0;
                    break;
                case '2':
                    $type = 1;
                    break;
                case '3':
                    $type = 2;
                    break;
                default:
                    $type = 0;
            }
            $goodsComment = $goodsComment->where('goods_comment.type', $type);

            $goodsComment = $goodsComment->select('goods_comment.*', 'goods.type as sort', 'goods.title', 'goods.desc', 'goods.cash', 'users.name', 'user_detail.avatar', 'goods.id as goodId')
                ->orderBy('goods_comment.created_at', 'desc')->paginate(4);
            if (isset($goodsComment)) {
                foreach ($goodsComment as $k => $v) {
                    $goodsComment[$k]->total_score = number_format(($v->speed_score + $v->quality_score + $v->attitude_score) / 3, 1);
                    $goodsComment[$k]->desc = htmlspecialchars_decode($goodsComment[$k]->desc);
                }
                $evaluateInfo = $goodsComment;
            }
            
            $goodCateInfo = GoodsModel::join('cate', 'goods.cate_id', '=', 'cate.id')
                ->where('goods.shop_id', $shopId)
                ->where(['goods.type' => 1, 'goods.status' => 1])
                ->select('goods.cate_id', 'cate.name')->distinct()->orderBy('goods.created_at', 'desc')->limit(3)->get()->toArray();
            if (!empty($goodCateInfo)) {
                foreach ($goodCateInfo as $k => $v) {
                    $num = GoodsModel::where(['cate_id' => $v['cate_id'], 'type' => 1, 'status' => 1, 'shop_id' => $shopId])->count();
                    $goodCateInfo[$k]['num'] = $num;
                }
            }
            
            $serviceCateInfo = GoodsModel::join('cate', 'goods.cate_id', '=', 'cate.id')
                ->where('goods.shop_id', $shopId)
                ->where(['goods.type' => 2, 'goods.status' => 1])
                ->select('goods.cate_id', 'cate.name')->distinct()->orderBy('goods.created_at', 'desc')->limit(3)->get()->toArray();
            if (!empty($serviceCateInfo)) {
                foreach ($serviceCateInfo as $k => $v) {
                    $num = GoodsModel::where(['cate_id' => $v['cate_id'], 'type' => 2, 'status' => 1, 'shop_id' => $shopId])->count();
                    $serviceCateInfo[$k]['num'] = $num;
                }
            }
            
            $goodsCount = GoodsModel::where(['shop_id' => $shopId, 'status' => 1, 'type' => 1])->count();
            
            $serviceCount = GoodsModel::where(['shop_id' => $shopId, 'status' => 1, 'type' => 2])->count();
            $goodsIds = GoodsModel::where(['shop_id' => $shopId, 'status' => 1])->select('id')->get()->toArray();
            $goodsIds = array_flatten($goodsIds);
            
            $speedScore = GoodsCommentModel::whereIn('goods_id', $goodsIds)->avg('speed_score');
            $speedScore = number_format($speedScore, 1);
            
            $qualityScore = GoodsCommentModel::whereIn('goods_id', $goodsIds)->avg('quality_score');
            $qualityScore = number_format($qualityScore, 1);
            
            $attitudeScore = GoodsCommentModel::whereIn('goods_id', $goodsIds)->avg('attitude_score');
            $attitudeScore = number_format($attitudeScore, 1);
            
            $contactInfo = UserDetailModel::where('uid', $shopInfo['uid'])->select('mobile', 'mobile_status', 'qq', 'qq_status', 'wechat', 'wechat_status')->first();
            $this->theme->setUserId($shopInfo['uid']);
        } else {
            abort('404');
        }

        $domain = \CommonClass::getDomain();
        
        $isFocus = ShopFocusModel::shopFocusStatus($shopId);
        $this->theme->setTitle('店铺评价');

        $data = array(
            'domain' => $domain,
            'shopInfo' => $shopInfo,
            'authUser' => $authUser,
            'commentInfo' => $evaluateInfo,
            'goodCateInfo' => $goodCateInfo,
            'serviceCateInfo' => $serviceCateInfo,
            'goodsCount' => $goodsCount,
            'serviceCount' => $serviceCount,
            'speedScore' => $speedScore,
            'qualityScore' => $qualityScore,
            'attitudeScore' => $attitudeScore,
            'shopId' => $shopId,
            'emailStatus' => $emailStatus,
            'isFocus' => $isFocus,
            'contactInfo' => $contactInfo

        );

        return $this->theme->scope('shop.rated', $data)->render();
    }


    
    public function serviceAll(Request $request, $shopId)
    {
        $shopId = intval($shopId);
        $this->theme->set('SHOPID', $shopId);
        $shopInfo = ShopModel::where('id', $shopId)->select('uid')->first();
        if (!empty($shopInfo)) {
            $this->theme->setUserId($shopInfo['uid']);
        } else {
            abort('404');
        }
        $cateInfo = GoodsModel::join('cate', 'goods.cate_id', '=', 'cate.id')
            ->where(['goods.type' => 2, 'goods.status' => 1, 'goods.shop_id' => $shopId])
            ->select('goods.cate_id', 'cate.name')->distinct()->orderBy('goods.created_at', 'desc')->get()->toArray();
        if (!empty($cateInfo)) {
            foreach ($cateInfo as $k => $v) {
                $num = GoodsModel::where(['cate_id' => $v['cate_id'], 'type' => 2, 'status' => 1, 'shop_id' => $shopId])->count();
                $cateInfo[$k]['num'] = $num;
            }
        }
        $serviceInfo = GoodsModel::join('cate', 'goods.cate_id', '=', 'cate.id')
            ->where(['goods.type' => 2, 'goods.status' => 1, 'goods.shop_id' => $shopId]);
        if ($request->get('cate_id')) {
            $serviceInfo = $serviceInfo->where('goods.cate_id', intval($request->get('cate_id')));
        }
        if($request->get('keywords')){
            $serviceInfo = $serviceInfo->where('goods.title','like','%'.$request->get('keywords').'%');
        }
        $serviceInfo = $serviceInfo->select('goods.id', 'goods.title', 'goods.cover', 'goods.cash', 'cate.name')
            ->orderBy('goods.created_at', 'desc')
            ->paginate(12);
        $domain = \CommonClass::getDomain();
        $this->theme->setTitle('店铺服务');
        $data = [
            'cateInfo' => $cateInfo,
            'serviceInfo' => $serviceInfo,
            'domain' => $domain,
            'shopId' => $shopId
        ];
        return $this->theme->scope('shop.serviceall', $data)->render();
    }

    
    public function getSecondCate($cateId)
    {
        $data = TaskCateModel::select('id', 'name')->where('pid', $cateId)->get();

        $html = '';
        if (!empty($data)) {
            foreach ($data as $item) {
                $html .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }
        } else {
            $html = "<option value=''>没有了</option>";
        }

        return \CommonClass::formatResponse('success', 200, $html);
    }

    
    public function ajaxUpdateShop(Request $request)
    {
        $shopId = $request->get('id');
        $shopInfo = ShopModel::where('id', $shopId)->first();
        $data = [
            'uid' => $shopInfo->uid,
            'shopId' => $shopId
        ];
        if ($shopInfo['status'] == 1) {
            $res = DB::transaction(function () use ($data) {
                $shopInfo = ShopModel::where('id', $data['shopId'])->update(['status' => 2, 'updated_at' => date('Y-m-d H:i:s', time())]);
                $userDetail = UserDetailModel::where('uid', $data['uid'])->update(['shop_status' => 2, 'updated_at' => date('Y-m-d H:i:s', time())]);
                $auditInfo = GoodsModel::where(['shop_id' => $data['shopId'], 'status' => 0])->get();
                if (!empty($auditInfo)) {
                    GoodsModel::where(['shop_id' => $data['shopId'], 'status' => 0])->update(['status' => 3]);
                }
                $salesInfo = GoodsModel::where(['shop_id' => $data['shopId'], 'status' => 1])->get();
                if (!empty($salesInfo)) {
                    GoodsModel::where(['shop_id' => $data['shopId'], 'status' => 1])->update(['status' => 2]);
                }
                return true;
            });

        } else {
            $res = DB::transaction(function () use ($data) {
                $shopInfo = ShopModel::where('id', $data['shopId'])->update(['status' => 1, 'updated_at' => date('Y-m-d H:i:s', time())]);
                $userDetail = UserDetailModel::where('uid', $data['uid'])->update(['shop_status' => 1, 'updated_at' => date('Y-m-d H:i:s', time())]);
                return true;
            });

        }
        if ($res) {
            return response()->json(['code' => 1, 'message' => '修改成功']);
        } else {
            return response()->json(['code' => 0, 'message' => '修改失败！']);
        }
    }

    
    public function ajaxUpdatePic(Request $request)
    {
        $file = $request->file('back');

        $result = \FileClass::uploadFile($file, 'user', array('jpg', 'png', 'jpeg', 'bmp', 'png'));
        $result = json_decode($result, true);
        $backgroundurl = $result['data']['url'];
        $domain = \CommonClass::getDomain();
        return response()->json(['path' => $backgroundurl, 'domain' => $domain]);
    }


    
    public function ajaxUpdateBack(Request $request)
    {
        $uid = Auth::id();
        $backgroundurl = $request->get('src');
        $data = array(
            'shop_bg' => $backgroundurl,
            'updated_at' => date('Y-m-d H:i:s', time())
        );
        $result = ShopModel::where('uid', $uid)->update($data);
        $domain = \CommonClass::getDomain();
        return response()->json(['path' => $backgroundurl, 'domain' => $domain]);
    }


    
    public function ajaxDelPic(Request $request)
    {
        $id = intval($request->get('id'));
        $result = ShopModel::where('id', $id)->update(['shop_bg' => '', 'updated_at' => date('Y-m-d H:i:s', time())]);
        $domain = \CommonClass::getDomain();
        return response()->json(['domain' => $domain]);
    }

    
    public function buyService($id)
    {
        $all_cate = TaskCateModel::findAllCache();
        $all_cate = \CommonClass::keyBy($all_cate, 'id');

        
        $service = GoodsModel::where('id', $id)->where('type', 2)->first();

        
        $is_owner = 0;
        if ($service['uid'] == Auth::user()['id']) {
            $is_owner = 1;
        }

        if ($is_owner == 0 && $service['status'] != 1)
            return redirect()->back()->with(['error' => '当前服务未上架！']);

        
        $employ_id = EmployGoodsModel::where('service_id', $id)->lists('employ_id')->toArray();
        
        $avgSpeed = round(EmployCommentsModel::whereIn('employ_id', $employ_id)->avg('speed_score'), 1);
        
        $avgQuality = round(EmployCommentsModel::whereIn('employ_id', $employ_id)->avg('quality_score'), 1);
        
        $avgAttitude = round(EmployCommentsModel::whereIn('employ_id', $employ_id)->avg('attitude_score'), 1);
        $avgAll = round(($avgSpeed + $avgQuality + $avgAttitude) / 3, 1);

        
        $comments = EmployCommentsModel::serviceComments($employ_id);
        $comments_toArray = $comments->toArray();
        
        foreach ($comments_toArray['data'] as $k => $v) {
            $comments_toArray['data'][$k]['total_score'] = round(($v['speed_score'] + $v['quality_score'] + $v['attitude_score']) / 3, 1);
        }

        
        $other_service = GoodsModel::where('shop_id', $service['shop_id'])->where('status', 1)->where('type', 2)->where('id', '<>', $id)->get();

        $this->theme->set('SHOPID', $service['shop_id']);
        
        $this->theme->setTitle('购买服务');
        if (!empty($service['title']))
            $this->theme->setTitle($service['title']);

        $this->theme->set('keywords', $service['seo_keyword']);
        $this->theme->set('keywords', $service['seo_keyword']);
        $this->theme->set('description', $service['seo_desc']);
        $this->theme->setUserId($service['uid']);
        
        $isFocus = ShopFocusModel::shopFocusStatus($service['shop_id']);
        
        GoodsModel::where('id', $id)->increment('view_num', 1);
        
        $rate = \CommonClass::getConfig('employ_percentage');
        
        $contactInfo = UserDetailModel::where('uid', $service['uid'])
            ->select('mobile', 'mobile_status', 'qq', 'qq_status', 'wechat', 'wechat_status')->first();
        $domain = url();
        $view = [
            'service' => $service,
            'other_service' => $other_service,
            'all_cate' => $all_cate,
            'comments' => $comments,
            'comments_toArray' => $comments_toArray,
            'avgAll' => $avgAll,
            'contact' => Theme::get('is_IM_open'),
            'avgSpeed' => $avgSpeed,
            'avgQuality' => $avgQuality,
            'avgAttitude' => $avgAttitude,
            'is_owner' => $is_owner,
            'isFocus' => $isFocus,
            'rate' => $rate,
            'domain' => $domain,
            'contactInfo' => $contactInfo
        ];

        return $this->theme->scope('shop.buyservice', $view)->render();
    }

    
    public function ajaxServiceComments(Request $request)
    {
        $this->initTheme('ajaxpage');
        $id = $request->get('id');
        $data = $request->except('id');
        $type = isset($data['type']) ? $data['type'] : 0;

        
        $employ_id = EmployGoodsModel::where('service_id', $id)->lists('employ_id')->toArray();

        
        $comments = EmployCommentsModel::serviceComments($employ_id, $data);

        $comments_toArray = $comments->toArray();
        
        foreach ($comments_toArray['data'] as $k => $v) {
            $comments_toArray['data'][$k]['total_score'] = round(($v['speed_score'] + $v['quality_score'] + $v['attitude_score']) / 3, 1);
        }

        $view = [
            'comments' => $comments,
            'comments_toArray' => $comments_toArray,
            'type' => $type,
            'id' => $id
        ];
        return $this->theme->scope('shop.ajaxservicecomments', $view)->render();
    }

    
    public function successDetail($id)
    {
        $id = intval($id);
        $successCase = SuccessCaseModel::getSuccessInfoById($id);
        
        SuccessCaseModel::where('id',$id)->update(array('view_count' => $successCase->view_count + 1));
        
        $successCaseList = SuccessCaseModel::getOtherSuccessByUid($successCase->uid, $id, 5);
        $shopId = ShopModel::getShopIdByUid($successCase->uid);
        $this->theme->set('SHOPID', $shopId);
        $this->theme->setUserId($successCase->uid);
        $data = array(
            'success_case' => $successCase,
            'list' => $successCaseList
        );
        $this->theme->setTitle('成功案例');
        return $this->theme->scope('shop.successdetail', $data)->render();
    }

    
    public function shopOutside($shopId)
    {
        $shopId = intval($shopId);
        $this->theme->set('SHOPID', $shopId);
        
        $shopInfo = ShopModel::getShopInfoById($shopId);
        $workInfo = $goodsInfo = $evaluateInfo = [];
        if (!empty($shopInfo)) {
            
            if ($shopInfo['total_comment']) {
                $shopInfo['percent'] = $shopInfo['good_comment'] / $shopInfo['total_comment'];
                if ($shopInfo['percent']) {
                    $shopInfo['percent'] = number_format($shopInfo['percent'], 1) * 100;
                } else {
                    $shopInfo['percent'] = 100;
                }
            } else {
                $shopInfo['percent'] = 100;
            }
            
            $shopInfo['shop_desc'] = htmlspecialchars_decode($shopInfo['shop_desc']);
            
            $shopInfo['serviceNum'] = GoodsModel::where(['shop_id' => $shopId, 'status' => 1])->select('id')->sum('sales_num');
            
            $authUser = AuthRecordModel::getAuthByUserId($shopInfo['uid']);
            
            $emailStatus = UserModel::where('id', $shopInfo['uid'])->select('email_status')->first()->email_status;
            
            $workInfo = GoodsModel::select('goods.id', 'goods.title', 'goods.cover', 'goods.cash', 'cate.name')
                ->join('cate', 'goods.cate_id', '=', 'cate.id')
                ->where(['goods.shop_id' => $shopId, 'goods.type' => 1, 'goods.status' => 1])
                ->orderBy('goods.created_at', 'desc')
                ->limit(4)->get()->toArray();
            
            $goodsInfo = GoodsModel::select('goods.id', 'goods.title', 'goods.cover', 'goods.cash', 'cate.name')
                ->join('cate', 'goods.cate_id', '=', 'cate.id')
                ->where(['goods.shop_id' => $shopId, 'goods.type' => 2, 'goods.status' => 1])
                ->orderBy('goods.created_at', 'desc')
                ->limit(4)->get()->toArray();
            
            $goodsComment = GoodsCommentModel::join('goods', 'goods_comment.goods_id', '=', 'goods.id')
                ->join('users', 'goods_comment.uid', '=', 'users.id')
                ->join('user_detail', 'users.id', '=', 'user_detail.uid')
                ->where('goods.shop_id', $shopId)
                ->select('goods_comment.*', 'goods.type as sort', 'goods.title', 'goods.desc', 'goods.cash', 'users.name', 'user_detail.avatar', 'goods.id as goodId')
                ->orderBy('goods_comment.created_at', 'desc')
                ->limit(3)->get()->toArray();
            if (!empty($goodsComment)) {
                foreach ($goodsComment as $k => $v) {
                    $goodsComment[$k]['total_score'] = number_format(($v['speed_score'] + $v['quality_score'] + $v['attitude_score']) / 3, 1);
                    $goodsComment[$k]['desc'] = htmlspecialchars_decode($goodsComment[$k]['desc']);
                }
                $evaluateInfo = $goodsComment;
            }
            
            $caseInfo = SuccessCaseModel::join('cate', 'success_case.cate_id', '=', 'cate.id')
                ->where('success_case.uid', $shopInfo['uid'])
                ->select('success_case.id', 'success_case.title', 'success_case.pic', 'success_case.view_count', 'cate.name')
                ->orderBy('success_case.created_at', 'desc')
                ->limit(4)->get()->toArray();
            
            $contactInfo = UserDetailModel::where('uid', $shopInfo['uid'])->select('mobile', 'mobile_status', 'qq', 'qq_status', 'wechat', 'wechat_status')->first();
            $this->theme->setTitle($shopInfo['shop_name']);

            
            $carouselIds = json_decode($shopInfo['banner_rules'],true);
            $carouselPics = AttachmentModel::whereIn('id',$carouselIds)->select('url')->get()->toArray();

        } else {
            abort('404');
        }
        $domain = \CommonClass::getDomain();
        
        $isFocus = ShopFocusModel::shopFocusStatus($shopId);

        $data = array(
            'domain' => $domain,
            'shopInfo' => $shopInfo,
            'authUser' => $authUser,
            'workInfo' => $workInfo,
            'goodsInfo' => $goodsInfo,
            'caseInfo' => $caseInfo,
            'commentInfo' => $evaluateInfo,
            'shopId' => $shopId,
            'emailStatus' => $emailStatus,
            'isFocus' => $isFocus,
            'contactInfo' => $contactInfo,
            'carouselPics' => $carouselPics,
            'central_ad' => $shopInfo['central_ad'],
            'footer_ad' => $shopInfo['footer_ad']
        );
        return $this->theme->scope('shop.shopoutside', $data)->render();
    }


    
    public function ajaxAdd(Request $request)
    {
        $uid = Auth::id();
        $shopId = $request->get('shop_id');
        $data = [
            'uid' => $uid,
            'shop_id' => $shopId,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $res = ShopFocusModel::create($data);
        if ($res) {
            return response()->json(['code' => 1]);
        } else {
            return response()->json(['code' => 2]);
        }
    }

    
    public function navList(Request $request){
        $shopId = intval($request->get('shopId'));
        $shopInfo = ShopModel::where('id',$shopId)->select('nav_rules','uid')->first();
        if(empty($shopInfo)){
            return false;
        }else{
            if($shopInfo['nav_rules']){
                $nav_rules = json_decode($shopInfo['nav_rules'],true);
                foreach($nav_rules as $k=>$v){
                    switch($v['id']){
                        case 1:
                            if($v['status']){
                                if($shopInfo['uid'] == Auth::id()){
                                    $nav_rules[$k]['url'] = '/shop/manage/'.$shopId;
                                }else{
                                    $nav_rules[$k]['url'] = '/shop/'.$shopId;
                                }
                            }
                            break;
                        case 2:
                            if($v['status']){
                                $nav_rules[$k]['url'] = '/shop/work/'.$shopId;
                            }
                            break;
                        case 3:
                            if($v['status']){
                                $nav_rules[$k]['url'] = '/shop/serviceAll/'.$shopId;
                            }
                            break;
                        case 4:
                            if($v['status']){
                                $nav_rules[$k]['url'] = '/shop/successStory/'.$shopId;
                            }
                            break;
                        case 5:
                            if($v['status']){
                                $nav_rules[$k]['url'] = '/shop/rated/'.$shopId;
                            }
                            break;
                        case 6:
                            if($v['status']){
                                $nav_rules[$k]['url'] = '/shop/about/'.$shopId;
                            }
                            break;
                    }
                }
            }else{
                $nav_rules = [
                    ["id" => 1,"name" => "首页","status" => true],
                    ["id" => 2,"name" => "作品","status" => true,"url" => '/shop/work/'.$shopId],
                    ["id" => 3,"name" => "服务","status" => true,"url" => '/shop/serviceAll/'.$shopId],
                    ["id" => 4,"name" => "成功案例","status" => true,"url" => '/shop/successStory/'.$shopId],
                    ["id" => 5,"name" => "交易评价","status" => true,"url" => '/shop/rated/'.$shopId],
                    ["id" => 6,"name" => "关于我们","status" => true,"url" => '/shop/about/'.$shopId]
                ];
                if($shopInfo['uid'] == Auth::id()){
                    $nav_rules[0]['url'] = '/shop/manage/'.$shopId;
                }else{
                    $nav_rules[0]['url'] = '/shop/'.$shopId;
                }
            }

            return $nav_rules;
        }
    }

}
