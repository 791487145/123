{{--列表--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">签到奖品  {!! date('Y-m-d',strtotime($sign['start_time'])) !!} -- {!! date('Y-m-d',strtotime($sign['end_time'])) !!}({!! $sign['winning_days'] !!})</h3>
<div class="well">
    <form class="form-inline search-group" role="form" action="{{ URL('manage/signPrize') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input type="hidden" name="sign_id" value="{{ $sign['id'] }}"/>
        <div class="form-group search-list">
            <label for="namee" class="">中奖天数</label>
            <input type="text" name="date" value="" required="required">
        </div>
        <div class="form-group search-list ">
            <label for="name" class="">奖品</label>
            <select name="goods_id" >
                <option value="">请选择</option>
                @foreach($sjlm_goods as $v)
                    <option value="{{ $v['id'] }}" >{{ $v['name'] }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">添加</button>
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
            <th>奖品名称</th>
            <th>奖品图片</th>
            <th>签到次数(中奖天数)</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
            @if(!empty($sign_prize))
            @foreach($sign_prize as $k=>$item)
                <tr>
                    <td>{!! $k+1 !!}</td>
                    <td>{!! $item['name'] !!}</td>
                    <td><img src="/{!! $item['icon'] !!}" style="height:30px;"> </td>
                    <td>{!! $item['date'] !!}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="{{ URL('manage/prizeDetail/'.$item['id']) }}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                        <a  href="{{ URL('manage/signDel/'.$item['id']) }}" title="删除" class="btn btn-xs btn-danger">
                            <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
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
           {!! $sign_prize->render() !!}
        </ul>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('questionlist', 'js/doc/questionlist.js') !!}