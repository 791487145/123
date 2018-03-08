<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Modules\Manage\Http\Requests\AgreementRequest;
use App\Modules\Manage\Model\AgreementModel;
use App\Modules\Manage\Model\ConfigModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AgreementController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');
        $this->theme->set('manageType', 'agreement');

    }

    
    public function agreementList(Request $request)
    {
        $agreement = AgreementModel::orderBy('id','ASC')->paginate(20);
        $data = array(
            'agree_list' => $agreement
        );
        $this->theme->setTitle('协议管理');
        return $this->theme->scope('manage.agreelist', $data)->render();
    }

    
    public function addAgreement(Request $request)
    {
        $data = array();
        $this->theme->setTitle('协议管理');
        return $this->theme->scope('manage.addagree', $data)->render();
    }

    
    public function postAddAgreement(AgreementRequest $request)
    {
        $data = $request->all();
        $data['content'] = htmlspecialchars($data['content']);
        if(mb_strlen($data['content']) > 4294967295/3){
            $error['content'] = '内容太长，建议减少上传图片';
            if (!empty($error)) {
                return redirect('/manage/editAgreement/'.$data['id'])->withErrors($error);
            }
        }
        $arr = array(
            'name' => $data['name'],
            'code_name' => $data['code_name'],
            'content' => $data['content'],
            'created_at' => date('Y-m-d H:i:s',time()),
            'updated_at' => date('Y-m-d H:i:s',time())
        );
        
        $agree = AgreementModel::where('code_name',$data['code_name'])->first();
        if($agree)
        {
            $error['code_name'] = '该协议代号已存在，请重新输入协议代号';
            if (!empty($error)) {
                return redirect('/manage/addAgreement')->withInput($request->only('name', 'content'))->withErrors($error);
            }
        }
        $res = AgreementModel::create($arr);
        if($res)
        {
            return redirect('/manage/agreementList')->with(array('message' => '操作成功'));
        }
        else
        {
            return redirect('/manage/agreementList')->with(array('message' => '操作失败'));
        }
    }


    
    public function editAgreement(Request $request,$id)
    {
        $id = intval($id);
        $agree = AgreementModel::where('id',$id)->first();
        $data = array(
            'agree' => $agree
        );
        $this->theme->setTitle('协议管理');
        return $this->theme->scope('manage.editagree',$data)->render();
    }

    
    public function postEditAgreement(AgreementRequest $request)
    {
        $data = $request->all();
        $arr = array(
            'name' => $data['name'],
            'code_name' => $data['code_name'],
            'content' => $data['content'],
            'updated_at' => date('Y-m-d H:i:s',time())
        );
        
        $agree = AgreementModel::where('code_name',$data['code_name'])->where('id','!=',$data['id'])->first();
        if($agree)
        {
            $error['code_name'] = '该协议代号已存在，请重新输入协议代号';
            if (!empty($error)) {
                return redirect('/manage/editAgreement/'.$data['id'])->withInput($request->only('name','id', 'content'))->withErrors($error);
            }
        }
        $res = AgreementModel::where('id',$data['id'])->update($arr);
        if($res)
        {
            return redirect('/manage/agreementList')->with(array('message' => '操作成功'));
        }
        else
        {
            return redirect('/manage/agreementList')->with(array('message' => '操作失败'));
        }
    }

    
    public function deleteAgreement($id)
    {
        $id = intval($id);
        $res = AgreementModel::where('id',$id)->delete();
        if($res)
        {
            return redirect()->to('/manage/agreementList')->with(array('message' => '操作成功'));
        }
        else
        {
            return redirect()->to('/manage/agreementList')->with(array('message' => '操作失败'));
        }
    }

    
    public function skin()
    {
        $skin_color_config = \CommonClass::getConfig('skin_color_config');
        
        $path = public_path().'/themes';
        $themes = \CommonClass::listDir($path);
        
        $theme_now = \CommonClass::getConfig('theme');

        $view = [
            'skin_config'=>$skin_color_config,
            'themes'=>$themes,
            'theme_now'=>$theme_now
        ];
        $this->theme->setTitle('模板管理');
        return $this->theme->scope('manage.skin',$view)->render();
    }
    
    public function skinSet($color)
    {
        if(!in_array($color,['blue','red','gray','orange']))
        {
            return redirect('manage/skin')->with(['error'=>'参数错误']);
        }
        $result = ConfigModel::where('alias','skin_color_config')->update(['rule'=>$color]);
        if(!$result)
            return redirect('manage/skin')->with(['error'=>'设置失败']);

        return redirect('manage/skin')->with(['message'=>'设置成功！']);
    }

    public function skinChange($name)
    {
        $result = ConfigModel::where('alias','theme')->update(['rule'=>$name]);

        if(!$result)
            return redirect()->back()->with(['error'=>'模板选择失败！']);

        return redirect()->back()->with(['message'=>'模板选择成功！']);
    }
}

