@extends('frontend.layouts.main_layout')
@section('title', 'Publisher Registration')
@push('page_css')
@endpush

@section('content')
<div class="container" style="margin-top: 1%">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('frontend.publisher.registration') }}" method="POST" id="publisher-form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>Publisher - Register</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name">First Name : </label>
                            <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}" />
                            @error('first_name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name : </label>
                            <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}" />
                            @error('last_name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="company">Company : </label>
                            <input type="text" name="company" class="form-control" value="{{old('company')}}" />
                            @error('company') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail : </label>
                            <input type="email" name="email" class="form-control" value="{{old('email')}}" />
                            @error('email') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password : </label>
                            <input type="password" name="password" class="form-control" />
                            @error('password') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Re-type Password : </label>
                            <input type="password" name="password_confirmation" class="form-control" />
                            @error('password_confirmation') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone : </label>
                            <input type="text" name="phone" class="form-control" value="{{old('phone')}}" />
                            @error('phone') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address : </label>
                            <input type="text" name="address" class="form-control" value="{{old('address')}}" />
                            @error('address') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="address2">Address Line 2 : </label>
                            <input type="text" name="address2" class="form-control" value="{{old('address2')}}" />
                            @error('address2') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="city">City : </label>
                            <input type="text" name="city" class="form-control" value="{{old('city')}}" />
                            @error('city') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="state">State : </label>
                            <input type="text" name="state" class="form-control" value="{{old('state')}}" />
                            @error('state') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="zipcode">Zipcode : </label>
                            <input type="text" name="zipcode" class="form-control" value="{{old('zipcode')}}" />
                            @error('zipcode') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="url">Url : </label>
                            <input type="url" name="url" class="form-control" value="{{old('url')}}" />
                            @error('url') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="logo">logo : </label>
                            <input type="file" name="logo" class="form-control" onchange="loadFile(event)" />
                            @error('logo') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        {{-- <br> --}}
                        <div>
                            <img src="{{ asset('assets/images/users/avatar5.png') }}" id="output" style="height:120px; width:120px; margin-top:10px; "/>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_script')
<script>
    var loadFile = function(event)
    {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function()
        {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
@endpush


