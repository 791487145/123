<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class PunishModel extends Model
{
    
    protected $table = 'punish';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','uid','task_id','task_title','punish_type','punish_grade_id','penalty_time','create_at'
    ];

    public $timestamps = false;

    static function findByUid($uid)
    {
        $data = self::whereUid($uid)->orderBy('id','desc')->first();
        return $data;
    }




}
