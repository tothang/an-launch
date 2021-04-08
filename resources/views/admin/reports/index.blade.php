
@extends('layouts.admin.app')

@section('page-title', $title)

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title" style="min-height: 24px;"></h3>
            <div class="card-tools">
                @if($countDelegates > 0)
                    <a href="{{ route('admin.reports.export') }}" class="btn btn-dark btn-sm">Export</a>
                @endif
            </div>
        </div>

        <div class="card-body">
            <table class="table" id="delegate-data-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Brand</th>
                    <th>Role</th>
                    <th>Duration of viewed time</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(() => {
            $('#delegate-data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": @json(route('admin.reports.datatable')),
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'brand', name: 'brand'},
                    {data: 'role', name: 'role'},
                    {data: 'view_time', name: 'view_time'}
                ]
            });
        } );
    </script>
@endpush
