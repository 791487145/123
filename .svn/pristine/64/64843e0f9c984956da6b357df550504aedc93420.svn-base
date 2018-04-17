<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Modules\Manage\Model\AppNavigationModel;
use App\Http\Controllers\ManageController;
use App\Modules\Task\Model\TaskExtraModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Theme;
use Illuminate\Support\Facades\Redis;
use Log;

class AppController extends ManageController
{
    protected $page = 20;   //分页信息

    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        //$this->theme->setTitle('参赛详情');
        //$this->theme->set('manageType', 'task');
    }

    public function navigationList(Request $request)
    {
        $app_navigations = AppNavigationModel::where('status',AppNavigationModel::STATUS_NORMAL)->orderBy('sort','asc')->paginate($this->page);

       $data = array(
           'app_navigations' => $app_navigations
       );

       return $this->theme->scope('manage.appnavigationList', $data)->render();
    }

    public function navigationAdd(Request $request)
    {
        if($request->isMethod("post")){
            $data = $request->except('_token');
            AppNavigationModel::insert($data);
            return  redirect('manage/appSetting');
        }

        return $this->theme->scope('manage.appnavigationAdd')->render();
    }

    public function navigationEdit($id,Request $request)
    {
        $app_navigation = AppNavigationModel::where('id',$id)->select('name','sort','url')->first();

        if($request->isMethod("post")){
            $data = $request->except('_token');
            $app_navigation = $app_navigation->toArray();
            $navigation = array_diff($data,$app_navigation);
            if(!empty($navigation)){
                AppNavigationModel::where('id',$id)->update($navigation);
            }

            return  redirect('/manage/appSetting');
        }

        $data = array(
            'app_navigation' => $app_navigation
        );

        return $this->theme->scope('manage.appnavigationEdit',$data)->render();
    }

    public function navigationDel(Request $request)
    {
        $id = $request->input('id');
        AppNavigationModel::where('id',$id)->update(['status' => -1]);

        return $id;
    }
}
