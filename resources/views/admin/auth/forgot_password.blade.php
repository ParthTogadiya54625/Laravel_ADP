@extends('admin.layouts.login_layout')
@section('title','Forgot Password')
@section('content')
<div>
    <div class="text-center pt-3 pb-3">
        <span class="db"><img src="{{ asset('assets/images/logo.png') }}" alt="logo" /></span>
    </div>
    <div class="text-center">
        <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
    </div>
    <div class="row mt-3">
        <form action="{{ route('admin.auth.forgotPasswordFormSubmit') }}" method="POST" class="col-12">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i class="ti-email"></i></span>
                </div>
                <input type="email" class="form-control form-control-lg" name="email" placeholder="Email Address" required>
            </div>
            @error('email') <span class="text-danger">{{$message}}</span> @enderror

            <div class="row mt-3 pt-3 border-top border-secondary">
                <div class="col-12">
                    <a class="btn btn-success text-white" href="{{ route('admin.auth.loginForm') }}">Back To Login</a>
                    <button class="btn btn-info float-end" type="submit" >Recover</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('page_script')
@endpush
