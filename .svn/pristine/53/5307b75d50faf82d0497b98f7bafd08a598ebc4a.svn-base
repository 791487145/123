<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserGoldRecordModel extends Model
{
    
    protected $table = 'user_gold_record';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','uid','gold','method','sign_record_id','created_at','updated_at','crement'
    ];

    public $timestamps = true;

    //每日总金币
    static function amountGoldOfUserToday($uid)
    {
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d",strtotime("+1 day"));
        $data = self::whereUid($uid)->where('created_at','>',$today)->where('created_at','<',$tomorrow)->sum('gold');
        return $data;
    }
}
