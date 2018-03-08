
<script>
    var error = 0;
    var success = 0;
    @if(Session::has('error'))
         error = 1;
        var message = '{{ Session::get('error') }}';
    @endif

    @if(Session::has('message'))
        success = 1;
        var message = '{{ Session::get('message') }}';
    @endif

</script>

{!! Theme::asset()->container('specific-js')->usepath()->add('gritter', 'plugins/ace/js/jquery.gritter.min.js') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('gritter_css', 'css/ace/jquery.gritter.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('gritter', 'js/doc/layer.js') !!}