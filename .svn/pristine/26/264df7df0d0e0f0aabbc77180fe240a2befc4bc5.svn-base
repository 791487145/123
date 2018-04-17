<?php
namespace App\Modules\Mobile\Http\Controllers;

use App\Http\Requests;

use App\Modules\Manage\Model\LastAndFoundImgModel;
use App\Modules\Manage\Model\LastAndFoundModel;
use App\Modules\Manage\Model\LastFoundCommentModel;
use App\Modules\Manage\Model\LastFoundCommentReplyModel;
use App\Modules\Manage\Model\TypeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;
use Validator;
use Illuminate\Support\Facades\Crypt;

use Cache;
use DB;
use Socialite;
use Auth;
use Log;
use Lang;
use Illuminate\Support\Facades\Redis;
//失物招领
class LostAndFoundController extends ApiBaseController
{

    protected $uid;
    protected $username;
    protected $mobile;

    public function __construct(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $this->uid = $tokenInfo['uid'];
        $this->username = $tokenInfo['name'];
        $this->mobile = $tokenInfo['mobile'];
    }

    /**
     *  二手交易列表
     *
     **/
    public function getTransactionList(Request $request)
    {
        $page = $request->input('page',1);
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $transaction = LastAndFoundModel::select('last_and_found.*','u.name as username','u.head_img','t.name')
                                                ->where('secondhand_transaction.status','valid')
                                                ->leftjoin('users as u','secondhand_transaction.uid','=','u.id')
                                                ->leftjoin('type as t','secondhand_transaction.type','=','t.id')
                                                ->orderBy('id','desc')->offset($offset)
                                                ->limit($limit)->get();
        if($transaction->isEmpty()){
            return $this->formateResponse(1001,'暂无数据');
        }

        return $this->formateResponse(1000,'获取成功',$transaction);
    }

    /**
     *  二手交易详情
     *
     **/
    public function postTransactionDetail(Request $request)
    {
        $id = $request->input('id',0);
        if($id == 0){
            return $this->formateResponse(1001,'请填写二手交易id');
        }

        $transaction = SecondhandTransactionModel::select('secondhand_transaction.*','u.name as username','u.head_img')
            ->where('secondhand_transaction.id',$id)
            ->leftjoin('users as u','secondhand_transaction.uid','=','u.id')
            ->first();

        $transaction['type'] = TypeModel::where('id',$transaction['type'])->pluck('name');

        $img = SecondhandImgModel::where('sid',$transaction['id'])->get()->toArray();
        $transaction['img'] = $img;

        $comment = SecondhandCommentModel::select('secondhand_comment.*','u.name as username','u.head_img')
            ->where('secondhand_comment.sid',$transaction['id'])
            ->leftjoin('users as u','secondhand_comment.uid','=','u.id')
            ->offset(0)->limit(10)->get()->toArray();
        foreach($comment as $key=>$val){
            $reply = SecondhandCommentReplyModel::select('secondhand_comment_reply.*','u.name as username','u.head_img')
                ->where('comment_id',$val['id'])
                ->leftjoin('users as u','secondhand_comment_reply.uid','=','u.id')
                ->offset(0)->limit(10)->get()->toArray();
            $comment[$key]['reply'] = $reply;
        }

        $transaction['comment'] = $comment;

        return $this->formateResponse(1000,'成功',$transaction);

    }

