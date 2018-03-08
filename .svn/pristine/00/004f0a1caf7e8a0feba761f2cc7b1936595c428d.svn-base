<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\ManageController;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\LinkModel;
use App\Modules\Manage\Model\NavigationModel;
use App\Modules\Manage\Model\IndustryModel;
use App\Modules\Manage\Model\ServiceObjectModel;
use App\Modules\Manage\Model\StyleModel;
use App\Modules\Task\Model\TaskCateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Theme;


class LinkController extends ManageController
{

    public $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = $this->manager;
        $this->initTheme('manage');
        $this->theme->setTitle('友情链接');
       
    }

    
    public function linkList(Request $request)
    {
        $linkList = LinkModel::whereRaw('1 = 1');
        if ($request->get('title')) {
            $linkList = $linkList->where('title','like','%'.$request->get('title').'%');
        }
        if ($request->get('content')) {
            $linkList = $linkList->where('content','like','%'.$request->get('content').'%');
        }
        if($request->get('status') != 0){
            $linkList = $linkList->where('status',$request->get('status'));
        }
        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $linkList = $linkList->where('addtime', '>',$start);
        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $linkList = $linkList->where('addtime', '<',$end);
        }
        $by = $request->get('by') ? $request->get('by') : 'id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;


        $linkList = $linkList->orderBy($by,$order)->paginate($paginate);


        $data =array(
            'linkList'=>$linkList,
            'title' => $request->get('title'),
            'id' => $request->get('id'),
            'status' => $request->get('status'),
            'by' => $request->get('by'),
            'order' => $request->get('order'),
            'paginate' => $request->get('paginate'),
        );
        $search = $request->all();
        $data['search'] = $search;
        return $this->theme->scope('manage.link',$data)->render();
    }

    
    public function postAdd(Request $request)
    {
        $data = $request->except('_token');
        $file = $request->file('pic');
        if (empty($file)) {
            return redirect()->back()->with(array('message' => '操作失败'));
        }
        $result = \FileClass::uploadFile($file,'sys');
        $result = json_decode($result,true);
        if(!$result['data']['url']){
            return redirect()->back()->with(['error'=>'广告图片必传！']);
        }
        $link =array(
            'title'=>$data['title'],
            'pic'=>$result['data']['url'],
            'content'=>$data['content'],
            'addtime'=>date('Y-m-d H:i:s',time()),
            'sort'=>$data['sort'],
        );
        $rs = LinkModel::insert($link);
        if($rs){
            return redirect()->back()->with(array('message' => '操作成功'));
        }else{
            return redirect()->back()->with(array('message' => '操作失败'));
        }
    }

    
    public function handleLink($id, $action)
    {
        switch ($action){
            case 'enable':
                $status = 1;
                break;
            case 'disable':
                $status = 2;
                break;
        }
        $status = LinkModel::where('id', $id)->update(['status' => $status]);
        if ($status) {
            return redirect('manage/link')->with(array('message' => '操作成功'));
        }
        return redirect()->back()->with(array('message' => '操作失败'));
    }

    
    public function getEdit($id){
        $list = LinkModel::where('id',$id)->first();

        $data = array(
          'list'=>$list
        );
        return $this->theme->scope('manage.editlink',$data)->render();
    }

    
    public function getDeleteLink($id){
        $re = LinkModel::destroy($id);
        if($re){
            return redirect()->back()->with(array('message' => '操作成功'));
        }
        return redirect()->back()->with(array('message' => '操作失败'));
    }

    
    public function postUpdateLink(Request $request,$id){
        $data = $request->except('_token');
        $link = LinkModel::where('id',$id)->first();
        if(!$link){
            return redirect()->back()->with('error', '操作失败');
        }
        $file = $request->file('pic');
        if (!$file) {
            $pic = $link->pic;
        }else{
            $result = \FileClass::uploadFile($file,'sys');
            $result = json_decode($result,true);
            $pic = $result['data']['url'];
        }
        $link = array(
            'title'=> $data['title'],
            'pic'=> $pic,
            'content'=> $data['content'],
            'sort'=> $data['sort']
        );
        $rs = LinkModel::where('id',$id)->update($link);

        if($rs){
            return redirect()->back()->with(array('message' => '操作成功'));
        }
        else{
            return redirect()->back()->with(array('message' => '操作失败'));
        }
    }

    
    public function allDeleteLink(Request $request)
    {
        $data = $request->all();
        $res = LinkModel::destroy($data);
        if($res)
        {
            return redirect()->to('/manage/link')->with(array('message' => '操作成功'));
        }
        return  redirect()->to('/manage/link')->with(array('message' => '操作失败'));
    }
}