<?php

namespace App\Modules\Mobile\Http\Controllers;

use App\Http\Requests;
use App\Modules\Employ\Models\EmployModel;
use App\Modules\Employ\Models\UnionRightsModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsCommentModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Input;
use Omnipay;
use Validator;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Employ\Models\UnionAttachmentModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\Shop\Models\ShopFocusModel;
use App\Modules\Task\Model\ServiceModel;
use DB;

class GoodsController extends ApiBaseController
{
    
    public function isPub(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        
        $isOpenShop = ShopModel::isOpenShop($tokenInfo['uid']);

        if ($isOpenShop != 1) {
            if ($isOpenShop == 2) {
                return $this->formateResponse(1001, '您的店铺已关闭');
            } else {
                return $this->formateResponse(1001, '您的店铺还没设置');
            }
        }
        return $this->formateResponse(1000, 'success');
    }

    
    public function fileUpload(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $file = $request->file('file');
        
        $attachment = \FileClass::uploadFile($file, 'user');
        $attachment = json_decode($attachment, true);
        
        if ($attachment['code'] != 200) {
            return $this->formateResponse(1001, $attachment['message']);
        }
        $attachment_data = array_add($attachment['data'], 'status', 1);
        $attachment_data['created_at'] = date('Y-m-d H:i:s', time());
        $attachment_data['user_id'] = $tokenInfo['uid'];
        
        $result = AttachmentModel::create($attachment_data);
        $data = AttachmentModel::where('id', $result['id'])->first();
        $domain = ConfigModel::where('alias', 'site_url')->where('type', 'site')->select('rule')->first();
        if (isset($data)) {
            $data->url = $data->url ? $domain->rule . '/' . $data->url : $data->url;
        }
        if ($result) {
            return $this->formateResponse(1000, 'success', $data);
        } else {
            return $this->formateResponse(1001, '网络错误');
        }
    }

    
    public function pubGoods(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'desc' => 'required|string',
            'first_cate' => 'required',
            'second_cate' => 'required',
            'cash' => 'required|numeric',
            'cover' => 'required'

        ], [
            'title.required' => '请输入作品标题',
            'title.string' => '请输入正确的标题格式',
            'title.max' => '标题长度不得超过50个字符',

            'desc.required' => '请输入作品描述',
            'desc.string' => '请输入描述正确的格式',

            'first_cate.required' => '请选择作品分类',
            'second_cate.required' => '请选择作品子分类',

            'cash.required' => '请输入作品金额',
            'cash.numeric' => '请输入正确的金额格式',

            'cover.required' => '请上传作品封面'
        ]);
        
        $error = $validator->errors()->all();
        if (count($error)) {
            return $this->formateResponse(1001, $error[0], $error);
        }
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        
        $shopId = ShopModel::getShopIdByUid($tokenInfo['uid']);

        $data = $request->all();
        $data['cate_id'] = $data['second_cate'];

        
        $minPriceArr = ConfigModel::getConfigByAlias('min_price');
        if (!empty($minPriceArr)) {
            $minPrice = $minPriceArr->rule;
        } else {
            $minPrice = 0;
        }
        if ($minPrice > 0 && $data['cash'] < $minPrice) {
            return $this->formateResponse(1001, '作品金额不能小于最低配置值');
        }
        isset($data['is_recommend']) ? $is_service = true : $is_service = false;
        
        $cover = $request->file('cover');
        $result = \FileClass::uploadFile($cover, 'sys');
        if ($result) {
            $result = json_decode($result, true);
            $data['cover'] = $result['data']['url'];
        }
        
        $config = ConfigModel::getConfigByAlias('goods_check');
        if (!empty($config) && $config->rule == 1) {
            $goodsCheck = 0;
        } else {
            $goodsCheck = 1;
        }
        $data['status'] = $goodsCheck;
        $data['is_recommend'] = 0;
        $data['uid'] = $tokenInfo['uid'];
        $data['shop_id'] = $shopId;
        $res = DB::transaction(function () use ($data) {
            $goods = GoodsModel::create($data);
            
            
            if (!empty($data['file_id'])) {
                
                $file_able_ids = AttachmentModel::fileAble($data['file_id']);
                $data['file_id'] = array_flatten($file_able_ids);
                $arrAttachment = array();
                foreach ($data['file_id'] as $v) {
                    $arrAttachment[] = [
                        'object_id' => $goods->id,
                        'object_type' => 4,
                        'attachment_id' => $v,
                        'created_at' => date('Y-m-d H:i:s', time())
                    ];
                }
                UnionAttachmentModel::insert($arrAttachment);
            }
            return $goods;
        });
        if (!isset($res)) {
            return $this->formateResponse(1001, '网络错误');
        }
        return $this->formateResponse(1000, '作品发布成功', $res);

    }

    
    public function pubService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'desc' => 'required|string',
            'first_cate' => 'required',
            'second_cate' => 'required',
            'cash' => 'required|numeric',
            'cover' => 'required'

        ], [
            'title.required' => '请输入服务标题',
            'title.string' => '请输入正确的标题格式',
            'title.max' => '标题长度不得超过50个字符',

            'desc.required' => '请输入服务描述',
            'desc.string' => '请输入描述正确的格式',

            'first_cate.required' => '请选择服务分类',
            'second_cate.required' => '请选择服务子分类',

            'cash.required' => '请输入服务金额',
            'cash.numeric' => '请输入正确的金额格式',
            'cover.required' => '请上传服务封面'
        ]);
        
        $error = $validator->errors()->all();
        if (count($error)) {
            return $this->formateResponse(1001,$error[0], $error);
        }
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        
        $shopId = ShopModel::getShopIdByUid($tokenInfo['uid']);

        $data = $request->all();
        $data['cate_id'] = $data['second_cate'];

        
        $minPriceArr = \CommonClass::getConfig('employ_bounty_min_limit');
        if (!$minPriceArr) {
            $minPrice = $minPriceArr;
        } else {
            $minPrice = 0;
        }
        if ($minPrice > 0 && $data['cash'] < $minPrice) {
            return $this->formateResponse(1001, '服务金额不能小于最低配置值');
        }
        
        $cover = $request->file('cover');
        $result = \FileClass::uploadFile($cover, 'sys');
        if ($result) {
            $result = json_decode($result, true);
            $data['cover'] = $result['data']['url'];
        }
        
        $config = ConfigModel::getConfigByAlias('service_check');
        if (!empty($config) && $config->rule == 1) {
            $goodsCheck = 0;
        } else {
            $goodsCheck = 1;
        }
        $data['status'] = $goodsCheck;
        $data['is_recommend'] = 0;
        $data['uid'] = $tokenInfo['uid'];
        $data['shop_id'] = $shopId;
        $goods = GoodsModel::create($data);
        if (!isset($goods)) {
            return $this->formateResponse(1001, '网络错误');
        }
        return $this->formateResponse(1000, '服务发布成功', $goods);

    }


    
    public function myCollectShop(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $merge = $request->all();
        $collectArr = ShopFocusModel::where('uid', $tokenInfo['uid'])->orderby('created_at', 'DESC')->get()->toArray();
        $shopList = array();
        if (!empty($collectArr)) {
            $shopIds = array_unique(array_pluck($collectArr, 'shop_id'));
            $shopList = ShopModel::getShopListByShopIds($shopIds, $merge)->toArray();
            if ($shopList['total']) {
                $domain = ConfigModel::where('alias', 'site_url')->where('type', 'site')->select('rule')->first();
                foreach ($shopList['data'] as $k => $v) {
                    $shopList['data'][$k]['shop_pic'] = $v['shop_pic'] ? $domain->rule . '/' . $v['shop_pic'] : $v['shop_pic'];
                    
                    $shopList['data'][$k]['city_name'] = $v['province_name'] . $v['city_name'];
                    $shopList['data'][$k]['cate_name'] = isset($v['skill']) ? $v['skill'] : [];
                    $shopList['data'][$k]['good_comment'] = $v['good_comment'] ? $v['good_comment'] : 0;
                    $shopList['data'][$k] = array_except($shopList['data'][$k], ['employ_data', 'province_name', 'uid', 'type', 'shop_desc', 'province', 'city', 'status', 'created_at', 'updated_at', 'shop_bg', 'seo_title', 'seo_keyword', 'seo_desc', 'is_recommend', 'email_status', 'comment_rate', 'auth', 'employ_num', 'skill', 'nav_rules', 'nav_color', 'banner_rules', 'central_ad', 'footer_ad']);
                    

                }
            }
        }
        return $this->formateResponse(1000, '获取我收藏的店铺列表信息成功', $shopList);

    }


    
    public function workRateInfo()
    {
        $workRate = ConfigModel::where('alias', 'trade_rate')->first();
        $percent = $workRate->rule;
        return $this->formateResponse(1000, '获取作品平台抽佣信息成功', ['percent' => $percent]);

    }

    
    public function workRecommendInfo()
    {
        $configInfo = [];
        
        $isOpenArr = ServiceModel::where(['identify' => 'ZUOPINTUIJIAN', 'type' => 2, 'status' => 1])->first();
        if (!empty($isOpenArr)) {
            $configInfo['isOpen'] = 1;
            $configInfo['price'] = $isOpenArr->price;
            
            $unitAbout = ConfigModel::getConfigByAlias('recommend_goods_unit');
            $configInfo['unit'] = $unitAbout->rule;
        } else {
            $configInfo['isOpen'] = 0;
        }
        return $this->formateResponse(1000, '获取推荐作品开启信息成功', ['configInfo' => $configInfo]);


    }


    
    public function serviceRateInfo()
    {
        $serviceRate = ConfigModel::where('alias', 'employ_percentage')->first();
        $percent = $serviceRate->rule;
        return $this->formateResponse(1000, '获取服务平台抽佣信息成功', ['percent' => $percent]);

    }


    
    public function serviceRecommendInfo()
    {
        $configInfo = [];
        
        $service = ServiceModel::where(['status' => 1, 'type' => 2, 'identify' => 'FUWUTUIJIAN'])->first();
        if (!empty($service)) {
            $configInfo['isOpen'] = 1;
            $configInfo['price'] = $service->price;
            $configInfo['unit'] = \CommonClass::getConfig('recommend_service_unit');
        } else {
            $configInfo['isOpen'] = 0;
        }

        return $this->formateResponse(1000, '获取推荐服务开启信息成功', ['configInfo' => $configInfo]);


    }


    
    public function myWorkList(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        $merge = $request->all();
        $goodsInfo = GoodsModel::getGoodsListByUid($uid, $merge)->toArray();
        if ($goodsInfo['total']) {
            $domain = ConfigModel::where('alias', 'site_url')->where('type', 'site')->select('rule')->first();
            foreach ($goodsInfo['data'] as $k => $v) {
                $goodsInfo['data'][$k]['desc'] = htmlspecialchars_decode($v['desc']);
                $goodsInfo['data'][$k]['cover'] = $v['cover'] ? $domain->rule . '/' . $v['cover'] : $v['cover'];
            }
        }
        return $this->formateResponse(1000, '获取我发布的作品成功', $goodsInfo);
    }


    
    public function myOfferList(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $all_cate = TaskCateModel::findAllCache();
        $all_cate = \CommonClass::keyBy($all_cate, 'id');
        $service = GoodsModel::select('*')->where('uid', $tokenInfo['uid'])->where('type', 2)->where('is_delete', 0);
        
        if ($request->get('status')) {
            switch ($request->get('status')) {
                case 1:
                    $status = 0;
                    $service = $service->where('status', $status);
                    break;
                case 2:
                    $status = 1;
                    $service = $service->where('status', $status);
                    break;
                case 3:
                    $status = 2;
                    $service = $service->where('status', $status);
                    break;
                case 4: 
                    $status = 3;
                    $service = $service->where('status', $status);
                    break;

            }
        }
        
        if ($request->get('sometime')) {
            $time = date('Y-m-d H:i:s', strtotime("-" . intval($request->get('sometime')) . " month"));
            $service->where('created_at', '>', $time);
        }

        $service = $service->orderBy('created_at', 'DESC')
            ->paginate(5)->toArray();

        if ($service['total']) {
            $domain = ConfigModel::where('alias', 'site_url')->where('type', 'site')->select('rule')->first();
            foreach ($service['data'] as $k => $v) {
                $service['data'][$k]['name'] = $all_cate[$v['cate_id']]['name'];
                $service['data'][$k]['cover'] = $v['cover'] ? $domain->rule . '/' . $v['cover'] : $v['cover'];
                $service['data'][$k]['desc'] = htmlspecialchars_decode($v['desc']);
            }
        }
        return $this->formateResponse(1000, '获取我发布的服务信息成功', $service);

    }


    
    public function goodsOrderList(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $type = $request->get('type');
        if (!$type) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $domain = url();
        $myGoods = array();

        if ($type == 1) {
            $status = $request->get('goods_status') ? $request->get('goods_status') : 0;
            $merge['type'] = $status;
            
            $myGoods = ShopOrderModel::myBuyGoods($tokenInfo['uid'], 2, $merge,10)->toArray();
            if (!empty($myGoods['data'])) {
                foreach ($myGoods['data'] as $k => $v) {
                    $myGoods['data'][$k] = array_except($v, array('code', 'uid', 'object_type',
                        'note', 'invoice_status', 'trade_rate', 'desc', 'cover'));
                    switch ($v['status']) {
                        case 0:
                            $ss = '待付款';
                            break;
                        case 1:
                            $ss = '已付款';
                            break;
                        case 2:
                            $ss = '交易完成';
                            break;
                        case 3:
                            $ss = '维权处理';
                            break;
                        case 4:
                            $ss = '交易完成';
                            break;
                        case 5:
                            $ss = '维权结束';
                            break;
                        default:
                            $ss = '交易完成';
                            break;
                    }
                    switch ($v['unit']) {
                        case 0:
                            $unit = '件';
                            break;
                        case 1:
                            $unit = '时';
                            break;
                        case 2:
                            $unit = '份';
                            break;
                        case 3:
                            $unit = '个';
                            break;
                        case 4:
                            $unit = '张';
                            break;
                        case 5:
                            $unit = '套';
                            break;
                        default:
                            $unit = '件';
                            break;
                    }
                    $cateName = isset($v['cate_name']) ? $v['cate_name'] : '';
                    $myGoods['data'][$k]['cate_name'] = $cateName;
                    $myGoods['data'][$k]['unit'] = $unit;
                    $myGoods['data'][$k]['status'] = $ss;
                    $myGoods['data'][$k]['status_num'] = $v['status'];
                    $myGoods['data'][$k]['img'] = $domain . '/' . $v['cover'];

                }
            }
        } elseif ($type == 2) {
            $status = ($request->get('service_status') || $request->get('service_status') == 0) ? $request->get('service_status') : 'all';
            $data['status'] = $status;
            
            $employ = new EmployModel();
            $myGoods = $employ->employMine($tokenInfo['uid'], $data,10)->toArray();
            if (!empty($myGoods['data'])) {
                foreach ($myGoods['data'] as $k => $v) {
                    $myGoods['data'][$k] = array_except($v, array('desc', 'phone', 'bounty', 'bounty_status',
                        'delivery_deadline', 'employee_uid', 'employer_uid', 'employed_at', 'employ_percentage', 'seo_title',
                        'seo_keywords', 'seo_content', 'cancel_at', 'except_max_at',
                        'end_at', 'begin_at', 'accept_deadline', 'accept_at', 'right_allow_at', 'comment_deadline',
                        'updated_at', 'user_name', 'avatar'));
                    switch ($v['status']) {
                        case 0:
                            $ss = '待受理';
                            break;
                        case 1:
                            $ss = '工作中';
                            break;
                        case 2:
                            $ss = '验收中';
                            break;
                        case 3:
                            $ss = '待评价';
                            break;
                        case 4:
                            $ss = '交易完成';
                            break;
                        case 5:
                            $ss = '拒绝雇佣';
                            break;
                        case 6:
                            $ss = '取消任务';
                            break;
                        case 7:
                            $ss = '雇主维权';
                            break;
                        case 8:
                            $ss = '威客维权';
                            break;
                        case 9:
                            $ss = '雇佣过期';
                            break;
                        default:
                            $ss = '待受理';
                            break;
                    }
                    $myGoods['data'][$k]['status'] = $ss;
                    $myGoods['data'][$k]['status_num'] = $v['status'];
                    $myGoods['data'][$k]['cash'] = $v['bounty'];
                    $myGoods['data'][$k]['img'] = $domain . '/' . $v['avatar'];
                }
            }
        }
        return $this->formateResponse(1000, '获取我购买的订单列表成功', $myGoods);

    }


    
    public function saleOrderList(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $type = $request->get('type');
        if (!$type) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $domain = url();
        $myGoods = array();

        if ($type == 1) {
            $status = $request->get('goods_status') ? $request->get('goods_status') : 0;
            $merge['type'] = $status;
            
            $myGoods = ShopOrderModel::sellGoodsList($tokenInfo['uid'], 2, $merge,10)->toArray();
            if (!empty($myGoods['data'])) {
                foreach ($myGoods['data'] as $k => $v) {
                    $myGoods['data'][$k] = array_except($v, array('code', 'uid', 'object_id', 'object_type',
                        'note', 'invoice_status', 'trade_rate', 'desc', 'object_id', 'cover'));
                    switch ($v['status']) {
                        case 0:
                            $ss = '待付款';
                            break;
                        case 1:
                            $ss = '已付款';
                            break;
                        case 2:
                            $ss = '交易完成';
                            break;
                        case 3:
                            $ss = '维权处理';
                            break;
                        case 4:
                            $ss = '交易完成';
                            break;
                        case 5:
                            $ss = '维权结束';
                            break;
                        default:
                            $ss = '交易完成';
                            break;
                    }
                    switch ($v['unit']) {
                        case 0:
                            $unit = '件';
                            break;
                        case 1:
                            $unit = '时';
                            break;
                        case 2:
                            $unit = '份';
                            break;
                        case 3:
                            $unit = '个';
                            break;
                        case 4:
                            $unit = '张';
                            break;
                        case 5:
                            $unit = '套';
                            break;
                        default:
                            $unit = '件';
                            break;
                    }
                    $cateName = isset($v['cate_name']) ? $v['cate_name'] : '';
                    $myGoods['data'][$k]['cate_name'] = $cateName;
                    $myGoods['data'][$k]['unit'] = $unit;
                    $myGoods['data'][$k]['status'] = $ss;
                    $myGoods['data'][$k]['status_num'] = $v['status'];
                    $myGoods['data'][$k]['avatar'] = $domain . '/' . $v['avatar'];

                }
            }
        } elseif ($type == 2) {
            $status = ($request->get('service_status') || $request->get('service_status') == 0) ? $request->get('service_status') : 'all';
            $data['status'] = $status;
            
            $myGoods = EmployModel::employMyJob($tokenInfo['uid'], $data,10)->toArray();

            if (!empty($myGoods['data'])) {
                foreach ($myGoods['data'] as $k => $v) {
                    $myGoods['data'][$k] = array_except($v, array('desc', 'phone', 'bounty', 'bounty_status',
                        'delivery_deadline', 'employee_uid', 'employer_uid', 'employed_at', 'employ_percentage', 'seo_title',
                        'seo_keywords', 'seo_content', 'cancel_at', 'except_max_at',
                        'end_at', 'begin_at', 'accept_deadline', 'accept_at', 'right_allow_at', 'comment_deadline',
                        'updated_at', 'avatar'));
                    switch ($v['status']) {
                        case 0:
                            $ss = '待受理';
                            break;
                        case 1:
                            $ss = '工作中';
                            break;
                        case 2:
                            $ss = '验收中';
                            break;
                        case 3:
                            $ss = '待评价';
                            break;
                        case 4:
                            $ss = '交易完成';
                            break;
                        case 5:
                            $ss = '拒绝雇佣';
                            break;
                        case 6:
                            $ss = '取消任务';
                            break;
                        case 7:
                            $ss = '雇主维权';
                            break;
                        case 8:
                            $ss = '威客维权';
                            break;
                        case 9:
                            $ss = '雇佣过期';
                            break;
                        default:
                            $ss = '待受理';
                            break;
                    }
                    $myGoods['data'][$k]['status'] = $ss;
                    $myGoods['data'][$k]['status_num'] = $v['status'];
                    $myGoods['data'][$k]['cash'] = $v['bounty'];
                    $myGoods['data'][$k]['avatar'] = $domain . '/' . $v['avatar'];
                }
            }
        }
        return $this->formateResponse(1000, '获取我卖出的订单列表成功', $myGoods);

    }


    
    public function buyGoodsDetail(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('order_id')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $id = $request->get('order_id');
        
        $order = ShopOrderModel::where('shop_order.id', $id)->where('shop_order.object_type', 2)
            ->leftJoin('goods', 'goods.id', '=', 'shop_order.object_id')
            ->select('shop_order.id', 'shop_order.uid as buy_uid', 'shop_order.cash', 'shop_order.status',
                'goods.id as goods_id', 'goods.unit', 'goods.title', 'goods.sales_num','goods.cover',
                'goods.uid', 'goods.shop_id')->first();
        $domain = \CommonClass::getDomain();
        if (!empty($order)) {
            if ($order->buy_uid != $uid) {
                return $this->formateResponse(1001, '参数错误');
            }
            $provinceN = '';
            $cityN = '';
            
            $shopInfo = ShopModel::where('id', $order->shop_id)->where('uid', $order->uid)->first();
            if (!empty($shopInfo)) {
                $province = DistrictModel::where('id', $shopInfo->province)->first();
                if (!empty($province)) {
                    $provinceN = $province->name;
                }
                $city = DistrictModel::where('id', $shopInfo->city)->first();
                if (!empty($city)) {
                    $cityN = $city->name;
                }
            }
            $order->address = $provinceN . $cityN;
            $order->cover = $domain . '/' . $order->cover;
            
            $user = UserModel::where('id',$order->uid)->first();
            if(!empty($user)){
                $order->username = $user->name;
            }else{
                $order->username = '';
            }
            $order = $order->toArray();
            switch ($order['unit']) {
                case 0:
                    $unit = '件';
                    break;
                case 1:
                    $unit = '时';
                    break;
                case 2:
                    $unit = '份';
                    break;
                case 3:
                    $unit = '个';
                    break;
                case 4:
                    $unit = '张';
                    break;
                case 5:
                    $unit = '套';
                    break;
                default:
                    $unit = '件';
                    break;
            }
            $order['unit'] = $unit;
            switch ($order['status']) {
                case 0:
                    $buttonStatus = '等待支付';
                    break;
                case 1:
                    $buttonStatus = '处理作品';
                    break;
                case 2:
                    $buttonStatus = '给予评价';
                    break;
                case 3:
                    $buttonStatus = '维权中';
                    break;
                case 4:
                    $buttonStatus = '查看评价';
                    break;
                case 5:
                    $buttonStatus = '等待支付';
                    break;
                default:
                    $buttonStatus = '等待支付';
                    break;
            }
            $order['button_status'] = $buttonStatus;
            if (in_array($order['status'], [1, 2, 3, 4])) {
                
                $workAtt = UnionAttachmentModel::where('object_type', 4)
                    ->where('object_id', $order['goods_id'])
                    ->select('attachment_id')->get()->toArray();
                $order['attachment'] = array();
                if (!empty($workAtt)) {
                    
                    $workId = array_flatten($workAtt);
                    if (!empty($workId)) {
                        
                        $order['attachment'] = AttachmentModel::whereIn('id', $workId)->get()->toArray();
                        if (!empty($order['attachment'])) {
                            foreach ($order['attachment'] as $k => $v) {
                                $order['attachment'][$k]['url'] = $domain . '/' . $v['url'];
                            }
                        }
                    }
                }
            } else {
                $order['attachment'] = array();
            }
            return $this->formateResponse(1000, '我购买作品的订单详情成功', $order);
        } else {
            return $this->formateResponse(1001, '参数错误');
        }
    }

    
    public function saleGoodsDetail(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('order_id')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $id = $request->get('order_id');
        
        $order = ShopOrderModel::where('shop_order.id', $id)->where('shop_order.object_type', 2)
            ->leftJoin('goods', 'goods.id', '=', 'shop_order.object_id')
            ->select('shop_order.id', 'shop_order.uid as buy_uid', 'shop_order.cash', 'shop_order.status',
                'goods.id as goods_id', 'goods.unit', 'goods.title', 'goods.sales_num','goods.cover',
                'goods.uid', 'goods.shop_id')->first();
        $domain = \CommonClass::getDomain();
        if (!empty($order)) {
            if ($order->uid != $uid) {
                return $this->formateResponse(1001, '参数错误');
            }
            $provinceN = '';
            $cityN = '';
            
            $shopInfo = ShopModel::where('id', $order->shop_id)->where('uid', $order->uid)->first();
            if (!empty($shopInfo)) {
                $province = DistrictModel::where('id', $shopInfo->province)->first();
                if (!empty($province)) {
                    $provinceN = $province->name;
                }
                $city = DistrictModel::where('id', $shopInfo->city)->first();
                if (!empty($city)) {
                    $cityN = $city->name;
                }
            }
            $order->address = $provinceN . $cityN;
            $order->cover = $domain . '/' . $order->cover;
            $order = $order->toArray();
            
            $user = UserModel::where('users.id', $order['buy_uid'])->leftJoin('user_detail', 'user_detail.uid', '=', 'users.id')
                ->select('users.name', 'user_detail.avatar')->first();
            if (!empty($user)) {
                $order['username'] = $user->name;
                $order['avatar'] = $domain . '/' . $user->avatar;
            }
            switch ($order['unit']) {
                case 0:
                    $unit = '件';
                    break;
                case 1:
                    $unit = '时';
                    break;
                case 2:
                    $unit = '份';
                    break;
                case 3:
                    $unit = '个';
                    break;
                case 4:
                    $unit = '张';
                    break;
                case 5:
                    $unit = '套';
                    break;
                default:
                    $unit = '件';
                    break;
            }
            $order['unit'] = $unit;
            
            $comment = GoodsCommentModel::where('goods_id', $order['goods_id'])->where('uid', $order['buy_uid'])->first();
            if (!empty($comment)) {
                $order['comment'] = $comment;
            } else {
                $order['comment'] = [];
            }
            return $this->formateResponse(1000, '我卖出作品的订单详情成功', $order);
        } else {
            return $this->formateResponse(1001, '参数错误');
        }
    }

    
    public function confirmGoods(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('order_id')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $id = $request->get('order_id');
        
        $orderInfo = ShopOrderModel::where('id', $id)->where('object_type', 2)->first();
        if (empty($orderInfo)) {
            return $this->formateResponse(1001, '参数错误');
        }
        $res = ShopOrderModel::confirmGoods($id, $uid);
        if ($res) {
            return $this->formateResponse(1000, '验收成功');
        } else {
            return $this->formateResponse(1001, '网络错误');
        }

    }

    
    public function rightGoods(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('order_id') || !$request->get('type') || !$request->get('desc')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $id = $request->get('order_id');
        $type = $request->get('type');
        $desc = $request->get('desc');
        
        $orderInfo = ShopOrderModel::where('id', $id)->where('object_type', 2)->first();
        if (empty($orderInfo)) {
            return $this->formateResponse(1001, '参数错误');
        }
        if (!empty($orderInfo)) {
            
            $goodsInfo = GoodsModel::where('id', $orderInfo->object_id)->first();
            if (!empty($goodsInfo)) {
                $toUid = $goodsInfo->uid;
            } else {
                $toUid = '';
            }
        } else {
            $toUid = '';
        }

        $rightsArr = array(
            'type' => $type,
            'object_id' => $id,
            'object_type' => 2,
            'desc' => $desc,
            'status' => 0,
            'from_uid' => $uid,
            'to_uid' => $toUid,
            'created_at' => date('Y-m-d H:i:s')
        );
        $res = UnionRightsModel::buyGoodsRights($rightsArr, $id);
        if ($res) {
            return $this->formateResponse(1000, '维权信息提交成功');
        } else {
            return $this->formateResponse(1001, '维权信息提交失败');
        }

    }

    
    public function commentGoods(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('order_id') || !$request->get('type') || !$request->get('desc') || !$request->get('speed_score') || !$request->get('quality_score') || !$request->get('attitude_score')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $id = $request->get('order_id');
        
        $orderInfo = ShopOrderModel::where('id', $id)->where('status', 2)->where('object_type', 2)->first()
;
        if (empty($orderInfo)) {
            return $this->formateResponse(1001, '参数错误');
        }
        $commentArr = array(
            'uid' => $uid,
            'goods_id' => $orderInfo['object_id'],
            'type' => $request->get('type'),
            'speed_score' => $request->get('speed_score'),
            'quality_score' => $request->get('quality_score'),
            'attitude_score' => $request->get('attitude_score'),
            'comment_desc' => $request->get('desc'),
            'created_at' => date('Y-m-d H:i:s'),
            'comment_by' => 1,
        );
        $res = GoodsCommentModel::createGoodsComment($commentArr, $orderInfo);
        if ($res) {
            return $this->formateResponse(1000, '评论提交成功');
        } else {
            return $this->formateResponse(1001, '网络错误');
        }

    }

    
    public function getComment(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('order_id')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $id = $request->get('order_id');
        
        $orderInfo = ShopOrderModel::where('id', $id)->where('object_type', 2)->first();
        if (empty($orderInfo)) {
            return $this->formateResponse(1001, '参数错误');
        }
        $res = GoodsCommentModel::where('uid',$uid)->where('goods_id',$orderInfo->object_id)->first();
        if ($res) {
            
            $user = UserModel::where('users.id',$uid)->leftJoin('user_detail','user_detail.uid','=','users.id')
                ->select('users.name','user_detail.avatar')->first();
            $domain = \CommonClass::getDomain();
            if($user){
                $res->name = $user->name;
                $res->avatar = $domain.'/'.$user->avatar;
            }else{
                $res->name = '';
                $res->avatar = '';
            }
            $res = $res->toArray();
            return $this->formateResponse(1000, '获取评论信息成功',$res);
        } else {
            return $this->formateResponse(1001, '没有评论信息');
        }

    }

    
    public function buyGoods(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('goods_id')) {
            return $this->formateResponse(1001, '缺少参数');
        }

        $goodsId = $request->get('goods_id');

        
        $goods = GoodsModel::where('id',$goodsId)->first()->toArray();
        if(empty($goods)){
            return $this->formateResponse(1001, '参数错误');
        }
        
        $tradeRateArr = ConfigModel::getConfigByAlias('trade_rate');
        if ($tradeRateArr) {
            $tradeRate = $tradeRateArr->rule;
        } else {
            $tradeRate = 0;
        }
        
        $order = ShopOrderModel::where('uid', $uid)->where('object_id', $goodsId)
            ->where('object_type', 2)->where('status', 0)->first();
        if (empty($order)) {
            $arr = array(
                'code' => ShopOrderModel::randomCode($uid, 'bg'),
                'title' => '购买作品' . $goods['title'],
                'uid' => $uid,
                'object_id' => $goodsId,
                'object_type' => 2, 
                'cash' => $goods['cash'],
                'status' => 0, 
                'created_at' => date('Y-m-d H:i:s', time()),
                'trade_rate' => $tradeRate
            );
            
            $re = ShopOrderModel::isBuy($uid, $goodsId, 2);
            if ($goods['uid'] == $uid) {
                return $this->formateResponse(1001, '您是商品发布人，无需购买');
            } else if ($goods['status'] != 1) {
                return $this->formateResponse(1001, '该商品已经失效');
            } else {
                if ($re == false) {
                    
                    $res = ShopOrderModel::create($arr);
                    if ($res) {
                        $data = array(
                            'order_id' => $res->id
                        );
                        return $this->formateResponse(1000, '订单生成成功',$data);
                    } else {
                        return $this->formateResponse(1000, '网络错误');
                    }
                } else {
                    return $this->formateResponse(1001, '已经购买该商品，无需继续购买');
                }
            }
        } else {
            $data = array(
                'order_id' => $order->id
            );
            return $this->formateResponse(1000, '订单生成成功',$data);
        }
    }

    
    public function cashPayGoods(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'pay_type' => 'required',
            'password' => 'required'
        ], [
            'order_id.required' => '作品订单id不能为空',
            'pay_type.required' => '请选择支付方式',
            'password.required' => '请输入支付密码'
        ]);
        $error = $validator->errors()->all();
        if (count($error)) {
            return $this->formateResponse(1001,$error[0], $error);
        }
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $data = array(
            'order_id' => $request->get('order_id'),
            'pay_type' => $request->get('pay_type'),
            'password' => $request->get('password')
        );

        
        $order = ShopOrderModel::where('id', $data['order_id'])->first();

        
        if ($order['uid'] != $tokenInfo['uid'] || $order['status'] != 0) {
            return $this->formateResponse(1001, '该作品已购买');
        }

        
        $balance = UserDetailModel::where('uid', $tokenInfo['uid'])->first();
        $balance = $balance['balance'];


        
        if ($balance >= $order['cash'] && $data['pay_type'] == 0) {
            
            $user = UserModel::where('id', $tokenInfo['uid'])->first();
            $password = UserModel::encryptPassword($data['password'], $user['salt']);
            if ($password != $user['alternate_password']) {
                return $this->formateResponse(1001, '您的支付密码不正确');
            }
            
            $res = ShopOrderModel::buyShopGoods($tokenInfo['uid'], $data['order_id']);
            if ($res) {
                
                $goodsInfo = GoodsModel::where('id', $order->object_id)->first();
                
                $salesNum = intval($goodsInfo->sales_num + 1);
                GoodsModel::where('id', $goodsInfo->id)->update(['sales_num' => $salesNum]);
                return $this->formateResponse(1000, '支付成功');
            } else {
                return $this->formateResponse(1001, '支付失败，请重新支付');
            }
        } else {
            return $this->formateResponse(1001, '余额不足，请充值或切换支付方式');
        }
    }

    
    public function ThirdCashGoodsPay(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if ($request->get('order_id')) {
            
            $order = ShopOrderModel::where('id', $request->get('order_id'))->where('status', 0)->first();
        } else {
            return $this->formateResponse(1001, '缺少参数');
        }

        if ($order) {
            
            if ($order->uid != $uid) {
                return $this->formateResponse(1001, '非法操作');
            }
            $payType = $request->get('pay_type');
            switch ($payType) {
                case 'alipay':
                    $alipay = app('alipay.mobile');
                    $alipay->setNotifyUrl(url('api/alipay/notify'));
                    $alipay->setOutTradeNo($order->code);
                    $alipay->setTotalFee($order->cash);
                    $alipay->setSubject($order->title);
                    $alipay->setBody($order->note);
                    return $this->formateResponse(1000, '确认支付', ['payParam' => $alipay->getPayPara()]);
                    break;
                case 'wechat':
                    $gateway = Omnipay::gateway('WechatPay');
                    $gateway->setNotifyUrl(url('api/wechatpay/notify'));
                    $data = [
                        'body' => $order->title,
                        'out_trade_no' => $order->code,
                        'total_fee' => $order->cash * 100, 
                        'spbill_create_ip' => Input::getClientIp(),
                        'fee_type' => 'CNY'
                    ];
                    $request = $gateway->purchase($data);
                    $response = $request->send();
                    if ($response->isSuccessful()) {
                        return $this->formateResponse(1000, '确认支付', ['params' => $response->getAppOrderData()]);
                    }
                    break;
            }
        } else {
            return $this->formateResponse(1001, '订单不存在或已经支付');
        }
    }

}
