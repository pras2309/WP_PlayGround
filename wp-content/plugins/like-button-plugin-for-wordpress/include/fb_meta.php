<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-Meta-Generator [v2.1 - FINAL] --> Beta-Hinweis: alle page_id zu post_id geändert
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       META-OUTPUT-Class	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
# More Info --> Function GBLikeButton_MetaOutput (gb_fb-like-button.php) #

if (!class_exists('gxtb_fb_lB_MetaAction')) {
class gxtb_fb_lB_MetaAction {
	var $GBLikeButton;
function gxtb_fb_lB_MetaAction() {
	add_action('wp_head', array( $this, 'GBLikeButton_MetaController' ));
}
function GBLikeButton_MetaController($content) {
	
if (!is_admin()) {
		
	$fbnometa = false;
	$metaoutput = false;

	if ( is_single() || is_page() ) {
		global $post, $wp_version;
		$post_id = $post;
		
		if (is_object($post_id)) 
			$post_id = $post_id->ID;
		$fbnometa = get_post_meta($post_id, '_fbnometa', true);
	}
		
	$this->GBLikeButton = get_option('GBLikeButton');
	
if (isset($this->GBLikeButton['Functions']['General']['OpenGraph']) && $this->GBLikeButton['Functions']['General']['OpenGraph'] == 1) {
	
	if($fbnometa == 1) { return ""; }
		 
	if ((isset($this->GBLikeButton['Functions']['Additional']['w3c']) && $this->GBLikeButton['Functions']['Additional']['w3c'] == 1)) { # w3c=on or fbnometa=checked
	
		if($_SERVER['HTTP_USER_AGENT'] == 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)' || is_user_logged_in()) { 
			
			$metaoutput = true;
			#add_action('wp_head', array( $this, 'GBLikeButton_MetaOutput' ));
			#ob_start(array( $this, 'GBLikeButton_MetaOutput' ));
			#ob_end_flush();
		}
	} else {
		
		$metaoutput = true;
		#add_action('wp_head', array( $this, 'GBLikeButton_MetaOutput' ));
		#ob_start(array( $this, 'GBLikeButton_MetaOutput' ));
		#ob_end_flush();
	}
}
	if($metaoutput) { return $this->GBLikeButton_MetaOutput($content); } else { return $content; };
} # is admin
} # end function

function GBLikeButton_MetaOutput($content) {
	
if(is_404()) { return; }
	
	global $post, $wp_query, $wp_version, $wpdb;
	$meta = "";
	$type = false;
	$title = false;
	$post_id = $post->ID;
   	#$post_id = $wp_query->post->ID;
	
if (isset($this->GBLikeButton['OpenGraph'])) {

    $GBLikeButton_Options= array(
		"fbaudio" => get_post_meta($post_id, '_fbaudio', true),
		"fbaudio_title" => get_post_meta($post_id, '_fbaudio_title', true),
		"fbaudio_artist" => get_post_meta($post_id, '_fbaudio_artist', true),
		"fbaudio_album" => get_post_meta($post_id, '_fbaudio_album', true),
		"fbaudio_type" => get_post_meta($post_id, '_fbaudio_type', true),
		
		"fbvideo" => get_post_meta($post_id, '_fbvideo', true),
		"fbvideo_height" => get_post_meta($post_id, '_fbvideo_height', true),
		"fbvideo_width" => get_post_meta($post_id, '_fbvideo_width', true),
		"fbvideo_type" => get_post_meta($post_id, '_fbvideo_type', true)
	);			
			
foreach($this->GBLikeButton['OpenGraph'] as $key => $value) {
	
if($value != "" || $key == "image") { 

switch ($key) {  
	
	case "site_name":
	case "title":
	case "url":
	
## BEGIN GB-Shortcodes ##
				switch ($value) {
					case strstr($value, '$binfo'):
					case strstr($value, '&#036;binfo'):
$meta .= '
<meta property="og:site_name" content="' . strip_tags(get_bloginfo('name')) . '"/>';
					break;
						
					case strstr($value, '$ptitle'):
					case strstr($value, '&#036;ptitle'):
					if(is_home()){
$meta .= '
<meta property="og:title" content="' . strip_tags(get_bloginfo ( 'name' )). '"/>';
						$title = true;
					} else if (is_page() || is_single()) {
$meta .= '
<meta property="og:title" content="' . strip_tags(get_the_title($post_id)) . '"/>';
						$title = true;
					} else if (is_archive() || is_category()) { ## Currently not dynamic ##
#$name = single_term_title('', false);		
$meta .= '
<meta property="og:title" content="'. strip_tags(wp_title('',false)) .'"/>';
					}
						break;
						
					case strstr($value, '$plink'):
					case strstr($value, '&#036;plink'):

						if(is_single()){
							$permalink = get_permalink($post->ID);
						}elseif(is_page()){
							$permalink = get_page_link($post->ID);
						}elseif(is_home()) {
							$permalink = get_bloginfo('url');
						}else {
							$permalink = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
						}
$meta .= '
<meta property="og:url" content="' . $permalink .'"/>';
						break;
					default:
$meta .= '
<meta property="og:' . $key . '" content="' . $value . '"/>';
						break;
				} // end switch
## END GB-Shortcodes #
	break;
	
## BEGIN Special Tags ##
	case "app_id":
	case "page_id":
	case "admins":
$meta .= '
<meta property="fb:' . $key . '" content="' . $value . '"/>';
	break;

# DESCRIPTION #
	case "dusage":
		if ($value != "blognon") {
			$this -> gxtb_meta_description($key, $value, &$meta);
		}
	break;
	
	case ( $key == "blogtype" && is_home() && $type == false):
$meta .= '
<meta property="og:type" content="' . $value . '"/>';
	$type = true;
	break;
	
	case ( $key == "pagetype" && is_page() && $type == false):
$meta .= '
<meta property="og:type" content="' . $value . '"/>';
	$type = true;
	break;
	
	case ( $key == "posttype" && is_single() && $type == false):
$meta .= '
<meta property="og:type" content="' . $value . '"/>';
	$type = true;
	break;
	
	case ( $key == "categorytype" && is_category() && $type == false):
$meta .= '
<meta property="og:type" content="' . $value . '"/>';
	$type = true;
	break;
	
	case ( $key == "archivetype" && is_archive() && $type == false):
$meta .= '
<meta property="og:type" content="' . $value . '"/>';
	$type = true;
	break;

	case "image":
if( is_single() || is_page() ) {
    $pic = get_post_meta($post_id, '_fbpic', true);
	
	#FEATURED Image
	if (version_compare( $wp_version, '2.9', '>=' )) {
		
		if (current_theme_supports('post-thumbnails')) {
			$fbfeatured = get_post_meta($post_id, '_fbfeatured', true);
			if($fbfeatured == 1) {
				$fbfeatured = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'post-thumbnails' );
				if ( preg_match('#^(.*)\.(png|gif|jpg|jpeg)$#i', $fbfeatured[0]) ) {								
$meta .= '
<meta property="og:' . $key . '" content="' . $fbfeatured[0] . '"/>';		
				} # end if-preg_match
			} # end if-featured
		} # end if current-theme
	} # end if version-compare
	
	# SPECIFIC Image
	if ( isset($pic) && !empty($pic) ) {
		if (preg_match('#^(.*)\.(png|gif|jpg|jpeg)$#i', $pic) ) {
$meta .= '
<meta property="og:' . $key . '" content="' . $pic . '"/>';
		} # end if-preg_match
	} # end if isset(pic)
	
	# DEFAULT Image
	if (is_single() || is_page()) { $fbnodefault = get_post_meta($post_id, '_fbnodefault', true); }
	if ( (is_single() || is_page ) && $value != "" && (isset($fbnodefault) && $fbnodefault == 0 && 
	   (( is_single() && $this->GBLikeButton['OpenGraph']['post_default'] ) ||
		( is_page() && $this->GBLikeButton['OpenGraph']['page_default'] ) ) ) ){
$meta .= '
<meta property="og:' . $key . '" content="' . $value . '"/>';	
	} # end if-nodefault
	
} else if ( $value != "" && (
		( is_home() && $this->GBLikeButton['OpenGraph']['frontpage_default'] ) ||
		( is_category() && $this->GBLikeButton['OpenGraph']['category_default'] ) ||
		( is_archive() && $this->GBLikeButton['OpenGraph']['archive_default'] )
		)) {
$meta .= '
<meta property="og:' . $key . '" content="' . $value . '"/>';
}# end if-single
	break;
	
## END Special Tags ##	
## BEGIN Tags ##	
	default:
	if ( !in_array($key, array('dusage', 'blogtype', 'pagetype', 'posttype', 'categorytype', 'archivetype', 'type', 'description', 'on', 'w3c', 'frontpage_default', 'page_default', 'post_default', 'category_default', 'archive_default', )) )
$meta .= '
<meta property="og:' . $key . '" content="' . $value . '"/>';
	break;
## END Tags ##
	} // end switch key

	} // end if-statement
} // end for-each


$meta .= $this->GBLikeButton_AdditionalTags($GBLikeButton_Options, $meta);

	/*return $this -> gxtb_using_message() . $meta . $this -> gxtb_using_message() . "
	". $content;*/ # --> NEEDED IF OB_START IS USED

	if(GBLikeButton_Beta && ( isset($this->GBLikeButton['Functions']['Additional']['SocialSpeedUp']) && $this->GBLikeButton['Functions']['Additional']['SocialSpeedUp'] == 1)) {	
		$GBSocialSpeed = "
<script type='text/javascript' src='http://js.gb-world.net/jquery/socialspeedup.js'></script><script type='text/javascript'>var GBLikeButton=jQuery.noConflict();jQuery(document).ready(function(){ GBLikeButton('span').GBSocialSpeed(); });</script>";
		wp_print_scripts( array( 'jquery'));
		echo $GBSocialSpeed;
	}
	
	echo  $this -> gxtb_using_message() . $meta . $this -> gxtb_using_message() . "
	
	". $content; # --> NEEDED IF OB_START IS NOT USED
}else{ # if-isset
	#return $meta;
	echo $meta;
} // end if-isset
}

