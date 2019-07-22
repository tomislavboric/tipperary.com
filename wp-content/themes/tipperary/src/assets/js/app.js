import $ from 'jquery';
import whatInput from 'what-input';
import { MobileMenu } from './mobile-menu';
import { ScrollToElement } from './scroll-to';
import { mapHeight } from './map';
import { slickSlider } from './slick-custom';
import { slickTabs } from './slick-tabs';
import { slickMain } from './slick.min.js';
import { Forms } from './forms';
import { Sticky } from './sticky';

window.$ = $;

import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

$(document).foundation();

$(function () {
  const scrollTo = new ScrollToElement();
  const forms = new Forms();
  const mobileMenu = new MobileMenu();
  // -------------------------------------------------------------
  // scrollTo
  scrollTo.scrolltoGlobalElement();
  scrollTo.scrolltoTopElement();

  // -------------------------------------------------------------
  // Map height
  mapHeight();

  // -------------------------------------------------------------
  // Forms
  forms.createSelect2();
  forms.createSelect();

  mobileMenu.MobileMenu();

});

$(".image-carousel").owlCarousel({
  rewind: true,
  lazyLoad: true,
  center: true,
  items: 1,
  loop: true,
  margin: 5,
  dots: true,
  navSpeed: 600,
  nav: false,
  navText: ['<i class="material-icons notranslate" aria-hidden="true">chevron_left</i>','<i class="material-icons notranslate" aria-hidden="true">chevron_right</i>'],
  responsive:{
      639:{
        dots: false,
        nav: true,
          items: 2,
          margin: 20,
          center: true,
          adaptiveHeight: true,
      }
  }
});
