<?php

namespace App\Modules\Employ\Http\Controllers;

use App\Http\Controllers\IndexController as BasicIndexController;
use App\Http\Requests;
use App\Modules\Employ\Http\Requests\EmployCreateRequest;
use App\Modules\Employ\Http\Requests\EvaluateRequest;
use App\Modules\Employ\Models\EmployAttachmentModel;
use App\Modules\Employ\Models\EmployCommentsModel;
use App\Modules\Employ\Models\EmployGoodsModel;
use App\Modules\Employ\Models\EmployModel;
use App\Modules\Employ\Models\EmployUserModel;
use App\Modules\Employ\Models\EmployWorkModel;
use App\Modules\Employ\Models\UnionAttachmentModel;
use App\Modules\Employ\Models\UnionRightsModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Order\Model\OrderModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserFocusModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Omnipay;
use Theme;
use QrCode;

class IndexController extends BasicIndexController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('employ');
    }

    public function index()
    {
        return $this->theme->scope('employ.index')->render();
    }

    
    public function employCreate($id,$service=0)
    {
        $this->theme->setTitle('雇佣页面');
        $service = intval($service);
        
        $employee_data = UserDetailModel::employeeData($id);
        
        if ($id == Auth::user()['id']) {
            return redirect()->back()->with(['error' => '自己不能雇佣自己！']);
        }
        
        if($service!=0)
        {
            $service = GoodsModel::where('id',$service)->where('type',2)->where('uid',$id)->first()->toArray();
            if(!$service)
                return redirect()->back()->with(['error' => '服务不存在！']);
        }
        
        $user_shop = ShopModel::where('status',1)->where('uid',$id)->first();
        $domain = url();
        $view = [
            'employ_data' => $employee_data,
            'domain' => $domain,
            'contact' => Theme::get('is_IM_open'),
            'service' => $service,
            'user_shop'=>$user_shop
        ];
        return $this->theme->scope('employ.create', $view)->render();
    }

    
    public function employUpdate(EmployCreateRequest $request)
    {
        $data = $request->except('_token');
        $time = date('Y-m-d', time());
        $employ_bounty_min_limit = \CommonClass::getConfig('employ_bounty_min_limit');
        
        $task_bounty_min_limit = $employ_bounty_min_limit;
        
        if ($data['bounty'] < $task_bounty_min_limit) {
            return redirect()->back()->with(['error' => '赏金不能小于' . $task_bounty_min_limit]);
        }
        
        $data['employee_uid'] = intval($data['employee_uid']);
        $data['employer_uid'] = Auth::user()['id'];
        $data['delivery_deadline'] = preg_replace('/([\x80-\xff]*)/i', '', $data['delivery_deadline']);
        $data['status'] = 0;
        $data['created_at'] = $time;
        $data['updated_at'] = $time;
        
        if($data['service_id']!=0)
        {
            $data['employ_type'] = 1;
        }
        
        $result = EmployModel::employCreate($data);

        if (!$result)
            return redirect()->back()->with(['error' => '创建雇佣任务失败']);

        return redirect('employ/bounty/' . $result['id']);
    }

    
    public function employBounty($id)
    {
        $this->theme->setTitle('雇佣托管');
        
        $employ_data = EmployModel::where('id', intval($id))->first();

        if (!$employ_data) {
            return redirect()->back()->with(['error' => '参数错误！']);
        }
        
        $user_data = UserDetailModel::where('uid', Auth::user()['id'])->first();
        
        $payConfig = ConfigModel::getConfigByType('thirdpay');
        $view = [
            'employ_data' => $employ_data,
            'user_data' => $user_data,
            'payConfig' => $payConfig
        ];

        return $this->theme->scope('employ.bounty', $view)->render();
    }

    
    public function employBountyUpdate(Request $request)
    {
        $data = $request->except('_token');
        $data['id'] = intval($data['id']);
        
        $employ = EmployModel::where('id', $data['id'])->first();

        
        if ($employ['employer_uid'] != Auth::user()['id'] || $employ['bounty_status'] != 0)
        {
            return redirect()->back()->with('error', '该雇佣已经托管！');
        }

        
        $balance = UserDetailModel::where('uid', Auth::user()['id'])->first();
        $balance = $balance['balance'];

        
        $is_ordered = ShopOrderModel::employOrder(Auth::user()['id'], $employ['bounty'], $data);

        if (!$is_ordered) return redirect()->back()->with(['error' => '创建订单失败！']);
        
        if ($balance >= $employ['bounty'] && $data['pay_canel'] == 0)
        {
            
            $password = UserModel::encryptPassword($data['password'], Auth::user()['salt']);
            if ($password != Auth::user()['alternate_password'])
            {
                return redirect()->back()->with(['error' => '您的支付密码不正确']);
            }
            
            EmployModel::employBounty($employ['bounty'], $employ['id'], Auth::user()['id'], $is_ordered->code);

            return Redirect::route('success',['id' => $employ['id'],'uid'=>$employ['employee_uid']]);
        } else if (isset($data['pay_type']) && $data['pay_canel'] == 1) {
            if ($data['pay_type'] == 1) {
                $config = ConfigModel::getPayConfig('alipay');
                $objOminipay = Omnipay::gateway('alipay');
                $objOminipay->setPartner($config['partner']);
                $objOminipay->setKey($config['key']);
                $objOminipay->setSellerEmail($config['sellerEmail']);
                $siteUrl = \CommonClass::getConfig('site_url');
                $objOminipay->setReturnUrl($siteUrl . '/order/pay/alipay/return');
                $objOminipay->setNotifyUrl($siteUrl . '/order/pay/alipay/notify');

                $response = Omnipay::purchase([
                    'out_trade_no' => $is_ordered->code, 
                    'subject' => \CommonClass::getConfig('site_name'), 
                    'total_fee' => $employ['bounty'], 
                ])->send();
                $response->redirect();
            } else if ($data['pay_type'] == 2) {
                $config = ConfigModel::getPayConfig('wechatpay');
                $wechat = Omnipay::gateway('wechat');
                $wechat->setAppId($config['appId']);
                $wechat->setMchId($config['mchId']);
                $wechat->setAppKey($config['appKey']);
                $out_trade_no = $is_ordered->code;
                $params = array(
                    'out_trade_no' => $is_ordered->code, 
                    'notify_url' => env('WECHAT_NOTIFY_URL', url('order/pay/wechat/notify')), 
                    'body' => \CommonClass::getConfig('site_name') . '余额充值', 
                    'total_fee' => $employ['bounty'], 
                    'fee_type' => 'CNY', 
                );
                $response = $wechat->purchase($params)->send();

                $img = QrCode::size('280')->generate($response->getRedirectUrl());

                $view = array(
                    'cash' => $employ['bounty'],
                    'img' => $img
                );
                return $this->theme->scope('task.wechatpay', $view)->render();
            }
        } else {
            return redirect()->back()->with(['error' => '请选择一种支付方式']);
        }
    }

    
    public function success(Request $request)
    {
        $this->theme->setTitle('雇佣成功');
        $data = $request->all();
        $uid = intval($data['uid']);
        
        $user_shop = ShopModel::where('status',1)->where('uid',$uid)->first();
        $view = [
            'id' => $data['id'],
            'user_shop'=>$user_shop,
        ];
        return $this->theme->scope('employ.success', $view)->render();
    }

    
    public function workin($id)
    {
        $this->theme->setTitle('雇佣详情');
        
        $user_id = Auth::user()['id'];
        
        $employ = EmployModel::where('id', $id)->first();
        
        if (empty($employ)) {
            return redirect()->back()->with(['error' => '参数错误！']);
        }

        if ($employ['employer_uid'] == $user_id) {
            $role = 1;
            $user_data = UserDetailModel::employeeData($employ['employee_uid']);
        } else if ($employ['employee_uid'] == $user_id) {
            $role = 2;
            $user_data = UserDetailModel::employerData($employ['employer_uid']);
        } else {
            return redirect()->back()->with(['error' => '参数错误！']);
        }
        


        $employ_detail = EmployModel::employDetail($id);

        
        $attatchment_ids = UnionAttachmentModel::where('object_id', '=', $id)->where('object_type', 2)->lists('attachment_id')->toArray();
        $attatchment_ids = array_flatten($attatchment_ids);
        $attatchment = AttachmentModel::whereIn('id', $attatchment_ids)->get();
        
        $work = array();
        $work_attachment = array();
        if ($employ_detail['status'] >= 2 && $employ_detail['status'] < 6) {
            
            $work = EmployWorkModel::where('employ_id', $id)->first();
            
            $work_attachment = UnionAttachmentModel::where('object_id', $work['id'])->where('object_type', 3)->lists('attachment_id')->toArray();
            $work_attachment = AttachmentModel::whereIn('id', $work_attachment)->get();
        }
        $comment = array();
        $comment_status = false;
        if ($employ_detail['status'] == 4 || $employ_detail['status']==3)
        {
            
            $comment = EmployCommentsModel::where('employ_id',$id)->get();
            
            $comment_status = EmployCommentsModel::where('employ_id',$id)->where('from_uid',$user_id)->first();
        }
        
        $isFocus = UserFocusModel::where('uid',$user_id)->where('focus_uid',$user_data['uid'])->first();

        
        $user_shop = ShopModel::where('status',1)->where('uid',$user_data['uid'])->first();
        $domain = url();
        $this->theme->set('employ_status',$employ_detail['status']);
        $this->theme->set('employ_bounty_status',$employ_detail['bounty_status']);

        $view = [
            'role' => $role,
            'user_data' => $user_data,
            'employ_data' => $employ_detail,
            'attachment' => $attatchment,
            'work' => $work,
            'comment' => $comment,
            'domain' => $domain,
            'contact' => Theme::get('is_IM_open'),
            'work_attachment' => $work_attachment,
            'comment_status'=>$comment_status,
            'user_shop'=>$user_shop,
            'isFocus'=>$isFocus
        ];

        return $this->theme->scope('employ.workin', $view)->render();
    }

    public function result(Request $request)
    {
        $data = $request->all();
        $data = [
            'pay_account' => $data['buyer_email'],
            'code' => $data['out_trade_no'],
            'pay_code' => $data['trade_no'],
            'money' => $data['total_fee'],
        ];
        $gateway = Omnipay::gateway('alipay');

        $options = [
            'request_params' => $_REQUEST,
        ];
        $response = $gateway->completePurchase($options)->send();

        if ($response->isSuccessful() && $response->isTradeStatusOk()) {
            
            $result = UserDetailModel::recharge($this->user['id'], 2, $data);

            if (!$result) {
                echo '支付失败！';
                return redirect()->back()->withErrors(['errMsg' => '支付失败！']);
            }
            
            $task_id = OrderModel::where('code', $data['code'])->first();

            TaskModel::employbounty($data['money'], $task_id['task_id'], $this->user['id'], $data['code'], 2);
            echo '支付成功';
            return redirect()->to('task/' . $task_id['task_id']);
        } else {
            
            echo '支付失败';
            return redirect()->to('task/bounty')->withErrors(['errMsg' => '支付失败！']);
        }
    }

    
    public function except($id, $type)
    {
        $user_id = Auth::user()['id'];

        $result = EmployModel::employHandle($type, $id, $user_id);

        if (!$result)
            return redirect()->back()->with(['error' => '操作失败！']);

        return redirect()->back()->with(['message' => '操作成功！']);
    }

    
    public function workCreate(Request $request)
    {
        $data = $request->except('_token');
        $data['desc'] = \CommonClass::removeXss($data['desc']);
        
        $uid = Auth::user()['id'];
        $employ_id = intval($data['employ_id']);

        $employ = EmployModel::where('id', $employ_id)->where('employee_uid', $uid)->first();
        if (!$employ)
            return redirect()->back()->with(['error' => '你不是被雇佣者不需要交付当前任务稿件！']);
        
        if ($employ['status'] != 1) {
            return redirect()->back()->with(['error' => '当前任务不是处于交稿状态！']);
        }

        
        $result = EmployWorkModel::employDilivery($data, $uid);

        if (!$result)
            return redirect()->back()->with(['error' => '投稿失败！']);

        return redirect()->back()->with(['message' => '投稿成功！']);
    }

    
    public function acceptWork($id)
    {
        $uid = Auth::user()['id'];
        
        $employ = EmployModel::where('id', $id)->first();
        if ($employ['status'] != 2)
            return redirect()->back()->with(['error' => '当前任务不是处于验收状态！']);

        if ($employ['employer_uid'] != $uid)
            return redirect()->back()->with(['error' => '你不是当前雇佣任务的雇主，不能验收！']);

        
        $result = EmployModel::acceptWork($id, $uid);

        if (!$result)
            return redirect()->back()->with('error', '验收失败！');

        return redirect()->back()->with(['message' => '验收成功！']);
    }

    
    public function employRights(Request $request)
    {
        $data = $request->all();
        
        $user_id = Auth::user()['id'];
        
        $employ = EmployModel::where('id', $data['id'])->first();
        
        if (empty($employ)) {
            return redirect()->back()->with(['error' => '参数错误！']);
        }

        if ($employ['employer_uid'] == $user_id) {
            $role = 1;
            $to_uid = $employ['employee_uid'];
        } else if ($employ['employee_uid'] == $user_id) {
            $role = 2;
            $to_uid = $employ['employer_uid'];
        } else {
            return redirect()->back()->with(['error' => '参数错误！']);
        }
        $employ_rights = [
            'type'=>intval($data['type']),
            'object_id'=>intval($data['id']),
            'object_type'=>1,
            'desc'=>\CommonClass::removeXss($data['desc']),
            'status'=>0,
            'from_uid'=>$user_id,
            'to_uid'=>$to_uid,
            'created_at'=>date('Y-m-d H:i:s',time()),
        ];
        $result = UnionRightsModel::employRights($employ_rights,$role);

        if(!$result)
            return redirect()->bakc()->with(['error'=>'维权失败！']);

        return redirect()->back()->with(['message'=>'维权成功！']);

    }
    
    public function employEvaluate(EvaluateRequest $request)
    {
        $data = $request->except('_token');
        $uid = Auth::user()['id'];
        
        $employ = EmployModel::where('id',$data['employ_id'])->first();
        if($employ['status']!=3)
        {
            return redirect()->back()->with(['error'=>'当前任务不在评价状态！']);
        }
        
        if($employ['employer_uid']==$uid)
        {
            $comment_by = 1;
            $to_uid = $employ['employee_uid'];
        }else if($employ['employee_uid']==$uid)
        {
            $comment_by = 0;
            $to_uid = $employ['employer_uid'];
        }else{
            return redirect()->back()->with(['error'=>'你不是雇主也不是被雇佣的威客，不能评价！']);
        }
        
        $evaluate_data = [
            'employ_id'=>intval($data['employ_id']),
            'from_uid'=>$uid,
            'to_uid'=>$to_uid,
            'comment'=>$data['comment'],
            'comment_by'=>$comment_by,
            'speed_score'=>intval($data['speed_score']),
            'quality_score'=>intval($data['quality_score']),
            'attitude_score'=>isset($data['attitude_score'])?intval($data['attitude_score']):0,
            'type'=>intval($data['type']),
            'created_at'=>date('Y-m-d H:i:s',time()),
        ];

        $result = EmployCommentsModel::serviceCommentsCreate($evaluate_data,intval($data['employ_id']));

        if(!$result)
            return redirect()->back()->with('error','评论失败！');

        
        if($employ['employer_uid']==$uid && $employ['employ_type']==1)
        {
            
            $service_id = EmployGoodsModel::where('employ_id',$employ['id'])->first();
            
            GoodsModel::where('id',$service_id['service_id'])->increment('comments_num',1);
            
            UserDetailModel::where('uid',$uid)->increment('publish_task_num',1);
            
            if($data['type']==1)
            {
                GoodsModel::where('id',$service_id['service_id'])->increment('good_comment',1);
                UserDetailModel::where('uid',$uid)->increment('employer_praise_rate',1);
            }
        }else
        {
            
            UserDetailModel::where('uid',$uid)->increment('receive_task_num',1);
            
            if($data['type']==1)
            {
                UserDetailModel::where('uid',$uid)->increment('employee_praise_rate',1);
            }
        }
        return redirect()->back()->with(['message'=>'评论成功！']);
    }
    
    public function validBounty(Request $request)
    {
        $data = $request->except('_token');
        
        $task_bounty_min_limit = \CommonClass::getConfig('employ_bounty_min_limit');

        
        if ($task_bounty_min_limit > $data['param']) {
            $data['info'] = '赏金应该大于' . $task_bounty_min_limit ;
            $data['status'] = 'n';
            return json_encode($data);
        }

        $data['status'] = 'y';
        return json_encode($data);
    }

    
    public function employCheck($id)
    {
        $employ = EmployModel::where('id',$id)->first();

        if(!$employ)
            return redirect()->back()->with(['error'=>'参数错误！']);

        if($employ['bounty_status']==0)
           return redirect()->to(URL('employ/workin',['id'=>$id]))->with(['error'=>'支付失败']);

       return redirect()->to(URL('employ/workin',['id'=>$id]))->with(['message'=>'支付成功']);
    }
}
