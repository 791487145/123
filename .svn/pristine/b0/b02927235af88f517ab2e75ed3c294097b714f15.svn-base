/*选中*/
/*var f = true;
function aCheck(obj){
    var txt = $(obj).html();
    $(document).on('click',obj,function(){
        /!*var i = $(this).find('i').attr('class');*!/
        var that = this;
        $(that).find('i').toggleClass('fa-check');
        if( i !== 'red fa fa-check' ){
           /!* $(that).html( '<i class="fa fa-check red"></i> '+txt );
            f = false;*!/
            $(that).find('i').toggleClass('fa-check');

        }else{
           /!* $(that).find('i').remove();
            f = true;*!/
            $(that).find('i').removeClass('fa-check');
        }
    })
}*/
/*选中*/
function aCheck(obj){
    $(document).on('click',obj,function(){
        var that = this;
        $(that).find('i').toggleClass('fa-check');
		
    })
}
aCheck(".aCheck");

/*添加、删除tr*/
$(document).on('click','#addTr',function(){
	var i = $('#getTr').children().length;
    $str='';
    $str+="<tr>";
    $str+="<td style='width: 264px'><input type='number'  datatype='*' value=''  class='inputxt' name=\"price_rules["+i+"][time_period]\" /> 月</td>";
    $str+="<td style='width: 284px'>金额：<input type='number'  datatype='*' value=''  class='inputxt' name=\"price_rules["+i+"][cash]\"/> 元</td>";
    $str+="<td><a onclick='getDel(this)' class='btn btn-xs btn-danger' href='javascript:;' id='delTr'>删除</a></td>";
    $str+="</tr>";
    $('#getTr').append($str);
    var tr = $('#getTr').children().length;
    if(tr>2){
        $('#addTr').hide();
    }

});

function getDel(obj){
    var tr = $('#getTr').children().length;
    $(obj).parent().parent().remove();
    if(tr<=3){
        $('#addTr').show();
    }
}


$(".addForm").Validform(function(){
        tiptype:2
});


/*function txtInput(obj){
    var input = $('#getTr td input').val();
    $('form').submit( function () {
        if ( input == '' ){
            alert(1)
            return false;
        }else{
            return true;
        }
    } );
}
txtInput();*/
/*排序*/
$('#spinner3').ace_spinner({
    value:0,
    min:0,
    max:100,
    step:1,
    on_sides: true,
    icon_up:'ace-icon fa fa-plus smaller-75',
    icon_down:'ace-icon fa fa-minus smaller-75',
    btn_up_class:'btn-success' ,
    btn_down_class:'btn-danger'
});


$(document).ready(function(){
    $("#status").click(function() {
			if($("#status").is(':checked') == true){
				$("#status").attr("value","1");
			}else{
				$("#status").attr("value","");
			}
    });
	$(".drag-tabinp").click(function(){
		$(".drag-tabinp").each(function(){
			if($(this).is(':checked') == true){
				$(this).attr('name','privileges[]');
			}else{
				if($(this).attr('name')){
					$(this).removeAttr('name');
				}
			}
		});
	});
})
