@extends('layouts.admin.app')

@section('page-title', 'Page Views')

@section('content')
    @component('admin.components.section', [
        'header' => 'Records',
    ])
        <table class="table data-table">
            <thead>
            <th>Page URL</th>
            <th>Total Views</th>
            <th>Total Time (minutes)</th>
            </thead>
            <tbody>
            @foreach($pageViews as $page)
                <tr>
                    <td>{{ $page->url }}</td>
                    <td>{{ $page->page_views }}</td>
                    <td>{{ $page->time_spent }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endcomponent
@endsection
