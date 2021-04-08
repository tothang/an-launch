@if (isHyster())
  <nav class="navbar navbar-expand-lg navbar-light p-0">
    <div class="container-fluid">
      <a class="navbar-brand navbar-brand-desktop" href="{{ route('index') }}">
        <img class="img-1" src="/img/hyster/logos-white-hysteryale@3x.png" height="50" alt="">
        <img class="img-2" src="/img/hyster/bitmap@3x.png" height="50" alt="">
      </a>

      <a class="navbar-brand navbar-brand-mobile" href="{{ route('index') }}">
        <img class="img-2" src="/img/hyster/logo-mobile.png" height="70" alt="">
      </a>

      <button class="navbar-toggler" type="button" id="navbarToggler">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse desktop-menu-items">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          {{-- HOME --}}
          <li class="nav-item">
            <a class="nav-link"
              href="{{ route(isPasswordCreated() ? 'welcome' : 'index') }}">{{ __('layout.header.home') }}</a>
          </li>

          {{-- AGENDA --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ route('agenda.index') }}">{{ __('layout.header.agenda') }}</a>
          </li>

          {{-- CONTACT --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact.index') }}">{{ __('layout.header.contact') }}</a>
          </li>

          @if (isRegisteredDelegate())
            @if ($stream->is_live)
              {{-- FAQs --}}
              <li class="nav-item">
                <a class="nav-link" href="{{ route('faq.index') }}">{{ __('layout.header.faqs') }}</a>
              </li>
            @else
              {{-- Presenter --}}
              <li class="nav-item">
                <a class="nav-link" href="{{ route('speakers.index') }}">{{ __('layout.header.speaker') }}</a>
              </li>
            @endif

            {{-- SIGN OUT --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}">{{ __('layout.header.sign_out') }}</a>
            </li>
          @else
            {{-- REGISTER --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('registration.index') }}"
                tabindex="-1">{{ __('layout.header.register_now') }}</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
@else
  <nav class="navbar navbar-expand-lg navbar-light p-0">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('index') }}">
        <img class="img-1" src="/img/yale/logos-white-yale@3x.png" height="50" alt="">
        <img class="img-2" src="/img/yale/bitmap@3x.png" height="50" alt="">
      </a>
      <button class="navbar-toggler" type="button" id="navbarToggler">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse desktop-menu-items">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          {{-- HOME --}}
          <li class="nav-item">
            <a class="nav-link"
              href="{{ route(isPasswordCreated() ? 'welcome' : 'index') }}">{{ __('layout.header.home') }}</a>
          </li>

          {{-- AGENDA --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ route('agenda.index') }}">{{ __('layout.header.agenda') }}</a>
          </li>

          {{-- CONTACT --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact.index') }}">{{ __('layout.header.contact') }}</a>
          </li>

          @if (isRegisteredDelegate())
            {{-- FAQs --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('faq.index') }}">{{ __('layout.header.faqs') }}</a>
            </li>
            {{-- SIGN OUT --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}">{{ __('layout.header.sign_out') }}</a>
            </li>
          @else
            {{-- REGISTER --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('registration.index') }}"
                tabindex="-1">{{ __('layout.header.register_now') }}</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
@endif
