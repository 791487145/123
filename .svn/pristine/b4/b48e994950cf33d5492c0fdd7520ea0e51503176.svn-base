
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="">
                <a href="{!! url('manage/payConfig') !!}" title="">支付配置</a>
            </li>
            <li class="active">
                <a href="{!! url('manage/thirdPay') !!}" title="">第三方支付平台接口</a>
            </li>
        </ul>
    </div>
</div>
<!--  /.page-header -->
<div class="row pay-api">
    <div class="col-sm-12">
        <!-- PAGE CONTENT BEGINS -->
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>支付接口名</th>
                <th>说明</th>
                <th>应用状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach($data as $item)
                    @if($item['alias'] != 'unionpay')
                <td>{!! $item['title'] !!}</td>
                <td>{!! $item['desc'] !!}</td>
                <td>@if($item['rule']['status'] == 1)启用@else禁用@endif</td>
                <td>
                    <div class="hidden-sm hidden-xs btn-group">
                        @if($item['rule']['status'] == 1)
                        <a href="{!! url('manage/thirdPayHandle/' . $item['id'] . "/disable") !!}" class="btn btn-xs btn-danger">
                            <i class="ace-icon fa fa-ban bigger-120"></i>禁用
                        </a>
                        @else
                        <a href="{!! url('manage/thirdPayHandle/' . $item['id'] . "/enable") !!}" class="btn btn-xs btn-success">
                            <i class="ace-icon fa fa-check bigger-120"></i>启用
                        </a>
                        @endif

                        <a href="{!! url('manage/thirdPayEdit/' . $item['id']) !!}" class="btn btn-xs btn-info">
                            <i class="ace-icon fa fa-asterisk bigger-120"></i>配置
                        </a>

                        <a class="btn btn-xs btn-warning">
                            <i class="ace-icon fa fa-user bigger-120"></i>
                            申请接口
                        </a>
                    </div>

                    <div class="hidden-md hidden-lg">
                        <div class="inline position-relative">
                            <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown"
                                    data-position="auto">
                                <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                <li>
                                    <a href="#" class="tooltip-info" data-rel="tooltip" title=""
                                       data-original-title="禁用">
                                    <span class="orange">
                                        <i class="ace-icon fa fa-ban bigger-120"></i>
                                    </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="tooltip-success" data-rel="tooltip" title=""
                                       data-original-title="配置">
                                    <span class="blue">
                                      <i class="ace-icon fa fa-asterisk bigger-120"></i>
                                    </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="tooltip-primary" data-rel="tooltip" title=""
                                       data-original-title="申请接口">
                                    <span class="default">
                                       <i class="ace-icon fa fa-user bigger-120"></i>
                                    </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            @endif
            @endforeach
            </tbody>
        </table>
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}