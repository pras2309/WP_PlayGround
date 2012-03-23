<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.4] - Like-Button-Shortcode [v0.6 - FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      ShortCode-Class		 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('GBLikeButton_Shortcode')) {
include_once( 'gb_generate.php');
class GBLikeButton_Shortcode extends gxtb_fb_lB_GenerateLike {

	var $GBLikeButton;
	
function GBLikeButton_Shortcode() {

	$this->GBLikeButton = get_option('GBLikeButton');

	if ( $this->GBLikeButton['Functions']['General']['Shortcode'] == 1)
		add_shortcode('like', array( &$this, 'GBLikeButton_ShortcodeOutput' ) );
}

function GBLikeButton_ShortcodeOutput($atts) {

	global $wp_version;
	$this->GBLikeButton = get_option('GBLikeButton');

if (GBLikeButton_Log && current_user_can('manage_options'))
_log('[Like-Button-Plugin-For-Wordpress] [--BEGIN--] Shortcode');	

	extract(shortcode_atts(array(
			'url' 			=> 	"",
			'xfbml'			=> 	($this->GBLikeButton['General']['jdk'] == 1) ? true:false,
			'layout'		=> 	$this->GBLikeButton['Generator']['layout'],
			'action'    	=> 	$this->GBLikeButton['Generator']['verb'],
			'width'			=> 	$this->GBLikeButton['Generator']['width'],
			'height'		=>	$this->GBLikeButton['Generator']['height'],
			'class'			=>	"",
			'style'			=> 	"",
			'besidebutton' 	=> 	true,
			'div' 			=> 	true,
			'enabled'		=> 	true # derzeit Out-Of-Order
		), $atts ));


if (GBLikeButton_Log && current_user_can('manage_options'))
_log('[Like-Button-Plugin-For-Wordpress] 	Shortcode[ACTION]: Extraction - complete');
		
if (GBLikeButton_Log && current_user_can('manage_options')) {	
	echo "<b>[DEBUG] Shortcode</b><br /><br />";
	echo '[like url=>' . esc_attr($url) . ' layout=>' . esc_attr($layout) .' action=>' . esc_attr($action) .' width=>' . esc_attr($width) .' height=>' . esc_attr($height) . " ". 'style=>' . esc_attr($style).' besidebutton=>' . esc_attr($besidebutton).' div=>' . esc_attr($div).' xfbml=>' . esc_attr($xfbml).' class=>' . esc_attr($class).']';
	echo "<br /><br />";
}

	$parameter = array();
	$parameter['url'] 			= 	(isset($url)) ? $url:"";
	$parameter['xfbml'] 		= 	(isset($xfbml)) ? $xfbml:false;
	$parameter['layout'] 		= 	(isset($layout)) ? $layout:$this->GBLikeButton['Generator']['layout'];
	$parameter['action'] 		= 	(isset($action)) ? $action:'like';
	$parameter['width'] 		= 	(isset($width)) ? $width:'80';
	$parameter['height'] 		= 	(isset($height)) ? $height:'20';
	$parameter['class']			= 	(isset($class)) ? $class:'';
	$parameter['style'] 		= 	(isset($style)) ? $style:'';
	$parameter['besidebutton'] 	= 	(isset($besidebutton)) ? $besidebutton:true;
	$parameter['div'] 			= 	(isset($div)) ? $div:true;
	$parameter['enabled'] 		= 	(isset($enabled)) ? $enabled:true; # enables the shortcode even if you deactivate the dynamic buttons on the post/page

if (GBLikeButton_Log && current_user_can('manage_options'))
_log('[Like-Button-Plugin-For-Wordpress] 	Shortcode[ACTION]: Var. OK - complete');

	return $this -> GBLikeButton_ShortcodeGenerate($parameter);
}
function GBLikeButton_ShortcodeGenerate($parameter) {	

if (GBLikeButton_Log && current_user_can('manage_options')) {	
	echo "GBLikeButtonGenerate(array( 'url' => '{$parameter['url']}', 'layout' => '{$parameter['layout']}', 'action' => '{$parameter['action']}', 'width' => '{$parameter['width']}', 'height' => '{$parameter['height']}', 'class' => '{$parameter['class']}',
	'style' => '{$parameter['style']}',
	'expert' => array( 'besidebutton' => '{$parameter['besidebutton']}', 'div' => '{$parameter['div']}', 'xfbml' => '{$parameter['xfbml']}'), 'enabled' => '{$parameter['enabled']}' ));";
	echo "<br /><br />";
}

if (GBLikeButton_Log && current_user_can('manage_options'))
_log('[Like-Button-Plugin-For-Wordpress] [--END--] Shortcode');

return $this -> GBLikeButtonGenerate(array( 'url' => $parameter['url'], 'layout' => $parameter['layout'], 'action' => $parameter['action'], 'width' => $parameter['width'], 'height' => $parameter['height'], 'class' => $parameter['class'],
'style' => $parameter['style'],
'expert' => array( 'besidebutton' => $parameter['besidebutton'], 'div' => $parameter['div'], 'xfbml' => $parameter['xfbml']),
'enabled' => $parameter['enabled'],
'type' => 'shortcode'
));	
}
} // end class
} // end if-class

if (class_exists('GBLikeButton_Shortcode')) {
	$GBLikeButton_Shortcode = new GBLikeButton_Shortcode();
}
?>