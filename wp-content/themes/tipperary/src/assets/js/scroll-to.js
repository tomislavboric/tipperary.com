export class ScrollToElement {
  constructor(  
    globalElement = '.js-scroll-to-anchor',
    topElement = '.js-scroll-to-top'
  ) { 
    this.globalElement = globalElement;
    this.topElement = topElement;
  }

  scrolltoGlobalElement() {
    $(this.globalElement).click((event) => {
      event.preventDefault();
      const $anchor = $(event.target);
      const anchorID = $anchor.attr('href');
      this.scrollToSelector(anchorID);
    });
 
  }

  scrolltoTopElement() {
    window.addEventListener('scroll', () => {
      if ($(window).scrollTop() >= 500) { 
        $(this.topElement).addClass('active');
      } else {
        $(this.topElement).removeClass('active');
      }
    });

    $(this.topElement).click((e) => {
      e.preventDefault();
      this.scrollToTop();
    });
  }

  scrollToSelector(selector) {
    const $selector = $(selector); 
 
    if ($selector.length) {  
      $('html, body').animate({        
        scrollTop: $selector.offset().top - 70, 
      }, 500);
    }
  }

  scrollToTop() {
    $('html, body').animate({
      scrollTop: 0,
    }, 500);
  }
}


$(function ($) { 
  $(window).scroll(function () {  
    var scrollPos = $(window).scrollTop();
    $('.itinerary-single__day').each(function (i=0) {

      var topPos = $(this).offset().top; 
      if ((topPos - scrollPos) <= 75) {  
        $('.active').removeClass('active');
        $('.js-scroll-to-anchor').eq(i).addClass('active');

        $(".itinerary-single__list-select").find("option").attr('selected', false);
        $(".itinerary-single__list-select").find("option").eq(i).attr('selected', true);
      } 
    });
  });
});