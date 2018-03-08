<h3 class="header smaller lighter blue mg-top12 mg-bottom20">图库</h3>
<div class="row">
    <div class="col-xs-12">
        <div>
            <div class="form-group">
                <button type="button" class="btn btn-primary btn-sm" ><a href="imageStore/add" style="color: white">新增图片</a> </button>
            </div>
            @foreach($image as $k=>$v)
                <input type="hidden" value="{{$k}}-{{$v}}" class="image">
            @endforeach
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th>编号</th>
                    <th>图片</th>
                    <th>操作</th>
                </tr>
                </thead>
                    <tbody id="demoContent">
                    {{--@if(empty($image))
                        暂无数据
                    @else--}}
                        {{--<tr id="tr_{{$k}}">
                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox"  class="ace check" name="ckb[]" value=""/>
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>
                                {{$k}}
                            </td>
                            <td><img src ="http://zfy.123.com/{{$v}}" alt="" width="50px" height="50px"></td>
                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    <a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="del({{$k}})">
                                        <i class="ace-icon fa fa-edit bigger-120">删除</i>
                                    </a>
                                </div>

                            </td>
                        </tr>--}}


                    </tbody>
            </table>
        </div>
        <div class="row">

            {{--<div class="col-xs-12">
                <div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">
                	<label class="position-relative mg-right10">
                        <input type="checkbox" class="ace" id="checkAll" value="1" />
                        <span class="lbl"> 全选</span>
                    </label>
                    <button type="submit" id="allTaskHandle" class="btn btn-primary btn-sm">批量审核</button>
                </div>
            </div>--}}

            <div class="space-10 col-xs-12"></div>
            <ul class="page" id="page"></ul>
        </div>
    </div>
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <link href="{{asset('uploadify/page.css')}}" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="{{asset('uploadify/page.js')}}"></script>
</div><!-- /.row -->
<script>
    //全选
	$len=$('.check').length;
	$('#checkAll').on('click',function(){
		
		if($(this).val() ==1){
			for(var i=0 ;i<$len;i++){
				$('.check')[i].checked=true;
			}
			
			$(this).val(2);
		}else{
			for(var i=0 ;i<$len;i++){
				$('.check')[i].checked=false;
			}
			$(this).val(1);
		}		
	})
    //批量审核
  $('#allTaskHandle').on('click',function(){
	  $('#FromSubmit').submit();
  })

    var image = $(".image");
    var images = [];

    for(i = 0;i<image.length;i++){
        var a = image[i].defaultValue;
        images.push(a);
    }
        //console.log(images)
    datas = images;
    var options={
        "id":"page",//显示页码的元素
        "data":datas,//显示数据
        "maxshowpageitem":3,//最多显示的页码个数
        "pagelistcount":10,//每页显示数据个数
        "callBack":function(result){
            //alert(id)
            //console.log(result);
            var cHtml="";
            for(var i=0;i<result.length;i++){
                var arr = result[i].split('-');
                cHtml+="<tr id='tr_"+arr[0]+"'>" +
                            "<td class='center'>" +
                                "<label class='pos-rel'>" +
                                    "<span class='lbl'></span>" +
                                "</label>" +
                            "</td>" +
                            "<td>"+i+
                                "</td><td><img src ='{{env('ZFY_WEB')}}/"+arr[1]+"' style='width: 50px;height: 50px'></td>" +
                            "<td>" +
                                "<div class='hidden-sm hidden-xs btn-group'>" +
                                    "<a href='javascript:void(0)' class='btn btn-xs btn-info' onclick='del("+arr[0]+")'>" +
                                        "<i class='ace-icon fa fa-edit bigger-120'>删除</i>" +
                                    "</a>" +
                                "</div>" +
                            "</td>" +
                        "</tr>";
            }

            $("#demoContent").html(cHtml);//将数据增加到页面中

        }
    };
    page.init(datas.length,1,options);

    function del(id){
        var _token = $("#_token").val();
        $.post('/manage/imageStoreDel',{id:id,_token:_token}, function (msg){
            $("#tr_"+msg).remove();
        })
    }

</script>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}

{!! Theme::asset()->container('custom-js')->usePath()->add('checked-js', 'js/checkedAll.js') !!}
