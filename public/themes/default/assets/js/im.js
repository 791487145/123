/**
 * Created by kuke on 2016/6/17.
 */
$(function () {
    var fromUid = $("input[name='fromUid']").val();
    var ImIp = $("#ImIp").attr('data-im')? $("#ImIp").attr('data-im') : '0.0.0.0';
	var ImPort = $("#ImPort").attr('data-im')? $("#ImPort").attr('data-im') : '9501';
    if (fromUid){
        var websocket = new WebSocket("ws://" + ImIp + ":" + ImPort + "?fromUid=" + fromUid);

        websocket.onopen = function (event) {
            console.log('成功连接IM服务器');
        };

        websocket.onmessage = function (event) {
			var toUid = $(this).find('h4').attr('data-toUid');
			if (toUid == undefined){
				var toUid = $('.im-side1-title').find('h4').attr('data-toUid');
			}
			
            var msg = JSON.parse(event.data);
            if (msg.online){
                $("#online").attr('data-im-online', msg.online);
            }

            var formId = $("h4[data-toUid='"+msg.fromUid+"']");
            var imSideright = $('.im-side2 .im-side1-list2 .result-container>li');
            $(imSideright).find(formId).parent().parent().addClass('shake-constant shake-delay im-shake');
            $('.new').show();
            $('.old').hide();

            if (msg.fromUid == fromUid && msg.toUid == toUid){
                $('.im-side1 .im-side1-list2 ul').append(
                    '<li class="clearfix"><div class="pull-right">' +
                    '<p class="cor-guryC5 f-size12"><span class="cor-green">' + msg.from_username+"</span> "+ msg.created_at + '</p>' +
                    '<p class="im-dialog-bgf8 cor-gury51">' + msg.content + '</p>' +
                    '</li>'
                )
            }
            if (msg.toUid == fromUid && msg.fromUid == toUid){
                $('.im-side1 .im-side1-list2 ul').append(
                    '<li class="clearfix"><div class="pull-left">' +
                    '<p class="cor-guryC5 f-size12"><span class="cor-blue2f">' + msg.from_username+"</span> "+ msg.created_at + '</p>' +
                    '<p class="im-dialog-bgf8 cor-gury51">' + msg.content + '</p>' +
                    '</li>'
                )
            }

            $(".im-side1 .im-side1-list2").scrollTop($(".im-side1 .im-side1-list2")[0].scrollHeight);
        }
    }



    $('.im .imClose').on('click', function () {

        arr.length = 0;
        $('.im-info').stop().fadeOut();
        $('.im .im-side2 .im-side1-list3').css("border-radius", "5px");
        $('.imContact .Top').removeClass('fa-chevron-down');
        $(".im-side ul").empty();
        return;

    });

    $('.im .imContact').on('click', function () {

        $('.imContact-info').stop().fadeToggle();
        $('.im .im-side2 .im-side1-list3').css("border-radius", "0 0 5px 5px");
        $('.imContact .Top').toggleClass(' fa-chevron-down');
        $('.im-side2').addClass('im-container');
        return;

    });

    $('.search-wrapper').on('click', function () {

        $('.search-btn').fadeOut();
        $('.search-wrapper').css({"padding-left": "10px"});
        $('.search-close').fadeIn();

    });
    $('.search-close').on('click', function () {

        $('.search-btn').fadeIn();
        $('.search-wrapper').css({"padding-left": "40px"});
        $('.search-close').fadeOut();

    });

    //右侧联系人
    var arr = [];
    $('.im-side2 .im-side1-list2 .result-container>li').on('click', function () {

        var sImg = $(this).find('img').attr('src');
        var tTxt = $(this).find('h4').html();
        var toUid = $(this).find('h4').attr('data-toUid');

        sign = $(this).find('p').html();

        $(this).css('background-color','#f5f5f5').siblings().css('background','#fff');
        $('.chat-t-name').html(tTxt);
        $('.chat-t-sign').html(sign);
        $('.chat-t-head img').attr('src', sImg);
        $(this).removeClass('shake-constant shake-delay im-shake');
        $('.qq-chat-you i').html($(this).find('.qq-hui-name i').html());
        $('.qq-chat-ner').html($(this).find('.qq-hui-txt').html());
        $('.im-ck').fadeIn();
        $('.old').show();
        $('.new').hide();
        //清空聊天区域内容
        $("#talkarea").empty();
        //拉取追加聊天记录
        $.get('/im/message/' + toUid, function(data){
            for (i = 0; i < data.data.length; i++){
                if (data.data[i].from_uid == fromUid){
                    $("#talkarea").append("<li class='clearfix'><div class='pull-right'>" +
                        "<p class='cor-guryC5 f-size12'><span class='cor-green'>" + data.data[i].from_username+'</span> '+data.data[i].created_at + "</p>" +
                        "<p class='im-dialog-bgf8 cor-gury51'>" + data.data[i].content + "</p>" +
                        "</div></li>")
                } else {
                    $("#talkarea").append("<li class='clearfix'><div class='pull-left'>" +
                        "<p class='cor-guryC5 f-size12'><span class='cor-blue2f'>" + data.data[i].from_username+'</span> '+data.data[i].created_at + "</p>" +
                        "<p class='im-dialog-bgf8 cor-gury51'>" + data.data[i].content + "</p>" +
                        "</div></li>")
                }
                $(".im-side1 .im-side1-list2").scrollTop($(".im-side1 .im-side1-list2")[0].scrollHeight);
            }
        }, 'json');

        //将所点击li添加到数组里面
        for(var i=0;i<arr.length;i++){

            if(arr[i]==this){

                for(var i=0;i<$('.im-side ul>li').length;i++){

                    //console.log($('.im-side ul>li').eq(i).attr("placeholder")==$(this).index())
                    if($('.im-side ul>li').eq(i).attr("placeholder")==$(this).index()){

                        $('.im-side ul>li').eq(i).addClass('im-wrapside')

                    }else{

                        $('.im-side ul>li').eq(i).removeClass('im-wrapside')

                    }

                }

                return;
            }
        };
        arr.push(this);

        //大于两个显示
        if (arr.length != 1) {

            $(".im .im-side").fadeIn();

        }

        //最左侧最近联系人
        $('.im-side ul').append(

            '<li placeholder='+$(this).index()+' class="im-side-itm clearfix listImg l-listImg" >' +
            '<div class="pull-left chat-head">' +
            '<img src="'+sImg+'" alt="..." class="img-circle chat-head" width="28" height="28"/>' +
            '</div>' +
            '<div class="im-side1-title">' +
            '<h4 class="f-size12 mg-margin0 title-tit chat-name" data-toUid="'+toUid+'">'+tTxt+'</h4>' +
            '</div>' +
            '</li>'
        );

        for(var i=0;i<$('.im-side ul>li').length;i++){

            //console.log($('.im-side ul>li').eq(i).attr("placeholder")==$(this).index())
            if($('.im-side ul>li').eq(i).attr("placeholder")==$(this).index()){

                $('.im-side ul>li').eq(i).addClass('im-wrapside')

            }else{

                $('.im-side ul>li').eq(i).removeClass('im-wrapside')

            }
        }

        $("#chat-text").trigger("focus");

    });

    //最左侧最近联系人
    $(document).on("click",".l-listImg",function(){
        var sImg = $(this).find('img').attr('src');
        var tTxt = $(this).find('h4').html();
        toUid = $(this).find('h4').attr('data-toUid');
        //sign = $(this).find('p').html();
        $("#talkarea").empty();
        $('.chat-t-name').html(tTxt);
        $('.chat-t-head img').attr('src', sImg);
        $(this).addClass('im-wrapside').siblings().removeClass('im-wrapside');
        $("#urse li").eq($(this).attr("placeholder")).css("background-color",'#f5f5f5').siblings().css("background-color",'#fff');
        //console.log($("#urse li").length)
        $('.old').show();
        $('.new').hide();

        $.get('/im/message/' + toUid, function(data){
            for (i = 0; i < data.data.length; i++){
                if (data.data[i].from_uid == fromUid){
                    $("#talkarea").append("<li class='clearfix'><div class='pull-right'>" +
                        "<p class='cor-guryC5 f-size12'><span class='cor-green'>" + data.data[i].from_username+'</span> '+ data.data[i].created_at + "sss</p>" +
                        "<p class='im-dialog-bgf8 cor-gury51'>" + data.data[i].content + "</p>" +
                        "</div></li>")
                } else {
                    $("#talkarea").append("<li class='clearfix'><div class='pull-left'>" +
                        "<p class='cor-guryC5 f-size12'><span class='cor-blue2f'>" + data.data[i].from_username+'</span> '+ data.data[i].id+ data.data[i].created_at + "sss</p>" +
                        "<p class='im-dialog-bgf8 cor-gury51'>" + data.data[i].content + "</p>" +
                        "</div></li>")
                }
                $(".im-side1 .im-side1-list2").scrollTop($(".im-side1 .im-side1-list2")[0].scrollHeight);
            }
        }, 'json');

    })

    

    //任务ico
    $(document).on('click','.taskmessico,.taskconico,.shop-im',function(){
        var toUid = $(this).attr('data-values');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '/im/addAttention',
            data: {
                toUid: toUid,
            },
            success: function (data) {
                var info = JSON.parse(data);
                $('.chat-t-name').html(info.data.name);
                $('.chat-t-sign').html(info.data.sign);
                $('.chat-t-head img').attr('src', info.data.avatar);
				$('.im-side1-title').find('h4').attr('data-toUid', info.data.friend_uid);
                $('.im .im-side1').stop().slideDown();
            }
        });


        $('.imContact-info').stop().slideDown(function () {
            $('.imContact-info .im-side1-list2').css('margin-bottom','45px')
        });

    })
	
	$('.im-btn').click(function () {
		var toUid = $(this).find('h4').attr('data-toUid');
			if (toUid == undefined){
				var toUid = $('.im-side1-title').find('h4').attr('data-toUid');
			}
		
		
        if ($('#chat-text').val() == '') {

            alert("发送内容不能为空,请输入内容")

        } else if ($('#chat-text').val() != '') {

            var ner = $('#chat-text').val();
            // 把多行回车换成br形式的换行
            var ners = ner.replace(/\n/g, '<br>');
            // 日期初始化
            var now = new Date();

            var tDiv = now.getFullYear() + "/" + now.getHours() + ":" + now.getMinutes();

            var data = {
                "fromUid" : fromUid,
                "toUid" : toUid,
                "content" : ner
            };

            websocket.send(JSON.stringify(data));

            $('#chat-text').val('').trigger("focus");

        }
    });

    //任务ico
    $('.taskmessico,.taskconico,.shop-im').on('click',function(){


        $('.im .im-side1').stop().slideDown();/*
        $('.imContact-info').stop().slideDown(function () {
            $('.imContact-info .im-side1-list2').css('margin-bottom','45px')
        });*/

    })
})