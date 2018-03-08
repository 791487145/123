<?php

namespace App\Modules\Task\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class SuccessCaseModel extends Model
{
    protected $table = 'success_case';
    protected $fillable = ['uid','username','title','url','pic','cate_id','pub_uid','view_count','created_at','type','desc'];
    public  $timestamps = false;  

    
    static function getSuccessCaseListByUid($uid,$merge=array())
    {
        $successCaseList = SuccessCaseModel::whereRaw('1 = 1');
        if(isset($merge['title'])){
            $successCaseList = $successCaseList->where('success_case.title','like','%'.$merge['title'].'%');
        }
        $successCaseList = $successCaseList->where('success_case.uid',$uid)->where('success_case.type',1)
            ->leftJoin('cate','cate.id','=','success_case.cate_id')
            ->select('success_case.*','cate.name')
            ->orderBy('success_case.created_at','DESC')
            ->paginate(5);
        return$successCaseList;
    }

    
    static function getSuccessInfoById($id)
    {
        $successInfo = SuccessCaseModel::where('id',$id)->first();
        if($successInfo->cate_id){
            $cateInfo = TaskCateModel::where('id',$successInfo->cate_id)->select('id','pid','name')->first();
            $successInfo['cate_name'] = $cateInfo->name;
            if($cateInfo->pid){
                $successInfo['cate_pid'] = $cateInfo->pid;
            }
        }
        return $successInfo;
    }

    
    static function getOtherSuccessByUid($uid,$id,$limit=5)
    {
        $successCaseList = SuccessCaseModel::where('success_case.uid',$uid)->where('success_case.type',1)
            ->where('success_case.id','!=',$id)
            ->leftJoin('cate','cate.id','=','success_case.cate_id')
            ->select('success_case.*','cate.name')
            ->orderBy('success_case.created_at','DESC')
            ->limit($limit)->get()->toArray();
        return $successCaseList;
    }

}
