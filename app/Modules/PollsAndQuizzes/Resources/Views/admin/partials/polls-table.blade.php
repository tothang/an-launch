<table class="table">
    <thead>
    <tr>
        <th width="30px">#</th>
        <th>Name</th>
        <th>Questions</th>
        <th>Answers</th>
        <th>Responses</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($polls as $poll)
        <tr>
            <td>{{ $poll->id }}</td>
            <td>{{ $poll->name }}</td>
            <td>{{ $poll->questions->count() }}</td>
            <td>{{ $poll->answers->count() }}</td>
            <td>{{ $poll->responses()->count() }}</td>
            <td>{!! $poll->active() ? '<span class="badge badge-success">Active</span>'  : '<span class="badge badge-danger">Inactive</span>' !!}</td>
            <td>
                <a href="{{ route('admin.poll-and-quiz.edit', $poll) }}" class="btn btn-info btn-sm btn-block">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.poll-and-quiz.questions.index', $poll) }}"
                   class="btn btn-success btn-sm btn-block">View
                    Questions</a>

                <hr>

                @if($poll->deleted_at)
                    <form class="form-inline" action="{{ route('admin.poll-and-quiz.restore', $poll) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                        <button type="submit" class="btn btn-warning btn-sm btn-block"><i class="fa fa-undo"></i>
                            Restore
                        </button>
                    </form>
                @else
                    <form class="form-inline" action="{{ route('admin.poll-and-quiz.destroy', $poll) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i> Delete
                        </button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
