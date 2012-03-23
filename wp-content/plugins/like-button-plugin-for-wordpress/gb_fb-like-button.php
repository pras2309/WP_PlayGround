<?php
/* 
	Plugin Name: Like-Button-Plugin-For-Wordpress
	Plugin URI: http://www.gb-world.net/like-button-plugin-for-wordpress/
	Description: This Plugin provides the most settings for the Like-Button of Facebook. It's in a steadily development to ensure that everything is up-to-date with all the Web 2.0 Standards and Requirements. Enjoy the Like-Button now with GB-World.net's Like-Button-Plugin-For-Wordpress! <strong>Please BACKUP your database everytime BEFORE you update to a new version!</strong>
	Version: 4.5.2
	Author: Stefan Natter
	Author URI: http://www.gb-world.net
	Min WP Version: 3.0
	Max WP Version: 3.2.x
*/

/* Copyright (C) 2010 Stefan Natter (http://www.gb-world.net)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

<http://www.gnu.org/licenses/>.
http://www.gnu.org/licenses/gpl.txt
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      STOP DIRECT CALL		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

#if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }		
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      MAIN-CLASS			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
if(!class_exists('GBLikeButton')) {
class GBLikeButton {
	
	# Klassenvariablen #
	var $GBLikeButton; /* diese Variable verk�rpert alle Settings aller Einstellungen Klassenweit */
	var $GBWarningSys;
	var $GBLikeButtonAdminBar; /* diese Variable verk�rpert das Admin-Men� */
	var $GBLikeButtonDashboard;
	var $GBLikeButtonGenerateClass;
	var $GBLikeButtonQuickEdit;
	var $pagelevel;
	var $currentpage;
	
