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

if (!class_exists('add_gxtbTinyMCE_Button') ){
class add_gxtbTinyMCE_Button {
	
	var $pluginname = "gxtb_fb_lB_TinyMCE";
	
	function add_gxtbTinyMCE_Button()  {
		// Modify the version when tinyMCE plugins are changed.
		add_filter('tiny_mce_version', array (&$this, 'change_tinymce_version') );
		
		// init process for button control
		add_action('init', array (&$this, 'addbuttons') );
	}

	function addbuttons() {
	
		// Don't bother doing this stuff if the current user lacks permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;
		
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
		 
		// add the button for wp2.5 in a new way
			add_filter("mce_external_plugins", array (&$this, "add_tinymce_plugin" ), 10);
			add_filter('mce_buttons', array (&$this, 'register_button' ), 10);
		}
	}
	
	// used to insert button in wordpress 2.5x editor
	function register_button($buttons) {
	
		array_push($buttons, "separator", $this->pluginname );
	
		return $buttons;
	}
	
	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	function add_tinymce_plugin($plugin_array) {    
	
		$plugin_array[$this->pluginname] = gxtb_fb_lB_URLPATH.'tinymce/editor_plugin.js';
		
		return $plugin_array;
	}
	
	function change_tinymce_version($version) {
		return ++$version;
	}

}
} // end if-class

if( class_exists('add_gxtbTinyMCE_Button') )
	$add_gxtbTinyMCE_Button = new add_gxtbTinyMCE_Button();
?>