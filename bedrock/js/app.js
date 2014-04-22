jQuery(document).ready(function($) {

    // Mobile Nav
    $('.nav-button').click(function() {
      if ($('.nav-lines').hasClass('open')) {
        $('.nav-lines').removeClass('open');
        $('.nav-lines').slideUp();
      } else {
        $('.nav-lines').addClass('open');
        $('.nav-lines').slideDown();
      }
    });

});
