<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Frontend-@yield('title')</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/fontawesome-free/css/all.min.css') }}"/>
    {{-- bootstrape --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    {{-- toaster --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.min.css') }}" />
    {{-- sweetalert2 css --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" />

    @stack('page_css')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">ADP - Direct Data</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('frontend.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('frontend.business.index') }}">Business</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.publisher.register') }}">Publisher-Registration</a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link" href="{{ route('frontend.generatePDF') }}">Generate-PDF</a> --}}
                </li>
            </ul>
            <a href="{{ route('frontend.logout') }}" class="btn btn-danger float-end">Logout</a>
        </div>
    </nav>
    @yield('content')

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- bootstrape --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- toaster --}}
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    {{-- sweetalert2 js --}}
    <script src="{{ asset('assets\libs\sweetalert2\sweetalert2.all.min.js') }}"></script>

    @if (Session::get('success'))
        <script>
            toastr.success("{!! Session::get('success') !!}");
        </script>
    @endif
    @if (Session::get('error'))
        <script>
            toastr.error("{!! Session::get('error') !!}");
        </script>
    @endif

    @stack('page_script')
</body>

</html>
