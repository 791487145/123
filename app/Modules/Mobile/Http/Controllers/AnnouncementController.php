<?php
namespace App\Modules\Mobile\Http\Controllers;

use App\Http\Requests;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskWaterModel;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Config;
use Validator;
use Toplan\PhpSms\Sms;
use Illuminate\Support\Facades\Crypt;
use App\Modules\User\Model\UserModel;
use App\Modules\Manage\Model\AnnouncementModel;
use Cache;
use DB;
use Socialite;
use Auth;
use Log;
use Lang;
use Illuminate\Support\Facades\Redis;

class AnnouncementController extends ApiBaseController
{
    //添加
    public function addAnnouncement(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'sender_name' => 'required|min:1|max:4',
            'recipient_name' => 'min:1|max:4',
            'content' => 'required|min:1|max:10',
        ],[
            'sender_name.required' => '请输入发送人姓名',
            'sender_name.min' => '发送人姓名最短1位',
            'sender_name.max' => '发送人姓名最长4位',
            'recipient_name.min' => '发送人姓名最短1位',
            'recipient_name.max' => '发送人姓名最长4位',
            'content.required' => '请输入内容',
            'content.min' => '内容最短1位',
            'content.max' => '内容最长10位',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);

        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $data = [];
        $sender_name = $request->get('sender_name');
        $content = $request->get('content');
        $recipient_name = $request->get('recipient_name');
        if(!empty($recipient_name)){
            $data['content'] = $sender_name.'祝'.$recipient_name.': '.$content;
        }else{
            $data['content'] = $sender_name.'祝所有用户: '.$content;
        }
        $data['uid'] = $tokenInfo['uid'];
        $data['type'] = '2';
        $a_res = AnnouncementModel::create($data);
        if(!$a_res){
            return $this->formateResponse(1001,'网络错误');
        }
        return $this->formateResponse(1000,'提交成功');
    }


 

    public function getAnnounceList(Request $request)
    {
        $list = AnnouncementModel::where('status','valid')->orderBy('id','desc')->take(10)->get();
        if($list->isEmpty()){
            return $this->formateResponse(1001,'暂无数据');
        }
        $list = $list->toArray();
        return $this->formateResponse(1000,'success',$list);
    }

    public function makeData(Request $request)
    {
        $result = AnnouncementModel::makeDate(10);
        if(!$result) return $this->formateResponse(1001,'网络错误');
        return $this->formateResponse(1000,'success',$result);
    }

    /**首页动态
     * @return \Illuminate\Http\Response
     */
    static public function displayMiddleOfTask()
    {
        //Redis::del('task');
       /* Redis::rpush  ('task',182);
        Redis::rpush  ('task',183);*/
        $len= Redis::llen('task');
        $task_id= Redis::lrange('task',0,$len-1);

        $length = 5 - $len;

        if($len != 0){
            $tasks_true = TaskModel::whereIn('id',$task_id)->select('title','bounty','username')->get();
            foreach($tasks_true as $task_true){
                $task_true->bounty = round($task_true->bounty);
            }
            $tasks_true =  $tasks_true->toArray();
        }

        $tasks = TaskWaterModel::where('status',TaskWaterModel::TASK_PUB)->orderByRaw('RAND()')->take($length)->select('title','bounty','username')->get();
        if(!$tasks->isEmpty()){
            foreach($tasks as $task){
                $task->bounty = round($task->bounty);
            }
            $tasks =  $tasks->toArray();
        }

        if(!empty($tasks_true) && !empty($tasks)){
            $data = array_merge($tasks_true,$tasks);
        }
        if($len == 0){
            $data = $tasks;
        }
        if($length == 0){
            $data = $tasks_true;
        }

        foreach($task_id as $id){
            Redis::lrem('task',0,$id);
        }
        return $data;
    }

}
