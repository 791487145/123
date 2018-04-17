
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
            <lebel class="col-sm-1 text-right">工作经验：</lebel>
            <div class="text-left col-sm-9">
                <select name="work_old">
                    <option value="">不限</option>
                    <option value="">1年以内</option>
                    <option value="">1-3年</option>
                    <option value="">3-5年</option>
                    <option value="">5-10年</option>
                    <option value="">10年以上</option>
                </select>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <lebel class="col-sm-1 text-right">学历：</lebel>
            <div class="text-left col-sm-9">
                <select name="education">
                    <option value="">不限</option>
                    <option value="">中专</option>
                    <option value="">大专</option>
                    <option value="">本科</option>
                    <option value="">硕士</option>
                    <option value="">博士</option>
                </select>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12 positionLable">
            <label class="col-sm-1 text-right" style="width: 100px">技能标签：</label>
            <div class="text-left col-sm-9" style="margin-bottom: 10px">
                <input type="text" name="positionLables[]" class="positionLables" value="">
                <button type="button"  class="positionLables_add">增加</button><button type="button" class="positionLables_del">删除</button>
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

<script>
    $('.positionLables_add').click(function(){
        var _html ="<div style='clear:both;height: 34px; margin-top: 10px '>"+
                        "<label class='col-sm-1 text-right' style='width:100px'>技能标签：</label>" +
                        "<div class='text-left col-sm-9'>" +
                            "<input type='text' name='positionLables[]' class='positionLables'>" +
                            "<button type='button' class='positionLables_del'>删除</button>" +
                        "</div>"+
                    "</div>";
        $(".positionLable").append(_html);
    })

    $(".positionLable").on('click','.positionLables_del',function(e){
        $(this).parent().parent().remove();
    })


</script>



{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}
