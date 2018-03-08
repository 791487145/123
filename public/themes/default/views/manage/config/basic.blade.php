<div class="row">
    <div class="col-xs-12">
        <div class="space-10"></div>
        <!-- <div class="table-responsive"> -->
        <div class="widget-box transparent ui-sortable-handle">
            <div class="widget-header">
                <div class="widget-toolbar no-border">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="/manage/config/site">站点配置</a>
                        </li>

                        <li class="active">
                            <a href="/manage/config/basic">基本配置</a>
                        </li>

                        <li>
                            <a href="/manage/config/seo">SEO配置</a>
                        </li>
                        <li>
                            <a href="/manage/config/email">邮箱配置</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

                   <!-- <div class="dataTables_borderWrap"> -->
        <br>
        <div class="space-10"></div>
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="/manage/config/basic">
                    {!! csrf_field() !!}
                    <!-- #section:elements.form -->
                    {{--<div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 用户禁止关键字： </label>

                        <div class="col-sm-4">
                            <textarea class="col-xs-10 col-sm-12" name="user_forbid_keywords">{{$basic['user_forbid_keywords']}}</textarea>
                        </div>
                        <label class="col-sm-5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (用户名之间用~|~隔开，建议不要使用“*”号和“？”号)</label>
                    </div>--}}

                    {{--<div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 内容禁止关键字： </label>

                        <div class="col-sm-4">
                            <textarea class="col-xs-10 col-sm-12" name="content_forbid_keywords">{{$basic['content_forbid_keywords']}}</textarea>
                        </div>
                        <label class="col-sm-5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (关键词必须是中文或英文字符串，多个请用~|~隔开，建议不要使用“*”号和“？”号)</label>
                    </div>--}}
                    <div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> CSS自适应： </label>

                        <div class="col-sm-4">
                            <label><input class="ace" type="radio" name="css_adaptive" value="2" @if($basic['css_adaptive'] == 2)checked="checked"@endif><span class="lbl"> 关闭 </span></label>
                            <label><input class="ace" type="radio" name="css_adaptive" value="1" @if($basic['css_adaptive'] == 1)checked="checked"@endif><span class="lbl"> 开启</span></label>
                        </div>
                    </div>
                    <div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 开启IM： </label>

                        <div class="col-sm-4">
                            <label><input class="ace" type="radio" name="open_IM" value="2" @if($basic['open_IM'] == 2)checked="checked"@endif><span class="lbl"> 关闭 </span></label>
                            <label><input class="ace" type="radio" name="open_IM" value="1" @if($basic['open_IM'] == 1)checked="checked"@endif><span class="lbl"> 开启</span></label>
                        </div>
                        <label class="col-sm-5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (此功能需单独购买IM工具，否则无效 )</label>
                    </div>
                    <div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 客服QQ： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="customer_service_qq" value="{{$basic['qq']}}"/>
                        </div>
                    </div>

                    {{--<div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 新用户注册时间限制： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="new_user_registration_time_limit" value="{{$basic['new_user_registration_time_limit']}}"/>
                        </div>
                        <label class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (时间为分钟)</label>
                    </div>
                    <div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 用户注册邮件激活： </label>

                        <div class="col-sm-4">
                            <label><input class="ace" type="radio" name="user_registration_email_activation" value="2" @if($basic['user_registration_email_activation'] == 2)checked="checked"@endif><span class="lbl"> 关闭 </span></label>
                            <label><input class="ace" type="radio" name="user_registration_email_activation" value="1" @if($basic['user_registration_email_activation'] == 1)checked="checked"@endif><span class="lbl"> 开启</span></label>
                        </div>
                    </div>--}}
                    <div class="space-10"></div>
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <div class="row">
                                <button class="btn btn-info btn-sm" type="submit">
                                    提交
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="space-24"></div>
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
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div><!-- /.row -->

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