<?php
namespace FrankRabbit\Authen;

use FrankRabbit\Authen\Driver\Openssl\Decrypter;
use FrankRabbit\Authen\Driver\Openssl\Encrypter;

class Crt
{

    private $crt_file;

    /*
     * crt info
     */
    public $crt_info;

    /*
     * status
     */
    private $staus;

    /*
     * decrypter
     */
    private $decrypter;

    /**
     * Crt constructor.
     */
    public function __construct()
    {
        $this->decrypter = new Decrypter("public");
    }

    /**
     * Check certificate
     *
     * @param $certificate_file
     * @param int $length
     * @return string
     */
    public function certificate( $crt_file )
    {
        $this->crt_file = $crt_file;
        return eval(base64_decode('JHRoaXMtPmdldENydEluZm8oKTsKICAgICAgICByZXR1cm4gJHRoaXMtPmNoZWNrKCk7Cg=='));
    }

    /**
     *
     * @param $crt_file
     * @param int $length
     * @return string
     */
    public function getCrtInfo()
    {
        eval(base64_decode('JGNydF9jb250ZW50ID0gZmlsZV9nZXRfY29udGVudHMoJHRoaXMtPmNydF9maWxlKTsKICAgICAgICAkdGhpcy0+Y3J0X2luZm8gPSBzdWJzdHIoJGNydF9jb250ZW50LCAtMTcyKTsK'));
    }

    public function check(){
        return eval(base64_decode('JGNvbnRlbnQgPSAkdGhpcy0+ZGVjcnlwdGVyLT5kZWNyeXB0KCR0aGlzLT5jcnRfaW5mbyk7CiAgICAgICAgaWYgKCRfU0VSVkVSWyJTRVJWRVJfTkFNRSJdID09ICRjb250ZW50KSB7CiAgICAgICAgICAgICRfU0VSVkVSWydBdXRoZW50aWNhdGlvbiddID0gJHRoaXMtPmNydF9pbmZvOwogICAgICAgICAgICByZXR1cm4gJHRoaXMtPmNydF9pbmZvOwogICAgICAgIH0gZWxzZSB7CiAgICAgICAgICAgIHJldHVybiBmYWxzZTsKICAgICAgICB9Cg=='));
    }

}