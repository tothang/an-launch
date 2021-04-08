<div class="block block__content block--boxed">
  <div class="row">
    <div class="col-12 d-flex flex-column justify-content-center">
      @foreach($registration->summary() as $field => $value)
          <h3 class="header--tertiary">{{ $field }}</h3>
          <p class="lead">{{ $value }}</p>
      @endforeach
    </div>
  </div>
</div>
