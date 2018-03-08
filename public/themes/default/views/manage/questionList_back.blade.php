{{--列表--}}
{{--<h3 class="header smaller lighter blue mg-bottom20 mg-top12">问答管理</h3>

<div class="well">
    <form class="form-inline search-group" role="form" action="http://kppw31.io/manage/userFinance" method="get">
        <div class="form-group search-list width285">
            <label for="name" class="">提问人　</label>
            <input type="text" name="uid" value="">
        </div>
        <div class="form-group search-list width285">
            <label for="namee" class="">提问类型　</label>
            <select>
                <option value="">发布时间</option>
            </select>
            <select name="" id="">
                <option>发布时间</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">搜索</button>
        </div>
        <div class="space"></div>
        <div class="form-group search-list width285">
            <label for="namee" class="">状态　　</label>
            <input type="text" name="username" value="">
        </div>
        <div class="form-group  ">
            <select class="">
                <option value="">发布时间</option>
            </select>
            <div class="input-daterange input-group">
                <input type="text" name="start" class="input-sm form-control" value="">
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                <input type="text" name="end" class="input-sm form-control" value="">
            </div>
        </div>
        <div class="">

        </div>
    </form>
</div>

<div class="table-responsive">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>

            </th>
            <th>
                <label>
                    编号
                </label>
            </th>
            <th>提问人</th>
            <th>提问类型</th>

            <th>
                发布时间
            </th>
            <th>审核时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td class="center">
                <label class="">
                    <input type="checkbox" class="ace" name="chk">
                    <span class="lbl"></span>
                </label>
            </td>
            <td>
                    8039
            </td>

            <td>
                发布任务            </td>
            <td>kekezu123</td>
            <td>￥100.00元</td>

            <td>
                ￥1100992.37元
            </td>

            <td>

                    <span class="label label-sm label-warning">待审核</span>

                    <span class="label label-sm label-success">已认证</span>

                    <span class="label label-sm label-danger">认证失败</span>

            </td>
            <td>

                    <a class="btn btn-xs btn-success" href="">
                        <i class="ace-icon fa fa-check bigger-120"></i>审核成功
                    </a>

                    <a class="btn btn-xs btn-danger" href="">
                        <i class="ace-icon fa fa-ban bigger-120"></i>审核失败
                    </a>

                <a class="btn btn-xs btn-warning" href="">
                    <i class="ace-icon fa fa-search bigger-120"></i>查看
                </a>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_bootstrap row">
            <ul class="pagination"><li class="disabled"><span>«</span></li> <li class="active"><span>1</span></li><li><a href="http://kppw31.io/manage/userFinance?page=2">2</a></li><li><a href="http://kppw31.io/manage/userFinance?page=3">3</a></li><li><a href="http://kppw31.io/manage/userFinance?page=4">4</a></li><li><a href="http://kppw31.io/manage/userFinance?page=5">5</a></li><li><a href="http://kppw31.io/manage/userFinance?page=6">6</a></li><li><a href="http://kppw31.io/manage/userFinance?page=7">7</a></li><li><a href="http://kppw31.io/manage/userFinance?page=8">8</a></li><li class="disabled"><span>...</span></li><li><a href="http://kppw31.io/manage/userFinance?page=801">801</a></li><li><a href="http://kppw31.io/manage/userFinance?page=802">802</a></li> <li><a href="http://kppw31.io/manage/userFinance?page=2" rel="next">»</a></li></ul>
        </div>
    </div>
</div>--}}
{{--提问--}}
{{--<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="/advertisement/recommendList">提问</a>
            </li>
            <li class="">
                <a href="/advertisement/serverList">回答</a>
            </li>
        </ul>
    </div>
</div>
<form class="form-horizontal" method="post" action="/manage/editArticle" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="HJ2MqkduEVb9rnGOI15zb0ECcDyJRo998ouAIWiM">
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">提问人</label>
            <label class="text-left col-sm-9">
                coolxhcn
            </label>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">问题类型</label>
            <label class="text-left col-sm-9">
                <select name="catID">
                    <option value="3">页脚配置</option>
                </select>
            </label>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">文章内容</label>
            <div class="text-left col-sm-8">
                <!--编辑器-->
                <div class="clearfix">
                    <script id="editor" name="content" type="text/plain"></script>
                    --}}{{--<div class="wysiwyg-editor" id="editor1">{!! htmlspecialchars_decode($article['content']) !!}</div>
                    <textarea name="content" id="content" style="display: none">{!! htmlspecialchars_decode($article['content']) !!}</textarea>--}}{{--
                </div>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">发布时间</label>
            <label class="text-left col-sm-9">
                2016-01-01      11:11：11
            </label>
        </div>
        <div class="interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">状态</label>
            <label class="text-left col-sm-9">
                待审核
            </label>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary">保存</button>
                        <button type="submit" class="btn btn-sm btn-success">审核成功</button>
                        <button type="submit" class="btn btn-sm btn-danger">审核失败</button>
                    </div>
                </div>i
            </div>
        </div>
        <div class="space col-xs-12"></div>
        <div class="col-xs-12 ">
            <div class="col-sm-1 text-right"></div>
            <div class="col-md-10">
                <a href="/manage/reportList">上一页</a>
                &nbsp;&nbsp;&nbsp;&nbsp;　
                <a href="/manage/reportList">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;　　
                <a href="http://kppw31.io/manage/reportDetail/15">下一项</a>
            </div>
        </div>
    </div>
</form>--}}
{{--回答--}}
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="">
                <a href="/advertisement/recommendList">提问</a>
            </li>
            <li class="active">
                <a href="/advertisement/serverList">回答</a>
            </li>
        </ul>
    </div>
</div>
<form class="form-horizontal" method="post" action="/manage/editArticle" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="HJ2MqkduEVb9rnGOI15zb0ECcDyJRo998ouAIWiM">
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <div>
                <label class="">admin  &nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="">
                    回答&nbsp;
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="">
                    采纳&nbsp;
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="">
                    打赏：￥41.00&nbsp;
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="">
                    回答时间：2016-02-02
                </label>
            </div>
            <div class="space-6"></div>
            <div>
                1111
            </div>
        </div>
    </div>
</form>
{{--问答配置--}}
{{--<h3 class="header smaller lighter blue mg-bottom20 mg-top12">问答配置</h3>
<form class="form-horizontal" action="/manage/postShopConfig" method="post" name="shopConfig">
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">是否开启问答功能</label>

            <div class="col-sm-9">
                <label>
                    <input class="ace" type="radio" name="goods_check" value="1" checked="checked">
                    <span class="lbl"> 开启</span>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                    <input class="ace" type="radio" name="goods_check" value="2">
                    <span class="lbl"> 不开启 </span>
                </label>
            </div>
        </div>
        <div class=" interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1" rows="2">是否开启审核</label>

            <div class="col-sm-9">
                <label><input class="ace" type="radio" name="service_check" value="1" checked="checked">
                    <span class="lbl"> 开启</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label><input class="ace" type="radio" name="service_check" value="2">
                    <span class="lbl"> 不开启 </span></label>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10">
                        <button class="btn btn-info" type="submit">
                            保存
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>--}}


{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}