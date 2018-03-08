<?php

namespace App\Modules\Employ\Models;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\UserDetailModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployModel extends Model
{
    protected $table = 'employ';
    public $timestamps = false;
    protected $fillable = [
        'title', 'desc', 'phone', 'bounty', 'delivery_deadline', 'status', 'employee_uid', 'employer_uid', 'employ_percentage', 'cancel_at', 'except_max_at', 'accept_deadline', 'created_at', 'updated_at',
        'seo_keywords', 'seo_title', 'seo_content', 'accept_at', 'right_allow_at', 'employ_type'
    ];

    /**
     * @param $employee
     * @param $employer
     * @param $data
     */
    static public function employCreate($data)
    {
        $status = DB::transaction(function () use ($data) {
            //创建一条雇佣记录
            $result = self::create($data);
            //如果服务雇佣，创建一条雇佣和服务的关联关系
            if ($data['service_id'] != 0) {
                //增加服务的购买次数
                GoodsModel::where('id', $data['service_id'])->increment('sales_num', 1);
                EmployGoodsModel::create(['employ_id' => $result['id'], 'service_id' => $data['service_id'], 'created_at' => date('Y-m-d H:i:s', time())]);
            }
            //创建雇佣附件关联关系
            if (!empty($data['file_id'])) {
                //查询用户的附件记录，排除掉用户删除的附件记录
                $file_able_ids = AttachmentModel::fileAble($data['file_id']);
                $file_able_ids = array_flatten($file_able_ids);
                foreach ($file_able_ids as $v) {
                    $attachment_data[] = [
                        'object_id' => $result['id'],
                        'object_type' => 2,
                        'attachment_id' => $v,
                        'created_at' => date('Y-m-d H:i:s', time()),
                    ];
                }
                UnionAttachmentModel::insert($attachment_data);
                //修改附件的发布状态
                $attachmentModel = new AttachmentModel();
                $attachmentModel->statusChange($file_able_ids);
            }

            //增加用户被雇佣的次数
            UserDetailModel::where('id', intval($data['employee_uid']))->increment('employee_num', 1);

            return $result;
        });

        return $status;
    }

    /**
     * 雇佣托管赏金
     * @param $money
     * @param $employ_id
     * @param $uid
     * @param $code
     * @param int $type
     * @return bool
     */
    static public function employBounty($money, $employ_id, $uid, $code, $type = 1)
    {
        $status = DB::transaction(function () use ($money, $employ_id, $uid, $code, $type) {
            //扣除用户的余额
            DB::table('user_detail')->where('uid', '=', $uid)->where('balance_status', '!=', 1)->decrement('balance', $money);
            //修改任务的赏金托管状态，写入配置项
            //查询所有的雇佣相关的配置信息
            $employ_configs = ConfigModel::where('type', 'employ')->get()->toArray();
            $employ_configs = \CommonClass::keyBy($employ_configs, 'alias');
            //查询记录雇佣配置，雇佣抽成比率，取消雇佣时间
            $data['employ_percentage'] = $employ_configs['employ_percentage']['rule'];
            $data['cancel_at'] = date('Y-m-d H:i:s', time() + $employ_configs['employer_cancel_time']['rule'] * 3600);//按照小时计算
            $data['except_max_at'] = date('Y-m-d H:i:s', time() + $employ_configs['employ_except_time']['rule'] * 3600);//按照小时计算
            $data['bounty_status'] = 1;
            self::where('id', $employ_id)->update($data);

            //生成财务记录，action 1表示发布任务????
            $financial = [
                'action' => 1,
                'pay_type' => $type,
                'cash' => $money,
                'uid' => $uid,
                'created_at' => date('Y-m-d H:i:s', time())
            ];
            FinancialModel::create($financial);
            //修改订单状态????????
            ShopOrderModel::where('code', $code)->update(['status' => 1]);

            //增加用户的发布任务数量???????????????
            UserDetailModel::where('uid', $uid)->increment('publish_task_num', 1);
        });

        return is_null($status) ? true : false;
    }

    //雇佣支付回调逻辑处理
    static function employResult()
    {

    }

    /**
     * 查询任务详情
     * @param $id
     */
    static public function employDetail($id)
    {
        $query = self::select('employ.*', 'a.name as user_name')
            ->where('employ.id', '=', $id);
        //赏金已经托管
//        $query = $query->where(function ($query) {
//            $query->where('employ.bounty_status', '=', 1);
//        });
        $data = $query->leftjoin('users as a', 'a.id', '=', 'employ.employer_uid')->first();
        return $data;
    }

