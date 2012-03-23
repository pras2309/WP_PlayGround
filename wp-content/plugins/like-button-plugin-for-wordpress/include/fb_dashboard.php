<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.4] - GB-Dasboard [v0.6 FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 3.1+ or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      DASHBOARD-WIDGET		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
if (!class_exists('GBLikeButtonDashboard')) {
class GBLikeButtonDashboard {
	
function GBLikeButtonDashboard() {
										
	global $wp_version;
	
	// creates a dashboard-widget which contains the blog-recommendations
	if ( version_compare( $wp_version, '2.7', '>=' ) /* && !strstr(get_bloginfo( 'wpurl'), "localhost") */) {
		include_once( dirname(dirname(__FILE__)) . '/admin/gb_fb_activity.php');
		add_action('wp_dashboard_setup', array( $this, 'gbworld_dashboard_widgets' ) );
	}
}

function GBLikeButtonDashboardHeader() {
	
if (is_admin()) {
		$path = $_SERVER['SCRIPT_NAME']; #http://www.learnphponline.com/php-basics/how-to-find-the-current-url-in-php
		
if (strstr($path, "index.php")) {
wp_print_scripts('jquery');
wp_print_styles('gb-jquery-ui');
?>
<script type="text/javascript">
var GBLikeButton=jQuery.noConflict();
GBLikeButton(document).ready(function(){
	GBLikeButton.getScript("http://js.gb-world.net/wordpress/like-button-plugin-for-wordpress/info.js");
	GBLikeButton.getScript("http://platform.twitter.com/widgets.js");
})
</script>
<?php
		}
	}
}

function gbworld_dashboard_widget_function() {
	// displays the recommendation and activity of current blog 
	global $wp_version; 
	?>
<!-- using <?php echo gxtb_fb_lB_name; ?> [<?php echo gxtb_fb_lB_version; ?>] | by Stefan Natter (http://www.gb-world.net) -->
<div id="gb-info" class="gb-info" style="display:none;"><div class="ui-widget"><div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong><span id="gb-info-title"></span></strong> <span id="gb-info-content"></span></p></div></div></div><br />
<table width="100%" style="overflow:hidden"><tr><td align="center">
<?php
	$gxtb_fb_lB_FBActivity = new gxtb_fb_lB_FBActivity();
?>
<div id="stblpn-w-1311143873814"></div>
<script type="text/javascript">
(function() {
var widget = {
  id: 'stblpn-w-1311143873814', 
  version: '1', 
  layout: '1',
  title: '<?php echo $_SERVER['HTTP_HOST']; ?> on StumbleUpon', 
  request: {sites: ['<?php echo $_SERVER['HTTP_HOST']; ?>']}
};
if (window.SuWidget) { if (typeof SuWidget == 'function') { new SuWidget(widget); } else { SuWidget.push(widget); } } else {var e, e1; SuWidget = [widget]; e = document.createElement('SCRIPT'); e.type = 'text/javascript'; e.async = true; e.src = 'http://cdn.stumble-upon.com/js/widgets.js'; e1 = document.getElementsByTagName('SCRIPT')[0]; e1.parentNode.insertBefore(e, e1); } 
})();
</script>
</td></tr>
<tr><td align="center" valign="top" width="100%">
<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2FGBWorldnet&amp;layout=button_count&amp;show_faces=false&amp;width=125&amp;action=like&amp;colorscheme=light&amp;height=20&amp;ref=wordpress_like_dashboard" scrolling="yes" frameborder="0" allowTransparency="false" style="border:none; overflow:hidden; width:130px; height:20px;"></iframe>
<a href="http://www.youtube.com/user/GBWorldnet" target="_blank"><img src="<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/youtube-button.png"; ?>"/></a>
<a href="https://plus.google.com/110009504014516259287" target="_blank"><img src="<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/googleplus-button.png"; ?>"/></a>
<a href="http://twitter.com/GBWorldnet" class="twitter-follow-button" data-show-count="false" data-width="70px">Follow @GBWorldnet</a>
<script type="text/javascript" src="http://apis.google.com/js/plusone.js">{lang:'en', 'de'}</script>
<g:plusone href="http://gb-world.net/projects/wordpress/like-button-plugin-for-wordpress/" class="g-plusone" size="medium" data-count="true"></g:plusone>
<?php #http://www.google.com/webmasters/+1/button/ ?>
</td></tr></table>
<ul id="twitter_update_list">
    <li>Loading Tweets..</li>
</ul>
<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/GBWorldnet.json?callback=twitterCallback2&count=1"></script>
<style type="text/css">
#twitter_update_list {
/* the main container */
}
#twitter_update_list li{
/* wraps a single list */
list-style-image:url( <?php echo "'" . gxtb_fb_lB_PLUGIN_FOLDER . "images/icon/twitter-bubble.png'"; ?>);
margin: 5px 0 0 25px;
font-style:italic;
}
#twitter_update_list li span {
/* wraps the tweet */
}
#twitter_update_list li a {
/* wraps the link to the tweet */
/* by default it have 85% font-size therefore you might want to change it like below */
}
</style>
<!-- using <?php echo gxtb_fb_lB_name; ?> [<?php echo gxtb_fb_lB_version; ?>] | by Stefan Natter (http://www.gb-world.net) -->
<?php
if( is_admin() && current_user_can('manage_options') ) {
		echo '<hr style="border:2px solid#ddd;border-bottom-color:#f9f9f9;">';
		echo sprintf( '<div style="padding-left:10px;"><a class="button-primary" href="admin.php?page=%s">%s</a></div>', "fb-like-button", __('Plugin', gxtb_fb_lB_lang) . "-" . __('Settings', gxtb_fb_lB_lang) );
	}
} 
function gbworld_dashboard_widgets() {
	$page = "";
	if(!isset($_GET['fbguide'])) { $page = "?"; } else if(!$_GET['fbguide']) { $page = "&";}
	if(!isset($_GET['fbguide'])) $guide = "fbguide=true"; else $guide = "";
	$page = $_SERVER["REQUEST_URI"].$page.$guide;
	$pic = plugins_url() ."/like-button-plugin-for-wordpress/images/help.png?v=1";
	$help = '<span style="position:relative;"><a href="'.$page.'"><img width="16px" height="16px" src="'.$pic.'"/></a></span>';
	
	add_action('admin_enqueue_scripts', array( $this, 'GBLikeButtonDashboardHeader' ));
	wp_add_dashboard_widget('gbworld_dashboard_widget', __('Social Activity', gxtb_fb_lB_lang) .' '. $help, array( $this, 'gbworld_dashboard_widget_function' ));	
		
	// Globalize the metaboxes array, this holds all the widgets for wp-admin
	global $wp_meta_boxes;
	
	// Get the regular dashboard widgets array 
	// (which has our new widget already but at the end)
	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	
	// Backup and delete our new dashbaord widget from the end of the array
	$gbworld_dashboard_widget = array('gbworld_dashboard_widget' => $normal_dashboard['gbworld_dashboard_widget']);
	unset($normal_dashboard['gbworld_dashboard_widget']);

	// Merge the two arrays together so our widget is at the beginning
	$sorted_dashboard = array_merge($gbworld_dashboard_widget, $normal_dashboard);

	// Save the sorted array back into the original metaboxes 
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
} # end class
} # end if-class