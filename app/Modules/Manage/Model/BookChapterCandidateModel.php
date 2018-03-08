<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class BookChapterCandidateModel extends Model
{

    protected $table = 'book_chapter_candidate';
    protected $primaryKey = 'id';


    protected $fillable = [
        'chapter_uid','book_id','book_chapter','chapter_title','chapter_content','created_at','good_num','bad_num','gift_num'
    ];

    public $timestamps = false;


}
