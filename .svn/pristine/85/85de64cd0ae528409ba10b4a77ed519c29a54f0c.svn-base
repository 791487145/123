<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Modules\Manage\Model\BoxGoodsModel;
use App\Modules\Manage\Model\SjlmGoodsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modules\Manage\Model\IconModel;
use App\Modules\Manage\Model\IconTypeModel;
use App\Modules\Manage\Model\FunctionModel;
use App\Modules\Manage\Model\BoxesModel;
use App\Modules\Manage\Model\GoodsCodeSignModel;
use App\Modules\Manage\Model\GoodsExchangeCodeModel;

class IconManagementController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');

    }

    //图标管理
    public function iconList($type='carousel' )
    {
        $icon_type = IconTypeModel::get()->toArray();
        $all_data = IconModel::where('type',$type)->where('status','valid')->get()->toArray();

        $view = [
            'icon'=>$all_data,
            'icon_type'=>$icon_type,
            'type' => $type
        ];

        return $this->theme->scope('manage.iconList',$view)->render();
    }

    //添加图标页
    public function addIcon()
    {
        $icon_type = IconTypeModel::get()->toArray();
        $view = [
            'icon_type'=>$icon_type,
        ];

        return $this->theme->scope('manage.addIcon',$view)->render();
    }

    //添加图标
    public function postAddIcon(Request $request)
    {
        $data = $request->all();
        if(!empty($data['icon_name'])){
            $ext = $data['icon_name']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/icon/';
            $result = $data['icon_name']->move($filepath,$filename);
            if($result){
                $data['icon_name'] = $filepath.$filename;
                unset($data['_token']);
                $result = IconModel::insert($data);
                if($result){
                    return redirect('/manage/icon')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['grade_img']);
                    return redirect('/manage/icon')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/icon')->with(['message'=>'图片上传失败']);
            }

        }else{
            return redirect('/manage/icon')->with(['message'=>'图片上传失败']);
        }

    }





    //删除图标
    public function iconDel($id)
    {
        $re = IconModel::where('id',$id)->update(array('status'=>'invalid'));
        if($re)
            return redirect('/manage/icon')->with(['message'=>'操作成功']);
    }

    /**
     * 图标详情
     * @param int
     */
    public function iconDetail($id)
    {
        $this->theme->setTitle('图标');
        $icon = IconModel::where('id',$id)->first();

        $icon_type = IconTypeModel::get()->toArray();
        $data = [
            'icon_type'=>$icon_type,
            'icon' => $icon,
        ];
        return $this->theme->scope('manage.iconDetail',$data)->render();
    }

    //修改图标
    public function iconUpdate(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        if(!empty($data['icon_name'])){
            $icon_name = IconModel::select('icon_name')->where('id',$data['id'])->first()->toArray();
            //获取图片信息
            $ext = $data['icon_name']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/icon/';
            $result = $data['icon_name']->move($filepath,$filename);
            if($result){
                $data['icon_name'] = $filepath.$filename;
                $result = IconModel::where('id',$data['id'])->update($data);
                if($result){
                    if($icon_name['icon_name']){
                        unlink($icon_name['icon_name']);
                    }

                    return redirect('/manage/icon')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['icon_name']);
                    return redirect('/manage/icon')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/icon')->with(['message'=>'图片上传失败']);
            }
        }
        $result = IconModel::where('id',$data['id'])->update($data);
        if($result)
            return redirect('/manage/icon')->with(['message'=>'操作成功']);
        else
            return redirect('/manage/icon')->with(['message'=>'操作失败']);

    }

    //功能
    public function functionList(Request $request)
    {
        $this->theme->setTitle('功能管理');
        $function = FunctionModel::where('status','valid')->paginate(20);
        $data = [
            'function' => $function,
        ];

        return $this->theme->scope('manage.functionList',$data)->render();
    }

    //添加功能
    public function postAddFunction(Request $request)
    {
        $data = $request->all();
        if(!empty($data['function_icon'])){
            $ext = $data['function_icon']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/function_icon/';
            $result = $data['function_icon']->move($filepath,$filename);
            if($result){
                $data['function_icon'] = $filepath.$filename;
                unset($data['_token']);
                $result = FunctionModel::insert($data);
                if($result){
                    return redirect('/manage/function')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['function_icon']);
                    return redirect('/manage/function')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/function')->with(['message'=>'图片上传失败']);
            }

        }else{
            return redirect('/manage/function')->with(['message'=>'图片上传失败']);
        }

    }

    //删除功能
    public function functionDel($id)
    {
        $re = FunctionModel::where('id',$id)->update(array('status'=>'invalid'));
        if($re)
            return redirect('/manage/function')->with(['message'=>'操作成功']);
    }

    /**
     * 功能详情
     * @param int
     */
    public function functionDetail($id)
    {
        $this->theme->setTitle('功能管理');
        $function = FunctionModel::where('id',$id)->first();
        $data = [
            'function' => $function,
        ];
        return $this->theme->scope('manage.functionDetail',$data)->render();
    }

    //修改功能
    public function functionUpdate(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        if(!empty($data['function_icon'])){
            $function_icon = FunctionModel::select('function_icon')->where('id',$data['id'])->first()->toArray();
            //获取图片信息
            $ext = $data['function_icon']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/function_icon/';
            $result = $data['function_icon']->move($filepath,$filename);
            if($result){
                $data['function_icon'] = $filepath.$filename;
                $result = FunctionModel::where('id',$data['id'])->update($data);
                if($result){
                    if($function_icon['function_icon']){
                        unlink($function_icon['function_icon']);
                    }

                    return redirect('/manage/function')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['function_icon']);
                    return redirect('/manage/function')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/function')->with(['message'=>'图片上传失败']);
            }
        }

        $result = FunctionModel::where('id',$data['id'])->update($data);
        if($result)
            return redirect('/manage/function')->with(['message'=>'操作成功']);
        else
            return redirect('/manage/function')->with(['message'=>'操作失败']);

    }

    //宝箱管理
    public function treasureChestList()
    {
        $boxes = BoxesModel::select('id','name','grade','created_at')->where('status','valid')->paginate(10);
        $data = [
            'boxes' => $boxes,
        ];
        return $this->theme->scope('manage.treasureList',$data)->render();
    }

    //添加宝箱
    public function treasureCreate(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['create_at'] = date('Y-m-d H:i:s');
        $info = BoxesModel::create($data);
        if($info)
            return redirect('/manage/treasure')->with(['message'=>'操作成功']);
        else
            return redirect('/manage/treasure')->with(['message'=>'操作失败']);
    }

    //宝箱详情
    public function treasureDetail($id)
    {
        $boxes = BoxesModel::select('id','name','grade')->where('id',$id)->where('status','valid')->first();
        $grade = [
            '1' =>  '1',
            '2' =>  '2',
            '3' =>  '3',
        ];
        $data = [
            'boxes' => $boxes,
            'grade' => $grade,
        ];
        return $this->theme->scope('manage.treasureDet',$data)->render();
    }


    //修改宝箱
    public function treasureUpdate(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] = date('Y-m-d H:i:s');
        $info = BoxesModel::where('id',$data['id'])->update($data);
        if($info)
            return redirect('/manage/treasure')->with(['message'=>'操作成功']);
        else
            return redirect('/manage/treasure')->with(['message'=>'操作失败']);
    }

    //宝箱物品管理
    public function boxList($id)
    {
        $box_goods = BoxGoodsModel::select('box_goods.*','sg.name','sg.icon')
                                   ->where('box_goods.box_id',$id)
                                   ->where('box_goods.status','valid')
                                   ->leftjoin('sjlm_goods as sg','box_goods.goods_id','=','sg.id')
                                   ->get();
        $box_name = BoxesModel::select('name')->where('id',$id)->first();
        $sjlm_goods = SjlmGoodsModel::where('status','valid')->get();
        $data = [
            'id'    => $id,
            'box_goods' => $box_goods,
            'box_name' => $box_name,
            'sjlm_goods' => $sjlm_goods,
        ];
        return $this->theme->scope('manage.boxList',$data)->render();
    }

    //宝箱物品添加
    public function boxGoodsAdd(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['create_at'] = date('Y-m-d H:i:s');
        $info = BoxGoodsModel::create($data);
        if($info)
            return redirect()->back()->with(['error'=>'操作成功']);
        else
            return redirect()->back()->with(['error'=>'操作失败']);
    }

    //宝箱详情
    public function boxDetail($id)
    {
        $box_goods = BoxGoodsModel::where('id',$id)->where('status','valid')->first();
        $sjlm_goods = SjlmGoodsModel::where('status','valid')->get();
        $data = [
            'box_goods' =>  $box_goods,
            'sjlm_goods'   =>  $sjlm_goods,
        ];
        return $this->theme->scope('manage.boxDetail',$data)->render();
    }

    //宝箱修改
    public function boxUpdate(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] = date('Y-m-d H:i:s');
        $info = BoxGoodsModel::where('id',$data['id'])->update($data);
        if($info)
            return redirect('/manage/box/'.$data['box_id'])->with(['message'=>'操作成功']);
        else
            return redirect()->back()->with(['error'=>'操作失败']);
    }

    //宝箱物品删除
    public function boxDelete($id)
    {
        $info = BoxGoodsModel::where('id',$id)->update(array('status'=>'invalid'));
        if($info)
            return redirect()->back()->with(['error'=>'操作成功']);
        else
            return redirect()->back()->with(['error'=>'操作失败']);

    }

    //生成兑换码页
    public function goodsCodeShow()
    {
        $this->theme->setTitle('物品兑换码');
        $code_sign = GoodsCodeSignModel::get();
        $data = [
            'code_sign'   =>  $code_sign,
        ];
        return $this->theme->scope('manage/goodsCodeShow',$data)->render();
    }

    //生成兑换码
    public function goodsCodeMake(Request $request)
    {
        $data = $request->except('_token');
        $str = array();
        $data['number'] = $data['number'] <= 10000 ? $data['number'] : 10000;
        for($i=0;$i<$data['number'];$i++){
            $str[] = $this->mtrandStr($data['length']).$data['code_sign'];
        }
        $newStr = array_unique($str);
        foreach($newStr as $k=>$v){
            $code[$k]['code_sign'] = $data['code_sign'];
            $code[$k]['created_at'] = date('Y-m-d H:i:s');
            $code[$k]['code'] = $v;
        }
        $info = GoodsExchangeCodeModel::insert($code);
        if($info){
            return redirect()->back()->with(['error'=>'操作成功']);
        }else{
            return redirect()->back()->with(['error'=>'操作失败']);
        }
    }

    //物品兑换码列表
    public function goodsCodeList(Request $request)
    {
        $this->theme->setTitle('物品兑换码');
        $search = $request->all();
        $goods_code = GoodsExchangeCodeModel::where('is_valid','valid');
        if ($request->get('code_sign')) {
            $goods_code = $goods_code->where('code_sign',$request->get('code_sign'));
        }
        $code_sign = GoodsCodeSignModel::get();
        $goods_code = $goods_code->paginate(20);
        $data = [
            'search'   =>  $search,
            'code_sign'   =>  $code_sign,
            'goods_code'   =>  $goods_code,
        ];
        return $this->theme->scope('manage/goodsCodeList',$data)->render();

    }

    //删除
    public function goodsCodeDelete($id)
    {
        $code = GoodsExchangeCodeModel::where('id',$id)->update(['is_valid'=>'invalid']);
        if($code)
            return redirect()->back()->with(['error'=>'操作成功']);
    }

    //批量删除
    public function goodsCodeHandle(Request $request)
    {
        if (!$request->get('ckb')) {
            return \CommonClass::adminShowMessage('参数错误');
        }
        $info = GoodsExchangeCodeModel::whereIn('id', $request->get('ckb'))->update(['is_valid'=>'invalid']);
        if($info)
            return redirect()->back()->with(['error'=>'操作成功！']);
        else
            return redirect()->back()->with(['error'=>'操作失败！']);
    }

    /**
     * 随机生成字符串
     * @param $length 长度
     * @return string
     */
    public function mtrandStr($length)
    {
        $length = $length ? $length : 8;
        $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $str = '';
        for($i=0;$i<$length;$i++){
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
}


