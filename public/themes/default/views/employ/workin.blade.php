<div class="col-xs-12">
    <div class="row min-height640">
        <div class="needs">
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 col-left pull-right">
                    @if($role==2 && $employ_data['status']==0)
                <div class="gzinfo-sidetime needs-sidebar text-center clearfix mg-bottom20">
                        <p class="cor-gray51 text-size18">雇佣处于:<span class="cor-blue">待受理</span>状态</p>
                        <a class="pull-left gzinfo-sidebtnblu btn btn-primary bor-radius2" href="javascript:void(0);" data-toggle="modal" data-target="#myModalsl" id="except1" url="{{ URL('employ/except',['id'=>$employ_data['id'],'type'=>2]) }}">受理</a>
                        <a data-toggle="modal" data-target="#myModalslno"  class="pull-right gzinfo-sidebtndef btn bor-radius2"  id="except2" url="{{ URL('employ/except',['id'=>$employ_data['id'],'type'=>3]) }}">拒绝</a>
                    @elseif($role==1 && date('Y-m-d',time())<$employ_data['cancel_at'] && $employ_data['status']==0)
                <div class="gzinfo-sidetime needs-sidebar text-center clearfix gzinfo-titnum">
                        <span class="text-size18">请耐心等待对方受理雇佣</span>
                        {{--<a data-toggle="modal" data-target="#myModalslno"  class="gzinfo-sidebtndef btn bor-radius2" id="except3" url="{{ URL('employ/except',['id'=>$employ_data['id'],'type'=>1]) }}">取消雇佣</a>--}}
                    @endif
                    {{--工作页面--}}
                    @if($employ_data['status']==1)
                <div class="gzinfo-sidetime needs-sidebar text-center clearfix mg-bottom20">
                    <p class="cor-gray51 text-size18">当前处于:<span class="cor-blue">工作中</span>状态</p>
                    <p class="cor-gray51 text-size14">离雇佣结束还剩</p>
                    <p class="cor-blue text-size22"><b delivery_deadline="{{ date('Y/m/d H:i:s',strtotime($employ_data['delivery_deadline'])) }}" class="timer-check"></b></p>
                        @if($role==2)
                    <a href="javascript:;" class="btn btn-block btn-primary bor-radius2 text-size16 gzinfo-showbtn">交付</a>
                        @endif
                    @endif
                    {{--交付验收页面--}}
                    @if($employ_data['status']==2)
                <div class="gzinfo-sidetime needs-sidebar text-center clearfix mg-bottom20">
                    <p class="cor-gray51 text-size18">当前处于:<span class="cor-blue">验收</span>状态</p>
                    <p class="cor-gray51 text-size14">离验收结束还剩</p>
                    <p class="cor-blue text-size22"><b delivery_deadline="{{ date('Y/m/d H:i:s',strtotime($employ_data['accept_deadline'])) }}" class="timer-check"></b></p>
                    @if($role==1)
                    <a href="" class="pull-left gzinfo-sidebtnblu btn btn-primary bor-radius2" data-toggle="modal" data-target="#except5">验收通过</a>
                    <a href="" class="pull-right gzinfo-sidebtndef btn bor-radius2" data-toggle="modal" data-target="#except6">维权</a>
                    @elseif($role==2 && time()>strtotime($employ_data['right_allow_at']))
                    <a href="" class="btn btn-block btn-primary bor-radius2 text-size16" data-toggle="modal" data-target="#except6">维权</a>
                    @endif
                    @endif
                    @if($employ_data['status']==3)
                <div class="gzinfo-sidetime needs-sidebar text-center clearfix gzinfo-titnum">
                    <span class="text-size18">本次雇佣已经结束</span>
                    @endif
                    @if($employ_data['status']==4)
                <div class="gzinfo-sidetime needs-sidebar text-center clearfix gzinfo-titnum">
                    <span class="text-size18">本次雇佣已经结束</span>
                    @endif
                    @if($employ_data['status']==5)
                <div class="gzinfo-sidetime needs-sidebar text-center clearfix gzinfo-titnum">
                        <span class="text-size18">威客已拒绝任务</span>
                    @endif
                    @if($employ_data['status']==6)
                <div class="gzinfo-sidetime needs-sidebar text-center clearfix gzinfo-titnum">
                        <span class="text-size18">雇主已取消雇佣</span>
                    @endif
                    @if($employ_data['status']==7 || $employ_data['status']==8)
                <div class="gzinfo-sidetime needs-sidebar text-center clearfix mg-bottom20">
                    <p class="cor-gray51 text-size18">雇佣处于:<span class="cor-blue">维权</span>状态</p>
                    <div class="cor-gray51 text-size14">请耐心等待平台反馈结果</div>
                    @endif
                    @if($employ_data['status']==9)
                        <div class="gzinfo-sidetime needs-sidebar text-center clearfix gzinfo-titnum">
                            <span class="text-size18">雇佣已过期</span>
                    @endif
                </div>
                <!-- 受理页面模态框（Modal） -->
                <div class="modal fade" id="myModalsl" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header widget-header-flat">
                                <span class="modal-title" id="myModalLabel">
                                    受理提示：
                                </span>
                            </div>
                            <div class="modal-body text-center">
                                <p class="h5">您确认受理该雇佣么，请确认是否明白雇佣内容！</p>
                                <div class="space"></div>
                                <p><button class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2 win-bid" type="button" taget_id="except1" onclick="winBid($(this))" data-dismiss="modal">确定</button> <button class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" type="button" data-dismiss="modal">取消</button></p>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
                </div>
                @if($employ_data['status']==0)
                <div class="modal fade" id="myModalslno" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header widget-header-flat">
                                <span class="modal-title" id="myModalLabel">
                                    {{ ($role==2)?'受理提示':'取消雇佣提示' }}：
                                </span>
                            </div>
                            <div class="modal-body text-center">
                                <p class="h5">{{ ($role==2)?'您确认拒绝该雇佣么':'您确认取消雇佣' }}？</p>
                                <div class="space"></div>
                                <p><button class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2 win-bid" type="button" taget_id="{{ ($role==2)?'except2':'except3' }}"  onclick="winBid($(this))" data-dismiss="modal">确定</button> <button class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" type="button" data-dismiss="modal">取消</button></p>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
                </div>
                @endif
                {{--<div class="space-10"></div>--}}
                @if($role==2)
                <div class="needs-sidebar gzinfo-sidebar hidden-md hidden-sm hidden-xs ">
                    <h4 class="text-center">雇主信息</h4>
                    <div class="needs-sidebar-wrap">
                        <div class="wrap3 clearfix gzinfo-imgwrap">
                            <div class="gzinfo-img"><img src="{{ $domain.'/'.$user_data['avatar'] }}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" alt=""></div>
                            <div class="gzinfo-imginfo">
                                <p class="text-size16 cor-gray51 p-space">{{ $user_data['user_name'] }}</p>
                                <p class="gzinfo-infoicon clearfix">
                                    @if(in_array('bank',$user_data['auth']))
                                        <span class="s-servicericon bank-attestation"></span>
                                    @else
                                        <span class="s-servicericon bank-attestation-no"></span>
                                    @endif
                                    @if(in_array('realname',$user_data['auth']))
                                        <span class="s-servicericon cd-card-attestation"></span>
                                    @else
                                        <span class="s-servicericon cd-card-attestation-no"></span>
                                    @endif
                                    @if(Auth::user()->email_status == 2)
                                        <span class="s-servicericon email-attestation"></span>
                                    @else
                                        <span class="s-servicericon email-attestation-no"></span>
                                    @endif
                                    @if(in_array('alipay',$user_data['auth']))
                                            <span class="s-servicericon alipay-attestation"></span>
                                    @else
                                            <span class="s-servicericon alipay-attestation-no"></span>
                                    @endif
                                    @if(in_array('enterprise',$user_data['auth']))
                                        <span class="s-servicericon com-attestation"></span>
                                    @else
                                        <span class="s-servicericon com-attestation-no"></span>
                                    @endif
                                </p>
                                <p class="cor-gray51">好评数<span class="cor-blue">{{ $user_data['employer_praise_rate'] }}</span> | 好评率<span class="cor-blue">{{ $user_data['good_rate'] }}%</span></p>
                            </div>
                        </div>
                        <div class="wrap4 employworkico">
                            <a href="javascript:;" title="联系TA" class="ico1 taskconico icogz" data-toggle="modal" data-target="#myModalgz" data-values="{{ $employ_data['employer_uid'] }}" data-id="{{$contact}}" id="contactHe">联系雇主</a>
                            @if(Auth::check())
                                @if($isFocus)
                                    <a class="follow-me workfocus" id="focus_uid" focus_uid = {{ $user_data['uid'] }}><i class="fa fa-minus text-size14 cor-grayac"></i> <span>已关注</span> </a>
                                @else
                                    <a class="follow-me workfocus" id="focus_uid"  focus_uid = {{ $user_data['uid'] }}><i class="fa fa-plus text-size14 cor-grayac"></i> <span>加关注</span> </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @if($role==1)
                <div class="needs-sidebar needs-sidebar-right">
                    <h4 class="text-center">被雇佣服务商信息</h4>
                    <div class="needs-sidebar-wrap">
                        <div class="wrap1">
                            <img src="{{ $domain.'/'.$user_data['avatar'] }}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" alt=""/>
                        </div>
                        <div class="wrap2">
                            <p class="tit">{{ $user_data['user_name'] }}</p>
                            <p class="beyond clearfix beyond-a">
                                <span>认证：</span>
                                <a  class="ico2 {{ (in_array('bank',$user_data['auth']))?'u-ico2':'' }}" title="银行卡认证"></a>
                                <a  class="ico1  {{ (in_array('realname',$user_data['auth']))?'u-ico1':'' }}" title="实名认证"></a>
                                <a  class="ico3 {{ ($user_data['email_status']==2)?'u-ico3':'' }}" title="邮箱认证">
                                </a><a  class="ico4 {{ (in_array('alipay',$user_data['auth']))?'u-ico4':'' }}" title="支付宝认证"></a>
                                <a  class="ico5 {{ (in_array('enterprise',$user_data['auth']))?'u-ico5':'' }}" title="企业认证"></a>
                            </p>
                            <p class="beyond">
                                <span>地区：</span>
                                @if(!empty($user_data['province_name']) && !empty($user_data['city_name']))
                                    {{ $user_data['province_name'].$user_data['city_name'] }}
                                @else
                                    暂无地区
                                @endif
                            </p>
                            <p class="beyond beyond-s clearfix">
                                <span>标签：</span>
                                @if(!empty($user_data['tags']))
                                    @foreach($user_data['tags'] as $v)
                                        <a href="javascript:;">{{ $v['tag_name'] }}</a>
                                    @endforeach
                                @else
                                    <a href="javascript:;">暂无标签</a>
                                @endif
                            </p>
                        </div>
                        <div class="wrap3">
                            <ul class="list-inline">
                                <li>
                                    <p class="text-center">好评数</p>
                                    <p class="text-center text-color">{{ $user_data['employee_praise_rate'] }}</p>
                                </li>
                                <li>
                                    <p class="text-center">好评率</p>
                                    <p class="text-center text-color">{{ $user_data['good_rate'] }}%</p>
                                </li>
                                <li>
                                    <p class="text-center">
                                        月雇佣
                                    </p>
                                    <p class="text-center text-color">92</p>
                                </li>
                            </ul>
                        </div>
                        <div class="wrap4 employworkico">
                            @if(Auth::check())
                            <a href="javascript:;" title="联系TA" class="ico1 taskconico icogz" data-toggle="modal" data-target="#myModalgz" data-values="{{ $employ_data['employee_uid'] }}" data-id="{{$contact}}" id="contactHe"><i></i>联系TA</a>
                            @endif
                            @if(!$user_shop)
                            <a href="{{ URL('bre/serviceCaseList/'.$user_data['uid']) }}" target="_blank" class="ico2"><i></i>进入空间</a>
                            @else
                            <a href="{{ URL('shop/'.$user_shop['id']) }}" target="_blank" class="ico3"><i></i>进入店铺</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                {{--联系雇主模态框--}}
                @if($contact==2)
                <div class="modal fade" id="myModalgz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog  contact-me-modal" role="document">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">联系TA</h4>
                            </div>
                            <form class="form-horizontal" action="seriveceCaseDetail_submit" method="post" accept-charset="utf-8">

                                <div class="modal-body">

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                                            <strong>标题：</strong> </label>

                                        <div class="col-sm-9">
                                            <input type="text" id="form-field-1" name="title" class="col-xs-10 col-sm-5 title">
                                            <input type="hidden" name="js_id" class="js_id" id="contactMeId" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                                            <strong>内容：</strong> </label>

                                        <div class="col-sm-9">
                                            <textarea class="form-control col-xs-10 col-sm-5 content" id="form-field-8" name="content"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="contactMe">确定</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="contactMeCancel">取消</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 col-left">
                <div class="gzinfo-main">
                    <div class="gzinfo-mainhd">
                        <h3 class="text-size20 clearfix">
                            <i class="bg-blue"></i>{{ $employ_data['title'] }}
                            @if($role==1 && $employ_data['status']==0 && time()>strtotime($employ_data['cancel_at']))
                            <a  data-toggle="modal" data-target="#myModalslno"   class="gzinfostop" id="except3" url="{{ URL('employ/except',['id'=>$employ_data['id'],'type'=>1]) }}">取消雇佣</a>
                            @endif
                            @if($employ_data['status']==3 && !$comment_status)
                            <a class="btn btn-primary btn-blue btn-big3 bor-radius2 pull-right gzinfo-orgin" href="#comment">评价</a>
                            @endif
                        </h3>
                        <p class="text-size16 cor-gray51">雇主预算：<b class="cor-blue">{{ $employ_data['bounty'] }}元</b></p>
                        <p class="text-size14 cor-gray89">雇主：{{ $employ_data['user_name'] }}  |  截止日期：{{ date('Y.m.d',strtotime($employ_data['delivery_deadline'])) }}</p>
                    </div>
                    <div class="gzinfo-maindes">
                        <div class="text-size16 cor-gray51">需求描述</div>
                        <div class="gzinfo-maindesinfo"  style="word-wrap: break-word;">{!!  $employ_data['desc']  !!}</div>
                        <div>
                            <div class="space-4"></div>
                            <b class="text-size14">附件：</b>
                            <div class="space-4"></div>
                            <div class="user-profile clearfix">
                            <ul class="ace-thumbnails">
                                @foreach($attachment as $v)
                                    <li>
                                        <a href="#" >
                                            <img alt="150x150" src="{!! Theme::asset()->url('images/task-xiazai/'.matchImg($v['type']).'.png') !!}">
                                            <div class="text">
                                                <div class="inner"></div>
                                            </div>
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="{{ URL('task/download',['id'=>$v['id']]) }}" target="_blank">下载</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <p class="text-right cor-grayC2">雇佣编号：{{ $employ_data['id'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发布时间：{{ date('Y-m-d',strtotime($employ_data['created_at'])) }} </p>
                        <div class="space-4"></div>
                    </div>
                </div>
                {{--工作页面--}}
                @if($role==2 && $employ_data['status']==1)
                <div class="gzinfo-mainup gzinfo-mainpay gzinfo-mainshow">
                    <form class="workin-validform" action="{{ URL('employ/workCreate') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="employ_id" value="{{ $employ_data['id'] }}" />
                    <h4 class="cor-gray51 ">交付稿件</h4>
                    <div class="clearfix">
                        <textarea datatype="*1-500" errormsg="请输入" id="liMit" class="textarea inputxt" name="desc"></textarea>
                        <div class="cor-gray51 pull-right">
                            <span class="cor-orange"><i class="fa fa-exclamation-circle"></i></span> 最多<span id="textCount">500</span>个字
                        </div>
                    </div>
                    <div class="annex needs-section-annex gzinfo-mainupload">
                        <!--文件上传-->
                        <div action=" " class="dropzone clearfix" id="dropzone"  url="/task/ajaxAttatchment" deleteurl="/task/delAttatchment">
                            <div class="fallback">
                                <input name="file" type="file" multiple="" />
                            </div>
                        </div>
                    </div>
                    <div style="display:none;" id="file_update"></div>
                    <div class="text-right"><input type="submit" value="提交" class="btn btn-primary bor-radius2 gzinfo-mainbtn"/></div>
                    </form>
                </div>
                @endif
                @if(!empty($work))
                {{--交付验收页面--}}
                <div class="gzinfo-mainup gzinfo-mainpay nopdtom mg-bottom20 text-size14">
                    <h4 class="text-size18 cor-gray51">交付稿件</h4>
                    <div style="word-wrap: break-word;">
                    <p class="gzinfo-maindesinfo">{{ $work['desc'] }}</p>
                    </div>
                    <div>
                        <div class="space-4"></div>
                        <div class="text-size14 cor-gray5 gzinfo-icofj"><b>附件</b> ({{ count($work_attachment) }})</div>
                        <div class="space-4"></div>
                        <div class="user-profile gzinfo-fjpdl clearfix">
                            <ul class="ace-thumbnails">
                                @foreach($work_attachment as $v)
                                <li>
                                    <a href="#" >
                                        <img alt="150x150" src="{!! Theme::asset()->url('images/task-xiazai/'.matchImg($v['type']).'.png') !!}">
                                        <div class="text">
                                            <div class="inner"></div>
                                        </div>
                                    </a>
                                    <div class="tools tools-bottom">
                                        <a href="{{ URL('task/download',['id'=>$v['id']]) }}" target="_blank">下载</a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="space-4"></div>
                    <p class="text-right cor-grayC2 text-size12">交付时间：{{ date('Y-m-d',strtotime($work['created_at'])) }}</p>
                    <div class="space-4"></div>
                </div>
                @endif
                @if(count($comment)>0)
                {{--评价展示--}}
                <div class="gzinfo-mainup nopdtom">
                    @foreach($comment as $v)
                    <div class="record pd-padding0">
                        <div class="text-size14 cor-gray51 clearfix">
                            <div class="col-xs-12 task-mediaAssessR pd-padding0">
                                <p class="text-size18 cor-gray51">{{ ($v['to_uid']==$employ_data['employee_uid'])?'评价威客':'评价雇主' }}</p>
                            </div>
                        </div>
                        <div class="clearfix record recordzs">
                            <p class="text-size12 cor-gray51 pull-left">{{ $v['comment'] }}</p>
                            @if($v['type']==1)
                            <span class="flower1 pull-right">好评</span>
                            @elseif($v['type']==2)
                            <span class="flower2 pull-right">中评</span>
                            @elseif($v['type']==3)
                            <span class="flower3 pull-right">差评</span>
                            @endif
                        </div>
                        <div class="star text-size14 cor-gray51 clearfix">
                            <div class="col-xs-11 task-mediaAssessR pd-padding0">
                                <div class="recordstar">
                                    <div class="target-star starpd"> {{ ($v['to_uid']==$employ_data['employee_uid'])?'工作速度':'付款及时性' }}：</div>
                                    <div class="mg-right visible-lg-inline-block visible-md-inline-block visible-sm-inline-block visible-xs-inline-block">
                                        @for($i=1;$i<=$v['speed_score'];$i++)
                                        <span class="rec-active"></span>
                                        @endfor
                                        @for($i=1;$i<=(5-$v['speed_score']);$i++)
                                        <span></span>
                                        @endfor
                                    </div>
                                    <div class="target-star starpd">{{ ($v['to_uid']==$employ_data['employee_uid'])?'工作质量':'合作愉快度' }}： </div>
                                    <div class="mg-right visible-lg-inline-block visible-md-inline-block visible-sm-inline-block visible-xs-inline-block">
                                        @for($i=1;$i<=$v['quality_score'];$i++)
                                            <span class="rec-active"></span>
                                        @endfor
                                        @for($i=1;$i<=(5-$v['quality_score']);$i++)
                                            <span></span>
                                        @endfor
                                    </div>
                                    @if($v['to_uid']!=$employ_data['employer_uid'])
                                    <div class="target-star starpd">工作态度： </div>
                                    <div class="mg-right visible-lg-inline-block visible-md-inline-block visible-sm-inline-block visible-xs-inline-block">
                                        @for($i=1;$i<=$v['attitude_score'];$i++)
                                            <span class="rec-active"></span>
                                        @endfor
                                        @for($i=1;$i<=(5-$v['attitude_score']);$i++)
                                            <span></span>
                                        @endfor
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="space-6"></div>
                        <p class="text-right cor-grayC2">评价时间：{{ date('Y-m-d',strtotime($v['created_at'])) }}</p>
                        <div class="space-4"></div>
                    </div>
                    @endforeach
                </div>
                @endif
                @if($employ_data['status']==3 && !$comment_status)
                <form action="{{ URL('employ/employEvaluate') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="employ_id" value="{{ $employ_data['id'] }}">
                <div class="gzinfo-mainup gzinfo-mainup-rated" id="comment">
                    <div class="record pd-padding0">
                        <div class="text-size14 cor-gray51 clearfix">
                            <div class="col-xs-12 task-mediaAssessR pd-padding0">
                                <p class="text-size18 cor-gray51">{{ ($role==1)?'雇主评价':'威客评价' }}</p>
                                <div class="space-10"></div>
                                <label class="evaluate-back">
                                    <input name="type" type="radio" class="ace" checked="" value=1>
                                    <span class="lbl"> <span class="flower4">好评</span></span>&nbsp;&nbsp;&nbsp;
                                </label>
                                <label class="evaluate-back">
                                    <input name="type" type="radio" class="ace" value="2">
                                    <span class="lbl"> <span class="flower5">中评</span></span>&nbsp;&nbsp;&nbsp;
                                </label>
                                <label>
                                    <input name="type" type="radio" class="ace" value="3">
                                    <span class="lbl"> <span class="flower6">差评</span></span>
                                </label>
                            </div>
                        </div>
                        <div class="space-8"></div>
                        <div class="text-size14 cor-gray51 clearfix">
                            <div class="col-xs-12 pd-padding0">
                                <textarea name="comment" id="limit" class="col-xs-12" rows="5"></textarea>
                                <div class="cor-gray51 text-right">
                                    <span class="cor-orange"><i class="fa fa-exclamation-circle"></i></span> 最多<span id="textCount">100</span>个字
                                </div>
                            </div>
                        </div>
                        <div class="star text-size14 cor-gray51 clearfix">
                            <div class="col-xs-11 task-mediaAssessR pd-padding0">
                                 <div class="target-star starpd"> {{ ($role==2)?'付款及时性':'工作速度' }}：</div>
                                 <div id="function-star1" class="target-star evaluate-back">
                                     <input type="hidden" name="speed_score" id="speed-score" value="5">
                                 </div>
                                 <div class="target-star starpd">{{ ($role==2)?'合作愉快度':'工作质量' }}： </div>
                                 <div id="function-star2" class="target-star evaluate-back">
                                     <input type="hidden" name="quality_score" id="quality-score" value="5">
                                 </div>
                                 @if($role==1)
                                 <div class="target-star starpd">工作态度： </div>
                                 <div id="function-star3" class="target-star evaluate-back">
                                     <input type="hidden" name="attitude_score" id="attitude-score" value="5">
                                 </div>
                                 @endif
                            </div>
                        </div>
                        <div class="space-6"></div>
                        <div class="clearfix text-right">
                            <button class="btn btn-primary btn-blue btn-big3 bor-radius2 rated-btn-input">提交</button>
                        </div>
                    </div>
                </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
<!--维权 模态框（Modal） -->
@if($employ_data['status']==2)
<div class="modal fade" tabindex="-1" role="dialog" id="except6" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header widget-header-flat">
                <span class="modal-title cor-gray51 text-size14 text-blod">
                    交易维权：
                </span>
                <button type="button" class="bootbox-close-button close text-size14"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                    <form action="{{ URL('employ/employRights') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $employ_data['id'] }}" />
                    <div class="space"></div>
                    <div class="clearfix">
                        <div class="form-group clearfix">
                            <label class="col-sm-3 control-label">维权类型：</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <select name="type">
                                        <option value="1">违规信息</option>
                                        <option value="2">虚假交稿</option>
                                        <option value="3">涉嫌抄袭</option>
                                        <option value="4">其他</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-3 control-label">维权原因：</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <textarea type="text" name="desc"   placeholder="请输入维权原因"  rows="3" cols="50"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix text-center">
                        <button class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2" type="submit" >确定</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" data-dismiss="modal" aria-hidden="true">取消</button>
                    </div>
                    <div class="space"></div>
                    </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
@endif
<!--验收付款 模态框（Modal） -->
@if($employ_data['status']==2 && $role=1)
<div class="modal fade" id="except5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header widget-header-flat">
                <span class="modal-title cor-gray51 text-size14 text-blod">
                    验收提示：
                </span>
                <button type="button" class="bootbox-close-button close text-size14"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="space"></div>
                <p class="cor-gray51 text-size14">请确认您是否已查看源文件，并通过验收！</p>
                <div class="space"></div>
                <a href="{{ URL('employ/acceptWork',['id'=>$employ_data['id']]) }}" class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2">确定</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button href="javascript:;" class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" data-dismiss="modal" aria-hidden="true">取消</button>
                <div class="space"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
@endif
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('datepicker','plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('Validform','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_raty','plugins/jquery/raty/jquery.raty.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('evaluate','js/doc/evaluate.js') !!}
{!! Theme::widget('editor',['plugins'=>CommonClass::getEditorInit(['insertImage'])])->render() !!}
@if($role==2 && $employ_data['status']==1)
{!! Theme::widget('fileUpload')->render() !!}
@endif
{!! Theme::asset()->container('custom-js')->usepath()->add('employ','js/doc/workin.js') !!}




