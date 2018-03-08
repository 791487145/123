<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class InstallPackageModel extends Model
{
    
    protected $table = 'install_package';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','version','describe','create_at','update_at'
    ];

    public $timestamps = false;

}
