{{--列表--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">用户等级</h3>

<div class="well">
    <form class="form-inline search-group" role="form" action="{{ URL('manage/postuerGrade') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group search-list ">
            <label for="name" class="">等级&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="grade" value="" >
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">所需活跃值</label>
            <input type="text" name="experience" value="">
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">称号</label>
            <input type="text" name="grade_name" value="">
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">称号图片</label>
            <input type="file" name="grade_img" value="">
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
            <th>等级</th>
            <th>所需活跃值</th>
            <th>称号</th>
            <th>称号图片</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
            @if(!empty($grade))
            @foreach($grade as $k=>$item)
                <tr>
                    <td>{!! $k+1 !!}</td>
                    <td>{!! $item['grade'] !!}</td>
                    <td>{!! $item['experience'] !!}活跃值</td>
                    <td>{!! $item['grade_name'] !!}</td>
                    <td><img src="/{!! $item['grade_img'] !!}" style="height:30px;"> </td>
                    <td>
                        <a class="btn btn-xs btn-info" href="gradeDetail/{{ $item['id'] }}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                        <a  href="gradeDel/{{ $item['id'] }}" title="删除" class="btn btn-xs btn-danger">
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
           {!! $grade->render() !!}
        </ul>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('questionlist', 'js/doc/questionlist.js') !!}