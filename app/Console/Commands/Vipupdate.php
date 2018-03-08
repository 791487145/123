<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Vipupdate extends Command
{
    
    protected $signature = 'Vipupdate';

    
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        $this->call('module:migrate vipshop');
        $this->call('module:seed vipshop');
    }
}
