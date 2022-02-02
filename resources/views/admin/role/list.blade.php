@extends('admin.layouts.master_layout')
@section('title','Role List')

@push('page_css')
{{-- datatable --}}
<link rel="stylesheet" href="{{ asset('assets/libs/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"/>
@endpush

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Roles</h4>
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
                        @can('role-create')
                        <a href="{{ route('admin.role.create') }}" class="btn btn-primary" style="float: right; border: 1px solid white"><i class="fas fa-plus"></i> New Role</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="role_table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role name</th>
                                    <th scope="col">Permissions</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $roles as $key=>$role)
									<tr>
										<th scope="row">{{ $role->id }}</th>
										<td>{{ ucwords(str_replace("-", " ", $role->name)) }}</td>
                                        @php
                                            $data = $role->permissions->pluck('name')->toArray();
                                            $permission = implode(', ', $data);
                                        @endphp
                                        <td>{{ $permission }}</td>
										<td>
                                            @can('role-edit')
											    <a class='btn btn-warning rounded-circle' href="{{ route('admin.role.edit', ['id'=>$role->id]) }}"> <i class="fas fa-pencil-alt" data-toggle="tooltip" title="Edit"></i> </a>
                                            @endcan
                                            @can('role-delete')
											    <a class='btn btn-danger rounded-circle' onclick='deleteUser({{ $role->id }})' href='javascript:void(0)'> <i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i> </a>
                                            @endcan
										</td>
									</tr>
								@endforeach
                            </tbody>
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
{{-- datatable --}}
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
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
                    url: "{{ route('admin.role.destroy') }}",
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (response){
                        console.log(response);
                        if (response == "success") {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'This role is assigned to user, You cannot delete it!',
                            })
                        }
                        location.reload();
                    }
                });
            }
        })
    }

    var table = $('#role_table').DataTable(
        {
            "responsive": true,
            // "order": [[ 1, "desc" ]],
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [-1,0] }
            ]
        }
    );
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
</script>

@endpush
