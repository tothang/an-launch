{!! Form::select(
    'title',
    $titles,
    old('title', isset($user) ? $user->title : 0),
    [
        'label' => 'Title',
        'placeholder' => 'Choose title',
        'required' => true,
    ]
) !!}

{!! Form::text(
    'forename',
    old('forename', $user->forename ?? ''),
    [
        'label' => 'First name',
        'placeholder' => 'Enter first name',
        'required' => true,
    ]
) !!}

{!! Form::text(
    'surname',
    old('surname', $user->surname ?? ''),
    [
        'label' => 'Last name',
        'placeholder' => 'Enter last name',
        'required' => true,
    ]
) !!}

{!! Form::email(
    'email',
    old('email', $user->email ?? ''),
    [
        'label' => 'Email address',
        'placeholder' => 'Enter email address',
        'required' => true,
    ]
) !!}

{!! Form::select(
    'brand',
    $brands,
    old('brand', isset($user) ? $user->brand : $brand),
    [
        'label' => 'Brand',
        'placeholder' => 'Choose brand',
        'required' => true,
        'disabled' => true
    ]
) !!}


{!! Form::select(
    'language',
    $languages,
    old('language', isset($user) ? $user->language : 0),
    [
        'label' => 'Language',
        'placeholder' => 'Choose language',
        'required' => true,
    ]
) !!}

{!! Form::select(
    'role',
    $roles,
    old('role', isset($user) ? $user->role : 0),
    [
        'label' => 'Role',
        'placeholder' => 'Choose role',
        'required' => true,
    ]
) !!}


{!! Form::text(
    'dealership_name',
    old('dealership_name', $user->dealership_name ?? ''),
    [
        'label' => 'Dealership Name',
        'placeholder' => 'Enter Dealership Name',
        'required' => false,
        'class' => 'dealership_name_class'
    ]
) !!}

{!! Form::text(
    'employee_function',
    old('employee_function', $user->employee_function ?? ''),
    [
        'label' => 'Employee Function',
        'placeholder' => 'Enter Employee Function',
        'required' => false,
        'class' => 'employee_function_class'
    ]
) !!}

{!! Form::text(
    'country_office_location',
    old('country_office_location', $user->country_office_location ?? ''),
    [
        'label' => 'Country / Office Location',
        'placeholder' => 'Enter Country / Office Location',
        'required' => false,
    ]
) !!}

{!! Form::text(
    'breakout_group',
    old('breakout_group', $user->breakout_group ?? ''),
    [
        'label' => 'Breakout group',
        'placeholder' => 'Enter breakout group',
        'required' => false,
    ]
) !!}

{!! Form::text(
    'region',
    old('region', $user->region ?? ''),
    [
        'label' => 'Region',
        'placeholder' => 'Enter region',
        'required' => false,
    ]
) !!}

{!! Form::text(
    'city',
    old('city', $user->city ?? ''),
    [
        'label' => 'City',
        'placeholder' => 'Enter city',
        'required' => false,
    ]
) !!}


@push('js')
    <script>
        $( document ).ready(function() {
            let value = $('#role').val();
            if (value === 'Dealer') {
                $('#dealership_name').parent().show();
                $('#employee_function').parent().hide();
            } else if (value === 'Employee') {
                $('#dealership_name').parent().hide();
                $('#employee_function').parent().show();
            } else {
                $('#dealership_name').parent().hide();
                $('#employee_function').parent().hide();
            }
        });

        $('#role').change(function (){
            let value = $(this).val();
            if (value === 'Dealer') {
                $('#dealership_name').parent().show();
                $('#employee_function').parent().hide();
            } else if (value === 'Employee') {
                $('#dealership_name').parent().hide();
                $('#employee_function').parent().show();
            } else {
                $('#dealership_name').parent().hide();
                $('#employee_function').parent().hide();
            }
        });
    </script>
@endpush
