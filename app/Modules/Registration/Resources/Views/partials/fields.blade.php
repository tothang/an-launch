<h3>
  {{ __('register.registration')}}
</h3>

@if (isHyster())
  <div class="line"></div>
@endif

<h4>
  {{ __('register.about_you') }}
</h4>

<div class="form-group">
  <label for="title" class="sr-only required">
      <span class="required-asterix">*</span>
  </label>

  <select class="form-control" name="title" id="title" required="">
      <option value="" selected="" disabled="">{{__('register.title')}}</option>

      @foreach ($titles as $title)
          <option value="{{$title}}" {{$title == old('title', $user->title ?? null) ? 'selected' : ''}}>{{ __('register.' . $title) }}</option>
        @endforeach
  </select>
</div>


{!! Form::text(
    'forename',
    old('forename', $registration->forename ?? null),
    [
        'placeholder' => __('register.forename'),
        'required' => true,
        'readonly' => true,
    ]
) !!}

{!! Form::text(
    'surname',
    old('surname', $registration->surname ?? null),
    [
        'placeholder' => __('register.surname'),
        'required' => true,
        'readonly' => true,
    ]
) !!}

{!! Form::email(
    'email',
    old('email', $registration->email ?? null),
    [
        'placeholder' => __('register.email'),
        'required' => true,
        'readonly' => true,
    ]
) !!}

@if ($user->role === 'Dealer')
  <h4>
    {{ isHyster() ? __('register.dealership_location') : __('register.your_dealership') }}
  </h4>
  {!! Form::text(
    'dealership_name',
    old('dealership_name', $user->dealership_name ?? ''),
    [
        'placeholder' => __('register.dealership_name'),
    ]
  ) !!}

  <div class="form-group">
    <label for="region" class="sr-only required">
        <span class="required-asterix">*</span>
    </label>

    <select class="form-control" name="region" id="region" required>
      <option value="" selected disabled>{{__('register.country')}}</option>
      @foreach ($countries as $country)
        <option value="{{$country}}" {{$country == old('region', $user->region ?? null) ? 'selected' : ''}}>
          {{$country}}
{{--          {{ __('country.' . $country)}}--}}
        </option>
      @endforeach
    </select>
</div>
@endif

@if ($user->role === 'Employee')
  {!! Form::text(
    'employee_function',
    old('employee_function', $user->employee_function ?? ''),
    [
        'placeholder' => __('register.job_title'),
        'class' => 'employee_function_class'
    ]
  ) !!}

  <h4>
    {{ __('register.employee_location') }}
  </h4>

  <select class="form-control" name="country_office_location" id="country_office_location" required>
    <option value="" selected disabled>{{__('register.country')}}</option>
    @foreach ($countries as $country)
      <option value="{{$country}}" {{$country == old('country_office_location', $user->country_office_location ?? null) ? 'selected' : ''}}>{{$country}}</option>
    @endforeach
  </select>
@endif

