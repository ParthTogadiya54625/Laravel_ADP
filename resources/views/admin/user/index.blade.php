@extends('admin.layouts.master_layout')
@section('title', 'User Index')

@push('page_css')
{{-- datatable css --}}
<link rel="stylesheet" href="{{ asset('assets/libs/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"/>
@endpush

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Users</h4>
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
                        <div class="row">
                            <div class="col-md-5">
                                <button type="button" class="btn btn-danger btn-sm btn-fab" id="multiple-delete" title="Delete Multiple"><i class="far fa-trash-alt"></i></button>
                            </div>
                            <div class="col-md-3">
                                <h4>Publisher : <strong style="color: #DA542E"> {{$publisher->full_name}}</strong></h4>
                            </div>
                            <div class="col-md-4">
                                @can('user-create')
                                    <a href="{{ route('admin.user.create', ['id'=>$publisher->id]) }}" class="btn btn-primary"
                                        style="float: right; border: 1px solid white"><i class="fas fa-plus"></i> New
                                        User</a>
                                @endcan
                            </div>
                        </div>

                        {{-- <div style="display: inline; text-align: center;"> --}}
                        {{-- </div> --}}

                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="user-table">
                            <thead>
                                <tr>
                                    <th style="width: 0px">
                                        <div class="form-check mr-sm-2">
                                            <input type="checkbox" class="form-check-input check-uncheck-all" style="margin-left: -21px;">
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Publisher Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th width="50%"><b>Publisher Name : </b></th>
                                <td>{{$publisher->full_name}}</td>
                            </tr>
                            <tr>
                                <th><b>First Name : </b></th>
                                <td id="first_name"></td>
                            </tr>
                            <tr>
                                <th><b>Last Name : </b></th>
                                <td id="last_name"></td>
                            </tr>
                            {{-- <tr>
                                <th><b>Company : </b></th>
                                <td id="company"></td>
                            </tr> --}}
                            <tr>
                                <th><b>Email : </b></th>
                                <td id="email"></td>
                            </tr>
                            <tr>
                                <th><b>Phone : </b></th>
                                <td id="phone"></td>
                            </tr>
                            <tr>
                                <th><b>Address : </b></th>
                                <td id="address"></td>
                            </tr>
                            <tr>
                                <th><b>Address 2 : </b></th>
                                <td id="address2"></td>
                            </tr>
                            <tr>
                                <th><b>City : </b></th>
                                <td id="city"></td>
                            </tr>
                            <tr>
                                <th><b>State : </b></th>
                                <td id="state"></td>
                            </tr>

                            <tr>
                                <th><b>Zipcode : </b></th>
                                <td id="zipcode"></td>
                            </tr>
                            {{-- <tr>
                                <th><b>Url : </b></th>
                                <td id="url"></td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</div>
@endsection

@push('page_script')
{{-- datatable cdn --}}
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    var table = $('#user-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.user.index',['id'=>$publisher->id]) }}",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'DT_RowIndex', name: '#', orderable: false, searchable: false },
            // { data: 'logo', name: 'logo', orderable: false, searchable: false },
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    function setUserInfo(id){
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: "{{ route('admin.publisher.getPublisherData') }}",
            type: 'POST',
            data: {
                "id": id,
                "_token": token,
            },
            success: function (response){
                // console.log(response);
                if (response.status == 200) {
                    $("#first_name").html(response.publisher.first_name);
                    $("#last_name").html(response.publisher.last_name);
                    // $("#company").html(response.publisher.company);
                    $("#email").html(response.publisher.email);
                    $("#phone").html(response.publisher.phone);
                    $("#address").html(response.publisher.address);
                    $("#address2").html(response.publisher.address2);
                    $("#city").html(response.publisher.city);
                    $("#state").html(response.publisher.state);
                    $("#zipcode").html(response.publisher.zipcode);
                    // $("#url").html(response.publisher.url);
                }
            }
        });
    }

    function deleteUser(id){
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
                    url: "{{ route('admin.user.destroy') }}",
                    type: 'DELETE',
                    data: {
                        "id": id,
                        // "publisher_id" : {{$publisher->id}},
                        "_token": token,
                    },
                    success: function (response){
                        // console.log(response);
                        if (response.status == 200) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong...',
                            })
                        }
                        table.ajax.reload();
                    }
                });
            }
        })
    }


    // super-admin entered keywords multiple deletion start
    $(document).on("change", ".check-uncheck-all", function (e) {
        var ischecked= $(this).is(':checked');
        if (ischecked) {
            $(".user-check").prop('checked', true);
        }else{
            $(".user-check").prop('checked', false);
        }
    });

    $(document).on("change", ".user-check", function (e) {
        var numberOfChecked = $('.user-check:checked').length;
        var totalCheckboxes = $('.user-check').length;

        if (totalCheckboxes == numberOfChecked) {
            $(".check-uncheck-all").prop('checked', true);
        }else{
            $(".check-uncheck-all").prop('checked', false);
        }
    });

    $("#multiple-delete").click(function (e) {
        var token = $("meta[name='csrf-token']").attr("content");

        var selectedIds = [];
        if ($('.user-check:checked').length != 0) {
            $('.user-check:checked').each(function(i,el){
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
                        url: "{{ route('admin.user.destroyMultiple') }}",
                        data: {user_ids: selectedIds, "_token": token},
                        dataType: false,
                        success: function(response){
                            // console.log(response);
                            toastr.success("Keywords deleted successfully");
                            table.ajax.reload();
                            // $('#keyword-table').DataTable().ajax.reload();
                            $(".check-uncheck-all").prop('checked', false);
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
