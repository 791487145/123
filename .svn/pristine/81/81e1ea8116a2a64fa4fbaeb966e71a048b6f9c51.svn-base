<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="{{ ($type==1)?'active':'' }}">
                <a href="{{ URL('manage/getDetail',['id'=>$id]) }}">提问</a>
            </li>
            <li class="{{ ($type==2)?'active':'' }}">
                <a href="{{ URL('manage/getDetailAnswer',['id'=>$id]) }}">回答</a>
            </li>
        </ul>
    </div>
</div>
@if($type==1)
<form class="form-horizontal" method="post" action="/manage/postDetail" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <input type="hidden" value="{{ $detail['id'] }}" name="id" />
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">提问人</label>
            <label class="text-left col-sm-9">{{ $detail['username'] }}</label>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">问题类型</label>
            <label class="text-left col-sm-9">
                <select name="first_cate" id="first_category" onchange="firstCate($(this))">
                    @foreach($category_first as $v)
                    <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                    @endforeach
                </select>
                <select name="category" id="second_category">
                    @foreach($category_second as $v)
                        <option value="{{ $v['id'] }}" {{ ($detail['category']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">问题描述</label>
            <div class="text-left col-sm-8">
                <!--编辑器-->
                <div class="clearfix">
                    <script id="editor" name="discription" type="text/plain">{!!  $detail['discription'] !!}</script>
                    {{--<div class="wysiwyg-editor" id="editor1">{!! htmlspecialchars_decode($article['content']) !!}</div>
                    <textarea name="content" id="content" style="display: none">{!! htmlspecialchars_decode($article['content']) !!}</textarea>--}}
                </div>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">发布时间</label>
            <label class="text-left col-sm-9">
                {{ $detail['time'] }}
            </label>
        </div>
        <div class="interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">状态</label>
            <label class="text-left col-sm-9">
                {{ $map[$detail['status']] }}
            </label>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary">保存</button>
                        @if($detail['status']==1)
                        <a type="submit" class="btn btn-sm btn-success" href="{{ URL('manage/verify',['id'=>$detail['id'],'status'=>1]) }}">审核成功</a>
                        <a type="submit" class="btn btn-sm btn-danger" href="{{ URL('manage/verify',['id'=>$detail['id'],'status'=>2]) }}">审核失败</a>
                        @endif
                    </div>
                </div>i
            </div>
        </div>
        <div class="space col-xs-12"></div>
        <div class="col-xs-12 ">
            <div class="col-sm-1 text-right"></div>
            <div class="col-md-10">
                @if(is_numeric($preId))
                <a href="{{ URL('manage/getDetail',['id'=>$preId]) }}">上一页</a>
                @endif
                &nbsp;&nbsp;&nbsp;&nbsp;　
                <a href="/manage/questionList">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;　
                @if(is_numeric($nextId))　
                <a href="{{ URL('manage/getDetail',['id'=>$nextId]) }}">下一项</a>
                @endif
            </div>
        </div>
    </div>
</form>
@else
<form class="form-horizontal" method="post" action="/manage/editArticle" enctype="multipart/form-data">
    <div class="g-backrealdetails clearfix bor-border interface">
        @foreach($answer as $v)
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <div>
                <label class="">{{ $v['username'] }}  &nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="">
                    回答&nbsp;
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                @if($v['adopt']==1)
                <label class="">
                    采纳&nbsp;
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                @endif
                <label class="">
                    打赏：￥{{ $v['cash'] }}.00&nbsp;
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="">
                    回答时间：{{ date('Y-m-d',strtotime($v['time'])) }}
                </label>
            </div>
            <div class="space-6"></div>
            <div>
                {!! $v['content'] !!}
            </div>
        </div>
        @endforeach
    </div>
</form>
@endif
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('questionlist', 'js/doc/questiondetail.js') !!}