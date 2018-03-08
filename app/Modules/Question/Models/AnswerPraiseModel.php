<?php

namespace App\Modules\Question\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerPraiseModel extends Model
{
    protected $table = 'answer_praise';

    public $timestamps = false;

    protected $fillable = [
        'id','answerid', 'uid'
    ];
}
