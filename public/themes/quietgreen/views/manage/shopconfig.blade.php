
                    <h3 class="header smaller lighter blue mg-bottom20 mg-top12">店铺设置</h3>

                    <form class="form-horizontal" action="/manage/postShopConfig" method="post" name="shopConfig">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="">
                        <div class="g-backrealdetails clearfix bor-border interface">
                            <div class="space-8 col-xs-12"></div>
                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">作品上架审核</label>

                                <div class="col-sm-9">
                                    <label>
                                        <input class="ace" type="radio" name="goods_check" value="1"
                                              @if(isset($shop_config['goods_check']) && $shop_config['goods_check']== 1 )checked="checked" @endif>
                                        <span class="lbl"> 开启</span>
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input class="ace" type="radio" name="goods_check" value="2"
                                               @if(isset($shop_config['goods_check']) && $shop_config['goods_check']== 2 )checked="checked" @endif>
                                        <span class="lbl"> 关闭 </span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1" rows="2">服务上架审核</label>

                                <div class="col-sm-9">
                                    <label><input class="ace" type="radio" name="service_check" value="1"
                                                  @if(isset($shop_config['service_check']) && $shop_config['service_check']== 1 )checked="checked" @endif>
                                        <span class="lbl"> 开启</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input class="ace" type="radio" name="service_check" value="2"
                                                  @if(isset($shop_config['service_check']) && $shop_config['service_check']== 2 )checked="checked" @endif>
                                        <span class="lbl"> 关闭 </span></label>
                                </div>
                            </div>
                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">作品推荐</label>

                                <div class="col-sm-9">
                                    <label><input class="ace" type="radio" name="is_goods_recommend" value="1"
                                                  @if(isset($goods_service['status']) && $goods_service['status']== 1 )checked="checked" @endif>
                                        <span class="lbl"> 开启</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input class="ace" type="radio" name="is_goods_recommend" value="2"
                                                  @if(isset($goods_service['status']) && $goods_service['status']== 2 )checked="checked" @endif>
                                        <span class="lbl"> 关闭 </span></label>
                                </div>
                            </div>
                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">作品推荐配置</label>

                                <div class="col-sm-9">
                                    <input type="text" name="recommend_goods_price"
                                           @if(isset($goods_service['price']))value="{!! $goods_service['price'] !!}" @endif> 元
                                    <select name="goods_unit" id="goods_unit">
                                        <option value="4" @if(isset($shop_config['recommend_goods_unit']) && $shop_config['recommend_goods_unit']== 4 )selected="selected" @endif>年</option>
                                        <option value="3" @if(isset($shop_config['recommend_goods_unit']) && $shop_config['recommend_goods_unit']== 3 )selected="selected" @endif>六个月</option>
                                        <option value="2" @if(isset($shop_config['recommend_goods_unit']) && $shop_config['recommend_goods_unit']== 2 )selected="selected" @endif>三个月</option>
                                        <option value="1" @if(isset($shop_config['recommend_goods_unit']) && $shop_config['recommend_goods_unit']== 1 )selected="selected" @endif>月</option>
                                        <option value="0" @if(isset($shop_config['recommend_goods_unit']) && $shop_config['recommend_goods_unit']== 0 )selected="selected" @endif>天</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">服务推荐</label>

                                <div class="col-sm-9">
                                    <label><input class="ace" type="radio" name="is_service_recommend" value="1"
                                                  @if(isset($service['status']) && $service['status']== 1 )checked="checked" @endif>
                                        <span class="lbl"> 开启</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input class="ace" type="radio" name="is_service_recommend" value="2"
                                                  @if(isset($service['status']) && $service['status']== 2 )checked="checked" @endif>
                                        <span class="lbl"> 关闭 </span></label>
                                </div>
                            </div>
                            <div class=" interface-bottom col-xs-12">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 服务推荐配置</label>

                                <div class="col-sm-9">
                                    <input type="text" name="recommend_service_price"
                                           @if(isset($service['price']))value="{!! $service['price'] !!}" @endif> 元
                                    <select name="service_unit" id="service_unit">
                                        <option value="4" @if(isset($shop_config['recommend_service_unit']) && $shop_config['recommend_service_unit']== 4 )selected="selected" @endif>年</option>
                                        <option value="3" @if(isset($shop_config['recommend_service_unit']) && $shop_config['recommend_service_unit']== 3 )selected="selected" @endif>六个月</option>
                                        <option value="2" @if(isset($shop_config['recommend_service_unit']) && $shop_config['recommend_service_unit']== 2 )selected="selected" @endif>三个月</option>
                                        <option value="1" @if(isset($shop_config['recommend_service_unit']) && $shop_config['recommend_service_unit']== 1 )selected="selected" @endif>月</option>
                                        <option value="0" @if(isset($shop_config['recommend_service_unit']) && $shop_config['recommend_service_unit']== 0 )selected="selected" @endif>天</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="clearfix row bg-backf5 padding20 mg-margin12">
                                    <div class="col-xs-12">
                                        <div class="col-sm-1 text-right"></div>
                                        <div  class="col-sm-10">
                                            <button class="btn btn-info" type="submit" >
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                提交
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
{!! Theme::widget('editor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}