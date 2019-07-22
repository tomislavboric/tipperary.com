export function mapHeight() {


  $(document).ready( function() {
    const globalElement = $('.js-map-wrapper');
    const headerHeight = $('.header').outerHeight();
    const footerHeight = $('.footer').outerHeight();
    const windowHeight = $(window).outerHeight();
    globalElement.css('height', windowHeight - headerHeight - footerHeight);
  });

  $(window).resize(function () {
    const globalElement = $('.js-map-wrapper');
    const headerHeight = $('.header').outerHeight();
    const footerHeight = $('.footer').outerHeight();
    const windowHeight = $(window).outerHeight();
    globalElement.css('height', windowHeight - headerHeight - footerHeight);
  });

  $(document).ready(function () {
    const toggleMap = $('.location-listings__listing-toggle');

    toggleMap.on('click', function(e){
      e.preventDefault();

      let dataToggle = $(this).data('toggle');

      $(this).addClass('active');
      $(this).siblings().removeClass('active');
      var elementShow = $("div[data-toggle-div='" + dataToggle + "']");
      elementShow.fadeIn('fast').siblings().fadeOut('fast');
      console.log(elementShow);
      /* if (dataToggle === 'results'){

        listingDisplay.fadeIn('slow');
        mapDisplay.fadeOut('slow');
      }else {
        listingDisplay.fadeOut('slow');
        mapDisplay.fadeIn('slow');
      } */
    });
  });
} 