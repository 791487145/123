
                    <div class="widget-header mg-bottom20 mg-top12 widget-well">
                        <div class="widget-toolbar no-border pull-left no-padding">
                            <ul class="nav nav-tabs">
                                <li class="">
                                    <a  href="/manage/categoryList/{!! $upID !!}">文章分类</a>
                                </li>

                                <li class="active">
                                    <a  href="/manage/categoryAdd/{!! $upID !!}">分类新建</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <form class="form-horizontal" action="/manage/categoryAdd" method="post">
                        {{ csrf_field() }}
                        <div class="g-backrealdetails clearfix bor-border interface">
                            <div class="space-8 col-xs-12"></div>
                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 text-right">父类</label>
                                <label class="text-left col-sm-9">
                                    <input type="hidden" name="upID" id="upID" value="{!! $upID !!}">
                                    {!! $catName !!}
                                </label>
                            </div>
                            <div class="form-group interface-bottom col-xs-12">
                                <lebel class="col-sm-1 text-right">分类名称</lebel>
                                <div class="text-left col-sm-9">
                                    <input type="text" name="catName" id="catName" value="">
                                    {{ $errors->first('catName') }}
                                </div>
                            </div>
                            <div class="interface-bottom col-xs-12">
                                <label class="col-sm-1 text-right">排序</label>
                                <div class="text-left col-sm-9">
                                    <input type="text" name="displayOrder" id="displayOrder" value="">
                                    {{ $errors->first('displayOrder') }}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="clearfix row bg-backf5 padding20 mg-margin12">
                                    <div class="col-xs-12">
                                        <div class="col-sm-1 text-right"></div>
                                        <div class="col-sm-10"><button type="submit" class="btn btn-sm btn-primary">提交</button></div>
                                    </div>
                                </div>
                            </div>
                            {{--<div>
                                <label class="text-right col-sm-3"></label>
                                <div class="text-left col-sm-9">
                                    <button class="btn btn-primary btn-sm" type="submit">提交</button>
                                </div>
                            </div>--}}
                        </div>
                    </form>
<!-- basic scripts -->
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}