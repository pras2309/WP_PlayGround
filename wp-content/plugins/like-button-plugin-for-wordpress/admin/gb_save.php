<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-Save-Settings [v1.0 FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       SAVE-METHOD			 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

# SAVE
function CleanerIsRunning() {
if ( (isset($_POST['gxtb_run_cleaner']) && $_POST['gxtb_run_cleaner'] == 1) ||
	 (isset($_POST['gxtb_reset']) && $_POST['gxtb_reset'] == 1) ||
	 (isset($_POST['gxtb_run_widgetcleaner']) && $_POST['gxtb_run_widgetcleaner'] == 1) ||
	 (isset($_POST['gxtb_widgetreset']) && $_POST['gxtb_widgetreset'] == 1) ) 
{ return false; } else { return true;}	
}
if ( isset($_POST['fbsubmit']) && check_admin_referer('fb-like-button') ) {

global $current_screen;
$nonce = wp_create_nonce( 'fb_like_hidden_'.$current_screen->parent_file);

if ( $_POST['fb_like_hidden'] != $nonce) { 
		GBLikeButton_SaveMessageOutput(sprintf("%s.",__("There has been an unusual action which tried to save some of the Options.", gxtb_fb_lB_lang))); return; }

	$error = false;	
	
if (get_option('GBLikeButton')) {
	
 	$GBLikeButton = get_option('GBLikeButton');
	
if ($_GET['page'] == "fb-like-button") {
	$GBLikeButton = GBSaveQuickInstallation($GBLikeButton);
}
if ($_GET['page'] == "fb-like-settings" && CleanerIsRunning()) {
	$GBLikeButton = GBSaveSettings($GBLikeButton);
}

if ($_GET['page'] == "fb-like-general") {
	
	if( GBLikeButton_Debug ) {
		echo "<b>Debug-Modus [General]</b><br />";
	}

	$area = "General";
	$keycode = "general_";
if( isset($GBLikeButton[$area])) {
	foreach ($GBLikeButton[$area] as $key => $value) { 
						
				  switch ($key) {
					 
					  case "jdk":
					  case "dynamic":
					  case "position_before":
					  case "position_before":
					  case "addfooter_activate":
					  case "frontpage":
					  case "page":
					  case "post":
					  case "category":
					  case "archiv":
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key])) ? $_POST[$keycode . $key]:0;
						  if( GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '";
							if ( isset($_POST[$keycode . $key]) ) { echo "1";} else { echo "0"; }
							echo "' from Checkbox [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;
					  				  
					  default:
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "" ) ? $_POST[$keycode . $key]:'';
						  if($_POST[$keycode . $key] && GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '" . $_POST[$keycode . $key] . "' from [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;
				  }
	}
} else { $error = true; }

if( GBLikeButton_Debug ) {
	echo "</b><br /><b>Debug-Modus [Generator]</b><br />";
}
	
	$area = "Generator";
	$keycode = "gxtb_fb_lB_generator_";
if( isset($GBLikeButton[$area])) {
	foreach ($GBLikeButton[$area] as $key => $value) { 
			
				  switch ($key) {
					  
					  case "faces":
					  case "scrolling":
					  case "trans":
					  case "send":
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key])) ? $_POST[$keycode . $key]:0;
						  if( GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '";
							if ( isset($_POST[$keycode . $key]) ) { echo "1";} else { echo "0"; }
							echo "' from Checkbox [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;	
					  
					  default:
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "" ) ? $_POST[$keycode . $key]:'';
						  if($_POST[$keycode . $key] && GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '" . $_POST[$keycode . $key] . "' from [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;
				  }
	}
} else { $error = true; }
}

if ($_GET['page'] == "fb-like-design") {
	
	if( GBLikeButton_Debug ) {
		echo "<b>Debug-Modus [Design]</b><br />";
	}
	
	$area = "Design";
	$keycode = "design_";
if( isset($GBLikeButton[$area])) {
	foreach ($GBLikeButton[$area] as $key => $value) { 
		
				  switch ($key) {
					  				  
					  default:
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "" ) ? $_POST[$keycode . $key]:'';
						  if($_POST[$keycode . $key] && GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '" . $_POST[$keycode . $key] . "' from [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;
				  }
	}
} else { $error = true; }
}

if ($_GET['page'] == "fb-like-opengraph") {
	
	if( GBLikeButton_Debug ) {
		echo "<b>Debug-Modus [OpenGraph]</b><br />";
	}
	
	$area = "OpenGraph";
	$keycode = "";
if( isset($GBLikeButton[$area])) {
	foreach ($GBLikeButton[$area] as $key => $value) { 
		
				  switch ($key) {
					  
					  case "image":
					  	if ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "") {
								if ((preg_match('#^http:\/\/#i', substr($_POST[$keycode . $key],0, 8)) || preg_match('#^https:\/\/#i', substr($_POST[$keycode . $key],0, 8))) && preg_match('#^(.*)\.(png|gif|jpg|jpeg)$#i', $_POST[$keycode . $key]) ) {		
									$GBLikeButton[$area][$key] = $_POST[$keycode . $key];
								} else if (!preg_match('#^http:\/\/#i', substr($_POST[$keycode . $key],0, 8))) {
									$GBLikeButton[$area][$key] = "http://" . $_POST[$keycode . $key];
								}  else { $GBLikeButton[$area][$key] = ""; }
						} else { $GBLikeButton[$area][$key] = ""; }
							unset($_POST[$keycode . $key]);
					  break;
					  
					  case "frontpage_default":
					  case "page_default":
					  case "post_default":
					  case "category_default":
					  case "archive_default":
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key])) ? $_POST[$keycode . $key]:0;
						  if( GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '";
							if ( isset($_POST[$keycode . $key]) ) { echo "1";} else { echo "0"; }
							echo "' from Checkbox [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;	
					  				  
					  default:
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "" ) ? $_POST[$keycode . $key]:'';
						  if($_POST[$keycode . $key] && GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '" . $_POST[$keycode . $key] . "' from [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;
				  }
	}
} else { $error = true; }
}

