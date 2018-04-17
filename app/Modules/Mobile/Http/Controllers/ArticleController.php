<?php

namespace App\Modules\Mobile\Http\Controllers;

use App\Modules\Advertisement\Model\AdModel;
use App\Modules\Article\Model\ArticleModel;
use App\Modules\Manage\Model\ArticleCategoryModel;
use App\Modules\Article\Model\ArticleCommentModel;
use App\Modules\Manage\Model\CampusRecruitmentModel;
use App\Modules\Manage\Model\IconModel;
use App\Modules\Manage\Model\UserArticleThumbupModel;
use App\Modules\Manage\Model\UserArticleCommentThumbupModel;
use App\Modules\Task\Model\TaskModel;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Crypt;
use Validator;
use DB;
use Cache;

class ArticleController extends ApiBaseController
{
    /**获取文章种类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategory(Request $request)
    {
        $m = ArticleCategoryModel::get()->toArray();
        $upIDs = ArticleCategoryModel::_reSort($m,1);

        $result = array('code' => self::RET_SUCCESS, 'message' => '', 'data' =>$upIDs);
        // return response()->json($result);
        return $this->formateResponse(1000,'success',$result);
    }

    /**广告(post:/article/getADs)
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getADs(Request $request)
    {
        if(Cache::has('ads')){
            $data = Cache::get('ads');
        }else{
            $data['ads_index'] = IconModel::getIconInfoFromSort(IconModel::ICON_TYPE_AD,IconModel::ICON_AD_INDEX);
            $data['ads_zixun'] = IconModel::getIconInfoFromSort(IconModel::ICON_TYPE_AD,IconModel::ICON_AD_ZIXUN_RECOMMENT);
            $data['ads_task'] = IconModel::getIconInfoFromSort(IconModel::ICON_TYPE_AD,IconModel::INCO_AD_TASK);
            Cache::put('ads',$data,24*60);
        }

        return $this->formateResponse(1000,'success',$data);
    }

    /**文章内容(get:/article/getArticle)
     * @param Request $request
     * @param $articleId 文章ID
     * @param $type 种类1：文章；2：招聘
     * @return \Illuminate\Http\JsonResponse
     */
    public function getArticle(Request $request)
    {
        $articleId = intval($request->input('articleId',0));
        $type = $request->input('type',1);
        if($articleId == 0){
            return $this->formateResponse(1001,'请填写文章id');
        }

        if($type == 1){
            $data = ArticleModel::whereId($articleId)->select('cat_id','author','title','from','summary','created_at','content','view_times','thumb_up_number','thumb_pic')->first();
            if(is_null($data)){
                return $this->formateResponse(1001,'无法找到该文章');
            }
            $data = $data->toArray();
            $data['userArticleCommentThumbup'] = 1;
            $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
            $userArticleCommentThumbup = UserArticleThumbupModel::where('uid',$tokenInfo['uid'])->where('article_id',$articleId)->first();
            if(is_null($userArticleCommentThumbup)){
                $data['userArticleCommentThumbup'] = 0;
            }
            $data['content'] = htmlspecialchars_decode($data['content']);
            $data['author'] = ($data['author'] == 'admin') ? '官方' :  $data['author'] ;
            $data['category_name'] = ArticleCategoryModel::whereId($data['cat_id'])->pluck('cate_name');
            ArticleModel::whereId($articleId)->increment('view_times',1);
        }

        if($type == 2){
            $data = CampusRecruitmentModel::whereId($articleId)->whereStatus('valid')->select()->first();
            if(is_null($data)){
                return $this->formateResponse(1001,'无法找到该招聘信息');
            }
            $data = $data->toArray();
        }

        return $this->formateResponse(1000,'success',$data);
    }

