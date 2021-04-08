<table class="table">
    <thead>
    <th width="30px">#</th>
    <th>Name</th>
    <th>Questions</th>
    <th>Answers</th>
    <th>Responses</th>
    <th>Status</th>
    <th>Actions</th>
    </thead>
    <tbody>
    @foreach($quizzes as $quiz)
        <tr>
            <td>{{ $quiz->id }}</td>
            <td>{{ $quiz->name }}</td>
            <td>{{ $quiz->questions->count() }}</td>
            <td>{{ $quiz->answers->count() }}</td>
            <td>{{ $quiz->responses()->count() }}</td>
            <td>{!! $quiz->active() ? '<span class="badge badge-success">Active</span>'  : '<span class="badge badge-danger">Inactive</span>' !!}</td>
            <td>
                <a href="{{ route('admin.poll-and-quiz.edit', $quiz) }}" class="btn btn-info btn-sm btn-block"><i class="fa fa-edit"></i> Edit</a>
                <a href="{{ route('admin.poll-and-quiz.questions.index', $quiz) }}" class="btn btn-success btn-sm btn-block">View Questions</a>

                <hr>

                @if($quiz->deleted_at)
                    <form class="form-inline" action="{{ route('admin.poll-and-quiz.restore', $quiz) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                        <button type="submit" class="btn btn-warning btn-sm btn-block"><i class="fa fa-undo"></i> Restore</button>
                    </form>
                @else
                    <form class="form-inline" action="{{ route('admin.poll-and-quiz.destroy', $quiz) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i> Delete</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
