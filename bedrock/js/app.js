jQuery(document).ready(function($) {

    // Mobile Nav
    $('.nav-button').click(function() {
      $('.navigation,.nav-lines').toggleClass('open');
    });

    // Home Page Slider
    $('.arrow-left').click(function() {
      var current_slide = $('.slide.show').data('slide');
      var next_slide;
      if (current_slide == 2 || current_slide == 3) {
        next_slide = current_slide - 1;
      } else {
        next_slide = 3;
      }
      $('div[data-slide='+ current_slide +']').removeClass('show');
      $('div[data-slide='+ current_slide +']').addClass('hidden');
      $('div[data-slide='+ current_slide +']').hide();
      $('div[data-slide='+ next_slide +']').removeClass('hidden');
      $('div[data-slide='+ next_slide +']').addClass('show');
      $('div[data-slide='+ next_slide +']').show();
    });

    $('.arrow-right').click(function() {
      var current_slide = $('.slide.show').data('slide');
      var next_slide;
      if (current_slide == 1 || current_slide == 2) {
        next_slide = current_slide + 1;
      } else {
        next_slide = 1;
      }
      $('div[data-slide='+ current_slide +']').removeClass('show');
      $('div[data-slide='+ current_slide +']').addClass('hidden');
      $('div[data-slide='+ current_slide +']').hide();
      $('div[data-slide='+ next_slide +']').removeClass('hidden');
      $('div[data-slide='+ next_slide +']').addClass('show');
      $('div[data-slide='+ next_slide +']').show();
    });

});
