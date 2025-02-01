<!DOCTYPE html>
<html lang="en">

{{-- head --}}
@include('sb-admin/head')

<body id="page-top">


    @include('sb-admin/topnav')
    <!-- Page Wrapper -->
    <div id="wrapper" style="margin-top: 3rem">

        <!-- Sidebar -->
        @include('sb-admin/sidebar')


        <!-- Content Wrapper -->
        <div id="content-wrapper" style="background-color: #D9EDF6">
            @include('sb-admin/topbar')

            <!-- Main Content -->
            <div id="content" class="d-flex flex-column m-4 p-4 rounded bg-white" style="min-height: 85vh">

                <!-- Topbar -->


                <!-- Begin Page Content -->
                <div class="container-fluid ">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            {{-- @include('sb-admin/footer') --}}


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    @include('sb-admin/scroll-topbar')

    <!-- Logout Modal-->
    @include('sb-admin/logout-modal')

    {{-- java script --}}
    @include('sb-admin/javascript')
    @yield('javascript')
    @include('sb-admin/notifications-js')



</body>

</html>
