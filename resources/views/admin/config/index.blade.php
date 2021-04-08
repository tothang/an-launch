@extends('layouts.admin.app')

@section('page-title', 'Configuration')

@section('content')
    @component('admin.components.section', ['header' => 'Config list'])
        <table class="table data-table">
            <thead>
                <th width="30px">#</th>
                <th>Key</th>
                <th>Value</th>
                <th>Actions</th>
            </thead>
            <tbody>
            @foreach($configs as $config)
                <tr>
                    <form action="{{ route('admin.config.update', $config) }}" method="POST">
                        <input type="hidden" name="_method" value="PATCH">
                        {{ csrf_field() }}
                        <td>{{ $config->id }}</td>
                        <td>{{ $config->key }}</td>
                        <td>
                            @if($config->key === 'technical_issues_message')
                                <textarea name="value" class="form-control">{{ $config->value }}</textarea>
                            @else
                                <input type="text" name="value" value="{{ $config->value }}" class="form-control">
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-success" type="submit">Save</button>
                        </td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endcomponent
@endsection
