{!! Form::text(
    'title',
    old('title', $breakout->title ?? ''),
    [
        'label' => 'Title',
        'placeholder' => 'Enter the title',
        'required' => true,
    ]
) !!}

{!! Form::text(
    'link',
    old('link', $breakout->link ?? ''),
    [
        'label' => 'Link',
        'placeholder' => 'Enter the link',
        'required' => true,
    ]
) !!}

{!! Form::text(
    'description',
    old('description', $breakout->description ?? ''),
    [
        'label' => 'Description',
        'placeholder' => 'Enter the description',
    ]
) !!}
