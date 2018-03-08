<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\UserCenterController;
use App\Http\Requests;
use App\Modules\Employ\Models\EmployCommentsModel;
use App\Modules\Employ\Models\EmployGoodsModel;
use App\Modules\Employ\Models\EmployModel;
use App\Modules\Employ\Models\UnionAttachmentModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\ServiceModel;
use App\Modules\Order\Model\OrderModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsCommentModel;
use App\Modules\Shop\Models\GoodsServiceModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Http\Requests\ServiceRequest;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay;
use QrCode;

class ServiceController extends  UserCenterController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('accepttask');
        $this->user = Auth::user();
    }

    
    public function serviceCreate()
    {
        $this->theme->setTitle('发布服务');
        $uid = Auth::id();
        $arrCate = TaskCateModel::findByPid([0]);
        $arrCateSecond = array();
        
        $shopId = ShopModel::getShopIdByUid($uid);
        
        $isOpenShop = ShopModel::isOpenShop($uid);

        if(!empty($arrCate[0]['id']))
            $arrCateSecond = TaskCateModel::findByPid([$arrCate[0]['id']]);
        
        $service = ServiceModel::where('status',1)->where('type',2)->where('identify','FUWUTUIJIAN')->first();
        $is_open = 1;
        if(!$service)
        {
            $is_open = 0;
        }
        
        $tradeRateArr = ConfigModel::getConfigByAlias('employ_percentage');
        if(!empty($tradeRateArr)){
            $tradeRate = $tradeRateArr->rule;
        }else{
            $tradeRate = 0;
        }
        
        $recommend_service_unit = (\CommonClass::getConfig('recommend_service_unit'))?\CommonClass::getConfig('recommend_service_unit'):0;
        $map = [
            0=>'一天',
            1=>'一个月',
            2=>'三个月',
            3=>'六个月',
            4=>'一年'
        ];
        $view = [
            'arr_cate' => $arrCate,
            'arrCateSecond'=>$arrCateSecond,
            'arr_cate' => $arrCate,
            'service'=>$service,
            'is_open'=>$is_open,
            'recommend_service_unit'=>$recommend_service_unit,
            'map'=>$map,
            'is_shop_open'=>$isOpenShop,
            'shop_id'=>$shopId,
            'trade_rate'=>$tradeRate
        ];
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.service.servicecreate',$view)->render();
    }

    
    public function serviceUpdate(ServiceRequest $request)
    {
        $data = $request->except('_token');

        $uid = Auth::user()['id'];
        
        $is_shop = ShopModel::where('uid',$uid)->where('status',1)->first();
        if(!$is_shop)
            return redirect()->back()->with('error','您还未开店，或店铺未激活，不能发布');
        
        if (!empty($data['cover'])){
            $cover = $request->file('cover');
            $result = \FileClass::uploadFile($cover,'sys');
            if ($result){
                $result = json_decode($result, true);
                $data['cover'] = $result['data']['url'];
            }
        }else{
            $data['cover'] = '';
        }
        
        $service_switch = \CommonClass::getConfig('service_check');


        
        $service = [
            'uid'=>$uid,
            'shop_id'=>$is_shop['id'],
            'title'=>e($data['title']),
            'desc'=>\CommonClass::removeXss($data['desc']),
            'cate_id'=>intval($data['secondCate']),
            'type'=>2,
            'cash'=>$data['cash'],
            'cover'=>$data['cover'],
            'is_recommend'=>0,
            'created_at'=>date('Y-m-d H:i:s',time()),
            'file_id'=>!empty($data['file_id'])?$data['file_id']:'',
        ];
        if($service_switch==2)
        {
            $service['status'] = 1;
        }
        $result = GoodsModel::serviceCreate($service);

        if(!$result)
            return redirect()->back()->with(['error'=>'创建失败！']);

        if(isset($data['is_recommend']))
            return redirect()->to('user/serviceBounty/'.$result['id']);

        return redirect()->to('user/waitServiceHandle/'.$result['id'])->with(['message'=>'发布成功！']);
    }

    
    public function waitServiceHandle($id)
    {
        $this->theme->setTitle('服务审核');
        
        $goodsInfo = GoodsModel::where('id',$id)->where('type',2)->where('is_delete',0)->first();
        
        if(!empty($goodsInfo) && $goodsInfo['status'] == 1){
            return redirect('user/serviceList');
        }
        $qq = \CommonClass::getConfig('qq');
        $data = array(
            'id' => $id,
            'goods_info' => $goodsInfo,
            'qq' => $qq
        );
        $this->theme->setTitle('服务审核');
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.service.servicesuccess',$data)->render();
    }
    
    public function serviceBounty($id)
    {
        $this->initTheme('userfinance');
        $this->theme->setTitle('购买增值服务');
        $id = intval($id);
        $uid = Auth::id();

        
        $service = ServiceModel::where('identify','FUWUTUIJIAN')->where('status',1)->first();

        if(!$service)
            return redirect()->back()->with('message','推送商城服务已关闭！');

        $userInfo = UserDetailModel::select('balance')->where('uid', $uid)->first();

        $payConfig = ConfigModel::getConfigByType('thirdpay');
        foreach ($payConfig as $k => $v){
            if ($v['status']){
                $pay[$k] = 1;
            }
        }
        $this->theme->set('TYPE',3);
        $data = [
            'service_cash' => $service['price'],
            'pay_config' => $pay,
            'balance' => $userInfo->balance,
            'good_id' => $id,
            'service_id'=>$service['id']
        ];

        return $this->theme->scope('user.service.servicebounty', $data)->render();
    }

    
    public function serviceBountyPay(Request $request)
    {
        $uid = Auth::id();
        $data = $request->except('_token');
        $service = ServiceModel::where('id',$data['service_id'])->first();
        $goods_id = intval($data['goods_id']);
        $money = $service['price'];
        
        $balance = UserDetailModel::where(['uid' => $uid])->first();
        $balance = (float)$balance['balance'];

        
        $is_ordered = ShopOrderModel::serviceOrder($uid,$service['price'],$goods_id);

        
        
        if ($balance >= $money && $data['pay_canel'] == 0)
        {
            
            $password = UserModel::encryptPassword($data['password'], $this->user['salt']);
            if ($password != $this->user['alternate_password']) {
                return redirect()->back()->with(['error' => '您的支付密码不正确']);
            }
            
            $result = GoodsModel::servicePay($money,$uid,$goods_id,$is_ordered['id']);
            $service = GoodsModel::where('id',$goods_id)->first();
            
            if(!$result)
                return redirect()->back()->with(['error'=>'支付失败']);

            return redirect()->to('user/serviceList')->with(['message'=>'您的服务成功被置顶到商城,'.date('Y-m-d',strtotime($service['recommend_end'])).'到期']);

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
                    'total_fee' => $money, 
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
                    'total_fee' => $money, 
                    'fee_type' => 'CNY', 
                );
                $response = $wechat->purchase($params)->send();

                $img = QrCode::size('280')->generate($response->getRedirectUrl());

                $view = array(
                    'cash'=>$money,
                    'img' => $img
                );
                return $this->theme->scope('task.wechatpay', $view)->render();
            } else if ($data['pay_type'] == 3) {
                dd('银联支付！');
            }
        } else if (isset($data['account']) && $data['pay_canel'] == 2) {
            dd('银行卡支付！');
        } else
        {
            return redirect()->back()->with(['error' => '请选择一种支付方式']);
        }

    }

    
    public function serviceBuy($id)
    {
        $id = intval($id);
        
        $service = GoodsModel::where('id',$id)->first();

        return redirect()->to('employ/create/'.$service['uid'].'/'.$service['id']);
    }

    
    public function serviceList(Request $request)
    {
        $this->theme->setTitle('我发布的服务');
        $data = $request->all();
        $uid = Auth::user()['id'];
        $all_cate = TaskCateModel::findAllCache();
        $all_cate = \CommonClass::keyBy($all_cate,'id');

        $goodsModel = new GoodsModel();
        $service = $goodsModel->serviceList($uid,$data);

        
        $isOpenShop = ShopModel::isOpenShop($uid);
        
        $shopId = ShopModel::getShopIdByUid($uid);
        $map = [
                0=>'待审核',
                1=>'出售中',
                2=>'已下架',
                3=>'审核未通过'
        ];

        $serviceStatistics = $goodsModel->serviceStatistics($uid);
        $this->theme->set('TYPE',3);
        $domain = url();

        $data = [
            'service'=>$service,
            'all_cate'=>$all_cate,
            'serviceStatistic'=>$serviceStatistics,
            'map'=>$map,
            'domain'=>$domain,
            'shop_id'=>$shopId,
            'is_open_shop'=>$isOpenShop
        ];
        return $this->theme->scope('user.service.servicelist', $data)->render();
    }

    
    public function serviceAdded($service_id)
    {
        $uid = Auth::user()['id'];
        
        $service = GoodsModel::where('id',$service_id)->where('uid',$uid)->whereIn('status',[1,2])->first();

        if(!$service)
            return redirect()->back()->with('error','操作失败！');
        
        
        $isOpenShop = ShopModel::isOpenShop($uid);
        if($isOpenShop!=1)
            return redirect()->back()->with(['error'=>'店铺关闭不能操作！']);
        
        $result = false;
        if($service['status']==1)
        {
            $result = GoodsModel::where('id',$service_id)->update(['status'=>2,'updated_at'=>date('Y-m-d H:i:s',time())]);
        }elseif($service['status']==2)
        {
            $result= GoodsModel::where('id',$service_id)->update(['status'=>1,'updated_at'=>date('Y-m-d H:i:s',time())]);
        }
        if(!$result)
            return redirect()->back()->with('error','操作失败！');

        return redirect()->back()->with('error','操作成功！');
    }

    
    public function serviceDelete($service_id)
    {
        $uid = Auth::user()['id'];
        
        $result = GoodsModel::where('id',$service_id)->where('uid',$uid)->update(['is_delete'=>1,'updated_at'=>date('Y-m-d H:i:s',time())]);

        if(!$result)
            return redirect()->back()->with('error','操作失败！');

        return redirect()->back()->with('error','操作成功！');
    }

    
    public function serviceMine(Request $request)
    {
        $this->initTheme('usertask');
        $this->theme->setTitle('我购买的服务');
        $uid = Auth::user()['id'];
        $data = $request->all();

        
        $employ = new EmployModel();
        $employ = $employ->employMine($uid,$data);
        $map = [
            0=>'待受理',
            1=>'工作中',
            2=>'验收中',
            3=>'待评价',
            4=>'交易完成',
            5=>'交易失败',
            6=>'交易失败',
            7=>'交易维权',
            8=>'交易维权',
            9=>'交易失败'
        ];

        $domian = url();
        $view = [
            'employ'=>$employ,
            'map'=>$map,
            'domain'=>$domian
        ];
        $this->theme->set('TYPE',2);
        return $this->theme->scope('user.service.servicemine', $view)->render();
    }

    
    public function serviceMyJob(Request $request)
    {
        $this->initTheme('accepttask');
        $this->theme->setTitle('我承接的服务');
        $uid = Auth::user()['id'];
        $data = $request->all();

        
        $employ = new EmployModel();
        $employ = $employ->employMyJob($uid,$data);

        
        $employ_ids = $employ->where('employee_uid',$uid)->where('employ_type',1)->where('bounty_status',1)->lists('id')->toArray();

        $employ_goods = EmployGoodsModel::select('employ_goods.*','gs.title','gs.id as goods_id')->whereIn('employ_goods.employ_id',$employ_ids)
            ->leftjoin('goods as gs','employ_goods.service_id','=','gs.id')
            ->get()->toArray();

        $employ_goods = \CommonClass::keyBy($employ_goods,'employ_id');

        $map = [
            0=>'待受理',
            1=>'工作中',
            2=>'验收中',
            3=>'待评价',
            4=>'交易完成',
            5=>'交易失败',
            6=>'交易失败',
            7=>'交易维权',
            8=>'交易维权',
            9=>'交易失败'
        ];
        $domain = url();
        $view = [
            'employ'=>$employ,
            'map'=>$map,
            'employ_goods'=>$employ_goods,
            'domain'=>$domain
        ];
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.service.servicemyjob', $view)->render();
    }

    
    public function serviceEdit($id)
    {
        $this->theme->setTitle('编辑服务');
        $service = GoodsModel::where('id',$id)->where('is_delete',0)->first();

        if(!$service)
            return redirect()->with('error','该任务已经删除！');

        if($service['status']!=0 && $service['status']!=3)
            return redirect()->with('error','该任务已经审核通过，不能编辑！');

        
        $service_attachment = UnionAttachmentModel::where('object_id',$service['id'])->where('object_type',4)->lists('attachment_id');
        $service_attachment = AttachmentModel::whereIn('id',$service_attachment)->get()->toArray();
        $service_attachment = json_encode($service_attachment);
        
        $cate_data = TaskCateModel::findById($service['cate_id']);
        $arrCate = TaskCateModel::findByPid([0]);
        $arrCate = \CommonClass::keyBy($arrCate,'id');
        $arrCateSecond = array();
        if(!empty($arrCate[$cate_data['pid']]))
            $arrCateSecond = TaskCateModel::findByPid([$arrCate[$cate_data['pid']]['id']]);

        
        $recommend_service_unit = (\CommonClass::getConfig('recommend_service_unit'))?\CommonClass::getConfig('recommend_service_unit'):0;
        $map = [
            0=>'一天',
            1=>'一个月',
            2=>'三个月',
            3=>'六个月',
            4=>'一年'
        ];
        $domian = url();
        
        $service_data = ServiceModel::where('status',1)->where('type',2)->where('identify','FUWUTUIJIAN')->first();
        $view = [
            'service'=>$service,
            'arrCate'=>$arrCate,
            'arrCateSecond'=>$arrCateSecond,
            'service_attachment'=>$service_attachment,
            'domain'=>$domian,
            'recommend_service_unit'=>$recommend_service_unit,
            'map'=>$map,
            'cate'=>$cate_data,
            'service_data'=>$service_data
        ];
        return $this->theme->scope('user.service.serviceEdit', $view)->render();
    }
    
    public function serviceEditUpdate(ServiceRequest $request)
    {
        $data = $request->except('_token');

        $uid = Auth::user()['id'];
        
        $service = GoodsModel::where('id',$data['id'])->where('uid',$uid)->first();

        if(!$service)
            return redirect()->back()->with(['error'=>'你不是当前服务的发布者']);

        if($service['status']!=0)
            return redirect()->back()->with(['error'=>'当前任务已经审核通过了，不能再修改！']);
        
        if (!empty($data['cover'])){
            $cover = $request->file('cover');
            $result = \FileClass::uploadFile($cover,'sys');
            if ($result){
                $result = json_decode($result, true);
                $data['cover'] = $result['data']['url'];
            }
        }else{
            $data['cover'] = $service['cover'];
        }
        
        $service_update = [
            'id'=>$service['id'],
            'secondCate'=>$data['secondCate'],
            'title'=>e($data['title']),
            'desc'=>\CommonClass::removeXss($data['desc']),
            'cate_id'=>intval($data['secondCate']),
            'cash'=>$data['cash'],
            'cover'=>$data['cover'],
            'file_id'=>!empty($data['file_id'])?$data['file_id']:'',
        ];
        $result = GoodsModel::updateService($service_update);

        if(!$result)
            return redirect()->back()->with(['error'=>'修改失败！']);

        if(isset($data['is_recommend']))
            return redirect()->to('user/serviceBounty/'.$service['id']);

        return redirect()->back()->with(['message'=>'修改成功！']);
    }

    
    public function serviceAttchDelete(Request $request)
    {
        $id = $request->get('id');
        
        $file = AttachmentModel::where('id',$id)->first()->toArray();
        if(!$file)
        {
            return response()->json(['errCode' => 0, 'errMsg' => '附件没有上传成功！']);
        }
        
        if(is_file($file['url']))
            unlink($file['url']);
        $result = AttachmentModel::destroy($id);

        
        UnionAttachmentModel::where('attachment_id',$id)->delete();

        if (!$result) {
            return response()->json(['errCode' => 0, 'errMsg' => '删除失败！']);
        }
        return response()->json(['errCode' => 1, 'errMsg' => '删除成功！']);
    }

    
    public function serviceEditNew($id)
    {
        $this->theme->setTitle('编辑服务');
        $service = GoodsModel::where('id',$id)->where('is_delete',0)->first();

        if(!$service)
            return redirect()->with('error','该任务已经删除！');

        if($service['status']!=0 && $service['status']!=3)
            return redirect()->with('error','该任务已经审核通过，不能编辑！');

        
        $service_attachment = UnionAttachmentModel::where('object_id',$service['id'])->where('object_type',4)->lists('attachment_id');
        $service_attachment = AttachmentModel::whereIn('id',$service_attachment)->get()->toArray();

        
        $cate_data = TaskCateModel::findById($service['cate_id']);
        $arrCate = TaskCateModel::findByPid([0]);
        $arrCate = \CommonClass::keyBy($arrCate,'id');
        $arrCateSecond = array();
        if(!empty($arrCate[$cate_data['pid']]))
            $arrCateSecond = TaskCateModel::findByPid([$arrCate[$cate_data['pid']]['id']]);
        
        $recommend_service_unit = (\CommonClass::getConfig('recommend_service_unit'))?\CommonClass::getConfig('recommend_service_unit'):0;
        $map = [
            0=>'一天',
            1=>'一个月',
            2=>'三个月',
            3=>'六个月',
            4=>'一年'
        ];
        
        $service_recommend = ServiceModel::where('status',1)->where('type',2)->where('identify','FUWUTUIJIAN')->first();
        $is_open = 1;
        if(!$service)
        {
            $is_open = 0;
        }
        $domian = url();
        $view = [
            'service'=>$service,
            'arrCate'=>$arrCate,
            'arrCateSecond'=>$arrCateSecond,
            'service_attachment'=>$service_attachment,
            'domain'=>$domian,
            'recommend_service_unit'=>$recommend_service_unit,
            'map'=>$map,
            'is_open'=>$is_open,
            'service_recommend'=>$service_recommend,
            'cate'=>$cate_data
        ];
        return $this->theme->scope('user.service.serviceEditNew', $view)->render();
    }
    
    public function serviceEditCreate(ServiceRequest $request)
    {
        $data = $request->except('_token');
        $uid = Auth::user()['id'];
        
        $is_shop = ShopModel::where('uid',$uid)->where('status',1)->first();
        if(!$is_shop)
            return redirect()->back()->with('error','您还未开店，或店铺未激活，不能发布');
        
        if (!empty($data['cover'])){
            $cover = $request->file('cover');
            $result = \FileClass::uploadFile($cover,'sys');
            if ($result){
                $result = json_decode($result, true);
                $data['cover'] = $result['data']['url'];
            }
        }elseif(!empty($data['cover_old'])){
            $data['cover'] = $data['cover_old'];
        }else{
            $data['cover'] = '';
        }
        
        $service = [
            'uid'=>$uid,
            'shop_id'=>$is_shop,
            'title'=>e($data['title']),
            'desc'=>\CommonClass::removeXss($data['desc']),
            'cate_id'=>intval($data['secondCate']),
            'type'=>2,
            'cash'=>$data['cash'],
            'cover'=>$data['cover'],
            'is_recommend'=>0,
            'created_at'=>date('Y-m-d H:i:s',time()),
            'file_id'=>isset($data['file_id'])?$data['file_id']:'',
        ];

        $result = GoodsModel::serviceCreate($service);

        if(!$result)
            return redirect()->back()->with(['error'=>'创建失败！']);

        if(isset($data['is_recommend']))
            return redirect()->to('user/serviceBounty/'.$result['id']);

        return redirect()->to('user/serviceList')->with('message','创建成功！');
    }

    public function shopcommentowner(Request $request)
    {
        $this->initTheme('accepttask');
        $this->theme->setTitle('交易评价');
        $data = $request->all();
        $uid = Auth::user()['id'];
        
        $shop = ShopModel::where('uid',$uid)->first();
        $shop_id = $shop['id'];
        $is_open_shop = 1;
        if(!$shop)
            $is_open_shop = 0;

        if(!empty($data['type']) && $data['type']==1 && $is_open_shop==1)
        {
            
            $service_ids = GoodsModel::where('shop_id',$shop_id)->where('type',2)->lists('id')->toArray();
            
            $employ_ids = EmployGoodsModel::whereIn('service_id',$service_ids)->lists('employ_id')->toArray();
            
            $service = EmployGoodsModel::select('employ_goods.employ_id','gs.*')
                ->whereIn('service_id',$service_ids)
                ->leftjoin('goods as gs','gs.id','=','employ_goods.service_id')
                ->get()->toArray();
            $service = \CommonClass::keyBy($service,'employ_id');

            $comments = EmployCommentsModel::select('employ_comment.*','us.name as user_name','ud.avatar')
                ->whereIn('employ_comment.employ_id',$employ_ids);
            if(!empty($data['from']) &&  $data['from']==1)
            {
                $comments = $comments->where('employ_comment.to_uid',$uid)
                    ->join('users as us','us.id','=','employ_comment.from_uid')
                    ->leftjoin('user_detail as ud','ud.uid','=','employ_comment.from_uid');

            }else{
                $comments = $comments->where('employ_comment.from_uid',$uid)
                    ->join('users as us','us.id','=','employ_comment.to_uid')
                    ->leftjoin('user_detail as ud','ud.uid','=','employ_comment.from_uid');
            }
            $comments = $comments->paginate(5);
            $comments_toArray = $comments->toArray();
            $comments_toArray['data'] = \CommonClass::keyBy($comments_toArray['data'],'employ_id');
            $view['service'] = $service;
        }else if($is_open_shop==1){
            
            $service_ids = GoodsModel::where('shop_id',$shop_id)->where('type',1)->lists('id')->toArray();
            $comments = GoodsCommentModel::select('goods_comment.*','ud.avatar','us.name as user_name','gs.title as goods_name','gs.cash as goods_price');
            
            if(!empty($data['from']) &&  $data['from']==1)
            {
                $comments = $comments->where('goods_comment.uid',$uid);
            }else{
                $comments = $comments->whereIn('goods_comment.goods_id',$service_ids);
            }
            $comments = $comments->join('users as us','us.id','=','goods_comment.uid')
                ->leftjoin('user_detail as ud','ud.uid','=','goods_comment.uid')
                ->leftjoin('goods as gs','gs.id','=','goods_comment.goods_id')
                ->paginate(5);
            $comments_toArray = $comments->toArray();
        }else{
            $comments = '';
            $comments_toArray = '';
        }

        $this->theme->set('TYPE',3);
        $view['comments'] = $comments;
        $view['comments_toArray'] = $comments_toArray;
        $view['is_shop_open'] = $is_open_shop;
        return $this->theme->scope('user.shopcommentowner',$view)->render();
    }

    
    public function serviceCashValid(Request $request)
    {
        $data = $request->except('_token');
        
        $employ_bounty_min_limit = \CommonClass::getConfig('employ_bounty_min_limit');

        
        if ($employ_bounty_min_limit > $data['param']) {
            $data['info'] = '服务价格应该大于' . $employ_bounty_min_limit ;
            $data['status'] = 'n';
            return json_encode($data);
        }

        $data['status'] = 'y';

        return json_encode($data);
    }
}
