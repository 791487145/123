<?php
namespace App\Modules\Question\Http\Controllers;

use App\Http\Controllers\IndexController as BaseIndexController;
use App\Modules\Advertisement\Model\AdTargetModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Question\Http\Requests\ReqardRequest;
use App\Modules\Question\Http\Requests\AnswerRequest;
use App\Modules\Question\Http\Requests\RewardRequest;
use App\Modules\Question\Models\AnswerPraiseModel;
use App\Modules\Question\Models\QuestionModel;
use App\Modules\Question\Models\AnswerModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;

use Illuminate\Http\Request;
use Auth;
use Cache;
use Teepluss\Theme\Facades\Theme;

class IndexController extends BaseIndexController
{
    public function __construct()
    {
        parent::__construct();
        $this->user = Auth::user();
        $this->initTheme('main');
    }

    
    public function strLength($str, $charset = 'utf-8')
    {
        if ($charset == 'utf-8') $str = iconv('utf-8', 'gb2312', $str);
        $num = strlen($str);
        $cnNum = 0;
        for ($i = 0; $i < $num; $i++) {
            if (ord(substr($str, $i + 1, 1)) > 127) {
                $cnNum++;
                $i++;
            }
        }
        $enNum = $num - ($cnNum * 2);
        $number = ($enNum / 2) + $cnNum;
        return ceil($number);
    }

    
    public function cc_msubstr($str, $length, $start = 0, $charset = "utf-8", $suffix = true)
    {
        if (function_exists("mb_substr")) {
            return mb_substr($str, $start, $length, $charset);
        } elseif (function_exists('iconv_substr')) {
            return iconv_substr($str, $start, $length, $charset);
        }
        $re['utf-8'] = "/[/x01-/x7f]|[/xc2-/xdf][/x80-/xbf]|[/xe0-/xef][/x80-/xbf]{2}|[/xf0-/xff][/x80-/xbf]{3}/";
        $re['gb2312'] = "/[/x01-/x7f]|[/xb0-/xf7][/xa0-/xfe]/";
        $re['gbk'] = "/[/x01-/x7f]|[/x81-/xfe][/x40-/xfe]/";
        $re['big5'] = "/[/x01-/x7f]|[/x81-/xfe]([/x40-/x7e]|/xa1-/xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
        if ($suffix) {
            return $slice . "..";
        } else {
            return $slice;
        }
    }

    
    public function index(Request $request)
    {

        $this->theme->setTitle('问答首页');
        $marge = $request->all();
        
        $current_page = $request->get('page');
        $status = $request->get('status');
        $question = QuestionModel::leftjoin('cate', 'question.category', '=', 'cate.id');
        if ($status == 4) {
            $question->where('question.status', 4);
        } elseif ($status == 2) {
            $question->where('question.status', 2)->orwhere('question.status', 3);
        }
        $result = $question->where('question.status', '!=', 5)
            ->where('question.status', '!=', 1)
            ->orderby('question.time', 'desc')
            ->select('question.*', 'cate.name');
        $result = $result->paginate(20);
        $results = $result->toArray();
        
        $num2 = count($results['data']);
        $time = $results['data'];
        foreach ($time as $k => $v) {
            $results['data'][$k]['time'] = self::wordTime(strtotime($v['time']));
        }
        
        $hot = QuestionModel::hot(5);
        foreach ($hot as $k => $v) {
            if ($this->strLength($v['discription']) > 10) {
                $hot[$k]['discription'] = $this->cc_msubstr($v['discription'], 10, $start = 0, $charset = "utf-8", $suffix = true) . "....";
            }
        }

        
        $essence = QuestionModel::essence(5);
        foreach ($essence as $k => $v) {
            $arr[$k] = $v['id'];
        }
        $answer = AnswerModel::answer();
        foreach ($essence as $k => $a) {
            foreach ($answer as $v) {
                if ($v['questionid'] == $a['id']) {
                    $essence[$k]['data'] = $v;
                }
            }
        }
        
        $count = AnswerModel::leftjoin('question', 'answer.questionid', '=', 'question.id')
            ->where('answer.adopt', 1)
            ->groupby('question.uid')
            ->get()->toArray();
        $count = count($count);
        $arr = str_split((string)$count, 1);
        $num = 8 - count($arr);
        for ($i = 0; $i < $num; $i++) {
            array_unshift($arr, '0');
        }
        $domain = url();
        
        $ad = AdTargetModel::getAdInfo('QUESTIONLIST_TOP');

        $data = array('questions' => $results,
            'question' => $result,
            'hot' => $hot,
            'essence' => $essence,
            'status' => $status,
            'count' => $arr,
            'marge' => $marge,
            'num2' => $num2,
            'current_page' => $current_page,
            'ad' => $ad,
            'domain' => $domain);
        return $this->theme->scope('question.index', $data)->render();
    }

    
    public function wordTime($time)
    {
        $time = (int)substr($time, 0, 10);
        $int = time() - $time;
        $str = '';
        if ($int <= 2) {
            $str = sprintf('刚刚', $int);
        } elseif ($int < 60) {
            $str = sprintf('%d秒前', $int);
        } elseif ($int < 3600) {
            $str = sprintf('%d分钟前', floor($int / 60));
        } elseif ($int < 86400) {
            $str = sprintf('%d小时前', floor($int / 3600));
        } elseif ($int < 2592000) {
            $str = sprintf('%d天前', floor($int / 86400));
        } else {
            $str = date('Y-m-d H:i:s', $time);
        }
        return $str;
    }

    
    public function quiz()
    {
        $this->theme->setTitle('提问页面');
        $value = TaskCateModel::get()->toArray();
        $data = array(
            'view' => $value,
            'mark' => 1
        );
        return $this->theme->scope('question.quiz', $data)->render();
    }

    
    public function getChild($id)
    {
        $result = TaskCateModel::where('pid', $id)->get()->toArray();
        return response()->json($result);
    }

    
    public function add(ReqardRequest $request)
    {
        
        $id = Auth::user()['id'];
        
        $category = $request->get('category');
        $description = $request->get('description');
        
        $time = date("Y-m-d H:i:s", time());
        
        $config = ConfigModel::getConfigByAlias('question_verify');
        $status = 1;
        if ($config['rule'] == 0) {
            $status = 2;
        }
        $result = QuestionModel::insertGetId(
            array('num' => 0,
            'category' => $category,
            'discription' => $description,
            'time' => $time,
            'status' => $status,
            'uid' => $id));
        if ($result) {
            return redirect('question/add/' . $result);
        }
    }

    
    public function reply($questionid)
    {

        
        $uid = Auth::user()['id'];
        $result = QuestionModel::leftjoin('users', 'question.uid', '=', 'users.id')
            ->leftjoin('cate', 'question.category', '=', 'cate.id')
            ->select('question.*', 'users.name as username', 'cate.name')
            ->where('question.id', $questionid)->get()->toArray();
        
        $login=1;
        if(empty($uid)){
            
            $login=2;
        }
        $data = array('question' => $result,'login'=>$login);
        
        $result = QuestionModel::where('id', $questionid)->where('uid', $uid)->get()->count();
        $question = QuestionModel::where('id', $questionid)->get()->toArray();
        $status = QuestionModel::where('id', $questionid)->select('status')->get()->toArray();
        $this->theme->setTitle('回答问题');
        if(!empty($question[0]['discription']));
            $this->theme->setTitle($question[0]['discription']);
        
        if (($question[0]['answernum'] == 0 && $uid!=$question[0]['uid']) || (empty($uid) && $question[0]['answernum'] == 0)) {
            
            $question = QuestionModel::where('id', $questionid)->select('num')->first()->toArray();
            $num = $question['num'] + 1;
            QuestionModel::where('id', $questionid)->update(array('num' => $num));
            
            $rightAd = AdTargetModel::getAdInfo('ANSWERLIST_RIGHT_TOP');
            $data['rightAd'] = $rightAd;
            return $this->theme->scope('question.reply', $data)->render();
        }

        
        if ($result != 1 && $status[0]['status'] != 4 && $uid!=$question[0]['uid']) {
            return redirect('question/wkanswerlist/' . $questionid);
        } else {
            return redirect('question/answerlist/' . $questionid);
        }
    }

    
    public function check($id)
    {
        $uid = Auth::user()['id'];
        $result = QuestionModel::where('id', $id)->where('uid', $uid)->get()->count();
        $question = QuestionModel::where('id', $id)->get()->toArray();
        $status = QuestionModel::where('id', $id)->select('status')->get()->toArray();
        
        if (($question[0]['answernum'] == 0 && $uid!=$question[0]['uid']) || (empty($uid) && $question[0]['answernum'] == 0)) {
            return redirect('question/reply/' . $id);
        }
        
        if ($result != 1 && $status[0]['status'] != 4 && $uid!=$question[0]['uid']) {
            return redirect('question/wkanswerlist/' . $id);
        } else {
            return redirect('question/answerlist/' . $id);
        }
    }

    
    public function answerlist($id)
    {
        $question = QuestionModel::where('id', $id)->select('status')->first();
        
        if ($question['status'] == 1) {
            $qq = \CommonClass::getConfig('qq');
            $data = array('mark' => 2, 'qq' => $qq);
            return $this->theme->scope('question.quiz', $data)->render();
        } elseif ($question['status'] == 5) {
            $qq = \CommonClass::getConfig('qq');
            $data = array('mark' => 3, 'qq' => $qq);
            return $this->theme->scope('question.quiz', $data)->render();
        }
        $common=$this->common($id);
        $uid=$common['uid'];
        $result=$common['result'];
        $fenye=$common['fenye'];
        $answer1=$common['answer1'];
        $answer2=$common['answer2'];
        $count=$common['count'];
        
        if (empty($uid)) {
            $reward = 1;
        } elseif ($result['uid'] != $uid) {
            $reward = 1;
        }elseif(!empty($answer2) && $answer2[0]['cash'] > 0){
            $reward = 1;
        } else {
            $reward = 2;
        }
        $this->theme->set('keywords',e($result['discription']));
        if(!empty($question['discription']))
        {
            $this->theme->setTitle($question['discription']);
        }else{
            $this->theme->setTitle('回答列表');
        }


        
        $rightAd = AdTargetModel::getAdInfo('ANSWERLIST_RIGHT_TOP');
        $domain = url();

        $data = array('question' => $result,
            'answer1' => $answer1['data'],
            'answer2' => $answer2,
            'count' => $count,
            'uid' => $uid,
            'reward' => $reward,
            'rightAd' => $rightAd,
            'domain' => $domain,
            'answerlist' => $fenye,
        );
        
        $result = QuestionModel::where('id', $id)->where('uid', $uid)->get()->count();
        $question = QuestionModel::where('id', $id)->get()->toArray();
        $status = QuestionModel::where('id', $id)->select('status')->get()->toArray();
        if (($question[0]['answernum'] == 0 && $uid!=$question[0]['uid']) || (empty($uid) && $question[0]['answernum'] == 0)) {
            return redirect('question/reply/' . $id);
        }
        if ($result != 1 && $status[0]['status'] != 4 && $uid!=$question[0]['uid']) {
            return redirect('question/wkanswerlist/' . $id);
        } else {
            
            $question = QuestionModel::where('id', $id)->select('num')->first()->toArray();
            $num = $question['num'] + 1;
            QuestionModel::where('id', $id)->update(array('num' => $num));
            return $this->theme->scope('question.answerlist', $data)->render();
        }

    }
    
