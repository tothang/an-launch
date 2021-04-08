<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @if (isHyster())
      <a href="{{ route('admin.dashboard') }}" class="brand-link" style="display: flex; width: 100%">
        <img style="width: 100%" src="{{ asset('img/admin/hyster-logo.png') }}" alt="Logo" class="brand-image">
        <img src="{{ asset('img/admin/hyster-logo.png') }}" alt="Mini Logo" class="brand-image brand-image--mini">
      </a>
    @else
      <a href="{{ route('admin.dashboard') }}" class="brand-link" style="display: flex; width: 100%">
        <img style="width: 100%" src="{{ asset('img/admin/yale-logo.png') }}" alt="Logo" class="brand-image">
        <img src="{{ asset('img/admin/yale-logo.png') }}" alt="Mini Logo" class="brand-image brand-image--mini">
      </a>
    @endif

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($adminMenu as $item)
                    @include('layouts.admin.partials.nav-item', $item)
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
