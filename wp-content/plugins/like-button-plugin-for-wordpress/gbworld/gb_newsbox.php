<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	GB-World-Newsbox [v3.5]
+	by Stefan Natter (http://www.gb-world.net)
+   required for GB-World-WP-Plugins
+----------------------------------------------------------------+
*/
if(!class_exists('gxtb_NewsClass')) {
class gxtb_NewsClass {
function gxtb_NewsClass() {
?>
	<ul type="circle">
			<li>	
<?php
$news = @file_get_contents("http://stats.gb-world.net/wordpress/index.php?language=" . __('en', gxtb_fb_lB_lang) );

if (strpos($http_response_header[0], "200")) { 
   echo '<div class="gbnews">' . $news . '</div>';
} else { 
	_e('Currently there are no new updates or news available or you are offline!', gxtb_fb_lB_lang );
}
?>		
			</li>
		</ul>
<!-- 										## GB-Newsbox 3.5  ##											  -->
<!-- ######################################################################################################## -->
<?php 
	} // end function
} // end class
} // end if-class
?>