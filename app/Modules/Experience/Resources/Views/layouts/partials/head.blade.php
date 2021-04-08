<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" id="metaViewport" content="user-scalable=no, initial-scale=1, width=device-width, viewport-fit=cover" data-tdv-general-scale="0.5"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.partials.head.favicon')

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="DRPG | 3D Virtual Tour"/>
    <meta name="theme-color" content="#FFFFFF"/>

    <script src="{{ s3asset('3dvista/lib/tdvplayer.js') }}"></script>
    <script src="{{ s3asset('3dvista/script.js') }}"></script>
    <link href="{{ s3asset('3dvista/locale/en.txt') }}" as="fetch" crossorigin="anonymous"/>
    <link href="{{ asset('css/experience.css') }}" rel="stylesheet">

    @include('layouts.partials.head.scripts')
</head>
