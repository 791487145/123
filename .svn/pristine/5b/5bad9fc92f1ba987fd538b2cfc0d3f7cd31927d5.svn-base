<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\BasicController;

use App\Http\Controllers\ManageController;
use App\Modules\Manage\Http\Requests\BaseConfigRequest;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Task\Model\TaskTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Theme;

class TaskConfigController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('任务配置');
        $this->theme->set('manageType', 'taskConfig');
    }

    
    public function index($id)
    {
        $configs = ConfigModel::where('type','task')->get()->toArray();
        $configs_data = array();
        foreach($configs as $k=>$v)
        {
            $configs_data[$v['alias']] = $v;
        }
        $model_data = TaskTypeModel::where('name','悬赏模式')->first();
        $all_model = TaskTypeModel::all();
        
        $data = [
            'config'=>$configs_data,
            'model_data'=>$model_data,
            'all_model'=>$all_model,
            'id'=>$id
        ];

        return $this->theme->scope('manage.taskconfig', $data)->render();
    }

    
    public function update(Request $request)
    {
        $data = $request->except('_token');

        if(!empty($data['change_ids']))
        {
            $change_ids = explode(',',$data['change_ids']);
            foreach($change_ids as $v){
                $result = ConfigModel::where('id',$v)->update(['rule'=>$data[$v]]);
                if(!$result)
                    return redirect()->back()->with(['error'=>'修改失败！']);
            }
        }

        
        if(isset($data['money'])){
            $task_delivery_limit_time = array();
            foreach($data['money'] as $k=>$v){
                $task_delivery_limit_time[$v] = $data['day'][$k];
            }
            ConfigModel::where('alias','task_delivery_limit_time')->update(['rule'=>json_encode($task_delivery_limit_time)]);
        }else{
            ConfigModel::where('alias','task_delivery_limit_time')->update(['rule'=>'']);
        }


        return redirect()->back()->with(['massage'=>'修改成功！']);
    }

    
    public function ajaxUpdateSys()
    {
        $status = ConfigModel::where('alias','task_sys_help_switch')->first();

        if($status['rule'] == 0){
            $result = ConfigModel::where('alias','task_sys_help_switch')->update(['rule'=>1]);
        }else{
            $result = ConfigModel::where('alias','task_sys_help_switch')->update(['rule'=>0]);
        }
        if(!$result)
            return response()->json(['error'=>'修改失败！']);

        return response()->json(['massage'=>'修改成功！']);
    }

    
    public function baseConfig(BaseConfigRequest $request)
    {
        $data = $request->except('_token');
        dd($data);
    }
}
