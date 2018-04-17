<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserFunctionModel extends Model
{
    
    protected $table = 'user_function';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','uid','navigation_id'
    ];

    public $timestamps = false;


}
