<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">银行卡绑定</h4>
    <div class="space-10"></div>
    {{--<h5 class="cor-gray51">查看绑定</h5>
    <div class="space-10"></div>--}}
    <div class="alert g-alertreal clearfix" role="alert">
        <i class="fa fa-lightbulb-o pull-left"></i>
        <span class="text-size12">友情提示：以下账户信息以您提交的信息为准，非本站金融体系，请妥善填写，如出现信息误差，自行负责。如对支付认证有任何疑问，请直接
            <a class="text-under" href="{!! CommonClass::contactClient(Theme::get('basis_config')['qq']) !!}" target="_blank">联系客服</a>。</span>
    </div>
    <div class="row text-center g-realcardlist">
        @if(!empty($arrBankAuth))
            @foreach($arrBankAuth as $item)
        <div class="col-md-4 col-sm-6">
            <div @if($item->status == 3) class="g-realcardshow" @else class="g-realcardjs" @endif>
                <div class="g-realcardwrap">
                    <div @if($item->status == 2) class="g-realbankimg" @else class="g-realbankimg g-realdisable" @endif>
                        @if($item->bank_name == '光大银行')
                        <img src="{!! Theme::asset()->url('images/bank/gdyh.jpg') !!}" />
                        @elseif($item->bank_name == '华夏银行')
                        <img src="{!! Theme::asset()->url('images/bank/hxyh.jpg') !!}" />
                        @elseif($item->bank_name == '建设银行')
                        <img src="{!! Theme::asset()->url('images/bank/jsyh.jpg') !!}" />
                        @elseif($item->bank_name == '交通银行')
                        <img src="{!! Theme::asset()->url('images/bank/jtyh.jpg') !!}" />
                        @elseif($item->bank_name == '民生银行')
                        <img src="{!! Theme::asset()->url('images/bank/msyh.jpg') !!}" />
                        @elseif($item->bank_name == '农村信用社')
                        <img src="{!! Theme::asset()->url('images/bank/ncxys.jpg') !!}" />
                        @elseif($item->bank_name == '农业银行')
                        <img src="{!! Theme::asset()->url('images/bank/nyyh.jpg') !!}" />
                        @elseif($item->bank_name == '平安银行')
                        <img src="{!! Theme::asset()->url('images/bank/payh.jpg') !!}" />
                        @elseif($item->bank_name == '浦发银行')
                        <img src="{!! Theme::asset()->url('images/bank/pfyh.jpg') !!}" />
                        @elseif($item->bank_name == '兴业银行')
                        <img src="{!! Theme::asset()->url('images/bank/xyyh.jpg') !!}" />
                        @elseif($item->bank_name == '邮政储蓄')
                        <img src="{!! Theme::asset()->url('images/bank/yzcx.jpg') !!}" />
                        @elseif($item->bank_name == '招商银行')
                        <img src="{!! Theme::asset()->url('images/bank/zsyh.jpg') !!}" />
                        @elseif($item->bank_name == '中国银行')
                        <img src="{!! Theme::asset()->url('images/bank/zgyh.jpg') !!}" />
                        @endif
                    </div>
                    <div @if($item->status == 3) class="cor-gray51 g-realcardinfo g-hiden" @else class="cor-gray51 g-realcardinfo" @endif>@if($item->status == 0)正在审核中...@elseif($item->status == 1)正在验证中..@else {!! CommonClass::starReplace($item->bank_account, -5, -10) !!} @endif</div>
                </div>
                @if($item->status == 2 || $item->status == 4 || $item->status == 3)
                <a class="g-realcardhide" @if($item->status == 3) href="{!! url('user/bankAuthSchedule/' . Crypt::encrypt($item->id)) !!}" @else href="#myModa1" @endif data-toggle="modal">
                    <span class="btn-big bg-gary bor-radius2 auth" data-auth-id="{!! Crypt::encrypt($item->id) !!}" data-card="{!! substr($item->bank_account, -4, 4) !!}">
                        @if($item->status == 2)停用@elseif($item->status == 4)启用@elseif($item->status == 3)认证失败@endif
                    </span>
                </a>
                @else
                <a class="g-realcardhide" href="{!! url('user/bankAuthSchedule/' . Crypt::encrypt($item->id)) !!}">
                    <span class="btn-big bg-gary bor-radius2 auth">
                        @if($item->status == 0)待审核@elseif($item->status == 1)待验证@elseif($item->status == 3)认证失败@endif
                    </span>
                </a>
                @endif
            </div>
        </div>
            @endforeach
        @endif
        <div class="col-md-4 col-sm-6">
            <div class="g-realwrapplus">
                <div class="space-20"></div>
                <div class="text-size24 cor-gray97"><a class="cor-gray97" href="{!! url('user/bankAuth') !!}"><i class="fa fa-plus text-size24"></i></a></div>
                <div><a href="{!! url('user/bankAuth') !!}">添加银行卡</a></div>
            </div>
        </div>
    </div>
</div>

<!-- 模态框（Modal） -->
<div class="modal fade" id="myModa1" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header widget-header-flat">
                    <span class="modal-title action" id="myModalLabel">

                    </span>：
            </div>
            <div class="modal-body text-center taskupload">
                <div class="space-6"></div>
                <form method="post" action="{!! url('user/changeBankAuth') !!}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="authId" id="authId">
                <p class="text-size14 cor-gray71">
                    <span class="fa fa-exclamation-circle cor-orange text-size18"></span> 您是否要
                    <span class="action"></span>尾号为
                    <span id="card"></span>的储蓄卡的绑定</p>
                <div class="space-10"></div>
                <button type="submit" class="btn btn-primary btn-sm modal-btn" >确 定</button>
                <button type="button" class="btn bg-gary btn-sm modal-btn" data-dismiss="modal">取 消</button>
                <div class="space"></div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>


{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('bankauthlist-js', 'js/bankauthlist.js') !!}