<?php


namespace App\Modules\Bre\Http\Controllers;

use App\Modules\Manage\Model\FeedbackModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Model\TagsModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use App\Modules\User\Model\UserTagsModel;
use Illuminate\Http\Request;
use App\Modules\Advertisement\Model\AdTargetModel;
use App\Modules\Advertisement\Model\AdModel;
use Auth;
use Validator;
use App\Modules\Advertisement\Model\RePositionModel;
use App\Modules\Advertisement\Model\RecommendModel;
use App\Modules\User\Model\AuthRecordModel;
use App\Modules\User\Model\CommentModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\User\Model\RealnameAuthModel;
use App\Modules\User\Model\DistrictModel;
use Cache;

class IndexController extends \App\Http\Controllers\IndexController
{

    public function __construct()
    {
        parent::__construct();
        $this->initTheme('main');
    }


    public function index()
    {
        $view =[];
        $adTargetID = AdTargetModel::where('code','HOME_TOP_SLIDE')->select('target_id')->first();
        if($adTargetID['target_id']){
            $adPicInfo = AdModel::where('target_id',$adTargetID['target_id'])->select('ad_file','ad_url')->get();
            if(count($adPicInfo)){
               $view['adPicInfo'] = $adPicInfo;
            }else{
                $view['adPicInfo'] = [];
            }
        }
        $adTarget = AdTargetModel::where('code','HOME_BOTTOM')->select('target_id')->first();
        if($adTarget['target_id']){
            $buttomPicInfo = AdModel::where('target_id',$adTarget['target_id'])->select('ad_file','ad_url')->get();
            if(count($adPicInfo)){
                $view['buttomPicInfo'] = $buttomPicInfo;
            }else{
                $view['buttomPicInfo'] = [];
            }
        }
        $useDetail = [];
        $user = Auth::User();
        if($user){
            $useDetail = UserDetailModel::where('uid',$user->id)->select('uid','mobile')->first();
        }
        $view['useDetail'] = $useDetail;
        return $this->theme->scope('bre.index',$view)->render();
    }

