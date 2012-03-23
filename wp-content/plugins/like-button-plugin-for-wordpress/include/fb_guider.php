<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.4] - LB-Guider [v0.5]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    GBLikeButton			 ###########
###########			GUIDE				 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if(!function_exists('GBLikeButton_Guider')) {
function GBLikeButton_Guider() {
	
	if(!isset($_GET['fbguide']) || ( isset($_GET['fbguide']) && !$_GET['fbguide']) ) {return;}
	if(isset($_GET['fbguide']) && $_GET['fbguide']) {
		
		global $current_screen;
		$text = array(
			"thanks" => __('No thanks', gxtb_fb_lB_lang),
			"next" => __('Next', gxtb_fb_lB_lang),
			"stop" => __('Stop', gxtb_fb_lB_lang),
			"close" => __('Close', gxtb_fb_lB_lang)
			);
		$currentpage = $current_screen->id;
?>
<script type="text/javascript">
var GBLikeButton=jQuery.noConflict();
GBLikeButton(document).ready(function(){
/* <![CDATA[ */
// ####################################################### \\

// @Author: Stefan Natter
// Version 0.1
// http://www.gb-world.net
// for the WP-Plugin: Like-Button-Plugin-For-Wordpress by Stefan Natter
// ####################################################### \\
<!-- ======================== SCRIPT ======================== -->

    /**
	 * Source: http://jeffpickhardt.com/guiders/
	 * Source: https://github.com/jeff-optimizely/Guiders-JS#readme
     * Guiders are created with guiders.createGuider({settings}).
     *
     * You can show a guider with the .show() method immediately
     * after creating it, or with guiders.show(id) and the guider's id.
     *
     * guiders.next() will advance to the next guider, and
     * guiders.hideAll() will hide all guiders.
     *
     * By default, a button named "Next" will have guiders.next as
     * its onclick handler.  A button named "Close" will have
     * its onclick handler set to guiders.hideAll.  onclick handlers
     * can be customized too.
     */
  <?php if(isset($_GET['page']) && $_GET['page'] == "fb-like-button") { ?> 
   
	// General //  
    guiders.createGuider({
      buttons: [{name: "<?php echo $text['thanks']; ?>", onclick: guiders.hideAll},
                {name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php echo sprintf('%s %s<br /><br />%s', gxtb_fb_lB_name, __('is one of the leading Wordpress Plugins with a Like-Button Integration and more. It provides a simple and powerful backend and many more.', gxtb_fb_lB_lang),__('This Guide helps you to learn how to use this powerful plugin best way and without problems. If you have any problems do not hesitate to contact us.', gxtb_fb_lB_lang)); ?>",
      id: "first",
      next: "second",
      overlay: true,
      title: "<?php echo sprintf('%s %s!', __('Welcome to', gxtb_fb_lB_lang), gxtb_fb_lB_name); ?>"
    }).show();
    
    guiders.createGuider({
      attachTo: "#general_jdk_desc",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php echo sprintf('%s: %s <br /><br />%s<br /><br /><b>%s:</b><br />%s',
	  __('First of all you have to decide if you use the XFBML or iFrame Version of the Like-Button', gxtb_fb_lB_lang),
	  __('There are a few differences between this two versions and also restrictions and modifications you have to make (if use the XFBML for example).', gxtb_fb_lB_lang),
	  __('If you are not sure which one you should use try both of them and then decide. Recommended Version: XFBML', gxtb_fb_lB_lang),
	  __('By the way', gxtb_fb_lB_lang),
	  __('If you want to add something beside the Like-Button <i>(for example a Twitter or +1 Button)</i> you can take a look at the Expert-Side and enter something into the Textarea. Everything inside this Textarea will be added beside the button.', gxtb_fb_lB_lang)); ?>",
      id: "second",
      next: "third",
      position: 3,
      title: "<?php echo sprintf('%s', __('Installation', gxtb_fb_lB_lang)); ?>"
    });
    
    guiders.createGuider({
      attachTo: "#general_language",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php echo sprintf('%s', __('You can now choose any supported language of the Like Button.', gxtb_fb_lB_lang)); ?>",
      id: "third",
      next: "viert",
      position: 3,
      title: "<?php echo sprintf('%s',__('Set the Like-Button language', gxtb_fb_lB_lang)); ?>"
    });
    
    guiders.createGuider({
      attachTo: "#general_sposition",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php echo sprintf('%s', __('Now you have to decide whether you want to have your Social Button before or after the Content.', gxtb_fb_lB_lang)); ?>",
      id: "viert",
      next: "g_appearance",
      position: 3,
      title: "<?php echo sprintf('%s',__('Button Position', gxtb_fb_lB_lang)); ?>"
    });
    
    guiders.createGuider({
      attachTo: "#general_appearance",
      buttons: [{name: "<?php echo $text['stop']; ?>", onclick: guiders.hideAll},
                {name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php echo sprintf('%s', __('If you want that the Social Button appears on your Frontpage just activate the Frontpage Checkbox. The same happens with the other types of pages.', gxtb_fb_lB_lang)); ?>",
      id: "g_appearance",
      next: "g_generator",
      position: 12,
      title: "<?php echo sprintf('%s', __('Button Appearance', gxtb_fb_lB_lang)); ?>"
    });
    
	// Generator //
    guiders.createGuider({
      attachTo: "#gb_fb_generator",
      buttons: [{name: "<?php echo $text['stop']; ?>", onclick: guiders.hideAll},
                {name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php echo sprintf('%s<br /><br /><i>%s: %s</i>', __('This Generator helps you - with a live preview - to create and generate a Like-Button for your Website. Just fill in the required infos (like height, width) and (un)check the options you need and thats it!', gxtb_fb_lB_lang), __('Important', gxtb_fb_lB_lang), __('The Send-Button works only in combination with the XFBML-Button.', gxtb_fb_lB_lang)); ?>",
      id: "g_generator",
      next: "design_css",
      position: 12,
      title: "<?php _e('Like-Button-Generator', gxtb_fb_lB_lang); ?>"
    });
    
	// Design //
    guiders.createGuider({
      attachTo: "#design_css",
      buttons: [{name: "<?php echo $text['stop']; ?>", onclick: guiders.hideAll},
                {name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php _e('The Design-Options provide the opportunities to choose a CSS-Class and also the breaks (before and after) for your Social Button.', gxtb_fb_lB_lang); ?>",
      id: "design_css",
      next: "meta_appid",
      position: 12,
      title: "<?php _e('FB-Button-Design', gxtb_fb_lB_lang); ?>"
    });
    
	// OpenGraph //
    guiders.createGuider({
      attachTo: "#app_id",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php echo sprintf('%s', __("One of the most important Meta-Tag is the <b>App-ID</b>. You need if for the XFBML-Button - but it is recommended to use it for the iFrame-Button too!<br />If you do not already have a valid App-ID you have to create one.<br /><br />Read through the Description below 'Important Information and Help' for more detailed information.", gxtb_fb_lB_lang)); ?>",
      id: "meta_appid",
      next: "meta_sitename",
      position: 3,
      title: "<?php _e('FB-Open Graph Protocol', gxtb_fb_lB_lang); ?>"
    });
	
    guiders.createGuider({
      attachTo: "#gxtb_fb_lB_meta_site_name",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php _e("This three tags are also required beside a valid App-ID (or another ID above). You can either way use one of the Shortcodes <i>(Shortcode: &#036;binfo)</i> which creates dynamic tags for each page/post or enter a static value.<br /><br /><b>How to use the Shortcodes</b><br />You just have to enter<i> - for example &#036;ptitle - </i>into the textbox. If you want that the Page-Title is dynamic for every post/page then you just have to enter &#036;ptitle into the Page-Title Textbox and you're done.", gxtb_fb_lB_lang); ?>",
      id: "meta_sitename",
      next: "meta_type",
      position: 3,
      title: "<?php _e('FB-Open Graph Protocol', gxtb_fb_lB_lang); ?>"
    });
	
    guiders.createGuider({
      attachTo: "#gxtb_fb_lB_meta_type",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php _e("You have to choose a page type for each of this five types. Depending on the type a 'like' appears different on Facebook. If you are not sure how you want to be presented on Facebook try some of them and like something by yourself.", gxtb_fb_lB_lang); ?>",
      id: "meta_type",
      next: "meta_description",
      position: 3,
      title: "<?php _e('FB-Open Graph Protocol', gxtb_fb_lB_lang); ?>"
    });
	
    guiders.createGuider({
      attachTo: "#description",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php _e('Now choose a description below <i>(for example: Blog-Description)</i> or choose a dynamic description <i>(for example: Excerpt)</i> or enter a static one. You can also disable the description if you want to use the &quot;normal&quot; description tag instead.', gxtb_fb_lB_lang); ?>",
      id: "meta_description",
      next: "meta_img",
      position: 12,
      title: "<?php _e('FB-Open Graph Protocol', gxtb_fb_lB_lang); ?>"
    });
	
    guiders.createGuider({
      attachTo: "#gxtb_fb_lB_meta_image",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php _e('You have provide a image for the Like Button because otherwise the Button will take a random image from your website. Just enter a valid and full URL <i>(including http://)</i> of your default image and choose where it should appear </i>(Frontpage, Page,...)</i>. If you hide it on a specific type you have to remember that you have to enter a image by yourself everytime when you create/edit a new page/post.', gxtb_fb_lB_lang); ?>",
      id: "meta_img",
      next: "meta_infohelp",
      position: 12,
      title: "<?php _e('FB-Open Graph Protocol', gxtb_fb_lB_lang); ?>"
    });
	
    guiders.createGuider({
      attachTo: "#meta_infohelp",
      buttons: [{name: "<?php echo $text['stop']; ?>", onclick: guiders.hideAll},
                {name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php _e('There are many information blocks which provides many important information and tips!', gxtb_fb_lB_lang); ?>",
      id: "meta_infohelp",
      next: "gb_fb_development",
      position: 12,
      title: "<?php _e('FB-Open Graph Protocol', gxtb_fb_lB_lang); ?>"
    });
	
	// Additional Help //
    guiders.createGuider({
      attachTo: "#gb_fb_development",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php _e('This new Sidebar provides up2date information about this plugin and the development process including upates, bugfixes and patches.', gxtb_fb_lB_lang); ?>",
      id: "gb_fb_development",
      next: "gb_fb_activity",
      position: 9,
      title: "<?php _e('Whats new?', gxtb_fb_lB_lang); ?>"
    });
	
    guiders.createGuider({
      attachTo: "#gb_fb_activity",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php _e('This new Sidebar provides up2date information of the Social Actitives on your blog (only Facebook Activites).', gxtb_fb_lB_lang); ?>",
      id: "gb_fb_activity",
      next: "contact",
      position: 9,
      title: "<?php _e('Whats new?', gxtb_fb_lB_lang); ?>"
    });
	
    guiders.createGuider({
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php _e('If you need help, want to report a bug or anything else you can contact us via the our contact form!', gxtb_fb_lB_lang); ?>",
      id: "contact",
      next: "paypalpic",
      overlay: true,
      title: "<?php echo sprintf('%s', __('Need help?', gxtb_fb_lB_lang), gxtb_fb_lB_name); ?>"
    });
	
    guiders.createGuider({
      attachTo: "#paypalpic",
      buttons: [{name: "<?php echo $text['close']; ?>", onclick: guiders.hideAll}],
      description: "<?php _e('I invested a lot of time and work in this plugin and I would appreciate it a lot if you could support me and my work!', gxtb_fb_lB_lang); ?>",
      id: "paypalpic",
      position: 9,
      title: "<?php echo sprintf('%s', __('Please support me', gxtb_fb_lB_lang), gxtb_fb_lB_name); ?>"
    });
	
<?php } else if(isset($_GET['page']) && $_GET['page'] == "fb-like-settings") {  ?>

	// General //  
    guiders.createGuider({
      buttons: [{name: "<?php echo $text['thanks']; ?>", onclick: guiders.hideAll},
                {name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php echo sprintf('%s %s<br /><br />%s', gxtb_fb_lB_name, __('is one of the leading Wordpress Plugins with a Like-Button Integration and more. It provides a simple and powerful backend and many more.', gxtb_fb_lB_lang),__('This Guide helps you to learn how to use this powerful plugin best way and without problems. If you have any problems do not hesitate to contact us.', gxtb_fb_lB_lang)); ?>",
      id: "first",
      next: "gb_cleaner",
      overlay: true,
      title: "<?php echo sprintf('%s %s!', __('Welcome to', gxtb_fb_lB_lang), gxtb_fb_lB_name); ?>"
    }).show();
	
    guiders.createGuider({
      attachTo: "#gxtb_run_cleaner",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php _e('This new Tools help you to fix, prevent bugs and update your database to the latest version if something went wrong during the update/installation. You can also use this tools to reset or delete Settings.', gxtb_fb_lB_lang); ?>",
      id: "gb_cleaner",
      next: "pluginsetting_Userlevel",
      position: 3,
      title: "<?php _e('Whats new?', gxtb_fb_lB_lang); ?>"
    });
	
    guiders.createGuider({
      attachTo: "#pluginsetting_Userlevel",
      buttons: [{name: "<?php echo $text['next']; ?>", onclick: guiders.next}],
      description: "<?php _e('This is one of the latest options available from the version [v4.5] on.<br /><br />It is now possible for example to choose the required Userlevel to change any settings, the priority level of the Plugin <i>(helps to adjust the position of the button more precisely)</i>.', gxtb_fb_lB_lang); ?>",
      id: "pluginsetting_Userlevel",
      next: "gb_fb_functions",
      position: 3,
      title: "<?php _e('Whats new?', gxtb_fb_lB_lang); ?>"
    });
	
    guiders.createGuider({
      attachTo: "#gb_fb_functions",
      buttons: [{name: "<?php echo $text['close']; ?>", onclick: guiders.hideAll}],
      description: "<?php _e('It is now also possible to switch all functions on and off <i>(seperate of each other)</i>.<br /><br />You can - for example - use only the Button-Output and create the OpenGraph-Tags by your own or via another plugin if you want to.', gxtb_fb_lB_lang); ?>",
      id: "gb_fb_functions",
      position: 12,
      title: "<?php _e('Whats new?', gxtb_fb_lB_lang); ?>"
    });

<?php } else if(is_admin() && strstr($_SERVER["REQUEST_URI"],"edit.php")) { ?>
    guiders.createGuider({
      buttons: [{name: "<?php echo $text['close']; ?>", onclick: guiders.hideAll}],
      description: "<?php _e('As you can see on the right of the table there is a new column. In this column there are several Social Buttons to provide a little Social Button Analysis for each post/page.<br /><br />If you do not like/need it anymore you can disbale this Analyse on the Settings-Page.', gxtb_fb_lB_lang); ?>",
      id: "fb_social_title",
      overlay: true,
      title: "<?php echo sprintf('%s<br />%s', gxtb_fb_lB_name, __("Social Button Analysis", gxtb_fb_lB_lang)); ?>"
    }).show();			
<?php } else if(is_admin() && $currentpage = "dashboard") { ?>
    guiders.createGuider({
      attachTo: "#fb_activity",
      buttons: [{name: "<?php echo $text['close']; ?>", onclick: guiders.hideAll}],
      description: "<?php _e('This Dashboard-Widget displays the latest Social Activities on your blog <i>(including Facebook and StumpleUpon)</i>.', gxtb_fb_lB_lang); ?>",
      id: "fb_activity",
      position: 3,
      title: "<?php echo sprintf('%s<br />%s', gxtb_fb_lB_name, __("Dashboard Widget", gxtb_fb_lB_lang)); ?>"
    }).show();
<?php }	?>
/* ]]> */
});
</script>
<?php
	} // end if
} // end function
} // end if
?>