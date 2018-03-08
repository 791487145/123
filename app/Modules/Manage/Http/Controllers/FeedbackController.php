<?php

namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Manage\Model\FeedbackModel;
use App\Modules\Manage\Model\GeneralizeConfigModel;
use App\Modules\Manage\Model\GeneralizeModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\Manage\Model\TypeModel;
use App\Modules\Manage\Model\HelpModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\PromoteModel;
use App\Modules\User\Model\UserDetailModel;
use Illuminate\Http\Request;
use Theme;
use App\Modules\User\Model\UserModel;
use Validator;

class FeedbackController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->theme->setTitle('用户反馈');
        $this->initTheme('manage');
    }

    
    public function listInfo(Request $request)
    {
        $merge = $request->all();
        $feedbackList = FeedbackModel::whereRaw('1 = 1');
        if ($request->get('type') != '') {
            $feedbackList = $feedbackList->where('type',$request->get('type'));
        }

        if($request->get('status') != 0){
            $feedbackList = $feedbackList->where('status', $request->get('status'));
        }
        $timeType = 'created_time';
        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $feedbackList = $feedbackList->where($timeType,'>',$start);
        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $feedbackList = $feedbackList->where($timeType,'<',$end);
        }

        $paginate = $request->get('paginate') ? $request->get('paginate') : 20;

        $feedbackList = $feedbackList->orderBy('id','desc')->paginate($paginate);
        if($feedbackList->total()){
            foreach($feedbackList->items() as $k=>$v){
                $userInfo = UserModel::where('id',$v->uid)->select('name')->get();
                $type_name = TypeModel::where('id',$v->type)->select('name')->first();
                if(count($userInfo)){
                    $v->name = $userInfo[0]['name'];
                }
                if(count($type_name)){
                    $v->type = $type_name['name'];
                }
                else{
                    $v->name = null;
                }
            }
        }
        $feedback = TypeModel::where('type','feedback')->get();
        $view = array(
            'feedback' =>  $feedback,
            'merge'        => $merge,
            'feedbackList' => $feedbackList,
        );
        $this->theme->setTitle('投诉建议');
        return $this->theme->scope('manage.feedbacklist', $view)->render();
    }

    
    public function deletefeedback($id){
        $res = FeedbackModel::destroy($id);
        if($res){
            return redirect()->to('/manage/feedbackList')->with(['massage'=>'删除成功！']);
        }
        else{
            return redirect()->to('/manage/feedbackList')->with(['error'=>'删除失败！']);
        }
    }
    
    //回复反馈页
    public function feedbackReplay($id){
        $feedbackDetail = FeedbackModel::select('feedback.*','t.name as type_name')
                                        ->where('feedback.id',$id)
                                        ->leftjoin('type as t','feedback.type','=','t.id')
                                        ->first();
        if(!$feedbackDetail){
            return redirect()->back()->with(['error'=>'传送参数错误！']);
        }
        $userInfo = UserModel::where('id',$feedbackDetail->uid)->select('name')->first();
        if(count($userInfo)){
            $feedbackDetail->name = $userInfo['name'];
        }
        else{
            $feedbackDetail->name = null;
        }

        $view = [
            'feedbackDetail' => $feedbackDetail,
            'id'             => $id
        ];
        $this->theme->setTitle('反馈投诉建议');
        return $this->theme->scope('manage.feedbackReplay',$view)->render();
    }

    
    public function feedbackUpdate(Request $request){
        $validator = Validator::make($request->all(),[
            'replay' => 'required|max:255'
        ],
        [
            'replay.required' => '请输入投诉建议',
            'replay.max'      => '投诉建议字数超过限制'
        ]);
        if($validator->fails()){
            return redirect()->to('/manage/feedbackList')->withErrors($validator);
        }
        $feedbackDetail = FeedbackModel::find(intval($request->get('id')));
        if(!$feedbackDetail){
            return redirect()->back()->withErrors(['error'=>'传送参数错误！']);
        }
        $newdata = [
            'handle_time' => date('Y-m-d h:i:s',time()),
            'status'      => 2,
            'replay'      => $request->get('replay')
        ];
        $res = $feedbackDetail->update($newdata);
        if($res){
            $uid = $request->get('uid');
            $newArr = array(
                'username' => $request->get('username'),
            );
            $codeName = 'feedback';
            $messageTem = MessageTemplateModel::where('code_name',$codeName)->where('is_open',1)->where('is_on_site',1)->first();
            if(!empty($messageTem)){
                $messageContent = MessageTemplateModel::sendMessage($codeName,$newArr);
                $message = array(
                    'js_id' => $uid,
                    'code_name' => $codeName,
                    'message_title' => '意见反馈处理通知',
                    'message_content' => $messageContent,
                    'message_type' => 1,
                    'receive_time' => date('Y-m-d H:i:s',time()),
                    'status' => 0
                );
                MessageReceiveModel::create($message);
            }

            return redirect('/manage/feedbackList')->with(['massage'=>'修改成功！']);
        }
        else{
            return redirect()->back()->with(['error'=>'修改失败！']);
        }

    }

    
    public function feedbackDetail($id){
        $feedbackDetail = FeedbackModel::find(intval($id));
        if(!$feedbackDetail){
            return redirect()->back()->with(['error'=>'传送参数错误！']);
        }
        $userInfo = UserModel::where('id',$feedbackDetail->uid)->select('name')->first();
        if(count($userInfo)){
            $feedbackDetail->name = $userInfo['name'];
        }
        else{
            $feedbackDetail->name = null;
        }

        $view = [
            'feedbackDetail' => $feedbackDetail
        ];
        return $this->theme->scope('manage.feedbackDetail',$view)->render();
    }

    //帮助
    public function helpInfo()
    {
        $this->theme->setTitle('帮助');
        $help = HelpModel::select('help.*','t.name as type_name')
                        ->leftjoin('type as t','help.type','=','t.id')
                        ->where('help.status','valid')->paginate(20);
        $data = [
            'help' => $help,
        ];
        return $this->theme->scope('manage/helpList',$data)->render();
    }

    //添加页
    public function helpAdd()
    {
        $this->theme->setTitle('帮助');
        $type = TypeModel::where('type','feedback')->get();
        $data = [
            'type'  =>  $type,
        ];
        return $this->theme->scope('manage/addHelp',$data)->render();
    }

    //添加
    public function createHelp(Request $request)
    {
        $data = $request->except('_token');
        $data['create_at'] = date('Y-m-d H:i:s');
        $help = HelpModel::create($data);
        if($help)
            return redirect('manage/help')->with(['message'=>'操作成功']);
        else
            return redirect()->back()->with(['message'=>'操作失败']);
    }

    //详情
    public function helpDetail($id)
    {
        $this->theme->setTitle('帮助');
        $help = HelpModel::select('help.*','t.name as type_name')
            ->leftjoin('type as t','help.type','=','t.id')
            ->where('help.status','valid')
            ->where('help.id',$id)
            ->first();
        $type = TypeModel::where('type','feedback')->get();
        $data = ['help'=>$help,'type'=>$type];
        return $this->theme->scope('manage/helpDetail',$data)->render();
    }
    //修改
    public function helpUpdate(Request $request)
    {
        $data = $request->except('_token');
        $help = HelpModel::where('id',$data['id'])->update($data);
        if($help)
            return redirect('manage/help')->with(['message'=>'操作成功']);
        else
            return redirect()->back()->with(['message'=>'操作失败']);
    }
    //删除
    public function helpDelete($id)
    {
        $help = HelpModel::where('id',$id)->update(['status'=>'invalid']);
        if($help)
            return redirect()->back()->with(['error'=>'修改成功！']);
    }

    //批量删除
    public function helpDelHandle(Request $request)
    {
        if (!$request->get('ckb')) {
            return \CommonClass::adminShowMessage('参数错误');
        }
        $info = HelpModel::whereIn('id', $request->get('ckb'))->update(array('status' => 'invalid'));
        if($info)
            return redirect()->back()->with(['error'=>'操作成功！']);
        else
            return redirect()->back()->with(['error'=>'操作失败！']);
    }

    //推广配置
    public function generalizeConfig()
    {
        $config = GeneralizeConfigModel::get();
        $data = array(
            'data' => $config,
        );
        $this->theme->setTitle('推广配置');
        return $this->theme->scope('manage.config.generalizeList', $data)->render();
    }
    //添加推广配置页
    public function  addGeneralizeConfig()
    {
        $this->theme->setTitle('添加推广配置');
        return $this->theme->scope('manage.config.generalize')->render();
    }

    //添加推广配置
    public function postGeneralizeConfig(Request $request)
    {
        $data = $request->except('_token');
        $data['create_at'] = date('Y-m-d H:i:s');
        $info = GeneralizeConfigModel::create($data);
        if($info){
            return redirect('manage/generalize_config')->with(array('message' => '添加成功'));
        }else{
            return redirect('manage/generalize_config')->with(array('message' => '保存失败'));
        }

    }

    //修改推广配置
    public function upGeneralizeConfig($id)
    {
        $config = GeneralizeConfigModel::whereId($id)->first();
        $data = array(
            'data' => $config,
        );
        $this->theme->setTitle('推广配置');
        return $this->theme->scope('manage.config.generalizeUp', $data)->render();
    }

    public function postGeneralizeConfigUpdate(Request $request)
    {
        $data = $request->except('_token');
        $config = GeneralizeConfigModel::whereId($data['id'])->update($data);
        if($config){
            return redirect('manage/generalize_config')->with(array('message' => '操作成功'));
        }else{
            return redirect('manage/generalize_config')->with(array('message' => '操作失败'));
        }
    }

    //添加推广员
    public function createGeneralize(Request $request)
    {
        $data = $request->except('_token');
        $info = UserModel::where('mobile',$data['mobile'])->select('id')->first();
        if(empty($info)){
            return redirect()->back()->with(['error'=>'该手机号未注册']);
        }
        $data['uid'] = $info['id'];
        $realName = UserDetailModel::whereUid($info['id'])->select('realname')->first();
        $data['name'] = $realName['realname'];
        $data['create_at'] = date('Y-m-d H:i:s');
        $result = GeneralizeModel::create($data);
        if($result){
            return redirect()->back()->with(['error'=>'操作成功']);
        }else{
            return redirect()->back()->with(['error'=>'操作失败']);
        }
    }

    //推广员列表
    public function generalizeList(Request $request)
    {
        $this->theme->setTitle('推广员列表');
        $search = $request->all();
        $generalize = GeneralizeModel::where('generalize.status','valid');
        if($request->get('mobile')){
            $generalize = $generalize->where('generalize.mobile',$request->get('mobile'));
        }
        if($request->get('name')){
            $generalize = $generalize->where('generalize.name',$request->get('name'));
        }
        $generalize = $generalize->leftjoin('generalize_config as gc','generalize.plan_id','=','gc.id')
                                 ->select('generalize.*','gc.one_sum','gc.two_sum','gc.three_sum')
                                 ->paginate(20);
        $paginate = $generalize;
        if(!$generalize->isEmpty()){
            $generalize = $generalize->toArray();
            foreach($generalize['data'] as $k=>$v){
                //一级推广
                $one = PromoteModel::where('from_uid',$v['uid'])->where('status',2);
                if ($request->get('start')) {
                    $start = date('Y-m-d H:i:s', strtotime($request->get('start')));
                    $one = $one->where('updated_at', '>', $start);
                }
                if ($request->get('end')) {
                    $end = date('Y-m-d H:i:s', strtotime($request->get('end')));
                    $one = $one->where('updated_at', '<', $end);
                }
                $one = $one->get();
                if(!$one->isEmpty()){
                    $one = $one->toArray();

                    $one_number = count($one);
                    $generalize['data'][$k]['one_number'] = $one_number;
                    $generalize['data'][$k]['one_money'] = $one_number*$v['one_sum'];
                    foreach($one as $do){
                        //二级推广
                        $two = PromoteModel::where('from_uid',$do['to_uid'])->where('status',2);
                        if ($request->get('start')) {
                            $start = date('Y-m-d H:i:s', strtotime($request->get('start')));
                            $two = $two->where('updated_at', '>', $start);
                        }
                        if ($request->get('end')) {
                            $end = date('Y-m-d H:i:s', strtotime($request->get('end')));
                            $two = $two->where('updated_at', '<', $end);
                        }
                        $two = $two->get();
                        if(!$two->isEmpty()){
                            $two = $two->toArray();
                            $two_number = count($two);
                            $generalize['data'][$k]['two_number'] = $two_number;
                            $generalize['data'][$k]['two_money'] = $two_number*$v['two_sum'];
                            foreach($two as $item){
                                //san级推广
                                $three = PromoteModel::where('from_uid',$item['to_uid'])->where('status',2);
                                if ($request->get('start')) {
                                    $start = date('Y-m-d H:i:s', strtotime($request->get('start')));
                                    $three = $three->where('updated_at', '>', $start);
                                }
                                if ($request->get('end')) {
                                    $end = date('Y-m-d H:i:s', strtotime($request->get('end')));
                                    $three = $three->where('updated_at', '<', $end);
                                }
                                $three = $three->get();
                                if(!empty($three)){
                                    $three = $three->toArray();
                                    $three_number = count($three);
                                    $generalize['data'][$k]['three_number'] = $three_number;
                                    $generalize['data'][$k]['three_money'] = $three_number*$v['three_sum'];
                                    $generalize['data'][$k]['total'] = $generalize['data'][$k]['one_money']+$generalize['data'][$k]['two_money']+$generalize['data'][$k]['three_money'];
                                }else{
                                    $generalize['data'][$k]['total'] = $generalize['data'][$k]['one_money']+$generalize['data'][$k]['two_money'];
                                }
                            }
                        }else{
                            $generalize['data'][$k]['total'] = $generalize['data'][$k]['one_money'];
                        }
                    }
                }
            }
        }
        $data = [
            'generalize'   =>  $generalize,
            'paginate' =>  $paginate,
        ];
        $data['merge'] = $search;
        return $this->theme->scope('manage.generalizeList',$data)->render();
    }

}
