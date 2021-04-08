@extends('layouts.email.admin-html')

@section('content')
    @component('layouts.email.components.section')
        <p>Hello {{ $admin->forename }},</p>

        <p>Your admin account for <b>{{ EventInfo::title() }}</b> has been created.</p>

        <p>Complete your account setup by clicking the login button below.</p>

        @component('layouts.email.components.button', ['link' => route('admin.login', ['token' => $token])])
            Login
        @endcomponent
    @endcomponent
@endsection
