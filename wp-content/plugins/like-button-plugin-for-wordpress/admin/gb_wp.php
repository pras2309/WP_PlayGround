<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
########################################################################################################

if(!class_exists('gxtb_fb_lB_WPClass')) {
class gxtb_fb_lB_WPClass {
function gxtb_fb_lB_WPClass() {
	
	echo sprintf( '%s <br><br>%s <a href="%s" target="_blank">%s</a>!', 
	__("If you find any bug then please report it. You can either post it on Wordpress or in our BugTracker-System! We would apreciate it if you report any bug!", gxtb_fb_lB_lang),
	__("Please visit our", gxtb_fb_lB_lang),
	'http://bugs.gb-world.net',
	'BugTracker'
	);
	
	
	// BugTracker-Feed-Reader [v1.0]
	require_once( ABSPATH . WPINC . '/feed.php' ); 
	
?>

<br /><br />
<u><?php _e("Latest WP-Reports", gxtb_fb_lB_lang); ?></u>
<br /><br />
<?php //if( !strstr(get_bloginfo('url'), "localhost") ){ ?>
<ul class="wordpress">

	<?php $max_items = 0; ?>
	<?php if ( function_exists( 'fetch_feed' ) ) { 
		
		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed( 'http://wordpress.org/support/rss/tags/like-button-plugin-for-wordpress' );
		if ( !is_wp_error( $rss ) ) { // Checks that the object is created correctly 
		    // Figure out how many total items there are, but limit it to 5. 
		    $max_items = $rss->get_item_quantity(3);
		    $rss_items = $rss->get_items( 0, $max_items ); 
		}
	
	    if ( $max_items == 0 ) {
			echo '<li class="ajax-error">';
				_e('Currently there are no reported bugs or you are offline.', gxtb_fb_lB_lang);
			echo '</li>';
	    } else {
		    // Loop through each feed item and display each item as a hyperlink.
		    foreach ( $rss_items as $item ) { ?>
		    <li>
				<a class="gxtb_feed fancylink_iframe" href='<?php echo $item->get_permalink(); ?>' title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'><?php echo $item->get_title(); ?></a>
		    </li><?php 
			} 
		}
    } else { 
			echo '<li class="ajax-error">';
				_e('Currently there are no reported bugs.', gxtb_fb_lB_lang);
			echo '</li>';
    } ?>
</ul>
<?php
/* } else {

	echo "<em>";
	_e('The official BugTracker-list is not available for the localhost-mode (with xampp for example).', gxtb_fb_lB_lang);
	echo "</em>";

} // end if
*/
} // end function
} // end class
} // end if-class ?>