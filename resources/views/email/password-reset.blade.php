@extends("layouts.email.{$layout}")

@section('content')
    @component('layouts.email.components.section')
        <p>Dear {{ $model->forename }},</p>
        <p>Your password has been reset, please click <a href="{{ route('set-password.show', ['token' => $token_login, 'reset_password' => true]) }}" target="_blank">
            here
          </a> to change your password</p>

{{--        <p>If you did not request a password reset, no further action is required.</p>--}}

{{--        @component('layouts.email.components.button', ['link' => $route])--}}
{{--            Reset password--}}
{{--        @endcomponent--}}
    @endcomponent
@endsection
