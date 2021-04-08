@component('layouts.email.components.section-twin', [
    'bgColour' => '#000000',
    'colour' => '#ffffff',
    'padding' => '10px',
    'rightAlign' => 'right',
])
    @slot('left')
        <img src="{{ asset('img/admin/envx-logo-mini.png')}}" height="50" alt="">
    @endslot

    @slot('right')
        <span>
            {{ EventInfo::client() }}<br>
            {{ EventInfo::title() }}
        </span>
    @endslot
@endcomponent
