<?php

namespace FrankRabbit\Authen\Driver\Openssl;

class Encrypter
{

    /*
     * key type
     */
    private $type;

    /*
     * crt file
     */
    private $crt;

    /*
     * data content
     */
    private $data;
    /*
     * Openssl private key
     */
    private $private_key;

    /*
     * Openssl public key
     */
    private $public_key;

    /*
     * Encrypt data
     */
    private $encrypted;

    /**
     * Encrypter constructor.
     * @param string $type
     * @param string $crt
     */
    public function __construct( $type = "public", $crt = "")
    {
        $this->type = $type;
        $this->crt = $crt;

        return $this->handle('ZmlsZV9leGlzdHMoJHRoaXMtPmNydCk/OigkdGhpcy0+Y3J0PV9fRElSX18uIi9jcnQvcnNhXyIuJHRoaXMtPnR5cGUuIl9rZXkucGVtIik7CgogICAgICAgIGlmIChmaWxlX2V4aXN0cygkdGhpcy0+Y3J0KSkgewogICAgICAgICAgICBzd2l0Y2goJHRoaXMtPnR5cGUpIHsKICAgICAgICAgICAgICAgIGNhc2UgInB1YmxpYyI6CiAgICAgICAgICAgICAgICAgICAgJHRoaXMtPnB1YmxpY19rZXkgPSBmaWxlX2dldF9jb250ZW50cygkdGhpcy0+Y3J0KTsKICAgICAgICAgICAgICAgICAgICBicmVhazsKICAgICAgICAgICAgICAgIGNhc2UgInByaXZhdGUiOgogICAgICAgICAgICAgICAgICAgICR0aGlzLT5wcml2YXRlX2tleSA9IGZpbGVfZ2V0X2NvbnRlbnRzKCR0aGlzLT5jcnQpOwogICAgICAgICAgICAgICAgICAgIGJyZWFrOwogICAgICAgICAgICAgICAgZGVmYXVsdDoKICAgICAgICAgICAgICAgICAgICBicmVhazsKICAgICAgICAgICAgfQogICAgICAgIH0KICAgICAgICByZXR1cm4gJHRoaXM7Cg==');
    }

    /**
     * Set private key
     *
     * @param $crt
     */
    public function setPrivateKey($crt){
        if (file_exists($crt))
            $this->private_key = file_get_contents($crt);
    }

    /**
     * Get private key
     *
     * @return string
     */
    public function getPrivateKey(){
        return $this->private_key;
    }

    /**
     * Set public key
     *
     * @param $crt
     */
    public function setPublicKey($crt){
        if (file_exists($crt))
            $this->public_key = file_get_contents($crt);
    }

    /**
     * Get public key
     *
     * @return string
     */
    public function getPublicKey(){
        return $this->public_key;
    }

    /**
     * Encrypt data
     *
     * @param $data
     * @return bool|string
     */
    public function encrypt($data)
    {

        if (!empty($this->private_key)) {
            return $this->privateKeyEncrypt($data);
        }

        if (!empty($this->public_key)) {
            return $this->publicKeyEncrypt($data);
        }

        return $this->encrypted;
    }

    /**
     * Use private key encrypt data
     *
     * @param $data
     * @return bool|string
     */
    private function privateKeyEncrypt($data)
    {
        $this->data = $data;
        return $this->handle('Ly8gY2hlY2sgcHJpdmF0ZSBrZXkgcmV0dXJuIGlkIHJlc291cmNlCiAgICAgICAgJHByaV9rZXkgPSBvcGVuc3NsX3BrZXlfZ2V0X3ByaXZhdGUoJHRoaXMtPnByaXZhdGVfa2V5KTsKICAgICAgICBpZiAoJHByaV9rZXkpIHsKICAgICAgICAgICAgb3BlbnNzbF9wcml2YXRlX2VuY3J5cHQoJHRoaXMtPmRhdGEsICR0aGlzLT5lbmNyeXB0ZWQsICRwcmlfa2V5KTsKICAgICAgICAgICAgLyog5Yqg5a+G5ZCO55qE5YaF5a656YCa5bi45ZCr5pyJ54m55q6K5a2X56ymLOmcgOimgee8lueggei9rOaNouS4iyzlnKjnvZHnu5zpl7TpgJrov4d1cmzkvKDovpPml7bopoHms6jmhI9iYXNlNjTnvJbnoIHmmK/lkKbmmK91cmzlronlhajnmoQgKi8KICAgICAgICAgICAgJHRoaXMtPmVuY3J5cHRlZCA9IGJhc2U2NF9lbmNvZGUoJHRoaXMtPmVuY3J5cHRlZCk7CiAgICAgICAgICAgIHJldHVybiAkdGhpcy0+ZW5jcnlwdGVkOwogICAgICAgIH0gZWxzZSB7CiAgICAgICAgICAgIHJldHVybiBmYWxzZTsKICAgICAgICB9Cg==');
    }

    /**
     * Use public key encrypt data
     *
     * @param $data
     * @return bool|string
     */
    private function publicKeyEncrypt($data)
    {
        $this->data = $data;
        return $this->handle('Ly8gY2hlY2sgcHVibGljIGtleSAgcmV0dXJuIGlkIHJlc291cmNlCiAgICAgICAgJHB1Yl9rZXkgPSBvcGVuc3NsX3BrZXlfZ2V0X3B1YmxpYygkdGhpcy0+cHVibGljX2tleSk7CgogICAgICAgIGlmICgkcHViX2tleSkgewogICAgICAgICAgICAvLyBlbmNyeXB0IGRhdGEKICAgICAgICAgICAgb3BlbnNzbF9wdWJsaWNfZW5jcnlwdCgkdGhpcy0+ZGF0YSwgJHRoaXMtPmVuY3J5cHRlZCwgJHB1Yl9rZXkpOwogICAgICAgICAgICAkdGhpcy0+ZW5jcnlwdGVkID0gYmFzZTY0X2VuY29kZSgkdGhpcy0+ZW5jcnlwdGVkKTsKICAgICAgICAgICAgcmV0dXJuICR0aGlzLT5lbmNyeXB0ZWQ7CiAgICAgICAgfSBlbHNlIHsKICAgICAgICAgICAgcmV0dXJuIGZhbHNlOwogICAgICAgIH0K');
    }

    /**
     * handle function
     *
     * @param $code
     * @return mixed
     */
    private function handle($code)
    {
        return eval(base64_decode($code));
    }

}