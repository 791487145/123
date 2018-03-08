<?php

namespace App\Console\Commands;

use App\Modules\Employ\Models\EmployModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EmployAccept extends Command
{
    
    protected $signature = 'EmployAccept';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        $employ_except_time = \CommonClass::getConfig('employ_except_time');
        if($employ_except_time>0){
            $employ_data = EmployModel::where('status',0)->where('bounty_status',1)->where('except_max_at','<',date('Y-m-d H:i:s',time()));
            $employ_data = $employ_data->where(function($employ_data){
                $employ_data->orWhere('delivery_deadline','<',date('Y-m-d H:i:s',time()));
            });
            $employ_data = $employ_data->get()->toArray();
            $employ = new EmployModel();
            foreach($employ_data as $k=>$v)
            {
                $result = $employ->employAccept($v);
            }
        }

    }
}
