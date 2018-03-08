{{--使用实例--}}
{{--<div class="clearfix">--}}
    {{--<div class="wysiwyg-editor" id="editor1">{!! old('description') !!}</div>--}}
    {{--<input type="hidden" name="description" id="discription-edit" datatype="*" nullmsg="需求描述不能为空">--}}
{{--</div>--}}
{{--注意：页面中需要首先加载以下js，如果没有加载需要手动加载--}}
{{--{!! Theme::asset()->container('custom-js')->usepath()->add('ace_min','plugins/ace/js/ace.min.js') !!}--}}
{{--{!! Theme::asset()->container('custom-js')->usepath()->add('elements','plugins/ace/js/uncompressed/ace-elements.js') !!}--}}
<script>
    @if(!isset($plugins))
        var plugins = [
                'font',
                null,
                'fontSize',
                null,
                {name:'bold', className:'btn-info'},
                {name:'italic', className:'btn-info'},
                {name:'strikethrough', className:'btn-info'},
                {name:'underline', className:'btn-info'},
                null,
                {name:'insertunorderedlist', className:'btn-success'},
                {name:'insertorderedlist', className:'btn-success'},
                {name:'outdent', className:'btn-purple'},
                {name:'indent', className:'btn-purple'},
                null,
                {name:'justifyleft', className:'btn-primary'},
                {name:'justifycenter', className:'btn-primary'},
                {name:'justifyright', className:'btn-primary'},
                {name:'justifyfull', className:'btn-inverse'},
                null,
                {name:'createLink', className:'btn-pink'},
                {name:'unlink', className:'btn-pink'},
                null,
                {name:'insertImage', className:'btn-success'},
                null,
                'foreColor',
                null,
                {name:'undo', className:'btn-grey'},
                {name:'redo', className:'btn-grey'}
            ];
    @else
        var plugins  = {!! $plugins !!};
    @endif
</script>
{!! Theme::asset()->container('custom-css')->usepath()->add('jquery-ui','plugins/ace/css/jquery-ui.custom.min.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery-ui','plugins/ace/js/jquery-ui.custom.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('hotkeys','plugins/ace/js/jquery.hotkeys.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('wysiwyg','plugins/ace/js/bootstrap-wysiwyg.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('editor','js/doc/editor.js') !!}
