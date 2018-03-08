<div class="col-xs-12 col-left">
    @if(empty($pay_type) && $user_type == 2)
        <div class="taskDetails taskbg clearfix taskSuccess">
            <div class="taskSuccess-left col-lg-4 col-md-3 col-sm-2 hidden-xs text-right">
                <img src="{{ Theme::asset()->url('images/success-right.png') }}" alt="">
            </div>
            <div class="taskSuccess-left hidden-lg hidden-sm hidden-md visible-xs-12 text-center">
                <img src="{{ Theme::asset()->url('images/success-right.png') }}" alt="">
            </div>
            <div class="taskSuccess-right col-lg-8 col-md-9 col-sm-10 col-xs-12">
                <h4 class="text-size24">请先等待雇主确认付款方式！</h4>
                <p class="">如果任务长时间未确认付款方式，请立即联系管理员</p>
                <p><a href="/task/{{$task['id']}}">返回</a></p>
            </div>
        </div>
    @elseif(!empty($pay_type) && $pay_type['status'] == 2 && $user_type == 2)
        <div class="taskDetails taskbg clearfix taskSuccess">
            <div class="taskSuccess-left col-lg-4 col-md-3 col-sm-2 hidden-xs text-right">
                <img src="{{ Theme::asset()->url('images/sign-icon3.png') }}" alt="">
            </div>
            <div class="taskSuccess-left hidden-lg hidden-sm hidden-md visible-xs-12 text-center">
                <img src="{{ Theme::asset()->url('images/sign-icon3.png') }}" alt="">
            </div>
            <div class="taskSuccess-right col-lg-8 col-md-9 col-sm-10 col-xs-12">
                <h4 class="text-size24">您已经拒绝雇主提出的付款方式,请等待雇主再次确认付款方式！</h4>
                <p class="">如果任务长时间未确认付款方式，请立即联系管理员</p>
                <p><a href="/task/{{$task['id']}}">返回</a></p>
            </div>
        </div>
    @else
    <form method="post" action="/task/postPayType">
        {{csrf_field()}}
        <div class="taskDetails alert taskbg clearfix">
            <div class="page-header">
                <h4 class="text-size22 cor-gray51">
                    <strong>设置付款方式</strong>
                </h4>
            </div>
            <div class="cor-gray51 text-size14">
                <div class="space"></div>
                <p>任务金额：
                    <span class="text-size26 cor-orange text-blod">
                        ￥ {{$task['bounty']}}
                    </span>
                </p>
                <input type="hidden" name="task_id" value="{{$task['id']}}">
                <div class="space"></div>
                <p>
                    @if(!empty($pay_type))
                        <span>支付方式 :</span>
                        @if($pay_type['pay_type'] == 1)一次性支付
                        @elseif($pay_type['pay_type'] == 2)50:50
                        @elseif($pay_type['pay_type'] == 3)50:30:20
                        @elseif($pay_type['pay_type'] == 4)
                            {{$pay_type['pay_type_append']}}
                        @endif
                    @else
                    <select class="form-control" id="pay_type" name="pay_type"
                            onchange="changePayType(this)" datatype="*" nullmsg="请选择支付方式"
                            errormsg="请选择支付方式" style="width:30%;">
                        <option value="1" @if(!empty($pay_type) && $pay_type['pay_type'] == 1)selected="selected"@endif>一次性支付</option>
                        <option value="2" @if(!empty($pay_type) && $pay_type['pay_type'] == 2)selected="selected"@endif>50:50</option>
                        <option value="3" @if(!empty($pay_type) && $pay_type['pay_type'] == 3)selected="selected"@endif>50:30:20</option>
                        <option value="4" @if(!empty($pay_type) && $pay_type['pay_type'] == 4)selected="selected"@endif>自定义</option>
                    </select>
                    <input type="text" id="payTypeAppend" name="pay_type_append" @if(!empty($pay_type) && $pay_type['pay_type'] == 4)value="{{$pay_type['pay_type_append']}}" style="display: block" @else style="display: none" @endif onchange="getAppendInput(this)" placeholder="请输入自定义支付比例"  >
                    @endif
                </p>
                <div class="space"></div>
                <div class="pay-section-list">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="center">交付阶段</th>
                            <th class="center">付款比例</th>
                            <th class="center">付款金额</th>
                            <th class="center">备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($pay_section as $item)
                            <tr>
                                <td class="center">
                                    第{{$item['sort']}}阶段
                                    <input class="form-control" type="hidden" name="sort[]" value="{{$item['sort']}}"/>
                                </td>
                                <td class="center">
                                    {{$item['percent']}}%
                                    <input class="form-control" type="hidden" name="percent[]" value="{{$item['percent']}}"/>
                                </td>
                                <td class="center">
                                    {{$item['price']}}
                                    <input class="form-control" type="hidden" name="price[]" value="{{$item['price']}}"/>
                                </td>
                                <td class="center" style="padding:5px;">
                                    @if(empty($pay_type))
                                    <input class="form-control" type="text" name="desc[]" value="{{$item['desc']}}" style="height:28px;padding:0;line-height:28px;" @if(!empty($item['desc'])) readonly="readonly"@endif/>
                                    @else
                                        {{$item['desc']}}
                                        <input class="form-control" type="hidden" name="desc[]" value="{{$item['desc']}}" style="height:28px;padding:0;line-height:28px;" @if(!empty($item['desc'])) readonly="readonly"@endif/>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td class="center">第1阶段
                                    <input class="form-control" type="hidden" name="sort[]" value="1"/>
                                </td>
                                <td class="center">100%
                                    <input class="form-control" type="hidden" name="percent[]" value="100"/>
                                </td>
                                <td class="center">{{$task['bounty']}}
                                    <input class="form-control" type="hidden" name="price[]" value="{{$task['bounty']}}"/></td>
                                <td class="center" style="padding:5px;">
                                    <input class="form-control" type="text" name="desc[]" style="height:28px;padding:0;line-height:28px;"/>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="space"></div>
                <div class="text-center">
                    @if($user_type == 1)
                        @if(empty($pay_type) && empty($pay_section))
                        <button class="btn btn-primary bor-radius2" type="submit">
                            确认提交
                        </button>
                        @elseif($pay_type['status'] == 2)
                            <a class="btn btn-primary bor-radius2" href="/task/payTypeAgain/{{$task['id']}}">
                                重新编辑
                            </a>
                        @endif
                    @elseif($user_type ==2)
                        @if($pay_type['status'] == 0)
                        <a class="btn btn-primary bor-radius2" href="/task/checkPayType/{{$task['id']}}/1">
                            同意
                        </a>
                        <a class="btn bor-radius2" href="/task/checkPayType/{{$task['id']}}/2">
                            不同意
                        </a>
                        @endif
                    @endif
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/task/{{$task['id']}}">返回</a>
                </div>
            </div>
            <div class="space"></div>
            
        </div>
    </form>
    @endif
</div>
{!! Theme::widget('popup')->render() !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('taskpaytype-js','js/doc/taskpaytype.js') !!}