if ($_GET['page'] == "fb-like-insights") {
	
if( GBLikeButton_Debug ) {
	echo "<b>Debug-Modus [Insights]</b><br />";
}
	
	$area = "FBInsights";
	$keycode = "insights_";
if( isset($GBLikeButton[$area])) {
	foreach ($GBLikeButton[$area] as $key => $value) { 
			
				  switch ($key) {
					  
					  case "on":
					  case "frontpage_activ":
					  case "page_activ":
					  case "post_activ":
					  case "category_activ":
					  case "archiv_activ":
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key])) ? $_POST[$keycode . $key]:0;
						  if( GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '";
							if ( isset($_POST[$keycode . $key]) ) { echo "1";} else { echo "0"; }
							echo "' from Checkbox [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;	
					  
					  default:
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "" ) ? $_POST[$keycode . $key]:'';
						  if($_POST[$keycode . $key] && GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '" . $_POST[$keycode . $key] . "' from [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;
				  }
	}
} else { $error = true; }
}

if ($_GET['page'] == "fb-like-expert") {
	
if( GBLikeButton_Debug ) {
	echo "<b>Debug-Modus [Expert]</b><br />";
}

	$area = "Expert";
	$keycode = "expert_";
if( isset($GBLikeButton[$area])) {
	foreach ($GBLikeButton[$area] as $key => $value) { 
			
				  switch ($key) {
					  
					  case "besidebutton":
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "" ) ? stripslashes($_POST[$keycode . $key]):'';
						  if($_POST[$keycode . $key] && GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '" . stripslashes($_POST[$keycode . $key]) . "' from [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  
					  break;
					  				  
					  default:
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "" ) ? $_POST[$keycode . $key]:'';
						  if($_POST[$keycode . $key] && GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '" . $_POST[$keycode . $key] . "' from [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;
				  }
	}
} else { $error = true; }
}


	# Alles updaten #
	update_option('GBLikeButton', $GBLikeButton);

	// Output Meldung	
	if ($error) {
		GBLikeButton_SaveMessageOutput(sprintf("%s.",__("Please run the GBCleaner first because there are several options which are required but not set", gxtb_fb_lB_lang)));
	} elseif ( ( isset($_GET['page']) && strstr($_GET['page'],'fb-like') )) {
		if (CleanerIsRunning()) {
			GBLikeButton_SaveMessageOutput( sprintf("%s!",__("Settings successfully saved", gxtb_fb_lB_lang)));
		}
		unset( $_POST['fbsubmit'] );
	} // end if
	
} else if (CleanerIsRunning) { ## if GBLikeButton-Option does not exists ## ?>
		<div class="ui-widget" id="gbfade">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
				<strong><?php _e("Information", gxtb_fb_lB_lang); ?>:</strong> <?php echo sprintf("%s [<a href='admin.php?page=fb-like-settings'>%s</a>] %s.", __("Please run the", gxtb_fb_lB_lang), __("GBCleaner", gxtb_fb_lB_lang),__("first! Because the Main-Option is missing", gxtb_fb_lB_lang)); ?></p>
			</div>
		</div>
<?php 
} // end if get_option
} // end if

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      QUICKINSTALL-PAGE		 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################

