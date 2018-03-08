<?php

namespace App\Modules\Shop\Models;

use App\Modules\User\Model\AuthRecordModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\User\Model\SkillTagsModel;
use App\Modules\User\Model\TagsModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShopModel extends Model
{
    protected $table = 'shop';
    
    protected $fillable = [
        'id', 'uid', 'type', 'shop_pic', 'shop_name', 'shop_desc','province','city','status','created_at','updated_at','shop_bg',
        'seo_title','seo_keyword','seo_desc', 'is_recommend'
    ];

    public function employ_data()
    {
        return $this->hasMany('App\Modules\Employ\Models\EmployModel', 'employee_uid', 'uid')
            ->where('status', '=', '4');
    }
    
    static function getShopInfoByUid($uid)
    {
        $shopInfo = ShopModel::where('uid',$uid)->first();
        if(!empty($shopInfo)){
            
            $shopInfoTags = ShopTagsModel::where('shop_id',$shopInfo->id)->get()->toArray();
            if(!empty($shopInfoTags)){
                $tagIds = array();
                foreach($shopInfoTags as $key => $val){
                    $tagIds[] = $val['tag_id'];
                }
                
                $tags = SkillTagsModel::whereIn('id',$tagIds)->get()->toArray();
                $shopInfo['tags'] = $tags;
            }
            return $shopInfo;
        }else{
            return false;
        }
    }


    
    static function getShopInfoById($id,$status = 0)
    {
        if($status){
            $shopInfo = ShopModel::where('shop.id',$id)
                ->leftJoin('users','users.id','=','shop.uid')
                ->select('shop.*','users.name')->first();
        }else{
            $shopInfo = ShopModel::where('shop.id',$id)->where('shop.status',1)
                ->leftJoin('users','users.id','=','shop.uid')
                ->select('shop.*','users.name')->first();
        }
        if(!empty($shopInfo)){
            
            $shopInfoTags = ShopTagsModel::where('shop_id',$shopInfo->id)->get()->toArray();
            if(!empty($shopInfoTags)){
                $tagIds = array();
                foreach($shopInfoTags as $key => $val){
                    $tagIds[] = $val['tag_id'];
                }
                
                $tags = SkillTagsModel::whereIn('id',$tagIds)->get()->toArray();
                $shopInfo['tags'] = $tags;
            }
            
            $shopInfo['province_name'] = '';
            if($shopInfo->province){
                $province = DistrictModel::where('id',$shopInfo->province)->select('id','name')->first();
                if(!empty($province)){
                    $shopInfo['province_name'] = $province->name;
                }

            }
            $shopInfo['city_name'] = '';
            if($shopInfo->city){
                $city = DistrictModel::where('id',$shopInfo->city)->select('id','name')->first();
                if(!empty($city)){
                    $shopInfo['city_name'] = $city->name;
                }
            }
            return $shopInfo;
        }else{
            return false;
        }
    }


    
    static function createShopInfo($data)
    {
        $status = DB::transaction(function () use ($data) {
            $arr = array(
                'uid'        => $data['uid'],
                'type'       => $data['type'],
                'shop_pic'   => $data['shop_pic'],
                'shop_name'  => $data['shop_name'],
                'shop_desc'  => $data['shop_desc'],
                'province'   => $data['province'],
                'city'       => $data['city'],
                'status'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $result = self::create($arr);
            
            if(!empty($data['tags'])){
                $tagId = explode(',',$data['tags']);
                foreach($tagId as $value){
                    $tagData = array(
                        'shop_id' => $result['id'],
                        'tag_id' => $value
                    );
                    ShopTagsModel::create($tagData);
                }
            }
            return true;
        });
        return $status;
    }

    
    static function updateShopInfo($data)
    {
        $status = DB::transaction(function () use ($data) {
            $arr = array(
                'shop_pic'   => $data['shop_pic'],
                'shop_name'  => $data['shop_name'],
                'shop_desc'  => $data['shop_desc'],
                'province'   => $data['province'],
                'city'       => $data['city'],
                'updated_at' => date('Y-m-d H:i:s'),
            );
            self::where('id',$data['id'])->update($arr);
            
            $oldTags = ShopTagsModel::shopTag($data['id']);
            $oldTags = array_flatten($oldTags);
            $oldTagsStr = implode(',',$oldTags);
            if($data['tags'] != $oldTagsStr)
            {
                
                if(!empty($data['tags'])){
                    
                    ShopTagsModel::where('shop_id',$data['id'])->delete();
                    $tagId = explode(',',$data['tags']);
                    foreach($tagId as $value){
                        $tagData = array(
                            'shop_id' => $data['id'],
                            'tag_id' => $value
                        );
                        ShopTagsModel::create($tagData);
                    }
                }
            }
            return true;
        });
        return $status;
    }


    
    static function AllShopOpen($idArr)
    {
        
        $res = ShopModel::whereIn('id',$idArr)->get()->toArray();
        if(!empty($res) && is_array($res)){
            $id = array();
            foreach($res as $k => $v){
                if($v['status'] == 2){
                    $id[] = $v['id'];
                }
            }
        }else{
            $id = array();
        }
        $status = ShopModel::whereIn('id',$id)->update(array('status' => 1));

        return is_null($status) ? true : $status;
    }

    
    static function AllShopClose($idArr)
    {
        
        $res = ShopModel::whereIn('id',$idArr)->get()->toArray();
        if(!empty($res) && is_array($res)){
            $id = array();
            foreach($res as $k => $v){
                if($v['status'] == 1){
                    $id[] = $v['id'];
                }
            }
        }else{
            $id = array();
        }
        $status = ShopModel::whereIn('id',$id)->update(array('status' => 2,'is_recommend' => 0));

        return is_null($status) ? true : $status;
    }

    
    static function isOpenShop($uid)
    {
        $shopInfo = ShopModel::where('uid',$uid)->first();
        if(!empty($shopInfo)){
            $isOpenShop = $shopInfo->status;
        }else{
            $isOpenShop = 3;
        }
        return $isOpenShop;
    }



    
    static function getCityByUid($uid){
        $city = ShopModel::join('district', 'shop.city', '=', 'district.id')
            ->select('district.name')->where('shop.uid', $uid)->first();
        $city = $city ? $city->name : '';
        return $city;
    }

    
    static function getShopIdByUid($uid)
    {
        $shopInfo = ShopModel::where('uid',$uid)->first();
        if(!empty($shopInfo)){
            $shopId = $shopInfo->id;
        }else{
            $shopId = '';
        }
        return $shopId;
    }


    
    static function getShopListByShopIds($shopIds,$merge=array())
    {
        $shopList = ShopModel::whereRaw('1 = 1');
        if(isset($merge['shop_name'])){
            $shopList = $shopList->where('shop.shop_name','like','%'.$merge['shop_name'].'%');
        }
        $shopList = $shopList->whereIn('shop.id',$shopIds)
            ->with('employ_data')
            ->join('shop_focus','shop_focus.shop_id','=','shop.id')
            ->leftJoin('users','users.id','=','shop.uid')
            ->select('shop.*','users.email_status')
            ->orderby('shop_focus.created_at','DESC')
            ->groupBy('shop.id')
            ->paginate(10);
        if(!empty($shopList->toArray()['data'])){
            $userIds = array();
            $provinceId = array();
            $cityId = array();
            foreach($shopList as $k => $v){
                $userIds[] = $v['uid'];
                $provinceId[] = $v['province'];
                $cityId[] = $v['city'];
                
                if(!empty($v['total_comment'])){
                    $v['comment_rate'] = intval($v['good_comment']/$v['total_comment'])*100;
                }else{
                    $v['comment_rate'] = 100;
                }
            }
            if(!empty($userIds)){
                $userAuthOne = AuthRecordModel::whereIn('uid', $userIds)->where('status', 2)
                    ->where('auth_code','!=','realname')->get()->toArray();
                $userAuthTwo = AuthRecordModel::whereIn('uid', $userIds)->where('status', 1)
                    ->whereIn('auth_code',['realname','enterprise'])->get()->toArray();
                $userAuth = array_merge($userAuthOne,$userAuthTwo);
                if(!empty($userAuth)){
                    
                    $auth = array_reduce($userAuth,function(&$auth,$v){
                        $auth[$v['uid']][] = $v['auth_code'];
                        return $auth;
                    });
                }
                if(!empty($auth) && is_array($auth)){
                    foreach($auth as $e => $f){
                        $auth[$e]['uid'] = $e;
                        if(in_array('realname',$f)){
                            $auth[$e]['realname'] = true;
                        }else{
                            $auth[$e]['realname'] = false;
                        }
                        if(in_array('bank',$f)){
                            $auth[$e]['bank'] = true;
                        }else{
                            $auth[$e]['bank'] = false;
                        }
                        if(in_array('alipay',$f)){
                            $auth[$e]['alipay'] = true;
                        }else{
                            $auth[$e]['alipay'] = false;
                        }
                        if(in_array('enterprise',$f)){
                            $auth[$e]['enterprise'] = true;
                        }else{
                            $auth[$e]['enterprise'] = false;
                        }
                    }
                    foreach ($shopList as $key => $item) {
                        
                        foreach ($auth as $a => $b) {
                            if ($item->uid == $b['uid']) {
                                $shopList[$key]['auth'] = $b;
                            }
                        }
                    }
                }
            }
            
            if(!empty($provinceId)){
                $provinceArr = DistrictModel::whereIn('id',$provinceId)->get()->toArray();
                if(!empty($provinceArr)){
                    foreach ($shopList as $key => $item) {
                        
                        foreach ($provinceArr as $a => $b) {
                            if ($item->province == $b['id']) {
                                $shopList[$key]['province_name'] = $b['name'];
                            }
                        }
                    }
                }
            }
            
            if(!empty($cityId)){
                $cityArr = DistrictModel::whereIn('id',$cityId)->get()->toArray();
                if(!empty($cityArr)){
                    foreach ($shopList as $key => $item) {
                        
                        foreach ($cityArr as $a => $b) {
                            if ($item->city == $b['id']) {
                                $shopList[$key]['city_name'] = $b['name'];
                            }
                        }
                    }
                }
            }


            
            $arrSkill = ShopTagsModel::shopTag($shopIds);
            if(!empty($arrSkill) && is_array($arrSkill)){
                $arrTagId = array();
                foreach ($arrSkill as $item){
                    $arrTagId[] = $item['tag_id'];
                }
                if(!empty($arrTagId)){
                    $arrTagName = TagsModel::select('id', 'tag_name')->whereIn('id', $arrTagId)->get()->toArray();
                    $arrUserTag = array();
                    foreach ($arrSkill as $item){
                        foreach ($arrTagName as $value){
                            if ($item['tag_id'] == $value['id']){
                                $arrUserTag[$item['shop_id']][] = $value['tag_name'];
                            }
                        }
                    }
                    if(!empty($arrUserTag)){
                        foreach ($shopList as $key => $item){
                            foreach ($arrUserTag as $k => $v){
                                if ($item->id == $k){
                                    $shopList[$key]['skill'] = $v;
                                }
                            }
                        }
                    }
                }
            }

        }
        return $shopList;
    }

}

