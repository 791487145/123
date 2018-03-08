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
        @if(!empty($arrAlipayAuth))
            @foreach($arrAlipayAuth as $item)
                <div class="col-md-4 col-sm-6">
                    <div @if($item->status == 3) class="g-realcardshow" @else class="g-realcardjs" @endif>
                        @if($item->status == 2 || $item->status == 4 || $item->status == 3)
                            <div class="g-realcardwrap">
                                <div @if($item->status == 2) class="g-realbankimg" @else class="g-realbankimg g-realdisable" @endif><img src="{!! Theme::asset()->url('images/alibank.jpg') !!}" /></div>
                                <div @if($item->status == 3) class="cor-gray51 g-realcardinfo g-hiden" @else class="cor-gray51 g-realcardinfo" @endif >{!! CommonClass::starReplace($item->alipay_account, -5, -10) !!}</div>
                            </div>
                            <a class="g-realcardhide" data-toggle="modal" @if($item->status == 3) href='{!! url('user/alipayAuthSchedule/' . Crypt::encrypt($item->id)) !!}' @else href="#myModa1" @endif>
                                <span class="btn-big bg-gary bor-radius2 auth"  @if($item->status == 3) href="{!! url('user/alipayAuthSchedule/' . Crypt::encrypt($item->id)) !!}" @endif data-toggle="modal" data-auth-id="{!! Crypt::encrypt($item->id) !!}" data-card="{!! substr($item->alipay_account, -4, 4) !!}">
                                    @if($item->status == 2)停用@elseif($item->status == 4)启用@elseif($item->status == 3)认证失败@endif
                                </span>
                            </a>
                        @else
                            <div class="g-realcardwrap">
                                <div class="g-realbankimg g-realdisable"><img src="{!! Theme::asset()->url('images/alibank.jpg') !!}" /></div>
                                <div class="cor-gray51 g-realcardinfo">@if($item->status == 0)正在审核中...@elseif($item->status == 1)正在验证中..@elseif($item->status == 3){!! CommonClass::starReplace($item->alipay_account, -5, -10) !!}@endif</div>
                            </div>
                            <a class="g-realcardhide" href='{!! url('user/alipayAuthSchedule/' . Crypt::encrypt($item->id)) !!}' >
                                <span class="btn-big bg-gary bor-radius2 auth" href="{!! url('user/alipayAuthSchedule/' . Crypt::encrypt($item->id)) !!}">
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
                <div class="text-size24 cor-gray97"><a class="cor-gray97" href="{!! url('user/alipayAuth') !!}"><i class="fa fa-plus text-size24"></i></a></div>
                <div><a href="{!! url('user/alipayAuth') !!}">添加支付宝账号</a></div>
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
                <form method="post" action="{!! url('user/changeAlipayAuth') !!}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="authId" id="authId">
                    <p class="text-size14 cor-gray71">
                        <span class="fa fa-exclamation-circle cor-orange text-size18"></span> 您是否要
                        <span class="action"></span>尾号为
                        <span id="card"></span>的支付宝账号</p>
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
{!! Theme::asset()->container('custom-js')->usePath()->add('bankauthlist-js', 'js/alipayauthlist.js') !!}