<!-- /section:basics/sidebar -->


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
	            {{--<li class="">--}}
	                {{--<i class="ace-icon fa fa-tasks home-icon"></i>--}}
	                {{--<a href="/manage/serviceList">增值工具</a>--}}
	            {{--</li>--}}
	            {{--<li class="">--}}
	                {{--<a href="/manage/serviceList">增值工具管理</a>--}}
	            {{--</li>--}}
	            {{--<li class="active">增值工具配置</li>--}}
	        {{--</ul><!-- /.breadcrumb -->--}}
	        {{--<!-- /section:basics/content.searchbox -->--}}
	    {{--</div>--}}
	
	    <!-- /section:basics/content.breadcrumbs -->
	    <div class="page-content-area">
	        <div class="">
	            <div class="col-xs-12 widget-container-col ui-sortable">
	                    <div id="flow" class="tab-pane row">
	                        <div class="">
	                            <div class="space"></div>
	                            <div class="widget-box">
	                                <div class="widget-header widget-header-flat">
	                                    <h5 class="widget-title">增值工具配置</h5>
	                                </div>
	
	                                <div class="widget-body">
	                                    <div class="widget-main row paddingTop paddingBottom">
	                                        <div class="">
	                                            <form action="/manage/addService" method="post">
	                                                {{ csrf_field() }}
	                                                <table class="editservics-table">
	                                                <tbody>
	                                                <tr>
	                                                    <td class="col-xs-2">工具名称：</td>
	                                                    <td class="text-left col-xs-10">
	                                                       <input type="text" name="title" id="title" value="">
	                                                        {{ $errors->first('title') }}
	                                                    </td>
	                                                </tr>
													<tr>
														<td class="col-xs-2">工具代号：</td>
														<td class="text-left col-xs-10">
															<input type="text" name="identify" id="identify" value="">
															{{ $errors->first('identify') }}
														</td>
													</tr>
	                                                <tr>
	                                                    <td class="">服务费用：</td>
	                                                    <td class="text-left">
	                                                        <input type="number" name="price" id="price" value="">
	                                                        {{ $errors->first('price') }}
	                                                    </td>
	                                                </tr>
													<tr>
														<td class="">服务类型：</td>
														<td class="text-left">
															<select name="type">
																<option value="1">任务</option>
																<option value="2">店铺</option>
															</select>
															{{ $errors->first('type') }}
														</td>
													</tr>
	                                                <tr>
	                                                    <td class="">工具说明：</td>
	                                                    <td class="text-left">
	                                                        <textarea rows="5" cols="35" name="description"></textarea>
	                                                    </td>
	                                                </tr>
	                                                <tr>
	                                                    <td class="">是否启用：</td>
	                                                    <td class="text-left">
	                                                        <label class="">
	                                                            <input type="radio"  name="status" value="1" checked/>
	                                                            <span class="lbl"></span>是
	                                                            <input type="radio" name="status" value="2"/>
	                                                            <span class="lbl"></span>否
	                                                        </label>
	                                                    </td>
	                                                </tr>
	
	                                                <tr>
	                                                    <td class=""></td>
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
<!-- basic scripts -->
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}