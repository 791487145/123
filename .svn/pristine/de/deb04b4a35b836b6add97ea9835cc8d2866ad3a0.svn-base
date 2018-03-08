<?php

namespace App\Modules\User\Model;
use Illuminate\Database\Eloquent\Model;

class UserTagsModel extends Model
{
    protected $table = 'tag_user';

    public $timestamps = false;

    protected $fillable = [
        'tag_id', 'uid'
    ];

    
    static function myTag($uid)
    {
        $data = UserTagsModel::select('a.id as tag_id')
            ->leftjoin('skill_tags as a','tag_user.tag_id', '=', 'a.id')
            ->where('tag_user.uid', '=', $uid)
            ->get()
            ->toArray();
        return $data;
    }

    
    static function updateTag($tag_id,$uid)
    {
        $result = UserTagsModel::firstOrCreate(['tag_id'=>$tag_id,'uid'=>$uid])->save();
        return $result;
    }

    
    static function delTag($tag_id, $uid)
    {
        $query = UserTagsModel::where('uid','=',$uid);
        $query = $query->where(function($query) use($tag_id){
            $query->where('tag_id','=',$tag_id);
        });
        $result = $query->delete();
        return $result;
    }

    
    static function insert($tags,$uid)
    {
        if(is_array($tags)){
            foreach($tags as $v)
            {
                $result = Self::updateTag($v,$uid);
                if(!$result){
                    return false;
                }
            }
        }else{
            $result = Self::updateTag($tags,$uid);
        }

        return $result;
    }

    
    static function tagDelete($tags,$uid)
    {
        $result = Self::whereIn('tag_id',$tags)->delete();
        return $result;
    }

    
    static function getTagsByUserId($uid)
    {
        if(is_array($uid)){
            $tag = UserTagsModel::select('tag_id', 'uid')->whereIn('uid', $uid)->get()->toArray();
        }else{
            
            $tag = UserTagsModel::where('tag_user.uid',$uid)
                ->leftJoin('skill_tags','skill_tags.id','=','tag_user.tag_id')
                ->select('skill_tags.tag_name','tag_user.tag_id')->get()->toArray();
        }
        return $tag;
    }

}