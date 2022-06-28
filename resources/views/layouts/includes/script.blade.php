<!-- plugins:js -->
<script src="{{ asset('skydash/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('skydash/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('skydash/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('skydash/js/dataTables.select.min.js') }}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('skydash/js/off-canvas.js') }}"></script>
<script src="{{ asset('skydash/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('skydash/js/template.js') }}"></script>
<script src="{{ asset('skydash/js/settings.js') }}"></script>
<script src="{{ asset('skydash/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('skydash/js/dashboard.js') }}"></script>
<script src="{{ asset('skydash/js/Chart.roundedBarCharts.js') }}"></script>
<!-- End custom js for this page-->

{{-- toastr --}}
@jquery
@toastr_js
@toastr_render


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script type="text/javascript">
 
    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          }
        });
    });
    $(function () {
        tooltip = $('[data-toggle="tooltip"]');
        if (tooltip.length) {
            tooltip.tooltip();
        }
    })
</script>
