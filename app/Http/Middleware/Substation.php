<?php

namespace App\Http\Middleware;

use App\Modules\Manage\Model\SubstationModel;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
class Substation
{

    
    public function handle($request, Closure $next)
    {
        $path = $request->path();
        $pos = strrpos($path,'/');
        $id = intval(substr($path,$pos+1));
        
        $hotSub = SubstationModel::where('status',1)->get()->toArray();
        if(!empty($hotSub) && is_array($hotSub)){
            foreach ($hotSub as $item) {
                $subIds[] = $item['district_id'];
            }

        }
        if(empty($subIds) || !in_array($id,$subIds)){
            abort('404');
        }

        return $next($request);

    }
}
