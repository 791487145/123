
{{--<div class="page-header">
    <h1>

    </h1>
</div> <!--  /.page-header -->--}}
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="/manage/area">地区配置</a>
            </li>
            <li>
                <a href="/manage/substationConfig">分站点配置</a>
            </li>
        </ul>
    </div>
</div><!-- <div class="dataTables_borderWrap"> -->
<form action="{{ URL('manage/areaCreate') }}" method="post" id="form-data">
    {{ csrf_field() }}
    <input type="hidden" name="change_ids" id="area-change" value="" />

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
            <select  id="form-field-select-1" name="province" onchange="checkprovince(this)">
                <option value="" id="province-back">-省份-</option>
                @foreach($province_data as $v)
                    <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                @endforeach
            </select>
            <!-- 城市 -->
            <select  id="province_check" name="city" onchange="checkcity(this)">
                <option value="" id="city-back">-城市-</option>
            </select>
        </div>

    </div>
    <div>
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th >排序</th>
                <th width="50%" >名称</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="area_data_change">
            @foreach($province_data as $v)
                <tr id="area-delete-{{ $v['id'] }}" area_id = "{{ $v['id'] }}">

                    <td>
                        <input class="area-index" type="text" name="displayorder[{{ $v['id'] }}]" value="{{ $v['displayorder'] }}" area_id="{{ $v['id'] }}" onchange="area_change($(this))">
                    </td>
                    <td class="text-left">
                        <input type="text" name="name[{{ $v['id'] }}]" value="{{ $v['name'] }}" area_id="{{ $v['id'] }}" onchange="area_change($(this))">
                    </td>
                    <td width="40%">
                        <span class="btn  btn-sm btn-primary" area_id="{{ $v['id'] }}"  onclick="area_delete($(this))" >删除</span>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <span class="btn btn-sm btn-primary" onclick="area_create($(this))">添加</span>
            <button class="btn btn-sm btn-primary" >提交</button>
        </div>
    </div>
</form>
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
<script>
    /**
     * 省级切换
     * @param obj
     */
    function checkprovince(obj){
        var id = obj.value;
        $('#province-back').val(0);
        $.get('/manage/ajaxcity',{'id':id},function(data){
            var html = '<option value=\"'+data.id+'\">-城市-</option>';
            var area = '';
            for(var i in data.province){
                html+= "<option value=\""+data.province[i].id+"\">"+data.province[i].name+"<\/option>";
                area+= "<tr id='area-delete-"+data.province[i].id+"'  area_id=\""+data.province[i].id+"\"><td><input class=\"area-index\" type=\"text\" name=\"displayorder["+data.province[i].id+"]\" value=\""+data.province[i].displayorder+"\" area_id=\""+data.province[i].id+"\" onchange=\"area_change($(this))\"><\/td><td class=\"text-left\"><input type=\"text\" name=\"name["+data.province[i].id+"]\"  value=\""+ data.province[i].name+"\" area_id=\""+data.province[i].id+"\" onchange=\"area_change($(this))\"><\/td><td width=\"40%\"><span class=\"btn btn-sm btn-primary\" area_id=\""+data.province[i].id+"\" onclick=\"area_delete($(this))\">删除<\/span><\/td><\/tr>";
            }
            if(data.id!=0){
                $('#province_check').html(html);
            }else{
                html = '<option value=\"\">-城市-</option>';
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
        $.get('/manage/ajaxarea',{'id':id},function(data){
            var html = '';
            var area = '';
            for(var i in data){
                html += "<option value=\""+data[i].id+"\">"+data[i].name+"<\/option>";
                area+= "<tr id='area-delete-"+data[i].id+"' area_id=\""+data[i].id+"\"><td><input class=\"area-index\" type=\"text\" name=\"displayorder["+data[i].id+"]\" value=\""+data[i].displayorder+"\" area_id=\""+data[i].id+"\" onchange=\"area_change($(this))\"><\/td><td class=\"text-left\"><input type=\"text\" name=\"name["+data[i].id+"]\" value=\""+ data[i].name+"\" area_id=\""+data[i].id+"\" onchange=\"area_change($(this))\"><\/td><td width=\"40%\"><span class=\"btn btn-sm btn-primary\" area_id=\""+data[i].id+"\" onclick=\"area_delete($(this))\">删除<\/span><\/td><\/tr>";
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
        var url = '/manage/areaDelete/'+id;
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
        var id = Number($('#area_data_change').children('tr:last').attr('area_id'))+1;
        //添加一个地区的input框
        var html = "<tr area_id=\""+id+"\" id=\"area-delate-"+id+"\"><td><input class=\"area-index\" area_id=\""+id+"\" type=\"text\" name=\"displayorder[]\"  onchange=\"area_change($(this))\" value=\"0\"><\/td><td class=\"text-left\"><input type=\"text\" name=\"name[]\" value=\"\" area_id=\""+id+"\"  onchange=\"area_change($(this))\"><\/td><td width=\"40%\"><\/td><\/tr>" ;
        $('#area_data_change').append(html);
    }
    function area_change(obj)
    {
        var id = obj.attr('area_id');
        var value = $('#area-change').attr('value');
        $('#area-change').attr('value',value+' '+id);
    }
</script>