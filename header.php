<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?> | Digital Design and Development<?php echo (is_front_page() ? ' | Frederick, MD' : '' ); ?></title>
    <meta name="description" content="<?php echo get_excerpt_by_id( $post->ID ); ?>">

    <!-- html5.js -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- media-queries.js (fallback) -->
    <!--[if lt IE 9]>
      <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/favicon.png">
    <link href="<?php bloginfo( 'stylesheet_url' ); ?>" rel="stylesheet">

    <?php wp_enqueue_script('jquery'); ?>
    <script type="text/javascript" src="//use.typekit.net/jcc0yeh.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

    <?php wp_head(); ?>
  </head>
  <body>
    <header class="menu">
      <div class="navigation">
        <a href="<?php echo home_url(); ?>">
          <img class="title" src="<?php bloginfo( 'template_directory' ); ?>/assets/img/title-white.png"
            alt="Lucid Studios Logo">
        </a>
        <!--
        <img class="menu-icon" src="<?php bloginfo( 'template_directory' ); ?>/assets/img/menu.png"
          alt="Menu Icon">
        -->
        <ul>
          <li><a href="<?php bloginfo( 'url' ); ?>#about">About</a></li>
          <li><a href="<?php bloginfo( 'url' ); ?>#services">Services</a></li>
          <li><a href="<?php bloginfo( 'url' ); ?>#work">Work</a></li>
          <li><a href="<?php bloginfo( 'url' ); ?>#journal">Journal</a></li>
          <li><a href="<?php bloginfo( 'url' ); ?>#contact">Contact</a></li>
        </ul>
        <!--
        <ul>
          <?php if ( has_nav_menu( 'main-menu' ) ) { ?>
          <?php wp_nav_menu( array( 'theme-location' => 'main-menu', 'container' => 'False',
            'items_wrap' => '%3$s' ) ); ?>
          <?php } ?>
        </ul>
        -->
      </div>
    </header>

    <div class="content">
