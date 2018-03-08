<form class="form-horizontal addForm" role="form" enctype="multipart/form-data" method="post" action="/manage/editPackage/{{$packageInfo['id']}}">
    {{csrf_field()}}
    <div class="g-backrealdetails clearfix bor-border interface">

        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">套餐名称</label>

            <div class="col-sm-4">
                <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="title" value="{{$packageInfo['title']}}">
                {{$errors->first('title')}}
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">套餐标识</label>

            <div class="col-sm-4">
                <div class="memberdiv pull-left">
                    <div class="position-relative">

                        <div id="imgdiv1">
                            <img id="imgShow1" width="120" height="120" src="{{URL($packageInfo['logo'])}}">
                        </div>

                        <a class="filea btn btn-sm btn-primary btn-block" href="javascript:void(0);">
                            上传标识
                            <input class="btn-file" type="file" id="up_img1" name="logo">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i>
                建议尺寸140*140px
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">排序</label>

            <div class="col-sm-1">
                <div class="ace-spinner touch-spinner" style="width: 100px;">
                    <div class="input-group">
                        <input type="text" id="spinner3" name="list" value="{{$packageInfo['list']}}" class="input-mini spinner-input form-control"  maxlength="3">

                    </div>
                </div>


                {{-- <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="footer_copyright" value=" ">--}}
            </div>
            <div class="col-sm-1 cor-gray87">
                <label class="im-close">
                    <input class="ace" type="checkbox" name="status" id="status" @if($packageInfo['status'] == 0) checked="checked"  value="1" @endif>
                    <span class="lbl"> 上架 </span>
                </label>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">套餐内容</label>
            @if(!empty($privileges))
                <div class="col-sm-8">
                    @foreach($privileges as $pv)
                        <label>
                            <input type="checkbox" class="drag-tabinp" value="{{$pv['id']}}" @if(in_array($pv['id'],$packageInfo['privileges'])) checked="checked" name="privileges[]" @endif>
                            <span class="drag-tabspan">{{$pv['title']}}</span>
                        </label>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="interface-bottom col-xs-12 txtinput">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">时长金额设定</label>

            <div class="col-sm-7">
                <table class="" align="left" width="70%">
                    <tbody id="getTr">
                    @if(!empty($packageInfo['price_rules']))
                    @foreach($packageInfo['price_rules'] as $pk=>$pv)
                    <tr>
                        <td style="width: 264px">
                            <input type="text" value="{{$pv['time_period']}}"  datatype="*" class="inputxt" name="price_rules[{{$pk}}][time_period]"/> 月
                        </td>
                        <td style="width: 284px">
                            金额：<input type="text"  datatype="*" value="{{$pv['cash']}}"  class="inputxt" name="price_rules[{{$pk}}][cash]"/> 元
                        </td>
                        @if($pk == 0)
                        <td>
                            <a class="btn btn-xs btn-info" href="javascript:;" id="addTr">添加</a>
                        </td>
                        @else
                        <td>
                            <a onclick='getDel(this)' class='btn btn-xs btn-danger' href='javascript:;' id='delTr'>删除</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10"><button id="sub" type="submit" class="btn btn-sm btn-primary">提交</button></div>
                </div>
            </div>
        </div>
    </div>
</form>
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('jquery.webui-popover', '/plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('addPackage', 'js/doc/addPackage.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('fuelux.spinner.min.js', 'plugins/ace/js/fuelux/fuelux.spinner.min.js') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('uploadimg', 'js/doc/uploadimg.js') !!}
{!! Theme::widget('uploadimg')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
