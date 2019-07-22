
export class Forms {
  constructor(
    globalElement = '.js-form',
    searchElement = '.select-dropdown__list-item',
    selectElement = '.select-dropdown ',
    selectDropdown = '#slider-search__dropdown-select',
  ) {
    this.globalElement = globalElement;
    this.searchElement = searchElement;
    this.selectElement = selectElement;
    this.selectDropdown = selectDropdown;
  }
  createSelect2() {
    $('.js-select2').niceSelect();
    $('.js-select2').on('change', function(){
      $('.js-form').submit();
    });

  }
 
  createSelect() {
    var select = document.getElementsByTagName('select'),
      liElement,
      ulElement,
      optionValue,
      iElement,
      optionText,
      selectDropdown,
      elementParentSpan;

      $("<select class='itinerary-single__list-select' />").appendTo(".itinerary-single__list-navigation");    
      $(".itinerary-single__list-navigation a").each(function() {
       var el = $(this);
        $("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
        }).appendTo(".itinerary-single__list-navigation select");
      });
      $(".itinerary-single__list-navigation select").change(function() {
        window.location = $(this).find("option:selected").val();
      }); 
  } 
}
