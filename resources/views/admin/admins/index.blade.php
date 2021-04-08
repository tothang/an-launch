
@extends('layouts.admin.app')

@section('page-title', 'Admins')

@section('content')
    @component('admin.components.section', [
        'header' => 'Admin list',
        'create' => route('admin.admins.create'),
    ])
    <table class="table" id="user-data-table" style="overflow: auto">
        <thead>
        <th width="10px">#</th>
        <th>Role</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
        </thead>
        <tbody></tbody>
    </table>
    @endcomponent

    @include('admin.admins.partials.import')
@endsection

@push('js')
    <script>
        $(function () {
            $('#user-data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": @json(route('admin.admins.datatable')),
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'role', name: 'role'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        } );
    </script>
@endpush

@push('modal-stack')
    @include('admin.admins.modals.confirm-delete')
    @include('admin.admins.modals.confirm-temp-password')
@endpush
