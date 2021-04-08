<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    @include('layouts.admin.partials.head.head')
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            @include('layouts.admin.partials.nav-top')
            @include('layouts.admin.partials.nav-left')

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <h1 class="m-0 text-dark">
{{--                            {{ ucfirst(strtolower(app()->view->getSections()['page-title'] ?? '')) }}--}}
                            {{ ucfirst(app()->view->getSections()['page-title'] ?? '') }}
                        </h1>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        @include('layouts.partials.alerts')
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>

            <footer class="main-footer">
                <strong>Copyright &copy; {{ date('Y') }} DRPG</strong>
                <span>All rights reserved.</span>
            </footer>

        </div>

        @stack('modal-stack')

        <script src="{{ asset('js/admin.js') }}"></script>
        @stack('js')
    </body>
</html>
