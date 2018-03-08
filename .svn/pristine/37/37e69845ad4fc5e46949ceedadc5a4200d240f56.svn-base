<?php
namespace FrankRabbit\Authen\Driver;

class Driver
{

    protected $binds;

    protected $instances;

    public function bind($abstract, $concreate)
    {
        if ($concreate instanceof \Closure) {
            $this->binds[$abstract] = $concreate;
        } else {
            $this->instances[$abstract] = $concreate;
        }
    }

    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        array_unshift($parameters,$this);
        return call_user_func_array($this->binds[$abstract], $parameters);
    }

}