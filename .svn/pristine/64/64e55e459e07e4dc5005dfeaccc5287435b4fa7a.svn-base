<?php


namespace App\Modules\Bre\Http\Controllers;

use App\Http\Controllers\IndexController;
use Illuminate\Routing\Controller;
use App\Http\Requests\Request;

class TaskController extends IndexController
{

    
    public function create()
    {

        return 'create';
        $this->initTheme('manage');

        return $this->theme->scope('bre.index')->render();

    }

    
    public function taskCreate(Request $request)
    {

        $this->initTheme('manage');

        return $this->theme->scope('bre.index')->render();

    }

    
    public function taskDetail($task_id){
        $this->initTheme('manage');

        return $this->theme->scope('bre.index')->render();
    }

    
    public function bounty($task_id){
        echo $task_id;
        return $this->theme->scope('bre.bounty')->render();
    }

    
    public function bountyCreate(Request $request){
        return $this->theme->scope('bre.bounty')->render();
    }

    
    public function taskVerify(Request $request){
        return true;
    }


}