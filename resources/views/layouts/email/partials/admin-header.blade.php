@component('layouts.email.components.section-twin', [
    'bgColour' => '#000000',
    'colour' => '#ffffff',
    'padding' => '10px',
    'rightAlign' => 'right',
])
    @slot('left')
        <img src="{{ asset('img/logos/drpg-logo-white.png')}}" height="50" alt="">
    @endslot

    @slot('right')
    @endslot
@endcomponent
