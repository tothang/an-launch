@extends('layouts.admin.app')

@section('page-title', $stream->name . ' - User engagement')

@section('content')
    @component('admin.components.section', [
        'header' => 'User list',
        'back' => route('admin.engagement'),
    ])
        <table class="table" id="engagement-data-table">
            <thead>
            <th width="20px">#</th>
            <th>Email</th>
            <th>Progress</th>
            <th>Total Stream Time (Minutes)</th>
            <th>Last Login</th>
            </thead>
            <tbody></tbody>
        </table>
    @endcomponent
@endsection

@push('js')
    <script>
        $(function () {
            $('#engagement-data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": @json(route('admin.engagement.datatable', $stream->id)),
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'email', name: 'email'},
                    {data: 'progress', name: 'progress'},
                    {data: 'stream_time', name: 'stream_time'},
                    {data: 'last_login', name: 'last_login'},
                ]
            });
        });
    </script>
@endpush
