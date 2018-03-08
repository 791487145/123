
   {{-- <div class="space-2"></div>
    <div class="page-header">
        <h1>
            行业配置
        </h1>
    </div> <!--  /.page-header -->--}}
    <h3 class="header smaller lighter blue mg-bottom20 mg-top12">行业配置</h3>
    <form action="{{ URL('manage/industryCreate') }}" method="post" id="form-data">
        {{ csrf_field() }}
        <input type="hidden" name="change_ids" id="area-change" value="" />
        <div class="row">

            <div class="col-xs-12">
                <div class="well">
                    <div class="alert alert-block alert-success area-tips">
                        技巧提示
                    </div>
                    <ul >
                        <li>您可以自己编辑地区数据</li>
                        <li>添加，编辑或删除操作后需要点击“提交”按钮才生效</li>
                    </ul>
                    <div class="chose-area">
                        选择地区
                        <!-- 省份 -->
                        <select  id="form-field-select-1" name="second" onchange="checkprovince(this)">
                            <option value="" id="province-back">-一级-</option>
                            @foreach($category_data as $v)
                                <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                            @endforeach
                        </select>
                        <!-- 城市 -->
                        <select  id="province_check" name="third" onchange="checkcity(this)">
                            <option value="" id="city-back">-二级-</option>
                        </select>
                    </div>

                </div>
                <div>
                    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>名称</th>
                            {{--<th>分类图标（App）</th>--}}
                            <th>排序</th>
                            <th>图标</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody id="area_data_change">
                        @foreach($category_data as $v)
                            <tr id="area-delete-{{ $v['id'] }}" area_id = "{{ $v['id'] }}">
                                <td class="text-left">
                                    <input type="text" name="name[{{ $v['id'] }}]" value="{{ $v['name'] }}" area_id="{{ $v['id'] }}" onchange="area_change($(this))" />
                                </td>
                                {{--<td class="text-left">--}}
                                    {{--<img src="{{ Theme::asset()->url('/images/ico.png')}}" alt="" height="33" width="33">--}}
                                {{--</td>--}}
                                <td class="text-left">
                                    <input type="text" name="sort[{{ $v['id'] }}]" value="{{ $v['sort'] }}" area_id="{{ $v['id'] }}" onchange="area_change($(this))" />
                                </td>
                                <td class="text-left">
                                    <img src="{!! url($v['pic']) !!}" width="30px" height="30px">
                                </td>
                                <td width="40%">
                                    <a class="btn btn-xs btn-info" href="/manage/industryInfo/{{ $v['id'] }}">
                                        <i class="fa fa-edit bigger-120"></i>编辑
                                    </a>
                                    <span class="btn  btn-xs btn-danger" area_id="{{ $v['id'] }}"  onclick="area_delete($(this))" ><i class="ace-icon fa fa-trash-o bigger-120"></i>删除</span>
                                    @if($v['pid']==0)
                                    <a class="btn  btn-xs btn-info" href="/manage/tasktemplate/{{ $v['id'] }}" ><i class="fa fa-edit bigger-120"></i>编辑实例模板</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <span  class="btn btn-sm btn-info" onclick="area_create($(this))">添加</span>
                <button  class="btn btn-sm btn-info" >提交</button>
            </div>
        </div>
    </form>
