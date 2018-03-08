<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class EducationAuthModel extends Model
{
    
    protected $table = 'education_auth';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','uid','student_number','student_id_card','status','create_at','auth_user','auth_time'
    ];

    public $timestamps = false;


}
