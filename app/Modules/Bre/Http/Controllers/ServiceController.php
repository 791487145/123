<?php


namespace App\Modules\Bre\Http\Controllers;

use App\Http\Controllers\IndexController;
use App\Modules\Im\Model\ImAttentionModel;
use App\Modules\User\Model\CommentModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\UserFocusModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use App\Modules\User\Model\UserTagsModel;
use Illuminate\Http\Request;
use App\Modules\Task\Model\SuccessCaseModel;
use Illuminate\Support\Facades\Auth;
use App\Modules\User\Model\TaskModel;
use Validator;

class serviceController extends IndexController
{

    public function __construct()
    {
        parent::__construct();
        $this->initTheme('main');
    }

    
    public function serviceCaseList($uid)
    {
        $this->theme->setTitle('服务商成功案例');
        
        $isFocus = \CommonClass::isFocus($uid);

        $user = UserModel::where('id',$uid)->first();
        $userInfo = UserDetailModel::where('uid', $uid)->first();

        
        $addr = UserDetailModel::getAreaByUserId($uid);

        
        $tag = UserTagsModel::getTagsByUserId($uid);

        
        if($userInfo->shop_status == 1){
            $query = SuccessCaseModel::select('success_case.*', 'tc.name as cate_name', 'ud.avatar as user_avatar', 'us.name as nickname');

            $list = $query->join('cate as tc', 'success_case.cate_id', '=', 'tc.id')
                ->leftjoin('user_detail as ud', 'ud.uid', '=', 'success_case.uid')->where('ud.uid', $uid)
                ->leftjoin('users as us','us.id','=','success_case.uid')
                ->paginate(8);
            $listCount = $list->count();
            $tcName = SuccessCaseModel::select('tc.name')->join('cate as tc', 'success_case.cate_id', '=', 'tc.id')->where('success_case.uid', $uid)->first();
        }else{
            $list = '';
            $listCount = 0;
        }

        $domain = \CommonClass::getDomain();
        $data = array(
            'uid' => $uid,
            'domain' => $domain,
            'addr' => $addr,
            'list' => $list,
            'introduce' => $userInfo,
            'user' => $user,
            'is_focus' => $isFocus,
            'skill_tag' => $tag,
            'listCount' => $listCount
        );
        return $this->theme->scope('bre.serviceCaseList', $data)->render();

    }

    
   public function serviceEvaluateDetail($uid)
   {
       $this->theme->setTitle('服务商评价详情');
       
       $isFocus = \CommonClass::isFocus($uid);
       $user = UserModel::where('id',$uid)->first();
       $userInfo = UserDetailModel::where('uid', $uid)->first();
       
       $tag = UserTagsModel::getTagsByUserId($uid);
       
       $addr = UserDetailModel::getAreaByUserId($uid);

       $commentList = CommentModel::join('task', 'comments.task_id', '=', 'task.id')->join('user_detail', 'task.uid', '=', 'user_detail.uid')->where('comments.to_uid', $uid)
           ->leftJoin('users','users.id','=','comments.from_uid')->paginate(8);
       $commentListCount = $commentList->count();
       
       $counts = CommentModel::groupBy('to_uid')->where('to_uid', $uid)->count();
       
       $count = CommentModel::groupBy('type')->where('to_uid', $uid)->havingRaw('type=1')->count();
       
       if ($counts != 0)
           $feedbackRate = ceil($count / $counts * 100);
       else
           $feedbackRate = 100;
       
       $avgspeed = round(CommentModel::where('to_uid', $uid)->avg('speed_score'), 1);
       
       $avgquality = round(CommentModel::where('to_uid', $uid)->avg('quality_score'), 1);
       
       $avgattitude = round(CommentModel::where('to_uid', $uid)->avg('attitude_score'), 1);
       $domain = \CommonClass::getDomain();
       $data = array(
           'uid' => $uid,
           'user' => $user,
           'domain' => $domain,
           'addr' => $addr,
           'introduce' => $userInfo,
           'avgquality' => $avgquality,
           'avgattitude' => $avgattitude,
           'avgspeed' => $avgspeed,
           'feedbackRete' => $feedbackRate,
           'count' => $count,
           'commentList' => $commentList,
           'is_focus' => $isFocus,
           'skill_tag' => $tag,
           'commentListCount' => $commentListCount
       );
       return $this->theme->scope('bre.serviceEvaluateDetail', $data)->render();

   }

    
    public function serviceCaseDetail($id,$uid)
    {
        $this->theme->setTitle('服务商案例');
        
        $isFocus = \CommonClass::isFocus($uid);
        $user = UserModel::where('id',$uid)->first();
        $userInfo = UserDetailModel::where('uid', $uid)->first();
        
        $tag = UserTagsModel::getTagsByUserId($uid);
        
        $addr = UserDetailModel::getAreaByUserId($uid);

        $comment = TaskModel::join('cate', 'task.cate_id', '=', 'cate.id')->where('task.id', $id)->first();
        $successCase = SuccessCaseModel::join('cate', 'success_case.cate_id', '=', 'cate.id')->where('success_case.id', $id)->first();
        $successCase['view_count'];
        
        SuccessCaseModel::where('id', $id)->update(['view_count' => $successCase['view_count'] + 1]);
        $domain = \CommonClass::getDomain();
        $data = array(
            'successCase' => $successCase,
            'domain' => $domain,
            'addr' => $addr,
            'introduce' => $userInfo,
            'comment' => $comment,
            'uid' => $uid,
            'user' => $user,
            'is_focus' => $isFocus,
            'skill_tag' => $tag
        );


        return $this->theme->scope('bre.serviceCaseDetail', $data)->render();

    }

    
    public function ajaxAdd(Request $request){
        if(Auth::User()) {
            $uid = Auth::User()->id;
            $focus_uid = $request->focus_uid;
            $data = array(
                'uid' => $uid,
                'focus_uid' => $focus_uid,
                'created_at' => date('Y-m-d H:i:s')
            );
            $info = UserFocusModel::where('uid',$uid)->where('focus_uid',$focus_uid)->first();
            if(empty($info)){
                $re = UserFocusModel::insert($data);

                
                $res = ImAttentionModel::where(['uid' => $uid, 'friend_uid' => $focus_uid])->first();
                if(empty($res)){
                    ImAttentionModel::insert([
                        [
                            'uid' => $uid,
                            'friend_uid' => $focus_uid
                        ],
                        [
                            'uid' => $focus_uid,
                            'friend_uid' => $uid
                        ]

                    ]);
                }

                if ($re) {
                    return response()->json(['code' => 1]);
                }
            }else{
                return response()->json(['code' => 1]);
            }
        }
        else{
            return response()->json(['code'=>2]);
        }
    }

    
    public function ajaxDel(Request $request){
        $uid= Auth::User()->id;
        $focus_uid =  $request->focus_uid;

        $re =  UserFocusModel::where('uid',$uid)->where('focus_uid',$focus_uid)->delete();


            return response()->json(['code'=>1]);

    }

    
    public function contactMe(Request $request)
    {
        $data = $request->all();
        if(Auth::check()){
            $user = Auth::User();
            $userId = $user['id'];
            $arr = array(
                'message_title' => $request->get('title')?$request->get('title'):'私信',
                'message_content' => $data['content'],
                'message_type' => 3,
                'fs_id' => $userId,
                'js_id' => $data['js_id'],
                'receive_time' => date('Y-m-d H:i:s',time())
            );
            $res = MessageReceiveModel::create($arr);
            if($res)
            {
                return \GuzzleHttp\json_encode(array(
                    'code' => 1,
                    'msg' => '操作成功'
                ));
            }
            else
            {
                return \GuzzleHttp\json_encode(array(
                    'code' => 0,
                    'msg' => '操作失败'
                ));
            }
        }else{
            return \GuzzleHttp\json_encode(array(
                'code' => 0,
                'msg' => '请登录'
            ));
        }


    }
}