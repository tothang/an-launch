@extends('layouts.app')

@section('title', 'FAQ')
@section('body-class', 'agenda')
@section('content')
  <div class="container {{ isHyster() ? 'hyster' : 'yale' }}">
    {{-- TODO implement UI --}}
    <ul class="agenda-content">
      <li>
        <p class="title">
          {!! __('agenda.title') !!}
        </p>

        @if (isHyster())
          <hr class="red-line" />
        @endif

      </li>

      <li class="agenda-time-wrapper">
        <p class="font-bold time-item" agenda>
          {{ isHyster() ? __('agenda.hyster_time_1') :  __('agenda.yale_time_1') }}
        </p>

        <p class="font-bold time-item" agenda>
          {{ isHyster() ? __('agenda.hyster_time_2') :  __('agenda.yale_time_2') }}
        </p>

        <p class="font-bold time-item" agenda>
          {{ isHyster() ? __('agenda.hyster_time_3') :  __('agenda.yale_time_3') }}
        </p>
      </li>

      <li class="under-line">
        <p>
          {{ isHyster() ? __('agenda.hyster_row_1') :  __('agenda.yale_row_1')  }}
        </p>
      </li>
      <li class="under-line">
        <p>
          {{ __('agenda.row_2') }}
        </p>
      </li>
      <li class="under-line">
        <p>
          {{ __('agenda.row_3') }}
        </p>
      </li>
      <li class="under-line">
        <p>
          {{ isHyster() ? __('agenda.hyster_row_4') :  __('agenda.yale_row_4')  }}
        </p>
      </li>
      <li class="under-line">
        <p>
          {{ isHyster() ? __('agenda.hyster_row_5') :  __('agenda.yale_row_5')  }}
        </p>
      </li>
      <li class="under-line">
        <p>
          {{ __('agenda.row_6') }}
        </p>
      </li>
    </ul>
  </div>
@endsection
