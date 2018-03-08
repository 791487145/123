$(function(){
    $('.change_ids').on('change',function(){
        var id = $(this).attr('name');
        var value = $('#change-ids').val();
        if(value==''){
            $('#change-ids').val(id);
        }else{
            var value_array = value.split(',');
            if(value_array.indexOf(id) == -1){
                $('#change-ids').val(value+','+id);
            }
        }
    });
})