<?php


namespace App\Modules\Bre\Http\Controllers;

use App\Http\Controllers\IndexController;
use App\Modules\Advertisement\Model\AdModel;
use App\Modules\Advertisement\Model\RecommendModel;
use App\Modules\Advertisement\Model\RePositionModel;
use App\Modules\Article\Model\ArticleModel;
use App\Modules\Manage\Model\LinkModel;
use App\Modules\Task\Model\SuccessCaseModel;
use App\Modules\Task\Model\TaskFocusModel;
use App\Modules\User\Model\CommentModel;
use App\Modules\User\Model\TaskModel;
use App\Modules\User\Model\AuthRecordModel;
use App\Modules\User\Model\UserDetailModel;
use Illuminate\Routing\Controller;
use App\Http\Requests\Request;
use App\Modules\Advertisement\Model\AdTargetModel;
use App\Modules\Manage\Model\ConfigModel;
use Cache;


class HomeController extends IndexController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('common');
    }

    
    public function index()
    {
        
        $banner = \CommonClass::getHomepageBanner();
        $this->theme->set('banner', $banner);

        
        $notice = \CommonClass::getHomepageNotice();
        $this->theme->set('notice',$notice);

        
        $taskWin = \CommonClass::getTaskWin();
        $this->theme->set('task_win',$taskWin);

        
        $withdraw = \CommonClass::getWithdrawSuccess();
        $this->theme->set('withdraw',$withdraw);

        
        $user = \CommonClass::getPhone();
        $this->theme->set('complaints_user',$user);

        
        $taskSer = TaskModel::whereNotNull('task.service')
            ->where('task.status','>',2)->where('task.bounty_status',1)
            ->where('task.begin_at','>',date('Y-m-d H:i:s',time()))->join('users','users.id','=','task.uid')
            ->select('task.*','users.name')
            ->orderBy('task.created_at','DESC')->limit(15)->get()->toArray();
        if(count($taskSer) < 15)
        {
            $taskArr = TaskModel::whereNull('task.service')->where('task.status','>',2)->where('task.bounty_status',1)
                ->where('task.begin_at','>',time())
                ->join('users','users.id','=','task.uid')
                ->select('task.*','users.name')
                ->orderBy('task.created_at','DESC')->limit(15-count($taskSer))->get()->toArray();
        }
        $task = array_merge($taskSer,$taskArr);
        
        $active = TaskFocusModel::join('users','users.id','=','task_focus.uid')
            ->leftJoin('task','task.id','=','task_focus.task_id')
            ->select('task_focus.*','users.name','task.show_cash','task.title')
            ->orderBy('task_focus.created_at','Desc')->limit(10)->get()->toArray();

        
        $recommendPosition = RePositionModel::where('code','HOME_MIDDLE')->where('is_open',1)->first();
        $recommend = RecommendModel::where('recommend.position_id',$recommendPosition['id'])->where('recommend.type','service')->where('recommend.is_open',1)
            ->where(function($recommend){
                $recommend->where('recommend.end_time','0000-00-00 00:00:00')
                    ->orWhere('recommend.end_time','>',date('Y-m-d h:i:s',time()));
            })
            ->leftJoin('users','users.id','=','recommend.recommend_id')->orderBy('recommend.created_at','DESC')->limit(8)->get()->toArray();

        if(!empty($recommend) && is_array($recommend))
        {
            $recommendIds = array();
            foreach($recommend as $m => $n)
            {
                $recommendIds[] = $n['recommend_id'];
            }
            
            $userAuthOne = AuthRecordModel::whereIn('uid', $recommendIds)->where('status', 2)->where('auth_code','!=','realname')->get()->toArray();
            $userAuthTwo = AuthRecordModel::whereIn('uid', $recommendIds)->where('status', 1)->where('auth_code','realname')->get()->toArray();
            $userAuth = array_merge($userAuthOne,$userAuthTwo);
            
            $busSuccess = SuccessCaseModel::whereIn('uid',$recommendIds)
                    ->leftJoin('cate','cate.id','=','success_case.cate_id')
                    ->select('success_case.*','cate.name')
                    ->orderBy('success_case.created_at','DESC')->get()->toArray();

            
            $goodComments = CommentModel::whereIn('to_uid',$recommendIds)->where('type',1)->get()->toArray();
            $comments = CommentModel::whereIn('to_uid',$recommendIds)->get()->toArray();
            foreach($recommend as $m => $n)
            {
                if(!empty($busSuccess) && is_array($busSuccess)){
                    foreach($busSuccess as $a => $b){
                        if($n['recommend_id'] == $b['uid']){
                            $recommend[$m]['success'][] = $b;
                        }
                    }
                }
                if(!empty($goodComments) && is_array($goodComments)){
                    foreach($goodComments as $c => $d){
                        if($n['recommend_id'] == $d['to_uid']){
                            $recommend[$m]['good_comments'][] = $d;
                        }
                    }
                }
                if(!empty($comments) && is_array($comments)){
                    foreach($comments as $e => $f){
                        if($n['recommend_id'] == $f['to_uid']){
                            $recommend[$m]['comments'][] = $f;
                        }
                    }
                }
                if (!empty($userAuth) && is_array($userAuth)) {
                    foreach ($userAuth as $w => $z) {
                        if ($n['recommend_id'] == $z['uid']) {
                            $recommend[$m]['authCode'][] = $z;
                        }
                    }
                }
            }
            foreach($recommend as $m => $n){
                if(!isset($recommend[$m]['success'])){
                    $recommend[$m]['success'] = array();
                }
                if(!isset($recommend[$m]['comments'])){
                    $recommend[$m]['comments'] = array();
                }
                if(!isset($recommend[$m]['goodCommentsRate'])){
                    $recommend[$m]['good_comments'] = array();
                }
                if( !empty($recommend[$m]['comments']))
                {
                    $recommend[$m]['good_comment_rate'] = intval((count($recommend[$m]['good_comments'])/count( $recommend[$m]['comments']))*100);
                }
                else
                {
                    $recommend[$m]['good_comment_rate'] = 100;
                }

                if(!empty($recommend[$m]['authCode']) && is_array($recommend[$m]['authCode'])) {
                    foreach ($recommend[$m]['authCode'] as $k => $v) {
                        $recommend[$m]['auth'][] = $v['auth_code'];
                    }
                    if (in_array('realname', $recommend[$m]['auth'])) {
                        $recommend[$m]['realname_auth'] = true;
                    } else {
                        $recommend[$m]['realname_auth']  = false;
                    }
                    if (in_array('bank', $recommend[$m]['auth'])) {
                        $recommend[$m]['bank_auth']  = true;
                    } else {
                        $recommend[$m]['bank_auth'] = false;
                    }
                    if (in_array('alipay', $recommend[$m]['auth'])) {
                        $recommend[$m]['alipay_auth'] = true;
                    } else {
                        $recommend[$m]['alipay_auth']= false;
                    }
                }else{
                    $recommend[$m]['realname_auth']  = false;
                    $recommend[$m]['bank_auth'] = false;
                    $recommend[$m]['alipay_auth'] = false;
                }
            }
        }
        $count = count($recommend);
        $recommendArr = array();
        
        for($a=0;$a<$count;$a=$a+2) {
            if(isset($recommend[$a+1])) {
                $reArr = array($recommend[$a],$recommend[$a+1]);
            } else {
                $reArr = array($recommend[$a]);
            }
            $recommendArr[] = $reArr;
        }
        
        $recommendPositionSuccess = RePositionModel::where('code','HOME_MIDDLE_BOTTOM')->where('is_open',1)->first();
        $recommendSuccess = RecommendModel::where('recommend.position_id',$recommendPositionSuccess['id'])->where('recommend.type','successcase')->where('recommend.is_open',1)
            ->where(function($recommendSuccess){
            $recommendSuccess->where('recommend.end_time','0000-00-00 00:00:00')
                ->orWhere('recommend.end_time','>',date('Y-m-d h:i:s',time()));
        })
            ->join('success_case','success_case.id','=','recommend.recommend_id')
            ->leftJoin('cate','cate.id','=','success_case.cate_id')
            ->leftJoin('user_detail','user_detail.uid','=','success_case.uid')
            ->leftJoin('users','users.id','=','success_case.uid')
            ->select('recommend.*','success_case.id','success_case.cate_id','success_case.title','cate.name','user_detail.avatar','users.name as username')
            ->orderBy('recommend.sort','ASC')->orderBy('recommend.created_at','DESC')->limit(4)->get()->toArray();

        
        $recommendPositionArticle = RePositionModel::where('code','HOME_BOTTOM')->where('is_open',1)->first();
        $article = RecommendModel::where('recommend.position_id',$recommendPositionArticle['id'])->where('recommend.type','article')->where('recommend.is_open',1)
            ->where(function($article){
                $article->where('recommend.end_time','0000-00-00 00:00:00')
                ->orWhere('recommend.end_time','>',date('Y-m-d h:i:s',time()));
        })
            ->join('article','article.id','=','recommend.recommend_id')
            ->leftJoin('article_category','article_category.id','=','article.cat_id')
            ->select('recommend.*','article_category.cate_name','article.summary')
            ->orderBy('recommend.created_at','DESC')->limit(5)->get()->toArray();
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

        
        $friendUrl = LinkModel::orderBy('addTime','DESC')->where('status',1)->get()->toArray();

        
        
        $adTarget = AdTargetModel::where('code','HOME_BOTTOM')->select('target_id')->first();
        if($adTarget['target_id']){
            $buttomPicInfo = AdModel::where('target_id',$adTarget['target_id'])
                ->where('is_open','1')
                ->where(function($buttomPicInfo){
                    $buttomPicInfo->where('end_time','0000-00-00 00:00:00')
                        ->orWhere('end_time','>',date('Y-m-d h:i:s',time()));
                })
                ->select('ad_file','ad_url')
                ->get();
            if(count($buttomPicInfo)){
                $ad = $buttomPicInfo;
            }
            else{
                $ad = [];
            }
        }

        $data = array(
            'task' => $task,
            'active' => $active,
            'articleArr' => $articleArr,
            'recommend' => $recommendArr,
            'recommend_position' => $recommendPosition,
            'success' => $recommendSuccess,
            'recommend_success' =>$recommendPositionSuccess,
            'article' => $article,
            'recommend_article' => $recommendPositionArticle,
            'friendUrl' => $friendUrl,
            'ad' => $ad
        );
        
        if(Cache::get('seo_config')){
            $seoConfig = Cache::get('seo_config');
        }else{
            $seoConfig = ConfigModel::getConfigByType('seo');
            Cache::put('seo_config',$seoConfig,120);
        }
        if(!empty($seoConfig['seo_index']) && is_array($seoConfig['seo_index'])){
            $this->theme->setTitle($seoConfig['seo_index']['title']);
            $this->theme->set('keywords',$seoConfig['seo_index']['keywords']);
            $this->theme->set('description',$seoConfig['seo_index']['description']);
        }else{
            $this->theme->setTitle('威客|系统—客客出品,专业威客建站系统开源平台');
            $this->theme->set('keywords','威客,众包,众包建站,威客建站,建站系统,在线交易平台');
            $this->theme->set('description','客客专业开源建站系统，国内外知名站长使用最多的众包威客系统，建在线交易平台，首选KPPW众包威客开源建站系统。');
        }
        $this->theme->set('now_menu','/bre/homePage');
        return $this->theme->scope('bre.homepage',$data)->render();

    }









}