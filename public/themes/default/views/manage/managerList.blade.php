   {{-- <div class="page-header">
        <h3>
              搜索
        </h3>
    </div><!-- /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">系统用户</h3>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix  well">
        <form  role="form" class="form-inline search-group">
            <div class="">
                <div class="form-group search-list">
                    <label for="">用户名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="username" @if(isset($username))value="{!! $username !!}"@endif/>
                </div>
                <div class="form-group search-list">
                    <label for="">QQ　　　　</label><input type="text" name="QQ" @if(isset($QQ))value="{!! $QQ !!}"@endif/>
                </div>
                <div class="form-group search-list width285">
                    <label>用户状态</label>　
                    <select name="status">
                        <option value="">全部</option>
                        <option @if(isset($status) && $status == 1)selected="selected"@endif value="1">正常</option>
                        <option @if(isset($status) && $status == 2)selected="selected"@endif value="2">禁用</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm">搜索</button>
                </div>
            </div>
            <div class="space"></div>
            <div class="">
                <div class="form-group search-list">
                    <label>
                        电子邮箱　
                    </label>
                    <input type="text" name="email" @if(isset($email))value="{!! $email !!}"@endif/>
                </div>
                <div class="form-group search-list">
                    <label>联系电话　</label><input type="text" name="telephone" @if(isset($telephone))value="{!! $telephone !!}"@endif/>
                </div>
                <div class="form-group search-list width285">
                    <label for="">用户组&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <select name="role_id">
                        <option value="">全部</option>
                        @foreach($roles as $v)
                            <option @if(isset($role_id) && $role_id == $v->id)selected="selected"@endif value="{{ $v->id }}">{{ $v->display_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- <div class="table-responsive"> -->

    <!-- <div class="dataTables_borderWrap"> -->
    <div>
        <form action="/manage/managerDeleteAll" method="post">
            {{csrf_field()}}
        <table id="sample-table" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th class="center">
                    <label class="position-relative">

                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                        UID
                    </label>
                </th>
                <th>用户名</th>
                <th>用户组</th>
                <th>用户状态</th>
                <th>电子邮箱</th>
                <th>联系电话</th>
                <th>QQ</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            @if(!empty($list->toArray()['data']))
            @foreach($list as $v)
                <tr>
                    <td class="center">
                        <label class="position-relative">
                            <input type="checkbox" class="ace" value="{{ $v->id }}" name="chk[]"/>
                            <span class="lbl">{{ $v->id }}</span>
                        </label>
                    </td>
                    <td>
                        <a href="#">{{ $v->username}}</a>
                    </td>
                    <td>{{ $v['display_name'] }}</td>
                    <td> @if($v->status == 1)
                                                正常

                        @elseif($v->status == 2 )
                                                禁用
                        @endif</td>

                    <td>{{ $v->email }}</td>
                    <td>
                        <span class=>{{ $v->telephone }}</span>
                    </td>
                    <td>
                       {{ $v->QQ }}
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-xs btn-info" href="managerDetail/{{ $v->id }}">
                                <i class="fa fa-edit"></i>编辑
                            </a>
                            <a class="btn btn-xs btn-danger" href="managerDel/{{ $v->id }}">
                                <i class="fa fa-trash-o"></i>删除
                            </a>
                            @if($v->status == 1)

                                <a class="btn btn-xs btn-danger" href="{!! url('manage/handleManage/' . $v->id . '/disable') !!}">
                                    <i class="fa fa-ban"></i>禁用
                                </a>
                            @elseif($v->status == 2 )

                                <a class="btn btn-xs btn-success" href="{!! url('manage/handleManage/' . $v->id . '/enable') !!}">
                                    <i class="fa fa-check"></i>启用
                                </a>
                        @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>

        </table>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">
                        <a href="/manage/managerAdd" target="_blank">添加</a>
                        <button class="btn btn-primary btn-sm" id="largeDel">批量删除

                        </button>
                    </div>
                </div>
                <div class="space-10 col-xs-12"></div>
                <div class="col-xs-12">
                    <div class="dataTables_paginate paging_bootstrap row">
                        <ul class="pagination">
                            @if(!empty($listArr['prev_page_url']))
                                <li><a href="{!! URL('manage/managerList').'?'.http_build_query(array_merge($merge,['page'=>$listArr['current_page']-1])) !!}">上一页</a></li>
                            @endif
                            @if($listArr['last_page']>1)
                                @for($i=1;$i<=$listArr['last_page'];$i++)
                                    <li class="{{ ($i==$listArr['current_page'])?'active disabled':'' }}"><a href="{!! URL('manage/managerList').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
                                @endfor
                            @endif
                            @if(!empty($listArr['next_page_url']))
                                <li><a href="{!! URL('manage/managerList').'?'.http_build_query(array_merge($merge,['page'=>$listArr['current_page']+1])) !!}">下一页</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    </div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('checked-js', 'js/checkedAll.js') !!}
