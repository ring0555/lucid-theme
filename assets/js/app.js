'use strict';

jQuery(document).ready(function($) {

    // Mobile Nav
    $('.menu-icon').click(function() {
      if ($('ul', '.navigation').hasClass('open')) {
        $('ul', '.navigation').removeClass('open');
        $('ul', '.navigation').hide();
      } else {
        $('ul', '.navigation').addClass('open');
        $('ul', '.navigation').show();
      }
    });

    // Sort Function
    $('ul.sort li').click(function() {
      var sort = $(this).data('sort');
      $('.sortable').each(function() {
        var categories = $(this).data('categories');
        if ( $.inArray(sort, categories) === -1 ) {
          $(this).delay(400).fadeOut(600);
        } else {
          $(this).delay(400).fadeIn(600);
        }
      });
    });

});
