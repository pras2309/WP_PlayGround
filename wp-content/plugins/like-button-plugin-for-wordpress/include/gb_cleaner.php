<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.5] - GB-Cleaner [v1.5 FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       GBCLEANER-CLASS		 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
# Background-Knowledge: http://wordpress.org/about/stats/ #
# http://www.phpbar.de/w/private#private #

#@vor eine Funktion um FehlerOutput zu verhindern!

if (!class_exists('GBCleaner')) {
class GBCleaner {
	
	var $GBLikeButton;
	
function GBCleaner() {
	$this->GBCleanerLoad();
}
final function GBCleanerLoad() {
	if(get_option('GBLikeButton')) {
		$this->GBLikeButton = get_option('GBLikeButton');
	} else {
		$this->GBLikeButton = NULL;
	}
}
/* adds all the neccessary Like-Button-Plugin-For-Wordpress Options */
final function GBCleanerAdd($return = false) {
	
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] [--BEGIN--] GBCleaner'); }
	
	global $wp_version;
	$default = array('language' => 'en_US', 'layout' => 'standard', 'verb' => 'like', 'width' => "250", 'height' => "100");
	$this->GBCleanerLoad();

	if ( !get_option('GBLikeButton') ) {
	/* set all the default values for a clean installation [v4.5] */
	$GBLikeButton = array (
			'PluginSetting' => array ( 
                'Userlevel' => 'administrator', # min. Userlevel für alle Backend-Seiten
				'Priority' => '98', ## ist für die Priorität bezüglich des Outputs des Like-Buttons verantwortlich
                'Message' => array ( ## handelt alle ON/OFF-Befehle für das Messaging-System des Plugins
					'Update' => 0, ## Update-Messages: Update-Messages für Hinweise nach dem Update (x Anzahl für Anzeige - Default: 0)
					'Installation' => 2, ## Installation-Messages (x Anzahl für Anzeige - Default: 2)
					'Help' => 2, ## Help-Messages (x Anzahl für Anzeige - Default: 2)
					'Support' => 3, ## Support-Message for all the Hardwork I did (x Anzahl der Anzeige - Default: 3)
					'Warning' => 1 ## Warning-Sys (0 - Warnungen aus | 1 - Warnungen an)
				 )
			), ################## NEW ##################
			'Functions' => array (
				'General' => array (
					'LikeButton' => 1, ## aktiviert den Like-Button Output (ÄNDERN - vorher [General][on] !!!!)
					'OpenGraph' => 1, ## aktiviert den OpenGraph-Output (ÄNDERN - vorher [Opengraph][on] !!!!)
					'TemplateFunction' => 1, ## aktiviert die TemplateFunctiont
					'Shortcode' => 1, ## aktiviert den GBShortcode (ÄNDERN - vorher [General][shortcode] !!!!)
					'Widget' => 1 ## aktiviert die Widgets
				),			
				'Editor' => array (
					'QuickEdit' => 1, ## aktiviert das Frontend-Menu (WP 3.0+)
					'PostButton' => 1, ## aktiviert den Post-Button im WYSIWYG-Editor
					'EditorWidget' => 1, ## aktiviert die individuellen Einstellungen (Widget) von Posts/Pages
					'EditorWidget_Settings' => array( ## spezielle Editor-Widget-Optionen
						'featured' => 0, ## wenn 1 dann ist immer 'Featured' aktiviert
						)
				),			
				'Additional' => array (
					'GBCleaner' => 1, ## aktiviert die Verfügbarkeit des GBCleaners
					'GBWidgetCleaner' => 1, ## aktiviert die Verfügbarkeit des GBWidgetCleaner
					'Dashboard' => 1, ## aktiviert das Dashboard Widget
					'FrontendMenu' => 1, ## aktiviert das Frontend-Menu (WP 3.0+)
					'Message' => 1, ## aktiviert das Message-System
					'SocialSpeedUp' => 0, ## akiviert die jQuery-Library von GB-World.net
					'w3c' => 0 ## aktivates the W3C-conform OpenGraph Meta-Tag Output (ÄNDERN - vorher [Opengraph][w3c] !!!!)
				)
			), ################## NEW ##################
			'PluginInfo' => array (
				'cVersion' => gxtb_fb_lB_version, ## current Plugin-Version
				'lVersion' => "" ## last installed Plugin-Version
			),
			'General' => array (		
				'jdk' => 0,
				'language' => $default['language'],
				'dynamic' => 1,
				'position_before' => 0,
				'position_after' => 1,
				'addfooter_activate' => 0,
				'addfooter' => 0,
				'frontpage' => 1,
				'page' => 1,
				'page_exclude' => "",
				'post' => 1,
				'post_exclude' => "",
				'category' => 0,
				'category_exclude' => "",
				'archiv' => 0,
				'archiv_exclude' => ""
			),
			'Generator' => array (
				'url' =>  (version_compare( $wp_version, '3.0', '>=' )) ? get_home_url() : get_bloginfo('url'),
				'send' => 0,
				'layout' => $default['layout'],
				'faces' => 0,
				'verb' => $default['verb'],
				'width' => $default['width'],
				'height' => $default['height'],
				'color' => "light",
				'font' => "arial",
				'scrolling' => 0,
				'frameborder' => "0",
				'borderstyle' => "none",
				'overflow' => "hidden",
				'trans' => 1
			),
			'Design' => array (
				'css' => "",
				'cssbox' => "",
				'br_before' => 0,
				'br_after' => 0	
			),
			'FBInsights' => array (
				'on' => 0,
				'frontpage' => "",
				'frontpage_activ' => 0,
				'category' => "",
				'category_activ' => 0,
				'page' => "",
				'page_activ' => 0,
				'post' => "",
				'post_activ' => 0,
				'archiv' => "",
				'archiv_activ' => 0
			),
			'OpenGraph' => array (
				'site_name' => "&#036;binfo",
				'blogtype' => "blog",
				'pagetype' => "blog",
				'posttype' => "article",
				'categorytype' => "blog",
				'archivetype' => "blog",
				'admins' => "",
				'app_id' => "",
				'page_id' => "",
				'title' => "&#036;ptitle",
				'url' => "&#036;plink",
				'description' => "",
				'dusage' => "blogd",
				'image' => "",
				'frontpage_default' => 1,
				'page_default' => 1,
				'post_default' => 1,
				'category_default' => 1,
				'archive_default' => 1,
				'plz' => "",
				'mail' => "",
				'street' => "",
				'phone' => "",
				'locality' => "",
				'fax' => "",
				'region' => "",
				'country' => "",
				'latitude' => "",
				'longitude' => ""
			),
			'Expert' => array(
				'besidebutton' => "",
				'besideposition' => "right",
				'customchannel' => ''
				#'Meta' => '', # NEU (Ausstehend) Zusatz für den Meta-Tag-Output den man adden möchte (ähnlich wie besidebutton), aber vl auch Post-Specifisch machen bzw beides
			));
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBCleaner[ACTION]: Options added - complete'); }
		update_option('GBLikeButton', $GBLikeButton);
		$this->GBCleanerUpdate();
	 	$this->GBCleanerNewAndModify();
		#_log(array('it' => 'works'));		
	} else {
	 	$this->GBCleanerNewAndModify();
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBCleaner[ACTION]: Modification - complete'); }
	}
		
	if (isset($return) && $return == true) { 
		# gibt den Wert zurück sofern es gewünscht / nötig ist #
		return $this->GBLikeButton;
	}
	
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] [--END--] GBCleaner'); }
}
/* adds new and modifies old Like-Button-Plugin-For-Wordpress Options after an installation */
final function GBCleanerNewAndModify($message = false) {
		
		$this->GBCleanerLoad();
		if ($this->GBLikeButton == NULL) {
if(GBLikeButton_Log || GBLikeButton_Debug) { _log('[Like-Button-Plugin-For-Wordpress] 	[--FATAL ERROR--]: GBLikeButton-Options are EMPTY! Please run the GBCleaner to fix this bug!'); } return; }
							
		# prüft ob die Plugin-Installation schon unter [v4.5] benutzt wurde und fügt die neuen Werte wenn nötig hinzu #
		if ( version_compare( $this->GBLikeButton['PluginInfo']['lVersion'], '4.5', '<=' ) ) {
				
			## new Options [v4.5] ##
				$GBFunctions = array(
					'General' => array(
						'LikeButton' => (isset($this->GBLikeButton['General']['on'])) ? $this->GBLikeButton['General']['on']:1,
						'OpenGraph' => (isset($this->GBLikeButton['OpenGraph']['on'])) ? $this->GBLikeButton['OpenGraph']['on']:1,
						'TemplateFunction' => 1,
						'Shortcode' => 1,
						'Widget' => 1
					),
					'Editor' => array(
						'QuickEdit' => 1,
						'PostButton' => 1,
						'EditorWidget' => 1
					), 
					'Additional' => array(
						'GBCleaner' => 1,
						'GBWidgetCleaner' => 1,
						'Dashboard' => 1,
						'FrontendMenu' => 1,
						'Message' => 1,
						'SocialSpeedUp' => 0,
						'w3c' => (isset($this->GBLikeButton['OpenGraph']['w3c'])) ? $this->GBLikeButton['OpenGraph']['w3c']:0
					)
				);
				
				$GBLikeButton_NewKey = "Functions";

	if( GBLikeButton_Debug ) {
		echo "<b>Debug-Modus [Run GBCleaner]</b><br />";
	}			
			## NEW OPTIONS ##
			if(!isset($this->GBLikeButton[$GBLikeButton_NewKey]) || !array_key_exists($GBLikeButton_NewKey, $this->GBLikeButton)) { $this->GBLikeButton[$GBLikeButton_NewKey] = array(); }
			
				foreach ($GBFunctions as $key => $keyvalue) { # General => array()
				
					if(!isset($this->GBLikeButton[$GBLikeButton_NewKey][$key]) || !array_key_exists($key, $this->GBLikeButton[$GBLikeButton_NewKey])) { $this->GBLikeButton[$GBLikeButton_NewKey][$key] = array(); }
					
					foreach ($GBFunctions[$key] as $keykey => $value) { # LikeButton => 1
					  if( !isset($this->GBLikeButton[$GBLikeButton_NewKey][$key][$keykey]) ||
					  	  !array_key_exists($keykey, $this->GBLikeButton[$GBLikeButton_NewKey][$key])) {
						  $this->GBLikeButton[$GBLikeButton_NewKey][$key][$keykey] = $value;
						  if( GBLikeButton_Debug && (strstr($_SERVER["REQUEST_URI"],"plugin") || strstr($_SERVER["REQUEST_URI"],"update"))) {
							echo "[$GBLikeButton_NewKey][$key][$keykey] => ";
							if ( $this->GBLikeButton[$GBLikeButton_NewKey][$key][$keykey] == 1 ) { echo "true";} else { echo "false"; }
							echo "<br />";
						  }
					  } # New Option set to 1 or their old value
					}
				}
				
				if( !array_key_exists('customchannel', $this->GBLikeButton['Expert']) || !isset($this->GBLikeButton['Expert']['customchannel'])) {
					$this->GBLikeButton['Expert']['customchannel'] = "";
				}
				if( !array_key_exists('EditorWidget_Settings', $this->GBLikeButton['Functions']['Editor']) || !isset($this->GBLikeButton['Functions']['Editor'])) {
					$this->GBLikeButton['Functions']['Editor']['EditorWidget_Settings'] = array( 'featured' => 0 );
				}
				
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBCleaner[ACTION]: add new Options - complete'); }

				# unset old options to prevent bugs/errors and empty options #
				unset($this->GBLikeButton['General']['on']);
				unset($this->GBLikeButton['General']['shortcode']);
				unset($this->GBLikeButton['PluginSetting']['GBCleaner']);
				unset($this->GBLikeButton['PluginSetting']['GBWidgetCleaner']);
				unset($this->GBLikeButton['PluginSetting']['jQuery']);
				unset($this->GBLikeButton['PluginSetting']['Bugreport']);
				unset($this->GBLikeButton['OpenGraph']['on']);
				unset($this->GBLikeButton['OpenGraph']['w3c']);
				unset($this->GBLikeButton['EditorSetting']);

if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBCleaner[ACTION]: unset obsolete Options - complete'); }
			
			# set some default values outside the foreach-loop #
				$this->GBLikeButton['PluginSetting']['Userlevel'] = 'administrator';
				$this->GBLikeButton['PluginSetting']['Priority'] = '98';
			## Update Version ##
				$this->GBLikeButton['PluginInfo']['cVersion'] = gxtb_fb_lB_version;
			## Message System ##
			if(isset($this->GBLikeButton['PluginInfo']['lVersion']) &&
					$this->GBLikeButton['PluginInfo']['lVersion'] != gxtb_fb_lB_version &&
					$this->GBLikeButton['PluginInfo']['lVersion'] != "") {
				
				$this->GBLikeButton['PluginSetting']['Message']['Update'] = 2;
				$this->GBLikeButton['PluginSetting']['Message']['Help'] = 2;
				
			} else if ($this->GBLikeButton['PluginInfo']['lVersion'] != gxtb_fb_lB_version &&
						$this->GBLikeButton['PluginInfo']['lVersion'] != ""){ 
				
				$this->GBLikeButton['PluginSetting']['Message']['Installation'] = 2;
				$this->GBLikeButton['PluginSetting']['Message']['Help'] = 2;
				$this->GBLikeButton['PluginSetting']['Message']['Support'] = 2;
			}				
			
			update_option('GBLikeButton', $this->GBLikeButton);
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBCleaner[ACTION]: Modification - complete'); }
		
			if($message) { $this->GBCleanerMessage(__("Your settings are now up2date and match the latest requirements of this plugin!", gxtb_fb_lB_lang)); }
		} // end if
} // end function
/* if someone uses a really old version of the plugin (below v4.3.3) then this function is called */
final function GBCleanerUpdate($message = false) {

	$this->GBCleanerLoad();
	if ($this->GBLikeButton == NULL) { return; }
	
	if ( (isset($this->GBLikeButton['PluginInfo']['lVersion']) && version_compare( $this->GBLikeButton['PluginInfo']['lVersion'], "4.5", '<' )) ||
		!isset($this->GBLikeButton['PluginInfo']['lVersion']) ) {
		
	delete_option('gxtb_fb_lB_settings');
	delete_option('gxtb_fb_lB_design');
	delete_option('gxtb_fb_lB_analytics');
	delete_option('gxtb_fb_lB_generator');
	delete_option('gxtb_fb_lB_meta');
	delete_option('gxtb_fb_lB');
	
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBCleaner[ACTION]: obsolete Options deleted - complete'); }
	return;	
	}

return;
## NOTE: THIS IS CURRENTLY OUT OF WORK BECAUSE THERE IS ONLY A SMALL AMOUT OF ACTIVE PLUGINS BELOW [v4.0] ##
/* checks if the old Option-Style is in use and changes it - at the end it deletes the old settings for ever */
	if ( 	get_option('gxtb_fb_lB_settings') || 
			get_option('gxtb_fb_lB_design') || 
			get_option('gxtb_fb_lB_analytics') || 
			get_option('gxtb_fb_lB_generator') || 
			get_option('gxtb_fb_lB_meta') || 
			get_option('gxtb_fb_lB') )
	{		
	  $gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
	  $gxtb_fb_lB_design = get_option('gxtb_fb_lB_design');
	  $gxtb_fb_lB_analytics = get_option('gxtb_fb_lB_analytics');
	  $gxtb_fb_lB_generator = get_option('gxtb_fb_lB_generator');
	  $gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
	  $gxtb_fb_lB = get_option('gxtb_fb_lB');

# This options have to be set manually #
	$this->GBLikeButton['Functions']['General']['LikeButton'] = (isset($gxtb_fb_lB_settings['activate']) && $gxtb_fb_lB_settings['activate']==true) ? 1:0;
	$this->GBLikeButton['Functions']['General']['Shortcode'] = (isset($gxtb_fb_lB_settings['shortcode']) && $gxtb_fb_lB_settings['shortcode']==true) ? 1:0;
	$this->GBLikeButton['Functions']['Additional']['w3c'] = (isset($this->GBLikeButton['OpenGraph']['w3c']) && $gxtb_fb_lB_settings['shortcode']==true) ? 1:0;

	$arraykeys = array( 'General', 'Generator', 'Design', 'FBInsights', 'OpenGraph');
	
	foreach ($gxtb_fb_lB_settings as $key => $value) {
		
		switch ($key) {
			
			case 'language':
				$this->GBLikeButton[$arraykeys[0]][$key][$value] = (isset($gxtb_fb_lB_settings[$key])) ? $gxtb_fb_lB_settings[$key]:'en_US';
			break;
			case 'page_exclude':
			case 'category_exclude':
			case 'archiv_exclude':
				$this->GBLikeButton[$arraykeys[0]][$key][$value] = (isset($gxtb_fb_lB_settings[$key])) ? $gxtb_fb_lB_settings[$key]:'';
			break;
			
			case "on":
			case "activate":
			case "shortcode":
			break;
			
			default:
				$this->GBLikeButton[$arraykeys[0]][$key][$value] = (isset($gxtb_fb_lB_settings[$key]) && $gxtb_fb_lB_settings[$key]==true) ? 1:0;		
			break;
		}
	}
	foreach ($gxtb_fb_lB_generator as $key => $value) {
		
		switch ($key) {
		
			case 'layout':
				$this->GBLikeButton[$arraykeys[1]][$key][$value] = (isset($gxtb_fb_lB_generator[$key])) ? $gxtb_fb_lB_generator[$key]:'standard';
			break;
			case 'width':
				$this->GBLikeButton[$arraykeys[1]][$key][$value] = (isset($gxtb_fb_lB_generator[$key])) ? $gxtb_fb_lB_generator[$key]:'250';
			break;
			case 'height':
				$this->GBLikeButton[$arraykeys[1]][$key][$value] = (isset($gxtb_fb_lB_generator[$key])) ? $gxtb_fb_lB_generator[$key]:'100';
			break;
			case 'verb':
				$this->GBLikeButton[$arraykeys[1]][$key][$value] = (isset($gxtb_fb_lB_generator[$key])) ? $gxtb_fb_lB_generator[$key]:'like';
			break;
			case 'color':
				$this->GBLikeButton[$arraykeys[1]][$key][$value] = (isset($gxtb_fb_lB_generator[$key])) ? $gxtb_fb_lB_generator[$key]:'light';
			break;
			case 'font':
				$this->GBLikeButton[$arraykeys[1]][$key][$value] = (isset($gxtb_fb_lB_generator[$key])) ? $gxtb_fb_lB_generator[$key]:'arial';
			break;
			case 'frameborder':
				$this->GBLikeButton[$arraykeys[1]][$key][$value] = (isset($gxtb_fb_lB_generator[$key])) ? $gxtb_fb_lB_generator[$key]:'0';
			break;
			case 'borderstyle':
				$this->GBLikeButton[$arraykeys[1]][$key][$value] = (isset($gxtb_fb_lB_generator[$key])) ? $gxtb_fb_lB_generator[$key]:'none';
			break;
			case 'overflow':
				$this->GBLikeButton[$arraykeys[1]][$key][$value] = (isset($gxtb_fb_lB_generator[$key])) ? $gxtb_fb_lB_generator[$key]:'hidden';
			break;
			
			default:
				$this->GBLikeButton[$arraykeys[1]][$key][$value] = (isset($gxtb_fb_lB_generator[$key]) && $gxtb_fb_lB_generator[$key]==true) ? 1:0;		
			break;
		}
	}
	foreach ($gxtb_fb_lB_design as $key => $value) {
		
		switch ($key) {
			
			case 'css':
			case 'cssbox':
				$this->GBLikeButton[$arraykeys[2]][$key][$value] = (isset($gxtb_fb_lB_design[$key])) ? $gxtb_fb_lB_design[$key]:'';
			break;
			
			default:
				$this->GBLikeButton[$arraykeys[2]][$key][$value] = (isset($gxtb_fb_lB_design[$key]) && $gxtb_fb_lB_design[$key]==true) ? 1:0;		
			break;
		}
	}
	foreach ($gxtb_fb_lB_analytics as $key => $value) {
		
		switch ($key) {
			
			case 'frontpage':
			case 'category':
			case 'page':
			case 'post':
			case 'archiv':
				$this->GBLikeButton[$arraykeys[3]][$key][$value] = (isset($gxtb_fb_lB_analytics[$key])) ? $gxtb_fb_lB_analytics[$key]:'';
			break;
			
			default:
				$this->GBLikeButton[$arraykeys[3]][$key][$value] = (isset($gxtb_fb_lB_analytics[$key]) && $gxtb_fb_lB_analytics[$key]==true) ? 1:0;		
			break;
		}
	}
	foreach ($gxtb_fb_lB_meta as $key => $value) {
	
	switch ($key) {
		
		case 'site_name':
			$this->GBLikeButton[$arraykeys[4]][$key][$value] = (isset($gxtb_fb_lB_meta[$key])) ? $gxtb_fb_lB_meta[$key]:'&#036;binfo';
		break;
		case 'title':
			$this->GBLikeButton[$arraykeys[4]][$key][$value] = (isset($gxtb_fb_lB_meta[$key])) ? $gxtb_fb_lB_meta[$key]:'&#036;ptitle';
		break;
		case 'url':
			$this->GBLikeButton[$arraykeys[4]][$key][$value] = (isset($gxtb_fb_lB_meta[$key])) ? $gxtb_fb_lB_meta[$key]:'&#036;plink';
		break;
		
		case 'blogtype':
		case 'pagetype':
			$this->GBLikeButton[$arraykeys[4]][$key][$value] = (isset($gxtb_fb_lB_meta[$key])) ? $gxtb_fb_lB_meta[$key]:'blog';
		break;
		
		case 'dusage':
			$this->GBLikeButton[$arraykeys[4]][$key][$value] = (isset($gxtb_fb_lB_meta[$key])) ? $gxtb_fb_lB_meta[$key]:'blogd';
		break;
		
		case "on":
		case "w3c":
		break;
		
		default:
			$this->GBLikeButton[$arraykeys[4]][$key][$value] = (isset($gxtb_fb_lB_meta[$key])) ? $gxtb_fb_lB_meta[$key]:'';	
		break;
	}
}		
	
	/* alle Alten Optionen löschen - Beta-Phase nocht nicht abgeschlossen */
	delete_option('gxtb_fb_lB_settings');
	delete_option('gxtb_fb_lB_design');
	delete_option('gxtb_fb_lB_analytics');
	delete_option('gxtb_fb_lB_generator');
	delete_option('gxtb_fb_lB_meta');
	delete_option('gxtb_fb_lB');
	
	update_option('GBLikeButton', $this->GBLikeButton);
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBCleaner[ACTION]: restored obsolete Options and deleted afterwards - complete'); }	
	if($message) { $this->GBCleanerMessage(sprintf("%s!", __("GBCleaner successfully executed", gxtb_fb_lB_lang))); }
	
	} // end if
}
/* deletes all the options for example if you delete the plugin */
final function GBCleanerDelete($message = false) {

	delete_option('gxtb_fb_lB_settings');
	delete_option('gxtb_fb_lB_design');
	delete_option('gxtb_fb_lB_analytics');
	delete_option('gxtb_fb_lB_generator');
	delete_option('gxtb_fb_lB_meta');
	delete_option('gxtb_fb_lB');
	
	delete_option('GBLikeButton');
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBCleaner[ACTION]: all Options deleted - complete');	 }			
	if($message) { $this->GBCleanerMessage(__("Successfully deleted all the Settings.", gxtb_fb_lB_lang)); }
}
/* resets the values to the default values */
final function GBCleanerReset() {
	delete_option('GBLikeButton');
	$this->GBLikeButton = $this->GBCleanerAdd(true);
	$this->GBCleanerMessage(__("Reset of all the available Settings complete!", gxtb_fb_lB_lang));
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBCleaner[ACTION]: Options restored - complete'); }
}
/* Output for all the necessary Messages of the GBCleaner */
final function GBCleanerMessage($message = "") {
	if ($message == "" ) { return; }
	global $GBMessage;
	$GBMessage->message .= "{$message}<br><br>";
}  
} // end class
} // end if-class
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	   WIDGET-CLEANER-CLASS		 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('GBLikeButtonWidgetCleaner')) {
class GBLikeButtonWidgetCleaner {
	var $GBLikeButtonWidget;
	var $GBLikeButton;
function GBLikeButtonWidgetCleaner() { if(get_option('GBLikeButtonWidget')) { $this->GBLikeButtonWidget = get_option('GBLikeButtonWidget'); } } // end konstruktor
function GBWidgetCleaner_Add() {

if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] [--BEGIN--] GBWidgetCleaner'); }

	if (!get_option('GBLikeButtonWidget')) {
		
		$GBLikeButton = get_option('GBLikeButtonWidget');
		global $wp_version;
		
		$this->GBLikeButtonWidget = array ( # alle Optionen auf 0 setzten falls es zu Fehlern kam #
				'LikeButton' => array ( 
					'title' => '',
					'url' => (version_compare( $wp_version, '3.0', '>=' )) ? get_home_url() : get_bloginfo('url'),
					'dynamic' => 1,
					'layout' => 'standard',
					'language' => 'en_US',
					'faces' => 1,
					'width' => '',
					'height' => '',
					'verb' => 'like',
					'color' => 'light',
					'font' => '',
					'scrolling' => 0,
					'frameborder' => '',
					'borderstyle' => '',
					'overflow' => 'hidden',
					'trans' => 1,
					'css' => '',
					'ref' => ''
				),
				'Recommendation' => array ( 
					'title' => '',
					'site' => (version_compare( $wp_version, '3.0', '>=' )) ? get_home_url() : get_bloginfo('url'),
					'header' => 1,
					'width' => '',
					'height' => '',
					'colorscheme' => 'light',
					'font' => '',
					'border_style' => '',
					'border_color' => '',
					'scrolling' => 0,
					'frameborder' => '',
					'overflow' => 'hidden',
					'trans' => 0,
					'css' => '',
					'ref' => ''
				),
				'ActivityFeed' => array (
					'title' => '',
					'site' => (version_compare( $wp_version, '3.0', '>=' )) ? get_home_url() : get_bloginfo('url'),
					'width' => '',
					'height' => '',
					'header' => 0,
					'colorscheme' => 'light',
					'font' => '',
					'border_style' => '',
					'border_color' => '',
					'scrolling' => 0,
					'frameborder' => '',
					'overflow' => 'hidden',
					'trans' => 0,
					'recommendations' => 0,
					'filter' => '',
					'css' => '',
					'ref' => ''
				)
			);
		update_option('GBLikeButtonWidget', $this->GBLikeButtonWidget);
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBWidgetCleaner[ACTION]: Options added - complete');	 }	
		$this->WidgetCleaner_ObsoleteOptions();
		$this->GBWidgetCleaner_Update();
	} else {		
		$this->WidgetCleaner_ObsoleteOptions();
		$this->GBWidgetCleaner_Update();
	}

if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] [--END--] GBWidgetCleaner'); }	
} // end function
function GBWidgetCleaner_Update() {
	
$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');
$this->GBLikeButton = get_option('GBLikeButton');

if ($this->GBLikeButtonWidget == NULL) {
if(GBLikeButton_Log || GBLikeButton_Debug) { _log('[Like-Button-Plugin-For-Wordpress] 	[--FATAL ERROR--]: GBLikeButtonWidget-Options are EMPTY! Please run the GBWidgetCleaner to fix this bug!'); } return; }
					
if ( version_compare( $this->GBLikeButton['PluginInfo']['lVersion'], '4.5', '<=' ) ) {
		$GBWidget = array(
			'LikeButton' => array(
				'language' => 'en_US'
			)
		);

if( GBLikeButton_Debug ) {
	echo "<b>Debug-Modus [Run GBWidgetCleaner]</b><br />";
}
			## executed and add the new Functions ##
				foreach ($GBWidget as $key => $keyvalue) { # LikeButton => array()
					//$this->GBLikeButtonWidget['LikeButton'][$key] = array();
					foreach ($GBWidget[$key] as $keykey => $value) { # language => en_US
					  if( !array_key_exists($keykey, $this->GBLikeButtonWidget[$key]) ||
					  	  !isset($this->GBLikeButtonWidget[$key][$keykey])) {
							  
						  $this->GBLikeButtonWidget[$key][$keykey] = $value;
						  
						  if( GBLikeButton_Debug && !strstr($_SERVER["REQUEST_URI"],"plugin") && !strstr($_SERVER["REQUEST_URI"],"update")) {
							  echo "[$key][$keykey] => ";
						  if ( $this->GBLikeButtonWidget[$key][$keykey] == 1 ) { echo "true";} else { echo "false"; }
							  echo "<br />";
							  
						  }
					  } # New Option set to 1 or their old value
					}
				} // end foreach
				
	update_option('GBLikeButtonWidget',$this->GBLikeButtonWidget);
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBWidgetCleaner[ACTION]: add new Options - complete'); }

} // end if
} // end function
function WidgetCleaner_ObsoleteOptions($message = false) {
	
if( get_option('gxtb_fb_lB_data') ) {
	$gxtb_fb_lB_data = get_option('gxtb_fb_lB_data');
	global $wp_version;
	
	$this->GBLikeButtonWidget = array ( # alle Optionen auf 0 setzten falls es zu Fehlern kam #
				'LikeButton' => array ( 
					'title' => (isset($gxtb_fb_lB_data['title'])) ? $gxtb_fb_lB_data['title']:'',
					'url' => (isset($gxtb_fb_lB_data['url'])) ? $gxtb_fb_lB_data['url']:(version_compare( $wp_version, '3.0', '>=' )) ? get_home_url() : get_bloginfo('url'),
					'dynamic' => (isset($gxtb_fb_lB_data['dynamic'])) ? $gxtb_fb_lB_data['dynamic']:1,
					'language' => "en_US",
					'layout' => (isset($gxtb_fb_lB_data['layout'])) ? $gxtb_fb_lB_data['layout']:'standard',
					'faces' => (isset($gxtb_fb_lB_data['faces'])) ? $gxtb_fb_lB_data['faces']:1,
					'width' => (isset($gxtb_fb_lB_data['width'])) ? $gxtb_fb_lB_data['width']:'',
					'height' => (isset($gxtb_fb_lB_data['height'])) ? $gxtb_fb_lB_data['height']:'',
					'verb' => (isset($gxtb_fb_lB_data['verb'])) ? $gxtb_fb_lB_data['verb']:'like',
					'color' => (isset($gxtb_fb_lB_data['color'])) ? $gxtb_fb_lB_data['color']:'',
					'font' => (isset($gxtb_fb_lB_data['font'])) ? $gxtb_fb_lB_data['font']:'',
					'scrolling' => (isset($gxtb_fb_lB_data['scrolling'])) ? $gxtb_fb_lB_data['scrolling']:0,
					'frameborder' => (isset($gxtb_fb_lB_data['frameborder'])) ? $gxtb_fb_lB_data['frameborder']:'',
					'borderstyle' => (isset($gxtb_fb_lB_data['borderstyle'])) ? $gxtb_fb_lB_data['borderstyle']:'',
					'overflow' => (isset($gxtb_fb_lB_data['overflow'])) ? $gxtb_fb_lB_data['overflow']:'hidden',
					'trans' => (isset($gxtb_fb_lB_data['trans'])) ? $gxtb_fb_lB_data['trans']:1,
					'css' => (isset($gxtb_fb_lB_data['css'])) ? $gxtb_fb_lB_data['css']:'',
					'ref' => (isset($gxtb_fb_lB_data['ref'])) ? $gxtb_fb_lB_data['ref']:''
				),
				'Recommendation' => array ( 
					'title' => (isset($gxtb_fb_lB_data['rec_title'])) ? $gxtb_fb_lB_data['rec_title']:'',
					'site' => (isset($gxtb_fb_lB_data['rec_domain'])) ? $gxtb_fb_lB_data['rec_domain']:(version_compare( $wp_version, '3.0', '>=' )) ? get_home_url() : get_bloginfo('url'),
					'header' => (isset($gxtb_fb_lB_data['rec_header'])) ? $gxtb_fb_lB_data['rec_header']:1,
					'width' => (isset($gxtb_fb_lB_data['rec_width'])) ? $gxtb_fb_lB_data['rec_width']:'',
					'height' => (isset($gxtb_fb_lB_data['rec_height'])) ? $gxtb_fb_lB_data['rec_height']:'',
					'colorscheme' => (isset($gxtb_fb_lB_data['rec_color'])) ? $gxtb_fb_lB_data['rec_color']:'light',
					'font' => (isset($gxtb_fb_lB_data['rec_font'])) ? $gxtb_fb_lB_data['rec_font']:'',
					'border_style' => (isset($gxtb_fb_lB_data['rec_border'])) ? $gxtb_fb_lB_data['rec_border']:'',
					'border_color' => '',
					'scrolling' => 0,
					'frameborder' => '',
					'overflow' => 'hidden',
					'trans' => '',
					'css' => (isset($gxtb_fb_lB_data['rec_css'])) ? $gxtb_fb_lB_data['rec_css']:'',
					'ref' => ''
				),
				'ActivityFeed' => array (
					'title' => '',
					'site' => (version_compare( $wp_version, '3.0', '>=' )) ? get_home_url() : get_bloginfo('url'),
					'width' => '',
					'height' => '',
					'header' => 0,
					'colorscheme' => 'light',
					'font' => '',
					'border_style' => '',
					'border_color' => '',
					'scrolling' => 0,
					'frameborder' => '',
					'overflow' => 'hidden',
					'trans' => 0,
					'recommendations' => 0,
					'filter' => '',
					'css' => '',
					'ref' => ''
				)
			);
	update_option('GBLikeButtonWidget', $this->GBLikeButtonWidget);
	delete_option('gxtb_fb_lB_data');
	if($message) { $this->GBWidgetCleaner_Message(sprintf( "%s '%s' [v%s] %s!", __('Successfully cleaned all the', gxtb_fb_lB_lang), gxtb_fb_lB_name,  gxtb_fb_lB_version, __('Widget-Settings', gxtb_fb_lB_lang))); }
	
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBWidgetCleaner[ACTION]: obsolete Options restored and deleted afterwards - complete');	}

} else {
	if($message) { $this->GBWidgetCleaner_Message(sprintf( "%s '%s' [v%s] %s!", __('Already cleaned all the', gxtb_fb_lB_lang), gxtb_fb_lB_name,  gxtb_fb_lB_version, __('Widget-Settings', gxtb_fb_lB_lang))); }	
} // end if
} // end function

function GBWidgetCleaner_Reset() {
	
	delete_option('GBLikeButtonWidget');
	
	$this->GBWidgetCleaner_Add();	
	$this->GBWidgetCleaner_Message(sprintf( "%s '%s' [v%s] %s!", __('Successfully reset all the', gxtb_fb_lB_lang), gxtb_fb_lB_name,  gxtb_fb_lB_version, __('Widget-Settings', gxtb_fb_lB_lang)));
	
if(GBLikeButton_Log) { _log('[Like-Button-Plugin-For-Wordpress] 	GBWidgetCleaner[ACTION]: Options Reset - complete'); }	
} // end function

final function GBWidgetCleaner_Message($message = "") {
	if ($message == "" ) { return; }
	global $GBMessage;
	$GBMessage->message .= "{$message}<br><br>";
} // end function
} // end class
} // end if-class
?>