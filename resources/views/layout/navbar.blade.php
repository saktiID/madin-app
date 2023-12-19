<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="/">
                    <img src="{{ asset('storage/logo/' . $logo_madin) }}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="/" class="nav-link"> MADIN </a>
            </li>
            <li class="nav-item toggle-sidebar">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                    <i data-feather="list"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-item flex-row navbar-dropdown ml-auto">

            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="settings"></i>
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <img src="{{ asset('assets') . Auth::user()->avatar }}" class="img-fluid mr-2" alt="avatar">
                            <div class="media-body">
                                <h5>{{ Auth::user()->nama }}</h5>
                                <p>{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="#">
                            <i data-feather="user"></i> <span>Profil</span>
                        </a>
                    </div>
                    <div class="dropdown-item">
                        <a href="#" data-toggle="modal" data-target="#logoutModal">
                            <i data-feather="log-out"></i> <span>Keluar</span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
