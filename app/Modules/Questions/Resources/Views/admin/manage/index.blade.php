@extends('layouts.admin.app')

@section('page-title', $stream->name . ' - Question Management')

@section('content')
    @include('questions::admin.partials.nav')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Question List</h3>
            <div class="card-tools">
                <a href="{{ route('admin.questions.create', $stream) }}" class="btn btn-success btn-sm">
                    Create Question
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table data-table">
                <thead>
                <tr>
                    <th width="30px">#</th>
                    <th>Sender</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Question</th>
                    <th>Likes</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ optional($question->user)->email }}</td>
                        <td>{{ $question->from }}</td>
                        <td>{{ $question->to }}</td>
                        <td>{{ $question->question }}</td>
                        <td>{{ $question->likes()->count() }}</td>
                        <td>
                            @if($question->status === 'waiting')
                                <span class="badge badge-dark">Waiting</span>
                            @elseif($question->status === 'accepted')
                                <span class="badge badge-success">Accepted</span>
                            @else
                                <span class="badge badge-danger">Rejected</span>
                            @endif

                            @if($question->read)
                                <br>
                                <span class="badge badge-warning">Read</span>
                            @endif

                            @if($question->on_screen)
                                <br>
                                <span class="badge badge-info">On Screen</span>
                            @endif

                            @if($question->hidden)
                                <br>
                                <span class="badge badge-secondary">Hidden</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.questions.edit', $question) }}"
                               class="btn btn-info btn-sm btn-block">
                                <i class="fa fa-edit"></i>
                                Edit
                            </a>
                            <form action="{{ route('admin.questions.destroy', $question) }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm btn-block">
                                    <i class="fa fa-trash"></i>
                                    Delete
                                </button>
                            </form>

                            @if($question->hidden)
                                <form action="{{ route('admin.questions.facilitation.update', $question) }}"
                                      method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="hidden" value="0">
                                    <button type="submit" class="btn btn-default btn-sm btn-block">
                                        <i class="fa fa-eye"></i>
                                        Unhide
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
