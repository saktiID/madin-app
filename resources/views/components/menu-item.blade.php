<li class="menu {{ (request()->routeIs($classActive)) ? 'active' : '' }}">
    <a href="{{ route($route) }}" aria-expanded="{{ (request()->routeIs($classActive)) ? 'true' : '' }}" class="dropdown-toggle" data-toggle="{{ $dataToggle }}" data-target="{{ $dataTarget }}">
        <div>
            <i data-feather="{{ $menuIcon }}"></i>
            <span>{{ $menuTitle }}</span>
        </div>
    </a>
</li>
