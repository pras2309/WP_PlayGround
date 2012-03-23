<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	GB-World-FeedReader [v1.5]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for GB-World-WP-Plugins
+----------------------------------------------------------------+
*/

/* notice: http://www.noupe.com/jquery/the-power-of-wordpress-and-jquery-30-useful-plugins-tutorials.html */

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	     SUPPORT-CLASS			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

if (!class_exists('gxtb_FRClass')) {

class gxtb_FRClass {
	
	var $feed;

function gxtb_FRClass () {
	
$this->feed[0] = "";
$this->feed[1] = "";
$feedurl[0] = "http://www.gb-world.net/topic/projects/development/feed/";
$feedurl[1] = "http://feeds.feedburner.com/GBWorldnet";
$count = 0;

require_once( ABSPATH . WPINC . '/feed.php' ); 

while ($count < 2) {

$this->feed[$count] .= '<ul class="gxtb_feed">'; ?>

	<?php $max_items = 0; ?>
	<?php if ( function_exists( 'fetch_feed' ) ) { 
		
		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed( $feedurl[$count] );
		if ( !is_wp_error( $rss ) ) { // Checks that the object is created correctly 
		    // Figure out how many total items there are, but limit it to 5. 
		    $max_items = $rss->get_item_quantity(5);
		    $rss_items = $rss->get_items( 0, $max_items ); 
		}
	
	    if ( $max_items == 0 ) {
			$this->feed[$count] .= '<li class="ajax-error">No feed items found to display or you are offline.</li>';
	    } else {
		    // Loop through each feed item and display each item as a hyperlink.
			$z = 0;
		    foreach ( $rss_items as $item ) { 			
			
			$this->feed[$count] .= '
		    <li>
				<a target="_blank" href="'. $item->get_permalink() .'?ref=likebuttonplugin" title=" Posted '. $item->get_date('j F Y | g:i a') .'">'
				. $item->get_title() .'
				</a>
		    </li>';
			$z += 1;
			} 
		}
    } else { 
    	$this->feed[$count] .= '<li class="ajax-error">No feed items found to display.</li>';
    }
	
$this->feed[$count] .= '</ul>';
$count += 1;

	} // end for
} // end function

function gxtb_reader($i) {

echo $this->feed[$i];

} // end function
} // end class
} // end if-class
?>