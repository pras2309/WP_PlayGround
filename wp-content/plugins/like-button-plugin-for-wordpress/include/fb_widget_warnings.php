<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.0] - GB-Warning-System [v1.0] 
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

if (!class_exists('class gxtb_fb_lB_WidgetClassWarning') && class_exists('gxtb_fb_lB_WAClass') ) {
class gxtb_fb_lB_WidgetClassWarning { //extends gxtb_fb_lB_WAClass { --> currently this is not needed because the warning-class is completely public/static

## global Variable
	var $Widget_MaxWarnings;

## Konstruktor
function gxtb_fb_lB_WidgetClassWarning() {
	global $Widget_MaxWarnings;
	$Widget_MaxWarnings = 0;
}

## Settings-Funktion
function gxtb_fb_lB_SetMaxWarnings ($count) {
	global $Widget_MaxWarnings;
	$Widget_MaxWarnings += $count;
}
function gxtb_fb_lB_GetMaxWarnings () {
	global $Widget_MaxWarnings;
	return $Widget_MaxWarnings;
}

## Class-Action
function gxtb_fb_lB_WidgetWarningCheck(){

	// get the WidgetWarnings-Variable
	global $Widget_MaxWarnings;
	
	// get the several options
	$gxtb_fb_lB_warning = get_option('gxtb_fb_lB_warning');
	$gxtb_fb_lB_data = get_option('gxtb_fb_lB_data');
	
#####################################################################################
						## possible warnings ##

  ## 1. und 2. Fehler: Titel oder URL ist nicht ausgefüllt
	if ( $gxtb_fb_lB_data['title'] == "" || $gxtb_fb_lB_data['url'] == "" ) {
		$gxtb_fb_lB_warning["<b>FB-Widget</b> -> Required fields"] = __("If you use the Sidebar-Widget you have to enter a title and the URL. This two settings are required.", gxtb_fb_lB_lang);
		$gxtb_fb_lB_warning['warning'] += 1;
		$Widget_MaxWarnings += 1;
	} else {
		unset($gxtb_fb_lB_warning["<b>FB-Widget</b> -> Required fields"]);
		$gxtb_fb_lB_warning['warning'] -= 1;
		$Widget_MaxWarnings -= 1;
	}

  ## 3. Fehler: Fehlerhafte URL (ohne http)
	if ( isset($gxtb_fb_lB_data['url']) && !strstr( $gxtb_fb_lB_data['url'], 'http://' ) ) {
		$gxtb_fb_lB_warning["<b>FB-Widget</b> -> URL"] = __("Do not forget to enter <b>http://</b> in the URL-box. Otherwise it will not work.", gxtb_fb_lB_lang);
		$gxtb_fb_lB_warning['warning'] += 1;
		$Widget_MaxWarnings += 1;
	} else {
		unset($gxtb_fb_lB_warning["<b>FB-Widget</b> -> URL"]);
		$gxtb_fb_lB_warning['warning'] -= 1;
		$Widget_MaxWarnings -= 1;
	}

  ## 4a. Fehler: REF aktiviert aber Box leer
	if( isset($gxtb_fb_lB_data['ref_activ']) && $gxtb_fb_lB_data['ref_activ'] && $gxtb_fb_lB_data['ref'] == "" ) {
		$gxtb_fb_lB_warning["<b>FB-Widget</b> -> REF Error #1"] = __("If you activate the REF-Attribute you have to enter sth. into the Ref-Box on the right.", gxtb_fb_lB_lang);
		$gxtb_fb_lB_warning['warning'] += 1;
		$Widget_MaxWarnings += 1;
	} else {
		unset($gxtb_fb_lB_warning["<b>FB-Widget</b> -> REF Error #1"]);
		$gxtb_fb_lB_warning['warning'] -= 1;
		$Widget_MaxWarnings -= 1;
	}
	
  ## 4b Fehler: REF NICHT aktiviert aber Box ist nicht leer
	if( isset($gxtb_fb_lB_data['ref']) && $gxtb_fb_lB_data['ref'] != "" && !$gxtb_fb_lB_data['ref_activ'] ) {
		$gxtb_fb_lB_warning["<b>FB-Widget</b> -> REF Error #2"] = __("If you enter a REF-Attribute you have to activate the REF-Attribute by activating the checkbox on the left.", gxtb_fb_lB_lang);
		$gxtb_fb_lB_warning['warning'] += 1;
		$Widget_MaxWarnings += 1;
	} else {
		unset($gxtb_fb_lB_warning["<b>FB-Widget</b> -> REF Error #2"]);
		$gxtb_fb_lB_warning['warning'] -= 1;
		$Widget_MaxWarnings -= 1;
	}


	// save the options
	update_option('gxtb_fb_lB_warning', $gxtb_fb_lB_warning);
	
}

} // end class
} // end if-class  
?>