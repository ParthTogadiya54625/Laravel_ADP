@extends('admin.layouts.master_layout')
@section('title', 'Business Index')

@push('page_css')
{{-- datatable css --}}
<link rel="stylesheet" href="{{ asset('assets/libs/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"/>
@endpush

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Business</h4>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <table class="table table-hover" id="business-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Business</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">City</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Zipcode</th>
                                    <th scope="col">Phone</th>
                                    {{-- <th scope="col">Email</th> --}}
                                    {{-- <th scope="col">Url</th> --}}
                                    <th scope="col">Action</th>
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
{{-- datatable cdn --}}
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    var table = $('#business-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.business.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: '#', orderable: false, searchable: false },
            { data: 'logo', name: 'logo', orderable: false, searchable: false },
            { data: 'user_name', name: 'user_name' },
            { data: 'name', name: 'name' },
            { data: 'address', name: 'address' },
            { data: 'city', name: 'city' },
            { data: 'state', name: 'state' },
            { data: 'zipcode', name: 'zipcode' },
            { data: 'phone', name: 'phone' },
            // { data: 'email', name: 'email' },
            // { data: 'url', name: 'url' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

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
