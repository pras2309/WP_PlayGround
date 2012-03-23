<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3.3] - GB-Admin-Footer [v0.1] - OUTPUT der MESSAGE OFFEN
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       GB-World-Footer  	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
?>
<p><a title="Jump to the top" href="#header"><img id="toparrow" src="<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/jump_top.GIF"; ?>" alt=""/></a></p>
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
<?php if(!strstr(get_bloginfo( 'wpurl'), "localhost")) { ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11334432-8']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script><?php /*
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-11334432-8";
urchinTracker();
</script>
*/ } ?>
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