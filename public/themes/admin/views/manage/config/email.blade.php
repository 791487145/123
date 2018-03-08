<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li>
                <a href="/manage/config/site">站点配置</a>
            </li>
            <li>
                <a href="/manage/config/link">关注链接</a>
            </li>

            {{--<li>
                <a href="/manage/config/basic">基本配置</a>
            </li>--}}

            <li>
                <a href="/manage/config/seo">SEO配置</a>
            </li>
            <li class="active">
                <a href="/manage/config/email">邮箱配置</a>
            </li>
        </ul>
    </div>
</div>
<div class="g-backrealdetails clearfix bor-border interface">

    <div class="space-8 col-xs-12"></div>
                <!-- PAGE CONTENT BEGINS -->
                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="/manage/config/email">
                    {!! csrf_field() !!}
                    <!-- #section:elements.form -->
                    {{--<div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 邮箱服务： </label>

                        <div class="col-sm-4">
                            <label><input class="ace" type="radio" name="email_service" value="1" @if($email['email_service'] == 1)checked="checked"@endif><span class="lbl"> 采用服务器内置mial服务 </span></label>
                            <label><input class="ace" type="radio" name="email_service" value="2" @if($email['email_service'] == 2)checked="checked"@endif><span class="lbl"> 采用其他的smtp服务 </span></label>
                        </div>
                    </div>
                    <div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 启用加密连接(SSL)： </label>

                        <div class="col-sm-4">
                            <label><input class="ace" type="radio" name="enable_encrypted_connection" value="2" @if($email['enable_encrypted_connection'] == 2)checked="checked"@endif><span class="lbl"> 否 </span></label>
                            <label><input class="ace" type="radio" name="enable_encrypted_connection" value="1" @if($email['enable_encrypted_connection'] == 1)checked="checked"@endif><span class="lbl"> 是 </span></label>
                        </div>
                    </div>--}}
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 发送邮件服务器： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="send_mail_server" value="{{$email['send_mail_server']}}"/>
                        </div>
                        <div class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (邮件服务器主机地址,如果本机发送则为localhost)</div>
                    </div>

                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 服务器端口： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="server_port" value="{{$email['server_port']}}"/>
                        </div>
                        <div class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (默认端口为：25)</div>
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 发送邮件账号： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="email_account" value="{{$email['email_account']}}"/>
                        </div>
                        <div class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (发送邮件所需账号,必须设置)</div>
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 账号密码： </label>

                        <div class="col-sm-4">
                            <input type="password" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="account_password" value="{{$email['account_password']}}"/>
                        </div>
                        <div class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (发送邮件所需账号的密码,必须设置)</div>

                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 邮件回复地址： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="reply_email_address" value="{{$email['reply_email_address']}}"/>
                        </div>
                    </div>
                    <div class="form-group interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 邮件回复名称： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="reply_email_name" value="{{$email['reply_email_name']}}"/>
                        </div>
                        <div class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> (邮件回复名称,必须设置)</div>

                    </div>
                    <div class="interface-bottom col-xs-12">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 测试邮件地址： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="test_email_address" value="{{$email['test_email_address']}}"/>
                            <a href="javascript:;" class="send_email">发送测试邮件</a>
                        </div>
                    </div>
                    {{--<div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 邮件编码： </label>

                        <div class="col-sm-4">
                            <label><input class="ace" type="radio" name="mail_code" value="1" @if($email['mail_code'] == 1)checked="checked"@endif><span class="lbl"> 国际化编码(utf-8) </span></label>
                            <label><input class="ace" type="radio" name="mail_code" value="2" @if($email['mail_code'] == 2)checked="checked"@endif><span class="lbl"> 简体中文 </span></label>
                        </div>
                    </div>
                    <div class="form-group basic-form-bottom">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 邮箱地址： </label>

                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="email_address" value="{{$email['email_address']}}"/>
                        </div>
                        <div class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 将显示在页面底部的版权信息处</div>
                    </div>--}}
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

                    {{--<div class="space-24"></div>--}}
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


{{--{!! Theme::asset()->container('custom-js')->usepath()->add('dataTab', 'plugins/ace/js/dataTab.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_dataTables', 'plugins/ace/js/jquery.dataTables.bootstrap.js') !!}--}}

{!! Theme::asset()->container('custom-js')->usepath()->add('configemail', 'js/doc/configemail.js') !!}
