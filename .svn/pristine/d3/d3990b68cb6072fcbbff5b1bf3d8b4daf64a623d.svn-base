<script>
    var uploadRule = '{!! CommonClass::attachmentUnserialize() !!}';
    uploadRule = JSON.parse(uploadRule);
    var extensions = '';
    for(var i in uploadRule.extensions)
    {
        extensions += uploadRule.extensions+',';
    }
    @if(isset($maxFiles))
        var maxFiles = {{ $maxFiles }};
    @else
        var maxFiles = 3;
    @endif
    @if(isset($initimage))
        var initimage = {!! $initimage   !!} ;
    @else
        var initimage = 3;
    @endif
</script>

{!! Theme::asset()->container('specific-css')->usepath()->add('issuetask','plugins/ace/css/dropzone.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('dropzone','plugins/ace/js/dropzone.min.js') !!}
@if(isset($initjs))
    @foreach($initjs as $v)
{!! Theme::asset()->container('custom-js')->usepath()->add('upload','js/'.$v) !!}
    @endforeach
@else
{!! Theme::asset()->container('custom-js')->usepath()->add('upload','js/upload.js') !!}
@endif
