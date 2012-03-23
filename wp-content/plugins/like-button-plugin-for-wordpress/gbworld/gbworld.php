<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	GB-World-Submenupage [v2.0] - Official GB-World.net WP-Plugin Page
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       GB-World				 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('gbworld')) {
class gbworld {

var $gxtb_FRClass;
var $pagehook;

function gbworld($pagehook) {

	$this->pagehook = $pagehook;
	
	global $screen_layout_columns;
	$screen_layout_columns = 2;

	add_action('admin_menu', array(&$this, 'on_admin_menu'));

  	add_meta_box('gxtb_world_like_box', 'GB-World on Facebook', array(&$this, 'gxtb_initialize_fb_box'), $this->pagehook, 'like', 'core');
  	add_meta_box('gxtb_world_feed_news', 'GB-World-Development-News', array(&$this, 'gxtb_initialize_feed_news'), $this->pagehook, 'feed_news', 'core');
  	add_meta_box('gxtb_world_feed_wp', 'GB-World.net', array(&$this, 'gxtb_initialize_feed_wp'), $this->pagehook, 'feed_wp', 'core');	
  	add_meta_box('gxtb_world_plugin_box', 'installed GB-World-Plugins', array(&$this, 'gxtb_initialize_plugins'), $this->pagehook, 'plugins', 'core');
	add_meta_box('gxtb_world_paypalbox', 'Please support GB-World.net', array(&$this, 'gxtb_initialize_infobox'), $this->pagehook, 'paypal', 'core');
	#add_meta_box('gxtb_world_newsbox', 'GB-News', array(&$this, 'gxtb_initialize_newsbox'), $this->pagehook, 'additional', 'core');

	include( dirname(dirname(__FILE__)) . '/gbworld/gb_feedreader.php');
	$this->gxtb_FRClass = new gxtb_FRClass();
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<div id="poststuff" class="formlyWrapper-Base metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
		<div id="poststuff" class="metabox-holder" style="width: 100%;">
				<!-- Sidebar -->
				<div id="side-info-column" class="inner-sidebar">
					<?php
					    do_meta_boxes($this->pagehook, 'feed_news', "");
						do_meta_boxes($this->pagehook, 'feed_wp', "");
						do_meta_boxes($this->pagehook, 'plugins', "");
						do_meta_boxes($this->pagehook, 'paypal', "");
					?>
				</div>
				<!-- /Sidebar -->
				<!-- Content -->
					<div id="post-body" class="has-sidebar" style="background-color:#eeeeee;">
						<div id="post-body-content" class="has-sidebar-content"><center>
							<?php
                            echo "<table class='gb_world' style='border-spacing:5px;'><tr><td style='border-spacing:5px;' class='gb_worldfirsttd'>";
							do_meta_boxes($this->pagehook, 'like', "");
							#echo "</td><td class='gb_worldsecondtd'>";
							#do_meta_boxes($this->pagehook, 'additional', "");
							echo "<br>"; ?>
							<a href="http://www.gb-world.net" target="_blank"><img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/gbworld/images/banner.png" class="gb_world"/></a>
							<?php echo "</td></tr></table>";
							?>
						</center></div>
					</div>
				<!-- /Content -->
				<br class="clear"/>
		</div>
<div class="plugin-version">
	<a href="#plugininfo" class="fancylink" title="Created by Stefan N."><?php echo gxtb_fb_lB_name; ?> - v<?php echo gxtb_fb_lB_version; ?></a>
</div>
<br />
</div>
</div>
</div>
<div style="display: none;">
<div id="plugininfo">
	<div id="plugininfotitle"><h2><?php _e('Plugin-Information', gxtb_fb_lB_lang) ?></h2></div>
	<div id="plugininfocontent"><p><?php echo sprintf( '%s <b>%s.</b> (<a href="#">%s</a>)', __('This Plugin was created by', gxtb_fb_lB_lang),  __(' Stefan N', gxtb_fb_lB_lang), __('GB-World.net', gxtb_fb_lB_lang)); ?></p>
		<p><?php _e('I use a lot of different (jQuery-)Plugins to make this page as easy as it could be for you. For example i use jQuery to make the Option-Page even smaller and better.', gxtb_fb_lB_lang);
		echo " ";
		echo sprintf( '%s <a href="#">%s</a>. %s <a href="#">%s</a> %s.', __('I hope you like my plugin and you', gxtb_fb_lB_lang), __('report any bugs', gxtb_fb_lB_lang), __('I have invested a lot of time to get this plugin as good as it is now. I would appreciate it if you would ', gxtb_fb_lB_lang), __('support', gxtb_fb_lB_lang), __('my work', gxtb_fb_lB_lang)); ?>
		<br /><br />
		<p><em><?php _e('Notice', gxtb_fb_lB_lang) ?>: <?php _e('Some of my impressions and ideas I got from other sites, plugins and tutorials. They are all listed beside the code snippets I got from their work or tutorials.', gxtb_fb_lB_lang) ?></em></p></div>
</div></div>
<?php $this -> gxtb_infopage_java();
} 
## Facebook-Like-Box
function gxtb_initialize_fb_box() {
	
	if (!class_exists('gxtb_FBGBClass')) {
		// dies ist die Facebook-Like-Box
		include( dirname(dirname(__FILE__)) . '/gbworld/gb_fb_box.php' ); 
		$gxtb_FBClass = new gxtb_FBClass();
	}
	
}
## PayPal-Box
function gxtb_initialize_infobox() {
	
	// initialize the newsbox now in the main-plugin-file (since v3.0)
	#require_once(dirname(__FILE__) .'/gb_paypal.php');
	
	$this -> gxtb_infoPageClassArray['Infopage'] = 1;
	$gxtb_NewsPClass = new gxtb_NewsPClass($this -> gxtb_infoPageClassArray);
	
}
## News-Box
function gxtb_initialize_newsbox() {

		$gxtb_NewsClass = new gxtb_NewsClass();
}
## Feed-Reader
function gxtb_initialize_feed_news() {
	// dies ist die Feed-Reader-Klasse - Teil I
	$this->gxtb_FRClass->gxtb_reader(0);
}

function gxtb_initialize_feed_wp() {
	// dies ist die Feed-Reader-Klasse - Teil II
	$this->gxtb_FRClass-> gxtb_reader(1);
}

## Installed Plugins
function gxtb_initialize_plugins() {

// Variable die die Page-Identity ausgibt
$GBWorldPlugins = array(
	"Like-Button-Plugin-For-Wordpress" => "http://www.gb-world.net/projects/like-button-plugin-for-wordpress/",
	"Jump-Page" => "options-general.php?page=jump-page-settings",
	"iPhone-WebApp-Redirection" => "options-general.php?page=webapp_gb"
	);

$plugin = "like-button-plugin-for-wordpress/gb_fb-like-button.php";
if( is_plugin_active($plugin) ) {
	$GBActivatePlugin[gxtb_fb_lB_name] = gxtb_fb_lB_version;
}

if(!empty($GBActivatePlugin)) {

  echo "<ul class='gb_world_plugins' id='gb_world_plugins'>";
	foreach($GBActivatePlugin as $key => $value) {
	
		if (!empty($GBActivatePlugin[$key]) ) {
			
			echo "<li>";
			echo "<a href='";
			echo $GBWorldPlugins[$key];
			echo "'>";
			echo $key . " - ";
			echo "[v" . $GBActivatePlugin[$key] . "]</a>";
			echo "</li>";
			
		}
	}
  echo "</ul>";
  
} else {

  echo "<ul class='gb_world_plugins' id='gb_world_plugins'>";
		echo "<li>";
		_e('You have no GB-World-Plugins installed yet', 'gb_like_button');
		echo ".";
 		echo "</li>"; 
  echo "</ul>";
}

}
function gxtb_infopage_java() {
?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-11334432-8";
urchinTracker();
</script>
	<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready( function($) {
			// close postboxes that should be closed
			$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
		<?php
		global $wp_version;
		if(version_compare($wp_version,"2.7-alpha", "<")){
			echo "add_postbox_toggles('" . $this->pagehook . "');"; //For WP2.6 and below
		}
		else{
			echo "postboxes.add_postbox_toggles('" . $this->pagehook . "');"; //For WP2.7 and above
		}
		?>
	
			});
			//]]>
	</script>
<script type="text/javascript">var _cmo = {form: '4dd4016332e0850001003f20', text: 'Contact', align: 'right', valign: 'bottom', lang: 'en', background_color: '#003C68'}; (function() {var cms = document.createElement('script'); cms.type = 'text/javascript'; cms.async = true; cms.src = ('https:' == document.location.protocol ? 'https://d1uwd25yvxu96k.cloudfront.net' : 'http://static.contactme.com') + '/widgets/tab/v1/tab.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(cms, s);})();</script>
<?php
}
} // end class
} // end if-class
?>