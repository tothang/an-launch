@extends('layouts.admin.app')

@section('page-title', 'Registrations')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header with-border">
        <h3 class="card-title">Update Registration - {{ $registration->user->email }} <a href="{{ route('admin.users.index') }}" class="btn btn-danger btn-sm float-right">Cancel</a></h3>
    </div>
    <div class="card-body">
        {!! Form::open(
            [
                'route' => ['admin.registrations.update', $registration->id],
                'action' => 'POST',
                'method' => 'PATCH',
            ],
            [
                'theme' => 'admin'
            ]
        ) !!}

        @csrf
        @include('registration::partials.fields')

        @unless($registration->isRegistered())
            <label for="register">
                <input type="checkbox" name="register" class="js-register">
                Register user?
            </label>
        @endif

        <div class="js-send-confirmation hide">
            <label for="confirmation">
                <input type="checkbox" name="confirmation">
                Send confirmation email?
            </label>
        </div>

        {!! Form::submit(
            'submit',
            'Update'
        ) !!}

        {!! Form::close() !!}

    </div>
</div>

<div class="card card-outline card-primary">
    <div class="card-header with-border">
        <h3 class="card-title">Reset Registration - {{ $registration->user->email }}</h3>
    </div>
    <div class="card-body">
        <p>Resetting a registration will set attending to false and allow the user to register again.</p>
        <form action="{{ route('admin.registrations.destroy', $registration->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-warning">Reset Registration</button>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(function () {
            $('.js-register').change(function () {
                $(this).is(':checked')
                    ? $('.js-send-confirmation').removeClass('hide')
                    : $('.js-send-confirmation').addClass('hide')
            });
        })
    </script>
@endpush
