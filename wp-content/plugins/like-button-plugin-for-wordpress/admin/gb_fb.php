<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.4.1]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       GB-World-Facebook	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('gxtb_fb_lB_FB')) {
class gxtb_fb_lB_FB {

## Konstruktor
function gxtb_fb_lB_FB() {
?>
<div class="gb_fbloading"><br /><center>
    <div class="loader-bar">
    	<img src="<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/ajax-loader.gif?v=1"; ?>"/>
   </div>
</center></div>
<table><tr><td align="center" valign="middle">
<div class="gb_facebook gb_follow" style="display:none"></div>
</td></tr>
<tr><td align="center" valign="middle">
<script type="text/javascript">
      (function(){
        var twitterWidgets = document.createElement('script');
        twitterWidgets.type = 'text/javascript';
        twitterWidgets.async = true;
        twitterWidgets.src = 'http://platform.twitter.com/widgets.js';
        document.getElementsByTagName('head')[0].appendChild(twitterWidgets);
      })();
    </script>
<div style="padding-left:15px;display:none" class="gb_follow"><a href="http://twitter.com/GBWorldnet" class="twitter-follow-button">Follow @GBWorldnet</a></div>
</td></tr>
</table>
<script type="text/javascript">
var GBLikeButton=jQuery.noConflict();
GBLikeButton(window).load(function() {
	GBLikeButton('div.gb_facebook').html('<iframe src="http://www.facebook.com/plugins/likebox.php?id=119752364716058&amp;width=292&amp;connections=0&amp;stream=false&amp;header=false&amp;height=62&amp;ref=likebuttonplugin-settings" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true"></iframe>');
	GBLikeButton('div.gb_fbloading').fadeOut(1000);
	GBLikeButton('div.gb_follow').delay(1000).show(1000);
});
</script>
<?php
} // end konstruktor
} // end class
} // end if-class
?>