<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.4] - GB-QuickEdit [v1.0 FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 3.1+ or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      Social-Button			 ###########
###########				Quick Edit		 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
# inspired by: http://shibashake.com/wordpress-theme/expand-the-wordpress-quick-edit-menu #
if (!class_exists('GBLikeButtonQuickEdit')) {
class GBLikeButtonQuickEdit {	
function GBLikeButtonQuickEdit() {
										
	global $wp_version;
	
	if(version_compare( $wp_version, '3.0', '>=' )/* && !strstr(get_bloginfo( 'wpurl'), "localhost")*/) {
		add_filter('manage_post_posts_columns', array( $this, 'GBLikeButtonQuickEdit_Add'),10,1);
		add_filter('manage_pages_columns', array( $this, 'GBLikeButtonQuickEdit_Add'),10,1);
		add_action('manage_posts_custom_column', array( $this, 'GBLikeButtonQuickEdit_Render'), 10, 2);
		add_action('manage_pages_custom_column', array( $this, 'GBLikeButtonQuickEdit_Render'), 10, 2);
		add_action('quick_edit_custom_box', array( $this, 'GBLikeButtonQuickEdit_AddQuickEdit'), 10, 3);
		if(gxtb_fb_lB_debug) { add_action('admin_notices', array( $this, 'GBLikeButtonQuickEdit_SaveQuickEdit_Debug')); }
		add_action('save_post', array( $this, 'GBLikeButtonQuickEdit_SaveQuickEdit'));
		if( strstr($_SERVER["REQUEST_URI"],"edit.php") ) {
			add_action('admin_head', array(&$this, 'GBLikeButtonQuickEdit_Header'));
			add_action('admin_footer', array( $this, 'GBLikeButtonQuickEdit_Footer'));
		}
		add_filter('post_row_actions', array( $this, 'GBLikeButtonQuickEdit_PostRow'), 10, 2);
		add_filter('page_row_actions', array( $this, 'GBLikeButtonQuickEdit_PostRow'), 10, 2);
	
		/* Additional Scripts/Styles */
		#wp_register_script('gb-twitter', 'http://platform.twitter.com/widgets.js', false, '1.0');
		#wp_register_script('gb-g1', 'http://apis.google.com/js/plusone.js', false, '1.0');
		#wp_enqueue_script('gb-twitter');
		#wp_enqueue_script('gb-g1');
	}
}
  
function GBLikeButtonQuickEdit_PostRow($actions, $post) {
	global $current_screen, $wp_version;	
	if (($current_screen->id == 'edit-post') || ($current_screen->post_type == 'post' )) $return = true;
	if (($current_screen->id == 'edit-page') || ($current_screen->post_type == 'page' )) $return = true;
	if (!$return) return; 
 
 	$post_id = $post->ID;
 
	$nonce = wp_create_nonce( 'gblikequick_'.$post_id);
	$fbpic = htmlspecialchars(get_post_meta( $post_id, '_fbpic', TRUE));
	$fbnone = get_post_meta($post_id, '_fbnone', true); ## Wenn == 1 dann keinen Like-Button-Output
	$fbnometa = get_post_meta($post_id, '_fbnometa', true); ## Wenn == 1 dann kein Meta-Output
	$fbnodefault = get_post_meta($post_id, '_fbnodefault', true); ## Wenn == 1 dann kein Default-Image-Tag
	$fbnotemplate = get_post_meta($post_id, '_fbnotemplate', true); ## Wenn == 1 dann kein Template-Button
	$fbfeatured = NULL;
	
	if (version_compare( $wp_version, '2.9', '>=' )) {
		if (current_theme_supports('post-thumbnails')) {	
			$fbfeatured = get_post_meta($post_id, '_fbfeatured', true);
			$fbfeatured = ($fbfeatured != 1) ? 0:1;
	}}
	
	$fbnone = ($fbnone != 1) ? 0:1;
	$fbnometa = ($fbnometa != 1) ? 0:1;
			
	$actions['inline hide-if-no-js'] = '<a href="#" class="editinline" title="';
	$actions['inline hide-if-no-js'] .= esc_attr( __( 'Edit this item inline' ) ) . '" ';
	$actions['inline hide-if-no-js'] .= " onclick=\"set_inline_widget_set('{$fbpic}', '{$fbfeatured}', '{$fbnone}', '{$fbnometa}', '{$fbnodefault}', '{$fbnotemplate}', '{$nonce}')\">"; 
	$actions['inline hide-if-no-js'] .= __( 'Quick&nbsp;Edit' );
	$actions['inline hide-if-no-js'] .= '</a>';
	
	return $actions;	
}

function GBLikeButtonQuickEdit_Header() {
?>
	<script type="text/javascript">
	var GBLikeButton=jQuery.noConflict();
	
	GBLikeButton(document).ready(function(){ 
		gb_load_quick();
	});
	
	function gb_load_quick() {
		
		(function(){var s=document.createElement('SCRIPT'),s1=document.getElementsByTagName('SCRIPT')[0];s.type='text/javascript';s.async=true;s.src='http://widgets.digg.com/buttons.js';s1.parentNode.insertBefore(s,s1)})();
		
		GBLikeButton.ajax({url: 'http://platform.twitter.com/widgets.js', dataType: 'script', cache:true});
		GBLikeButton.ajax({url: 'http://apis.google.com/js/plusone.js', dataType: 'script', cache:true});
		
		GBLikeButton("span.facelike").each(function() {
		 	var url = GBLikeButton(this).attr("src");
		 	var style = GBLikeButton(this).attr("style");
 			GBLikeButton(this).replaceWith('<iframe src=' + url + ' style="' + style + '"/>');
 		});	
			
		GBLikeButton("span.stumbleupon").each(function() {
		 	var url = GBLikeButton(this).attr("src");
 			GBLikeButton(this).replaceWith('<iframe src=\"http:\/\/www.stumbleupon.com\/badge\/embed\/1\/?url=\ ' + url + '" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:74px; height: 18px;\" allowTransparency=\"true\"><\/iframe>');
 		});	
	}
	</script>
	<?php
}
function GBLikeButtonQuickEdit_Footer() {
	global $current_screen;
	
	if (($current_screen->id == 'edit-post') || ($current_screen->post_type == 'post' )) $return = true;
	if (($current_screen->id == 'edit-page') || ($current_screen->post_type == 'page' )) $return = true;
	if (!$return) return; 
 
	?>
	<script type="text/javascript">
	<!--
	function set_inline_widget_set(fbpic, fbfeatured, fbnone, fbnometa, fbnodefault, fbnotemplate, nonce) {
		// revert Quick Edit menu so that it refreshes properly
		inlineEditPost.revert();
		
		var widgetInput = document.getElementById('GBLikeButton_post_image');
		var nonceInput = document.getElementById('fb_like_hidden');
		
		nonceInput.value = nonce;
		
		GBLikeButton('input[name=GBLikeButton_post_image]').val(fbpic);
		
		if(fbfeatured == 1) {
			GBLikeButton('input[name=GBLikeButton_fbfeatured]').attr('checked','checked');
		} else if (fbfeatured != null) {
			GBLikeButton('input[name=GBLikeButton_fbfeatured]').removeAttr('checked','checked');
		}
		if(fbnone == 1) {
			GBLikeButton('input[name=GBLikeButton_fbnone]').attr('checked','checked');
		} else {
			GBLikeButton('input[name=GBLikeButton_fbnone]').removeAttr('checked','checked');
		}
		if(fbnometa == 1) {
			GBLikeButton('input[name=GBLikeButton_fbnometa]').attr('checked','checked');
		} else {
			GBLikeButton('input[name=GBLikeButton_fbnometa]').removeAttr('checked','checked');
		}	
		if(fbnodefault == 1) {
			GBLikeButton('input[name=GBLikeButton_fbnodefault]').attr('checked','checked');
		} else {
			GBLikeButton('input[name=GBLikeButton_fbnodefault]').removeAttr('checked','checked');
		}	
		if(fbnotemplate == 1) {
			GBLikeButton('input[name=GBLikeButton_fbnotemplate]').attr('checked','checked');
		} else {
			GBLikeButton('input[name=GBLikeButton_fbnotemplate]').removeAttr('checked','checked');
		}		
	}
	//-->
	</script>
	<?php
}

final function GBLikeButtonQuickEdit_Add($columns) {
	$page = "";
	if(!strstr($_SERVER["REQUEST_URI"], "post_type") && !isset($_GET['fbguide'])) { $page = "?"; } 
	else if(isset($_GET['fbguide']) && !$_GET['fbguide']) { $page = "&";}
	else { $page = "&"; }
	
	if(!isset($_GET['fbguide'])) $guide = "fbguide=true"; else $guide = "";
	$page = $_SERVER["REQUEST_URI"].$page.$guide;
	$pic = plugins_url() ."/like-button-plugin-for-wordpress/images/help.png?v=1";
	$columns['fb_social'] = 'Social Button Analysis <span style="position:relative;"><a href="'.$page.'"><img width="16px" height="16px" src="'.$pic.'"/></a></span>';
	return $columns;
}
final function GBLikeButtonQuickEdit_Render($column_name, $id) {

	if (defined('DOING_AJAX') && DOING_AJAX ) {
		?><script type="text/javascript">location.reload();/*gb_load_quick();*/</script>
		<?php
	}	
	
	switch ($column_name) {
		
	case 'fb_social':
	
		$GBQuick= NULL;
		
			#$GBQuick= get_post($widget_id);
			#$GBQuick= get_post_meta( $id, '_fbpic', TRUE);
			$GBQuick.= '<span class="facelike" src="http://www.facebook.com/plugins/like.php?href='. urlencode(get_permalink( $id )) . '&amp;send=false&amp;layout=button_count&amp;width=75&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;height=20&amp;locale=en_US" style="border:none; overflow:hidden; width:75px; height:20px;"></span>';

			$GBQuick.= '<a href="http://twitter.com/share" class="twitter-share-button" data-url="' . urlencode(get_permalink( $id )) .'" data-count="horizontal" style="display:none;">Tweet</a> ';

			$GBQuick.= "<a class='DiggThisButton DiggCompact' href='http://digg.com/submit?url=" . urlencode(get_permalink( $id )) ."'></a> ";

$GBQuick.= '<span style="margin:0 10px 0 0;" class="stumbleupon" src="' . urlencode(get_permalink( $id )) .'"></span> ';

$GBQuick.= '<g:plusone size="medium" href="' . urlencode(get_permalink( $id )) .'"></g:plusone>';

		/* #$GBQuick.= $this->GBLikeButtonGenerateClass->GBLikeButtonGenerate(array('url'=>get_permalink( $id ), 'expert' => array('besidebutton' => true)));
		<script src="http://www.stumbleupon.com/hostedbadge.php?s=1&r=' . urlencode(get_permalink( $id )) .'"></script> */
		#scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:20px;" allowTransparency="true"
		
		if ($GBQuick!= "") {
			echo $GBQuick;
		} else 
		echo 'None';
						
		break;
	}
}
final function GBLikeButtonQuickEdit_AddQuickEdit($column_name, $post_type) {
	if ($column_name != 'fb_social') return;
	
    global $post, $wp_version;
    $post_id = $post;
    
    if (is_object($post_id)) 
    	$post_id = $post_id->ID;
    
    $fbpic = get_post_meta($post_id, '_fbpic', true); ## Wenn != "" dann benutzen
	$fbnone = get_post_meta($post_id, '_fbnone', true); ## Wenn == 1 dann keinen Like-Button-Output
	$fbnometa = get_post_meta($post_id, '_fbnometa', true); ## Wenn == 1 dann kein Meta-Output
	$fbnodefault = get_post_meta($post_id, '_fbnodefault', true); ## Wenn == 1 dann kein Default-Image-Tag
	$fbnotemplate = get_post_meta($post_id, '_fbnotemplate', true); ## Wenn == 1 dann kein Template-Button
		
	?>
    <fieldset class="inline-edit-col-right">
	<div class="inline-edit-col">
		<span class="title"><?php _e( 'Like-Button-Settings', gxtb_fb_lB_lang ); ?></span><br />
        <input type="hidden" name="fb_like_hidden" id="fb_like_hidden" value="" />
		<?php
if (version_compare( $wp_version, '2.9', '>=' )) {
	if (current_theme_supports('post-thumbnails')) {	
	$fbfeatured = get_post_meta($post_id, '_fbfeatured', true);
?>
    	<input name="GBLikeButton_fbfeatured" type="checkbox" class="checkbox" <?php if ($fbfeatured) echo("checked"); ?> value="1" />&nbsp; <?php _e("Use the Featured Image for the Image-Tag.", gxtb_fb_lB_lang ) ?>
        <br />
<?php } } ?>
        <input name="GBLikeButton_fbnone" type="checkbox" class="checkbox" <?php if ($fbnone) echo("checked"); ?>  value="1" />&nbsp; <?php  echo sprintf("<b>%s</b> %s", __("Disable", gxtb_fb_lB_lang ), __("Like-Button for this post/page.", gxtb_fb_lB_lang )); ?>
        <br />
        <input name="GBLikeButton_fbnometa" type="checkbox" class="checkbox" <?php if ($fbnometa) echo("checked"); ?>  value="1" />&nbsp; <?php  echo sprintf("<b>%s</b> %s", __("Disable", gxtb_fb_lB_lang ), __("the Meta-Tags on this page/post.", gxtb_fb_lB_lang )); ?>
        <br />
        <input name="GBLikeButton_fbnodefault" type="checkbox" class="checkbox" <?php if ($fbnodefault) echo("checked"); ?>  value="1" />&nbsp; <?php  echo sprintf("<b>%s</b> %s", __("Disable", gxtb_fb_lB_lang ), __("the Default-Image on this page/post.", gxtb_fb_lB_lang )); ?>
        <br />
        <input name="GBLikeButton_fbnotemplate" type="checkbox" class="checkbox" <?php if ($fbnotemplate) echo("checked"); ?>  value="1" />&nbsp; <?php  echo sprintf("<b>%s</b> %s", __("Disable", gxtb_fb_lB_lang ), __("the Template-Function on this page/post.", gxtb_fb_lB_lang )); ?>
        <br />
        <input type="text" name="GBLikeButton_post_image" value="<?php echo $fbpic; ?>" size="25" />
	</div>
    </fieldset>
	<?php
}
function GBLikeButtonQuickEdit_SaveQuickEdit_Debug() {}
function GBLikeButtonQuickEdit_SaveQuickEdit($post_id) {
	
	global $current_screen;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	
	$post = get_post($post_id);
	$nonce = wp_create_nonce( 'gblikequick_'.$post_id);
		
	if( $current_screen->post_type != 'revision' && isset($_POST['fb_like_hidden']) && $_POST['fb_like_hidden'] == $nonce && (current_user_can( 'edit_post', $post_id ) || current_user_can( 'edit_page', $post_id ))) {
		
		$fbpic = (isset($_POST['GBLikeButton_post_image'])) ? esc_attr($_POST['GBLikeButton_post_image']):"";
		$fbnone = (isset($_POST['GBLikeButton_fbnone'])) ? $_POST['GBLikeButton_fbnone']:0;
		$fbnometa = (isset($_POST['GBLikeButton_fbnometa']))  ?$_POST['GBLikeButton_fbnometa']:0;
		$fbfeatured = (isset($_POST['GBLikeButton_fbfeatured'])) ? $_POST['GBLikeButton_fbfeatured']:0;
		$fbnodefault = (isset($_POST['GBLikeButton_fbnodefault'])) ? $_POST['GBLikeButton_fbnodefault']:0;
		$fbnotemplate = (isset($_POST['GBLikeButton_fbnotemplate'])) ? $_POST['GBLikeButton_fbnotemplate']:0;
		
		if (isset($fbpic)) {

			if($fbpic != "" && !preg_match('#^http#', substr($fbpic,0, 4)) ) { 
					
					$http = "http";
					
					if (!preg_match('#^:\/\/#', substr($fbpic,4, 8))) {
						$http .= "://";
					}
					
					$fbpic = $http . $fbpic;
			}
					#delete_post_meta($post_id, '_fbpic');
					update_post_meta($post_id, '_fbpic', $fbpic);
		}
		if ($fbnone || !$fbnone) {
					#delete_post_meta($post_id, '_fbnone');
					update_post_meta($post_id, '_fbnone', $fbnone);
		}
		if ($fbfeatured || !$fbfeatured) {
					#delete_post_meta($post_id, '_fbfeatured');
					update_post_meta($post_id, '_fbfeatured', $fbfeatured);
		}
		if ($fbnometa || !$fbnometa) {
					#delete_post_meta($post_id, '_fbnometa');
					update_post_meta($post_id, '_fbnometa', $fbnometa);
		}
		if ($fbnodefault || !$fbnodefault) {
					#delete_post_meta($post_id, '_fbnodefault');
					update_post_meta($post_id, '_fbnodefault', $fbnodefault);
		}
		if ($fbnotemplate || !$fbnotemplate) {
					#delete_post_meta($post_id, '_fbnotemplate');
					update_post_meta($post_id, '_fbnotemplate', $fbnotemplate);
		}
	}
	return $post_id;	
}
} # end class
} # end if-class