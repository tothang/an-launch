@component('admin.components.section', ['header' => 'Import Delegate'])
    {!! Form::open([
        'route' => 'admin.users.import',
        'method' => 'POST',
        'files' => true
    ], [
        'theme' => 'admin'
    ]) !!}

    @csrf

    {!! Form::file(
        'file',
        [
            'required' => true,
            'classes' => 'd-block mt-1',
        ]
    ) !!}

    {!! Form::submit(
        'submit',
        'Import'
    ) !!}

    {!! Form::close() !!}
@endcomponent
