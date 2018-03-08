{{--列表--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">物品兑换码生成</h3>

<div class="well">
    <form class="form-inline search-group" role="form" action="{{ URL('manage/goods_code') }}" method="post">
        {!! csrf_field() !!}
        <div class="form-group search-list ">
            <label for="name" class="">生成兑换码长度&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="length" value="" >注：最长为30 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">生成兑换码个数</label>
            <input type="text" name="number" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">兑换码标志</label>
            <select name="code_sign">
                <option value="">请选择</option>
                @foreach($code_sign as $v)
                    <option value="{{$v['sign']}}">{{$v['describe']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">生成</button>
        </div>
        <div class="space"></div>
       
        <div class="">

        </div>
    </form>
</div>