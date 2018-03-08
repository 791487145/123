<?php

namespace App\Http\Middleware;

use App\Modules\User\Model\UserModel;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    
    protected $auth;

    

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/login');
            }
        }

        if (UserModel::find(Auth::id())->status == 2){
            return redirect('logout');
        }

        return $next($request);
    }
}
