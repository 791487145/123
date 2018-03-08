
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">添加自定义导航</h3>

<div class="g-backrealdetails clearfix bor-border">
        <form action="/manage/addNav" method="post">
            {{ csrf_field() }}
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-md-1 text-right">标题：</p>
                <p class="col-md-11 text-left">
                   <input type="text" name="title" id="title" value="">
                    <span class="red">{{ $errors->first('title') }}</span>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-md-1 text-right">链接：</p>
                <p class="col-md-11 text-left">
                    <input type="text" name="link_url" id="link_url" value="">
                    <span class="red">{{ $errors->first('link_url') }}</span>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-md-1 text-right">排序：</p>
                <p class="col-md-11 text-left">
                    <input type="text" name="sort" id="sort" value="">
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-md-1 text-right">新窗口打开：</p>
                <p class="col-md-11 text-left">
                    <label class="">
                        <input type="radio"  name="is_new_window" value="1" checked/>
                        <span class="lbl"></span>是
                        <input type="radio" name="is_new_window" value="2"/>
                        <span class="lbl"></span>否
                    </label>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-md-1 text-right">显示模式：</p>
                <p class="col-md-11 text-left">
                    <label class="">
                        <input type="radio"  name="is_show" value="1" checked/>
                        <span class="lbl"></span>显示
                        <input type="radio" name="is_show" value="2"/>
                        <span class="lbl"></span>隐藏
                    </label>
                </p>
            </div>
            <div class="col-md-12">
                <div class="clearfix row bg-backf5 padding20 mg-margin12">
                    <div class="col-xs-12">
                        <div class="col-md-1 text-right"></div>
                        <div class="col-md-10">

                            <button class="btn btn-primary btn-sm" type="submit">提交</button>
                            <a href="javascript:history.back()" title="" class=" add-case-concel">返回</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
<!-- basic scripts -->
