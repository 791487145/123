<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Modules\Manage\Model\MessageTemplateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');
        $this->theme->setTitle('短信模版管理');
        $this->theme->set('manageType', 'message');

    }

    
    public function messageList(Request $request)
    {
        $message = MessageTemplateModel::orderBy('id','DESC')->paginate(20);
        $data = array(
            'message_list' => $message
        );
        $this->theme->setTitle('消息模板');
        return $this->theme->scope('manage.messagelist', $data)->render();
    }

    
    public function editMessage(Request $request,$id)
    {
        $id = intval($id);
        $messageInfo = MessageTemplateModel::where('id',$id)->first();
        
        $message = MessageTemplateModel::get()->toArray();
        $data = array(
            'message_info' => $messageInfo,
            'message' => $message,
            'id' => $id
        );
        return $this->theme->scope('manage.editmessage', $data)->render();
    }

    
    public function postEditMessage(Request $request)
    {
        $data = $request->except('_token');
        $data['content'] = htmlspecialchars($data['content']);
        if(mb_strlen($data['content']) > 4294967295/3){
            $error['content'] = '内容太长，建议减少上传图片';
            if (!empty($error)) {
                return redirect('/manage/editMessage/'.$data['id'])->withErrors($error);
            }
        }
        $rule = "/\{\{[\\w](.*?)\}\}/";
        preg_match_all($rule,$data['content'],$matches);
        $params = empty($matches[0])?:array_unique($matches[0]);
        $number = count($params);
        if(!empty($params) && is_array($params)){
            foreach($params as $k => $v)
            {
                $params[$k] = substr($v,2,-2);
            }
            $variableStr = implode($params,',');
        }else{
            $variableStr = '';
        }
        $arr = array(
            'name' => $data['name'],
            'code_name' => $data['code_name'],
            'content' => $data['content'],
            'num' => $number,
            'variable_str' => $variableStr,
            'updated_at' => date('Y-m-d H:i:s',time())
        );
        $res = MessageTemplateModel::where('id',$data['id'])->update($arr);
        if($res)
        {
            return redirect('/manage/messageList')->with(array('message' => '操作成功'));
        }
    }

    
    public function changeStatus(Request $request,$id,$isName,$status)
    {
        $id = intval($id);
        $isName = intval($isName);
        switch($isName)
        {
            case 1:
                $arr = array(
                    'is_open' => $status,
                    'updated_at' => date('Y-m-d H:i:s',time())
                );
                $res = MessageTemplateModel::where('id',$id)->update($arr);
                break;
            case 2:
                $arr = array(
                    'is_on_site' => $status,
                    'updated_at' => date('Y-m-d H:i:s',time())
                );
                $res = MessageTemplateModel::where('id',$id)->update($arr);
                break;
            case 3:
                $arr = array(
                    'is_send_email' => $status,
                    'updated_at' => date('Y-m-d H:i:s',time())
                );
                $res = MessageTemplateModel::where('id',$id)->update($arr);
                break;

        }
        if($res)
        {
            return redirect('/manage/messageList')->with(array('message' => '操作成功'));
        }
        else
        {
            return redirect('/manage/messageList')->with(array('message' => '操作失败'));
        }
    }



    public function getMessage($id, $message) {

    }




}

