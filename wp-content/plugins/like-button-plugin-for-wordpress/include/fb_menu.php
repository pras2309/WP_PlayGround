<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.5] - GB-Admin-Bar-Menu [v1.2 FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 3.1+ or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       Admin-Bar-Menu		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net ##############
####################################################
if (!class_exists('GBLikeButtonAdminBar')) {
class GBLikeButtonAdminBar {
	var $pagelevel;
function GBLikeButtonAdminBar($pagelevel) {
	
	global $wp_version;
	$this->pagelevel = $pagelevel;
	
	if ( version_compare( $wp_version, '3.1', '>=' ) ) {
		# Add a new menu to the admin bar (WP 3.1+)
		add_action('wp_head', array( $this, 'wp_admin_head' ));
		add_action('admin_bar_menu', array( $this, 'wp_admin_bar'), 1000 );
	}
}

function wp_admin_head() {
		if (!is_admin() && is_admin_bar_showing() ) {
wp_print_scripts('gb-frontendscript-admin');
		}
}
function wp_admin_bar() { # More Infos on: http://www.problogdesign.com/wordpress/add-useful-links-to-wordpress-admin-bar/ and http://wordpress.stackexchange.com/questions/4998/is-the-new-wordpress-3-1-admin-bar-pluggable-and-how-can-i-extend-it #
# German: http://www.hpvorlagen24.de/2011/03/06/wordpress-adminbar-teil1/ # 

if (!is_admin_bar_showing() || !current_user_can($this->pagelevel) )
	return;

global $wp_admin_bar, $wpdb, $wp_version;

$id = 'fblike';
$url = get_option('siteurl').'/wp-admin/admin.php?page=fb-like-';

/* Add the main siteadmin menu item */
$wp_admin_bar->add_menu( array( 'id' => $id.'menu', 'title' => __( 'Like-Button-Settings', gxtb_fb_lB_lang ), 'href' => FALSE ) );
# Facebook-Menu
$wp_admin_bar->add_menu( array( 'parent' => $id.'menu', 'id' => $id.'facebook', 'title' => __( 'Facebook', gxtb_fb_lB_lang ), 'href' => '#' ) );
$wp_admin_bar->add_menu( array( 'parent' => $id.'facebook', 'id' => $id.'urllinter', 'title' => __( 'Check this Page', gxtb_fb_lB_lang ), 'href' => 'http://developers.facebook.com/tools/lint/?url='. get_permalink(), 'meta' => array('target' => '_blank')  ) );

# Post/Page-Settings
if(is_single() || is_page() ) {
	
	global $post, $wp_query, $wp_version;
   	$post_id = $wp_query->post->ID;	
	
	$method = (GBLikeButton_Debug) ? "get":"post";
	
	$this->AdminBar_Save($post_id, $wp_version);
		
    $fbpic = get_post_meta($post_id, '_fbpic', true); ## Wenn != "" dann benutzen
	$fbnone = get_post_meta($post_id, '_fbnone', true); ## Wenn == 1 dann keinen Like-Button-Output
	$fbnometa = get_post_meta($post_id, '_fbnometa', true); ## Wenn == 1 dann kein Meta-Output
	$fbnodefault = get_post_meta($post_id, '_fbnodefault', true); ## Wenn == 1 dann kein Default-Image-Tag
	$fbnotemplate = get_post_meta($post_id, '_fbnotemplate', true); ## Wenn == 1 dann kein Template-Button
			
	$css = "gb-adminbar";
	
	$test = '<form target="_blank" method="get" action="'.get_permalink().'" style="margin:5px 0 0;">
        <input size="13" type="text" onblur="this.value=(this.value==\'\') ? \'' . __( 'Search the Codex', 'textdomain' ) . '\' : this.value;" onfocus="this.value=(this.value==\'' . __( 'Search the Codex', 'textdomain' ) . '\') ? \'\' : this.value;" maxlength="100" value="' . __( 'Search the Codex', 'textdomain' ) . '" name="search" class="adminbar-input">
        <button type="submit" class="adminbar-button">
            <span>Go</span>
        </button>
    </form>';
	
	$infotext = __( 'You have to refresh the page to see any changes after you hit the Go-Button.', gxtb_fb_lB_lang );
	
if (version_compare( $wp_version, '2.9', '>=' ) && current_theme_supports('post-thumbnails')) {
	$fbfeatured = get_post_meta($post_id, '_fbfeatured', true);
		
	$featured = '<form target="_self" name="gb_adminbar_featured-form" method="'.$method.'" action="'.get_permalink().'">
	<input type="checkbox" class="checkbox" name="gb_adminbar_featured"';
	$featured .= ($fbfeatured == 1) ? " checked":"";
	$featured .= ' value="1" onchange="gb_adminbar();"> '.__( 'Use Featured Image', gxtb_fb_lB_lang ).'
    <input type="hidden" name="fb_like_hidden" value="featured" />
	<input name="gb_adminbar_featured-submit" type="submit" class="button-primary" value="Go" />	
    </form>';
}
	$nolikebutton = '<form target="_self"  name="gb_adminbar_nolikebutton-form"  method="'.$method.'" action="'.get_permalink().'">
	<input type="checkbox" class="checkbox" name="gb_adminbar_nolikebutton"';
	$nolikebutton .= ($fbnone == 1) ? " checked":"";
	$nolikebutton .= ' value="1" onchange="gb_adminbar();" class="adminbar-input"> '.__( 'Disable Like Button', gxtb_fb_lB_lang ).'
    <input type="hidden" name="fb_like_hidden" value="nolikebutton" />
	<input name="gb_adminbar_nolikebutton-submit" type="submit" class="button-primary" value="Go" />	
    </form>';
	$nometatags = '<form target="_self"  name="gb_adminbar_nometatags-form"  method="'.$method.'" action="'.get_permalink().'">
	<input type="checkbox" class="checkbox" name="gb_adminbar_nometatags"';
	$nometatags .= ($fbnometa == 1) ? " checked":"";
	$nometatags .= '  value="1" onchange="gb_adminbar();"> '.__( 'Disable Meta-Tags', gxtb_fb_lB_lang ).'
    <input type="hidden" name="fb_like_hidden" value="nometatags" />
	<input name="gb_adminbar_nometatags-submit" type="submit" class="button-primary" value="Go" />	
    </form>';
	$nodefaultimage = '<form target="_self"  name="gb_adminbar_nodefaultimage-form" method="'.$method.'" action="'.get_permalink().'">
	<input type="checkbox" class="checkbox" name="gb_adminbar_nodefaultimage"';
	$nodefaultimage .= ($fbnodefault == 1) ? " checked":"";
	$nodefaultimage .= '  value="1" onchange="gb_adminbar();"> '.__( 'Disable Default Image', gxtb_fb_lB_lang ).'
    <input type="hidden" name="fb_like_hidden" value="nodefaultimage" />
	<input name="gb_adminbar_nodefaultimage-submit" type="submit" class="button-primary" value="Go" />	
    </form>';
	$notemplatebutton = '<form target="_self"  name="gb_adminbar_notemplatebutton-form" method="'.$method.'" action="'.get_permalink().'">
	<input type="checkbox" class="checkbox" name="gb_adminbar_notemplatebutton"';
	$notemplatebutton .= ($fbnotemplate == 1) ? " checked":"";
	$notemplatebutton .= '  value="1" onchange="gb_adminbar();"> '.__( 'Disable Template Button', gxtb_fb_lB_lang ).'
    <input type="hidden" name="fb_like_hidden" value="notemplatebutton" />
	<input name="gb_adminbar_notemplatebutton-submit" type="submit" class="button-primary" value="Go" />	
    </form>';
	$fbpicture = '<form target="_self" id="gb_adminbar_fbpicture-form" name="gb_adminbar_fbpicture-form" method="'.$method.'" action="'.get_permalink().'">';
	$fbpicture .= '<input size="30" type="text" maxlength="100" value="'.  stripslashes($fbpic) .'" id="gb_adminbar_fbpicture" name="gb_adminbar_fbpicture" class="adminbar-input" onchange="return gb_adminbar(this.value)">';
	$fbpicture .= ' ' . __("Connected Image", gxtb_fb_lB_lang ) . ' ';
    $fbpicture .= '<input name="gb_adminbar_picture-submit" type="submit" class="button-primary" value="Go" />
	<input type="hidden" name="fb_like_hidden" value="fbpicture" />
    </form>';

$wp_admin_bar->add_menu( array( 'parent' => $id.'menu', 'id' => $id.'pagesettings', 'title' => __( 'Post-Settings', gxtb_fb_lB_lang ), 'href' => '#' ) );
$wp_admin_bar->add_menu( array( 'parent' => $id.'pagesettings', 'title' => $infotext, 'href' => '#', 'meta' => array('class' => $css, 'title' => __( 'You can change this setting right here!', gxtb_fb_lB_lang ))  ) );
if ( version_compare( $wp_version, '2.9', '>=') && current_theme_supports('post-thumbnails') ) {
	$wp_admin_bar->add_menu( array( 'parent' => $id.'pagesettings', 'title' => $featured, 'href' => '#', 'meta' => array('class' => $css, 'title' => __( 'You can change this setting right here!', gxtb_fb_lB_lang ))  ) );
}
$wp_admin_bar->add_menu( array( 'parent' => $id.'pagesettings', 'title' => $nolikebutton, 'href' => '#', 'meta' => array('class' => $css, 'title' => __( 'You can change this setting right here!', gxtb_fb_lB_lang ))  ) );
$wp_admin_bar->add_menu( array( 'parent' => $id.'pagesettings', 'title' => $nometatags, 'href' => '#', 'meta' => array('class' => $css, 'title' => __( 'You can change this setting right here!', gxtb_fb_lB_lang ))  ) );
$wp_admin_bar->add_menu( array( 'parent' => $id.'pagesettings', 'title' => $nodefaultimage, 'href' => '#', 'meta' => array('class' => $css, 'title' => __( 'You can change this setting right here!', gxtb_fb_lB_lang ))  ) );
$wp_admin_bar->add_menu( array( 'parent' => $id.'pagesettings', 'title' => $notemplatebutton, 'href' => '#', 'meta' => array('class' => $css, 'title' => __( 'You can change this setting right here!', gxtb_fb_lB_lang ))  ) );
$wp_admin_bar->add_menu( array( 'parent' => $id.'pagesettings', 'title' => $fbpicture, 'href' => '#', 'meta' => array('class' => $css, 'title' => __( 'You can change this setting right here!', gxtb_fb_lB_lang ))  ) );
}

# Settings-Menu
$wp_admin_bar->add_menu( array( 'parent' => $id.'menu', 'id' => $id.'settings', 'title' => __( 'Like-Button-Settings', gxtb_fb_lB_lang ), 'href' => $url.'general', 'meta' => array('target' => '_blank')  ) );
$wp_admin_bar->add_menu( array( 'parent' => $id.'settings', 'title' => __( 'General Settings', gxtb_fb_lB_lang ), 'href' => $url.'general', 'meta' => array('target' => '_blank')  ) );
$wp_admin_bar->add_menu( array( 'parent' => $id.'settings', 'title' => __( 'Design Settings', gxtb_fb_lB_lang ), 'href' => $url.'design', 'meta' => array('target' => '_blank')  ) );
$wp_admin_bar->add_menu( array( 'parent' => $id.'settings', 'title' => __( 'OpenGraph Settings', gxtb_fb_lB_lang ), 'href' => $url.'opengraph', 'meta' => array('target' => '_blank')  ) );
$wp_admin_bar->add_menu( array( 'parent' => $id.'settings', 'title' => __( 'FB-Insights Settings', gxtb_fb_lB_lang ), 'href' => $url.'insights', 'meta' => array('target' => '_blank')  ) );
$wp_admin_bar->add_menu( array( 'parent' => $id.'settings', 'title' => __( 'Plugin Settings', gxtb_fb_lB_lang ), 'href' => $url.'settings', 'meta' => array('target' => '_blank') ) );

# Help-Menu
$wp_admin_bar->add_menu( array( 'parent' => $id.'menu', 'id' => $id.'help', 'title' => __( 'Live Support', gxtb_fb_lB_lang ), 'href' => 'http://www.facebook.com/GBWorldnet', 'meta' => array('target' => '_blank')  ) );
} # end function

function AdminBar_Save($post_id, $wp_version) {

	#if ( !current_user_can('activate_plugins') || !is_user_logged_in() )
	#	return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	
	if( !isset($_POST['fb_like_hidden'])) { return "";}

      $keycode = "gb_adminbar_";
		
		switch ($_POST['fb_like_hidden']) {
			
			case "featured":
				if (version_compare( $wp_version, '2.9', '>=' ) && current_theme_supports('post-thumbnails')) {
					$featured = $_POST[$keycode . $_POST['fb_like_hidden']];	
					if ($featured || !$featured) {
								#delete_post_meta($post_id, '_fbfeatured');
								update_post_meta($post_id, '_fbfeatured', $featured);
					}		
				}
			break;
			
			case "nolikebutton":
					$fbnone = $_POST[$keycode . $_POST['fb_like_hidden']];
					if ($fbnone || !$fbnone) {
								#delete_post_meta($post_id, '_fbnone');
								update_post_meta($post_id, '_fbnone', $fbnone);
					}
			break;
			
			case "nometatags":
				$fbnometa = $_POST[$keycode . $_POST['fb_like_hidden']];
				if ($fbnometa || !$fbnometa) {
							#delete_post_meta($post_id, '_fbnometa');
							update_post_meta($post_id, '_fbnometa', $fbnometa);
				}
			break;
			
			case "nodefaultimage":
				$fbnodefault = $_POST[$keycode . $_POST['fb_like_hidden']];
				if ($fbnodefault || !$fbnodefault) {
							#delete_post_meta($post_id, '_fbnodefault');
							update_post_meta($post_id, '_fbnodefault', $fbnodefault);
				}
			break;
			
			case "notemplatebutton":
				$fbnotemplate = $_POST[$keycode . $_POST['fb_like_hidden']];
					
				if ($fbnotemplate || !$fbnotemplate) {
							#delete_post_meta($post_id, '_fbnotemplate');
							update_post_meta($post_id, '_fbnotemplate', $fbnotemplate);
				}
			break;
			
			case "fbpicture":
					$fbpicture = stripslashes($_POST[$keycode . $_POST['fb_like_hidden']]);
					if (isset($fbpicture)) {
						if($fbpicture != "" && !preg_match('#^http#', substr($fbpicture,0, 4)) ) { 
					
							$http = "http";
					
							if (!preg_match('#^:\/\/#', substr($fbpicture,4, 8))) {
								$http .= "://";
								}
					
						$fbpicture = $http . $fbpicture;
						}
						#delete_post_meta($post_id, '_fbpic');
						update_post_meta($post_id, '_fbpic', $fbpicture);
					}
			break;
			
			default:
			break;
			
		}		
}

} # end clsas
} # end if-class