<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Requests;
use App\Modules\Question\Models\AnswerModel;
use App\Modules\Question\Models\QuestionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends UserCenterController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('apple');
    }

    
    public function myAnswer(Request $request)
    {
        $this->theme->setTitle('我的回答');
        $uid = Auth::user()['id'];
        $data = $request->all();
        
        $myanwser = AnswerModel::myAnswer($uid,$data);

        $myanwser_toArray = $myanwser->toArray();
        $domain = url();

        $view  = [
            'myanwser'=>$myanwser,
            'myanwser_toArray'=>$myanwser_toArray,
            'domain'=>$domain
        ];
        return $this->theme->scope('user.quetion.myAnswer',$view)->render();
    }

    
    public function myQuestion(Request $request)
    {
        $this->theme->setTitle('我的提问');
        $uid = Auth::user()['id'];
        $data = $request->all();

        
        $myquestion = QuestionModel::myQuestion($uid,$data);
        $myquestion_toArray = $myquestion->toArray();
        $domian=url();
        $view = [
            'myquestion'=>$myquestion,
            'myquestion_toArray'=>$myquestion_toArray,
            'domain'=>$domian
        ];
        return $this->theme->scope('user.quetion.myquestion',$view)->render();
    }


    
    public function extendcode(Request $request)
    {
        return $this->theme->scope('user.extendcode')->render();
    }

    
    public function extendprofit(Request $request)
    {
        return $this->theme->scope('user.extendprofit')->render();
    }
}
