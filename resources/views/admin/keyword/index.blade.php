@extends('admin.layouts.master_layout')
@section('title', 'Keywords')

@push('page_css')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
@endpush

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 style="display: inline">Heading : <strong style="color: #DA542E"> {{$heading->name}} </strong></h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href={{route('admin.heading.index')}}>Heading</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Keyword</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @can('keyword-list')
            <div class="col-md-2">
                <div class="card">
                    <form id="keyword-form">
                        @csrf
                        <div class="card-header">
                            <h4>Add Keyword</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" />
                                <input type="hidden" name="heading_id" id="heading_id" value="{{ $heading->id }}" />
                                <input type="hidden" name="super_admin_user_id" id="super_admin_user_id" value="{{ auth()->user()->id }}" />
                                <label for="keyword">Keyword : </label>
                                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Enter your keyword here" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcan
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-danger btn-sm rounded-circle" id="multiple-delete" title="Delete Multiple"><i class="far fa-trash-alt"></i></button>
                        <h4 class="page-title float-end">List Keyword</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="keyword-table">
                            <thead>
                                <tr>
                                    <th style="width:0px;">
                                        <div class="form-check mr-sm-2">
                                            <input type="checkbox" class="form-check-input check-uncheck-all" style="margin-left: -21px;">
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>Keyword</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-danger btn-sm rounded-circle" id="multiple-delete-user-keyword" title="Delete Multiple"><i class="far fa-trash-alt"></i></button>

                        <h4 class="page-title float-end">User-added Keywords</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="keyword-user-table">
                            <thead>
                                <tr>
                                    <th style="width:0px;">
                                        <div class="form-check mr-sm-2">
                                            <input type="checkbox" class="form-check-input check-uncheck-all-user-keyword" style="margin-left: -21px;">
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>Keyword</th>
                                    <th>User Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
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

<script>
    $('#keyword-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.keyword.index',['heading_id'=>$heading->id]) }}",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'DT_RowIndex', name: '#', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    var table = $('#keyword-user-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.keyword.list',['heading_id'=>$heading->id]) }}",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'DT_RowIndex', name: '#', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'user_name', name: 'user_name' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    $('#keyword-form').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        if (!$("#id").val()) {
            var url = "{{ route('admin.keyword.store') }}"
        } else {
            var url = "{{ route('admin.keyword.update') }}"
        }
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $(".error").remove();
                if (response.status == 200) {
                    toastr.success(response.message);
                    $('#keyword-table').DataTable().ajax.reload();
                    $("#id").val("");
                    $("#keyword").val("");
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
                            $(inputSelect).closest(".form-group").append("<span class='text-danger error'>" + value + "</span>");
                        }
                    });
                }
            }
        });
    });

    function editKeyword(id, keyword) {
        $("#id").val(id);
        $("#keyword").val(keyword);
    }

    function deleteKeyword(id) {
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
                    url: "{{ route('admin.keyword.destroy') }}",
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
                            $('#keyword-table').DataTable().ajax.reload();
                            table.ajax.reload();
                            $("#id").val("");
                            $("#keyword").val("");
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

    // super-admin entered keywords multiple deletion start
    $(document).on("change", ".check-uncheck-all", function (e) {
        var ischecked= $(this).is(':checked');
        if (ischecked) {
            $(".keyword-check").prop('checked', true);
        }else{
            $(".keyword-check").prop('checked', false);
        }
    });

    $(document).on("change", ".keyword-check", function (e) {
        var numberOfChecked = $('.keyword-check:checked').length;
        var totalCheckboxes = $('.keyword-check').length;

        if (totalCheckboxes == numberOfChecked) {
            $(".check-uncheck-all").prop('checked', true);
        }else{
            $(".check-uncheck-all").prop('checked', false);
        }
    });

    $("#multiple-delete").click(function (e) {
        var token = $("meta[name='csrf-token']").attr("content");

        var selectedIds = [];
        if ($('.keyword-check:checked').length != 0) {
            $('.keyword-check:checked').each(function(i,el){
                selectedIds.push($(this).val());
            });

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
                        type:"POST",
                        url: "{{ route('admin.keyword.destroyMultiple') }}",
                        data: {keyword_ids: selectedIds, "_token": token},
                        dataType: false,
                        success: function(response){
                            console.log(response);
                            toastr.success("Keywords deleted successfully");
                            // table.ajax.reload();
                            $('#keyword-table').DataTable().ajax.reload();
                            // LaravelDataTables["familymember-table"].ajax.reload();
                            $(".check-uncheck-all").prop('checked', false);
                        }
                    })
                }
            }).catch(swal.noop)
        }else{
            toastr.error("Please select at least one keyword!","error");
        }
    })

    // user entered keywords multiple deletion start
    $(document).on("change", ".check-uncheck-all-user-keyword", function (e) {
        var ischecked= $(this).is(':checked');
        if (ischecked) {
            $(".user-keyword-check").prop('checked', true);
        }else{
            $(".user-keyword-check").prop('checked', false);
        }
    });

    $(document).on("change", ".user-keyword-check", function (e) {
        var numberOfChecked = $('.user-keyword-check:checked').length;
        var totalCheckboxes = $('.user-keyword-check').length;

        if (totalCheckboxes == numberOfChecked) {
            $(".check-uncheck-all-user-keyword").prop('checked', true);
        }else{
            $(".check-uncheck-all-user-keyword").prop('checked', false);
        }
    });

    $("#multiple-delete-user-keyword").click(function (e) {
        var token = $("meta[name='csrf-token']").attr("content");

        var selectedIds = [];
        if ($('.user-keyword-check:checked').length != 0) {
            $('.user-keyword-check:checked').each(function(i,el){
                selectedIds.push($(this).val());
            });

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
                        type:"POST",
                        url: "{{ route('admin.keyword.destroyMultiple') }}",
                        data: {keyword_ids: selectedIds, "_token": token},
                        dataType: false,
                        success: function(response){
                            console.log(response);
                            toastr.success("Keywords deleted successfully");
                            table.ajax.reload();
                            // LaravelDataTables["familymember-table"].ajax.reload();
                            $(".check-uncheck-all-user-keyword").prop('checked', false);
                        }
                    })
                }
            }).catch(swal.noop)
        }else{
            toastr.error("Please select at least one keyword!","error");
        }
    })
</script>
@endpush
