<?php

namespace App\Modules\User\Model;

use App\Modules\Employ\Models\UnionAttachmentModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\Task\Model\TaskCateModel;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class EnterpriseAuthModel extends Model
{
    protected $table = 'enterprise_auth';
    
    protected $fillable = [
       'id', 'uid', 'company_name', 'cate_id','employee_num','business_license','begin_at',
        'website','province','city','area','address','status','auth_time','created_at','updated_at'
    ];


    
    static function isEnterpriseAuth($uid){
        $companyInfo = EnterpriseAuthModel::where('uid', $uid)->where('status',1)->first();
        $companyAuth = AuthRecordModel::where('uid',$uid)->where('status',1)->where('auth_code','enterprise')->first();
        if($companyInfo && $companyAuth){
            return true;
        }else{
            return false;
        }
    }


    
    static function getEnterpriseAuthStatus($uid)
    {
        $companyInfo = EnterpriseAuthModel::where('uid', $uid)->first();
        if ($companyInfo) {
            return $companyInfo->status;
        }
        return null;
    }

    
    static function getEnterpriseInfo($id)
    {
        
        $companyInfo = EnterpriseAuthModel::where('id', $id)->first();
        
        if($companyInfo->cate_id){
            $cateInfo = TaskCateModel::findById($companyInfo->cate_id);
            $companyInfo['cate_name'] = $cateInfo['name'];
            
            $parentCate= TaskCateModel::findById($cateInfo['pid']);
            $companyInfo['cate_parent_name'] = $parentCate['name'];
        }else{
            $companyInfo['cate_name'] = '';
            $companyInfo['cate_parent_name'] = '';
        }
        
        if($companyInfo->province){
            $province = DistrictModel::where('id',$companyInfo->province)->first();
            $companyInfo['province_name'] = $province->name;
        }else{
            $companyInfo['province_name'] = '';
        }
        if($companyInfo->city){
            $city = DistrictModel::where('id',$companyInfo->city)->first();
            $companyInfo['city_name'] = $city->name;
        }else{
            $companyInfo['city_name'] = '';
        }
        if($companyInfo->area && $companyInfo->area != 0){
            $area = DistrictModel::where('id',$companyInfo->area)->first();
            $companyInfo['area_name'] = $area->name;
        }else{
            $companyInfo['area_name'] = '';
        }
        
        $attachment = UnionAttachmentModel::where('object_id',$companyInfo->uid)
            ->where('object_type',1)->get()->toArray();
        if(!empty($attachment)){
            $attachmentId = array();
            foreach($attachment as $k => $v){
                $attachmentId[] = $v['attachment_id'];
            }
            
            $attachmentInfo = AttachmentModel::whereIn('id',$attachmentId)->get()->toarray();
            if(!empty($attachmentInfo)){
                $companyInfo['attachement'] = $attachmentInfo;
            }
        }else{
            $companyInfo['attachement'] = array();
        }
        return $companyInfo;

    }



    
    static function createEnterpriseAuth($companyInfo, $authRecordInfo,$fileId)
    {
        $status = DB::transaction(function () use ($companyInfo, $authRecordInfo,$fileId) {
            $authRecordInfo['auth_id'] = DB::table('enterprise_auth')->insertGetId($companyInfo);
            DB::table('auth_record')->insert($authRecordInfo);
            if (!empty($fileId)) {
               
               $fileAbleIds = AttachmentModel::fileAble($fileId);
               $fileAbleIds = array_flatten($fileAbleIds);
               foreach ($fileAbleIds as $v) {
                   $attachmentData = array(
                       'object_id'     => $companyInfo['uid'],
                       'object_type'   => 1,
                       'attachment_id' => $v,
                       'created_at'    => date('Y-m-d H:i:s', time())
                   );
                   UnionAttachmentModel::create($attachmentData);
               }
               
               $attachmentModel = new AttachmentModel();
               $attachmentModel->statusChange($fileAbleIds);
           }
        });
        return is_null($status) ? true : $status;
    }

    
    static function removeEnterpriseAuth()
    {
        $status = DB::transaction(function () {
            $user = Auth::User();
            EnterpriseAuthModel::where('uid', $user->id)->delete();
            AuthRecordModel::where('auth_code', 'enterprise')->where('uid', $user->id)->delete();
        });
        return is_null($status) ? true : $status;
    }

    
    static function EnterpriseAuthPass($id)
    {
        $status = DB::transaction(function () use ($id) {
            EnterpriseAuthModel::where('id', $id)->update(array('status' => 1, 'auth_time' => date('Y-m-d H:i:s')));
            AuthRecordModel::where('auth_id', $id)
                ->where('auth_code', 'enterprise')
                ->update(array('status' => 1, 'auth_time' => date('Y-m-d H:i:s')));
        });

        return is_null($status) ? true : $status;
    }

    
    static function EnterpriseAuthDeny($id)
    {
        $status = DB::transaction(function () use ($id) {
            EnterpriseAuthModel::where('id', $id)->update(array('status' => 2));
            AuthRecordModel::where('auth_id', $id)
                ->where('auth_code', 'enterprise')
                ->update(array('status' => 2));
        });

        return is_null($status) ? true : $status;
    }

    
    static function AllEnterpriseAuthPass($idArr)
    {
        
        $res = EnterpriseAuthModel::whereIn('id',$idArr)->get()->toArray();
        if(!empty($res) && is_array($res)){
            $id = array();
            foreach($res as $k => $v){
                if($v['status'] == 0){
                    $id[] = $v['id'];
                }
            }
        }else{
            $id = array();
        }
        $status = DB::transaction(function () use ($id) {
            EnterpriseAuthModel::whereIn('id', $id)->update(array('status' => 1, 'auth_time' => date('Y-m-d H:i:s')));
            AuthRecordModel::whereIn('auth_id', $id)
                ->where('auth_code', 'enterprise')
                ->update(array('status' => 1, 'auth_time' => date('Y-m-d H:i:s')));
        });

        return is_null($status) ? true : $status;
    }


    
    static function AllEnterpriseAuthDeny($idArr)
    {
        
        $res = EnterpriseAuthModel::whereIn('id',$idArr)->get()->toArray();
        if(!empty($res) && is_array($res)){
            $id = array();
            foreach($res as $k => $v){
                if($v['status'] == 0){
                    $id[] = $v['id'];
                }
            }
        }else{
            $id = array();
        }
        $status = DB::transaction(function () use ($id) {
            EnterpriseAuthModel::whereIn('id', $id)->update(array('status' => 2));
            AuthRecordModel::whereIn('auth_id', $id)
                ->where('auth_code', 'enterprise')
                ->update(array('status' => 2));
        });

        return is_null($status) ? true : $status;
    }

}
