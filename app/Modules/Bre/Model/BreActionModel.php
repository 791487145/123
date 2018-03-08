<?php

namespace App\Modules\Bre\Model;

use Illuminate\Database\Eloquent\Model;

class BreActionModel extends Model
{
    protected $table = 'bre_action';

    public $timestamps = true;

    protected $fillable = [
        'title','description','class','function','method','status'
    ];

    public function update(){

    }
}
