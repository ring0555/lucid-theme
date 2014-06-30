<?php get_header(); ?>

  <div id="home">

    <div class="slide" data-slide="1">
      <div class="splash">
        <img src="<?php bloginfo( 'template_directory' ); ?>/dist/img/logo-blue.png">
        <h1>We Are Lucid Studios</h1>
        <button>Learn About Us</button>
      </div>
    </div>
    <div class="slide" data-slide="2">
      test2
    </div>
    <div class="slide" data-slide="3">
      test2
    </div>
    <div class="slide" data-slide="4">
      test2
    </div>
  </div>

  <script>
    jQuery(document).ready(function($) {

      $('.splash').delay(500).fadeIn(1500);

      $(window).on('resize', function() {
        var height = $('.content').height();
        $('.slide').each(function() {
          $(this).height(height);
        });
      }).trigger('resize');

      $('button').click(function() {

      });

    });
  </script>

<?php get_footer(); ?>
