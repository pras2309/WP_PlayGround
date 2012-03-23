<?php
/*
Template Name: Full Width
*/
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>

<?php get_header(); ?>

  <div id="main" class="full">
  
    <div class="wrapper">
      
        <div class="sep sepMenu">&nbsp;</div>
  
      <div id="content">
      
      <?php wp_reset_query(); if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="single single-page">
         
          <h1><?php the_title(); ?></h1>
          <div class="entry">
 				<?php the_content(); ?>
			</div>
          <?php wp_link_pages(array('before' => '<p class="pages"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
          <p class="more"><?php edit_post_link( __('Edit this post &raquo;'), '', ''); ?></p>
          
        </div><!-- end .single -->
        
        <div class="cleaner">&nbsp;</div>
        
   <?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>
    <?php endif; ?>
      
      </div><!-- end #content -->
      
      <div class="cleaner">&nbsp;</div>

          
    </div><!-- end .wrapper -->

  </div><!-- end #main -->

<?php get_footer(); ?>