    /**
     * @param $type
     * @param $task_id
     * @param $user_id
     * @return bool
     */
    static public function employHandle($type, $task_id, $user_id)
    {
        $result = false;
        //判断用户是否有资格操作
        $task = self::where('id', $task_id)->where('status', 0)->first();
        if (!$task || $task['status'] != 0) {
            return $result;
        }

        if ($type == 1) {
            //判断当前用户是不是雇主
            if ($task['employer_uid'] != $user_id || date('Y-m-d H:i:s', time()) < $task['cancel_at'])
                return $result;
            //雇主取消雇佣status变成6，表示雇主取消雇佣
           $result = DB::transaction(function() use($task_id,$task){
                //修改雇佣的状态
                $result = self::where('id', $task_id)->update(['status' => 6, 'end_at' => date('Y-m-d H:i:s', time())]);
                //为用户退款
                UserDetailModel::where('uid',$task['employer_uid'])->increment(['balance'=>$task['bounty']]);
                //生成财务记录
                $financial = [
                    'action' => 7,
                    'pay_type' => 1,
                    'cash' => $task['bounty'],
                    'uid' => $task['employer_uid'],
                    'created_at' => date('Y-m-d H:i:s', time()),
                ];
                FinancialModel::create($financial);

            });
            return is_null($result)?true:false;

        } else if ($type == 2) {
            $result = self::where('id', $task_id)->where('employee_uid', $user_id)
                ->update(['status' => 1, 'begin_at' => date('Y-m-d H:i:s', time())]);
        } else if ($type == 3) {
            $result = DB::transaction(function() use($task_id,$task,$user_id){
                //修改雇佣的状态
                $result = self::where('id', $task_id)->where('employee_uid', $user_id)
                    ->update(['status' => 5, 'end_at' => date('Y-m-d H:i:s', time())]);

                //为用户退款
                UserDetailModel::where('uid',$task['employer_uid'])->increment('balance',$task['bounty']);

                //生成财务记录\
                $financial = [
                    'action' => 7,
                    'pay_type' => 1,
                    'cash' => $task['bounty'],
                    'uid' => $task['employer_uid'],
                    'created_at' => date('Y-m-d H:i:s', time()),
                ];
                FinancialModel::create($financial);

            });

            return is_null($result)?true:false;
        }
        return $result;
    }

    //验收通过稿件
    static public function acceptWork($id, $uid)
    {
        $status = DB::transaction(function () use ($id, $uid) {
            //将任务的状态改变成3
            $comment_deadline = \CommonClass::getConfig('employ_comment_time');
            if ($comment_deadline != 0) {
                $comment_deadline = time() + $comment_deadline * 24 * 3600;
            } else {
                $comment_deadline = time() + 7 * 24 * 3600;
            }

            self::where('id', $id)->update(['status' => 3, 'accept_at' => date('Y-m=d H:i:s', time()), 'comment_deadline' => date('Y-m-d H:i:s', $comment_deadline)]);
            $employ = self::where('id', $id)->first()->toArray();
            //将钱打给用户
            //扣除平台抽成比率
            $bounty = $employ['bounty'] * (1 - $employ['employ_percentage'] / 100);

            UserDetailModel::where('uid', $employ['employee_uid'])->increment('balance', $bounty);
            //产生一笔财务流水 表示接受任务产生的钱
            $finance_data = [
                'action' => 2,
                'pay_type' => 1,
                'cash' => $bounty,
                'uid' => $employ['employee_uid'],
                'created_at' => date('Y-m-d H:i:s', time())
            ];
            FinancialModel::create($finance_data);
        });
        return is_null($status) ? true : false;
    }

    /**
     * 任务过期
     * @param $employ
     * @return bool
     */
    static public function employAccept($employ)
    {
        $status = DB::transaction(function () use ($employ) {
            $time = date('Y-m-d H:i:s', time());
            //将任务的状态修改成过期状态9
            self::where('id', $employ['id'])->update(['status' => 9, 'end_at' => $time]);
            //增加用户的余额
            UserDetailModel::where('uid', $employ['employer_uid'])->increment('balance', $employ['bounty']);
            //生成财务记录
            //产生一笔财务流水 表示接受任务产生的钱
            $finance_data = [
                'action' => 7,
                'pay_type' => 1,
                'cash' => $employ['bounty'],
                'uid' => $employ['employer_uid'],
                'created_at' => $time
            ];
            FinancialModel::create($finance_data);
        });
        return is_null($status) ? true : false;
    }

    /**
     * 逾期未验收处理
     * @param $employ
     * @return bool
     */
    static public function employDelivery($employ)
    {
        $status = DB::transaction(function () use ($employ) {
            $time = date('Y-m-d H:i:s', time());
            //将任务的状态修改成已完成
            self::where('id', $employ['id'])->update(['status' => 4, 'end_at' => $time]);
            //修改稿件状态
            EmployWorkModel::where('employ_id', $employ['id'])->update(['status' => 1]);
            //增加用户的余额
            UserDetailModel::where('uid', $employ['employee_uid'])->increment('balance', $employ['bounty']);
            //产生一笔财务流水 表示接受任务产生的钱
            $finance_data = [
                'action' => 2,
                'pay_type' => 1,
                'cash' => $employ['bounty'],
                'uid' => $employ['employee_uid'],
                'created_at' => $time
            ];
            FinancialModel::create($finance_data);
        });
        return is_null($status) ? true : false;
    }

