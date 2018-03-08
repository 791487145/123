<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li>
                <a href="/manage/config/site">站点配置</a>
            </li>
            <li>
                <a href="/manage/config/link">关注链接</a>
            </li>

           {{-- <li>
                <a href="/manage/config/basic">基本配置</a>
            </li>--}}

            <li class="active">
                <a href="/manage/config/seo">SEO配置</a>
            </li>
            <li>
                <a href="/manage/config/email">邮箱配置</a>
            </li>
        </ul>
    </div>
</div>

                <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="/manage/config/seo">
                    {!! csrf_field() !!}
                    <!-- #section:elements.form -->
                    {{--<div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 是否开启伪静态： </label>

                        <div class="col-sm-1">
                            <label><input class="ace" type="radio" name="pseudo_static" value="2" @if(isset($seo['seo_pseudo_static']) && $seo['seo_pseudo_static'] == 2)checked="checked"@endif><span class="lbl"> 关闭 </span></label>
                            <label><input class="ace" type="radio" name="pseudo_static" value="1" @if(isset($seo['seo_pseudo_static']) && $seo['seo_pseudo_static'] == 1)checked="checked"@endif><span class="lbl"> 开启</span></label>
                        </div>
                        <div class="col-sm-5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 伪静态生效必须依赖服务器的支持.. 请先完成服务器配置再开启本开关 查看<a href="" class="text-size16">伪静态配置说明</a></div>
                    </div>
                    <div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 是否开启二级域名： </label>

                        <div class="col-sm-1">
                            <label><input class="ace" type="radio" name="secondary_domain" value="2" @if(isset($seo['seo_secondary_domain']) && $seo['seo_secondary_domain'] == 2)checked="checked" @endif><span class="lbl"> 关闭 </span></label>
                            <label><input class="ace" type="radio" name="secondary_domain"  value="1" @if(isset($seo['seo_secondary_domain']) && $seo['seo_secondary_domain'] == 1)checked="checked"@endif><span class="lbl"> 开启</span></label>
                        </div>
                        <div class="col-sm-5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (若需要支持二级域名，请先配置DNS，开启泛解析，将各域名指向同一IP)</div>
                    </div>--}}
                    <div class="g-backrealdetails clearfix bor-border interface">
                    <div class="space-8 col-xs-12"></div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 首页SEO标题： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="homepage_seo_title" @if(isset($seo['seo_index']['title']))value="{{$seo['seo_index']['title']}}"@endif/>
                        </div>
                        <div class="col-sm-4 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 网页标题通常是搜索引擎关注的重点，本附加字设置将出现在标题中网站名称的后面，如果有多个关键字，建议用 "|"、","(不含引号) 等符号分隔</div>
                    </div>

                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 首页SEO关键词： </label>

                        <div class="col-sm-4">
                            <textarea class="col-xs-10 col-sm-12"  name="homepage_seo_keywords">@if(isset($seo['seo_index']['keywords'])){{$seo['seo_index']['keywords']}}@endif</textarea>
                        </div>
                        <div class="col-sm-4 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> Keywords 项出现在页面头部的 Meta 标签中，用于记录本页面的关键字，多个关键字间请用半角逗号 "," 隔开</div>
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 首页SEO描述： </label>

                        <div class="col-sm-4">
                            <textarea class="col-xs-10 col-sm-12" name="homepage_seo_desc">@if(isset($seo['seo_index']['description'])){{$seo['seo_index']['description']}}@endif</textarea>
                        </div>
                        <div class="col-sm-4 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> Description 出现在页面头部的 Meta 标签中，用于记录本页面的概要与描述</div>
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 任务大厅SEO标题： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-12"  name="task_seo_title" @if(isset($seo['seo_task']['title']))value="{{$seo['seo_task']['title']}}"@endif/>
                        </div>
                        {{--<div class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (可用变量) {地区}{行业}{子行业}{任务模式}{赏金状态}{任务状态}</div>--}}
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 任务大厅SEO关键词： </label>

                        <div class="col-sm-4">
                            <textarea class="col-xs-10 col-sm-12"  name="task_seo_keywords"> @if(isset($seo['seo_task']['keywords'])){{$seo['seo_task']['keywords']}}@endif</textarea>
                        </div>
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 任务大厅SEO描述： </label>

                        <div class="col-sm-4">
                            <textarea class="col-xs-10 col-sm-12" name="task_seo_desc"> @if(isset($seo['seo_task']['description'])){{$seo['seo_task']['description']}}@endif</textarea>
                        </div>
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 服务商列表SEO标题： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-12"  name="service_seo_title" @if(isset($seo['seo_service']['title']))value="{{$seo['seo_service']['title']}}"@endif/>
                        </div>
                        {{--<div class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (可用变量) {地区}{店铺类型}{行业}{子行业}</div>--}}
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 服务商列表SEO关键词： </label>

                        <div class="col-sm-4">
                            <textarea class="col-xs-10 col-sm-12" name="service_seo_keywords">@if(isset($seo['seo_service']['keywords'])){{$seo['seo_service']['keywords']}}@endif</textarea>
                        </div>
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 服务商列表SEO描述： </label>

                        <div class="col-sm-4">
                            <textarea class="col-xs-10 col-sm-12" name="service_seo_desc">@if(isset($seo['seo_service']['description'])){{$seo['seo_service']['description']}}@endif</textarea>
                        </div>
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 资讯中心SEO标题： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-12"  name="article_seo_title" @if(isset($seo['seo_article']['title']))value="{{$seo['seo_article']['title']}}"@endif/>
                        </div>
                        {{--<div class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (可用变量){资讯分类}</div>--}}
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 资讯中心SEO关键词： </label>

                        <div class="col-sm-4">
                            <textarea class="col-xs-10 col-sm-12" name="article_seo_keywords">@if(isset($seo['seo_article']['keywords'])){{$seo['seo_article']['keywords']}}@endif</textarea>
                        </div>
                    </div>
                    <div class="interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 资讯中心SEO描述： </label>

                        <div class="col-sm-4">
                            <textarea class="col-xs-10 col-sm-12" name="article_seo_desc">@if(isset($seo['seo_article']['description'])){{$seo['seo_article']['description']}}@endif</textarea>
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
                    {{--<div class="space-10"></div>
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <div class="row">
                                <button class="btn btn-info btn-sm" type="submit">
                                    提交
                                </button>
                            </div>
                        </div>
                    </div>--}}
                        </div>
                </form>

    <div id="modal-form" class="modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">Please fill the following form fields</h4>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-5">
                                        <div class="space"></div>

                                        <input type="file" />
                                    </div>

                                    <div class="col-xs-12 col-sm-7">
                                        <div class="form-group">
                                            <label for="form-field-select-3">Location</label>

                                            <div>
                                                <select class="chosen-select" data-placeholder="Choose a Country...">
                                                    <option value="">&nbsp;</option>
                                                    <option value="AL">Alabama</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="AZ">Arizona</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WA">Washington</option>
                                                    <option value="WV">West Virginia</option>
                                                    <option value="WI">Wisconsin</option>
                                                    <option value="WY">Wyoming</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="space-4"></div>

                                        <div class="form-group">
                                            <label for="form-field-username">Username</label>

                                            <div>
                                                <input class="input-large" type="text" id="form-field-username" placeholder="Username" value="alexdoe" />
                                            </div>
                                        </div>

                                        <div class="space-4"></div>

                                        <div class="form-group">
                                            <label for="form-field-first">Name</label>

                                            <div>
                                                <input class="input-medium" type="text" id="form-field-first" placeholder="First Name" value="Alex" />
                                                <input class="input-medium" type="text" id="form-field-last" placeholder="Last Name" value="Doe" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-sm" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Cancel
                                </button>

                                <button class="btn btn-sm btn-primary">
                                    <i class="ace-icon fa fa-check"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- PAGE CONTENT ENDS -->

{!! Theme::asset()->container('specific-js')->usepath()->add('datepicker', 'plugins/ace/css/bootstrap-datetimepicker/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('jquery.webui-popover', '/plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--上传图片--}}
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('touch-punch', 'plugins/ace/js/jquery.ui.touch-punch.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('autosize', 'plugins/ace/js/jquery.autosize.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('inputlimiter', 'plugins/ace/js/jquery.inputlimiter.1.3.1.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('maskedinput', 'plugins/ace/js/jquery.maskedinput.min.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('dataTab', 'plugins/ace/js/dataTab.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_dataTables', 'plugins/ace/js/jquery.dataTables.bootstrap.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('configbasic', 'js/doc/configbasic.js') !!}