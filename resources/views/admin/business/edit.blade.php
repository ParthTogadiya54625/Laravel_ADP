@extends('admin.layouts.master_layout')
@section('title','Business Edit')

@push('page_css')
<style>
    #map{
        height: 50%;
        width: 100%;
    }
</style>
@endpush

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Edit Business</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Business</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.business.index') }}" class="btn btn-danger rounded-circle" style="float: right;" title="Back"> <i class="fas fa-times"></i> </a>
                    </div>
                    <form action="{{ route('admin.business.update') }}" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Business Name : </label>
                                <input type="hidden" name="id" value="{{ $business->id }}">
                                <input type="text" name="name" class="form-control" placeholder="Business name" value="{{old('name', $business->name)}}" />
								@error('name') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address : </label>
                                <input type="text" name="address" class="form-control" placeholder="Address" value="{{old('address', $business->address)}}" />
								@error('address') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="address2">Address Line 2 : </label>
                                <input type="text" name="address2" class="form-control" placeholder="Address Line 2" value="{{old('address2', $business->address2)}}" />
								@error('address2') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="city">City : </label>
                                <input type="text" name="city" class="form-control" placeholder="City" value="{{old('city', $business->city)}}" />
								@error('city') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="state">State : </label>
                                <input type="text" name="state" class="form-control" placeholder="State" value="{{old('state', $business->state)}}" />
								@error('state') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="zipcode">Zipcode : </label>
                                <input type="text" name="zipcode" class="form-control" placeholder="Zipcode" value="{{old('zipcode', $business->zipcode)}}" />
								@error('zipcode') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone : </label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{old('phone', $business->phone)}}" />
								@error('phone') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="url">Url : </label>
                                <input type="url" name="url" class="form-control" placeholder="Url" value="{{old('url', $business->url)}}" />
								@error('url') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail : </label>
                                <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{old('email', $business->email)}}" />
								@error('email') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo : </label>
                                <input type="file" name="logo" class="form-control" onchange="loadFile(event)" />
								@error('logo') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div>
                                <img src="@if($business->logo) {{ asset('/storage/business/'.$business->logo) }} @else {{ asset('assets/images/no-image.jpg') }} @endif" id="output" style="height:120px; width:120px; "/>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div id="map"></div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</div>
@endsection

@push('page_script')
<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap&libraries=places&v=weekly&channel=2" async></script>

<script>
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 21.17,
                lng: 72.83
            },
            zoom: 13,
        });
    }

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
