<!-- /section:basics/sidebar -->

    {{--<!-- #section:basics/content.breadcrumbs -->--}}
    {{--<div class="breadcrumbs" id="breadcrumbs">--}}
        {{--<script type="text/javascript">--}}
            {{--try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}--}}
        {{--</script>--}}

        {{--<ul class="breadcrumb">--}}
            {{--<li>--}}
                {{--<i class="ace-icon fa fa-tasks home-icon"></i>--}}
                {{--<a href="#">页脚配置</a>--}}
            {{--</li>--}}
            {{--<li class="active">友情链接</li>--}}
        {{--</ul><!-- /.breadcrumb -->--}}
        {{--<!-- /section:basics/content.searchbox -->--}}
    {{--</div>--}}

    <!-- /section:basics/content.breadcrumbs -->


                    <div class="widget-header mg-bottom20 mg-top12 widget-well">
                        <div class="widget-toolbar no-border pull-left no-padding">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#basic">友情链接</a>
                                </li>

                                <li class="">
                                    <a data-toggle="tab" href="#flow">添加</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget-body">

                        <div class="widget-main paddingTop no-padding-left no-padding-right">
                            <div class="tab-content padding-4">
                                <div id="basic" class="tab-pane active">
                                    <form class="form-inline" role="form" action="/manage/link" method="get">
                                        <div class="well">
                                            <div class="form-group search-list ">
                                                <label for="">链接名称　</label>
                                                <input type="text" name="title" value="@if(isset($title)){!! $title !!}@endif">
                                            </div>
                                            <div class="form-group search-list ">
                                                <label for="">链接地址　</label>
                                                <input type="text" name="content" value="@if(isset($content)){!! $content !!}@endif">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-sm" type="submit">搜索</button>
                                            </div>
                                            <div class="space"></div>
                                            <div class="form-group search-list">
                                                <label for="namee">添加时间　　</label>
                                                <div class="input-daterange input-group">
                                                    <input type="text" name="start" class="input-sm form-control" @if(isset($search['start']))value="{!! $search['start'] !!}" @endif>
                                                    <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                                                    <input type="text" name="end" class="input-sm form-control" @if(isset($search['end']))value="{!! $search['end'] !!}" @endif>
                                                </div>
                                            </div>
                                            <div class="form-group search-list width285">
                                                <label for="">状态　</label>
                                                <select name="status">
                                                    <option value="0" {{ ($status==0)?'selected':'' }}>全部</option>
                                                    <option value="1" {{ ($status==1)?'selected':'' }}>开启</option>
                                                    <option value="2"  {{ ($status==2)?'selected':'' }}>关闭</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="/manage/allDeleteLink" method="post">
                                        {{csrf_field()}}
                                        <div>
                                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="center">
                                                        <label>
                                                            <input type="checkbox" class="ace allcheck"/>
                                                            <span class="lbl"></span>
                                                            UID
                                                        </label>
                                                    </th>
                                                    <th>链接名称</th>
                                                    <th>链接地址</th>
                                                    <th>添加时间</th>
                                                    <th>排序</th>
                                                    <th>状态</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($linkList as $v)
                                                    <tr>
                                                        <td class="center">
                                                            <label>
                                                                {{--<input type="checkbox" class="ace" name="chk"/>--}}
                                                                <input type="checkbox" name="chk  allcheck" class="ace " value="{!! $v->id !!}"/>
                                                                <span class="lbl"></span>
                                                                {{ $v['id'] }}
                                                            </label>
                                                        </td>

                                                        <td>
                                                            {{ $v['title'] }}
                                                        </td>
                                                        <td>
                                                            {{ $v['content'] }}
                                                        </td>
                                                        <td>
                                                            {{ $v['addtime'] }}
                                                        </td>
                                                        <td>
                                                            {{ $v['sort'] }}
                                                        </td>
                                                        <td>
                                                            @if( $v['status']  ==1)启用 @else()禁用 @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a class="btn btn-xs btn-info" href="/manage/editlink/{{  $v['id'] }}">
                                                                    <i class="fa fa-edit bigger-120"></i>编辑
                                                                </a>
                                                                </a>

                                                                @if($v->status == 1)
                                                                    <a class="btn btn-xs btn-danger" href="{!! url('manage/handleLink/' . $v->id . '/disable') !!}">
                                                                        <i class="fa fa-ban bigger-120"></i> 禁用
                                                                    </a>
                                                                @elseif($v->status ==2 )
                                                                    <a class="btn btn-xs btn-success" href="{!! url('manage/handleLink/' . $v->id . '/enable') !!}">
                                                                        <i class="fa fa-check bigger-120"></i> 启用
                                                                    </a>
                                                                @endif
                                                                <a title="删除" class="btn btn-xs btn-danger" href="/manage/deletelink/{{ $v['id'] }}">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                                                </a>
                                                            </div>
                                                            <div class="hidden-md hidden-lg hidden-sm hidden-xs">
                                                                <div class="inline position-relative">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-left dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="" data-original-title="View">
																				<span class="blue">
																					<i class="fa fa-edit bigger-120"></i>
																				</span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
																				<span class="green">
																					<i class="fa fa-check bigger-120"></i>
																				</span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>
																				</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="dataTables_info row" id="sample-table-2_info" role="status" aria-live="polite">
                                                    <button class="btn btn-primary btn-sm" id="largeDel">批量删除</button>
                                                </div>
                                            </div>
                                            <div class="space-10 col-xs-12"></div>
                                            <div class="col-xs-12">
                                                <div class="dataTables_paginate paging_simple_numbers row text-right" id="dynamic-table_paginate">
                                                    {!! $linkList->appends($search)->render() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div id="flow" class="tab-pane">
                                    <div class="g-backrealdetails clearfix bor-border interface">
                                        <form action="/manage/addlink" method="post" enctype="multipart/form-data" class="registerform"  onsubmit="return checkform()">
                                            {{ csrf_field() }}
                                            <table class="table table-hover">
                                                <tbody>
                                                <tr>
                                                    <td class="text-right">链接名称：</td>
                                                    <td class="text-left">
                                                        <input type="text" name="title"  datatype="*">
                                                        <i class="light-red ace-icon fa fa-asterisk"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">链接封面：
                                                    </td>

                                                    <td class="text-left">
                                                        <div class="memberdiv pull-left">
                                                            <div class="position-relative">
                                                                <input multiple="" type="file" id="id-input-file-3" name="pic" />
                                                            </div>
                                                        </div>
                                                        <label class="sys-infotop">
                                                            <span class="cor-gray87">
                                                                <i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>
                                                                位于首页底部，建议图片尺寸大小150px*55px
                                                            </span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">链接地址：</td>
                                                    <td class="text-left">
                                                        <input type="text" class="col-sm-6" name="content" datatype="url">
                                                        <i class="light-red ace-icon fa fa-asterisk"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">排序：</td>
                                                    <td class="text-left">
                                                        <div class="clearfix pull-left">
                                                            <input type="text" class="input-mini" id="spinner3" name="sort"/>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"></td>
                                                    <td class="text-left">
                                                        <button class="btn btn-primary btn-sm" type="submit">提交</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

{{--<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>--}}
<!-- basic scripts -->

<!--图片-->
<script type="text/javascript">
    jQuery(function($) {


        $('#id-input-file-3').ace_file_input({
            style:'well',
            btn_choose:'上传图片',
            btn_change:null,
            no_icon:' ace-icon ace-icon fa fa-picture-o',
            droppable:true,
            thumbnail:'small'//large | fit
            //,icon_remove:null//set null, to hide remove/reset button
            /**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
            /**,before_remove : function() {
						return true;
					}*/
            ,
            preview_error : function(filename, error_code) {
                //name of the file that failed
                //error_code values
                //1 = 'FILE_LOAD_FAILED',
                //2 = 'IMAGE_LOAD_FAILED',
                //3 = 'THUMBNAIL_FAILED'
                //alert(error_code);
            }

        }).on('change', function(){
            //console.log($(this).data('ace_input_files'));
            //console.log($(this).data('ace_input_method'));
        });

        $('#spinner3').ace_spinner({
            value:0,
            min:0,
            max:100,
            step:1,
            on_sides: true,
            icon_up:'ace-icon fa fa-plus smaller-75',
            icon_down:'ace-icon fa fa-minus smaller-75',
            btn_up_class:'btn-success' ,
            btn_down_class:'btn-danger'
        });



    });
    function checkform(){
        var filepath = $("input[name='pic']").val();
        if(filepath == ""){
            alert('请上传图片');
            return false;
        }
        var extStart=filepath.lastIndexOf(".");
        var ext=filepath.substring(extStart,filepath.length).toUpperCase();
        if(ext!=".BMP"&&ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
            alert("图片限于bmp,png,gif,jpeg,jpg格式");
            return false;
        }

    }
</script>
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('bootstrap-datetimepicker.css', 'plugins/ace/css/bootstrap-datetimepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('fuelux.spinner.min.js', 'plugins/ace/js/fuelux/fuelux.spinner.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('moment', 'plugins/ace/js/date-time/moment.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepickertime-js', 'plugins/ace/js/date-time/bootstrap-datetimepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('datefuelux-js', 'js/doc/datefuelux.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('checked-js', 'js/checkedAll.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('linkManage-js', 'js/linkManage.js') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}

{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}