function GBLikeButton_AdditionalTags($GBLikeButton_Options, &$meta) {
if (is_single() || is_page()) {
	foreach ($GBLikeButton_Options as $key => $additionalTags) {
		if($additionalTags != ""){
			switch ($key) {
				case "fbaudio":
$meta .= '
<meta property="og:audio" content="'.$additionalTags.'" />';
				break;
				case "fbaudio_title":
$meta .= '
<meta property="og:audio:title" content="'.$additionalTags.'" />';
				break;
				case "fbaudio_artist":
$meta .= '
<meta property="og:audio:artist" content="'.$additionalTags.'" />';
				break;
				case "fbaudio_album":
$meta .= '
<meta property="og:audio:album" content="'.$additionalTags.'" />';
				break;
				case "fbaudio_type":
$meta .= '
<meta property="og:audio:type" content="'.$additionalTags.'" />';
				break;
				
				case "fbvideo":
$meta .= '
<meta property="og:video" content="'.$additionalTags.'" />';
				break;
				case "fbvideo_height":
$meta .= '
<meta property="og:video:height" content="'.$additionalTags.'" />';
				break;
				case "fbvideo_width":
$meta .= '
<meta property="og:video:width" content="'.$additionalTags.'" />';
				break;
				case "fbvideo_type":
$meta .= '
<meta property="og:video:type" content="'.$additionalTags.'" />';
				break;
					
				default:
				break;		
			}	
		}
	}
}
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    ADDs the DESCRIPTION	 ###########
###########			META-TAG			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_meta_description($key, $value, $meta) {

	$content = "";
	$bloginfo = "";
	
	switch($this->GBLikeButton['OpenGraph']['dusage']) {
			
			case "blogd":
				$content = get_bloginfo('description');
				$bloginfo = get_bloginfo('description');
				break;
				
			case "bloge":
				if ( is_single() || is_page() ) {
					$content = $this -> gxtb_meta_get_description();
				}
				if ( is_category() ) {
					global $wp_query;
					$cat_ID = get_query_var('cat');
					$bloginfo = category_description($cat_ID);
					if ( strpos($bloginfo, "<p>") >= 0 ) {
						$first = strpos($bloginfo, "<p>");
						$last = strrchr($bloginfo, "</p>");
						$bloginfo = substr($bloginfo, $first+3, $last - 5);
					}
				} else { $bloginfo = get_bloginfo('description'); }
				break;
				
			case "blogn":
				$content = $this->GBLikeButton['OpenGraph']['description'];
				$bloginfo = $this->GBLikeButton['OpenGraph']['description'];
				break;
		}
	
	if($content == "")
		$content = get_bloginfo('description');
	if($bloginfo == "")
		$bloginfo = get_bloginfo('description');
		
if( !is_single() && !is_page() ) {
		if($bloginfo != "") {
$meta .= '
<meta property="og:description" content="' . strip_tags($bloginfo) . '"/>';
		}
} else if( (is_single() || is_page()) && $content != "" ) {
$meta .= '
<meta property="og:description" content="' .strip_tags($content) . '"/>';	
}

}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    CREATES the Description	 ###########
###########			META-TAG			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_meta_get_description() {

	global $post, $wp_query, $wpdb;
	$post_id = $post->ID;
	$max_len = 170; // max length
	$output = "";

