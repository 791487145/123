<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <style>
        html{
            width: 100%;
            height: 100%;
        }
        body{
            height:100%;
            font-size:10px;
            background-color:#3289cd;
            font-family:"Microsoft YaHei";
        }
        body, button, input, select, textarea {
            font: 12px/1.5 "Microsoft YaHei",sans-serif;
            -webkit-font-smoothing: antialiased;

        }
        img{
            vertical-align: middle;
            display:block;
            max-width: 100%;
            height: auto;
        }
        p,h1,h2,h3,h4,h5,h6{
            margin:0;
            padding:0;
        }
        .clear{
            clear:both;
        }
        @keyframes animate-wrap{
            0%{background-position: 0 0;}
            10%{background-position: -10px 1px;}
            20%{background-position: -10px 3px;}
            30%{background-position: -20px 1px;}
            40%{background-position: -40px 2px;}
            50%{background-position: -60px 4px;}
            60%{background-position: -40px 2px;}
            70%{background-position: -20px 4px;}
            80%{background-position: -10px 3px;}
            90%{background-position: -10px 1px;}
            100%{background-position: 0 0;}
        }
        @-o-keyframes animate{
            0%{background-position: 0 0;}
            10%{background-position: -10px 1px;}
            20%{background-position: -10px 3px;}
            30%{background-position: -20px 1px;}
            40%{background-position: -40px 2px;}
            50%{background-position: -60px 4px;}
            60%{background-position: -40px 2px;}
            70%{background-position: -20px 4px;}
            80%{background-position: -10px 3px;}
            90%{background-position: -10px 1px;}
            100%{background-position: 0 0;}
        }
        @-moz-keyframes animate{
            0%{background-position: 0 0;}
            10%{background-position: -10px 1px;}
            20%{background-position: -10px 3px;}
            30%{background-position: -20px 1px;}
            40%{background-position: -40px 2px;}
            50%{background-position: -60px 4px;}
            60%{background-position: -40px 2px;}
            70%{background-position: -20px 4px;}
            80%{background-position: -10px 3px;}
            90%{background-position: -10px 1px;}
            100%{background-position: 0 0;}
        }
        @-webkit-keyframes animate{
            0%{background-position: 0 0;}
            10%{background-position: -10px 1px;}
            20%{background-position: -10px 3px;}
            30%{background-position: -20px 1px;}
            40%{background-position: -40px 2px;}
            50%{background-position: -60px 4px;}
            60%{background-position: -40px 2px;}
            70%{background-position: -20px 4px;}
            80%{background-position: -10px 3px;}
            90%{background-position: -10px 1px;}
            100%{background-position: 0 0;}
        }
        @keyframes animate-above{
            0%{background-position: -60px 0;}
            10%{background-position: -50px 8px;}
            20%{background-position: -35px 10px;}
            30%{background-position: -20px 10px;}
            40%{background-position: -30px 16px;}
            50%{background-position: -10px 20px;}
            60%{background-position: -20px 20px;}
            70%{background-position: -30px 12px;}
            80%{background-position: -40px 10px;}
            90%{background-position: -50px 10px;}
            100%{background-position: -60px 0;}
        }
        @-webkit-keyframes animate-above{
            0%{background-position: -60px 0;}
            10%{background-position: -50px 8px;}
            20%{background-position: -35px 10px;}
            30%{background-position: -20px 10px;}
            40%{background-position: -30px 16px;}
            50%{background-position: -10px 20px;}
            60%{background-position: -20px 20px;}
            70%{background-position: -30px 12px;}
            80%{background-position: -40px 10px;}
            90%{background-position: -50px 10px;}
            100%{background-position: -60px 0;}
        }
        @-webkit-keyframes fadeIn {
            0% {
                opacity: 0; /*初始状态 透明度为0*/
            }
            50% {
                opacity: 0; /*中间状态 透明度为0*/
            }
            100% {
                opacity: 1; /*结尾状态 透明度为1*/
            }
        }
        .animate-wrap{
            animation: 10s animate linear infinite alternate;
            -o-animation: 10s animate linear infinite alternate;
            -moz-animation: 10s animate linear infinite alternate;
            -webkit-animation: 10s animate linear infinite alternate;
        }
        .below,.above,.bottom-container{
            position: absolute;
            bottom: 0;
            left:0;
            width:100%;

        }
        .below,.above{
            bottom: 360px;
        }
        .bottom-container{
            height:400px;
            width:100%;
            background:#fff;
        }
        .below{
            height: 141px;
            background:url('{{ asset('attachment/sys/below.png') }}') no-repeat;
            bottom: 381px;
        }
        .above{
            height:160px;
            background:url('{{ asset('attachment/sys/above.png') }}') no-repeat;
            animation-name: animate-above;
            -o-animation-name: animate-above;
            -moz-animation-name: animate-above;
            -webkit-animation-name: animate-above;
        }
        .container-text{
            width:697px;
            margin:0 auto;
            text-align:center;
            background-color:#fff;
        }
        .container-text-tit{
            font-size:36px;
            color:#686767;
            margin:0;
            line-height: 60px;
        }
        .container-text p{
            font-size:24px;
            color:#676767;
            margin: 0;
            line-height: 55px;
        }
        .container-text .btn{
            display:block;
            width:152px;
            height:41px;
            line-height: 41px;
            text-align:center;
            background:#4395d3;
            color:#fff;
            cursor:pointer;
            text-decoration: none;
            border-radius:41px;
            font-size: 15px;
            margin:0 auto;
        }
        .container{
            width:697px;
            margin:0 auto;
            overflow:hidden;
        }
        .sorry-left,.sorry-center,.sorry-right{
            float:left;
            padding-top: 100px;
        }
        .bones{
            margin-bottom: 40px;
            margin-left:83px;
            animation-name: fadeIn;
            -webkit-animation-name: fadeIn; /*动画名称*/
            -webkit-animation-duration: 3s; /*动画持续时间*/
            -webkit-animation-iteration-count: infinite; /*动画次数*/
            -webkit-animation-delay: 0s; /*延迟时间*/
        }
        .erha{
            margin:18px 93px 0 69px;
        }
        .sorry-right-txt{
            font-size: 57px;
            line-height: 32px;
            color:#4991c5;
            font-weight: bold;
            text-shadow: 1px 1px #8fbfe6, -1px -1px #333;
        }
        .sorry-right-404{
            font-size: 93px;
            color:#4991c5;
            font-weight: bold;
            text-shadow: 1px 1px #8fbfe6, -1px -1px #333;
        }
        .sorry-right{
            margin-top: 50px;
        }
        .sorry-center{
            position:relative;
        }
        .tears{
            position:absolute;
            width:36px;
            height:26px;
            top: 225px;
            left: 41px;
            background:url('{{ asset('attachment/sys/tears.png') }}') no-repeat;
            animation-name: fadeIn;
            -webkit-animation-name: fadeIn; /*动画名称*/
            -webkit-animation-duration: 1.5s; /*动画持续时间*/
            -webkit-animation-iteration-count: infinite; /*动画次数*/
            -webkit-animation-delay: 0.5s; /*延迟时间*/
        }
        .tears2{
            background-position: -1px -28px;
            top: 265px;
            left: 34px;
            animation-name: fadeIn;
            -webkit-animation-name: fadeIn; /*动画名称*/
            -webkit-animation-duration: 2s; /*动画持续时间*/
            -webkit-animation-iteration-count: infinite; /*动画次数*/
            -webkit-animation-delay: 0s; /*延迟时间*/
        }
        .tears3{
            background-position: -46px 0;
            top: 225px;
            left: 224px;
        }
        .tears4{
            background-position: -43px -30px;
            top: 266px;
            left: 234px;
            animation-name: fadeIn;
            -webkit-animation-name: fadeIn; /*动画名称*/
            -webkit-animation-duration: 2s; /*动画持续时间*/
            -webkit-animation-iteration-count: infinite; /*动画次数*/
            -webkit-animation-delay: 0s; /*延迟时间*/
        }
        .erha-img{
            position: absolute;
            width: 99%;
            bottom: 422px;
        }
        @media (min-width: 1200px) and (max-width: 1400px) {
            .erha-img{
                bottom: 322px;
            }
            .below{
                bottom: 281px;
            }
            .above{
                bottom: 260px;
            }
            .bottom-container{
                height: 300px;
            }
        }
        @media (min-width: 404px) and (max-width: 767px) {
            .erha-img{
                width: 98%;
                bottom: 444px;
            }
            .container{
                width:404px;
            }
            .bones{
                width:50px;
                margin-left: 21px;
            }
            .sorry-bg{
                width: 70px;
            }
            .erha{
                width:120px;
                margin: 18px 36px 0 61px;
            }
            .sorry-right-txt{
                font-size: 37px;
            }
            .container-text-tit{
                font-size: 26px;
            }
            .container-text{
                width:100%;
            }
            .sorry-right-404{
                font-size: 60px;
            }
            .tears{
                display:none;
            }
        }
        @media (min-width: 320px) and (max-width: 403px) {
            .erha-img{
                width: auto;
                bottom: 313px;
            }
            .container{
                width:auto;
            }
            .bones{
                width:50px;
                margin-left: 21px;
            }
            .sorry-bg{
                width: 70px;
            }
            .erha{
                width: 63px;
                margin: 18px 31px 0 50px;
            }
            .sorry-right-txt{
                font-size: 27px;
            }
            .container-text-tit{
                font-size: 18px;
                line-height: 20px;
            }
            .container-text{
                width:100%;
            }
            .sorry-right-404{
                font-size: 42px;
            }
            .container-text p{
                font-size: 14px;
            }
            .container-text .btn{
                width: 88px;
                height: 36px;
                line-height: 36px;
                font-size: 12px;
            }
            .bottom-container{
                height:260px;
            }
            .above{
                bottom: 187px;
            }
            .below{
                bottom: 210px;
            }
            .sorry-right{
                margin-top: 0;
            }

        }
    </style>
</head>
    <body>
        <div class="erha-img">
            <div class="container clear">
                <div class="sorry-left">
                    <img src="{{ asset('attachment/sys/bones.png') }}" alt="" class="bones">
                    <img src="{{ asset('attachment/sys/sorry-bg.png') }}" alt="" class="sorry-bg">
                </div>
                <div class="sorry-center">
                    <div class="tears tears1"></div>
                    <div class="tears tears2"></div>
                    <img src="{{ asset('attachment/sys/erha.png') }}" class="erha">
                    <div class="tears tears3"></div>
                    <div class="tears tears4"></div>
                </div>
                <div class="sorry-right">
                    <p class="sorry-right-txt">出错了</p>
                    <p class="sorry-right-404">404</p>
                </div>
            </div>
        </div>
        <div>
            <div class="animate-wrap below"></div>
            <div class="animate-wrap above"></div>
            <div class="bottom-container">
                <div class="container-text">
                    <h3 class="container-text-tit">出错了</h3>
                    <p>:( 很抱歉，您所访问的页面不存在</p>
                    <a href="{{ URL('/') }}" class="btn">返回首页</a>
                </div>
            </div>
        </div>
    </body>
</html>