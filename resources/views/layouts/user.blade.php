<!DOCTYPE html>
<html lang="en">

@include('layouts.includes.head')
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <!-- partial -->
    @include('layouts.includes.topnav')
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      {{-- @include('layouts.includes.setting') --}}
      @include('layouts.includes.right-sidebar')
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item {{ Request::routeIs('user') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('user.events*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.events') }}" >
              <i class="icon-bell menu-icon"></i>
              <span class="menu-title">Event</span>
            </a>
          </li>
          <li class="nav-item d-none {{ Request::routeIs('user.surveys*') ? 'active' : '' }}">
            <a class="nav-link" href="#" >
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Survey</span>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="#" >
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Sertifikat</span>
            </a>
          </li>

          <li class="nav-item {{ Request::routeIs('user.profile') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.profile') }}" >
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('layouts.includes.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


  @include('layouts.includes.script')
  {{-- yield script --}}
  @yield('script')
</body>

</html>

