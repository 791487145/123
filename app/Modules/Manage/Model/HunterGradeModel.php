<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class HunterGradeModel extends Model
{
    
    protected $table = 'hunter_grade';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','grade','experience','grade_name','grade_img','create_time','status'
    ];

    public $timestamps = false;


}
