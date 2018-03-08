<?php

namespace App\Modules\Task\Model;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\UserBalanceModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
//use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class WorkModel extends Model
{
    const WORK_CANCEL = -1;//取消
    const WORK_SELECTED = 1;//猎人接受任务
    const WORK_PUSH = 2;//猎人提交

    protected $table = 'work';
    public  $timestamps = false;  //关闭自动更新时间戳
    public $fillable = ['desc','task_id','status','uid','bid_at','created_at','price','if_account'];

    /**
     * 查询所有的附件
     */
    public function childrenAttachment()
    {
        return $this->hasMany('App\Modules\Task\Model\WorkAttachmentModel', 'work_id', 'id');
    }

    /**
     * 查询所有的评论
     */
    public function childrenComment()
    {
        return $this->hasMany('App\Modules\Task\Model\WorkCommentModel', 'work_id', 'id');
    }
    /**
     * 判断用户是否是当前任务的投稿人
     */
    static function isWorker($uid,$task_id)
    {
        $query = Self::where('uid','=',$uid);
        $query = $query->where(function($query) use($task_id){
            $query->where('task_id',$task_id);
        });
        $result = $query->first();
        if($result) return true;

        return false;
    }

    /**
     * 判断用户是否中标
     * @param $task_id
     * @param $uid
     */
    static function isWinBid($task_id,$uid)
    {
        $query = Self::where('task_id',$task_id)->where('status',1)->where('uid',$uid);

        $result = $query->first();

        if($result) return $result['status'];

        return false;
    }

    /**
     * 关联查询所有的投标记录
     * @param $id
     */
    static function findAll($id,$data=array())
    {
        $query = Self::select('work.*','us.name as nickname','a.avatar')
            ->where('work.task_id',$id)->where('work.status','<=',1)->where('forbidden',0);
        //筛选
        if(isset($data['work_type'])){
            switch($data['work_type'])
            {
                case 1:
                    $query->where('work.status','=',0);
                    break;
                case 2:
                    $query->where('work.status','=',1);
                    break;
            }
        }
        $data = $query->with('childrenAttachment')
            ->with('childrenComment')
            ->join('user_detail as a','a.uid','=','work.uid')
            ->join('users as us','us.id','=','work.uid')
            ->paginate(5)->setPageName('work_page')->toArray();
        return $data;
    }

    /**
     * 统计某一任务某一状态下的稿件数量
     * @param $task
     * @param $status
     */
    static function countWorker($task_id,$status)
    {
        $query = Self::where('status',$status);
        $data = $query->where(function($query) use($task_id){
            $query->where('task_id',$task_id);
        })->count();

        return $data;
    }

    /**
     * 中标
     * @param $data
     */
    static function workCreate($data)
    {
        $work = new WorkModel();
        $work->task_id = $data['task_id'];
        $work->uid = $data['uid'];
        $work->bid_by = 0;
        $work->bid_at = date("Y-m-d H:i:s");
        $work->status = 1;
        $work->created_at = date("Y-m-d H:i:s");
        $work->save();

        TaskModel::whereId($data['task_id'])->update(['status'=>3]);
        $userBalance = UserBalanceModel::where('user_id',$data['uid'])->first();
        UserBalanceModel::where('user_id',$data['uid'])->update(['work_task_num'=> ($userBalance->work_task_num + 1)]);

        return $work;

        /*$status = DB::transaction(function() use($data){
            //将数据写入到work表中
            $result = WorkModel::create($data);

            if(isset($data['file_id'])){
                $file_able_ids = AttachmentModel::select('attachment.id','attachment.type')->whereIn('id',$data['file_id'])->get()->toArray();
                //创建投稿记录和附件关联关系
                foreach($file_able_ids as $v){
                    $work_attachment = [
                        'task_id'=>$data['task_id'],
                        'work_id'=>$result['id'],
                        'attachment_id'=>$v['id'],
                        'type'=>$v['type'],
                        'created_at'=>date('Y-m-d H:i:s',time()),
                    ];
                    WorkAttachmentModel::create($work_attachment);
                }
            }
            //修改用户的承接的任务数量
            UserDetailModel::where('uid',$data['uid'])->increment('receive_task_num',1);
            //修改任务的投稿数量
            TaskModel::where('id',$data['task_id'])->increment('delivery_count',1);
            //修改任务的状态为威客交稿,判断当前任务有没有稿件
            $work = WorkModel::where('task_id',$data['task_id'])->count();
            if($work==1)
            {
                TaskModel::where('id',$data['task_id'])->update(['status'=>4]);
            }

            return $result['id'];
        });

        if(is_null($status)){
            return true;
        }
        return $status;*/
    }

    /**
     * 中标 (悬赏模式)
     * @param $data
     * @return bool
     */
    public function winBid($data)
    {
        $status = DB::transaction(function() use($data){
            //修改当前稿件为中标状态
            Self::where('id',$data['work_id'])->update(['status'=>1,'bid_at'=>date('Y-m-d H:s:i',time())]);
            //判断如果是第一次选稿就直接将任务状态修改成选稿状态
            $win_bid_num = self::where('task_id',$data['task_id'])->where('status',1)->count();
            if($win_bid_num==1)
            {
                TaskModel::where('id',$data['task_id'])->update(['status'=>5,'selected_work_at'=>date('Y-m-d H:i:s',time())]);
            }
            //判断当前的任务人数有没有满，如果满了就进入公示期
            if(($data['win_bid_num']+1)== $data['worker_num'])
            {
                //判断当前系统公示期是否为0
                //如果不为0公示期开始
                //如果为0就直接跳转到验收期
                $task_publicity_day = \CommonClass::getConfig('task_publicity_day');
                if($task_publicity_day==0)
                {
                    TaskModel::where('id',$data['task_id'])->update(['status'=>7,'publicity_at'=>date('Y-m-d H:i:s',time()),'checked_at'=>date('Y-m-d H:i:s',time())]);
                }else{
                    TaskModel::where('id',$data['task_id'])->update(['status'=>6,'publicity_at'=>date('Y-m-d H:i:s',time())]);
                }

            }
        });
        //如果中标成功就发送一条系统消息
        if(is_null($status)){
            //判断当前的任务发布成功之后是否需要发送系统消息
            self::sendTaskWidMessage($data);
        }
        return is_null($status)?true:false;
    }

    /**
     * 查询交付投稿
     * @param $id
     * @param $data
     * @return mixed
     */
    static public function findDelivery($id,$data)
    {
        $query = Self::select('work.*','us.name as nickname','a.avatar')
            ->where('work.task_id',$id)->where('work.status','>=',2);
        //筛选
        if(isset($data['evaluate'])){
            switch($data['evaluate'])
            {
                case 1:
                    $query->where('status','>=',0);
                    break;
                case 2:
                    $query->where('status','>=',1);
                    break;
                case 3:
                    $query->where('status','>=',2);
            }
        }
        $data = $query->with('childrenAttachment')
            ->join('user_detail as a','a.uid','=','work.uid')
            ->leftjoin('users as us','us.id','=','work.uid')
            ->paginate(5)->setPageName('delivery_page')->toArray();
        return $data;
    }

    /**
     * 查找当前正在维权的账户
     * @param $id
     * @param $data
     */
    static public function findRights($id)
    {
        $data = Self::select('work.*','us.name as nickname','ud.avatar')
            ->where('task_id',$id)->where('work.status',4)
            ->with('childrenAttachment')
            ->join('user_detail as ud','ud.uid','=','work.uid')
            ->leftjoin('users as us','us.id','=','work.uid')
            ->paginate(5)->setPageName('delivery_page')->toArray();
        return $data;
    }
    /**
     * 悬赏模式(一次性)交付稿件(工作中 交付验收)
     */
    static public function delivery($data)
    {
        $status = DB::transaction(function() use($data){
            //将数据写入到work表中
            $result = WorkModel::create($data);

            if(isset($data['file_id'])){
                $file_able_ids = AttachmentModel::select('attachment.id','attachment.type')->whereIn('id',$data['file_id'])->get()->toArray();
                //创建投稿记录和附件关联关系
                foreach($file_able_ids as $v){
                    $work_attachment = [
                        'task_id'=>$data['task_id'],
                        'work_id'=>$result['id'],
                        'attachment_id'=>$v['id'],
                        'type'=>$v['type'],
                        'created_at'=>date('Y-m-d H:i:s',time()),
                    ];
                    WorkAttachmentModel::create($work_attachment);
                }
            }

        });

        return is_null($status)?true:false;
    }

    /**
     * 验收通过 悬赏模式
     */
    static public function workCheck($data)
    {
        $status = DB::transaction(function() use($data) {
            //修改稿件的状态
            self::where('id', $data['work_id'])->update(['status' => 3, 'bid_at' => date('Y-m-d H:i:s', time())]);
            //赏金分配
            TaskModel::distributeBounty($data['task_id'],$data['uid']);

            TaskModel::whereId($data['task_id'])->update(['end_at'=>date('Y-m-d H:i:s')]);


            //判断是不是最后一个的稿件验收通过，如果是的就直接进入状态8
           /* if(($data['win_check']+1)==$data['worker_num'])
            {
                TaskModel::where('id',$data['task_id'])->update(['status'=>8,'comment_at'=>date('Y-m-d H:i:s',time())]);
            }*/
        });
        return is_null($status)?true:false;
        //稿件结算发送系统消息
        /*if(is_null($status))
        {
            //判断当前的任务发布成功之后是否需要发送系统消息
            $manuscript_settlement = MessageTemplateModel::where('code_name','manuscript_settlement')->where('is_open',1)->where('is_on_site',1)->first();
            if($manuscript_settlement)
            {
                $task = TaskModel::where('id',$data['task_id'])->first();
                $work = WorkModel::where('id',$data['work_id'])->first();
                $user = UserModel::where('id',$work['uid'])->first();//必要条件
                $site_name = \CommonClass::getConfig('site_name');//必要条件
                $domain = \CommonClass::getDomain();
                //组织好系统消息的信息
                //发送系统消息
                $messageVariableArr = [
                    'username'=>$user['name'],
                    'task_number'=>$task['id'],
                    'task_link'=>$domain.'/task/'.$task['id'],
                    'website'=>$site_name,
                ];
                $message = MessageTemplateModel::sendMessage('manuscript_settlement',$messageVariableArr);
                $data = [
                    'message_title'=>'任务验收通知',
                    'message_content'=>$message,
                    'js_id'=>$user['id'],
                    'message_type'=>2,
                    'receive_time'=>date('Y-m-d H:i:s',time()),
                    'status'=>0,
                ];
                MessageReceiveModel::create($data);
            }
        }*/

    }


    /**
     * 中标 招标模式
     * @param $data
     * @return bool
     */
    static public function bidWinBid($data)
    {
        $status = DB::transaction(function() use($data){
            //修改当前稿件为中标状态
            self::where('id',$data['work_id'])->update(['status'=>1,'bid_at'=>date('Y-m-d H:s:i',time())]);
            $bounty = self::find($data['work_id'])->price;
            //将任务状态修改成选稿状态 任务赏金修改为中标人提出金额
            TaskModel::where('id',$data['task_id'])->update(['bounty' => $bounty,'status'=>5,'selected_work_at'=>date('Y-m-d H:i:s',time())]);

        });
        return is_null($status)?true:false;
    }

    /**
     * 发送任务中标信息
     * @param $arr
     * @return bool|static
     */
    static public function sendTaskWidMessage($arr)
    {
        $res = true;
        //判断当前的任务发布成功之后是否需要发送系统消息
        $task_win = MessageTemplateModel::where('code_name','task_win')->where('is_open',1)->where('is_on_site',1)->first();
        if($task_win)
        {
            $task = TaskModel::where('id',$arr['task_id'])->first();
            $work = WorkModel::where('id',$arr['work_id'])->first();
            $user = UserModel::where('id',$work['uid'])->first();
            $site_name = \CommonClass::getConfig('site_name');
            $domain = \CommonClass::domain();
            //发送系统消息
            $messageVariableArr = [
                'username'=>$user['name'],
                'website'=>$site_name,
                'task_number'=>$task['id'],
                'href' => $domain.'/task/'.$task['id'],
                'task_title'=>$task['title'],
                'win_price'=>$task['bounty']/$task['worker_num'],
            ];
            $message = MessageTemplateModel::sendMessage('task_win',$messageVariableArr);
            $data = [
                'message_title'=>'任务中标通知',
                'message_content'=>$message,
                'js_id'=>$user['id'],
                'message_type'=>2,
                'receive_time'=>date('Y-m-d H:i:s',time()),
                'status'=>0,
            ];
            $res = MessageReceiveModel::create($data);
        }
        return $res;
    }

    /**
     * 招标模式 阶段交付稿件
     * @param $data
     * @return bool
     */
    static public function bidDelivery($data)
    {
        $status = DB::transaction(function() use($data){
            //判断该阶段是否提交过稿件
            $paySection = TaskPaySectionModel::where('task_id',$data['task_id'])->where('case_status',1)->where('sort',$data['sort'])->first();
            if(!empty($paySection['work_id']) && $paySection['verify_status'] == 2){
                //删除该稿件
                WorkModel::where('id',$paySection['work_id'])->delete();
                WorkAttachmentModel::where('work_id',$paySection['work_id'])->delete();
            }
            //将数据写入到work表中
            $workInfo = [
                'desc' => $data['desc'],
                'task_id' => $data['task_id'],
                'status' => 2,//威客交付稿件
                'forbidden' => 0,
                'uid' => $data['uid'],
                'created_at' => date('Y-m-d H:i:s')
            ];
            $result = WorkModel::create($workInfo);

            if(isset($data['file_id'])){
                $file_able_ids = AttachmentModel::select('attachment.id','attachment.type')->whereIn('id',$data['file_id'])->get()->toArray();
                //创建投稿记录和附件关联关系
                foreach($file_able_ids as $v){
                    $work_attachment = [
                        'task_id' => $data['task_id'],
                        'work_id' => $result['id'],
                        'attachment_id' => $v['id'],
                        'type' => $v['type'],
                        'created_at' => date('Y-m-d H:i:s',time()),
                    ];
                    WorkAttachmentModel::create($work_attachment);
                }
            }

            //关联稿件和支付阶段
            $paySectionInfo = [
                'work_id' => $result['id'],
                'verify_status' => 0,
                'section_status' => 1, //支付阶段进行中
                'updated_at' => date('Y-m-d H:i:s')
            ];
            TaskPaySectionModel::where('task_id',$data['task_id'])->where('case_status',1)->where('sort',$data['sort'])->update($paySectionInfo);

        });

        return is_null($status)?true:false;
    }

    /**
     * 招标模式 验收稿件
     * @param $data
     * @return bool
     */
    static public function bidWorkCheck($data)
    {
        if($data['status'] == 1){//验收通过
            $status = DB::transaction(function() use($data) {

                //修改稿件的状态
                self::where('id', $data['work_id'])->update(['status' => 3, 'bid_at' => date('Y-m-d H:i:s', time())]);
                //查询任务成功抽成比例
                $task = TaskModel::find($data['task_id']);
                $percent = $task->task_success_draw_ratio;
                $paySection = TaskPaySectionModel::where('task_id',$data['task_id'])
                    ->where('work_id',$data['work_id'])->first();
                //修改支付阶段状态
                $paySectionInfo = [
                    'status' => 1,//已支付
                    'verify_status' => 1,//稿件审核通过
                    'section_status' => 3,//阶段完成
                    'updated_at' => date('Y-m-d H:i:s'),
                    'pay_at' => date('Y-m-d H:i:s'),//支付时间
                ];

                TaskPaySectionModel::where('task_id',$data['task_id'])
                    ->where('work_id',$data['work_id'])
                    ->update($paySectionInfo);
                if($percent){
                    $price = $paySection['price'] -intval($paySection['price']*$percent/100);
                }else{
                    $price =  $paySection['price'];
                }
                //增加用户余额
                UserDetailModel::where('uid', $data['uid'])->increment('balance', $price);
                //产生一笔财务流水 表示接受任务产生的钱
                $finance_data = [
                    'action' => 2,
                    'pay_type' => 1,
                    'cash' => $price,
                    'uid' => $data['uid'],
                    'created_at' => date('Y-m-d H:i:s', time()),
                    'updated_at' => date('Y-m-d H:i:s', time())
                ];
                FinancialModel::create($finance_data);

                //判断是不是完成最后支付阶段
                $isFinish = TaskPaySectionModel::where('task_id',$data['task_id'])
                    ->where('section_status','<',3)->first();
                if(empty($isFinish)){
                    TaskModel::where('id',$data['task_id'])->update(['status'=>8,'comment_at'=>date('Y-m-d H:i:s',time())]);
                }

            });
            //稿件结算发送系统消息
            if(is_null($status))
            {
                //判断当前的任务是否需要发送系统消息
                $manuscript_settlement = MessageTemplateModel::where('code_name','bid_work_check_success')->where('is_open',1)->where('is_on_site',1)->first();
                if($manuscript_settlement)
                {
                    $task = TaskModel::where('id',$data['task_id'])->first();
                    $work = WorkModel::where('id',$data['work_id'])->first();
                    $user = UserModel::where('id',$work['uid'])->first();//必要条件
                    $site_name = \CommonClass::getConfig('site_name');//必要条件
                    $domain = \CommonClass::getDomain();
                    //组织好系统消息的信息
                    //发送系统消息
                    $messageVariableArr = [
                        'username'=>$user['name'],
                        'task_name'=>$task['title'],
                        'task_link'=>$domain.'/task/'.$task['id'],
                        'website'=>$site_name,
                    ];
                    $message = MessageTemplateModel::sendMessage('bid_work_check_success',$messageVariableArr);
                    $data = [
                        'message_title'=>'任务验收通知',
                        'message_content'=>$message,
                        'js_id'=>$user['id'],
                        'message_type'=>2,
                        'receive_time'=>date('Y-m-d H:i:s',time()),
                        'status'=>0,
                    ];
                    MessageReceiveModel::create($data);
                }
            }
        }else{
            $status = DB::transaction(function() use($data) {

                //修改稿件的状态
                self::where('id', $data['work_id'])->update(['status' => 5]);
                //修改支付阶段状态
                $paySectionInfo = [
                    'verify_status' => 2,//稿件审核失败
                    'section_status' => 1,//阶段进行中
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                TaskPaySectionModel::where('task_id',$data['task_id'])
                    ->where('work_id',$data['work_id'])->update($paySectionInfo);

            });
            //稿件审核失败发送系统消息
            if(is_null($status))
            {
                //判断当前的任务是否需要发送系统消息
                $manuscript_settlement = MessageTemplateModel::where('code_name','bid_work_check_failure')->where('is_open',1)->where('is_on_site',1)->first();
                if($manuscript_settlement)
                {
                    $task = TaskModel::where('id',$data['task_id'])->first();
                    $work = WorkModel::where('id',$data['work_id'])->first();
                    $user = UserModel::where('id',$work['uid'])->first();//必要条件
                    $site_name = \CommonClass::getConfig('site_name');//必要条件
                    $domain = \CommonClass::getDomain();
                    //组织好系统消息的信息
                    //发送系统消息
                    $messageVariableArr = [
                        'username'=>$user['name'],
                        'task_name'=>$task['title'],
                        'task_link'=>$domain.'/task/'.$task['id'],
                        'website'=>$site_name,
                    ];
                    $message = MessageTemplateModel::sendMessage('bid_work_check_failure',$messageVariableArr);
                    $data = [
                        'message_title'=>'任务验收通知',
                        'message_content'=>$message,
                        'js_id'=>$user['id'],
                        'message_type'=>2,
                        'receive_time'=>date('Y-m-d H:i:s',time()),
                        'status'=>0,
                    ];
                    MessageReceiveModel::create($data);
                }
            }
        }

        return is_null($status)?true:false;
    }

}