<!-- /.page-content-area -->
   {!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
<script>
    /**
     * 省级切换
     * @param obj
     */
    function checkprovince(obj){
        var id = obj.value;
        $('#province-back').val(0);
        $.get('/manage/ajaxSecond',{'id':id},function(data){
            var html = '<option value=\"'+data.id+'\">-二级-</option>';
            var area = '';
            for(var i in data.province) {
                html += "<option value=\"" + data.province[i].id + "\">" + data.province[i].name + "<\/option>";
                if (data.province[i].pid == 0) {
                    area += "<tr id='area-delete-" + data.province[i].id + "'  area_id=\"" + data.province[i].id + "\">" +
                            "<td class=\"text-left\">" +
                            "<input type=\"text\" name=\"name[" + data.province[i].id + "]\"  value=\"" + data.province[i].name + "\" area_id=\"" + data.province[i].id + "\" onchange=\"area_change($(this))\">" +
                            "<\/td><td class=\"text-left\">" +
                            "<input type=\"text\" name=\"sort[" + data.province[i].id + "]\"  value=\"" + data.province[i].sort + "\" area_id=\"" + data.province[i].id + "\" onchange=\"area_change($(this))\">" +
                            "<\/td>" +
                            "<td class=\"text-left\"><img src=\""+ data.province[i].pic +"\" width=\"30px\" height=\"30px\"><\/td>"+
                            "<td width=\"40%\">" +
                            " <a class=\"btn btn-xs btn-info\" href=\"/manage/industryInfo/" + data.province[i].id +"\"><i class=\"fa fa-edit bigger-120\"></i>编辑</a>&nbsp;&nbsp;"+
                            "<span class=\"btn btn-sm btn-primary\" area_id=\"" + data.province[i].id + "\" onclick=\"area_delete($(this))\">删除<\/span> " +
                            "<a  class='btn  btn-sm btn-primary' href='/manage/tasktemplate/"+data.province[i].id+"'>编辑实例模板</a><\/td><\/tr>";
                }else{
                    area += "<tr id='area-delete-" + data.province[i].id + "'  area_id=\"" + data.province[i].id + "\">" +
                            "<td class=\"text-left\"><input type=\"text\" name=\"name[" + data.province[i].id + "]\"  value=\"" + data.province[i].name + "\" area_id=\"" + data.province[i].id + "\" onchange=\"area_change($(this))\">" +
                            "<\/td><td class=\"text-left\">" +
                            "<input type=\"text\" name=\"sort[" + data.province[i].id + "]\"  value=\"" + data.province[i].sort + "\" area_id=\"" + data.province[i].id + "\" onchange=\"area_change($(this))\">" +
                            "<\/td>" +
                            "<td class=\"text-left\"><img src=\""+ data.province[i].pic +"\" width=\"30px\" height=\"30px\"><\/td>"+
                            "<td width=\"40%\">" +
                            " <a class=\"btn btn-xs btn-info\" href=\"/manage/industryInfo/" + data.province[i].id +"\"><i class=\"fa fa-edit bigger-120\"></i>编辑</a>&nbsp;&nbsp;"+
                            "<span class=\"btn btn-sm btn-primary\" area_id=\"" + data.province[i].id + "\" onclick=\"area_delete($(this))\">删除<\/span><\/td><\/tr>";

                }
            }
            if(data.id!=0){
                $('#province_check').html(html);
            }else{
                html = '<option value=\"\">-二级-</option>';
                $('#province_check').html(html);
            }
            //替换数据列表
            $('#area_data_change').html(area);
            $('#area-change').attr('value','');
        });
    }
    /**
     * 市级切换
     * @param obj
     */
    function checkcity(obj){
        var id = obj.value;
        $('#city-back').attr('value',id);
        $.get('/manage/ajaxThird',{'id':id},function(data){
            var html = '';
            var area = '';
            for(var i in data){
                html += "<option value=\""+data[i].id+"\">"+data[i].name+"<\/option>";
                area+= "<tr id='area-delete-"+data[i].id+"' area_id=\""+data[i].id+"\">" +
                        "<td class=\"text-left\"><input type=\"text\" name=\"name["+data[i].id+"]\" value=\""+ data[i].name+"\" area_id=\""+data[i].id+"\" onchange=\"area_change($(this))\">" +
                        "<\/td><td class=\"text-left\"><input type=\"text\" name=\"sort["+data[i].id+"]\" value=\""+ data[i].sort+"\" area_id=\""+data[i].id+"\" onchange=\"area_change($(this))\">" +
                        "<\/td>" +
                        "<td class=\"text-left\"><img src=\""+ data[i].pic +"\" width=\"30px\" height=\"30px\"><\/td>"+
                        "<td width=\"40%\">" +
                        " <a class=\"btn btn-xs btn-info\" href=\"/manage/industryInfo/" + data[i].id +"\"><i class=\"fa fa-edit bigger-120\"></i>编辑</a>&nbsp;&nbsp;"+
                        "<span class=\"btn btn-sm btn-primary\" area_id=\""+data[i].id+"\" onclick=\"area_delete($(this))\">删除<\/span><\/td><\/tr>";
            }
            $('#area_data_change').html(area);
            $('#area-change').attr('value','');
        });
    }
    /**
     * 删除地区数据
     * @param obj
     */
    function area_delete(obj)
    {
        var id = obj.attr('area_id');
        var url = '/manage/industryDelete/'+id;
        $.get(url,function(data){
            if(data.errCode==0)
            {
                alert('删除失败');
            }else if(data.errCode==1)
            {
                $('#area-delete-'+data.id).remove();
            }
        });
    }
    /**
     * 地区的添加修改
     * @param obj
     */
    function area_create(obj)
    {
        var id = Number($('#area_data_change').children('tr:last').attr('area_id'))+10000;
        if(isNaN(id))
        {
            id= 10000;
        }

        //添加一个地区的input框
        var html = "<tr area_id=\""+id+"\" id=\"area-delate-"+id+"\"><td class=\"text-left\"><input type=\"text\" name=\"name["+id+"]\" value=\"\" area_id=\""+id+"\"  onchange=\"area_change($(this))\"><\/td><td class=\"text-left\"><input type=\"text\" name=\"sort["+id+"]\" value=\"\" area_id=\""+id+"\"  onchange=\"area_change($(this))\"><\/td><td width=\"40%\"><\/td><\/tr>" ;
        $('#area_data_change').append(html);
    }
    function area_change(obj)
    {
        var id = obj.attr('area_id');
        var value = $('#area-change').attr('value');
        $('#area-change').attr('value',value+' '+id);
    }
</script>