@extends('admin.layouts.master_layout')
@section('title','Database Backup')
@push('page_css')
    {{-- datatable css --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/libs/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"/> --}}
@endpush
@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h3 class="page-title">Database Import/Export</h3>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Database</li>
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
                        <a href="{{route('admin.database.export')}}" class="btn btn-primary" style="float: right; border: 1px solid white"> <i class="fas fa-cloud-download-alt"></i> Export</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.database.import')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-select" aria-label="Default select example" name="file">
                                        <option value="">Select import file</option>
                                        @foreach ($files as $file)
                                        <option value="{{Str::after($file, 'db_backup/')}}">{{Str::after($file, 'db_backup/')}}</option>
                                        @endforeach
                                    </select>
								    @error('file') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success text-white"> <i class="fas fa-cloud-upload-alt"></i> Import</button>
                                </div>
                            </div>
                        </form>
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
    {{-- <script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        var table = $('#company_table').DataTable(
            {
                "responsive": true,
                "order": [[ 0, "desc" ]],
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [-1] }
                ]
            }
        );
    </script> --}}
@endpush
