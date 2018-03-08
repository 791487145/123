<?php

namespace App\Modules\Order\Model;

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

class SubOrderModel extends Model
{

    
    protected $table = 'sub_order';
    protected $fillable = ['title','note','cash','uid','order_id','order_code','product_id','product_type','status','created_at','updated_at'];

    
    static function createOne($data,$uid)
    {
        $model = new SubOrderModel();
        $model->title = $data['title'];
        $model->note = isset($data['note'])?$data['note']:'';
        $model->cash = $data['cash'];
        $model->uid = $uid;
        $model->order_id = $data['order_id'];
        $model->order_code = $data['order_code'];
        $model->product_id = isset($data['product_id'])?$data['product_id']:'';
        $model->product_type = isset($data['product_type'])?$data['product_type']:'';
        $model->status = isset($data['status'])?$data['status']:0;
        $model->created_at = date('Y-m-d H:i:s',time());
        $model->updated_at = date('Y-m-d H:i:s',time());

        $model->save();

        return  $model;
    }

    static function findByOrderId($orderId)
    {
        $data['sum'] = self::where('order_id',$orderId)->sum('cash');
        return $data;
    }
}
