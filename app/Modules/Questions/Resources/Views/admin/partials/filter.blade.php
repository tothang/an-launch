<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Filter By Speaker</h3>
    </div>
    <div class="card-body">
        {!! Form::model(
            $stream,
            [
                'route' => [$route, $stream],
                'method' => 'GET',
            ],[
                'theme' => 'admin',
            ]
        ) !!}

        {!! Form::select(
            'speakers',
            $speakers,
            old('speakers'),
            [
                'class' => 'form-control',
                'multiple' => true,
            ]
        ) !!}

        {!! Form::submit(
            'Submit',
            'Filter',
            [
                'groupClasses' => 'mb-0'
            ]
        ) !!}

        {!! Form::close() !!}
    </div>
</div>
