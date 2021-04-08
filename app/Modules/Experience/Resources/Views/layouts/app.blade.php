<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('layouts.partials.head.head')
<body class="page page--{{ $theme }} brand--{{ $brand }}">

<div class="page__wrapper">
  @include('experience::partials.navbar')

  <div class="page__content container-fluid" id="content-wrap">
    @include('layouts.partials.alerts')
    @if(View::hasSection('title'))
      <h3 class="header--primary">@yield('title')</h3>
    @endif
    @yield('content')
  </div>
</div>

@include('partials.footer')

@stack('modal-stack')
<script>
    window.FreshChat = {
        isActive: "{{ $supportChat->is_active }}",
        ApiToken: "{{ $supportChat->api_token }}",
        FirstName: "{{ auth()->user()->forename }}",
        ExternalId: "{{ auth()->user()->id }}"
        Email: "{{ auth()->user()->email }}",
        AppName: "{{ $supportChat->name }}",
        AppLogo: "{{ $supportChat->logo }}",
        BackgroundColour: "{{ $supportChat->background_colour }}",
        Colour: "{{ $supportChat->colour }}",
    };
</script>

@stack('window-js')
<script src="{{ mix('js/app.js') }}"></script>
@stack('js')

</body>
</html>
