<nav class="navigation navbar navbar-expand-lg">
    <span class="navigation__brand navbar-brand d-none d-lg-block">
        <img class="navigation__logo" src="{{ asset(EventInfo::clientLogoInverse()) }}" alt="Client Logo">
    </span>

  <div class="navigation__toggle collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navigation__icon d-lg-none"></span>
  </div>
  <a class="navigation__link d-lg-none" href="{{ url('/') }}">
    <img src="{{ asset(EventInfo::clientLogo()) }}" class="navigation__logo" alt="Client Logo">
  </a>
  @include('partials.nav.angle-right')

  <div class="collapse navbar-collapse navigation__collapse" id="navbarSupportedContent">
    <ul class="navigation__nav navbar-nav mr-auto">
      <li class="nav-item navigation__item {{ Route::is('landing') ? 'navigation__item--active' : '' }}">
        <a class="navigation__link" href="{{ route('landing') }}">
          Home
        </a>
      </li>

      @includeWhen(module_enabled('registration'), 'registration::integration.navbar-link')

      @includeWhen(module_enabled('agenda'), 'agenda::integration.navbar-link')

      @if(is_admin())
        <li class="nav-item navigation__item">
          <a class="navigation__link" href="{{ route('admin.dashboard') }}">Admin Area</a>
        </li>
      @endif
      <li class="nav-item navigation__item">
        <a class="navigation__link" href="{{ route('logout') }}">Logout</a>
      </li>
    </ul>
  </div>
</nav>
