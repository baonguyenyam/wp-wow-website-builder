"use strict";jQuery(document).ready(function(c){c(".wow-carousel").each(function(a,s){var e=c(this),i=JSON.parse(e.attr("data-settings")),n=1===parseInt(i.control_option),t=1===parseInt(i.arrow_option),o=i.animated_speed,p=1===parseInt(i.autoplay_option),r={autoplay:!1,speed:600,lazyLoad:"progressive",nextArrow:'<span class="wow-carousel-next"><i class="fas fa-angle-right"></i></span>',prevArrow:'<span class="wow-carousel-prev"><i class="fas fa-angle-left"></i></span>'};r.dots=n,r.arrows=t,r.speed=o,r.autoplay=p,e.hasClass("slick-initialized")&&e.slick("unslick"),e.not(".slick-initialized").slick(r).slickAnimation()}),c(document).on("rendered_addon",function(a,l){var s=window.frames["wow-builder-view"].window.document;void 0!==l.type&&"addon"===l.type&&"wow_carousel"===l.name&&c(s).find(".wow-carousel").each(function(a,s){var e,i,n,t,o,p,r=c(this);parseInt(r.attr("data-addon-id"))===parseInt(l.id)&&(e=l.settings,i=1===parseInt(e.control_option),n=1===parseInt(e.arrow_option),t=e.animated_speed,o=1===parseInt(e.autoplay_option),(p={autoplay:!1,speed:600,lazyLoad:"progressive",nextArrow:'<span class="wow-carousel-prev"><i class="fas fa-angle-left"></i></span>',prevArrow:'<span class="wow-carousel-next"><i class="fas fa-angle-right"></i></span>'}).dots=i,p.arrows=n,p.speed=t,p.autoplay=o,r.hasClass("slick-initialized")&&r.slick("unslick"),r.not(".slick-initialized").slick(p).slickAnimation())})})});