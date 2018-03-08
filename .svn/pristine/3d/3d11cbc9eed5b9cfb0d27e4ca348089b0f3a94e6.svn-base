<?php

namespace App\Extensions;
use Illuminate\Support\Facades\Blade;

class ExtendBlade
{
    public static function register()
    {
        
        Blade::extend(function ($view, $compiler) {
            $pattern = self::createPlainMatcher('break');
            return preg_replace($pattern, '$1<?php break; ?>$2', $view);
        });

    }
    public static function createPlainMatcher($function)
    {
        return '/(?<!\w)(\s*)@'.$function.'(\s*)/';
    }

}
