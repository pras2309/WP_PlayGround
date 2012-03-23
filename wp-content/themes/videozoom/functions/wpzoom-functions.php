<?php 
 
add_action('admin_menu', 'wpzoom_options_box');

function wpzoom_options_box() {
  add_meta_box('wpzoom_post_embed', 'Post Video Embed', 'wpzoom_post_embed_info', 'post', 'side', 'high');
  add_meta_box('wpzoom_post_template', 'Custom Post Options', 'wpzoom_post_info', 'post', 'side', 'high');
}

function wpzoom_post_embed_info() {
global $post;
?>
<fieldset>
<div>
<p>
<label for="wpzoom_post_embed_location" >Where to show embed video in post:</label><br />
<select name="wpzoom_post_embed_location" id="wpzoom_post_embed_location">
<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_location', true), 'In the middle column' ); ?>>In the middle column</option>
<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_location', true), 'Before everything else' ); ?>>Before everything else</option>
</select>
<br />
</p>
<p>
<label for="wpzoom_post_embed_code" >Video URL or Embed Code:</label><br />
<textarea style="height: 100px; width: 250px;" name="wpzoom_post_embed_code" id="wpzoom_post_embed_code"><?php echo get_post_meta($post->ID, 'wpzoom_post_embed_code', true); ?></textarea>
<br />
</p>
</div>
</fieldset>
<?php
}

function wpzoom_post_info() {
global $post;
?>
<fieldset>
<div>
<p>
<label for="wpzoom_post_template" >Choose layout for this post:</label><br />
<select name="wpzoom_post_template" id="wpzoom_post_template">
<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_template', true), 'Default' ); ?>>Default</option>
<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_template', true), 'Sidebar on the left' ); ?>>Sidebar on the left</option>
<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_template', true), 'Full Width (no sidebar)' ); ?>>Full Width (no sidebar)</option>
</select>
</p>
<p>
<label for="wpzoom_post_social" >Show social sharing icons:</label><br />
<select name="wpzoom_post_social" id="wpzoom_post_social">
<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_social', true), 'Yes' ); ?>>Yes</option>
<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_social', true), 'No' ); ?>>No</option>
</select>
<br />
</p>
</div>
</fieldset>
<?php
}

add_action('save_post', 'custom_add_save');

function custom_add_save($postID){
// called after a post or page is saved
if($parent_id = wp_is_post_revision($postID))
{
  $postID = $parent_id;
}

if ($_POST['wpzoom_post_template']) {
  update_custom_meta($postID, $_POST['wpzoom_post_template'], 'wpzoom_post_template');
  update_custom_meta($postID, $_POST['wpzoom_post_social'], 'wpzoom_post_social');
}
if ($_POST['wpzoom_post_embed_code']) {
  update_custom_meta($postID, $_POST['wpzoom_post_embed_location'], 'wpzoom_post_embed_location');
  update_custom_meta($postID, $_POST['wpzoom_post_embed_code'], 'wpzoom_post_embed_code');
}
}

function update_custom_meta($postID, $newvalue, $field_name) {
// To create new meta
if(!get_post_meta($postID, $field_name)){
add_post_meta($postID, $field_name, $newvalue);
}else{
// or to update existing meta
update_post_meta($postID, $field_name, $newvalue);
}
}

/*this function controls the meta titles display*/
function wpzoom_titles() {
	global $shortname;
	
	#if the title is being displayed on the homepage
	if (is_home()) {
 
			if (get_option('wpzoom_seo_home_title') == 'Site Title - Site Description') echo get_bloginfo('name').get_option('wpzoom_title_separator').get_bloginfo('description'); 
			if ( get_option('wpzoom_seo_home_title') == 'Site Description - Site Title') echo get_bloginfo('description').get_option('wpzoom_title_separator').get_bloginfo('name');
			if ( get_option('wpzoom_seo_home_title') == 'Site Title') echo get_bloginfo('name');
 	}
	#if the title is being displayed on single posts/pages
	if (is_single() || is_page()) { 

			if (get_option('wpzoom_seo_posts_title') == 'Site Title - Page Title') echo get_bloginfo('name').get_option('wpzoom_title_separator').wp_title('',false,''); 
			if ( get_option('wpzoom_seo_posts_title') == 'Page Title - Site Title') echo wp_title('',false,'').get_option('wpzoom_title_separator').get_bloginfo('name');
			if ( get_option('wpzoom_seo_posts_title') == 'Page Title') echo wp_title('',false,'');
					
	}
	#if the title is being displayed on index pages (categories/archives/search results)
	if (is_category() || is_archive() || is_search()) { 
		if (get_option('wpzoom_seo_pages_title') == 'Site Title - Page Title') echo get_bloginfo('name').get_option('wpzoom_title_separator').wp_title('',false,''); 
		if ( get_option('wpzoom_seo_pages_title') == 'Page Title - Site Title') echo wp_title('',false,'').get_option('wpzoom_title_separator').get_bloginfo('name');
		if ( get_option('wpzoom_seo_pages_title') == 'Page Title') echo wp_title('',false,'');
		 }	  
} 

 
function wpzoom_index(){
		global $post;
		global $wpdb;
		if(!empty($post)){
			$post_id = $post->ID;
		}
 
		/* Robots */	
		$index = 'index';
		$follow = 'follow';

		if ( is_tag() && get_option('wpzoom_index_tag') != 'index') { $index = 'noindex'; }
		elseif ( is_search() && get_option('wpzoom_index_search') != 'index' ) { $index = 'noindex'; }  
		elseif ( is_author() && get_option('wpzoom_index_author') != 'index') { $index = 'noindex'; }  
		elseif ( is_date() && get_option('wpzoom_index_date') != 'index') { $index = 'noindex'; }
		elseif ( is_category() && get_option('wpzoom_index_category') != 'index' ) { $index = 'noindex'; }
		echo '<meta name="robots" content="'. $index .', '. $follow .'" />' . "\n";
		
	}
	
