<?php
namespace FrankRabbit\Authen\Facades;

use Illuminate\Support\Facades\Facade;

class Crt extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'crt';
    }
}