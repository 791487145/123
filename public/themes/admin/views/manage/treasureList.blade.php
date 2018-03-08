{{--列表--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">宝箱管理</h3>

<div class="well">
    <form class="form-inline search-group" role="form" action="{{ URL('manage/addTreasure') }}" method="post">
        {!! csrf_field() !!}
        <div class="form-group search-list ">
            <label for="">宝箱名称</label>
            <input type="text" name="name" style="width:200px" required="required">
        </div>
        <div class="form-group search-list">
            <label for="">宝箱级别</label>
            <select name="grade">
                <option value="">请选择</option>
                <option value="1">1级宝箱</option>
                <option value="2">2级宝箱</option>
                <option value="3">3级宝箱</option>
            </select>
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
            <th>宝箱名称</th>
            <th>宝箱级别</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
            @if(!empty($boxes))
            @foreach($boxes as $item)
                <tr>
                    <td>{!! $item['id'] !!}</td>
                    <td>{!! $item['name'] !!}</td>
                    <td>{!! $item['grade'] !!}级</td>
                    <td>{!! $item['created_at'] !!}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="treasureDet/{{ $item['id'] }}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                        <a class="btn btn-xs btn-info" href="box/{{ $item['id'] }}">
                            宝箱物品管理
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
           {!! $boxes->render() !!}
        </ul>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('questionlist', 'js/doc/questionlist.js') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}