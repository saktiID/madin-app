<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="{{ route('get-foto', ['filename' => Auth::user()->avatar]) }}" alt="avatar">
                <h6 class="">{{ Auth::user()->nama }}</h6>
                <p class="">{{ Auth::user()->role }}</p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionSidebar">

            @include('layout.menu')

        </ul>

    </nav>

</div>
