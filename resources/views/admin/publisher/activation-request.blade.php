@extends('admin.layouts.master_layout')
@section('title', 'Publisher Request')

@push('page_css')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
@endpush

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Publisher's Requests</h4>
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
                    <div class="card-header"></div>
                    <div class="card-body">
                        <table class="table" id="publisher_table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inactivePublishers as $publisher)
                                    <tr>
                                        <th scope="row"></th>
                                        <td>{{ $publisher->first_name }}</td>
                                        <td>{{ $publisher->last_name }}</td>
                                        <td>{{ $publisher->company }}</td>
                                        <td>{{ $publisher->email }}</td>
                                        <td>
                                            <a href="javascript:;" onclick="acceptRequest({{ $publisher->id }},1)" class="btn btn-primary rounded-circle" title="Accept Request"><i class="fas fa-user-check"></i></a>

                                            <a href="javascript:;" onclick="acceptRequest({{ $publisher->id }},0)" class="btn btn-danger rounded-circle" title="Decline Request"><i class="fas fa-times"></i></a>

                                            <a href="javascript:;" class="btn btn-success rounded-circle" onclick="setPublisherInfo({{ $publisher }})" data-bs-toggle="modal" data-bs-target="#publisherInfoModal" title="Publisher Info"><i
                                                    class="fas fa-eye"></i></a>
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
    <!-- Modal -->
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
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    function acceptRequest(id, status) {
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: "{{ route('admin.publisher.acceptdeclineReq') }}",
            type: 'POST',
            data: {
                "id": id,
                "status": status,
                "_token": token,
            },
            success: function(response) {
                if (response.status) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
                location.reload();
            }
        });
    }

    function setPublisherInfo(publisher){
        $("#first_name").html(publisher.first_name);
        $("#last_name").html(publisher.last_name);
        $("#company").html(publisher.company);
        $("#email").html(publisher.email);
        $("#phone").html(publisher.phone);
        $("#address").html(publisher.address);
        $("#address2").html(publisher.address2);
        $("#city").html(publisher.city);
        $("#state").html(publisher.state);
        $("#zipcode").html(publisher.zipcode);
        $("#url").html(publisher.url);
        $("#url").html(publisher.url);
        (publisher.logo)? $("#logo").attr("src", "{{asset('storage/publishers')}}/"+publisher.logo) : $("#logo").attr("src", "{{ asset('assets/images/users/avatar5.png') }}") ;
    }

    var table = $('#publisher_table').DataTable({
        "responsive": true,
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0, -1]
        }]
    });
    table.on('order.dt search.dt', function() {
        table.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) { cell.innerHTML = i + 1; });
    }).draw();
</script>
@endpush
