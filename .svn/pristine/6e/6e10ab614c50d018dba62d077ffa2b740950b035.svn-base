{{--<div class="page-header">
    <h1>
        提现详情
    </h1>
</div><!-- /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">提现详情</h3>
<div class="g-backrealdetails clearfix bor-border">
    <div class="chearfix">
        {{--<div class="bankAuth-bottom clearfix col-xs-12">
            <p>用户：{!! $info->realname !!}</p>
        </div>
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p>提现方式：@if($info->cashout_type == 1)支付宝@elseif($info->cashout_type == 2){!! \App\Modules\User\Model\BankAuthModel::getBankname($info->cashout_account) !!}@endif</p>
        </div>
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p>账号：{!! $info->cashout_account !!}</p>
        </div>--}}
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">用户</p>
            <p class="col-md-11"><span class="text-primary">{!! $info->realname !!}</span></p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">提现方式</p>
            <p class="col-md-11"><span class="text-primary">@if($info->cashout_type == 1)支付宝@elseif($info->cashout_type == 2){!! \App\Modules\User\Model\BankAuthModel::getBankname($info->cashout_account) !!}@endif</span></p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">账号</p>
            <p class="col-md-11"><span class="text-primary">{!! $info->cashout_account !!}</span></p>
        </div>
    </div>
<div class="space col-xs-12"></div>
<div class="clear">
    <span class="pull-left">时间：{!! $info->created_at !!}</span>
    <span class="pull-right">单位/元</span>
</div>
<table id="sample-table-1" class="table table-striped table-bordered table-hover" style="vertical-align:middle; text-align:center;">
    <thead>
        <tr>
            <th>流水编号</th>
            <th>收款方</th>
            <th>提现金额</th>
            <th>手续费</th>
            <th>到账金额</th>
            <th>状态</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>
               {!! $info->id !!}
            </td>
            <td>{!! $info->realname !!}</td>
            <td>￥{!! $info->cash !!}元</td>
            <td>￥{!! $info->fees !!}元</td>
            <td>
                ￥{!! $info->real_cash !!}元
            </td>
            <td>
                @if($info->status == 0)待审核@elseif($info->status == 1)已打款@elseif($info->status == 2)未通过审核@endif
            </td>
        </tr>
    </tbody>
</table>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}