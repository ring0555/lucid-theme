<?php
/*
Template Name: About Page
*/
?>

<?php get_header(); ?>

  <div class="page-heading">
    <h1>Lucid Studios</h1>
    <h4>Learn more about us.</h4>
  </div>

  <div id="about">
    <div class="spiel">
      <h3>Who We Are</h3>
      <p>We are a Maryland based digital design and development agency that provides a variety of services
        including UI/UX design, web development, mobile development, and software development. We work with
        both new and established companies to increase and improve their digital presence.</p>
      <p>By developing all of our projects from scratch, we ensure that you will have a unique product that
        fits your brand and market. Everything we build uses modern, reliable technologies and is built using
        the latest and greatest programming paradigms. We handle the design, development, testing, deployment,
        and maintenance of your project so you can focus on running your business.</p>
    </div>
    <!--
    <div class="work">
      <h3>How We Work</h3>
    </div>
    -->
    <div class="team">
      <h3>The Team</h3>
      <?php
        $team = get_users( array( 'orderby' => 'ID', 'order' => 'ASC' ) );

        foreach ( $team as $member ) {
          $template_dir = get_template_directory_uri();
          $img_dir = $template_dir.'/assets/img/';
          $avatar = get_avatar( $member->id, 350 );
          $user_meta = array_map( function( $a ){ return $a[0]; }, get_user_meta( $member->id ) );
          $companytitle = $user_meta['companytitle'];
          $twitter = $user_meta['twitter'];
          $github = $user_meta['github'];
          $linkedin = $user_meta['linkedin'];
          $dribbble = $user_meta['dribbble'];

          echo '<div class="member">';
          echo '  '.$avatar.'';
          echo '  <h4 class="name">'.$member->display_name.'</h4>';
          echo '  <h4 class="title">'.$companytitle.'</h4>';
          echo '  <h4 class="email"><a href="mailto:'.$member->user_email.'">'.$member->user_email.'</a></h4>';
          echo '  <ul class="links">';
          if ( $twitter != '' ) {
            echo '    <li><a href="'.$twitter.'" target="_blank"><img src="'.$img_dir.'user_twitter.png"></a></li>';
          }
          if ( $linkedin != '' ) {
            echo '    <li><a href="'.$linkedin.'" target="_blank"><img src="'.$img_dir.'user_linkedin.png"></a></li>';
          }
          if ( $github != '' ) {
            echo '    <li><a href="'.$github.'" target="_blank"><img src="'.$img_dir.'user_github.png"></a></li>';
          }
          if ( $dribbble != '' ) {
            echo '    <li><a href="'.$linkedin.'" target="_blank"><img src="'.$img_dir.'user_linkedin.png"></a></li>';
          }
          echo '  </ul>';
          echo '</div>';
        } // End foreach
      ?>
    </div>
  </div>
<?php get_footer(); ?>