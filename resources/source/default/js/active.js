(function ($) {
  'use strict';
  const browserWindow = $(window);

  // :: 1.0 Preloader Active Code
  browserWindow.on('load', function () {
    $('.preloader').fadeOut('slow', function () {
      $(this).remove();
    });
  });

  // :: 2.0 Nav Active Code
  if ($.fn.classyNav) {
    $('#newsboxNav').classyNav();
  }

  $(window).scroll(function () {
    const scroll = $(window).scrollTop();
    const height = $(window).height() - 64;
    if (scroll > height) {
      $("#to-top").addClass("to-top");
    } else {
      $("#to-top").removeClass("to-top");
    }
  });

  $('a.page-scroll').click(function () {
    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') &&
      location.hostname === this.hostname) {
      let target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 40
        }, 900);
        return false;
      }
    }
  });

}(jQuery));
