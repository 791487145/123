<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserGradeModel extends Model
{
    
    protected $table = 'user_grade';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','grade','experience','grade_name','grade_img','create_time'
    ];

    public $timestamps = false;

    //添加等级
    static function adduserGrade($data)
    {
        foreach($data as $k=>$v){
            $newData[$k]['invitation_code'] = $v;
            $newData[$k]['add_time'] = date('Y_m-d H:i:s');

        }
    	$result = Self::insert($newData);
    	return $result;
    }

    static function vertifyGrade($active_value)
    {
        $grades = self::where('status','valid')->orderBy('experience','asc')->lists('experience','grade');

        if($active_value < $grades[1] || $active_value == $grades[1]){
            return '0';
        }

        foreach($grades as $key=>$val)
        {
            if($active_value < $val || $active_value == $val)
            {
                return $key;
            }
        }
    }
}
