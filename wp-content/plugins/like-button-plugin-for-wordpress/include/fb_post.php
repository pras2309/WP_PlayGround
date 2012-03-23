<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.4] - GB-Post-Option [v1.5.1]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
# FAQ: http://net.tutsplus.com/tutorials/wordpress/creating-custom-fields-for-attachments-in-wordpress/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      CUSTOM-OPTIONS		 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('GBLikeButton_EditorWidget')) {
class GBLikeButton_EditorWidget{
	var $pagelevel;
function GBLikeButton_EditorWidget($pagelevel) {
	
	if ( is_admin() && (strstr($_SERVER['REQUEST_URI'], "post.php") || strstr($_SERVER['REQUEST_URI'], "post-new.php")) ) {

	  if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] [--BEGIN--] EDITOR-WIDGET'); }
		
		wp_enqueue_script('gb-generator');
		wp_enqueue_style('gb-tooltips');
		
		$this->pagelevel = $pagelevel;
		
		add_action('save_post', array( $this, 'gxtb_fb_lB_save_postdata' ));
		add_action('admin_menu', array( $this, 'gxtb_fb_lB_add_custom_box' ));
		#add_action('admin_head', array(&$this, 'gxtb_fb_lB_header'));
	}
}

function gxtb_fb_lB_header($content) {

echo '
<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by Stefan Natter (http://www.gb-world.net) -->';
echo '
<script type="text/javascript" src="' . gxtb_fb_lB_PLUGIN_FOLDER . 'admin/js/gb_generator.js"></script>
';
echo '<link rel="stylesheet" type="text/css" href="' . gxtb_fb_lB_PLUGIN_FOLDER . 'admin/css/tooltips.css" />
';
echo '<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by Stefan Natter (http://www.gb-world.net) -->
';
}

function gxtb_fb_lB_add_custom_box() {

	$headline = __( 'Like-Button-Settings', gxtb_fb_lB_lang );

if(current_user_can('manage_options')) {
	$pic = plugins_url() ."/like-button-plugin-for-wordpress/images/help.png?v=1";
	$page = admin_url('admin.php?page=fb-like-settings#editorwidget');
	$headline .= ' <span style="position:relative;"><a href="'.$page.'"><img width="16px" height="16px" src="'.$pic.'"/></a></span>';
}
	
	#$headline .= "<small> | <a href='admin.php?page=fb-like-button'>" . __( 'Settings', gxtb_fb_lB_lang ) ."</a></small>";

  if( function_exists( 'add_meta_box' )) {
    add_meta_box( 'gxtb_fb_lB_sectionid', $headline,
                array( $this, 'gxtb_fb_lB_inner_custom_box' ), 'post', 'side', 'high' );
    add_meta_box( 'gxtb_fb_lB_sectionid', $headline, 
                array( $this, 'gxtb_fb_lB_inner_custom_box' ), 'page', 'side', 'high' );
	if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	EDITOR-WIDGET[ACTION]: Widgets added - complete'); }			
	}
}
   
/* Prints the inner fields for the custom post/page section */
function gxtb_fb_lB_inner_custom_box() {

    global $post, $wp_version;
	$GBLikeButton = get_option('GBLikeButton');
    $post_id = $post;
    
    if (is_object($post_id)) 
    	$post_id = $post_id->ID;
    
    $fbpic = get_post_meta($post_id, '_fbpic', true); ## Wenn != "" dann benutzen
	$fbnone = get_post_meta($post_id, '_fbnone', true); ## Wenn == 1 dann keinen Like-Button-Output
	$fbnometa = get_post_meta($post_id, '_fbnometa', true); ## Wenn == 1 dann kein Meta-Output
	$fbnodefault = get_post_meta($post_id, '_fbnodefault', true); ## Wenn == 1 dann kein Default-Image-Tag
	$fbnotemplate = get_post_meta($post_id, '_fbnotemplate', true); ## Wenn == 1 dann kein Template-Button
		
	echo '<b>'; _e("Check the OpenGraph Meta-Tags", gxtb_fb_lB_lang ); echo '</b>';
?><br>
<a href="http://developers.facebook.com/tools/lint/?url=<?php echo get_permalink( $post_id ); ?>" target="_blank">Facebook URL Linter</a>
<?php if (isset($GBLikeButton['OpenGraph']['w3c']) && $GBLikeButton['OpenGraph']['w3c']) {
	echo "<br><br>";
	echo sprintf("%s <a href='". get_bloginfo('siteurl') ."/wp-admin/admin.php?page=fb-like-expert#w3c' target='_blank'>%s</a>. %s",
	_e("You have activated the", gxtb_fb_lB_lang),
	_e("W3C-Validation Option", gxtb_fb_lB_lang ),
	_e("The Facebook URL Linter will not work as long as you have activate this option.", gxtb_fb_lB_lang ));
	echo "<br>";
}
?>
<br><br>
<?php
if (version_compare( $wp_version, '2.9', '>=' )) {
	if (current_theme_supports('post-thumbnails')) {	
	$fbfeatured = get_post_meta($post_id, '_fbfeatured', true);
	if($fbfeatured == "") { $fbfeatured = $GBLikeButton['Functions']['Editor']['EditorWidget_Settings']['featured']; }
?>
    	<input name="GBLikeButton_fbfeatured" type="checkbox" class="checkbox" <?php if ($fbfeatured == 1) echo("checked"); ?> value="1" />&nbsp; <?php _e("Use the Featured Image for the Image-Tag.", gxtb_fb_lB_lang ) ?>
        <br />
<?php } } ?>
        <input name="GBLikeButton_fbnone" type="checkbox" class="checkbox" <?php if ($fbnone == 1) echo("checked"); ?>  value="1" />&nbsp; <?php  echo sprintf("<b>%s</b> %s", __("Disable", gxtb_fb_lB_lang ), __("Like-Button for this post/page.", gxtb_fb_lB_lang )); ?>
        <br />
        <input name="GBLikeButton_fbnometa" type="checkbox" class="checkbox" <?php if ($fbnometa == 1) echo("checked"); ?>  value="1" />&nbsp; <?php  echo sprintf("<b>%s</b> %s", __("Disable", gxtb_fb_lB_lang ), __("the Meta-Tags on this page/post.", gxtb_fb_lB_lang )); ?>
        <br />
        <input name="GBLikeButton_fbnodefault" type="checkbox" class="checkbox" <?php if ($fbnodefault == 1) echo("checked"); ?>  value="1" />&nbsp; <?php  echo sprintf("<b>%s</b> %s", __("Disable", gxtb_fb_lB_lang ), __("the Default-Image on this page/post.", gxtb_fb_lB_lang )); ?>
        <br />
        <input name="GBLikeButton_fbnotemplate" type="checkbox" class="checkbox" <?php if ($fbnotemplate == 1) echo("checked"); ?>  value="1" />&nbsp; <?php  echo sprintf("<b>%s</b> %s", __("Disable", gxtb_fb_lB_lang ), __("the Template-Function on this page/post.", gxtb_fb_lB_lang )); ?>
        <br /><br />
<?php
	echo '<label for="GBLikeButton_post_description">' . __("Enter the full path to an image you want to connect with this Post/Page.", gxtb_fb_lB_lang ) . '</label><br/><br/>';
	echo sprintf("<b>%s</b>: %s: <br><br><i>%s <small>(%s)</small></i><br/><br/>", __("Important", gxtb_fb_lB_lang ), __("Keep in mind that Facebook does only supports the following images", gxtb_fb_lB_lang ), __("The image must be at least 50px by 50px and have a maximum aspect ratio of 3:1. We support PNG, JPEG and GIF formats.", gxtb_fb_lB_lang ),  __("by Facebook", gxtb_fb_lB_lang ));
	echo '<input type="text" name="GBLikeButton_post_image" id="GBLikeButton_post_image" value="' . $fbpic . '" size="25" />';
	?>
	<img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('Every single post/page can have its own individuel image if you like!', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();">
    <br />
	<?php
		#wp_nonce_field('fb_editwidget_save','fb_like_hidden');
	  wp_nonce_field( plugin_basename( __FILE__ ), 'fb_editwidget_save' );

	if (isset($fbpic) && !empty($fbpic)) {
		if(!preg_match('#^http:\/\/#', substr($fbpic,0, 8))) { $fbpic = "http://" . $fbpic; } else if ( preg_match('#^https:\/\/#i', substr($fbpic,0, 8))) { $fbpic = "https://" . $fbpic;  }
		echo sprintf( '<br /><a href="' . $fbpic . '" target="_blank">%s</a>', __('See Post-Image', gxtb_fb_lB_lang));
	}
	if ( isset($fbpic) && !empty($fbpic)) {
			if (!preg_match('#^(.*)\.(png|gif|jpg|jpeg)$#i', $fbpic) ) {
				$datentyp = substr (strrchr ($fbpic, "."), 1);
		echo sprintf( '<br /><br /><div id="message" class="error"><p><b>%s:</b> %s <i>%s</i> %s! <small>[%s]</small></p></div>', __('Warning', gxtb_fb_lB_lang), __('The Image-Type', gxtb_fb_lB_lang), $datentyp, __('is not allowed', gxtb_fb_lB_lang), __('Like-Button-Image #1', gxtb_fb_lB_lang) );
			}
	}
}

function gxtb_fb_lB_save_postdata( $post_id ) {
	#http://codex.wordpress.org/Function_Reference/add_meta_box#Example
	
	$return = false;
	
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      $return = true;

  if ( isset($_POST['fb_editwidget_save']) && !wp_verify_nonce( $_POST['fb_editwidget_save'], plugin_basename( __FILE__ ) ) )
      $return = true;

	  if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) 
	  {
		if ( !current_user_can( 'edit_page', $post_id ) )
			$return = true;
	  }
	  else
	  {
		if ( !current_user_can( 'edit_post', $post_id ) )
			$return = true;
	  }
		
	if($return) {
		_log('[Like-Button-Plugin-For-Wordpress] 	EDITOR-WIDGET[WARNING]: the current user was not allowed to save the post!');
		return;
	}

if ( strpos($_SERVER['REQUEST_URI'], "post.php") || strpos($_SERVER['REQUEST_URI'], "post.php") || strpos($_SERVER['REQUEST_URI'], "post-new.php") ) {
	if ( !empty($_POST) ) {
		
		#http://www.wordpress-expert.info/2011/05/08/improving-security-in-wordpress-plugins-using-nonces/
		#http://www.prelovac.com/vladimir/improving-security-in-wordpress-plugins-using-nonces
		#check_admin_referer('fb_editwidget_save','fb_like_hidden');

		$fbpic = (isset($_POST['GBLikeButton_post_image'])) ? $_POST['GBLikeButton_post_image']:"";
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
		
		if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	EDITOR-WIDGET[ACTION]: Widgets updated - complete'); }
	} else { 
		if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	EDITOR-WIDGET[WARNING]: The has been an unusual request!'); }	
    } // end if-isset & admin-referer
   } // end if-page
} // end function
} // end class
} // end if-class
if(!class_exists('GBLikeButton_CustomPost')) {  # still available until every old class-call is changed
class GBLikeButton_CustomPost extends GBLikeButton_EditorWidget {
} // end class
} // end if-class
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      ADDITIONAL			 ###########
###########			CUSTOM META-TAGS	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('GBLikeButton_EditorWidgetMeta')) {
class GBLikeButton_EditorWidgetMeta {
	
