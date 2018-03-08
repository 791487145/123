<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Shop\Models\GoodsCommentModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Task\Model\TaskCateModel;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodsController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('作品管理');
        $this->theme->set('manageType', 'auth');
    }

    
    public function goodsList(Request $request)
    {
        $merge = $request->all();
        $goodsList = GoodsModel::whereRaw('1 = 1')->where('goods.type',1)->where('goods.is_delete',0);
        
        if ($request->get('name')) {
            $goodsList = $goodsList->where('users.name',$request->get('name'));
        }
        
        if ($request->get('goods_name')) {
            $goodsList = $goodsList->where('goods.title','like','%'.$request->get('goods_name').'%');
        }
        
        if ($request->get('status')) {
            switch($request->get('status')){
                case 1:
                    $status = 0;
                    break;
                case 2:
                    $status = 1;
                    break;
                case 3:
                    $status = 2;
                    break;
                case 4:
                    $status = 3;
                    break;
            }
            $goodsList = $goodsList->where('goods.status',$status);
        }
        $by = $request->get('by') ? $request->get('by') : 'goods.id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;

        $goodsList = $goodsList->where('goods.is_delete',0)->leftJoin('users','users.id','=','goods.uid')
            ->select('goods.*','users.name')
            ->orderBy($by, $order)->paginate($paginate);
        $data = array(
            'merge' => $merge,
            'goods_list' => $goodsList,
        );
        $this->theme->setTitle('作品管理');
        return $this->theme->scope('manage.goodslist',$data)->render();
    }


    
    public function goodsInfo($id)
    {
        $id = intval($id);
        
        $preId = GoodsModel::where('id','>',$id)->min('id');
        
        $nextId = GoodsModel::where('id','<',$id)->max('id');
        $goodsInfo = GoodsModel::getGoodsInfoById($id);
        
        $cateFirst = TaskCateModel::findByPid([0],['id','name']);
        
        if(!empty($goodsInfo->cate_pid)){
            $cateSecond = TaskCateModel::findByPid([$goodsInfo->cate_pid]);
        }else{
            $cateSecond = TaskCateModel::findByPid([$cateFirst[0]['id']],['id','name']);
        }
        $data = array(
            'goods_info' => $goodsInfo,
            'pre_id' => $preId,
            'next_id' => $nextId,
            'cate_first' => $cateFirst,
            'cate_second' => $cateSecond
        );
        $this->theme->setTitle('作品详情');
        return $this->theme->scope('manage.goodsinfo', $data)->render();
    }

    
    public function goodsComment(Request $request,$id)
    {
        $id = intval($id);
        
        $preId = GoodsModel::where('id','>',$id)->min('id');
        
        $nextId = GoodsModel::where('id','<',$id)->max('id');
        $merge = $request->all();
        $page = $request->get('page') ? $request->get('page') : 1;
        $type = $request->get('type') ? $request->get('type') : 0;
        $paginate = 20;
        $commentList = GoodsCommentModel::getCommentByGoodsId($id,$page,$type,$paginate);
        $data = array(
            'id' => $id,
            'merge' => $merge,
            'pre_id' => $preId,
            'next_id' => $nextId,
            'comment_list' => $commentList
        );
        $this->theme->setTitle('作品评价');
        return $this->theme->scope('manage.goodscomment', $data)->render();

    }

    
    public function ajaxGetSecondCate(Request $request)
    {
        $id = intval($request->get('id'));
        if (!$id) {
            return response()->json(['errMsg' => '参数错误！']);
        }
        $cate = TaskCateModel::findByPid([$id]);
        $data = [
            'cate' => $cate
        ];
        return response()->json($data);
    }

    
    public function saveGoodsInfo(Request $request)
    {
        $data = $request->except('_token');
        $arr = array(
            'title' => $data['title'],
            'cate_id' => $data['cate_id'],
            'status' => $data['status'],
            'cash' => $data['cash'],
            'desc' => $data['desc'],
            'seo_title' => trim($data['seo_title']),
            'seo_keyword' => trim($data['seo_keyword']),
            'seo_desc' => trim($data['seo_desc'])

        );
        $res = GoodsModel::where('id',$data['id'])->update($arr);
        if($res){
            return redirect('/manage/goodsInfo/'.$data['id'])->with(array('message' => '操作成功'));
        }
        return redirect('/manage/goodsInfo/'.$data['id'])->with(array('message' => '操作失败'));
    }

    
    public function changeGoodsStatus(Request $request)
    {
        $type = $request->get('type');
        $id = $request->get('id');
        $res = GoodsModel::changeGoodsStatus($id,$type);
        if($res){
            $data = array(
                'code' => 1,
                'msg' => 'success'
            );
        }else{
            $data = array(
                'code' => 0,
                'msg' => 'failure'
            );
        }
        return response()->json($data);
    }

    
    public function checkGoodsDeny(Request $request)
    {
        $reason = $request->get('reason');
        $type = 4;
        $id = $request->get('id');
        $res = GoodsModel::changeGoodsStatus($id,$type,$reason);
        if($res){
            $data = array(
                'code' => 1,
                'msg' => 'success'
            );
        }else{
            $data = array(
                'code' => 0,
                'msg' => 'failure'
            );
        }
        return response()->json($data);
    }



    
    public function goodsConfig()
    {
        $goodsConfig = ConfigModel::getConfigByType('goods_config');
        $data = array(
            'goods_config' => $goodsConfig
        );
        $this->theme->setTitle('流程配置');
        return $this->theme->scope('manage.goodsconfig', $data)->render();
    }

    
    public function postGoodsConfig(Request $request)
    {
        $data = $request->all();
        $configData = array(
            'min_price' => $data['min_price'],
            'trade_rate' => $data['trade_rate'],
            'legal_rights' => $data['legal_rights'],
            'doc_confirm' => $data['doc_confirm'],
            'comment_days' => $data['comment_days']
        );
        ConfigModel::updateConfig($configData);
        Cache::forget('goods_config');
        return redirect('/manage/goodsConfig')->with(array('message' => '操作成功'));
    }

}