    /**
     * 推荐中心（post:activeCenter）
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function activeCenter(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data,[
            'limit' => 'required|integer|min:1',
        ],[
            'limit.required' => '请填写数量',
            'limit.integer' => '请输入整数',
            'limit.min' => '最小值为1',
        ]);

        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }

        $num = $request->input('page_num',1);

        $offset_task = ($num - 1) * 2;
        $offset_article = ($num - 1) * 3;
        $offset_campus = ($num - 1) * ($data['limit'] -5);

        $date['task'] = TaskModel::where('task.status',TaskModel::TASK_PUB)->orderBy('task.id','desc')->limit($data['limit'])->offset($offset_task)
            ->leftJoin('cate','cate.id','=','task.cate_id')
            ->leftJoin('users','users.id','=','task.uid')
            ->leftJoin('district_region','district_region.id','=','task.area')
            ->select('task.id','task.title','task.desc','task.bounty','users.head_img as avatar','task.created_at','task.uid','cate.name as task_cate_name','users.name as username','district_region.name as schoolName')
            ->get();
        if(!$date['task']->isEmpty()){
            foreach($date['task'] as $val){
                $val->type = 5;
            }
            $date['task'] = $date['task']->toArray();
        }
        $offset_article = $offset_article + $offset_task - count($date['task']);


        $date['infos'] = ArticleModel::where('is_recommended',1)->limit($data['limit'])->offset($offset_article)
                          ->select('id','created_at','title','summary','view_times','thumb_pic')->orderBy('id', 'desc')
                         ->get();
        if (!$date['infos']->isEmpty()) {
            foreach($date['infos'] as $v){
                if(empty($v->thumb_pic)){
                    $v->type = 1;
                }else{
                    $v->type = 2;
                    $v->thumb_pic_1 = $v->thumb_pic;
                }
                $v->create_at = self::timeShow($v->created_at);
            }
            $date['infos'] = $date['infos']->toArray();
        }
        $offset_campus = $offset_campus + $offset_article - count($date['infos']);

        //招聘校园
        $date['invites'] = CampusRecruitmentModel::whereStatus('valid')->select('id','post_name','salary','create_at','post_demand','company_name')->orderBy('id', 'desc')->limit($data['limit'])->offset($offset_campus)->get();
        if (!$date['invites']->isEmpty()) {
            foreach($date['invites'] as  $val){
                $val->title = $val->post_name;
                if(empty($val->thumb_pic)){
                    $val->type = 1;
                }else{
                    $val->type = 2;
                    $val->thumb_pic_1 = $val->thumb_pic;
                }
                $val->create_at = self::timeShow($val->created_at);
            }
            $date['invites'] = $date['invites']->toArray();
        }

        if(is_array($date['infos']) && is_array($date['task']) && is_array($date['invites'])){
            $data = array_merge($date['infos'],array_merge($date['invites'],$date['task']));
        }
        if(is_array($date['infos']) && !is_array($date['task']) && !is_array($date['invites'])){
            $data = $date['infos'];
        }
        if(!is_array($date['infos']) && is_array($date['task']) && !is_array($date['invites'])){
            $data = $date['task'];
        }
        if(is_array($date['infos']) && is_array($date['task']) && !is_array($date['invites'])){
            $data = $date['invites'];
        }
        if(is_array($date['infos']) && is_array($date['task']) && !is_array($date['invites'])){
            $data = array_merge($date['task'],$date['task']);
        }
        if(is_array($date['infos']) && !is_array($date['task']) && is_array($date['invites'])){
            $data = array_merge($date['infos'],$date['invites']);
        }
        if(!is_array($date['infos']) && is_array($date['task']) && is_array($date['invites'])){
            $data = array_merge($date['task'],$date['invites']);
        }
        if(!is_array($date['infos']) && !is_array($date['task']) && !is_array($date['invites'])){
            $data = '';
        }

        if(empty($data)){
            return $this->formateResponse(2000,'暂无数据');
        }
        //$data
       /* //广告
        $data['ads'] = IconModel::getIconInfoFromSort(IconModel::ICON_TYPE_AD,IconModel::ICON_AD_ZIXUN_RECOMMENT);
        $data['lunbo'] = IconModel::getIconInfoFromSort(IconModel::ICON_TYPE_CAROUSEL,IconModel::ICON_AD_ZIXUN_RECOMMENT);
        Cache::put('infos_actives_invites_ads',$data,3*60);*/

