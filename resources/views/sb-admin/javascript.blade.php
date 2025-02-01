<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

@include('sb-admin/datatable')

{{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script> --}}

<script src="{{ asset('vendor/sb-admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('vendor/sb-admin/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/sb-admin/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('vendor/sb-admin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('vendor/sb-admin/js/demo/chart-pie-demo.js') }}"></script>

<script src="{{ asset('js/script.js') }}"></script>

<script src="{{ asset('js/select2.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    new DataTable('#barang_masuk_besi_tua_table', {
        // 'bSort': false
    });
</script>
