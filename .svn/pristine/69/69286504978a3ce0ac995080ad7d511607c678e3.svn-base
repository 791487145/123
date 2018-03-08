<div class="page-content-area">
    <div class="row">
        <div class="col-xs-12">
            {{--<div class="alert alert-info">
                <h3>模板标签</h3>
                <small>颜色选择</small>
            </div>--}}
            <h3 class="header smaller lighter blue mg-bottom20 mg-top12">模板管理</h3>
            @if($theme_now=='default')
            <div class="h4 text-primary">网站换色</div>
            <div class="well well-sm text-muted">温馨提示：网站换色功能目前只适用于经典版皮肤，暂不支持商业皮肤换色</div>
            <div id="skin" class="clearfix">
                <a href="/manage/skinSet/blue" id="skin_0" class="{{ ($skin_config=='blue')?'selected':'' }}" title="blue"></a>
                <a href="/manage/skinSet/red" id="skin_1" class="{{ ($skin_config=='red')?'selected':'' }}" title="red"></a>
                <a href="/manage/skinSet/gray" id="skin_2" class="{{ ($skin_config=='gray')?'selected':'' }}" title="gray"></a>
                <a href="/manage/skinSet/orange" id="skin_3" class="{{ ($skin_config=='orange')?'selected':'' }}" title="orange"></a>
            </div>
            @endif
            <div class="space"></div>
            <div class="well well-sm text-muted h4 text-primary">网站模板选择</div>
            <div class="clearfix">
                @foreach($themes as $v)
                    <div class="col-sm-3">
                        <div class="thumbnail" style="height: 190px;overflow: hidden"><img src="{{ $v['themepic'] }}" alt=""></div>
                        <div class="text-center">
                            @if($v['themename']=='default')
                                <p>经典版{{ ($v['themename']==$theme_now)?'(使用中)':'' }}</p>
                            @elseif($v['themename']=='quietgreen')
                                <p>静谧绿{{ ($v['themename']==$theme_now)?'(使用中)':'' }}</p>
                            @elseif($v['themename']=='black')
                                <p>时尚黑{{ ($v['themename']==$theme_now)?'(使用中)':'' }}</p>
                            @endif
                            @if($v['themename']==$theme_now)
                                <a class="btn btn-sm btn-primary disabled">停用</a>
                            @else
                                <a class="btn btn-sm btn-primary" href="{{ URL('manage/skinChange',['name'=>$v['themename']]) }}">启用</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div><!-- /.row -->
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
<script>
    $(function () {
        var aSkin = $("#skin a");  //查找到元素
        aSkin.click(function () {   //给元素添加事件
            switchSkin(this.id);//调用函数
        });
    });
    function switchSkin(skinName) {
        $("#" + skinName).addClass("selected")                //当前a元素选中
                .siblings().removeClass("selected");  //去掉其他同辈a元素的选中
    }
</script>