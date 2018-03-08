<?php

namespace App\Modules\Advertisement\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class AdTargetModel extends Model
{
    protected $table = 'ad_target';
    protected $fillable = ['target_id','name','code','ad_num','pic'];
    public  $timestamps = false;  

    
    static function getAdInfo($targetCode)
    {
        $adTargetInfo = AdTargetModel::where('code',$targetCode)->select('target_id')->first();
        $ad = [];
        if($adTargetInfo['target_id']){
            $rightPicInfo = AdModel::where('target_id',$adTargetInfo['target_id'])
                ->where('is_open','1')
                ->where(function($rightPicInfo){
                    $rightPicInfo->where('end_time','0000-00-00 00:00:00')
                        ->orWhere('end_time','>',date('Y-m-d H:i:s',time()));
                })
                ->select('ad_file','ad_url')
                ->get();
            if(count($rightPicInfo)){
                $ad = $rightPicInfo;
            }
            else{
                $ad = [];
            }
        }
        return $ad;
    }

}
