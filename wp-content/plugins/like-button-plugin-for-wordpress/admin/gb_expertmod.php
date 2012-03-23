<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-Expertmod [v0.5 - FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       EXPERT-MODE			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net ##############
####################################################
if (!class_exists('gxtb_fb_lB_EXMClass')) {
include( dirname(dirname(__FILE__)) . '/include/gb_generate.php' );
class gxtb_fb_lB_EXMClass extends gxtb_fb_lB_GenerateLike{
	
	var $GBLikeButton;
	var $GBLikeButtonWidget;
	var $pagehook;
	
function gxtb_fb_lB_EXMClass() {
	
	add_filter('screen_layout_columns', array(&$this, 'on_screen_layout_columns'), 10, 2);
	$this->pagehook = add_submenu_page("fb-like-button", 'FB-Expert-Mode', __('Expert-Mode', gxtb_fb_lB_lang), 'administrator', 'fb-like-expert', array(&$this, 'on_show_page'));
	add_action('load-'.$this->pagehook, array(&$this, 'on_load_page'));
	
	global $screen_layout_columns;
	$screen_layout_columns = 2;
	$this->GBLikeButton = get_option('GBLikeButton');
	$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');
}

function on_screen_layout_columns($columns, $screen) {
		if ($screen == $this->pagehook) {
			$columns[$this->pagehook] = 2;
		}
		return $columns;
}

function on_load_page() {
	add_meta_box('gb_fb_expert', __('FB-Expert Mod', gxtb_fb_lB_lang), array(&$this, 'gb_expert'), $this->pagehook, 'first', 'core');	
	add_meta_box('gb_fb_beta', __('Beta-Functions and requested Functions [v'. gxtb_fb_lB_version .']', gxtb_fb_lB_lang), array(&$this, 'gb_beta'), $this->pagehook, 'second', 'core');
}

function on_show_page() {
include_once('gb_admin_sidebar.php');
global $screen_layout_columns;
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<form method="post" class="formlyWrapper-Base gb_expertform" action="<?php echo admin_url( 'admin.php?page=fb-like-expert' ); ?>" name="settingpage" id="settingpage" class="settingpage">
<?php gb_admin_header::gb_admin_title(); ?> 
<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
		<div id="poststuff" class="metabox-holder" style="width: 100%;">
				<!-- Sidebar -->
				<div id="side-info-column" class="inner-sidebar">
					<?php
					    do_meta_boxes($this->pagehook, 'additional_fb', "");
						do_meta_boxes($this->pagehook, 'additional_support', "");
						do_meta_boxes($this->pagehook, 'additional_development', "");
						do_meta_boxes($this->pagehook, 'additional_fb_activity', "");
						do_meta_boxes($this->pagehook, 'additional_bugs', "");
						do_meta_boxes($this->pagehook, 'additional_fans', "");
						do_meta_boxes($this->pagehook, 'additional_settings', "");
					?>
				</div>
				<!-- /Sidebar -->
				<!-- Content -->
					<div id="post-body" class="has-sidebar" style="background-color:#eeeeee;">
						<div id="post-body-content" class="has-sidebar-content">
							<?php do_meta_boxes($this->pagehook, 'first', ""); ?>	
                            <?php do_meta_boxes($this->pagehook, 'second', ""); ?>				
						</div><?php 
									include('gb_submit.php');
								?>
					</div>
				<!-- /Content -->
				<br class="clear"/>
		</div>
<div class="plugin-version">
	<a href="#plugininfo" class="fancylink" title="Created by Stefan N."><?php echo gxtb_fb_lB_name; ?> - v<?php echo gxtb_fb_lB_version; ?></a>
</div>&nbsp;
</div>
</div>
<?php
	include('gb_admin_footer.php');
} // end konstruktor
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      CALLBACK METHODS		 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################

function gb_expert() {
	$this->GBLikeButton = get_option('GBLikeButton');
	$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');
?>
<table class="form-table gb-table">
	<tbody>
        <tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('Debug Options', gxtb_fb_lB_lang ); ?>
				</strong>
			</td>		
            <td width="80%" valign="middle">
<textarea name="GBLikeButton_Options" readonly="readonly"><?php if(!empty($this->GBLikeButton)) {
$string = "";
foreach ($this->GBLikeButton as $key => $value) { 

if(/*$key != "PluginSetting" && */ $key != "PluginInfo") {
#$string.= "" . $key . " => " . $value;
if ( is_array($value) ) {
$string.= $key . "";
} else {
$string.= $key . " => ";
}
$string.= "\n";

	foreach ($this->GBLikeButton[$key] as $key1 => $value1) { 
	
	if($key == "PluginSetting" && $key1 == "Message") { break; }
	
		switch ($key1) {
			
			case (in_array($key1, array("General", "Editor", "Additional"))):
				$string.= "  " . $key1 . "";
				$string.= "\n";
			
					foreach ($this->GBLikeButton[$key][$key1] as $function => $value) { 
						if($function != "EditorWidget_Settings") $string.= "    " . $function . " => ";
						
						if($function == "EditorWidget_Settings") {
							$string.= "    " . $function;
							$string.= "\n";
							
							foreach ($this->GBLikeButton[$key][$key1][$function] as $settings => $settingsvalue) {
								$string.= "        " . $settings . " => ";
								switch ($settingsvalue) {
								case ($settingsvalue == "" || !isset($value)):
									$string.="not set";
									break;
								case "0":
								case "off":
									$string.="false";
									break;
								case "1":
								case "on":
									$string.="true";
									break;
								default:
									$string.=$value;
									break;	
								}
							}
						} else {
							switch ($value) {
								case ($value == "" || !isset($value)):
									$string.="not set";
									break;
								case "0":
								case "off":
									$string.="false";
									break;
								case "1":
								case "on":
									$string.="true";
									break;
								default:
									$string.=$value;
									break;	
							}
						}
						$string.= "\n";
					}
			break;
	
			default:
				$string.= "   " . $key1 . " => ";
				
				switch ($value1) {
					case ($value1 == "" || !isset($value1)):
						$string.="not set";
						break;
					case "0":
					case "off":
						$string.="false";
						break;
					case "1":
					case "on":
						$string.="true";
						break;
					default:
						$string.=$value1;
						break;	
				}
				$string.= "\n";
			break;
		}
	}
}
}
echo $string; } ?></textarea>
             </td>
        </tr>
        <tr>
            <td class="gb-table-tipp">
			</td>
        </tr>
		
		 <tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('Debug Widget-Options', gxtb_fb_lB_lang ); ?>
				</strong>
			</td>		
            <td width="80%" valign="middle">
<textarea name="GBLikeButtonWidget_Options" readonly="readonly"><?php if(!empty($this->GBLikeButtonWidget)) {
$string = "";
foreach ($this->GBLikeButtonWidget as $key => $value) { 
if ( is_array($value) ) {
$string.= $key . "";
} else {
$string.= $key . " => ";
}
$string.= "\n";
	foreach ($this->GBLikeButtonWidget[$key] as $key1 => $value1) { 
				$string.= "   " . $key1 . " => ";
				switch ($value1) {
					case ($value1 == "" || !isset($value1)):
						$string.="not set";
						break;
					case "0":
					case "off":
						$string.="false";
						break;
					case "1":
					case "on":
						$string.="true";
						break;
					default:
						$string.=$value1;
						break;	
				}
				$string.= "\n";
	}

}
echo $string; } ?></textarea><br /><br />
<?php echo '
<div class="ui-widget" id="fade_import" style="display:none;"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
				<strong>'.__("Important", gxtb_fb_lB_lang).':</strong> '. __('Import is currently not available. It will be available soon!', gxtb_fb_lB_lang) .'</p></div><br /></div>'; ?>
<a class="button-primary gbexpert_button gbtools_export"><?php _e("Export Settings", gxtb_fb_lB_lang ); ?></a>
<span class="button-primary gbexpert_button gbtools_import" onclick="this.removeAttribute('href');"><?php _e("Import Settings", gxtb_fb_lB_lang ); ?></span>
             </td>
        </tr>
        <tr>
            <td class="gb-table-tipp">
			</td>
        </tr> 
	</tbody>
</table>

<?php
} // end function

function gb_beta() {
global $wp_version;
?>
<table class="form-table gb-table">
	<tbody>
<?php
	if (version_compare( $wp_version, '3.0', '>=' ) ) {   
?> 
         <tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('Beta-Functions Information', gxtb_fb_lB_lang ); ?>
				</strong>
			</td>		
            <td width="80%" valign="middle">
			<?php _e('As you can see below there are some options you can use now at your own risk to extend some functions of this plugin. But keep in mind that this are just Beta-Functions and no release stuff. This options may be implemented later if the demand is high enough to complete it.', gxtb_fb_lB_lang ); ?>
             </td>
        </tr>
        <tr>
            <td class="gb-table-tipp">
			</td>
        </tr><tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('Custom Channel URL', gxtb_fb_lB_lang ); ?>
				</strong>
			</td>		
            <td width="80%" valign="middle">
			<input name="expert_customchannel" type="text" value="<?php if (isset($this->GBLikeButton['Expert']['customchannel']) && $this->GBLikeButton['Expert']['customchannel'] != "") {echo $this->GBLikeButton['Expert']['customchannel'];} else {echo "";} ?>" size="40" maxlength="100"/>
             </td>
        </tr>
        <tr>
            <td class="gb-table-tipp">
<div class="accordionButton"><?php _e('Explanation', gxtb_fb_lB_lang ); ?></div>
<div class="accordionContent">
 This is an option that can help address three specific known issues. First, when auto playing audio/video is involved, the user may hear two streams of audio because the page has been loaded a second time in the background for cross domain communication. Second, if you have frame busting code, then you would see a blank page. Third, this will prevent inclusion of extra hits in your server-side logs.
<br />
<span class="note">Source:</span> <a href="https://developers.facebook.com/docs/reference/javascript/FB.init/" target="_blank">Facebook, July 2011</a>
</div>
<div class="accordionButton"><?php _e('How-To', gxtb_fb_lB_lang ); ?></div>
<div class="accordionContent">
The channelUrl MUST be a fully qualified absolute URL. If you modify the document.domain, it is your responsibility to make the same document.domain change in the channel.html file as well. Remember the protocols must also match. If your application is https, your channelUrl must also be https. Remember to use the matching protocol for the script src as well. You MUST send valid Expires headers and ensure the channel file is cached by the browser. We recommend caching indefinitely. This is very important for a smooth user experience, as without it cross domain communication becomes very slow.
<br />
<br />
Important: If you do not specify a custom channelUrl, you should remove the following from your logs to ensure proper counts
<br />
<br />
<ul class="gb-faq">
<li>Matches against user-agent: "facebookexternalhit/*"</li>
<li>Pageviews containing "fb_xd_bust" or "fb_xd_fragment"</li>
<li>Track clicks from FB-hosted iframes separately from referrers (https://www.facebook.com/plugins/ https://www.facebook.com/plugins/like.php</li>
</ul>
<br />
<span class="note">Source:</span> <a href="https://developers.facebook.com/docs/reference/javascript/FB.init/" target="_blank">Facebook, July 2011</a>
</div> 
			</td>
       </tr>
    
		<tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('Add something beside the Like-Button', gxtb_fb_lB_lang ); ?>
				</strong>
                <br />
                <input type='Radio' class="radio" Name='expert_besideposition' value='left' <?php if(isset($this->GBLikeButton['Expert']['besideposition']) && $this->GBLikeButton['Expert']['besideposition'] == "left") echo "checked"; ?> > <?php _e('left', gxtb_fb_lB_lang ); ?>
                <br />
                <input type='Radio' class="radio" Name='expert_besideposition' value='right' <?php if(isset($this->GBLikeButton['Expert']['besideposition']) && $this->GBLikeButton['Expert']['besideposition'] == "right") echo "checked"; ?> > <?php _e('right', gxtb_fb_lB_lang ); ?>
			</td>		
            <td width="80%" valign="middle">
<textarea name="expert_besidebutton" id="expert_besidebutton"><?php if(isset($this->GBLikeButton['Expert']['besidebutton']) && $this->GBLikeButton['Expert']['besidebutton'] != "") { echo stripslashes($this->GBLikeButton['Expert']['besidebutton']); } ?></textarea><br />
<?php _e('You can either add some html-stuff into this box or a simple text.', gxtb_fb_lB_lang ); ?>
             </td>
        </tr>
        <tr>
            <td class="gb-table-tipp">
			</td>
       </tr>
         <tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('Add other Buttons', gxtb_fb_lB_lang ); ?> <small>(<?php _e('More coming soon!', gxtb_fb_lB_lang ); ?>)</small>
				</strong>
			</td>		
            <td width="80%" valign="middle">
			<?php echo '<a class="button-primary gbexpert_button" id="gbexpert_side">'.__("Blog-Specific Like Button", gxtb_fb_lB_lang ).'</a>'; ?><br />
<br />
<?php #echo '<a class="button-primary gbexpert_button" id="stumbleupon" >Stumbleupon</a>'; ?> <?php echo '<a class="button-primary gbexpert_button" href="https://twitter.com/about/resources/followbutton" target="_blank">'.__("Follow Button", gxtb_fb_lB_lang ).'</a>'; ?>
<?php echo '<a class="button-primary gbexpert_button" href="http://twitter.com/about/resources/tweetbutton" target="_blank">'.__("Tweet Button", gxtb_fb_lB_lang ).'</a>'; ?>
<br />
<br />
<?php echo '<a class="button-primary gbexpert_button" href="http://about.digg.com/downloads/button/smart" target="_blank">'.__("Digg Button", gxtb_fb_lB_lang ).'</a>'; ?> <?php echo '<a class="button-primary gbexpert_button" href="http://www.stumbleupon.com/badges/" target="_blank">'.__("StumpleUpon Button", gxtb_fb_lB_lang ).'</a>'; ?>
<br />
<br />
<?php echo '<a class="button-primary gbexpert_button" href="http://www.evernote.com/about/developer/sitememory/#a_builder" target="_blank">'.__("Evernote Button", gxtb_fb_lB_lang ).'</a>'; ?>
<?php echo '<a class="button-primary gbexpert_button" href="http://www.google.com/intl/de/webmasters/+1/button/index.html" target="_blank">'.__("+1 Button", gxtb_fb_lB_lang ).'</a>'; ?>
<div style="display:none;" id="blogspecificbutton"><?php 
	if ( version_compare( $wp_version, '3.0', '>=' ) ) {
		$siteurl = home_url();
	} else {
		$siteurl = get_bloginfo('home');
	}
#echo htmlspecialchars($this->GBLikeButtonGenerate(array('url' => $siteurl, 'expert' => array( 'besidebutton' => false, 'div' => false))));
echo $this->GBLikeButtonGenerate(array('url' => $siteurl, 'expert' => array( 'besidebutton' => false, 'div' => false, 'socialspeedup' => false, 'xfbml' => false)));
?></div>
<?php
if(GBLikeButton_Beta) { ## activates Beta-Functions ##
$this->GBLikeButton = get_option('GBLikeButton');
if(isset($this->GBLikeButton['Functions']['Additional']['SocialSpeedUp']) && $this->GBLikeButton['Functions']['Additional']['SocialSpeedUp'] == 1) { ?>
<div style="display:none;" id="socialbutton_like"><?php 
	if ( version_compare( $wp_version, '3.0', '>=' ) ) {
		$siteurl = home_url();
	} else {
		$siteurl = get_bloginfo('home');
	}
#echo htmlspecialchars($this->GBLikeButtonGenerate(array('url' => $siteurl, 'expert' => array( 'besidebutton' => false, 'div' => false))));
echo $this->GBLikeButtonGenerate(array('url' => $siteurl, 'expert' => array( 'besidebutton' => false, 'div' => false, 'socialspeedup' => true)));
?></div>
             </td>
        </tr>
        <tr>
            <td class="gb-table-tipp">
			</td>
        </tr>
         <tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php echo sprintf("'%s' %s", __("Social Speed Up", gxtb_fb_lB_lang ), __("Buttons", gxtb_fb_lB_lang)); ?>
				</strong>
			</td>		
            <td width="80%" valign="middle">
			<?php echo '<a class="button-primary gbexpert_button" id="gbexpert_button_like">'.__("Like Button", gxtb_fb_lB_lang ).'</a>'; ?>
			<?php echo '<a class="button-primary gbexpert_button" id="gbexpert_button_tweet">'.__("Tweet Button", gxtb_fb_lB_lang ).'</a>'; ?><br /><br />
			<?php echo '<a class="button-primary gbexpert_button" id="gbexpert_button_digg">'.__("Digg Button", gxtb_fb_lB_lang ).'</a>'; ?>
			<?php echo '<a class="button-primary gbexpert_button" id="gbexpert_button_stumpleupon">'.__("StumpleUpon Button", gxtb_fb_lB_lang ).'</a>'; ?><br /><br />
			<?php echo '<a class="button-primary gbexpert_button" id="gbexpert_button_plusone">'.__("+1 Button", gxtb_fb_lB_lang ).'</a>'; ?>
             </td>
        </tr>
        <tr>
            <td class="gb-table-tipp">
           	 	<?php echo sprintf("%s <a href='http://wiki.gb-world.net/wiki/GB-Wiki:Social-Speed-Up' class='fancylink_iframe' target='_blank'>%s<a>", __("Please read through the official 'Social Speed Up' [developed GB-World.net] Documentation for more Information and Help:", gxtb_fb_lB_lang ),
					__("'Social Speed Up' Documentation", gxtb_fb_lB_lang )); ?>
			</td>
        </tr>
<?php } ## if-beta ?>        
<?php } ## if-social-speedup ?>
<?php } else { ?>
         <tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('Beta-Functions Information', gxtb_fb_lB_lang ); ?>
				</strong>
			</td>		
            <td width="80%" valign="middle">
			<?php _e('The Beta-Functions and also the requested Functions are only available if you have Wordpress 3.x or higher.', gxtb_fb_lB_lang ); ?>
             </td>
        </tr>
        <tr>
            <td class="gb-table-tipp">
			</td>
        </tr>
<?php } ?>
	</tbody>
</table>

<?php
} // end function
} // end class
} // end if-class

/* 
OFFEN:
+ http://de2.php.net/manual/de/function.str-rot13.php#93385
+ Output-Variable für Fehlersuche (Textbox mit diesem Output unten und dies soll für Fehlersuche verwendet werden
<?php 

foreach ($this->GBLikeButton as $key => $value) { 
echo $key . " => " . $value;
echo "<br>";
	foreach ($this->GBLikeButton[$key] as $key1 => $value1) { 
				echo $key1 . " => " . $value1;
				echo "<br>";
				if($key1 == "Message") {
				foreach ($this->GBLikeButton[$key][$key1] as $key2 => $value2) { 
					echo $key2 . " => " . $value2;
					echo "<br>";
				}
				}
	}
}
?>
*/
?>