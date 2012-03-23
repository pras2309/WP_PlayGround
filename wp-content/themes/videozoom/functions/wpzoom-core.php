<?php 
/* Register Sidebars  */
if ( function_exists('register_sidebar') )

register_sidebar(array('name'=>'Sidebar',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '<div class="cleaner">&nbsp;</div>
              </div>',
'before_title' => '<p class="header">',
'after_title' => '</p>',
));

register_sidebar(array('name'=>'Footer: Column 1',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="header">',
'after_title' => '</p>',
));

register_sidebar(array('name'=>'Footer: Column 2',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="header">',
'after_title' => '</p>',
));

register_sidebar(array('name'=>'Footer: Column 3',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="header">',
'after_title' => '</p>',
));

register_sidebar(array('name'=>'Footer: Column 4',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="header">',
'after_title' => '</p>',
));


/* Custom Menu (WP 3.0+) */
if (function_exists('register_nav_menus')) {
register_nav_menus( array(
		'secondary' => __( 'Top Menu', 'wpzoom' ),
		'primary' => __( 'Main Menu', 'wpzoom' ),
	) );
}
/* Post Thumbnail (WP 2.9+) */
if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 9999, 9999, true ); // Normal post thumbnails, set to maximum size, then will be cropped with TimThumb script
}

	
if ( function_exists( 'add_custom_background'  ) ) { 
// This theme allows users to set a custom background. Added in 3.0
add_custom_background();
}


/* Reset default WP styling for [gallery] shortcode */   
add_filter('gallery_style', create_function('$a', 'return "
<div class=\'gallery\'>";'));

/* Custom lenght for the_excerpt */ 
function new_excerpt_length($length) {
	return 80;
}

add_filter('excerpt_length', 'new_excerpt_length');


/* This allows to display only exact count of comments, without trackbacks */ 
function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$get_comments = get_comments('post_id=' . $id);
		$comments_by_type = &separate_comments($get_comments);
 		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}
add_filter('get_comments_number', 'comment_count', 0);

/* WPZOOM Options Panel */
if (is_admin() && $_GET['activated'] == 'true') {
header("Location: admin.php?page=wpzoom_options");
}

if (is_admin() && $_GET['page'] == 'wpzoom_options') {
	add_action('admin_head', 'wpzoom_admin_css');
	// wp_enqueue_script('jquery');
	wp_enqueue_script('tabs', get_bloginfo('template_directory').'/wpzoom_admin/simpletabs.js');
}
	
function wpzoom_admin_css() {
	echo '
	<link rel="stylesheet" type="text/css" media="screen" href="'.get_bloginfo('template_directory').'/wpzoom_admin/options.css" />
	';
}

$functions_path = TEMPLATEPATH . '/wpzoom_admin/';
require_once ($functions_path . 'admin_functions.php');
$homepath = get_bloginfo('stylesheet_directory');

add_action('admin_menu', 'wpzoom_add_admin');

?>