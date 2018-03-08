<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modules\Manage\Model\SjlmGoodsModel;
use App\Modules\Manage\Model\EmployerGradeModel;
use App\Modules\Manage\Model\HunterGradeModel;
use App\Modules\Manage\Model\TypeModel;


class EmployerHunController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');

    }

    //雇主等级
    public function employerList(Request $request)
    {
        $this->theme->setTitle('雇主等级');
        $grade = EmployerGradeModel::where('status','valid')->paginate(20);
        $data = [
            'grade' => $grade,
        ];

        return $this->theme->scope('manage.employerList',$data)->render();
    }

    //添加雇主等级
    public function postAddEmployer(Request $request)
    {
        $data = $request->all();
        if(!empty($data['grade_img'])){
            $data['create_time'] = date('Y-m-d H:i:s');
            $ext = $data['grade_img']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/employer_grade/';
            $result = $data['grade_img']->move($filepath,$filename);
            if($result){
                $data['grade_img'] = $filepath.$filename;
                unset($data['_token']);
                $result = EmployerGradeModel::insert($data);
                if($result){
                    return redirect('/manage/employer')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['grade_img']);
                    return redirect('/manage/employer')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/employer')->with(['message'=>'图片上传失败']);
            }

        }else{
            return redirect('/manage/employer')->with(['message'=>'图片上传失败']);
        }

    }

    //删除雇主等级
    public function employerDel($id)
    {
        $re = EmployerGradeModel::where('id',$id)->update(array('status'=>'invalid'));
        if($re)
            return redirect('/manage/employer')->with(['message'=>'操作成功']);
    }

    /**
     * 雇主等级详情
     * @param int
     */
    public function employerDetail($id)
    {
        $this->theme->setTitle('用户等级');
        $grade = EmployerGradeModel::where('id',$id)->first();
        $data = [
            'grade' => $grade,
        ];
        return $this->theme->scope('manage.employerDetail',$data)->render();
    }

    //修改雇主等级
    public function employerUpdate(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        if(!empty($data['grade_img'])){
            $grade_img = EmployerGradeModel::select('grade_img')->where('id',$data['id'])->first()->toArray();
            //获取图片信息
            $ext = $data['grade_img']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/employer_grade/';
            $result = $data['grade_img']->move($filepath,$filename);
            if($result){
                $data['grade_img'] = $filepath.$filename;
                $result = EmployerGradeModel::where('id',$data['id'])->update($data);
                if($result){
                    if($grade_img['grade_img']){
                        unlink($grade_img['grade_img']);
                    }
                    return redirect('/manage/employer')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['grade_img']);
                    return redirect('/manage/employer')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/employer')->with(['message'=>'图片上传失败']);
            }
        }

        $result = EmployerGradeModel::where('id',$data['id'])->update($data);
        if($result)
            return redirect('/manage/employer')->with(['message'=>'操作成功']);
        else
            return redirect('/manage/employer')->with(['message'=>'操作失败']);

    }

    //猎人等级
    public function hunterList(Request $request)
    {
        $this->theme->setTitle('雇主等级');
        $grade = HunterGradeModel::where('status','valid')->paginate(20);
        $data = [
            'grade' => $grade,
        ];

        return $this->theme->scope('manage.hunterList',$data)->render();
    }

    //添加猎人等级
    public function postAddHunter(Request $request)
    {
        $data = $request->all();
        if(!empty($data['grade_img'])){
            $data['create_time'] = date('Y-m-d H:i:s');
            $ext = $data['grade_img']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/hunter_grade/';
            $result = $data['grade_img']->move($filepath,$filename);
            if($result){
                $data['grade_img'] = $filepath.$filename;
                unset($data['_token']);
                $result = HunterGradeModel::insert($data);
                if($result){
                    return redirect('/manage/hunter')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['grade_img']);
                    return redirect('/manage/hunter')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/hunter')->with(['message'=>'图片上传失败']);
            }

        }else{
            return redirect('/manage/hunter')->with(['message'=>'图片上传失败']);
        }

    }

    //删除猎人等级
    public function hunterDel($id)
    {
        $re = HunterGradeModel::where('id',$id)->update(array('status'=>'invalid'));
        if($re)
            return redirect('/manage/hunter')->with(['message'=>'操作成功']);
    }

    /**
     * 猎人等级详情
     * @param int
     */
    public function hunterDetail($id)
    {
        $this->theme->setTitle('用户等级');
        $grade = HunterGradeModel::where('id',$id)->first();
        $data = [
            'grade' => $grade,
        ];
        return $this->theme->scope('manage.hunterDetail',$data)->render();
    }

    //修改猎人等级
    public function hunterUpdate(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        if(!empty($data['grade_img'])){
            $grade_img = HunterGradeModel::select('grade_img')->where('id',$data['id'])->first()->toArray();
            //获取图片信息
            $ext = $data['grade_img']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/hunter_grade/';
            $result = $data['grade_img']->move($filepath,$filename);
            if($result){
                $data['grade_img'] = $filepath.$filename;
                $result = HunterGradeModel::where('id',$data['id'])->update($data);
                if($result){
                    if($grade_img['grade_img']){
                        unlink($grade_img['grade_img']);
                    }
                    return redirect('/manage/hunter')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['grade_img']);
                    return redirect('/manage/hunter')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/hunter')->with(['message'=>'图片上传失败']);
            }
        }

        $result = HunterGradeModel::where('id',$data['id'])->update($data);
        if($result)
            return redirect('/manage/hunter')->with(['message'=>'操作成功']);
        else
            return redirect('/manage/hunter')->with(['message'=>'操作失败']);

    }

    //奖品管理
    public function prizeManageList()
    {
        $this->theme->setTitle('奖品管理');
        $type = TypeModel::where('type','prop')->orwhere('type','stdmode')->get();
        $prize = SjlmGoodsModel::where('status','valid')->paginate(20);
        $data = [
            'type' => $type,
            'prize' => $prize,
        ];
        return $this->theme->scope('manage.prizeManage',$data)->render();
    }

    //添加奖品
    public function createPrize(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        if(!empty($data['icon'])){
            $ext = $data['icon']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/sjlm_goods/';
            $result = $data['icon']->move($filepath,$filename);
            if($result){
                $data['icon'] = $filepath.$filename;
                $result = SjlmGoodsModel::insert($data);
                if($result){
                    return redirect('/manage/prizeManage')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['icon']);
                    return redirect('/manage/prizeManage')->with(['message'=>'操作失败']);
                }
            }else{
                return redirect('/manage/prizeManage')->with(['message'=>'图片上传失败']);
            }
        }else{
            return redirect('/manage/prizeManage')->with(['message'=>'图片上传失败']);
        }
    }

    //删除奖品
    public function prizeDelete($id)
    {
        $re = SjlmGoodsModel::where('id',$id)->update(array('status'=>'invalid'));
        if($re)
            return redirect('/manage/prizeManage')->with(['message'=>'操作成功']);
    }

    /**
     * 猎人等级详情
     * @param int
     */
    public function prizeDetail($id)
    {
        $this->theme->setTitle('用户等级');
        $prize = SjlmGoodsModel::where('id',$id)->first();
        $type = TypeModel::where('type','prop')->orwhere('type','stdmode')->get();
        $data = [
            'type' => $type,
            'prize' => $prize,
        ];
        return $this->theme->scope('manage.prizeDet',$data)->render();
    }

    //修改奖品
    public function prizeUpdate(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        if(!empty($data['icon'])){
            $icon = SjlmGoodsModel::select('icon')->where('id',$data['id'])->first()->toArray();
            //获取图片信息
            $ext = $data['icon']->getClientOriginalExtension();
            $filename = md5(date('Y-m-d-H-i-S').'-'.uniqid()).'.'.$ext;
            $filepath = 'uploads/sjlm_goods/';
            $result = $data['icon']->move($filepath,$filename);
            if($result){
                $data['icon'] = $filepath.$filename;
                $result = SjlmGoodsModel::where('id',$data['id'])->update($data);
                if($result){
                    if($icon['icon']){
                        unlink($icon['icon']);
                    }
                    return redirect('/manage/prizeManage')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['icon']);
                    return redirect('/manage/prizeManage')->with(['message'=>'操作失败']);
                }

            }else{
                return redirect('/manage/prizeManage')->with(['message'=>'图片上传失败']);
            }
        }

        $result = SjlmGoodsModel::where('id',$data['id'])->update($data);
        if($result)
            return redirect('/manage/prizeManage')->with(['message'=>'操作成功']);
        else
            return redirect('/manage/prizeManage')->with(['message'=>'操作失败']);

    }









}


