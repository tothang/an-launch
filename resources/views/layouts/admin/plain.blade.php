<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('layouts.admin.partials.head.head')

<body>
  <div class="grid">
    @includeUnless(isset($noNav), 'layouts.admin.partials.nav-plain')
    <div id="content">
      <div class="container-fluid">
        <div style="padding: 15px 15px 0 15px;">
          @include('layouts.partials.alerts')
        </div>
        @yield('content')
      </div>
    </div>
  </div>

  @stack('modal-stack')

  <script src="{{ asset('js/admin.js') }}"></script>
  @stack('js')
</body>

</html>
