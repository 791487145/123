<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    
    protected $table = 'service';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','title','description','price','created_at','updated_at','status','identify'
    ];

    public $timestamps = false;




}