    /**
     *  添加二手交易
     *
     **/
    public function postTransactionCreate(Request $request)
    {
        $dataInfo = $request->all();
        $validator = Validator::make($dataInfo,[
            'name' => 'required',
            'price' => 'required',
            'type'  =>  'required',
            'phone' => 'required|mobile_phone',
        ],[
            'name.required' => '请输入物品名称',
            'price.required' => '请输入物品价格',
            'type.required' => '请选择物品类型',
            'phone.required' => '请输入联系方式',
            'phone.mobile_phone' => '请输入正确的手机号码格式',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);

        $data['uid'] = $this->uid;
        $data['name'] = \CommonClass::removeXss($dataInfo['name']);
        $data['price'] = \CommonClass::removeXss($dataInfo['price']);
        $data['phone'] = \CommonClass::removeXss($dataInfo['phone']);
        $data['type'] = $dataInfo['type'];
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['name'] = $dataInfo['name'];




    }

    /**
     *  获取二手交易物品类型
     *
     **/
    public function getTransactionCreate(Request $request)
    {
        $type = TypeModel::where('type','secondhand_type')->get();
        if($type){
            return $this->formateResponse(1000,'获取成功',$type);
        }else{
            return $this->formateResponse(1001,'获取失败');
        }

    }

    /**
     *  关闭二手交易
     **/
    public function postTransactionClose(Request $request)
    {
        $id = $request->input('id',0);
        if($id == 0){
            return $this->formateResponse(1001,'请填写二手交易id');
        }

        $uid = SecondhandTransactionModel::where('id',$id)->pluck('uid');
        if($uid != $this->uid){
            return $this->formateResponse(1001,'二手交易id与用户id不匹配');
        }
        $status = SecondhandTransactionModel::where('id',$id)->pluck('status');
        if($status == 'invalid'){
            return $this->formateResponse(1001,'该交易已关闭');
        }

        $data['status'] = 'invalid';
        $data['update_at'] = date('Y-m-d H:i:s');
        $info = SecondhandTransactionModel::where('id',$id)->update($data);
        if($info){
            return $this->formateResponse(1000,'关闭成功');
        }else{
            return $this->formateResponse(1001,'网络错误，请稍后重试');
        }

    }

    /**
     * 用户评论
     **/
    public function postUserComment(Request $request)
    {
        $dataInfo = $request->all();

        $validator = Validator::make($dataInfo,[
            'com_content' => 'required',
        ],[
            'com_content.required' => '请输入评论内容',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);

        $data['com_content'] = \CommonClass::removeXss($dataInfo['com_content']);
        $data['uid'] = $this->uid;
        $data['sid'] = $dataInfo['id'];
        $data['comment_time'] = date('Y-m-d H:i:s');

        $info = SecondhandCommentModel::create($data);
        if($info){
            return $this->formateResponse(1000,'评论成功');
        }else{
            return $this->formateResponse(1001,'网络错误，请稍后重试');
        }

    }

    /**
     * 用户回复评论
     **/
    public function postUserCommentReply(Request $request)
    {
        $dataInfo = $request->all();

        $validator = Validator::make($dataInfo,[
            'reply_content' => 'required',
        ],[
            'reply_content.required' => '请输入回复内容',
        ]);
        $error = $validator->errors()->all();
        if(count($error)) return $this->formateResponse(1001,$error[0], $error);

        $data['uid'] = $this->uid;
        $data['comment_id'] = $dataInfo['id'];
        $data['reply_content'] = \CommonClass::removeXss($dataInfo['reply_content']);
        $data['reply_time'] = date('Y-m-d H:i:s');

        $info = SecondhandCommentReplyModel::create($data);
        if($info){
            return $this->formateResponse(1000,'回复评论成功');
        }else{
            return $this->formateResponse(1001,'网络错误，请稍后重试');
        }


    }

    /**
     * 查看更多评论
     **/
    public function postUserCommentMore(Request $request)
    {
        $id = $request->input('id',0);
        if($id == 0){
            return $this->formateResponse(1001,'请填写二手交易id');
        }

        $page = $request->input('page',1);
        $limit = 20;
        $offset = ($page - 1) * $limit;

        $comment = SecondhandCommentModel::select('secondhand_comment.*','u.name as username','u.head_img')
            ->where('secondhand_comment.sid',$id)
            ->leftjoin('users as u','secondhand_comment.uid','=','u.id')
            ->offset($offset)->limit($limit)->get()->toArray();

        foreach($comment as $key=>$val){
            $reply = SecondhandCommentReplyModel::select('secondhand_comment_reply.*','u.name as username','u.head_img')
                ->where('comment_id',$val['id'])
                ->leftjoin('users as u','secondhand_comment_reply.uid','=','u.id')
                ->offset(0)->limit(10)->get()->toArray();
            $comment[$key]['reply'] = $reply;
        }

        return $this->formateResponse(1000,'成功',$comment);
    }





}
