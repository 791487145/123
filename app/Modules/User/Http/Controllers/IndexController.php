<?php
namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\UserCenterController;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use App\Modules\User\SpaceModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Crypt;
use Storage;

class IndexController extends UserCenterController
{

    
    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|sometimes|email',
            'password' => 'required|alpha_dash'
        ]);
        if ($validator->fails()) {
            return Response('参数错误');
        }
        $userInfo = array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Crypt::encrypt($request->get('password'))
        );

        User::create($userInfo);
        return Response('创建成功');
    }

    
    public function updateTips(Request $request)
    {
        $user = Auth::user();
        $arr = array(
            'alternate_tips' => 1
        );
        $res = UserDetailModel::where('uid',$user->id)->update($arr);
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

    
    public function ajaxChangeAvatar(Request $request)
    {
        $user = Auth::user();
        $data = $request->except('_token');
        $file = (object)$data;

        
        $result = \FileClass::headUpload($file, $user['id']);

        $result = json_decode($result, true);
        $avatar = $result['data']['url'];
        $arr = array(
            'avatar' => $avatar
        );
        $res = UserDetailModel::where('uid',$user['id'])->update($arr);
        if($res){
            $data = array(
                'code' => 1,
                'msg' => '上传成功'
            );
        }else{
            $data = array(
                'code' => 0,
                'msg' => '上传失败'
            );
        }
        return json_encode($data);

    }


    
    public function checkMobile(Request $request)
    {
        $mobile = $request->get('param');

        $status = UserModel::where('mobile', $mobile)->first();
        if (empty($status)){
            $status = 'y';
            $info = '';
        } else {
            $info = '手机已占用';
            $status = 'n';
        }
        $data = array(
            'info' => $info,
            'status' => $status
        );
        return json_encode($data);
    }
}
