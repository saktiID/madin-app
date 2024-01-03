<li class="menu {{ (request()->is($classActive)) ? 'active' : '' }}">
    <a href="{{ route($route, ['pelajaran_id' => $pelajaranId]) }}" aria-expanded="{{ (request()->is($classActive)) ? 'true' : '' }}" class="dropdown-toggle" data-toggle="{{ $dataToggle }}" data-target="{{ $dataTarget }}">
        <div>
            <i data-feather="{{ $menuIcon }}"></i>
            <span>{{ $menuTitle }}</span>
        </div>
    </a>
</li>
