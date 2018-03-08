
<form class="form-horizontal clearfix registerform" role="form"  action="{!! url('manage/rolesDetail') !!}" method="post">
                                {{ csrf_field() }}
                                <div class="">
                                    <h3 class="header smaller lighter blue mg-top12 mg-bottom20">用户组列表</h3>
                                    <div class="well ">
                                        <h4 class="blue">编辑用户组</h4>
                                        用户组名称：<input type="text" name="name" value="{{ $info1['name'] }}" datatype="*">
                                        <i class="light-red ace-icon fa fa-asterisk"></i>
                                        显示名称：<input type="text" name="display_name" value="{{ $info1['display_name'] }}" datatype="*">
                                        <i class="light-red ace-icon fa fa-asterisk"></i>
                                        <input type="hidden" value ="{{ $info1['id']  }}" name="rid">
                                    </div>
                                    <div class="well h4 blue">
                                        用户组权限设置
                                    </div>
                                </div>
                                <div class="">
                                    <div class="">
                                        <div class="col-sm-12">
                                            <div class="tabbable row">
                                                <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4" num="{{ $num=0 }}">
                                                    @foreach($list as $v)
                                                    <li num="{{ $num++ }}" class="{{ ($num==1)?'active':'' }}">
                                                        <a data-toggle="tab" href="#home{{ $v['id'] }}">{{ $v['name'] }}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content" num="{{ $number=0 }}">
                                                    @foreach($list as $v)
                                                    <div num="{{ $number++ }}" id="home{{ $v['id'] }}" class="tab-pane in {{ ($number==1)?'active':'' }}">
                                                        <div id="main{{ $v['id'] }}">
                                                            <ul id='browser{{ $v['id'] }}' class='filetree'>
                                                                <li>
                                                                    <span class='folder'>
                                                                        @if(empty($v['_child']))
                                                                            <input type="checkbox" name="id[]"  value="{{ $v['id'] }}" id="t{{ $v['id'] }}" pId="t0" {{ (in_array($v['id'],$ids))?'checked':'' }}  onchange="child(this)"/>
                                                                        @endif
                                                                        {{ $v['name'] }}
                                                                    </span>
                                                                    @if(!empty($v['_child']))
                                                                    <ul>
                                                                        @foreach($v['_child'] as $value)
                                                                        <li>
                                                                            <span>
                                                                                @if(!empty($value['_child']))
                                                                                {{--<input type="checkbox"  id='t{{ $value['id'] }}' pId="t{{ $v['id'] }}"  onchange="child(this)"/>--}}
                                                                                    {{ $value['name'] }}
                                                                                @else
                                                                                <input type="checkbox" name="id[]"  id='t{{ $value['id'] }}' pId="t{{ $v['id'] }}" value="{{ $value['id'] }}" {{ (in_array($value['id'],$ids))?'checked':'' }} onchange="child(this)"/>
                                                                                    {{ $value['name'] }}
                                                                                @endif
                                                                            </span>
                                                                            @if(!empty($value['_child']))
                                                                                <ul>
                                                                                    @foreach($value['_child'] as $permissions)
                                                                                    <li>
                                                                                        <span >
                                                                                            @if(!empty($permissions['_child']))
                                                                                                {{--<input type="checkbox"  id='t{{ $permissions['id'] }}' pId="t{{ $value['id'] }}"  onchange="child(this)"/>--}}
                                                                                                {{ $permissions['name'] }}
                                                                                            @else
                                                                                                <input type="checkbox" name="id[]"  id='p{{ $permissions['id'] }}' pId="t{{ $value['id'] }}" value="{{ $permissions['id'] }}" {{ (in_array($permissions['id'],$ids))?'checked':'' }} onchange="child(this)"/>{{ $permissions['name'] }}
                                                                                            @endif
                                                                                        </span>
                                                                                        @if(!empty($permissions['_child']))
                                                                                            <ul>
                                                                                                @foreach($permissions['_child'] as $menu)
                                                                                                    <li>
                                                                                                        <span class='file'>
                                                                                                            <input type="checkbox" name="id[]" id="1{{ $menu['id'] }}" pId="t{{ $permissions['id'] }}" value="{{ $menu['id'] }}" {{ (in_array($menu['id'],$ids))?'checked':'' }} onchange="child(this)"/>{{ $menu['name'] }}
                                                                                                        </span>
                                                                                                    </li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        @endif
                                                                                    </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12  text-center">
                                    <div class="space"></div>
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <div class="space"></div>
                                </div>
                            </form>
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('treeView-css', 'plugins/jquery/tree/jquery.treeview.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('treeview-js', 'plugins/jquery/tree/jquery.treeview.js') !!}
<script type="text/javascript">
    $(document).ready(function(){
        @foreach($list as $v)
            $("#browser{{ $v['id']}}").treeview({});
        @endforeach
    });

    function findParent(p,checked) {
        $("input[id='"+p+"']").prop("indeterminate",checked);
    }
    function child(e) {
        var pId = e.id;
        var checked = e.checked;
        var p = $("#"+pId+"").attr("pId");

        if(checked) {
            findParent(p,checked);
            var children = $("input[pId='"+pId+"']");
            for(var i = 0; i < children.length; i++){
                $(children[i]).prop("checked", checked);
            }

            var checkLevelLengh = $("input[pId='"+p+"']:checked").length;
            var levelLengh = $("input[pId='"+p+"']").length;
            if(checkLevelLengh == levelLengh) {
                $("#"+p+"").removeAttr("indeterminate");
            }
        }else {
            var children = $("input[pId='"+pId+"']");
            for(var i = 0; i < children.length; i++){
                $(children[i]).prop("checked", checked);
            }

            var checkLevelLengh = $("input[pId='"+p+"']:checked").length;
            if(checkLevelLengh == 0) {
                $("#"+p+"").removeAttr("indeterminate");
                $("#"+p+"").prop("checked",checked);
            }else {
                $("#"+p+"").attr("indeterminate",true);
            }
        }
    }

</script>