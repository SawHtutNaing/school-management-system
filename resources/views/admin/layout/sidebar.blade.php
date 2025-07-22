 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/SRMS.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SRMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/aria.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#"
                class="d-block">{{ Auth::check() ? auth()->user()->name . ' (' . ucfirst(auth()->user()->roles->first()?->name) . ')' : 'Not Registered' }}</a>

        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="{{ url('/dashboard') }}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard

              </p>
            </a>

          </li>

          <!--teacher-->

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon  fas fa-chalkboard-teacher"></i>
              <p>
                 Manage Teacher
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.teachers.create') }}" class="nav-link">
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>Add teachers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.teachers.index') }}" class="nav-link">
                  <i class=" nav-icon fas fa-edit"></i>
                  <p>View teachers</p>
                </a>
              </li>
            </ul>
          </li>

           <!--subject-->

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon  fas fa-newspaper"></i>
              <p>
                Manage Subject
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.subjects.create')}}" class="nav-link">
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>Add Subjects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.subjects.index')}}" class="nav-link">
                  <i class=" nav-icon fas fa-edit"></i>
                  <p>View subjects</p>
                </a>
              </li>
            </ul>
          </li>

          <!--student-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon  fas fa-users"></i>
              <p>
                Manage Student
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.students.create')}}" class="nav-link">
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>Add students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.students.index')}}" class="nav-link">
                  <i class=" nav-icon fas fa-edit"></i>
                  <p>View students</p>
                </a>
              </li>
            </ul>
          </li>



          <!--results-->

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon  fas fa-address-card"></i>
              <p>
                Manage Result
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.results.create') }}" class="nav-link">
                  <i class="fa fa-link nav-icon"></i>
                  <p>Add Result</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ route('admin.results.index') }}" class="nav-link">
                  <i class=" nav-icon fa fa-table"></i>
                  <p>View Result</p>
                </a>
              </li> 
            </ul>
          </li>

          <!--logout-->
          <li >
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
  <p>
    <b>Logout</b>
    <i class="fas fa-sign-out-alt"></i>
  </p>
</a>

          </li>



        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
