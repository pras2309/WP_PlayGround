<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.5] - GB-MESSAGE-SYSTEM [v0.5 FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       GB-MESSAGE-SYSTEM  	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if(!class_exists('GBMessage')) {
class GBMessage {
	
	public $message, $type, $title;
	var $GBLikeButton;
	
function GBMessage_Init() {

	$this->GBLikeButton = get_option('GBLikeButton');
	
	if(isset($this->GBLikeButton['Functions']['Additional']['Message']) && $this->GBLikeButton['Functions']['Additional']['Message'] != 1) { return; }
	
if( (
isset($this->GBLikeButton['PluginSetting']['Message']['Update']) || 
isset($this->GBLikeButton['PluginSetting']['Message']['Installation']) || 
isset($this->GBLikeButton['PluginSetting']['Message']['Help']) || 
isset($this->GBLikeButton['PluginSetting']['Message']['Support'])) && (
$this->GBLikeButton['PluginSetting']['Message']['Update'] > 0 ||
$this->GBLikeButton['PluginSetting']['Message']['Installation'] > 0 ||
$this->GBLikeButton['PluginSetting']['Message']['Help'] > 0  ||
$this->GBLikeButton['PluginSetting']['Message']['Support'] > 0)
) {  
	#$this->GBMessage_Incompability(); # solved via the gb-info.js file #
	$this->GBMessage_Generate();

	if($this->GBLikeButton['PluginSetting']['Message']['Update'] >= 1)
		$this->GBLikeButton['PluginSetting']['Message']['Update'] -= 1;
	
	if($this->GBLikeButton['PluginSetting']['Message']['Installation'] >= 1)
		$this->GBLikeButton['PluginSetting']['Message']['Installation'] -= 1;
	
	if($this->GBLikeButton['PluginSetting']['Message']['Help'] >= 1)
		$this->GBLikeButton['PluginSetting']['Message']['Help'] -= 1;
	
	if($this->GBLikeButton['PluginSetting']['Message']['Support'] >= 1)
		$this->GBLikeButton['PluginSetting']['Message']['Support'] -= 1;
	
	update_option('GBLikeButton', $this->GBLikeButton);

} # end if Abfrage
} // end constructor

function GBMessage_Incompability() {
	/* 
	$plugin = "disqus-comment-system/disqus.php";
	if(is_plugin_active($plugin) && ($this->GBLikeButton['PluginSetting']['Message']['Installation'] > 0 || $this->GBLikeButton['PluginSetting']['Message']['Help'] > 0)) {
		$this->message .= sprintf( '<br /><p><b>%s:</b> %s <i><b>%s</b></i> %s! <small>[%s]</small></p>', __('Warning', gxtb_fb_lB_lang), __('If you use the Plugin', gxtb_fb_lB_lang), "Disqus Comment System", __('you will probably have problems accessing other tabs then the first one on the several pages. You can fix that if you temporary deactivate Disqus and reactivate it again after you saved your settings of this Plugin! Disqus is already informed to make an update of their plugin.', gxtb_fb_lB_lang), __('Plugin Incompatibility', gxtb_fb_lB_lang) );
	} */	
}
function GBMessage_Generate() {
		
		$this->GBLikeButton = get_option('GBLikeButton');

$text = "";	
				foreach ($this->GBLikeButton['PluginSetting']['Message'] as $key => $value) { 
					switch($key) {
						
					 case ($key == "Update" && $this->GBLikeButton['PluginSetting']['Message']['Update'] > 0 && version_compare( gxtb_fb_lB_version, '4.5', '=') ):
					 	$text .= sprintf( '<strong>%s:</strong> %s (%s <a href="http://wordpress.org/extend/plugins/like-button-plugin-for-wordpress/changelog/" target="_blank">%s</a>) %s<br>%s <a href="http://wordpress.org/extend/plugins/like-button-plugin-for-wordpress/faq/" target="_blank">%s</a> %s <b>%s</b> %s <b>%s</b>!',
						
						__('Update', gxtb_fb_lB_lang),
						__('There are a lot of new functions and options available now', gxtb_fb_lB_lang),
						__('Check out the', gxtb_fb_lB_lang),
						__('Changelog', gxtb_fb_lB_lang),
						__('and it is recommended to check all your settings on the several FB-Like-Pages.', gxtb_fb_lB_lang),
						__('Check out the', gxtb_fb_lB_lang),
						__('FAQ-Site', gxtb_fb_lB_lang),
						__('on the Plugin-Page to learn and see how you can implement the new', gxtb_fb_lB_lang),
						__('Shortcode, Template-Function, a lot more Plugin-Settings', gxtb_fb_lB_lang),
						__('but also the new', gxtb_fb_lB_lang),
						__('Social Button Analytics Function', gxtb_fb_lB_lang)				
						);
						$text .= "<br /><br />";
					 break;
					 
					 case ($key == "Installation" && gxtb_fb_lB_version == $this->GBLikeButton['PluginInfo']['lVersion'] && $this->GBLikeButton['PluginSetting']['Message']['Installation'] > 0):
					 	$text .=  sprintf( "<strong>%s:</strong> %s %s. %s <a href='admin.php?page=fb-like-button'>%s</a> %s <a href='admin.php?page=fb-like-button#tabs-1'>%s</a>, <a href='admin.php?page=fb-like-button#tabs-2'>%s</a>, %s <a href='admin.php?page=fb-like-button#tabs-5'>%s</a> %s.<br>%s.",
						__('Installation', gxtb_fb_lB_lang),
						__('Hello and welcome to the', gxtb_fb_lB_lang),
						gxtb_fb_lB_name,
						__('First of all set the Default Settings on the',gxtb_fb_lB_lang),
						__('General Page', gxtb_fb_lB_lang),
						__('including the', gxtb_fb_lB_lang),
						__('General Settings', gxtb_fb_lB_lang),
						__('Position Settings', gxtb_fb_lB_lang),
						__('and the', gxtb_fb_lB_lang),
						__('Generator', gxtb_fb_lB_lang),
						__('at the bottom. After that you can check your Blog to see that it works', gxtb_fb_lB_lang),
						__('Now you should set the OpenGraph-Tags and the other stuff if you need/want it', gxtb_fb_lB_lang)
						
						);
						$text .= "<br /><br />";
					 break;
					 
					 case ($key == "Help" && $this->GBLikeButton['PluginSetting']['Message']['Help'] > 0):
					 	$text .=  sprintf( "<strong>%s:</strong> %s <br>%s <b><a href='http://facebook.com/GBWorldnet'>%s</a></b> %s <b><a href='http://www.gb-world.net'>%s</a></b>.",
						
						__('Help', gxtb_fb_lB_lang),
						__('If you have any questions, need help, found a bug or you just have a feature request then contact us please!', gxtb_fb_lB_lang),
						__('Get in touch with us on', gxtb_fb_lB_lang),
						__('Facebook', gxtb_fb_lB_lang),
						__('or on our', gxtb_fb_lB_lang),
						__('Website', gxtb_fb_lB_lang)
						
						);
						$text .= "<br /><br />";
					 break;
					 
					 case ($key == "Support" && $this->GBLikeButton['PluginSetting']['Message']['Support'] > 0):
					 	$text .=  sprintf( "<a href='https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SB94MEM9ATTBG'><img style='float:left;padding-right:10px;' src='".gxtb_fb_lB_PLUGIN_FOLDER."images/donate.gif'></a><strong>%s:</strong> %s <br><b>%s!</b><br><p style='padding-left:102px;'>%s %s.<br>%s!<br><br><b>%s!</b></p>",
						
						__('Support', gxtb_fb_lB_lang),
						__('I have invested a lot of time to update this Plugin to [v'.gxtb_fb_lB_version.'] and I would appreciate it if you could support my work.', gxtb_fb_lB_lang),
						__('I invested over 150 hours for you and this update', gxtb_fb_lB_lang),
						__('Please support me and my work with a little', gxtb_fb_lB_lang),
						__('Donation', gxtb_fb_lB_lang),
						__('1$, 1€ or another amount in another currency is nothing special for you but it is a big appreciation for me, the invested time and my work', gxtb_fb_lB_lang),
						__('Thank you very much', gxtb_fb_lB_lang)
						
						);
						$text .= "<br /><br />";
					 break;
					 
					 default:
						break;
					} // end switch
				} // end foreach
				
if($text != "") {
	$this->message .= $text;	
} // end if text
} // end function
public function GBMessage_Output($text = "") {
	
	if($this->message == "") { return; }
	
	$title = ($this->title == "") ?  __('Information', gxtb_fb_lB_lang):$this->title; 
	$type = ($this->type == "") ?  "info":$this->type; 
	$this->message .= $text;
?>
		<div class="ui-widget gbfade" id="gbfade">
			<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
				<p><span class="ui-icon ui-icon-<?php echo $type; ?>" style="float: left; margin-right: .3em;"></span> 
					<strong><?php echo $title; ?></strong><br /><br /><?php 
						echo $this->message;
					?></p>
			</div>
		</div>
<?php		
} // end function
} // end class
} // end if-class
?>