    public function common($id){
        
        $uid = Auth::user()['id'];
        
        $result = QuestionModel::leftjoin('cate', 'question.category', '=', 'cate.id')
            ->leftjoin('users', 'question.uid', '=', 'users.id')
            ->select('question.*', 'cate.name', 'users.name as username')
            ->where('question.id', $id)->first()->toArray();
        
        $fenye = AnswerModel::leftjoin('users', 'users.id', '=', 'answer.uid')
            ->leftjoin('user_detail', 'user_detail.uid', '=', 'users.id')
            ->where('questionid', $id)->where('adopt', 0)->orderBy('answer.time','asc')
            ->select('answer.*', 'users.name as username', 'users.id as answeruid', 'user_detail.avatar')->paginate(9);
        $answer1 = $fenye->toArray();
        
        $answer2 = AnswerModel::leftjoin('users', 'users.id', '=', 'answer.uid')
            ->leftjoin('user_detail', 'user_detail.uid', '=', 'users.id')
            ->where('questionid', $id)->where('adopt', 1)
            ->select('answer.*', 'users.name as username', 'users.id as answeruid', 'user_detail.avatar')
            ->get()->toArray();
        $count = $result['answernum'];

        
        $praiseid = AnswerPraiseModel::where('uid', $uid)->select('answerid')->get()->toArray();
        if ($count != 0 && !empty($praiseid)) {
            foreach ($praiseid as $k => $v) {
                $arr[$k] = $v['answerid'];
            }
        } else {
            $arr = array();
        }
        foreach ($answer1['data'] as $k => $v) {
            if (in_array($v['id'], $arr)) {
                $answer1['data'][$k]['praise'] = 1;
            } else {
                $answer1['data'][$k]['praise'] = 0;
            }
            if ($v['uid'] == $uid) {
                $answer1['data'][$k]['same'] = 1;
            }
        }
        foreach ($answer2 as $k => $v) {
            if (in_array($v['id'], $arr)) {
                $answer2[$k]['praise'] = 1;
            } else {
                $answer2[$k]['praise'] = 0;
            }
            if ($v['uid'] == $uid) {
                $answer2[$k]['same'] = 1;
            }
        }
        
        if (empty($uid)) {
            foreach ($answer1['data'] as $k => $v) {
                $answer1['data'][$k]['tourists'] = 1;
            }

            foreach ($answer2 as $k => $v) {
                $answer2[$k]['tourists'] = 1;
            }
        }
        $data=array(
            'uid'=>$uid,
            'result'=>$result,
            'fenye'=>$fenye,
            'answer1'=>$answer1,
            'answer2'=>$answer2,
            'count'=>$count
        );
        return $data;
    }
    
