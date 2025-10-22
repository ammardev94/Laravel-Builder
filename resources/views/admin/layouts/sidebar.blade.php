  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ asset('adminlte/images/llcf-white-header.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item {{ request()->is('admin/pages*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('admin/pages*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Pages
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    {{-- Pages --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.pages.index') }}" class="nav-link {{ request()->is('admin/pages') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Pages</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pages.create') }}" class="nav-link {{ request()->is('admin/pages/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add New Page</p>
                        </a>
                    </li>

                    {{-- Page Sections --}}
                    <li class="nav-item {{ request()->is('admin/pages/*/sections*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/pages/*/sections*') ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>
                                Page Sections
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.pages.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Choose Page → Sections</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Section Fields --}}
                    <li class="nav-item {{ request()->is('admin/sections/*/fields*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/sections/*/fields*') ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>
                                Section Fields
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.pages.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Choose Section → Fields</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            {{-- Logout --}}
            <li class="nav-item">
                <a href="javascript:void(0);" onclick="logout()" class="nav-link">
                    <i class="nav-icon fa fa-power-off"></i>
                    <p>Logout</p>
                </a>
            </li>

          </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <form style="display: none;" action="{{ route('admin.logout') }}" method="POST" id="logout-form">
    @csrf
    <button type="submit"></button>
  </form>