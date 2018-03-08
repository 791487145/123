<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">银行卡绑定</h4>
    <div class="space"></div>
    <div class="form-group hidden-xs">
        <div data-target="#step-container" class="row-fluid" id="fuelux-wizard">
            <ul class="wizard-steps">
                <li class="active" data-target="#step1">
                    <span class="step">1</span>
                    <span class="title">填写信息</span>
                </li>
                <li data-target="#step2">
                    <span class="step">2</span>
                    <span class="title">打款中</span>
                </li>
                <li data-target="#step3">
                    <span class="step">3</span>
                    <span class="title">填写打入卡内金额</span>
                </li>
                <li data-target="#step4">
                    <span class="step">4</span>
                    <span class="title">认证成功</span>
                </li>
            </ul>
        </div>
    </div>
    <form class="registerform" action="{!! url('user/bankAuth') !!}" method="post">
        {!! csrf_field() !!}
        <ul class="xstxtleft">
            <li><div class="row task-casehid">
                <div class="space-10"></div>
                <div class="col-md-2 col-sm-3 col-xs-3 text-right h5">银行名称</div>
                    <div class="col-md-10 col-xs-9 bank-pdtop2">
                        <select class="set-pdl4 col-md-3" errormsg="请选择银行！" nullmsg="请选择银行！" datatype="*" name="bankname">
                            <option value="">请选择银行</option>
                            @foreach($bankname as $v)
                                <option value="{!! $v !!}">{!! $v !!}</option>
                            @endforeach
                        </select>
                    <span class="Validform_checktip vilid-wrprg">
                        <i class="fa fa-exclamation-circle cor-orange text-size18"></i> 仅支持该行储蓄卡，不支持信用卡和存折</span>
                    </div>
                <div class="space-2 col-md-12"></div>
            </div></li>
            <li><div class="row task-casehid">
                <div class="space-8"></div>
                <div class="col-md-2 col-sm-3 col-xs-3 text-right h5">开户行支行</div>
                    <div class="col-md-10 col-xs-9"><input type="text" nullmsg="请输入开户行名称！" name="depositName" class="col-sm-3 inputxt col-xs-12" datatype="zh4-20" errormsg="请输入4到20位中文字符"  />
                        <span class="col-md-8 Validform_checktip vilid-wrprg"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 须使用以"法定代表人名称"为银行开户名</span>
                    </div>
            </div></li>
            <li><div class="row task-casehid">
                <div class="space-8"></div>
                <div class="col-md-2 col-sm-3 col-xs-3 text-right h5">开户行地区</div>
                <div class="col-md-10 col-xs-9 bank-pdtop2">
                    <select name="province" id="province" onchange="getZone(this.value, 'city');">
                        <option value="">请选择省份</option>
                        @foreach($province as $item)
                        <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                        @endforeach
                    </select>
                    <select name="city" id="city" onchange="getZone(this.value, 'area');">
                        <option value="">请选择城市</option>
                    </select>
                    <select  errormsg="请选择地区！" nullmsg="请选择地区！" datatype="*" name="area" id="area">
                        <option value="">请选择地区</option>
                    </select>
                    <div class="space-6 hidden-lg"></div>
                    <span class="Validform_checktip mg-margin val-mdlveral"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 如果找不到所在城市，可以选择所在区或者上级城市</span>
                </div>
            </div></li>
            <li><div class="row task-casehid">
                <div class="space-10"></div>
                <div class="col-md-2 col-sm-3 col-xs-3 text-right h5">银行卡号</div>
                <div class="col-md-10 col-xs-9"><input type="text" nullmsg="请输入银行卡号！" class="inputxt col-sm-4 col-xs-12" datatype="n16-19" name="bankAccount" /><span class="Validform_checktip vilid-wrprg"></span></div>
            </div></li>
            <li><div class="row task-casehid">
                <div class="space-10"></div>
                <div class="col-md-2 col-sm-3 col-xs-3 text-right h5"><div class="row">确认银行卡号 &nbsp;&nbsp;&nbsp;</div></div>
                <div class="col-md-10 col-xs-9"><input type="text" nullmsg="请确认银行卡号！" class="inputxt col-sm-4 col-xs-12" datatype="n16-19" recheck="bankAccount" name="confirmBankAccount" /><span class="Validform_checktip vilid-wrprg"></span></div>
            </div></li>
        </ul>

        <div class="space-20"></div>
        <div class="text-center"><button  class="btn-big1 btn-blue bor-radius2 btn btn-primary btn-imp" type="submit" >立即申请</button></div>
    </form>
</div>



{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('bankauth-js', 'js/bankauth.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('main-js', 'js/main.js') !!}