	var $pagelevel;
	var $GBLikeButton;
	var $GBLikeButton_Name; // for the option identifier 
	var $identifier = 'GBLikeButton_';
	
function GBLikeButton_EditorWidgetMeta($pagelevel) {
	
	if ( is_admin() && (strstr($_SERVER['REQUEST_URI'], "post.php") || strstr($_SERVER['REQUEST_URI'], "post-new.php")) ) {
		wp_enqueue_script('gb-generator');
		wp_enqueue_style('gb-tooltips');
		
		$this->pagelevel = $pagelevel;
		
		#include_once('gb_meta.php');
		
		add_action('save_post', array( $this, 'GBLikeButton_OpenGraphSave' ));
		add_action('admin_menu', array( $this, 'GBLikeButton_OpenGraphAdd' ));
		
		$this->GBLikeButton_Name = array(
			'fbaudio',
			'fbaudio_title',
			'fbaudio_artist',
			'fbaudio_album',
			'fbaudio_type',
			'fbvideo',
			'fbvideo_height',
			'fbvideo_width',
			'fbvideo_type'
		);
	}
}
function GBLikeButton_OpenGraphAdd() {

	$headline = __( 'OpenGraph Settings', gxtb_fb_lB_lang );

if(current_user_can('manage_options')) {
	$pic = plugins_url() ."/like-button-plugin-for-wordpress/images/help.png?v=1";
	$page = admin_url('admin.php?page=fb-like-settings#editorwidget');
	$headline .= ' <span style="position:relative;"><a href="'.$page.'"><img width="16px" height="16px" src="'.$pic.'"/></a></span>';
}

  if( function_exists( 'add_meta_box' )) {
    add_meta_box( 'GBLikeButton_OpenGraph', $headline,
                array( $this, 'GBLikeButton_OpenGraphContent' ), 'post', 'normal', 'high' );
    add_meta_box( 'GBLikeButton_OpenGraph', $headline, 
                array( $this, 'GBLikeButton_OpenGraphContent' ), 'page', 'normal', 'high' );
	}
}
function GBLikeButton_OpenGraphContent() {

    global $post, $wp_version;
    $post_id = $post;
    if (is_object($post_id)) 
    	$post_id = $post_id->ID;
    
    $GBLikeButton_Options= array(
		"fbaudio" => get_post_meta($post_id, '_fbaudio', true),
		"fbaudio_title" => get_post_meta($post_id, '_fbaudio_title', true),
		"fbaudio_artist" => get_post_meta($post_id, '_fbaudio_artist', true),
		"fbaudio_album" => get_post_meta($post_id, '_fbaudio_album', true),
		"fbaudio_type" => get_post_meta($post_id, '_fbaudio_type', true),
		
		"fbvideo" => get_post_meta($post_id, '_fbvideo', true),
		"fbvideo_height" => get_post_meta($post_id, '_fbvideo_height', true),
		"fbvideo_width" => get_post_meta($post_id, '_fbvideo_width', true),
		"fbvideo_type" => get_post_meta($post_id, '_fbvideo_type', true)
	);

	$GBLikeButton_Output = array (
		array(	'type' => 'open'),
			
		array(	'type' => 'left'),	
				
		array(	'title' => __('Audio', gxtb_fb_lB_lang),
				'name' => $this->GBLikeButton_Name[0],
				'value' => $GBLikeButton_Options['fbaudio'],
				'tooltip' => __('http://example.com/amazing.mp3', gxtb_fb_lB_lang),
				'tooltip_ad' => "",
				'type' => 'content'),	
				
		array(	'title' => __('Audio-Title', gxtb_fb_lB_lang),
				'name' =>  $this->GBLikeButton_Name[1],
				'value' => $GBLikeButton_Options['fbaudio_title'],
				'tooltip' => __('Amazing Soft Rock Ballad', gxtb_fb_lB_lang),
				'tooltip_ad' => "",
				'type' => 'content'),	
				
		array(	'title' => __('Audio-Artist', gxtb_fb_lB_lang),
				'name' =>  $this->GBLikeButton_Name[2],
				'value' => $GBLikeButton_Options['fbaudio_artist'],
				'tooltip' => __('Amazing Band', gxtb_fb_lB_lang),
				'tooltip_ad' => "",
				'type' => 'content'),	
				
		array(	'title' => __('Audio-Album', gxtb_fb_lB_lang),
				'name' =>  $this->GBLikeButton_Name[3],
				'value' => $GBLikeButton_Options['fbaudio_album'],
				'tooltip' => __('Amazing Album', gxtb_fb_lB_lang),
				'tooltip_ad' => "",
				'type' => 'content'),	
				
		array(	'title' => __('Audio-Type', gxtb_fb_lB_lang),
				'name' =>  $this->GBLikeButton_Name[4],
				'value' => $GBLikeButton_Options['fbaudio_type'],
				'tooltip' => __('application/mp3', gxtb_fb_lB_lang),
				'tooltip_ad' => "",
				'type' => 'content'),
			
		array(	'type' => 'right'),		
				
		array(	'title' => __('Video', gxtb_fb_lB_lang),
				'name' =>  $this->GBLikeButton_Name[5],
				'value' => $GBLikeButton_Options['fbvideo'],
				'tooltip' => __('http://example.com/awesome.flv', gxtb_fb_lB_lang),
				'tooltip_ad' => "",
				'type' => 'content'),		
				
		array(	'title' => __('Video-Height', gxtb_fb_lB_lang),
				'name' =>  $this->GBLikeButton_Name[6],
				'value' => $GBLikeButton_Options['fbvideo_height'],
				'tooltip' => __('640', gxtb_fb_lB_lang),
				'tooltip_ad' => "",
				'type' => 'content'),		
				
		array(	'title' => __('Video-Width', gxtb_fb_lB_lang),
				'name' =>  $this->GBLikeButton_Name[7],
				'value' => $GBLikeButton_Options['fbvideo_width'],
				'tooltip' => __('385', gxtb_fb_lB_lang),
				'tooltip_ad' => "",
				'type' => 'content'),		
				
		array(	'title' => __('Video-Type', gxtb_fb_lB_lang),
				'name' =>  $this->GBLikeButton_Name[8],
				'value' => $GBLikeButton_Options['fbvideo_type'],
				'tooltip' => __('application/x-shockwave-flash', gxtb_fb_lB_lang),
				'tooltip_ad' => "If you don not specify a og:video:type, parsers will try to infer the type. A sensible default would be to assume &quot;application/x-shockwave-flash&quot; until HTML5 video becomes more prevalent.",
				'type' => 'content'),
							
		array(	'type' => 'hidden'),
							
		array(	'type' => 'close')			
	
	);
	
	$this->GBLikeButton_SettingOutput($GBLikeButton_Output);
}
protected function GBLikeButton_SettingOutput($option) {
	
	global $post, $wp_version;
    $post_id = $post;
    
    if (is_object($post_id)) 
    	$post_id = $post_id->ID;
	
	foreach ($option as $value) { 
		switch ( $value['type'] ) {
	
		case 'open':
			echo '<div class="gb_tagswidget" style="overflow:hidden;position:static;">';
		break;
		
		case 'left':
			echo '<div style="float:left;display:block;margin-right:20px;">';
		break;
		
		case 'right':
			echo '</div>';
			echo '<div>';
		break;
		
		case 'content': 
		
		$value['name'] = $this->identifier . $value['name'];
		?>
       <label for="<?php echo $value['name'] ?>"><?php echo $value['title'] ?></label><br /><input type="text" name="<?php echo $value['name'] ?>" id="<?php echo $value['name'] ?>" value="<?php if (isset($value['value']) && $value['value'] != "") {echo $value['value'];} else {echo "";} ?>" /> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('Example', gxtb_fb_lB_lang); ?>: <i><?php echo $value['tooltip'] ?></i><?php if( isset($value['tooltip_ad']) && $value['tooltip_ad']!= "") echo '<br /><br />'.$value['tooltip_ad'] ?>');" onmouseout="tooltip.hide();">  
        <br /><br />
		<?php break;
		
		case 'hidden': 
			wp_nonce_field('fb_editwidget_additional_save'.$post_id,'fb_like_hidden_opengraph');
		break;
		
		case 'close':
			echo '</div></div>';
		break;		
		} // end switch
	} // end foreach
} // end function
function GBLikeButton_OpenGraphSave( $post_id ) {

	$return = false;
	
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      $return = true;

  if ( isset($_POST['fb_like_hidden_opengraph']) && !wp_verify_nonce( $_POST['fb_like_hidden_opengraph'], 'fb_editwidget_additional_save'.$post_id) )
      $return = true;

	  if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) 
	  {
		if ( !current_user_can( 'edit_page', $post_id ) )
			$return = true;
	  }
	  else
	  {
		if ( !current_user_can( 'edit_post', $post_id ) )
			$return = true;
	  }
		
	if($return) {
		_log('[Like-Button-Plugin-For-Wordpress] 	EDITOR-WIDGET[WARNING]: the current user was not allowed to save the post!');
		return;
	}	
	
	if ( strpos($_SERVER['REQUEST_URI'], "post.php") || strpos($_SERVER['REQUEST_URI'], "post.php") || strpos($_SERVER['REQUEST_URI'], "post-new.php") ) {
	  if ( !empty($_POST) ) {
		
		$GBLikeButton_Save = array();
		foreach($this->GBLikeButton_Name as $key) {
			$GBLikeButton_Save[$key] = (isset($_POST[$this->identifier . $key])) ? $_POST[$this->identifier . $key]:"";
			update_post_meta($post_id, '_' . $key, $GBLikeButton_Save[$key]);		
		}
	} // end if-nonce
  } // end if
} // end function
} // end class
} // end if-class
?>