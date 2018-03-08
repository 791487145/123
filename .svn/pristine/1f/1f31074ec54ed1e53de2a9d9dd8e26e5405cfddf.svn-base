/**
 * Created by R on 2016/6/14.
 */
jQuery(function($) {
    $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    $(document).on('click', 'th input:checkbox' , function(){
        var that = this;
        $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
    });


    $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
    function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('table')
        var off1 = $parent.offset();
        var w1 = $parent.width();

        var off2 = $source.offset();
        //var w2 = $source.width();

        if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
        return 'left';
    }
    $('#allcheck').on('click',function(){
        if($(this).is(':checked')){
            $('[type="checkbox"]').prop('checked','true');
        }else{
            $('[type="checkbox"]').prop('checked','');
        }
    });

});
$('.input-daterange').datepicker({autoclose:true});
$("#bootbox-confirm").on(ace.click_event, function() {
    bootbox.confirm("Are you sure?", function(result) {
        if(result) {
            //
        }
    });
});
