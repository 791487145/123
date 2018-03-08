<div class="g-taskhead employ-header ">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 clearfix col-left">
                <img src="{{ Theme::asset()->url('images/sign-logo.png') }}" class="img-responsive pull-left hidden-480">
                <div class="employ-part pull-right">
                    <a href="javascript:;">张小病nofeel</a> | <a href="javascript:;">返回</a>
                </div>
                <img class="pull-right img-circle" src="@if(!empty(Theme::get('avatar'))) {!!  url(Theme::get('avatar')) !!} @else {!! Theme::asset()->url('images/default_avatar.png') !!} @endif" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))" alt="" width="34" height="34"/>
            </div>
        </div>
    </div>
</div>