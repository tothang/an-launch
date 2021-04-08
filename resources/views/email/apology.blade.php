@extends('layouts.email.admin-html')

@section('content')
    @component('layouts.email.components.section')
        <p>
            {!! __('email.apology.dear', [], $locale) !!}
        </p>

        <p>
            {!! __('email.apology.content', [], $locale) !!}
        </p>

        <p>
            {!! __('email.apology.content_2', [], $locale) !!}
        </p>

        <p>
            {!! __('email.apology.content_3', [], $locale) !!}
        </p>

        <p>
            {!! __('email.apology.thank', [], $locale) !!}
        </p>

        <p>
            {!! __('email.apology.signature', [], $locale) !!}
        </p>

    @endcomponent
@endsection
