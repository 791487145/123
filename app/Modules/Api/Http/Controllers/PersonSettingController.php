<?php

namespace App\Modules\Api\Http\Controllers;


use App\Http\Controllers\ApiBaseController;
use App\Modules\Finance\Model\CashoutModel;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\HelpModel;
use App\Modules\Manage\Model\TypeModel;
use Illuminate\Http\Request;
use Validator;
use App\Modules\Task\Model\TaskFocusModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\User\Model\TagsModel;
use App\Modules\User\Model\UserFocusModel;
use App\Modules\User\Model\UserTagsModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\Task\Model\SuccessCaseModel;
use App\Modules\Im\Model\ImAttentionModel;
use App\Modules\Im\Model\ImMessageModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\Advertisement\Model\AdModel;
use App\Modules\Advertisement\Model\AdTargetModel;
use App\Modules\Advertisement\Model\RePositionModel;
use App\Modules\Advertisement\Model\RecommendModel;
use App\Modules\User\Model\CommentModel;
use App\Modules\User\Model\UserModel;
use App\Modules\Task\Model\TaskAttachmentModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\Task\Model\WorkAttachmentModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\FeedbackModel;
use App\Modules\Manage\Model\ArticleCategoryModel;
use App\Modules\Manage\Model\ArticleModel;
use App\Modules\Order\Model\OrderModel;
use Omnipay;
use Config;
use Illuminate\Support\Facades\Crypt;
use DB;
Use QrCode;
Use Cache;
use Illuminate\Support\Facades\Redis;

class PersonSettingController extends ApiBaseController
{

	protected $uid;

    public function __construct(Request $request)
    {
        $tokenInfo = Crypt::decrypt(urldecode($request->get('token')));
        $this->uid = $tokenInfo['uid'];
        $this->school = $tokenInfo['school'];
        $this->username = $tokenInfo['name'];
        $this->mobile = $tokenInfo['mobile'];
    }


    /**意见反馈种类（post:/setting/feedbackType）
     * @param Request $request
     * @param type 意见种类 feedback
     * @return \Illuminate\Http\Response
     */
    public function feedbackType(Request $request)
    {
    	$type = $request->input('type',0);


    	if($type != 'feedback'){
    		return $this->formateResponse(1001,'请填写正确的种类名称');
    	}

		if(Cache::has('type_of_feedback')){
			$data['type'] = Cache::get('type_of_feedback');
		}else{
			$data['type'] = TypeModel::selectAllofType($type);
		}

		return $this->formateResponse(1000,'success',$data);
	}


    /**意见反馈(post:/setting/feedbackSubmission)
     * @param Request $request
     * @param phone 手机号
     * @param desc 描述
     * @param type 类型
     * @return \Illuminate\Http\Response
     */
	public function feedbackSubmission(Request $request)
	{
		$data = $request->except('token');
        $validator = Validator::make($data,[
            'phone' => 'required|mobile_phone',
            'desc' => 'required',
            'type' => 'required',
            
        ],[
            'phone.required' => '请填写联系方式',
            'phone.mobile_phone' => '请填写正确手机号格式',	

            'desc.required' => '请填写任务描述',
            'type.required' => '请选择反馈类型',
            
        ]);

        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }

        $data['desc'] = \CommonClass::removeXss($data['desc']);
        $data['uid'] = $this->uid;
        $ret = FeedbackModel::createOne($data);

        if($ret){
        	return $this->formateResponse(1000,'success');
        }

        return $this->formateResponse(1001,'操作失败');
	}


    /**帮助列表（post:/setting/systemHelpList）
     * @param Request $request
     * @param limit 限制数
     * @param pageNum 页数
     * @return \Illuminate\Http\Response
     */
	public function systemHelpList(Request $request)
	{
		$data = $request->all();
        $validator = Validator::make($data,[
            'limit' => 'required',
            'pageNum' => 'required',
            
        ],[
            'limit.required' => '每页显示数量',
            'pageNum.required' => '当前第几页',	
        ]);

        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }

        $offset = $data['limit'] * ($data['pageNum'] - 1);
        $data = HelpModel::whereStatus('valid')->limit($data['limit'])->offset($offset)->orderBy('id','desc')->get();

        if(!$data->isEmpty()){

        	$data = $data->toArray();
        }

        return $this->formateResponse(1000,'success',$data);
	}


    /**帮助详情(post:/setting/systemHelpDetail)
     * @param Request $request
     * @param help_id 帮助信息id
     * @return \Illuminate\Http\Response
     */
	public function systemHelpDetail(Request $request)
	{
		$data = $request->all();
        $validator = Validator::make($data,[
            'help_id' => 'required',
            
        ],[
            'help_id.required' => '请填写帮助列表id',   
        ]);

        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }

        $data = HelpModel::findById($data['help_id']);

        if(is_null($data)){
        	return $this->formateResponse(1001,'暂无数据');
        }

        return $this->formateResponse(1000,'success',$data);
	}

    /**消费记录（post:/setting/consumeList）
     * @param Request $request
     * @return mixed
     */
    public function consumeList(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data,[
            'limit' => 'required',
            'pageNum' => 'required',

        ],[
            'limit.required' => '每页显示数量',
            'pageNum.required' => '当前第几页',
        ]);

        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }

        $array = [1,5,6];
        $offset = $data['limit'] * ($data['pageNum'] - 1);
        $financials = FinancialModel::whereIn('action',$array)->whereUid($this->uid)->limit($data['limit'])->offset($offset)
                                      ->select('cash','id','created_at','action')->get();
        if(!$financials->isEmpty()){
            foreach($financials as $financial){
                $financial->action_name = FinancialModel::getStatusCN($financial->action);
            }
            $financials = $financials->toArray();
        }

        if($financials->isEmpty()){
            return $this->formateResponse(2000,'暂无数据');
        }

        return $this->formateResponse(1000,'success',$financials);
    }

    /**充值记录(post:/setting/rechargeList)
     * @param Request $request
     * @return mixed
     */
    public function rechargeList(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data,[
            'limit' => 'required',
            'pageNum' => 'required',

        ],[
            'limit.required' => '每页显示数量',
            'pageNum.required' => '当前第几页',
        ]);

        $error = $validator->errors()->all();
        if(count($error)){
            return $this->formateResponse(1001,$error[0], $error);
        }

        $offset = $data['limit'] * ($data['pageNum'] - 1);

        $financials = OrderModel::where('type',1)->where('uid',$this->uid)->limit($data['limit'])->offset($offset)
            ->select('cash','id','created_at','type','code')->get();
        //dd($financials);
        if($financials->isEmpty()){
            return $this->formateResponse(2000,'暂无数据');
        }

        if(!$financials->isEmpty()){
            foreach($financials as $financial){
                $financial->type_name = '充值';
            }
            $financials = $financials->toArray();
        }



        return $this->formateResponse(1000,'success',$financials);
    }

}