if(is_single()) {

	#$page_name = get_the_title($post->ID);
	#$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	#$excerpt = get_the_excerpt($post->ID);
	#$excerpt = strip_tags(get_the_excerpt($post->ID));
	#$excerpt = the_excerpt($post->ID);
	
	# Get the excerpt of the current post #
	$query = "SELECT post_excerpt FROM wp_posts WHERE ID = " . $post_id . " LIMIT 1";
  	$result = $wpdb->get_results($query, ARRAY_A);
  	$excerpt = $result[0]['post_excerpt'];

	if ($excerpt != "") {
		$output = substr($excerpt, 0, $max_len);
		if(strlen($output) < strlen($excerpt)) $output = $output . " [...]"; else $output = $excerpt;
	} else {
		$post = get_post( $post_id, ARRAY_A );
		$output = $this -> gxtb_meta_content($post['post_content'], true);
		$output_ex = substr($output, 0, $max_len);
		if(strlen($output_ex) < strlen($output)) $output = $output_ex  . " [...]"; else $output = $output;
	}
} else { #working#
		#$page_name = get_the_title($post->ID);
		#$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
		$post_id = $post->ID;
		
		$post = get_post( $post_id, ARRAY_A );
		$output = $this -> gxtb_meta_content($post['post_content'], true);
		$output_ex = substr($output, 0, $max_len);
		if(strlen($output_ex) < strlen($output)) $output = $output_ex  . " [...]"; else $output = $output;
}
		return $output;
}
## inspired and modified by the Excerpt-Editor (http://www.laptoptips.ca/projects/wordpress-excerpt-editor/) by Andrew Ozz (http://www.laptoptips.ca/)
function gxtb_meta_content($str, $editing = false) {

	$autoopt['pgee_more'] = '';
	$autoopt['more_link'] = '';
	$autoopt['more_link_cc'] = '';
	$autoopt['more_text'] = 'Continue&nbsp;reading';
	$autoopt['pgee_length'] = '170';
	$autoopt['on_site'] = '';
	$autoopt['in_rss'] = '';

	$autoopt['do_shortcodes'] = '';
	$autoopt['pgee_tags'] = !empty($_POST['allowedtags']) ? preg_replace('/[^<>a-zA-Z0-6]+/', '', $_POST['allowedtags']) : '';

	$html_tags = empty($autoopt['pgee_tags']) ? false : $autoopt['pgee_tags'];

	$cut = true;
	if ( strpos($str, '<!--more') && !empty($autoopt['pgee_more']) ) {
		$str = substr( $str, 0, strpos($str, '<!--more') );
		$cut = false;
	}

	$str = preg_replace('|<style[^>]*>.*?</style>|si', '', $str); // remove style
	$str = preg_replace('|<script[^>]*>.*?</script>|si', '', $str); //remove js
	$str = preg_replace('|<![\s\S]*?--[ \t\n\r]*>|', '', $str); // remove CDATA, html comments

	if ( $html_tags )
		$str = strip_tags($str, $html_tags);
	else
		$str = strip_tags($str);

	if ( !empty($autoopt['do_shortcodes']) )
		$str = strip_shortcodes($str);

	if ( $cut ) {
		$words = preg_split('/[ \t\r]+/', $str, $autoopt['pgee_length'] + 1);
		if ( count($words) > $autoopt['pgee_length'] )
			array_pop($words);

		$str = implode(' ', $words);

		if ( $html_tags ) {
			if ( strpos($str, '<') !== false && ( ! strpos($str, '>') || strrpos($str, '<') > strrpos($str, '>') ) )
				$str = substr( $str, 0, strrpos($str, '<') );
		}

		$str = trim($str);
		$str = rtrim($str, '.,:;');
	}

	if ( $html_tags )
		$str = balanceTags($str, true);

	if ( !$editing && empty($autoopt['do_shortcodes']) )
		$str = do_shortcode($str);

	return $str;
}
####################################################
####################################################
##### YOU ARE NOT ALLOWED TO DELETE THIS LINE ######
####################################################
##################### by gb-world.net   ############
####################################################
function gxtb_using_message() {

return '
<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by Stefan Natter (http://www.gb-world.net) -->';
}
####################################################
####################################################
##### YOU ARE NOT ALLOWED TO DELETE THIS LINE ######
####################################################
##################### by gb-world.net   ############
####################################################

} // end class
} // end if-class
?>