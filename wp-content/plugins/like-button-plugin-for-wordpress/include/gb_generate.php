<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.5] - Like-Button-Generator [v1.1 FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	   LIKE-Generate-CLASS		 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('gxtb_fb_lB_GenerateLike')) {
class gxtb_fb_lB_GenerateLike {

	var $GBLikeButton;
	
function gxtb_fb_lB_GenerateLike() {
	$this->GBLikeButton = get_option('GBLikeButton');
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  GENERATES THE LIKE-BUTTON	 ###########
###########		FB-LIKE-BUT-GENERATOR	 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
function GBLikeButtonGenerate() {
	
	global $wp_version;

	## Get Parameter ##	
	$numargs = func_num_args();
	
	## Standard - Values ##
	$this->GBLikeButton = get_option('GBLikeButton');
	
	$expert = array(); ## required for the beside-function
	$expert['besidebutton'] = true;
	$expert['div'] = true;
	$expert['socialspeedup'] = NULL;
	$expert['xfbml'] = true;
	
	$style = "";
	$enabled = true;
	$layout = $this->GBLikeButton['Generator']['layout'];
	$type = "normal";
	$url = "";
	$class = "";
	
	if ($numargs > 0) {
if (GBLikeButton_Debug && current_user_can('manage_options')) {	
	echo "<b>[DEBUG] GBLikeButtonGenerate Parameterlist</b><br /><br />";
}		
		$arg_list = func_get_args();
		if (is_array($arg_list)) {
			foreach ($arg_list[0] as $key => $value) {
				switch ($key) {
					case ($key == "url" && $value != ""):
						#preg_match('#^http:\/\/#i', substr($value,0, 8), $treffer);
						#if ($treffer != false) {
							$url= $value;
						#} else {
						#	$url = "http://" . $value;
						#}
						if(GBLikeButton_Debug && current_user_can('manage_options')) { echo "[url] => {$url}<br />"; }
					break;
					
					case ($key == "layout" && $value != ""):
						$layout = $value;
						if(GBLikeButton_Debug && current_user_can('manage_options')) { echo "[layout] => {$layout}<br />"; }
					break;
					
					case ($key == "action" && $value != ""):
						if( in_array($value, array('like', 'LIKE', 'recommend', 'RECOMMEND' )) ) {
							$action = $value;
						} else {
							$action = "like";
						}
						if(GBLikeButton_Debug && current_user_can('manage_options')) { echo "[action] => {$action}<br />"; }
					break;
					
					case ($key == "class" && $value != ""):
						$class = $value;
						if(GBLikeButton_Debug && current_user_can('manage_options')) { echo "[class] => {$class}<br />"; }
					break;
					
					case ($key == "style" && $value != ""):
							if (!is_array($arg_list[0][$key])) {
								$style = $value;
							} else {
								foreach ($arg_list[0][$key] as $keystyle => $valuestyle) {
									$style.= $keystyle.":".$valuestyle.";";
								}
							}
							if(GBLikeButton_Debug && current_user_can('manage_options')) { echo "[style] => {$style}<br />"; }
					break;
					
					case ($key == "expert" && $value != ""):
							if (is_array($arg_list[0][$key])) {
								foreach ($arg_list[0][$key] as $keyexpert => $valueexpert) {
									$expert[$keyexpert] = $valueexpert;
									if(GBLikeButton_Debug && current_user_can('manage_options')) { echo "[$key][$keyexpert] => {$valueexpert}<br />"; }
								}
							}
					break;
					
					case ($key == "width" && $value != ""):
						$width = $value;
						if(GBLikeButton_Debug && current_user_can('manage_options')) { echo "[width] => {$width}<br />"; }
					break;
					
					case ($key == "height" && $value != ""):
						$height = $value;
						if(GBLikeButton_Debug && current_user_can('manage_options')) { echo "[height] => {$height}<br />"; }
					break;
					
					case ($key == "enabled" && $value != ""):
						if($enabled == 1) { $enabled = true; }
						if($enabled == 0) { $enabled = false; }
						$enabled = $value;
					break;
					
					case ($key == "type" && $value != ""):
						$type = $value;
						if(GBLikeButton_Debug && current_user_can('manage_options')) { echo "[type] => {$type}<br />"; }
					break;
					
					default:			
					break;
				}
			}
		}
		if(GBLikeButton_Debug && current_user_can('manage_options')) { echo "<br /><br />"; }
	}
## End Get Parameter ##	

	# deactivate the like-button if the option 'fbnone' is true
	if( !is_admin()) {
		
	global $post, $wp_query;
   	$page_id = $wp_query->post->ID;
    $fbnone = get_post_meta($page_id, '_fbnone', true);
	if (!isset($enabled)) { $enabled = true; }
	
	if ($fbnone || (isset($enabled) && $enabled != true) )
		return "";
	# end deactivate the like-button
	}
	
	// get all the needed options
	$this->GBLikeButton = get_option('GBLikeButton');
			
	/* GENERATOR-CONTENT */
	$generator_content = array();
	
	#generates the link
		if (isset($url) && $url != "" && $url != NULL) {
			$generator_content['url'] = $url;
		} else if( ( is_single() || is_page() || is_category() || is_home() || is_archive() ) && $this->GBLikeButton['General']['dynamic'] == 1) {
			$generator_content['url'] = get_permalink($post->ID);
		} else if ($this->GBLikeButton['Generator']['url'] != "" && isset($this->GBLikeButton['Generator']['url'])) {
			$generator_content['url'] = $this->GBLikeButton['Generator']['url'];
		} else {
			$generator_content['url'] = (version_compare( $wp_version, '3.0', '>=' )) ? get_home_url() : get_bloginfo('siteurl');
		}
	#generates the link

	#generates the faces
	$generator_content['faces'] = $this->GBLikeButton['Generator']['faces'];
	if($generator_content['faces'] == 0)
		$generator_content['faces'] = "false";
	else
		$generator_content['faces'] = "true";
	#generates the faces

	if($type == "normal") {
		$generator_content['layout'] = $this->GBLikeButton['Generator']['layout'];
	} else if ($type == "shortcode" || $type == "template") {
		$generator_content['layout'] = (isset($layout) && $layout != "") ? $layout : $this->GBLikeButton['Generator']['layout'];
	}
	
	$generator_content['width'] = (!isset($width)) ? $this->GBLikeButton['Generator']['width'] : $width;
	$generator_content['height'] = (!isset($height)) ? $this->GBLikeButton['Generator']['height'] : $height;
	$generator_content['verb'] = (!isset($action)) ? $this->GBLikeButton['Generator']['verb'] : $action;
	$generator_content['color'] = $this->GBLikeButton['Generator']['color'];
	$generator_content['font'] = $this->GBLikeButton['Generator']['font'];
	
	// setting defaults if sth. is empty
	if ($generator_content['width'] == "") {
		$generator_content['width'] = "150";
	}

	if($this->GBLikeButton['FBInsights']['on']) {
	
		$ref = "";
	
		// generates the ref-definiton
		if ( is_home() && $this->GBLikeButton['FBInsights']['frontpage_activ'] && $this->GBLikeButton['FBInsights']['frontpage'] != "" ) {
			$ref = $this->GBLikeButton['FBInsights']['frontpage'];
		}
		if ( is_page() && $this->GBLikeButton['FBInsights']['page_activ'] && $this->GBLikeButton['FBInsights']['page'] != "" ) {
			$ref = $this->GBLikeButton['FBInsights']['page'];
		}	
		if ( is_single() && $this->GBLikeButton['FBInsights']['post_activ'] && $this->GBLikeButton['FBInsights']['post'] != "" ) {
			$ref = $this->GBLikeButton['FBInsights']['post'];
		}
		if ( is_category() && $this->GBLikeButton['FBInsights']['category_activ'] && $this->GBLikeButton['FBInsights']['category'] != "" ) {
			$ref = $this->GBLikeButton['FBInsights']['category'];
		}	
		if ( is_archive() && $this->GBLikeButton['FBInsights']['archiv_activ'] && $this->GBLikeButton['FBInsights']['archiv'] != "" ) {
			$ref = $this->GBLikeButton['FBInsights']['archiv'];
		}
	
	} // end ref-def-if
	
	$lang = $this->GBLikeButton['General']['language'];
	if ($lang == "") { $lang = "en_US"; }
	
	if( isset($this->GBLikeButton['Generator']['send']) && $this->GBLikeButton['Generator']['send'] == 1) { $send = 'true';} else { $send = "false"; }

#############################################################################################################	
// Abfrage ob JDK aktiviert ist und die App-ID vorhanden ist!
	if($this->GBLikeButton['General']['jdk'] && $this->GBLikeButton['OpenGraph']['app_id'] != "" && (is_array($expert) && isset($expert) && $expert['xfbml'] == true)) { 
	
		// generiert die Schriften für die JDK-Variante
		 if($generator_content['font'] != "") {
			 	$font = ' font="' . $generator_content['font'] . '" ';
			} else {
				 $font = '';
			}

		// generiert die FB-Insights-Analyse (REL)
		if(isset($ref) && $ref != "") {
			$ref = 'ref="'. $ref .'"';
		} else {
			$ref = "";
		}

	// Zusammenbau des fb:like-Outputs
	//$text = gxtb_fb_lB_GenerateLike::gxtb_fb_lB_java();
	/*$text .= '<script src="http://connect.facebook.net/' . $lang . '/all.js#appId='. $this->GBLikeButton['OpenGraph']['app_id'] . '&amp;xfbml=1"></script>';*/
	$text = '<fb:like href="'. $generator_content['url'] .'" layout="'. $generator_content['layout'] .'" show_faces="'. $generator_content['faces'] .'" width="'. $generator_content['width'] .'" action="'. $generator_content['verb'] .'" ' . $font .'colorscheme="'. $generator_content['color'] .'" '. $ref .' send="'. $send .'"></fb:like>';
	
	} else {
	
	################################################
	##### i-Frame ##### if JDK is not activated ####
	################################################	
	
	// security-if-statement if some array-variables are empty
	if ($this->GBLikeButton['Generator']['scrolling'] == 0 || !isset($this->GBLikeButton['Generator']['scrolling']))
		$generator_content['scrolling'] = "no";
	else 
		$generator_content['scrolling'] = "yes";
		
	if ($this->GBLikeButton['Generator']['trans'] == 0 || !isset($this->GBLikeButton['Generator']['trans']))
		$generator_content['trans'] = "false";
	else 
		$generator_content['trans'] = "true";	
	
	if($generator_content['font'] != "") {
	 
	 switch ($generator_content['font']) {
		 case "luciada grande":
			$generator_content['font'] = "lucida+grande";
		 break;
		 
		 case "segoe ui":
			$generator_content['font'] = "segoe+ui";
		 break;
		 
		 case "trebuchet ms":
			$generator_content['font'] = "trebuchet+ms";
		 break;
		 
		 default:
			$generator_content['font'] = $generator_content['font'];
		 break;
	 }
		 
	$generator_content['font'] = 'font=' . $generator_content['font'] . '&amp;'; } else { $generator_content['font'] = ''; }
	
	if ($generator_content['height'] == "") { $generator_content['height'] = "150"; }

	$generator_content['frameborder'] = $this->GBLikeButton['Generator']['frameborder'];
	if ($generator_content['frameborder'] == "") { $generator_content['frameborder'] = "0"; }
	
	$generator_content['borderstyle'] = $this->GBLikeButton['Generator']['borderstyle'];	
	if ($generator_content['borderstyle'] == "") { $generator_content['borderstyle'] = "none";	}	

	$generator_content['overflow'] = $this->GBLikeButton['Generator']['overflow'];	
	if ($generator_content['overflow'] == "" || isset($generator_content['overflow'])) { $generator_content['overflow'] = "hidden"; 	}	

	// generiert die FB-Insights-Analyse (REF)
	if(isset($ref) && $ref != "") {	$ref = '&amp;ref='. $ref; }	else { $ref = ""; }

## LIKE BUTTON OUTPUT ##
	$text = '<iframe src="http://www.facebook.com/plugins/like.php?';
	if($this->GBLikeButton['OpenGraph']['app_id'] != "" && isset($this->GBLikeButton['OpenGraph']['app_id'])) {
		$text .= 'app_id='.$this->GBLikeButton['OpenGraph']['app_id'].'&amp;';
	}
	$text .= 'href='. $generator_content['url'] .'&amp;layout='. $generator_content['layout'] .'&amp;show_faces='. $generator_content['faces'] .'&amp;width='. $generator_content['width'] .'&amp;action='. $generator_content['verb'] .'&amp;' . $generator_content['font'] . 'colorscheme='. $generator_content['color'] .'&amp;height='. $generator_content['height'] .''.$ref.''.'&amp;locale='. $lang ./*'&amp;send='. $send .*/'" scrolling="'. $generator_content['scrolling'] .'" frameborder="'. $generator_content['frameborder'] .'" allowTransparency="'. $generator_content['trans'] .'" style="border:'. $generator_content['borderstyle'] .'; overflow:'. $generator_content['overflow'] .'; width:'. $generator_content['width'] .'px; height:'. $generator_content['height'] .'px"></iframe>';
	}
	
## FINAL OUTPUT ##	
	$div = array( 'before' => $this->GBLikeButtonDiv('before', $class, $style, $expert), 'after' => $this->GBLikeButtonDiv('after', $class, $style, $expert));
	$text = $this -> gxtb_using_message() . $div['before'] . $this->besidebutton("left", $expert) . $text . $this->besidebutton("right", $expert) . $div['after'] . $this -> gxtb_using_message();

#### SOCIAL SPEED UP (BETA) #####
if(GBLikeButton_Beta && current_user_can('manage_options')) { ## activates Beta-Functions ##

	if(is_array($expert) && isset($expert) && $expert['socialspeedup'] == true) {
		$this->GBLikeButton['Functions']['Additional']['SocialSpeedUp'] = 1;
	} else if (is_array($expert) && isset($expert) && $expert['socialspeedup'] == false) {
		$this->GBLikeButton['Functions']['Additional']['SocialSpeedUp'] = 0;
	}
	
	if(isset($this->GBLikeButton['Functions']['Additional']['SocialSpeedUp']) && $this->GBLikeButton['Functions']['Additional']['SocialSpeedUp'] == 1) {
		return $this -> gxtb_using_message() . $div['before'] . $this->besidebutton("left", $expert) . "<span class='gb_socialspeed gb_likebutton_iframe {$this->GBLikeButton['Design']['css']}' src='http://www.facebook.com/plugins/like.php?href={$generator_content['url']}&amp;send={$send}&amp;layout={$generator_content['layout']}&amp;width={$generator_content['width']}&amp;show_faces={$generator_content['faces']}&amp;action={$generator_content['verb']}&amp;colorscheme={$generator_content['color']}&amp;font={$generator_content['font']}&amp;height={$generator_content['height']}&amp;locale={$lang}' style='border:{$generator_content['borderstyle']};height:{$generator_content['height']}px;width:{$generator_content['width']}px;'></span>" . $this->besidebutton("right", $expert) . $div['after'] . $this -> gxtb_using_message();
	} else {
		return $text;
	}
	
} ## if-beta
#### SOCIAL SPEED UP (BETA) #####

	return $text;
}
function GBLikeButtonDiv($div, $class, $style, $expert) {
if( ($expert['div'] != false || $expert['div'] != 0) || $class != "" ) {
	$div_before = "<div";
	$div_after = "</div>";
	$div_style = "";
		
	## CSS-CLASS ##
	$class = ($class != "") ? $class . " ":"";;
	$class .= (isset($this->GBLikeButton['Design']['css']) && $this->GBLikeButton['Design']['css'] != "") ? $this->GBLikeButton['Design']['css']:"";
	$div_before .= ($class != "") ? ' class="' . $class . '"':"";
	
	## CSS-BOX ##
	if ( isset($this->GBLikeButton['Design']['cssbox']) && $this->GBLikeButton['Design']['cssbox'] != "") {
		##$div_before .= ' style="' . $this->GBLikeButton['Design']['cssbox'] . '"';
		$div_style .=  $this->GBLikeButton['Design']['cssbox'];
	}
	## STYLE ATTRIBUTE ##
	if ($style != "" && isset($style)) {
		#$div_before .= ' style="' . $style . '"';	
		$div_style .= $style;	
	}
	if ($div_style != "") {
		$div_before .= ' style="' . $div_style . '"';	
	}
	
	// div is only available if you have at least a css-class or css-style defined
	if ( strstr($div_before, "class") || strstr($div_before, "style") )
		$div_before .= ">";
	else {
		$div_before = "";
		$div_after = "";
	}
	
	switch ($div) {
		case "before":
			return $div_before;
			break;
		case "after":
			return $div_after;
			break;	
	} // end switch
} // end if
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  EXPERT Modus Optionen		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
function besidebutton($position, $expert) {
		
	if( empty($expert) || !isset($expert['besidebutton']) || (is_array($expert) && $expert['besidebutton'] == true)) {
		$expert['besidebutton'] == true;
	}
		
	if($this->GBLikeButton['Expert']['besidebutton'] !="" && $expert['besidebutton'] == true) {
		if($position == "left" && $this->GBLikeButton['Expert']['besideposition'] == "left") {
			return $this->GBLikeButton['Expert']['besidebutton']; 
		} else if ($position == "right" && $this->GBLikeButton['Expert']['besideposition'] == "right") {
			return $this->GBLikeButton['Expert']['besidebutton'];
		}
	}	
}
####################################################
####################################################
##### YOU ARE NOT ALLOWED TO DELETE THIS LINE ######
####################################################
##################### by gb-world.net   ############
####################################################
function gxtb_using_message() {

return '
<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by Stefan Natter (http://www.gb-world.net) -->
';
}
####################################################
####################################################
##### YOU ARE NOT ALLOWED TO DELETE THIS LINE ######
####################################################
##################### by gb-world.net   ############
####################################################
} // end class
} // end if-class
?>