    public function wkanswerlist($id)
    {
        $common=$this->common($id);
        $uid=$common['uid'];
        $result=$common['result'];
        $fenye=$common['fenye'];
        $answer1=$common['answer1'];
        $answer2=$common['answer2'];
        $count=$common['count'];
        
        if ($result['discription']) {
            $this->theme->setTitle($result['discription']);
        } else {
            $this->theme->setTitle('威客回答列表');
        }
        
        $rightAd = AdTargetModel::getAdInfo('ANSWERLIST_RIGHT_TOP');
        $domain = url();
        
        
        $login=1;
        if(empty($uid)){
            
            $login=2;
        }
        $data = array(
            'question' => $result,
            'answer1' => $answer1['data'],
            'answer2' => $answer2,
            'count' => $count,
            'uid' => $uid,
            'rightAd' => $rightAd,
            'domain' => $domain,
            'wkanswerlist' => $fenye,
            'login'=>$login
        );
        
        $result = QuestionModel::where('id', $id)->where('uid', $uid)->get()->count();
        $question = QuestionModel::where('id', $id)->get()->toArray();
        $status = QuestionModel::where('id', $id)->select('status')->get()->toArray();
        
        if (($question[0]['answernum'] == 0 && $uid!=$question[0]['uid']) || (empty($uid) && $question[0]['answernum'] == 0)) {
            return redirect('question/reply/' . $id);
        }
        if ($result != 1 && $status[0]['status'] != 4 && $uid!=$question[0]['uid']) {
            
            $question = QuestionModel::where('id', $id)->select('num')->first()->toArray();
            $num = $question['num'] + 1;
            QuestionModel::where('id', $id)->update(array('num' => $num));
            return $this->theme->scope('question.wkanswerlist', $data)->render();
        } else {
            return redirect('question/answerlist/' . $id);
        }

    }

