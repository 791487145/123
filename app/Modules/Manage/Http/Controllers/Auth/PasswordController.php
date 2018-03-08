<?php

namespace App\Modules\Manage\Http\Controllers\Auth;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends BasicController
{
    


    use ResetsPasswords;

    
    public function __construct()
    {
        $this->middleware('guest');
    }
}
