<?php

namespace App\Modules\Manage\Model;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;


class Role extends EntrustRole
{
    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'display_name',
        'description',
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;
}
