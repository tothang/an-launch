$(function () {
    let owl = $('.slider').owlCarousel({
        items: 1,
        margin: 0,
        loop  : true,
        nav    : true,
        smartSpeed :900,
        navText : ["<img class='slider__img' src='img/icons/arrow-slider.svg' alt='Slider - Left' />","<img class='slider__img' src='img/icons/arrow-slider.svg' alt='Slider - Right' />"]
    });
});
