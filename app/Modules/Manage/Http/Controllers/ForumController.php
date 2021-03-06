<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Modules\Manage\Model\ForumImgModel;
use App\Modules\Manage\Model\ForumModel;
use App\Modules\Manage\Model\TypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Theme;
use Image;
class ForumController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');

    }

    //论坛列表
    public function forumListShow(Request $request)
    {
        $this->theme->setTitle('论坛列表');
        $forumList = ForumModel::orderBy('forum.id','desc')->where('forum.status','valid');
        $re = $request->all();
        if ($request->get('class')) {//贴吧分类
            $forumList = $forumList->where('forum.class', $request->get('class'));
        }
        if ($request->get('type')) {//发布类型
            $forumList = $forumList->where('forum.type', $request->get('type'));
        }
        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $forumList = $forumList->where('forum.created_at','>',$start);
        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $forumList = $forumList->where('forum.created_at','<',$end);
        }

        $forum = $forumList->leftjoin('users as u','forum.uid','=','u.id')
                       ->select('forum.*','u.name as user_name')
                       ->paginate(20);
        $data = [
            'forum' => $forum,
            'request' => $re
        ];
        $data['class'] = TypeModel::where('type','last_and_found')->get()->toArray();

        $data['type'] = [
            ['id' => "1" ,'name' => '后台发布'],
            ['id' => "2" ,'name' => '用户发布'],
        ];
        $data['class'] = [
            ['id' => "1" ,'name' => '搞笑'],
            ['id' => "2" ,'name' => '娱乐'],
        ];
        return $this->theme->scope('manage.forumList', $data)->render();
    }

    //发布新贴页
    public function createForumShow()
    {
        $this->theme->setTitle('发布新贴');
        $data['class'] = [
            ['id' => "1" ,'name' => '搞笑'],
            ['id' => "2" ,'name' => '娱乐'],
        ];
        return $this->theme->scope('manage.addForum', $data)->render();
    }

    //发布新贴页
    public function createForum(Request $request)
    {
        $data = $request->except('_token');
        $data['type'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        if($request->get('img_name')){//图文
            $rule = ['png','gif','jpeg','jpg'];
            $url_path = 'uploads/forum/';
            $data['forum_type'] = 1;
            $result = $this->uploads_img($data['img_name'],$url_path,$rule);
            if($result){
                $this->watermark($result);
                unset($data['img_name']);
                $info = ForumModel::insertGetId($data);
                if($info){
                    $img = array();
                    foreach($result as $k=>$v){
                        $img[$k]['forum_id'] = $info;
                        $img[$k]['img_name'] = $v;
                    }

                    ForumImgModel::insert($img);
                    return redirect('/manage/forumList')->with(['message'=>'操作成功']);
                }else{
                    foreach($result as $v){
                        unlink($v);
                    }
                    return redirect('/manage/forumList')->with(['message'=>'操作失败']);
                }
            }
        }elseif($data['screen'] != null){
            $data['forum_type'] = 2;

        }else{
            unset($data['img_name']);
            $info = ForumModel::insert($data);
            $return  = $info ? '操作成功' : '操作失败';
            return redirect('/manage/forumList')->with(['message'=>$return]);
        }

    }


}


