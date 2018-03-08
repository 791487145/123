<?php

namespace App\Modules\Order\Model;

use App\Modules\Employ\Models\EmployModel;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\ServiceModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskServiceModel;
use App\Modules\User\Model\UserDetailModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class OrderModel extends Model
{

    
    protected $table = 'order';

    protected $fillable = [
        'code', 'title', 'uid', 'cash', 'status', 'invoice_status', 'note', 'created_at'
    ];

    public $timestamps = false;

    protected $hidden = [

    ];


    
    static function randomCode($uid)
    {
        $zero = '';
        for ($i = 0; $i < 6; $i++) {
            $zero .= '0';
        }
        return date('YmdHis') . $zero . $uid;
    }
    
    static function createOne($data,$uid)
    {
        $model = new OrderModel();
        $model->code = isset($data['code'])?$data['code']:Self::randomCode($uid);
        $model->title = $data['title'];
        $model->uid = $uid;
        $model->task_id = isset($data['task_id'])?$data['task_id']:'';
        $model->cash = $data['cash'];
        $model->status = isset($data['status'])?$data['status']:0;
        $model->invoice_status = isset($data['invoice_status'])?$data['invoice_status']:0;
        $model->note = isset($data['note'])?$data['note']:'';
        $model->created_at = date('Y-m-d H:i:s', time());

        $model->save();
        return $model;
    }

    
    static function bountyOrder($uid,$money,$task_id)
    {
        $status = DB::transaction(function() use($uid,$money,$task_id){
            
            $order = [
                'code'=>Self::randomCode($uid),
                'title'=>'赏金托管',
                'uid'=>$uid,
                'cash'=>$money,
                'task_id'=>$task_id,
                'status'=>0,
                'created_at'=>date('Y-m-d H:i:s', time()),
            ];
            $order_obj = OrderModel::createOne($order,$uid);
            if($order_obj)
            {
                $bounty = TaskModel::select('task.bounty')->where('id','=',$task_id)->first();
                $bounty_order = [
                    'title'=>'赏金托管',
                    'cash'=>$bounty['bounty'],
                    'order_id'=>$order_obj->id,
                    'order_code'=>$order_obj->code,
                    'product_type'=>1,
                    'uid'=>$uid,
                    'status'=>0,
                    'created_at'=>date('Y-m-d H:i:s',time()),
                ];
                SubOrderModel::create($bounty_order);
            }
            $service = TaskServiceModel::where('task_id',$task_id)->lists('service_id')->toArray();
            if(!empty($service))
            {
                $service_ids = array_flatten($service);
                $service = ServiceModel::whereIn('id',$service_ids)->get()->toArray();
                foreach($service as $k=>$v)
                {
                    $sub_order = [
                        'title'=>'增值服务',
                        'cash'=>$v['price'],
                        'order_id'=>$order_obj->id,
                        'order_code'=>$order_obj->code,
                        'product_id'=>$v['id'],
                        'product_type'=>2,
                        'uid'=>$uid,
                        'created_at'=>date('Y-m-d H:i:s',time()),
                    ];
                    SubOrderModel::create($sub_order);
                }
            }
            return $order_obj;
        });
        return $status;
    }

    public function employBounty($uid,$money,$task_id)
    {

    }

    public $transactionData;

    
    public function recharge($payType, array $data)
    {
        switch ($payType){
            case 'alipay':
            case 'wechat':
                
                $orderInfo = OrderModel::where('code', $data['code'])->where('status', 0)->first();
                if (!empty($orderInfo)){
                    $financeInfo = array(
                        'code' => $data['code'],
                        'action' => 3,
                        'pay_type' => $payType == 'wechat' ? 3: 2,
                        'pay_account' => $data['pay_account'],
                        'pay_code' => $data['pay_code'],
                        'cash' => $data['money'],
                        'uid' => $orderInfo['uid'],
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s', time())
                    );
                    $this->transactionData['orderInfo'] = $orderInfo;
                    $this->transactionData['financeInfo'] = $financeInfo;
                    $status = DB::transaction(function (){
                        OrderModel::where('code', $this->transactionData['orderInfo']->code)->update(array('status' => 1));
                        FinancialModel::create($this->transactionData['financeInfo']);
                        $this->transactionData['status'] = UserDetailModel::where('uid', $this->transactionData['orderInfo']->uid)
                            ->increment('balance', $this->transactionData['financeInfo']['cash']);
                    });
                    Log::info($this->transactionData['status']);
                    return is_null($status) ? true : false;
                }
                break;
            case 'unionbank':
                break;
        }
    }

    
    static function adminRecharge($order)
    {
        $status = DB::transaction(function() use ($order){
            $order->update(array('status' => 1));
            $data = array(
                'action' => 3,
                'pay_type' => 1,
                'cash' => $order->cash,
                'uid' => $order->uid,
                'created_at'=>date('Y-m-d H:i:s',time())
            );
            FinancialModel::create($data);
            UserDetailModel::where('uid', $order->uid)->increment('balance', $order->cash);
        });

        return is_null($status) ? true : false;
    }
    
    static function dispatcher($order)
    {
        $prefix = [
            'e'=>'employ/success',
        ];
        
        $initial_str = substr($order,0,1);
        if(!empty($prefix[$initial_str]))
        {
            if($initial_str=='e')
            {
                
                $result = EmployModel::employResult();
                $route  = $prefix[$initial_str].'/'.$result['id'];
            }
            if(!$result)
                return false;

            return $route;
        }
        return false;
    }


    
    static function buyServicebyTaskBid($uid,$money,$task_id)
    {
        $status = DB::transaction(function() use($uid,$money,$task_id){
            
            $order = [
                'code' => ShopOrderModel::randomCode($uid,'ts'),
                'title' => '招标任务购买增值服务',
                'uid' => $uid,
                'cash' => $money,
                'task_id' => $task_id,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s', time()),
            ];
            $order_obj = OrderModel::createOne($order,$uid);
            $service = TaskServiceModel::where('task_id',$task_id)->lists('service_id')->toArray();
            if(!empty($service)){
                $service_ids = array_flatten($service);
                $service = ServiceModel::whereIn('id',$service_ids)->get()->toArray();
                foreach($service as $k=>$v)
                {
                    $sub_order = [
                        'title' => '增值服务',
                        'cash' => $v['price'],
                        'order_id' => $order_obj->id,
                        'order_code' => $order_obj->code,
                        'product_id' => $v['id'],
                        'product_type' => 2,
                        'uid' => $uid,
                        'status' => 0,
                        'created_at' => date('Y-m-d H:i:s',time()),

                    ];
                    SubOrderModel::create($sub_order);
                }
            }
            return $order_obj;
        });
        return $status;
    }


    
    static function bountyOrderByTaskBid($uid,$money,$task_id)
    {
        $status = DB::transaction(function() use($uid,$money,$task_id){
            
            $order = [
                'code' => self::randomCode($uid),
                'title' => '赏金托管',
                'uid' => $uid,
                'cash' => $money,
                'task_id' => $task_id,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s', time()),
            ];
            $order_obj = OrderModel::createOne($order,$uid);
            if($order_obj){
                $bounty = TaskModel::select('task.bounty')->where('id','=',$task_id)->first();
                $bounty_order = [
                    'title' => '赏金托管',
                    'cash' => $bounty['bounty'],
                    'order_id' => $order_obj->id,
                    'order_code' => $order_obj->code,
                    'product_type' => 1,
                    'product_id' => $task_id,
                    'uid' => $uid,
                    'status' => 0,
                    'created_at'=>date('Y-m-d H:i:s',time()),
                ];
                SubOrderModel::create($bounty_order);
            }
            return $order_obj;
        });
        return $status;
    }


}
