<?php
namespace FrankRabbit\Authen\Tool;

use FrankRabbit\Authen\Driver\Openssl\Decrypter;
use FrankRabbit\Authen\Driver\Openssl\Encrypter;

class CodeBuilder
{

    /*
     * decrypter
     */
    private $decrypter;

    /*
     * encrypter
     */
    private $encrypter;

    /**
     * Codebuilder constructor.
     */
    public function __construct()
    {
        $this->decrypter = new Decrypter('public');
        $this->encrypter = new Encrypter('private');
    }


    public function encrypt($code)
    {
        $code = base64_encode($code);
        return $this->encrypter->encrypt($code);
    }

    public function decrypt($code)
    {
        $code = $this->decrypter->decrypt($code);
        return base64_decode($code);
    }
}