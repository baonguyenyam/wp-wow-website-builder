"use strict";

jQuery(document).ready(function ($) {
  'use strict';

  $('.wow-carousel').each(function (index, $value) {
    var $slider = $(this);
    var settings = JSON.parse($slider.attr('data-settings'));
    var isDots = parseInt(settings.control_option) === 1;
    var isArrow = parseInt(settings.arrow_option) === 1;
    var animated_speed = settings.animated_speed;
    var isAutoPlay = parseInt(settings.autoplay_option) === 1;
    var slickOptions = {
      autoplay: false,
      speed: 600,
      lazyLoad: 'progressive',
      nextArrow: '<span class="wow-carousel-next"><i class="fas fa-angle-right"></i></span>',
      prevArrow: '<span class="wow-carousel-prev"><i class="fas fa-angle-left"></i></span>' //dots: true,

    };
    slickOptions.dots = isDots;
    slickOptions.arrows = isArrow;
    slickOptions.speed = animated_speed;
    slickOptions.autoplay = isAutoPlay;

    if ($slider.hasClass('slick-initialized')) {
      $slider.slick('unslick');
    }

    $slider.not('.slick-initialized').slick(slickOptions).slickAnimation();
  });
  $(document).on('rendered_addon', function (e, addon) {
    var iframe = window.frames['wow-builder-view'].window.document;

    if (typeof addon.type !== 'undefined' && addon.type === 'addon' && addon.name === 'wow_carousel') {
      var $sliderWrap = $(iframe).find('.wow-carousel');
      $sliderWrap.each(function (index, $value) {
        var $slider = $(this);
        var addonID = parseInt($slider.attr('data-addon-id'));

        if (addonID === parseInt(addon.id)) {
          var settings = addon.settings;
          var isDots = parseInt(settings.control_option) === 1;
          var isArrow = parseInt(settings.arrow_option) === 1;
          var animated_speed = settings.animated_speed;
          var isAutoPlay = parseInt(settings.autoplay_option) === 1;
          var slickOptions = {
            autoplay: false,
            speed: 600,
            lazyLoad: 'progressive',
            nextArrow: '<span class="wow-carousel-prev"><i class="fas fa-angle-left"></i></span>',
            prevArrow: '<span class="wow-carousel-next"><i class="fas fa-angle-right"></i></span>' //dots: true,

          };
          slickOptions.dots = isDots;
          slickOptions.arrows = isArrow;
          slickOptions.speed = animated_speed;
          slickOptions.autoplay = isAutoPlay;

          if ($slider.hasClass('slick-initialized')) {
            $slider.slick('unslick');
          }

          $slider.not('.slick-initialized').slick(slickOptions).slickAnimation();
        }
      });
    }
  });
});