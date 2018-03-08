
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">雇佣编辑</h3>

<form class="form-horizontal" action="{{ URL('manage/serviceOrderUpdate') }}" method="post" name="seo-form">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $data['id'] }}">
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 雇主</label>

                <div class="col-sm-9">
                    <label class="col-sm-2 row">{{ $data['employer_name'] }}</label>
                    <label class="col-sm-2 row">手机号：{{ $data['phone'] }}</label>
                    <a target="_blank" href="{{ URL('employ/detail',['id'=>$data['id']]) }}" class="btn btn-sm btn-info">查看前台详情</a>
                </div>
            </div>

        <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 标题</label>

                <div class="col-sm-9">
                    <input type="text" class="col-sm-5" name="title" value="{{ $data['title'] }}">
                </div>
            </div>
        <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 托管赏金</label>

                <div class="col-sm-9">
                    {{ $data['bounty'] }}
                </div>
            </div>
        <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 雇佣发布日期</label>
                <div class="col-sm-9">
                    <label class="col-sm-2 row">{{ $data['created_at'] }}</label>
                    <label class="col-sm-9">
                        雇佣受理日期：
                        @if($data['status']>0)
                            <span>{{ $data['employed_at'] }}</span>
                        @else
                            <span>当前任务还未受理</span>
                        @endif
                    </label>
                </div>
            </div>
        <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 雇佣截止日期</label>

                <div class="col-sm-9">
                    <label class="col-sm-12 row">
                        {{ $data['delivery_deadline'] }}
                    </label>
                </div>
            </div>
        <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">  附件</label>
                <div class="col-sm-9">
                    @foreach($attachment as $k=>$v)
                        <a href="{{ URL('manage/download',['id'=>$v['attachment_id']]) }}" class="btn btn-sm btn-info" target="_blank">附件{{ $k+1 }}</a>&nbsp;&nbsp;
                    @endforeach
                </div>
            </div>
        <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 详细需求描述</label>
                <div class="col-sm-8">
                    <div class="clearfix ">
                        <script id="editor" name="desc" type="text/plain">{!! $data['desc'] !!} </script>
                        {{--<div class="wysiwyg-editor" id="editor1">{{ $data['desc'] }}</div>--}}
                        {{--<input type="hidden" name="desc" id="discription-edit" datatype="*" nullmsg="需求描述不能为空" value="{{ $data['desc'] }}">--}}
                    </div>
                </div>
            </div>
        <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> seo标题</label>

                <div class="col-sm-9">
                    <textarea class="col-xs-5 col-sm-5" rows="1" name="seo_title" >{{ $data['seo_title'] }}</textarea>
                </div>
            </div>
        <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1" rows="2"> seo关键字</label>

                <div class="col-sm-9">
                    <textarea class=" col-xs-5 col-sm-5" rows="1" name="seo_keywords">{{ $data['seo_keywords'] }}</textarea>
                </div>
            </div>
        <div class=" interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> seo描述</label>

                <div class="col-sm-9">
                    <textarea class="col-xs-5 col-sm-5" rows="1" name="seo_content" >{{ $data['seo_content'] }}</textarea>
                </div>
            </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-9">
                        <button class="btn btn-info btn-sm" type="submit" >
                            提交
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{!! Theme::widget('editor')->render() !!}
{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}