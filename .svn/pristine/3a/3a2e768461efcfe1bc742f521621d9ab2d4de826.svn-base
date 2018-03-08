<?php

namespace App\Modules\Question\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\IndexController as BaseIndexController;
use App\Modules\Question\Models\QuestionModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use Auth;
class MyQuestionController extends BaseIndexController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('main');
    }
    
    public function myquestionlist( request $request)
    {
        $where=QuestionModel::leftjoin('question_category','question.category','=','question_category.id');
        $type=$request->get('type');
        if($type==1){
            $where->where('audit',0);
        }elseif ($type==2){
            $where->where('audit',2);
        }elseif($type==3){
            $where->where('status',0)->where('audit',1);
        }elseif($type==4){
            $where->where('status',1)->where('audit',1);
        }
        
        $id=Auth::user()['id'];
        $question=$where->select('question.*','question_category.name')->where('uid',$id)->orderby('time','desc')->get()->toArray();
        $data=array('question'=>$question);
        return $this->theme->scope('user.quetion.myquestion',$data)->render();
    }
}
