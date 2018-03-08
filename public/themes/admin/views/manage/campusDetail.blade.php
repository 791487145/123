
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加招聘信息</h3>

<form class="form-horizontal" action="/manage/campusUpdate" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$campus['id']}}">
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">公司名称：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="company_name" id="company_name" value="{{$campus['company_name']}}">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <lebel class="col-sm-1 text-right">公司规模：</lebel>
            <div class="text-left col-sm-9">
                <select name="scale">
                    <option value="">请选择</option>
                    @if($scale)
                        @foreach($scale as $v)
                            <option value="{{ $v['id'] }}" {{ ($campus['scale']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">公司简介：</label>
            <div class="text-left col-sm-9">
                <div class="clearfix">
                    <textarea name="profile" cols="100" rows="5">{{$campus['profile']}}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">岗位名称：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="post_name" id="author" value="{{$campus['post_name']}}">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">薪资：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="salary" id="summary" value="{{$campus['salary']}}">  例：60/天 或60/小时 60/月
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">岗位要求：</label>
            <div class="text-left col-sm-8">
                <!--编辑器-->
                <div class="clearfix">
                    <script id="editor" name="post_demand"  type="text/plain" style="height:300px;" >{!! htmlspecialchars_decode($campus['post_demand']) !!}</script>
                </div>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">电话：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="phone" id="summary" value="{{$campus['phone']}}">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">邮箱：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="email" id="summary" value="{{$campus['email']}}">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">公司地址：</label>
            <div class="text-left col-sm-4">
                <input type="text" name="address" id="summary" style="width:400px" value="{{$campus['address']}}">
            </div>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10"><button type="submit" class="btn btn-sm btn-primary">提交</button></div>
                </div>
            </div>
        </div>

    </div>
</form>



{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('datepicker', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('touch-punch', 'plugins/ace/js/jquery.ui.touch-punch.min.js') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('autosize', 'plugins/ace/js/jquery.autosize.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('inputlimiter', 'plugins/ace/js/jquery.inputlimiter.1.3.1.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('maskedinput', 'plugins/ace/js/jquery.maskedinput.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('hotkeys', 'plugins/ace/js/jquery.hotkeys.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('wysiwyg', 'plugins/ace/js/bootstrap-wysiwyg.min.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('dataTab', 'plugins/ace/js/dataTab.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_dataTables', 'plugins/ace/js/jquery.dataTables.bootstrap.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('addarticle', 'js/doc/addarticle.js') !!}
