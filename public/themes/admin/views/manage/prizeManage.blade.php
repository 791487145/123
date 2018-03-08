{{--列表--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">奖品管理</h3>

<div class="well">
    <form class="form-inline search-group" role="form" action="{!! url('manage/addPrize') !!}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group search-list ">
            <label for="name" class="">名称</label>
            <input type="text" name="name" value="" >
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">图片</label>
            <input type="file" name="icon" value="">
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">类型</label>
            <select name="kind">
                <option value="">请选择</option>
                @foreach($type as $v)
                    @if($v['type'] == 'stdmode')
                        <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                    @endif
                @endforeach
            </select>

        </div>
        <div class="form-group search-list">
            <label for="namee" class="">功能</label>
            <select name="ability">
                <option value="0">请选择</option>
                @foreach($type as $v)
                @if($v['type'] == 'prop')
                    <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                @endif
                @endforeach
            </select>

        </div>
        <div class="space"></div>
        <div class="form-group search-list">
            <label for="namee" class="">价值（实物价值）</label>
            <input type="text" name="price" value="">
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">金币兑换</label>
            <input type="text" name="gold" value="">
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">兑换码标志</label>
            <input type="text" name="sign" value="">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">生成</button>
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
            <th>名称</th>
            <th>图片</th>
            <th>类型</th>
            <th>实物价值</th>
            <th>金币兑换数量</th>
            <th>兑换码标志</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
            @if(!empty($prize))
            @foreach($prize as $k=>$item)
                <tr>
                    <td>{!! $k+1 !!}</td>
                    <td>{!! $item['name'] !!}</td>
                    <td><img src="/{!! $item['icon'] !!}" style="height:30px;"></td>
                    <td>@if($item['kind'] == 1)实物 @else 道具 @endif</td>
                    <td>{!! $item['price'] !!}元</td>
                    <td>{!! $item['gold'] !!}</td>
                    <td>{!! $item['sign'] !!}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="prizeDet/{{ $item['id'] }}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                        <a  href="prizeDel/{{ $item['id'] }}" title="删除" class="btn btn-xs btn-danger">
                            <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                        </a>
                        
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
<div class="col-xs-12">
    <div class="dataTables_paginate paging_bootstrap row">
        <ul class="pagination">
           {!! $prize->render() !!}
        </ul>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('questionlist', 'js/doc/questionlist.js') !!}