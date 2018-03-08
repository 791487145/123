<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class SubstationModel extends Model
{
    
    protected $table = 'substation';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','district_id','name','sort','created_at','updated_at'
    ];

    public $timestamps = false;


}
