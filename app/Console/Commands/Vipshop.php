<?php

namespace App\Console\Commands;

use App\Modules\Shop\Models\ShopModel;
use App\Modules\Vipshop\Models\ShopPackageModel;
use Illuminate\Console\Command;

class Vipshop extends Command
{
    
    protected $signature = 'vipshop';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $now = date('Y-m-d H:i:s', time());

        ShopPackageModel::where('end_time','<',$now)->update(['status' => 1]);
    }
}
