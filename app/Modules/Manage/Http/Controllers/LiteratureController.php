<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Modules\Manage\Model\BookModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Theme;

class LiteratureController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('manage');

    }

    //书籍列表
    public function bookList(Request $request)
    {
        $this->theme->setTitle('书籍列表');
        $bookList = BookModel::orderBy('id','desc');
        $re = $request->all();
        if ($request->get('book_name')) {//书籍名称
            $bookList = $bookList->where('book_name', $request->get('book_name'));
        }
        if ($request->get('author')) {//作者
            $bookList = $bookList->where('author', $request->get('author'));
        }
        if ($request->get('book_type')) {//书籍类型
            $bookList = $bookList->where('book_type', $request->get('book_type'));
        }
        if ($request->get('type')) {//发布类型
            $bookList = $bookList->where('type', $request->get('type'));
        }
        if ($request->get('book_status')) {//书籍状态
            $bookList = $bookList->where('book_status', $request->get('book_status'));
        }
        if($request->get('start')){
            $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
            $bookList = $bookList->where('created_at','>',$start);
        }
        if($request->get('end')){
            $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
            $bookList = $bookList->where('created_at','<',$end);
        }

        $bookList = $bookList->paginate(20);
        $data = [
            'book' => $bookList,
            'request' => $re
        ];
        $data['book_status'] = [
            ['id' => "1" ,'name' => '待审核'],
            ['id' => "2" ,'name' => '未通过'],
            ['id' => "3" ,'name' => '未支付'],
            ['id' => "4" ,'name' => '创作中'],
            ['id' => "5" ,'name' => '已完结'],
        ];
        $data['type'] = [
            ['id' => "1" ,'name' => '官方发布'],
            ['id' => "2" ,'name' => '用户发布'],
        ];
        $data['book_type'] = [
            ['id' => "1" ,'name' => '文学'],
            ['id' => "2" ,'name' => '都市'],
        ];
        return $this->theme->scope('manage.bookList', $data)->render();
    }

    //添加书籍页
    public function createBookShow(Request $request)
    {
        $this->theme->setTitle('发布新书');
        $data['book_type'] = [
            ['id' => "1" ,'name' => '文学'],
            ['id' => "2" ,'name' => '都市'],
        ];

        return $this->theme->scope('manage.addBook',$data)->render();
    }

    //添加书籍
    public function createBook(Request $request)
    {
        $data = $request->except('_token');
        if(!empty($data['book_cover'])){
            $rule = ['png','gif','jpeg','jpg'];
            $url_path = 'uploads/book_cover/';
            $result = $this->upload_img($data['book_cover'],$url_path,$rule);
            if($result){
                $data['book_cover'] = $result['name'];
                $data['book_status'] = 4;
                $data['type'] = 1;
                $data['author'] = '官方发布';
                $data['created_at'] = date('Y-m-d H:i:s');
                $book = BookModel::insert($data);
                $return = $book ? '操作成功' : '操作失败';
                return redirect('manage/bookList')->with(['error'=>$return]);
            }
        }else{
            return redirect('manage/bookList')->with(['error'=>'图片上传失败']);
        }

    }

    //书籍详情
    public function updateBookShow($id)
    {
        $book = BookModel::where('id',$id)->first()->toArray();
        $data['book_type'] = [
            ['id' => "1" ,'name' => '文学'],
            ['id' => "2" ,'name' => '都市'],
        ];

        $data['book'] = $book;
        return $this->theme->scope('manage.updateBook',$data)->render();
    }

    //修改书籍
    public function updateBook(Request $request)
    {
        $data = $request->except('_token');
        $data['updated_at'] = date('Y-m-d H:i:s');
        if(!empty($data['book_cover'])){
            $book_cover = BookModel::select('book_cover')->where('id',$data['id'])->first()->toArray();
            $rule = ['png','gif','jpeg','jpg'];
            $url_path = 'uploads/book_cover/';
            $result = $this->upload_img($data['book_cover'],$url_path,$rule);
            if($result){
                $data['book_cover'] = $result['name'];
                $book = BookModel::where('id',$data['id'])->update($data);
                if($book){
                    if($book_cover['book_cover']){
                        unlink($book_cover['book_cover']);
                    }
                    return redirect('/manage/bookList')->with(['message'=>'操作成功']);
                }else{
                    unlink($data['book_cover']);
                    return redirect('/manage/bookList')->with(['message'=>'操作失败']);
                }
            }
        }else{
            $book = BookModel::where('id',$data['id'])->update($data);
            $return = $book ? '操作成功' : '操作失败';
            return redirect('/manage/bookList')->with(['message'=>$return]);
        }

    }


}


