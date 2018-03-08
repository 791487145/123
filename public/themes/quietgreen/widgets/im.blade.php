{!! Theme::asset()->container('im-css')->usepath()->add('im-css','css/im.css') !!}
{!! Theme::asset()->container('im-css')->styles() !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('im-js', 'js/im.js') !!}

<div class="im clearfix hidden-xs">
    <div class="im-side pull-left im-info ">
        <ul class="mg-margin0 pd-padding0 ">
            <!--<li class="im-side-itm clearfix listImg">-->
            <!--<div class="pull-left ">-->
            <!--<img src="../images/evaluate.jpg" alt="..." class="img-circle chat-head" width="28" height="28"/>-->
            <!--</div>-->
            <!--<div class="im-side1-title ">-->
            <!--<h4 class="f-size12 mg-margin0 title-tit chat-name"></h4>-->
            <!--</div>-->
            <!--</li>-->
            <!--<li class="im-side-itm clearfix">-->
            <!--<div class="pull-left">-->
            <!--<img src="../images/weedout.png" alt="..." class="img-circle chat-head1" width="28" height="28"/>-->
            <!--</div>-->
            <!--<div class="im-side1-title">-->
            <!--<h4 class="f-size12 mg-margin0 title-tit chat-name1"></h4>-->
            <!--</div>-->
            <!--</li>-->
        </ul>
    </div>
    <div class="im-side1 pull-left im-info im-ck ">
        <div class="text-right im-side1-colos">
            <a href=""><i class="fa fa-close imClose" data-dismiss="alert"></i></a>
        </div>
        <div class="im-side1-list1 clearfix">
            <div class="pull-left chat-t-head">
                <img src="" alt="..." class="img-circle" width="44" height="44"/>
            </div>
            <div class="im-side1-title">
                <h4 class="f-size16 mg-margin0 title-tit cor-gury51 chat-t-name"></h4>

                <p class="cor-gury9c f-size12 tit-time mg-margin0 chat-t-sign"></p>
            </div>
        </div>
        <div class="im-side1-list2 clearfix">
            <ul class="pd-padding0  mg-margin0 clearfix" id="talkarea">
                <!-- 聊天区域 -->
            </ul>
        </div>
        <div class="im-side1-list3 clearfix">
            <textarea name="" id="chat-text" cols="30" rows="100%" placeholder="说点什么"
                      class="im-side1-list3-input"></textarea>

            <div class="text-right">
                <button class="btn im-btn"><i class="fa  fa-paper-plane"></i> 发送</button>
            </div>
        </div>
    </div>
    <div class="im-side2 pull-left">
        @if(Auth::check())
            <div class=" collapse in im-info imContact-info ">
                <div class="im-side1-list1 clearfix">
                    <div class="pull-left">
                        <img src="@if(!empty(Theme::get('avatar'))) {!!  url(Theme::get('avatar')) !!} @else {!! Theme::asset()->url('images/defaulthead.png') !!} @endif" alt="..." class="img-circle" width="63" height="63"/>
                    </div>
                    <div class="im-side1-title">
                        <p class=" title-tit">
                            <a class="f-size14 cor-gury51">{!! Theme::get('username') !!}</a>
                        </p>

                        <p class="cor-gury9c f-size12 tit-time mg-margin0">
                            <a href="javascript:;"><i class="fa fa-envelope"></i></a>
                            <a href="{!! url('user/messageList/4') !!}">进入消息中心</a>
                        </p>
                        <a href="" class="im-colose-x"><i class="fa fa-close imClose" data-dismiss="alert"></i></a>
                    </div>
                </div>
                <div class="im-side1-list2 clearfix">
                    {{--<div class="im-seach clearfix">
                        <i class="fa fa-search search-btn"></i>
                        <input type="text" class="form-control search-wrapper col-xs-12" placeholder="搜索...">
                        <i class="fa fa-close search-close ds-none"></i>
                    </div>--}}
                    <!--无搜索状态-->
                    <!--<div class="text-center no-search">-->
                    <!--无搜索结果...-->
                    <!--</div>-->
                    <!--联系人列表-->
                    @if(!empty($attention))

                        <ul class="mg-margin0 pd-padding0 result-container" id="urse">
                            @foreach($attention as $item)
                                <li class="im-side-itm clearfix listImg item1">
                                    <div class="pull-left">
                                        <img src="@if(!empty($item['avatar'])){!! url($item['avatar']) !!}@else{!! Theme::asset()->url('images/haed.png') !!} @endif" alt="..." class="img-circle" width="44" height="44"/>
                                    </div>
                                    <div class="im-side1-title">
                                        <h4 class="f-size14 mg-margin0 title-tit cor-gury51" data-toUid="{!! $item['id'] !!}">{!! $item['name'] !!}</h4>

                                        <p class="cor-gury9c f-size12 tit-time mg-margin0">
                                            @if($item['autograph']){!! mb_substr($item['autograph'], 0, 10, 'utf-8') !!}@else 这家伙都懒的签名！ @endif
                                        </p>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    @else
                        <ul class="mg-margin0 pd-padding0">
                            <li class="center">
                                暂无联系人
                            </li>
                        </ul>
                        @endif

                                <!--搜索列表-->
                        <!--<ul class="mg-margin0 pd-padding0 search-itm">-->
                        <!--<li class="im-side-itm clearfix listImg">-->
                        <!--<div class="pull-left ">-->
                        <!--<img src="../images/evaluate.jpg" alt="..." class="img-circle" width="28" height="28"/>-->
                        <!--</div>-->
                        <!--<div class="im-side1-title ">-->
                        <!--<h4 class="f-size12 mg-margin0 title-tit ">杭州巴顿设计1</h4>-->
                        <!--</div>-->
                        <!--</li>-->
                        <!--<li class="im-side-itm clearfix">-->
                        <!--<div class="pull-left">-->
                        <!--<img src="../images/weedout.png" alt="..." class="img-circle" width="28" height="28"/>-->
                        <!--</div>-->
                        <!--<div class="im-side1-title">-->
                        <!--<h4 class="f-size12 mg-margin0 title-tit ">杭州巴顿设计2</h4>-->
                        <!--</div>-->
                        <!--</li>-->
                        <!--<li class="im-side-itm clearfix">-->
                        <!--<div class="pull-left">-->
                        <!--<img src="../images/valuimgbg.png" alt="..." class="img-circle" width="28" height="28"/>-->
                        <!--</div>-->
                        <!--<div class="im-side1-title">-->
                        <!--<h4 class="f-size12 mg-margin0 title-tit ">杭州巴顿设计3</h4>-->
                        <!--</div>-->
                        <!--</li>-->
                        <!--<li class="im-side-itm clearfix">-->
                        <!--<div class="pull-left">-->
                        <!--<img src="../images/evaluate.jpg" alt="..." class="img-circle" width="28" height="28"/>-->
                        <!--</div>-->
                        <!--<div class="im-side1-title">-->
                        <!--<h4 class="f-size12 mg-margin0 title-tit ">杭州巴顿设计4</h4>-->
                        <!--</div>-->
                        <!--</li>-->
                        <!--</ul>-->
                </div>
            </div>
        @endif

        <div class="im-side1-list3 clearfix imContact">
            <i class="fa fa-paper-plane f-size20 pull-left mg-top12"></i>
            <!--<a href="" class="f-size12">登录</a>-->
            @if(Auth::check())
                <b class="f-size12">{!! count($attention) !!} 位联系人 </b>
                <i class="fa fa-chevron-up pull-right mg-top18 Top"></i>
            @else
                <a href="{!! url('login') !!}">请先登录</a>
            @endif

        </div>
    </div>
</div>
<input type="hidden" name="fromUid" value="@if(isset(Auth::User()->id)){!! Auth::User()->id !!}@endif">
<div id="ImIp" data-im="{!! $ImIp !!}"></div>
<div id="ImPort" data-im="{!! $ImPort !!}"></div>
<div id="online" data-im-online=""></div>