<?php

namespace App\Modules\Api\Http\Controllers;

use App\Http\Controllers\ApiBaseController;
use App\Modules\Finance\Model\CashoutModel;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Order\Model\OrderModel;
use App\Modules\Task\Model\ServiceModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskServiceModel;
use App\Modules\User\Model\AlipayAuthModel;
use App\Modules\User\Model\BankAuthModel;
use App\Modules\User\Model\UserBalanceModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Omnipay;
use DB;
use Validator;

class PayController extends ApiBaseController
{
    protected $uid;

    public function __construct(Request $request)
    {
        $tokenInfo = Crypt::decrypt($request->get('token'));
        $this->uid = $tokenInfo['uid'];
        $this->school = $tokenInfo['school'];
        $this->mobile = $tokenInfo['mobile'];
    }


    /**任务支付接口（post:/pay/taskService）
     * @param Request $request
     * @param task_id任务ID
     * @param password支付密码
     * @return \Illuminate\Http\Response
     */
    public function taskService(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'task_id' => 'required',
            'password' => 'required'
        ], [
            'task_id.required' => '请选择要托管的任务',

            'password.required' => '请填写支付密码',
        ]);

        $error = $validator->errors()->all();
        if (count($error)) {
            return $this->formateResponse(1001, $error[0], $error);
        }

        $array = explode("&",$data['task_id']);
        $data['task_id'] = $array[0];

        $userDetail = UserDetailModel::where('uid',$this->uid)->first();
        $user = UserModel::whereId($this->uid)->first();
        $newPayPass = UserModel::encryptPassword($data['password'], $user->salt);

        $task = TaskModel::whereId($data['task_id'])->first();

        $userBalance = UserBalanceModel::findByUid($this->uid);
        $data['cash'] = 0;
        $data['money'] = $task['bounty'];

        if($userDetail->pay_code != $newPayPass){
            return $this->formateResponse(1001,'支付密码错误');
        }

        if($task->uid != $this->uid){
            return $this->formateResponse(1001,'不能代人付款');
        }

        if(!empty($task->service)) {
            $serviceIds = explode(",", $task['service']);

            $topDiamondTaskNum = 0;
            $topDiamondTaskTopNum = 0;

            $topdiamond = ServiceModel::whereTitle('钻石置顶')->pluck('id');
            $top = ServiceModel::whereTitle('置顶')->pluck('id');
            $data['cash'] = ServiceModel::serviceMoney($serviceIds);

            $retDiamong = in_array($topdiamond, $serviceIds);
            $retTop = in_array($top, $serviceIds);

            if(!empty($retDiamong)){
                TaskModel::whereId($data['task_id'])->update(['top_status'=>TaskModel::TASK_DIAMAND]);
            }
            if(!empty($retTop)){
                TaskModel::whereId($data['task_id'])->update(['top_status'=>TaskModel::TASK_TOP]);
            }

            if ($task->region_limit == TaskModel::TASK_REGION_LIMIT_OFF) {

                if (!empty($retDiamong)) {
                    $topDiamondTaskNum = TaskModel::where('task.status',TaskModel::TASK_PUB)
                        ->where('task.region_limit',TaskModel::TASK_REGION_LIMIT_OFF)
                        ->leftJoin('task_service','task_service.task_id','=','task.id')
                        ->where('task_service.service_id',$topdiamond)
                        ->count();
                   }

                if (!empty($retTop)) {
                    $topDiamondTaskTopNum = TaskModel::where('task.status',TaskModel::TASK_PUB)
                        ->where('task.region_limit',TaskModel::TASK_REGION_LIMIT_OFF)
                        ->leftJoin('task_service','task_service.task_id','=','task.id')
                        ->where('task_service.service_id',$retTop)
                        ->count();
                    }

            }

            if ($task->region_limit == TaskModel::TASK_REGION_LIMIT_ON) {

                if (!empty($retDiamong)) {
                    $topDiamondTaskNum = TaskModel::where('task.status',TaskModel::TASK_PUB)
                        ->where('task.region_limit',TaskModel::TASK_REGION_LIMIT_ON)
                        ->where('task.area',$this->school)
                        ->leftJoin('task_service','task_service.task_id','=','task.id')
                        ->where('task_service.service_id',$topdiamond)
                        ->count();
                }

                if (!empty($retTop)) {
                    $topDiamondTaskTopNum = TaskModel::where('task.status',TaskModel::TASK_PUB)
                        ->where('task.region_limit',TaskModel::TASK_REGION_LIMIT_ON)
                        ->where('task.area',$this->school)
                        ->leftJoin('task_service','task_service.task_id','=','task.id')
                        ->where('task_service.service_id',$retTop)
                        ->count();
                    }

            }

            if ($topDiamondTaskNum >= 1) {
                return $this->formateResponse(1001,'本地区钻石置顶已满，不能置顶');
            }

            if ($topDiamondTaskTopNum >= 6) {
                return $this->formateResponse(1001,'置顶已满，不能置顶');
            }

            if ($userBalance->balance < ($data['cash'])) {
                return $this->formateResponse(1001,'您的余额不足，请充值');
            }

            TaskServiceModel::createOne($data['task_id'],$serviceIds);
        }

        if ($userBalance['balance'] < ($data['cash'] + $data['money'])) {
            return $this->formateResponse(1001,'您的余额不足，请充值');
        }

        $order = OrderModel::where('uid',$this->uid)->whereIn('status',[0,1])->where('task_id',$data['task_id'])->first();
        if(!is_null($order)){
            return $this->formateResponse(1001,'您已支付，请勿重新操作');
        }

        $ret = DB::transaction(function () use($data) {

            $param = [
                'action' => 1,
                'pay_type' => 1,
                'pay_account' => $this->mobile,
                'pay_code' => OrderModel::randomCode($this->uid),
                'cash' => $data['money'],
                'uid' => $this->uid
            ];
            FinancialModel::createOne($param);

            if(!empty($task['service'])) {
                $param = [
                    'action' => 5,
                    'pay_type' => 1,
                    'pay_account' => $this->mobile,
                    'pay_code' => OrderModel::randomCode($this->uid),
                    'cash' => $data['cash'],
                    'uid' => $this->uid
                ];
                FinancialModel::createOne($param);
            }

            $order = OrderModel::bountyOrder($this->uid,bcadd($data['cash'],$data['money']),$data['task_id']);
            TaskModel::whereId($data['task_id'])->update(['status'=>TaskModel::TASK_CHECKING,'bounty_status'=>TaskModel::TASK_BOUNTY_YES,'deposit_cash'=>$data['money']]);
            UserBalanceModel::where('user_id',$this->uid)->decrement('balance',bcadd($data['cash'],$data['money']));
            OrderModel::whereId($order->id)->update(['status'=>1]);
            return true;
        });

        if($ret){
            return $this->formateResponse(1000,'支付成功');
        }
        return $this->formateResponse(1001,'支付失败');
    }

    public function taskDepositByBalance(Request $request)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'task_id' => 'required',
            'pay_type' => 'required',
        ], [
            'task_id.required' => '请选择要托管的任务',
            'pay_type.required' => '请选择支付方式',
        ]);
        $error = $validator->errors()->all();
        if (count($error)) {
            return $this->formateResponse(1001, $error[0], $error);
        }
        $task_id = $data['task_id'];
        
        $task = TaskModel::where('id', $task_id)->first();
        if ($task->uid != $this->uid || $task->status >= 2) {
            return $this->formateResponse(1001, '非法操作');
        }

        
        $taskModel = new TaskModel();
        $money = $taskModel->taskMoney($task_id);
        
        $user = UserModel::where('id', $this->uid)->first();
        $userDetail = UserDetailModel::where('uid', $this->uid)->first();
        $balance = (float)$userDetail->balance;

        if ($balance >= $money && $data['pay_type'] == 0) {
            
            $order = OrderModel::bountyOrder($this->uid, $money, $task_id);
            if (!$order) {
                return $this->formateResponse(1001, '网络错误');
            }
            $alternate_password = UserModel::encryptPassword($data['password'], $user->salt);
            if ($alternate_password != $user->alternate_password) {
                return $this->formateResponse(1001, '支付密码不正确');
            }
            $result = TaskModel::bounty($money, $task_id, $this->uid, $order->code);
            if ($result) {
                return $this->formateResponse(1000, 'success');
            } else {
                return $this->formateResponse(1001, '网络错误');
            }
        } else {
            return $this->formateResponse(1001, '网络错误');
        }
    }

    
    public function createOrderInfo(Request $request)
    {
        $data = $request->all();
        $task_id = $data['task_id'];
        
        $task = TaskModel::where('id', $task_id)->first();
        if ($task->uid == $this->uid || $task->status >= 2) {
            return $this->formateResponse(1001, '非法操作');
        }
        
        $taskModel = new TaskModel();
        $money = $taskModel->taskMoney($task_id);
        $orderInfo = OrderModel::where('task_id', $task_id)->first();
        if ($orderInfo) {
            $order = $orderInfo;
        } else {
            $order = OrderModel::bountyOrder($this->uid, $money, $task_id);
        }
        if ($order) {
            return $this->formateResponse(1000, 'success', $order);
        } else {
            return $this->formateResponse(1001, '网络错误');
        }
    }

    
    public function checkThirdConfig(Request $request)
    {

        $pay_type = $request->get('pay_type');
        $configInfo = $pay_type_name = '';
        $status = 1;
        switch ($pay_type) {
            case 1:
                $configInfo = ConfigModel::getPayConfig('alipay');
                $pay_type_name = '支付宝';
                break;
            case 2:
                $configInfo = ConfigModel::getPayConfig('wechatpay');
                $pay_type_name = '微信支付';
                break;
            case 3:

                $configInfo = null;
                $pay_type_name = '银联支付';
                break;
        }
        
        if (is_array($configInfo)) {
            foreach ($configInfo as $con) {
                if (empty($con)) {
                    $status = 0;
                }
            }
        }
        if (!$configInfo) {
            $status = 0;
        }

        if ($status) {
            return $this->formateResponse(1000, 'success', $configInfo);
        } else {
            return $this->formateResponse(1001, $pay_type_name . '配置信息不全');
        }
    }

    
    public function balance()
    {
        $userDetail = UserDetailModel::where('uid', $this->uid)->first();
        $data = array(
            'balance' => $userDetail->balance
        );
        return $this->formateResponse(1000, 'success', $data);
    }

    
    public function financeList(Request $request)
    {
        $data = $request->all();
        $data['timeStatus'] = isset($data['timeStatus']) ? $data['timeStatus'] : 0;
        $finance = FinancialModel::where('uid', $this->uid);
        if (isset($data['timeStatus'])) {
            $sql = 'date_format(created_at,"%Y-%m")=date_format(date_sub(now(),interval ' . $data['timeStatus'] . ' month),"%Y-%m")';
            if ($data['timeStatus']) {
                $finance = $finance->whereRaw($sql);
            } else {
                $finance = $finance->whereRaw('date_format(created_at,"%Y-%m")=date_format(now(),"%Y-%m")');
            }
        }
        $finance = $finance->orderBy('created_at','desc')->get()->toArray();
        $userInfo = UserDetailModel::where('uid',$this->uid)->select('balance')->first();
        $financeInfo = [
            'balance' => $userInfo->balance,
            'finance' => $finance
        ];
        return $this->formateResponse(1000,'success',$financeInfo);
    }

    
    public function cashOut(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'cash' => 'required|numeric',
            'cashout_type' => 'required',
            'cashout_account' => 'required',
            'alternate_password' => 'required',
        ], [
            'cash.required' => '请输入提现金额',
            'cash.numeric' => '请输入正确的金额格式',
            'cashout_type.required' => '请选择提现方式',
            'cashout_account.required' => '请输入提现账户',
            'alternate_password.required' => '请输入支付密码',
        ]);
        $error = $validator->errors()->all();
        if (count($error)) {
            return $this->formateResponse(1001,$error[0],$error);
        }

        $userDetail = UserDetailModel::where('uid', $this->uid)->first();
        $user = UserModel::where('id', $this->uid)->first();
        $balance = $userDetail->balance;
        
        $cashConfig = ConfigModel::getConfigByAlias('cash');
        $rule = json_decode($cashConfig->rule, true);

        
        $now = strtotime(date('Y-m-d'));
        $start = date('Y-m-d H:i:s', $now);
        $end = date('Y-m-d H:i:s', $now + 24 * 3600);

        
        $cashOutSum = CashoutModel::where('uid', $this->uid)->whereBetween('created_at', [$start, $end])->sum('cash');
        $message = '';
        if ($data['cash'] > $balance) {
            return $this->formateResponse(1001,'提现金额不得大于账户余额');
        }
        if ($rule['withdraw_min'] && $data['cash'] < $rule['withdraw_min']) {
            return $this->formateResponse(1001,'单笔提现金额不得小于' . $rule['withdraw_min'] . '元');
        }
        if ($rule['withdraw_max'] && $cashOutSum > $rule['withdraw_max']) {
            return $this->formateResponse(1001,'当日提现金额不得大于' . $rule['withdraw_max'] . '元');
        }

        $alternate_password = UserModel::encryptPassword($data['alternate_password'], $user->salt);
        if ($alternate_password === $user->alternate_password) {
            $fees = FinancialModel::getFees($data['cash']);
            $info = array(
                'uid' => $this->uid,
                'cash' => $data['cash'],
                'fees' => $fees,
                'real_cash' => $data['cash'] - $fees,
                'cashout_type' => $data['cashout_type'],
                'cashout_account' => $data['cashout_account'],
            );

            $status = $this->addCashOut($info);
            if ($status) {
                return $this->formateResponse(1000, 'success');
            } else {
                return $this->formateResponse(1001, '网络错误');
            }
        } else {
            return $this->formateResponse(1001, '支付密码不正确');
        }
    }

    
    public function bankAccount()
    {
        $bankCard = BankAuthModel::where('uid', $this->uid)->where('status', 2)->get();
        if (count($bankCard)) {

            return $this->formateResponse(1000, 'success', $bankCard);
        } else {
            return $this->formateResponse(1001, '暂无已认证的银行卡信息');
        }
    }

    
    public function alipayAccount()
    {
        $alipay = AlipayAuthModel::where('uid', $this->uid)->where('status', 2)->get();
        if (count($alipay)) {
            return $this->formateResponse(1000, 'success', $alipay);
        } else {
            return $this->formateResponse(1001, '暂无已认证的支付宝信息');
        }
    }

    
    static function addCashOut($data)
    {
        $status = DB::transaction(function () use ($data) {
            CashoutModel::create($data);
            $finance = array(
                'action' => 4,
                'pay_account' => $data['cashout_account'],
                'cash' => $data['cash'],
                'uid' => $data['uid'],
                'created_at' => date('Y-m-d H:i:d', time()),
            );
            if ($data['cashout_type'] == 1) {
                $finance['pay_type'] = 2;
            } elseif ($data['cashout_type'] == 2) {
                $finance['pay_type'] = 4;
            }
            FinancialModel::create($finance);
            UserDetailModel::where('uid', $data['uid'])->decrement('balance', $data['cash']);
        });
        return is_null($status) ? true : false;
    }

    
    public function alipayNotify()
    {
        if (app('alipay.mobile')->verify()) {
            $data = [
                'pay_account' => Input::get('buy_email'),
                'code' => Input::get('out_trade_no'),
                'pay_code' => Input::get('trade_no'),
                'money' => Input::get('total_fee')
            ];

            
            switch (Input::get('trade_status')) {
                case 'TRADE_SUCCESS':
                case 'TRADE_FINISHED':
                    $orderInfo = OrderModel::where('code', $data['code'])->first();
                    if (!empty($orderInfo)) {
                        if ($orderInfo->task_id) {
                            $uid = $orderInfo->uid;
                            $money = $data['money'];
                            $task_id = $orderInfo->task_id;
                            $code = $data['code'];
                            $result = DB::transaction(function () use ($money, $task_id, $uid, $code) {
                                
                                $data = self::where('id', $this->task_id)->update(['bounty_status' => 1,'status' => 2]);
                                
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
                                    self::where('id', '=', $task_id)->update(['status' => 3]);
                                } else {
                                    self::where('id', '=', $task_id)->update(['status' => 2]);
                                }
                                
                                UserDetailModel::where('uid', $uid)->increment('publish_task_num', 1);
                                return true;
                            });
                        } else {
                            $result = UserDetailModel::recharge($orderInfo->uid, 2, $data);
                        }


                        if (!$result) {
                            return $this->formateResponse(1001, '支付失败');
                        }

                        return $this->formateResponse(1000, 'success');
                    }
                    return $this->formateResponse(1001, '订单信息错误');
                    break;
            }

            return $this->formateResponse(1001, '网络错误');
        }
    }

    
    public function wechatpayNotify()
    {
        Log::info('微信支付回调');
        $gateway = Omnipay::gateway('WechatPay');

        $response = $gateway->completePurchase([
            'request_params' => file_get_contents('php://input')
        ])->send();

        if ($response->isPaid()) {
            
            $result = $response->getData();
            $data = [
                'pay_account' => $result['openid'],
                'code' => $result['out_trade_no'],
                'pay_code' => $result['transaction_id'],
                'money' => $result['total_fee']
            ];
            $orderInfo = OrderModel::where('code', $data['code'])->first();
            if (!empty($orderInfo)) {
                if ($orderInfo->task_id) {
                    $uid = $orderInfo->uid;
                    $money = $data['money'];
                    $task_id = $orderInfo->task_id;
                    $code = $data['code'];
                    $result = DB::transaction(function () use ($money, $task_id, $uid, $code) {
                        
                        $data = self::where('id', $this->task_id)->update(['bounty_status' => 1,'status' => 2]);
                        
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
                            self::where('id', '=', $task_id)->update(['status' => 3]);
                        } else {
                            self::where('id', '=', $task_id)->update(['status' => 2]);
                        }
                        
                        UserDetailModel::where('uid', $uid)->increment('publish_task_num', 1);
                        return true;
                    });
                } else {
                    $result = UserDetailModel::recharge($orderInfo->uid, 2, $data);
                }


                if (!$result) {
                    return $this->formateResponse(1001, '网络错误');
                }

                return $this->formateResponse(1000, 'success');
            }

        } else {
            
        }
    }

    
    public function postCash(Request $request)
    {
        if ($request->get('task_id')) {
            $task_id = $request->get('task_id');
            
            $task = TaskModel::where('id', $task_id)->first();
            if ($task->uid != $this->uid || $task->status >= 2) {
                return $this->formateResponse(1001, '非法操作');
            }

            
            $taskModel = new TaskModel();
            $money = $taskModel->taskMoney($task_id);

            
            $order = OrderModel::bountyOrder($this->uid, $money, $task_id);
            

        } else {
            $data = array(
                'code' => OrderModel::randomCode($this->uid),
                'title' => $request->get('title'),
                'cash' => $request->get('cash'),
                'uid' => $this->uid,
                'created_at' => date('Y-m-d H:i:s', time()),
                'note' => $request->get('note'),
                'task_id' => $request->get('task_id')
            );
            $order = OrderModel::create($data);
        }

        if ($order) {
            $payType = $request->get('pay_type');
            switch ($payType) {
                case 'alipay':
                    $alipay = app('alipay.mobile');
                    $alipay->setNotifyUrl(url('api/alipay/notify'));
                    $alipay->setOutTradeNo($order->code);
                    $alipay->setTotalFee($order->cash);
                    $alipay->setSubject($order->title);
                    $alipay->setBody($order->note);
                    return $this->formateResponse(1000, '确认充值', ['payParam' => $alipay->getPayPara()]);
                    break;
                case 'wechat':
                    $gateway = Omnipay::gateway('WechatPay');
                    $gateway->setNotifyUrl(url('api/wechatpay/notify'));
                    $data = [
                        'body' => $order->title,
                        'out_trade_no' => $order->code,
                        'total_fee' => $order->cash*100, 
                        'spbill_create_ip' => Input::getClientIp(),
                        'fee_type' => 'CNY'
                    ];
                    $request = $gateway->purchase($data);
                    $response = $request->send();
                    if ($response->isSuccessful()) {
                        return $this->formateResponse(1000, '确认充值', ['params' => $response->getAppOrderData()]);
                    }
                    break;
            }
        } else {
            return $this->formateResponse(1001, '网络错误');
        }
    }


}