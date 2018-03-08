
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">编辑自定义导航</h3>

    <div class="g-backrealdetails clearfix bor-border">
        <form action="/manage/editNav" method="post">
            {{ csrf_field() }}
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="text-right col-xs-1"><lable>标题</lable></p>
                <p class="text-left col-xs-9">
                   <input type="text" name="title" id="title" value="{{$navInfo[0]['title']}}">
                    {{ $errors->first('title') }}
                    <input type="hidden" name="id" value="{{$navInfo[0]['id']}}">
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="text-right col-xs-1">链接</p>
                <p class="text-left col-xs-9" >
                    <input type="text" name="link_url" id="link_url" value="{{$navInfo[0]['link_url']}}">
                    {{ $errors->first('link_url') }}

                </p>
            </div>
            {{--<tr>
                <td class="text-right">样式：</td>
                <td class="text-left">
                    <input type="text" name="style" id="style" value="{{$navInfo[0]['style']}}">
                    {{ $errors->first('style') }}
                </td>
            </tr>--}}
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="text-right col-xs-1">排序</p>
                <p class="text-left col-xs-9">
                    <input type="text" name="sort" id="sort" value="{{$navInfo[0]['sort']}}">
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="text-right col-xs-1">新窗口打开</p>
                <p class="text-left col-xs-9">
                    <label class="">
                        <input type="radio"  name="is_new_window" value="1" @if($navInfo[0]['is_new_window'] == 1)checked="checked"@endif/>
                        <span class="lbl"></span>是
                        <input type="radio" name="is_new_window" value="2" @if($navInfo[0]['is_new_window'] == 2)checked="checked"@endif/>
                        <span class="lbl"></span>否
                    </label>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="text-right col-xs-1">显示模式</p>
                <p class="text-left col-xs-9">
                    <label class="">
                        <input type="radio"  name="is_show" value="1" @if($navInfo[0]['is_show'] == 1)checked="checked"@endif/>
                        <span class="lbl"></span>显示
                        <input type="radio" name="is_show" value="2" @if($navInfo[0]['is_show'] == 2)checked="checked"@endif/>
                        <span class="lbl"></span>隐藏
                    </label>
                </p>
            </div>
            <div class="col-xs-12">
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
            {{--<tr>
                <td class="text-right col-xs-3"></td>
                <td class="text-left col-xs-9">
                    <button class="btn btn-primary btn-sm" type="submit">提交</button>
                </td>
            </tr>--}}
        </form>
    </div>


<!-- basic scripts -->
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}