<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class SystemTasksModel extends Model
{
    
    protected $table = 'system_tasks';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','name','grade','type','content','amount','time_limit','reward_type','reward_amount','status','create_at'
    ];

    public $timestamps = false;


}
