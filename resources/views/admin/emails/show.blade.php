@extends('layouts.admin.app')

@section('page-title', $pageTitle)

@section('content')
    @include('admin.emails.partials.queue-info')
        @component('admin.components.section', [
            'header' => 'Delegate list',
            'back' => route('admin.emails'),
        ])
            @include('admin.emails.partials.bulk-buttons')
            <hr>
            <table class="table" id="email-user-data-table">
                <thead>
                <th width="80px">Selected</th>
                <th width="20px">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Language</th>
                <th>Actions</th>
                </thead>
                <tbody></tbody>
            </table>
        @endcomponent
@endsection

@push('js')
    <script>
        $(function () {
            $('#email-user-data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": @json(route('admin.emails.users.datatable', $email)),
                columns: [
                    {data: 'selected', name: 'selected'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'language', name: 'language'},
                    {data: 'action', name: 'action'},
                ]
            });
        } );
    </script>
@endpush


@push('modal-stack')
    @include('admin.emails.modals.confirm-send')
@endpush
