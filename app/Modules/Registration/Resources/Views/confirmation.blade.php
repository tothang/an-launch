@extends(View::exists('experience::layouts.app') ? 'experience::layouts.app' : 'layouts.app')

@section('title', (
    $registration->attending
    ? 'Thank you for registering for '
    : 'Thank you for letting us know you can\'t attend ') . EventInfo::title()
)

@section('content')
    @if($registration->attending)
        @if(module_enabled('experience'))
            <a href="{{ route('experience') }}" class="btn btn-primary mt-4">Enter Experience</a>
        @endif
        <div class="text-center">
            @include('registration::partials.summary')
        </div>
    @else
        <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
    @endif
@endsection
