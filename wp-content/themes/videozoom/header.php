<?php 
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<title><?php wpzoom_titles(); ?></title>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<meta name="description" content="<?php the_excerpt_rss(); ?>" />
<?php meta_post_keywords(); ?>
<?php endwhile; endif; elseif(is_home()) : ?>
<meta name="description" content="<?php if (strlen($wpzoom_meta_desc) < 1) { bloginfo('description');} else {echo"$wpzoom_meta_desc";}?>" />
<?php meta_home_keywords(); ?>
<?php endif; ?>
<?php wpzoom_index(); ?>
<?php wpzoom_canonical(); ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php wpzoom_rss(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/dropdown.css" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if (strlen($wpzoom_misc_favicon) > 1 ) { ?><link rel="shortcut icon" href="<?php echo "$wpzoom_misc_favicon";?>" type="image/x-icon" /><?php } ?> 
<?php wp_enqueue_script('jquery');  ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>  
<?php wp_head(); ?>
<?php wpzoom_js("dropdown"); ?>
<?php if (is_home()) { ?>
<?php if ($wpzoom_featured_posts_show == 'Yes') { ?>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/loopedslider.min.js" type="text/javascript"></script>
<?php } ?>
<?php } ?>
<script type="text/javascript">
jQuery(document).ready(
function($)
{
 
	$("a.switch_thumb").toggle(function(){
	  $(this).addClass("swap"); 
	  $("ul.grid").fadeOut("fast", function() {
	  	$(this).fadeIn("fast").addClass("list"); 
		 });
	  }, function () {
      $(this).removeClass("swap");
	  $("ul.grid").fadeOut("fast", function() {
	  	$(this).fadeIn("fast").removeClass("list");
		});
	}); 

});
</script>
</head>

<body>
<div id="container">

  <div id="topNav">
    <div class="wrapper">
    
      <ul id="menuSocial">
        <li><a href="<?php if (strlen($wpzoom_misc_feedburner) < 10) { bloginfo('rss2_url');} else {echo"$wpzoom_misc_feedburner";} ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/rss.png" width="16" height="16" alt="Subscribe to RSS" />Subscribe</a></li>
         <?php if (strlen($wpzoom_soc_twitter) > 1) { ?><li><a href="http://twitter.com/<?php echo $wpzoom_soc_twitter; ?>" rel="external,nofollow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/twitter.png" width="16" height="16" alt="" /><?php echo"$wpzoom_soc_twitter_title"; ?></a></li><?php } ?>
          <?php if (strlen($wpzoom_soc_facebook) > 1) { ?><li><a href="<?php echo $wpzoom_soc_facebook; ?>" rel="external,nofollow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/facebook.png" width="16" height="16" alt="" /><?php echo"$wpzoom_soc_facebook_title"; ?></a></li><?php } ?>
      </ul>
      
    <div id="topnav_menu" class="dropdown">
    <?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => '', 'menu_id' => 'topMenu', 'sort_column' => 'menu_order', 'theme_location' => 'secondary' ) ); ?>
	</div>
		
    </div><!-- end .wrapper -->
  </div><!-- end #topNav -->

  <div id="header">
  
    <div class="wrapper">

      <div id="logo">
        <a href="<?php echo get_option('home'); ?>"><?php if ($wpzoom_misc_logo_path) { ?><img src="<?php echo "$wpzoom_misc_logo_path";?>" alt="<?php bloginfo('name'); ?>" /><?php } else { ?><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" /><?php } ?></a>
      </div><!-- end #logo -->
      <?php if ($wpzoom_ad_head_select == 'Yes') {?>
      <div id="bannerHead"><?php echo stripslashes($wpzoom_ad_head_code); ?></div>
      <?php } ?>
      
      <div class="cleaner">&nbsp;</div>
    
    </div><!-- end .wrapper -->

  </div><!-- end #header -->
  
  <div id="navigation">
  
    <div class="wrapper">
      
      <div id="menu" class="dropdown">
      <?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => '', 'menu_id' => 'nav', 'sort_column' => 'menu_order', 'theme_location' => 'primary' ) ); ?>
      </div>
      
      <div class="cleaner">&nbsp;</div>
      
    </div><!-- end .wrapper -->

  </div><!-- end #navigation -->