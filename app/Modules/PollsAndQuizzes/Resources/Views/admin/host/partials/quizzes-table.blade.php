<table class="table">
    <thead>
    </thead>
    <tbody>
    @foreach($quizzes as $quiz)
        <tr>
            <th class="group-header" colspan="6">
                <h3 class="text-primary">{{ $quiz->name }}</h3>
            </th>
        </tr>

        @if($quiz->questions->count())
            <th width="300">Title</th>
            <th>Status</th>
            <th>Responses</th>
            <th>Correct</th>
            <th>Incorrect</th>
        @endif
        @foreach($quiz->questions as $question)
            <tr data-itemId="{{ $question->id }}">
                <td>{{ $loop->iteration }} : {{ $question->title }}</td>
                <td>{!! $question->active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' !!}</td>
                <td>{{ $question->responses->count() }}</td>
                <td>{{ $question->correctResponses() }}</td>
                <td>{{ $question->incorrectResponses() }}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
