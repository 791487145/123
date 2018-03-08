<?php

namespace App\Console\Commands;

use App\Modules\Employ\Models\EmployModel;
use App\Modules\Finance\Model\FinancialModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Test extends Command
{
    
    protected $signature = 'Test';

    
    protected $description = 'Command Test';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        $param = [
            'action' => 7,
            'pay_type' => 1,
            'pay_account' => 45,
            'pay_code' => 45,
            'cash' => 4,
            'uid' => 4
        ];
        FinancialModel::createOne($param);

    }
}
