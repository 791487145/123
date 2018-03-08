<?php

namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Question\Models\AnswerModel;
use App\Modules\Question\Models\QuestionModel;
use App\Modules\Task\Model\TaskCateModel;
use Illuminate\Http\Request;

class QuestionController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');
        $this->theme->set('manageType', 'agreement');

    }

    
    public function getList(Request $request)
    {
        $this->theme->setTitle('问答列表');
        $data = $request->all();
        $question = QuestionModel::allQuestion($data);
        
        $category_first = TaskCateModel::where('pid',0)->get()->toArray();
        $category_first = \CommonClass::keyBy($category_first,'id');
        
        $category_second = [];
        if(isset($data['first_category']) && $data['first_category']!=0)
            $category_second = TaskCateModel::where('pid',$category_first[$data['first_category']]['id'])->get()->toArray();
        $map = [
            0=>'全部',
            1=>'等待处理',
            2=>'审核失败',
            3=>'未解决',
            4=>'已解决',
        ];
        $view = [
            'question'=>$question,
            'category_first'=>$category_first,
            'category_second'=>$category_second,
            'map'=>$map,
        ];
        return $this->theme->scope('manage.questionList',$view)->render();

    }

    
    public function verify($id,$status)
    {
        switch($status){
            case 1:
                $status_real = 2;
                break;
            case 2:
                $status_real = 5;
                break;
            default:
                $status_real = 2;
                break;
        }
        $result = QuestionModel::where('id',$id)->update(['status'=>$status_real,'verify_at'=>date('Y-m-d H:i:s',time())]);

        if(!$result)
            return redirect()->back()->with(['error'=>'操作失败']);

        return redirect()->back()->with(['error'=>'操作成功！']);
    }

    
    public function getDetail($id)
    {
        $this->theme->setTitle('问答详情');
        $detail = QuestionModel::select('question.*','us.name as username')
            ->where('question.id',$id)
            ->join('users as us','us.id','=','question.uid')
            ->leftjoin('cate as ct','ct.id','=','question.category')
            ->first();
        
        $preId = QuestionModel::where('id', '>', $id)->min('id');
        
        $nextId = QuestionModel::where('id', '<', $id)->max('id');
        
        $category_first = TaskCateModel::where('pid',0)->get()->toArray();
        
        $category_second = [];
        $second_pid = TaskCateModel::where('id',$detail['category'])->first();
        if($second_pid)
            $category_second = TaskCateModel::where('pid',$second_pid['pid'])->get()->toArray();
        $map = [
            0=>'待审核',
            1=>'待审核',
            2=>'审核通过',
            3=>'已回答',
            4=>'已采纳',
            5=>'审核失败'
        ];
        $type=1;
        $view = [
            'detail'=>$detail,
            'category_first'=>$category_first,
            'category_second'=>$category_second,
            'second_pid'=>$second_pid,
            'map'=>$map,
            'preId'=>$preId,
            'nextId'=>$nextId,
            'type'=>$type,
            'id'=>$id
        ];
        return $this->theme->scope('manage.questionDetail',$view)->render();
    }

    
    public function postDetail(Request $request)
    {
        $data = $request->except('_token');
        $question = [
            'discription'=>\CommonClass::removeXss($data['discription']),
            'category'=>intval($data['category'])
        ];
        
        $result = QuestionModel::where('id',$data['id'])->update($question);

        if(!$result)
            return redirect()->back()->with(['error'=>'修改失败！']);

        return redirect()->back()->with(['message'=>'修改成功！']);
    }

    public function getDetailAnswer($id)
    {
        $this->theme->setTitle('问答详情');
        $answer = AnswerModel::select('answer.*','us.name as username','qt.discription','qt.status as question_status')
            ->where('answer.questionid',$id)
            ->join('users as us','us.id','=','answer.uid')
            ->leftjoin('question as qt','qt.id','=','answer.questionid')
            ->get();
        $type=2;
        $view = [
            'answer'=>$answer,
            'type'=>$type,
            'id'=>$id
        ];
        return $this->theme->scope('manage.questionDetail',$view)->render();
    }

    
    public function getConfig()
    {
        $this->theme->setTitle('问答配置');
        $question_switch = \CommonClass::getConfig('question_switch');
        $question_verify = \CommonClass::getConfig('question_verify');

        $view = [
            'question_switch'=>$question_switch,
            'question_verify'=>$question_verify
        ];

        return $this->theme->scope('manage.questionConfig',$view)->render();
    }

    
    public function postConfig(Request $request)
    {
        $data = $request->except('_token');
        
        $question_switch = $data['question_switch'];
        $question_verify = $data['question_verify'];
        $result1 = ConfigModel::where('alias','question_switch')->update(['rule'=>$question_switch]);
        $result2 = ConfigModel::where('alias','question_verify')->update(['rule'=>$question_verify]);

        if(!$result1 && !$result2)
            return redirect()->back()->with(['error'=>'修改失败！']);

        return redirect()->back()->with(['message'=>'修改成功！']);
    }

    
    public function ajaxCategory($id)
    {
        $category = TaskCateModel::where('pid',$id)->get()->toJson();

        if(!$category)
            return response()->json(['errMsg' => '参数错误！','errCode'=>1]);

        return $category;
    }

    
    public function questionDelete($id)
    {
        $result = QuestionModel::where('id',$id)->delete();

        if(!$result)
            return redirect()->back()->with(['error'=>'删除失败！']);

        return redirect()->back()->with(['message'=>'删除成功！']);
    }


}
