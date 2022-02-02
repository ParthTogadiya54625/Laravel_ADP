@extends('frontend.layouts.main_layout')
@section('title', 'Business Create')
@push('page_css')
<style>
    #map{
        height: 50%;
        width: 100%;
    }
</style>
@endpush

@section('content')
<div class="container" style="padding-top: 1%">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('frontend.business.store') }}" method="POST" id="business-form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>Add Listing
                            <a href="{{ route('frontend.business.index') }}" class="btn btn-danger float-end"><i class="far fa-times-circle"></i></a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Business Name : </label>
                            <input type="text" name="name" class="form-control" placeholder="Business name" value="{{old('name')}}" />
                            @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address : </label>
                            <input type="text" name="address" class="form-control" placeholder="Address" value="{{old('address')}}" />
                            @error('address') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="address2">Address Line 2 : </label>
                            <input type="text" name="address2" class="form-control" placeholder="Address Line 2" value="{{old('address2')}}" />
                            @error('address2') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="city">City : </label>
                            <input type="text" name="city" class="form-control" placeholder="City" value="{{old('city')}}" />
                            @error('city') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="state">State : </label>
                            <input type="text" name="state" class="form-control" placeholder="State" value="{{old('state')}}" />
                            @error('state') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="zipcode">Zipcode : </label>
                            <input type="text" name="zipcode" class="form-control" placeholder="Zipcode" value="{{old('zipcode')}}" />
                            @error('zipcode') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone : </label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{old('phone')}}" />
                            @error('phone') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="url">Url : </label>
                            <input type="url" name="url" class="form-control" placeholder="Url" value="{{old('url')}}" />
                            @error('url') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail : </label>
                            <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{old('email')}}" />
                            @error('email') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo : </label>
                            <input type="file" name="logo" class="form-control" onchange="loadFile(event)" />
                            @error('logo') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div>
                            <img src="{{ asset('assets/images/no-image.jpg') }}" id="output" style="height:120px; width:120px; margin-top: 10px"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Capture</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div id="map"></div>
        </div>
    </div>
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


