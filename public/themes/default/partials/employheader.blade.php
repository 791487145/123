<div class="g-taskhead employ-header ">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 clearfix col-left">
                <a href="{!! CommonClass::homePage() !!}">
                    @if(Theme::get('site_config')['site_logo_1'])
                        <img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" class="img-responsive pull-left hidden-480">
                    @else
                        <img src="{!! Theme::asset()->url('images/sign-logo.png') !!}" class="img-responsive pull-left hidden-480">
                    @endif
                </a>
                <div class="employ-part pull-right">
                    <a href="{{ URL('user/index') }}">{{ Theme::get('username') }}</a> | <a href="{{ URL('logout') }}">退出</a>
                </div>
                <img class="pull-right img-circle" src="{!!  url(Theme::get('avatar')) !!} " onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))" alt="" width="34" height="34"/>
            </div>
        </div>
    </div>
</div>