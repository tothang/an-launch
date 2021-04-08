$(function () {
    let owl = $('.owl-carousel').owlCarousel({
        items: 1,
        margin: 10,
    });
    $('.owl__btn').click(function () {
        owl.trigger('next.owl.carousel');
    });

  owl.on("dragged.owl.carousel", function (event) {
    if ($('.owl-dots button').last().hasClass('active')){
      $('.action-skip').hide();
      $('.btn-next').hide();
      $('.btn-trigger-got-it').show();
    }else{
      $('.btn-next').show();
      $('.btn-trigger-got-it').hide();
    }
    $('.owl-dots').find('.active').prevAll().addClass('is-selected');
    $('.owl-dots').find('.active').nextAll().removeClass('is-selected');
  });

  $('.owl-dots button').last().click(() => {
    $('.action-skip').hide();
    $('.btn-next').hide();
    $('.btn-trigger-got-it').show();
  });

  $('.btn-next').click(() => {
    if ($('.owl-dots button').last().hasClass('active')){
      $('.action-skip').hide();
      $('.btn-next').hide();
      $('.btn-trigger-got-it').show();
    }
    $('.owl-dots').find('.active').prev().addClass('is-selected');

  });

  $('.owl-dots').click(() => {
    if (!$('.owl-dots button').last().hasClass('active')){
      $('.action-skip').show();
      $('.btn-next').show();
      $('.btn-trigger-got-it').hide();
    }
    $('.owl-dots').find('.active').prevAll().addClass('is-selected');
    $('.owl-dots').find('.active').nextAll().removeClass('is-selected');
  });

  $('.skip-link').click(() => {
    $('.btn-got-it').trigger('click');
  })

  $('.btn-trigger-got-it').click(() => {
    $('.btn-got-it').trigger('click');
  })


    // System test
    // $('.js-system-test-run').click(() => {
    //     $('.js-system-test-run').addClass('hide');
    //     $('.js-system-test-text').addClass('hide');
    //     $('.js-system-test-loader').removeClass('hide');
    //
    //     setTimeout(function () {
    //         $('.js-system-test-loader').addClass('hide');
    //         $('.js-system-test').removeClass('hide');
    //         $('.js-system-test-continue').removeClass('hide')
    //     }, 1000)
    // })
});
