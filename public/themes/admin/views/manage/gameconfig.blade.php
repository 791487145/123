<div class="row">
    <div class="col-xs-12 widget-container-col ui-sortable">
        <div class="widget-box transparent ui-sortable-handle">
            <div class="widget-header">
                <h3 class="widget-title lighter"> 流程配置</h3>
            </div>

            <div class="widget-body">

                <div class="widget-main padding-12 no-padding-left no-padding-right">
                    <div class="tab-content padding-4">
                        <div id="basic" class="tab-pane active row">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat">
                                            <h5 class="widget-title">基本配置</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="/manage/game/groupInitialize" method="post">
                        <div id="flow" class="tab-pane active row">
                                {{ csrf_field() }}
                                <div class="col-sm-8 flow-task">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat">
                                            <h5 class="widget-title">个人比赛基本配置</h5>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main row paddingTop">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mg-bottom0">
                                                        <tbody>
                                                        <tr>
                                                            <td class="col-sm-3 flow-money text-right">个人组数：</td>
                                                            <td> <input type="text" name="single_num" value="{{$user_game_settings['single']['num']}}" class="change_ids">组 </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div id="flow" class="tab-pane active row">
                                <div class="col-sm-8 flow-task">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat">
                                            <h5 class="widget-title">团队比赛基本配置</h5>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main row paddingTop">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mg-bottom0">
                                                        <tbody>
                                                        <tr>
                                                            <td class="col-sm-3 flow-money text-right">团队组数：</td>
                                                            <td> <input type="text" name="couple_num" value="{{$user_game_settings['single']['num']}}" class="change_ids"> 组</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="text-center col-sm-12">
                        <br>
                        <button class="btn btn-primary btn-sm">保存</button>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div><!-- /.row -->
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('taskconfig', 'js/doc/taskconfig.js') !!}

{!! Theme::asset()->container('specific-js')->usePath()->add('hotkeys', 'plugins/ace/js/jquery.hotkeys.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('bootstrap-wysiwyg', 'plugins/ace/js/bootstrap-wysiwyg.min.js') !!}