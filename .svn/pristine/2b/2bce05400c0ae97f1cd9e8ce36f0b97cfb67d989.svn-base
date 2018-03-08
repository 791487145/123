<?php

namespace App\Modules\Shop\Models;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\User\Model\UserDetailModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GoodsCommentModel extends Model
{
    
    protected $table = 'goods_comment';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id','uid', 'goods_id', 'comment_by', 'speed_score', 'quality_score', 'attitude_score', 'type', 'created_at','comment_desc'
    ];
    public  $timestamps = false;  

    
    static function getCommentByGoodsId($goodsId,$page=1,$type=0,$paginate=5)
    {
        
        $commentList = GoodsCommentModel::where('goods_comment.goods_id',$goodsId)->where('goods_comment.type',$type)
            ->leftJoin('users','users.id','=','goods_comment.uid')->leftJoin('user_detail','user_detail.uid','=','goods_comment.uid')
            ->select('goods_comment.*','users.name','user_detail.avatar')
            ->orderBy('goods_comment.created_at','DESC')->paginate($paginate);
        
        $avgSpeed = round(GoodsCommentModel::where('goods_id', $goodsId)->avg('speed_score'), 1);
        
        $avgQuality = round(GoodsCommentModel::where('goods_id', $goodsId)->avg('quality_score'), 1);
        
        $avgAttitude = round(GoodsCommentModel::where('goods_id', $goodsId)->avg('attitude_score'), 1);
        $data = array(
            'comment_list' => $commentList,
            'speed_score' => $avgSpeed,
            'quality_score' => $avgQuality,
            'attitude_score' => $avgAttitude
        );
        return $data;
    }

    
    static function isComment($goodsId,$uid)
    {
        
        $comment = GoodsCommentModel::where('uid',$uid)->where('goods_id',$goodsId)->first();
        
        $shopOrderInfo = ShopOrderModel::where('uid',$uid)->where('object_id',$goodsId)
            ->where('object_type',2)->where('status',2)->first();
        if(!empty($shopOrderInfo) && empty($comment)){
            $isComment = true;
        }else{
            $isComment = false;
        }
        return $isComment;
    }

    
    static function createGoodsComment($data,$shopOrder)
    {
        $status = DB::transaction(function () use ($data,$shopOrder) {
            
            GoodsCommentModel::create($data);

            ShopOrderModel::where('id',$shopOrder['id'])->update(['status' => 4]);
            
            $goodsInfo = GoodsModel::where('id', $data['goods_id'])->first();
            if(!empty($goodsInfo)){
                
                $shopInfo = ShopModel::where('id',$goodsInfo->shop_id)->first();
                if ($data['type'] == 0) {
                    
                    $arr = array(
                        'good_comment' => $goodsInfo->good_comment + 1,
                        'comments_num' => $goodsInfo->comments_num + 1
                    );
                    GoodsModel::where('id', $data['goods_id'])->update($arr);
                    $shopArr = array(
                        'good_comment' => $shopInfo->good_comment + 1,
                        'total_comment' => $shopInfo->total_comment + 1
                    );
                    ShopModel::where('id', $goodsInfo->shop_id)->update($shopArr);
                } else {
                    
                    $arr = array(
                        'comments_num' => $goodsInfo->comments_num + 1
                    );
                    GoodsModel::where('id', $data['goods_id'])->update($arr);
                    $shopArr = array(
                        'total_comment' => $shopInfo->total_comment + 1
                    );
                    ShopModel::where('id', $goodsInfo->shop_id)->update($shopArr);
                }
            }
            return true;
        });
        return $status;

    }



}
