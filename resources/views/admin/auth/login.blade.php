@extends('admin.layouts.login_layout')
@section('title','Login')

@section('content')
<div id="loginform">
    <div class="text-center pt-3 pb-3">
        <span class="db"><img src="{{ asset('assets/images/logo.png') }}" alt="logo" /></span>
    </div>
    <form action="{{ route('admin.auth.loginFormSubmit') }}" method="POST" class="form-horizontal mt-3">
        @csrf
        <div class="row pb-4">
            <div class="col-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="ti-email"></i></span>
                    </div>
                    <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" placeholder="Email" required>
                </div>
                @error('email') <span class="text-danger">{{$message}}</span> @enderror
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i class="ti-pencil"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" value="Pa$$w0rd!" required>
                </div>
                @error('password') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <button class="btn btn-success float-end text-white" type="submit">Login</button>
        </div>
        <div class="row border-top border-secondary">
            <div class="col-12">
                <div class="form-group">
                    <div class="pt-3">
                        <a href="{{ route('admin.auth.forgotPasswordForm') }}" class="btn btn-info" style="float: left;"><i class="fa fa-lock me-1"></i> Lost password?</a>
                        {{-- <a href="{{ route('auth.registrationForm') }}" class="btn btn-primary" style="float: right;"><i class="fas fa-registered"></i> Registration</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('page_script')
@endpush
