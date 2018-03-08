
$(function(){


});
$(function(){
    //多选
    $(document).on('click', 'th input:checkbox' , function(){
        var that = this;
        $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');

            });
    });
    //全选
    $('#allcheck').on('click',function(){
        if($(this).is(':checked')){
            $('[type="checkbox"]').prop('checked','true');
        }else{
            $('[type="checkbox"]').prop('checked','');
        }
    });

    //批量审核通过
    $('#pass').on('click',function(){
        var idArray = [];
        $('.ace.auth_id').each(function(){
            if($(this).is(':checked')){
                var id = $(this).val();
                idArray.push(id);
            }
        });
        var ids = idArray.toString();
        console.log(ids);
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/manage/allEnterprisePass',
            data: {ids:ids},
            dataType:'json',
            success: function(data){
                if(data.code == 1){
                    $('[type="checkbox"]').prop('checked','');
                    location.reload();
                }
            }
        });
    });

    //批量审核通过
    $('#deny').on('click',function(){
        var idArray = [];
        $('.ace.auth_id').each(function(){
            if($(this).is(':checked')){
                var id = $(this).val();
                idArray.push(id);
            }
        });
        var ids = idArray.toString();
        console.log(ids);
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/manage/allEnterpriseDeny',
            data: {ids:ids},
            dataType:'json',
            success: function(data){
                if(data.code == 1){
                    $('[type="checkbox"]').prop('checked','');
                    location.reload();
                }
            }
        });
    });

});


