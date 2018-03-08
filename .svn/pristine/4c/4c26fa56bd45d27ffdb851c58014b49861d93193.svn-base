<?php

namespace App\Modules\Task\Model;

use App\Http\Controllers\ApiBaseController;
use Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Log;

class DistrictRegionModel extends Model
{
    protected $table = 'district_region';
    public $timestamps = false;
    protected $fillable = [
        'upid', 'name', 'type', 'displayorder','id'
    ];

    





    
    static function findAll($param)
    {
        $regions = $param->whereUpid(0)->select('id','name')->get()->toArray();
        foreach($regions as $k=>$v){
            $province = self::provinceDetial($v['id'],$param);
            if(!empty($province)){
                $regions[$k]['city'] = $province;
            }
        }

        return $regions;
    }

    static function provinceDetial($pid,$param)
    {
        $city = $param->whereUpid($pid)->select('id','name')->get();

        if(!$city->isEmpty()){
            $city = $city->toArray();
            foreach($city as $k=>$v){
                $school = self::schoolDetial($v['id'],$param);
                $city[$k]['district'] = [];
                if(!$school->isEmpty()){
                    $school = $school->toArray();
                    $city[$k]['district'] = $school;
                }
            }
        }

        return $city;
    }

    static function schoolDetial($pid,$param)
    {
        $school = $param->whereUpid($pid)->select('id','name')->get();
        return $school;
    }

    static function getAllfromSchoolId($school_id)
    {
        $school = self::whereId($school_id)->first();
        $province = self::whereId($school->upid)->first();
        $region = self::whereId($province->upid)->first();
       // $data = self::getDetialRegion($region->id,$province->id,$school_id);
        $data = self::getDetialRegion($school_id,$province->id,$region->id);

        return $data;
    }


    //获取区省学校拼接
    static function getDetialRegion($region,$province,$school)
    {
        $data = self::whereId($region)->pluck('name');
        $data = (self::whereId($province)->pluck('name')).$data;
        $data = (self::whereId($school)->pluck('name')).$data;

        return $data;
    }

    //获取名称
    static function findByIdGetName($id)
    {
        $data = self::whereId($id)->pluck('name');
        return $data;
    }


    /*static function getDistrictProvince($data)
    {
        foreach($data as $k=>$area){
            $province = self::whereUpid($area['id'])->get();

            if(!$province->isEmpty()){
                $province = $province->toArray();
                $province = self::getDistrictSchool($province);
                $data[$k]['province'] = $province;
            }
        }

        return $data;
    }*/

    static function getRegionProvince()
    {
        if(Cache::has('region_province'))
        {
            $data = Cache::get('region_province');
        }else{
            $data = DistrictRegionModel::where('upid',0)->get()->toArray();
            Cache::put('region_province',$data,24*60);
        }
        return $data;
    }

    static function getDistrictSchool($data)
    {

        foreach($data as $k=>$province){
            $school = self::whereUpid($province['id'])->get();
            if(!$school->isEmpty()){
                $school = $school->toArray();
                $data[$k]['school'] = $school;
            }
        }

        return $data;
    }


    /*static function findTree($pid)
    {
        $data = array();
        
        if($pid==0)
        {
            $data = self::getDistrictProvince();
        }else
        {
            
            $district_relationship = self::getDistractRelationship();
            $upid = $district_relationship[$pid];
            if($upid == 0)
            {
                
                $province_data = self::getProvinceDetail($pid);
                foreach($province_data as $v)
                {
                    if($v['upid']==$pid){
                        $data[] = $v;
                    }
                }
            }else
            {
                
                $province_detail = self::getProvicneData($upid);
                if(empty($province_detail))
                {
                    return false;
                }
                
                $province_data = self::getProvinceDetail($upid);
                foreach($province_data as $v)
                {
                    if($v['upid']==$pid){
                        $data[] = $v;
                    }
                }
            }
        }
        return $data;
    }*/

