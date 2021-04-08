<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('layouts.partials.head.head')

<body class="page @yield('body-class') brand--{{ $brand }}">
  <div id="content-wrap">
    @include('layouts.partials.navbar')
    @yield('content')
    @include('layouts.partials.backdrop')
    @include('layouts.partials.notification')
  </div>

  @stack('modal-stack')
  <script>
    window.FreshChat = {
      isActive: "{{ $supportChat->is_active }}",
      ApiToken: "{{ $supportChat->api_token }}",
      FirstName: "{{ optional(auth()->user())->forename }}",
      Email: "{{ optional(auth()->user())->email }}",
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
