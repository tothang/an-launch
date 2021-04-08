@extends('layouts.admin.app')

@section('page-title', 'Experience Content')

@section('content')
  <div class="card card-outline card-primary">
    <div class="card-header with-border">
      <h3 class="card-title">Create Content</h3>
      <div class="card-tools">
        <a href="{{ route("{$route}.index") }}" class="btn btn-danger btn-sm">Cancel</a>
      </div>
    </div>
    <div class="card-body">

      {!! Form::open(
           [
               'url' => route("{$route}.store"),
               'method' => 'POST',
           ],
           [
               'theme' => 'admin',
           ]
      ) !!}

      @csrf
      @include('experience::admin.content.partials.form')

      <hr>

      {!! Form::submit(
          'submit',
          'Submit'
      ) !!}

      {!! Form::close() !!}

    </div>
  </div>
@endsection
