{!! Theme::asset()->container('specific-js')->usepath()->add('ueditor','plugins/ueditor/ueditor.config.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ueditor.all','plugins/ueditor/ueditor.all.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('lang','plugins/ueditor/lang/zh-cn/zh-cn.js') !!}
<script>
    var config = {

        toolbars: [
            ['fullscreen', 'source', 'undo', 'redo', 'bold','subscript',
                'superscript','simpleupload','selectall','justifyleft','justifyright',
                'justifycenter','justifyjustify','cleardoc','fontfamily','fontsize','paragraph',
                'link','forecolor','touppercase','tolowercase'
            ]
        ],
        initialFrameHeight:200,
        zIndex:1,
    };
    window.onload = function(){
        var ue = UE.getEditor('editor',config);
        alert(ue.getOpt('serverUrl'));
    };
</script>