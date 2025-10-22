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

              {{-- Family --}}
              <li class="nav-item {{ request()->is('admin/families*') || request()->is('admin/family-services*') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is('admin/families*') || request()->is('admin/family-services*') ? 'active' : '' }}">
                      <i class="fa fa-users nav-icon"></i>
                      <p>
                          Family
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.families.index') }}" class="nav-link {{ request()->routeIs('admin.families.*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Families</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.family_services.index') }}" class="nav-link {{ request()->routeIs('admin.family_services.*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Services</p>
                          </a>
                      </li>
                  </ul>
              </li>

              {{-- JMC Students --}}
              <li class="nav-item {{ request()->is('admin/students*') || request()->is('admin/student-services*') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is('admin/students*') || request()->is('admin/student-services*') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-graduation-cap"></i>
                      <p>
                          JMC Students
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.students.index') }}" class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Students</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.student_services.index') }}" class="nav-link {{ request()->routeIs('admin.student_services.*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Services</p>
                          </a>
                      </li>
                  </ul>
              </li>

              {{-- Donors --}}
              <li class="nav-item">
                  <a href="{{ route('admin.donors.index') }}" class="nav-link {{ request()->routeIs('admin.donors.*') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-money-bill"></i>
                      <p>Donors</p>
                  </a>
              </li>

              {{-- Companies --}}
              <li class="nav-item">
                  <a href="{{ route('admin.companies.index') }}" class="nav-link {{ request()->routeIs('admin.companies.*') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-home"></i>
                      <p>Companies</p>
                  </a>
              </li>

              {{-- Health --}}
              <li class="nav-item">
                  <a href="{{ route('admin.health.index') }}" class="nav-link {{ request()->routeIs('admin.health.*') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-briefcase-medical"></i>
                      <p>Health</p>
                  </a>
              </li>

              {{-- Attendance --}}
              <li class="nav-item">
                  <a href="{{ route('admin.attendance.index') }}" class="nav-link {{ request()->routeIs('admin.attendance.*') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-calendar"></i>
                      <p>Attendance</p>
                  </a>
              </li>

              {{-- Spear --}}
              <li class="nav-item">
                  <a href="{{ route('admin.spear.index') }}" class="nav-link {{ request()->routeIs('admin.spear.*') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-star"></i>
                      <p>Spear</p>
                  </a>
              </li>

              {{-- VTC Students --}}
              <li class="nav-item {{ request()->is('admin/vtc-students*') || request()->is('admin/courses*') || request()->is('admin/vtc-attendance*') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is('admin/vtc-students*') || request()->is('admin/courses*') || request()->is('admin/vtc-attendance*') ? 'active' : '' }}">
                      <i class="fa fa-users nav-icon"></i>
                      <p>
                          VTC Students
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">

                      {{-- <li class="nav-item">
                          <a href="{{ route('admin.vtc_students.indexV1') }}" class="nav-link {{ request()->routeIs('admin.vtc_students.indexV1') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Students V1</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('admin.vtc_students.indexV2') }}" class="nav-link {{ request()->routeIs('admin.vtc_students.indexV2') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Students V2</p>
                          </a>
                      </li> --}}

                      <li class="nav-item">
                          <a href="{{ route('admin.vtc_students.indexV3') }}" class="nav-link {{ request()->is('admin/vtc-students*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Students</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->is('admin/courses*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Courses</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('admin.vtc_attendance.index') }}" class="nav-link {{ request()->is('admin/vtc-attendance*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Attendence</p>
                          </a>
                      </li>


                  </ul>
              </li>


              {{-- Kitchen Expenses --}}
              <li class="nav-item {{ request()->is('admin/items*') || request()->is('admin/expenses-llcf*') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is('admin/items*') || request()->is('admin/expenses-llcf*') ? 'active' : '' }}">
                      <i class="fa fa-users nav-icon"></i>
                      <p>
                          Kitchen Expenses
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">

                      <li class="nav-item">
                          <a href="{{ route('admin.items.index') }}" class="nav-link {{ request()->is('admin/items*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Items</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('admin.expenses-llcf.index') }}" class="nav-link {{ request()->is('admin/expenses-llcf*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Expence LLCF</p>
                          </a>
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