<div class="{{ isYale() ? 'card mb-2' : 'card' }} {{ $customMarginClass }}">
  <a href="{{ $redirect }}" class="card-body" style="background-image: {{ $url }};">
    @if ($img)
      <img src="{{ $img }}" alt="img" srcset="">
    @endif
    @if ($label)
      <span class="card-label {{ $lableClass }}">{{ $label }}</span>
    @endif
    @if ($label1)
      <span class="card-label-1">{!! $label1 !!}</span>
    @endif
    @if ($title)
      <span class="card-title">{!! $title !!}</span>
    @endif
  </a>
</div>
