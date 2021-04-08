<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>EnvX Email</title>
        <style>
            body {
                font-family: Helvetica, Arial, sans-serif;
            }
            img {
                vertical-align: bottom;
            }
            table {
                border-spacing: 0;
            }
        </style>
    </head>
    <body>
        <table width="100%">
            <tr>
                <td align="center">
                    <table width="600">
                        <tr>
                            <td align="left">
                                @include('layouts.email.partials.header')

                                @yield('content')

                                @include('layouts.email.partials.footer')
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        @isset($tracker)
            <img src="{{ route('emails.track', $tracker) }}" style="height: 0; width: 0" alt="image"/>
        @endisset
    </body>
</html>
