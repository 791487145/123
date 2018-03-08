<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArticleCommentModel extends Model
{
    
    protected $table = 'article_comment';


    protected $fillable = [
       'id','artical_id','commentator','commentator_id','good_num','bed_num','content','status'
    ];

    public $timestamps = true;


}
