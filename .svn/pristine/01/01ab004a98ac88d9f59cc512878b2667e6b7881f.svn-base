
<form action="#" method="post">
    {{csrf_field()}}
    {{--<div class="space-6"></div>
    <div class="well h4 blue">模板列表</div>--}}
    <h3 class="header smaller lighter blue mg-bottom20 mg-top12">模板列表</h3>
    <div>
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>配置编号</th>
                <th>配置名称</th>
                <th>配置代号</th>
                <th>基本配置</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            @if(!empty($message_list))
            @foreach($message_list as $item)
            <tr>
                <td class=" id" data-id="{!! $item->id !!}">
                    {!! $item->id !!}
                </td>
                <td>
                    {!! $item->name !!}
                </td>
                <td>
                    {!! $item->code_name !!}
                </td>
                <td>
                    <span>
                        <input type="radio" name="is_open_{!! $item->id !!}" value="1" class="is_open" @if($item->is_open == 1)checked="checked"@endif>开启
                        <input type="radio" name="is_open_{!! $item->id !!}" value="2" class="is_open" @if($item->is_open == 2)checked="checked"@endif>关闭
                    </span>
                    @if($item->is_open == 1)
                    <span>
                        <input type="checkbox" name="is_on_site" value="1" class="is_on_site" @if($item->is_on_site == 1)checked @endif>站内信息
                    </span>
                    <span>
                        <input type="checkbox" name="is_on_site" value="1" class="is_send_email"@if($item->is_send_email == 1)checked @endif>发送邮件
                    </span>
                    @endif
                </td>

                <td>
                    <div class="hidden-sm hidden-xs btn-group">
                        <a class="btn btn-xs btn-info" href="/manage/editMessage/{!! $item->id !!}">
                            <i class="fa fa-edit bigger-120"></i>编辑模板
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="dataTables_paginate paging_bootstrap text-right row" id="dynamic-table_paginate">
                @if(!empty($message_list)){!! $message_list->render() !!}@endif
            </div>
        </div>
    </div>
</form>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
<!-- basic scripts -->
{!! Theme::asset()->container('custom-js')->usePath()->add('messagelist', 'js/doc/messagelist.js') !!}