function meta_post_keywords() {
	$posttags = get_the_tags();
	foreach((array)$posttags as $tag) {
		$meta_post_keywords .= $tag->name . ',';
	}
	echo '<meta name="keywords" content="'.$meta_post_keywords.'" />';
}


function meta_home_keywords() {
 global $wpzoom_meta_key;
 
 if (strlen($wpzoom_meta_key) > 1 ) {
  
 echo '<meta name="keywords" content="'.get_option('wpzoom_meta_key').'" />';
 
 }
}

function wpzoom_rss()
{	 global $wpzoom_misc_feedburner;
    if (strlen($wpzoom_misc_feedburner) < 1) {
        bloginfo('rss2_url');
    } else {
        echo $wpzoom_misc_feedburner;
    }
}
 

function wpzoom_js()
{
    $args = func_get_args();
    foreach ($args as $arg) {
        echo '<script type="text/javascript" src="' . get_bloginfo('template_directory') . '/js/' . $arg . '.js"></script>' . "\n";
    }
}
 
/*this function controls canonical urls*/
function wpzoom_canonical() {
 	
 	if(get_option('wpzoom_canonical') == 'Yes' ) {
 	
	#homepage urls
	if (is_home() )echo '<link rel="canonical" href="'.get_bloginfo('url').'" />';
	
	#single page urls
	global $wp_query; 
	$postid = $wp_query->post->ID; 

	if (is_single() || is_page()) echo '<link rel="canonical" href="'.get_permalink().'" />';	
	
	
	#index page urls
	
		if (is_archive() || is_category() || is_search()) echo '<link rel="canonical" href="'.get_permalink().'" />';	
	}
}

/* 
Widget Name: Social Connections 
Version: 1.1 
Description: Creates an unordered lists with links to social profiles. 
Author: Dumitru Brinzan  and Pavel Ciorici
Author URI: http://www.wpzoom.com
*/ 

function connectWithMe($args) {

  extract($args);
	$settings = get_option( 'widget_social_connect' );
  
  echo $before_widget;
  echo "$before_title"."$settings[title]"."$after_title";
?>
		<ul class="social">
				<?php if ($settings[ 'rss' ] != '') echo"<li><a href=\"$settings[rss]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/rss.png\" alt=\"$settings[rss_name] \" />$settings[rss_name]<span>$settings[rss_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'email' ] != '') echo"<li><a href=\"mailto:$settings[email]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/email.png\" alt=\"$settings[rss_email] \" />$settings[email_name]<span>$settings[email_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'twitter' ] != '') echo"<li><a href=\"$settings[twitter]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/twitter.png\" alt=\"$settings[rss_twitter] \" />$settings[twitter_name]<span>$settings[twitter_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'tumblr' ] != '') echo"<li><a href=\"$settings[tumblr]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/tumblr.png\" alt=\"$settings[rss_tumblr] \" />$settings[tumblr_name]<span>$settings[tumblr_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'delicious' ] != '') echo"<li><a href=\"$settings[delicious]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/delicious.png\" alt=\"$settings[rss_delicious] \" />$settings[delicious_name]<span>$settings[delicious_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'digg' ] != '') echo"<li><a href=\"$settings[digg]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/digg.png\" alt=\"$settings[rss_digg] \" />$settings[digg_name]<span>$settings[digg_sub]</span></a></li>"; ?>
 				<?php if ($settings[ 'stumble' ] != '') echo"<li><a href=\"$settings[stumble]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/stumbleupon.png\" alt=\"$settings[rss_stumble] \" />$settings[stumble_name]<span>$settings[stumble_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'facebook' ] != '') echo"<li><a href=\"$settings[facebook]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/facebook.png\" alt=\"$settings[rss_facebook] \" />$settings[facebook_name]<span>$settings[facebook_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'linkedin' ] != '') echo"<li><a href=\"$settings[linkedin]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/linkedin.png\" alt=\"$settings[rss_linkedin] \" />$settings[linkedin_name]<span>$settings[linkedin_sub]</span></a></li>"; ?>
  				<?php if ($settings[ 'flickr' ] != '') echo"<li><a href=\"$settings[flickr]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/flickr.png\" alt=\"$settings[rss_flickr] \" />$settings[flickr_name]<span>$settings[flickr_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'picasa' ] != '') echo"<li><a href=\"$settings[picasa]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/picasa.png\" alt=\"$settings[rss_picasa] \" />$settings[picasa_name]<span>$settings[picasa_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'youtube' ] != '') echo"<li><a href=\"$settings[youtube]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/social_widget/youtube.png\" alt=\"$settings[rss_youtube] \" />$settings[youtube_name]<span>$settings[youtube_sub]</span></a></li>"; ?>
 
 		</ul>
		<div class="cleaner">&nbsp;</div>
<?php
  echo $after_widget;

}

