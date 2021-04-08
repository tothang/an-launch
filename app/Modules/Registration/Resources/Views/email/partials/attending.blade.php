<p>Your details:</p>
@foreach($user->registration->summary() as $field => $value)
    <strong>{{ $field }}</strong>: {{ $value }}
    <br>
@endforeach
<p>
    If you need to change any of your details, please contact us at
    @include('partials.contact')
</p>

@component('layouts.email.components.button', ['link' => route('calendar')])
    Add to calendar
@endcomponent
