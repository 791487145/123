@if($status == 1 || $status == 0)
    @include('com.gameTeamList_report')
@endif
@if($status == 2)
    @include('com.gameTeamList_draw_lots')
@endif
@if($status == 3)
    @include('com.gameTeamList_audition')
@endif
@if($status == 4 || $status == 6 || $status == 7 || $status == 8)
    @include('com.gameTeamList_group_game')
@endif
@if($status == 5)
    @include('com.gameTeamList_resurgence')
@endif
<script>
    function del(id){
        var _token = $("#_token").val();
        $.post('/manage/game/teamDel',{id:id,_token:_token}, function (msg){
            if(msg){
                $("#tr_"+msg).remove();
            }
            if(msg == 0){
                alert(1);
            }
        })
    }
</script>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}

{!! Theme::asset()->container('custom-js')->usePath()->add('checked-js', 'js/checkedAll.js') !!}
