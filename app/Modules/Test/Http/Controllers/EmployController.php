<?php

namespace App\Modules\Test\Http\Controllers;

use App\Http\Requests;
use App\Modules\Employ\Models\EmployCommentsModel;
use App\Modules\Employ\Models\EmployGoodsModel;
use App\Modules\Employ\Models\EmployWorkModel;
use App\Modules\Employ\Models\UnionAttachmentModel;
use App\Modules\Employ\Models\UnionRightsModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Input;
use Omnipay;
use Validator;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Employ\Models\EmployModel;
use App\Modules\Shop\Models\GoodsModel;
use DB;

class EmployController extends ApiBaseController
{
    public function serviceEmploy(Request $request)
    {
        if (!$request->get('id') || !$request->get('uid')) {
            return $this->formateResponse(1001, '传送参数不能为空');
        }
        $id = intval($request->get('id'));
        $uid = intval($request->get('uid'));
        $service = GoodsModel::where('id', $id)->where('type', 2)->where('uid', $uid)->select('id', 'uid', 'title', 'desc', 'cash')->first();
        if (empty($service)) {
            return $this->formateResponse(1001, '传送参数错误');
        }
        $service->desc = htmlspecialchars_decode($service->desc);
        return $this->formateResponse(1000, '获取服务雇佣信息成功', $service);
    }


    
    public function createEmploy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:25',
            'desc' => 'required|max:5000',
            'phone' => 'required',
            'bounty' => 'required|numeric',
            'delivery_deadline' => 'required',
            'employee_uid' => 'required'

        ], [
            'title.required' => '标题不能为空',
            'title.max' => '标题最多25个字符',
            'desc.required' => '需求描述不能为空',
            'desc.max' => '需求描述最多5000字符',
            'phone.required' => '手机号不能为空',
            'bounty.required' => '预算不能为空',
            'bounty.numeric' => '请输入正确的预算格式',
            'delivery_deadline.required' => '截止时间不能为空',
            'employee_uid.required' => '被雇用人id不能为空'
        ]);
        $error = $validator->errors()->all();
        if (count($error)) {
            return $this->formateResponse(1001, $error[0], $error);
        }
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));

        $data['title'] = $request->get('title');
        $data['desc'] = $request->get('desc');
        $data['phone'] = $request->get('phone');
        $data['bounty'] = $request->get('bounty');
        $time = date('Y-m-d', time());
        $employBountyMinLimit = \CommonClass::getConfig('employ_bounty_min_limit');
        
        $taskBountyMinLimit = $employBountyMinLimit;
        
        if ($data['bounty'] < $taskBountyMinLimit) {
            return $this->formateResponse(1001, '赏金不能小于' . $taskBountyMinLimit);
        }
        
        $data['employee_uid'] = intval($request->get('employee_uid'));
        
        if($data['employee_uid'] == $tokenInfo['uid']){
            return $this->formateResponse(1001, '自己不能雇佣自己');
        }
        $data['employer_uid'] = $tokenInfo['uid'];
        $data['delivery_deadline'] = date('Y-m-d H:i:s', strtotime($request->get('delivery_deadline')));
        $data['status'] = 0;
        $data['created_at'] = $time;
        $data['updated_at'] = $time;
        
        $data['service_id'] = $request->get('service_id') ? $request->get('service_id') : 0;
        
        if ($data['service_id'] != 0) {
            $data['employ_type'] = 1;
        }
        
        $fileIds = $request->get('file_id') ? $request->get('file_id') : '';
        if (!empty($fileIds)) {
            $data['file_id'] = explode(',', $fileIds);
        } else {
            $data['file_id'] = array();
        }
        
        $result = EmployModel::employCreate($data);
        if ($result) {
            
            $isOrdered = ShopOrderModel::employOrder($tokenInfo['uid'], $data['bounty'], $result);
            if ($isOrdered) {
                $data = array(
                    'employ_id' => $result['id'],
                    'order_id' => $isOrdered['id']
                );
                return $this->formateResponse(1000, '创建成功', $data);
            } else {
                return $this->formateResponse(1001, '网络错误');
            }

        } else {
            return $this->formateResponse(1001, '网络错误');
        }
    }

    
    public function cashPayEmploy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'employ_id' => 'required',
            'pay_type' => 'required',
            'password' => 'required'
        ], [
            'order_id.required' => '雇佣订单id不能为空',
            'employ_id.required' => '请选择要托管的雇佣',
            'pay_type.required' => '请选择支付方式',
            'password.required' => '请输入支付密码'
        ]);
        $error = $validator->errors()->all();
        if (count($error)) {
            return $this->formateResponse(1001, $error[0], $error);
        }
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $data = array(
            'id' => $request->get('employ_id'),
            'order_id' => $request->get('order_id'),
            'pay_type' => $request->get('pay_type'),
            'password' => $request->get('password')
        );

        
        $employ = EmployModel::where('id', $data['id'])->first();

        
        if ($employ['employer_uid'] != $tokenInfo['uid'] || $employ['bounty_status'] != 0) {
            return $this->formateResponse(1001, '该雇佣已托管');
        }

        
        $balance = UserDetailModel::where('uid', $tokenInfo['uid'])->first();
        $balance = $balance['balance'];

        
        $order = ShopOrderModel::where('id', $data['order_id'])->first();

        
        if ($balance >= $employ['bounty'] && $data['pay_type'] == 0) {
            
            $user = UserModel::where('id', $tokenInfo['uid'])->first();
            $password = UserModel::encryptPassword($data['password'], $user['salt']);
            if ($password != $user['alternate_password']) {
                return $this->formateResponse(1001, '您的支付密码不正确');
            }
            
            $res = EmployModel::employBounty($employ['bounty'], $employ['id'], $tokenInfo['uid'], $order->code);
            if ($res) {
                return $this->formateResponse(1000, '支付成功');
            } else {
                return $this->formateResponse(1001, '网络错误，请重新支付');
            }
        } else {
            return $this->formateResponse(1001, '余额不足，请充值或切换支付方式');
        }

    }

    
    public function ThirdCashEmployPay(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if ($request->get('employ_id') && $request->get('order_id')) {
            $employId = $request->get('employ_id');
            
            $employ = EmployModel::where('id', $employId)->first();
            if ($employ->employer_uid != $uid || $employ->status >= 2) {
                return $this->formateResponse(1001, '非法操作');
            }
            
            $order = ShopOrderModel::where('id', $request->get('order_id'))->where('status', 0)->first();
        } else {
            return $this->formateResponse(1001, '缺少参数');
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


    
    public function employUserDetail(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('employ_id')) {
            return $this->formateResponse(1001, '缺少参数');
        }

        $id = $request->get('employ_id');
        
        $employ = EmployModel::where('id', $id)->first();
        
        if (empty($employ)) {
            return $this->formateResponse(1001, '参数错误');
        }
        $cash = $employ->bounty;
        $deliveryDeadline = $employ->delivery_deadline;
        $title = $employ->title;
        $type = 0;
        
        if ($uid == $employ->employer_uid) {
            $type = 1;
        } elseif ($uid == $employ->employee_uid) {
            $type = 2;
        }
        $domain = \CommonClass::getDomain();
        $cardType = '';
        $status = '';
        $deal = '';
        $buttonStatus = 0;
        $shopId = '';
        $userId = '';
        if (isset($type)) {
            switch ($type) {
                case 1:
                    
                    $shop = ShopModel::where('uid',$employ->employee_uid)->first();
                    if(!empty($shop)){
                        $shopId = $shop->id;
                    }
                    $cardType = '威客';
                    $userId = $employ->employee_uid;
                    
                    $user = UserModel::where('users.id', $employ->employee_uid)
                        ->leftJoin('user_detail', 'user_detail.uid', '=', 'users.id')
                        ->select('users.id', 'users.name', 'user_detail.avatar')->first();
                    switch ($employ->status) {
                        case 0:
                            $status = '待受理';
                            $deal = '等待受理';
                            $buttonStatus = 0;
                            break;
                        case 1:
                            $status = '工作中';
                            $deal = '工作中';
                            $buttonStatus = 1;
                            break;
                        case 2:
                            $status = '验收中';
                            $deal = '处理作品';
                            $buttonStatus = 2;
                            break;
                        case 3:
                            $status = '已完成';
                            $deal = '给予评价';
                            $buttonStatus = 3;
                            break;
                        case 4:
                            $status = '已完成';
                            $deal = '完成交易';
                            $buttonStatus = 4;
                            break;
                        case 5:
                            $status = '已失败';
                            $deal = '已被拒绝';
                            $buttonStatus = 5;
                            break;
                        case 6:
                            $status = '已失败';
                            $deal = '取消任务';
                            $buttonStatus = 5;
                            break;
                        case 7:
                            $status = '维权中';
                            $deal = '维权中';
                            $buttonStatus = 6;
                            break;
                        case 8:
                            $status = '维权中';
                            $deal = '维权中';
                            $buttonStatus = 6;
                            break;
                        case 9:
                            $status = '已失败';
                            $deal = '雇佣过期';
                            $buttonStatus = 10;
                            break;
                    }
                    break;
                case 2:
                    
                    $shop = ShopModel::where('uid',$uid)->first();
                    if(!empty($shop)){
                        $shopId = $shop->id;
                    }
                    $cardType = '雇主';
                    
                    $user = UserModel::where('users.id', $employ->employer_uid)
                        ->leftJoin('user_detail', 'user_detail.uid', '=', 'users.id')
                        ->select('users.id', 'users.name', 'user_detail.avatar')->first();
                    $userId = $employ->employer_uid;

                    switch ($employ->status) {
                        case 0:
                            $status = '待受理';
                            $deal = '处理委托';
                            $buttonStatus = 7;
                            break;
                        case 1:
                            $status = '工作中';
                            $deal = '上传作品';
                            $buttonStatus = 8;
                            break;
                        case 2:
                            $status = '验收中';
                            $deal = '等待处理';
                            $buttonStatus = 9;
                            break;
                        case 3:
                            $status = '已完成';
                            $deal = '给予评价';
                            $buttonStatus = 3;
                            break;
                        case 4:
                            $status = '已完成';
                            $deal = '任务完成';
                            $buttonStatus = 4;
                            break;
                        case 5:
                            $status = '已失败';
                            $deal = '已经拒绝';
                            $buttonStatus = 5;
                            break;
                        case 6:
                            $status = '已失败';
                            $deal = '已被取消';
                            $buttonStatus = 5;
                            break;
                        case 7:
                            $status = '维权中';
                            $deal = '维权中';
                            $buttonStatus = 6;
                            break;
                        case 8:
                            $status = '维权中';
                            $deal = '维权中';
                            $buttonStatus = 6;
                            break;
                        case 9:
                            $status = '已失败';
                            $deal = '雇佣过期';
                            $buttonStatus = 10;
                            break;
                    }
                    break;
            }
        }
        $username = '';
        $avatar = '';
        if (isset($user) && !empty($user)) {
            $username = $user->name;
            $avatar = $domain . '/' . $user->avatar;
        }
        
        $days = (strtotime($employ->delivery_deadline) - time()) / (3600 * 24) > 0 ? (strtotime($employ->delivery_deadline) - time()) / (3600 * 24) : 0;
        if($days){
            $d = floor($days);
            $h = intval(($days-$d)*24);
            $days = $d.'天'.$h.'小时';
        }else{
            $days = '0天';
        }

        $data = array(
            'employ_id' => $id,
            'shop_id' => $shopId,
            'user_id' => $userId,
            'type' => $type,
            'card_type' => $cardType,
            'status' => $status,
            'button_word' => $deal,
            'button_status' => $buttonStatus,
            'days' => $days,
            'username' => $username,
            'avatar' => $avatar,
            'cash' => $cash,
            'delivery_deadline' => $deliveryDeadline,
            'title' => $title

        );
        return $this->formateResponse(1000, '获取雇佣订单详情信息成功', $data);
    }

    
    public function employServiceDetail(Request $request)
    {
        if (!$request->get('employ_id')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $id = $request->get('employ_id');
        
        $employ = EmployModel::where('id', $id)->first();
        
        if (empty($employ)) {
            return $this->formateResponse(1001, '参数错误');
        }
        $employ->desc = htmlspecialchars_decode($employ->desc);
        $domain = \CommonClass::getDomain();
        
        $employAtt = UnionAttachmentModel::where('object_type', 2)->where('object_id', $id)
            ->select('attachment_id')->get()->toArray();
        $employAttachment = array();
        if (!empty($employAtt)) {
            
            $attId = array_flatten($employAtt);
            if (!empty($attId)) {
                
                $employAttachment = AttachmentModel::whereIn('id', $attId)->get()->toArray();
                if (!empty($employAttachment)) {
                    foreach ($employAttachment as $k => $v) {
                        $employAttachment[$k]['url'] = $domain . '/' . $v['url'];
                    }
                }
            }
        }
        $data = array(
            'title' => $employ->title,
            'desc' => $employ->desc,
            'employ_att' => $employAttachment,

        );
        return $this->formateResponse(1000, '获取雇佣订单服务详情信息成功', $data);

    }


    
    public function employWorkDetail(Request $request)
    {
        if (!$request->get('employ_id')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $id = $request->get('employ_id');
        
        $employ = EmployModel::where('id', $id)->first();
        
        if (empty($employ)) {
            return $this->formateResponse(1001, '参数错误');
        }
        $domain = \CommonClass::getDomain();
        
        $work = EmployWorkModel::where('employ_id', $id)->where('uid', $employ->employee_uid)->first();
        $workAtt = array();
        if (!empty($work)) {
            
            $workAtt = UnionAttachmentModel::where('object_type', 3)
                ->where('object_id', $work->id)
                ->select('attachment_id')->get()->toArray();
        }
        $attachment = array();
        if (!empty($workAtt)) {
            
            $workId = array_flatten($workAtt);
            if (!empty($workId)) {
                
                $attachment = AttachmentModel::whereIn('id', $workId)->get()->toArray();
                if (!empty($attachment)) {
                    foreach ($attachment as $k => $v) {
                        $attachment[$k]['url'] = $domain . '/' . $v['url'];
                    }
                }
            }
        }

        $data = array(
            'work' => $work,
            'work_att' => $attachment

        );
        return $this->formateResponse(1000, '获取雇佣订单作品详情信息成功', $data);

    }


    
    public function employCommentDetail(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('employ_id')) {
            return $this->formateResponse(1001, '缺少参数');
        }

        $id = $request->get('employ_id');
        
        $employ = EmployModel::where('id', $id)->first();
        
        if (empty($employ)) {
            return $this->formateResponse(1001, '参数错误');
        }
        $type = 0;
        
        if ($uid == $employ->employer_uid) {
            $type = 1;
        } elseif ($uid == $employ->employee_uid) {
            $type = 2;
        }
        $domain = \CommonClass::getDomain();
        $commentToMe = array();
        $commentToHe = array();
        if (isset($type)) {
            switch ($type) {
                case 1:
                    
                    $user = UserModel::where('users.id', $employ->employee_uid)
                        ->leftJoin('user_detail', 'user_detail.uid', '=', 'users.id')
                        ->select('users.id', 'users.name', 'user_detail.avatar')->first();
                    
                    
                    $commentToMe = EmployCommentsModel::where('employ_id', $id)
                        ->where('from_uid', $employ->employee_uid)
                        ->where('to_uid', $uid)->first();
                    if(!empty($commentToMe)){
                        $userToMe = $user;
                        if(!empty($userToMe)){
                            $commentToMe->username = $userToMe->name;
                            $commentToMe->avatar = $domain.'/'.$userToMe->avatar;
                        }else{
                            $commentToMe->username = '';
                            $commentToMe->avatar = '';
                        }
                    }
                    
                    $commentToHe = EmployCommentsModel::where('employ_id', $id)
                        ->where('from_uid', $uid)
                        ->where('to_uid', $employ->employee_uid)->first();
                    if(!empty($commentToHe)){
                        $userToHe = UserModel::where('users.id', $uid)
                            ->leftJoin('user_detail', 'user_detail.uid', '=', 'users.id')
                            ->select('users.id', 'users.name', 'user_detail.avatar')->first();
                        if(!empty($userToHe)){
                            $commentToHe->username = $userToHe->name;
                            $commentToHe->avatar = $domain.'/'.$userToHe->avatar;
                        }else{
                            $commentToHe->username = '';
                            $commentToHe->avatar = '';
                        }
                    }
                    break;
                case 2:
                    
                    $user = UserModel::where('users.id', $employ->employer_uid)
                        ->leftJoin('user_detail', 'user_detail.uid', '=', 'users.id')
                        ->select('users.id', 'users.name', 'user_detail.avatar')->first();
                    
                    
                    $commentToMe = EmployCommentsModel::where('employ_id', $id)
                        ->where('from_uid', $employ->employer_uid)
                        ->where('to_uid', $uid)->first();
                    if(!empty($commentToMe)){
                        $userToMe = $user;
                        if(!empty($userToMe)){
                            $commentToMe->username = $userToMe->name;
                            $commentToMe->avatar = $domain.'/'.$userToMe->avatar;
                        }else{
                            $commentToMe->username = '';
                            $commentToMe->avatar = '';
                        }
                    }
                    
                    $commentToHe = EmployCommentsModel::where('employ_id', $id)
                        ->where('from_uid', $uid)
                        ->where('to_uid', $employ->employer_uid)->first();
                    if(!empty($commentToHe)){
                        $userToHe = UserModel::where('users.id', $uid)
                            ->leftJoin('user_detail', 'user_detail.uid', '=', 'users.id')
                            ->select('users.id', 'users.name', 'user_detail.avatar')->first();
                        if(!empty($userToHe)){
                            $commentToHe->username = $userToHe->name;
                            $commentToHe->avatar = $domain.'/'.$userToHe->avatar;
                        }else{
                            $commentToHe->username = '';
                            $commentToHe->avatar = '';
                        }
                    }

                    break;
            }
        }

        $data = array(
            'type' => $type,
            'comment_to_me' => $commentToMe,
            'comment_to_he' => $commentToHe,

        );
        return $this->formateResponse(1000, '获取雇佣订单详情评价信息成功', $data);

    }



    
    public function employDetail(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('employ_id')) {
            return $this->formateResponse(1001, '缺少参数');
        }

        $id = $request->get('employ_id');
        
        $employ = EmployModel::where('id', $id)->first();
        
        if (empty($employ)) {
            return $this->formateResponse(1001, '参数错误');
        }
        $employ->desc = htmlspecialchars_decode($employ->desc);
        $type = 0;
        
        if ($uid == $employ->employer_uid) {
            $type = 1;
        } elseif ($uid == $employ->employee_uid) {
            $type = 2;
        }
        $domain = \CommonClass::getDomain();
        $commentToMe = array();
        $commentToHe = array();
        $cardType = '';
        $status = '';
        $deal = '';
        $buttonStatus = 0;
        $shopId = '';
        if (isset($type)) {
            switch ($type) {
                case 1:
                    
                    $shop = ShopModel::where('uid',$employ->employee_uid)->first();
                    if(!empty($shop)){
                        $shopId = $shop->id;
                    }
                    $cardType = '威客';
                    
                    $user = UserModel::where('users.id', $employ->employee_uid)
                        ->leftJoin('user_detail', 'user_detail.uid', '=', 'users.id')
                        ->select('users.id', 'users.name', 'user_detail.avatar')->first();
                    
                    
                    $commentToMe = EmployCommentsModel::where('employ_id', $id)
                        ->where('from_uid', $employ->employee_uid)
                        ->where('to_uid', $uid)->first();
                    if(!empty($commentToMe)){
                        $userToMe = $user;
                        if(!empty($userToMe)){
                            $commentToMe->username = $userToMe->name;
                            $commentToMe->avatar = $domain.'/'.$userToMe->avatar;
                        }else{
                            $commentToMe->username = '';
                            $commentToMe->avatar = '';
                        }
                    }
                    
                    $commentToHe = EmployCommentsModel::where('employ_id', $id)
                        ->where('from_uid', $uid)
                        ->where('to_uid', $employ->employee_uid)->first();
                    if(!empty($commentToHe)){
                        $userToHe = UserModel::where('users.id', $uid)
                            ->leftJoin('user_detail', 'user_detail.uid', '=', 'users.id')
                            ->select('users.id', 'users.name', 'user_detail.avatar')->first();
                        if(!empty($userToHe)){
                            $commentToHe->username = $userToHe->name;
                            $commentToHe->avatar = $domain.'/'.$userToHe->avatar;
                        }else{
                            $commentToHe->username = '';
                            $commentToHe->avatar = '';
                        }
                    }
                    switch ($employ->status) {
                        case 0:
                            $status = '待受理';
                            $deal = '等待受理';
                            $buttonStatus = 0;
                            break;
                        case 1:
                            $status = '工作中';
                            $deal = '工作中';
                            $buttonStatus = 1;
                            break;
                        case 2:
                            $status = '验收中';
                            $deal = '处理作品';
                            $buttonStatus = 2;
                            break;
                        case 3:
                            $status = '已完成';
                            $deal = '给予评价';
                            $buttonStatus = 3;
                            break;
                        case 4:
                            $status = '已完成';
                            $deal = '完成交易';
                            $buttonStatus = 4;
                            break;
                        case 5:
                            $status = '已失败';
                            $deal = '已被拒绝';
                            $buttonStatus = 5;
                            break;
                        case 6:
                            $status = '已失败';
                            $deal = '取消任务';
                            $buttonStatus = 5;
                            break;
                        case 7:
                            $status = '维权中';
                            $deal = '维权中';
                            $buttonStatus = 6;
                            break;
                        case 8:
                            $status = '维权中';
                            $deal = '维权中';
                            $buttonStatus = 6;
                            break;
                        case 9:
                            $status = '已失败';
                            $deal = '雇佣过期';
                            $buttonStatus = 10;
                            break;
                    }
                    break;
                case 2:
                    
                    $shop = ShopModel::where('uid',$uid)->first();
                    if(!empty($shop)){
                        $shopId = $shop->id;
                    }
                    $cardType = '雇主';
                    
                    $user = UserModel::where('users.id', $employ->employer_uid)
                        ->leftJoin('user_detail', 'user_detail.uid', '=', 'users.id')
                        ->select('users.id', 'users.name', 'user_detail.avatar')->first();
                    
                    
                    $commentToMe = EmployCommentsModel::where('employ_id', $id)
                        ->where('from_uid', $employ->employer_uid)
                        ->where('to_uid', $uid)->first();
                    if(!empty($commentToMe)){
                        $userToMe = $user;
                        if(!empty($userToMe)){
                            $commentToMe->username = $userToMe->name;
                            $commentToMe->avatar = $domain.'/'.$userToMe->avatar;
                        }else{
                            $commentToMe->username = '';
                            $commentToMe->avatar = '';
                        }
                    }
                    
                    $commentToHe = EmployCommentsModel::where('employ_id', $id)
                        ->where('from_uid', $uid)
                        ->where('to_uid', $employ->employer_uid)->first();
                    if(!empty($commentToHe)){
                        $userToHe = UserModel::where('users.id', $uid)
                            ->leftJoin('user_detail', 'user_detail.uid', '=', 'users.id')
                            ->select('users.id', 'users.name', 'user_detail.avatar')->first();
                        if(!empty($userToHe)){
                            $commentToHe->username = $userToHe->name;
                            $commentToHe->avatar = $domain.'/'.$userToHe->avatar;
                        }else{
                            $commentToHe->username = '';
                            $commentToHe->avatar = '';
                        }
                    }

                    switch ($employ->status) {
                        case 0:
                            $status = '待受理';
                            $deal = '处理委托';
                            $buttonStatus = 7;
                            break;
                        case 1:
                            $status = '工作中';
                            $deal = '上传作品';
                            $buttonStatus = 8;
                            break;
                        case 2:
                            $status = '验收中';
                            $deal = '等待处理';
                            $buttonStatus = 9;
                            break;
                        case 3:
                            $status = '已完成';
                            $deal = '给予评价';
                            $buttonStatus = 3;
                            break;
                        case 4:
                            $status = '已完成';
                            $deal = '任务完成';
                            $buttonStatus = 4;
                            break;
                        case 5:
                            $status = '已失败';
                            $deal = '已经拒绝';
                            $buttonStatus = 5;
                            break;
                        case 6:
                            $status = '已失败';
                            $deal = '已被取消';
                            $buttonStatus = 5;
                            break;
                        case 7:
                            $status = '维权中';
                            $deal = '维权中';
                            $buttonStatus = 6;
                            break;
                        case 8:
                            $status = '维权中';
                            $deal = '维权中';
                            $buttonStatus = 6;
                            break;
                        case 9:
                            $status = '已失败';
                            $deal = '雇佣过期';
                            $buttonStatus = 10;
                            break;
                    }
                    break;
            }
        }
        $username = '';
        $avatar = '';
        if (isset($user) && !empty($user)) {
            $username = $user->name;
            $avatar = $domain . '/' . $user->avatar;
        }
        
        $days = intval((strtotime($employ->delivery_deadline) - time()) / (3600 * 24)) > 0 ? intval((strtotime($employ->delivery_deadline) - time()) / (3600 * 24)) : 0;
        
        $work = EmployWorkModel::where('employ_id', $id)->where('uid', $employ->employee_uid)->first();
        $workAtt = array();
        if (!empty($work)) {
            
            $workAtt = UnionAttachmentModel::where('object_type', 3)
                ->where('object_id', $work->id)
                ->select('attachment_id')->get()->toArray();
        }
        $attachment = array();
        if (!empty($workAtt)) {
            
            $workId = array_flatten($workAtt);
            if (!empty($workId)) {
                
                $attachment = AttachmentModel::whereIn('id', $workId)->get()->toArray();
                if (!empty($attachment)) {
                    foreach ($attachment as $k => $v) {
                        $attachment[$k]['url'] = $domain . '/' . $v['url'];
                    }
                }
            }
        }
        
        $employAtt = UnionAttachmentModel::where('object_type', 2)->where('object_id', $id)
            ->select('attachment_id')->get()->toArray();
        $employAttachment = array();
        if (!empty($employAtt)) {
            
            $attId = array_flatten($employAtt);
            if (!empty($attId)) {
                
                $employAttachment = AttachmentModel::whereIn('id', $attId)->get()->toArray();
                if (!empty($employAttachment)) {
                    foreach ($employAttachment as $k => $v) {
                        $employAttachment[$k]['url'] = $domain . '/' . $v['url'];
                    }
                }
            }
        }
        $data = array(
            'shop_id' => $shopId,
            'type' => $type,
            'card_type' => $cardType,
            'status' => $status,
            'button_word' => $deal,
            'button_status' => $buttonStatus,
            'days' => $days,
            'username' => $username,
            'avatar' => $avatar,
            'employ' => $employ,
            'employ_att' => $employAttachment,
            'comment_to_me' => $commentToMe,
            'comment_to_he' => $commentToHe,
            'work' => $work,
            'work_att' => $attachment

        );
        return $this->formateResponse(1000, '获取雇佣订单详情信息成功', $data);

    }

    
    public function dealEmploy(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('employ_id') || !$request->get('type')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $type = $request->get('type'); 
        $id = $request->get('employ_id');
        $result = EmployModel::employHandle($type, $id, $uid);

        if (!$result) {
            return $this->formateResponse(1001, '网络错误');
        }
        return $this->formateResponse(1000, '操作成功');

    }

    
    public function workCreate(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('employ_id') || !$request->get('desc')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        
        $data['desc'] = \CommonClass::removeXss($request->get('desc'));
        $data['employ_id'] = $request->get('employ_id');
        
        $employ_id = intval($data['employ_id']);
        $employ = EmployModel::where('id', $employ_id)->where('employee_uid', $uid)->first();
        if (!$employ)
            return $this->formateResponse(1001, '你不是被雇佣者不需要交付当前雇佣稿件！');
        
        if ($employ['status'] != 1) {
            return $this->formateResponse(1001, '当前雇佣不是处于交稿状态！');
        }
        if ($request->get('file_id')) {
            $data['file_id'] = explode(',', $request->get('file_id'));
        }
        
        $result = EmployWorkModel::employDilivery($data, $uid);

        if (!$result) {
            return $this->formateResponse(1001, '投稿失败');
        }
        return $this->formateResponse(1000, '投稿成功');
    }

    
    public function acceptEmployWork(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('employ_id')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $id = $request->get('employ_id');
        
        $employ = EmployModel::where('id', $id)->first();
        if ($employ['status'] != 2)
            return $this->formateResponse(1001, '当前任务不是处于验收状态！');

        if ($employ['employer_uid'] != $uid)
            return $this->formateResponse(1001, '你不是当前雇佣任务的雇主，不能验收！');

        
        $result = EmployModel::acceptWork($id, $uid);
        if (!$result) {
            return $this->formateResponse(1001, '网络错误');
        }
        return $this->formateResponse(1000, '验收成功');
    }


    
    public function employRights(Request $request)
    {
        
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if (!$request->get('employ_id') || !$request->get('type') || !$request->get('desc')) {
            return $this->formateResponse(1001, '缺少参数');
        }
        $id = $request->get('employ_id');
        $type = $request->get('type');
        $desc = $request->get('desc');
        
        $employ = EmployModel::where('id', $id)->first();
        
        if (empty($employ)) {
            return $this->formateResponse(1001, '参数错误！');
        }

        if ($employ['employer_uid'] == $uid) {
            $role = 1;
            $to_uid = $employ['employee_uid'];
        } else if ($employ['employee_uid'] == $uid) {
            $role = 2;
            $to_uid = $employ['employer_uid'];
        } else {
            return $this->formateResponse(1001, '参数错误！');
        }
        $employ_rights = [
            'type' => intval($type),
            'object_id' => intval($id),
            'object_type' => 1,
            'desc' => \CommonClass::removeXss($desc),
            'status' => 0,
            'from_uid' => $uid,
            'to_uid' => $to_uid,
            'created_at' => date('Y-m-d H:i:s', time()),
        ];
        $result = UnionRightsModel::employRights($employ_rights, $role);

        if (!$result) {
            return $this->formateResponse(1001, '网络错误');
        }
        return $this->formateResponse(1000, '维权提交成功');

    }


    
    public function employEvaluate(Request $request)
    {

        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $uid = $tokenInfo['uid'];
        if(!$request->get('employ_id') || !$request->get('comment') || !$request->get('speed_score') || !$request->get('quality_score') || !$request->get('type')){
            return $this->formateResponse(1001, '缺少参数');
        }
        $data = array(
            'employ_id' => $request->get('employ_id'),
            'comment' => $request->get('comment'),
            'speed_score' => $request->get('speed_score'),
            'quality_score' => $request->get('quality_score'),
            'attitude_score' => $request->get('attitude_score')?intval($request->get('attitude_score')):0,
            'type' => $request->get('type'),
        );
        
        $employ = EmployModel::where('id', $data['employ_id'])->first();
        if ($employ['status'] != 3) {
            return $this->formateResponse(1001, '当前任务不是处于评价状态！');
        }
        
        if ($employ['employer_uid'] == $uid) {
            if(!$request->get('attitude_score')){
                return $this->formateResponse(1001, '缺少参数');
            }
            $comment_by = 1;
            $to_uid = $employ['employee_uid'];
        } else if ($employ['employee_uid'] == $uid) {
            $comment_by = 0;
            $to_uid = $employ['employer_uid'];
        } else {
            return $this->formateResponse(1001, '你不是雇主也不是被雇佣的威客，不能评价！');
        }
        
        $isComment = EmployCommentsModel::where('from_uid',$uid)->where('to_uid',$to_uid)->where('employ_id',$data['employ_id'])->first();
        if($isComment){
            return $this->formateResponse(1001, '你已经评价过，不能再次评价！');
        }
        
        $evaluate_data = [
            'employ_id' => intval($data['employ_id']),
            'from_uid' => $uid,
            'to_uid' => $to_uid,
            'comment' => $data['comment'],
            'comment_by' => $comment_by,
            'speed_score' => intval($data['speed_score']),
            'quality_score' => intval($data['quality_score']),
            'attitude_score' => isset($data['attitude_score']) ? intval($data['attitude_score']) : 0,
            'type' => intval($data['type']),
            'created_at' => date('Y-m-d H:i:s', time()),
        ];

        $result = EmployCommentsModel::serviceCommentsCreate($evaluate_data, intval($data['employ_id']));

        if (!$result)
            return $this->formateResponse(1001, '评论失败');

        
        if ($employ['employer_uid'] == $uid && $employ['employ_type'] == 1) {
            
            $service_id = EmployGoodsModel::where('employ_id', $employ['id'])->first();
            
            GoodsModel::where('id', $service_id['service_id'])->increment('comments_num', 1);
            
            UserDetailModel::where('uid', $uid)->increment('publish_task_num', 1);
            
            if ($data['type'] == 1) {
                GoodsModel::where('id', $service_id['service_id'])->increment('good_comment', 1);
                UserDetailModel::where('uid', $uid)->increment('employer_praise_rate', 1);
            }
        } else {
            
            UserDetailModel::where('uid', $uid)->increment('receive_task_num', 1);
            
            if ($data['type'] == 1) {
                UserDetailModel::where('uid', $uid)->increment('employee_praise_rate', 1);
            }
        }
        return $this->formateResponse(1000, '评论成功');
    }

}