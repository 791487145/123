<div class="row">
    <div class="col-xs-12 widget-container-col ui-sortable">
        <div class="widget-box transparent ui-sortable-handle">
            <div class="widget-header">
                <h3 class="widget-title lighter"> 流程配置</h3>
            </div>

            <div class="widget-body">

                <div class="widget-main padding-12 no-padding-left no-padding-right">
                    <form action="/manage/bidConfigUpdate" method="post">
					    {{csrf_field()}}
                        <input type="hidden" name="change_ids" value="{{$id}}" id="change-ids">
                        <div class="col-sm-12">
							<div class="widget-box">
								<div class="widget-header widget-header-flat">
									<h5 class="widget-title">任务佣金策略：任务规则设置和异常任务资金分配</h5>
								</div>
                                <div class="widget-body">
                                    <div class="widget-main row paddingTop">
                                        <div class="table-responsive">
                                            <table class="table table-hover mg-bottom0">
                                                <tbody>
													<tr>
                                                        <td class="col-sm-2 flow-money text-right">任务审核设定：</td>
                                                        <td>
															<div style="display:inline-block;width:160px;">
																<label for="open"><input type="radio" id="open" name="bid_examine" @if($config['bid_examine']['rule'] ==1) checked="checked"@endif value="1">开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
																<label for="close"><input type="radio" id="close" name="bid_examine" @if($config['bid_examine']['rule'] ==0) checked="checked"@endif value="0">关闭</label>
															</div>
															&nbsp;（开启后发布任务后需要审核，关闭后不需要审核）</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-2 flow-money text-right">任务最大金额设定：</td>
                                                        <td> <input type="text" name="bid_bounty_limit" value="{{$config['bid_bounty_limit']['rule']}}" class="change_ids">&nbsp;&nbsp;元（设置任务最大金额,为0时不生效）</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-2 flow-money text-right">任务最小金额设定：</td>
                                                        <td> <input type="text" name="bid_bounty_min_limit" value="{{$config['bid_bounty_min_limit']['rule']}}" class="change_ids">&nbsp;&nbsp;元（设置任务最小金额不得小于0元）</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-2 flow-money text-right">任务提成比例：</td>
                                                        <td> <input type="text" name="bid_percentage" value="{{$config['bid_percentage']['rule']}}" class="change_ids">&nbsp;&nbsp;%（平台提取任务佣金的百分比，设为0即无抽佣）</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-2 flow-money text-right">任务失败返金抽成比例：</td>
                                                        <td> <input type="text" name="bid_fail_percentage" value="{{$config['bid_fail_percentage']['rule']}}" class="change_ids">&nbsp;&nbsp;%（任务失败时，抽取该比例任务金额的佣金）</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
						
						<div class="space-8 col-sm-12"></div>
						
						<div class="col-sm-12">
							<div class="widget-box">
								<div class="widget-header widget-header-flat">
									<h5 class="widget-title">任务佣金策略：任务时间规则设置</h5>
								</div>
								<div class="widget-body">
									<div class="widget-main row paddingTop">
										<div class="table-responsive">
											<table class="table table-hover mg-bottom0">
												<tbody>
													<tr>
														<td class="col-sm-2 flow-money text-right">任务交稿截止最大天数：</td>
														<td> <input type="text" name="bid_delivery_max" value="{{$config['bid_delivery_max']['rule']}}" class="change_ids">&nbsp;&nbsp;天（大于等于1的整数天）</td>
													</tr>
													<tr>
														<td class="col-sm-2 flow-money text-right">新注册用户投标时间限制：</td>
														<td> <input type="text" name="bid_new_user_registration_time_limit" value="{{$config['bid_new_user_registration_time_limit']['rule']}}" class="change_ids">&nbsp;&nbsp;小时（大于等于0的整数小时，设为0即无注册时间限制）</td>
													</tr>
													<tr>
														<td class="col-sm-2 flow-money text-right">选稿时间设置：</td>
														<td> <input type="text" name="bid_select_work" value="{{$config['bid_select_work']['rule']}}" class="change_ids">&nbsp;&nbsp;天（大于等于1的整数天）</td>
													</tr>
													<tr>
														<td class="col-sm-2 flow-money text-right">交付期最大时间限制：</td>
														<td> <input type="text" name="bid_delivery_max_time" value="{{$config['bid_delivery_max_time']['rule']}}" class="change_ids">&nbsp;&nbsp;天（逾期未完成交付，任务直接冻结交由管理员处理）</td>
													</tr>
													<tr>
														<td class="col-sm-2 flow-money text-right">验收期最大时间限制：</td>
														<td> <input type="text" name="bid_check_time_limit" value="{{$config['bid_check_time_limit']['rule']}}" class="change_ids">&nbsp;&nbsp;天（逾期未验收的，任务稿件直接通过验收阶段）</td>
													</tr>
	
												</tbody>
											</table>
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
</div><!-- /.row -->
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('taskconfig', 'js/doc/taskconfig.js') !!}

{!! Theme::asset()->container('specific-js')->usePath()->add('hotkeys', 'plugins/ace/js/jquery.hotkeys.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('bootstrap-wysiwyg', 'plugins/ace/js/bootstrap-wysiwyg.min.js') !!}