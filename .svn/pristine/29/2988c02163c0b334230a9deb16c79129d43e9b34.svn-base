@foreach(Theme::get('manageMenu') as $v)
    <li class="{{ in_array($v['id'],Theme::get('menu_ids'))?'active':'' }}">
        <a href="{!! empty($v['route'])?'javaascript:;':url($v['route']) !!}" class="{!! empty($v['_child'])?'':'dropdown-toggle' !!}">
            <i class="menu-icon fa {{ (!empty(Theme::get('menuIcon')[$v['name']]))?Theme::get('menuIcon')[$v['name']]:'fa-line-chart' }}"></i>
            <span class="menu-text"> {!! $v['name'] !!} </span>
            @if(!empty($v['_child']))
            <b class="arrow fa fa-angle-down"></b>
            @endif
        </a>
        <b class="arrow"></b>
        @if(!empty($v['_child']))
        <ul class="submenu">
            @foreach($v['_child'] as $value)
            <li class="{{ in_array($value['id'],Theme::get('menu_ids'))?'active':'' }}">
                <a href="{!! (empty($value['route']) && !empty($value['_child']))?'javaascript:;':url($value['route']) !!}" class="{!! empty($value['_child'])?'':'dropdown-toggle' !!}">
                    <i class="menu-icon fa fa-caret-right"></i>
                    {{ $value['name'] }}
                    @if(!empty($value['_child']))
                        <b class="arrow fa fa-angle-down"></b>
                    @endif
                </a>
                <b class="arrow"></b>
                @if(!empty($value['_child']))
                <ul class="submenu">
                    @foreach($value['_child'] as $menus)
                    <li class="{{ in_array($menus['id'],Theme::get('menu_ids'))?'active':'' }}">
                        <a href="{!! empty($menus['route'])?'javaascript:;':url($menus['route']) !!}" >
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ $menus['name'] }}
                        </a>
                        <b class="arrow"></b>
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

