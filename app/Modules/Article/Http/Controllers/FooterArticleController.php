<?php
namespace App\Modules\Article\Http\Controllers;

use App\Http\Controllers\IndexController;
use App\Http\Requests;
use App\Modules\Article\Model\ArticleModel;
use App\Modules\Manage\Model\ArticleCategoryModel;
use Illuminate\Http\Request;

class FooterArticleController extends IndexController
{
	public function __construct()
    {
        parent::__construct();

        $this->initTheme('main');
    }

    
    public function aboutUs(Request $request,$catID)
    {
        
        $category = ArticleCategoryModel::where('pid',3)->orderBy('display_order','ASC')->paginate(4)->toArray();
        $cate = ArticleCategoryModel::where('id',$catID)->first()->toArray();
        if($cate['cate_name'] == '帮助中心'){
            $catIDs = array();
            $thirdCatIds = array();
            
            $childrenCate = ArticleCategoryModel::where('pid',$cate['id'])->orderBy('display_order','ASC')->get()->toArray();
            if(empty($childrenCate)) {
                $childrenCate = array();
            } else {
                if(!empty($childrenCate) && is_array($childrenCate)) {
                    foreach($childrenCate as $k => $v){
                        
                        $catIDs[] = $v['id'];
                        $secCate = ArticleCategoryModel::where('pid',$v['id'])->orderBy('display_order','ASC')->get()->toArray();
                        if(!empty($secCate) && is_array($secCate)) {
                            foreach($secCate as $key => $val){
                                $thirdCatIds[] = $val['id'];
                            }
                        }
                        $childrenCate[$k]['children'] = $secCate;
                    }
                }
            }
        }else{
            $childrenCate = array();
        }

        $preId = '';
        $nextId = '';
        $pre = '';
        $next = '';
        $article = '';
        if($request->get('article_id')){
            $article = ArticleModel::where('id',$request->get('article_id'))->first();
            if(!empty($article)){
                
                $pre = ArticleModel::where('cat_id',$article->cat_id)->where('id', '<', $request->get('article_id'))->min('id');
                $next = ArticleModel::where('cat_id',$article->cat_id)->where('id', '>', $request->get('article_id'))->max('id');
            }else{
                $pre = $preId;
                $next = $nextId;
            }
        }else{
            
            $firArticle = ArticleModel::where('cat_id',$catID)->orderBy('display_order','ASC')->first();
            if(!empty($firArticle)){
                
                $preId = ArticleModel::where('cat_id',$firArticle->cat_id)->where('id', '<', $firArticle->id)->min('id');
                $nextId = ArticleModel::where('cat_id',$firArticle->cat_id)->where('id', '>', $firArticle->id)->max('id');
            }
            if(empty($firArticle) && !empty($catIDs)){
                
                $secArticle = ArticleModel::whereIn('cat_id',$catIDs)->orderBy('display_order','ASC')->get()->toArray();
                if(empty($secArticle) && !empty($thirdCatIds)) {
                    $thirdArticle = ArticleModel::whereIn('cat_id',$thirdCatIds)->orderBy('display_order','ASC')->get()->toArray();
                    if(!empty($thirdArticle) && is_array($thirdArticle)){
                        $article = $thirdArticle[0];
                        
                        $pre = ArticleModel::whereIn('cat_id',$thirdCatIds)->where('id', '<', $thirdArticle[0]['id'])->min('id');
                        $next = ArticleModel::whereIn('cat_id',$thirdCatIds)->where('id', '>', $thirdArticle[0]['id'])->max('id');
                    }
                } else {
                    $secArticleArr =  ArticleModel::whereIn('cat_id',$catIDs)->orderBy('display_order','ASC')->get()->toArray();
                    if(!empty($secArticleArr) && is_array($secArticleArr)){
                        $article = $secArticleArr[0];
                        
                        $pre = ArticleModel::whereIn('cat_id',$catIDs)->where('id', '<', $secArticleArr[0]['id'])->min('id');
                        $next = ArticleModel::whereIn('cat_id',$catIDs)->where('id', '>', $secArticleArr[0]['id'])->max('id');
                    }
                }
            } else {
                $article = $firArticle;
                $pre = $preId;
                $next = $nextId;
            }
        }

        $data = array(
            'catID' => $catID,
            'category' => $category['data'],
            'cate' => $cate,
            'article' => $article,
            'childrenCate'=> $childrenCate,
            'pre' => $pre,
            'next' => $next
        );
        $this->theme->setTitle($cate['cate_name']);
        if($cate['cate_name'] == '关于我们'){
            $this->theme->set('keywords','关于我们,关于介绍,公司介绍');
            $this->theme->set('description','关于我们，众包威客关于我们介绍。');
        }elseif($cate['cate_name'] == '服务条款'){
            $this->theme->set('keywords','服务条款');
            $this->theme->set('description','服务条款');
        }elseif($cate['cate_name'] == '帮助中心'){
            $this->theme->set('keywords','帮助中心');
            $this->theme->set('description','帮助中心');
        }
        return $this->theme->scope('bre.footerarticle',$data)->render();
    }

    
    public function helpCenter(Request $request,$catID,$upID)
    {
        
        $category = ArticleCategoryModel::where('pid',3)->get()->toArray();
        $upIDs = array();
        if($category && is_array($category)) {
            foreach($category as $a => $b) {
                $upIDs[] = $b['id'];
            }
            if(in_array($upID,$upIDs)) {
                
                $catArr = ArticleCategoryModel::where('pid',$upID)->first();
                $upID = $catArr['id'];
            } else {
                $upID = $upID;
            }
        }
        
        $search = $request->get('search');
        $cate = ArticleCategoryModel::where('id',$catID)->first();
        $upCate = ArticleCategoryModel::where('id',$upID)->first();
        $helpID = $upCate['pid'];
        $catIDs = array();
        $thirdCatIds = array();
        
        $childrenCate = ArticleCategoryModel::where('pid',$helpID)->orderBy('display_order','ASC')->get()->toArray();
        if(empty($childrenCate)){
            $childrenCate = array();
        } else{
            if(!empty($childrenCate) && is_array($childrenCate)){
                foreach($childrenCate as $k => $v){
                    
                    $catIDs[] = $v['id'];
                    $secCate = ArticleCategoryModel::where('pid',$v['id'])->orderBy('display_order','ASC')->get()->toArray();
                    if(!empty($secCate) && is_array($secCate)){
                        foreach($secCate as $key => $val) {
                            $thirdCatIds[] = $val['id'];
                        }
                    }
                    $childrenCate[$k]['children'] = $secCate;
                }
            }
        }
        $ids = array_merge($catIDs,$thirdCatIds);
        $searchArticle = array();
        $article = array();
        $pre = '';
        $next = '';
        if($search) {
            if($request->get('article_id')){
                $article = ArticleModel::where('id',$request->get('article_id'))->first();
                if(!empty($article)){
                    
                    $pre = ArticleModel::where('cat_id',$article->cat_id)->where('id', '<', $request->get('article_id'))->min('id');
                    $next = ArticleModel::where('cat_id',$article->cat_id)->where('id', '>', $request->get('article_id'))->max('id');
                }
            }else{
                
                $res = ArticleCategoryModel::where('cate_name','like',"%".$search."%")->get();
                if(!empty($res)){
                    foreach($res as $m => $n){
                        if(in_array($n['id'],$ids)){
                            
                            $searchArticle = ArticleModel::where('cat_id',$n['id'])->orderBy('display_order','ASC')->first();
                        }
                    }
                }
                if(!empty($searchArticle)){
                    
                    $pre = ArticleModel::where('cat_id',$searchArticle->cat_id)->where('id', '<', $searchArticle->id)->min('id');
                    $next = ArticleModel::where('cat_id',$searchArticle->cat_id)->where('id', '>', $searchArticle->id)->max('id');
                }
            }
        }else{
            if($request->get('article_id')){
                $article = ArticleModel::where('id',$request->get('article_id'))->first();
                if(!empty($article)){
                    
                    $pre = ArticleModel::where('cat_id',$article->cat_id)->where('id', '<', $request->get('article_id'))->min('id');
                    $next = ArticleModel::where('cat_id',$article->cat_id)->where('id', '>', $request->get('article_id'))->max('id');
                }
            }else{
                
                $article = ArticleModel::where('cat_id',$catID)->orderBy('display_order','ASC')->first();
                if(!empty($article)){
                    
                    $pre = ArticleModel::where('cat_id',$catID)->where('id', '<', $article->id)->min('id');
                    $next = ArticleModel::where('cat_id',$catID)->where('id', '>', $article->id)->max('id');
                }
            }

        }
        $data = array(
            'upID' => $upID,
            'catID' => $catID,
            'cate' => $cate,
            'article' => $article,
            'childrenCate'=> $childrenCate,
            'searchArticle' => $searchArticle,
            'search' => $search,
            'pre' => $pre,
            'next' => $next
        );
        $this->theme->setTitle($cate['cate_name']);
        $this->theme->set('keywords',$cate['cate_name'].'，帮助中心');
        $this->theme->set('description',$cate['cate_name']);
        return $this->theme->scope('bre.helpcenter',$data)->render();
    }
}

















