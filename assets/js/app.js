'use strict';

jQuery(document).ready(function($) {

    // Mobile Nav
    $('.menu-icon').click(function() {
      if ($('ul', '.navigation').hasClass('open')) {
        $('ul', '.navigation').removeClass('open');
        $('ul', '.navigation').slideUp();
      } else {
        $('ul', '.navigation').addClass('open');
        $('ul', '.navigation').slideDown();
      }
    });

    // Mobile Nav
    $('.menu-icon').click(function() {
      $('ul', '.navigation').show();
    });

});
