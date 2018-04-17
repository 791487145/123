<?php
namespace App\Modules\Manage\Http\Controllers;
use App\Http\Controllers\ManageController;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Modules\Manage\Model\SecondhandCommentModel;
use App\Modules\Manage\Model\SecondhandCommentReplyModel;
use App\Modules\Manage\Model\SecondhandImgModel;
use App\Modules\Manage\Model\SecondhandTransactionModel;
use App\Modules\Manage\Model\TypeModel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Theme;
//二手交易
class SecondhandTransactionController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');

    }

    /**
     *  二手交易列表
     *
     **/
    public function getTransactionList(Request $request)
    {
        $this->theme->setTitle('书籍列表');
        $transaction = SecondhandTransactionModel::orderBy('secondhand_transaction.id','desc');
        $re = $request->all();
        if ($request->get('name')) {//物品名称
            $transaction = $transaction->where('secondhand_transaction.name', $request->get('name'));
        }

        if ($request->get('type')) {//物品类型
            $transaction = $transaction->where('secondhand_transaction.type', $request->get('type'));
        }

        if ($request->get('status')) {//物品状态
            $transaction = $transaction->where('secondhand_transaction.status', $request->get('status'));
        }
        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $transaction = $transaction->where('secondhand_transaction.created_at','>',$start);
        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $transaction = $transaction->where('secondhand_transaction.created_at','<',$end);
        }



        $transaction = $transaction->select('secondhand_transaction.*','u.name as username','t.name as type_name')
                                ->where('secondhand_transaction.status','valid')
                                ->leftjoin('users as u','secondhand_transaction.uid','=','u.id')
                                ->leftjoin('type as t','secondhand_transaction.type','=','t.id')
                                ->paginate(20);

        $data = [
            'transaction' => $transaction,
            'request' => $re
        ];

        $data['type'] = TypeModel::where('type','secondhand_type')->get()->toArray();

        $data['status'] = [
            ['id' => "valid" ,'name' => '正在交易中'],
            ['id' => "invalid" ,'name' => '已完成交易'],
        ];

        return $this->theme->scope('manage.transactionList', $data)->render();
    }

    /**
     *  二手交易详情
     *
     **/
    public function getTransactionDetail($id)
    {
        $transaction = SecondhandTransactionModel::select('secondhand_transaction.*','u.name as username')
            ->where('secondhand_transaction.id',$id)
            ->leftjoin('users as u','secondhand_transaction.uid','=','u.id')
            ->first();

        $transaction['type'] = TypeModel::where('id',$transaction['type'])->pluck('name');

        $img = SecondhandImgModel::where('sid',$transaction['id'])->get()->toArray();
        $transaction['img'] = $img;

        //评论回复
//        $comment = SecondhandCommentModel::select('secondhand_comment.*','u.name as username','u.head_img')
//            ->where('secondhand_comment.sid',$transaction['id'])
//            ->leftjoin('users as u','secondhand_comment.uid','=','u.id')
//            ->offset(0)->limit(10)->get()->toArray();
//        foreach($comment as $key=>$val){
//            $reply = SecondhandCommentReplyModel::select('secondhand_comment_reply.*','u.name as username','u.head_img')
//                ->where('comment_id',$val['id'])
//                ->leftjoin('users as u','secondhand_comment_reply.uid','=','u.id')
//                ->offset(0)->limit(10)->get()->toArray();
//            $comment[$key]['reply'] = $reply;
//        }

        $data = ['transaction'=>$transaction];
        return $this->theme->scope('manage.transactionDetail', $data)->render();


    }









}
