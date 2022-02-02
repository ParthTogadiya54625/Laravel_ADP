@extends('admin.layouts.master_layout')
@section('title', 'Publisher Index')

@push('page_css')
{{-- datatable css --}}
<link rel="stylesheet" href="{{ asset('assets/libs/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"/>
@endpush

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Publishers</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Publisher</li>
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
                        @can('publisher-create')
                            <a href="{{ route('admin.publisher.create') }}" class="btn btn-primary" style="float: right; border: 1px solid white"><i class="fas fa-plus"></i> New Publisher</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="active-publisher-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Logo</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    {{-- <th>Address 2</th> --}}
                                    <th>Url</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- publisher-model --}}
    <div class="modal fade" id="publisherInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <th width="50%"><b>First Name : </b></th>
                                <td id="first_name"></td>
                            </tr>
                            <tr>
                                <th><b>Last Name : </b></th>
                                <td id="last_name"></td>
                            </tr>
                            <tr>
                                <th><b>Company : </b></th>
                                <td id="company"></td>
                            </tr>
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
                            <tr>
                                <th><b>Url : </b></th>
                                <td id="url"></td>
                            </tr>
                            <tr>
                                <th><b>Logo : </b></th>
                                <td> <img src="" style="height: 100px; width:100px; " id="logo" alt="Publisher"> </td>
                            </tr>
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
    var table = $('#active-publisher-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.publisher.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: '#', orderable: false, searchable: false },
            { data: 'logo', name: 'logo', orderable: false, searchable: false },
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'company', name: 'company' },
            { data: 'email', name: 'email' },
            { data: 'address', name: 'address' },
            // { data: 'address2', name: 'address2' },
            { data: 'url', name: 'url' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    function setPublisherInfo(id){
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: "{{ route('admin.publisher.getPublisherData') }}",
            type: 'POST',
            data: {
                "id": id,
                "_token": token,
            },
            success: function (response){
                console.log(response);
                if (response.status == 200) {
                    $("#first_name").html(response.publisher.first_name);
                    $("#last_name").html(response.publisher.last_name);
                    $("#company").html(response.publisher.company);
                    $("#email").html(response.publisher.email);
                    $("#phone").html(response.publisher.phone);
                    $("#address").html(response.publisher.address);
                    $("#address2").html(response.publisher.address2);
                    $("#city").html(response.publisher.city);
                    $("#state").html(response.publisher.state);
                    $("#zipcode").html(response.publisher.zipcode);
                    $("#url").html(response.publisher.url);
                    (response.publisher.logo)? $("#logo").attr("src", "{{asset('storage/publishers')}}/"+response.publisher.logo) : $("#logo").attr("src", "{{ asset('assets/images/users/avatar5.png') }}") ;
                }
            }
        });

    }

    function deletePublisher(id){
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
                    url: "{{ route('admin.publisher.destroy') }}",
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (response){
                        console.log(response);
                        if (response.status == 200) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            )
                        }else if(response.status == 404){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            })
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
</script>
@endpush
