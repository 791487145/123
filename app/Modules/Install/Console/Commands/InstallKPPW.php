<?php

namespace App\Modules\Install\Console\Commands;

use Illuminate\Console\Command;

class InstallKPPW extends Command
{
    
    protected $signature = 'install:kppw {--data=true}';

    
    protected $description = 'Install KPPW';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        
        $boolData = $this->option('data');

        $this->call('migrate', [
            '--force' => true
        ]);

        $this->call('db:seed');

        if (!empty($boolData)){
            $seedListClass = [
                'Article', 'Task', 'Link', 'Users', 'UserDetail', 'SuccessCase'
            ];
            foreach ($seedListClass as $class){
                $this->call('db:seed', [
                    '--class' => $class . 'TableSeeder'
                ]);
            }
        }

    }
}
