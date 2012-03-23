<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.4.1]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       SUBMIT-METHOD		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net ##############
####################################################
?>
<input type="hidden" name="fb_like_hidden" value="<?php global $current_screen; echo wp_create_nonce( 'fb_like_hidden_'.$current_screen->parent_file); ?>" />
<input name="fbsubmit" type="submit" class="button-primary" id="button" value="<?php _e('Save Changes', gxtb_fb_lB_lang) ?>"  style="width:100px;"/>	
</form>