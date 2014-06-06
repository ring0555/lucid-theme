<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo('name'); ?></title>
    <meta name="description" content="Developing High End Web and Mobile Applications">

    <!-- html5.js -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- media-queries.js (fallback) -->
    <!--[if lt IE 9]>
      <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/img/favicon.png">
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">

    <?php wp_enqueue_script('jquery'); ?>

    <?php wp_head(); ?>
  </head>
  <body>

  <div class="header">
    <ul class="hidden-xs">
      <?php wp_nav_menu( array( 'menu' => 'Menu 1', 'container' => 'False', 'items_wrap' => '%3$s' ) ); ?>
      <li class="logo"><a href="<?php bloginfo( 'url' ); ?>">
        <img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/logo.png">
      </a></li>
        <?php wp_nav_menu( array( 'menu' => 'Menu 2', 'container' => 'False', 'items_wrap' => '%3$s' ) ); ?>
    </ul>
    <div class="visible-xs">
      <img class="title" src="<?php bloginfo( 'template_directory' ); ?>/assets/img/title-white.png">
      <ul>
        <?php wp_nav_menu( array( 'menu' => 'Menu 1', 'container' => 'False', 'items_wrap' => '%3$s' ) ); ?>
        <?php wp_nav_menu( array( 'menu' => 'Menu 2', 'container' => 'False', 'items_wrap' => '%3$s' ) ); ?>
      </ul>
    </div>
  </div>

  <div class="content">
