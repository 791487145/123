<?php
/**
 * ------------------------
 * Created by PhpStorm.
 * ------------------------
 *
 * ------------------------
 * Author: frank
 * Date: 16-4-19
 * Desc:
 * ------------------------
 *
 */

namespace App\Http\Controllers;

use App\Modules\Advertisement\Model\RecommendModel;
use App\Modules\Advertisement\Model\RePositionModel;
use App\Modules\Finance\Model\CashoutModel;
use App\Modules\Manage\Model\LinkModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\Shop\Models\ShopTagsModel;
use App\Modules\Task\Model\SuccessCaseModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\CommentModel;
use App\Modules\User\Model\TagsModel;
use App\Modules\User\Model\TaskModel;
use App\Modules\User\Model\AuthRecordModel;
use App\Modules\User\Model\UserModel;
use App\Modules\User\Model\UserTagsModel;
use Illuminate\Routing\Controller;
use App\Modules\Advertisement\Model\AdTargetModel;
use App\Modules\Manage\Model\ConfigModel;
use Cache;
use Teepluss\Theme\Theme;


class HomeController extends IndexController
{
    public function __construct()
    {

        parent::__construct();
        $this->initTheme('common');
    }

    /**
     * 首页
     * @return mixed
     */
    public function index()
    {
        //首页banner
        $banner = \CommonClass::getHomepageBanner();
        $this->theme->set('banner', $banner);

        //公告
        $notice = \CommonClass::getHomepageNotice();
        $this->theme->set('notice',$notice);

        //中标通知
        $taskWin = WorkModel::where('work.status',1)->join('users','users.id','=','work.uid')
            ->leftJoin('task','task.id','=','work.task_id')
            ->select('work.*','users.name','task.show_cash','task.title')
            ->orderBy('work.bid_at','Desc')->limit(5)->get()->toArray();
        $this->theme->set('task_win',$taskWin);

        //提现
        $withdraw = CashoutModel::where('cashout.status',1)->join('users','users.id','=','cashout.uid')
            ->select('cashout.*','users.name')
            ->orderBy('cashout.updated_at','DESC')->limit(5)->get()->toArray();
        $this->theme->set('withdraw',$withdraw);

        //投诉建议用户信息
        $user = \CommonClass::getPhone();
        $this->theme->set('complaints_user',$user);

        //最新任务查询前15条
        $task = TaskModel::where('task.status','>',2)->where(function($query){
                    $query->where(function($querys){
                        $querys->where('task.bounty_status',1)->where('task_type.alias','xuanshang');
                    })->orwhere(function($querys){
                        $querys->where('task_type.alias','zhaobiao');
                    });
            })     //where('task.bounty_status',1)
            ->where('task.begin_at','<',date('Y-m-d H:i:s',time()))
			->where('task.status','!=',10)
            ->join('users','users.id','=','task.uid')
            ->leftJoin('task_type','task.type_id','=','task_type.id')
            ->leftJoin('user_detail','user_detail.uid','=','task.uid')
            ->select('task.*','users.name','user_detail.avatar')
            ->orderBy('task.created_at','DESC')
            ->orderBy('task.top_status','DESC')->limit(15)->get()->toArray();
        //最新动态查询前10条
        $active = WorkModel::where('work.status',1)->join('users','users.id','=','work.uid')
            ->leftJoin('task','task.id','=','work.task_id')
            ->select('work.*','users.name','task.show_cash','task.title')
            ->orderBy('work.bid_at','Desc')->limit(10)->get()->toArray();

        //推荐店铺
        $recommendPositionShop = RePositionModel::where('code','HOME_MIDDLE_SHOP')->where('is_open',1)->first();
        if($recommendPositionShop['id']){
            $recommendShop = RecommendModel::getRecommendInfo($recommendPositionShop['id'],'shop')
                ->leftJoin('shop','shop.id','=','recommend.recommend_id')->orderBy('recommend.created_at','DESC')
                ->get()->toArray();
        }else{
            $recommendShop = [];
        }
        if(!empty($recommendShop) && is_array($recommendShop))
        {
            $recommendIds = array();
            $recommendShopIds = array();
            foreach($recommendShop as $m => $n)
            {
                $recommendIds[] = $n['uid'];
                $recommendShopIds[] = $n['recommend_id'];
            }
            if(!empty($recommendIds)){
                //查询店铺和店铺所属用户的绑定关系
                $userAuthOne = AuthRecordModel::whereIn('uid', $recommendIds)->where('status', 2)
                    ->whereIn('auth_code',['bank','alipay'])->get()->toArray();
                $userAuthTwo = AuthRecordModel::whereIn('uid', $recommendIds)->where('status', 1)
                    ->whereIn('auth_code',['realname','enterprise'])->get()->toArray();
                $emailAuth = UserModel::whereIn('id',$recommendIds)->select('id','email_status')->get()->toArray();
                $userAuth = array_merge($userAuthOne,$userAuthTwo);
            }else{
                $emailAuth = array();
                $userAuth = array();
            }
            if(!empty($recommendShopIds)){
                //查询店铺作品和服务
                $shopGoods = GoodsModel::whereIn('goods.shop_id',$recommendShopIds)->where('goods.status',1)
                    ->where('goods.is_delete',0)
                    ->leftJoin('cate','cate.id','=','goods.cate_id')
                    ->select('goods.*','cate.name')
                    ->orderBy('goods.created_at','DESC')->get()->toArray();
                //查询店铺的技能标签
                $skill = ShopTagsModel::whereIn('shop_id',$recommendShopIds)
                    ->leftJoin('skill_tags','skill_tags.id','=','tag_shop.tag_id')
                    ->select('tag_shop.*','skill_tags.tag_name')->get()->toArray();
                $newSkill = array();
                if(!empty($skill)){
                    $newSkill = array_reduce($skill,function(&$newSkill,$v){
                        $newSkill[$v['shop_id']][] = $v;
                        return $newSkill;
                    });
                }
                $sk = array();
                if(!empty($newSkill)){
                    foreach($newSkill as $k => $v){
                        foreach($v as $a => $b){
                            if($k == $b['shop_id']){
                                $sk[$k][] = $b['tag_name'];
                            }
                        }
                    }
                }
            }else{
                $shopGoods = array();
            }
            foreach($recommendShop as $m => $n)
            {
                if(!empty($shopGoods) && is_array($shopGoods)){
                    foreach($shopGoods as $a => $b){
                        if($n['uid'] == $b['uid']){
                            $recommendShop[$m]['success'][] = $b;
                        }
                    }
                }
                if (!empty($userAuth) && is_array($userAuth)) {
                    foreach ($userAuth as $w => $z) {
                        if ($n['uid'] == $z['uid']) {
                            $recommendShop[$m]['authCode'][] = $z;
                        }
                    }
                }
                if (!empty($emailAuth) && is_array($emailAuth)) {
                    foreach ($emailAuth as $x => $y) {
                        if ($n['uid'] == $y['id']) {
                            $recommendShop[$m]['email_status'] = $y['email_status'];
                        }
                    }
                }
                if(!empty($sk) && is_array($sk)){
                    foreach($sk as $kk => $vv){
                        if($n['recommend_id'] == $kk){
                            $recommendShop[$m]['skill_name'] = implode('|',$vv);
                        }
                    }
                }
            }
            foreach($recommendShop as $m => $n){
                if(!isset($recommendShop[$m]['success'])){
                    $recommendShop[$m]['success'] = array();
                }
                if( !empty($recommendShop[$m]['total_comment']))
                {
                    $recommendShop[$m]['good_comment_rate'] =
                        intval(($recommendShop[$m]['good_comment']/ $recommendShop[$m]['total_comment'])*100);
                }
                else
                {
                    $recommendShop[$m]['good_comment_rate'] = 100;
                }

                if(!empty($recommendShop[$m]['authCode']) && is_array($recommendShop[$m]['authCode'])) {
                    foreach ($recommendShop[$m]['authCode'] as $k => $v) {
                        $recommendShop[$m]['auth'][] = $v['auth_code'];
                    }
                    if (in_array('realname', $recommendShop[$m]['auth'])) {
                        $recommendShop[$m]['realname_auth'] = true;
                    } else {
                        $recommendShop[$m]['realname_auth']  = false;
                    }
                    if (in_array('bank', $recommendShop[$m]['auth'])) {
                        $recommendShop[$m]['bank_auth']  = true;
                    } else {
                        $recommendShop[$m]['bank_auth'] = false;
                    }
                    if (in_array('alipay', $recommendShop[$m]['auth'])) {
                        $recommendShop[$m]['alipay_auth'] = true;
                    } else {
                        $recommendShop[$m]['alipay_auth']= false;
                    }
                    if (in_array('enterprise', $recommendShop[$m]['auth'])) {
                        $recommendShop[$m]['enterprise_auth'] = true;
                    } else {
                        $recommendShop[$m]['enterprise_auth']= false;
                    }
                }else{
                    $recommendShop[$m]['realname_auth']  = false;
                    $recommendShop[$m]['bank_auth'] = false;
                    $recommendShop[$m]['alipay_auth'] = false;
                    $recommendShop[$m]['enterprise_auth']= false;
                }
            }
        }
        $count = count($recommendShop);
        $recommendShopArr = array();
        //重新组装推荐服务商的数组
        for($a=0;$a<$count;$a=$a+2) {
            if(isset($recommendShop[$a+1])) {
                $reArr = array($recommendShop[$a],$recommendShop[$a+1]);
            } else {
                $reArr = array($recommendShop[$a]);
            }
            $recommendShopArr[] = $reArr;
        }
        //作品
        $recommendPositionWork = RePositionModel::where('code','HOME_MIDDLE_WORK')->where('is_open',1)->first();
        if($recommendPositionWork['id']){
            $recommendWork = RecommendModel::getRecommendInfo($recommendPositionWork['id'],'work')
                ->join('goods','goods.id','=','recommend.recommend_id')
                ->leftJoin('cate','cate.id','=','goods.cate_id')
                ->select('recommend.*','goods.*','cate.name')
                ->orderBy('recommend.sort','ASC')->orderBy('recommend.created_at','DESC')->get()->toArray();
        }else{
            $recommendWork = [];
        }

        //服务
        $recommendPositionServer = RePositionModel::where('code','HOME_MIDDLE_SERVICE')->where('is_open',1)->first();
        if($recommendPositionServer['id']){
            $recommendServer = RecommendModel::getRecommendInfo($recommendPositionServer['id'],'server')
                ->join('goods','goods.id','=','recommend.recommend_id')
                ->leftJoin('cate','cate.id','=','goods.cate_id')
                ->select('recommend.*','goods.*','cate.name')
                ->orderBy('recommend.sort','ASC')->orderBy('recommend.created_at','DESC')->get()->toArray();
        }else{
            $recommendServer = [];
        }

        //成功案例
        $recommendPositionSuccess = RePositionModel::where('code','HOME_MIDDLE_BOTTOM')->where('is_open',1)->first();
        if($recommendPositionSuccess['id']){
            $recommendSuccess = RecommendModel::getRecommendInfo($recommendPositionSuccess['id'],'successcase')
                ->join('success_case','success_case.id','=','recommend.recommend_id')
                ->leftJoin('cate','cate.id','=','success_case.cate_id')
                ->leftJoin('user_detail','user_detail.uid','=','success_case.uid')
                ->leftJoin('users','users.id','=','success_case.uid')
                ->select('recommend.*','success_case.id','success_case.cate_id','success_case.title','success_case.pic as success_pic',
                    'cate.name','user_detail.avatar','users.name as username')
                ->orderBy('recommend.sort','ASC')->orderBy('recommend.created_at','DESC')->get()->toArray();
        }else{
            $recommendSuccess = [];
        }

        //资讯
        $recommendPositionArticle = RePositionModel::where('code','HOME_BOTTOM')->where('is_open',1)->first();
        if($recommendPositionArticle['id']){
            $article = RecommendModel::getRecommendInfo($recommendPositionArticle['id'],'article')
                ->join('article','article.id','=','recommend.recommend_id')
                ->leftJoin('article_category','article_category.id','=','article.cat_id')
                ->select('recommend.*','article_category.cate_name','article.summary','article.title')
                ->orderBy('recommend.created_at','DESC')->get()->toArray();
        }else{
            $article = [];
        }

        $articleArr = array();
        if(!empty($article) && is_array($article))
        {
            foreach($article as $k => $v)
            {
                if($k > 0)
                {
                    $articleArr[] = $v;
                }
            }
        }
        //友情链接
        $friendUrl = LinkModel::where('status',1)->orderBy('sort','ASC')->orderBy('addTime','DESC')->get()->toArray();

        //广告位
        $ad = AdTargetModel::getAdInfo('HOME_BOTTOM');
        $data = array(
            'task' => $task,
            'active' => $active,
            'recommend_shop' => $recommendPositionShop,
            'shop_before' => $recommendShop,
            'shop' => $recommendShopArr,
            'recommend_work' => $recommendPositionWork,
            'work' => $recommendWork,
            'recommend_server' => $recommendPositionServer,
            'server' => $recommendServer,
            'success' => $recommendSuccess,
            'recommend_success' =>$recommendPositionSuccess,
            'articleArr' => $articleArr,
            'article' => $article,
            'recommend_article' => $recommendPositionArticle,
            'friendUrl' => $friendUrl,
            'ad' => $ad
        );

        if ($this->themeName == 'black'){
            $list = UserModel::select('user_detail.sign', 'users.name', 'user_detail.avatar', 'users.id','users.email_status','user_detail.employee_praise_rate','user_detail.shop_status','shop.is_recommend','shop.id as shopId')
                ->leftJoin('user_detail', 'users.id', '=', 'user_detail.uid')
                ->leftJoin('shop','user_detail.uid','=','shop.uid')->where('users.status','<>', 2)
                ->orderBy('shop.is_recommend','DESC')
                ->limit(5)->get();
            if (!empty($list)){

                foreach ($list as $k => $v){
                    $arrUid[] = $v->id;
                }
            } else {
                $arrUid = 0;
            }
            //查询所有评价数组
            $comment = CommentModel::whereIn('to_uid',$arrUid)->get()->toArray();
            if(!empty($comment)){
                //根据uid重组数组
                $newComment = array_reduce($comment,function(&$newComment,$v){
                    $newComment[$v['to_uid']][] = $v;
                    return $newComment;
                });
                $commentCount = array();
                if(!empty($newComment)){
                    foreach($newComment as $c => $d){
                        $commentCount[$c]['to_uid'] = $c;
                        $commentCount[$c]['count'] = count($d);
                    }
                }
                //查询好评评价数组
                $goodComment = CommentModel::whereIn('to_uid',$arrUid)->where('type',1)->get()->toArray();
                //根据uid重组数组
                $newGoodsComment = array_reduce($goodComment,function(&$newGoodsComment,$v){
                    $newGoodsComment[$v['to_uid']][] = $v;
                    return $newGoodsComment;
                });
                $goodCommentCount = array();
                if(!empty($newGoodsComment)){
                    foreach($newGoodsComment as $a => $b){
                        $goodCommentCount[$a]['to_uid'] = $a;
                        $goodCommentCount[$a]['count'] = count($b);
                    }
                }
                //把好评数和评价数拼入$list数组
                foreach($list as $key => $value){
                    foreach($goodCommentCount as $a => $b){
                        if($value['id'] == $b['to_uid']){
                            $list[$key]['good_comment_count'] = $b['count'];
                        }
                    }
                    foreach($commentCount as $c => $d){
                        if($value['id'] == $d['to_uid']){
                            $list[$key]['comment_count'] = $d['count'];
                        }
                    }
                }
                foreach ($list as $key => $item) {

                    /*//根据用户id查询店铺id
                    $item->shopId = ShopModel::getShopIdByUid($item->id);*/
                    //计算好评率
                    if($item->comment_count > 0){
                        $item->percent = ceil($item->good_comment_count/$item->comment_count*100);
                        //$item->percent = $item->percent?$item->percent:100;
                    }
                    else{
                        $item->percent = 100;
                    }
                }
            }else{
                foreach ($list as $key => $item) {
                    //计算好评率
                    $item->percent = 100;
                }
            }

            //查询行业标签
            $arrSkill = UserTagsModel::getTagsByUserId($arrUid);

            if(!empty($arrSkill) && is_array($arrSkill)){
                foreach ($arrSkill as $item){
                    $arrTagId[] = $item['tag_id'];
                }

                $arrTagName = TagsModel::select('id', 'tag_name')->whereIn('id', $arrTagId)->get()->toArray();
                foreach ($arrSkill as $item){
                    foreach ($arrTagName as $value){
                        if ($item['tag_id'] == $value['id']){
                            $arrUserTag[$item['uid']][] = $value['tag_name'];
                        }
                    }
                }
                foreach ($list as $key => $item){
                    foreach ($arrUserTag as $k => $v){
                        if ($item->id == $k){
                            $list[$key]['skill'] = $v;
                        }
                    }
                }

                $data['service'] = $list;
            }

            //查询服务商的认证情况
            $userAuthOne = AuthRecordModel::whereIn('uid', $arrUid)->where('status', 2)->where('auth_code','!=','realname')->get()->toArray();
            $userAuthTwo = AuthRecordModel::whereIn('uid', $arrUid)->where('status', 1)
                ->whereIn('auth_code',['realname','enterprise'])->get()->toArray();
            $userAuth = array_merge($userAuthOne,$userAuthTwo);
            $auth = array();
            if(!empty($userAuth) && is_array($userAuth)){
                foreach($userAuth as $a => $b){
                    foreach($userAuth as $c => $d){
                        if($b['uid'] = $d['uid']){
                            $auth[$b['uid']][] = $d['auth_code'];
                        }
                    }
                }
            }
            if(!empty($auth) && is_array($auth)) {
                foreach ($auth as $e => $f) {
                    $auth[$e]['uid'] = $e;
                    if (in_array('realname', $f)) {
                        $auth[$e]['realname'] = true;
                    } else {
                        $auth[$e]['realname'] = false;
                    }
                    if (in_array('bank', $f)) {
                        $auth[$e]['bank'] = true;
                    } else {
                        $auth[$e]['bank'] = false;
                    }
                    if (in_array('alipay', $f)) {
                        $auth[$e]['alipay'] = true;
                    } else {
                        $auth[$e]['alipay'] = false;
                    }
                    if (in_array('enterprise', $f)) {
                        $auth[$e]['enterprise'] = true;
                    } else {
                        $auth[$e]['enterprise'] = false;
                    }
                }
                foreach ($list as $key => $item) {
                    //拼接认证信息
                    foreach ($auth as $a => $b) {
                        if ($item->id == $b['uid']) {
                            $list[$key]['auth'] = $b;
                        }
                    }
                }
            }

            $goodsInfo = GoodsModel::where('status',1)
                ->select('id','uid','shop_id','title','type','cash','cover','sales_num','good_comment', 'comments_num')
                ->where(function($goodsInfo){
                    $goodsInfo->where('is_recommend',0)
                        ->orWhere(function($goodsInfo){
                            $goodsInfo->where('is_recommend',1)
                                ->where('recommend_end','>',date('Y-m-d H:i:s',time()));
                        });})
                ->orderBy('is_recommend','desc')->orderBy('created_at','desc')->limit(10)->get();
            if (!empty($goodsInfo->toArray())){
                foreach($goodsInfo as $k => $v){
                    $uid[] = $v->uid;
                }

                $cityInfo = ShopModel::join('district', 'shop.city', '=', 'district.id')
                    ->select('shop.uid','district.name')->whereIn('shop.uid', $uid)->get();

                if(!empty($cityInfo)){
                    foreach($cityInfo as $ck => $cv){
                        $cityInfo[$cv->uid] = $cv->name;
                        foreach($goodsInfo as $gk => $gv){
                            if ($cv->uid == $gv->uid){
                                $goodsInfo[$gk]->addr = $cityInfo[$gv->uid];
                            }
                        }
                    }


                }
            }
            $data['goods'] = json_encode($goodsInfo);

            $data['danmu'] = json_encode($data['task']);
        }
        //seo配置信息
        $seoConfig = ConfigModel::getConfigByType('seo');

        if(!empty($seoConfig['seo_index']) && is_array($seoConfig['seo_index'])){
            $this->theme->setTitle($seoConfig['seo_index']['title']);
            $this->theme->set('keywords',$seoConfig['seo_index']['keywords']);
            $this->theme->set('description',$seoConfig['seo_index']['description']);
        }else{
            $this->theme->setTitle('威客|系统—客客出品,专业威客建站系统开源平台');
            $this->theme->set('keywords','威客,众包,众包建站,威客建站,建站系统,在线交易平台');
            $this->theme->set('description','客客专业开源建站系统，国内外知名站长使用最多的众包威客系统，建在线交易平台。');
        }
        $this->theme->set('now_menu','/');
        return $this->theme->scope('bre.homepage',$data)->render();

    }











}