<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Employ\Models\EmployGoodsModel;
use App\Modules\Employ\Models\EmployModel;
use App\Modules\Employ\Models\UnionRightsModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\Manage\Model\ServiceModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\Vipshop\Models\ShopPackageModel;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('店铺管理');
        $this->theme->set('manageType', 'auth');
    }

    
    public function shopList(Request $request)
    {
        $merge = $request->all();
        $shopList = ShopModel::whereRaw('1 = 1');

        
        if ($request->get('name')) {
            $shopList = $shopList->where('users.name', $request->get('name'));
        }
        
        if ($request->get('shop_name')) {
            $shopList = $shopList->where('shop.shop_name', 'like', '%' . $request->get('shop_name') . '%');
        }
        
        if ($request->get('status')) {
            switch ($request->get('status')) {
                case 1:
                    $status = 1;
                    break;
                case 2:
                    $status = 2;
                    break;
                default:
                    $status = 0;
            }
            $shopList = $shopList->where('shop.status', $status);
        }
        $by = $request->get('by') ? $request->get('by') : 'shop.id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;

        $shopList = $shopList->leftJoin('users', 'users.id', '=', 'shop.uid')
            ->select('shop.*', 'users.name')
            ->orderBy($by, $order)->paginate($paginate);
        if ($shopList) {
            $ShopId = array();
            foreach ($shopList as $k => $v) {
                $ShopId[] = $v['id'];
            }
            
            $goods = GoodsModel::whereIn('shop_id', $ShopId)->where('type', 1)->orderBy('shop_id')
                ->select('id', 'shop_id')->get()->toArray();
            if (!empty($goods)) {
                
                $newGoods = array_reduce($goods, function (&$newGoods, $v) {
                    $newGoods[$v['shop_id']][] = $v;
                    return $newGoods;
                });
                $newGoodsCount = array();
                if (!empty($newGoods)) {
                    foreach ($newGoods as $a => $b) {
                        $newGoodsCount[$a]['shop_id'] = $a;
                        $newGoodsCount[$a]['count'] = count($b);
                    }
                }
            } else {
                $newGoodsCount = array();
            }
            
            $service = GoodsModel::whereIn('shop_id', $ShopId)->where('type', 2)->orderBy('shop_id')
                ->select('id', 'shop_id')->get()->toArray();
            if (!empty($service)) {
                
                $newService = array_reduce($service, function (&$newService, $v) {
                    $newService[$v['shop_id']][] = $v;
                    return $newService;
                });
                $newServiceCount = array();
                if (!empty($newService)) {
                    foreach ($newService as $a => $b) {
                        $newServiceCount[$a]['shop_id'] = $a;
                        $newServiceCount[$a]['count'] = count($b);
                    }
                }
            } else {
                $newServiceCount = array();
            }
            foreach ($shopList as $k => $v) {
                
                if (!empty($newGoodsCount)) {
                    foreach ($newGoodsCount as $a => $b) {
                        if ($v['id'] == $b['shop_id']) {
                            $shopList[$k]['goods_num'] = $b['count'];
                        }
                    }
                } else {
                    $shopList[$k]['goods_num'] = 0;
                }
                
                if (!empty($newServiceCount)) {
                    foreach ($newServiceCount as $a => $b) {
                        if ($v['id'] == $b['shop_id']) {
                            $shopList[$k]['service_num'] = $b['count'];
                        }
                    }
                } else {
                    $shopList[$k]['service_num'] = 0;
                }
            }
        }
        $data = array(
            'merge' => $merge,
            'shop' => $shopList,
        );
        $this->theme->setTitle('店铺信息');
        return $this->theme->scope('manage.shoplist', $data)->render();
    }


    
    public function shopInfo($id)
    {
        $id = intval($id);
        
        $preId = ShopModel::where('id', '>', $id)->min('id');
        
        $nextId = ShopModel::where('id', '<', $id)->max('id');
        $shopInfo = ShopModel::getShopInfoById($id,1);
        $data = array(
            'shop_info' => $shopInfo,
            'pre_id' => $preId,
            'next_id' => $nextId
        );
        $this->theme->setTitle('店铺详情');
        return $this->theme->scope('manage.shopinfo', $data)->render();
    }

    
    public function updateShopInfo(Request $request)
    {
        $data = $request->except('_token');
        $data['seo_desc'] = trim($data['seo_desc']);
        $res = ShopModel::where('id', $data['id'])->update($data);
        if ($res) {
            return redirect('/manage/shopInfo/' . $data['id'])->with(array('message' => '操作成功'));
        }
        return redirect('/manage/shopInfo/' . $data['id'])->with(array('message' => '操作失败'));
    }

    
    public function openShop($id)
    {
        $id = intval($id);
        
        $shopInfo = ShopModel::where('id', $id)->first();
        if ($shopInfo->status == 2) {
            $arr = array(
                'status' => 1,
            );
            $res = ShopModel::where('id', $id)->update($arr);
            UserDetailModel::where('uid',$shopInfo->uid)->update(['shop_status' => 1]);
            if ($res) {
                return redirect('/manage/shopList')->with(array('message' => '操作成功'));
            } else {
                return redirect('/manage/shopList')->with(array('message' => '操作失败'));
            }
        } else {
            return redirect('/manage/shopList')->with(array('message' => '操作成功'));
        }

    }

    
    public function closeShop($id)
    {
        $id = intval($id);
        
        $shopInfo = ShopModel::where('id', $id)->first();
        if ($shopInfo->status == 1) {
            $arr = array(
                'status' => 2,
                'is_recommend' => 0
            );
            $res = ShopModel::where('id', $id)->update($arr);
            UserDetailModel::where('uid',$shopInfo->uid)->update(['shop_status' => 2]);
            if ($res) {
                return redirect('/manage/shopList')->with(array('message' => '操作成功'));
            } else {
                return redirect('/manage/shopList')->with(array('message' => '操作失败'));
            }
        } else {
            return redirect('/manage/shopList')->with(array('message' => '操作成功'));
        }
    }

    
    public function allOpenShop(Request $request)
    {
        $ids = $request->get('ids');
        $idArr = explode(',', $ids);
        $res = ShopModel::AllShopOpen($idArr);
        if ($res) {
            $data = array(
                'code' => 1,
                'msg' => '操作成功'
            );
        } else {
            $data = array(
                'code' => 0,
                'msg' => '操作失败'
            );
        }
        return response()->json($data);
    }

    
    public function allCloseShop(Request $request)
    {
        $ids = $request->get('ids');
        $idArr = explode(',', $ids);
        $res = ShopModel::AllShopClose($idArr);
        if ($res) {
            $data = array(
                'code' => 1,
                'msg' => '操作成功'
            );
        } else {
            $data = array(
                'code' => 0,
                'msg' => '操作失败'
            );
        }
        return response()->json($data);
    }

    
    public function recommendShop($id)
    {
        $id = intval($id);
        
        $shop = ShopModel::where('id', $id)->first();
        if ($shop->status == 1) {
            $arr = array(
                'is_recommend' => 1
            );
            $res = ShopModel::where('id', $id)->update($arr);
            if ($res) {
                return redirect('/manage/shopList')->with(array('message' => '操作成功'));
            } else {
                return redirect('/manage/shopList')->with(array('message' => '操作失败'));
            }
        } else {
            return redirect('/manage/shopList')->with(array('message' => '操作失败'));
        }
    }

    
    public function removeRecommendShop($id)
    {
        $id = intval($id);
        
        $shop = ShopModel::where('id', $id)->first();
        if ($shop->status == 1) {
            $arr = array(
                'is_recommend' => 0
            );
            $res = ShopModel::where('id', $id)->update($arr);
            if ($res) {
                return redirect('/manage/shopList')->with(array('message' => '操作成功'));
            } else {
                return redirect('/manage/shopList')->with(array('message' => '操作失败'));
            }
        } else {
            return redirect('/manage/shopList')->with(array('message' => '操作失败'));
        }
    }

    
    public function shopConfig()
    {
        $shopConfig = ConfigModel::getConfigByType('shop_config');
        
        $goodsService = ServiceModel::where('identify','ZUOPINTUIJIAN')->first();
        
        $service = ServiceModel::where('identify','FUWUTUIJIAN')->first();
        $data = array(
            'shop_config' => $shopConfig,
            'goods_service' => $goodsService,
            'service' => $service,
        );
        $this->theme->setTitle('店铺配置');
        return $this->theme->scope('manage.shopconfig', $data)->render();
    }

    
    public function postShopConfig(Request $request)
    {
        $data = $request->all();
        $configData = array(
            'goods_check' => $data['goods_check'],
            'service_check' => $data['service_check'],
            'recommend_goods_unit' => $data['goods_unit'],
            'recommend_service_unit' => $data['service_unit']
        );
        ConfigModel::updateConfig($configData);
        Cache::forget('shop_config');
        
        ServiceModel::where('identify','ZUOPINTUIJIAN')
            ->update(['price'=>$data['recommend_goods_price'],'status' => $data['is_goods_recommend']]);
        
        ServiceModel::where('identify','FUWUTUIJIAN')
            ->update(['price'=>$data['recommend_service_price'],'status' => $data['is_service_recommend']]);

        return redirect('/manage/shopConfig')->with(array('message' => '操作成功'));
    }

    
    public function rightsList(Request $request)
    {
        $merge = $request->all();
        $rightsList = UnionRightsModel::whereRaw('1 = 1')->where('is_delete',0);
        
        if ($request->get('username')) {
            $rightsList = $rightsList->where('users.name', 'like', '%' . $request->get('username') . '%');
        }
        
        if ($request->get('reportType') && $request->get('reportType') != 0) {
            $rightsList = $rightsList->where('union_rights.type', $request->get('reportType'));
        }
        
        if ($request->get('objectType') && $request->get('objectType') != 0) {
            $rightsList = $rightsList->where('union_rights.object_type', $request->get('objectType'));
        }
        
        if ($request->get('reportStatus') && $request->get('reportStatus') != 0) {
            switch ($request->get('reportStatus')) {
                case 1:
                    $status = 1;
                    $rightsList = $rightsList->where('union_rights.status', $status);
                    break;
                case 2:
                    $status = 0;
                    $rightsList = $rightsList->where('union_rights.status', $status);
                    break;
                case 3:
                    $status = 2;
                    $rightsList = $rightsList->where('union_rights.status', $status);
                    break;
            }
        }
        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $rightsList = $rightsList->where('union_rights.created_at', '>',$start);
        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $rightsList = $rightsList->where('union_rights.created_at', '<',$end);
        }
        $by = $request->get('by') ? $request->get('by') : 'union_rights.id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;

        $rightsList = $rightsList->leftJoin('users', 'users.id', '=', 'union_rights.from_uid')
            ->select('union_rights.*', 'users.name')
            ->orderBy($by, $order)->paginate($paginate);
        if (!empty($rightsList)) {
            $goodsId = array();
            $employId = array();
            foreach ($rightsList as $k => $v) {
                if ($v->object_type == 2) {
                    $goodsId[] = $v->object_id;
                } elseif ($v->object_type == 1) {
                    $employId[] = $v->object_id;
                }
            }
            if (!empty($goodsId)) {
                $goods = ShopOrderModel::whereIn('id', $goodsId)->select('id', 'title')->get();
            } else {
                $goods = array();
            }
            if (!empty($employId)) {
                $employ = EmployModel::whereIn('id', $employId)->select('id', 'title')->get();
            } else {
                $employ = array();
            }
            foreach ($rightsList as $k => $v) {
                if (!empty($goods)) {
                    foreach ($goods as $a => $b) {
                        if ($v->object_id == $b->id) {
                            $v->title = $b->title;
                        }
                    }
                }

                if (!empty($employ)) {
                    foreach ($employ as $a => $b) {
                        if ($v->object_id == $b->id) {
                            $v->title = $b->title;
                        }
                    }
                }
            }
        }

        $data = array(
            'merge' => $merge,
            'rights_list' => $rightsList,
        );
        $this->theme->setTitle('交易维权');
        return $this->theme->scope('manage.rightslist', $data)->render();
    }

    
    public function shopRightsInfo($id)
    {
        $id = intval($id);
        
        $preId = UnionRightsModel::where('id', '>', $id)->min('id');
        
        $nextId = UnionRightsModel::where('id', '<', $id)->max('id');
        $rightsInfo = UnionRightsModel::rightsInfoById($id);

        $employ = [];
        if($rightsInfo['object_type']==1)
        {
            
            $employ = EmployModel::where('id',$rightsInfo['object_id'])->first();
        }
        $data = array(
            'rights_info' => $rightsInfo,
            'pre_id' => $preId,
            'next_id' => $nextId,
            'employ'=>$employ
        );
        $this->theme->setTitle('交易维权详情');
        return $this->theme->scope('manage.rightsinfo', $data)->render();
    }

    
    public function download($id)
    {
        $pathToFile = AttachmentModel::where('id', $id)->first();
        $pathToFile = $pathToFile['url'];
        return response()->download($pathToFile);
    }


    
    public function ShopRightsSuccess(Request $request,$id)
    {
        $id = intval($id);
        $rightsInfo = UnionRightsModel::rightsInfoById($id);
        $shopOrder = ShopOrderModel::where('id',$rightsInfo->object_id)->first();
        $fromPrice = $shopOrder->cash;
        $domain = \CommonClass::getDomain();
        
        if($rightsInfo->object_type == 2){
            $status = UnionRightsModel::dealGoodsRights($id,$fromPrice);
            if($status){
                $shopRightsTem = MessageTemplateModel::where('code_name','shop_rights')
                    ->where('is_open',1)->where('is_on_site',1)->first();
                if($shopRightsTem){
                    $siteName = \CommonClass::getConfig('site_name');
                    
                    $fromNewArr = array(
                        'username' => $rightsInfo->from_name,
                        'href' => $domain.'/shop/buyGoods/'.$shopOrder->object_id,
                        'trade_name' => $rightsInfo->title,
                        'content' => '维权成立，您获得金额为'.$fromPrice.'元',
                        'website' => $siteName

                    );
                    $fromMessageContent = MessageTemplateModel::sendMessage('shop_rights',$fromNewArr);
                    $messageFrom = [
                        'message_title'=>$shopRightsTem['name'],
                        'code'=>'trading_rights_result',
                        'message_content'=>$fromMessageContent,
                        'js_id'=>$rightsInfo->from_uid,
                        'message_type'=>2,
                        'receive_time'=>date('Y-m-d H:i:s',time()),
                        'status'=>0,
                    ];
                    MessageReceiveModel::create($messageFrom);
                    
                    $toNewArr = array(
                        'username' => $rightsInfo->to_name,
                        'href' => $domain.'/shop/buyGoods/'.$shopOrder->object_id,
                        'trade_name' => $rightsInfo->title,
                        'content' => '维权成立，您获得金额为0元',
                        'website' => $siteName

                    );
                    $toMessageContent = MessageTemplateModel::sendMessage('shop_rights',$toNewArr);
                    $messageTo = [
                        'message_title'=>$shopRightsTem['name'],
                        'code'=>'trading_rights_result',
                        'message_content'=>$toMessageContent,
                        'js_id'=>$rightsInfo->to_uid,
                        'message_type'=>2,
                        'receive_time'=>date('Y-m-d H:i:s',time()),
                        'status'=>0,
                    ];
                    MessageReceiveModel::create($messageTo);
                }
            }
        }
        return redirect('/manage/shopRightsInfo/'.$id);

    }

    
    public function ShopRightsFailure($id)
    {
        $id = intval($id);
        $rightsInfo = UnionRightsModel::rightsInfoById($id);
        $shopOrder = ShopOrderModel::where('id',$rightsInfo->object_id)->first();
        $domain = \CommonClass::getDomain();
        if($rightsInfo->object_type == 2){
            $status = UnionRightsModel::dealGoodsRightsFailure($id);
            if($status){
                $shopRightsTem = MessageTemplateModel::where('code_name','shop_rights')
                    ->where('is_open',1)->where('is_on_site',1)->first();
                if($shopRightsTem){
                    $siteName = \CommonClass::getConfig('site_name');
                    
                    $fromNewArr = array(
                        'username' => $rightsInfo->from_name,
                        'href' => $domain.'/shop/buyGoods/'.$shopOrder->object_id,
                        'trade_name' => $rightsInfo->title,
                        'content' => '维权不成立',
                        'website' => $siteName

                    );
                    $fromMessageContent = MessageTemplateModel::sendMessage('shop_rights',$fromNewArr);
                    $messageFrom = [
                        'message_title'=>$shopRightsTem['name'],
                        'code'=>'trading_rights_result',
                        'message_content'=>$fromMessageContent,
                        'js_id'=>$rightsInfo->from_uid,
                        'message_type'=>2,
                        'receive_time'=>date('Y-m-d H:i:s',time()),
                        'status'=>0,
                    ];
                    MessageReceiveModel::create($messageFrom);
                    
                    $toNewArr = array(
                        'username' => $rightsInfo->to_name,
                        'href' => $domain.'/shop/buyGoods/'.$shopOrder->object_id,
                        'trade_name' => $rightsInfo->title,
                        'content' => '维权不成立',
                        'website' => $siteName

                    );
                    $toMessageContent = MessageTemplateModel::sendMessage('shop_rights',$toNewArr);
                    $messageTo = [
                        'message_title'=>$shopRightsTem['name'],
                        'code'=>'trading_rights_result',
                        'message_content'=>$toMessageContent,
                        'js_id'=>$rightsInfo->to_uid,
                        'message_type'=>2,
                        'receive_time'=>date('Y-m-d H:i:s',time()),
                        'status'=>0,
                    ];
                    MessageReceiveModel::create($messageTo);
                }
            }
        }
        return redirect('/manage/shopRightsInfo/'.$id);
    }



    
    static function serviceRightsSuccess(Request $request)
    {
        $id = $request->get('id');
        $domain = \CommonClass::getDomain();
        
        if((!$request->get('to_price') && $request->get('to_price')!=0) || (!$request->get('from_price') && $request->get('from_price')!=0))
        {
            return redirect()->back()->with(['error'=>'请填写金额！']);
        }
        $rightsInfo = UnionRightsModel::rightsInfoById($id);
        
        $employ_info = EmployModel::where('id',$rightsInfo['object_id'])->whereIn('status',[7,8])->first();
        
        $serviceInfo = EmployGoodsModel::where('employ_id',$rightsInfo['object_id'])->first();
        if(!$employ_info)
        {
            return redirect()->back()->with(['error'=>'维权雇佣任务不存在！']);
        }
        $toPrice = $request->get('to_price');
        $fromPrice = $request->get('from_price');
        if(($toPrice+$fromPrice)!=$employ_info['bounty'])
        {
            return redirect()->back()->with(['error'=>'请正确分配金额！']);
        }
        
        if($rightsInfo->object_type == 1){
            $status = UnionRightsModel::dealSeriviceRights($id,$fromPrice,$toPrice);
            if($status){
                $shopRightsTem = MessageTemplateModel::where('code_name','shop_rights')
                    ->where('is_open',1)->where('is_on_site',1)->first();
                if($shopRightsTem){
                    $siteName = \CommonClass::getConfig('site_name');
                    
                    $fromNewArr = array(
                        'username' => $rightsInfo->from_name,
                        'href' => $domain.'/shop/buyservice/'.$serviceInfo->service_id,
                        'trade_name' => $rightsInfo->title,
                        'content' => '维权成立，您获得金额为'.$fromPrice.'元',
                        'website' => $siteName

                    );
                    $fromMessageContent = MessageTemplateModel::sendMessage('shop_rights',$fromNewArr);
                    $messageFrom = [
                        'message_title'=>$shopRightsTem['name'],
                        'code'=>'trading_rights_result',
                        'message_content'=>$fromMessageContent,
                        'js_id'=>$rightsInfo->from_uid,
                        'message_type'=>2,
                        'receive_time'=>date('Y-m-d H:i:s',time()),
                        'status'=>0,
                    ];
                    MessageReceiveModel::create($messageFrom);
                    
                    $toNewArr = array(
                        'username' => $rightsInfo->to_name,
                        'href' => $domain.'/shop/buyservice/'.$serviceInfo->service_id,
                        'trade_name' => $rightsInfo->title,
                        'content' => '维权成立，您获得金额为'.$toPrice.'元',
                        'website' => $siteName

                    );
                    $toMessageContent = MessageTemplateModel::sendMessage('shop_rights',$toNewArr);
                    $messageTo = [
                        'message_title'=>$shopRightsTem['name'],
                        'code'=>'trading_rights_result',
                        'message_content'=>$toMessageContent,
                        'js_id'=>$rightsInfo->to_uid,
                        'message_type'=>2,
                        'receive_time'=>date('Y-m-d H:i:s',time()),
                        'status'=>0,
                    ];
                    MessageReceiveModel::create($messageTo);
                }
            }
        }
        return redirect('/manage/shopRightsInfo/'.$id);
    }


    
    public function serviceRightsFailure($id)
    {
        $id = intval($id);
        $domain = \CommonClass::getDomain();
        $rightsInfo = UnionRightsModel::rightsInfoById($id);
        
        $serviceInfo = EmployGoodsModel::where('employ_id',$rightsInfo['object_id'])->first();
        if($rightsInfo['object_type']==1)
        {
            $result = UnionRightsModel::serviceRightsHandel($id);
            if($result){
                $shopRightsTem = MessageTemplateModel::where('code_name','shop_rights')
                    ->where('is_open',1)->where('is_on_site',1)->first();
                if($shopRightsTem){
                    $siteName = \CommonClass::getConfig('site_name');
                    
                    $fromNewArr = array(
                        'username' => $rightsInfo->from_name,
                        'href' => $domain.'/shop/buyservice/'.$serviceInfo->service_id,
                        'trade_name' => $rightsInfo->title,
                        'content' => '维权不成立',
                        'website' => $siteName

                    );
                    $fromMessageContent = MessageTemplateModel::sendMessage('shop_rights',$fromNewArr);
                    $messageFrom = [
                        'message_title'=>$shopRightsTem['name'],
                        'code'=>'trading_rights_result',
                        'message_content'=>$fromMessageContent,
                        'js_id'=>$rightsInfo->from_uid,
                        'message_type'=>2,
                        'receive_time'=>date('Y-m-d H:i:s',time()),
                        'status'=>0,
                    ];
                    MessageReceiveModel::create($messageFrom);
                    
                    $toNewArr = array(
                        'username' => $rightsInfo->to_name,
                        'href' => $domain.'/shop/buyservice/'.$serviceInfo->service_id,
                        'trade_name' => $rightsInfo->title,
                        'content' => '维权不成立',
                        'website' => $siteName

                    );
                    $toMessageContent = MessageTemplateModel::sendMessage('shop_rights',$toNewArr);
                    $messageTo = [
                        'message_title'=>$shopRightsTem['name'],
                        'code'=>'trading_rights_result',
                        'message_content'=>$toMessageContent,
                        'js_id'=>$rightsInfo->to_uid,
                        'message_type'=>2,
                        'receive_time'=>date('Y-m-d H:i:s',time()),
                        'status'=>0,
                    ];
                    MessageReceiveModel::create($messageTo);
                }
            }
        }
        return redirect('/manage/shopRightsInfo/'.$id);
    }


    
    public function deleteShopRights($id)
    {
        $id = intval($id);
        $rightsInfo = UnionRightsModel::where('id',$id)->first();
        if($rightsInfo->is_delete == 0 && $rightsInfo->status != 0){
            UnionRightsModel::where('id',$id)->update(['is_delete' => 1]);
        }
        return redirect('/manage/ShopRightsList');
    }




    
    public function vipshopConfig()
    {
        $vipConfig = ConfigModel::getVipConfigByType('vip');
        $data = [
            'vipConfig' => $vipConfig
        ];
        return $this->theme->scope('manage.vipConfig',$data)->render();
    }

    
    public function vipPackageList()
    {
        return $this->theme->scope('manage.vipPackageList')->render();
    }
    
    public function addPackage()
    {
        return $this->theme->scope('manage.addPackage')->render();
    }
    
    public function vipInfoList()
    {
        return $this->theme->scope('manage.vipInfoList')->render();
    }

    
    public function vipInfoAdd()
    {
        return $this->theme->scope('manage.vipInfoAdd')->render();
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
    
    public function vipShopAuth()
    {
        return $this->theme->scope('manage.vipShopAuth')->render();
    }

    
    public function vipDetailsList()
    {
        return $this->theme->scope('manage.vipDetailsList')->render();
    }
    
    public function vipDetailsAuth()
    {
        return $this->theme->scope('manage.vipDetailsAuth')->render();
    }
}
