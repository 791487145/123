<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class LastFoundCommentModel extends Model
{

    protected $table = 'last_found_comment';
    protected $primaryKey = 'id';


    protected $fillable = [
        'uid','sid','com_content','good_num','bad_num','comment_time'
    ];

    public $timestamps = false;


}
