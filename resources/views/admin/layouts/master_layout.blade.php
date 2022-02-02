<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- Tell the browser to be responsive to screen width --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin-@yield('title')</title>

    {{-- Favicon icon --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/fontawesome-free/css/all.min.css') }}"/>
    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/dist/css/bootstrap.min.css') }}"/>
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}">
    {{-- toastr css --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.min.css') }}"/>
    {{-- datatable css --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/libs/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"/> --}}
    {{-- select2 css --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}"/>
    {{-- sweetalert2 css --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}"/>

    @stack('page_css')
</head>

<body>
    {{-- Preloader - style you can find in spinners.css --}}
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    {{-- Main wrapper - style you can find in pages.scss --}}
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        {{-- Topbar header - style you can find in pages.scss --}}
        @include('admin.layouts.header')
        {{-- End Topbar header --}}

        {{-- Left Sidebar - style you can find in sidebar.scss  --}}
        @include('admin.layouts.leftsidebar')
        {{-- End Left Sidebar - style you can find in sidebar.scss  --}}

        {{-- Page wrapper  --}}
        @yield('content')
        {{-- End Page wrapper  --}}
    </div>
    {{-- End Wrapper --}}

    {{-- All Jquery --}}
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    {{-- Bootstrap tether Core JavaScript --}}
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script> --}}
    <script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
    {{--Wave Effects --}}
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    {{--Menu sidebar --}}
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    {{--Custom JavaScript --}}
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    {{--This page JavaScript --}}
    {{-- <script src="{{ asset('dist/js/pages/dashboards/dashboard1.js') }}"></script>  --}}
    {{-- Charts js Files --}}
    {{-- <script src="{{ asset('assets/libs/flot/excanvas.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/jquery.flot.crosshair.js') }}"></script>
    <script src="{{ asset('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script> --}}
    {{-- toastr js --}}
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    {{-- datatable cdn --}}
    {{-- <script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/libs/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}
    {{-- select2 js --}}
    <script src="{{ asset('assets\libs\select2\dist\js\select2.min.js') }}"></script>
    {{-- sweetalert2 js --}}
    <script src="{{ asset('assets\libs\sweetalert2\sweetalert2.all.min.js') }}"></script>

    @if(Session::get('success'))
    <script>
        toastr.success("{!! Session::get('success') !!}");
    </script>
    @endif

    @if(Session::get('error'))
        <script>
            toastr.error("{!! Session::get('error') !!}");
        </script>
    @endif

    @stack('page_script')
</body>

</html>
