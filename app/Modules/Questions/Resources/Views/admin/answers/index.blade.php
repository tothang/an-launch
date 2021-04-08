@extends('layouts.admin.app')

@section('page-title', $stream->name . ' - Answer Management')

@section('content')
    @include('questions::admin.partials.nav')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Answer List</h3>
            <div class="card-tools">
                <a href="{{ route('admin.questions.answers.create', $stream) }}" class="btn btn-success btn-sm">Create Answer</a>
            </div>
        </div>
        <div class="card-body">

            <table class="table data-table">
                <thead>
                    <th width="30px">#</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Asked By</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach($answers as $answer)
                    <tr>
                        <td>{{ $answer->id }}</td>
                        <td>{{ $answer->question }}</td>
                        <td>{{ $answer->answer }}</td>
                        <td>{{ $answer->asked_by }}</td>
                        <td>
                            <a href="{{ route('admin.questions.answers.edit', $answer) }}" class="btn btn-info btn-sm btn-block"><i class="fa fa-edit"></i> Edit</a>
                            <form class="form-inline" action="{{ route('admin.questions.answers.destroy', $answer) }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

     <div class="card card-primary card-outline">
         <div class="card-header with-border">
             <h3 class="card-title">Import Answers</h3>
         </div>
         <div class="card-body">
             <form action="{{ route('admin.questions.answers.import', $stream) }}" method="POST" enctype="multipart/form-data">
                 {!! csrf_field() !!}

                 <div class="form-group">
                     <label for="import">Answer list to import</label>
                     <input type="file" name="import">
                 </div>

                 <div class="form-group">
                     <button class="btn btn-primary pull-right">Import List</button>
                 </div>

             </form>
         </div>
     </div>
@endsection
