{{--列表--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">宝箱物品  {!! $box_name['name'] !!}</h3>
<div class="well">
    <form class="form-inline search-group"  action="{{ URL('manage/boxAdd') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input type="hidden" name="box_id" value="{{ $id }}"/>

        <div class="form-group search-list ">
            <label for="name" class="">物品名称</label>
            <select name="goods_id" >
                <option value="">请选择</option>
                @foreach($sjlm_goods as $v)
                    <option value="{{ $v['id'] }}" >{{ $v['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group search-list">
            <label for="namee" class="">物品数量</label>
            <input type="number" name="g_amount"  required="required">
        </div>

        <div class="form-group search-list">
            <label for="namee" class="">概率</label>
            <input type="number" max="10000" name="probability" required="required">
            注：最小概率为0  最大概率为10000（0为不中 10000必中）
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">添加</button>
        </div>
        <div class="space"></div>

        <div class="">

        </div>
    </form>
</div>
<div class="table-responsive">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>
                <label>
                    编号
                </label>
            </th>
            <th>物品名称</th>
            <th>物品图片</th>
            <th>物品数量</th>
            <th>物品概率</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
            @if(!empty($box_goods))
            @foreach($box_goods as $k=>$item)
                <tr>
                    <td>{!! $k+1 !!}</td>
                    <td>{!! $item['name'] !!}</td>
                    <td><img src="/{!! $item['icon'] !!}" style="height:30px;"> </td>
                    <td>{!! $item['g_amount'] !!}</td>
                    <td>{!! $item['probability'] !!}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="{{ URL('manage/boxDet/'.$item['id']) }}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                        <a  href="{{ URL('manage/boxDel/'.$item['id']) }}" title="删除" class="btn btn-xs btn-danger">
                            <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                        </a>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>


{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('questionlist', 'js/doc/questionlist.js') !!}