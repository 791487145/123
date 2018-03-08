<?php

namespace App\Modules\Question\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    protected $table = 'question';

    public $timestamps = false;

    protected $fillable = [
        'id','num','discription','audit','status','uid','time','verify_at','category'
    ];


    
    static public function myQuestion($uid,$data)
    {
        $result = self::select('question.*','ct.name as category_name','ud.avatar')->where('question.uid',$uid);

        if(!empty($data['type']) && $data['type']!=0)
        {
            switch($data['type']){
                case 1 :
                    $result = $result->where('question.status',1);
                    break;
                case 2 :
                    $result = $result->where('question.status',5);
                    break;
                case 3 :
                    $result = $result->whereIn('question.status',[2,3]);
                    break;
                case 4 :
                    $result = $result->where('question.status',[4]);
                    break;
            }

        }
        $result = $result->join('cate as ct','ct.id','=','question.category')
                ->leftjoin('user_detail as ud','ud.uid','=','question.uid')
                ->orderBy('question.time','DESC')
                ->paginate(5);
        return $result;
    }
    
    static public function allQuestion($data)
    {
        $result = self::select('question.*','us.name as username','ct.name as question_category');
        
        if(!empty($data['username']))
        {
            $result = $result->where('us.name','like','%'.$data['username'].'%');
        }
        
        if(!empty($data['second_category']) && $data['second_category']!=0)
        {
            $result = $result->where('question.category',$data['second_category']);
        }
        if(!empty($data['first_category']) && $data['second_category']==0)
        {
            $category_ids= QuestionCategoryModel::where('pid',$data['first_category'])->lists('id');
            $result = $result->whereIn('question.category',$category_ids);
        }
        
        if(!empty($data['status']) && $data['status']!=0)
        {
            switch($data['status']){
                case 1 :
                    $result = $result->where('question.status',1);
                    break;
                case 2 :
                    $result = $result->where('question.status',5);
                    break;
                case 3 :
                    $result = $result->whereIn('question.status',[2,3]);
                    break;
                case 4 :
                    $result = $result->where('question.status',[4]);
                    break;
            }
        }
        
        if(!empty($data['time_type']) && $data['time_type']==1 && !empty($data['start']) && !empty($data['end']))
        {
            $result = $result->whereBetween('question.time',[date('Y-m-d H:i:s',strtotime($data['start'])),date('Y-m-d H:i:s',strtotime($data['end']))]);
        }
        
        if(!empty($data['time_type']) && $data['time_type']==2  && !empty($data['start']) && !empty($data['end']))
        {
            $result = $result->whereBetween('question.verify_at',[$data['start'],$data['end']]);
        }
        $result = $result->join('users as us','us.id','=','question.uid')
            ->leftjoin('cate as ct','ct.id','=','question.category')
            ->orderBy('id','DESC')
            ->paginate(10);

        return $result;
    }
    
    static public function hot($num)
    {
        $result = self::leftjoin('cate', 'question.category', '=', 'cate.id')
            ->orderby('answernum', 'des')
            ->select('cate.name', 'question.discription', 'question.id')
            ->where('question.status', '!=', 5)->where('question.status', '!=', 1)
            ->limit($num)->get()->toArray();
        return $result;
    }
    
    static public function essence($num)
    {
        $result = self::orderBy('question.praisenum', 'desc')
            ->where('question.status', '!=', 5)->where('question.status', '!=', 1)
            ->select('question.id', 'question.discription')
            ->limit($num)->get()->toArray();
        return $result;
    }

}
