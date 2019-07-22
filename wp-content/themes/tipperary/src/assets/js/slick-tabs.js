$(function () {
  var slid = $('.js-swipe-tabs');

 /* slid.on('setPosition', function(event, slick) {
    if (slick.currentSlide === 0) {
      $(this).find('.slick-track').css({"transform": "translate3d(0px, 0px, 0px)" });
    }
  });   */

  $( ".slick-current" ).nextAll().addClass( "next-sel" );
  $( ".slick-current" ).prevAll().addClass( "prev-sel" );
  $('.js-swipe-tabs').on('afterChange', function(event, slick, currentSlide){
    $( ".slick-current" ).prevAll().removeClass( "next-sel" );
    $( ".slick-current" ).nextAll().removeClass( "next-sel" );
    $( ".slick-current" ).nextAll().addClass( "next-sel" );
    $( ".slick-current" ).prevAll().addClass( "prev-sel" );
  });


  var numSlick = 0;
  $('.js-swipe-tabs-container').each( function() {
    numSlick++;
    $(this).addClass( 'slider-' + numSlick ).slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      touchMove: true,
      swipe: true,
      draggable: true,
      infinite: false,
      asNavFor: '.js-swipe-tabs.slider-' + numSlick
    });
  });

  numSlick = 0;
  $('.js-swipe-tabs').each( function() {
    numSlick++;
    $(this).addClass( 'slider-' + numSlick ).slick({
      variableWidth: true,
      slidesToScroll: 1,
      slidesToShow: 5,
      touchMove: true,
      swipe: true,
      draggable: true,
      accessibility: true,
      stopAtEnd: true,
      asNavFor: '.js-swipe-tabs-container.slider-' + numSlick,
      arrows: false,
      //centerMode: true,
      focusOnSelect: true,
      infinite: false,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            variableWidth: false,
            centerMode: false,
           }
        }
      ]
    });
  });


  let tabSlider = $('.tabs-slider__slider');
  for (let index = 0; index < tabSlider.length; index++) {
    const element = tabSlider[index];
    //console.log(element.id);
    console.log(element.id);
    $('#' + element.id).slick({
      dots: false,
      arrows: true,
      infinite: false,
      speed: 300,
      swipe: false,
      slidesToShow: 1,
      cssEase: "cubic-bezier(0.87, 0.03, 0.41, 0.9)",
      prevArrow: '<div class="slider-arrow slider-arrow--prev"><i class="arrow left"></i></div>',
      nextArrow: '<div class="slider-arrow slider-arrow--next"><i class="arrow right"></i></div>'
    });
  }
  $('.tabs').on('change.zf.tabs', function () {
    var slider = $('.is-active').find('.tabs-slider__slider');

    $('#' + slider.get(0).id).slick('unslick');
    $('#' + slider.get(0).id).slick({
      dots: false,
      arrows: true,
      infinite: false,
      speed: 300,
      swipe: false,
      slidesToShow: 1,
      cssEase: "cubic-bezier(0.87, 0.03, 0.41, 0.9)",
      prevArrow: '<div class="slider-arrow slider-arrow--prev"><i class="arrow left"></i></div>',
      nextArrow: '<div class="slider-arrow slider-arrow--next"><i class="arrow right"></i></div>'
    });

  });

});
