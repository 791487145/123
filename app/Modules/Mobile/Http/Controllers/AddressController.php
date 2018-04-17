<?php
namespace App\Modules\Mobile\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Config;
use Validator;
use Toplan\PhpSms\Sms;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Manage\Model\AddressModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\Task\Model\DistrictRegionModel;
use App\Modules\User\Model\UserModel;
use Cache;
use DB;
use Socialite;
use Auth;
use Log;

class AddressController extends ApiBaseController
{
    //增
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|mobile_phone',
            'name' => 'required',
            'province' => 'required',
            'city' => 'required',
            'area' => 'required',
            'address' => 'required',
            'post_code' => 'required',
        ],[
            'name.required' => '请输入收货人姓名',
            'phone.mobile_phone' => '请输入正确的手机号码格式',
            'phone.required' => '请输入手机号',
            'province.required' => '请选择省份',
            'city.required' => '请选择市',
            'area.required' => '请选择区',
            'address.required' => '请填入详细地址',
            'post_code.required' => '请输入邮编',
        ]);
        
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001, $error[0]);
        if(strlen($request->get('post_code')) != 6 || !is_numeric($request->get('post_code'))){
            return $this->formateResponse(1001,'请输入正确格式的邮编');
        }
        $userInfo = Crypt::decrypt(urldecode($request->input('token')));
        $userAddressCount = AddressModel::where('uid',$userInfo['uid'])->where('status','1')->count();
        if($userAddressCount > 3 || $userAddressCount == 3){
            return $this->formateResponse('1001','抱歉，我们只能为您存储3条地址信息');
        }
        $province = DistrictModel::where('id',$request->get('province'))->select('name')->first();
        if(!$province) return $this->formateResponse(1001,'请选择有效的省份');
        $city = DistrictModel::where('id',$request->get('city'))->select('name')->first();
        if(!$city) return $this->formateResponse(1001,'请选择有效的市');
        $area = DistrictModel::where('id',$request->get('area'))->select('name')->first();
        if(!$area) return $this->formateResponse(1001,'请选择有效的区');
        $data = array(
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'province' => $request->get('province'),
                'province_cn' => $province['name'],
                'city' => $request->get('city'),
                'city_cn' => $city['name'],
                'area' => $request->get('area'),
                'area_cn' => $area['name'],
                'address' => $request->get('address'),
                'is_default' => 1,
                'status' => 1,
                'uid' => $userInfo['uid'],
                'post_code' => $request->get('post_code'),
            );
        $add_res = AddressModel::create($data);
        if($add_res){
            return $this->formateResponse(1000,'添加收货地址成功');
        }else{
            return $this->formateResponse(1001,'网络错误');
        }
    }

    //删
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'add_id' => 'required',
            'token' => 'required',
        ],[
            'add_id.required' => '请选择待删除地址',
            'token.required' => '请登录'
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001, $error[0]);
        $userInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user_add = AddressModel::where('uid',$userInfo['uid'])->where('id',$request->get('add_id'))->first();
        if($user_add){
            $add_res = AddressModel::where('id',$request->get('add_id'))->update(['status'=>'2']);
            if($add_res){
                return $this->formateResponse(1000,'删除地址成功');
            }else{
                return $this->formateResponse(1001,'网络错误');
            }
        }
        return $this->formateResponse(1001,'地址信息错误');
    }

    //改
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|mobile_phone',
            'name' => 'required',
            'province' => 'required',
            'city' => 'required',
            'area' => 'required',
            'address' => 'required',
            'add_id' => 'required',
            'post_code' => 'required',
        ],[
            'name.required' => '请输入收货人姓名',
            'phone.mobile_phone' => '请输入正确的手机号码格式',
            'phone.required' => '请输入手机号',
            'province.required' => '请选择省份',
            'city.required' => '请选择市',
            'area.required' => '请选择区',
            'address.required' => '请填入详细地址',
            'add_id.required' => '请选择地址',
            'post_code.required' => '请输入邮编',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);
        if(strlen($request->get('post_code')) != 6 || !is_numeric($request->get('post_code'))){
            return $this->formateResponse(1001,'请输入正确的邮编格式');
        }
        $province = DistrictModel::where('id',$request->get('province'))->select('name')->first();
        if(!$province) return $this->formateResponse(1001,'请选择有效的省份');
        $city = DistrictModel::where('id',$request->get('city'))->select('name')->first();
        if(!$city) return $this->formateResponse(1001,'请选择有效的市');
        $area = DistrictModel::where('id',$request->get('area'))->select('name')->first();
        if(!$area) return $this->formateResponse(1001,'请选择有效的区');
        $userInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user_add = AddressModel::where('uid',$userInfo['uid'])->where('id',$request->get('add_id'))->first();
        if($user_add){
            $data = array(
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'province' => $request->get('province'),
                'province_cn' => $province['name'],
                'city' => $request->get('city'),
                'city_cn' => $city['name'],
                'area' => $request->get('area'),
                'area_cn' => $area['name'],
                'address' => $request->get('address'),
                'post_code' => $request->get('post_code'),
            );
            $add_res = AddressModel::where('id',$request->get('add_id'))->update($data);
            if($add_res){
                return $this->formateResponse(1000,'更新地址成功');
            }elseif($add_res == 0){
                return $this->formateResponse(1001,'地址并未做修改');
            }else{
                return $this->formateResponse(1001,'网络错误');
            }
        }else{
            return $this->formateResponse(1001,'地址信息错误');
        }
    }

    //查
    public function detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'add_id' => 'required',
            'token' => 'required',
        ],[
            'add_id.required' => '请选择地址',
            'token.required' => '请登录'
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0]);
        $userInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user_add = AddressModel::where('uid',$userInfo['uid'])->where('id',$request->get('add_id'))->first();
        if($user_add){
            // $province = DistrictModel::where('id',$user_add['province'])->select('name')->first();
            // $user_add['province_name'] = $province['name'];
            // $area = DistrictModel::where('id',$user_add['area'])->select('name')->first();
            // $user_add['area_name'] = $area['name'];
            // $city = DistrictModel::where('id',$user_add['city'])->select('name')->first();
            // $user_add['city_name'] = $city['name'];
            return $this->formateResponse(1000,'success',$user_add);
        }else{
            return $this->formateResponse(1001,'地址信息错误');
        }
    }

    //列表
    public function list(Request $request)
    {
        $userInfo = Crypt::decrypt(urldecode($request->input('token')));
        $list = AddressModel::where('uid',$userInfo['uid'])->where('status','1')->get();
        if(!$list->isEmpty()){
            // foreach($list as &$list_s){
            //     $province = DistrictModel::where('id',$list_s['province'])->select('name')->first();
            //     $list_s['province_name'] = $province['name'];
            //     $area = DistrictModel::where('id',$list_s['area'])->select('name')->first();
            //     $list_s['area_name'] = $area['name'];
            //     $city = DistrictModel::where('id',$list_s['city'])->select('name')->first();
            //     $list_s['city_name'] = $city['name'];
            // }
            return $this->formateResponse(1000,'success',$list);    
        }else{
            return $this->formateResponse(1001,'暂无收货地址，请添加');
        }
    }

    //设置默认地址
    public function setDefault(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'add_id' => 'required',
            'token' => 'required',
        ],[
            'add_id.required' => '请选择地址',
            'token.required' => '请登录'
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0]);
        $userInfo = Crypt::decrypt(urldecode($request->input('token')));
        $user_add = AddressModel::where('uid',$userInfo['uid'])->where('id',$request->get('add_id'))->where('status','1')->first();
        if($user_add){
            $add_res = AddressModel::where('id',$request->get('add_id'))->update(['is_default'=>'2']);
            if($add_res){
                return $this->formateResponse(1000,'设置成功');
            }else{
                return $this->formateResponse(1001,'网络错误');
            }
        }else{
            return $this->formateResponse(1001,'地址信息错误');
        }
    }

    //获取默认地址
    Public function getDefault(Request $request)
    {
        $userInfo = Crypt::decrypt(urldecode($request->input('token')));

        $default = AddressModel::where('uid',$userInfo['uid'])
                                ->where('status','1')
                                ->where('is_default','2')
                                ->select('name','phone','province_cn','city_cn','area_cn','address','id')
                                ->first();
        
        if(empty($default)){
            $address = AddressModel::where('uid',$userInfo['uid'])->where('status','1')->first(); 
            if(empty($address)){
                return $this->formateResponse(1001,'未添加地址，请添加');
            }else{
                return $this->formateResponse(1001,'success',$address);
            }
        }else{
            return $this->formateResponse(1000,'success',$default);
        }
    }

    /**获取学校信息
     * @return \Illuminate\Http\Response
     */
    public function getSchoolInfo()
    {
        $data = DistrictRegionModel::getDistrictSchoolLists();
        return $this->formateResponse(1000,'success',$data);
    }

    /**获取地址信息（post:/address/allDistrictInfo）
     * @param Request $request
     * @return mixed
     */
    public function allDistrictInfo(Request $request)
    {
        if(Cache::has('district')){
            $data = Cache::get('district');
        }else{
            $param = new DistrictModel();
            $data = DistrictRegionModel::findAll($param);
            Cache::put('district',$data,72*60);
        }

        return $data;
    }
}
