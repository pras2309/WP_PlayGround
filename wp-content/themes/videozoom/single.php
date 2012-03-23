<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>

<?php get_header(); ?>

<?php
// post custom fields 
$template = get_post_meta($post->ID, 'wpzoom_post_template', true);
$showsocial = get_post_meta($post->ID, 'wpzoom_post_social', true);
$showauthor = get_post_meta($post->ID, 'wpzoom_post_author', true);

$videolocation = get_post_meta($post->ID, 'wpzoom_post_embed_location', true);
$videocode = get_post_meta($post->ID, 'wpzoom_post_embed_code', true);
$AE = new AutoEmbed(); // loading the AutoEmbed PHP Class
 
?>

  <div id="main"<?php if ($template == 'Full Width (no sidebar)') {echo' class="full"';} elseif ($template == 'Sidebar on the left') {echo' class="invert"';} ?>>
  
    <div class="wrapper">
      
      <?php wp_reset_query(); if (have_posts()) : while (have_posts()) : the_post(); ?>

      <?php if (strlen($videocode) > 1 && $videolocation == 'Before everything else') { ?>
      
        <div class="zoomVideo zoomVideoBig">
          <?php
            if ($videocode && $AE->parseUrl($videocode)) {
                $AE->setParam('wmode','transparent');
                $AE->setParam('autoplay','false');
                $AE->setHeight(550);
                $AE->setWidth(920);
                echo $AE->getEmbedCode(); } ?>
        </div>
        
      <?php } else { ?>

        <div class="sep sepMenu">&nbsp;</div>
      
      <?php } ?>
  
      <div id="content">
      
        <div class="postmetadata">
        <?php if ($wpzoom_singlepost_cat == 'Show') { ?>
          <p class="header">Filed Under</p>
          <p><?php the_category(', '); ?></p>
		<?php } ?>
		
        <div class="sep">&nbsp;</div>
        
        <?php if ($wpzoom_singlepost_tag == 'Show') { ?><p class="header">Tags</p>
          <?php the_tags( '<p>', ' ', '</p>'); ?>
          <div class="sep">&nbsp;</div>
        <?php } ?>

            <?php if ($showsocial != 'No' || !$showsocial) { ?>
              <p class="header">Share this post</p>
              
              <ul class="wpzoomSocial">
                    <li><a href="http://twitter.com/home?status=<?php the_title(); ?> <?php echo get_bloginfo('url')."/?p=".$post->ID; ?>" rel="external,nofollow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/twitter.png" alt="Tweet This!" /> Tweet this!</a></li>
                    <li><a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink();?>&amp;title=<?php the_title_attribute();?>" rel="external,nofollow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/digg.png" alt="Digg it!" /> Digg it!</a></li>
                    <li><a href="http://del.icio.us/post?v=4&amp;noui&amp;jump=close&amp;url=<?php the_permalink();?>&amp;title=<?php the_title_attribute();?>" rel="external,nofollow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/delicious.png" alt="Add to Delicious!" /> Add to Delicious!</a></li>
                    <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" rel="external,nofollow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/facebook.png" alt="Share on Facebook!" /> Share on Facebook!</a></li>
                    <li><a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>" rel="external,nofollow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/stumbleupon.png" alt="Stumble it" /> Stumble it</a></li>
                     <li class="last"><a href="<?php if (strlen($wpzoom_misc_feedburner) < 10) { bloginfo('rss2_url');} else {echo"$wpzoom_misc_feedburner";} ?>" rel="external,nofollow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/rss.png" alt="Subscribe by RSS" /> Subscribe by RSS</a></li>
              </ul>
              <div class="cleaner">&nbsp;</div>
              <div class="sep">&nbsp;</div>
            <?php } // if social icons should be shown ?>
         
        </div><!-- end .postmetadata -->
        <div class="single">

          <?php if (strlen($videocode) > 1 && $videolocation == 'In the middle column') {
          
            if ($videocode && $AE->parseUrl($videocode)) {
                $AE->setParam('wmode','transparent');
                $AE->setParam('autoplay','false');
                $AE->setHeight(370);
                $AE->setWidth(570);
                echo'<div class="zoomVideo">';
                echo $AE->getEmbedCode(); 
                echo'</div>';
                }
            } ?>

          <p class="postmetadata"><?php if ($wpzoom_singlepost_author == 'Show') { ?>Posted by <?php the_author_posts_link(); } ?><?php if ($wpzoom_singlepost_author == 'Show' && $wpzoom_singlepost_date == 'Show') { ?> on <?php } ?><?php if ($wpzoom_singlepost_date == 'Show') { ?> <?php the_time("$dateformat $timeformat"); } ?></p>
          
          <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
        
          <div class="entry">
 				<?php the_content(); ?>
			</div>
			
          <?php wp_link_pages(array('before' => '<p class="pages"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
          <p class="more"><?php edit_post_link( __('Edit this post &raquo;'), '', ''); ?></p>
          
        </div><!-- end .single -->
        
        <div class="cleaner">&nbsp;</div>
        
        <?php comments_template(); ?>

      </div><!-- end #content -->
      
          <div id="sidebar">
          
            <?php get_sidebar(); ?>
            
          </div><!-- end #sidebar -->
 
      <div class="cleaner">&nbsp;</div>

   <?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>
    <?php endif; ?>          
          

    </div><!-- end .wrapper -->

  </div><!-- end #main -->

<?php get_footer(); ?>
