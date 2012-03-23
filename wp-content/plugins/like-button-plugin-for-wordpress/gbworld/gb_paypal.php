<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	GB-World-PayPalBox [v1.6]
+	by Stefan Natter (http://www.gb-world.net)
+   required for GB-World-WP-Plugins
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	     PayPal-CLASS			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
if(!class_exists('gxtb_NewsPClass')) {
class gxtb_NewsPClass {
function gxtb_NewsPClass() {
?>

<!-- ######################################################################################################## -->
<!-- 										## GB-Newsbox 3.0  ##											  -->

	                <p><?php if ( isset($_GET['page']) && !$_GET['page'] == "fb-like-gbworld" ) { ?> '<?php echo gxtb_fb_lB_name; ?>' <?php _e('was', gxtb_fb_lB_lang) ?> <?php } else { _e("The GB-World-Plugins were", gxtb_fb_lB_lang); } ?> 
					<?php _e('created by', gxtb_fb_lB_lang) ?> <a class="fancylink_iframe" href="http://natterstefan.at/projects/like-button-plugin-for-wordpress" target="_blank">Stefan Natter</a>. 
           			<?php _e('The development of this plugin(s) took a lot of time and effort, so please don&rsquo;t forget to donate if you found this plugin(s) useful.', gxtb_fb_lB_lang) ?></p>
                    
                    <p><?php _e('There are also other ways of supporting this plugin(s) to ensure it is maintained and well supported in the future!', gxtb_fb_lB_lang) ?>
                    <?php _e('Rating the plugin(s) on wordpress.org (if you like it), linking/spreading the word, and submitting code contributions will all help.', gxtb_fb_lB_lang) ?> </p>
                    
					<a id="paypalpic" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SB94MEM9ATTBG" target="_blank"><img src="<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/btn_donate_LG.gif"; ?>"/></a>
<span style="float:right;"><a class="FlattrButton" style="display:none;" rev="flattr;button:compact;" href="http://www.gb-world.net/projects/wordpress/like-button-plugin-for-wordpress/"></a>
<noscript><a href="http://flattr.com/thing/355412/Like-Button-Plugin-For-Wordpress" target="_blank">
<img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a></noscript></span>

<?php
# https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif
	}
} // end class
} // end if-class
?>