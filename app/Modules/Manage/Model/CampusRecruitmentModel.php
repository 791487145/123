<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class CampusRecruitmentModel extends Model
{
    
    protected $table = 'campus_recruitment';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','company_name','scale','profile','post_name','salary','post_demand','phone','email','address','create_at','status','thumb_pic'
    ];

    public $timestamps = false;


}