    public function answeradd(AnswerRequest $request)
    {
        $uid = Auth::user()['id'];
        $time = date('Y-m-d H:i:s', time());
        $desc = $request->get('desc');
        $questionid = $request->get('questionid');
        

        $data = array(
            'adopt' => 0,
            'cash' => 0,
            'praisenum' => 0,
            'uid' => $uid,
            'time' => $time,
            'content' => \CommonClass::removeXss($desc),
            'questionid' => $questionid
        );
        $result = AnswerModel::insert($data);
        $answernum = QuestionModel::select('answernum')->where('id', $questionid)->first()->toArray();
        $answernum = $answernum['answernum'] + 1;
        $data = array('answernum' => $answernum);
        QuestionModel::where('id', $questionid)->update($data);
        if ($result) {
            return redirect('question/wkanswerlist/' . $questionid);
        }

    }

    
    public function addpraise($num, $uid, $answerid, $questionid)
    {
        $count = AnswerPraiseModel::where('uid', $uid)->where('answerid', $answerid)->get()->toArray();
        if (!$count) {
            $status = AnswerModel::praise($answerid, $uid, $questionid);
        }
        if (is_null($status)) {
            return response()->json(array('result' => 0, 'status' => 0));
        }
    }

    
    public function adopt($adoptid, $questionid)
    {
        $status = AnswerModel::adopt($adoptid, $questionid);
        if (is_null($status)) {
            return redirect('question/answerlist/' . $questionid);
        }
    }

    
    public function reward($adoptid, $questionid)
    {
        
        $cash = AnswerModel::where('id', $adoptid)->select('cash')->first()->toArray();
        if ($cash['cash'] > 0) {
            return redirect('question/check/' . $questionid);
        }
        $domain = url();
        
        $this->theme->setTitle('打赏页面');
        $question = QuestionModel::leftjoin('user_detail', 'question.uid', '=', 'user_detail.uid')
            ->where('question.id', $questionid)
            ->select('user_detail.avatar', 'user_detail.balance', 'question.uid', 'question.discription', 'question.id')
            ->first()->toArray();
        $answer = AnswerModel::leftjoin('users', 'answer.uid', '=', 'users.id')
            ->where('answer.id', $adoptid)->select('users.name', 'answer.uid', 'answer.id')
            ->first()->toArray();
        $data = array('question' => $question, 'answer' => $answer, 'domain' => $domain);
        return $this->theme->scope('question.reward', $data)->render();
    }

    
    public function money(RewardRequest $request)
    {
        $answerid = $request['answerid'];
        $questionid = $request['questionid'];
        $qid = $request['questionuid'];
        $aid = $request['answeruid'];
        $password = $request['password'];
        $money = $request['reward'];
        

        $qmoney = UserDetailModel::where('uid', $qid)->get()->toArray();
        $reward = $qmoney[0]['balance'] - $money;
        $amoney = UserDetailModel::where('uid', $aid)->get()->toArray();
        $reward1 = $amoney[0]['balance'] + $money;
        
        $password = UserModel::encryptPassword($password, $this->user['salt']);
        if ($password != $this->user['alternate_password']) {
            return redirect()->back()->with(['error' => '您的支付密码不正确']);
        }
        if ($reward < 0) {
            return redirect()->back()->with(['error' => '余额不足']);
        }
        $status = AnswerModel::reward($money, $answerid, $qid, $aid, $reward, $reward1);
        if (is_null($status)) {
            return redirect('question/check/' . $questionid);
        } else {
            return redirect()->back()->with(['error' => '打赏失败']);
        }

    }

