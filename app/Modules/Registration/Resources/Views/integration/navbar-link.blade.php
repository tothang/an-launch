<li class="nav-item navigation__item {{ Route::is('registration.*') ? 'navigation__item--active' : '' }}">
    <a class="navigation__link" href="{{ route('registration.index', auth()->user()) }}">
        {{ auth()->user()->isRegistered() ? 'Registration' : 'Register' }}
    </a>
</li>