        return $this->formateResponse(1000,'success',$data);
    }

    //招聘列表
    /**
     * /article/campusRecruitment
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function campusRecruitment(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data,[
            'limit' => 'required|integer|min:1',
        ],[
            'limit.required' => '请填写数量',
            'limit.integer' => '请输入整数',
            'limit.min' => '最小值为1',
        ]);

        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }

        $num = $request->input('page_num',1);
        $offset = ($num - 1) * $data['limit'];

        $data = CampusRecruitmentModel::whereStatus('valid')->select('id','post_name','salary','create_at','post_demand','company_name')->orderBy('id','desc')->limit($data['limit'])->offset($offset)->get();
        if ($data->isEmpty()) {
            return $this->formateResponse(2000,'暂无数据');
        }

        foreach($data as  $val){
            $val->title = $val->post_name;
            if(empty($val->thumb_pic)){
                $val->type = 1;
            }else{
                $val->type = 2;
                $val->thumb_pic_1 = $val->thumb_pic;
            }
            $val->create_at = self::timeShow($val->created_at);
        }

        return $this->formateResponse(1000,'success',$data);
    }

    /*public function officialList(Request $request)
    {

    }*/

    /**资讯列表(post:/article/articleTypeList)
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function articleTypeList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ],[
            'type.required' => '请填写分类',
        ]);
        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0]);
        }

        $data = '';
        $type = $request->input('type');
        $page = $request->input('page',1);
        $limit = 20;//每页显示条数
        $offset = ($page - 1) * $limit;

        if($type == 1){
            $data['invites'] = CampusRecruitmentModel::whereStatus('valid')
                                                    ->select('id','post_name','salary','create_at','post_demand','company_name','thumb_pic')
                                                    ->orderBy('id','desc')
                                                    ->limit($limit)->offset($offset)->get()->toArray();
            if(!!empty($data['invites'])){
                foreach($data['invites'] as $k=>$v){
                    $data['invites'][$k]['created_at'] = self::timeShow($v->created_at);
                }
            }
        }

        //资讯
        if($type == 61){
            $data['infos'] = ArticleModel::where('cat_id',$type)
                                        ->select('id','created_at','title','summary','view_times','thumb_pic')
                                        ->orderBy('id','desc')
                                        ->limit($limit)->offset($offset)->get()->toArray();
            if(!empty($data['infos'])){
                foreach($data['infos'] as $k=>$v){
                    $data['infos'][$k]['created_at'] = self::timeShow($v['created_at']);
                }
            }
        }

        //活动
        if($type == 60){
            $data['infos'] = ArticleModel::where('cat_id',$type)
                                        ->select('id','title','view_times','thumb_pic')
                                        ->orderBy('id','desc')
                                        ->limit($limit)->offset($offset)->get()->toArray();
            if(!!empty($data['infos'])){
                foreach($data['infos'] as $k=>$v){
                    $data['infos'][$k]['created_at'] = self::timeShow($v['created_at']);
                }
            }
        }

        return $this->formateResponse(1000,'success',$data);
    }

    /**文章发布
     * @param Request $request
     * @param $title 标题
     * @param $author 作者
     * @param $content 内容
     * @param $cat_id 种类
     * @param $token
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function addArticle(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'content' => 'required',
            'cat_id' => 'required',
            'token' => 'required',
        ],[
            'title.required' => '请输入文章标题',
            'author.required' => '请输入作者',
            'content.required' => '请写内容',
            'cat_id.required' => '请选择种类',
            'token.required' => '参数不完整',
        ]);
        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }

        $result['content'] = htmlspecialchars($request->input('content'));
        if(mb_strlen($result['content']) > 4294967295/3){
            $error['content'] = '文章内容太长，建议减少上传图片';
            if (!empty($error)) {
                return $this->formateResponse(1001, $error['content']);
            }
        }

        $article = new ArticleModel();
        $article->title = $request->input('title');
        $article->cat_id = $request->input('cat_id');
        $article->content = $result['content'];
        $article->user_id = $tokenInfo['uid'];
        $article->author = $request->input('author');
        $article->summary = $request->input('summary','');
        $article->seotitle = $request->input('seotitle','');
        $article->keywords = $request->input('keywords','');
        $article->description = $request->input('description','');
        $article->user_name = $tokenInfo['name'];
        $article->is_recommended = $request->input('is_recommended',2);
        $article->updated_at = date('Y-m-d H:i:s',time());
        $article->created_at = date('Y-m-d H:i:s',time());
        $article->save();

        $result = array('code' => self::RET_SUCCESS, 'message' => '', 'data' =>$article);
        // return response()->json($result);
        return $this->formateResponse(1000,'success',$result);
    }

    /**
     * 文章评论（文章内容防攻击\CommonClass::removeXss、过滤敏感词）
     * @param Request $request [description]
     */
    public function addComment(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $validator = Validator::make($request->all(),[
            'content' => 'required',
            'artical_id' => 'required',
            'token' => 'required'
        ],[
            'content.required' => '请输入评论内容',
            'artical_id.required' => '请输入文章标志',
            'token.required' => '参数不完整'
        ]);
        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0],$error);
        }

        //过滤敏感内容
        $content = $request->input('content');
        $if_sensitive = $this->sensitiveWordFilter($content);
        if($if_sensitive){
            $error = ['评论内容中含有敏感内容，无法提交'];
            return $this->formateResponse(1001,$error);
        };

        $article_comment = array(
            'commentator' => $tokenInfo['name'],
            'commentator_id' => $tokenInfo['uid'],
            // 'content' => \CommonClass::removeXss($content),
            'content' => htmlspecialchars($content),
            'artical_id' => $request->input('artical_id')
        );

        $result = ArticleCommentModel::create($article_comment);

        if($result){
            return $this->formateResponse(1000,'评论成功');
        }
        return $this->formateResponse(1001,'网络错误');
    }

    /**
     * 验证是否有敏感内容
     * @param  $str 待验证内容
     * @return true OR false
     */
    public function sensitiveWordFilter($str)
    {
        // $words = getSensitiveWords();
        // 后续找一个文件吧
        $words = ['fuck','傻逼','bitch啊','CMD','NMD','AAAAAA'];
        $flag = false;

        // 提取中文部分，防止其中夹杂英语等
        preg_match_all("/[\x{4e00}-\x{9fa5}]+/u", $str, $match);
        $chinsesArray = $match[0];
        $chineseStr = implode('', $match[0]);
        $englishStr = strtolower(preg_replace("/[^A-Za-z0-9\.\-]/", " ", $str));

        $flag_arr = array('？', '！', '￥', '（', '）', '：' , '‘' , '’', '“', '”', '《' , '》', '，', 
        '…', '。', '、', 'nbsp', '】', '【' ,'～', '#', '$', '^', '%', '@', '!', '*', '-'. '_', '+', '=');
        $contentFilter = preg_replace('/\s/', '', preg_replace("/[[:punct:]]/", '', 
        strip_tags(html_entity_decode(str_replace($flag_arr, '', $str), ENT_QUOTES, 'UTF-8'))));

        // 全匹配过滤,去除特殊字符后过滤中文及提取中文部分
        foreach ($words as $word)
        {
            // 判断是否包含敏感词,可以减少这里的判断来降低过滤级别，
            if (strpos($str, $word) !== false || strpos($contentFilter, $word) !== false || strpos($chineseStr, $word) !== false 
            || strpos($englishStr, $word) !== false) {
                $flag = true;
            }
        }
        return $flag;
    }

    public function commentThumbsUp(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $validator = Validator::make($request->all(),[
            'artical_comment_id' => 'required',
            'token' => 'required',
        ],[
            'artical_comment_id.required' => '请输入文章标志',
            'token.required' => '参数不完整',
        ]);

        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0],$error);
        $if_already = UserArticleCommentThumbupModel::where('uid',$tokenInfo['uid'])->where('article_comment_id',$request->input('article_comment_id'))->count();
        if($if_already) return $this->formateResponse(1001,'您已经为该文章点赞');
        DB::beginTransaction();
        $result = ArticleCommentModel::where('id',$request->input('artical_comment_id'))->increment('good_num','1');
        if($result){
            //记录
            $u_a_t_res = UserArticleCommentThumbupModel::create(['uid'=>$tokenInfo['uid'],'article_comment_id'=>$request->input('artical_comment_id'),'created_at'=>date('Y-m-d H:i:s')]);
            if(!$u_a_t_res){
                DB::rollBack();
                return $this->formateResponse(1001,'网络错误');
            }
            DB::commit();
            return $this->formateResponse(1000,'点赞成功');
        }else{
            DB::rollBack();
            return $this->formateResponse(1001,'网络错误');
        }
    }

    //点赞
    public function articleThumbsUp(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->input('token')));
        $validator = Validator::make($request->all(),[
            'article_id' => 'required',
            'token' => 'required',
        ],[
            'article_id.required' => '请输入文章标志',
            'token.required' => '参数不完整',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0],$error);
        $if_already = UserArticleThumbupModel::where('uid',$tokenInfo['uid'])->where('article_id',$request->input('article_id'))->count();
        if($if_already) return $this->formateResponse(1001,'您已经为该文章点赞');
        DB::beginTransaction();
        $result = ArticleModel::where('id',$request->input('article_id'))->increment('thumb_up_number','1');
        $param = ArticleModel::whereId($request->input('article_id'))->select('thumb_up_number')->first()->toArray();
        $param['token'] = $request->get('token');
        if($result){
            //记录
            $u_a_t_res = UserArticleThumbupModel::create(['uid'=>$tokenInfo['uid'],'article_id'=>$request->input('article_id'),'created_at'=>date('Y-m-d H:i:s')]);
            if(!$u_a_t_res){
                DB::rollBack();
                return $this->formateResponse(1001,'网络错误');
            }
            DB::commit();
            return $this->formateResponse(1000,'点赞成功',$param);
        }else{
            DB::rollBack();
            return $this->formateResponse(1001,'网络错误');
        }
    }

}