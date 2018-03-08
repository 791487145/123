{{--
使用说明


--}}
<script>
    @if(!isset($toolbars))
        var toolbars = [[
                'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                'simpleupload', 'insertimage', 'emotion', 'scrawl', 'preview'
            ]];
    @else
        var toolbars  = {!! $toolbars !!};
    @endif
</script>
{!! Theme::asset()->container('specific-js')->usepath()->add('ueditorconfig', 'plugins/ueditor/ueditor.config.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ueditorall', 'plugins/ueditor/ueditor.all.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ueditorlang', 'plugins/ueditor/lang/zh-cn/zh-cn.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ueditorinit', 'js/doc/ueditor.js') !!}