<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
  xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <title>
      @yield('title')
  </title>
  <!--[if !mso]><!-- -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

  <style type="text/css">
    #outlook a {
      padding: 0;
    }

    * {
      font-family: 'DINNextLTPro-Regular', Arial, sans-serif;
    }

    .ReadMsgBody {
      width: 100%;
    }

    .ExternalClass {
      width: 100%;
    }

    .ExternalClass * {
      line-height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    table,
    td {
      border-collapse: collapse;
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    p {
      display: block;
      margin: 13px 0;
    }

  </style>
  <!--[if !mso]><!-->
  <style type="text/css">
    @media only screen and (max-width:480px) {
      @-ms-viewport {
        width: 320px;
      }

      @viewport {
        width: 320px;
      }
    }

  </style>
  <!--<![endif]-->
  <!--[if mso]>
    <xml>
    <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
  <![endif]-->
  <!--[if lte mso 11]>
    <style type="text/css">
      .outlook-group-fix { width:100% !important; }
    </style>
  <![endif]-->

  <style type="text/css">
    @media only screen and (min-width:480px) {
      .mj-column-per-100 {
        width: 100% !important;
        max-width: 100%;
      }
    }

  </style>


  <style type="text/css">


  </style>
  <style type="text/css">
    .body {
      min-width: 600px;
    }

    @media (prefers-color-scheme: dark) {
      .dark-hero-text-large {
        color: #e5a713 !important;
      }

      .dark-hero-text-small {
        color: #3e4545 !important;
      }
    }

    [data-ogsc] .dark-hero-text-large {
      color: #e5a713 !important;
    }

    [data-ogsc] .dark-hero-text-small {
      color: #3e4545 !important;
    }

  </style>
  <meta name="x-apple-disable-message-reformatting">
  <meta name="color-scheme" content="light dark">
  <meta name="supported-color-schemes" content="light dark">
  <!--[if mso]>
    <style type=???text/css???>
      .fallback-hero-large {
        font-size:80px!important;
        line-height:70px!important;
      }
    </style>
  <![endif]-->
  <style>
    body {
      background-color: #dddddd;
    }
    .only-mobile {
      display: none;
    }
    .email-main-body{
      background:#fffffd;background-color:#fffffd;
    }
    @media only screen and (max-width:600px) {
      body {
        background-color: white;
      }
      .no-mobile {
        display: none;
        background-color: white;
      }
      .only-mobile {
        display: block;
      }
      .email-main-body {
        background-image: url({{ asset('/img/yale/rectangle-2.png') }});
        background-repeat: no-repeat;
        background-size: 200%;
      }
    }
  </style>
</head>

<body>
  <div style="display:none;font-size:1px;color:#ffffff;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">
    @yield('description')
  </div>
  <div class="body body-inline" style="background-color: #dddddd;">
    {{-- HEADER --}}
    @include('layouts.email.yale.header')

    {{-- CONTENT --}}
    @yield('content')

    {{-- FOOTER --}}
    @include('layouts.email.yale.footer')
  </div>
</body>

</html>
