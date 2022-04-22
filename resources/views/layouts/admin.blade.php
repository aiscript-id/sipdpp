<!DOCTYPE html>
<html lang="en">

@include('layouts.includes.head')
@stack('styles')
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
          <li class="nav-item {{ Request::routeIs('admin') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item {{ Request::routeIs('users.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}" >
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User</span>
            </a>
          </li>
          <li class="nav-item {{ Request::routeIs('events.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('events.index') }}" >
              <i class="icon-bell menu-icon"></i>
              <span class="menu-title">Event</span>
            </a>
          </li>
          <li class="nav-item {{ Request::routeIs('surveys.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('surveys.index') }}" >
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Survey</span>
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
  @stack('scripts')
</body>

</html>

