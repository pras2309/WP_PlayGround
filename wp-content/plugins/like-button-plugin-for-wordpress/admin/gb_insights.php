<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-Insights-Page [v0.2]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       ADMIN-PAGE-DESIGN	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('gxbt_gb_insights')) {
class gxbt_gb_insights {
	
	var $GBLikeButton;
	var $pagehook;
	
function gxbt_gb_insights($pagehook) {

		$this->pagehook = $pagehook;

		$this->GBLikeButton = get_option('GBLikeButton');
		global $screen_layout_columns;
		$screen_layout_columns = 2;

		add_meta_box('gb_fb_insights', __('FB-Insights', gxtb_fb_lB_lang), array(&$this, 'gb_insights'), $this->pagehook, 'first', 'core');			
#########################################################
		include('gb_admin_sidebar.php');
#########################################################	
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<form method="post" class="formlyWrapper-Base" action="<?php echo admin_url( 'admin.php?page=fb-like-insights' ); ?>" name="settingpage" id="settingpage" class="settingpage">
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
						</div><?php 
									include('gb_submit.php');
								?>
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

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      CALLBACK METHODS		 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################

function gb_insights() {
$this->GBLikeButton = get_option('GBLikeButton');
	?>
<!-- Analytics-Table -->
<table class="form-table" border="0" id="gb-table">
		        <tbody>
           
                    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<input type="checkbox" class="checkbox" name="insights_on" 
							<?php if (isset($this->GBLikeButton['FBInsights']['on']) && $this->GBLikeButton['FBInsights']['on']) { echo("checked"); } ?> value="1"/>
                            <strong id="gb_insights_start">
								<a name="reldefinitions" style="color:#000000"><?php _e('Activate Insights', gxtb_fb_lB_lang ) ?></a>
							</strong> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('Activate this checkbox if you want to analyse the effectivity of your like-buttons.', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();">
						</td>
                        <td width="80%" valign="top">
                         <!-- inner table -->
						<table border="1" cellspacing="0" cellpadding="0">
							<tr>
								<td valign="bottom">
									<input type="checkbox" class="checkbox" name="insights_frontpage_activ" <?php if (isset($this->GBLikeButton['FBInsights']['frontpage_activ']) && $this->GBLikeButton['FBInsights']['frontpage_activ']) echo("checked"); ?> onmouseover="tooltip.show('<?php _e('Activate this checkbox if you want to use this ref-definition at the frontpage (index) of your blog.', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();" value="1"/> <?php _e('Front-Page', gxtb_fb_lB_lang ) ?>
								</td>
								<td valign="bottom">
								<input name="insights_frontpage" id="insights_frontpage" type="text" value="<?php if (isset($this->GBLikeButton['FBInsights']['frontpage']) && $this->GBLikeButton['FBInsights']['frontpage'] != "") { echo stripslashes($this->GBLikeButton['FBInsights']['frontpage']); } else {echo "";} ?>" size="25" /> <small><i><?php _e('For example: top_post', gxtb_fb_lB_lang ) ?></i></small>
								</td>
							</tr>                        
							<tr>
								<td valign="bottom">
									<input type="checkbox" class="checkbox" name="insights_page_activ" <?php if (isset($this->GBLikeButton['FBInsights']['page_activ']) && $this->GBLikeButton['FBInsights']['page_activ']) echo("checked"); ?> onmouseover="tooltip.show('<?php _e('Activate this checkbox if you want to use this ref-definition on every page where the Like-Button appears.', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();" value="1"/> <?php _e('Page', gxtb_fb_lB_lang ) ?>
								</td>
								<td valign="bottom">
								<input name="insights_page" type="text" value="<?php if (isset($this->GBLikeButton['FBInsights']['page']) && $this->GBLikeButton['FBInsights']['page'] != "") { echo stripslashes($this->GBLikeButton['FBInsights']['page']); } else {echo "";} ?>" size="25" />
								</td>
							</tr>
							<tr>
								<td valign="bottom">
									<input type="checkbox" class="checkbox" name="insights_post_activ" <?php if (isset($this->GBLikeButton['FBInsights']['post_activ']) && $this->GBLikeButton['FBInsights']['post_activ'] ) echo("checked"); ?> onmouseover="tooltip.show('<?php _e('Activate this checkbox if you want to use this ref-definition on every post where the Like-Button appears.', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();" value="1"/> <?php _e('Post', gxtb_fb_lB_lang ) ?>
								</td>
								<td valign="bottom">
								<input name="insights_post" type="text" value="<?php if (isset($this->GBLikeButton['FBInsights']['post']) && $this->GBLikeButton['FBInsights']['post'] != "") { echo stripslashes($this->GBLikeButton['FBInsights']['post']); } else {echo "";} ?>" size="25" />
								</td>
							</tr>							
							<tr>
								<td valign="bottom">
									<input type="checkbox" class="checkbox" name="insights_category_activ" <?php if (isset($this->GBLikeButton['FBInsights']['category_activ']) && $this->GBLikeButton['FBInsights']['category_activ']) echo("checked"); ?> onmouseover="tooltip.show('<?php _e('Activate this checkbox if you want to use this ref-definition for category-sites.', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();" value="1"/> <?php _e('Category', gxtb_fb_lB_lang ) ?>
								</td>
								<td valign="bottom">
								<input name="insights_category" type="text" value="<?php if (isset($this->GBLikeButton['FBInsights']['category']) && $this->GBLikeButton['FBInsights']['category'] != "") { echo stripslashes($this->GBLikeButton['FBInsights']['category']); } else {echo "";} ?>" size="25" />
								</td>
							</tr> 							
							<tr>
								<td valign="bottom">
									<input type="checkbox" class="checkbox" name="insights_archiv_activ" <?php if (isset($this->GBLikeButton['FBInsights']['archiv_activ']) && $this->GBLikeButton['FBInsights']['archiv_activ']) echo("checked"); ?> onmouseover="tooltip.show('<?php _e('Activate this checkbox if you want to use this ref-definition for archive-sites.', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();" value="1"/> <?php _e('Archive', gxtb_fb_lB_lang ) ?>
								</td>
								<td valign="bottom">
								<input name="insights_archiv" type="text" value="<?php if (isset($this->GBLikeButton['FBInsights']['archiv']) && $this->GBLikeButton['FBInsights']['archiv'] != "") { echo stripslashes($this->GBLikeButton['FBInsights']['archiv']); } else {echo "";} ?>" size="25" />
								</td>
							</tr>
						</table>	
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp"><small><?php _e('Use the ref attribute to help you test different placements and types of Like buttons. Append the ref="" attribute to the Like button, making sure that the value you choose is <b>less than 50 characters (a-z, A-Z, 0-9, + / = - . : _)</b>.', gxtb_fb_lB_lang ) ?></small></td>
                    </tr>
					
				    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"></td>
                        <td width="80%" valign="top">
                        <div class="accordionButton"><?php _e('Facebook-Information', gxtb_fb_lB_lang ); ?></div>
                            <div class="accordionContent">
                            	<i>
                            	<?php _e('We recently added the ref and source parameters to help you test and optimize Like button performance on your website (<a  class="gxtb_feed fancylink_iframe"  href="http://developers.facebook.com/docs/reference/plugins/like">read more</a> about the attributes). For instance, you can now easily A/B test different types and placements of the Like button to determine the implementation that maximizes referral traffic to your site. ', gxtb_fb_lB_lang ) ?>
                           		</i>
                            </div>
                        <div class="accordionButton"><?php _e('How can I analyse this?', gxtb_fb_lB_lang ) ?></div>
                            <div class="accordionContent">
                            	<i>
								<?php _e('If you visit <a href="http://www.facebook.com/insights" target="_blank">Facebook Insights</a> and register your domain, you can see the number of likes on your domain each day and the demographics of who is clicking the Like button.', gxtb_fb_lB_lang ) ?>
                                </i>
                            </div>
							</td>
                    </tr>				
				</tbody>
	</table>
<?php	
} // end function
} // end class
} // end if-class
?>