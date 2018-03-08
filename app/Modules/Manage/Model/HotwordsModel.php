<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HotwordsModel extends Model
{
    protected $table = 'hotwords';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'sort',
        'words',
        'count',
        'time',
        'auto'
    ];

    public $timestamps = false;


}
