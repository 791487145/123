<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class InvitingAwardsModel extends Model
{
    
    protected $table = 'inviting_awards';
    protected $primaryKey = 'id';


    protected $fillable = [
        'fid','name','reward','created_at','uid','winning_at','status'
    ];

    public $timestamps = false;


}
