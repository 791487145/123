<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="">作品信息</a>
            </li>

            <li class="">
                <a  href="/manage/goodsComment/{!! $goods_info->id !!}">评价</a>
            </li>
        </ul>
    </div>
</div>

<form class="form-horizontal" action="/manage/saveGoodsInfo" method="post" name="seo-form">
    {{ csrf_field() }}
    <input name="id" type="hidden" value="{!! $goods_info->id !!}">
    <div class="g-backrealdetails clearfix bor-border interface">

        <div class="space-8 col-xs-12"></div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 店主</label>
                <div class="col-sm-9">
                    <label class="col-sm-2 row">{!! $goods_info->name !!}</label>
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 作品名称</label>

                <div class="col-sm-9">
                    <input type="text" class="col-sm-5" name="title" value="{!! $goods_info->title !!}">
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 作品分类</label>

                <div class="col-sm-9">
                    <select name="cate_first" id="cate_first">
                        @if(!empty($cate_first))
                            @foreach($cate_first as $item)
                                <option value="{!! $item['id'] !!}"
                                        @if($goods_info->cate_pid == $item['id'])selected="selected" @endif>
                                    {!! $item['name'] !!}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <select name="cate_id" id="cate_id">
                        @if(!empty($cate_second))
                            @foreach($cate_second as $item)
                                <option value="{!! $item['id'] !!}"
                                        @if($goods_info->cate_id == $item['id'])selected="selected" @endif>
                                    {!! $item['name'] !!}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 作品报价</label>

                <div class="col-sm-9">
                    <input type="text" class="col-sm-4" name="cash" value="{!! $goods_info->cash !!}"> 元
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 作品状态</label>

                <div class="col-sm-9">
                    @if($goods_info->status == 1 || $goods_info->status == 2)
                    <select name="status" id="status">
                        <option value="1" @if($goods_info->status == 1)selected="selected" @endif>售卖中</option>
                        <option value="2" @if($goods_info->status == 2)selected="selected" @endif>下架</option>
                    </select>
                    @elseif($goods_info->status == 0)待审核 <input type="hidden" name="status" value="{!! $goods_info->status !!}">
                    @elseif($goods_info->status == 3)审核失败 <input type="hidden" name="status" value="{!! $goods_info->status !!}">
                    @endif
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 发布时间</label>
                <div class="col-sm-9">
                    <label class="col-sm-2 row">{!! $goods_info->created_at !!}</label>
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 作品描述</label>
                <div class="col-sm-8">
                    <div class="clearfix ">
                        <script id="editor" name="desc" type="text/plain">{!! htmlspecialchars_decode($goods_info->desc) !!}</script>
                        {{--<div class="wysiwyg-editor" id="editor1">{!! htmlspecialchars_decode($goods_info->desc) !!}</div>
                        <input type="hidden" name="desc" id="discription-edit"  value="{!! $goods_info->desc !!}">--}}
                    </div>
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> seo标题</label>

                <div class="col-sm-9">
                    <textarea class="col-xs-5 col-sm-5" rows="1" name="seo_title" >{!! $goods_info->seo_title !!}</textarea>
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1" rows="2"> seo关键字</label>

                <div class="col-sm-9">
                    <textarea class=" col-xs-5 col-sm-5" rows="1" name="seo_keyword">{!! $goods_info->seo_keyword !!}</textarea>
                </div>
            </div>
            <div class="interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> seo描述</label>

                <div class="col-sm-9">
                    <textarea class="col-xs-5 col-sm-5" rows="1" name="seo_desc" >{!! $goods_info->seo_desc !!}</textarea>
                </div>
            </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-9" id="delete_id" data-id="{!! $goods_info->id !!}">
                        <button class="btn btn-info btn-sm" type="submit" >
                            提交
                        </button>
                        @if($goods_info->status == 0)
                            <button class="btn btn-success btn-sm" type="button" data-values="3" onclick="changeGoodsStatus(this)">

                                审核通过
                            </button>
                            <button class="btn btn-danger btn-sm check_failure" type="button" data-values="3" data-toggle="modal" data-target="#modal1">

                                审核不通过
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <label class="col-sm-1" for="form-field-1"></label>
            <div class="col-sm-9">
                <div class="space"></div>
                <a href="/manage/goodsInfo/{!! $pre_id !!}">上一项</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/manage/goodsList">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/manage/goodsInfo/{!! $next_id !!}">下一项</a>
                <div class="space"></div>
            </div>
        </div>
    </div>
</form>
<!--模态框（Modal） -->
<form action="javascript:;" method="post" enctype="multipart/form-data" id="report-form">

    <input type="hidden" name="task_id" value="">
    <input type="hidden" name="work_id" value="" id="report-work-id">
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header widget-header-flat">
                <span class="modal-title cor-gray51 h4 text-blod">
                    审核失败：
                </span>
                    <button type="button" class="bootbox-close-button close text-size14" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="space-8"></div>
                    <div class="clearfix">
                        <div class="form-group clearfix">
                            <label class="col-sm-1 control-label text-right">失败原因：</label>
                            <div class="col-sm-8 ">
                                <textarea type="text" name="reason" id="reason" placeholder="请输入审核失败的原因"  rows="3" class="col-xs-12 jbchat-text"></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="space-4"></div>
                    <div class="clearfix text-center" data-id="">
                        <button class="btn btn-primary btn-md btn-big1 btn-blue bor-radius2" type="button" id="check_failure"  data-dismiss="modal" aria-hidden="true">确定</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-default btn-md btn-big1 btn-gray999 bor-radius2" data-dismiss="modal" aria-hidden="true">取消</button>
                    </div>
                    <div class="space"></div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>
    </div>
</form>
{!! Theme::widget('editor')->render() !!}
{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shoplist', 'js/doc/goodslist.js') !!}