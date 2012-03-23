<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-Plugin-Settings-Content [v0.3 - FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       GB-World-Settings	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('gxtb_fb_lB_Settings')) {
	
class gxtb_fb_lB_Settings {
	
	var $GBLikeButton;
	
function gxtb_fb_lB_Tools() {

$tools_settings = array (
	array(	"type" => "open"),
	array(	"content" => __('Run GB-Cleaner', gxtb_fb_lB_lang),
			"tooltip" =>  __('With this GB-Cleaner App you can delete, unset and clear old options from older versions of this Plugin.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<div class="ui-widget" id="fade_gbcleaner" style="display:none;"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
				<strong>'.__("Information", gxtb_fb_lB_lang).':</strong> '. __('It is not recommended to run more than one Tool at a time! Because this could lead to serious problems.', gxtb_fb_lB_lang) .'</p></div><br></div>
<input type="Radio" class="radio gbcleaner" name="gxtb_run_cleaner" value="1"><span id="gxtb_run_cleaner"> ' . __('Execute', gxtb_fb_lB_lang) . '</span><br>
<input type="Radio" class="radio gbcleaner" name="gxtb_run_cleaner" value="0" checked> ' . __('Off', gxtb_fb_lB_lang),	
			"content" => sprintf("%s <b>(%s)</b>",
			__('If you run this Tool the GB-Cleaner will try to fix Bugs with the Settings and other stuff.', gxtb_fb_lB_lang),
			__('But keep in mind that you have to check all of your settings after you run it. Because it cleans and restores some settings!', gxtb_fb_lB_lang)),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => __('RESET Options', gxtb_fb_lB_lang),
			"tooltip" =>  __('If you activate this option and hit save all of your settings will be restored to their default value.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '
<input type="Radio" class="radio gbcleaner" name="gxtb_reset" value="1"> ' . __('Execute', gxtb_fb_lB_lang) . '<br>
<input type="Radio" class="radio gbcleaner" name="gxtb_reset" value="0" checked> ' . __('Off', gxtb_fb_lB_lang),		
			"content" => __('If you activate this option and hit save all of your settings will be <b>restored</b> to their default value.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
			
/* 	array(	"content" => sprintf("%s <small>(%s)</small>", __('DELETE Options', gxtb_fb_lB_lang), __('including Widget-Settings', gxtb_fb_lB_lang)),
			"tooltip" =>  __('With this GB-Cleaner App you can delete, unset and clear old options from older versions of this Plugin.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '
<input type="Radio" class="radio gbcleaner" name="gxtb_delete" value="1"> ' . __('Execute', gxtb_fb_lB_lang) . '<br>
<input type="Radio" class="radio gbcleaner" name="gxtb_delete" value="0" checked> ' . __('Off', gxtb_fb_lB_lang),		
			"content" => sprintf("%s <b>(%s)</b>",
			__('If you run this Tool the GB-Cleaner will delete all Settings.', gxtb_fb_lB_lang),
			__('This is only recommended if you wish to uninstall this plugin and clean up your WP-Options.', gxtb_fb_lB_lang)),
			"smalltip" => "",
            "type" => "content"),
*/
	array(	"content" => __('Run GB-Widget-Cleaner', gxtb_fb_lB_lang),
			"tooltip" =>  __('With this GB-Widget-Cleaner App you can delete, unset and clear old widget-options from older versions of this Plugin.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '
<input type="Radio" class="radio gbcleaner" name="gxtb_run_widgetcleaner" value="1"> ' . __('Execute', gxtb_fb_lB_lang) . '<br>
<input type="Radio" class="radio gbcleaner" name="gxtb_run_widgetcleaner" value="0" checked> ' . __('Off', gxtb_fb_lB_lang),	
			"content" => __('If you run this Tool the GB-Widget-Cleaner will try to fix Bugs with the Widget-Settings and other stuff. <b>But keep in mind that you have to check all of your settings after you run it. Because it cleans and restores some settings!</b>', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => __('RESET Widget-Options', gxtb_fb_lB_lang),
			"tooltip" =>  __('If you activate this option and hit save all of your settings will be reset to the value 0 or empty.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '
<input type="Radio" class="radio gbcleaner" name="gxtb_widgetreset" value="1"> ' . __('Execute', gxtb_fb_lB_lang) . '<br>
<input type="Radio" class="radio gbcleaner" name="gxtb_widgetreset" value="0" checked> ' . __('Off', gxtb_fb_lB_lang),	
			"content" => __('If you activate this option and hit save all of your settings will be reset to the value 0 or empty.', gxtb_fb_lB_lang) . __(' Notice: You will loose all your Widget-Settings if you run this Option.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
			
			
	array(	"type" => "close")
);

$this -> GBLikeButton_SettingOutput($tools_settings);

}
	
function gxtb_fb_lB_Setting() {
	
	$this->GBLikeButton = get_option('GBLikeButton');
	
## General-Settings ##
$gxtb_fb_lB = get_option('gxtb_fb_lB');
$gxtb_fb_lB_warning = get_option('gxtb_fb_lB_warning');

$settings_options = array (
	array(	"type" => "open"),
			
	array(	"content" => __("User-Level", gxtb_fb_lB_lang),
			"tooltip" =>  __('required Userlevel to change any settings', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<SELECT NAME="pluginsetting_Userlevel" id="pluginsetting_Userlevel">'.

$this->GetSettings('userlevel')
	
	.'</SELECT>',	
			"content" => __('Set the required userlevel to access any Backend site and also the Adminbar-Menu of this plugin.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => __("Plugin-Priority", gxtb_fb_lB_lang),
			"tooltip" =>  __('Set the priority of this Plugin comparing to other plugins. This will help you to choose the Output-Positon relative to other Plugin-Outputs.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<SELECT NAME="pluginsetting_Priority" id="pluginsetting_Priority">'.

$this->GetSettings('priority')
	
	.'</SELECT>',	
			"content" => __('Set the priority of this Plugin comparing to other plugins. This will help you to choose the Output-Positon relative to other Plugin-Outputs.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
						
	array(	"type" => "close")			

);
$this -> GBLikeButton_SettingOutput($settings_options);
} // end function

function gxtb_fb_lB_Functions() {
$editor_settings = array (
	array(	"type" => "open"),
	
	array(	"content" =>  __("Like Button", gxtb_fb_lB_lang),
			"tooltip" => __('Activate this checkbox if you want that your Like-Button appears on your blog.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_LikeButton" '. $this->GetSettings(array("Functions", "General", "LikeButton")) .' id="pluginsetting_LikeButton" /> ',	
			"content" => __('Acivate this option if you would like to activate the Like-Button Output according to your settings.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),	
	
	array(	"content" =>  __("Open-Graph Metatag Output", gxtb_fb_lB_lang),
			"tooltip" =>  __('It is not recommended to deactivate the OpenGraph Output because the Plugin generates very individual and very dynamic OpenGraph Tags.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_OpenGraph" '. $this->GetSettings(array("Functions", "General", "OpenGraph")) .' id="pluginsetting_OpenGraph" /> ',	
			"content" => __('Deactivate this Option if another Plugin already creates the OpenGraph Metatags or you just do not need/want it.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),		
	
	array(	"content" => __("Template Function", gxtb_fb_lB_lang),
			"tooltip" =>  __('Activate the Template-Function', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_TemplateFunction" '. $this->GetSettings(array("Functions", "General", "TemplateFunction")) .' id="pluginsetting_TemplateFunction" /> ',	
			"content" => __('Activate this option if you would like to use the TemplateFunction of this plugin.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),		
	
	array(	"content" =>  __("Shortcode", gxtb_fb_lB_lang),
			"tooltip" =>  __('Activate the Shortcode [like] of this plugin.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_Shortcode" '. $this->GetSettings(array("Functions", "General", "Shortcode")) .' id="pluginsetting_Shortcode" /> ',	
			"content" => __('Activate this option if you would like to use the [like]-Shortcode of this plugin.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),			
	
	array(	"content" =>  __("Widgets", gxtb_fb_lB_lang),
			"tooltip" =>  __('Activate the Widgets of this plugin.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_Widget" '. $this->GetSettings(array("Functions", "General", "Widget")) .' id="pluginsetting_Widget" /><a name="widget">&nbsp;</a>',	
			"content" => __('Activate this option if you would like to use the Widgets of this plugin.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),		
			
	array(	"type" => "close")		
);
$this -> GBLikeButton_SettingOutput($editor_settings);
} // end function

function gxtb_fb_lB_EditorSettings() {
$editor_settings = array (
	array(	"type" => "open"),			
	
	array(	"content" =>  __("Social Button Analysis (QuickEdit)", gxtb_fb_lB_lang),
			"tooltip" =>  __('Activate this option if you like to have a little Social Media Montitoring Tool on the Page/Post-List Screen.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_QuickEdit" '. $this->GetSettings(array("Functions", "Editor", "QuickEdit")) .' id="pluginsetting_QuickEdit"/> ',	
			"content" => __('Activate this option if you like to have a little Social Media Montitoring Tool on the Page/Post-List Screen.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
	
	array(	"content" => __("Post-Button", gxtb_fb_lB_lang),
			"tooltip" =>  __('You can activate or deactivate the Post-Button on the TinyMCE-Menu.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_PostButton" '. $this->GetSettings(array("Functions", "Editor", "PostButton")) .' id="pluginsetting_PostButton" disabled="disabled" /> ',	
			"content" => __('You can either choose if you want to have a Shortbutton on the Post/Page Editor TinyMCE menu or not.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
	
	array(	"content" =>  __("Editor-Widget", gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_EditorWidget" '. $this->GetSettings(array("Functions", "Editor", "EditorWidget")) .' id="pluginsetting_IndividualPost" disabled="disabled" /><a name="editorwidget">&nbsp;</a>',	
			"content" => __('If you deactivate this option it is not possible anymore to define individual options for post and pages or even disable the button easily from the Editor Page.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),	
	
	array(	"content" =>  __("Editor-Widget Options", gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => "<input type='checkbox' class='checkbox' name='pluginsetting_EditorWidget_Settings_featured' ". $this->GetSettings(array("Functions", "Editor", "EditorWidget_Settings", "featured")) ." onmouseover='tooltip.show('". __('If you acivate this Option the default image will appear on this type of page.', gxtb_fb_lB_lang ) ."');' onmouseout='tooltip.hide();' value='1'/> ". __('Always use Featured image', gxtb_fb_lB_lang ) ." <small>(". __('if possible', gxtb_fb_lB_lang) .")</small>",	
			"content" => "",
			"smalltip" => "",
            "type" => "content"),
			
	array(	"type" => "close")		
);
$this -> GBLikeButton_SettingOutput($editor_settings);
} // end function

function gxtb_fb_lB_Additional() {
$editor_settings = array (
	array(	"type" => "open"),
	
	array(	"content" => __("Dashboard", gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_Dashboard" '. $this->GetSettings(array("Functions", "Additional", "Dashboard")) .' id="pluginsetting_Dashboard" /> ',	
			"content" => __('Activate or Deactivate the Dashboard-Analytics-Box of your Blog-Activiy.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),	
	
	array(	"content" => __("WP-Admin Menu", gxtb_fb_lB_lang),
			"tooltip" =>  __('If you activate this option the Menu in the WP-Admin-Bar will be visible for admins.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_FrontendMenu" '. $this->GetSettings(array("Functions", "Additional", "FrontendMenu")) .' id="pluginsetting_FrontendMenu" /> ',	
			"content" => __('Activate this option if you would like to use and activate the WP-Admin-Menu of this plugin.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),		
	
	array(	"content" =>  __("W3C-Validated Code Output", gxtb_fb_lB_lang),
			"tooltip" =>  __('If you activate this option the Menu in the WP-Admin-Bar will be visible for admins.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<div class="ui-widget" id="fade_w3c" style="display:none;"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
				<strong>'.__("Important", gxtb_fb_lB_lang).':</strong> '. __('When this option is activated the Facebook URL Linter will not work because only the Crawler and logged in admins will see the Meta-Tags!', gxtb_fb_lB_lang) .'</p></div><br></div> <input type="checkbox" class="checkbox" value="1" name="pluginsetting_w3c" '. $this->GetSettings(array("Functions", "Additional", "w3c")) .' id="pluginsetting_w3c" /> ',	
			"content" => __('When you activate this option the meta tags will only appear on your blog if the Facebook Crawler is visiting/caching your site! Nobody else (except if you are an admin and logged in) will see it anymore.', gxtb_fb_lB_lang) . '<br />'.
          	sprintf( '<b>%s:</b> %s!', __('Important', gxtb_fb_lB_lang), __('When this option is activated the Facebook URL Linter will not work because only the Crawler and logged in admins will see the Meta-Tags', gxtb_fb_lB_lang)),
			"smalltip" => "",
            "type" => "content"),	
	
	array(	"content" => __("Message", gxtb_fb_lB_lang),
			"tooltip" =>  __('If you activate this Option all the Notifications/Messages will appear.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_Message" '. $this->GetSettings(array("Functions", "Additional", "Message")) .' id="pluginsetting_Message" /> ',	
			"content" => __('If you activate this Option all the Notifications/Messages will appear.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),		

## SOCIAL SPEED UP BETA ##
/*   array(	"content" => __("GB-World.net - SocialSpeedUp", gxtb_fb_lB_lang),
			"tooltip" =>  __('If you activate this option the plugin will use the GB-World SocialSpeedUp-jQuery-Library to speed up the output of the Social Media Buttons', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" value="1" name="pluginsetting_SocialSpeedUp" '. $this->GetSettings(array("Functions", "Additional", "SocialSpeedUp")) .' id="pluginsetting_SocialSpeedUp" /> ',	
			"content" => sprintf('%s <a href="http://wiki.gb-world.net/wiki/GB-Wiki:Social-Speed-Up" class="fancylink_iframe" target="_blank">%s</a> %s', __('If you activate this option the plugin will use the', gxtb_fb_lB_lang), __('GB-World SocialSpeedUp-jQuery-Library', gxtb_fb_lB_lang), __('to speed up the output of the Social Media Buttons.', gxtb_fb_lB_lang)),
			"smalltip" => "",
            "type" => "content"),	
*/	
	array(	"type" => "close")		
);

$this -> GBLikeButton_SettingOutput($editor_settings);
} // end function


protected function GetSettings($type) {

$output = ""; #"Functions", "Editor", "Settings", "featured"
switch ($type) {
	
	case ($type == "userlevel" && isset($this->GBLikeButton['PluginSetting']['Userlevel'])):
/* Einstellungs-Arrays */
$userlevel = array('Administrator', 'Editor', 'Author', 'Contributor');
	foreach ($userlevel as $value) {
		if(strtolower($value) == $this->GBLikeButton['PluginSetting']['Userlevel']) {
			$output .= '<OPTION selected value="'. $value .'">'. $value .'</OPTION>';
		} else {
			$output .= '<OPTION value="'. $value .'">'. $value .'</OPTION>';
		}
	}
	break;
	
	case ($type == "priority" && isset($this->GBLikeButton['PluginSetting']['Priority'])):
	for ($count = 100; $count >= 0; $count--) {
		if($count == $this->GBLikeButton['PluginSetting']['Priority']) {
			$output .= '<OPTION selected value="'. $count .'">'. $count .'</OPTION>';
		} else {
			$output .= '<OPTION value="'. $count .'">'. $count .'</OPTION>';
		}
	}
	break;
	
	case (is_array($type) && $type[0] == "Functions"):
	
	if(isset($type[3])) {
		if(isset($this->GBLikeButton[$type[0]][$type[1]][$type[2]][$type[3]]) && $this->GBLikeButton[$type[0]][$type[1]][$type[2]][$type[3]] == 1) {
			$output = "checked";
		}
	}
	else if (isset($this->GBLikeButton[$type[0]][$type[1]][$type[2]]) && $this->GBLikeButton[$type[0]][$type[1]][$type[2]] == 1) {
		$output = "checked";
	}
	break;
	
	case (is_array($type) && $type[0] == "General"):
	if (isset($this->GBLikeButton[$type[0]][$type[1]]) && $this->GBLikeButton[$type[0]][$type[1]] == 1) {
		$output = "checked";
	}
	break;
	
	default:
	break;
}
return $output;	
}
protected function GBLikeButton_SettingOutput($option) {
	foreach ($option as $value) { 
		
		switch ( $value['type'] ) {
	
		case "open":
		?>
        <table class="form-table" width="100%">
		<?php break;
		case "title":
		?>
		<tr>
        <td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php if(isset($value['tooltip']) && $value['tooltip'] != "") { ?> <span class="hotspot" onmouseover="tooltip.show('<?php echo $value['tooltip']; ?>');" onmouseout="tooltip.hide();">
            <?php echo $value['content']; ?></span> <?php }else{ echo $value['content']; } ?>
        </strong></td>
		<?php break;
		case 'content':
		?>                        
        <td width="80%" valign="middle">
			<?php echo $value['input']; ?>
            <br />
            <?php echo $value['content']; ?>
        </td>
        </tr>          
        <tr>
           <td class="gb-table-tipp"><small>
		   		<?php echo $value['smalltip']; ?>
            </small></td>
        </tr>
		<?php 
		break;
			case 'tooltip':
		?>
        	<span class="hotspot" onmouseover="tooltip.show('<?php echo $value['content']; ?>');" onmouseout="tooltip.hide();">
		<?php 
		break;
		case "close":
		?>
			</table>
		<?php break;		
		} // end switch
	} // end foreach
} // end function
} // end class
} // end if-class
?>