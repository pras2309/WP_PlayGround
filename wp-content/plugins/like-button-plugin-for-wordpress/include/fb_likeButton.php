<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.4] - GBLikeButton [v1.0 - FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  LIKE-BUTTON ACTION-CLASS	 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
if (!class_exists('gxtb_fb_lB_Class')) {
include_once( 'gb_generate.php');
class gxtb_fb_lB_Class extends gxtb_fb_lB_GenerateLike {

	var $GBLikeButton;

function gxtb_fb_lB_Class() {
			
	$this->GBLikeButton = get_option('GBLikeButton');

	// this security-if is new since v4.0 because we got some errors without this if-statement
	if ( !isset($this->GBLikeButton['General']['addfooter_activate']) || empty($this->GBLikeButton['General']['addfooter_activate']) ) {
		$this->GBLikeButton['General']['addfooter_activate'] = false;
	}
		
	if ( isset($this->GBLikeButton['Functions']['General']['LikeButton']) && $this->GBLikeButton['Functions']['General']['LikeButton'] == 1 ) {
		
		// generates the header before the site is loaded
		add_action('wp_head', array($this, 'gxtb_fb_lB_ajax'));
		include_once('fb_inc.php');
		add_action('wp_footer', 'GBLikeButton_JavaSDK');
		
		if(isset($this->GBLikeButton['PluginSetting']['Priority']) && $this->GBLikeButton['PluginSetting']['Priority'] >= 0) { 
			add_filter('the_content', array( $this, 'GBLikeButton_LikeOutput' ),$this->GBLikeButton['PluginSetting']['Priority']);
		} else {
			add_filter('the_content', array( $this, 'GBLikeButton_LikeOutput' ),98);
			#adding the like-button before/after the content
			#add_action('the_content', array( $this, 'gxtb_fb_lB_add_after_post' ),98);
		}
		// checking if the user wants to add the like-button after/before the footer
		if($this->GBLikeButton['General']['addfooter_activate']) {
		
			if ($this->GBLikeButton['General']['addfooter'] == __('Before the Footer', gxtb_fb_lB_lang) || $this->GBLikeButton['General']['addfooter'] == __('Vor dem Footer', gxtb_fb_lB_lang)) {
				add_action('get_footer', array( $this, 'gxtb_fb_lB_footer_function'));
				
			} else {
				add_action('wp_footer', array( $this, 'gxtb_fb_lB_footer_function'));
			}
		}
				
		## adds the like-button to the rss-feed if the users wants it - OFFEN
		##add_filter('the_excerpt_rss', array( $this, 'gxtb_fb_lB_rss_function'));
		##add_filter('the_content_rss', array( $this, 'gxtb_fb_lB_rss_function'));
		#add_filter( 'the_excerpt', array( $this, 'GBLikeButton_LikeOutput' ) );
	}
	
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       BETA-Methods			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_rss_function($content) {
	if($content != "")	
	return $content;
} // end function

function gxtb_fb_lB_ajax() {	
global $wp_version;
wp_print_scripts( array( 'sack' ));
if ( version_compare( $wp_version, '2.7.999', '>' ) ) {
?>
<script type="text/javascript">
var ajaxurl = ajaxurl;
</script>
<?php
} else {
?>
<script type="text/javascript">
var ajaxurl = "<?php echo get_bloginfo( 'wpurl') . '/wp-admin/admin-ajax.php'; ?>";
</script>
<?php
}

} //end function
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  ADD THE LIKE-BUTTON		 ###########
###########			AFTER THE CONTENT	 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function GBLikeButton_LikeOutput($content) {

if( !is_404() ) {

	$like_button_shown = false;
	
	global $post, $wp_query;
   	$page_id = $wp_query->post->ID;
    $fbnone = get_post_meta($page_id, '_fbnone', true);

	if ( $this->GBLikeButton['Functions']['General']['LikeButton'] && $fbnone == 0 ) {
				
		$text = "";
		
		/* PAGE - OPTIONS */
		$gxtb_frontpage = $this->GBLikeButton['General']['frontpage'];
		$gxtb_page = $this->GBLikeButton['General']['page'];
		$gxtb_post = $this->GBLikeButton['General']['post'];
		$gxtb_category = $this->GBLikeButton['General']['category'];
		$gxtb_archiv = $this->GBLikeButton['General']['archiv'];
		
		if($gxtb_frontpage) {
			if(is_home()) {
				$text = $this -> GBLikeButtonGenerate();
				$like_button_shown = true;
			}
		}
		
		if($gxtb_page) {
			if(is_page()) {
				if($this-> gxtb_fb_lB_exclude_check("page")) {
					$text = $this -> GBLikeButtonGenerate();
					$like_button_shown = true;
				}
			}
		}
		
		if($gxtb_post) {
			if(is_single()){
				if($this-> gxtb_fb_lB_exclude_check("post")) {
					$text = $this -> GBLikeButtonGenerate();
					$like_button_shown = true;
				}
			}
		}
		
		if($gxtb_category) {
			if(is_category()) {
				if($this-> gxtb_fb_lB_exclude_check("category")) {
					$text = $this -> GBLikeButtonGenerate();
					$like_button_shown = true;
				}
			}
		}
		
		if($gxtb_archiv) {
			if(is_archive()) {
				if($this-> gxtb_fb_lB_exclude_check("archiv")) {
					$text = $this -> GBLikeButtonGenerate();
					$like_button_shown = true;
				}
			}
		}
			
	} else {
	 	return $content;
	 } // end if activate 

if( $like_button_shown && ( isset($this->GBLikeButton['General']['position_before']) || isset($this->GBLikeButton['General']['position_after']) ) ) {
	$gxtb_fb_lB_settings_both = false;

	if ( $this->GBLikeButton['General']['position_before'] == 1 && $this->GBLikeButton['General']['position_after'] == 1 ) {
	
		$text = $this -> gxtb_fb_lB_breaks("before") . $text . $this -> gxtb_fb_lB_breaks("after") . $content . $this -> gxtb_fb_lB_breaks("before") . $text;
		$gxtb_fb_lB_settings_both = true;
		
	} else if ( $this->GBLikeButton['General']['position_before'] == 0 && $this->GBLikeButton['General']['position_after'] == 0 ) {
	
		$text = $content . $this -> gxtb_fb_lB_breaks("before") . $text;
		
	} else if ( $this->GBLikeButton['General']['position_before']  == 1 && !$gxtb_fb_lB_settings_both ) {

		$text = $this -> gxtb_fb_lB_breaks("before")  . $text . $this -> gxtb_fb_lB_breaks("after") . $content;
		
	} else if ( $this->GBLikeButton['General']['position_after'] == 1 && !$gxtb_fb_lB_settings_both ) {
	
		$text = $content . $this -> gxtb_fb_lB_breaks("before") . $text;

	}
	
} else {
	$text = $content;
}
	return $text;
} // end if-404	
} // end function

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  ADDs the <br> BEFORE or	 ###########
###########			AFTER the BUTTON	 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_breaks($code) {
$br = "";
if ($code == "before") {
	for($count = 1; $count <= $this->GBLikeButton['Design']['br_before']; $count++)
	{
		$br .= "<br />";
	}
}
if ($code == "after") {
	for($count = 1; $count <= $this->GBLikeButton['Design']['br_after']; $count++)
	{
		$br .= "<br />";
	}
}
return $br;
} // end gxtb_fb_lB_breaks

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  CHECKS IF YOU CHOOSE 		 ###########
###########			EXCLUDED IDs	 	 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_exclude_check($def) {

	/* EXCLUDE - OPTIONS */
	$gxtb_page = $this->GBLikeButton['General']['page_exclude'];
	$gxtb_post = $this->GBLikeButton['General']['post_exclude'];
	$gxtb_category = $this->GBLikeButton['General']['category_exclude'];
	$gxtb_archiv = $this->GBLikeButton['General']['archiv_exclude'];

	$array = array();

	switch ($def) {
	
		case "page":
		
			if ((strpos($gxtb_page, ",")) > 0) {
				$array = $this -> ArrayTrim($gxtb_page);
				
				if(!is_page($array))
					return true;
				else
					return false;
					
			} elseif ($gxtb_page != "") {
				
				if(!is_page($gxtb_page))
					return true;
					
			} else {
				
				return true;
			}
			
		break;
				
		case "post":
		
			if ((strpos($gxtb_post, ",")) > 0) {
				$array = $this -> ArrayTrim($gxtb_post);
				
				if(!is_single($array))
					return true;
				else
					return false;
					
			} elseif ($gxtb_post != "") {
				
				if(!is_single($gxtb_post))
					return true;
					
			} else {
				
				return true;
			}				
		break;
				
		case "category":
			if ((strpos($gxtb_category, ",")) > 0) {
				$array = $this -> ArrayTrim($gxtb_category);
				
				if(!is_category($array))
					return true;
				else
					return false;
					
			} elseif ($gxtb_category != "") {
				
				if(!is_category($gxtb_category))
					return true;
					
			} else {
				
				return true;
			}				
		break;
				
		case "archiv":
			if ((strpos($gxtb_archiv, ",")) > 0) {
				$array = $this -> ArrayTrim($gxtb_archiv);
				
				if(!is_archive($array))
					return true;
				else
					return false;
					
			} elseif ($gxtb_archiv != "") {
				
				if(!is_archive($gxtb_archiv))
					return true;
					
			} else {
				
				return true;
			}				
		break;
								
		default:
			return false;
	}
}

function ArrayTrim($content) {

	if ($content != "") {

		$array = array();
		$i = 0;
	
		##echo "BEFORE: " . $content . "<br>";
		
		while (!$this -> ArrayCheck($content)){
			
			$i += 1;
			
			$pos = strpos($content, ",", 0);
			$array[strval($i)] = substr($content, 0, $pos);
			
			$content = strstr($content, ",");
			##echo "STRSTR: " . $content . "<br>";
			
			$content = trim($content, ",");
			##echo "TRIM: " .  $content  . "<br>";
			
			if(!strpos($content,","))
				$array[strval($i + 1)] = substr($content, 0);
		}
		
			return $array;
	} else {
		return "";
	}
}


function ArrayCheck($content) {

	$find = strpos($content, ",");
	
	if($find > 0) {
		return false;
	} else {
		return true;
	}
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  LIKE-BUTTON (SHORTCODE)	 ###########
###########			FOOTER-ACTION		 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
function gxtb_fb_lB_footer_function() {
	echo $this -> GBLikeButtonGenerate();
	#$this -> gxtb_fb_lB_java();
	echo $this -> gxtb_using_message();
}
####################################################
####################################################
##### YOU ARE NOT ALLOWED TO DELETE THIS LINE ######
####################################################
##################### by gb-world.net   ############
####################################################
function gxtb_using_message() {

return '
<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by Stefan Natter (http://www.gb-world.net) -->
';
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