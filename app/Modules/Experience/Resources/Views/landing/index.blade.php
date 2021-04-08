@extends('experience::layouts.app')

@section('title', EventInfo::title())

@section('content')
    <div class="row">
        <div class="col-12">
            @if($registered && $attending)
                <a href="{{ route('experience') }}" class="btn btn-primary">Enter Experience</a>
            @elseif($registered === false)
                <a href="{{ route('registration.index') }}" class="btn btn-primary">Register Now</a>
            @endif
        </div>
    </div>
@endsection
