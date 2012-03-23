<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - Development-Sidebar [v1.0}
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    INCOMPATIBLE PLUGINS	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('GBLikeButton_Development')) {
class GBLikeButton_Development {
## Konstruktor
function GBLikeButton_Development() {
?>
<div class="gb-development">
    <div id="gb-development-title"><span id="gb-development-titlespan"></span><?php #_e('Development News', gxtb_fb_lB_lang); ?></div>
    <div id="gb-development-content">
        <div class="loader-bar"><center>
      		 <img src="<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/ajax-loader.gif?v=1"; ?>"/>
        </center></div>
<?php #_e('Currently there are no new Development-News available for this Plugin.', gxtb_fb_lB_lang); ?></div>
    <div id="gb-development-list">
    </div>
</div>
<?php
} // end konstruktor
} // end class
} // end if-class
?>