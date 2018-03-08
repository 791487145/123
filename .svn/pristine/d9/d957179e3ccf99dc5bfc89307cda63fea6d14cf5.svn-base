<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class InvitationModel extends Model
{
    use EntrustUserTrait;
    
    protected $table = 'invitation_code';

    protected $fillable = [
        'invitation_code', 'status', 'add_time'
    ];



}
