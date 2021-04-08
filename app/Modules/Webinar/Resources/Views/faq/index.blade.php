@extends('layouts.app')

@section('title', 'FAQ')
@section('body-class', 'faq')
@section('content')
  <div class="container {{ isHyster() ? 'hyster' : 'yale' }}">
    {{-- TODO implement UI --}}
    <ul class="faq-content">
      <li>
        <p class="title">
          {!! __('faq.title') !!}
        </p>
      </li>
      <li>
        <p class="font-bold">
          {{ __('faq.able_to_attend') }}
        </p>
        <p>
          {{ __('faq.yes_on_demand') }}
        </p>
      </li>
      <li>
        <p class="font-bold">
          {{ __('faq.can_change_language') }}
        </p>
        <p>
          {{ __('faq.yes_you_can_language') }}
        </p>
      </li>
      <li>
        <p class="font-bold">
          {{ __('faq.what_devices') }}
        </p>
        <p>
          {{ __('faq.use_devices') }}
        </p>
      </li>
      <li>
        <p class="font-bold">
          {{ __('faq.how_can_i_ask') }}
        </p>
        <p>
          {{ __('faq.there_is_a_Q&A') }}
        </p>
      </li>
      <li>
        <p class="font-bold">
          {{ __('faq.how_find_regional') }}
        </p>
        <p>
          {{ __('faq.notification_pop_up') }}
        </p>
      </li>
      <li>
        <p class="font-bold">
          {{ __('faq.if_cannot_find_region') }}
        </p>
        <p>
          {{ __('faq.pls_click_chat') }}
        </p>
      </li>
      <li>
        <p class="font-bold">
          {{ __('faq.what_happen_if_wrong_region') }}
        </p>
        <p>
          {{ __('faq.pls_click_to_get_correct_link') }}
        </p>
      </li>
      <li>
        <p class="font-bold">
          {{ __('faq.what_browsers') }}
        </p>
        <p>
          {{ __('faq.need_use_chrome') }}
        </p>
      </li>
      <li>
        <p class="font-bold">
          {{ __('faq.broadcast_lagging') }}
        </p>
        <p>
          {!! __('faq.ensure_you_are_connected') !!}
        </p>
      </li>
    </ul>
  </div>
@endsection
