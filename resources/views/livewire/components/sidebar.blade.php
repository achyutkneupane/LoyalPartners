<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="text-center brand-link">
    <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? "active" : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Home
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? "active" : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Profile
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('properties') }}" class="nav-link {{ request()->routeIs('properties') ? "active" : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Properties
                    </p>
                    </a>
                </li>
                @role('director')
                <li class="nav-item {{ request()->routeIs('tetants.all') || request()->routeIs('households.all') || request()->routeIs('unverified.all') ? "menu-open" : 'menu-close' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('tetants.all') || request()->routeIs('households.all') || request()->routeIs('unverified.all') ? "active" : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tetants.all') }}" class="nav-link {{ request()->routeIs('tetants.all') ? "active" : '' }}">
                                <i class="fas fa-people-carry nav-icon"></i>
                                <p>Tenants</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('households.all') }}" class="nav-link {{ request()->routeIs('households.all') ? "active" : '' }}">
                                <i class="fas fa-home nav-icon"></i>
                                <p>Households</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('unverified.all') }}" class="nav-link {{ request()->routeIs('unverified.all') ? "active" : '' }}">
                                <i class="fas fa-user-times nav-icon"></i>
                                <p>Unverified</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
  </aside>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
  {{-- For dropdown sidebar --}}
  {{-- 
  <li class="nav-item menu-open">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Home
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Active Page</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inactive Page</p>
            </a>
        </li>
    </ul>
  </li>
  --}}