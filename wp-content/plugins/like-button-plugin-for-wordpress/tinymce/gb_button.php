<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.2.3] - GB-TinyMCE-Button [v0.5]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  		TINYMCE-BUTTON		 ###########
###########		    			         ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

class gxtb_fb_lB_button {

	function gxtb_fb_lB_button() {
		global $wp_version;
		
		// Check for WP2.5 installation
		if (!defined ('IS_WP25'))
			define('IS_WP25', version_compare($wp_version, '2.5', '>=') );
		
		//This works only in WP2.5 or higher
		if ( IS_WP25 == FALSE) {
			add_action('admin_notices', create_function('', 'echo \'<div id="message" class="error fade"><p><strong>' . __('Sorry, Like-Shortcode works only under WordPress 2.5 or higher',gxtb_fb_lB_lang) . '</strong></p></div>\';'));
			return;
		}	
		include_once ('tinymce.php');
	}

} ## end class
?>