<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use File;

class UpdateKPPW extends Command
{
    
    protected $signature = 'update:kppw';

    
    protected $description = 'this is kppw update engine';

    
    protected $updatePath;
    
    protected $updateTime;
    
    protected $migrationPath;
    
    protected $seederPath;

    
    public function __construct()
    {
        parent::__construct();
		
		$this->updateTime = config('kppw.kppw_update_time');

        $this->updatePath = base_path('update');

        $this->seederPath = database_path('seeds/' . $this->updateTime);

        $this->migrationPath = 'database/migrations/' . $this->updateTime;


    }

    
    public function handle()
    {

        $start = $this->confirm('Please back up the database and the program before you upgrade!!!');

        if ($start){

            $status = File::copyDirectory($this->updatePath, base_path());


            if ($status){

                
                $dirList = File::directories(database_path('migrations'));
                $dirName = [];
                if(!empty($dirList) && is_array($dirList)){
                    foreach ($dirList as $dirNameV){
                        $dirName[] = basename($dirNameV);
                    }
                }

                
                $dirSeedList = File::directories(database_path('seeds'));
                $dirSeedName = [];
                if(!empty($dirSeedList) && is_array($dirSeedList)){
                    foreach ($dirSeedList as $dirNameS){
                        $dirSeedName[] = basename($dirNameS);
                    }
                }

                
                $dataArr = array_unique(array_merge($dirName,$dirSeedName));
                if(!empty($dataArr)){
                    $maxDateKey = array_search(max($dataArr),$dataArr);
                    $maxDate = $dataArr[$maxDateKey];
                }else{
                    $maxDate = '';
                }


                if(!empty($dirName)){
                    foreach($dirName as $itemDir){
                        if($itemDir <= $this->updateTime){
                            
                            File::deleteDirectory(database_path('migrations').'/'.$itemDir);
                        }else{
                            
                            $this->call('migrate', [
                                '--path' => database_path('migrations').'/'.$itemDir
                            ]);
                        }
                    }
                }
                $now = date('Ymd',time());
                $seedsDirPath = database_path('seeds').'/'.$now;
                if(!File::exists($seedsDirPath)){
                    File::makeDirectory($seedsDirPath);
                }

                if(!empty($dirSeedName)){

                    foreach($dirSeedName as $itemSeedDir){
                        if($itemSeedDir <= $this->updateTime){
                            
                            File::deleteDirectory(database_path('seeds').'/'.$itemSeedDir);
                        }else{
                            
                            File::copyDirectory(database_path('seeds').'/'.$itemSeedDir, $seedsDirPath);
                            if($itemSeedDir != $now){
                                File::deleteDirectory(database_path('seeds').'/'.$itemSeedDir);
                            }
                        }
                    }

                    
                    $files = File::files($seedsDirPath);
                    if(!empty($files)){
                        foreach ($files as $file){
                            $filename[] = basename($file, '.' . File::extension($file));
                        }
                        if(!empty($filename)){
                            foreach ($filename as $seed){
                                Artisan::call('db:seed', [
                                    '--class' => $seed
                                ]);
                            }
                        }
                        
                        File::deleteDirectory($seedsDirPath);
                    }


                }

                $oldVersion = config('kppw.kppw_version');
                $newVersion = '3.2';
                if(!empty($maxDate) && $this->updateTime < $maxDate){
                    
                    $kppwFile = File::get(config_path().'/kppw.php');

                    $strSearch = "'kppw_update_time' => '".$this->updateTime."',";
                    $strReplace = "'kppw_update_time' => '".$maxDate."',";

                    $newKppw = str_replace($strSearch,$strReplace,$kppwFile);

                    File::put(config_path().'/kppw.php',$newKppw);
                }
                if($oldVersion != $newVersion){
                    
                    $kppwFile = File::get(config_path().'/kppw.php');

                    $strOldVersion = "'kppw_version' => env('KPPW_VERSION', '".$oldVersion."'),";
                    $strNewVersion = "'kppw_version' => env('KPPW_VERSION', '3.2'),";
                    $newKppw = str_replace($strOldVersion,$strNewVersion,$kppwFile);
                    File::put(config_path().'/kppw.php',$newKppw);
                }


                
                File::deleteDirectory($this->updatePath);
            }
			$this->info('update success');
        }

        
    }
}