    public function breDetail($id)
    {
        echo $id;
        return $this->theme->scope('bre.index')->render();
    }

    
    public function getService(Request $request)
    {
        
        $seoConfig = ConfigModel::getConfigByType('seo');
        if(!empty($seoConfig['seo_service']) && is_array($seoConfig['seo_service'])){
            $this->theme->setTitle($seoConfig['seo_service']['title']);
            $this->theme->set('keywords',$seoConfig['seo_service']['keywords']);
            $this->theme->set('description',$seoConfig['seo_service']['description']);
        }else{
            $this->theme->setTitle('服务商大厅');
        }

        if($request->get('employee_praise_rate')){
            $merge = $request->except('employee_praise_rate');
        }elseif($request->get('receive_task_num')){
            $merge = $request->except('receive_task_num');
        }else{
            $merge = $request->all();
        }


        if($request->get('service_name') || $request->get('keywords')){
            $searchName = $request->get('service_name') ? $request->get('service_name') : $request->get('keywords');
            $list = UserModel::select('user_detail.sign', 'users.name', 'user_detail.avatar', 'users.id','users.email_status','user_detail.employee_praise_rate','user_detail.shop_status','shop.is_recommend','shop.id as shopId')
                ->leftJoin('user_detail', 'users.id', '=', 'user_detail.uid')
                ->leftJoin('shop','user_detail.uid','=','shop.uid')->where('users.status', '<>',2)->where('users.name','like',"%".$searchName."%");
        }else{
            $list = UserModel::select('user_detail.sign', 'users.name', 'user_detail.avatar', 'users.id','users.email_status','user_detail.employee_praise_rate','user_detail.shop_status','shop.is_recommend','shop.id as shopId')
                ->leftJoin('user_detail', 'users.id', '=', 'user_detail.uid')
                ->leftJoin('shop','user_detail.uid','=','shop.uid')->where('users.status','<>', 2);
        }
        
        if ($request->get('category')) {
            $category = TaskCateModel::findByPid([$request->get('category')]);

            if (empty($category)) {
                $category_data = TaskCateModel::findById($request->get('category'));
                $category = TaskCateModel::findByPid([$category_data['pid']]);
                $pid = $category_data['pid'];
                $arrTag = TagsModel::where('cate_id', $request->get('category'))->lists('id')->toArray();
                $dataUid = UserTagsModel::whereIn('tag_id', $arrTag)->lists('uid')->toArray();
                $list = $list->whereIn('users.id', $dataUid);
            } else {
                foreach ($category as $item){
                    $arrCateId[] = $item['id'];
                }
                $arrTag = TagsModel::whereIn('cate_id', $arrCateId)->lists('id')->toArray();
                $dataUid = UserTagsModel::whereIn('tag_id', $arrTag)->lists('uid')->toArray();
                $list = $list->whereIn('users.id', $dataUid);
                $pid = $request->get('category');
            }
        } else {
            
            $category = TaskCateModel::findByPid([0]);
            $pid = 0;
        }

        if($this->themeName == 'quietgreen'){
            
            $area_data = DistrictModel::findTree(0);
            $area_pid = 0;
            $city = DistrictModel::findTree($area_data[0]['id']);
            $areaA = DistrictModel::findTree($city[0]['id']);
            $arr['province'] = $area_data;
            $arr['province_id'] = $area_pid;
            $arr['city'] = $city;
            $arr['area_add'] = $areaA;
            if ($request->get('province')) {
                $provinceDe = DistrictModel::where('id',intval($request->get('province')))->first()->name;
                $city = DistrictModel::findTree(intval($request->get('province')));
                $city_pid = $request->get('province');
                $areaA = DistrictModel::findTree($city[0]['id']);
                $arr['city'] = $city;
                $arr['province_id'] = $city_pid;
                $arr['area_add'] = $areaA;
                $arr['province_detail'] = $provinceDe;
            }
            if ($request->get('city')) {
                $areaA = DistrictModel::findTree(intval($request->get('city')));
                $cityDe = DistrictModel::where('id',intval($request->get('city')))->first()->name;
                $area_pid = $request->get('city');
                $arr['area_add'] = $areaA;
                $arr['city_id'] = $area_pid;
                $arr['city_detail'] = $cityDe;
            }
            if ($request->get('area')) {
                $area_id = $request->get('area');
                $areaDe = DistrictModel::where('id',$area_id)->first()->name;
                $arr['area_id'] = $area_id;
                $arr['area_detail'] = $areaDe;
            }

        }else{
            if ($request->get('province')) {
                $area_data = DistrictModel::findTree(intval($request->get('province')));
                $area_pid = $request->get('province');
            } elseif ($request->get('city')) {
                $area_data = DistrictModel::findTree(intval($request->get('city')));
                $area_pid = $request->get('city');
            } elseif ($request->get('area')) {
                $area = DistrictModel::where('id', '=', intval($request->get('area')))->first();
                $area_data = DistrictModel::findTree(intval($area['upid']));
                $area_pid = $area['upid'];
            } else {
                $area_data = DistrictModel::findTree(0);
                $area_pid = 0;
            }
        }


        
        if ($request->get('province')) {
            $list = $list->where('user_detail.province', intval($request->get('province')));
        }
        if ($request->get('city')) {
            $list = $list->where('user_detail.city', intval($request->get('city')));
        }
        if ($request->get('area')) {
            $list = $list->where('user_detail.area', intval($request->get('area')));
        }

        
        if($request->get('employee_praise_rate') && $request->get('employee_praise_rate') == 1){
            $list = $list->orderby('user_detail.employee_praise_rate','DESC');
        }
        


        $paginate = 20;
        $list = $list->orderBy('shop.is_recommend','DESC')->paginate($paginate);
        if (!empty($list->toArray()['data'])){

            foreach ($list as $k => $v){
                $arrUid[] = $v->id;
            }
        } else {
            $arrUid = 0;
        }

        
        $comment = CommentModel::whereIn('to_uid',$arrUid)->get()->toArray();
        if(!empty($comment)){
            
            $newComment = array_reduce($comment,function(&$newComment,$v){
                $newComment[$v['to_uid']][] = $v;
                return $newComment;
            });
            $commentCount = array();
            if(!empty($newComment)){
                foreach($newComment as $c => $d){
                    $commentCount[$c]['to_uid'] = $c;
                    $commentCount[$c]['count'] = count($d);
                }
            }
            
            $goodComment = CommentModel::whereIn('to_uid',$arrUid)->where('type',1)->get()->toArray();
            
            $newGoodsComment = array_reduce($goodComment,function(&$newGoodsComment,$v){
                $newGoodsComment[$v['to_uid']][] = $v;
                return $newGoodsComment;
            });
            $goodCommentCount = array();
            if(!empty($newGoodsComment)){
                foreach($newGoodsComment as $a => $b){
                    $goodCommentCount[$a]['to_uid'] = $a;
                    $goodCommentCount[$a]['count'] = count($b);
                }
            }
            
            foreach($list as $key => $value){
                foreach($goodCommentCount as $a => $b){
                    if($value['id'] == $b['to_uid']){
                        $list[$key]['good_comment_count'] = $b['count'];
                    }
                }
                foreach($commentCount as $c => $d){
                    if($value['id'] == $d['to_uid']){
                        $list[$key]['comment_count'] = $d['count'];
                    }
                }
            }
            foreach ($list as $key => $item) {

                

                
                if($item->comment_count > 0){
                    $item->percent = ceil($item->good_comment_count/$item->comment_count*100);
                    
                }
                else{
                    $item->percent = 100;
                }
            }
        }else{
            foreach ($list as $key => $item) {
                
                $item->percent = 100;
            }
        }

        
        $arrSkill = UserTagsModel::getTagsByUserId($arrUid);

        if(!empty($arrSkill) && is_array($arrSkill)){
            foreach ($arrSkill as $item){
                $arrTagId[] = $item['tag_id'];
            }

            $arrTagName = TagsModel::select('id', 'tag_name')->whereIn('id', $arrTagId)->get()->toArray();
            foreach ($arrSkill as $item){
                foreach ($arrTagName as $value){
                    if ($item['tag_id'] == $value['id']){
                        $arrUserTag[$item['uid']][] = $value['tag_name'];
                    }
                }
            }
            foreach ($list as $key => $item){
                foreach ($arrUserTag as $k => $v){
                    if ($item->id == $k){
                        $list[$key]['skill'] = $v;
                    }
                }
            }
        }

        
        $preArr = UserDetailModel::join('district', 'user_detail.province', '=', 'district.id')->select('district.name','user_detail.uid')->whereIn('user_detail.uid', $arrUid)->get()->toArray();
        $cityArr = UserDetailModel::join('district', 'user_detail.city', '=', 'district.id')->select('district.name','user_detail.uid')->whereIn('user_detail.uid', $arrUid)->get()->toArray();
        foreach($list as $key => $value){
            if(!empty($preArr) && is_array($preArr)){
                foreach($preArr as $g => $h){
                    if($value['id'] == $h['uid']){
                        $list[$key]['pre'] = $h['name'];
                    }
                }
            }
            if(!empty($cityArr) && is_array($cityArr)){
                foreach($cityArr as $i => $j){
                    if($value['id'] == $j['uid']){
                        $list[$key]['city'] = $j['name'];
                    }
                }
            }
        }
        
        $userAuthOne = AuthRecordModel::whereIn('uid', $arrUid)->where('status', 2)->where('auth_code','!=','realname')->get()->toArray();
        $userAuthTwo = AuthRecordModel::whereIn('uid', $arrUid)->where('status', 1)
            ->whereIn('auth_code',['realname','enterprise'])->get()->toArray();
        $userAuth = array_merge($userAuthOne,$userAuthTwo);
        $auth = array();
        if(!empty($userAuth) && is_array($userAuth)){
            foreach($userAuth as $a => $b){
                foreach($userAuth as $c => $d){
                    if($b['uid'] = $d['uid']){
                        $auth[$b['uid']][] = $d['auth_code'];
                    }
                }
            }
        }
        if(!empty($auth) && is_array($auth)){
            foreach($auth as $e => $f){
                $auth[$e]['uid'] = $e;
                if(in_array('realname',$f)){
                    $auth[$e]['realname'] = true;
                }else{
                    $auth[$e]['realname'] = false;
                }
                if(in_array('bank',$f)){
                    $auth[$e]['bank'] = true;
                }else{
                    $auth[$e]['bank'] = false;
                }
                if(in_array('alipay',$f)){
                    $auth[$e]['alipay'] = true;
                }else{
                    $auth[$e]['alipay'] = false;
                }
                if(in_array('enterprise',$f)){
                    $auth[$e]['enterprise'] = true;
                }else{
                    $auth[$e]['enterprise'] = false;
                }
            }
            foreach ($list as $key => $item) {
                
                foreach ($auth as $a => $b) {
                    if ($item->id == $b['uid']) {
                        $list[$key]['auth'] = $b;
                    }
                }
            }

         }


        
        $ad = AdTargetModel::getAdInfo('SELLERLIST_BOTTOM');

        
        $rightAd = AdTargetModel::getAdInfo('SELLERLIST_RIGHT_TOP');

        
        $reTarget = RePositionModel::where('code','SERVICE_SIDE')->where('is_open','1')->select('id','name')->first();
        if($reTarget->id){
            $recommend = RecommendModel::getRecommendInfo($reTarget->id)->select('*')->orderBy('recommend.sort','ASC')->get();
            if(count($recommend)){
                foreach($recommend as $k=>$v){
                    $comment = CommentModel::where('to_uid',$v['recommend_id'])->count();
                    $goodComment = CommentModel::where('to_uid',$v['recommend_id'])->where('type',1)->count();
                    if($comment){
                        $v['percent'] = $goodComment?$goodComment/$comment : 1;
                    }
                    else{
                        $v['percent'] = 1;
                    }
                    $recommend[$k] = $v;
                }
                $hotList = $recommend;
            }
            else{
                $hotList = [];
            }
        }


        $data = array(
            'pid' => $pid,
            'category' => $category,
            'list' => $list,
            'merge' => $merge,
            'paginate' => $paginate,
            'page' => $request->get('page') ? $request->get('page') : '',
            'skillId' => $request->get('skillId') ? $request->get('skillId') : '',
            'type' => $request->get('type') ? $request->get('type') : 0,
            'ad' => $ad,
            'rightAd' => $rightAd,
            'hotList' => $hotList,
            'targetName' => $reTarget->name,
            'area' => $area_data,
            'area_pid' => $area_pid,
        );
        if(isset($arr) && !empty($arr)){
            $data = array_merge($data,$arr);
        }

        $this->theme->set('now_menu','/bre/service');
        return $this->theme->scope('bre.servicelist', $data)->render();
    }

    
    public function creatInfo(Request $request){
        $data = $request->except('_token');
        $validator = Validator::make($data,[
            'desc' => 'required|max:255'
        ],
        [
            'desc.required' => '请输入投诉建议',
            'desc.max'      => '投诉建议字数超过限制'


        ]);
        $error = $validator->errors()->all();
        if(count($error)){
            return redirect()->to(\CommonClass::homePage())->with(['error'=>$validator->errors()->first()]);
        }
        if($data['phone']){
            $validator = Validator::make($data,[
                'phone' => 'mobile_phone'
            ],
            [
                'phone.mobile_phone' => '请输入正确的手机格式'


            ]);

            $error = $validator->errors()->all();
            if(count($error)){
                return redirect()->to(\CommonClass::homePage())->with(['error'=>$validator->errors()->first()]);
            }
        }
        $newdata = [
            'desc'          => $data['desc'],
            'created_time'  => date('Y-m-d h:i:s',time())
        ];
        if($data['uid']){
            $newdata['uid'] = $data['uid'];
        }
        if($data['phone']){
            $newdata['phone'] = $data['phone'];
        }
        $res = FeedbackModel::create($newdata);
        if($res){
            return redirect()->to(\CommonClass::homePage())->with(['message'=>'投诉建议提交成功！']);
        }
        return redirect()->to(\CommonClass::homePage())->with(['error'=>'投诉建议提交失败！']);
    }


    
    public function shop(Request $request)
    {
        $this->theme->setTitle('威客商城');
        $data = $request->all();
        $workInfo = $uid = [];
        
        $goodsInfo = GoodsModel::where('status',1)
            ->select('id','uid','shop_id','title','type','cash','cover','sales_num','good_comment');
		
        if (isset($data['category']) && $data['category']!=0) {
            $category = TaskCateModel::findByPid([intval($data['category'])]);
            $pid = $data['category'];
            if (empty($category)) {
                $category_data = TaskCateModel::findById( intval($data['category']));
                $category = TaskCateModel::findByPid([intval($category_data['pid'])]);
                $pid = $category_data['pid'];
				$goodsInfo=$goodsInfo->where('cate_id',$data['category']);
            }else{
				$categoryArr=[];
				foreach($category as $Vcg){
					$categoryArr[]=$Vcg['id'];
				}
				$goodsInfo=$goodsInfo->whereIn('cate_id',$categoryArr);
			}
        } else {
            
            $category = TaskCateModel::findByPid([0]);
            $pid = 0;
        }	
        if(isset($data['type'])){
            $goodsInfo = $goodsInfo->where('type',$data['type']);
        }
        if(isset($data['title'])){
            $goodsInfo = $goodsInfo->where('title','like','%'.$data['title'].'%');
        }
        if(isset($data['desc'])){
            switch($data['desc']){
                case 'cash':
                    $goodsInfo = $goodsInfo->orderBy('cash','desc');
                    break;
                case 'sales_num':
                    $goodsInfo = $goodsInfo->orderBy('sales_num','desc');
                    break;
                case 'good_comment':
                    $goodsInfo = $goodsInfo->orderBy('good_comment','desc');
                    break;
            }

        }

        if($this->themeName == 'black'){
            $paginate = 10;
        }else{
            $paginate = 12;
        }
        $goodsInfo = $goodsInfo->where(function($goodsInfo){
            $goodsInfo->where('is_recommend',0)
                ->orWhere(function($goodsInfo){
                    $goodsInfo->where('is_recommend',1)
                        ->where('recommend_end','>',date('Y-m-d H:i:s',time()));
                });
        })

            ->orderBy('is_recommend','desc')->orderBy('created_at','desc')->paginate($paginate);
        foreach($goodsInfo as $k => $v){
            $uid[] = $v->uid;
        }
        $cityInfo = ShopModel::join('district', 'shop.city', '=', 'district.id')
            ->select('shop.uid','district.name')->whereIn('shop.uid', $uid)->get();

        $cityUid= [];
        $cityIn = [];
        if(!empty($cityInfo)){
            foreach($cityInfo as $ck => $cv){
                $cityIn[$cv->uid] = $cv->name;
                $cityUid[] = $cv->uid;
            }
            foreach($goodsInfo as $gk => $gv){
                if(in_array($gv->uid,$cityUid)){
                    $goodsInfo[$gk]->addr = $cityIn[$gv->uid];
                }

            }
        }
        $goodsArr = $goodsInfo->toArray()['data'];
        
        $workInfo = GoodsModel::where(['status' => 1,'type' => 1])
            ->select('id','title','cash','cover','shop_id')
            ->orderBy('sales_num','desc')
            ->limit(5)->get()->toArray();
        $domain = \CommonClass::getDomain();
        
        $ad = AdTargetModel::getAdInfo('SHOP_BOTTOM');
        $data = [
            'goodsInfo' => $goodsInfo,
            'goods_arr' => json_encode($goodsArr),
            'domain' => $domain,
            'workInfo' => $workInfo,
            'merge' => $data,
			'category' => $category,
            'uid' => Auth::User() ? Auth::User()['id'] : 0,
            'ad' => $ad,
			'pid'=>$pid
        ];
        $this->theme->set('now_menu','/bre/shop');
        return $this->theme->scope('bre.shoplist',$data)->render();
    }


    
    public function changeUrl(Request $request){
        $url = '';
        $uid = intval($request->get('uid'));
        if($uid){
            $type = $request->get('type');
            
            $realName = RealnameAuthModel::where('uid',$uid)->where('status',1)->first();
            if(empty($realName)){
                $url = '/user/userShopBefore';
            }else{
                $shopInfo = ShopModel::where('uid',$uid)->first();
                if(empty($shopInfo)){
                    $url = '/user/myShopHint';
                }else{
                    if($type == '2'){
                        $url = '/user/serviceCreate';
                    }elseif($type == '1'){
                        $url = '/user/pubGoods';
                    }
                }
            }

        }else{
            $url = '/login';
        }

        return $url;
    }


    
    public function ajaxGoodsList(Request $request)
    {
        $page = $request->get('page');
        $type = $request->get('type');
        $title = $request->get('title');
        $desc = $request->get('desc');

        $goodsInfo = GoodsModel::where('status',1)
            ->select('id','uid','shop_id','title','type','cash','cover','sales_num','good_comment');
        if($type != 0){
            $goodsInfo = $goodsInfo->where('type',$type);
        }
        if(!empty($title)){
            $goodsInfo = $goodsInfo->where('title','like','%'.$title.'%');
        }
        if($desc != ''){
            switch($desc){
                case 'cash':
                    $goodsInfo = $goodsInfo->orderBy('cash','desc');
                    break;
                case 'sales_num':
                    $goodsInfo = $goodsInfo->orderBy('sales_num','desc');
                    break;
                case 'good_comment':
                    $goodsInfo = $goodsInfo->orderBy('good_comment','desc');
                    break;
            }

        }

        $goodsInfo = $goodsInfo->where(function($goodsInfo){
            $goodsInfo->where('is_recommend',0)
                ->orWhere(function($goodsInfo){
                    $goodsInfo->where('is_recommend',1)
                        ->where('recommend_end','>',date('Y-m-d H:i:s',time()));
                });
        })->orderBy('is_recommend','desc')->orderBy('created_at','desc')->paginate(10);
        if(!empty($goodsInfo)){
            foreach($goodsInfo as $k => $v){
                $uid[] = $v->uid;
            }
            $cityInfo = ShopModel::join('district', 'shop.city', '=', 'district.id')
                ->select('shop.uid','district.name')->whereIn('shop.uid', $uid)->get();
            if(!empty($cityInfo)){
                foreach($cityInfo as $ck => $cv){
                    $cityInfo[$cv->uid] = $cv->name;
                }
                foreach($goodsInfo as $gk => $gv){
                    $goodsInfo[$gk]->addr = $cityInfo[$gv->uid];
                }
            }
            $goodsArr = $goodsInfo->toArray()['data'];
        }else{
            $goodsArr = [];
        }
        $domain = \CommonClass::getDomain();
        if (!empty($goodsArr)) {
            $data = array(
                'code' => 1,
                'msg' => 'success',
                'data' => json_encode($goodsArr),
                'domain' => $domain
            );
        } else {
            $data = array(
                'code' => 0,
                'msg' => 'failure'
            );
        }
        return response()->json($data);
    }
}