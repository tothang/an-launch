@extends(View::exists('experience::layouts.app') ? 'experience::layouts.app' : 'layouts.app')

@section('title', 'Forum')

@section('content')
    @forelse($forumTopics as $topic)
        <div class="border border-light p-4 {{ $loop->iteration > 1 ? 'mt-2' : '' }} {{ $topic->pinned ? 'pinned' : '' }}">
            <i class="fa fa-exclamation-circle d-inline {{ $topic->pinned ? '' : 'hide' }}"></i>
            <div class="row">
                <div class="col-md-5">
                    <h4>{{ $topic->title }}</h4>
                    {{ $topic->likeCount() . ' ' }} Likes
                </div>
                <div class="col-md-3 text-right">
                    <h5>
                        {{ $topic->threads->count() }} Threads
                        <br>
                        {{ $topic->commentCount }} Comments
                    </h5>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{ route('forum.show', $topic) }}" class="btn btn-primary">Enter</a>
                </div>
            </div>
        </div>
    @empty
        <h4>No topics are available yet!</h4>
    @endforelse
@endsection
