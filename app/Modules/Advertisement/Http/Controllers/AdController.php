<?php

namespace App\Modules\Advertisement\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Advertisement\Model\AdModel;
use App\Modules\Advertisement\Model\AdTargetModel;
use Illuminate\Http\Request;
use Theme;
use Validator;

class AdController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
    }

    
    public function adlist(Request $request){
        $this->theme->setTitle('广告管理');
        $by = $request->get('by') ? $request->get('by') : 'id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 10;

        $adList = AdModel::leftJoin('ad_target','ad_target.target_id','=','ad.target_id')
            ->where('ad.is_open','<>','3')
            ->select('ad.*','ad_target.name')
            ->orderBy($by, $order);
        if ($request->get('ad_name')) {
            $adList = $adList->where('ad.ad_name','like','%'.$request->get('ad_name').'%');
        }

        if($request->get('target_id') != 0){
            $adList = $adList->where('ad.target_id','=',$request->get('target_id'));

        }

        if($request->get('is_open') != 0){
            $adList = $adList->where('ad.is_open','=',$request->get('is_open'));
        }
        $adList = $adList->paginate($paginate);

        $adTargetInfo = AdTargetModel::select('target_id','name')->get();

        $view = array(
            'adList' => $adList,
            'ad_name' => $request->get('ad_name'),
            'target_id' => $request->get('target_id'),
            'is_open' => $request->get('is_open'),
            'by' => $request->get('by'),
            'order' => $request->get('order'),
            'paginate' => $request->get('paginate'),
            'adTargetInfo' => $adTargetInfo
        );
        $search = [
            'ad_name'=>$request->get('ad_name'),
            'paginate' => $paginate,
            'order' => $order,
            'by' => $request->get('by'),
            'target_id' => $request->get('target_id'),
            'is_open' => $request->get('is_open'),
        ];
        $view['search'] = $search;


        return $this->theme->scope('manage.adlist', $view)->render();
    }

    
    public function storeAdInfo(Request $request){
        $data = $request->except('_token');
        $validator = Validator::make($request->all(), [
            'ad_name' => 'required',
            'target_id' => 'required',
            'ad_file' => 'required',
            'ad_url' => 'required|url'
        ],[
            'ad_name.required' => '请输入广告名称',
            'target_id.required' => '请选择广告位置',
            'ad_file.required' => '请上传图片',

            'ad_url.required' => '请输入链接',
            'ad_url.url' => '请输入有效的url'
        ]);
        
        $error = $validator->errors()->all();
        if(count($error)){
            return redirect()->back()->with(['error'=>$validator->errors()->first()]);
        }

        $ad_num = AdTargetModel::where('target_id',intval($data['target_id']))->select('ad_num')->get();
        $num = AdModel::where('target_id',intval($data['target_id']))
            ->where(function($num){
                $num->where('end_time','0000-00-00 00:00:00')
                ->orWhere('end_time','>',date('Y-m-d h:i:s',time()));
            })
            ->where('is_open',1)
            ->count();

        if(isset($ad_num[0]) && $ad_num[0]['ad_num'] <= $num){
            $errorData['message'] = '该广告位已满';
            return redirect()->back()->with(['error'=>'该广告位已满！']);
        }

        $file = $request->file('ad_file');
       

        $result = \FileClass::uploadFile($file,'sys');
        $result = json_decode($result,true);


        $newData = [
            'ad_type'       => $data['ad_type'],
            'target_id'     => $data['target_id'],
            'ad_name'       => $data['ad_name'],
            'ad_file'       => $result['data']['url'],
            'ad_url'        => $data['ad_url'],
            'start_time'    => date('Y-m-d h:i:s',strtotime($data['start_time'])),
            'end_time'      => date('Y-m-d h:i:s',strtotime($data['end_time'])),
            'listorder'     => $data['listorder'],
            'is_open'       => $data['is_open'],
            'created_at'    => date('Y-m-d h:i:s',time())

        ];
        $res = AdModel::create($newData);
        if($res){
            return redirect('/advertisement/adList')->with(['message'=>'广告创建成功！']);
        }
        return redirect('/advertisement/adList')->with(['message'=>'广告创建失败！']);
    }

    
    public function updateAdInfo(Request $request,$ad_id){
        if(!$ad_id){
            return redirect()->back()->with(['error'=>'传送参数不能为空！']);
        }
        $adInfo = AdModel::find(intval($ad_id));
        if(!$adInfo){
            return redirect()->back()->with(['error'=>'传送参数错误！']);
        }

        $data = $request->except('_token');
        $validator = Validator::make($request->all(), [
            'ad_name' => 'required',
            'target_id' => 'required',
            'ad_url' => 'required|url'
        ],[
            'ad_name.required' => '请输入广告名称',
            'target_id.required' => '请选择广告位置',
            'ad_url.required' => '请输入链接',
            'ad_url.url' => '请输入有效的url'
        ]);
        
        $error = $validator->errors()->all();
        if(count($error)){
            return redirect()->back()->with(['error'=>$validator->errors()->first()]);
        }
        $file = $request->file('ad_file');
        if(!empty($file)){
            
            $result = \FileClass::uploadFile($file,'sys');
            $result = json_decode($result,true);
            $adFile =  $result['data']['url'];
        }else{
            $adFile = $adInfo['ad_file'];
        }


        $newData = [
            'ad_type'       => $data['ad_type'],
            'target_id'     => $data['target_id'],
            'ad_name'       => $data['ad_name'],
            'ad_file'       => $adFile,
            'ad_url'        => $data['ad_url'],
            'start_time'    => date('Y-m-d h:i:s',strtotime($data['start_time'])),
            'end_time'      => date('Y-m-d h:i:s',strtotime($data['end_time'])),
            'listorder'     => $data['listorder'],
            'is_open'       => $data['is_open']

        ];
        $res = $adInfo->update($newData);
        if($res){
            return redirect('/advertisement/adList')->with(['message'=>'修改成功！']);
        }
        else{
            return redirect('/advertisement/adList')->with(['message'=>'修改失败！']);
        }
    }

    
    public function deleteAdInfo($ad_id){
        $adInfo = AdModel::find($ad_id);
        if(empty($adInfo)){
            return redirect('/advertisement/adList')->with(['error'=>'传送参数错误！']);
        }
        $res = $adInfo->update(['is_open' => '3']);
        if($res){
            return redirect('/advertisement/adList')->with(['message'=>'删除成功！']);
        }
        else{
            return redirect('/advertisement/adList')->with(['message'=>'删除成功！']);
        }
    }

    

    public function getInsertAd()
    {
        $this->theme->setTitle('广告管理');
        $adTargetInfo = AdTargetModel::select('target_id','name','code')->get();
        $view = [
            'adTargetInfo' =>$adTargetInfo
        ];
        return $this->theme->scope('manage.adadd',$view)->render();
    }

    

    public function getUpdateAd($id)
    {
        $this->theme->setTitle('广告管理');
        $adTargetInfo = AdTargetModel::select('target_id','name','code')->get();
        $adInfo = AdModel::where('id',$id)->select('*')->get();
        $view = [
            'adTargetInfo' =>$adTargetInfo,
            'adInfo' =>$adInfo,
            'ad_id' =>$id
        ];
        return $this->theme->scope('manage.adedit',$view)->render();
    }



}
