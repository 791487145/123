<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\ManageController;
use App\Modules\Manage\Model\ArticleCategoryModel;
use App\Modules\Manage\Model\CampusRecruitmentModel;
use App\Modules\Manage\Model\SystemTasksModel;
use App\Modules\Manage\Model\TypeModel;
use App\Modules\Manage\Model\ArticleModel;
use App\Http\Requests;
use App\Modules\Manage\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Theme;
use Illuminate\Support\Facades\Auth;

class ArticleController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');
        $this->theme->set('manageType', 'article');

    }

    //文章列表
    public function articleList(Request $request, $upID)
    {
        $title = ArticleCategoryModel::where('id',$upID)->first()->cate_name;
        if($upID == 1){
            $this->theme->setTitle('文章管理');
        }elseif($upID == 3){
            $this->theme->setTitle('页脚管理');
        }
        $arr = $request->all();
        $upID = intval($upID);
        
        $m = ArticleCategoryModel::get()->toArray();
        $res = ArticleCategoryModel::_reSort($m,$upID);//筛选

        $articleList = ArticleModel::whereRaw('1 = 1');

        if ($request->get('catID')) {

            $r = ArticleCategoryModel::_children($m, $request->get('catID'));
            if (empty($r)) {
                $articleList = $articleList->where('article.cat_id', $request->get('catID'));
            } else {
                $catIds = array_merge($r, array($request->get('catID')));
                $articleList = $articleList->whereIn('article.cat_id', $catIds);
            }
        } else {
            
            $r = ArticleCategoryModel::_children($m, $upID);
            $catIds = array_merge($r, array($upID));
            $articleList = $articleList->whereIn('article.cat_id', $catIds);

        }
        
        if ($request->get('artID')) {
            $articleList = $articleList->where('article.id', $request->get('artID'));
        }
        
        if ($request->get('title')) {
            $articleList = $articleList->where('article.title', 'like', "%" . e($request->get('title')) . '%');
        }
        
        if ($request->get('author')) {
            $articleList = $articleList->where('article.author', 'like', '%' . e($request->get('author')) . '%');
        }
        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $articleList = $articleList->where('article.created_at','>',$start);
        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $articleList = $articleList->where('article.created_at','<',$end);
        }
        $by = $request->get('by') ? $request->get('by') : 'article.created_at';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;


        $list = $articleList->join('article_category as c', 'article.cat_id', '=', 'c.id')
            ->select('article.id','article.is_recommended', 'article.cat_id', 'article.title', 'article.view_times', 'article.author', 'article.created_at', 'c.cate_name as cate_name')
            ->orderBy($by, $order)->paginate($paginate);
        $listArr = $list->toArray();

        $data = array(
            'merge' => $arr,
            'upID' => $upID,
            'artID' => $request->get('artID'),
            'title' => $request->get('title'),
            'catID' => $request->get('catID'),
            'author' => $request->get('author'),
            'paginate' => $request->get('paginate'),
            'order' => $request->get('order'),
            'by' => $request->get('by'),
            'article_data' => $listArr,
            'article' => $list,
            'category' => $res

        );
        return $this->theme->scope('manage.articlelist', $data)->render();

    }

    
    public function articleDelete($id, $upID)
    {
        $upID = intval($upID);
        switch($upID){
            case 1:
                $url = '/manage/article/';
                break;
            case 3:
                $url = '/manage/articleFooter/';
                break;
            default:
                $url = '/manage/article/';
        }
        $result = ArticleModel::where('id', $id)->delete();
        if (!$result) {
            return redirect()->to($url . $upID)->with(array('message' => '操作失败'));
        }
        return redirect()->to($url . $upID)->with(array('message' => '操作成功'));

    }

    
    public function allDelete(Request $request)
    {
        $data = $request->except('_token');

        $res = ArticleModel::destroy($data);
        if ($res) {
            return redirect()->to('/manage/article/1')->with(array('message' => '操作成功'));
        }
        return redirect()->to('/manage/article/1')->with(array('message' => '操作失败'));
    }

    
    public function addArticle(Request $request, $upID)
    {
        $upID = intval($upID);
        $title = ArticleCategoryModel::where('id',$upID)->first()->cate_name;
        $this->theme->setTitle('文章新建');
        
        $m = ArticleCategoryModel::get()->toArray();
        $res = ArticleCategoryModel::_reSort($m,$upID);
        $parentCate = ArticleCategoryModel::where('id',$upID)->first();

        $data = array(
            'category' => $res,
            'parent_cate' => $parentCate,
            'upID' => $upID
        );
        return $this->theme->scope('manage.addarticle', $data)->render();
    }

    
    public function postArticle(Request $request)
    {
        $data = $request->except('_token', 'pic','upID');
        if(!empty($data['thumb_pic'])){
            $ext = $data['thumb_pic']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/article/';
            $result = $data['thumb_pic']->move($filepath,$filename);
            if($result) {
                $data['thumb_pic'] = $filepath.$filename;
            }else{
                redirect()->back()->with(['error'=>'缩略图上传失败']);
            }
        }
        $upID = $request->get('upID');
        switch($upID){
            case 1:
                $url = '/manage/article/';
                break;
            case 3:
                $url = '/manage/articleFooter/';
                break;
            default:
                $url = '/manage/article/';
        }
        $data['cat_id'] = $data['catID'];
        $data['created_at'] = date('Y-m-d H:i:s',time());
        $data['updated_at'] = date('Y-m-d H:i:s',time());
        $data['display_order'] = $request->get('displayOrder');
        $data['content'] = htmlspecialchars($data['content']);

        if(mb_strlen($data['content']) > 4294967295/3){
            $error['content'] = '文章内容太长，建议减少上传图片';
            if (!empty($error)) {
                return redirect('/manage/addArticle')->withErrors($error);
            }
        }

        $res = ArticleModel::create($data);
        if ($res) {
            return redirect($url . $upID)->with(array('message' => '操作成功'));
        }else{
            return redirect($url . $upID)->with(array('message' => '操作失败'));
        }

    }

    
    public function editArticle(Request $request, $id, $upID)
    {
        $id = intval($id);
        $upID = intval($upID);
        
        $title = ArticleCategoryModel::where('id',$upID)->first()->cate_name;
        $this->theme->setTitle($title);
        $arr = ArticleCategoryModel::where('pid', $upID)->get()->toArray();
        foreach ($arr as $k => &$v) {
            $res = ArticleCategoryModel::where('pid', $v['id'])->get()->toArray();
            $arr[$k]['res'] = $res;
        }
        
        $m = ArticleCategoryModel::get()->toArray();
        $res = ArticleCategoryModel::_reSort($m,$upID);
        $parentCate = ArticleCategoryModel::where('id',$upID)->first();
        
        $article = ArticleModel::where('id', $id)->first();
        $data = array(
            'article' => $article,
            'parent_cate' => $parentCate,
            'upID' => $upID,
            'cate' => $res
        );
        $this->theme->setTitle('页脚编辑');
        return $this->theme->scope('manage.editarticle', $data)->render();
    }

    
    public function postEditArticle(ArticleRequest $request)
    {
        $data = $request->except('_token','thumb');
        switch($data['upID']){
            case 1:
                $url = '/manage/article/';
                break;
            case 3:
                $url = '/manage/articleFooter/';
                break;
            default:
                $url = '/manage/article/';
        }
        $thumb = $request->get('thumb');
        if(!empty($data['thumb_pic'])){
            $ext = $data['thumb_pic']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/article/';
            $result = $data['thumb_pic']->move($filepath,$filename);
            if($result) {
                $data['thumb_pic'] = $filepath.$filename;
                $arr['thumb_pic'] = $data['thumb_pic'];
            }else{
                redirect()->back()->with(['error'=>'缩略图上传失败']);
            }
        }
        $data['content'] = htmlspecialchars($data['content']);
        if(mb_strlen($data['content']) > 4294967295/3){
            $error['content'] = '文章内容太长，建议减少上传图片';
            if (!empty($error)) {
                return redirect('/manage/addArticle')->withErrors($error);
            }
        }

        $arr = array(
            'title' => $data['title'],
            'cat_id' => $data['catID'],
            'author' => $data['author'],
            'display_order' => $data['displayOrder'],
            'content' => $data['content'],
            'summary' => $data['summary'],
            'seotitle' => $data['seotitle'],
            'keywords' => $data['keywords'],
            'description' => $data['description'],
            'updated_at' => date('Y-m-d H:i:s',time()),
            'is_recommended' => $data['is_recommended'],

        );
        $res = ArticleModel::where('id', $data['artID'])->update($arr);
        if ($res) {
            return redirect($url . $data['upID'])->with(array('message' => '操作成功'));
        }
    }


    //校园招聘
    public function recruitmentList(Request $request)
    {
        $campus = CampusRecruitmentModel::select('campus_recruitment.*','type.id as type_id','type.name as type_name')
            ->where('campus_recruitment.status','valid')
            ->leftjoin('type','campus_recruitment.scale','=','type.id')
            ->paginate(20);
        $data = [
            'campus' => $campus,
        ];
        return $this->theme->scope('manage.campusList',$data)->render();
    }

    //添加页
    public function addCampusPage()
    {
        $scale = TypeModel::where('type','scale')->get();
        $data = [
            'scale' => $scale,
        ];
        return $this->theme->scope('manage.addCampus',$data)->render();
    }
    //添加
    public function addRecruitment(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['create_at'] = date('Y-m-d H:i:s');
        $result = CampusRecruitmentModel::create($data);
        if($result)
            return redirect('/manage/campus')->with(['message'=>'操作成功']);
        else
            return redirect('/manage/campus')->with(['message'=>'操作失败']);
    }

    //删除
    public function recruitmentDel($id)
    {
        $re = CampusRecruitmentModel::where('id',$id)->update(array('status'=>'invalid'));
        if($re)
            return redirect('/manage/campus')->with(['message'=>'操作成功']);
    }

    //批量删除
    public function recruitmentDelHandle(Request $request)
    {
        if (!$request->get('ckb')) {
            return \CommonClass::adminShowMessage('参数错误');
        }

        $info = CampusRecruitmentModel::whereIn('id', $request->get('ckb'))->update(array('status' => 'invalid'));
        if($info)
            return redirect()->back()->with(['error'=>'操作成功！']);
        else
            return redirect()->back()->with(['error'=>'操作失败！']);
    }

    //详情
    public function recruitmentDet($id)
    {
        $campus = CampusRecruitmentModel::select('campus_recruitment.*','type.id as type_id','type.name as type_name')
            ->where('campus_recruitment.status','valid')
            ->where('campus_recruitment.id',$id)
            ->leftjoin('type','campus_recruitment.scale','=','type.id')
            ->first();
        $scale = TypeModel::where('type','scale')->get();
        $data = [
            'scale' => $scale,
            'campus' => $campus,
        ];
        return $this->theme->scope('manage.campusDetail',$data)->render();
    }

    //修改
    public function recruitmentUp(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $result = CampusRecruitmentModel::where('id',$data['id'])->update($data);
        if($result)
            return redirect('/manage/campus')->with(['message'=>'操作成功']);
        else
            return redirect('/manage/campus')->with(['message'=>'操作失败']);
    }

    //系统任务
    public function systemTask()
    {
        $system_task = SystemTasksModel::select('system_tasks.*','t.name as grade_name','ty.name as task_type')
                                        ->where('system_tasks.status','valid')
                                        ->join('type as t','t.id','=','system_tasks.grade')
                                        ->leftjoin('type as ty','ty.id','=','system_tasks.type')
                                        ->paginate(20);
        $data = [
            'system_task'  =>  $system_task,
        ];
        return $this->theme->scope('manage/systemList',$data)->render();
    }

    //添加系统任务页面
    public function addSystemShow()
    {
        $grade_name = TypeModel::select('id','name')->where('type','system_task_grade')->get();
        $task_name = TypeModel::select('id','name')->where('type','system_task')->get();
        $data = [
            'grade_name'   =>  $grade_name,
            'task_name'   =>  $task_name,
        ];
        return $this->theme->scope('manage/addSystem',$data)->render();
    }

    //添加
    public function systemCreate(Request $request)
    {
        $data = $request->except('_token');
        $data['create_at'] = date('Y-m-d H:i:s');
        $info = SystemTasksModel::create($data);
        if($info)
            return redirect('/manage/system')->with(['message'=>'操作成功']);
        else
            return redirect()->back()->with(['error'=>'操作失败！']);
    }
    //删除
    public function systemDelete($id)
    {
        $info = SystemTasksModel::where('id', $id)->update(array('status' => 'invalid'));
        if($info)
            return redirect()->back()->with(['error'=>'操作成功！']);
        else
            return redirect()->back()->with(['error'=>'操作失败！']);
    }

    //批量删除
    public function systemTaskDelHandle(Request $request)
    {
        if (!$request->get('ckb')) {
            return \CommonClass::adminShowMessage('参数错误');
        }

        $info = SystemTasksModel::whereIn('id', $request->get('ckb'))->update(array('status' => 'invalid'));
        if($info)
            return redirect()->back()->with(['error'=>'操作成功！']);
        else
            return redirect()->back()->with(['error'=>'操作失败！']);
    }

    //详情
    public function systemDetail($id)
    {
        $system = SystemTasksModel::where('id',$id)->where('status','valid')->first();
        $grade_name = TypeModel::select('id','name')->where('type','system_task_grade')->get()->toArray();
        $task_name = TypeModel::select('id','name')->where('type','system_task')->get()->toArray();
        $reward_type = array(
            array('id'=>1,'name'=>'余额'),
            array('id'=>2,'name'=>'金币'),
        );
        $data = [
            'system'   => $system,
            'grade_name'   =>  $grade_name,
            'task_name'   =>  $task_name,
            'reward_type'  =>  $reward_type
        ];
        return $this->theme->scope('manage/systemDetail',$data)->render();
    }
    //修改
    public function systemUpdate(Request $request)
    {
        $data = $request->except('_token');
        $info = SystemTasksModel::where('id',$data['id'])->update($data);
        if($info)
            return redirect('manage/system')->with(['message'=>'操作成功']);
        else
            return redirect()->back()->with(['error'=>'操作失败！']);
    }

}
