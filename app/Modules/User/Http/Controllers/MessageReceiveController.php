<?php
namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\UserCenterController;
use App\Modules\User\Model\MessageReceiveModel;
use Illuminate\Http\Request;
use Auth;

class MessageReceiveController extends UserCenterController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('userfinance');
    }

    
    public function messageList(Request $request,$type)
    {
        $this->theme->setTitle('我的消息');
        $arr = $request->all();
        $user = Auth::User();
        $userId = $user['id'];
        $typeInt = intval($type);
        $arrayData = [1,2,3,4];
        if(in_array($typeInt,$arrayData)){
            $type = $typeInt;
        }else{
            $type = $arrayData[0];
        }
        if($request->get('is_read') && $request->get('is_read') == 1)
        {
            switch ($type) {
                case 1:
                    $message = MessageReceiveModel::where('js_id', $userId)->where('message_type', 1)->where('status', 0)
                        ->orderBy('receive_time', 'DESC')->paginate(10);
                    $messageCount = MessageReceiveModel::where('js_id', $userId)->where('message_type', 1)->where('status', 0)->count();
                    break;
                case 2:
                    $message = MessageReceiveModel::where('js_id', $userId)->where('message_type', 2)->where('status', 0)
                        ->orderBy('receive_time', 'DESC')->paginate(10);
                    
                    $messageCount = MessageReceiveModel::where('js_id', $userId)->where('message_type', 2)->where('status', 0)->count();
                    break;
                case 3:
                    $message = MessageReceiveModel::where('message_receive.fs_id', $userId)->where('message_receive.message_type', 3)->where('message_receive.status', 0)
                        ->leftJoin('users','users.id','=','message_receive.js_id')
                        ->select('message_receive.*','users.name as username')
                        ->orderBy('receive_time', 'DESC')->paginate(10);
                    
                    $messageCount = MessageReceiveModel::where('fs_id', $userId)->where('message_type', 3)->where('status', 0)->count();
                    break;
                case 4:
                    $message = MessageReceiveModel::where('message_receive.js_id', $userId)->where('message_receive.message_type', 3)->where('message_receive.status', 0)
                        ->leftJoin('users','users.id','=','message_receive.fs_id')
                        ->select('message_receive.*','users.name as username')
                        ->orderBy('receive_time', 'DESC')->paginate(10);
                    
                    $messageCount = MessageReceiveModel::where('js_id', $userId)->where('message_type', 3)->where('status', 0)->count();
                    break;
            }
        }elseif($request->get('is_read') && $request->get('is_read') == 2){
            switch ($type) {
                case 1:
                    $message = MessageReceiveModel::where('js_id', $userId)->where('message_type', 1)->where('status', 1)
                        ->orderBy('receive_time', 'DESC')->paginate(10);
                    $messageCount = MessageReceiveModel::where('js_id', $userId)->where('message_type', 1)->where('status', 0)->count();
                    break;
                case 2:
                    $message = MessageReceiveModel::where('js_id', $userId)->where('message_type', 2)->where('status', 1)
                        ->orderBy('receive_time', 'DESC')->paginate(10);
                    
                    $messageCount = MessageReceiveModel::where('js_id', $userId)->where('message_type', 2)->where('status', 0)->count();
                    break;
                case 3:
                    $message = MessageReceiveModel::where('message_receive.fs_id', $userId)->where('message_receive.message_type', 3)->where('message_receive.status', 1)
                        ->leftJoin('users','users.id','=','message_receive.js_id')
                        ->select('message_receive.*','users.name as username')
                        ->orderBy('receive_time', 'DESC')->paginate(10);
                    
                    $messageCount = MessageReceiveModel::where('fs_id', $userId)->where('message_type', 3)->where('status', 0)->count();
                    break;
                case 4:
                    $message = MessageReceiveModel::where('message_receive.js_id', $userId)->where('message_receive.message_type', 3)->where('message_receive.status', 1)
                        ->leftJoin('users','users.id','=','message_receive.fs_id')
                        ->select('message_receive.*','users.name as username')
                        ->orderBy('receive_time', 'DESC')->paginate(10);
                    
                    $messageCount = MessageReceiveModel::where('js_id', $userId)->where('message_type', 3)->where('status', 0)->count();
                    break;
            }
        } else
        {
            switch($type)
            {
                case 1:
                    $message = MessageReceiveModel::where('js_id',$userId)->where('message_type',1)
                        ->orderBy('receive_time','DESC')->paginate(10);
                    $messageCount = MessageReceiveModel::where('js_id',$userId)->where('message_type',1)->where('status',0)->count();
                    break;
                case 2:
                    $message = MessageReceiveModel::where('js_id',$userId)->where('message_type',2)
                        ->orderBy('receive_time','DESC')->paginate(10);
                    
                    $messageCount = MessageReceiveModel::where('js_id',$userId)->where('message_type',2)->where('status',0)->count();
                    break;
                case 3:
                    $message = MessageReceiveModel::where('message_receive.fs_id',$userId)->where('message_receive.message_type',3)
                        ->leftJoin('users','users.id','=','message_receive.js_id')
                        ->select('message_receive.*','users.name as username')
                        ->orderBy('receive_time','DESC')->paginate(10);
                    
                    $messageCount = MessageReceiveModel::where('fs_id',$userId)->where('message_type',3)->where('status',0)->count();
                    break;
                case 4:
                    $message = MessageReceiveModel::where('message_receive.js_id',$userId)->where('message_receive.message_type',3)
                        ->leftJoin('users','users.id','=','message_receive.fs_id')
                        ->select('message_receive.*','users.name as username')
                        ->orderBy('receive_time','DESC')->paginate(10);
                    
                    $messageCount = MessageReceiveModel::where('js_id',$userId)->where('message_type',3)->where('status',0)->count();
                    break;
            }
        }
        $view = array(
            'merge'=> $arr,
            'message' => $message,
            'type' => $type,
            'uid' => $userId,
            'new_count' => $messageCount
        );
        return $this->theme->scope('user.messagelist', $view)->render();
    }

    
    public function changeStatus($id,$type)
    {
        $id = intval($id);
        $data = array(
            'status' => 1,
            'read_time' => date('Y-m-d H:i:s',time())
        );
        $res = MessageReceiveModel::where('id',$id)->update($data);
        if($res)
        {
            return redirect('/user/messageList/'.$type);
        }
        else
        {
            return redirect('/user/messageList/'.$type);
        }
    }

    
    public function postChangeStatus(Request $request)
    {
        $id = $request->get('id');
        if(!empty($id)){
            $data = array(
                'status' => 1,
                'read_time' => date('Y-m-d H:i:s',time())
            );
            $res = MessageReceiveModel::where('id',$id)->update($data);
            if(!empty($res)){
                $data = array(
                    'code' => 1,
                    'msg' => '修改成功'
                );
            }else{
                $data = array(
                    'code' => 0,
                    'msg' => '修改失败'
                );
            }
        }else{
            $data = array(
                'code' => 0,
                'msg' => '缺少参数'
            );
        }
        return response()->json($data);
    }

    

    public function allChange(Request $request)
    {
        $arr = $request->all();
        $status = $arr['status'];
        $ids = $arr['ids'];
        switch($status)
        {
            case 1:
                $data = array(
                    'status' => 1,
                    'read_time' => date('Y-m-d H:i:s',time())
                );
                $res = MessageReceiveModel::whereIn('id',$ids)->update($data);
                if($res)
                {
                    return \GuzzleHttp\json_encode(array(
                        'code' => 1,
                        'msg' => '操作成功'
                    ));
                }
                else
                {
                    return \GuzzleHttp\json_encode(array(
                        'code' => 0,
                        'msg' => '操作失败'
                    ));
                }
                break;

            case 2:
                $res = MessageReceiveModel::destroy($ids);
                if($res)
                {
                    return \GuzzleHttp\json_encode(array(
                        'code' => 1,
                        'msg' => '操作成功'
                    ));
                }
                else
                {
                    return \GuzzleHttp\json_encode(array(
                        'code' => 0,
                        'msg' => '操作失败'
                    ));
                }
                break;
        }
    }

    
    public function contactMe(Request $request)
    {
        $data = $request->all();
        $user = Auth::User();
        $userId = $user['id'];
        $arr = array(
            'message_title' => $data['title'],
            'message_content' => $data['content'],
            'message_type' => 3,
            'fs_id' => $userId,
            'js_id' => $data['js_id'],
            'receive_time' => date('Y-m-d H:i:s',time())
        );
        $res = MessageReceiveModel::create($arr);
        if($res)
        {
            return \GuzzleHttp\json_encode(array(
                'code' => 1,
                'msg' => '操作成功'
            ));
        }
        else
        {
            return \GuzzleHttp\json_encode(array(
                'code' => 0,
                'msg' => '操作失败'
            ));
        }

    }

}
