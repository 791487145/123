<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Employ\Models\EmployCommentsModel;
use App\Modules\Employ\Models\EmployGoodsModel;
use App\Modules\Employ\Models\EmployModel;
use App\Modules\Employ\Models\UnionAttachmentModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsCommentModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Task\Model\TaskCateModel;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodsServiceController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('服务管理');
        $this->theme->set('manageType', 'auth');
    }

    
    public function goodsServiceList(Request $request)
    {
        $merge = $request->all();
        $goodsList = GoodsModel::whereRaw('1 = 1')->where('goods.type',2)->where('goods.is_delete',0);
        
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
        $this->theme->setTitle('服务管理');
        return $this->theme->scope('manage.goodsServiceList',$data)->render();
    }


    
    public function serviceInfo($id)
    {
        $id = intval($id);
        
        $preId = GoodsModel::where('id','>',$id)->where('type',2)->min('id');
        
        $nextId = GoodsModel::where('id','<',$id)->where('type',2)->max('id');
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
        $this->theme->setTitle('服务详情');
        return $this->theme->scope('manage.serviceinfo', $data)->render();
    }

    
    public function serviceComments(Request $request,$id)
    {
        $id = intval($id);
        
        $preId = GoodsModel::where('id','>',$id)->where('type',2)->min('id');
        
        $nextId = GoodsModel::where('id','<',$id)->where('type',2)->max('id');
        $merge = $request->all();
        $page = $request->get('page') ? $request->get('page') : 1;
        $type = $request->get('type') ? $request->get('type') : 0;
        $paginate = 20;
        
        $employ_id = EmployGoodsModel::where('service_id',$id)->lists('employ_id')->toArray();
        
        $comments = EmployCommentsModel::select('employ_comment.*','ep.title','us.name as user_name')
            ->whereIn('employ_comment.employ_id',$employ_id)
            ->where('employ_comment.comment_by',1)
            ->join('employ as ep','ep.id','=','employ_comment.employ_id')
            ->join('users as us','us.id','=','employ_comment.from_uid')
            ->paginate(1);
        $comments_toArray = $comments->toArray();

        $data = array(
            'id' => $id,
            'merge' => $merge,
            'pre_id' => $preId,
            'next_id' => $nextId,
            'comment_list' => $comments_toArray,
            'comments'=>$comments
        );
        $this->theme->setTitle('服务评价');
        return $this->theme->scope('manage.servicecomments', $data)->render();

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

    
    public function saveServiceInfo(Request $request)
    {
        $data = $request->except('_token');
        $arr = array(
            'title' => $data['title'],
            'cate_id' => $data['cate_id'],
            'cash' => $data['cash'],
            'desc' => $data['desc'],
            'seo_title' => trim($data['seo_title']),
            'seo_keyword' => trim($data['seo_keyword']),
            'seo_desc' => trim($data['seo_desc'])
        );
        $res = GoodsModel::where('id',$data['id'])->update($arr);
        if($res){
            return redirect('/manage/serviceInfo/'.$data['id'])->with(array('message' => '操作成功'));
        }
        return redirect('/manage/serviceInfo/'.$data['id'])->with(array('message' => '操作失败'));
    }

    
    public function changeServiceStatus(Request $request)
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

    
    public function checkServiceDeny(Request $request)
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

    
    public function serviceOrderList(Request $request)
    {
        $data = $request->all();
        $pagesize = 20;
        
        $employ_ids = EmployGoodsModel::lists('employ_id')->toArray();
        
        $employ = EmployModel::select('employ.*','ur.name as employer_name','us.name as employee_name')
            ->whereIn('employ.id',$employ_ids)
            ->join('users as ur','ur.id','=','employ.employer_uid')
            ->leftjoin('users as us','us.id','=','employ.employee_uid');
        
        if(!empty($data['employer_name']))
        {
            $employ = $employ->where('ur.name','like',"%".e($data['employer_name'])."%");
        }
        
        if(!empty($data['employ_title']))
        {
            $employ = $employ->where('employ.title','like',"%".e($data['employ_title'])."%");
        }
        
        if(!empty($data['service_status']))
        {
            $employ = $employ->whereIn('employ.status',explode(',',$data['service_status']));
        }
        
        $orderBy = 'id';
        if(!empty($data['orderby']))
        {
            $orderBy = $data['orderby'];
        }
        $orderByType = 'ACS';
        if(!empty($data['ordertype']))
        {
            $orderByType = $data['ordertype'];
        }
        
        if(!empty($data['pagesize']))
        {
            $pagesize = $data['pagesize'];
        }
        $employ_page = $employ->orderBy($orderBy,$orderByType)->paginate($pagesize);
        $employ = $employ_page->toArray();
        $map = [
            'status'=>[
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
            ]
        ];
        $employ['data'] = \CommonClass::intToString($employ['data'],$map);
        $data = [
            'result'=>$employ,
            'employ_page'=>$employ_page
        ];
        $this->theme->setTitle('订单管理');
        return $this->theme->scope('manage.serviceorderlist',$data)->render();
    }
    
    public function serviceOrderEdit($id)
    {
        
        $data = EmployModel::select('employ.*','ur.name as employer_name','us.name as employee_name')
            ->where('employ.id',$id)
            ->join('users as ur','ur.id','=','employ.employer_uid')
            ->leftjoin('users as us','us.id','=','employ.employee_uid')
            ->first();
        
        $attachment = UnionAttachmentModel::where('object_id',$id)->where('object_type',2)->get()->toArray();

        if(!$data)
            return redirect()->back()->with(['error'=>'数据不存在！']);

        $view = [
            'data'=>$data,
            'attachment'=>$attachment,
        ];
        $this->theme->setTitle('订单编辑');
        return $this->theme->scope('manage.serviceOrderEdit',$view)->render();
    }
    
    public function serviceOrderUpdate(Request $request)
    {
        $data = $request->except('_token');

        $result = EmployModel::where('id',$data['id'])->update($data);

        if(!$result)
            return redirect()->back()->with(['error'=>'编辑失败！']);

        return redirect('manage/serviceOrderEdit/'.$data['id'])->with(['message'=>'编辑成功！']);
    }
    
    public function serviceOrderInfo($id)
    {
        $id = intval($id);
        
        $preId = ShopOrderModel::where('id', '>', $id)->where('object_type',1)->min('id');
        
        $nextId = ShopOrderModel::where('id', '<', $id)->where('object_type',1)->max('id');
        $orderInfo = ShopOrderModel::getGoodsOrderInfoById($id);
        $data = array(
            'order_info' => $orderInfo,
            'pre_id' => $preId,
            'next_id' => $nextId
        );
        $this->theme->setTitle('服务订单详情');
        return $this->theme->scope('manage.goodsorderinfo', $data)->render();
    }

    
    public function shopOrderInfo($id)
    {
        $id = intval($id);
        
        $preId = ShopOrderModel::where('id', '>', $id)->where('object_type',2)->min('id');
        
        $nextId = ShopOrderModel::where('id', '<', $id)->where('object_type',2)->max('id');
        $orderInfo = ShopOrderModel::getGoodsOrderInfoById($id);
        $data = array(
            'order_info' => $orderInfo,
            'pre_id' => $preId,
            'next_id' => $nextId
        );
        $this->theme->setTitle('服务订单详情');
        return $this->theme->scope('manage.goodsorderinfo', $data)->render();
    }


    
    public function serviceConfig()
    {
        
        $employ_config = ConfigModel::where('type','employ')->get()->toArray();
        $employ_config = \CommonClass::keyBy($employ_config,'alias');

        $view = [
            'config'=>$employ_config
        ];
        $this->theme->setTitle('流程配置');
        return $this->theme->scope('manage.serviceconfig', $view)->render();
    }

    
    public function serviceConfigUpdate(Request $request)
    {
        $data = $request->except('_token');
        if(!empty($data['change_ids']))
        {
            $change_ids = explode(',',$data['change_ids']);
            foreach($change_ids as $v)
            {
                $result = ConfigModel::where('id',$v)->update(['rule'=>$data[$v]]);
                if(!$result)
                    return redirect()->back()->with(['error'=>'修改失败！']);
            }
        }else{
            return redirect()->back()->with(['error'=>'请修改后再提交！']);
        }

        return redirect()->back()->with(['message'=>'修改成功！']);
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
