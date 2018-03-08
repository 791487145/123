<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Manage\Model\InstallPackageModel;
use App\Modules\Manage\Model\UserSjlmGoodsUseRecordModel;
use Illuminate\Http\Request;
use Theme;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\User\Model\UserModel;

class GoodsDistributionController extends ManageController{

    public function __construct()
    {
        parent::__construct();
        
        $this->initTheme('manage');
    }

    //物品配送列表
    public function distributionList(Request $request)
    {
        $this->theme->setTitle('物品配送');
        $select = array(
            'user_sjlm_goods_use_record.*','sg.name as good_name','ad.name','ad.phone','ad.province_cn','ad.city_cn','ad.area_cn','ad.address','users.name as username'
        );
        $goods = UserSjlmGoodsUseRecordModel::select($select);
        if($request->get('status') != ''){
            if($request->get('status') == 2){//已配送
                $goods = $goods->where('user_sjlm_goods_use_record.status','=',2);
            }else{//未配送
                $goods = $goods->where('user_sjlm_goods_use_record.status','>',1);
            }

        }

        $goods =  $goods->where('user_sjlm_goods_use_record.kind','=','1')
                        ->leftjoin('sjlm_goods as sg','sg.id','=','user_sjlm_goods_use_record.goods_id')
                        ->leftjoin('user_address as ad','ad.id','=','user_sjlm_goods_use_record.address_id')
                        ->leftjoin('users','users.id','=','user_sjlm_goods_use_record.uid')
                        ->paginate(20);
        $type = array(
            array('id'=>0,'name'=>'已配送'),
            array('id'=>1,'name'=>'未配送'),
        );
        $data = [
            'type'  =>  $type,
            'goods'  =>  $goods,
            'amount'  =>  $request->get('amount'),
        ];

        return $this->theme->scope('manage/distributionList',$data)->render();
    }

    //完成配送
    public function finishDistribution(Request $request)
    {
        $this->theme->setTitle('物品配送');
        $request = $request->all();
        $data = array(
            'status' => 2,
            'logistics_number' => $request['logistics_number'],
            'logistics_company' => $request['logistics_company'],
        );
        $goods = UserSjlmGoodsUseRecordModel::where('id',$request['record_id'])->update($data);
        //发送站内信
        $userInfo = UserModel::leftJoin('user_sjlm_goods_use_record as usgur','usgur.uid','=','users.id')
                             ->leftJoin('sjlm_goods as sg','sg.id','=','usgur.goods_id')
                             ->where('usgur.id','=',$request['record_id'])
                             ->select('users.id','users.name','sg.name as goods_name')
                             ->first();

        $messageVariableArr = array(
                'username' => $userInfo['name'],
                'goods_name' => $userInfo['goods_name'],
                'logistics_company' => $request['logistics_company'],
                'logistics_number' => $request['logistics_number'],
            );

        $message_res = MessageTemplateModel::sendToUser($userInfo['id'],"logistics_information",$messageVariableArr);
        if($goods)
            return redirect('manage/distribution')->with(['error'=>'操作成功']);
    }

    //填写物流信息
    public function inputLogistics($id)
    {
        $this->theme->setTitle('提交物流信息');
        $data = array('logistics_id'=>$id);
        $record = UserSjlmGoodsUseRecordModel::where('id',$id)->select('logistics_number','logistics_company')->first();
        $data['logistics_number'] = $record['logistics_number'];
        $data['logistics_company'] = $record['logistics_company'];
        return $this->theme->scope('manage/inputLogistics',$data)->render();
    }

    //APP安装包列表
    public function installPackageList()
    {
        $this->theme->setTitle('安装包列表');
        $package = InstallPackageModel::orderBy('id', 'desc')->paginate(20);
        $data = [
            'package'  =>  $package,
        ];
        return $this->theme->scope('manage/installPackageList',$data)->render();
    }

    //添加页
    public function installPackage(Request $request)
    {
        $this->theme->setTitle('安装包版本添加');
        return $this->theme->scope('manage/installPackage')->render();
    }


    //添加
    public function addInstallPackage(Request $request)
    {
        $data = $request->except('_token');
        if(!empty($data['name'])) {
            $ext = $data['name']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S') . '-' . uniqid()) . '.' . $ext;
            $filepath = 'uploads/install_package/';
            $result = $data['name']->move($filepath, $filename);
            if($result){
                $data['name'] = $filepath.$filename;
                $data['create_at'] = date('Y-m-d H:i:s');
                $info = InstallPackageModel::insert($data);
                if($info == false){
                    unlink($data['name']);
                }
                $message = $info ? '操作成功' : '操作失败';
                return redirect('manage/install_package')->with(['error'=>$message]);
            }else{
                return redirect('manage/install_package')->with(['error'=>'安装包上传失败']);
            }
        }else{
            return redirect('manage/install_package')->with(['error'=>'安装包上传失败']);
        }
    }

    //详情
    public function installPackageDetail($id)
    {
        $this->theme->setTitle('详情');
        $package = InstallPackageModel::where('id', $id)->first();
        $data = [
            'package'  =>  $package
        ];
        return $this->theme->scope('manage/installPackageDe',$data)->render();
    }

    //修改
    public function installPackageUp(Request $request)
    {
        $data = $request->except('_token');
        if(!empty($data['name'])){
            $name = InstallPackageModel::select('name')->where('id',$data['id'])->first()->toArray();
            $ext = $data['name']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/install_package/';
            $result = $data['name']->move($filepath,$filename);
            if($result){
                $data['name'] = $filepath.$filename;
                $data['update_at'] = date('Y-m-d H:i:s');
                $info = InstallPackageModel::where('id',$data['id'])->update($data);
                if($info){
                    if($name['name']){
                        unlink($name['name']);
                    }
                    return redirect('/manage/install_package')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['name']);
                    return redirect('/manage/install_package')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/install_package')->with(['message'=>'图片上传失败']);
            }
        }
        $data['update_at'] = date('Y-m-d H:i:s');
        $result = InstallPackageModel::where('id',$data['id'])->update($data);
        $message = $result ? '操作成功' : '操作失败';
        return redirect('manage/installPackageList')->with(['error'=>$message]);
    }

}