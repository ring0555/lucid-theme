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

    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/bedrock/img/favicon.png">
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">

    <?php wp_enqueue_script('jquery'); ?>

    <?php wp_head(); ?>
  </head>
  <body>

  <div class="header">
    <div class="container">
      <div class="title">
        <a href="<?php bloginfo('url'); ?>">
          <img src="<?php bloginfo('template_directory'); ?>/bedrock/img/title.png">
        </a>
      </div>
      <div class="navigation">
        <ul class="nav nav-pills">
          <?php wp_list_pages(array('title_li' => '')); ?>
        </ul>
      </div>
    </div>
  </div>
