@extends('layouts.admin.app')

@section('page-title', $stream->name . ' - Question Moderation')

@section('content')
    @include('questions::admin.partials.nav')
    @include('questions::admin.partials.filter', ['route' => 'admin.questions.moderation.index'])
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Question List</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th width="30px">#</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Question</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->from }}</td>
                        <td>{{ $question->to }}</td>
                        <td>{{ $question->question }}</td>
                        <td>
                            <form action="{{ route('admin.questions.moderation.update', $question) }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fa fa-thumbs-up"></i>
                                    Accept
                                </button>
                            </form>
                            <form action="{{ route('admin.questions.moderation.update', $question) }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger btn-block">
                                    <i class="fa fa-thumbs-down"></i>
                                    Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
