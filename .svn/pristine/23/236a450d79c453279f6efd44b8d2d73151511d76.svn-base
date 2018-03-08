
{{--<div class="page-header pay-api">--}}
    {{--<ul class="nav nav-pills nav-justified">--}}
        {{--<li role="presentation" class="active"><a href="{!! url('manage/payConfig') !!}" title="">支付配置</a></li>--}}
        {{--<li role="presentation"><a href="{!! url('manage/thirdPay') !!}" title="">第三方支付平台接口</a></li>--}}
    {{--</ul>--}}
{{--</div>--}}
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="{!! url('manage/generalize_config') !!}" title="">添加推广员</a>
            </li>
        </ul>
    </div>
</div>
<div class="well">
    <form class="form-inline search-group" role="form" action="{{ URL('manage/generalize') }}" method="post">
        {!! csrf_field() !!}
        <div class="form-group search-list ">
            <label for="">推广员手机号</label>
            <input type="text" name="mobile" style="width:200px" required="required">
        </div>
        <div class="form-group search-list ">
            <label for="">推广方案</label>
            <select name="plan_id">
                @if(!empty($data))
                    <option value="">请选择方案</option>
                @foreach($data as $v)
                        <option value="{!! $v->id !!}">方案{!! $v->id !!}</option>
                @endforeach
                @else
                    <option value="">暂无方案</option>
                @endif
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">添加</button>
        </div>

    </form>

</div>



<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="{!! url('manage/generalize_config') !!}" title="">推广配置列表</a>
            </li>
            <li class="">
                <a href="{!! url('manage/addGeneralize_config') !!}">添加配置</a>
            </li>
        </ul>
    </div>
</div>
<div>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>方案编号</th>
            <th>一级推广金额</th>
            <th>二级推广金额</th>
            <th>三级推广金额</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($data))
            @foreach($data as $item)
                <tr>
                    <td>{!! $item->id !!}</td>
                    <td>{!! $item->one_sum !!}</td>
                    <td>{!! $item->two_sum !!}</td>
                    <td>{!! $item->three_sum !!}</td>
                    <td>
                        <div class="hidden-sm hidden-xs btn-group">
                            <a class="btn btn-xs btn-info" href="/manage/upGeneralize_config/{!! $item->id !!}">
                                <i class="fa fa-edit bigger-120"></i>编辑
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>






{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}