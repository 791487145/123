
                    <div class="widget-header mg-bottom20 mg-top12 widget-well">
                        <div class="widget-toolbar no-border pull-left no-padding">
                            <ul class="nav nav-tabs">
                                <li class="">
                                    <a  href="/manage/categoryList/{!! $upID !!}">文章分类</a>
                                </li>

                                <li class="active">
                                    <a  href="/manage/categoryEdit/{!! $catID !!}/{!! $upID !!}">分类编辑</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                                            <form class="form-horizontal" action="/manage/categoryEdit" method="post">
                                                {{ csrf_field() }}
                                                <div class="g-backrealdetails clearfix bor-border interface">
                                                    <div class="space-8 col-xs-12"></div>
                                                    <div class="form-group interface-bottom col-xs-12">
                                                        <label class="col-sm-1 text-right">父类：</label>
                                                        <div class="text-left col-sm-9">
                                                            <select name="upID">
                                                                <option value="{!! $upID !!}">@if($upID == 1)资讯中心@elseif($upID == 3)页脚配置@endif</option>
                                                                @foreach($upIDs as $items)
                                                                    <option value="{{ $items['id'] }}" @if((isset($upID) && $upID == $items['id'])) selected="selected"@endif>
                                                                        {{ str_repeat("&nbsp;&nbsp;", $items['level']).str_repeat('--', $items['level']).$items['cate_name'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group interface-bottom col-xs-12">
                                                        <label class="col-sm-1 text-right">分类名称：</label>
                                                        <div class="text-left col-sm-9">
                                                            <input type="hidden" name="catID" id="catID" value="{!! $catID !!}">
                                                            <input type="text" name="catName" id="catName" value="{!! $catName !!}">
                                                            {{ $errors->first('catName') }}
                                                        </div>
                                                    </div>
                                                    <div class=" interface-bottom col-xs-12">
                                                        <label class="col-sm-1 text-right">排序：</label>
                                                        <div class="text-left col-sm-9">
                                                            <input type="text" name="displayOrder" id="displayOrder" value="{!! $displayOrder !!}">
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
                                                   {{-- <div>
                                                        <td class="text-right col-sm-3"></td>
                                                        <td class="text-left col-sm-9">
                                                            <button class="btn btn-primary btn-sm" type="submit">提交</button>
                                                        </td>
                                                    </div>--}}
                                                </div>
                                            </form>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
