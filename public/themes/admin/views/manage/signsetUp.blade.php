{{--列表--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">签到</h3>

<div class="well">
    <form class="form-inline search-group" role="form" action="{{ URL('manage/sign') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group search-list">
            <label for="">签到周期 </label>
            <div class="input-daterange input-group">
                <input type="text" name="start_time" class="input-sm form-control" required="required">
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                <input type="text" name="end_time" class="input-sm form-control" required="required">
            </div>
        </div>

        <div class="form-group search-list ">
            <label for="">中奖天数（以英文,隔开）</label>
            <input type="text" name="winning_days" style="width:200px" required="required">

        </div>
        
        <div class="space"></div>
        <div class="form-group search-list">
            <label for="">每次签到活跃值</label>
            <input type="text" name="active_value" required="required">
        </div>
        <div class="form-group search-list">
            <label for="">每次签到金币</label>
            <input type="text" name="gold"  required="required">
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">生成</button>
        </div>
        <div class="space"></div>
       
        <div class="">
    
        </div>
    </form>
    
</div>


<div class="table-responsive">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>
                <label>
                    编号
                </label>
            </th>
            <th>签到周期</th>
            <th>中奖天数</th>
            <th>每次签到活跃值</th>
            <th>每次签到金币</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
            @if(!empty($sign))
            @foreach($sign as $item)
                <tr>
                    <td>{!! $item['id'] !!}</td>
                    <td>{!! date('Y-m-d',strtotime($item['start_time'])) !!} -- {!! date('Y-m-d',strtotime($item['end_time'])) !!}</td>
                    <td>{!! $item['winning_days'] !!}</td>
                    <td>{!! $item['active_value'] !!}</td>
                    <td>{!! $item['gold'] !!}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="signDetail/{{ $item['id'] }}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                        <a class="btn btn-xs btn-info" href="signPrize/{{ $item['id'] }}">
                            中奖物品管理
                        </a>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
<div class="col-xs-12">
    <div class="dataTables_paginate paging_bootstrap row">
        <ul class="pagination">
           {!! $sign->render() !!}
        </ul>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('questionlist', 'js/doc/questionlist.js') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}