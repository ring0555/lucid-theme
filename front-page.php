<?php get_header(); ?>

<div class="jumbotron">
  <div class="container">
    <div class="arrow-left"><span class="glyphicon glyphicon-chevron-left"></span></div>
    <div class="arrow-right"><span class="glyphicon glyphicon-chevron-right"></span></div>
    <div class="slide show" data-slide="1">
      <img class="img-responsive" src="<?php bloginfo('template_directory'); ?>/bedrock/img/design.png">
      <h1>Design</h1>
    </div>
    <div class="slide hidden" data-slide="2">
      <img class="img-resonsive" src="<?php bloginfo('template_directory'); ?>/bedrock/img/develop.png">
      <h1>Develop</h1>
    </div>
    <div class="slide hidden" data-slide="3">
      <img class="img-resonsive" src="<?php bloginfo('template_directory'); ?>/bedrock/img/deploy.png">
      <h1>Deploy</h1>
    </div>
  </div>
</div>
<div class="container">


</div>

<?php get_footer(); ?>
