<?php

namespace App\Modules\Question\Models;

use App\Modules\Question\Models\QuestionModel;
use App\Modules\Question\Models\AnswerPraiseModel;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\User\Model\MessageReceiveModel;
use DB;
class AnswerModel extends Model
{
    protected $table = 'answer';

    public $timestamps = false;

    protected $fillable = [
        'uid', 'questionid', 'content', 'adopt', 'cash', 'time', 'praise'
    ];


    static public function myAnswer($uid,$data)
    {
        $result = self::select('answer.*','qt.discription as question_name','qt.num','qt.answernum','ct.name as question_category','ud.avatar')
            ->where('answer.uid',$uid);
        
        if(!empty($data['type']) && $data['type']!=0)
        {
            $result = $result->where('answer.adopt',$data['type']);
        }
        $result = $result->join('question as qt','answer.questionid','=','qt.id')
            ->leftjoin('cate as ct','ct.id','=','qt.category')
            ->leftjoin('user_detail as ud','ud.uid','=','qt.uid')
            ->orderBy('answer.time','DESC')
            ->paginate(5);
        return $result;
    }
    static public function reward($money,$answerid,$qid,$aid,$reward,$reward1)
    {
        $status=DB::transaction(function() use($money,$answerid,$qid,$aid,$reward,$reward1)
        {

            DB::table('user_detail')->where('uid',$qid)->update(['balance' => $reward]);

            DB::table('user_detail')->where('uid',$aid)->update(['balance' => $reward1]);

            $finance1 = array(
                'action' => 12,
                'pay_type' =>1,
                'cash' =>$money,
                'uid' => $qid,
                'created_at'=>date('Y-m-d H:i:s',time())
            );
            $finance2 = array(
                'action' => 13,
                'pay_type' => 1,
                'cash' =>$money,
                'uid' => $aid,
                'created_at'=>date('Y-m-d H:i:s',time())
            );
            DB::table('financial')->insert($finance1);

            DB::table('financial')->insert($finance2);
            AnswerModel::where('id',$answerid)->update(['cash'=>$money]);
            

        });
        return $status;
    }
    static public function praise($answerid,$uid,$questionid)
    {
        $status=DB::transaction(function() use($answerid,$uid,$questionid)
        {
            $data1=array('answerid'=>$answerid,'uid'=>$uid);
            $result=AnswerPraiseModel::insert($data1);
            $answer=AnswerModel::where('id',$answerid)->select('praisenum')->first()->toArray();
            $num=$answer['praisenum']+1;
            $data=array('praisenum'=>$num);
            $status=AnswerModel::where('id',$answerid)->update($data);
            $question=QuestionModel::where('id',$questionid)->select('praisenum')->get()->toArray();
            $num1=$question[0]['praisenum']+1;
            $data=array('praisenum'=>$num1);
            $status=QuestionModel::where('id',$questionid)->update($data);
        });
        return $status;
    }
    static public function adopt($adoptid,$questionid)
    {
        $status=DB::transaction(function() use($adoptid,$questionid)
        {
            $answer=array('adopt'=>1);
            $result=AnswerModel::where('id',$adoptid)->update($answer);
            $question=array('status'=>4);
            $result1=QuestionModel::where('id',$questionid)->update($question);
        });
        if(is_null($status))
        {
            
            $question_accept = MessageTemplateModel::where('code_name','question_accept')->where('is_open',1)->where('is_on_site',1)->first();
            if($question_accept)
            {
                $question=QuestionModel::where('id',$questionid)->first();
                $answeruser = AnswerModel::leftjoin('users','users.id','=','answer.uid')->where('answer.id',$adoptid)->first();
                $questionuser=QuestionModel::leftjoin('users','users.id','=','question.uid')->where('question.id',$questionid)->first();
                $site_name = \CommonClass::getConfig('site_name');
                
                
                $messageVariableArr = [
                    'username'=>$answeruser['name'],
                    'from_name'=>$questionuser['name'],
                    'queation'=>$question['discription'],
                    'website'=>$site_name,
                ];
                $message = MessageTemplateModel::sendMessage('question_accept',$messageVariableArr);
                $data = [
                    'message_title'=>$question_accept['name'],
                    'code'=>'question_accept',
                    'message_content'=>$message,
                    'js_id'=>$answeruser['uid'],
                    'message_type'=>2,
                    'receive_time'=>date('Y-m-d H:i:s',time()),
                    'status'=>0,
                ];
                MessageReceiveModel::create($data);
            }
        }
        return $status;
    }
    
    static public function answer()
    {
        $result = self::orderBy('answer.praisenum', 'desc')->groupBy('answer.questionid')
            ->leftjoin('users', 'answer.uid', '=', 'users.id')
            ->leftjoin('user_detail', 'users.id', '=', 'user_detail.uid')
            ->select('users.name', 'user_detail.avatar', 'answer.praisenum', 'answer.questionid')
            ->get()->toArray();
        return $result;
    }
}

