<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Manage\Model\BoxGoodsModel;

class HelpModel extends Model
{
    
    protected $table = 'help';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','title','answer','type','status','create_at'
    ];

    public $timestamps = false;

    //查询某一数据
    static function findById($id)
    {
    	$data = self::whereId($id)->whereStatus('valid')->first();

    	if(!is_null($data)){
    		$data['type_name'] = TypeModel::findTypeNameById($data['type']);
    	}

    	return $data;
    }
}
