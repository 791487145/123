
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">帮助详情</h3>

<form class="form-horizontal" action="/manage/helpUp" method="post">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$help['id']}}">
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">问题：</label>
            <div class="text-left col-sm-9">
                <input type="text" name="title" id="company_name" value="{{$help['title']}}">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">答案：</label>
            <div class="text-left col-sm-9">
                <div class="clearfix">
                    <textarea name="answer" cols="100" rows="5">{{$help['answer']}}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <lebel class="col-sm-1 text-right">类型：</lebel>
            <div class="text-left col-sm-9">
                <select name="type">
                    <option value="">请选择</option>
                    @if($type)
                        @foreach($type as $v)
                            <option value="{{ $v['id'] }}" {{ ($help['type']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
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