    /**
     * 威客逾期未交稿
     * @param $employ
     */
    static public function employDeadline($employ)
    {
        $status = DB::transaction(function () use ($employ) {
            $time = date('Y-m-d H:i:s', time());
            self::where('id', $employ['id'])->update(['status' => 9, 'end_at' => $time]);

            //增加用户的余额
            UserDetailModel::where('uid', $employ['employer_uid'])->increment('balance', $employ['bounty']);
            //产生一笔财务流水 表示接受任务产生的钱
            $finance_data = [
                'action' => 7,
                'pay_type' => 1,
                'cash' => $employ['bounty'],
                'uid' => $employ['employer_uid'],
                'created_at' => $time
            ];
            FinancialModel::create($finance_data);
        });

        return is_null($status) ? true : false;
    }

    /**
     * 系统自动创建评价
     * @param $employ
     */
    static public function employComment($employ)
    {
        $status = DB::transaction(function () use ($employ) {
            //修改当前任务的状态为4已完成状态
            self::where('id', $employ['id'])->where('status', 3)->update(['status' => 4, 'end_at' => date('Y-m-d H:i:s', time())]);

            //判断雇主是否评价
            $result = EmployCommentsModel::where('employ_id', $employ['id'])->where('comment_by', 1)->first();
            if (!$result) {
                $employ_comment = [
                    'employ_id' => $employ['id'],
                    'from_uid' => $employ['employer_uid'],
                    'to_uid' => $employ['employee_uid'],
                    'comment_by' => 3,
                    'speed_score' => 5,
                    'quality_score' => 5,
                    'attitude_score' => 5,
                    'type' => 1,
                    'created_at' => date('Y-m-d H:i:s', time()),
                ];
                EmployCommentsModel::create($employ_comment);
            }
            //判断威客是否评价
            $result2 = EmployCommentsModel::where('employ_id', $employ['id'])->where('comment_by', 0)->first();
            if (!$result2) {
                $employ_comment = [
                    'employ_id' => $employ['id'],
                    'from_uid' => $employ['employee_uid'],
                    'to_uid' => $employ['employer_uid'],
                    'comment_by' => 3,
                    'speed_score' => 5,
                    'quality_score' => 5,
                    'attitude_score' => 0,
                    'type' => 1,
                    'created_at' => date('Y-m-d H:i:s', time()),
                ];
                EmployCommentsModel::create($employ_comment);
            }
        });
    }

    /**
     * 查询我购买的服务
     * @param $uid
     * @param $data
     * @return mixed
     */
    static public function employMine($uid, $data,$paginate=5)
    {
        $employ = self::select('employ.*', 'us.name as user_name', 'ud.avatar')->where('employer_uid', $uid)->where('bounty_status', 1);

        if (isset($data['employ_type']) && $data['employ_type'] != 'all') {
            $employ = $employ->where('employ.employ_type', $data['employ_type']);
        }
        if (isset($data['time']) && $data['time'] != 'all') {
            $time = date('Y-m-d H:i:s', strtotime("-" . intval($data['time']) . " month"));
            $employ = $employ->where('employ.created_at', '>', $time);
        }
        if (isset($data['status']) && $data['status'] != 'all') {
            $status = explode(',', $data['status']);
            $employ = $employ->whereIn('employ.status', $status);
        }
        $employ = $employ->leftjoin('users as us', 'us.id', '=', 'employ.employee_uid')
            ->leftjoin('user_detail as ud', 'ud.uid', '=', 'employ.employee_uid')
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);

        return $employ;
    }

    /**
     * 查询我承接的服务
     * @param $uid
     * @param $data
     * @return mixed
     */
    static public function employMyJob($uid, $data,$paginate=5)
    {
        $employ = self::select('employ.*', 'us.name as user_name', 'ud.avatar')->where('employee_uid', $uid)->where('bounty_status', 1);

        if (isset($data['employ_type']) && $data['employ_type'] != 'all') {
            $employ = $employ->where('employ.employ_type', $data['employ_type']);
        }
        if (isset($data['time']) && $data['time'] != 'all') {
            $time = date('Y-m-d H:i:s', strtotime("-" . intval($data['time']) . " month"));
            $employ = $employ->where('employ.created_at', '>', $time);
        }
        if (isset($data['status']) && $data['status'] != 'all') {
            $status = explode(',', $data['status']);
            $employ = $employ->whereIn('employ.status', $status);
        }

        $employ = $employ->leftjoin('users as us', 'us.id', '=', 'employ.employer_uid')
            ->leftjoin('user_detail as ud', 'ud.uid', '=', 'employ.employer_uid')
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);

        return $employ;
    }
}
