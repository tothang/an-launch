<table align="{{ $align ?? 'left' }}" bgcolor="{{ $bgColour ?? 'ffffff' }}" style="color: {{ $colour ?? '#000000' }}; padding: {{ $padding ?? '0' }}; margin: {{ $margin ?? '0' }}" width="600" cellspacing="0" cellpadding="0" border="0">
    <tr align="{{ $align ?? 'left' }}">
        <td width="600">{{ $slot }}</td>
    </tr>
</table>
