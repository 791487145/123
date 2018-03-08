<?php

namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\ManageController;
use App\Modules\Manage\Model\HotwordsModel;
use Illuminate\Http\Request;
use Theme;
use Validator;

class HotwordsController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('热词管理');
    }

    
    public function hotwordsInfo(Request $request){
        $where = '1 = 1';

        if($request->get('id') !== null){
            $where .= " and id like '%" . $request->get('id'). "%'";
        }
        if ($request->get('words')) {
            $where .= " and words like '%" . $request->get('words'). "%'";
        }

        if($request->get('listorder')){
            switch($request->get('listorder')){
                case '1':
                    $by = 'id';
                    $order = 'asc';
                    break;
                case '2':
                    $by = 'id';
                    $order = 'desc';
                    break;
                case '3':
                    $by = 'count';
                    $order = 'asc';
                    break;
                case '4':
                    $by = 'count';
                    $order = 'desc';
                    break;
            }
        }
        else{
            $by = 'id';
            $order = 'asc';
        }

        $HotwordsList = HotwordsModel::whereRaw($where)->orderBy($by,$order)->paginate();
        $view = array(
            'HotwordsList' => $HotwordsList,
            'id'           => $request->get('id'),
            'words'         => $request->get('words'),
            'listorder'       => $request->get('listorder')

        );

        return $this->theme->scope('manage.hotwords', $view)->render();
    }

    
    public function hotwordsDelete($id){
        $res = HotwordsModel::destroy($id);
        if($res){
            return redirect('/manage/hotwordsList')->with(['message'=>'删除成功！']);
        }
        else{
            return redirect('/manage/hotwordsList')->with(['message'=>'删除成功！']);
        }
    }
    
    public function hotwordsCreate(Request $request){
        $data = $request->except('_token');
        $validator = Validator::make($request->all(),[
            'words' => 'required|max:255',
            'count' => 'required'
        ],
            [
                'words.required' => '请输入热词',
                'words.max'      => '热词字数超过限制',
                'count.required' => '请输入次数'


            ]);
        if($validator->fails()){
            return redirect()->to('/manage/hotwordsList')->withErrors($validator);
        }
        $newdata = [
            'words' => $data['words'],
            'count' => $data['count']
        ];
        $res = HotwordsModel::create($newdata);
        if($res){
            return redirect('/manage/hotwordsList')->with(['message'=>'热词创建成功！']);
        }
        return redirect('/manage/hotwordsList')->with(['message'=>'热词创建失败！']);
    }

    
    public function listorderUpdate(Request $request){
        $hotwordsDetail = HotwordsModel::find(intval($request->get('id')));
        $data = array();
        if(!$hotwordsDetail){
            $data['status'] = 'fail';
        }
        $newdata = [
            'sort' => $request->get('sort')
        ];
        $res = $hotwordsDetail->update($newdata);
        if($res){
            $data['status'] = 'success';
        }
        else{
            $data['status'] = 'fail';
        }
        return $data;

    }




}
