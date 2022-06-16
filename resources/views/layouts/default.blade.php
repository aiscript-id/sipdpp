<!DOCTYPE html>
<html lang="en">

@include('layouts.includes.head')

<style>
  .bg-login {
    background-image: url("{{ asset('assets/images/bg-login.jpeg') }}");
    background-size: cover;
    /* background-repeat: no-repeat; */
    background-position: center;
    height: 100vh;
    /* darken */
    /* background-color: rgba(0, 0, 0, 100); */
    /* filter: blur(10px); */
  }
</style>
<body >
  <div class="container-scroller bg-success">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0 bg-login">
        @yield('content')
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  @include('layouts.includes.script')
</body>

</html>
