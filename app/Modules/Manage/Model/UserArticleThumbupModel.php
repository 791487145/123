<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserArticleThumbupModel extends Model
{
    
    protected $table = 'user_article_thumbup';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','uid','article_id','created_at'
    ];

    public $timestamps = false;


}
