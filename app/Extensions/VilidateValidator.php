<?php

namespace app\Extensions;

use Illuminate\Validation\Validator;



class VilidateValidator extends Validator
{
    

    public function validateMobilePhone($attribute, $value ,$parameters)
    {
        return preg_match('/^(13[0-9]|15[012356789]|17[0678]|18[0-9]|14[57])[0-9]{8}$/', $value);
    }
    
    public function validateStrLength($attribute,$value,$parameters)
    {
        if(strlen($value)>$parameters[0])
        {
            return false;
        }
        return true;
    }
    
    public function validatePositive($attribute,$value,$parameters)
    {
        return preg_match('/^[1-9]\d*$/',$value);
    }
    
    public function validateDecimal($attribute,$value,$parameters)
    {
        return preg_match('/^[0-9]+(.[0-9]{1,2})?$/',$value);
    }
    

    public function validatePrice($attribute, $value ,$parameters)
    {
        return preg_match('/^\\d+$/', $value);
    }
    
    public function validateBountyMin($attribute,$value,$parameters)
    {
        $task_bounty_min_limit = \CommonClass::getConfig('task_bounty_min_limit');
        if($value< $task_bounty_min_limit)
        {
            return false;
        }
        return true;
    }

    public function validateBountyMax($attribute,$value,$parameters)
    {
        $task_bounty_max_limit = \CommonClass::getConfig('task_bounty_max_limit');
        if(intval($value)>$parameters &&  $task_bounty_max_limit!=0)
        {
            return false;
        }
        return true;
    }

    
    public function validateBeginAt($attribute,$value,$parameters)
    {
        if(strtotime(preg_replace('/([\x80-\xff]*)/i', '', $value))>=strtotime(date('Y-m-d',time())))
        {
            return true;
        }

        return false;
    }

    
    public function validateDeliveryDeadline($attribute,$value,$parameters)
    {
        $bounty = json_decode($parameters[0],true);
        $begin_at = json_decode($parameters[1],true);
        
        $task_delivery_limit_time = \CommonClass::getConfig('task_delivery_limit_time');
        $task_delivery_limit_time = json_decode($task_delivery_limit_time, true);
        $task_delivery_limit_time_key = array_keys($task_delivery_limit_time);
        $task_delivery_limit_time_key = \CommonClass::get_rand($task_delivery_limit_time_key, $bounty['bountyxuanshang']);

        if(in_array($task_delivery_limit_time_key,array_keys($task_delivery_limit_time))){
            $task_delivery_limit_time = $task_delivery_limit_time[$task_delivery_limit_time_key];
        }else{
            $task_delivery_limit_time = 100;
        }

        
        
        $delivery_deadline = strtotime(preg_replace('/([\x80-\xff]*)/i', '', $value));
        $task_delivery_limit_time = $task_delivery_limit_time * 24 * 3600;
        $begin_at = strtotime(preg_replace('/([\x80-\xff]*)/i', '', $begin_at['begin_atxuanshang']));
        
        if ($begin_at > $delivery_deadline) {
            return false;
        }
        if (($begin_at + $task_delivery_limit_time) < $delivery_deadline) {
            return false;
        }
        return true;
    }

    
    public function validateStrLengthBetween($attribute,$value,$parameters)
    {
        $str_length = mb_strlen($value);
        if($str_length<$parameters[0] || $str_length>$parameters[1])
        {
            return false;
        }

        return true;
    }

    
    public function validateDeadline($attribute,$value,$parameters)
    {
        $value_time = strtotime(preg_replace('/([\x80-\xff]*)/i', '', $value));
        $parameters_time = strtotime(date('Y-m-d',$parameters[0]));
        if($parameters_time>=$value_time)
        {
            return false;
        }
        return true;
    }

    
    public function validateDeliveryDeadlineBid($attribute,$value,$parameters)
    {
        $begin_at = json_decode($parameters[0],true);
        
        $task_delivery_limit_time = \CommonClass::getConfig('bid_delivery_max');
        
        $delivery_deadline = strtotime(preg_replace('/([\x80-\xff]*)/i', '', $value));
        $task_delivery_limit_time = $task_delivery_limit_time * 24 * 3600;
        $begin_at = strtotime(preg_replace('/([\x80-\xff]*)/i', '', $begin_at['begin_atzhaobiao']));
        
        if ($begin_at > $delivery_deadline) {
            return false;
        }
        if (($begin_at + $task_delivery_limit_time) < $delivery_deadline) {
            return false;
        }
        return true;
    }
}
