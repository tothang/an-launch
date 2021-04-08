<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('layouts.partials.head.head')

<body class="page--light brand--{{ $brand }}">

  @yield('content')

  <script>
    window.FreshChat = {
      isActive: "{{ $supportChat->is_active }}",
      ApiToken: "{{ $supportChat->api_token }}",
      FirstName: "Guest",
      Email: "",
      AppName: "{{ $supportChat->name }}",
      AppLogo: "{{ $supportChat->logo }}",
      BackgroundColour: "{{ $supportChat->background_colour }}",
      Colour: "{{ $supportChat->colour }}",
    };

  </script>
  <script src="{{ mix('js/app.js') }}"></script>
  @stack('js')

</body>

</html>
