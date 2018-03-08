<?php

namespace App\Console\Commands;

use App\Modules\Employ\Models\EmployModel;
use Illuminate\Console\Command;

class EmployDelivery extends Command
{
    
    protected $signature = 'EmployDelivery';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $employ_data = EmployModel::where('status',2)->where('bounty_status',1)->where('accept_deadline','<',date('Y-m-d H:i:s',time()))->get()->toArray();
        $employ = new EmployModel();
        
        foreach($employ_data as $v)
        {
            $result = $employ->employDelivery($v);
        }
    }
}
