<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-AdminPage [v1.0.4 - FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
########################################################################################################
											## FAQ  ##
##	http://www.code-styling.de/downloads/howto-metabox-plugin.zip
##	http://andrewferguson.net/2008/09/26/using-add_meta_box/
##	http://wordpress.org/support/topic/356788 (EDITOR)
##  http://wefunction.com/2009/10/revisited-creating-custom-write-panels-in-wordpress/ (GOOD)
											## FAQ  ##
########################################################################################################

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       OPTION-CLASS			 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################

if(!class_exists('gxtb_fb_lB_spClass')) {
class gxtb_fb_lB_spClass {
	
	var $pagelevel;
	var $pagehook;
	
function gxtb_fb_lB_spClass($pagelevel) {
	
		$this->pagelevel = $pagelevel;
	
		add_filter('screen_layout_columns', array(&$this, 'on_screen_layout_columns'), 10, 2);
		add_action('admin_menu', array(&$this, 'on_admin_menu'));
		
		$mypluginoptionpageslug = "fb-like";
		if ( ( isset($_GET['page']) && strstr($_GET['page'],$mypluginoptionpageslug) )) { $ismypluginoptionpage = 'true'; } else { $ismypluginoptionpage = 'false'; }
		 
		if ( $ismypluginoptionpage == 'true' )
			 add_action('admin_head', array(&$this, 'gb_admin_header'));
			 
		// including the gb_metaboxes
		include_once('gb_general.php');
		include_once('gb_design.php');
		include_once('gb_meta.php');
		include_once('gb_sidebar.php');
		include_once('gb_quick.php');
		include_once('gb_admin_header.php');
		include_once('gb_faq.php');
		include_once('gb_insights.php');
		include_once('gb_expertmod.php');
		include_once('gb_settings.php');
		}

########################################################################################################
											## ADDING THE JS-File  ##

function gb_admin_header() {	
	gb_admin_header::gb_admin_head();
}
########################################################################################################
											## ADDING THE COLUMNS  ##

	function on_screen_layout_columns($columns, $screen) {
		//for WordPress 2.8 we have to tell, that we support 2 columns !
		if ($screen == $this->pagehook) {
			$columns[$this->pagehook] = 2;
		}
		return $columns;
	}

########################################################################################################
											## ADMIN-FUNCTION  ##
	function on_admin_menu() {

	global $wp_version;
	
	if ( version_compare( $wp_version, '2.8', '>=' ) ) {
		if(current_user_can($this->pagelevel)) { $this->pagehook = add_menu_page('FB-Like', __('Like', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-button', array(&$this, 'GBLikeButtonQuickInstall'),  gxtb_fb_lB_PLUGIN_FOLDER .'images/adminfb.png'); }
	} elseif ( version_compare( $wp_version, '2.8', '<' ) ) {
		if(current_user_can($this->pagelevel)) { $this->pagehook = add_menu_page('FB-Like', __('Like', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-button', array(&$this, 'GBLikeButtonQuickInstall'), gxtb_fb_lB_PLUGIN_FOLDER .'images/adminfb.png'); }
	}

	//register callback gets call prior your own page gets rendered
	#add_action('load-'.$this->pagehook, array(&$this, 'on_load_page'));

	## NEW ##
	if(current_user_can($this->pagelevel)) {
		$this->pagehook = add_submenu_page("fb-like-button", 'Easy-and-Quick-Installation', __('Installation', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-button');
		$this->pagehook = add_submenu_page("fb-like-button", 'FB-General', __('General', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-general', array(&$this, 'gb_general'));
		$this->pagehook = add_submenu_page("fb-like-button", 'FB-Design', __('Design', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-design', array(&$this, 'gb_design'));
		$this->pagehook = add_submenu_page("fb-like-button", 'FB-OpenGraph-Tags', __('OpenGraph Tags', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-opengraph', array(&$this, 'gb_meta'));
	#if(current_user_can($this->pagelevel)) { #$this->pagehook = add_submenu_page("fb-like-button", 'FB-Sidebar', __('Sidebar Plugin', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-sidebar', array(&$this, 'gb_sidebar')); }
	$this->pagehook = add_submenu_page("fb-like-button", 'FB-Insights', __('FB-Insights', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-insights', array(&$this, 'gb_insights')); }
	
	if(current_user_can('manage_options')) { # available only for admins #
	$this->pagehook = add_submenu_page("fb-like-button", 'FB-Settings', __('Plugin-Settings', gxtb_fb_lB_lang), 'administrator', 'fb-like-settings', array(&$this, 'gb_settings'));
	}
	
if(current_user_can($this->pagelevel)) { 
	$this->gb_expert(); /* $this->pagehook = add_submenu_page("fb-like-button", 'FB-Expert-Mode', __('Expert-Mode', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-expert', array(&$this, 'gb_expert'));*/
	$this->gb_faq();
	#$this->pagehook = add_submenu_page("fb-like-button", 'FB-FAQ', __('FAQ - Help', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-faq', array(&$this, 'gb_faq'));
	$this->pagehook = add_submenu_page("fb-like-button", 'GB-World', __('GB-World<small>.net</small>', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-gbworld', array(&$this, 'gb_infopage')); }
	}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      CALLBACK METHODS		 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################
	function GBLikeButtonQuickInstall() {
		$GBLikeButtonQuickInstall = new GBLikeButtonQuickInstall($this->pagehook);
	}
	function gb_general() {
		$GBLikeButtonGeneral = new GBLikeButtonGeneral($this->pagehook);	
	}
	function gb_design() {
		$gxtb_gb_design = new gxtb_gb_design($this->pagehook);
	}
	function gb_meta() {
		$gxtb_gb_meta = new gxtb_gb_meta($this->pagehook);
	}
	function gb_sidebar() {
		$GBLikeButtonSidebar = new GBLikeButtonSidebar;
	}
	function gb_insights() {
		$gxbt_gb_insights = new gxbt_gb_insights($this->pagehook);
	}
	function gb_settings() {
		$gxtb_gb_settings = new gxtb_gb_settings($this->pagehook);
	}
	function gb_faq() {
		$gxtb_fb_lB_FAQClass = new gxtb_fb_lB_FAQClass($this->pagelevel);
	}
	function gb_infopage() {
		include_once(dirname(dirname(__FILE__)) . '/gbworld/gbworld.php');
		$gbworld = new gbworld($this->pagehook);		
	}
	function gb_expert() {
		$gxtb_fb_lB_EXMClass = new gxtb_fb_lB_EXMClass();
	}
} // end class
} // end if-class
?>