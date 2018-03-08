<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="/advertisement/recommendList">推荐位管理</a>
            </li>
            <li class="">
                <a href="/advertisement/serverList">推荐位列表</a>
            </li>
        </ul>
    </div>
</div>

<div class="g-backrealdetails clearfix bor-border interface">
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
            <tr>
                @foreach($recommendList as $itemK=>$itemV)
                    @if( $itemK%2 == 0)
            </tr>
            <tr>
                @endif
                <td class="text-left">
                    <div class="pull-left">
                        <img src="{!! $itemV->pic !!}">
                    </div>
                    <div class="text-left pull-left">
                        <p>推荐位置：<a href="javascript:;">{!! $itemV->position !!}</a></p>
                        <p>名称：<input type="text" value="{!! $itemV->name !!}" rel="{!! $itemV->id !!}" onblur="changeName(this)"></p>
                        <p>广告数量：{!! $itemV->num !!} 条</p>
                        <p>已投放：{!! $itemV->deliveryNum !!} 条</p>
                    </div>
                    <div style="margin-left: 30%">
                        <a href="/advertisement/serverListByID/{!! $itemV->id !!}" class="btn btn-primary btn-sm">查看</a>
                    </div>
                </td>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="space"></div>
<div class="dataTables_paginate paging_bootstrap row">
    {!! $recommendList->render() !!}
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('nameedit-js', 'js/doc/nameedit.js') !!}
