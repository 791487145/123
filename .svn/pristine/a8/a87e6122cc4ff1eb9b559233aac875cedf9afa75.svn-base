<?php

namespace App\Console\Commands;

use App\Modules\Employ\Models\EmployModel;
use Illuminate\Console\Command;

class EmployComment extends Command
{
    
    protected $signature = 'EmployComment';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $employ_data = EmployModel::where('status',3)->where('comment_deadline','<',date('Y-m-d H:i:s',time()))->get();
        
        foreach($employ_data as $v)
        {
            EmployModel::employComment($v);
        }
    }
}
