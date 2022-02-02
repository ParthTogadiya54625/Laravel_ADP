@extends('admin.layouts.master_layout')
@section('title','User Edit')

@push('page_css')
@endpush

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Edit User</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            @if(auth()->user()->hasRole('super-admin'))
                                <li class="breadcrumb-item"><a href={{route('admin.publisher.index')}}>Publisher</a></li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">User</li>
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
                        <h4 style="display: inline">Publisher : <strong style="color: #DA542E"> {{$publisher->full_name}}</strong></h4>

                        <a href="{{ route('admin.user.index',['id'=>$publisher->id]) }}" class="btn btn-danger rounded-circle" style="float: right;" title="Back"> <i class="fas fa-times"></i> </a>
                    </div>
                    <form action="{{ route('admin.user.update') }}" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="first_name">First Name : </label>
                                <input type="hidden" id="id" name="id" value="{{ $user->id }}" />
                                <input type="hidden" id="publisher_id" name="publisher_id" value="{{ $publisher->id }}" />
                                <input type="text" name="first_name" class="form-control" value="{{old('first_name', $user->first_name)}}" />
								@error('first_name') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name : </label>
                                <input type="text" name="last_name" class="form-control" value="{{old('last_name', $user->last_name)}}" />
								@error('last_name') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for="company">Company : </label>
                                <input type="text" name="company" class="form-control" value="{{old('company', $user->company)}}" />
								@error('company') <span class="text-danger">{{$message}}</span> @enderror
                            </div> --}}
                            <div class="form-group">
                                <label for="email">E-mail : </label>
                                <input type="email" name="email" class="form-control" value="{{old('email', $user->email)}}" />
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
                                <input type="text" name="phone" class="form-control" value="{{old('phone', $user->phone)}}" />
								@error('phone') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address : </label>
                                <input type="text" name="address" class="form-control" value="{{old('address', $user->address)}}" />
								@error('address') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="address2">Address Line 2 : </label>
                                <input type="text" name="address2" class="form-control" value="{{old('address2', $user->address2)}}" />
								@error('address2') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="city">City : </label>
                                <input type="text" name="city" class="form-control" value="{{old('city', $user->city)}}" />
								@error('city') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="state">State : </label>
                                <input type="text" name="state" class="form-control" value="{{old('state', $user->state)}}" />
								@error('state') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="zipcode">Zipcode : </label>
                                <input type="text" name="zipcode" class="form-control" value="{{old('zipcode', $user->zipcode)}}" />
								@error('zipcode') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="Status">Status : </label>
                                <select name="status" id="status" class="form-control">
                                    <option value="{{config('constants.user.status_code.active')}}" {{ old('status',$user->status)== '1' ? 'selected' : '' }}>Active</option>
                                    <option value="{{config('constants.user.status_code.inactive')}}" {{ old('status', $user->status)== '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
								@error('status') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for="url">Url : </label>
                                <input type="url" name="url" class="form-control" value="{{old('url', $user->url)}}" />
								@error('url') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo : </label>
                                <input type="file" name="logo" class="form-control" onchange="loadFile(event)" />
								@error('logo') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div>
                                <img src="@if($publisher->logo) {{ asset('/storage/publishers/'.$publisher->logo) }} @else {{ asset('assets/images/users/avatar5.png') }} @endif" id="output" style="height:120px; width:120px; "/>
                            </div> --}}
                        </div>
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
