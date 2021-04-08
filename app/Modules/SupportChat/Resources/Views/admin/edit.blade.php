@extends('layouts.admin.app')

@section('page-title', 'Support Chat')

@section('content')
  <div class="card card-primary card-outline">
    <div class="card-header with-border">
      <h3 class="card-title">Edit Support Chat</h3>
    </div>
    <div class="card-body">

      {!! Form::open([
          'route' => ['admin.support-chat.update', $supportChat],
          'action' => 'POST',
          'autocomplete' => 'off',
      ], [
          'theme' => 'admin'
      ]) !!}

      @csrf
      @method('PATCH')
      @include('support-chat::admin.form')

      {!! Form::close() !!}

    </div>
  </div>
@endsection
