<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\ManageController;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\ManagerModel;
use App\Modules\Manage\Permission;
use App\Modules\Manage\Role;
use App\Modules\Task\Model\TaskModel;
use App\Modules\User\Model\UserModel;
use Theme;
use Session;
class IndexController extends ManageController
{
    public function __construct()
    {
        if(Session::get('manager') == null){
            echo "<script>window.location.href='http://test.zfy0351.cn/manage/login'</script>";
        }
        parent::__construct();
        $this->initTheme('manage');
        $this->theme->setTitle('后台管理');
    }
    
    public function getManage()
    {
        $now = strtotime(date('Y-m-d', time()));
        $today = date('Y-m-d H:i:s', $now);
        $tomorrow = date('Y-m-d H:i:s', strtotime('+1 day', $now));
        $yesterday = date('Y-m-d H:i:s', strtotime('-1 day', $now));

        
        $userTotal = UserModel::all()->count();
        $todayUser = UserModel::where('created_at', '>', $today)->where('created_at', '<', $tomorrow)->count();
        $yesterdayUser = UserModel::where('created_at', '>', $yesterday)->where('created_at', '<', $today)->count();
        if ($yesterdayUser) {
            $userScale = ($todayUser - $yesterdayUser) / $yesterdayUser * 100;
        } else {
            $userScale = $todayUser * 100;
        }
        $userScale = number_format($userScale, 2);
        
        $todayTask = TaskModel::where('created_at', '>', $today)->where('created_at', '<', $tomorrow)->count();
        $yesterdayTask = TaskModel::where('created_at', '>', $yesterday)->where('created_at', '<', $today)->count();
        if ($yesterdayTask) {
            $taskScale = ($todayTask - $yesterdayTask) / $yesterdayTask * 100;
        } else {
            $taskScale = $todayTask * 100;
        }
        $taskScale = number_format($taskScale, 2);
        
        $todayRecharge = FinancialModel::where('pay_type', 3)->where('created_at', '>', $today)->where('created_at', '<', $tomorrow)->sum('cash');
        $yesterdayRecharge = FinancialModel::where('pay_type', 3)->where('created_at', '>', $yesterday)->where('created_at', '<', $today)->sum('cash');
        if ($yesterdayRecharge) {
            $rechargeScale = ($todayRecharge - $yesterdayRecharge) / $yesterdayRecharge * 100;
        } else {
            $rechargeScale = $todayRecharge * 100;
        }
        $rechargeScale = number_format($rechargeScale, 2);
        
        $todayCashout = FinancialModel::where('pay_type', 4)->where('created_at', '>', $today)->where('created_at', '<', $tomorrow)->sum('cash');
        $yesterdayCashout = FinancialModel::where('pay_type', 4)->where('created_at', '>', $yesterday)->where('created_at', '<', $today)->sum('cash');
        if ($yesterdayCashout) {
            $cashoutScale = ($todayCashout - $yesterdayCashout) / $yesterdayCashout * 100;
        } else {
            $cashoutScale = $todayCashout * 100;
        }
        $cashoutScale = number_format($cashoutScale, 2);
        
        $taskCount = TaskModel::all()->count();
        $successTaskCount = TaskModel::where('status', 9)->count();
        $failTaskCount = TaskModel::where('status', 10)->count();
        $doingTaskCount = TaskModel::where('status', '>', 2)->where('status', '<', 9)->count();

        $maxDay = 10;
        $oneDay = 24 * 60 * 60;
        for ($i = 0; $i < $maxDay; $i++) {
            $timeArr[$i]['min'] = date('Y-m-d H:i:s', ($now - $oneDay * ($i + 1)));
            $timeArr[$i]['max'] = date('Y-m-d H:i:s', ($now - $oneDay * $i));
        }
        
        $timeArr = array_reverse($timeArr);
        foreach ($timeArr as $k => $v){
            $dateArr[] = date('m', strtotime($timeArr[$k]['min'])) . '月' . date('d', strtotime($timeArr[$k]['min'])) . '日';
        }

        $arr = array();
        $task = TaskModel::where('created_at', '>', $timeArr[0]['min'])->where('created_at', '<', $timeArr[$maxDay - 1]['max'])->get();
        if ($task->count()){
            foreach ($task as $item){
                switch ($item->status){
                    case 9:
                        for ($i = 0; $i < $maxDay; $i++) {
                            if ($item->created_at > $timeArr[$i]['min'] && $item->created_at < $timeArr[$i]['max']) {
                                $arr['successTask'][$i][] = 1;
                            }
                        }
                        break;
                    case 10:
                        for ($i = 0; $i < $maxDay; $i++) {
                            if ($item->created_at > $timeArr[$i]['min'] && $item->created_at < $timeArr[$i]['max']) {
                                $arr['failTask'][$i][] = 1;
                            }
                        }
                        break;
                }
            }
        } else {
            for ($i = 0; $i < $maxDay; $i++){
                $arr['successTask'][$i] = 0;
                $arr['failTask'][$i] = 0;
            }
        }

        
        $user = UserModel::where('created_at', '>', $timeArr[0]['min'])->where('created_at', '<', $timeArr[$maxDay - 1]['max'])->get();
        if ($user->count()){
            foreach ($user as $item){
                for ($i = 0; $i < $maxDay; $i++) {
                    if ($item->created_at > $timeArr[$i]['min'] && $item->created_at < $timeArr[$i]['max']) {
                        $arr['user'][$i][] = 1;
                    }
                }
            }
        } else {
            for ($i = 0; $i < $maxDay; $i++){
                $arr['user'][$i] = 0;
            }
        }

        
        $arrFinance = FinancialModel::select('action', 'cash', 'created_at')
            ->where('created_at', '>', $timeArr[0]['min'])->where('created_at', '<', $timeArr[$maxDay - 1]['max'])->get();
        
        if (!empty($arrFinance)){
            foreach ($arrFinance as $item) {
                switch ($item->action) {
                    case 3:
                        for ($i = 0; $i < $maxDay; $i++){
                            if ($item->created_at > $timeArr[$i]['min'] && $item->created_at < $timeArr[$i]['max']) {
                                $arr['in'][$i][] = $item->cash;
                            }
                        }
                    break;
                    case 4:
                        for ($i = 0; $i < $maxDay; $i++){
                            if ($item->created_at > $timeArr[$i]['min'] && $item->created_at < $timeArr[$i]['max']) {
                                $arr['out'][$i][] = $item->cash;
                            }
                        }
                    break;
                }
            }
        } else {
            for ($i = 0; $i < $maxDay; $i++){
                $arr['in'][$i] = 0;
                $arr['out'][$i] = 0;
            }
        }
        
        $rechargeTotal = FinancialModel::where('action', 3)->sum('cash');
        $cashoutTotal = FinancialModel::where('action', 4)->sum('cash');

        
        if (!empty($arr)){
            if (!empty($arr['successTask'])){
                for ($i = 0; $i < $maxDay; $i++){
                    if (isset($arr['successTask'][$i]) && is_array($arr['successTask'][$i])){
                        $arr['successTask'][$i] = array_sum($arr['successTask'][$i]);
                    } else {
                        $arr['successTask'][$i] = 0;
                    }
                }
            } else {
                for ($i = 0; $i < $maxDay; $i++){
                    $arr['successTask'][$i] = 0;
                }
            }
            if (!empty($arr['failTask'])){
                for ($i = 0; $i < $maxDay; $i++){
                    if (isset($arr['failTask'][$i]) && is_array($arr['failTask'][$i])){
                        $arr['failTask'][$i] = array_sum($arr['failTask'][$i]);
                    } else {
                        $arr['failTask'][$i] = 0;
                    }
                }
            } else {
                for ($i = 0; $i < $maxDay; $i++){
                    $arr['failTask'][$i] = 0;
                }
            }
            if (!empty($arr['user'])){
                for ($i = 0; $i < $maxDay; $i++){
                    if (isset($arr['user'][$i]) && is_array($arr['user'][$i])){
                        $arr['user'][$i] = array_sum($arr['user'][$i]);
                    } else {
                        $arr['user'][$i] = 0;
                    }
                }
            } else {
                for ($i = 0; $i < $maxDay; $i++){
                    $arr['user'][$i] = 0;
                }
            }
            if (!empty($arr['in'])){
                for ($i = 0; $i < $maxDay; $i++){
                    if (isset($arr['in'][$i]) && is_array($arr['in'][$i])){
                        $arr['in'][$i] = array_sum($arr['in'][$i]);
                    } else {
                        $arr['in'][$i] = 0;
                    }
                }
            } else {
                for ($i = 0; $i < $maxDay; $i++){
                    $arr['in'][$i] = 0;
                }
            }
            if (!empty($arr['out'])){
                for ($i = 0; $i < $maxDay; $i++){
                    if (isset($arr['out'][$i]) && is_array($arr['out'][$i])){
                        $arr['out'][$i] = array_sum($arr['out'][$i]);
                    } else {
                        $arr['out'][$i] = 0;
                    }
                }
            } else {
                for ($i = 0; $i < $maxDay; $i++){
                    $arr['out'][$i] = 0;
                }
            }
        } else {
            for ($i = 0; $i < $maxDay; $i++){
                $arr['successTask'][$i] = 0;
                $arr['failTask'][$i] = 0;
                $arr['user'][$i] = 0;
                $arr['in'][$i] = 0;
                $arr['out'][$i] = 0;
            }
        }

        
        $recentlyTask = TaskModel::select('title', 'bounty', 'status')->orderBy('created_at', 'desc')->take(5)->get();
        $recentlyFinance = FinancialModel::select('financial.action', 'financial.cash', 'financial.pay_type', 'users.name')
            ->leftJoin('users', 'financial.uid', '=', 'users.id')->orderBy('financial.created_at', 'desc')
            ->take(5)->get();

        
        $topCount = [
            'userTotal' => $userTotal,
            'todayUser' => $todayUser,
            'userScale' => $userScale,
            'todayTask' => $todayTask,
            'taskScale' => $taskScale,
            'todayRecharge' => $todayRecharge,
            'rechargeScale' => $rechargeScale,
            'todayCashout' => $todayCashout,
            'cashoutScale' => $cashoutScale,

            'taskCount' => $taskCount,
            'successTaskCount' => $successTaskCount,
            'failTaskCount' => $failTaskCount,
            'doingTaskCount' => $doingTaskCount,

            'rechargeTotal' => $rechargeTotal,
            'cashoutTotal' => $cashoutTotal,

            'recentlyTask' => $recentlyTask,
            'recentlyFinance' => $recentlyFinance,
        ];

        $broken = [
            'task' => [
                'successTask' => $arr['successTask'],
                'failTask' => $arr['failTask']
            ],
            'user' => $arr['user'],
            'finance' => [
                'in' => $arr['in'],
                'out' => $arr['out']
            ]
        ];
        $data = [
            'maxDay' => json_encode($maxDay),
            'topCount' => $topCount,
            'broken' => json_encode($broken),
            'dateArr' => json_encode($dateArr)
        ];
        return $this->theme->scope('manage.index', $data)->render();
    }

}
