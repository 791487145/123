<?php

namespace App\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class ShopTagsModel extends Model
{
    protected $table = 'tag_shop';

    public $timestamps = false;

    protected $fillable = [
        'id','tag_id', 'shop_id'
    ];

    
    static public function shopTag($shop_id)
    {
        if(is_array($shop_id)){
            $data = ShopTagsModel::select('tag_id', 'shop_id')->whereIn('shop_id', $shop_id)->get()->toArray();
        }else{
            $data = ShopTagsModel::select('a.id as tag_id')
                ->leftjoin('skill_tags as a','tag_shop.tag_id', '=', 'a.id')
                ->where('tag_shop.shop_id', '=', $shop_id)
                ->get()->toArray();
        }
        return $data;
    }


}

