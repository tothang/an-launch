@extends('layouts.reset-password')

@section('custom-class', isHyster() ? 'page-hyster-password-creation' : '')

@section('title')
    <h3 class="reset-password__header">{{__('auth.create_password')}}</h3>
@stop

@section('page-content')
        {!! Form::open([
            'route' => 'set-password.store',
            'action' => 'POST',
            'autocomplete' => 'off',
            'class' => 'auth__form'
        ]) !!}

        @csrf

        @if(isHyster())
            <hr class="hyster-line" />
        @endif

        <div class="reset-password-message">
            @if(isHyster())
                {!! __('auth.create_password_description') !!}
            @else
                {{ strip_tags(__('auth.create_password_description')) }}
            @endif
        </div>

        @if(!empty($msg))
            <div class="alert alert-danger">
                <p class="mb-1">
                    {{__('auth.create_password_url_invalid')}}
                </p>
            </div>
        @elseif(!empty($msg_create_success))
            <div class="alert alert-primary">
                <p class="mb-1">
                    {{__('auth.create_password_success')}}

                    <a class="forgot-password-link" href="{{ route('login') }}">
                        {{__('auth.login_now')}}
                    </a>
                </p>
            </div>
        @else
            <div class="col-lg-10 pl-0 pr-0">
            <input type="hidden" name="token" value={{$token}}>
            {!! Form::password(
                'password',
                [
                    //'required' => true,
                    'placeholder' => __('auth.password')
                ]
            ) !!}

            {!! Form::password(
                'password_confirmation',
                [
                    //'required' => true,
                    'placeholder' => __('auth.retype_password')
                ]
            ) !!}

            <div class="yale-mobile-spacing"></div>

            {!! Form::submit(
                'submit',
                isHyster() ? __('auth.hyster.create_password_submit_button') : __('auth.create_password_submit_button'),
                [
                    'inline' => true,
                ]
            ) !!}
            </div>
        @endif

        {!! Form::close() !!}
@endsection

