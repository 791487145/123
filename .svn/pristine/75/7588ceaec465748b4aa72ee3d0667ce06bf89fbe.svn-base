/**
 * ajax获取地区信息
 *
 * @param int id
 * @param element
 */
function getZone(id, element) {
    if (id && element) {
        $.get('/user/getZone', {
            id: id
        }, function (json) {
            if (json.code = 200) {
                $("#" + element).html(json.data);
                if (element == 'city') {
                    getZone($("#" + element).val(), 'area');
                }
            }

        }, 'json')
    } else {
        $("#city").html("<option value=''>请选择城市</option>");
        $("#area").html("<option value=''>请选择地区</option>");
    }
}

/**
 * ajax获取验证码
 *
 * @param element
 */
function flushCode(element) {
    $.get('/flushCode', function (msg) {
        $(element).attr('src', msg.data);
    }, 'json')
}
/**
 * 换一换验证码
 * @param ele
 */
function changeCode(ele){
    $.get('/flushCode', function (msg) {
        $("#" + ele).attr('src', msg.data);
    }, 'json')
}

$(function(){
    $(".login-form").Validform({
        tiptype:3,
        showAllError:true

    });
})