function GBSaveQuickInstallation($GBLikeButton) {

	$error = false;	
	
	if( GBLikeButton_Debug ) {
		echo "<b>Debug-Modus [QuickInstallation]</b><br />";
	}
	
	$area = "General";
	$keycode = "general_";
if( isset($GBLikeButton[$area])) {
	foreach ($GBLikeButton[$area] as $key => $value) { 
		
				  switch ($key) {

					  case "jdk":
					  case "position_before":
					  case "position_before":
					  case "frontpage":
					  case "page":
					  case "post":
					  case "category":
					  case "archiv":
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key])) ? $_POST[$keycode . $key]:0;
						  if( GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '";
							if ( isset($_POST[$keycode . $key]) ) { echo "1";} else { echo "0"; }
							echo "' from Checkbox [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;	
					  
					  case "language":
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "" ) ? $_POST[$keycode . $key]:'';
						  if($_POST[$keycode . $key] && GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '" . $_POST[$keycode . $key] . "' from [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;
					  
					  default:
					  break;
				  }
	}
} else { $error = true; }
	
	$area = "Generator";
	$keycode = "gxtb_fb_lB_generator_";
if( isset($GBLikeButton[$area])) {
	foreach ($GBLikeButton[$area] as $key => $value) { 
			
				  switch ($key) {
					  
					  case "faces":
					  case "send":
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key])) ? $_POST[$keycode . $key]:0;
						  if( GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '";
							if ( isset($_POST[$keycode . $key]) ) { echo "1";} else { echo "0"; }
							echo "' from Checkbox [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;	
					  				  
					  case "layout":
					  case "verb":
					  case "width":
					  case "height":
					  case "color ":
					  case "font":
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "" ) ? $_POST[$keycode . $key]:'';
						  if(GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '" . $_POST[$keycode . $key] . "' from [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;
					  
					  default:
					  break;
				  }
	}
} else { $error = true; }
	
	$area = "Design";
	$keycode = "design_";
if( isset($GBLikeButton[$area])) {
	foreach ($GBLikeButton[$area] as $key => $value) { 
		
				  switch ($key) {
					  
					  case "br_before":
					  case "br_after":
					  	$GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "" ) ? $_POST[$keycode . $key]:0;
						  if($_POST[$keycode . $key] && GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '" . $_POST[$keycode . $key] . "' from [" . $keycode . $key ."]<br />";
						  }
						unset($_POST[$keycode . $key]);
					  break;
					  				  
					  default:
					  break;
				  }
	}
} else { $error = true; }
	
	$area = "OpenGraph";
	$keycode = "";
