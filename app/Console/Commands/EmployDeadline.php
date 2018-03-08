<?php

namespace App\Console\Commands;

use App\Modules\Employ\Models\EmployModel;
use Illuminate\Console\Command;

class EmployDeadline extends Command
{
    
    protected $signature = 'EmployDeadline';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $employ_data = EmployModel::where('status',1)->where('delivery_deadline','<',date('Y-m-d H:i:s',time()))->get()->toArray();

        $employ = new EmployModel();
        
        foreach($employ_data as $v)
        {
           $employ->employDeadline($v);
        }
    }
}
