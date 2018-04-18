<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Cache;

class CompanyModel extends Model
{
    
    protected $table = 'company';

    protected $fillable = [
        'uid', 'name', 'logo', 'phone', 'scale','industry','financing','email','province','city',
        'area','address'
    ];

    public $timestamps = false;

    
    static function creatOne($alias)
    {
        $info = ConfigModel::where('alias', $alias)->first();
        if (!empty($info)) {
            return $info;
        }
        return false;
    }

}
