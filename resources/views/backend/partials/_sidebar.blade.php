<aside class="main-sidebar elevation-4 sidebar-light-teal">
  <!-- Brand Logo -->
  <a href="{{route('dashboard')}}" class="brand-link">
    <img src="{{asset('images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light" style="color:green;">|| {{session('user_name')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('images/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="javascript:void(0)" class="d-block">{{session('user_name')}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        @if(Session::get('page')=="dashboard")
          <?php $active="active"; ?>
        @else
          <?php $active=""; ?>
        @endif
        <li class="nav-item has-treeview menu-open">
          <a href="{{route('dashboard')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
        </li>

        @if(Session::get('page')=="visitor-visitors")
            <?php $active="active"; ?>
        @else
            <?php $active=""; ?>
        @endif
        @if(session('role_id') == 1)
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Visitors
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              @if(Session::get('page')=="visitor-visitors")
                  <?php $active="active"; ?>
              @else
                <?php $active=""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('all-visitor')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Visitor</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if(Session::get('page')=="forwar-visitor")
            <?php $active="active"; ?>
          @else
            <?php $active=""; ?>
          @endif
          @if(session('role_id') == 9)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Visitors
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              @if(Session::get('page')=="forwar-visitor")
                  <?php $active="active"; ?>
              @else
                <?php $active=""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('forward-visitor')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Visitor</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>