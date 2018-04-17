<?php

namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Manage\Http\Requests\PackageRequest;
use App\Modules\Manage\Http\Requests\PrivilegesRequest;
use App\Modules\Manage\Http\Requests\VipAuthRequest;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\JiangHuPropModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cache;
use Validator;
use Theme;

class JiangHuController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('道具列表');
        $this->theme->set('manageType', 'auth');
    }

    //道具列表
    public function propList(Request $request){
        $daojus = JiangHuPropModel::get();
		$data = array(
			'daojus' => $daojus
		);
        return $this->theme->scope('manage.jhpropList', $data)->render();
    }


    //添加道具页
    public function createPropShow(Request $request){
        
        return $this->theme->scope('manage.jhPropAdd')->render();
    }

    //添加道具
    public function createProp(Request $request)
    {

        $data = $request->all();//接收数据
        if(!empty($data['icon'])){
            $ext = $data['icon']->getClientOriginalExtension();//获取图片后缀
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;//文件命名
            $filepath = 'uploads/jianghu/prop/icon/';//上传路径
            $result = $data['icon']->move($filepath,$filename);//将文件放到指定目录
            if($result){
                $data['icon'] = $filepath.$filename;//数据拼接
                unset($data['_token']);
                $data['created_at'] = date('Y-m-d H:i:s');//添加时间
                $result = JiangHuPropModel::insert($data);//数据入库
                if($result){
                    return redirect('/manage/propList')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['icon']);
                    return redirect('/manage/propList')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/propList')->with(['message'=>'图片上传失败']);
            }

        }else{
            return redirect('/manage/propList')->with(['message'=>'图片上传失败']);
        }

    }

     //删除道具
     public function DeleteProp($id)
     {
        $icon = JiangHuPropModel::where('id',$id)->pluck('icon');//查找图片名称

        $re = JiangHuPropModel::where('id',$id)->delete();//删除记录
        if($re){
            unlink($icon); //删除图片文件
            return redirect('/manage/propList')->with(['message'=>'操作成功']);
        }
    }    
    //修改道具页
    public function updatePropShow($id)
    {
        $this->theme->setTitle('修改道具');

        $icon = JiangHuPropModel::where('id',$id)->first();//查询信息

        
        $data = [
            'icon' => $icon,
        ];
        return $this->theme->scope('manage.jhPropupdate',$data)->render();//输出页面
    }

    //修改道具
    public function updateProp(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        if(!empty($data['icon'])){
            $icon_name = JiangHuPropModel::where('id',$data['id'])->pluck('icon'); //查询图片
            $ext = $data['icon']->getClientOriginalExtension();//获取图片后缀
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/jianghu/prop/icon/';//上传路径
            $result = $data['icon']->move($filepath,$filename);
            if($result){
                $data['icon'] = $filepath.$filename;
                $result = JiangHuPropModel::where('id',$data['id'])->update($data);
                if($result){
                    if($icon_name['icon']){
                        unlink($icon_name['icon']);
                    }

                    return redirect('/manage/propList')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['icon']);
                    return redirect('/manage/propList')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/propList')->with(['message'=>'图片上传失败']);
            }
        }
        $result = JiangHuPropModel::where('id',$data['id'])->update($data);
        if($result)
            return redirect('/manage/propList')->with(['message'=>'操作成功']);
        else
            return redirect('/manage/propList')->with(['message'=>'操作失败']);

    }








}