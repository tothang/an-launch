@extends('layouts.email.html')

@section('content')
    @component('layouts.email.components.section')
        <p>Hello {{ $user->forename }},</p>
        <p>Thanks for registering for <b>{{ EventInfo::title() }}</b>.</p>

        @if($user->isAttending())
            @include('registration::email.partials.attending')
        @else
            @include('registration::email.partials.not-attending')
        @endif
    @endcomponent
@endsection
