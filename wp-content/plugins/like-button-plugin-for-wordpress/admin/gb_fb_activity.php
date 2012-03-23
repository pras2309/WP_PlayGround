<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       LIKE-ACTIVITY		 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('gxtb_fb_lB_FBActivity')) {
class gxtb_fb_lB_FBActivity {
## Konstruktor
function gxtb_fb_lB_FBActivity() {
?><table width="100%"><tr><td align="center">
<span class="gb_fb_activity"> 
	<div class="loader-bar">
      	<img src="<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/ajax-loader.gif?v=1"; ?>"/>
    </div>
</span>
</td></tr>
</table>
<script type="text/javascript">
var GBLikeButton=jQuery.noConflict();
GBLikeButton(document).ready(function(){
	GBLikeButton('.gb_fb_activity').html('<iframe id="fb_activity" src="http://www.facebook.com/plugins/activity.php?site=<?php echo $_SERVER['HTTP_HOST']; ?>&amp;width=250&amp;height=300&amp;header=true&amp;colorscheme=light&amp;recommendations=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:300px;" allowTransparency="true"></iframe>');
});
</script>
<?php
} // end konstruktor
} // end class
} // end if-class
?>