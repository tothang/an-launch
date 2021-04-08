<table align="{{ $align ?? 'left' }}" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
    <tr align="{{ $align ?? 'left' }}">
        <td align="center" bgcolor="{{ $bgColour ?? '#000000' }}" role="presentation" style="border:none;border-radius:6px;cursor:auto;padding:11px 20px;background:{{ $bgColour ?? '#000000' }};" valign="middle">
            <a href="{{ $link }}" style="background:{{ $bgColour ?? '#000000' }};color:{{ $colour ?? '#ffffff' }};font-family:Helvetica, sans-serif;font-size:18px;font-weight:600;line-height:120%;Margin:0;text-decoration:none;text-transform:none;" target="_blank">
            {{ $slot }}
            </a>
        </td>
    </tr>
</table>
