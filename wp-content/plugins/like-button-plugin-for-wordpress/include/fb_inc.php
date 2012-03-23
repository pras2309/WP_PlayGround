<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.4] - Functions [v0.5]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    GBLikeButton			 ###########
###########			global plugin		 ###########
###########				functions		 ###########
####################################################
####################### by gb-world.net ############
####################################################

/*
## Inspired by the Plugin: Facebook Like Button (by Ahmed Hussein) ##
File Name: local.inc.php
Descrption: Get facebook locals
By: Anty (mail@anty.at)
*/

## WP 3.0+ Update: http://wpquestions.com/question/show/id/1925 ##
if(!function_exists('GBLikeButton_Language')) {
function GBLikeButton_Language() {
	
	 if( !class_exists( 'WP_Http' ) )
        include_once( ABSPATH . WPINC. '/class-http.php' );
		# include_once(ABSPATH .'wp-includes/class-snoopy.php');
    
    $locales = array();
	$localesArray = array();

   # $snoopy = new Snoopy;
	$request = new WP_Http;
    $result = $request->request( 'http://www.facebook.com/translations/FacebookLocales.xml' );
 /*   if($snoopy->fetch("http://www.facebook.com/translations/FacebookLocales.xml")) {
        $facebookLocales = $snoopy->results; */
	#if($result) {
        $facebookLocales = $result['body'];	
	
	preg_match_all('/<locale>\s*<englishName>([^<]+)<\/englishName>\s*<codes>\s*<code>\s*<standard>.+?<representation>([^<]+)<\/representation>/s', utf8_decode($facebookLocales), $localesArray, PREG_PATTERN_ORDER);

        foreach ($localesArray[1] as $i => $englishName) {
            $locales[$localesArray[2][$i]] = $englishName;
        }
   # }

    if ($locales == array()) {
		$locales['en_US'] = "English (US)";
    }

	#http://www.php.net/manual/de/function.sort.php
	ksort($locales, SORT_STRING);
    return $locales;
}
} // end if
if(!function_exists('GBLikeButton_JavaSDK')) {
function GBLikeButton_JavaSDK() {
$GBLikeButton = get_option('GBLikeButton');
if($GBLikeButton['General']['jdk'] == 1 && $GBLikeButton['OpenGraph']['app_id'] != "" ) {
?>
<!-- Google Analytics Social Button Tracking -->
<?php
	wp_print_scripts('gb-socialtracking');
?>
<div id="fb-root"></div>
<script type="text/javascript">
/* <![CDATA[ */
    window.fbAsyncInit = function() {
        FB.init({appId: '<?php echo $GBLikeButton['OpenGraph']['app_id']; ?>', status: true, cookie: true,
                         xfbml: true});
		_ga.trackFacebook();
		<?php if(isset($GBLikeButton['Expert']['customchannel']) && $GBLikeButton['Expert']['customchannel'] != "") { ?>
		channelUrl  : '<?php echo $GBLikeButton['Expert']['customchannel']; ?>'  // custom channel
		<?php } ?>
    };
    (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
            '//connect.facebook.net/<?php
	  if ($GBLikeButton['General']['language'] != "") { echo $GBLikeButton['General']['language']; } else { echo "en_US"; }  ?>/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());
/* ]]> */
</script>
<?php
	} // end jdk/app_id
} // end function
} // end if
if(GBLikeButton_Debug) { if(isset($_GET['gb-tools']) && $_GET['gb-tools'] == "export") { return GBLikeButton_ExportSettings(); } }
if(!function_exists('GBLikeButton_ExportSettings')) {
function GBLikeButton_ExportSettings() { #http://www.scribd.com/doc/60216932/155/Using-ajax-to-Download-text# # http://stackoverflow.com/questions/4683233/forcing-a-file-to-download-via-jquery #
header('Content-disposition: attachment; filename=likebutton_settings.txt');
header('Content-type: text/plain');
echo "Export finished";
} // end function
} // end if

## Debugging-Method ##
if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}
?>