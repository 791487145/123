<div class="shop-wrap clearfix">
    <div class="col-sm-12 col-left">
        <div class="shop-wares buygoods-shop orders-wares shopsuccess-main">
            <div class="step-content row-fluid position-relative" id="step-container">
                <div class="space-30"></div>
                <div class="space-30"></div>
                <div class="space-30"></div>
                <div class="clearfix">
                    <div class="col-lg-5 col-md-4 col-sm-3 hidden-xs text-right">
                        <img src="{!! Theme::asset()->url('images/sign-icon1.png') !!}" alt="">
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-9 hidden-xs text-left">
                        <p class="text-size24">恭喜，您已完成付款 <span class="cor-orange31">￥30.00</span></p>
                        <p class="cor-gray51 text-size14">页面将在<span id="show"></span>秒后自动跳转</p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm text-center hidden-xs">
                        <img src="{!! Theme::asset()->url('images/sign-icon1.png') !!}" alt="">
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm text-center visible-xs-block">
                        <p class="text-size24">恭喜您，密码设置成功!</p>
                        <p class="cor-gray51 text-size14">页面将在<span id="show"></span>秒后自动跳转</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var t=5;//设定跳转的时间
    setInterval("refer()",1000); //启动1秒定时
    function refer(){
        if(t===0){
            location="{!! url('') !!}"; //#设定跳转的链接地址

        }
        if(t>-1){
            document.getElementById('show').innerHTML=""+t+""; // 显示倒计时
            t--; // 计数器递减
        }

    }
</script>
{!! Theme::asset()->container('custom-css')->usepath()->add('successstory','css/shop/successstory.css') !!}