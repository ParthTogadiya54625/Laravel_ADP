@extends('frontend.layouts.main_layout')
@section('title', 'Select Image&Keywords')

@push('page_css')
{{-- select2 css --}}
<link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}"/>

<style>
    #assign_keyword td{
        border: 1px solid #dddddd;
    }
</style>
@endpush

@section('content')
    <div class="container" style="margin-top: 1%">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Select Image & Keywords
                            <a href="{{ route('frontend.business.selectHeading',['id'=>$business->id]) }}" class="btn btn-danger float-end" title="Business Listing Page"><i class="far fa-times-circle"></i></a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
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
                </div> <br>

                <h1 style="text-align: center; color:red;">YELLOW PAGES IMAGES ASSIGNMENT</h1> <hr>
                <table class="table table-hovered">
                    <tr>
                        <th>{{$heading->name}}</th>
                        <td>
                            <form id="upload_image" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="business_id" id="business_id" value="{{$business->id}}">
                                <input type="hidden" name="heading_id" id="heading_id" value="{{$heading->id}}">
                                <div class="form-group">
                                    <input type="file" id="image" name="image" class="form-control" onchange="loadFile(event)">
                                </div>
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <img src="{{($pivot->image) ? asset('storage/headings').'/'.$pivot->image : asset('storage/headings').'/'.$heading->image }}" id="output" style="height:120px; width:150px; "/>
                        </td>
                    </tr>
                </table>

                <h1 style="text-align: center; color:red;">YELLOW PAGES KEYWORD/KEY PHRASE ASSIGNMENT</h1> <hr>
                <table id="assign_keyword" class="table table-hovered" style="border: ">
                    <tr>
                        <form id="additional_keywords">
                            @csrf
                            <td colspan="2">
                                <div class="form-group">
                                    <label for="additional_keyword">Add New Keywork/KeyPhrase</label>
                                    <input type="hidden" name="business_id" id="business_id" value="{{$business->id}}">
                                    <input type="hidden" name="heading_id" id="heading_id" value="{{$heading->id}}">
                                    <input type="text" name="additional_keyword" id="additional_keyword" class="form-control">
                                </div>
                                <div class="form-group">
                                    <br>
                                    <button class="btn btn-primary" type="submit">Add</button>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <td>
                            <h3>Offered keywords</h3>
                            <ol type="1" id="offered_keyword_list">
                                @foreach ($offeredKeywords as $offeredkeyword)
                                <li>{{$offeredkeyword->name}}</li>
                                @endforeach
                            </ol>
                        </td>
                        <td>
                            <h3>Additional Keywords</h3>
                            <ol type="1" id="additional_keyword_list">
                                @foreach ($additionalKeywords as $additionalkeyword)
                                <li>{{$additionalkeyword->name}}
                                    <span onclick="removeAdditionalKeyword({{$additionalkeyword->id}})" id="{{$additionalkeyword->id}}">
                                        <i class="far fa-times-circle"></i>
                                    </span>
                                </li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('page_script')
{{-- select2 js --}}
<script src="{{ asset('assets\libs\select2\dist\js\select2.min.js') }}"></script>

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    $('#upload_image').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        formData.append('image', $('#image')[0].files[0] );

        $.ajax({
            url: '{{route("frontend.business.uploadImage")}}',
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status == 200) {
                    $(".error").remove();
                    $("#image").val("");
                    $("#output").attr("src", "{{asset('storage/headings')}}/"+response.image)
                } else {
                    toastr.error("Opps, something went wrong");
                }
            },
            error: function(response) {
                var error = response.responseJSON.errors;
                var status = response.status;
                toastr.error(response.responseJSON.message);

                if (status == 422) {
                    $(".error").remove();
                    $.each(error, function(key, value) {
                        var inputSelect = $("[name=" + key + "]");
                        var inputType = inputSelect.attr('type');

                        if(inputType == 'file')
                        {
                            $(inputSelect).closest(".form-group").append("<span class='text-danger error' >"+ value +"</span>");
                            // $(inputSelect).closest(".form-group").append("<span class='text-danger' >"+ value +"</span>");
                        }
                    });
                }
            }
        });
    });

    $('#additional_keywords').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: '{{route("frontend.business.storeAdditionalKeyword")}}',
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response) {
                if (response.status == 200) {
                    $(".error").remove();
                    $("#additional_keyword").val("");
                    var html = `<li>${response.data.name} <span onclick="removeAdditionalKeyword(${response.data.id})" id="${response.data.id}" ><i class="far fa-times-circle"></i></span></li>`;
                    $('#additional_keyword_list').append(html);
                } else {
                    toastr.error("Opps, something went wrong");
                }
            },
            error: function(response) {
                var error = response.responseJSON.errors;
                var status = response.status;
                toastr.error(response.responseJSON.message);

                if (status == 422) {
                    $(".error").remove();
                    $.each(error, function(key, value) {
                        var inputSelect = $("[name=" + key + "]");
                        var inputType = inputSelect.attr('type');

                        if (inputType == 'text') {
                            $(inputSelect).closest(".form-group").append("<span class='text-danger error' >" + value + "</span>");
                            // $(inputSelect).append("<span class='text-danger' >" + value + "</span>");
                        }
                    });
                }
            }
        });
    });

    function removeAdditionalKeyword(id){
        var business_id = '{{$business->id}}';
        var heading_id = '{{$heading->id}}';
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "{{ route('frontend.business.destroyAdditionalKeyword') }}",
            type: 'DELETE',
            data: {
                "keyword_id": id,
                "business_id": business_id,
                "heading_id": heading_id,
                "_token": token,
            },
            success: function(response) {
                if (response.status == 200) {
                    $("#"+id).parent('li').remove();
                }
            }
        });
    }
</script>
@endpush


