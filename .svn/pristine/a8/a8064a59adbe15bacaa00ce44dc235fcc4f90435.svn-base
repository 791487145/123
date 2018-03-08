
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">编辑协议</h3>
<form action="/manage/editAgreement" method="post">
    {{ csrf_field() }}
    <div class="g-backrealdetails clearfix bor-border">
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">协议名称：</p>
            <p class="col-md-11">
               <input type="text" name="name" id="name" value="{{$agree['name']}}">
                <input type="hidden" name="id" value="{{$agree['id']}}">
                {{ $errors->first('name') }}
            </p>
        </div>
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">协议代号：</p>
            <p class="col-md-11">
                <input type="text" name="code_name" id="code_name" value="{{$agree['code_name']}}" readonly="readonly">
                {{ $errors->first('code_name') }}
            </p>
        </div>
            {{--<tr>--}}
                {{--<td class="text-right">协议内容：</td>--}}
                {{--<td class="text-left">--}}
                    {{--<textarea name="content" class="content">{{$agree['content']}}</textarea>--}}
                    {{--{{ $errors->first('content') }}--}}
                {{--</td>--}}
            {{--</tr>--}}
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">协议内容：</p>
            <!--编辑器-->
            <p class="clearfix col-md-8">
                <script id="editor" type="text/plain" style="width:;height:300px;" name="content">{!! htmlspecialchars_decode($agree['content']) !!}</script>
                {{--<div class="wysiwyg-editor" id="editor1">{!! htmlspecialchars_decode($agree['content']) !!}</div>
                <textarea name="content" id="content" style="display: none">{!! htmlspecialchars_decode($agree['content']) !!}</textarea>--}}
                {{ $errors->first('content') }}
            </p>
        </div>

            {{--<tr>
                <td class="text-right"></td>
                <td class="text-left">
                    <button class="btn btn-primary sub_article btn-sm" type="submit"><i class="ace-icon fa fa-check bigger-110"></i>提交</button>
                </td>
            </tr>--}}

        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-md-1 text-right"></div>
                    <div class="col-md-10"><button class="btn btn-primary btn-sm" type="submit">提交</button></div>
                </div>
            </div>
        </div>
        <div class="space col-xs-12"></div>
        <div class="col-xs-12">
            <div class="col-md-1 text-right"></div>
            <div class="col-md-10"><a href="javascript:history.back()">返回</a>　　<a href=""></a></div>
        </div>
        <div class="col-xs-12 space">

        </div>
    </div>
</form>


<!-- basic scripts -->
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('datepicker', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('touch-punch', 'plugins/ace/js/jquery.ui.touch-punch.min.js') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('autosize', 'plugins/ace/js/jquery.autosize.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('inputlimiter', 'plugins/ace/js/jquery.inputlimiter.1.3.1.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('maskedinput', 'plugins/ace/js/jquery.maskedinput.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('hotkeys', 'plugins/ace/js/jquery.hotkeys.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('wysiwyg', 'plugins/ace/js/bootstrap-wysiwyg.min.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('dataTab', 'plugins/ace/js/dataTab.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_dataTables', 'plugins/ace/js/jquery.dataTables.bootstrap.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('addarticle', 'js/doc/addarticle.js') !!}
{!! Theme::widget('ueditor')->render() !!}