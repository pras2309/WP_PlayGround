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
      
        <div class="sep sepMenu">&nbsp;</div>
        
        <?php include(TEMPLATEPATH . '/wpzoom_recent_posts.php'); // ?>
        
          <div id="sidebar">
          
            <?php get_sidebar(); ?>
            
          </div><!-- end #sidebar -->
 
      <div class="cleaner">&nbsp;</div>
    </div><!-- end .wrapper -->

  </div><!-- end #main -->

<?php get_footer(); ?>
