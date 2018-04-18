<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Cache;

class CompanyIndustryModel extends Model
{
    
    protected $table = 'company_industry';

    protected $fillable = [
        'industry'
    ];

    public $timestamps = false;

}
