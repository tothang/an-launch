@extends('layouts.admin.app')

@section('page-title', 'Wordclouds')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Basic information:</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <h4>Title:</h4>
                    <p>{{ $wordcloud->question }}</p>
                </div>
                <div class="col-sm-2">
                    <h4>Status</h4>
                    @if($wordcloud->active)
                        <div class="badge badge-pill badge-success text-center">Active</div>
                    @else
                        <div class="label label-danger">Inactive</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card card-dark card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Entries</h3>
            <div class="card-tools">
                <a href="{{ route('admin.wordclouds.entries.create', $wordcloud) }}" class="btn btn-success btn-sm">Create Entry</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Word</th>
                        <th>Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($waiting as $entry)
                        <tr>
                            <td>{{ $entry->id }}</td>
                            <td>{{ $entry->word }}</td>
                            <td>{{ $entry->count }}</td>
                            <td>
                                <form action="{{ route('admin.wordclouds.moderation.update', $entry) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-thumbs-up"></i> Accept</button>
                                </form>
                                <form action="{{ route('admin.wordclouds.moderation.update', $entry) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-thumbs-down"></i> Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <h3 class="text-center">Accepted</h3>
                    <table class="table data-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Word</th>
                            <th>Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($accepted as $entry)
                            <tr>
                                <td>{{ $entry->id }}</td>
                                <td>{{ $entry->word }}</td>
                                <td>{{ $entry->count }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card card-danger card-outline">
                <div class="card-body">
                    <h3 class="text-center">Rejected</h3>
                    <table class="table data-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Word</th>
                            <th>Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rejected as $entry)
                            <tr>
                                <td>{{ $entry->id }}</td>
                                <td>{{ $entry->word }}</td>
                                <td>{{ $entry->count }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
