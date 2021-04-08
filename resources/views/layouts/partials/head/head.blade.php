<head>
  @include('layouts.partials.head.meta')

  <title>{{ config('app.name', 'Laravel') }}</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @if (isHyster())
    <link rel="stylesheet" href="{{ asset('css/hyster.css') }}">
  @endif
  @if (isYale())
    <link rel="stylesheet" href="{{ asset('css/yale.css') }}">
  @endif
  @include('layouts.partials.head.scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
  </script>
</head>
