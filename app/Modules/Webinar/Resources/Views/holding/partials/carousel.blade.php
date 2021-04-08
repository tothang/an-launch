<div id="multi-item-example" class="carousel slide carousel-multi-item holding-carousel" data-ride="carousel">

  <!--Controls-->
  <div class="controls-top">
    <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
    <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a>
  </div>
  <!--/.Controls-->

  <!--Slides-->
  <div class="carousel-inner" role="listbox">
    <!--First slide-->
    <div class="carousel-item active">
      <div class="row">
        <div class="{{ isYale() ? 'col-md-6' : 'col-lg-6 col-md-12' }}">
          @include('webinar::holding.partials.carousel-item', [
            'url' => isHyster() ? "url('/img/hyster/carousel/DR Murdoch.png')" : "url('/img/yale/carousel/DR Murdoch.png')",
            'label' => isYale() ? __('holding.yale.presenters') : __('holding.hyster.presenters'),
            'label1' => 'Stewart D. Murdoch',
            'title' => 'Senior Vice President, <br/> Managing Director – EMEA',
            'img' => null,
            'redirect' => route('speakers.index'),
            'lableClass' => 'presenters-label',
            'customMarginClass' => isHyster() ? 'mg-right' : ''
          ])
        </div>

        <div class="clearfix d-none d-md-block {{ isYale() ? 'col-md-6' : 'col-lg-6 col-md-12' }}">
          @include('webinar::holding.partials.carousel-item', [
            'url' => isHyster() ? "url('/img/hyster/holding/Hyster-Agenda@2x.png')" : "linear-gradient(to left, rgb(229 167 19 / 55%), #e5a713 42%)",
            'label' => isYale() ? __('holding.yale.agenda') : __('holding.hyster.agenda'),
            'label1' => isYale() ? '13:30hrs - 15:00hrs (BST)' : '09:30hrs - 11:00hrs (BST)',
            'title' => '',
            'img' => isHyster() ? null : '/img/yale/pexels-photo-257636@3x.png',
            'redirect' => route('agenda.index'),
            'lableClass' => isHyster() ? 'width-100' : 'width-70',
            'customMarginClass' => isHyster() ? 'mg-left' : ''
          ])
        </div>
      </div>

    </div>
    <!--/.First slide-->

    <!--Second slide-->


    @if(isYale())
    <div class="carousel-item">
      <div class="row">
        <div class="{{ isYale() ? 'col-md-6' : 'col-lg-6 col-md-12' }}">
          <div class="{{ isYale() ? 'card mb-2' : 'card mg-right' }}">
            <div class="card-body"
              style="background-image: url('{{ isHyster() ? '/img/hyster/carousel/3.png' : '/img/yale/carousel/3.png' }}');">
              <div class="embed-container embed-responsive">
                @if ($video)
                  {!! $video['vimeo_iframe'] !!}
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="clearfix d-none d-md-block {{ isYale() ? 'col-md-6' : 'col-lg-6 col-md-12' }}">
          @include('webinar::holding.partials.carousel-item', [
            'url' => isHyster() ? "url('/img/hyster/carousel/DR Murdoch.png')" : "url('/img/yale/carousel/DR Murdoch.png')",
             'label' => __('holding.yale.presenters'),
            'label1' => 'Stewart D. Murdoch',
            'title' => 'Senior Vice President, <br/> Managing Director – EMEA',
            'img' => null,
            'redirect' => route('speakers.index'),
            'lableClass' => 'presenters-label',
            'customMarginClass' => isHyster() ? 'mg-left' : ''
          ])
        </div>

      </div>
    </div>
    @endif

    <!--/.Second slide-->
  </div>
  <!--/.Slides-->

</div>
