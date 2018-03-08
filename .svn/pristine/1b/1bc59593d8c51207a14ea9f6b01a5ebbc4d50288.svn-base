{!! Theme::asset()->container('specific-js')->usepath()->add('gritter-js', '/plugins/ace/js/jquery.gritter.min.js') !!}
<script>
    $(function(){
        //弹出失败消息
        @if(Session::has('error'))
        $.gritter.add({
//            title: '消息提示：',
            text: '<div><span class="text-center"><h5>{{ Session::get('error') }}</h5></span></div>',
            class_name: 'gritter-info gritter-center'
        });
        @endif
        //弹出成功消息
        @if(Session::has('message'))
        $.gritter.add({
//            title: '消息提示：',
            text: '<div><span class="text-center"><h5>{{ Session::get('message') }}</h5></span></div>',
            class_name: 'gritter-info gritter-center'
        });
        @endif
    })
</script>