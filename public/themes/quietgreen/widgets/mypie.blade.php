<script>
    var pie = {!! htmlspecialchars_decode($pie_data) !!};

</script>

{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_flot','plugins/ace/js/flot/jquery.flot.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_flot_pie','plugins/ace/js/flot/jquery.flot.pie.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_flot_resize','plugins/ace/js/flot/jquery.flot.resize.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('nopie','js/doc/nopie.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('pie','js/doc/pie.js') !!}