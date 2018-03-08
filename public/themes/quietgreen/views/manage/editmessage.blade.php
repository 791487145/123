
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">模板编辑</h3>

<form action="/manage/editMessage" method="post">
    {{ csrf_field() }}
    <div class="g-backrealdetails clearfix bor-border">
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-xs-1 text-right">信息邮件代号</p>
            <p class="col-xs-10 text-left">
                <input type="text" name="code_name" value="{{$message_info['code_name']}}" readonly="readonly">
            </p>
        </div>
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-xs-1 text-right">信息邮件类型</p>
            <p class="col-xs-10 text-left">
                {{--<select name="name">--}}
                    {{--@foreach($message as $items)--}}
                        {{--<option value="{{ $items['name'] }}" @if((isset($id) && $id == $items['id']))selected="selected"@endif>{{$items['name']}}消息提示</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
                <input type="text" name="name" value="{{$message_info['name']}}">
                <input type="hidden" name="id" value="{{$id}}">
            </p>
        </div>
        {{--<div>--}}
            {{--<div class="text-right">信息邮件内容：</div>--}}
            {{--<div class="text-left">--}}
                {{--<textarea name="content">{{$message_info['content']}}</textarea>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-xs-1 text-right">信息邮件内容</p>
            <div class="col-xs-8 text-left">
                <!--编辑器-->
                <div class="clearfix">
                    <script id="editor" name="content" type="text/plain">{!! htmlspecialchars_decode($message_info['content']) !!}</script>
                    {{--<div class="wysiwyg-editor" id="editor1">{!! htmlspecialchars_decode($message_info['content']) !!}</div>
                    <textarea name="content" id="content" style="display: none">{!! htmlspecialchars_decode($message_info['content']) !!}</textarea>--}}
                    {{ $errors->first('content') }}
                </div>
            </div>
            <div class="space-6 col-xs-12"></div>
        </div>

        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-md-1 text-right"></div>
                    <div class="col-md-10">
                        <button class="btn btn-primary sub_article" type="submit">提交</button>
                        <a href="javascript:history.back()" title="" class=" add-case-concel">返回</a>
                    </div>
                </div>
            </div>
        </div>
         {{--   <p class="col-xs-1 text-right"></p>
            <p class="text-left">
                <button class="btn btn-primary sub_article" type="submit">提交</button>
            </p>
        </div>--}}
    </div>
</form>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('datepicker', 'plugins/ace/js/date-time/bootsdivap-datepicker.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('touch-punch', 'plugins/ace/js/jquery.ui.touch-punch.min.js') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('autosize', 'plugins/ace/js/jquery.autosize.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('inputlimiter', 'plugins/ace/js/jquery.inputlimiter.1.3.1.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('maskedinput', 'plugins/ace/js/jquery.maskedinput.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('hotkeys', 'plugins/ace/js/jquery.hotkeys.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('wysiwyg', 'plugins/ace/js/bootsdivap-wysiwyg.min.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('dataTab', 'plugins/ace/js/dataTab.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_dataTables', 'plugins/ace/js/jquery.dataTables.bootsdivap.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('addarticle', 'js/doc/addarticle.js') !!}
{!! Theme::widget('ueditor')->render() !!}