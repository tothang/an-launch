@extends('layouts.admin.app')

@section('page-title', 'Experience Content')

@section('content')

  <div class="card card-primary card-outline">
    <div class="card-header with-border">
      <h3 class="card-title">Content List</h3>
      <div class="card-tools">
        <a href="{{ route("{$route}.create") }}" class="btn btn-success btn-sm">Create
          Content</a>
      </div>
    </div>
    <div class="card-body">
      @foreach($experienceTypes as $type => $contents)
        <h2>{{ $type }}</h2>
        <table class="table">
          <thead>
          <tr>
            <th>#</th>
            <th>Ref</th>
            <th>Name</th>
            <th>Body</th>
            <th width="150px">Action</th>
          </tr>
          </thead>
          <tbody>
          @foreach($contents as $content)
            <tr>
              <td>{{ $content->id }}</td>
              <td>{{ $content->ref }}</td>
              <td>{{ $content->name }}</td>
              <td>{{ $content->body }}</td>
              <td>
                <a class="btn btn-primary" href="{{ route("{$route}.edit", $content) }}">Edit</a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      @endforeach
    </div>
  </div>
@endsection
