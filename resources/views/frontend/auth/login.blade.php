<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Frontend- Login</title>

    {{-- bootstrape --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    {{-- toaster --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.min.css') }}" />
</head>
<body>
    <div class="container" style="margin-top:15%">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <form action="{{ route('frontend.login_post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h3> Login </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required />
                                @error('email') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" value="Pa$$w0rd!" required />
                                @error('password') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- bootstrape --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- toaster --}}
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>

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
</body>
</html>
