
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">作品配置</h3>
<div class="g-backrealdetails clearfix bor-border interface">
    <form class="form-horizontal" action="/manage/postGoodsConfig" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="change_ids" value="" id="change-ids">
        <div class="space-8 col-xs-12"></div>
            {{--<div class="widget-header widget-header-flat">
                <h5 class="widget-title">作品规则和作品资金设置</h5>
            </div>--}}

        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1  text-right">最小金额设定</label>
            <div class="col-sm-9 ">  <input type="text" name="min_price" @if(isset($goods_config['min_price']))value="{!! $goods_config['min_price'] !!}" @endif class="change_ids" > 元(设置作品上架金额不得小于X元，设为0即无限制)</div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1  text-right">交易提成比例</label>
            <div class="col-sm-9 "><input type="text" name="trade_rate" @if(isset($goods_config['trade_rate']))value="{!! $goods_config['trade_rate'] !!}" @endif  class="change_ids"> %(交易成功后，站长提取佣金的百分比，设为0即无抽佣)</div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1  text-right">维权时间配置</label>
            <div class="col-sm-9 "> <input type="text" name="legal_rights" @if(isset($goods_config['legal_rights']))value="{!! $goods_config['legal_rights'] !!}" @endif class="change_ids"> 小时(服务商交付以后，可以维权的等待时间为X小时，设未0即无限制)</div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1  text-right"> 文件确认配置</label>
            <div class="col-sm-9 "> <input type="text"  name="doc_confirm" @if(isset($goods_config['doc_confirm']))value="{!! $goods_config['doc_confirm'] !!}" @endif class="change_ids"> 天(交易完成后，X天未确认源文件，系统主动确认）</div>
        </div>
        <div class="interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">评价天数配置</label>
            <div class="col-sm-9 "> <input type="text" name="comment_days" @if(isset($goods_config['comment_days']))value="{!! $goods_config['comment_days'] !!}" @endif class="change_ids"> 天(交易完成X天后默认好评)</div>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10"><button type="submit" class="btn btn-sm btn-primary">提交</button></div>
                </div>
            </div>
        </div>
        {{--<div class="space"></div>
        <div class="text-right">
            <button type="submit" class="btn btn-info">提交</button>　　
        </div>--}}
    </form>
</div>
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
