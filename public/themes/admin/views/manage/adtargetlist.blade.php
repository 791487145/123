<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="/advertisement/adTarget">广告位管理</a>
            </li>
            <li class="">
                <a href="/advertisement/adList">广告列表</a>
            </li>
        </ul>
    </div>
</div>



<div class="g-backrealdetails clearfix bor-border interface">
    <div>
    <table class="table table-hover">
        <tbody>
        <tr>
            @foreach($adTargetList as $itemK=>$itemV)
            @if( $itemK%2 == 0)
            </tr>
            <tr>
            @endif
            <td class="text-left">
                <div class="pull-left">
                    <img src="{!! $itemV->pic !!}">
                </div>
                <div class="text-left pull-left">
                    <p>广告位置：<a href="javascript:;">{!! $itemV->name !!}</a></p>
                    <p>广告数量：{!! $itemV->ad_num !!} 条</p>
                    <p>已投放：{!! $itemV->deliveryNum !!} 条</p>
                    <p>广告位代码:{!! $itemV->code !!}</p>
                </div>
                <div style="margin-left: 30%">
                    　<a href="/advertisement/adList/{!! $itemV->target_id !!}" class="btn btn-primary btn-sm">查看</a>
                </div>
            </td>
            @endforeach
        </tr>
        </tbody>
    </table>
    </div>
</div>
<div class="space"></div>
<div class="dataTables_paginate paging_bootstrap text-right row">
    {!! $adTargetList->render() !!}
</div>


{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
