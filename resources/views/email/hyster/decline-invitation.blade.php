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
  <style type="text/css">
    #outlook a {
      padding: 0;
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
    .body {
      min-width: 600px;
    }

    @media (prefers-color-scheme: dark) {
      .dark-hero-text-large {
        color: #fffffe !important;
      }

      .dark-hero-text-small {
        color: #ffe34b !important;
      }
    }

    [data-ogsc] .dark-hero-text-large {
      color: #fffffe !important;
    }

    [data-ogsc] .dark-hero-text-small {
      color: #ffe34b !important;
    }

  </style>
  <meta name="x-apple-disable-message-reformatting">
  <meta name="color-scheme" content="light dark">
  <meta name="supported-color-schemes" content="light dark">
  <!--[if mso]>
    <style type=”text/css”>
      .fallback-hero-large {
        font-size:80px!important;
        line-height:70px!important;
      }
    </style>
  <![endif]-->
</head>
<body style="background-color:#000000;">
  @include('layouts.email.hyster.email-preview')

  <div
    style="display:none;font-size:1px;color:#ffffff;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">
    @yield('description')
  </div>

  <div class="body body-inline"
    style="background-image: linear-gradient(to bottom, rgba(43, 43, 43, 0), #2f2f2f 68%); background-color: #000000;">
    <!--[if mso | IE]>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
    <![endif]-->

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="900">
      <tr>
        <td align="center" bgcolor="#000" style="padding: 40px 0 30px 0;">
          <img src="{{ asset('/img/hyster/email/hyster-decline.png') }}" alt="decline invitation" width="600"
            style="display: block;" />
        </td>
      </tr>

      <tr>
        <td bgcolor="#000" style="background-image: linear-gradient(180deg, #000, #2F2F2F);">
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
            <tr>
              <td style="width: 150px"></td>
              <td
                style="font-family: Arial Narrow, Arial, Helvetica, sans-serif; font-size: 19px; line-height: 1; text-align: left; color:#ffe34b; background-color: #000; padding-left: 50px; padding-right: 50px;">
                <h3>{{ __('email.decline_invitation.hyster.dear', [], $locale) }},</h3>
              </td>
              <td style="width: 150px"></td>
            </tr>

            <tr>
              <td style="width: 150px"></td>
              <td align="left" style="font-size: 0px; padding: 0; word-break: break-word;  background-color: #000; padding-left: 50px; padding-right: 50px; padding-bottom: 40px;">
                <div
                  style="font-family:Arial, Helvetica, sans-serif;font-size:14px;line-height:23px;text-align:left;color:#fffffe;">
                  <p style="margin-top: 25px; margin-bottom: 25px; font-size: 16px;">
                    {!! __('email.decline_invitation.hyster.content_1', [], $locale) !!}
                  </p>

                  <p style="margin-top: 25px; margin-bottom: 25px; font-size: 16px;">
                    {!! __('email.decline_invitation.hyster.content_2', [], $locale) !!} <a style="font-weight:bold; color: #ffffff!important; text-decoration: none;" href="{{ 'mailto:' . config('services.email_contact.hyster') }}"><font color="white"><strong>{{ config('services.email_contact.hyster') }}</strong></font></a>
                  </p>
                  <p style="margin-top: 25px; margin-bottom: 25px; font-size: 16px;">
                    {!! __('email.decline_invitation.hyster.thank', [], $locale) !!}
                  </p>

                  <p style="margin-top: 25px; margin-bottom: 25px; font-size: 16px; font-weight: 700;">
                    {!! __('email.decline_invitation.hyster.signature', [], $locale) !!}
                  </p>
                </div>
              </td>
              <td style="width: 150px"></td>
            </tr>
          </table>

          @include('layouts.email.hyster.footer')
        </td>
      </tr>
    </table>

    <!--[if mso | IE]>
          </td>
        </tr>
      </table>
    <![endif]-->
  </div>
</body>

</html>
