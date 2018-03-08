<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Lang;

class AnnouncementModel extends Model
{
    
    protected $table = 'announcement';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','type','uid','status','created_at','updated_at','content'
    ];

    public $timestamps = true;

    static function makeDate($number)
    {
    	$falseName = Lang::get('auth.falseName');
    	$blasses = Lang::get('auth.blasses');

    	for($i = 0 ; $i < $number ; $i++)
    	{
    		$name_res = array_rand($falseName,2);
	    	$blass_res = array_rand($blasses,1);

	    	$sender_name = $falseName[$name_res[0]];
	    	$recipient_name = $falseName[$name_res[1]];
	    	$blass = $blasses[$blass_res];

	    	$content = $sender_name.'祝'.$recipient_name.': '.$blass;

	    	$data[] = array(
    			'type' => '2',
    			'uid' => '0',
    			'content' => $content,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
    		);
    	}
    	
    	$result = self::insert($data);
    	return $result;
    }
}