function connectWithMe_admin() {
	$settings = get_option( 'widget_social_connect' );
	
	if( isset( $_POST[ 'update_social_connect' ] ) ) {
    $settings[ 'title' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_title' ] ) );
    
    
	$settings[ 'rss' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_rss' ] ) );
    $settings[ 'rss_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_rss_name' ] ) );
    $settings[ 'rss_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_rss_sub' ] ) );	
    
    $settings[ 'email' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_email' ] ) );
    $settings[ 'email_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_email_name' ] ) );
    $settings[ 'email_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_email_sub' ] ) );
    
    $settings[ 'twitter' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_twitter' ] ) );
    $settings[ 'twitter_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_twitter_name' ] ) );
    $settings[ 'twitter_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_twitter_sub' ] ) );	
    
    $settings[ 'tumblr' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_tumblr' ] ) );
    $settings[ 'tumblr_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_tumblr_name' ] ) );
    $settings[ 'tumblr_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_tumblr_sub' ] ) );		
    
    $settings[ 'delicious' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_delicious' ] ) );
    $settings[ 'delicious_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_delicious_name' ] ) );
    $settings[ 'delicious_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_delicious_sub' ] ) );
    
    $settings[ 'digg' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_digg' ] ) );
    $settings[ 'digg_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_digg_name' ] ) );
    $settings[ 'digg_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_digg_sub' ] ) );	
    
    $settings[ 'stumble' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_stumble' ] ) );
    $settings[ 'stumble_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_stumble_name' ] ) );
    $settings[ 'stumble_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_stumble_sub' ] ) );	
    
    $settings[ 'facebook' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_facebook' ] ) );
    $settings[ 'facebook_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_facebook_name' ] ) );
    $settings[ 'facebook_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_facebook_sub' ] ) );	
    
    $settings[ 'linkedin' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_linkedin' ] ) );
    $settings[ 'linkedin_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_linkedin_name' ] ) );
    $settings[ 'linkedin_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_linkedin_sub' ] ) );	
    
    $settings[ 'flickr' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_flickr' ] ) );
    $settings[ 'flickr_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_flickr_name' ] ) );
    $settings[ 'flickr_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_flickr_sub' ] ) );	
    
    $settings[ 'picasa' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_picasa' ] ) );
    $settings[ 'picasa_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_picasa_name' ] ) );
    $settings[ 'picasa_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_picasa_sub' ] ) );	
     
    $settings[ 'youtube' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_youtube' ] ) );
    $settings[ 'youtube_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_youtube_name' ] ) );
    $settings[ 'youtube_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_youtube_sub' ] ) );	
    
 
		update_option( 'widget_social_connect', $settings );
	}

