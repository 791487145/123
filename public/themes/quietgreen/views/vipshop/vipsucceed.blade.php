
<main class="content">
    <div class="container ">
        <div class="row">
            <div class="g-taskposition col-lg-12 col-left">当前位置：首页 &gt; VIP首页 &gt; 套餐购买</div>
            <div class="col-xs-12 col-left">
                <div class="taskDetails taskbg clearfix taskSuccess">
                    <div class="taskSuccess-left col-lg-5 col-md-3 col-sm-2 hidden-xs text-right">
                        <img src="{{ Theme::asset()->url('images/success-right.png') }}" alt="">
                    </div>
                    <div class="taskSuccess-left hidden-lg hidden-sm hidden-md visible-xs-12 text-center">
                        <img src="{{ Theme::asset()->url('images/success-right.png') }}" alt="">
                    </div>
                    <div class="taskSuccess-right col-lg-7 col-md-9 col-sm-10 col-xs-12">
                        <h4 class="text-size24">恭喜,您已完成付款&nbsp;</h4>
                        <p class="cor-gray51 text-size14">页面将在<span id="show"></span>秒后自动跳转到</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('index','css/vipshop.css') !!}
<script type="text/javascript">
    var t=5;//设定跳转的时间
    setInterval("refer()",1000); //启动1秒定时
    function refer(){
        if(t==1){
            location="{!! url('login') !!}"; //#设定跳转的链接地址
        }
        if (t>=0){
            document.getElementById('show').innerHTML=""+t+""; // 显示倒计时
            t--; // 计数器递减
        }

    }
</script>