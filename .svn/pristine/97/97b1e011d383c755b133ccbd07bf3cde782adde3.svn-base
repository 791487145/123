<?php
namespace App\Modules\Im\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Http\Requests;
use App\Modules\Im\Model\ImAttentionModel;
use App\Modules\Im\Model\ImMessageModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use Auth;

class IndexController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('main');
    }

    
    public function getMessage($uid)
    {
        $user = Auth::User();
        $uid = intval($uid);
        $list = ImMessageModel::where(['from_uid' => $user->id, 'to_uid' => $uid])
            ->orWhere(['to_uid' => $user->id, 'from_uid' => $uid])->orderBy('created_at', 'asc')
            ->leftjoin('users as ud','ud.id','=','im_message.from_uid')
            ->select('im_message.*','ud.name as from_username')
            ->get()->toArray();
        foreach($list as $k=>$v)
        {
            $list[$k]['created_at']  = date('Y/m/d H:i:s',strtotime($v['created_at']));
        }
        return \CommonClass::formatResponse('success', 200, $list);
    }

    
    public function addAttention(Request $request)
    {
        $user = Auth::User();

        $friend_uid = $request->get('toUid');
        $usersInfo = UserModel::select('name')->where('id', $friend_uid)->first();
        if (!empty($usersInfo)){
            $info = UserDetailModel::select('avatar', 'sign')->where('uid', $friend_uid)->first();

            $res = ImAttentionModel::where(['uid' => $user->id, 'friend_uid' => $friend_uid])->first();
            if (empty($res)){
                ImAttentionModel::insert([
                    [
                        'uid' => $friend_uid,
                        'friend_uid' => $user->id
                    ],
                    [
                        'uid' => $user->id,
                        'friend_uid' => $friend_uid
                    ]

                ]);
            }
            $data = [
                'name' => $usersInfo->name,
                'avatar' => $info->avatar,
                'friend_uid' => $friend_uid,
                'sign' => $info->sign ? $info->sign : '这家伙都懒的签名！'
            ];
            return \CommonClass::formatResponse('success', 200, $data);
        }

    }

}
