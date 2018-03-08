<?php

use Toplan\PhpSms\Sms;

/**
 * Created by PhpStorm.
 * User: kuke
 * Date: 2016/10/20
 * Time: 10:43
 */
class SmsClass
{


    /**
     * 发送短信
     *
     * @param $mobile
     * @param array $templates ['服务商' => 'temp_id']
     * @param array $data ['变量' => '值']
     * @param string $content
     * @return string
     */
    static function sendSms($mobile, $templates, $data, $content = '')
    {
        $to = $mobile;
        
        $status = Sms::make()->to($to)->template($templates)->data($data)
            ->content($content)->send();

        return $status;
    }

}