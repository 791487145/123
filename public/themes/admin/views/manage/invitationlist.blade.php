

<div class="table-responsive">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>
                <label>
                    编号
                </label>
            </th>
            <th>邀请码</th>
            <th>状态</th>
        </tr>
        </thead>

        <tbody>
        @if(!empty($all_code))
            @foreach($all_code as $k=>$item)
                <tr>
                    <td>{!! $k+1 !!}</td>
                    <td>{!! $item['invitation_code'] !!}</td>
                    <td>
                        @if($item['status'] == 'valid')
                            <span class="label label-sm label-success">有效</span>
                        @endif
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
            {!! $all_code->render() !!}
        </ul>
    </div>
</div>




{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('questionlist', 'js/doc/questionlist.js') !!}