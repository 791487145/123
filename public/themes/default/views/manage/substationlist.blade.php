<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li>
                <a href="/manage/area">地区配置</a>
            </li>
            <li class="active">
                <a href="/manage/substationConfig">分站点配置</a>
            </li>
        </ul>
    </div>
</div><!-- <div class="dataTables_borderWrap"> -->

<div class="row height56">
    <form method="post" action="/manage/addSubstation">
        <input type="hidden" name="tags" id="tags" value=""/>
        {!! csrf_field() !!}
        <div class="col-sm-3 stationlabel">
            <select multiple="" class="chosen-select tag-input-style" id="form-field-select-4" data-placeholder="请选择地区...">
                @if(!empty($district))
                    @foreach($district as $item)
                        <option value="{!! $item['id'] !!}"  >{!! $item['name'] !!}
                    @endforeach
                @endif

            </select>
            {!! $errors->first('tags_name') !!}
        </div>
        <div class="col-sm-9">
            <button href="javascript:;" class="btn btn-primary btn-sm" type="submit">添加</button>
        </div>
    </form>

</div>

<div class="">
    <form method="post" action="/manage/postEditSubstation">
        {{csrf_field()}}
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th >排序</th>
                <th width="50%" >名称</th>
                <th width="10%">热门站点</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="area_data_change">
            @if(!empty($list->toArray()['data']))
                @foreach($list->toArray()['data'] as $item)
                    <tr>
                        <td class="sort">
                            <input class="sub_sort" name="sort[{!! $item['id'] !!}]" value="{!! $item['sort'] !!}">
                        </td>
                        <td class="text-left">
                            {!! $item['name'] !!}
                        </td>
                        <td>
                            @if($item['status'] == 1)是@else 否 @endif
                        </td>
                        <td width="40%">
                            {{-- <span class="btn  btn-sm btn-primary edit" data-id="{!! $item['id'] !!}" >编辑</span>--}}
                            <span class="btn  btn-sm btn-danger" data-id="{!! $item['id'] !!}" >
                            <a href="/manage/deleteSubstation/{!!  $item['id']  !!}">删除</a>
                        </span>
                            @if($item['status'] == 1)
                                <span class="btn  btn-sm btn-primary miss_sub" data-id="{!! $item['id'] !!}" >取消热门
                            </span>
                            @else
                                <span class="btn  btn-sm btn-primary set_sub" data-id="{!! $item['id'] !!}" >设置热门
                            </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <button class="btn btn-primary" type="submit">保存</button>
    </form>


    {{--分页--}}
    <div class="col-xs-12">
        <div class="dataTables_paginate paging_bootstrap text-right">
            <ul class="pagination">
                {!! $list->render() !!}
            </ul>
        </div>
    </div>
</div>



{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}

{!! Theme::asset()->container('specific-css')->usepath()->add('chosen','plugins/ace/css/chosen.css') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('chosen','plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('paypassword','js/doc/substation.js') !!}
