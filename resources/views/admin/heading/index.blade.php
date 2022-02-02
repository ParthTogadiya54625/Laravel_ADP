@extends('admin.layouts.master_layout')
@section('title', 'Heading')

@push('page_css')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
@endpush

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Headings</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Heading</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @can('heading-create')
            <div class="col-md-4">
                <div class="card">
                    <form id="heading-form" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Add Heading</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" />
                                <label for="heading">Heading : </label>
                                <input type="text" name="heading" id="heading" class="form-control" placeholder="Enter heading here" />
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" id="image" class="form-control" onchange="loadFile(event)" />
                            </div>
                            <div>
                                <img src="{{ asset('assets/images/no-image.jpg') }}" id="output" style="height:120px; width:120px; "/>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcan
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="page-title">List Headings</h4>
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</div>
@endsection

@push('page_script')
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

{{ $dataTable->scripts() }}

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

    $('#heading-form').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        formData.append('image', $('#image')[0].files[0] );

        if (!$("#id").val()) {
            var url = "{{ route('admin.heading.store') }}"
        } else {
            var url = "{{ route('admin.heading.update') }}"
        }
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status == 200) {
                    $(".error").remove();

                    toastr.success(response.message);
                    $('#heading-table').DataTable().ajax.reload();
                    $("#id").val("");
                    $("#heading").val("");
                    $("#image").val("");
                    $("#output").attr("src", "{{ asset('assets/images/no-image.jpg') }}")
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
                        }
                        else if(inputType == 'file')
                        {
                            $(inputSelect).closest(".form-group").append("<span class='text-danger error' >"+ value +"</span>");
                        }
                    });
                }
            }
        });
    });

    function editHeading(id, heading, image) {
        $("#id").val(id);
        $("#heading").val(heading);
        (image)? $("#output").attr("src", "{{asset('storage/headings')}}/"+image) : $("#output").attr("src", "{{ asset('assets/images/no-image.jpg') }}") ;
    }

    function deleteHeading(id) {
        var token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('admin.heading.destroy') }}",
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            )
                            $('#heading-table').DataTable().ajax.reload();
                            $("#id").val("");
                            $("#heading").val("");
                            $("#image").val("");
                            $("#output").attr("src", "{{ asset('assets/images/no-image.jpg') }}")
                        } else if(response.status == 404){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong',
                            })
                        }
                    }
                });
            }
        })
    }
</script>
@endpush
