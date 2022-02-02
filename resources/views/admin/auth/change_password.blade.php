@extends('admin.layouts.master_layout')
@section('title','Change Password')
@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Change Password</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.auth.dashboard') }}" class="btn btn-danger rounded-circle" style="float: right;" title="Back"> <i class="fas fa-times"></i> </a>
                    </div>
                    <form action="{{ route('admin.auth.changePasswordFormSubmit') }}" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="current_password" placeholder="Current password" value="{{ old('current_password') }}" required>
                                @error('current_password') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="New password" required>
                                @error('password') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Re-enter password" required>
                                @error('password_confirmation') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</div>
@endsection

@push('page_script')

@endpush
