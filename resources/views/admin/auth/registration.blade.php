@extends('admin.layouts.login_layout')
@section('title','Registration')
@section('content')
<div>
    <div class="text-center pt-3 pb-3">
        <span class="db"><img src="../../assets/images/logo.png" alt="logo" /></span>
    </div>
    <!-- Form -->
    <form class="form-horizontal mt-3" action="{{ route('auth.registrationFormSubmit') }}" method="POST">
        @csrf
        <div class="row pb-4">
            <div class="col-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="ti-user"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-lg" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}" required>
                </div>
                @error('full_name') <span class="text-danger">{{$message}}</span> @enderror

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i class="ti-email"></i></span>
                    </div>
                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                </div>
                @error('email') <span class="text-danger">{{$message}}</span> @enderror

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i class="ti-pencil"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                </div>
                @error('password') <span class="text-danger">{{$message}}</span> @enderror

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info text-white h-100" id="basic-addon2"><i class="ti-pencil"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                @error('password_confirmation') <span class="text-danger">{{$message}}</span> @enderror

            </div>
            <button style="float: right;" class="btn btn-block btn-lg btn-info" type="submit">Sign Up</button>
        </div>
        <div class="row border-top border-secondary">
            <div class="col-12">
                <div class="form-group">
                    <div class="pt-3 d-grid">
                        <a href="{{ route('auth.loginForm') }}" class="btn btn-primary" style="float: left;"></i> I already have a membership</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('page_script')
@endpush
