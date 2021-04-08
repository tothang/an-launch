@extends("layouts.email.{$layout}")

@section('content')
    @component('layouts.email.components.section')
        <p>Hello {{ $model->forename }},</p>

        <p>A temporary password has been set for you for <b>{{ EventInfo::title() }}</b>.</p>

        <p>Your password is: <strong>{{ $password }}</strong></p>

        <p>Login by clicking the login button below.</p>

        @component('layouts.email.components.button', ['link' => $route])
            Login
        @endcomponent
    @endcomponent
@endsection
