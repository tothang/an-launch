<table class="table">
    <thead>
    </thead>
    <tbody>
    @foreach($polls as $poll)
        <tr>
            <th class="group-header" colspan="6">
                <h3 class="text-primary">{{ $poll->name }}</h3>
            </th>
        </tr>

        @if($poll->questions->count())
            <th width="300">Title</th>
            <th>Status</th>
            <th>Responses</th>
        @endif
        @forelse($poll->questions as $question)
            <tr data-itemId="{{ $question->id }}">
                <td>{{ $loop->iteration }} : {{ $question->title }}</td>
                <td>{!! $question->active ? '<span class="badge badge-success">Active</span>'  : '<span class="badge badge-danger">Inactive</span>' !!}</td>
                <td>{{ $question->responses->count() }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No questions!</td>
            </tr>
        @endforelse
    @endforeach
    </tbody>
</table>
