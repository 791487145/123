<?php

namespace App\Modules\Shop\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\IndexController as BasicIndexController;
use App\Modules\Employ\Models\UnionAttachmentModel;
use App\Modules\Employ\Models\UnionRightsModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsCommentModel;
use App\Modules\Shop\Models\ShopFocusModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\BankAuthModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\Shop\Models\GoodsModel;
use Auth;
use DB;
use Omnipay;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GoodsController extends BasicIndexController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('shop');
    }

    
    public function buyGoods(Request $request, $id)
    {
        $id = intval($id);
        $merge = $request->all();
        if ($request->get('page')) {
            $page = $request->get('page');
        } else {
            $page = 1;
        }
        if ($request->get('comment_type')) {
            $type = $request->get('comment_type');
        } else {
            $type = 0;
        }
        
        $goodsInfo = GoodsModel::getGoodsInfoById($id, array('is_delete' => 1)); 
        $shopId = $goodsInfo->shop_id;
        $this->theme->set('SHOPID', $shopId);
        $this->theme->setUserId($goodsInfo->uid);
        $isRights = false;
        if (!empty($goodsInfo)) {
            
            if (Auth::check()) {
                $uid = Auth::id();
                
                if ($goodsInfo->uid == $uid) {
                    $owner = true; 
                    $isContract = false; 
                    $collectShop = false;

                } else {
                    $owner = false;
                    $isContract = true;
                    
                    $collectShopArr = ShopFocusModel::shopFocusStatus($shopId);
                    if (!empty($collectShopArr)) {
                        $collectShop = 1;
                    } else {
                        $collectShop = 0;
                    }
                }
                
                $isBuy = ShopOrderModel::isBuy($uid, $id, 2);
                if ($isBuy == true && $owner == false) {
                    
                    $isComment = GoodsCommentModel::isComment($id, $uid);
                } else {
                    $isComment = false;
                    
                    $isRights = ShopOrderModel::isRights($uid, $id, 2);
                }
                
                if ($goodsInfo->status == 1) {
                    $isOk = true;
                } else {
                    if ($isBuy == true) {
                        $isOk = true;
                    } else {
                        if ($goodsInfo->is_delete == 0) {
                            $isOk = true;
                        } else {
                            $isOk = false;
                        }
                    }
                }

            } else {
                $owner = false;
                if ($goodsInfo->status == 1) {
                    $isOk = true;
                } else {
                    if ($goodsInfo->is_delete == 0) {
                        $isOk = true;
                    } else {
                        $isOk = false;
                    }
                }
                $isBuy = false;
                $isContract = true;
                $isComment = false;
                $collectShop = false; 
            }
            
            $unionAtt = UnionAttachmentModel::where(['object_id' => $id, 'object_type' => 4])->get();
            if (!empty($unionAtt)) {
                $attachmentId = array();
                foreach ($unionAtt as $k => $v) {
                    $attachmentId[] = $v['attachment_id'];
                }
                $attachment = AttachmentModel::whereIn('id', $attachmentId)->get();
            } else {
                $attachment = array();
            }

            
            $commentAbout = GoodsCommentModel::getCommentByGoodsId($id, $page, $type);
            
            $userId = $goodsInfo->uid;
            $goodsList = GoodsModel::where('goods.uid', $userId)->where('goods.shop_id', $shopId)->where('goods.is_delete', 0)
                ->where('goods.status', 1)->where('goods.type', 1)->where('goods.id', '!=', $id)
                ->leftJoin('cate', 'cate.id', '=', 'goods.cate_id')->select('goods.*', 'cate.name')
                ->orderBy('goods.updated_at', 'DESC')->limit(4)->get()->toArray();
            
            $contactInfo = UserDetailModel::where('uid', $goodsInfo->uid)
                ->select('mobile', 'mobile_status', 'qq', 'qq_status', 'wechat', 'wechat_status')->first();
            
            $tradeRate = \CommonClass::getConfig('trade_rate');
            $data = array(
                'goods_info' => $goodsInfo,
                'is_buy' => $isBuy,
                'is_contract' => $isContract,
                'is_comment' => $isComment,
                'collect_shop' => $collectShop,
                'goods_list' => $goodsList,
                'comment_about' => $commentAbout,
                'attachment' => $attachment,
                'owner' => $owner,
                'contactInfo' => $contactInfo,
                'merge' => $merge,
                'trade_rate' => $tradeRate,
                'is_rights' => $isRights

            );
            if ($goodsInfo->seo_title) {
                $this->theme->setTitle($goodsInfo->seo_title);
                $this->theme->set('keywords', $goodsInfo->seo_keyword);
                $this->theme->set('description', $goodsInfo->seo_desc);
            } else {
                $this->theme->setTitle('作品详情');
                if (!empty($goodsInfo->title)) {
                    $this->theme->setTitle($goodsInfo->title);
                }
            }
            if ($isOk == true) {
                return $this->theme->scope('shop.buygoods', $data)->render();

            } else {
                abort('404');
            }
        } else {
            abort('404');
        }

    }

    
    public function addGoodsComment(Request $request)
    {
        $data = $request->except('_token');
        $uid = Auth::id();
        
        $goodsOrder = ShopOrderModel::where('uid', $uid)->where('object_id', $data['goods_id'])
            ->where('object_type', 2)->where('status', 2)->first()->toArray();
        $commentArr = array(
            'uid' => $data['uid'],
            'goods_id' => $data['goods_id'],
            'type' => $data['type'],
            'speed_score' => $data['speed_score'],
            'quality_score' => $data['quality_score'],
            'attitude_score' => $data['attitude_score'],
            'comment_desc' => $data['comment'],
            'created_at' => date('Y-m-d H:i:s'),
            'comment_by' => 1,
        );
        $res = GoodsCommentModel::createGoodsComment($commentArr, $goodsOrder);
        if ($res) {
            return redirect('/shop/buyGoods/' . $data['goods_id']);
        }
    }

    
    public function ajaxGetGoodsComment(Request $request)
    {
        $id = $request->get('id');
        $page = $request->get('page') ? intval($request->get('page')) : 1;
        $type = $request->get('type') ? intval($request->get('type')) : 0;
        
        $goodsComment = GoodsCommentModel::getCommentByGoodsId($id, $page, $type);
        $domain = \CommonClass::getDomain();
        if (!empty($goodsComment)) {
            $data = array(
                'code' => 1,
                'msg' => 'success',
                'data' => $goodsComment,
                'domain' => $domain
            );
        } else {
            $data = array(
                'code' => 0,
                'msg' => 'failure'
            );
        }
        return response()->json($data);
    }

    
    public function orders(Request $request, $id)
    {
        $id = intval($id);
        $uid = Auth::id();
        $isBuy = ShopOrderModel::isBuy($uid, $id, 2);
        $isRights = ShopOrderModel::isRights($uid, $id, 2);
        if ($isBuy == true || $isRights == true) {
            return redirect('/shop/buyGoods/' . $id);
        }
        $goodsInfo = GoodsModel::getGoodsInfoById($id);
        $shopId = $goodsInfo->shop_id;
        $this->theme->set('SHOPID', $shopId);
        $this->theme->setUserId($goodsInfo->uid);
        $data = array(
            'goods_info' => $goodsInfo,
            'uid' => $uid
        );
        $this->theme->setTitle('商品订单');
        return $this->theme->scope('shop.orders', $data)->render();
    }

    
    public function postOrder(Request $request)
    {
        $uid = Auth::id();
        $data = $request->all();
        
        $tradeRateArr = ConfigModel::getConfigByAlias('trade_rate');
        if ($tradeRateArr) {
            $tradeRate = $tradeRateArr->rule;
        } else {
            $tradeRate = 0;
        }
        
        $order = ShopOrderModel::where('uid', $uid)->where('object_id', $data['goods_id'])
            ->where('object_type', 2)->where('status', 0)->first();
        if (empty($order)) {
            $arr = array(
                'code' => ShopOrderModel::randomCode($uid, 'bg'),
                'title' => '购买作品' . $data['title'],
                'uid' => $uid,
                'object_id' => $data['goods_id'],
                'object_type' => 2, 
                'cash' => $data['pay_cash'],
                'status' => 0, 
                'created_at' => date('Y-m-d H:i:s', time()),
                'trade_rate' => $tradeRate
            );
            
            $re = ShopOrderModel::isBuy($uid, $data['goods_id'], 2);
            
            $isPublish = GoodsModel::where('id', $data['goods_id'])->first();
            if ($isPublish->uid == $uid) {
                $data = array(
                    'code' => 0,
                    'msg' => '您是商品发布人，无需购买'
                );
            } else if ($isPublish->status != 1) {
                $data = array(
                    'code' => 0,
                    'msg' => '该商品已经失效'
                );
            } else {
                if ($re == false) {
                    
                    $res = ShopOrderModel::create($arr);
                    if ($res) {
                        $data = array(
                            'code' => 1,
                            'msg' => 'success',
                            'data' => $res->id
                        );
                    } else {
                        $data = array(
                            'code' => 0,
                            'msg' => '订单生成失败'
                        );
                    }
                } else {
                    $data = array(
                        'code' => 2,
                        'msg' => '已经购买该商品，无需继续购买'
                    );
                }
            }
        } else {
            $data = array(
                'code' => 1,
                'msg' => 'success',
                'data' => $order->id
            );
        }
        return response()->json($data);
    }

    
    public function pay($id)
    {
        $uid = Auth::id();
        
        $res = ShopOrderModel::where('id', $id)->first();
        if (!empty($res) && $uid == $res->uid) {
            if ($res->status == 0) {
                
                $userInfo = UserDetailModel::where('uid', $uid)->where('balance_status', 0)->select('balance')->first();
                if (!empty($userInfo)) {
                    $balance = $userInfo->balance;
                } else {
                    $balance = 0.00;
                }
                $balance_pay = false;
                if ($balance >= $res->cash) {
                    $balance_pay = true;
                }
                
                $bank = BankAuthModel::where('uid', '=', $id)->where('status', '=', 4)->get();
                
                $payConfig = ConfigModel::getConfigByType('thirdpay');
                $data = array(
                    'id' => $res->id,  
                    'pay_cash' => $res->cash, 
                    'balance' => $balance, 
                    'balance_pay' => $balance_pay, 
                    'bank' => $bank,
                    'pay_config' => $payConfig
                );
                $this->theme->setTitle('商品订单支付');

                
                $goods = GoodsModel::where('id',$res->object_id)->first();
                $this->theme->set('SHOPID', $goods->shop_id);
                $this->theme->setUserId($goods->uid);

                return $this->theme->scope('shop.pay', $data)->render();
            } else {
                return redirect('shop/buyGoods/' . $res->object_id);
            }
        } else {
            abort('404');
        }
    }

    
    public function postPayOrder(Request $request)
    {
        $user = Auth::user();
        $data = $request->except('_token');
        $data['id'] = intval($data['id']);
        
        $orderInfo = ShopOrderModel::where('id', $data['id'])->first();
        
        if ($data['pay_canel'] == 0) {
            
            $password = UserModel::encryptPassword($data['password'], $user->salt);
            if ($password != $user->alternate_password) {
                return redirect()->back()->with(['error' => '您的支付密码不正确']);
            } else {
                $res = ShopOrderModel::buyShopGoods($user->id, $data['id']);
                if ($res) {
                    
                    $goodsInfo = GoodsModel::where('id', $orderInfo->object_id)->first();
                    
                    $salesNum = intval($goodsInfo->sales_num + 1);
                    GoodsModel::where('id', $goodsInfo->id)->update(['sales_num' => $salesNum]);
                    return redirect('/shop/confirm/' . $orderInfo->id);
                } else {
                    return redirect()->back()->with(['error' => '支付失败']);
                }
            }
        } else if (isset($data['pay_type']) && $data['pay_canel'] == 1) {

            if ($data['pay_type'] == 1) {
                $config = ConfigModel::getPayConfig('alipay');
                $objOminipay = Omnipay::gateway('alipay');
                $objOminipay->setPartner($config['partner']);
                $objOminipay->setKey($config['key']);
                $objOminipay->setSellerEmail($config['sellerEmail']);
                $objOminipay->setReturnUrl(env('ALIPAY_RETURN_URL', url('/order/pay/alipay/return'))); 
                $objOminipay->setNotifyUrl(env('ALIPAY_NOTIFY_URL', url('/order/pay/alipay/notify'))); 

                $response = Omnipay::purchase([
                    'out_trade_no' => $orderInfo->code, 
                    'subject' => \CommonClass::getConfig('site_name'), 
                    'total_fee' => $orderInfo->cash, 
                ])->send();
                $response->redirect();

            } else if ($data['pay_type'] == 2) {
                $config = ConfigModel::getPayConfig('wechatpay');
                $wechat = Omnipay::gateway('wechat');
                $wechat->setAppId($config['appId']);
                $wechat->setMchId($config['mchId']);
                $wechat->setAppKey($config['appKey']);
                $params = array(
                    'out_trade_no' => $orderInfo->code, 
                    'notify_url' => env('WECHAT_NOTIFY_URL', url('order/pay/wechat/notify')), 
                    'body' => \CommonClass::getConfig('site_name') . '余额充值', 
                    'total_fee' => $orderInfo->cash, 
                    'fee_type' => 'CNY', 
                );
                $response = $wechat->purchase($params)->send();

                $img = QrCode::size('280')->generate($response->getRedirectUrl());

                $view = array(
                    'cash' => $orderInfo->cash,
                    'img' => $img
                );
                return $this->theme->scope('pay.wechatpay', $view)->render();

            } else if ($data['pay_type'] == 3) {
                dd('银联支付！');
            }
        } else if (isset($data['account']) && $data['pay_canel'] == 2) {
            dd('银行卡支付！');
        } else {
            return redirect()->back()->with(['error' => '请选择一种支付方式']);
        }
    }

    
    public function confirm($id)
    {
        $id = intval($id);
        $orderInfo = ShopOrderModel::where('id', $id)->where('status', 1)->where('object_type', 2)->first();
        if (!empty($orderInfo)) {
            
            $goodsInfo = GoodsModel::getGoodsInfoById($orderInfo->object_id, ['status' => 1]);
            
            $unionAtt = UnionAttachmentModel::where(['object_id' => $orderInfo->object_id, 'object_type' => 4])->get();
            if (!empty($unionAtt)) {
                $attachmentId = array();
                foreach ($unionAtt as $k => $v) {
                    $attachmentId[] = $v['attachment_id'];
                }
                $attachment = AttachmentModel::whereIn('id', $attachmentId)->get();
            } else {
                $attachment = array();
            }

            $data = array(
                'id' => $id,
                'goods_info' => $goodsInfo,
                'attachment' => $attachment
            );
            $this->theme->setTitle('商品确认');

            $this->theme->set('SHOPID', $goodsInfo->shop_id);
            $this->theme->setUserId($goodsInfo->uid);


            return $this->theme->scope('shop.confirm', $data)->render();
        } else {
            abort('404');
        }

    }

    
    public function postConfirm(Request $request)
    {
        $data = $request->except('_token');
        $orderInfo = ShopOrderModel::where('id', $data['id'])->where('object_type', 2)->first();
        $res = ShopOrderModel::confirmGoods($data['id'], Auth::id());
        if ($res) {
            return redirect('shop/buyGoods/' . $orderInfo->object_id . '?comment_type=0');
        }

    }

    
    public function download($id)
    {
        $pathToFile = AttachmentModel::where('id', $id)->first();
        $pathToFile = $pathToFile['url'];
        return response()->download($pathToFile);
    }

    
    public function postRightsInfo(Request $request)
    {
        $data = $request->except('_token');
        
        $orderInfo = ShopOrderModel::where('id', $data['order_id'])->first();
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
            'type' => $data['type'],
            'object_id' => $data['order_id'],
            'object_type' => 2,
            'desc' => $data['desc'],
            'status' => 0,
            'from_uid' => Auth::id(),
            'to_uid' => $toUid,
            'created_at' => date('Y-m-d H:i:s')
        );
        $orderId = $data['order_id'];
        $res = UnionRightsModel::buyGoodsRights($rightsArr, $orderId);
        if ($res) {
            
            return redirect('user/myBuyGoods?status=4');
        }
    }


}
