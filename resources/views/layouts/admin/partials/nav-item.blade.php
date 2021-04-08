@if(isset($isDivider) && $isDivider)
    <li class="nav-item">
        <div class="divider"></div>
    </li>
@else
    @if(isset($children) && count($children) > 0)
        <li class="nav-item has-treeview {{ Route::is($activeOn) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is($activeOn) ? 'active' : '' }}">
                <i class="nav-icon {{ $icon }}"></i>
                <p>
                    {{ $title }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @foreach($children as $child)
                    <li class="nav-item">
                        <a href="{{ route($child['route']) }}" class="nav-link {{ Route::is($child['activeOn']) ? 'active' : '' }}">
                            <i class="{{ $child['icon'] }} nav-icon"></i>
                            <p>{{ $child['title'] }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @else
        <li class="nav-item">
            <a href="{{ route($route) }}" class="nav-link {{ Route::is($activeOn) ? 'active' : '' }}">
                <i class="nav-icon {{ $icon }}"></i>
                <p>
                    {{ $title }}
                </p>
            </a>
        </li>
    @endif
@endif
