<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>

<?php get_header(); ?>



  <div id="main">
  
    <div class="wrapper">
  
          <?php if ($wpzoom_featured_posts_show == 'Yes' && is_home() && $paged < 2) { include(TEMPLATEPATH . '/wpzoom_featured_posts.php'); } ?>
          
          
          <?php if ($wpzoom_recent_posts_show == 'Yes') { include(TEMPLATEPATH . '/wpzoom_recent_posts.php'); } ?>
          
          <div id="sidebar">
          
            <?php get_sidebar(); ?>
            
          </div><!-- end #sidebar -->
 
      <div class="cleaner">&nbsp;</div>
    </div><!-- end .wrapper -->

  </div><!-- end #main -->

<?php get_footer(); ?>
