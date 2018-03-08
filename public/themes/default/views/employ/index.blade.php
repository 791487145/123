<div class="col-xs-12">
    <div class="row">
        <div class="needs">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 col-left">
                <div class="">
                    <div class="needs-section">
                        <h4>您将雇佣  联合创意文化</h4>
                        <div class="needs-section-module">
                            <div class="needs-section-wwrap1">
                                <p>一句话说明TA需要干什么：</p>
                                <input type="text" class="form-control needs-input"/>
                            </div>
                            <div class="needs-section-wwrap2">
                                <p>详细描述下您的需求：</p>
                                <!--编辑器-->
                                <div class="clearfix needs-section-editor">
                                    {{--<div class="wysiwyg-editor" id="editor1"></div>--}}
                                    <script id="editor" type="text/plain" style="width:850;height:300px;"></script>
                                </div>

                                <div class="annex needs-section-annex">
                                    <!--文件上传-->
                                    <div action=" " class="dropzone clearfix" id="dropzone">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="needs-section-wwrap3">
                                <p>填写联系方式：</p>
                                <input type="text" class="form-control needs-input"/>
                            </div>
                            <div class="needs-section-wwrap4">
                                <p>您的预算：</p>
                                <form class="form-inline">
                                    <div class="form-group">
                                        <input type="text" class="form-control wwrap4-input" id="exampleInputName2" placeholder="">
                                        <label for="exampleInputName2">元</label>
                                    </div>
                                </form>
                            </div>
                            <div class="needs-section-wwrap5">
                                <p>雇佣截止日期：</p>
                                <div class="input-group wwrap5-input">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                    <input class="form-control date-picker" type="text" name="date-range-picker" id="date-timepicker1" placeholder="截止时间"/>
                                </div>
                            </div>
                            <input type="submit" value="下一步" class="btn btn-primary bor-radius2 needs-btn1"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 hidden-xs hidden-md hidden-sm col-left">
                <div class="needs-sidebar">
                    <h4 class="text-center">被雇佣服务商信息</h4>
                    <div class="needs-sidebar-wrap">
                        <div class="wrap1">
                            <img src="{{ Theme::asset()->url('images/employ/bg1.jpg') }}" alt=""/>
                        </div>
                        <div class="wrap2">
                            <p class="tit">联合创意文化传播</p>
                            <p class="beyond clearfix beyond-a">
                                <span>认证：</span><a href="" class="ico1 u-ico1"></a><a href="" class="ico2"></a><a href="" class="ico3 u-ico3"></a><a href="" class="ico4 "></a>
                            </p>
                            <p class="beyond">
                                <span>地区：</span>湖北省武汉市
                            </p>
                            <p class="beyond beyond-s">
                                <span>标签：</span>
                                <a href="">VI设计</a>
                                <a href="">VI设计</a>
                                <a href="">VI设计</a>
                            </p>
                        </div>
                        <div class="wrap3">
                            <ul class="list-inline">
                                <li>
                                    <p class="text-center">好评数</p>
                                    <p class="text-center text-color">92</p>
                                </li>
                                <li>
                                    <p class="text-center">综合评分</p>
                                    <p class="text-center text-color">92</p>
                                </li>
                                <li>
                                    <p class="text-center">
                                        月雇佣
                                    </p>
                                    <p class="text-center text-color">92</p>
                                </li>
                            </ul>
                        </div>
                        <div class="wrap4 employworkico" >
                            <a href="" class="ico1 icogz"><i></i>联系TA</a>
                            <a href="" class="ico2"><i></i>进入空间</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Theme::widget('fileUpload')->render() !!}
{!! Theme::widget('ueditor')->render() !!}





