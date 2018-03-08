<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserSystemOptionModel extends Model
{
    
    protected $table = 'user_system_option';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','uid','systerm_task_id_arr','status','created_at','updated_at'
    ];

    public $timestamps = true;


}
