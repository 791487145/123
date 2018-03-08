<?php

namespace App\Modules\Advertisement\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Advertisement\Model\RePositionModel;
use App\Modules\Advertisement\Model\RecommendModel;
use Illuminate\Http\Request;
use Theme;
use App\Modules\User\Model\UserModel;
use App\Modules\Task\Model\SuccessCaseModel;
use App\Modules\Manage\Model\ArticleModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Shop\Models\ShopModel;
use Validator;

class RecommendController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('推荐管理');
    }

    

    public function recommendList()
    {
        $recommendList = RePositionModel::where('is_open','1')->paginate(10);
        foreach($recommendList->items() as $k=>$v){
            $deliveryNum = RecommendModel::where('position_id',$v->id)
                ->where('is_open','1')
                ->where(function($deliveryNum){
                    $deliveryNum->where('end_time','0000-00-00 00:00:00')
                        ->orWhere('end_time','>',date('Y-m-d h:i:s',time()));
                })
                ->count();
            if($deliveryNum){
                $v->deliveryNum = $deliveryNum;
            }
            else{
                $v->deliveryNum = 0;
            }
        }
        $view = [
            'recommendList' => $recommendList
        ];
        return $this->theme->scope('manage.rePositionList',$view)->render();
    }

    
    public function nameUpdate(Request $request){
        $RecommendDetail = RePositionModel::find(intval($request->get('id')));
        $data = array();
        if(!$RecommendDetail){
            $data['status'] = 'fail';
        }
        $newdata = [
            'name' => $request->get('name')
        ];
        $res = $RecommendDetail->update($newdata);
        if($res){
            $data['status'] = 'success';
        }
        else{
            $data['status'] = 'fail';
        }
        return $data;
    }

    
    public function serverListByID(Request $request,$position_id){
        $by = $request->get('by')?$request->get('by'):'sort';
        $order = $request->get('order') ? $request->get('order') : 'asc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 10;

        $serviceList = RecommendModel::leftJoin('recommend_position','recommend_position.id','=','recommend.position_id')
            ->where('recommend.is_open','<>','3')
            ->select('recommend.*','recommend_position.name')
            ->orderBy($by, $order);
        if ($request->get('recommend_name')) {
            $serviceList = $serviceList->where('recommend.recommend_name','like','%'.$request->get('recommend_name').'%');
        }
        if($request->get('position_id') !== null){
            if($request->get('position_id') != 0){
                $serviceList = $serviceList->where('recommend.position_id',$request->get('position_id'));
            }
        }
        else{
            $serviceList = $serviceList->where('recommend.position_id',$position_id);
        }


        if($request->get('is_open') != 0){
            $serviceList = $serviceList->where('recommend.is_open',$request->get('is_open'));
        }
        $serviceList = $serviceList->paginate($paginate);

        $positionInfo = RePositionModel::select('id','name')->get();


        $view = array(
            'serviceList' => $serviceList,
            'id' => $position_id,
            'recommend_name' => $request->get('recommend_name'),
            'position_id' => $request->get('position_id'),
            'is_open' => $request->get('is_open'),
            'by' => $request->get('by'),
            'order' => $request->get('order'),
            'paginate' => $request->get('paginate'),
            'positionInfo' => $positionInfo
        );

        return $this->theme->scope('manage.serviceListById', $view)->render();
    }

    
    public function serverList(Request $request){
        $by = $request->get('by')?$request->get('by'):'sort';
        $order = $request->get('order') ? $request->get('order') : 'asc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 10;

        $serviceList = RecommendModel::leftJoin('recommend_position','recommend_position.id','=','recommend.position_id')
            ->where('recommend.is_open','<>','3')
            ->select('recommend.*','recommend_position.name')
            ->orderBy($by, $order);
        if ($request->get('recommend_name')) {
            $serviceList = $serviceList->where('recommend.recommend_name','like','%'.$request->get('recommend_name').'%');
        }

        if($request->get('position_id') != 0){
            $serviceList = $serviceList->where('recommend.position_id','=',$request->get('position_id'));

        }

        if($request->get('is_open') != 0){
            $serviceList = $serviceList->where('recommend.is_open','=',$request->get('is_open'));
        }
        $serviceList = $serviceList->paginate($paginate);

        $positionInfo = RePositionModel::select('id','name')->get();

        $view = array(
            'serviceList' => $serviceList,
            'recommend_name' => $request->get('recommend_name'),
            'position_id' => $request->get('position_id'),
            'is_open' => $request->get('is_open'),
            'by' => $request->get('by'),
            'order' => $request->get('order'),
            'paginate' => $request->get('paginate'),
            'positionInfo' => $positionInfo
        );
        $search = [
            'recommend_name'=>$request->get('recommend_name'),
            'position_id' => $request->get('position_id'),
            'is_open' => $request->get('is_open'),
            'paginate' => $paginate,
            'order' => $order,
            'by' => $request->get('by'),
        ];
        $view['search'] = $search;

        return $this->theme->scope('manage.serverlist', $view)->render();
    }

    
    public function deleteReInfo($id){
        $recommendInfo = RecommendModel::find($id);
        if(empty($recommendInfo)){
            return redirect('/advertisement/serverList')->with(['error'=>'传送参数错误！']);
        }
        $res = $recommendInfo->update(['is_open' => '3']);
        if($res){
            return redirect('/advertisement/serverList')->with(['message'=>'删除成功！']);
        }
        else{
            return redirect('/advertisement/serverList')->with(['message'=>'删除失败！']);
        }
    }

    

    public function insertRecommend(){
        $positionInfo = RePositionModel::where('is_open',1)->select('id','name','code')->get();
        $domain = \CommonClass::domain();
        $view = [
            'positionInfo' =>$positionInfo,
            'domain' => $domain
        ];
        return $this->theme->scope('manage.adrecommend',$view)->render();
    }

    

    public function addRecommend(Request $request){
        $data = $request->except('_token');
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            
            'recommend_id' => 'required',
            
            'url' => 'required|url'
        ],[
            'type.required' => '请选择推荐分类',
            
            'recommend_id.required' => '请选择推荐名称',

            
            'url.required' => '请输入链接',
            'url.url' => '请输入有效的url'
        ]);
        
        $error = $validator->errors()->all();
        if(count($error)){
            return redirect()->back()->with(['error'=>$validator->errors()->first()]);
        }
        if(!$request->get('position_id')){
            return redirect()->back()->with(['error'=>'请选择推荐位置']);
        }

        $ad_num = RePositionModel::where('id',intval($data['position_id']))->select('num')->get();
        $num = RecommendModel::where('position_id',intval($data['position_id']))
            ->where(function($num){
                $num->where('end_time','0000-00-00 00:00:00')
                    ->orWhere('end_time','>',date('Y-m-d h:i:s',time()));
            })
            ->where('is_open',1)
            ->count();
        if(isset($ad_num[0]) && $ad_num[0]['num'] <= $num){
            $errorData['message'] = '该推荐位已满';
            return redirect()->back()->with(['error'=>'该推荐位已满！']);
        }

        $file = $request->file('recommend_pic');
        if(!in_array($data['type'],['shop','work','server','successcase'])){
            if(empty($file)){
                
                return redirect()->back()->with(['error'=>'请上传图片']);
            }

        }
        if((!in_array($data['type'],['shop','work','server','successcase'])) ||
            (in_array($data['type'],['shop','work','server','successcase']) && !empty($file))){
            
            $result = \FileClass::uploadFile($file,'sys');
            $result = json_decode($result,true);
        }


        switch($data['type']){
            case 'service':
                $recommend_name = UserModel::find($data['recommend_id']);
                $name = $recommend_name->name;
                break;
            case 'successcase':
                $recommend_name = SuccessCaseModel::find($data['recommend_id']);
                $name = $recommend_name->title;
                break;
            case 'article':
                $recommend_name = ArticleModel::find($data['recommend_id']);
                $name = $recommend_name->title;
                break;
            case 'task':
                $recommend_name = TaskModel::find($data['recommend_id']);
                $name = $recommend_name->title;
                break;
            case 'shop':
                $recommend_name = ShopModel::find($data['recommend_id']);
                $name = $recommend_name->shop_name;
                break;
            case 'work':
                $recommend_name = GoodsModel::find($data['recommend_id']);
                $name = $recommend_name->title;
                break;
            case 'server':
                $recommend_name = GoodsModel::find($data['recommend_id']);
                $name = $recommend_name->title;
                break;
        }
        $newData = [
            'position_id'       => $data['position_id'],
            'type'              => $data['type'],
            'recommend_id'      => $data['recommend_id'],
            'recommend_name'    => $name,
            'recommend_type'    => $data['recommend_type'],
            'recommend_pic'     => empty($file)?'':$result['data']['url'],
            'url'               => $data['url'],
            'start_time'        => date('Y-m-d h:i:s',strtotime($data['start_time'])),
            'end_time'          => date('Y-m-d h:i:s',strtotime($data['end_time'])),
            'sort'              => $data['sort'],
            'is_open'           => $data['is_open'],
            'created_at'        => date('Y-m-d h:i:s',time())

        ];
        $res = RecommendModel::create($newData);
        if($res){
            return redirect('/advertisement/serverList')->with(['message'=>'创建成功！']);
        }
        return redirect('/advertisement/serverList')->with(['message'=>'创建失败！']);
    }

    

    public function updateRecommend($id){
        $positionInfo = RePositionModel::where('is_open',1)->select('id','name','code')->get();
        $serviceInfo = RecommendModel::where('id',$id)->select('*')->get();
        switch($serviceInfo[0]->type){
            case 'service':
                $userInfo = UserModel::where('status','!=','2')->select('id','name');
                $recommended = RecommendModel::getRecommended($serviceInfo[0]->type);
                if($recommended != false){
                    $this->recommededId = $serviceInfo[0]['recommend_id'];
                    $recommended =array_where($recommended,function ($key, $value) {
                        return $value != $this->recommededId;
                    });
                    $userInfo = $userInfo->whereNotIn('id',$recommended);
                }
                $userInfo = $userInfo->get();
                break;
            case 'successcase':
                $userInfo = SuccessCaseModel::select('id','title');
                $recommended = RecommendModel::getRecommended($serviceInfo[0]->type);
                if($recommended != false){
                    $this->recommededId = $serviceInfo[0]['recommend_id'];
                    $recommended =array_where($recommended,function ($key, $value) {
                        return $value != $this->recommededId;
                    });
                    $userInfo = $userInfo->whereNotIn('id',$recommended);
                }
                $userInfo = $userInfo->get();
                break;
            case 'article':
                $userInfo = ArticleModel::select('id','title');
                $recommended = RecommendModel::getRecommended($serviceInfo[0]->type);
                if($recommended != false){
                    $this->recommededId = $serviceInfo[0]['recommend_id'];
                    $recommended =array_where($recommended,function ($key, $value) {
                        return $value != $this->recommededId;
                    });
                    $userInfo = $userInfo->whereNotIn('id',$recommended);
                }
                $userInfo = $userInfo->get();
                break;
            case 'task':
                $userInfo = TaskModel::select('id','title');
                $recommended = RecommendModel::getRecommended($serviceInfo[0]->type);
                if($recommended != false){
                    $this->recommededId = $serviceInfo[0]['recommend_id'];
                    $recommended =array_where($recommended,function ($key, $value) {
                        return $value != $this->recommededId;
                    });
                    $userInfo = $userInfo->whereNotIn('id',$recommended);
                }
                $userInfo = $userInfo->get();
                break;
            case 'shop':
                $userInfo = ShopModel::where('status',1)->select('id','shop_name');
                $recommended = RecommendModel::getRecommended($serviceInfo[0]->type);
                if($recommended != false){
                    $this->recommededId = $serviceInfo[0]['recommend_id'];
                    $recommended =array_where($recommended,function ($key, $value) {
                        return $value != $this->recommededId;
                    });
                    $userInfo = $userInfo->whereNotIn('id',$recommended);
                }
                $userInfo = $userInfo->get();
                break;
            case 'work':
                $userInfo = GoodsModel::where(['status' => 1,'type' => 1,'is_delete' => 0])->select('id','title');
                $recommended = RecommendModel::getRecommended($serviceInfo[0]->type);
                if($recommended != false){
                    $this->recommededId = $serviceInfo[0]['recommend_id'];
                    $recommended =array_where($recommended,function ($key, $value) {
                        return $value != $this->recommededId;
                    });
                    $userInfo = $userInfo->whereNotIn('id',$recommended);
                }
                $userInfo = $userInfo->get();
                break;
            case 'server':
                $userInfo = GoodsModel::where(['status' => 1,'type' => 2,'is_delete' => 0])->select('id','title');
                $recommended = RecommendModel::getRecommended($serviceInfo[0]->type);
                if($recommended != false){
                    $this->recommededId = $serviceInfo[0]['recommend_id'];
                    $recommended =array_where($recommended,function ($key, $value) {
                        return $value != $this->recommededId;
                    });
                    $userInfo = $userInfo->whereNotIn('id',$recommended);
                }
                $userInfo = $userInfo->get();
                break;
        }
        $domain = \CommonClass::domain();
        $view = [
            'positionInfo' =>$positionInfo,
            'serviceInfo' =>$serviceInfo,
            'service_id' =>$id,
            'userInfo' =>$userInfo,
            'domain' => $domain
        ];
        return $this->theme->scope('manage.recommendedit',$view)->render();
    }

    
    public function modifyRecommend(Request $request,$service_id){
        if(!$service_id){
            return redirect()->back()->with(['error'=>'传送参数不能为空！']);
        }
        $recommendInfo = RecommendModel::find(intval($service_id));
        if(!$recommendInfo){
            return redirect()->back()->with(['error'=>'传送参数错误！']);
        }
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            
            'recommend_id' => 'required',
            'url' => 'required|url'
        ],[
            'type.required' => '请选择推荐分类',
            
            'recommend_id.required' => '请选择推荐名称',
            'url.required' => '请输入链接',
            'url.url' => '请输入有效的url'
        ]);
        
        $error = $validator->errors()->all();
        if(count($error)){
            return redirect()->back()->with(['error'=>$validator->errors()->first()]);
        }

        if(!$request->get('position_id')){
            return redirect()->back()->with(['error'=>'请选择推荐位置']);
        }
        $data = $request->except('_token');
        $file = $request->file('recommend_pic');
        if(!empty($file)){
            
            $result = \FileClass::uploadFile($file,'sys');
            $result = json_decode($result,true);
            $pic = $result['data']['url'];
        }else{
            $pic = $recommendInfo['recommend_pic'];
        }

        switch($data['type']){
            case 'service':
                $recommend_name = UserModel::find($data['recommend_id']);
                $name = $recommend_name->name;
                break;
            case 'successcase':
                $recommend_name = SuccessCaseModel::find($data['recommend_id']);
                $name = $recommend_name->title;
                break;
            case 'article':
                $recommend_name = ArticleModel::find($data['recommend_id']);
                $name = $recommend_name->title;
                break;
            case 'task':
                $recommend_name = TaskModel::find($data['recommend_id']);
                $name = $recommend_name->title;
                break;
            case 'shop':
                $recommend_name = ShopModel::find($data['recommend_id']);
                $name = $recommend_name->shop_name;
                break;
            case 'work':
                $recommend_name = GoodsModel::find($data['recommend_id']);
                $name = $recommend_name->title;
                break;
            case 'server':
                $recommend_name = GoodsModel::find($data['recommend_id']);
                $name = $recommend_name->title;
                break;
        }
        $newData = [
            'position_id'       => $data['position_id'],
            'type'              => $data['type'],
            'recommend_id'      => $data['recommend_id'],
            'recommend_name'    => $name,
            'recommend_type'    => $data['recommend_type'],
            'recommend_pic'     => $pic,
            'url'               => $data['url'],
            'start_time'        => date('Y-m-d h:i:s',strtotime($data['start_time'])),
            'end_time'          => date('Y-m-d h:i:s',strtotime($data['end_time'])),
            'sort'              => $data['sort'],
            'is_open'           => $data['is_open']

        ];
        $res = $recommendInfo->update($newData);
        if($res){
            return redirect('/advertisement/serverList')->with(['message'=>'修改成功！']);
        }
        else{
            return redirect('/advertisement/serverList')->with(['message'=>'修改失败！']);
        }
    }

    
    public function getReInfo(Request $request){
        $type = $request->get('type');
        $userInfo = [];
        $option = '';
        switch($type){
            case 'service':
                $userInfo = UserModel::where('status','!=','2')->select('id','name');
                $recommended = RecommendModel::getRecommended($type);
                if($recommended != false){
                    $userInfo = $userInfo->whereNotIn('id',$recommended);
                }
                $userInfo = $userInfo->get()->toArray();
                if(count($userInfo)){
                    foreach($userInfo as $k=>$v){
                        $option .= '<option value="'.$v['id'].'">'.$v['name'].'</option>';
                    }
                    return $option;
                }
                else{
                    return $option;
                }
                break;
            case 'successcase':
                $userInfo = SuccessCaseModel::select('id','title');
                $recommended = RecommendModel::getRecommended($type);
                if($recommended != false){
                    $userInfo = $userInfo->whereNotIn('id',$recommended);
                }
                $userInfo = $userInfo->get()->toArray();
                if(count($userInfo)){
                    foreach($userInfo as $k=>$v){
                        $option .= '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                    }
                    return $option;
                }
                else{
                    return $option;
                }
                break;
            case 'article':
                $userInfo = ArticleModel::select('id','title');
                $recommended = RecommendModel::getRecommended($type);
                if($recommended != false){
                    $userInfo = $userInfo->whereNotIn('id',$recommended);
                }
                $userInfo = $userInfo->get()->toArray();
                if(count($userInfo)){
                    foreach($userInfo as $k=>$v){
                        $option .= '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                    }
                    return $option;
                }
                else{
                    return $option;
                }
                break;
            case 'task':
                $userInfo = TaskModel::select('id','title');
                $recommended = RecommendModel::getRecommended($type);
                if($recommended != false){
                    $userInfo = $userInfo->whereNotIn('id',$recommended);
                }
                $userInfo = $userInfo->get()->toArray();
                if(count($userInfo)){
                    foreach($userInfo as $k=>$v){
                        $option .= '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                    }
                    return $option;
                }
                else{
                    return $option;
                }
                break;
            case 'shop':
                $shopInfo = ShopModel::where('status',1)->select('id','shop_name');
                $recommended = RecommendModel::getRecommended($type);
                if($recommended != false){
                    $shopInfo = $shopInfo->whereNotIn('id',$recommended);
                }
                $shopInfo = $shopInfo->get()->toArray();
                if(count($shopInfo)){
                    foreach($shopInfo as $k=>$v){
                        $option .= '<option value="'.$v['id'].'">'.$v['shop_name'].'</option>';
                    }
                    return $option;
                }
                else{
                    return $option;
                }
                break;
            case 'work':
                $workInfo = GoodsModel::where(['type' => 1,'status' => 1,'is_delete' => 0])->select('id','title');
                $recommended = RecommendModel::getRecommended($type);
                if($recommended != false){
                    $workInfo = $workInfo->whereNotIn('id',$recommended);
                }
                $workInfo = $workInfo->get()->toArray();
                if(count($workInfo)){
                    foreach($workInfo as $k=>$v){
                        $option .= '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                    }
                    return $option;
                }
                else{
                    return $option;
                }
                break;
            case 'server':
                $serviceInfo = GoodsModel::where(['type' => 2,'status' => 1,'is_delete' => 0])->select('id','title');
                $recommended = RecommendModel::getRecommended($type);
                if($recommended != false){
                    $serviceInfo = $serviceInfo->whereNotIn('id',$recommended);
                }
                $serviceInfo = $serviceInfo->get()->toArray();
                if(count($serviceInfo)){
                    foreach($serviceInfo as $k=>$v){
                        $option .= '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                    }
                    return $option;
                }
                else{
                    return $option;
                }
                break;


        }
        return $option;

    }


}
