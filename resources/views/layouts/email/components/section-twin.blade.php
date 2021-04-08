<table align="{{ $align ?? 'left' }}" bgcolor="{{ $bgColour ?? 'ffffff' }}" style="color: {{ $colour ?? '#000' }}; padding: {{ $padding ?? '0' }}; margin: {{ $margin ?? '0' }}" width="600" cellspacing="0" cellpadding="0" border="0">
    <tr align="{{ $align ?? 'left' }}">
        <td
            bgcolor="{{ $leftBgColour ?? $bgColour ?? 'ffffff'  }}"
            width="{{ $leftWidth ?? '300' }}"
            style="color: {{ $colour ?? '#000' }}; padding:{{ $leftPadding ?? '0' }}; margin:{{ $leftMargin ?? '0' }};"
            align="{{ $leftAlign ?? 'left' }}"
        >
            {{ $left }}
        </td>
        <td
            bgcolor="{{ $rightBgColour ?? $bgColour ?? 'ffffff'  }}"
            width="{{ 600 - ($leftWidth ?? 300) }}"
            style="color: {{ $colour ?? '#000' }}; padding:{{ $rightPadding ?? '0' }}; margin:{{ $rightMargin ?? '0' }};"
            align="{{ $rightAlign ?? 'left' }}"
        >
            {{ $right }}
        </td>
    </tr>
</table>
