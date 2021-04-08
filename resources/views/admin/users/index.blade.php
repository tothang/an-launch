@extends('layouts.admin.app')

@section('page-title', $brand . ' Delegate Management')

@section('content')
    <div class="card card-primary card-outline">

        <div class="card-header with-border">
            <h3 class="card-title">Delegates List</h3>
            <div class="card-tools">
                <a href="{{ route('admin.' . strtolower($brand) . '.create') }}" class="btn btn-success btn-sm">Create New Delegate</a>
                <a href="{{ route('admin.users.export', $brand) }}" class="btn btn-dark btn-sm">Export Delegate</a>
            </div>
        </div>

        <div class="card-body" style="overflow: auto">
            <table class="table" id="user-data-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Email address</th>
                    <th>Brand</th>
                    <th>Language</th>
                    <th>Role</th>
                    <th>Dealership Name / Employee Function</th>
                    <th>Country / Office Location</th>
                    <th>Breakout group</th>
                    <th>Last login</th>
                    <th>Region</th>
                    <th>City</th>
                    <th>Status</th>
                    <th width="150px">Actions</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    @include('admin.users.partials.import')
@endsection

@push('js')
    <script>
        $(function () {
            let columns = [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'name', name: 'forename'},
                {data: 'email', name: 'email'},
                {data: 'brand', name: 'brand'},
                {data: 'language', name: 'language'},
                {data: 'role', name: 'role'},
                {data: 'dealership_name_or_employee_function', name: 'dealership_name_or_employee_function'},
                {data: 'country_office_location', name: 'country_office_location'},
                {data: 'breakout_group', name: 'breakout_group'},
                {data: 'last_login', name: 'last_login'},
                {data: 'region', name: 'region'},
                {data: 'city', name: 'city'},
                {data: 'statusStringify', name: 'statusStringify'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'surname', name: 'surname', visible: false},
                {data: 'dealership_name', name: 'dealership_name', visible: false},
                {data: 'employee_function', name: 'employee_function', visible: false},
                {data: 'status', name: 'status', visible: false},
            ]

            $('#user-data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": @json(route('admin.users.datatable', $brand)),
                columns: columns
            });
        } );
    </script>
@endpush

@push('modal-stack')
    @include('admin.users.modals.confirm-delete')
    @include('admin.users.modals.confirm-temp-password')
    @include('admin.users.modals.confirm-set-status')
@endpush
