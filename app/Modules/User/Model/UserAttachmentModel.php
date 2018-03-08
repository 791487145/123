<?php

namespace App\Modules\User\Model;
use Illuminate\Database\Eloquent\Model;

class UserAttachmentModel extends Model
{
    protected $table = 'user_attachment';

    public $timestamps = false;

    protected $fillable = [
       'id','source', 'source_id', 'attachment_id'
    ];




}