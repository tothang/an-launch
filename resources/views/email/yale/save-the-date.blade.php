@extends('layouts.email.yale.html')

@section('title', __('email.save_the_date.yale.title', [], $locale))

@section('description', __('email.save_the_date.yale.description', [], $locale))

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

      <td background="{{ asset('/img/yale/email/yale-save-the-date-hero.jpg') }}"
        style="background: #fffffd url('{{ asset('/img/yale/email/yale-save-the-date-hero.jpg') }}') no-repeat center center / cover; background-position: center center; background-repeat: no-repeat; padding: 189px 0 70px 0; vertical-align: top; background-size: 600px 431px;"
        valign="top">
        <!--[if mso | IE]>
          <table border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600">
            <tr>
              <td style="">
        <![endif]-->
        <div class="mj-hero-content" style="margin:0px auto;width:100%;">
          <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;margin:0px;">
            <tr>
              <td style="">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;margin:0px;">
                  <tr>
                    <td align="left" class="dark-hero-text-large fallback-hero-large"
                      style="font-size:0px;padding:0 25px 0 50px;word-break:break-word;">
                      <?php
                        $fontSize = '60px';
                        if (in_array($locale, ['ru', 'cs', 'it', 'nl'])) $fontSize = '40px';
                      ?>
                      <div style="font-family: 'DINNextLTPro-Regular', Arial, sans-serif;font-size:{!! $fontSize !!};font-weight:600;line-height:70px;text-align:left;color:#e5a713;">
                        <span class="dark-hero-text-large fallback-hero-large"
                          style="font-size:{!! $fontSize !!};line-height:70px;font-weight:bold;letter-spacing:-4px;">
                          {!! __('email.save_the_date.yale.mail_type', [], $locale) !!}
                        </span>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td align="left" class="dark-hero-text-small"
                      style="font-size:0px;padding:5px 25px 0 50px;word-break:break-word;">
                      <div style="font-family: 'DINNextLTPro-Regular', Arial, sans-serif;font-size:22px;line-height:22px;text-align:left;color:#3e4545;">
                        <span class="dark-hero-text-small" style="color:#3e4545!important;font-size:22px;line-height:22px;">
                          {!! __('email.save_the_date.yale.event_date', [], $locale) !!}
                        </span>
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

      <td style="width:0.01%;padding-bottom:72%;mso-padding-bottom-alt:0;"></td>
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
<div style="background:#fffffd;background-color:#fffffd;Margin:0px auto;max-width:600px;">
  <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
    style="background:#fffffd;background-color:#fffffd;width:100%;">
    <tbody>
      <tr>
        <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:80px;padding-top:50px;text-align:center;vertical-align:top;">
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
                              {{ __('email.save_the_date.yale.dear', [], $locale) }},
                              </span>
                            </p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td align="left" style="font-size:0px;padding:0;word-break:break-word;">
                          <div style="font-family: 'DINNextLTPro-Regular', Arial, sans-serif;font-size:14px;line-height:23px;text-align:left;color:#3e4545;">
                            <p style="margin-top: 25px; margin-bottom: 25px;">
                              {!! __('email.save_the_date.yale.content', [], $locale) !!}
                            </p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td>
                            <div><!--[if mso]>
                                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{$url}}" style="height:50px;v-text-anchor:middle;width:{{$view_video_trailer_button_width}};" arcsize="50%" stroke="f" fillcolor="#e5a713">
                                    <w:anchorlock/>
                                    <center>
                                <![endif]-->
                                <a href="{{ $url }}" target="_blank" style="background-color:#e5a713;border-radius:25px;color:#ffffff;display:inline-block;font-family:Arial, Helvetica, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:{{$view_video_trailer_button_width}};-webkit-text-size-adjust:none;">
                                    <strong>{{ __('email.save_the_date.yale.view_video_trailer', [], $locale) }}</strong>
                                </a>
                                <!--[if mso]>
                                </center>
                                </v:roundrect>
                                <![endif]--></div>
                        </td>
                      </tr>

                      <tr>
                        <td align="left" style="font-size:0px;padding:0;word-break:break-word;">
                          <div style="font-family: 'DINNextLTPro-Regular', Arial, sans-serif;font-size:14px;line-height:23px;text-align:left;color:#3e4545;">
                            <p style="margin-top: 25px; margin-bottom: 25px;">{!! __('email.save_the_date.yale.content_2', [], $locale) !!}</p>
                            <p style="margin-top: 25px; margin-bottom: 25px;">{!! __('email.save_the_date.yale.thank', [], $locale) !!}</p>
                            <p style="margin-top: 25px; margin-bottom: 25px;">
                              <strong><span style="font-weight:900">{{ __('email.save_the_date.yale.signature', [], $locale) }}</span></strong></p>
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
