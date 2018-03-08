<?php
namespace FrankRabbit\Authen\Tool;

use FrankRabbit\Authen\Driver\Openssl\Encrypter;

class CrtBuilder
{

    private $private_key;

    private $encrypter;

    public function __construct()
    {
        $this->encrypter = new Encrypter('private');
    }

    public function build($data, $template, $certificate)
    {

        $file_info = getimagesize($template);
        $mime = strtolower($file_info['mime']);
        $img_obj = false;

        switch ($mime) {
            case 'image/png':
                $img_obj = imagecreatefrompng($template);
                break;
            case 'image/gif':
                $img_obj = imagecreatefromgif($template);
                break;
            case 'image/jpeg':
                $img_obj = imagecreatefromjpeg($template);
                break;
            default:
                return $img_obj;
        }

        //$certificate = '/home/web/blog/public/test.png';
        //$data = 'abcefg'; //待附加的信息
        imagepng($img_obj, $certificate); //生成png图片授权文件
        // 将自定义内容写入授权文件
        //$stat = file_put_contents($certificate, sprintf('%s%s', $data, pack('n', strlen($data))), FILE_APPEND);
        $stat = file_put_contents($certificate, sprintf('%s', $data), FILE_APPEND);
        imagedestroy($img_obj);
        return $stat;

    }

    /**
     * Send a POST requst using cURL
     * @param string $url to request
     * @param array $post values to send
     * @param array $options for cURL
     * @return string
     */
    function curl_post($url, array $post = NULL, array $options = array())
    {
        $defaults = array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => $url,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 4,
            CURLOPT_POSTFIELDS => http_build_query($post)
        );

        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));
        if( ! $result = curl_exec($ch))
        {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    /**
     * Send a GET requst using cURL
     * @param string $url to request
     * @param array $get values to send
     * @param array $options for cURL
     * @return string
     */
    function curl_get($url, array $get = NULL, array $options = array())
    {
        $defaults = array(
            CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($get),
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 4
        );

        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));
        if( ! $result = curl_exec($ch))
        {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

}