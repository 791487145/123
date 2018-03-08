<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="/manage/updatePrivileges/{{$privilegesInfo['id']}}">
    {!! csrf_field() !!}
    <div class="g-backrealdetails clearfix bor-border interface">

        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">特权名</label>

            <div class="col-sm-4">
                <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="title" value="{{$privilegesInfo['title']}}" @if(in_array($privilegesInfo['code'],['SHOP_DECORATION'])) readonly="readonly" @endif>
                {{$errors->first('title')}}
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">说明</label>

            <div class="col-sm-4">
                <textarea rows="10" cols="71%" name="desc">{{$privilegesInfo['desc']}}</textarea>
                {{$errors->first('desc')}}
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">展示图片</label>

            <div class="col-sm-4">
                <div class="memberdiv pull-left">
                    <div class="position-relative">

                        <div id="imgdiv2">
                            <img id="imgShow1" width="120" height="120" src="{{URL($privilegesInfo['ico'])}}">
                        </div>

                        <a class="filea btn btn-sm btn-primary btn-block" href="javascript:void(0);">
                            上传图片
                            <input class="btn-file" type="file" id="up_img1" name="ico">
                        </a>
                        {{$errors->first('ico')}}
                    </div>
                </div>
            </div>
            <div class="col-sm-5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i>
                建议尺寸70*70px
            </div>
        </div>
        <div class="interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">排序</label>

            <div class="col-sm-4">
                <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="list" value=" {{$privilegesInfo['list']}}">
                {{$errors->first('list')}}
            </div>
            <div class="col-sm-5">
                <label class="">
                    <input class="ace " type="checkbox" name="status" id="status" @if($privilegesInfo['status'] == 0) checked="checked" value="1" @endif>
                    <span class="lbl aStar"> 是否启用 </span>
                </label>
                　　
                <label class="aStop" @if($privilegesInfo['status'] == 0) style="display:inline-block;" @endif>
                    <input class="ace" type="checkbox" name="is_recommend" id="is_recommend" @if($privilegesInfo['is_recommend'] == 1) checked="checked" value="1" @endif >
                    <span class="lbl"> 是否推荐 </span>
                </label>
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
{!! Theme::asset()->container('specific-js')->usepath()->add('jquery.webui-popover', '/plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('vipinfoadd', 'js/vipinfoadd.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('uploadimg', 'js/doc/uploadimg.js') !!}
{!! Theme::widget('uploadimg')->render() !!}

