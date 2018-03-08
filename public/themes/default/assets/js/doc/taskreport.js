$('#allcheck').on('click',function(){
    if($(this).is(':checked')){
        $('[type="checkbox"]').prop('checked','true');
    }else{
        $('[type="checkbox"]').prop('checked','');
    }
});

$(document).on('click', 'th input:checkbox' , function(){
    var that = this;
    $(this).closest('table').find('tr > td:first-child input:checkbox')
        .each(function(){
            this.checked = that.checked;
            $(this).closest('tr').toggleClass('selected');
        });
});