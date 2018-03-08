
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加帮助信息</h3>

<form class="form-horizontal" action="/manage/help" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">问题：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="title" id="summary" style="width:400px">
            </div>
        </div>

        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">答案：</label>
            <div class="text-left col-sm-9">
                <div class="clearfix">
                    <textarea name="answer" cols="100" rows="5"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <lebel class="col-sm-1 text-right">类型：</lebel>
            <div class="text-left col-sm-9">
                <select name="type">
                    <option value="">请选择</option>
                    @if($type)
                        @foreach($type as $item)
                            <option value="{{$item['id']}}">{{ $item['name'] }}</option>
                        @endforeach
                    @endif
                </select>
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

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}