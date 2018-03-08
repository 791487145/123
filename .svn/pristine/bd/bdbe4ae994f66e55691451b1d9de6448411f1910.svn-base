<div class="g-main clearfix">
    <h4 class="text-size16 cor-blue u-title">技能标签</h4>
    <div class="space-16"></div>
    <p class="cor-gray97">选择一下您的标签吧，可输入选择哦！最多设置三个标签</p>
    <div class="space-10"></div>
    <form action="{{ URL('user/skillSave') }}" method="post" />
        <input type="hidden" name="tags" id="tags" value=""/>
        {!! csrf_field() !!}
        <div>
            <select multiple="" class="chosen-select tag-input-style" id="form-field-select-4" data-placeholder="请选择标签...">
                @foreach($hotTag as $v)
                    <option value="{{ $v['id'] }}" {{ in_array($v['id'],$tags)?'selected':'' }} >{{ $v['tag_name'] }}</option>
                @endforeach
            </select>
            {!! $errors->first('tags_name') !!}
        </div>
        <div class="space-30"></div>
        <div>
            <button href="javascript:;" class="btn btn-primary btn-big btn-blue bor-radius2 btn-sm btn-imp" type="submit">保存</button>
        </div>
    </form>
</div>
{!! Theme::widget('popup')->render() !!}

{!! Theme::asset()->container('specific-css')->usepath()->add('chosen','plugins/ace/css/chosen.css') !!}

{!! Theme::asset()->container('specific-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ace-extra','plugins/ace/js/ace-extra.min.js') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('chosen','plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ace-elements','plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ace.min','plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('paypassword','js/doc/skill.js') !!}
{!! Theme::widget('avatar')->render() !!}