?>
	<p>
		<label for="widget_social_connect_title">Widget Title</label><br />
		<input type="text" id="widget_social_connect_title" name="widget_social_connect_title" value="<?php echo $settings['title']; ?>" size="35" /><br />
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/rss.png" />
		<label for="widget_social_connect_rss"><strong>RSS Feed</strong> URL</label> 
		<input type="text" id="widget_social_connect_rss" name="widget_social_connect_rss" value="<?php echo $settings['rss']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_rss">Heading</label><br />
		<input type="text" id="widget_social_connect_rss_name" name="widget_social_connect_rss_name" value="<?php echo $settings['rss_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_rss">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_rss_sub" name="widget_social_connect_rss_sub" value="<?php echo $settings['rss_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/email.png" />
		<label for="widget_social_connect_email"><strong>E-mail</strong></label> <br/>
		<input type="text" id="widget_social_connect_email" name="widget_social_connect_email" value="<?php echo $settings['email']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_email">Heading</label><br />
		<input type="text" id="widget_social_connect_email_name" name="widget_social_connect_email_name" value="<?php echo $settings['email_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_email">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_email_sub" name="widget_social_connect_email_sub" value="<?php echo $settings['email_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/twitter.png" />
		<label for="widget_social_connect_twitter"><strong>Twitter</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_twitter" name="widget_social_connect_twitter" value="<?php echo $settings['twitter']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_twitter">Heading</label><br />
		<input type="text" id="widget_social_connect_twitter_name" name="widget_social_connect_twitter_name" value="<?php echo $settings['twitter_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_twitter">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_twitter_sub" name="widget_social_connect_twitter_sub" value="<?php echo $settings['twitter_sub']; ?>" size="30" /><br />
		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/tumblr.png" />
		<label for="widget_social_connect_tumblr"><strong>Tumblr</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_tumblr" name="widget_social_connect_tumblr" value="<?php echo $settings['tumblr']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_tumblr">Heading</label><br />
		<input type="text" id="widget_social_connect_tumblr_name" name="widget_social_connect_tumblr_name" value="<?php echo $settings['tumblr_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_tumblr">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_tumblr_sub" name="widget_social_connect_tumblr_sub" value="<?php echo $settings['tumblr_sub']; ?>" size="30" /><br />
		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/delicious.png" />
		<label for="widget_social_connect_delicious"><strong>Delicious</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_delicious" name="widget_social_connect_delicious" value="<?php echo $settings['delicious']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_delicious">Heading</label><br />
		<input type="text" id="widget_social_connect_delicious_name" name="widget_social_connect_delicious_name" value="<?php echo $settings['delicious_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_delicious">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_delicious_sub" name="widget_social_connect_delicious_sub" value="<?php echo $settings['delicious_sub']; ?>" size="30" /><br />
		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/digg.png" />
		<label for="widget_social_connect_digg"><strong>Digg</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_digg" name="widget_social_connect_digg" value="<?php echo $settings['digg']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_digg">Heading</label><br />
		<input type="text" id="widget_social_connect_digg_name" name="widget_social_connect_digg_name" value="<?php echo $settings['digg_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_digg">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_digg_sub" name="widget_social_connect_digg_sub" value="<?php echo $settings['digg_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/stumbleupon.png" />
		<label for="widget_social_connect_stumble"><strong>StumbleUpon</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_stumble" name="widget_social_connect_stumble" value="<?php echo $settings['stumble']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_stumble">Heading</label><br />
		<input type="text" id="widget_social_connect_stumble_name" name="widget_social_connect_stumble_name" value="<?php echo $settings['stumble_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_stumble">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_stumble_sub" name="widget_social_connect_stumble_sub" value="<?php echo $settings['stumble_sub']; ?>" size="30" /><br />
		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/facebook.png" />
		<label for="widget_social_connect_facebook"><strong>Facebook</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_facebook" name="widget_social_connect_facebook" value="<?php echo $settings['facebook']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_facebook">Heading</label><br />
		<input type="text" id="widget_social_connect_facebook_name" name="widget_social_connect_facebook_name" value="<?php echo $settings['facebook_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_facebook">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_facebook_sub" name="widget_social_connect_facebook_sub" value="<?php echo $settings['facebook_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/linkedin.png" />
		<label for="widget_social_connect_linkedin"><strong>Linkedin</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_linkedin" name="widget_social_connect_linkedin" value="<?php echo $settings['linkedin']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_linkedin">Heading</label><br />
		<input type="text" id="widget_social_connect_linkedin_name" name="widget_social_connect_linkedin_name" value="<?php echo $settings['linkedin_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_linkedin">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_linkedin_sub" name="widget_social_connect_linkedin_sub" value="<?php echo $settings['linkedin_sub']; ?>" size="30" /><br />
		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/flickr.png" />
		<label for="widget_social_connect_flickr"><strong>Flickr</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_flickr" name="widget_social_connect_flickr" value="<?php echo $settings['flickr']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_flickr">Heading</label><br />
		<input type="text" id="widget_social_connect_flickr_name" name="widget_social_connect_flickr_name" value="<?php echo $settings['flickr_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_flickr">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_flickr_sub" name="widget_social_connect_flickr_sub" value="<?php echo $settings['flickr_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/picasa.png" />
		<label for="widget_social_connect_picasa"><strong>Picasa</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_picasa" name="widget_social_connect_picasa" value="<?php echo $settings['picasa']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_picasa">Heading</label><br />
		<input type="text" id="widget_social_connect_picasa_name" name="widget_social_connect_picasa_name" value="<?php echo $settings['picasa_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_picasa">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_picasa_sub" name="widget_social_connect_picasa_sub" value="<?php echo $settings['picasa_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/social_widget/youtube.png" />
		<label for="widget_social_connect_youtube"><strong>Youtube</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_youtube" name="widget_social_connect_youtube" value="<?php echo $settings['youtube']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_youtube">Heading</label><br />
		<input type="text" id="widget_social_connect_youtube_name" name="widget_social_connect_youtube_name" value="<?php echo $settings['youtube_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_youtube">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_youtube_sub" name="widget_social_connect_youtube_sub" value="<?php echo $settings['youtube_sub']; ?>" size="30" /><br />
		</p>
		
 
	</p>
	<input type="hidden" id="update_social_connect" name="update_social_connect" value="1" />
<?php }

/* 
Plugin Name: Ping/Track/Comment Count 
Plugin URI: http://txfx.net/code/wordpress/ping-track-comment-count/ 
Version: 1.1 
Description: Provides unctions that return or display the number of trackbacks, pingbacks, comments or combined pings recieved by a given post.  Other authors: Chris J. Davis, Scott "Skippy" Merrill 
Author: Mark Jaquith 
Author URI: http://markjaquith.com/ 
*/ 

/* 

This program is free software; you can redistribute it and/or 
modify it under the terms of the GNU General Public License 
as published by the Free Software Foundation; either version 2 
of the License, or (at your option) any later version. 

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.    See the 
GNU General Public License for more details. 

You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA     02110-1301, USA. 

*/


function get_comment_type_count($type='all', $post_id = 0) { 
    global $cjd_comment_count_cache, $id, $post; 
    if ( !$post_id ) 
        $post_id = $post->ID; 
    if ( !$post_id ) 
        return; 

    if ( !isset($cjd_comment_count_cache[$post_id]) ) { 
        $p = get_post($post_id); 
        $p = array($p); 
        update_comment_type_cache($p); 
    } 

    if ( $type == 'pingback' || $type == 'trackback' || $type == 'comment' ) 
        return $cjd_comment_count_cache[$post_id][$type]; 
    elseif ( $type == 'ping' ) 
        return $cjd_comment_count_cache[$post_id]['pingback'] + $cjd_comment_count_cache[$post_id]['trackback']; 
    else 
        return array_sum((array) $cjd_comment_count_cache[$post_id]); 

} 

function comment_type_count($type = 'all', $post_id = 0) { 
        echo get_comment_type_count($type, $post_id); 
} 

function update_comment_type_cache($queried_posts) { 
    global $cjd_comment_count_cache, $wpdb; 

    if ( !$queried_posts ) 
        return $queried_posts; 


    foreach ( (array) $queried_posts as $post ) 
        if ( !isset($cjd_comment_count_cache[$post->ID]) ) 
            $post_id_list[] = $post->ID; 

    if ( $post_id_list ) { 
        $post_id_list = implode(',', $post_id_list); 

        foreach ( array('', 'pingback', 'trackback') as $type ) { 
            $counts = $wpdb->get_results("SELECT ID, COUNT( comment_ID ) AS ccount 
            FROM $wpdb->posts 
            LEFT JOIN $wpdb->comments ON ( comment_post_ID = ID AND comment_approved = '1' AND comment_type='$type' ) 
            WHERE post_status = 'publish' AND ID IN ($post_id_list) 
            GROUP BY ID"); 

            if ( $counts ) { 
                if ( '' == $type ) 
                    $type = 'comment'; 
                foreach ( $counts as $count ) 
                    $cjd_comment_count_cache[$count->ID][$type] = $count->ccount; 
            } 
        } 
    } 
    return $queried_posts; 
} 
add_filter('the_posts', 'update_comment_type_cache');

/* 
Function Name: getCategories 
Version: 1.0 
Description: Gets the list of categories. Represents a workaround for the get_categories bug in WP 2.8 
Author: Dumitru Brinzan
Author URI: http://www.brinzan.net 
*/ 
function getCategories($parent) {

	global $wpdb, $table_prefix;
	
	$tb1 = "$table_prefix"."terms";
	$tb2 = "$table_prefix"."term_taxonomy";
	
	if ($parent == '1')
	{
	 $qqq = "AND $tb2".".parent = 0";
  }
  else
  {
    $qqq = "";
  }
  
	$q = "SELECT $tb1.term_id,$tb1.name,$tb1.slug FROM $tb1,$tb2 WHERE $tb1.term_id = $tb2.term_id AND $tb2.taxonomy = 'category' $qqq ORDER BY $tb1.name ASC";
	$q = $wpdb->get_results($q);
	
  foreach ($q as $cat) {
    	$categories[$cat->term_id] = $cat->name;
    } // foreach
  return($categories);
} // end func

/* 
Function Name: getPages 
Version: 1.0 
Description: Gets the list of pages. Represents a workaround for the get_categories bug in WP 2.8 
Author: Dumitru Brinzan
Author URI: http://www.brinzan.net 
*/ 

function getPages() {

	global $wpdb, $table_prefix;
	
	$tb1 = "$table_prefix"."posts";
  
	$q = "SELECT $tb1.ID,$tb1.post_title FROM $tb1 WHERE $tb1.post_type = 'page' AND $tb1.post_status = 'publish' ORDER BY $tb1.post_title ASC";
	$q = $wpdb->get_results($q);
	
  foreach ($q as $pag) {
    	$pages[$pag->ID] = $pag->post_title;
    } // foreach
  return($pages);
} // end func

/*
Plugin Name: Limit Posts
Plugin URI: http://labitacora.net/comunBlog/limit-post.phps
Description: Limits the displayed text length on the index page entries and generates a link to a page to read the full content if its bigger than the selected maximum length.
Usage: the_content_limit($max_charaters, $more_link)
Version: 1.1
Author: Alfonso Sanchez-Paus Diaz y Julian Simon de Castro
Author URI: http://labitacora.net/
License: GPL
Download URL: http://labitacora.net/comunBlog/limit-post.phps
Make:
    In file index.php
    replace the_content()
    with the_content_limit(1000, "more")
*/

function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0 && $thisshouldnotapply) {
      echo $content;
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo $content;
        echo "...";
   }
   else {
      echo $content;
   }
}

function wpzoom_breadcrumbs() {
 
  $delimiter = '&raquo;';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
     global $post;
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . '';
      single_cat_title();
      echo '' . $currentAfter;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
  
  }
}

function dp_recent_comments($no_comments = 10, $comment_len = 90) { 
    global $wpdb; 
	
	$request = "SELECT * FROM $wpdb->comments";
	$request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
	$request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password ='' AND comment_type = ''"; 
	$request .= " ORDER BY comment_date DESC LIMIT $no_comments"; 
		
	$comments = $wpdb->get_results($request);
		
	echo "$before_title"."$settings[title]"."$after_title";
  if ($comments) { 
		foreach ($comments as $comment) {
    
//    print_r($comment); 
			ob_start();
			?>
				<li>
					<div class="cover"><?php echo get_avatar($comment,$size='32' ); ?></div>
					<div class="info">
						<p><a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo dp_get_author($comment); ?></a> on:
						<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo $comment->post_title; ?></a></p>
					</div>
					<div class="sep">&nbsp;</div>
				</li>
			<?php
			ob_end_flush();
		} 
	} else { 
		echo "<li>No comments</li>";
	}
}

function dp_get_author($comment) {
	$author = "";

	if ( empty($comment->comment_author) )
		$author = __('Anonymous');
	else
		$author = $comment->comment_author;
		
	return $author;
}

function wp_get_related_posts() {
	global $wpdb, $post,$table_prefix;
	$wp_rp = get_option("wp_rp");
	
	$exclude = explode(",",$wp_rp["wp_rp_exclude"]);
	$limit = $wp_rp["wp_rp_limit"];
	$wp_rp_title = $wp_rp["wp_rp_title"];
	$wp_no_rp = $wp_rp["wp_no_rp"];
	$wp_no_rp_text = $wp_rp["wp_no_rp_text"];
	$show_date = $wp_rp["wp_rp_date"];
	$show_comments_count = $wp_rp["wp_rp_comments"];
	
	if ( $exclude != '' ) {
		$q = "SELECT tt.term_id FROM ". $table_prefix ."term_taxonomy tt, " . $table_prefix . "term_relationships tr WHERE tt.taxonomy = 'category' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id = $post->ID";

		$cats = $wpdb->get_results($q);
		
		foreach(($cats) as $cat) {
			if (in_array($cat->term_id, $exclude) != false){
				return;
			}
		}
	}
		
	if(!$post->ID){return;}
	$now = current_time('mysql', 1);
	$tags = wp_get_post_tags($post->ID);

	//print_r($tags);
	
	$taglist = "'" . $tags[0]->term_id. "'";
	
	$tagcount = count($tags);
	if ($tagcount > 1) {
		for ($i = 1; $i <= $tagcount; $i++) {
			$taglist = $taglist . ", '" . $tags[$i]->term_id . "'";
		}
	}
		
	if ($limit) {
		$limitclause = "LIMIT $limit";
	}	else {
		$limitclause = "LIMIT 10";
	}
	
	$q = "SELECT p.ID, p.post_title, p.post_date, p.comment_count, count(t_r.object_id) as cnt FROM $wpdb->term_taxonomy t_t, $wpdb->term_relationships t_r, $wpdb->posts p WHERE t_t.taxonomy ='post_tag' AND t_t.term_taxonomy_id = t_r.term_taxonomy_id AND t_r.object_id  = p.ID AND (t_t.term_id IN ($taglist)) AND p.ID != $post->ID AND p.post_status = 'publish' AND p.post_date_gmt < '$now' GROUP BY t_r.object_id ORDER BY cnt DESC, p.post_date_gmt DESC $limitclause;";

	//echo $q;

	$related_posts = $wpdb->get_results($q);
	$output = "";
	
	if (!$related_posts){
		
		if(!$wp_no_rp || ($wp_no_rp == "popularity" && !function_exists('akpc_most_popular'))) $wp_no_rp = "text";
		
		if($wp_no_rp == "text"){
			if(!$wp_no_rp_text) $wp_no_rp_text= __("No Related Post",'wp_related_posts');
//			$output  .= '<li>'.$wp_no_rp_text .'</li>';
		}	else{
			if($wp_no_rp == "random"){
				if(!$wp_no_rp_text) $wp_no_rp_text= __("Random Posts",'wp_related_posts');
				$related_posts = wp_get_random_posts($limitclause);
			}	elseif($wp_no_rp == "commented"){
				if(!$wp_no_rp_text) $wp_no_rp_text= __("Most Commented Posts",'wp_related_posts');
				$related_posts = wp_get_most_commented_posts($limitclause);
			}	elseif($wp_no_rp == "popularity"){
				if(!$wp_no_rp_text) $wp_no_rp_text= __("Most Popular Posts",'wp_related_posts');
				$related_posts = wp_get_most_popular_posts($limitclause);
			}else{
				return __("Something wrong",'wp_related_posts');;
			}
			$wp_rp_title = $wp_no_rp_text;
		}
	}		
		
	foreach ($related_posts as $related_post ){
		$output .= '<li>';
		
		if ($show_date){
			$dateformat = get_option('date_format');
			$output .=   mysql2date($dateformat, $related_post->post_date) . " -- ";
		}
		
		$output .=  '<a href="'.get_permalink($related_post->ID).'" title="'.wptexturize($related_post->post_title).'">'.wptexturize($related_post->post_title).'';
		
		if ($show_comments_count){
			$output .=  " (" . $related_post->comment_count . ")";
		}
		
		$output .=  '</a></li>';
	}
	
	$output = '<h2>Related Posts:</h2><ul class="related_post">' . $output . '</ul>';
		
	if($wp_rp_title != '') $output =  '<h3>'.$wp_rp_title .'</h3>'. $output;
	
	return $output;
}

function wp_related_posts(){
		
	$output = wp_get_related_posts() ;

	echo $output;
}

function wp_related_posts_auto($content=""){
	$wp_rp = get_option("wp_rp");
	$wp_rp_auto = ($wp_rp["wp_rp_auto"] == 'yes') ? 1 : 0;
	if ( (! is_single()) || (! $wp_rp_auto)) return $content;
	
	$output = wp_get_related_posts() ;
	$content = $content . $output;
	
	return $content;
}

// ADD OPTIONS FOR THE FEATURED POSTS WIDGET
$widget_featured_posts_options = array(
'featured_works_cat' => "1",
'featured_works_side' => "3",
'featured_works_title' => "Favourite Posts");
add_option('widget_featured_works_settings', $widget_featured_posts_options );

function featured_works_side($args) {

extract($args);

$widget_settings = get_option( 'widget_featured_works_settings' ); 
$breaking_tag = $widget_settings['featured_works_cat'];
$breaking_num = $widget_settings['featured_works_side'];
global $activestyle;

$args = array('showposts' => $breaking_num, 'orderby' => 'date', 'order' => 'DESC', 'cat' => $breaking_tag);

  query_posts($args);
    $i = 0;
    
    global $wpzoom_cf_photo, $wpzoom_cf_use;
        // Generate output
    echo $before_widget;
		echo "$before_title"."$widget_settings[featured_works_title]"."$after_title"; ?>
  
    <ul class="posts">
  
          <?php while (have_posts()) : the_post(); ?>

          <li>
        <?php 
          global $post;


         unset($img);
if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
            $img = $thumbURL[0]; 
						}

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

         if ($img) :          ?>
        <div class="cover"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;h=45&amp;w=60&amp;zc=1" alt="<?php the_title(); ?>" /></a></div>
          <?php endif; ?>  
     <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> 
    <p class="postmetadata"> <a href="<?php the_permalink() ?>#commentspost" title="Jump to the comments"><?php comments_number('0 comments','1 comment','% comments'); ?></a></p>
     <div class="cleaner">&nbsp;</div>
        </li>
          
       <?php endwhile; wp_reset_query(); ?>
       </ul><!-- end .posts -->
<?php
echo $after_widget;
wp_reset_query();
}

function featured_works_side_admin() {
	
	$widget_settings = get_option( 'widget_featured_works_settings' );
	if( isset( $_POST[ 'widget_update_featured' ] ) ) {
		$widget_settings['featured_works_side'] = strip_tags( stripslashes( $_POST[ 'featured_works_side' ] ) );
		$widget_settings['featured_works_cat'] = strip_tags( stripslashes( $_POST[ 'featured_works_cat' ] ) );
		$widget_settings['featured_works_title'] = strip_tags( stripslashes( $_POST[ 'featured_works_title' ] ) );
		update_option( 'widget_featured_works_settings', $widget_settings );
	} 
?>
	<label>Widget title:</label><br /> 
	<input type="input" id="featured_works_title" name="featured_works_title" value="<?php echo"$widget_settings[featured_works_title]";?>" /><br />
  <label for="featured_works_cat">Select the category for the posts:</label><br />
		<select id="featured_works_cat" name="featured_works_cat">
			<?php
				  
				$activecategory = $widget_settings['featured_works_cat'];
				
				$availablecats = getCategories();
				
				foreach ($availablecats as $key => $value ) {
					$option = '<option value="' . $key . '" ' . ( $activecategory == $key? " selected=\"selected\"" : "") . '>';
						$option .= $value;
					$option .= '</option>';
					echo $option;
				}
			?>
		</select><br />
	<label>Featured posts in sidebar:</label><br />
	<input type="input" id="featured_works_side" name="featured_works_side" value="<?php echo"$widget_settings[featured_works_side]";?>" /><br />
	<input type="hidden" id="widget_update_featured" name="widget_update_featured" value="1">

<?php

}

/* Recent Comments Widget
-----------------------------*/	

function recent_comments($args) {

  extract($args);
	$settings = get_option( 'widget_recent_comments' );
  
  echo $before_widget;
  echo "$before_title"."$settings[title]"."$after_title";
?>
		<ul class="sideComments">
				<?php dp_recent_comments($settings['number']); ?>
		</ul>
<?php
  echo $after_widget;

}

function recent_comments_admin() {
	$settings = get_option( 'widget_recent_comments' );
	
	if( isset( $_POST[ 'update_recent_news' ] ) ) {
		$settings[ 'title' ] = strip_tags( stripslashes( $_POST[ 'widget_rec_comments' ] ) );
		$settings[ 'number' ] = strip_tags( stripslashes( $_POST[ 'widget_rec_comments_num' ] ) );
		update_option( 'widget_recent_comments', $settings );
	}

?>
	<p>
		<label for="widget_rec_comments">Widget Title</label><br />
		<input type="text" id="widget_rec_comments" name="widget_rec_comments" value="<?php echo $settings['title']; ?>" /><br />
		<label for="widget_rec_comments">Number of Comments</label><br />
		<input type="text" id="widget_rec_comments_num" name="widget_rec_comments_num" value="<?php echo $settings['number']; ?>" />
	</p>
	<input type="hidden" id="update_recent_news" name="update_recent_news" value="1" />
<?php }

/* Recent Comments Widget
-----------------------------*/	

function catch_that_image ($post_id=0, $width=60, $height=60, $img_script='') {
	global $wpdb;
	if($post_id > 0) {

		 // select the post content from the db

		 $sql = 'SELECT post_content FROM ' . $wpdb->posts . ' WHERE id = ' . $wpdb->escape($post_id);
		 $row = $wpdb->get_row($sql);
		 $the_content = $row->post_content;
		 if(strlen($the_content)) {

			  // use regex to find the src of the image

			preg_match("/<img src\=('|\")(.*)('|\") .*( |)\/>/", $the_content, $matches);
			if(!$matches) {
				preg_match("/<img class\=\".*\" title\=\".*\" src\=('|\")(.*)('|\") .*( |)\/>/U", $the_content, $matches);
			}
			
			$the_image = '';
			$the_image_src = $matches[2];
			$frags = preg_split("/(\"|')/", $the_image_src);
			if(count($frags)) {
				$the_image_src = $frags[0];
			}

			  // if src found, then create a new img tag

			  if(strlen($the_image_src)) {
				   if(strlen($img_script)) {

					    // if the src starts with http/https, then strip out server name

					    if(preg_match("/^(http(|s):\/\/)/", $the_image_src)) {
						     $the_image_src = preg_replace("/^(http(|s):\/\/)/", '', $the_image_src);
						     $frags = split("\/", $the_image_src);
						     array_shift($frags);
						     $the_image_src = '/' . join("/", $frags);
					    }
					    $the_image = '<img alt="" src="' . $img_script . $the_image_src . '" />';
				   }
				   else {
					    $the_image = '<img alt="" src="' . $the_image_src . '" width="' . $width . '" height="' . $height . '" />';
				   }
			  }
			  return $the_image_src;
		 }
	}
}

/*
Plugin Name: Quick Flickr Widget
Plugin URI: http://kovshenin.com/wordpress/plugins/quick-flickr-widget/
Description: Display up to 20 of your latest Flickr submissions in your sidebar.
Author: Konstantin Kovshenin
Version: 1.2.10
Author URI: http://kovshenin.com/
Modified for WPZOOM by Dumitru Brinzan
*/

$flickr_api_key = "d348e6e1216a46f2a4c9e28f93d75a48"; // You can use your own if you like

function widget_quickflickr($args) {
	extract($args);
	
	$options = get_option("widget_quickflickr");
	if( $options == false ) {
		$options["title"] = "Flickr Photos";
		$options["rss"] = "";
		$options["items"] = 3;
		$options["target"] = "";
		$options["username"] = "";
		$options["user_id"] = "";
		$options["error"] = "";
	}
	
	$title = $options["title"];
	$items = $options["items"];
	$view = "_s";
	$before_item = "<li>";
	$after_item = "</li>";
	$before_flickr_widget = "<ul class=\"gallery\">";
	$after_flickr_widget = "</ul>";
	$more_title = $options["more_title"];
	$target = $options["target"];
	$username = $options["username"];
	$user_id = $options["user_id"];
	$error = $options["error"];
	$rss = $options["rss"];
	$tester = 0;
	
	if (empty($error))
	{	
		$target = ($target == "checked") ? "target=\"_blank\"" : "";
		
		$flickrformat = "php";
		
		if (empty($items) || $items < 1 || $items > 20) $items = 3;
		
		// Screen name or RSS in $username?
		if (!ereg("http://api.flickr.com/services/feeds", $username))
			$url = "http://api.flickr.com/services/feeds/photos_public.gne?id=".urlencode($user_id)."&format=".$flickrformat."&lang=en-us".$tags;
		else
			$url = $username."&format=".$flickrformat.$tags;
		
      eval("?>". file_get_contents($url) . "<?");
			$photos = $feed;

			if ($photos)
			{
			 $out .= $before_flickr_widget;
				
        foreach($photos["items"] as $key => $value)
				{
				  $tester++;
				
					if (--$items < 0) break;
					
					$photo_title = $value["title"];
					$photo_link = $value["url"];
					ereg("<img[^>]* src=\"([^\"]*)\"[^>]*>", $value["description"], $regs);
					$photo_url = $regs[1];
					
					//$photo_url = $value["media"]["m"];
					$photo_medium_url = str_replace("_m.jpg", ".jpg", $photo_url);
					$photo_url = str_replace("_m.jpg", "$view.jpg", $photo_url);
					
					if ($tester == 3)
					{
					  $before_item = '<li class="last">';
					  $tester = 0;
          }
          else
          {
            $before_item = '<li>';
          }
					
//					$photo_title = ($show_titles) ? "<div class=\"qflickr-title\">$photo_title</div>" : "";
					$out .= $before_item . "<a $target href=\"$photo_link\"><img class=\"flickr_photo\" alt=\"$photo_title\" title=\"$photo_title\" src=\"$photo_url\" /></a>" . $after_item;

				}
				$flickr_home = $photos["link"];
				$out .= $after_flickr_widget;
			}
			else
			{
				$out = "Something went wrong with the Flickr feed! Please check your configuration and make sure that the Flickr username or RSS feed exists";
			}

		?>
<!-- Quick Flickr start -->
	<?php echo $before_widget; ?>
		<?php if(!empty($title)) { $title = apply_filters('localization', $title); echo $before_title . $title . $after_title; } ?>
		<?php echo $out ?>
		<?php if (!empty($more_title) && !$javascript) echo "<a href=\"" . strip_tags($flickr_home) . "\">$more_title</a>"; ?>
	<?php echo $after_widget; ?>
<!-- Quick Flickr end -->
	<?php
	}
	else // error
	{
		$out = $error;
	}
}

function widget_quickflickr_control() {
	$options = $newoptions = get_option("widget_quickflickr");
	if( $options == false ) {
		$newoptions["title"] = "Flickr photostream";
		$newoptions["error"] = "Your Quick Flickr Widget needs to be configured";
	}
	if ( $_POST["flickr-submit"] ) {
		$newoptions["title"] = strip_tags(stripslashes($_POST["flickr-title"]));
		$newoptions["items"] = strip_tags(stripslashes($_POST["rss-items"]));
		$newoptions["more_title"] = strip_tags(stripslashes($_POST["flickr-more-title"]));
		$newoptions["target"] = strip_tags(stripslashes($_POST["flickr-target"]));
		$newoptions["username"] = strip_tags(stripslashes($_POST["flickr-username"]));
		
		if (!empty($newoptions["username"]) && $newoptions["username"] != $options["username"])
		{
			if (!ereg("http://api.flickr.com/services/feeds", $newoptions["username"])) // Not a feed
			{
				global $flickr_api_key;
				$str = @file_get_contents("http://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=".$flickr_api_key."&username=".urlencode($newoptions["username"])."&format=rest");
				ereg("<rsp stat=\\\"([A-Za-z]+)\\\"", $str, $regs); $findByUsername["stat"] = $regs[1];

				if ($findByUsername["stat"] == "ok")
				{
					ereg("<username>(.+)</username>", $str, $regs);
					$findByUsername["username"] = $regs[1];
					
					ereg("<user id=\\\"(.+)\\\" nsid=\\\"(.+)\\\">", $str, $regs);
					$findByUsername["user"]["id"] = $regs[1];
					$findByUsername["user"]["nsid"] = $regs[2];
					
					$flickr_id = $findByUsername["user"]["nsid"];
					$newoptions["error"] = "";
				}
				else
				{
					$flickr_id = "";
					$newoptions["username"] = ""; // reset
					
					ereg("<err code=\\\"(.+)\\\" msg=\\\"(.+)\\\"", $str, $regs);
					$findByUsername["message"] = $regs[2] . "(" . $regs[1] . ")";
					
					$newoptions["error"] = "Flickr API call failed! (findByUsername returned: ".$findByUsername["message"].")";
				}
				$newoptions["user_id"] = $flickr_id;
			}
			else
			{
				$newoptions["error"] = "";
			}
		}
		elseif (empty($newoptions["username"]))
			$newoptions["error"] = "Flickr RSS or Screen name empty. Please reconfigure.";
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option("widget_quickflickr", $options);
	}
	$title = wp_specialchars($options["title"]);
	$items = wp_specialchars($options["items"]);
	if ( empty($items) || $items < 1 ) $items = 3;
	
	$more_title = wp_specialchars($options["more_title"]);
	
	$target = wp_specialchars($options["target"]);
	$flickr_username = wp_specialchars($options["username"]);
	
	?>
	<p><label for="flickr-title"><?php _e("Title:"); ?> <input class="widefat" id="flickr-title" name="flickr-title" type="text" value="<?php echo $title; ?>" /></label></p>
	<p><label for="flickr-username"><?php _e("Flickr RSS URL or Screen name:"); ?> <input class="widefat" id="flickr-username" name="flickr-username" type="text" value="<?php echo $flickr_username; ?>" /></label></p>
	<p><label for="flickr-items"><?php _e("How many items?"); ?> <select class="widefat" id="rss-items" name="rss-items"><?php for ( $i = 1; $i <= 20; ++$i ) echo "<option value=\"$i\" ".($items==$i ? "selected=\"selected\"" : "").">$i</option>"; ?></select></label></p>
	<p><label for="flickr-more-title"><?php _e("More link anchor text:"); ?> <input class="widefat" id="flickr-more-title" name="flickr-more-title" type="text" value="<?php echo $more_title; ?>" /></label></p>
	<p><label for="flickr-target"><input id="flickr-target" name="flickr-target" type="checkbox" value="checked" <?php echo $target; ?> /> <?php _e("Target: _blank"); ?></label></p>
	<input type="hidden" id="flickr-submit" name="flickr-submit" value="1" />
	<?php
}

register_sidebar_widget( 'WPZOOM: Featured Posts', 'featured_works_side' );
register_widget_control( 'WPZOOM: Featured Posts', 'featured_works_side_admin', 300, 200 );
register_sidebar_widget( 'WPZOOM: Social Connections', 'connectWithMe' );
register_widget_control( 'WPZOOM: Social Connections', 'connectWithMe_admin', 300, 200 );
register_widget_control( 'WPZOOM: Gallery', "widget_quickflickr_control");
register_sidebar_widget( 'WPZOOM: Gallery', "widget_quickflickr");
?>