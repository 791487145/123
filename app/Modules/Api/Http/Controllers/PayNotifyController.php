<?php

namespace App\Modules\Api\Http\Controllers;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests;
use App\Modules\Employ\Models\EmployModel;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Pay\OrderModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\User\Model\UserDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Omnipay;

class PayNotifyController extends ApiBaseController
{
    
    public function alipayNotify()
    {
        if (app('alipay.mobile')->verify()) {
            $data = [
                'pay_account' => Input::get('buy_email'),
                'code' => Input::get('out_trade_no'),
                'pay_code' => Input::get('trade_no'),
                'money' => Input::get('total_fee')
            ];

            $type = ShopOrderModel::handleOrderCode($data['code']);
            
            switch (Input::get('trade_status')) {
                case 'TRADE_SUCCESS':
                case 'TRADE_FINISHED':
                switch($type){
                    case 'cash':
                        $orderInfo = OrderModel::where('code', $data['code'])->first();
                        if (!empty($orderInfo) && $orderInfo['status'] == 0 && empty($orderInfo->task_id)) {
                            $result = UserDetailModel::recharge($orderInfo->uid, 2, $data);
                            if (!$result) {
                                return $this->formateResponse(2022, '支付失败');
                            }
                            echo 'success';
                        }
                        break;
                    case 'pub task':
                        $orderInfo = OrderModel::where('code', $data['code'])->first();
                        if (!empty($orderInfo) && $orderInfo['status'] == 0 && $orderInfo->task_id) {
                            $uid = $orderInfo->uid;
                            $money = $data['money'];
                            $task_id = $orderInfo->task_id;
                            $code = $data['code'];
                            $result = DB::transaction(function () use ($money, $task_id, $uid, $code) {
                                
                                $data = TaskModel::where('id', $task_id)->update(['bounty_status' => 1, 'status' => 2]);
                                
                                $financial = [
                                    'action' => 1,
                                    'pay_type' => 2,
                                    'cash' => $money,
                                    'uid' => $uid,
                                    'created_at' => date('Y-m-d H:i:s', time())
                                ];
                                FinancialModel::create($financial);
                                
                                OrderModel::where('code', $code)->update(['status' => 1]);

                                
                                
                                $bounty_limit = \CommonClass::getConfig('task_bounty_limit');
                                if ($bounty_limit < $money) {
                                    TaskModel::where('id', '=', $task_id)->update(['status' => 3]);
                                } else {
                                    TaskModel::where('id', '=', $task_id)->update(['status' => 2]);
                                }
                                

                                UserDetailModel::where('uid', $uid)->increment('publish_task_num', 1);
                                return true;
                            });

                            if (!$result) {
                                return $this->formateResponse(2022, '支付失败');
                            }
                            echo 'success';
                        }
                        break;
                    case 'pub goods':
                        break;
                    case 'employ':
                        $order = ShopOrderModel::where('code', $data['code'])->first();
                        if (!empty($order) && $order['status'] == 0) {
                            
                            $result = UserDetailModel::recharge($order['uid'], 2, $data);
                            if (!$result) {
                                echo '支付失败！';
                            }
                            $result2 = EmployModel::employBounty($data['money'], $order['object_id'], $order['uid'], $data['code'],2);
                            if ($result2) {
                                echo('支付成功');
                            }
                            echo 'success';
                        }
                        break;
                    case 'pub service':
                        break;
                    case 'buy goods':
                        $data['pay_type'] = 2;
                        $res = ShopOrderModel::where(['code'=>$data['code'],'status'=>0,'object_type' => 2])->first();
                        if (!empty($res)){
                            $status = ShopOrderModel::thirdBuyGoods($res->code, $data);
                            if ($status) {
                                
                                $goodsInfo = GoodsModel::where('id',$res->object_id)->first();
                                
                                $salesNum = intval($goodsInfo->sales_num + 1);
                                GoodsModel::where('id',$goodsInfo->id)->update(['sales_num' => $salesNum]);
                                echo '支付成功';
                            }
                            echo 'success';
                        }
                        break;
                    case 'buy service':
                        break;
                    case 'buy shop service':
                        break;
                    case 'vipshop':
                        break;
                }

                    return $this->formateResponse(2023, '订单信息错误');
                    break;
            }

            return $this->formateResponse(2023, '支付失败');
        }
    }

    
    public function wechatpayNotify(Request $request)
    {
        $content = '<xml>
                    <return_code><![CDATA[SUCCESS]]></return_code>
                    <return_msg><![CDATA[OK]]></return_msg>
                    </xml>';

        $gateway = Omnipay::gateway('WechatPay');

        $response = $gateway->completePurchase([
            'request_params' => file_get_contents('php://input')
        ])->send();

        if ($response->isPaid()) {
            $result = \CommonClass::xmlToArray($GLOBALS['HTTP_RAW_POST_DATA']);
            $data = [
                'pay_account' => $result['openid'],
                'code' => $result['out_trade_no'],
                'pay_code' => $result['transaction_id'],
                'money' => $result['total_fee']
            ];

            $type = ShopOrderModel::handleOrderCode($data['code']);
            switch($type){
                case 'cash':
                    $orderInfo = OrderModel::where('code', $data['code'])->first();
                    $data['money'] = $orderInfo['cash'];
                    if (!empty($orderInfo) && $orderInfo['status'] == 0 && empty($orderInfo->task_id)) {
                        $result = UserDetailModel::recharge($orderInfo->uid, 2, $data);
                    }
                    if (!$result) {
                        return $this->formateResponse(2022, '支付失败');
                    }
                    return response($content)->header('Content-Type', 'text/xml');
                    break;
                case 'pub task':
                    $orderInfo = OrderModel::where('code', $data['code'])->first();
                    $data['money'] = $orderInfo['cash'];
                    if (!empty($orderInfo) && $orderInfo['status'] == 0 && $orderInfo->task_id) {

                        $uid = $orderInfo->uid;
                        $money = $data['money'];
                        $task_id = $orderInfo->task_id;
                        $code = $data['code'];
                        $result = DB::transaction(function () use ($money, $task_id, $uid, $code) {
                            
                            $data = TaskModel::where('id', $task_id)->update(['bounty_status' => 1, 'status' => 2]);
                            
                            $financial = [
                                'action' => 1,
                                'pay_type' => 3,
                                'cash' => $money,
                                'uid' => $uid,
                                'created_at' => date('Y-m-d H:i:s', time())
                            ];
                            FinancialModel::create($financial);
                            
                            OrderModel::where('code', $code)->update(['status' => 1]);

                            
                            
                            $bounty_limit = \CommonClass::getConfig('task_bounty_limit');
                            if ($bounty_limit < $money) {
                                TaskModel::where('id', '=', $task_id)->update(['status' => 3]);
                            } else {
                                TaskModel::where('id', '=', $task_id)->update(['status' => 2]);
                            }
                            
                            UserDetailModel::where('uid', $uid)->increment('publish_task_num', 1);
                            return true;
                        });

                    }
                    if (!$result) {
                        return $this->formateResponse(2022, '支付失败');
                    }
                    return response($content)->header('Content-Type', 'text/xml');
                    break;
                case 'pub goods':
                    break;
                case 'employ':
                    $orderInfo = ShopOrderModel::where('code', $data['code'])->first();
                    $data['money'] = $orderInfo['cash'];
                    if (!empty($orderInfo) && $orderInfo['status'] == 0) {
                        
                        $result = UserDetailModel::recharge($orderInfo['uid'], 2, $data);
                        if (!$result) {
                            $status = false;
                        }
                        $result2 = EmployModel::employBounty($data['money'], $orderInfo['object_id'], $orderInfo['uid'], $data['code'],3);
                        if ($result2) {
                            $status = true;;
                        }
                        if($status)
                            return response($content)->header('Content-Type', 'text/xml');
                    }
                    break;
                case 'pub service':
                    break;
                case 'buy goods':
                    $data['pay_type'] = 3;
                    $res = ShopOrderModel::where(['code'=>$data['code'],'status'=>0,'object_type' => 2])->first();
                    if (!empty($res)){
                        $status = ShopOrderModel::thirdBuyGoods($res->code, $data);
                        if ($status) {
                            
                            $goodsInfo = GoodsModel::where('id',$res->object_id)->first();
                            
                            $salesNum = intval($goodsInfo->sales_num + 1);
                            GoodsModel::where('id',$goodsInfo->id)->update(['sales_num' => $salesNum]);
                            return response($content)->header('Content-Type', 'text/xml');
                        }
                    }
                    break;
                case 'buy service':
                    break;
                case 'buy shop service':
                    break;
                case 'vipshop':
                    break;
            }

        } else {
            
        }
    }


}
