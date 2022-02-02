@extends('admin.layouts.master_layout')
@section('title','Change Profile')
@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Change Profile</h4>
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
                <div class="row">
                    @if (auth()->user()->hasRole('publisher-admin'))
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div>
                                    <img id="output" style="height: 200px; width:200px; padding-left:10px;" src="@if(auth()->user()->logo){{ asset('storage/publishers/'.auth()->user()->logo)}} @else {{ asset('assets/images/no-image.jpg') }} @endif"/>
                                </div>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                    @endif
                    <div class="{{ auth()->user()->hasRole('publisher-admin')? "col-md-10" : "col-md-12" }}">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('admin.auth.dashboard') }}" class="btn btn-danger rounded-circle" style="float: right;" title="Back"> <i class="fas fa-times"></i> </a>
                            </div>
                            <form action="{{ route('admin.auth.userProfileFormSubmit') }}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>First name</label>
                                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name',auth()->user()->first_name) }}" required>
                                        @error('first_name') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name',auth()->user()->last_name) }}" required>
                                        @error('last_name') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Company</label>
                                        <input type="text" class="form-control" name="company" value="{{ old('company',auth()->user()->company) }}" required>
                                        @error('company') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email',auth()->user()->email) }}" required>
                                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone',auth()->user()->phone) }}" required>
                                        @error('phone') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ old('address',auth()->user()->address) }}" required>
                                        @error('address') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Address 2</label>
                                        <input type="text" class="form-control" name="address2" value="{{ old('address2',auth()->user()->address2) }}" required>
                                        @error('address2') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control" name="city" value="{{ old('city',auth()->user()->city) }}" required>
                                        @error('city') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" class="form-control" name="state" value="{{ old('state',auth()->user()->state) }}" required>
                                        @error('state') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Zipcode</label>
                                        <input type="text" class="form-control" name="zipcode" value="{{ old('zipcode',auth()->user()->zipcode) }}" required>
                                        @error('zipcode') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Url</label>
                                        <input type="url" class="form-control" name="url" value="{{ old('url',auth()->user()->url) }}" required>
                                        @error('url') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>

                                    @if (auth()->user()->hasRole('publisher-admin'))
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <input type="file" class="form-control" name="logo" id="logo" onchange="loadFile(event)">
                                    </div>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</div>
@endsection

@push('page_script')
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
@endpush