    public function addquestion($questionid)
    {
        $question = QuestionModel::where('id', $questionid)->select('category', 'discription', 'time', 'uid')
            ->first()->toArray();
        $category = TaskCateModel::where('id', $question['category'])->select('name')->get()->toArray();
        $username = UserModel::select('name')->find($question['uid']);
        $question[0]['discription'] = $question['discription'];
        $question[0]['username'] = $username['name'];
        $question[0]['name'] = $category[0]['name'];
        $question[0]['time'] = $question['time'];
        
        $status = QuestionModel::where('id', $questionid)->select('status')->first();
        if ($status['status'] != 1 && $status['status'] != 5) {
            return redirect('question/check/' . $questionid);
        }
        
        $config = ConfigModel::getConfigByAlias('question_verify');
        $status = 1;
        if ($config['rule'] == 0) {
            $status = 2;
        }

        if ($status == 2) {
            $this->theme->setTitle('提交问题');
            $data = array('question' => $question, 'status' => 1);
            return $this->theme->scope('question.reply', $data)->render();
        } else {
            $this->theme->setTitle('提交问题');
            $qq = \CommonClass::getConfig('qq');
            $data = array('question' => $question, 'mark' => 2, 'qq' => $qq);
            return $this->theme->scope('question.quiz', $data)->render();
        }
    }
}


















