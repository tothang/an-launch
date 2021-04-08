<div class="mobile-menu-items hidden">
  <div class="modal-backdrop">
    <nav class="navbar navbar-expand-lg navbar-light p-0">
      <div class="container-fluid">

        <div class="backdrop-container">
          <button class="navbar-toggler" type="button" id="navbarToggler">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="backdrop-logo">
            @if (isHyster())
              <a href="{{ route('index') }}">
                <img src="/img/hyster/logos-white-hysteryale@3x.png" style="margin-right: 33px;">
                <img src="/img/hyster/bitmap@3x.png">
              </a>
            @else
              <a href="{{ route('index') }}">
                <img src="/img/yale/logos-white-yale@3x.png" style="margin-right: 15px;">
                <img src="/img/yale/bitmap@3x.png">
              </a>
            @endif
          </div>

          <div class="mobile-menu-items-body">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-collapse">
              @if (isHyster())
                {{-- HOME --}}
                <li class="nav-item">
                  <a class="nav-link" href="{{ route(isPasswordCreated() ? 'welcome' : 'index') }}">{{ __('layout.header.home') }}</a>
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
                      <a class="nav-link"
                        href="{{ route('speakers.index') }}">{{ __('layout.header.speaker') }}</a>
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
              @else
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
              @endif
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>
</div>

@push('js')
  <script>
    $(".navbar-toggler").click(function() {
      if ($(".mobile-menu-items").hasClass('hidden')) {
        $("html").addClass('no-scroll');
        $("body.page").addClass('no-scroll');
        $(".desktop-menu-items").addClass('hidden');
        $(".mobile-menu-items").removeClass('hidden');
      } else {
        $("html").removeClass('no-scroll');
        $("body.page").removeClass('no-scroll');
        $(".mobile-menu-items").addClass('hidden');
        $(".desktop-menu-items").removeClass('hidden');
      }
    })

  </script>
@endpush
