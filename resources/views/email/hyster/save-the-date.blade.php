@extends('layouts.email.hyster.html')

@section('title', __('email.save_the_date.hyster.title', [], $locale))

@section('description', __('email.save_the_date.hyster.description', [], $locale))

@section('content')
@include('layouts.email.hyster.email-preview')
  <!--[if mso | IE]>
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:600px;" width="600">
      <tr>
        <td  style="line-height:0;font-size:0;mso-line-height-rule:exactly;">
          <v:image style="border:0;height:431px;mso-position-horizontal:center;position:absolute;top:0;width:600px;z-index:-3;" src="{{asset('/img/hyster/email/hyster-save-the-date-hero.jpg')}}" xmlns:v="urn:schemas-microsoft-com:vml" />
  <![endif]-->
  <div class="hero-inline" style="margin:0 auto;max-width:600px;">
    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
      <tr style="vertical-align:top;">
        <td style="width:0.01%;padding-bottom:72%;mso-padding-bottom-alt:0;">
        </td>
        <td background="{{asset('/img/hyster/email/hyster-save-the-date-hero.jpg')}}"
          style="background: #000000 url('{{asset('/img/hyster/email/hyster-save-the-date-hero.jpg')}}') no-repeat center center / cover; background-position: center center; background-repeat: no-repeat; padding: 125px 0 70px 0; vertical-align: top; background-size: 600px 431px;"
          valign="top">
          <!--[if mso | IE]>
            <table border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600">
              <tr>
                <td  style="">
          <![endif]-->
          <div class="mj-hero-content" style="margin:0px auto;width:100%;">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;margin:0px;">
              <tr>
                <td style="">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;margin:0px;">
                    <tr>
                      <td align="left" class="dark-hero-text-large fallback-hero-large"
                        style="font-family: 'BebasNeue-Regular', Arial, sans-serif;font-size:0px;padding:0 25px 0 125px;word-break:break-word;">
                        <?php
                            $fontSize = '60px';
                            if (in_array($locale, ['ru', 'cs', 'it', 'nl'])) $fontSize = '40px';
                        ?>
                        <div
                          style="font-family: 'BebasNeue-Regular', Arial, sans-serif;font-size:{!! $fontSize !!};font-weight:600;line-height:70px;text-align:left;color:#ffffff;">
                          <span class="dark-hero-text-large fallback-hero-large"
                            style="font-family: 'BebasNeue-Regular', Arial, sans-serif;font-size:{!! $fontSize !!};line-height:70px;font-weight:bold;text-transform:uppercase;">{!! __('email.save_the_date.hyster.mail_type', [], $locale) !!}</span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td align="left" class="dark-hero-text-small"
                        style="font-family: 'BebasNeue-Regular', Arial, sans-serif;font-size:0px;padding:0 25px 0 125px;word-break:break-word;">
                        <div
                          style="font-family: 'BebasNeue-Regular', Arial, sans-serif;font-size:26px;font-weight:600;line-height:26px;text-align:left;color:#ffe34b;">
                          <span class="dark-hero-text-small"
                            style="font-family: 'BebasNeue-Regular', Arial, sans-serif;color:#ffe34b!important;font-size:26px;line-height:26px;text-transform:uppercase;">{{ __('email.save_the_date.hyster.event_date', [], $locale) }}</span>
                        </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
          <!--[if mso | IE]>
                </td>
              </tr>
            </table>
          <![endif]-->
        </td>
        <td style="width:0.01%;padding-bottom:72%;mso-padding-bottom-alt:0;">
        </td>
      </tr>
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
  <div style="background:#000000;background-color:#000000;margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
      style="background:#000000;background-color:#000000;width:100%;">
      <tbody>
        <tr>
          <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:80px;padding-top:50px;text-align:center;">
            <!--[if mso | IE]>
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="" style="vertical-align:top;width:600px;">
            <![endif]-->
            <div class="mj-column-per-100 mj-outlook-group-fix"
              style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
              <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                <tbody>
                  <tr>
                    <td style="vertical-align:top;padding:0;padding-right:55px;padding-left:55px;">
                      <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="" width="100%">
                        <tr>
                          <td align="left" style="font-size:0px;padding:0;word-break:break-word;">
                            <div
                              style="font-family: 'BebasNeue-Regular', Arial, sans-serif;font-size:19px;line-height:1;text-align:left;color:#ffe34b;">
                              <p style="margin-top: 25px; margin-bottom: 10px;">
                                <span style="font-family: 'BebasNeue-Regular', Arial, sans-serif;font-weight:600;color:#ffe34b;letter-spacing:0.76px">
                                  {{ __('email.save_the_date.hyster.dear', [], $locale) }},
                                </span>
                              </p>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td align="left" style="font-size:0px;padding:0;word-break:break-word;">
                            <div
                              style="font-family:Arial, Helvetica, sans-serif;font-size:14px;line-height:23px;text-align:left;color:#fffffe;">
                              <p style="font-family:Arial, Helvetica, sans-serif;margin-top: 25px; margin-bottom: 25px;">{!! __('email.save_the_date.hyster.content', [], $locale) !!}</p>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td align="left" vertical-align="middle"
                            style="font-size:0px;padding:20px 0;word-break:break-word;">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                              style="border-collapse:separate;line-height:100%;">
                              <tr>
                                <td align="center" bgcolor="transparent" role="presentation"
                                  style="border:2px solid #fffffe;border-radius:0;cursor:auto;mso-padding-alt:10px 15px;background:transparent;"
                                  valign="middle">
                                  <a href="{{ $url }}"
                                    style="display:inline-block;background:transparent;color:white;font-family: 'BebasNeue-Regular', Arial, sans-serif;font-size:19px;font-weight:600;line-height:120%;letter-spacing:0.76px;margin:0;text-decoration:none;text-transform:none;padding:10px 15px;mso-padding-alt:0px;border-radius:0;"
                                    target="_blank"><strong>{{ __('email.save_the_date.hyster.view_video_trailer', [], $locale) }}</strong></a>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td align="left" style="font-size:0px;padding:0;word-break:break-word;">
                            <div
                              style="font-family:Arial, Helvetica, sans-serif;font-size:14px;line-height:23px;text-align:left;color:#fffffe;">
                              <p style="font-family:Arial, Helvetica, sans-serif;margin-top: 25px; margin-bottom: 25px;">{!! __('email.save_the_date.hyster.content_2', [], $locale) !!}</p>
                              <p style="font-family:Arial, Helvetica, sans-serif;margin-top: 25px; margin-bottom: 25px;">{!! __('email.save_the_date.hyster.thank', [], $locale) !!}</p>
                              <p style="font-family:Arial, Helvetica, sans-serif;margin-top: 25px; margin-bottom: 25px;"><strong><span
                                    style="font-family:Arial, Helvetica, sans-serif;font-weight:900">{{ __('email.save_the_date.hyster.signature', [], $locale) }}</span></strong></p>
                            </div>
                          </td>
                        </tr>
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