    static function findTree($pid)
    {
        $data = array();
        
        if($pid==0)
        {
            $data = self::getRegionProvince();
        }else
        {
            
            $district_relationship = self::getRegionRelationship();
            $upid = $district_relationship[$pid];
            if($upid == 0)
            {
                
                $province_data = self::getRegionProvinceDetail($pid);
                foreach($province_data as $v)
                {
                    if($v['upid']==$pid){
                        $data[] = $v;
                    }
                }
            }else
            {
                
                $province_detail = self::getRegionProvicneData($upid);
                if(empty($province_detail))
                {
                    return false;
                }
                
                $province_data = self::getRegionProvinceDetail($upid);
                foreach($province_data as $v)
                {
                    if($v['upid']==$pid){
                        $data[] = $v;
                    }
                }
            }
        }
        return $data;
    }

  //   static function findById($id,$fild=null)
  //   {
		// $area_data = self::refreshAreaCache();
  //       $data = array();
  //       foreach($area_data as $k=>$v)
  //       {
  //           if(is_array($id) && in_array($v['id'],$id))
  //           {
  //               if(!is_null($fild))
  //               {
  //                   $data[] = $v[$fild];
  //               }else
  //               {
  //                   $data[] = $v;
  //               }

  //           }elseif($v['id']==$id)
  //           {
  //               if(!is_null($fild))
  //               {
  //                   $data = $v[$fild];
  //               }else
  //               {
  //                   $data = $v;
  //               }
  //           }
  //       }
  //       return $data;
  //   }
    
    static function getDistrictName($id)
    {
        if (is_array($id)) {
            $arrDistrictName = DistrictModel::whereIn('id', $id)->lists('name')->toArray();
            return implode('', $arrDistrictName);
        }
        $arrDistrictName = DB::table('district_region')->select('name')->where('id', $id)->first();
        if (!empty($arrDistrictName))
            return $arrDistrictName->name;
    }

    
    // static function refreshAreaCache()
    // {
        
    //     $district_relationship = DistrictModel::lists('upid','id')->toArray();
    //     Cache::put('district_relationship',$district_relationship,24*60);
        
    //     $province = DistrictModel::where('upid',0)->orderBy('displayorder')->get()->toArray();
    //     Cache::put('district_province',$province,24*60);
        
    //     foreach($province as $k=>$v)
    //     {
            
    //         $city_ids = DistrictModel::where('upid',$v['id'])->lists('id');
    //         $city_data = DistrictModel::whereIn('id',$city_ids)->orderBy('displayorder')->get()->toArray();
            
    //         $area_data = DistrictModel::whereIn('upid',$city_ids)->orderBy('displayorder')->get()->toArray();
    //         $other_data = array_merge($city_data,$area_data);
    //         Cache::put('district_list_'.$v['id'],$other_data,24*60);
    //     }

    // }

    
    static function getRegionRelationship()
    {
        if(Cache::has('region_relationship'))
        {
            $data = Cache::get('region_relationship');
        }else{
            $data = DistrictRegionModel::lists('upid','id')->toArray();
            Cache::put('region_relationship',$data,24*60);
        }
        return $data;
    }

    
    static function getDistrictArea()
    {
        $data = self::where('upid',0)->select('id','upid','name')->get()->toArray();
        return $data;
    }

    
    static function getRegionProvinceDetail($id)
    {
        if(Cache::has('region_list_'.$id))
        {
            $data = Cache::get('region_list_'.$id);
        }else{
            
            $province_ids = DistrictRegionModel::where('upid',$id)->lists('id');
            $province_data = DistrictRegionModel::whereIn('id',$province_ids)->get()->toArray();
            
            $school_data = DistrictRegionModel::whereIn('upid',$province_ids)->get()->toArray();
            $data = array_merge($province_data,$school_data);
            Cache::put('region_list_'.$id,$data,24*60);
        }
        return $data;
    }

    
    static function getRegionProvicneData($id)
    {
        $province_datas = Self::getRegionProvince($id);
        $data = null;
        foreach($province_datas as $k=>$v)
        {
            if($v['id']==$id)
            {
                $data = $v;
            }
        }
        return $data;
    }

    /**数组键值改变
     * @param $key键
     * @param $arrays数组
     * @return array
     */
    static function arrayKeyChange($key,$arrays)
    {
        foreach($arrays as $array){
            $array = array_values($array);
            $data[] = array_combine($key, $array);
        }
        return $data;
    }

    static function getDistrictSchoolLists()
    {
        if(Cache::has('school_list')){
            $data = Cache::get('school_list');
        }else{
            $data = self::whereType(0)->select('id','name')->get()->toArray();
            Cache::put('school_list',$data,24.60);
        }

        return $data;
    }

}
