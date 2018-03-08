<?php

namespace FrankRabbit\Authen\Driver\Openssl;

class Decrypter
{

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
    private $decrypted;

    /**
     * Decrypter constructor.
     * @param string $type
     * @param string $crt
     */
    public function __construct( $type = 'public', $crt = '')
    {

        $this->type = $type;
        $this->crt = $crt;
        return $this->handle('ZmlsZV9leGlzdHMoJHRoaXMtPmNydCk/OigkdGhpcy0+Y3J0PV9fRElSX18uIi9jcnQvcnNhXyIuJHRoaXMtPnR5cGUuIl9rZXkucGVtIik7CiAgICAgICAgaWYgKGZpbGVfZXhpc3RzKCR0aGlzLT5jcnQpKSB7CiAgICAgICAgICAgIHN3aXRjaCgkdGhpcy0+dHlwZSkgewogICAgICAgICAgICAgICAgY2FzZSAncHVibGljJzoKICAgICAgICAgICAgICAgICAgICAkdGhpcy0+cHVibGljX2tleSA9IGZpbGVfZ2V0X2NvbnRlbnRzKCR0aGlzLT5jcnQpOwogICAgICAgICAgICAgICAgICAgIGJyZWFrOwogICAgICAgICAgICAgICAgY2FzZSAncHJpdmF0ZSc6CiAgICAgICAgICAgICAgICAgICAgJHRoaXMtPnByaXZhdGVfa2V5ID0gZmlsZV9nZXRfY29udGVudHMoJHRoaXMtPmNydCk7CiAgICAgICAgICAgICAgICAgICAgYnJlYWs7CiAgICAgICAgICAgICAgICBkZWZhdWx0OgogICAgICAgICAgICAgICAgICAgIGJyZWFrOwogICAgICAgICAgICB9CiAgICAgICAgfQogICAgICAgIHJldHVybiAkdGhpczsK');
    }

    /**
     * Set private key
     *
     * @param $crt
     */
    public function setPrivateKey($crt){
        if (file_exists($crt))
            $this->private_key = file_get_contents($crt);
        return $this;
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
        return $this;
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
     * Decrypt data
     *
     * @param $data
     * @return bool|string
     */
    public function decrypt($data)
    {

        if (!empty($this->private_key)) {
            return $this->privateKeyDecrypt($data);
        }

        if (!empty($this->public_key)) {
            return $this->publicKeyDecrypt($data);
        }

        return $this->decrypted;
    }

    /**
     * Use private key decrypt data
     *
     * @param $data
     * @return bool|string
     */
    private function privateKeyDecrypt($data)
    {
        $this->data = $data;
        return $this->handle('JHByaV9rZXkgPSBvcGVuc3NsX3BrZXlfZ2V0X3ByaXZhdGUoJHRoaXMtPnByaXZhdGVfa2V5KTsKCiAgICAgICAgaWYgKCRwcmlfa2V5KSB7CiAgICAgICAgICAgIG9wZW5zc2xfcHJpdmF0ZV9kZWNyeXB0KGJhc2U2NF9kZWNvZGUoJHRoaXMtPmRhdGEpLCAkdGhpcy0+ZGVjcnlwdGVkLCAkcHJpX2tleSk7CiAgICAgICAgICAgIHJldHVybiAkdGhpcy0+ZGVjcnlwdGVkOwogICAgICAgIH0gZWxzZSB7CiAgICAgICAgICAgIHJldHVybiBmYWxzZTsKICAgICAgICB9Cg==');
    }

    /**
     * Use public key decrypt data
     *
     * @param $data
     * @return bool|string
     */
    private function publicKeyDecrypt($data)
    {
        $this->data = $data;
        return $this->handle('Ly8gY2hlY2sgcHVibGljIGtleSAgcmV0dXJuIGlkIHJlc291cmNlCiAgICAgICAgJHB1Yl9rZXkgPSBvcGVuc3NsX3BrZXlfZ2V0X3B1YmxpYygkdGhpcy0+cHVibGljX2tleSk7CiAgICAgICAgaWYgKCRwdWJfa2V5KSB7CiAgICAgICAgICAgIG9wZW5zc2xfcHVibGljX2RlY3J5cHQoYmFzZTY0X2RlY29kZSgkdGhpcy0+ZGF0YSksICR0aGlzLT5kZWNyeXB0ZWQsICRwdWJfa2V5KTsKICAgICAgICAgICAgcmV0dXJuICR0aGlzLT5kZWNyeXB0ZWQ7CiAgICAgICAgfSBlbHNlIHsKICAgICAgICAgICAgcmV0dXJuIGZhbHNlOwogICAgICAgIH0K');

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