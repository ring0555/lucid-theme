<?php get_header(); ?>

  <div id="home">

    <div id="vslide1" class="vslide active" data-num="1">
      <div class="splash">
        <img src="<?php bloginfo( 'template_directory' ); ?>/dist/img/logo-blue.png"
          alt="Lucid Studios Logo">
        <h1>We Are Lucid Studios</h1>
        <button>Learn About Us</button>
      </div>
    </div>
    <div id="vslide2" class="vslide" data-num="2">
      <h1 class="page-heading">Our Services</h1>
      <div class="services horizontal-slider">
        <div id="hslide1" class="hslide active" data-num="1">
          <img src="<?php bloginfo( 'template_directory' ); ?>/dist/img/uiux.png"
            alt="Lucid studios UI UX Design">
          <h2>UI &amp; UX Design</h2>
        </div>
        <div id="hslide2" class="hslide" data-num="2">
          <img src="<?php bloginfo( 'template_directory' ); ?>/dist/img/web.png"
            alt="Lucid Studios Web Development">
          <h2>Web Development</h2>
        </div>
        <div id="hslide3" class="hslide" data-num="3">
          <img src="<?php bloginfo( 'template_directory' ); ?>/dist/img/mobile.png"
            alt="Lucid Studios Mobile Development">
          <h2>Mobile Development</h2>
        </div>
        <div id="hslide4" class="hslide" data-num="4">
          <img src="<?php bloginfo( 'template_directory' ); ?>/dist/img/software.png"
            alt="Lucid Studios Software Development">
          <h2>Software Development</h2>
        </div>
      </div>
      <div class="horizontal-control" data-target="services">
        <i class="icon ion-chevron-left" data-move="left"></i>
        <i class="icon ion-chevron-right" data-move="right"></i>
      </div>
    </div>
    <div id="vslide3" class="vslide" data-num="3">
      <h1 class="page-heading">How We Work</h1>
    </div>
    <div id="vslide4" class="vslide" data-num="4">
      <h1 class="page-heading">Testimonials</h1>
    </div>

    <div class="vertical-control">
      <i class="icon ion-chevron-up" data-move="up"></i>
      <br>
      <i class="icon ion-chevron-down" data-move="down"></i>
    </div>

  </div>

  <script>
    jQuery(document).ready(function($) {

      $('.splash').delay(500).fadeIn(1500);

      $(window).on('resize', function() {
        var height = $('.content').height();
        $('.vslide').each(function() {
          $(this).height(height);
        });
      }).trigger('resize');

      $('button').click(function() {
        $('#vslide1').removeClass('active');
        $('html,body').animate({scrollTop: $('#vslide2').offset().top}, 'slow');
        $('#vslide2').addClass('active');
      });

      $('.vertical-control i').click(function() {
        var numSlides = $('.vslide').length;
        var move = $(this).data('move');
        var number = $('.vslide.active').data('num');
        var nextNum;
        if (move === 'up') {
          if (number !== 1) {
            nextNum = parseInt(number - 1);
          }
        } else {
          if (number !== numSlides) {
            nextNum = parseInt(number + 1);
          }
        }
        $('#vslide' + number).removeClass('active');
        $('html,body').animate({scrollTop: $('#vslide' + nextNum).offset().top}, 'slow');
        $('#vslide' + nextNum).addClass('active');
      });

      $('.horizontal-control i').click(function() {
        var parent = $(this).parent().data('target');
        var numSlides = $('.' + parent + ' .hslide').length;
        var move = $(this).data('move');
        var number = $('.' + parent + ' .hslide.active').data('num');
        var nextNum;
        if (move === 'left') {
          if (number !== 1) {
            nextNum = parseInt(number - 1);
            $('.' + parent + ' #hslide' + number).removeClass('active');
            $('.' + parent + ' #hslide' + number).hide('slow');
            $('.' + parent + ' #hslide' + nextNum).addClass('active');
            $('.' + parent + ' #hslide' + nextNum).show('slow');
          }
        } else {
          if (number !== numSlides) {
            nextNum = parseInt(number + 1);
            $('.' + parent + ' #hslide' + number).removeClass('active');
            $('.' + parent + ' #hslide' + number).hide('slow');
            $('.' + parent + ' #hslide' + nextNum).addClass('active');
            $('.' + parent + ' #hslide' + nextNum).show('slow');
          }
        }
      });

    });
  </script>

<?php get_footer(); ?>
