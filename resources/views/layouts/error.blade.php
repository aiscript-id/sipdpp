<!DOCTYPE html>
<html lang="en">

@include('layouts.includes.head')

<body>
    @yield('content')
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('skydash/') }}/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('skydash/') }}/js/off-canvas.js"></script>
  <script src="{{ asset('skydash/') }}/js/hoverable-collapse.js"></script>
  <script src="{{ asset('skydash/') }}/js/template.js"></script>
  <script src="{{ asset('skydash/') }}/js/settings.js"></script>
  <script src="{{ asset('skydash/') }}/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>