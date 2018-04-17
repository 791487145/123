<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class SecondhandImgModel extends Model
{

    protected $table = 'secondhand_img';
    protected $primaryKey = 'id';


    protected $fillable = [
        'sid','img'
    ];

    public $timestamps = false;


}
