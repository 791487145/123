<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Modules\Manage\Model\LastAndFoundImgModel;
use App\Modules\Manage\Model\LastAndFoundModel;
use App\Modules\Manage\Model\TypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Theme;

class LastAndFoundController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');

    }

    //失物招领列表
    public function lastAndFoundList(Request $request)
    {
        $this->theme->setTitle('失物招领列表');
        $lastAndFound = LastAndFoundModel::orderBy('last_and_found.id','desc');
        $re = $request->all();
        if ($request->get('class')) {//物品类型
            $lastAndFound = $lastAndFound->where('last_and_found.class', $request->get('class'));
        }
        if ($request->get('type')) {//类型
            $lastAndFound = $lastAndFound->where('last_and_found.type', $request->get('type'));
        }
        if ($request->get('status')) {//状态
            $lastAndFound = $lastAndFound->where('last_and_found.status', $request->get('status'));
        }

        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $lastAndFound = $lastAndFound->where('last_and_found.created_at','>',$start);
        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $lastAndFound = $lastAndFound->where('last_and_found.created_at','<',$end);
        }

        $goods = $lastAndFound->leftjoin('type as t','last_and_found.class','=','t.id')
                              ->select('last_and_found.*','t.name as class_name')
                              ->paginate(20);
        $data = [
            'goods' => $goods,
            'request' => $re
        ];
        $data['class'] = TypeModel::where('type','last_and_found')->get()->toArray();

        $data['type'] = [
            ['id' => "1" ,'name' => '寻物'],
            ['id' => "2" ,'name' => '招领'],
        ];
        $data['status'] = [
            ['id' => "valid" ,'name' => '寻找中'],
            ['id' => "invalid" ,'name' => '已关闭'],
        ];
        return $this->theme->scope('manage.lastAndFound', $data)->render();
    }

    //失物招领详情
    public function lastAndFoundDetail($id)
    {
        $this->theme->setTitle('失物招领详情');
        $good = LastAndFoundModel::where('last_and_found.id',$id)
                                 ->leftjoin('type as t','t.id','=','last_and_found.class')
                                 ->select('last_and_found.*','t.name as class_name')
                                 ->first()->toArray();
        $good_img = LastAndFoundImgModel::where('last_found_id',$id)->get()->toArray();
        $data = [
            'good' =>  $good,
            'good_img' =>  $good_img,
        ];
        return $this->theme->scope('manage.lastAndFoundDetail', $data)->render();
    }



}


