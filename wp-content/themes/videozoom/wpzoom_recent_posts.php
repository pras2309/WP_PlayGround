<?php wp_reset_query(); ?>
	<div id="content">
      
	<div id="postFuncs">
	  <div id="funcStyler"><a href="#" class="switch_thumb"></a></div>
          <?php if (is_category()) { 
           $cat_ID = get_query_var('cat'); ?>
          
          <?php echo '<h2>'; wpzoom_breadcrumbs(); echo'</h2>'; ?><?php } 
            elseif (!is_category() && !is_home()) { ?>
            <?php echo '<h2>'; wpzoom_breadcrumbs(); echo'</h2>'; ?>
            <?php }
            else { ?>
            <h2>Recent Videos</h2>
            <?php } ?>
	</div><!-- end #postFuncs -->
        
	<div id="archive">
        
	<?php if (have_posts()) : ?>
		<ul class="posts posts-3 grid">
			<?php  
      $i = 0;  
				while (have_posts()) : the_post();
				$i++;
			?>
			
			<li<?php if ($i == 4) {$i = 0; echo " class=\"last\"";} ?>>
				<?php unset($img); if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
					$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
					$img = $thumbURL[0];  }
				else {
					unset($img);
					if ($wpzoom_cf_use == 'Yes')
					{
					  $img = get_post_meta($post->ID, $wpzoom_cf_photo, true);
					}
                else
                {
                  if (!$img)
                  {
                    $img = catch_that_image($post->ID);
                  }
                }
				}
				if ($img){ ?>
				<div class="cover"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;h=160&amp;w=228&amp;zc=1" width="228px" height="160px" alt="<?php the_title(); ?>" /></a></div><?php } ?>
				
				<div class="postcontent">
					<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<p class="postmetadata"><?php if ($wpzoom_homepost_date == 'Show') { ?><?php the_time("$dateformat"); ?><?php } ?><?php if ($wpzoom_homepost_date == 'Show' && $wpzoom_homepost_cat == 'Show') { ?> / <?php } ?><?php if ($wpzoom_homepost_cat == 'Show') { ?><?php the_category(', '); ?><?php } ?></p>
 					
 					<?php the_excerpt(); ?>
 					
					<p class="more"><?php if ($wpzoom_homepost_more == 'Show') { ?><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="readmore" rel="nofollow">Continue reading &raquo;</a><?php } ?> <?php edit_post_link( __('Edit this post'), ' | ', ''); ?></p>
				
				</div>
			</li>
			<?php if ($i == 0) {echo'<li class="cleaner">&nbsp;</li>';} ?>
			
			<?php endwhile; //  ?>
		</ul>
		<div class="cleaner">&nbsp;</div>
	<?php else : ?>
 	<p class="title">There are no posts in this category</p>
  
	<?php endif; ?>
          
	</div><!-- end #archive -->

	<div class="navigation">

		<?php
		if(function_exists('wp_pagenavi'))
		{
			wp_pagenavi();
		}
		else
		{
		?>

        <p><?php next_posts_link('&laquo; Older Entries') ?><?php previous_posts_link('Newer Entries &raquo;') ?></p>
<?php } ?> 
      </div>
      
</div><!-- end #content -->