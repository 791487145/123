<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class PunishGradeModel extends Model
{
    
    protected $table = 'punish_grade';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','name','experience','penalty_time','create_at'
    ];

    public $timestamps = false;


}
