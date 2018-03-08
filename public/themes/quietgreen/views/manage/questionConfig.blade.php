<h3 class="header smaller lighter blue mg-bottom20 mg-top12">问答配置</h3>
<form class="form-horizontal" action="/manage/postConfig" method="post" name="shopConfig">
    {!! csrf_field() !!}
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">是否开启问答功能</label>

            <div class="col-sm-9">
                <label>
                    <input class="ace" type="radio" name="question_switch" value="1" {{ ($question_switch==1)?'checked':'' }}>
                    <span class="lbl"> 开启</span>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                    <input class="ace" type="radio" name="question_switch" value="0" {{ ($question_switch==0)?'checked':'' }}>
                    <span class="lbl"> 不开启 </span>
                </label>
            </div>
        </div>
        <div class=" interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1" rows="2">是否开启审核</label>

            <div class="col-sm-9">
                <label>
                    <input class="ace" type="radio" name="question_verify" value="1" {{ ($question_verify==1)?'checked':'' }}>
                    <span class="lbl"> 开启</span>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                    <input class="ace" type="radio" name="question_verify" value="0" {{ ($question_verify==0)?'checked':'' }}>
                    <span class="lbl"> 不开启 </span>
                </label>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10">
                        <button class="btn btn-info" type="submit">
                            保存
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}