<script>
    function checkForm() {
        var displayname =  $("input[name='display_name']");
        if(displayname == ""){
            alert('权限名b')
        }
    }
</script>
{{--<div class="well">
    <h4 >添加菜单</h4>
</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加菜单</h3>
<div class="">
    <div class="g-backrealdetails clearfix bor-border">
        <form class="form-horizontal clearfix registerform" role="form" action="/manage/menuCreate" method="post" >
            {!! csrf_field() !!}
            <input type="hidden" name="pid" value="{{ $id }}"/>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 菜单名：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="name" >
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1">菜单路由：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="route">
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1">排序：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="sort" value="0" />
                </p>
            </div>

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 描述：</p>
                <p class="col-sm-4">
                    <textarea name="note" class="col-xs-10 col-sm-5"></textarea>
                </p>
            </div>

            <div class="col-xs-12">
                <div class="clearfix row bg-backf5 padding20 mg-margin12">
                    <div class="col-xs-12">
                        <div class="col-md-1 text-right"></div>
                        <div class="col-md-10">
                            <button class="btn btn-primary btn-sm" type="submit">提交</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space col-xs-12"></div>
            <div class="col-xs-12">
                <div class="col-md-1 text-right"></div>
                <div class="col-md-10"><a href="">上一项</a>　　<a href="">下一项</a></div>
            </div>
            <div class="col-xs-12 space">

            </div>
            {{--<div class="bankAuth-bottom clearfix col-xs-12">
                <label class="col-sm-1 control-label no-padding-left" for="form-field-1"></label>
                <div class="col-sm-3 text-left">
                    　<button class="btn btn-primary btn-sm" type="submit" >提交</button>
                </div>
            </div>--}}
        </form>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
