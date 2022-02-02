@extends('admin.layouts.master_layout')
@section('title','Role Create')

@push('page_css')
<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 30px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 22px;
      width: 18px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(22px);
      -ms-transform: translateX(22px);
      transform: translateX(22px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>
@endpush

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">New Role</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role</li>
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
                        <a href="{{ route('admin.role.index') }}" class="btn btn-danger rounded-circle" style="float: right;" title="Back"> <i class="fas fa-times"></i> </a>
                    </div>
                    <form action="{{ route('admin.role.store') }}" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" class="form-control" name="name" placeholder="Role name" value="{{ old('name') }}" required>
                                @error('name') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for=""> Permission</label>
                                    @foreach ($allPermissions as $permission)
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label for="{{$permission->id}}" style="align-self: right">{{ ucwords(str_replace("-", " ", $permission->name)) }} :  </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <label class="switch">
                                                        <input type="checkbox" id="{{$permission->id}}" name="permissions[]" value="{{$permission->name}}">
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('permissions') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
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
