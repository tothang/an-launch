@component('admin.components.section', ['header' => 'Import admins'])
    <div class="alert alert-warning" role="alert">
        Each imported admin will receive an email inviting them to create their password and access the admin area.
    </div>

    {!! Form::open([
        'route' => 'admin.admins.import',
        'method' => 'POST',
        'files' => true
    ], [
        'theme' => 'admin'
    ]) !!}

    {!! Form::file(
        'import',
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