if( isset($GBLikeButton[$area])) {
	foreach ($GBLikeButton[$area] as $key => $value) { 
		
				  switch ($key) {
					  
					  case "admins":
					  case "app_id":
					  case "page_id":
					  case "site_name":
					  case "title":
					  case "url":
					  case "blogtype":
					  case "pagetype":
					  case "posttype":
					  case "categorytype":
					  case "archivetype":
					  case "description":
					  case "dusage":
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "" ) ? $_POST[$keycode . $key]:'';
						  if($_POST[$keycode . $key] && GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '" . $_POST[$keycode . $key] . "' from [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;
					  
					  case "frontpage_default":
					  case "page_default":
					  case "post_default":
					  case "category_default":
					  case "archive_default":
						  $GBLikeButton[$area][$key] = ( isset($_POST[$keycode . $key])) ? $_POST[$keycode . $key]:0;
						  if( GBLikeButton_Debug && isset($_POST[$keycode . $key]) ) {
						  	echo "[" . $area ."][".$key."] => '";
							if ( isset($_POST[$keycode . $key]) ) { echo "1";} else { echo "0"; }
							echo "' from Checkbox [" . $keycode . $key ."]<br />";
						  }
						  unset($_POST[$keycode . $key]);
					  break;
					  	
					  case "image":
					  	if ( isset($_POST[$keycode . $key]) && $_POST[$keycode . $key] != "") {
								if ((preg_match('#^http:\/\/#i', substr($_POST[$keycode . $key],0, 8)) || preg_match('#^https:\/\/#i', substr($_POST[$keycode . $key],0, 8))) && preg_match('#^(.*)\.(png|gif|jpg|jpeg)$#i', $_POST[$keycode . $key]) ) {		
									$GBLikeButton[$area][$key] = $_POST[$keycode . $key];
								} else if (!preg_match('#^http:\/\/#i', substr($_POST[$keycode . $key],0, 8))) {
									$GBLikeButton[$area][$key] = "http://" . $_POST[$keycode . $key];
								} else { $GBLikeButton[$area][$key] = ""; }
						} else { $GBLikeButton[$area][$key] = ""; }
							unset($_POST[$keycode . $key]);
					  break;

					  default:
					  break;
				  }
	}
} else { $error = true; }
	
	if ($error) { GBLikeButton_SaveMessageOutput(sprintf("%s.",__("Please run the GBCleaner first because there are several options which are required but not set", gxtb_fb_lB_lang))); }
	return $GBLikeButton;
} // end function
function GBSaveSettings($GBLikeButton) {
	
	$error = false;
	
	if( GBLikeButton_Debug ) {
		echo "<b>Debug-Modus [Settings-Page]</b><br />";
	}

	$area = "PluginSetting";
	$keycode = "pluginsetting_";
	$keysearch = array("Userlevel", "Priority");
	foreach ($keysearch as $keykey) {
		if( isset($GBLikeButton[$area][$keykey])) {	
			 $GBLikeButton[$area][$keykey] = ( isset($_POST[$keycode . $keykey]) && $_POST[$keycode . $keykey] != "" ) ? strtolower($_POST[$keycode . $keykey]):'administrator';
				if($_POST[$keycode . $keykey] && GBLikeButton_Debug && isset($_POST[$keycode . $keykey]) ) {
					echo "[" . $area ."][".$keykey."] => '" . strtolower($_POST[$keycode . $keykey]) . "' from [" . $keycode . $keykey ."]<br />";
				}
			unset($_POST[$keycode . $keykey]);
		} else { $error = true; }
	}

	$area = "Functions";
	$keycode = "pluginsetting_";
	if( isset($GBLikeButton[$area])) {
		foreach ($GBLikeButton[$area] as $key => $value) {  #GBLikeButton['Functions'] as ['Additional'] => array
			foreach ($GBLikeButton[$area][$key] as $keykey => $value) { #GBLikeButton['Functions']['Additional'] as ['W3C'] => 1
		
					  switch ($keykey) {
						  
						  case "EditorWidget_Settings":
						  	foreach ($GBLikeButton[$area][$key][$keykey] as $settingskey => $settingsvalue) {
								$GBLikeButton[$area][$key][$keykey][$settingskey] = ( isset($_POST[$keycode . $keykey . "_" . $settingskey])) ? $_POST[$keycode . $keykey . "_" . $settingskey]:0;
								if( GBLikeButton_Debug && isset($_POST[$keycode . $keykey. "_"  . $settingskey]) ) {
									echo "[" . $area ."][".$key."][".$keykey."][".$settingskey."] => '";
									if ( isset($_POST[$keycode . $keykey. "_"  . $settingskey]) ) { echo "1";} else { echo "0"; }
									echo "' from Checkbox [" . $keycode . $keykey . "_" . $settingskey."]<br />";
							  	}
							  unset($_POST[$keycode . $keykey . "_" . $settingskey]);
							}
						  break;
						  
						  default:
							 $GBLikeButton[$area][$key][$keykey] = ( isset($_POST[$keycode . $keykey])) ? $_POST[$keycode . $keykey]:0;
							  if( GBLikeButton_Debug && isset($_POST[$keycode . $keykey]) ) {
								echo "[" . $area ."][".$key."][".$keykey."] => '";
								if ( isset($_POST[$keycode . $keykey]) ) { echo "1";} else { echo "0"; }
								echo "' from Checkbox [" . $keycode . $keykey ."]<br />";
							  }
							  unset($_POST[$keycode . $key]);
						  break;
					  }
			}
		}
} else { $error = true; }
	
	# muss immer 1 sein (derzeit) #
	$GBLikeButton['Functions']['Editor']['PostButton'] = 1;
	$GBLikeButton['Functions']['Editor']['EditorWidget'] = 1;
	
	$GBLikeButton['Functions']['Additional']['GBCleaner'] = 1;
	$GBLikeButton['Functions']['Additional']['GBWidgetCleaner'] = 1;
	
	if ($error) { GBLikeButton_SaveMessageOutput(sprintf("%s.",__("Please run the GBCleaner first because there are several options which are required but not set", gxtb_fb_lB_lang))); }
	
	return $GBLikeButton;
}

function GBLikeButton_SaveMessageOutput($message) {
	global $GBMessage;
	$GBMessage->message .= "{$message}<br><br>";
}
?>