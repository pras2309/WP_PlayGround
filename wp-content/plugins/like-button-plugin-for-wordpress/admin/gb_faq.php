<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-FAQ-Page [v0.3]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

########################################################################################################
											## FAQ  ##
// How-to-Call a function:
// gxtb_fb_lB_mBClass::gxtb_sidebox_1();

//below you will find for each registered metabox the callback method, that produces the content inside the boxes
//i did not describe each callback dedicated, what they do can be easily inspected and compare with the option page displayed

											## FAQ  ##
########################################################################################################


####################################################
####################################################
###########								 ###########
###########								 ###########
###########	   		FAQ-Class			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net 	############
####################################################

if (!class_exists('gxtb_fb_lB_FAQClass')) {
class gxtb_fb_lB_FAQClass {

########################################################################################################
											## FAQ-BOX  ##	
	var $pagehook;
	var $pagelevel;

function gxtb_fb_lB_FAQClass($pagelevel) {
	
		$this->pagelevel = $pagelevel;
		add_filter('screen_layout_columns', array(&$this, 'on_screen_layout_columns'), 10, 2);
		$this->pagehook = add_submenu_page("fb-like-button", 'FB-FAQ', __('FAQ - Help', gxtb_fb_lB_lang), $this->pagelevel, 'fb-like-faq', array(&$this, 'on_show_page'));
		add_action('load-'.$this->pagehook, array(&$this, 'on_load_page'));
		
		global $screen_layout_columns;
		$screen_layout_columns = 2;

}	
function on_screen_layout_columns($columns, $screen) {
		if ($screen == $this->pagehook) {
			$columns[$this->pagehook] = 2;
		}
		return $columns;
}
function on_load_page() {
		add_meta_box('gb_fb_faq', __('FB-Button - FAQ', gxtb_fb_lB_lang), array(&$this, 'GBLikeButton_FAQContent'), $this->pagehook, 'first', 'core');	
		add_meta_box('gb_fb_video', __('FB-Button - Tutorial', gxtb_fb_lB_lang), array(&$this, 'gxbt_video_content'), $this->pagehook, 'video', 'core');
		add_meta_box('gb_mediawiki', __('GB-Wiki', gxtb_fb_lB_lang), array(&$this, 'gxbt_mediawiki_content'), $this->pagehook, 'iframe', 'core');	
		add_meta_box('gb_bugtracker', __('GB-BugTracker', gxtb_fb_lB_lang), array(&$this, 'gxbt_bugtracker_content'), $this->pagehook, 'iframe', 'core');	
}
function on_show_page() {
			include_once('gb_admin_sidebar.php');
global $screen_layout_columns;
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<form method="post" class="formlyWrapper-Base" action="<?php echo admin_url( 'admin.php?page=fb-like-faq' ); ?>" name="settingpage" id="settingpage" class="settingpage">
<?php gb_admin_header::gb_admin_title(); ?> 
<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
		<div id="poststuff" class="metabox-holder" style="width: 100%;">
				<!-- Sidebar -->
				<div id="side-info-column" class="inner-sidebar">
					<?php
					    do_meta_boxes($this->pagehook, 'additional_fb', "");
						do_meta_boxes($this->pagehook, 'additional_support', "");
						do_meta_boxes($this->pagehook, 'additional_development', "");
						do_meta_boxes($this->pagehook, 'additional_fb_activity', "");
						do_meta_boxes($this->pagehook, 'additional_bugs', "");
						do_meta_boxes($this->pagehook, 'additional_fans', "");
						do_meta_boxes($this->pagehook, 'additional_settings', "");
					?>
				</div>
				<!-- /Sidebar -->
				<!-- Content -->
					<div id="post-body" class="has-sidebar" style="background-color:#eeeeee;">
						<div id="post-body-content" class="has-sidebar-content">
                        	<?php do_meta_boxes($this->pagehook, 'first', ""); ?>	
                       		<?php do_meta_boxes($this->pagehook, 'video', ""); ?>
                            <?php do_meta_boxes($this->pagehook, 'iframe', ""); ?>						
						</div>
					</div>
				<!-- /Content -->
				<br class="clear"/>
		</div>
<div class="plugin-version">
	<a href="#plugininfo" class="fancylink" title="Created by Stefan N."><?php echo gxtb_fb_lB_name; ?> - v<?php echo gxtb_fb_lB_version; ?></a>
</div>&nbsp;
</div>
</div>
<?php
	include('gb_admin_footer.php');
} // end konstruktor

function GBLikeButton_FAQContent() {
$FAQContent = array (
	array(	"type" => "open"),
			
	array(	"content" => __('How-To install and setup the Plugin', gxtb_fb_lB_lang),
			"tooltip" => '',
			"type" => "title"),	
			
	array(	"content" => sprintf('<ol class="gb-faq"><li>%s</li><li>%s</li><li>%s</li><li><b>%s</b><br><ul class="gb-faq"><li>%s</li><li>%s</li><li>%s</li><li>%s</li></ul></li></ol><ol class="gb-faq"><li value="5">%s<br><ul class="gb-faq"><li>%s <a href="'.admin_url().'admin.php?page=fb-like-opengraph#app_id">%s</a></li></ul></li></ol>',
		__('Download and Install the Plugin', gxtb_fb_lB_lang),
		__('Go to the General-Page and set all the required information and activate the Plugin with the first checkbox on this site. Now hit save and you are done!', gxtb_fb_lB_lang),
		__('You should now generate the Like Button with the Generator on the General-Page (take a look at the Facebook-Generator-FAQ below)', gxtb_fb_lB_lang),
		__('Facebook-Generator-FAQ', gxtb_fb_lB_lang),
		__('The URL must look like this and containt http:// -> http://www.gb-world.net - Otherwise the Button will not work properly.', gxtb_fb_lB_lang),
		__('Now choose your layout style, width, height, font, verb to display, color scheme and if faces should be shown.', gxtb_fb_lB_lang),
		__('Language: It is possible to choose a language for your button.', gxtb_fb_lB_lang),
		__('Dynamic Like-Button: Every page will have its own unique like-button if you activate this checkbox. Otherwise every page will use the same facebook-like-button.', gxtb_fb_lB_lang),
		__('After that visit the OpenGraph-Site and fill in all the Administrative and Blog-Tags correct.', gxtb_fb_lB_lang),
		__('Especially the', gxtb_fb_lB_lang),
		__('App-ID', gxtb_fb_lB_lang)),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => __('Information about XFBML (Java-SDK) and iFrame', gxtb_fb_lB_lang),
			"tooltip" => '',
			"type" => "title"),	
			
	array(	"content" => sprintf('<ul class="gb-faq"><li>%s</li></ul>',
	__('The basic Like button is available via a simple iframe you can drop into your page easily. A fuller-featured Like button is available via the <fb:like> XFBML tag and requires you use the new JavaScript SDK. The XFBML version allows users to add a comment to their like as it is posted back to Facebook. The XFBML version also dynamically sizes its height; for example, if there are no profile pictures to display, the plugin will only be tall enough for the button itself. (definition by Facebook)', gxtb_fb_lB_lang) ),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => __('Meta-Tag: App-ID', gxtb_fb_lB_lang),
			"tooltip" => '',
			"type" => "title"),	
			
	array(	"content" => sprintf('<ul class="gb-faq"><li>%s <a href="http://www.facebook.com/developers" target="_blank">%s</a> %s</li></ul>', __('You have to enable your domain as Connect-Domain of your FB-App. Visit the developer-page of your Facebook-App', gxtb_fb_lB_lang),
	'http://www.facebook.com/developers',
	__('and then click on your App and then on "Edit Settings". After that Step you have to visit "Web Site" and fill in the "Site Domain"-Option and also the "Site URL". After that your Domain is connected with your App. ', gxtb_fb_lB_lang)),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => __('[like]-Shortcode', gxtb_fb_lB_lang),
			"tooltip" => '',
			"type" => "title"),	
			
	array(	"content" => sprintf('<ul class="gb-faq"><li>%s</li><li>%s</li><li>%s:<br><pre class="brush:php; auto-links: false;">%s</pre></li></ul>',
	__('You only have to insert [like] into a post/article and your like-Button (generated with all your defined settings) will appear at this position', gxtb_fb_lB_lang),
	__('available Options: url, layout, action, width, height, style, div, besidebutton, xfbml', gxtb_fb_lB_lang),
	__('Example', gxtb_fb_lB_lang), "
[like]

or

[like url=http://www.gb-world.net layout=box_count action=recommend
xfbml=true
width=100 height=150
style=border:solid;float:right;padding-left:15px;
div=true
besidebutton=true]

" ),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => __("Template Function 'GBLikeButtonTemplate'", gxtb_fb_lB_lang),
			"tooltip" => '',
			"type" => "title"),	
			
	array(	"content" => sprintf('<ul class="gb-faq"><li>%s</li><li>%s</li><li>%s:<br><pre class="brush:php; auto-links: false;">%s</pre></li></ul>',
	__('You only have to insert <?php GBLikeButtonTemplate(); ?> somewhere in your template-files and your like-Button (generated with all your defined settings) will appear at this position', gxtb_fb_lB_lang),
	__('available Options: url, action, width, height, style, expert [besidebutton, div, xfbml]', gxtb_fb_lB_lang),/*socialspeedup,*/
	__('You have to set the values with an array like this: array("url" => "http://www.gb-world.net"). It does not work if you send the parameter like this to the function GBLikeButtonTemplate("http://www.gb-world.net")', gxtb_fb_lB_lang), "
GBLikeButtonTemplate();

or

GBLikeButtonTemplate(array( 'url' => 'http://www.gb-world.net',
'action' => 'recommend',
'width' => 250, 'height' => 200,
'style' => array('border' => 'solid', 'overflow' => 'hidden')));

or

GBLikeButtonTemplate(array( 'url' => 'http://www.gb-world.net', 'action' => 'like', 'width' => 80, 'height' => 20,
'style' => array('border' => 'solid', 'overflow' => 'hidden'),
'expert' => array( 'besidebutton' => false, 'div' => false, 'xfbml' => false)));


"), /* 'socialspeedup' => false, */
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => __('Facebook-Like-Button-Widget, Facebook Recommendations and Facebook Activity Feed', gxtb_fb_lB_lang),
			"tooltip" => '',
			"type" => "title"),	
			
	array(	"content" => sprintf('<ul class="gb-faq"><li>%s</li><li>%s</li></ul>',
	__('Go to the Widgets-Page on the left. Add the needed Widget and add the required information.', gxtb_fb_lB_lang),
	__('The URL must look like this and containt http:// -> http://www.gb-world.net - Otherwise the Button will not work properly.', gxtb_fb_lB_lang )),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => __('Important Notes', gxtb_fb_lB_lang),
			"tooltip" => '',
			"type" => "title"),	
			
	array(	"content" => sprintf('<ul class="gb-faq"><li>%s</li><li>%s</li><li>%s</li></ul>',
	__('You only have to enter one of this to Meta-Tags (Admin-ID or AppID) as long as you don not use the Java-SDK.', gxtb_fb_lB_lang),
	__('App-ID: If you want to use the Java-SDK you have to enter a valid Facebook-App-ID.', gxtb_fb_lB_lang ),
	__('Admin-ID: Facebook-Profile-IDs of all Administrators of this Like-Button.', gxtb_fb_lB_lang )),
			"smalltip" => "",
            "type" => "content"),


	array(	"type" => "close")			

);	
$this->GBLikeButton_FAQOutput($FAQContent);
}
function GBLikeButton_FAQOutput($FAQContent) {
	
	foreach ($FAQContent as $value) { 
	switch ( $value['type'] ) {
	
		case "open":
		?>
<table class="form-table gb-faq" border="0" id="gb-faq">
		<?php break;
		case "title":
		?>
		<tr>
        <td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php if(isset($value['tooltip']) && $value['tooltip'] != "") { ?> <span class="hotspot" onmouseover="tooltip.show('<?php echo $value['tooltip']; ?>');" onmouseout="tooltip.hide();">
            <?php echo $value['content']; ?></span> <?php }else{ echo $value['content']; } ?>
        </strong></td>
		<?php break;
			case 'content':
		?>                        
        <td width="80%" valign="middle">
			<?php /* echo $value['input']; ?>
            <br />
            <?php */ echo $value['content']; ?>
        </td>
        </tr>          
        <tr>
           <td class="gb-table-tipp"><small>
		   		<?php echo $value['smalltip']; ?>
            </small></td>
        </tr>
		<?php 
		break;
			case 'tooltip':
		?>
        	<span class="hotspot" onmouseover="tooltip.show('<?php echo $value['content']; ?>');" onmouseout="tooltip.hide();">
            <?php _e('Run GB-Cleaner:', gxtb_fb_lB_lang) ?></span> <input type="checkbox" class="checkbox" name="gxtb_run_cleaner" id="gxtb_run_cleaner" /> 
		<?php 
		break;
		case "close":
		?>
			</table>
		<?php break;		
} 
}
}

function gxbt_faq_content() {
		?>
<table class="form-table" style="width:100%;" border="0" id="gb-table">
<tbody>
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong>
								<?php _e('How do I activate the Like-Button?', gxtb_fb_lB_lang) ?>
							</strong>
						</td>
                        <td width="80%" valign="middle">
<pre class="brush:php; auto-links: false; highlight: [1,2]">

GBLikeButtonTemplate(array( 'url' => "http://www.gb-world.net", 'action' => 'recommend', 'width' => 250, 'height' => 200,
					'style' => array('border' => 'solid', 'overflow' => 'hidden')));

</pre>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>

                    <tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong>
								<?php _e('How do I activate the Like-Button?', gxtb_fb_lB_lang) ?>
							</strong>
						</td>
                        <td width="80%" valign="middle">
							<ol>
								<li><?php _e('Install the Plugin', gxtb_fb_lB_lang) ?></strong></li>
								<li><?php _e('Go to the Settings-Page and complete all the required information and activate the Plugin with the first checkbox on this site.', gxtb_fb_lB_lang) ?></li>
							</ol>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong>
								<?php _e('FB Button Settings', gxtb_fb_lB_lang) ?>
							</strong>
						</td>
                        <td width="80%" valign="middle">
							<ol>
             		        	<li><u><?php _e('Dynamic Like-Button', gxtb_fb_lB_lang); ?>:</u> <?php _e('Every page will have its own unique like-button if you activate this checkbox. Otherwise every page will use the same facebook-like-button.', gxtb_fb_lB_lang); ?></li>
                                <li><u><?php _e('Language', gxtb_fb_lB_lang); ?>:</u> <?php _e('It is possible to choose a language for your button. But keep in mind that you have to activate XFBML (Java-SDK) and you must have a valid appID.', gxtb_fb_lB_lang); ?></li>
							</ol>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong>
								<?php _e('XFBML (Java-SDK) or iFrame', gxtb_fb_lB_lang) ?>
							</strong>
						</td>
                        <td width="80%" valign="middle">
							<ol>
             		        	<li><?php _e('The basic Like button is available via a simple <b>iframe</b> you can drop into your page easily. A fuller-featured Like button is available via the <b>&lt;fb:like&gt; XFBML tag</b> and requires you use the new <b>JavaScript SDK</b>. The XFBML version allows users to add a <b>comment to their like as it is posted back to Facebook</b>. The XFBML version also <b>dynamically sizes its height</b>; for example, if there are no profile pictures to display, the plugin will only be tall enough for the button itself.', gxtb_fb_lB_lang) ?> <small>(<?php _e('definition by Facebook', gxtb_fb_lB_lang) ?>)</small>
								</li>
							</ol>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong id="meta_app">
								<?php _e('Meta-Tag: App-ID', gxtb_fb_lB_lang) ?>
							</strong>
						</td>
                        <td width="80%" valign="middle">
							<ol>
             		        	<li><?php _e('You have to enable your domain as Connect-Domain of your FB-App. Visit the developer-page of your Facebook-App (<a href="http://www.facebook.com/developers" target="_blank">http://www.facebook.com/developers</a>) and then click on your App and then on "Edit Settings". After that Step you have to visit "Web Site" and fill in the "Site Domain"-Option and also the "Site URL". After that your Domain is connected with your App.', gxtb_fb_lB_lang); ?>
								<br /><br />
								<?php echo sprintf( '%s <a href="http://www.gb-world.net/forum/viewforum.php?f=22" target="_blank">%s</a>.', __('Write us a little support-topic if you need help with that meta-tag in our', gxtb_fb_lB_lang), __('Forum', gxtb_fb_lB_lang)); ?>
								</li>
							</ol>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong>
								<?php _e('How does it look on Facebook if someone likes something?', gxtb_fb_lB_lang) ?>
							</strong>
						</td>
                        <td width="80%" valign="middle">
							<ol>
             		           <li>
							   	<?php _e('If you want that the "Likes" appear on facebook like this:', gxtb_fb_lB_lang ); ?> <i><a href="http://www.gb-world.net" target="_blank"  onmouseover="tooltip.show('<?php _e('Author of this plugin', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();">GangXtaBoii</a> likes <a href="http://www.gb-world.net" target="_blank">Like-Button-Plugin-For-Wordpress</a> on <a href="http://www.gb-world.net" target="_blank">GB-World.net</a></i><br />
                               	 <?php echo sprintf('%s <a href="#gxtb_fb_lB_meta_site_name">%s</a>.', __('you have to fill in a ', gxtb_fb_lB_lang ), __('Sitename (Meta-Tag)', gxtb_fb_lB_lang )); ?>
								</li>
							</ol>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong>
								<?php _e('Facebook-Generator-FAQ:', gxtb_fb_lB_lang) ?>
							</strong>
						</td>
                        <td width="80%" valign="middle">
							<ol>
             		        	<li><?php _e('The URL must look like this -> http://example.com. Otherwise the Button will not work properly.', gxtb_fb_lB_lang); ?></li>
                                <li><?php _e('Now choose your layout style, width, height, font, verb to display, color scheme and if faces should be shown.', gxtb_fb_lB_lang); ?></li>
							</ol>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong>
								<?php _e('[like]-Shortcode', gxtb_fb_lB_lang) ?>
							</strong>
						</td>
                        <td width="80%" valign="middle">
							<ol>
             		        	<li><?php _e('You only have to insert <strong>[like]</strong> into a post/article and your like-Button (generated on this Option-Page) will appear', gxtb_fb_lB_lang) ?></li>
							</ol>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong>
								<?php _e('Facebook-Like-Button-Widget', gxtb_fb_lB_lang) ?>
							</strong>
						</td>
                        <td width="80%" valign="middle">
							<ol>
             		           <li><?php _e('Go to the Widgets-Page on the left. Add the "Facebook-Like-Button" Widget and add the required information.', gxtb_fb_lB_lang) ?></li>
							   <li><?php _e('The URL must look like the URL for the Facebook-Generator on this site.', gxtb_fb_lB_lang) ?></li>
							</ol>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong>
								<?php _e('The Tooltips do not work', gxtb_fb_lB_lang) ?>  <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png" onmouseover="tooltip.show('<?php _e('It works :)', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
							</strong>
						</td>
                        <td width="80%" valign="middle">
							<ol>
             		           <li><?php _e('Press F5, load the page again or delete your cache and try it again.', gxtb_fb_lB_lang) ?></li>
							</ol>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong>
								<?php _e('What is Facebook Insights Tools?', gxtb_fb_lB_lang) ?>
							</strong>
						</td>
                        <td width="80%" valign="middle">
							<ol>
             		           <li><?php _e('If you visit <a href="http://www.facebook.com/insights" target="_blank">facebook.com/insights</a> and register your domain, you can see the number of likes on your domain each day and the demographics of who is clicking the Like button.', gxtb_fb_lB_lang) ?></li>
							</ol>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header">
							<strong>
								<?php _e('What can I do if I need help?', gxtb_fb_lB_lang) ?>
							</strong>
						</td>
                        <td width="80%" valign="middle">
							<ol>
             		           <li><?php echo sprintf( '%s <a href="http://www.gb-world.net/forum" target="_blank">%s</a>, <a href="http://www.gb-world.net/" target="_blank">%s</a>, <a href="http://bugs.gb-world.net/" target="_blank">%s</a> <b>(%s)</b> %s <a href="http://www.facebook.com/pages/GB-World/119752364716058" target="_blank">%s</a>!', __('Contact us in our', gxtb_fb_lB_lang), __('Forum', gxtb_fb_lB_lang), __('Blog', gxtb_fb_lB_lang), __('BugTracker', gxtb_fb_lB_lang), __('only for Bugreports', gxtb_fb_lB_lang),  __('or', gxtb_fb_lB_lang), __('Facebook-Fanpage', gxtb_fb_lB_lang)  ) ?></li>
							</ol>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>

			</tbody>
</table>
</div>
	<?php
} // end function
function gxbt_video_content() { ?>
<center>
<iframe width="640" height="390" src="https://www.youtube.com/embed/p8tyI57sUvI?rel=0&amp;hd=1" frameborder="0" allowfullscreen></iframe>
<br />
<br />
<iframe width="640" height="390" src="https://www.youtube.com/embed/gsxA0Hai6kU?rel=0&amp;hd=1" frameborder="0" allowfullscreen></iframe>
</center>
<?php } // end function
function gxbt_mediawiki_content() { #<iframe src="http://wiki.gb-world.net/wiki/Like-Button-Plugin-For-Wordpress" width="100%" height="600px" id="GB-Wiki"> ?>
<span class="gb_socialspeed gb_socialiframe" src="http://wiki.gb-world.net/wiki/Like-Button-Plugin-For-Wordpress" style="width:100%;height:600px;"></span> <?php /* 
  <p><?php _e('Your browser/Hosting Provider does not support frames. You visit the embedded page with this link ', gxtb_fb_lB_lang); ?><a href="http://wiki.gb-world.net/wiki/Like-Button-Plugin-For-Wordpress">GB-Wiki</a></p>
</iframe>
<?php */ } // end function
function gxbt_bugtracker_content() { #<iframe src="http://bugs.gb-world.net/" width="100%" height="600px" id="BugTracker"> ?>
<span class="gb_socialspeed gb_socialiframe" src="http://bugs.gb-world.net" style="width:100%;height:600px;"></span> <?php /* 
  <p><?php _e('Your browser/Hosting Provider does not support frames. You visit the embedded page with this link ', gxtb_fb_lB_lang); ?><a href="http://bugs.gb-world.net/">GB-BugTracker</a></p>
</iframe>
<?php */ } // end function
} // end if-class
} // end class
?>