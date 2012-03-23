<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	GB-World-FB-Box [v1.1]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for GB-World-WP-Plugins
+----------------------------------------------------------------+
*/

/* notice: http://www.noupe.com/jquery/the-power-of-wordpress-and-jquery-30-useful-plugins-tutorials.html */

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	     SUPPORT-CLASS			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

if (!class_exists('gxtb_FBClass')) {
class gxtb_FBClass {
function gxtb_FBClass() {
?>
<div class="gxtb_like_box"><iframe id="gxtb_like_box" src="http://www.facebook.com/plugins/likebox.php?id=119752364716058&amp;width=300&amp;connections=10&amp;stream=true&amp;header=false&amp;height=587&amp;ref=likebuttonplugin-gbworld" scrolling="no" frameborder="0" style="border:none; overflow:hidden; allowTransparency="true"></iframe></div>
<?php
}
} // end class
} // end if-class
?>