
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">查看</h3>

<form class="form-horizontal" method="post" action="/manage/endTimeUpdate" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <input type="hidden" value="{{$vipShopInfo['id']}}" name="id" />
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">用户名</label>
            <label class="text-left col-sm-9">{{$vipShopInfo['username']}}</label>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">店铺名</label>
            <label class="text-left col-sm-2">{{$vipShopInfo['shop_name']}}</label>
            <label class="col-sm-1 text-right">电话</label>
            <label class="text-left col-sm-1">@if($vipShopInfo['mobile']) {{$vipShopInfo['mobile']}} @else 暂无 @endif</label>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">购买套餐</label>
            <label class="text-left col-sm-2">{{$vipShopInfo['package_name']}}</label>
            <label class="col-sm-1 text-right">购买时限</label>
            <label class="text-left col-sm-1">{{$vipShopInfo['duration']}}月</label>
            <label class="col-sm-1 text-right">金额</label>
            <label class="text-left col-sm-1">{{$vipShopInfo['price']}}元</label>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">购买时间</label>
            <label class="text-left col-sm-2">
                {{$vipShopInfo['start_time']}}
            </label>
            <label class="col-sm-1 control-label text-right">到期时间</label>
            <label class="text-left col-sm-1">
                <input type="text" id="datepicker" class="form-control hasDatepicker" value="{{$vipShopInfo['end_time']}}" name="end_time"></label>
            <label class="col-sm-1 text-right">状态</label>
            <label class="text-left col-sm-1">@if($vipShopInfo['status']) 已过期 @else 生效中 @endif</label>
        </div>
        <div class="interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">特权内容</label>
            <label class="text-left col-sm-9">
                @if(!empty($vipShopInfo['privileges']))
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>功能名</th>
                        <th>功能介绍</th>
                        @if(count($vipShopInfo['privileges']) >= 2)
                        <th>功能名</th>
                        <th>功能介绍</th>
                        @endif
                    </tr>
                    </thead>

                    <tbody>

                    <tr>
                        @foreach($vipShopInfo['privileges'] as $pk=>$pv)
                            @if($pk%2 == 0)
                            </tr>
                            <tr>
                            @endif
                            <td>{{$pv['title']}}</td>
                            <td>{{$pv['desc']}}</td>
                        @endforeach
                        {{--<td>{{$pv['title']}}</td>
                        <td>{{$pv['desc']}}</td>--}}
                    </tr>
                    </tbody>
                </table>
                @endif
            </label>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary">保存</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{URL('/manage/vipShopList')}}">返回</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userManage-js', 'js/userManage.js') !!}
