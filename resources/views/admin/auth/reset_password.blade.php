@extends('admin.layouts.login_layout')
@section('title','Reset Password')
@section('content')
<div>
    <div class="text-center pt-3 pb-3">
        <span class="db"><img src="{{ asset('assets/images/logo.png') }}" alt="logo" /></span>
    </div>
    <!-- Form -->
    <form action="{{ route('admin.auth.resetPasswordFormSubmit') }}" method="POST" class="form-horizontal mt-3">
        @csrf
        <div class="row pb-4">
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="col-12">
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
            <button class="btn btn-success float-end text-white" type="submit">Reset Password</button>
        </div>
    </form>
</div>
@endsection

@push('page_script')
@endpush
