
<li>
  <div class="item">
    <span class="font-bold mt-6">
      {{ Carbon::parse($group)->isoFormat('dddd Do MMMM') }} {{ $agendaItem->time }}
    </span>
    <span class="description">
            {{ $agendaItem->title }}<br>
      <small>{{ $agendaItem->description }}</small>
    </span>
  </div>
</li>
