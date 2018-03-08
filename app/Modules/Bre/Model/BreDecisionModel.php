<?php

namespace App\Modules\Bre\Model;

use Illuminate\Database\Eloquent\Model;

class BreDecisionModel extends Model
{
    protected $table = 'bre_decision';

    public $timestamps = true;

    protected $fillable = [
        'rule_id','action_id','before_status','after_status','sort'
    ];

}
