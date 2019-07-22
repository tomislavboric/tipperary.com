export class MobileMenu {

  constructor(
    globalElement = '.menu-icon',
  ) {
    this.globalElement = globalElement
  }

  MobileMenu(){

    $(document).ready(function(){
      // menu click event
      $('.header__mobile-icon').on('click', function(){

        if ($("body").hasClass("mobile-nav")) {
          $("body").removeClass("mobile-nav");
        } else {
          $("body").addClass("mobile-nav");
        }
      });

      $(window).resize(function(){
        $("body").removeClass("mobile-nav");
      });
    });
  }

}
