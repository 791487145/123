<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class IconModel extends Model
{
    //轮播
    const ICON_LUNBO_INDEX = 1;//首页
    const ICON_LUNBO_ZIXUN = 2;//资讯

    //广告
    const ICON_AD_INDEX = 1;//首页
    const ICON_AD_ZIXUN_RECOMMENT = 2;//资讯推荐
    const INCO_AD_ACTIVE = 3;//活动
    const INCO_AD_ZIXUN = 4;//资讯
    const INCO_AD_RECURIT = 5;//招聘
    const INCO_AD_TASK = 6;//任务大厅

    const ICON_TYPE_MENU = 'menu';//菜单
    const ICON_TYPE_CAROUSEL = 'carousel';//轮播图
    const ICON_TYPE_AD = 'advertisement';//广告

    protected $table = 'icon';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','icon_name','route','type','describe','status','sort'
    ];

    public $timestamps = false;

    static function getIconInfoFromSort($type,$sort)
    {
        $data = self::where('status','valid')->whereType($type)->where('sort',$sort)->get();
        if(!$data->isEmpty()){
            $data = $data->toArray();
        }

        return $data;
    }

}
