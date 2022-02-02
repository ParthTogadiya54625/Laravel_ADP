@extends('frontend.layouts.main_layout')
@section('title', 'Select Heading')
@push('page_css')
{{-- select2 css --}}
<link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}"/>
@endpush

@section('content')
<div class="container" style="margin-top: 1%">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Select YPH(Headings) Category
                        <a href="{{ route('frontend.business.index') }}" class="btn btn-danger float-end" title="Business Listing Page"><i class="far fa-times-circle"></i></a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- {{$business}} --}}
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Business Name : </th>
                                        <td>{{$business->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>E-mail : </th>
                                        <td>{{$business->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address : </th>
                                        <td>{{$business->address}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address2 : </th>
                                        <td>{{$business->address2}}</td>
                                    </tr>
                                    <tr>
                                        <th>City : </th>
                                        <td>{{$business->city}}</td>
                                    </tr>
                                    <tr>
                                        <th>State : </th>
                                        <td>{{$business->state}}</td>
                                    </tr>
                                    <tr>
                                        <th>Zipcode : </th>
                                        <td>{{$business->zipcode}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone : </th>
                                        <td>{{$business->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>Url : </th>
                                        <td><a href="{{$business->url}}">{{$business->url}}</a></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <td><a href="{{ route('frontend.business.edit', ['id'=>$business->id]) }}" class="btn btn-primary">EDIT</a></td>
                                </tfoot>
                            </table>
                            {{-- {{$business}} --}}
                        </div>
                        <div class="col-md-6">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.252990426465!2d72.83605531533429!3d21.221814186534466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04ee86be2bb45%3A0xaab551d0c89f3da3!2sCirkle%20Studio%20Pvt.%20Ltd.!5e0!3m2!1sen!2sin!4v1641277340664!5m2!1sen!2sin" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <h1 style="text-align: center">Select YPH Category</h1>
            <form id="select_heading_form">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="business_id" id="business_id" value="{{$business->id}}">
                    <label for="heading">Select Heading : </label>
                    <select id="heading" class="heading form-control" name="heading[]" multiple>
                        @foreach ($business->headings as $heading)
                            <option value="{{$heading->id}}" selected>{{$heading->name}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <button class="btn btn-success" id="assignKeywords" disabled>Assign</button>
                </div>
            </form>
            <hr>
            <h1 style="text-align: center">Image & Keyword Assignment</h1>
            <table id="assign_image">
                @foreach ($business->headings as $heading)
                    <tr>
                        <th>{{$heading->name}}</th>
                        <td>
                            <a href='{{ route("frontend.business.assignImageKeyword", ["business_id"=>$business->id])}}?heading_id={{$heading->id}}' class="btn btn-primary">Assign Image</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <hr>

        </div>
    </div>
</div>
@endsection

@push('page_script')
{{-- select2 js --}}
<script src="{{ asset('assets\libs\select2\dist\js\select2.min.js') }}"></script>

<script>
    $(document).ready(function () {
        if ($('.heading').val().length != 0)
            $("#assignKeywords").removeAttr("disabled");
        else
            $("#assignKeywords").prop("disabled",true);
    });

    $(".heading").select2({
        multiple: true,
        ajax: {
            url: "{{ route('frontend.business.getHeadings') }}",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term,
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true,
        }
    });

    $('.heading').change(function (e) {
        e.preventDefault();
        if ($('.heading').val().length != 0)
            $("#assignKeywords").removeAttr("disabled");
        else
            $("#assignKeywords").prop("disabled",true);
    });

    $('#select_heading_form').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: '{{route("frontend.business.assignHeadings")}}',
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response) {
                if (response.status == 200) {
                    $("#assign_image").html("");
                    $.each(response.data, function (indexInArray, valueOfElement) {
                        var route = `{{route("frontend.business.assignImageKeyword",["business_id"=>$business->id])}}?heading_id=`+valueOfElement.id;
                        // console.log(route);
                        var html = `<tr><th>${valueOfElement.name}</th><td><a href="${route}" class="btn btn-primary">Assign Image</a></td></tr>`;
                        $("#assign_image").append(html);
                    });
                } else {
                    toastr.error("Opps, something went wrong");
                }
            },
            error: function(response) {
                var error = response.responseJSON.errors;
                var status = response.status;
                toastr.error(response.responseJSON.message);

                if (status == 422) {
                    $.each(error, function(key, value) {
                        var inputSelect = $("[name=" + key + "]");
                        var inputType = inputSelect.attr('type');

                        if (inputType == 'text') {
                            $(inputSelect).closest(".form-group").append(
                                "<span class='text-danger' >" + value + "</span>");
                        }
                        else if(inputType == 'file')
                        {
                            $(inputSelect).closest(".form-group").append("<span class='text-danger' >"+ value +"</span>");
                        }
                    });
                }
            }
        });
    });

</script>
@endpush


