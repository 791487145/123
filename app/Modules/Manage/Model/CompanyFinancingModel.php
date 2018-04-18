<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Cache;

class CompanyFinancingModel extends Model
{
    
    protected $table = 'company_financing';

    protected $fillable = [
        'financing'
    ];

    public $timestamps = false;

    
    /*static function creatOne($alias)
    {
        $info = ConfigModel::where('alias', $alias)->first();
        if (!empty($info)) {
            return $info;
        }
        return false;
    }*/

}
