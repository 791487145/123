<?php

namespace App\Modules\Advertisement\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Modules\Advertisement\Model\AdTargetModel;
use App\Modules\Advertisement\Model\AdModel;
use Illuminate\Http\Request;
use Theme;

class AdTargetController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->theme->setTitle('广告管理');
        $this->initTheme('manage');
    }

   

    public function index()
    {
        $adTargetList = AdTargetModel::paginate(10);
        foreach($adTargetList->items() as $k=>$v){
            $deliveryNum = AdModel::where('target_id',$v->target_id)
                ->where('is_open','1')
                ->where(function($deliveryNum){
                    $deliveryNum->where('end_time','0000-00-00 00:00:00')
                        ->orWhere('end_time','>',date('Y-m-d h:i:s',time()));
                })
                ->count();
            if($deliveryNum){
                $v->deliveryNum = $deliveryNum;
            }
            else{
                $v->deliveryNum = 0;
            }
        }
        $view = [
            'adTargetList' => $adTargetList
        ];
        $this->theme->setTitle('广告管理');
        return $this->theme->scope('manage.adtargetlist',$view)->render();
    }

    
    public function adListById(Request $request,$target_id){
        $where = '1 = 1';

        if ($request->get('ad_name')) {
            $where .= " and ad_name like '%" . $request->get('ad_name'). "%'";
        }
        if($request->get('target_id') !== null){
            if($request->get('target_id') != 0){
                $where .= " and target_id =" . $request->get('target_id');
            }
        }
        else{
            $where .= " and target_id =" . $target_id;
        }


        if($request->get('is_open') != 0){
            $where .= " and is_open =" . $request->get('is_open');
        }
        $where .= " and is_open != 3";
        $by = $request->get('by') ? $request->get('by') : 'id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 10;

        $adList = AdModel::whereRaw($where)->orderBy($by, $order)->paginate($paginate);
        if($adList->total()){
            foreach($adList->items() as $k=>$v){
                $adTarget = AdTargetModel::where('target_id',$v->target_id)->select('name')->get();
                $v->name = $adTarget[0]['name'];
            }
        }
        $adTargetInfo = AdTargetModel::select('target_id','name')->get();

        $view = array(
            'adList' => $adList,
            'ad_target_id' => $target_id,
            'ad_name' => $request->get('ad_name'),
            'target_id' => $request->get('target_id'),
            'is_open' => $request->get('is_open'),
            'by' => $request->get('by'),
            'order' => $request->get('order'),
            'paginate' => $request->get('paginate'),
            'adTargetInfo' => $adTargetInfo
        );

        return $this->theme->scope('manage.adlistById', $view)->render();
    }


}
