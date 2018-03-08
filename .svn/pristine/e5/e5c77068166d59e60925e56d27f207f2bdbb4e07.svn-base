<!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">
    <!-- /section:basics/sidebar -->
    <div class="main-content">
        <!-- #section:basics/content.breadcrumbs -->
        {{--<div class="breadcrumbs" id="breadcrumbs">--}}
            {{--<script type="text/javascript">--}}
                {{--try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}--}}
            {{--</script>--}}

            {{--<ul class="breadcrumb">--}}
                {{--<li>--}}
                    {{--<i class="ace-icon fa fa-tasks home-icon"></i>--}}
                    {{--<a href="#">增值工具</a>--}}
                {{--</li>--}}
                {{--<li class="active">购买记录</li>--}}
            {{--</ul><!-- /.breadcrumb -->--}}
            {{--<!-- /section:basics/content.searchbox -->--}}
        {{--</div>--}}

        <div class="page-content-area">
            <div class="">
                <div class="col-xs-12 widget-container-col ui-sortable">
                    <div class="widget-box transparent ui-sortable-handle">

                        <div class="widget-body">
                            <div class="widget-main padding-12 no-padding-left no-padding-right">
                                <div class="tab-content padding-4">
                                    <div id="basic" class="tab-pane active">
                                        <form action="/manage/serviceBuy" method="get">
                                            <div class="widget-box">
                                                <div class="widget-header widget-header-flat">
                                                    <h5 class="widget-title">搜索</h5>
                                                </div>
                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover text-left">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="text-left">
                                                                        编号：<input type="text" name="id" value="{{$id}}">
                                                                    </td>
                                                                    <td class="text-left">
                                                                        购买用户：<input type="text" name="name" value="{{$name}}">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left">
                                                                        工具名称：<input type="text" name="title" value="{{$title}}">
                                                                    </td>
                                                                    <td class="text-left">
                                                                        结果排序：<select  name="by">
                                                                            <option value="sub_order.id"@if($by == 'sub_order.id')selected="selected"@endif>默认排序</option>
                                                                            <option value="sub_order.created_at" @if($by == 'sub_order.created_at')selected="selected"@endif>购买时间</option>
                                                                        </select>
                                                                        <select name="order">
                                                                            <option value="ASC"@if($order == 'ASC')selected="selected"@endif>递增</option>
                                                                            <option value="DESC"@if($order == 'DESC')selected="selected"@endif>递减</option>
                                                                        </select>
                                                                        <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="space-6"></div>
                                        <div class="well h4 blue">购买列表</div>
                                        <form action="" method="post">
                                            {{csrf_field()}}
                                            <div>
                                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">
                                                            <label>
                                                                {{--<input type="checkbox" class="ace" />--}}
                                                                <span class="lbl"></span>
                                                                编号
                                                            </label>
                                                        </th>
                                                        <th>工具名称</th>
                                                        <th class="hidden-480">购买用户</th>
                                                        <th class="hidden-480">使用花费</th>
                                                        <th>购买数量</th>
                                                        <th>购买时间 </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @if(!empty($list))
                                                    @foreach($list['data'] as $item)
                                                    <tr>
                                                        <td class="center">
                                                            <label>
                                                                {{--<input type="checkbox" name="id_{!! $item->id !!}" class="ace" value="{{ $item['id'] }}"/>--}}
                                                                <span class="lbl"></span>
                                                                {{ $item['id'] }}
                                                            </label>
                                                        </td>

                                                        <td>
                                                            {{ $item['title'] }}
                                                        </td>
                                                        <td class="hidden-480">
                                                            {{ $item['name'] }}
                                                        </td>
                                                        <td>
                                                            {{ $item['cash'] }}
                                                        </td>
                                                        <td>
                                                            {{ $item['cash']/$item['price'] }}
                                                        </td>
                                                        <td>
                                                            {{ $item['created_at'] }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="dataTables_info" id="sample-table-2_info">
                                                        {{--<label><input type="checkbox" class="ace" id="allcheck"/>--}}
                                                            {{--<span class="lbl"></span>全选--}}
                                                        {{--</label>--}}
                                                        {{--<button id="all_delete" type="submit">批量删除</button>--}}
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="dataTables_paginate paging_bootstrap">
                                                        <ul class="pagination">
                                                            @if(!empty($list['prev_page_url']))
                                                                <li><a href="{!! URL('manage/serviceBuy').'?'.http_build_query(array_merge($merge,['page'=>$list['current_page']-1])) !!}">上一页</a></li>
                                                            @endif
                                                            @if($list['last_page']>1)
                                                                @for($i=1;$i<=$list['last_page'];$i++)
                                                                    <li class="{{ ($i==$list['current_page'])?'active disabled':'' }}"><a href="{!! URL('manage/serviceBuy').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
                                                                @endfor
                                                            @endif
                                                            @if(!empty($list['next_page_url']))
                                                                <li><a href="{!! URL('manage/serviceBuy').'?'.http_build_query(array_merge($merge,['page'=>$list['current_page']+1])) !!}">下一页</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content-area -->
    </div><!-- /.main-content -->

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('datepicker', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('touch-punch', 'plugins/ace/js/jquery.ui.touch-punch.min.js') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('autosize', 'plugins/ace/js/jquery.autosize.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('inputlimiter', 'plugins/ace/js/jquery.inputlimiter.1.3.1.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('maskedinput', 'plugins/ace/js/jquery.maskedinput.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('hotkeys', 'plugins/ace/js/jquery.hotkeys.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('wysiwyg', 'plugins/ace/js/bootstrap-wysiwyg.min.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('dataTab', 'plugins/ace/js/dataTab.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_dataTables', 'plugins/ace/js/jquery.dataTables.bootstrap.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('articlelist', 'js/doc/articlelist.js') !!}


