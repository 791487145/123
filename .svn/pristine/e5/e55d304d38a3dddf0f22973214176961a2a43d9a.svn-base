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

class TaskPayTypeModel extends Model
{
    protected $table = 'task_pay_type';
    public  $timestamps = false;  
    public $fillable = ['id','task_id','pay_type','pay_type_append','status','created_at','updated_at'];

    
    static public function saveTaskPayType($data)
    {
        $status = DB::transaction(function () use ($data) {
            $payTypeInfo = [
                'task_id' => $data['task_id'],
                'pay_type' => $data['pay_type'],
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            if($data['pay_type'] == 4){
                $payTypeInfo['pay_type_append'] = $data['pay_type_append'];
            }else{
                $payTypeInfo['pay_type_append'] = '';
            }
            TaskPayTypeModel::create($payTypeInfo);

            $sort = $data['sort'];
            $percent = $data['percent'];
            $price = $data['price'];
            $desc = $data['desc'];
            if(is_array($sort) && !empty($sort)){
                for ($i = 0; $i < count($sort); $i++) {
                    $paySectionInfo[] = array(
                        'task_id' => $data['task_id'],
                        'sort' => $sort[$i],
                        'percent' => $percent[$i],
                        'name' => '第'.$sort[$i].'阶段',
                        'price' => $price[$i],
                        'desc' => $desc[$i],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                }
                if (!empty($paySectionInfo)) {
                    TaskPaySectionModel::insert($paySectionInfo);
                }
            }
        });

        return is_null($status) ? true : false;
    }


    
    static public function checkTaskPayType($taskId,$type,$uid)
    {
        $status = DB::transaction(function () use ($taskId,$type,$uid) {
            TaskPayTypeModel::where('task_id',$taskId)->update(['status' => $type,'updated_at' => date('Y-m-d H:i:s')]);
            TaskPaySectionModel::where('task_id',$taskId)->update(['case_status' => $type,'uid'=> $uid,'updated_at' => date('Y-m-d H:i:s')]);
            if($type == 1){
                TaskModel::where('id', $taskId)->update(['checked_at'=>date('Y-m-d H:i:s',time())]);
            }
        });

        return is_null($status) ? true : false;
    }
}
