@extends('layouts.email.yale.password-reset.html')

@section('title', __('email.password_reset.yale.title', [], $locale))
@section('description', __('email.password_reset.yale.description', [], $locale))

@section('content')
@include('layouts.email.yale.email-preview')
<!--[if mso | IE]>
  <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:600px;" width="600">
    <tr>
      <td style="line-height:0;font-size:0;mso-line-height-rule:exactly;">
        <v:image style="border:0;height:431px;mso-position-horizontal:center;position:absolute;top:0;width:600px;z-index:-3;" src="{{ asset('/img/yale/email/yale-save-the-date-hero.jpg') }}" xmlns:v="urn:schemas-microsoft-com:vml" />
<![endif]-->
<div class="hero-inline" style="margin:0 auto;max-width:600px;">
  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
    <tr style="vertical-align:top;">
      <td style="width:0.01%;padding-bottom:72%;mso-padding-bottom-alt:0;"></td>
      <td class="only-mobile" style="background:white">
        <img style="width: 100%;padding-top:60px;padding-bottom:60px;background:white" src="{{ asset('/img/yale/email/yale-header.png') }}">
      </td>
      <td class="only-mobile" style="background:white">
        <img class="registration-confirmation-img" style="width:100%;background:white;" src="{{ asset('/img/yale/email/rc-bg.png') }}">
      </td>

      <td class="no-mobile" background="{{ asset('/img/yale/email/yale-save-the-date-hero.jpg') }}" style="background: #fffffd url('{{ asset('/img/yale/email/yale-save-the-date-hero.jpg') }}') no-repeat center center / cover; background-position: center top; background-repeat: no-repeat; padding-top: 160px; vertical-align: top; background-size: 600px 431px;" valign="top">
        <!--[if !mso]>-->
        <div class="mj-hero-content" style="margin:0px auto;width:100%;">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;margin:0px;">
                <tr>
                    <td style="">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;margin:0px;">

                            <tr>
                                <td align="left" class="dark-hero-text-large fallback-hero-large" style="padding-top: 0;">
                                    <img class="registration-confirmation-img" style="width: 600px; height: 300px; margin-top: -25px;" src="{{ asset('/img/yale/email/reset-password-bg.png') }}">
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!--<![endif]-->
    </td>

      <td style="width:0.01%;padding-bottom:72%;mso-padding-bottom-alt:0;"></td>
    </tr>
    <!--[if mso | IE]>
    <tr>
        <td valign="top">
          <img width="600" height="300" class="registration-confirmation-img" style="width:600px;height:300px;margin-top:-25px;" src="{{ asset('/img/yale/email/reset-password-bg.png') }}">
        </td>
    </tr>
    <![endif]-->
  </table>
</div>
<!--[if mso | IE]>
      </td>
    </tr>
  </table>
<![endif]-->

<!--[if mso | IE]>
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600">
    <tr>
      <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
<![endif]-->
<div style="background:#fffffd;background-color:#fffffd;Margin:0px auto;max-width:600px;">
  <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
    style="background:#fffffd;background-color:#fffffd;width:100%;">
    <tbody>
      <tr>
        <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:80px;padding-top:50px;text-align:center;vertical-align:top;" class="email-main-body">
          <!--[if mso | IE]>
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td class="" style="vertical-align:top;width:600px;">
          <![endif]-->
          <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
              <tbody>
                <tr>
                  <td style="vertical-align:top;padding:0;padding-right:55px;padding-left:55px;">
                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="" width="100%">
                      <tr>
                        <td align="left" style="font-size:0px;padding:0;word-break:break-word;">
                          <div style="font-family:Arial Narrow, Arial, Helvetica, sans-serif;font-size:19px;line-height:1;text-align:left;color:#3e4545;">
                            <p style="margin-top: 25px; margin-bottom: 5px;">
                              <span style="font-weight:600;color:#3e4545;letter-spacing:0.76px">
                              {{ __('email.common.dear', [], $locale) }},
                              </span>
                            </p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td align="left" style="font-size:0px;padding:0;word-break:break-word;">
                          <div style="font-family: 'DINNextLTPro-Regular', Arial, sans-serif;font-size:14px;line-height:23px;text-align:left;color:#3e4545;">
                            <p style="margin-top: 25px; margin-bottom: 25px;">
                              {!! __('email.password_reset.yale.content', [], $locale) !!}
                            </p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td align="left" vertical-align="middle"
                            style="font-size:0px;padding:30px 0;word-break:break-word;">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                   style="border-collapse:separate;line-height:100%;">
                                <tr>
                                    <td align="center" bgcolor="#e5a713" role="presentation"
                                        style="border:none;border-radius:7px;cursor:auto;padding:15px 50px;background:#e5a713;"
                                        valign="middle">
                                        <a href="{{ route('set-password.show', ['token' => $token_login, 'reset_password' => true]) }}"
                                           style="background:#e5a713;color:black;font-family:Arial, Helvetica, sans-serif;font-size:16px;font-weight:600;line-height:120%;Margin:0;text-decoration:none;text-transform:none;"
                                           target="_blank">
                                            <strong>{!! __('email.common.reset_password', [], $locale) !!}</strong>
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                      {{-- <tr>
                        <td align="left" style="font-size:0px;padding:0;word-break:break-word;">
                          <div style="font-family: 'DINNextLTPro-Regular', Arial, sans-serif;font-size:14px;line-height:23px;text-align:left;color:#3e4545;">
                            <p style="margin-top: 25px; margin-bottom: 25px;">{!! __('email.save_the_date.yale.thank', [], $locale) !!}</p>
                            <p style="margin-top: 25px; margin-bottom: 25px;">
                              <strong><span style="font-weight:900">{{ __('email.save_the_date.yale.signature', [], $locale) }}</span></strong></p>
                          </div>
                        </td>
                      </tr> --}}
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!--[if mso | IE]>
                </td>
              </tr>
            </table>
          <![endif]-->
        </td>
      </tr>
    </tbody>
  </table>
</div>
<!--[if mso | IE]>
      </td>
    </tr>
  </table>
<![endif]-->

@endsection
