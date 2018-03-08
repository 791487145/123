<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BasicController;
use App\User;
use Validator;
use Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends BasicController
{
    


    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|between:2,10|alpha_num|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|between:3,16|alpha_num',
            'confirmPassword' => 'required|same:password',
            'code' => 'required|alpha_num'
        ]);
    }

    
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    


}
