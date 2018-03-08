<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\ShopModel;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopOrderController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('店铺管理');
        $this->theme->set('manageType', 'auth');
    }

    
    public function orderList(Request $request)
    {
        $merge = $request->all();
        $orderList = ShopOrderModel::whereRaw('1 = 1')->where('object_type',2);

        
        if ($request->get('name')) {
            $orderList = $orderList->where('users.name','like', '%'.$request->get('name').'%');
        }
        
        if ($request->get('title')) {
            $orderList = $orderList->where('shop_order.title', 'like','%'.$request->get('title').'%');
        }
        
        if ($request->get('status')) {
            switch ($request->get('status')) {
                case 1:
                    $status = 0;
                    $orderList = $orderList->where('shop_order.status', $status);
                    break;
                case 2:
                    $status = 1;
                    $orderList = $orderList->where('shop_order.status', $status);
                    break;
                case 3:
                    $status = 2;
                    $orderList = $orderList->where('shop_order.status', $status);
                    break;
                case 4:
                    $status = 3;
                    $orderList = $orderList->where('shop_order.status', $status);
                    break;
                case 5:
                    $status = 4;
                    $orderList = $orderList->where('shop_order.status', $status);
                    break;
                case 6:
                    $status = 5;
                    $orderList = $orderList->where('shop_order.status', $status);
                    break;
            }
        }
        
        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $orderList = $orderList->where('shop_order.created_at', '>',$start);
        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $orderList = $orderList->where('shop_order.created_at', '<',$end);
        }
        $by = $request->get('by') ? $request->get('by') : 'shop_order.id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;

        $orderList = $orderList->leftJoin('users', 'users.id', '=', 'shop_order.uid')
            ->select('shop_order.*', 'users.name')
            ->orderBy($by, $order)->paginate($paginate);

        $data = array(
            'merge' => $merge,
            'order_list' => $orderList,
        );
        $this->theme->setTitle('订单管理');
        return $this->theme->scope('manage.goodsorderlist', $data)->render();
    }


    
    public function shopOrderInfo($id)
    {
        $id = intval($id);
        
        $preId = ShopOrderModel::where('id', '>', $id)->where('object_type',2)->min('id');
        
        $nextId = ShopOrderModel::where('id', '<', $id)->where('object_type',2)->max('id');
        $orderInfo = ShopOrderModel::getGoodsOrderInfoById($id);
        $data = array(
            'order_info' => $orderInfo,
            'pre_id' => $preId,
            'next_id' => $nextId
        );
        $this->theme->setTitle('商品订单详情');
        return $this->theme->scope('manage.goodsorderinfo', $data)->render();
    }


}
