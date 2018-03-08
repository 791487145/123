<?php

namespace App\Modules\Test\Model;

use Illuminate\Database\Eloquent\Model;

class Common extends Model
{

    const KEEURL = 'http://testwww.kee.im/';

    const KPPWHTTPURL='http://dev.kekezu.net/test/testCallback';
    const KPPWACCESSTOKENURL= 'http://testsapi.kee.im/v1/oauth/accessToken';
    const KPPWREFRESHTOKENURL = 'http://testapi.kee.im/v1/oauth/refreshToken';


    
    static function sendPostRequest($url,$data)
    {
        $ch = curl_init();
        $postData = http_build_query($data);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       
        $data = curl_exec($ch);
        dd($data);
        curl_close($ch);

        return $data;
    }

    
    static function sendGetRequest($url)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }


}
