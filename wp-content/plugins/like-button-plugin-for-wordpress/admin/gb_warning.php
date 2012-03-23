<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.5] - GB-WARNING-SYSTEM [v0.3 BETA] [mit global $GBLikeButton]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       GB-Warning-SYSTEM  	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if(!class_exists('GBWarningSys')) {
class GBWarningSys {
	
	#var $GBLikeButton;
	var $warningtext;
	var $likevisible;
	var $butposition;
	
function GBWarningSys() {
	$this -> warningtext = array();
	unset($this->warningtext);
	$this->likevisible = false;
	$this->butposition = false;
	$this -> GBWarningSysCheck();
} // end konstruktor

/* 
	the SysCheck checks all the available options if there are some things not set correctly. 
	if there is a Warning the Warning-Option [Message][Warning] must be 1 or more. If this option
	is 0 then there is everything correct. The messages were generated here and are not saved in any
	option because this is redundand.
*/
function GBWarningSysCheck() {
	
	#$GBLikeButton = get_option('GBLikeButton');
	$GBLikeButton = get_option('GBLikeButton');

if ($GBLikeButton['PluginSetting']['Message']['Warning'] == 1) {
	
	if ($GBLikeButton['General']['on'] == 1) {
		
		/* OFFEN
		# Anzeige des FB-Buttons kontrollieren
		$this->likevisible = false;
		
		$this->likevisible = ($this->likevisible == false && $GBLikeButton['General']['frontpage'] == 1 ) ? true:false;
		$this->likevisible = ($this->likevisible == false && $GBLikeButton['General']['page'] == 1 ) ? true:false;
		$this->likevisible = ($this->likevisible == false && $GBLikeButton['General']['post'] == 1 ) ? true:false;
		$this->likevisible = ($this->likevisible == false && $GBLikeButton['General']['category'] == 1 ) ? true:false;
		$this->likevisible = ($this->likevisible == false && $GBLikeButton['General']['archiv'] == 1 ) ? true:false;
		
		if($this->likevisible == false) {
			$this -> warningtext[__('Button Appearance', gxtb_fb_lB_lang )] = array( __('You must choose either frontpage, page, post, category or archive if you activate the plugin. Otherwise the Like-Button will not be displayed!', gxtb_fb_lB_lang ) => array("General" => "fb-like-button#tabs-2") );
		}
		
		# Überprüfen ob eine Position ausgewählt worden ist #	
		#$butposition = ($butposition == false && $GBLikeButton['General']['position_before'] == 1 ) ? true:false;
		#$butposition = ($butposition == false && $GBLikeButton['General']['position_after'] == 1 ) ? true:false;
		
		if($this->butposition == false) {
			$this -> warningtext[__('Button Position', gxtb_fb_lB_lang )] = array( __('You must either choose if the Button appears <i>before</i> or <i>after</i> the content!', gxtb_fb_lB_lang ) => array("General" => "fb-like-button#tabs-2") );
		} */
				
		# Überprüft die Eingabe des Generators (http usw) #
		if($GBLikeButton['Generator']['url'] == "" || !strstr($GBLikeButton['Generator']['url'], "http://") ) {
			$this -> warningtext[__('Like-Button-Generator', gxtb_fb_lB_lang )] = array( __('You must enter a valid URL for your like-Button! Either your URL-Box is empty or you forget to enter http://', gxtb_fb_lB_lang ) => array("General" => "fb-like-button#tabs-5") );
		}
		
		# Meta-Tags überprüfen (speziell AdminID usw) #!is_numeric($gxtb_fb_lB_meta['admins']) && !empty($gxtb_fb_lB_meta['admins'])
		if( empty($GBLikeButton['OpenGraph']['admins']) || $GBLikeButton['OpenGraph']['admins'] == "" ) {
			$this -> warningtext[__('AdminID', gxtb_fb_lB_lang )] = array( __('You did not enter a valid Admin-ID. Please visit <a href="http://apps.facebook.com/whatismyid/" target="_blank">this site</a> to get your Facebook-ID (which is used as Admin-ID).', gxtb_fb_lB_lang ) => array("OpenGraph" => "fb-like-opengraph#tabs-10") );
		}
		
		if( ( empty($GBLikeButton['OpenGraph']['app_id']) || $GBLikeButton['OpenGraph']['app_id'] == "" ) && $GBLikeButton['General']['jdk'] == 1 ) {
			$this -> warningtext[__('AppID', gxtb_fb_lB_lang )] = array( __('You have to enter a valid AppID if you use XFBML. Please visit <a href="http://developers.facebook.com/setup/" target="_blank">this site</a> to get your App-ID.', gxtb_fb_lB_lang ) => array("OpenGraph" => "fb-like-opengraph#tabs-10") );
		}
				
		# Alle Blog-Specific Tags müssen ausgefüllt sein #
		if($GBLikeButton['OpenGraph']['site_name'] == "" || $GBLikeButton['OpenGraph']['title'] == "" || $GBLikeButton['OpenGraph']['url'] == "" || ( isset($GBLikeButton['OpenGraph']['dusage']) && $GBLikeButton['OpenGraph']['dusage'] == "blogn" && isset($GBLikeButton['OpenGraph']['description']) && $GBLikeButton['OpenGraph']['description'] == "") || $GBLikeButton['OpenGraph']['image'] == "") {
			$this -> warningtext[__('Blog Tags', gxtb_fb_lB_lang )] = array( __('Please set all the required Tags like the Examples show on the Tags-Page.', gxtb_fb_lB_lang ) => array("OpenGraph" => "fb-like-opengraph#tabs-11") );
		}		
					
	# Wenn Plugin bzw. Button nicht aktiviert ist #						
	} else {
		$this -> warningtext[__('Activation', gxtb_fb_lB_lang )] = array( __('Please activate the Like Button in order to use and see the Button on your Blog.', gxtb_fb_lB_lang ) => array("General" => "fb-like-button#tabs-1") );

	} // end if on
	
} // end if-Warning = 1	
}

/* the Output generates the Message which is displayed on every Admin-Page */
function GBWarningSysOutput() { 
$this -> GBWarningSysCheck();

if ( !empty($this -> warningtext) ) {
?>
<br />
		<div class="ui-widget">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
					<strong><?php _e("GB-Warning-System", gxtb_fb_lB_lang); ?></strong> <small>(<a href="<?php echo $_SERVER["REQUEST_URI"]; ?>"><?php _e("Refresh for Update", gxtb_fb_lB_lang); ?></a>)</small><br />
					<ul style="list-style-type:disc; padding-left: 20px;"><?php 
							foreach ($this -> warningtext as $title => $value) {
								echo "<li><b>" . $title . ":</b> ";
								foreach ($value as $text => $link) {
									echo $text;
									foreach ($link as $page => $url) {
										echo " <a href='admin.php?page=". $url ."'>[" . $page . "]</a></li>";
									}
								}
							}
					?></ul></p>
			</div>
		</div>
<?php } }

} // end class
} // end if-class
?>