<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('layouts.partials.head.head')

<body class="page--{{ $theme }} brand--{{ $brand }}">

  <div class="teaser__container">
    <div class="logo">
      <a href="/">
        <img
          src="{{ isHyster() ? '/img/hyster/logos-white-hysteryale@3x.png' : '/img/yale/logos-white-yale@3x.png' }}"
          style="margin-right: 15px;">
        <img src="{{ isHyster() ? '/img/hyster/bitmap@3x.png' : '/img/yale/bitmap@3x.png' }}">
      </a>
    </div>

    <div class="page__content container-fluid" id="content-wrap">
      @yield('page-content')
    </div>
  </div>

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
