@if (Request::path() !== 'mail-preview' && isset($preview_mail_url))
    <div style="text-align: center; margin: 0px 0px 16px 0px; padding: 0;">
        <a style="color: #ffe34b; font-size: 14px; text-decoration: underline; font-family: Arial;" href="{{ $preview_mail_url  }}" target="_blank">
            {{ __('email.common.preview_in_browser', [], $locale) }}</a>
    </div>
@endif
