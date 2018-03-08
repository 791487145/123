

<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#need">失物招领详情</a>
            </li>
        </ul>
    </div>
</div>
<div class="widget-body">
    <div class="widget-main paddingTop no-padding-left no-padding-right">
        <div class="tab-content padding-4">
            <div id="need" class="tab-pane active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="g-backrealdetails clearfix bor-border interface">
                                <div class="space-8 col-xs-12"></div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 标题： </label>
                                    <div class="col-sm-9">
                                        <label class="col-sm-1">{{ $good['title'] }}</label>
                                    </div>
                                </div>

                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 物品名称： </label>
                                    <div class="col-sm-9">
                                        <label class="col-sm-1">{{ $good['goods_name'] }}</label>
                                    </div>

                                </div>

                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 物品类型： </label>

                                    <div class="col-sm-9">
                                        <label class="col-sm-6">{{ $good['class_name'] }}</label>

                                    </div>
                                </div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 物品描述： </label>
                                    <div class="col-sm-8">
                                        <div class="clearfix ">
                                            {!! htmlspecialchars_decode($good['details']) !!}
                                        </div>
                                        @if(!empty($good_img))
                                            @foreach($good_img as $item)
                                                <img src="/{!! $item['img_name'] !!}" height="50" alt=""/>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                @if($good['type'] == 1)
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 丢失时间： </label>
                                    <div class="col-sm-9">
                                        <label class="col-sm-1">{{ $good['last_or_found_time'] }}</label>
                                    </div>
                                </div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 丢失地点： </label>
                                    <div class="col-sm-9">
                                        <label class="col-sm-1">{{ $good['last_or_found_address'] }}</label>
                                    </div>
                                </div>

                                @else
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 拾取时间： </label>
                                    <div class="col-sm-9">
                                        <label class="col-sm-1">{{ $good['last_or_found_time'] }}</label>
                                    </div>
                                </div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 拾取地点： </label>
                                    <div class="col-sm-9">
                                        <label class="col-sm-1">{{ $good['last_or_found_address'] }}</label>
                                    </div>
                                </div>
                                @endif

                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 联系人： </label>

                                    <div class="col-sm-9">
                                        <label class="col-sm-2">{{ $good['contacts'] }}</label>
                                    </div>
                                </div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 联系电话： </label>
                                    <div class="col-sm-9">
                                        <label class="col-sm-1">{{ $good['contacts_phone'] }}</label>
                                    </div>
                                </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

</div>


{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}