<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class AppNavigationModel extends Model
{
    const STATUS_NORMAL = 1;//正常

    protected $table = 'app_navigation';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','name','status','url','sort','remark'
    ];

    public $timestamps = false;


}