function GBLikeButton() {

########################################################################################################
											## BEGIN DEFINITIONS  ##

	## including another plugin for our plugin ##
	include_once('plugins/changelogger/changelogger.php');

	$gb_fb_lB_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	$this->GBLikeButton = get_option('GBLikeButton');									
	global $wp_version;
	
if ( !defined('gxtb_fb_lB_shortcode' ) )
	define( 'gxtb_fb_lB_shortcode', "gxtb" );
if ( !defined('GBLikeButton_Version' ) )
	define( 'GBLikeButton_Version', "4.5.2" );
if ( !defined( 'GBLikeButton_Name' ) )
	define( 'GBLikeButton_Name', "Like-Button-Plugin-For-Wordpress" );
if ( !defined( 'gxtb_fb_lB_page' ) )
	define( 'gxtb_fb_lB_page', "fb-like-button" );
if ( !defined( 'gxtb_fb_lB_lang' ) )
	define( 'gxtb_fb_lB_lang', "gb_like_button" );
if ( !defined( 'GBLikeButton_Debug' ) )
	define( 'GBLikeButton_Debug', false );
if ( !defined( 'GBLikeButton_Delete' ) )
	define( 'GBLikeButton_Delete', false );
if ( !defined( 'GBLikeButton_Log' ) )
	define( 'GBLikeButton_Log', false );
if ( !defined( 'GBLikeButton_Beta' ) )
	define( 'GBLikeButton_Beta', false );
if ( !defined( 'gxtb_fb_lB_name' ) )
	define( 'gxtb_fb_lB_name', GBLikeButton_Name );
if ( !defined('gxtb_fb_lB_version' ) )
	define( 'gxtb_fb_lB_version', GBLikeButton_Version );
if ( !defined( 'gxtb_fb_lB_debug' ) )
	define( 'gxtb_fb_lB_debug', GBLikeButton_Debug );
if ( !defined( 'gxtb_fb_lB_beta' ) )
	define( 'gxtb_fb_lB_beta', GBLikeButton_Beta );
if ( !defined( 'gxtb_fb_lB_PLUGIN_FOLDER' ) )
	define( 'gxtb_fb_lB_PLUGIN_FOLDER', $gb_fb_lB_path );
if ( !defined( 'gxtb_fb_lB_FB_BASENAME' ) )
	define( 'gxtb_fb_lB_FB_BASENAME', plugin_basename( __FILE__ ) );
if ( !defined( 'gxtb_fb_lB_FB_BASEFOLDER' ) )
	define( 'gxtb_fb_lB_FB_BASEFOLDER', plugin_basename( dirname( __FILE__ ) ) );
if ( !defined( 'gxtb_fb_lB_FB_FILENAME' ) )
	define( 'gxtb_fb_lB_FB_FILENAME', str_replace( gxtb_fb_lB_FB_BASEFOLDER.'/', '', plugin_basename(__FILE__) ) );
if ( !defined( 'gxtb_fb_lB_ABSPATH' ) )
	define('gxtb_fb_lB_ABSPATH', WP_PLUGIN_DIR.'/'.plugin_basename( dirname(__FILE__) ).'/' );
if ( !defined( 'gxtb_fb_lB_URLPATH' ) )
	define('gxtb_fb_lB_URLPATH', WP_PLUGIN_URL.'/'.plugin_basename( dirname(__FILE__) ).'/' );

											## END DEFINITIONS  ##
########################################################################################################
											## BEGIN OTHER HOOKS ##
											
	if ( function_exists('register_activation_hook') ) { register_activation_hook( __FILE__, array(&$this, 'GBLikeButton_Activate')); }
	if ( function_exists('register_deactivation_hook') ) { register_deactivation_hook( __FILE__, array(&$this, 'GBLikeButton_Deactivate')); }
	## http://codex.wordpress.org/Function_Reference/register_uninstall_hook  || http://wpengineer.com/35/wordpress-plugin-deinstall-data-automatically/##
	if ( function_exists('register_uninstall_hook') ) {	register_uninstall_hook(__FILE__, 'GBLikeButton_Uninstall'); }
	
											## END OTHER HOOKS ##
########################################################################################################
											## BEGIN PLUGIN-PAGE-BUTTONS ##

	// add aditional links to the plugin-page
	if ( version_compare( $wp_version, '2.8', '>=' ) ) {
	  	add_filter( 'plugin_row_meta', array( $this, 'GBLikeButton_PluginLinks' ), 10, 2 ); // only 2.8 and higher
		add_filter( 'plugin_action_links', array( $this, 'GBLikeButton_PluginLinks' ), 10, 2 );
		
		// add message to list of plugins, if an update is available / add additional links on Plugins page, but only if page is plugins.php
		if ( is_admin() && 'plugins.php' == $GLOBALS['pagenow'] ) {
			add_action( 'in_plugin_update_message-' . plugin_basename(__FILE__), array( $this, 'GBLikeButton_UpdateNotice' ), 10, 2 );
		}
		
	} else {
		add_filter( 'plugin_action_links', array( $this, 'GBLikeButton_PluginLinks' ), 10, 2 );
	}

											## END PLUGIN-PAGE-BUTTONS ##
########################################################################################################
##http://de.selfhtml.org/javascript/objekte/document.htm#get_elements_by_tag_name
########################################################################################################
																						## BEGIN SCRIPTS ##

	  # jQuery-JS-Stuff #
	  wp_register_script('gb-jquery-preview', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/jquery.preview.script.js', false, '1.0');
	  wp_register_script('gb-jquery-thumbs', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/jquery.thumbs.js', false, '1.1');
	  wp_register_script('gb-jquery-mousewheel', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/jquery.mousewheel-3.0.4.pack.js', false, '3.0.4');
	  wp_register_script('gb-jquery-fancybox', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/jquery.fancybox-1.3.4.pack.js', false, '1.3.4');
	  wp_register_script('gb-jquery-formly', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/formly.min.js', false, '1.0');
	  wp_register_script('gb-jquery-accordion', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/jquery.accordion.js', false, '1.0');
	  wp_register_script('gb-jquery-guider', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/guiders.js', false, '1.1.0');
	  
	  # Admin-JS-Stuff #	  
	  wp_register_script('gb-generator', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/js/gb_generator.js', false, '1.2');
	  wp_register_script('gb-js', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/js/gb_js.js', false, '1.5');
	  wp_register_script('gb-js-php', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/js/gb_js.php', false, '1.0');
	  wp_register_script('gb-expert', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/js/gb_expert.js', false, '0.1');

	  # jQuery-CSS-Stuff #
	  wp_register_style('gb-jquery-ui', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/jquery-ui-1.8.4.custom.css', false, '1.8.4');	
	  wp_register_style('gb-jquery-fancybox', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/jquery.fancybox-1.3.4.css', false, '1.3.4');			
	  wp_register_style('gb-tooltips', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/tooltips.css', false, '1.0');	
	  wp_register_style('gb-formly', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/formly.min.css', false, '1.0');
	  wp_register_style('gb-thumbs',gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/jquery.thumbs.css', false,'1.0');
	  wp_register_style('gb-jquery-guider',gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/guiders.css', false,'1.1.0');
	  
	  # Admin-CSS-Stuff #
	  wp_register_style('gb-widget',gxtb_fb_lB_PLUGIN_FOLDER . 'admin/css/widget.css', false,'0.2');
	  wp_register_style('gb-admin', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/admin.css', false, '2.1.2');	
	  wp_register_style('gb-adminsmart', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/adminsmart.css', false, '1.0', 'screen,protection');
	  	 
	  # Frontend-CSS-Stuff # 
	  wp_register_script('gb-frontendscript-admin',gxtb_fb_lB_PLUGIN_FOLDER. 'frontend/frontend_admin.js', false, '0.1');	
	  
	  # GB-World-JS&CSS-Stuff # 
	  wp_register_style('gb-world', gxtb_fb_lB_PLUGIN_FOLDER. '/gbworld/css/gbworld.css', false, '2.0');	
	  wp_register_script('gb-info','http://js.gb-world.net/wordpress/like-button-plugin-for-wordpress/info.js', false, '0.1');
	  wp_register_script('gb-socialspeedup','http://js.gb-world.net/jquery/socialspeedup.js', false, '0.1');
	  wp_register_script('gb-socialtracking','http://js.gb-world.net/lib/ga_social_tracking.js', false, '0.1');
	  
	  # FAQ-Stuff # 
	  wp_register_style('gb-faq-syntaxcore', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/shCore.css', false, '3.0.83');	
	  wp_register_style('gb-faq-syntax', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/shThemeDefault.css', false, '3.0.83');	
	  wp_register_script('gb-faq-syntaxcore',gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/shCore.js', false, '3.0.83');
	  wp_register_script('gb-faq-syntaxloader',gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/shAutoloader.js', false, '3.0.83');
	  wp_register_script('gb-faq-syntaxcss',gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/shBrushCss.js', false, '3.0.83');
	  wp_register_script('gb-faq-syntaxphp',gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/shBrushPhp.js', false, '3.0.83');
	  wp_register_script('gb-faq-syntaxjscript',gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/shBrushJScript.js', false, '3.0.83');
  	
											## END SCRIPTS ##
########################################################################################################
											## BEGIN INCLUDE ##

	if (isset($this->GBLikeButton['PluginSetting']['Userlevel']) && $this->GBLikeButton['PluginSetting']['Userlevel'] != "") {
		$this->pagelevel = $this->GBLikeButton['PluginSetting']['Userlevel'];
	}  else { $this->pagelevel = "administrator"; }
		
	switch ($this->pagelevel) {
		case "contributor":
			$this->pagelevel = "edit_posts";
		break;
		case "author":
			$this->pagelevel = "publish_posts";
		break;
		case "editor":
			$this->pagelevel = "publish_pages";
		break;
		case "administrator":
		if ( version_compare( $wp_version, '3.0', '>=' ) ) {
			$this->pagelevel = "manage_options";
		} else {
			$this->pagelevel = "administrator";	
		}
		break;	
	}
	
	#include_once(dirname(__FILE__) . '/admin/gb_message.php');	
	#$this -> GBWarningSys = new GBWarningSys();

	if (isset($this->GBLikeButton['Functions']['General']['LikeButton']) && $this->GBLikeButton['Functions']['General']['LikeButton'] == 1) {	
		include_once( 'include/fb_likeButton.php' );
		$this->GBLikeButtonGenerateClass = new gxtb_fb_lB_Class();
	}	
	if (isset($this->GBLikeButton['Functions']['General']['OpenGraph']) && $this->GBLikeButton['Functions']['General']['OpenGraph'] == 1) {	
		include_once( 'include/fb_meta.php');
		$gxtb_fb_lB_MetaAction = new gxtb_fb_lB_MetaAction();
	}
	if (isset($this->GBLikeButton['Functions']['General']['TemplateFunction']) && $this->GBLikeButton['Functions']['General']['TemplateFunction'] == 1) {
		include_once(dirname(__FILE__) . '/include/fb_template.php');
	}
	if (isset($this->GBLikeButton['Functions']['General']['Widget']) && $this->GBLikeButton['Functions']['General']['Widget'] == 1) {
		include_once( 'include/fb_widget.php');
		$gxtb_fb_lB_WidgetClass = new gxtb_fb_lB_WidgetClass();
	}
	if (isset($this->GBLikeButton['Functions']['General']['Shortcode']) && $this->GBLikeButton['Functions']['General']['Shortcode'] == 1) {
		include_once( 'include/gb_shortcode.php' );
	}
	if (isset($this->GBLikeButton['Functions']['Editor']['PostButton']) && $this->GBLikeButton['Functions']['Editor']['PostButton'] == 1) {
		include_once(dirname(__FILE__) . '/tinymce/gb_button.php');		
		// Start the tinymce-modul once all other plugins are fully loaded
		add_action( 'plugins_loaded', create_function( '', 'global $gxtb_fb_lB_button; $gxtb_fb_lB_button = new gxtb_fb_lB_button();' ) );
	}
	if (isset($this->GBLikeButton['Functions']['Editor']['EditorWidget']) && $this->GBLikeButton['Functions']['Editor']['EditorWidget'] == 1) {
		include_once(dirname(__FILE__) . '/include/fb_post.php');
		$GBLikeButton_EditorWidget = new GBLikeButton_EditorWidget($this->pagelevel);
		$GBLikeButton_EditorWidgetMeta = new GBLikeButton_EditorWidgetMeta($this->pagelevel);
	}
	if (isset($this->GBLikeButton['Functions']['Editor']['QuickEdit']) && $this->GBLikeButton['Functions']['Editor']['QuickEdit'] == 1) {	
		include_once(dirname(__FILE__) . '/include/fb_quickedit.php');
		$this -> GBLikeButtonQuickEdit = new GBLikeButtonQuickEdit();
	}
	if (isset($this->GBLikeButton['Functions']['Additional']['FrontendMenu']) && $this->GBLikeButton['Functions']['Additional']['FrontendMenu'] == 1) {
		include_once(dirname(__FILE__) . '/include/fb_menu.php');
		$this -> GBLikeButtonAdminBar = new GBLikeButtonAdminBar($this->pagelevel);
	}
	if (isset($this->GBLikeButton['Functions']['Additional']['Dashboard']) && $this->GBLikeButton['Functions']['Additional']['Dashboard'] == 1) {
		include_once(dirname(__FILE__) . '/include/fb_dashboard.php');	
		$this -> GBLikeButtonDashboard = new GBLikeButtonDashboard();
	}
	
	## Includes some main Plugin-Functions ##
	include_once('include/fb_inc.php');
	include_once('include/fb_guider.php');
											## END INCLUDE ##
########################################################################################################
									      ## BEGIN SETTING-PAGE  ##

	$this -> GBLikeButton_AdminPages();

											## END SETTING-PAGE  ##
########################################################################################################
											## BEGIN ACTION ##
	
	// initialize the Warning-System -- currently out of work sine 4.4.3 - bug testing is open
	#add_action('admin_notices', array(&$this,'gxtb_fb_lB_warningsys'));
	#add_action('admin_head', array(&$this, 'gxtb_fb_lB_warningsysheader'));
	
	if ( isset($_GET['page']) && strstr($_GET['page'],"fb-like") ) {		
		add_filter('admin_footer_text', array(&$this,'GBLikeButton_AdminFooterText'));
	}
	
	add_filter( 'wp_feed_cache_transient_lifetime', array(&$this,'GBLikeButton_FeedController') );
	add_action('admin_notices', array(&$this,'GBLikeButton_PluginInfoMessage'));
		
	// Guider in the Backend	
	#if(is_admin() && () {
	if(is_admin() && ( strstr($_SERVER["REQUEST_URI"],"edit.php") || ( isset($_GET['fbguide']) && $_GET['fbguide'] )) ) {
		wp_enqueue_style('gb-jquery-guider');
		wp_enqueue_script('jquery');
		wp_enqueue_script('gb-jquery-guider');
		add_action( 'admin_footer', 'GBLikeButton_Guider' );			
	}	
	
	// generates the header before the site is loaded
	#add_action('wp_head', array( $this, 'GBLikeButton_MetaOutput' )); # --> NEEDED IF OB_START IS USED
	
											## END ACTION ##
########################################################################################################
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      INTERNATIONALIZE		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
 function GBLikeButton_AdminFooterText () {
    echo '<span style="padding-left:10px">&copy; 2011 - all rights reserved <a href="http://natterstefan.at/" target="_blank" rel="nofollow">Stefan Natter</a> | '.GBLikeButton_Name.' [v'.GBLikeButton_Version.']</span>';
  }
function GBLikeButton_LoadTextdomain() {
	// Place it in this plugin's "lang" folder and name it "gb_like_button-[value in wp-config].mo"
	load_plugin_textdomain( 'gb_like_button', FALSE, plugin_basename( dirname(__FILE__) ).'/languages' );
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      OPTION PAGE			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function GBLikeButton_AdminPages() {

	if ( isset($_GET['page']) && strstr($_GET['page'],"fb-like") ) {			
		add_action('admin_enqueue_scripts', array( $this, 'GBWorldHeaderScripts' ));
	}
	
	$this -> GBLikeButton_LoadTextdomain();
	require_once(dirname(__FILE__) . '/admin/admin_page.php');
	require_once(dirname(__FILE__) . "/gbworld/gb_newsbox.php");
	require_once(dirname(__FILE__) . "/gbworld/gb_paypal.php");
	$gxtb_fb_lB_spClass = new gxtb_fb_lB_spClass($this->pagelevel);
	
}

function GBWorldHeaderScripts() {

if(isset($_GET['page']) && strstr($_GET['page'],"fb-like")) {

		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('gb-jquery-preview');
		wp_enqueue_script('gb-jquery-thumbs');
		wp_enqueue_script('gb-jquery-mousewheel');
		wp_enqueue_script('gb-jquery-fancybox');
		wp_enqueue_script('gb-jquery-formly');
		
		wp_enqueue_script('gb-generator');
		wp_enqueue_script('gb-js');
		wp_enqueue_script('gb-js-php');
		
		wp_enqueue_style('gb-jquery-ui');
		wp_enqueue_style('gb-jquery-fancybox');
		
		wp_enqueue_style('gb-tooltips');
		wp_enqueue_style('gb-formly');
		wp_enqueue_style('gb-admin');	
	
		if($_GET['page'] == "fb-like-faq") {
			wp_enqueue_style('gb-faq-syntaxcore');
			wp_enqueue_style('gb-faq-syntax');
			wp_enqueue_script('gb-faq-syntaxcore');
			#wp_enqueue_script('gb-faq-syntaxloader');
			wp_enqueue_script('gb-faq-syntaxphp');
			#wp_enqueue_script('gb-faq-syntaxcss');
			#wp_enqueue_script('gb-faq-syntaxjscript');
		}
		
		if($_GET['page'] == "fb-like-button" || $_GET['page'] == "fb-like-settings") {	
			wp_enqueue_style('gb-jquery-guider');
			wp_enqueue_script('gb-jquery-guider');
			add_action( 'admin_footer', 'GBLikeButton_Guider' );
		}
			
		if($_GET['page'] == "fb-like-opengraph" || $_GET['page'] == "fb-like-button") {	
			wp_enqueue_style('gb-thumbs');
		}

		if(in_array($_GET['page'], array("fb-like-opengraph","fb-like-button","fb-like-expert","fb-like-insights"))) {	
			wp_enqueue_script('gb-jquery-accordion');
		}

		if($_GET['page'] != "fb-like-gbworld") {
			wp_enqueue_style('gb-adminsmart');
		}
				
		if($_GET['page'] == "fb-like-gbworld") {
			wp_enqueue_style('gb-world');
			wp_enqueue_style('sack');
		}
				
		if($_GET['page'] == "fb-like-expert") {
			wp_enqueue_script('gb-expert');
		}
				
		if($_GET['page'] == "fb-like-faq") {
			wp_enqueue_script('gb-socialspeedup');
		}
	
		#if(!strstr(get_bloginfo( 'wpurl'), "localhost")) {
			#wp_enqueue_script('gb-info');
		#}
} // end if
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      PLUGIN PAGE			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
## http://striderweb.com/nerdaphernalia/2008/06/wp-use-action-links/ ##
// Additional Plugin-Buttons
function GBLikeButton_PluginLinks($links, $file) {

	/* donate-link (before) */
	 if ( $file == gxtb_fb_lB_FB_BASENAME ) {
		$links[] =  sprintf( '<a href="admin.php?page=%s">%s</a>', "fb-like-button", __('Settings', gxtb_fb_lB_lang) );
	 }
		
	 if ( $file == gxtb_fb_lB_FB_BASENAME ) {
		$links[] =  sprintf( '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SB94MEM9ATTBG" target="_blank">'. __('Donate', gxtb_fb_lB_lang) . '</a>');
	 }
	 if ( $file == gxtb_fb_lB_FB_BASENAME ) {
		$links[] =  sprintf( '<a href="%s" target="_blank">%s</a>', "http://facebook.com/GBWorldnet", __('Become a Fan', gxtb_fb_lB_lang));
     }

    /* settings-link (after) */
    /* if ( $file == gxtb_fb_lB_FB_BASENAME ) {
	    array_unshift(
            $links,
            sprintf( '<a href="admin.php?page=%s">%s</a>', "fb-like-button", __('Settings', gxtb_fb_lB_lang) )
        );		
    }*/

    return $links;
}
function GBLikeButton_UpdateNotice() {
	$info = __( 'Notice: Changelog-Preview is provided with <a href="http://wordpress.org/extend/plugins/changelogger/" target="_blank">Changelogger</a>', gxtb_fb_lB_lang );
	echo ' (<small><span class="spam">' . strip_tags( $info, '<br><a><b><i><span>' ) . '</span></small>)';
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      META-TAGS-OUTPUT		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
function GBLikeButton_MetaOutput() { # --> NEEDED IF OB_START IS USED
if (isset($this->GBLikeButton['Functions']['General']['OpenGraph']) && $this->GBLikeButton['Functions']['General']['OpenGraph'] == 1) {	
	include_once( 'include/fb_meta.php');
	$gxtb_fb_lB_MetaAction = new gxtb_fb_lB_MetaAction();
}
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    REGISTER THIS PLUGIN	 ###########
###########								 ###########
###########								 ###########
####################################################
#####################   by gb-world.net  ###########
####################################################
function GBLikeButton_Activate(){
	include('include/gb_cleaner.php');
	
	$GBCleaner = new GBCleaner();
	$GBLikeButtonWidgetCleaner = new GBLikeButtonWidgetCleaner();
	
	$GBCleaner->GBCleanerAdd();
	$GBLikeButtonWidgetCleaner->GBWidgetCleaner_Add();

if(GBLikeButton_Log || GBLikeButton_Debug) { _log('[Like-Button-Plugin-For-Wordpress] Plugin Activation - complete'); }
} // end function

function GBLikeButton_PluginInfoMessage() {

	if (is_admin()) {
		global $current_screen; #http://cleverwp.com/current_screen-wordpress-global-variable/
		
		if(GBLikeButton_Debug) {
			print_r($current_screen);
		}
		$this->currentpage = $current_screen->id;
	}
	
if(empty($this->GBLikeButton) || !$this->ActivationCheck() ) {
	if( strstr($_SERVER["REQUEST_URI"],"plugins") ||
		strstr($_SERVER["REQUEST_URI"],"update-core")) {
		echo sprintf( '<br /><br /><div id="message" class="error"><p><b>%s:</b> %s. %s <a href="admin.php?page=fb-like-settings">%s</a> %s.</p></div>', 
		__('Warning', gxtb_fb_lB_lang),
		__('There was an Error while creating/updating the neccessary Options for this Plugin', gxtb_fb_lB_lang), 
		__('Please do the following and run the', gxtb_fb_lB_lang),
		__('GBCleaner', gxtb_fb_lB_lang),
		__('to solve this problem', gxtb_fb_lB_lang)
		);
		
if(GBLikeButton_Log || GBLikeButton_Debug) { _log('[Like-Button-Plugin-For-Wordpress] [--FATAL ERROR--] GBLikeButton-Options are EMPTY - Please run the GBCleaner to fix this bug!'); }
	}
return;
}
	
if($this->GBLikeButton['PluginInfo']['lVersion'] == gxtb_fb_lB_version) { return; } else {
	if( (strstr($_SERVER["REQUEST_URI"],"plugins") ||
		strstr($_SERVER["REQUEST_URI"],"update-core")) && $this->GBLikeButton['PluginSetting']['Message']['Update'] == 2 && isset($_GET['activate'])) {
		echo sprintf( '<br /><br /><div id="message" class="updated"><p><b>%s:</b> %s %s! %s <a href="'. admin_url( 'admin.php?page=fb-like-button&fbguide=true' ) .'" target="_blank">%s</a> %s! %s <a href="http://wordpress.org/extend/plugins/like-button-plugin-for-wordpress/faq/" target="_blank">%s</a> %s <a href="http://wordpress.org/extend/plugins/like-button-plugin-for-wordpress/changelog/" target="_blank">%s</a> %s.</p></div>', 
		__('Information', gxtb_fb_lB_lang), 
		gxtb_fb_lB_name, 
		__('was updated correct', gxtb_fb_lB_lang), 
		__('Take a look at the new', gxtb_fb_lB_lang), 
		__('Quick Installation Site', gxtb_fb_lB_lang), 
		__('and see whats new', gxtb_fb_lB_lang),
		__('You can also read through the', gxtb_fb_lB_lang),
		__('FAQ', gxtb_fb_lB_lang),
		__('and', gxtb_fb_lB_lang),
		__('Changelog', gxtb_fb_lB_lang),
		__('for more information', gxtb_fb_lB_lang)
		);
if(GBLikeButton_Log || GBLikeButton_Debug) { _log('[Like-Button-Plugin-For-Wordpress] [SMART-TEST] OK'); }
	}
} // end if-lVersion
} // end function
function ActivationCheck() {
	if(!isset($this->GBLikeButton['Functions'])) return false;
	
	
	
	return true;
}
function GBLikeButton_Deactivate(){
	$this->GBLikeButton = get_option('GBLikeButton');
	$this->GBLikeButton['PluginInfo']['lVersion'] = gxtb_fb_lB_version;
	update_option('GBLikeButton', $this->GBLikeButton);
	
	if((GBLikeButton_Debug && GBLikeButton_Delete) || GBLikeButton_Delete) {
		delete_option('GBLikeButton');
	}
	
if(GBLikeButton_Log || GBLikeButton_Debug) { _log('[Like-Button-Plugin-For-Wordpress] Plugin Deactivation - complete'); }
}
function GBLikeButton_Uninstall(){
	delete_option('GBLikeButton');
	delete_option('GBLikeButtonWidget');
	
if(GBLikeButton_Log || GBLikeButton_Debug) { _log('[Like-Button-Plugin-For-Wordpress] Plugin Uninstall - complete');	}
}
####################################################
####### since v4.0 #################################
###########								 ###########
###########								 ###########
###########	    	ADMIN-ACTION	     ###########
###########		Messages/WarningSys	 	 ###########
###########								 ###########
####################################################
#####################   by gb-world.net  ###########
####################################################
function gxtb_fb_lB_warningsys() {
	# only Admins can see the GB-Warning-Message
	if(is_admin() && (
		strstr($_SERVER["REQUEST_URI"],"index") ||
		strstr($_SERVER["REQUEST_URI"],"plugin") ||
		strstr($_SERVER["REQUEST_URI"],"tools")  ||
		strstr($_SERVER["REQUEST_URI"],"option") ||
		strstr($_GET['page'],"fb-like")
		)) {
			
		$this -> GBWarningSys -> GBWarningSysOutput();
	}
}
function gxtb_fb_lB_warningsysheader() {
	
	if( ( strstr($_SERVER["REQUEST_URI"],"index") ||
		strstr($_SERVER["REQUEST_URI"],"plugin")  ||
		strstr($_SERVER["REQUEST_URI"],"tools")  ||
		strstr($_SERVER["REQUEST_URI"],"option"))
		&&
		( !strstr($_GET['page'],"fb-like") ) )
		
		wp_enqueue_style('gb-jquery-ui');
}
####################################################
####### since v4.0 #################################
###########								 ###########
###########								 ###########
###########	    	ADMIN-ACTION	     ###########
###########				FEED-Controller	 ###########
###########								 ###########
####################################################
#####################   by gb-world.net  ###########
####################################################
## inspired by this article: http://wpengineer.com/feed-cache-in-wordpress/ (Englisch ##
## http://bueltge.de/feed-cache-von-wordpress/1039/ (German) ##
## http://simplepie.org/wiki/reference/start#simplepie_item ##
function GBLikeButton_FeedController() {
if ( isset($_GET['page']) && strstr($_GET['page'],"fb-like") ) { return 0; } else { return 43200; }
	#vorher: #_REQUEST
	#return 1800; ## 15 min
	#return 600; ## 5 min
}
} // end class
} // end if-class

	include_once( 'admin/gb_message.php' );
	if(class_exists('GBMessage')) {	
		global $GBMessage;
		if (empty($GBMessage)) {
			$GBMessage = new GBMessage();
		}
	}
	
	// Let's start the plugin by gb-world.net
	if(class_exists('GBLikeButton')) {
	global $GBLikeButton;
	$GBLikeButton = new GBLikeButton();
	}
	
/*## Debugging-Method ##
if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
} */	
?>