
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加招聘信息</h3>

<form class="form-horizontal" action="/manage/campus" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">公司名称：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="company_name" id="company_name" value="">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <lebel class="col-sm-1 text-right">公司规模：</lebel>
            <div class="text-left col-sm-9">
                <select name="scale">
                    <option value="">请选择</option>
                    @if($scale)
                        @foreach($scale as $item)
                            <option value="{{$item['id']}}">{{ $item['name'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">公司简介：</label>
            <div class="text-left col-sm-9">
                <div class="clearfix">
                    <textarea name="profile" cols="100" rows="5"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">岗位名称：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="post_name" id="author" value="">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">薪资：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="salary" id="summary" value="">  例：60/天 或60/小时 60/月
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">岗位要求：</label>
            <div class="text-left col-sm-8">
                <!--编辑器-->
                <div class="clearfix">
                    <script id="editor" name="post_demand"  type="text/plain" style="height:300px;" ></script>
                </div>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">电话：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="phone" id="summary" value="">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">邮箱：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="email" id="summary" value="">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">公司地址：</label>
            <div class="text-left col-sm-4">
                <input type="text" name="address" id="summary" style="width:400px">
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
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}
