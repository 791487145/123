<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\User\Model\MessageReceiveModel;

class MessageTemplateModel extends Model
{
    
    protected $table = 'message_template';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','code_name','name','content','message_type','is_open','is_on_site','is_send_email','created_at','updated_at'
    ];

    public $timestamps = false;

    //通过模板获取要发送的内容
    //sendWay 1-站内信  2-发送邮件
    static function sendMessage($codeName,$messageVariableArr,$sendWay=1)
    {
        switch($sendWay){
            case 1:
                $sendWay = 'is_on_site';
                break;
            case 2:
                $sendWay = 'is_send_email';
                break;
        }

        
        $message = MessageTemplateModel::where('code_name',$codeName)->where('is_open',1)->where($sendWay,1)->first();
        if($message['num'] > 0)
        {
            $rule = "/\{\{[\\w](.*?)\}\}/";
            preg_match_all($rule,$message['content'],$matches);
            $oldArr = empty($matches[0])?:array_unique($matches[0]);
            $res = str_replace($oldArr,$messageVariableArr,$message['content']);
        }
        else
        {
            $res = $message['content'];
        }
        return $res;
    }

    /**
     * 给用户发送站内信
     * @param  [type] $uid                接收人ID
     * @param  [type] $codeName           模板名称代号
     * @param  [type] $messageVariableArr 模板参数数组
     * @param  string $sendWay            发送方式 1-站内信  2-发送邮件
     * @param  string $message_type       信息类型 1-系统消息 2-交易动态
     * @return [type]                     
     */
    static function sendToUser($uid,$codeName,$messageVariableArr,$fs_id='',$sendWay='1',$message_type='1')
    {
        switch($sendWay){
            case 1:
                $sendWay = 'is_on_site';
                break;
            case 2:
                $sendWay = 'is_send_email';
                break;
        }

        $message = MessageTemplateModel::where('code_name',$codeName)->where('is_open',1)->where($sendWay,1)->first();

        if(empty($message)) return array('code'=>'-1','msg'=>'不存在该模板');

        if($message['num'] > 0)
        {
            $rule = "/\{\{[\\w](.*?)\}\}/";
            preg_match_all($rule,$message['content'],$matches);
            $oldArr = empty($matches[0])?:array_unique($matches[0]);
            $message_str = str_replace($oldArr,$messageVariableArr,$message['content']);
        }
        else
        {
            $message_str = $message['content'];
        }

        $data = array(
                'message_title'=>$message['name'],
                'code_name'=>$codeName,
                'message_content'=>$message_str,
                'js_id'=>$uid,
                'message_type'=>$message_type,
                'receive_time'=>date('Y-m-d H:i:s',time()),
                'status'=>0,
            );

        if(!empty($fs_id)) $data['fs_id'] = $fs_id;

        $m_r_res = MessageReceiveModel::create($data);

        if(!$m_r_res) return array('code'=>'-2','msg'=>'网络错误');

        return array('code'=>'200','msg'=>'发送成功');
    }
}
