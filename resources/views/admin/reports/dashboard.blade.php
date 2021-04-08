<table>
    <tbody>
    @foreach($dashboardItems as $item)
        @if(isset($item['title'], $item['stat']))
            <tr>
                <td><strong>{{ $item['title'] }}</strong></td>
                <td>{{ $item['stat'] }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
