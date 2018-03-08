<div>
    {!! $msg !!}
</div>

<script>
    var time = '{!! $time !!}';

    function redirect(){
        window.history.back();
    }

    setTimeout('redirect()', time);
</script>