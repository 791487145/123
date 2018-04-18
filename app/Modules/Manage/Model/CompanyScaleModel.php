<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Cache;

class CompanyScaleModel extends Model
{
    
    protected $table = 'company_scale';

    protected $fillable = [
        'scale'
    ];

    public $timestamps = false;


}
