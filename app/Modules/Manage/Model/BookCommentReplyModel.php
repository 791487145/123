<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class BookCommentReplyModel extends Model
{

    protected $table = 'book_comment_reply';
    protected $primaryKey = 'id';


    protected $fillable = [
        'uid','comment_id','reply_content','reply_time'
    ];

    public $timestamps = false;


}
