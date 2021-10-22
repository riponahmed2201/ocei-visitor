<aside class="main-sidebar elevation-4 sidebar-light-teal">
  <a href="#" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 240px; object-fit: cover;">
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="mt-5 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('images/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="javascript:void(0)" class="d-block">{{session('name')}}</a>
      </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
          <a href="{{route('dashboard')}}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @if(session('role_id') == 1)
        <li class="nav-item has-treeview">
            <a href="{{route('all-visitor')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                All Visitor
              </p>
            </a>
          </li>
        @endif
       <li class="nav-item has-treeview {{ request()->is('appointment/*') ? ' menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('appointment/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-search"></i>
            <p>
              Appointment
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="{{route('appointment.list')}}" class="nav-link {{ request()->is('list') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Appointment</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
        <a href="{{route('official.list')}}" class="nav-link {{ request()->is('official/list') ? 'active' : '' }}">
          <i class="nav-icon fa fa-user-secret"></i>
          <p>
            Officials
          </p>
        </a>
       </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>