{!! Form::text(
    'forename',
    old('forename', $admin->forename ?? ''),
    [
        'label' => 'Forename',
        'placeholder' => 'Enter forename',
        'required' => true,
    ]
) !!}

{!! Form::text(
    'surname',
    old('surname', $admin->surname ?? ''),
    [
        'label' => 'Surname',
        'placeholder' => 'Enter surname',
        'required' => true,
    ]
) !!}

{!! Form::email(
    'email',
    old('email', $admin->email ?? ''),
    [
        'label' => 'Email',
        'placeholder' => 'Enter email',
        'required' => true,
    ]
) !!}

{!! Form::select(
    'role',
    $roles,
    old('role', isset($admin) ? $admin->roles->first()->id : 0),
    [
        'label' => 'Role',
        'placeholder' => 'Choose role',
        'required' => true,
    ]
) !!}
