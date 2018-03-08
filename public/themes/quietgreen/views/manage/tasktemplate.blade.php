{{--<div class="page-header">
    <h1>
        添加实例 >>{{ $industry['name'] }}
    </h1>
</div><!-- /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">  添加实例 >>{{ $industry['name'] }}</h3>

<div class="g-backrealdetails clearfix bor-border">
    <form class="form-horizontal" action="/manage/templateCreate" method="post" id="success-case">
        {{ csrf_field() }}
        <input type="hidden" name="cate_id" value="{{ $industry['id'] }}">
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-sm-1 control-label no-padding-right" for="form-field-1"><strong>案例名称：</strong>  </p>
            <p class="col-sm-11">
                <input type="text" id="form-field-1" name='title' class="col-xs-3 col-sm-3" value="{{ $template['title'] }}">
            </p>
        </div>
        <!-- 案例描述 -->
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-sm-1 control-label no-padding-right" for="form-field-1"><strong>案例描述：</strong>  </p>
            <p class="col-sm-8">
                <script id="editor" name="desc" type="text/plain" style="width:100%;height:300px;">{!! htmlspecialchars_decode($template['content']) !!}</script>

                {{--<div class="clearfix">
                    <div class="wysiwyg-editor" id="editor1">{!! htmlspecialchars_decode($template['content']) !!}</div>
                </div>
                <input type="hidden" name="desc" id="discription-edit" value="{{ htmlspecialchars_decode($template['content']) }}"/>--}}
            </p>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-md-1 text-right"></div>
                    <div class="col-md-10">
                        <button type="submit" form="success-case" class="btn btn-primary btn-blue bor-radius2 btn-big1 subTask btn-sm">保存</button>
                        <a href="javascript:history.back()" title="" class=" add-case-concel">返回</a>
                    </div>
                </div>
            </div>
        </div>
    {{--<div class="form-group">
        <div class="col-sm-11 col-sm-offset-1">　
            <button type="submit" form="success-case" class="btn btn-primary btn-blue bor-radius2 btn-big1 subTask btn-sm">保存</button>
            <a href="" title="" class=" add-case-concel">返回</a>
        </div>
    </div>--}}
    </form>
</div>
{!! Theme::widget('popup')->render() !!}
{!! Theme::widget('editor')->render() !!}
{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}