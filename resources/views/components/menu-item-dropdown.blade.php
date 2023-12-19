<li class="menu {{ (request()->is($classActive)) ? 'active' : '' }}">
    <a href="#{{ $menuId }}" data-toggle="collapse" aria-expanded="{{ (request()->is($classActive)) ? 'true' : 'false' }}" class="dropdown-toggle">
        <div>
            <i data-feather="{{ $menuIcon }}"></i>
            <span>{{ $menuTitle }}</span>
        </div>
        <div>
            <i data-feather="chevron-right"></i>
        </div>
    </a>
    <ul class="collapse submenu list-unstyled {{ (request()->is($classActive)) ? 'collapse show' : '' }}" id="{{ $menuId }}" data-parent="#accordionSidebar">

        {{ $slot }}

    </ul>
</li>
