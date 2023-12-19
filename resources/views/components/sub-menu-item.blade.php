<li class="{{ (request()->is($classActive)) ? 'active' : '' }}">
    <a href="{{ route($route, $param) }}">{{ $menuTitle }}</a>
</li>
