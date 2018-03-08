<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Modules\Bre\Model\BreRuleModel;
use App\Modules\Bre\Model\BreDecisionModel;
use App\Modules\Bre\Model\BreActionModel;
use App\Modules\Task\Model\TaskModel;

class RuleEngine
{


    
    public function handle($request, Closure $next)
    {

        

        
        $msg = '';

        
        $params = json_decode($request->get('params'), true);

        
        if (isset($params['rule_id']) && intval($params['rule_id']) > 0) {

            
            
            
            
            
            
            
            

            


            $rule_id = intval($params['rule_id']); 
            $bre_rule = BreRuleModel::find($rule_id); 

            
            if (isset($bre_rule->status) && $bre_rule->status == 1) {

                
                $bre_decision = $this->getDecisionActionInfo($rule_id);

                


                
                if (isset($params['task_id'])) {
                    
                    $task_status = 0;

                    

                    $task_id = intval($params['task_id']);
                    if ($task_id > 0) {
                        $task = TaskModel::find($task_id);
                        if (isset($task->status)) {
                            
                            $msg = 'Task status is :' . $task->status;
                        } else {
                            $msg = 'Task is not exist!';
                        }
                    } else {
                        
                        if (isset($bre_decision[0])) {

                            $class = $bre_decision[0]['class'];
                            $method = $bre_decision[0]['function'];
                            $param = empty($bre_decision[0]['params'])?'':$bre_decision[0]['params'];
                            $data = $this->operate($class, $method,[$param]);
                            dd($data);
                        } else {
                            $msg = 'Lack of decision';
                        }
                    }
                }

            } else {
                $msg = 'Rule is not exist or disabled';
            }

        } else {
            $msg = 'Lack of BRE id';
        }

        return $next($request);

    }

    
    private function getDecisionActionInfo($rule_id)
    {
        $data = BreDecisionModel::select('before_status', 'after_status', 'sort', 'action.*')
            ->leftJoin('bre_action as action', 'bre_decision.action_id', '=', 'action.id')
            ->where('rule_id', $rule_id)
            ->get()->toArray();
        return $data;
    }

    
    private function operate($class, $method, $params = array())
    {
        $stat = false;
        if (empty($class) || empty($method)) return $stat;

        if (class_exists($class)) {
            $obj = new $class();
            if (method_exists($obj, $method)) {
                $stat = call_user_func_array(array($obj, $method), $params);
            }
        }

        return $stat;

    }
}
