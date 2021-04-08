@extends(View::exists('experience::layouts.app') ? 'experience::layouts.app' : 'layouts.app')

@section('title', 'Forum')

@section('content')
    <a href="{{ route('forum.index') }}" class="btn btn-primary btn-sm mb-2 w-100">Back</a>
    <div id="react-forum" data-topic-id="{{ $topic->id }}"></div>
@endsection
