<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-Meta-Page [v0.5 - FINAL]
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
if (!class_exists('gxtb_gb_meta')) {
class gxtb_gb_meta {
	
	var $metacontent;
	var $GBLikeButton;
	var $pagehook;
	
function gxtb_gb_meta($pagehook) {

		$this->pagehook = $pagehook;
	
		$this->GBLikeButton = get_option('GBLikeButton');
		$this->metacontent = new gxtb_gb_metacontent();

		global $screen_layout_columns;
		$screen_layout_columns = 2;

		add_meta_box('gb_fb_meta', __('FB-Open Graph Protocol', gxtb_fb_lB_lang), array(&$this, 'gb_meta'), $this->pagehook, 'first', 'core');			
		include('gb_admin_sidebar.php');	
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<form method="post" class="formlyWrapper-Base" action="<?php echo admin_url( 'admin.php?page=fb-like-opengraph' ); ?>" name="settingpage" id="settingpage" class="settingpage">
<?php gb_admin_header::gb_admin_title(); ?> 
<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
		<div id="poststuff" class="metabox-holder" style="width:100%;">
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
function gb_meta() {
	?>
<table class="form-table" border="0" id="gb-table">
	<tbody>
		<tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('Meta-Tags', gxtb_fb_lB_lang); ?>
				</strong>
			</td>		
            <td width="80%" valign="bottom">
			<!-- Tabs-Menue -->
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs ui-widget ui-corner-all" id="tabs_general">
			<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
				<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active ui-state-focus">
					<a href="#administrativ" class="ui-state-default ui-corner-top">
						<?php _e('Administrativ Tags', gxtb_fb_lB_lang); ?>
					</a>
				</li>
				<li class="ui-state-default ui-corner-top">
					<a href="#blogtags" class="ui-state-default ui-corner-top">
						<?php _e('Blog Tags', gxtb_fb_lB_lang); ?>
					</a>
				</li>
				<li class="ui-state-default ui-corner-top">
					<a href="#additionaltags" class="ui-state-default ui-corner-top">
						<?php _e('Additional Tags', gxtb_fb_lB_lang); ?>
					</a>
				</li>
			</ul>
			<!-- /Tabs-Menue -->
			
			<!-- Tabs-Content -->
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="administrativ"><table class="form-table">
					<?php $this->metacontent -> tab1(); ?>
			</table></div>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="blogtags"><table class="form-table">
					<?php $this->metacontent -> tab2(); ?>
                    <?php $this->metacontent -> tab3(); ?>
			</table></div>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="additionaltags"><table class="form-table">
					<?php $this->metacontent -> tab4(); ?>			
			</table></div>

			<!-- /Tabs-Content -->
		</div>
             </td>
        </tr>
        <tr>
            <td class="gb-table-tipp">
			</td>
        </tr>
	</tbody>
</table>
<?php $this->metacontent -> getJava();
} // end function
} // end class

class gxtb_gb_metacontent {
	var $GBLikeButton;
function tab1() {
$this->GBLikeButton = get_option('GBLikeButton');
?>
<tr>
	<td valign="middle" width="20%">							
		<?php _e('Admin-ID', gxtb_fb_lB_lang) ?>
	</td>
	<td valign="bottom">				
<input type="text" name="admins" id="gxtb_fb_lB_meta_admins" class="{required:true, digits:true, messages:{required:'<?php _e('Enter a valid Admin-ID.', gxtb_fb_lB_lang) ?>', digits:'<?php _e('Only digits pls.', gxtb_fb_lB_lang) ?>'}}" value="<?php if (isset($this->GBLikeButton['OpenGraph']['admins']) && $this->GBLikeButton['OpenGraph']['admins'] != "") {echo $this->GBLikeButton['OpenGraph']['admins'];} else {echo "";} ?>" size="15"/> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png" onmouseover="tooltip.show('<?php _e('<b>Important:</b> The AdminID is your Facebook-Profile-ID or the FB-Profile-IDs of the other admins of this Like-Button.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
	</td>
</tr>
<tr>
	<td valign="bottom">							
		<div id="gxtb_fb_lB_meta_appid_div">
		<?php if(isset($this->GBLikeButton['General']['jdk']) && $this->GBLikeButton['General']['jdk'] != 1) { _e('App-ID', gxtb_fb_lB_lang); } else { ?> <b><?php _e('App-ID (required)', gxtb_fb_lB_lang); ?></b><?php } ?>
		</div>
	</td>
	<td valign="bottom"><a name="app_id">
		<input type="text" name="app_id" id="app_id" value="<?php if (isset($this->GBLikeButton['OpenGraph']['app_id']) && $this->GBLikeButton['OpenGraph']['app_id'] != "") {echo $this->GBLikeButton['OpenGraph']['app_id'];} else {echo "";} ?>" size="15"/> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('<b>Notice:</b> Visit the Page mentioned below to get a valid App-ID if you do not have one.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();"></a>
	</td>
</tr>					
<tr>
	<td>
		<?php _e('Page-ID', gxtb_fb_lB_lang) ?>
	</td>
	<td>
		<input type="text" name="page_id" value="<?php if (isset($this->GBLikeButton['OpenGraph']['page_id']) && $this->GBLikeButton['OpenGraph']['page_id'] != "") {echo $this->GBLikeButton['OpenGraph']['page_id'];} else {echo "";} ?>" size="15"/> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('You can also connect a Facebook-Fanpage with your Like-Buttons on your website. Just enter the Facebook-Fanpage-ID.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
	</td>
</tr>
<tr>
	<td colspan="3" valign="middle" align="left">
<div class="accordionButton"><?php _e('Important Information and Help', gxtb_fb_lB_lang ); ?></div>
<div class="accordionContent">
<b><?php 
			echo sprintf('%s <a href="http://developers.facebook.com/setup/" target="_blank">%s</a> %s! ',
			__('You have to enter a valid', gxtb_fb_lB_lang),
			__('App-ID', gxtb_fb_lB_lang),
			__('and additionally the Admin-ID and Page-ID to provide valid tags and fulfill the requirements of the Like-Button', gxtb_fb_lB_lang));
			echo "</b><br />";		
			 _e('<a class="note" href="http://developers.facebook.com/setup/" target="_blank">Get a App-ID</a>', gxtb_fb_lB_lang) ?> || <a href="http://developers.facebook.com/docs/opengraph/" class="note" target="_blank"><?php _e("What's OpenGraph?", gxtb_fb_lB_lang); ?></a>
		<br /><br />
		<?php _e('If you use more than one Admin-ID you have to seperate them with a <b>comma</b>! For example: 123123,123123 (no free space).', gxtb_fb_lB_lang) ?>
		<br />
<?php echo sprintf( '<a href="%s" target="_blank" class="note">%s</a>', "http://apps.facebook.com/whatismyid/", "Get your Admin-ID" ); ?>
        <br /><br />
		<b><span class="note"><?php _e('Important', gxtb_fb_lB_lang) ?>:</b></span>
		<?php _e('You have to enable your domain as Connect-Domain of your FB-App. Visit the <a class="note" href="http://www.facebook.com/developers" target="_blank">developer-page</a> of your Facebook-App and then click on your App and then on "Edit Settings". After that Step you have to visit "Web Site" and fill in the "Site Domain"-Option and also the "Site URL". After that your Domain is connected with your App.', gxtb_fb_lB_lang); ?>
</div>
	</td>
</tr>
<?php }
function tab2() {
$this->GBLikeButton = get_option('GBLikeButton');
	$blogtype = array(
		"blog",
		"website",
		"article",
		"activity",
		"sport",
		"bar",
		"company",
		"cafe",
		"hotel",
		"restaurant",
		"cause",
		"sports_league",
		"sports_team",
		"band",
		"government",
		"non_profit",
		"school",
		"university",
		"actor",
		"athlete",
		"author",
		"director",
		"musician",
		"politician",
		"public_figure",
		"city",
		"country",
		"landmark",
		"state_province",
		"album",
		"book",
		"drink",
		"food",
		"game",
		"product",
		"song",
		"movie",
		"tv_show"
);
?>
							<tr>
								<td valign="bottom" width="20%">							
									<?php _e('Site-Name', gxtb_fb_lB_lang) ?>: (<?php _e('required', gxtb_fb_lB_lang) ?>)
								</td>
								<td valign="bottom">
									<input type="text" id="gxtb_fb_lB_meta_site_name" name="site_name" value="<?php if (isset($this->GBLikeButton['OpenGraph']['page_id']) && $this->GBLikeButton['OpenGraph']['site_name']) {echo $this->GBLikeButton['OpenGraph']['site_name'];} else {echo "";} ?>" /> <span class="hotspot" style="color:#900;" onmouseover="tooltip.show('<?php _e('This Shortcode will generate the Site-Name Tag dynamically!', gxtb_fb_lB_lang) ?>');" onmouseout="tooltip.hide();"><?php _e('Shortcode: $binfo', gxtb_fb_lB_lang) ?></span>
								</td>
							</tr>			
											
							<tr>
								<td valign="bottom">							
									<?php _e('Page-Title', gxtb_fb_lB_lang) ?>: (<?php _e('required', gxtb_fb_lB_lang) ?>)
								</td>
								<td valign="bottom">
									<input type="text" name="title" value="<?php if (isset($this->GBLikeButton['OpenGraph']['title']) && $this->GBLikeButton['OpenGraph']['title'] != "") {echo $this->GBLikeButton['OpenGraph']['title'];} else {echo "";} ?>" /> <span class="hotspot" style="color:#900;" onmouseover="tooltip.show('<?php _e('This Shortcode will generate the Page-Title Tag dynamically!', gxtb_fb_lB_lang) ?>');" onmouseout="tooltip.hide();"><?php _e('Shortcode: $ptitle', gxtb_fb_lB_lang) ?></span>
								</td>
							</tr>
							
							<tr>
								<td valign="top">							
									<?php _e('Page-URL', gxtb_fb_lB_lang) ?>: (<?php _e('required', gxtb_fb_lB_lang) ?>)
								</td>
								<td valign="top">
									<input type="text" name="url" value="<?php if (isset($this->GBLikeButton['OpenGraph']['url']) && $this->GBLikeButton['OpenGraph']['url'] != "") {echo $this->GBLikeButton['OpenGraph']['url'];} else {echo "";} ?>" /> <span class="hotspot" style="color:#900;" onmouseover="tooltip.show('<?php _e('This Shortcode will generate the Page-URL Tag dynamically!', gxtb_fb_lB_lang) ?>');" onmouseout="tooltip.hide();"><?php _e('Shortcode: $plink', gxtb_fb_lB_lang) ?></span>
								<hr /></td>
							</tr>	
							<tr>
								<td valign="bottom" onmouseover="gxtb_blogtype()">							
									<?php _e('Frontpage-Type', gxtb_fb_lB_lang) ?>:
 								</td>
								<td valign="bottom" onmouseover="gxtb_blogtype()">                             
                                    <SELECT NAME="blogtype" id="gxtb_fb_lB_meta_type" onchange="gxtb_blogtype()" onblur="gxtb_blogtype()" onfocus="gxtb_blogtype()">
                                    <?php
                                    $i = $blogtype;
                                      foreach($i as $variable) {
                                        if($variable == $this->GBLikeButton['OpenGraph']['blogtype']) {
                                            echo '<OPTION selected>' . $variable .'</OPTION>';
                                        } else {
                                            echo '<OPTION>' . $variable .'</OPTION>';
                                        }
                                    }
                                    ?>
                                    </SELECT> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png" style="visibility:hidden" id="gxtb_fb_lB_meta_type_img" onmouseover="" onmouseout="tooltip.hide();">
                    			</td>
							</tr>
							<tr>
								<td valign="bottom" onmouseover="gxtb_blogtype()">							
									<?php _e('Page-Type', gxtb_fb_lB_lang) ?>:
 								</td>
								<td valign="bottom" onmouseover="gxtb_blogtype()">                             
                                    <SELECT NAME="pagetype">
                                    <?php
                                    $i = $blogtype;
                                      foreach($i as $variable) {
                                        if($variable == $this->GBLikeButton['OpenGraph']['pagetype']) {
                                            echo '<OPTION selected>' . $variable .'</OPTION>';
                                        } else {
                                            echo '<OPTION>' . $variable .'</OPTION>';
                                        }
                                    }
                                    ?>
                                    </SELECT> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png" style="visibility:hidden" id="gxtb_fb_lB_meta_type_img" onmouseover="" onmouseout="tooltip.hide();">
                    			</td>
							</tr>
							<tr>
								<td valign="bottom" onmouseover="gxtb_blogtype()">							
									<?php _e('Post-Type', gxtb_fb_lB_lang) ?>:
 								</td>
								<td valign="bottom" onmouseover="gxtb_blogtype()">                             
                                    <SELECT NAME="posttype">
                                    <?php
                                    $i = $blogtype;
                                      foreach($i as $variable) {
                                        if($variable == $this->GBLikeButton['OpenGraph']['posttype']) {
                                            echo '<OPTION selected>' . $variable .'</OPTION>';
                                        } else {
                                            echo '<OPTION>' . $variable .'</OPTION>';
                                        }
                                    }
                                    ?>
                                    </SELECT> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png" style="visibility:hidden" id="gxtb_fb_lB_meta_type_img" onmouseover="" onmouseout="tooltip.hide();">
                    			</td>
							</tr>
							<tr>
								<td valign="bottom" onmouseover="gxtb_blogtype()">							
									<?php _e('Category-Type', gxtb_fb_lB_lang) ?>:
 								</td>
								<td valign="bottom" onmouseover="gxtb_blogtype()">                             
                                    <SELECT NAME="categorytype">
                                    <?php
                                    $i = $blogtype;
                                      foreach($i as $variable) {
                                        if($variable == $this->GBLikeButton['OpenGraph']['categorytype']) {
                                            echo '<OPTION selected>' . $variable .'</OPTION>';
                                        } else {
                                            echo '<OPTION>' . $variable .'</OPTION>';
                                        }
                                    }
                                    ?>
                                    </SELECT> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png" style="visibility:hidden" id="gxtb_fb_lB_meta_type_img" onmouseover="" onmouseout="tooltip.hide();">
                    			</td>
							</tr>
							<tr>
								<td valign="bottom" onmouseover="gxtb_blogtype()">							
									<?php _e('Archive-Type', gxtb_fb_lB_lang) ?>:
 								</td>
								<td valign="bottom" onmouseover="gxtb_blogtype()">                             
                                    <SELECT NAME="archivetype">
                                    <?php
                                    $i = $blogtype;
                                      foreach($i as $variable) {
                                        if($variable == $this->GBLikeButton['OpenGraph']['archivetype']) {
                                            echo '<OPTION selected>' . $variable .'</OPTION>';
                                        } else {
                                            echo '<OPTION>' . $variable .'</OPTION>';
                                        }
                                    }
                                    ?>
                                    </SELECT> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png" style="visibility:hidden" id="gxtb_fb_lB_meta_type_img" onmouseover="" onmouseout="tooltip.hide();">
                    			<hr /></td>
							</tr>
                            <tr>
								<td valign="top">
									<?php _e('Page-Description', gxtb_fb_lB_lang) ?>: (<?php _e('required', gxtb_fb_lB_lang) ?>)
								</td>
								<td valign="bottom" colspan="4">
									<textarea name="description" id="description" rows="5"/ style="width:100%"><?php if (isset($this->GBLikeButton['OpenGraph']['url']) && $this->GBLikeButton['OpenGraph']['description'] != "") {echo $this->GBLikeButton['OpenGraph']['description'];} else {echo "";} ?></textarea><br />
                                    
                                    <input type='Radio' class="radio" Name='dusage' value='blogd' <?php if(isset($this->GBLikeButton['OpenGraph']['dusage']) && $this->GBLikeButton['OpenGraph']['dusage'] == "blogd") echo "checked"; ?> >
                                    	<span class="hotspot" onmouseover="tooltip.show('<?php _e('The Blog-Description will be used for this Meta-Tag', gxtb_fb_lB_lang) ?>');" onmouseout="tooltip.hide();">
											<?php _e('Use Blog-Description', gxtb_fb_lB_lang) ?>
                                        </span><br />
									<input type='Radio' class="radio" Name='dusage' value='bloge' <?php if(isset($this->GBLikeButton['OpenGraph']['dusage']) && $this->GBLikeButton['OpenGraph']['dusage'] == "bloge") echo "checked"; ?>>
										<span class="hotspot" onmouseover="tooltip.show('<?php _e('<u>Example:</u> If a user visits Post A this Meta-Tag will display the Excerpt of Post A.<br><br><small><u>Recommended</u>: because with this option every post has its unique description.</small>', gxtb_fb_lB_lang) ?>');" onmouseout="tooltip.hide();">
											<?php _e('Use the excerpt of the shown page/post', gxtb_fb_lB_lang) ?>
                                        </span><br />
                                    <input type='Radio' class="radio" Name='dusage' value='blogn' <?php if(isset($this->GBLikeButton['OpenGraph']['dusage']) && $this->GBLikeButton['OpenGraph']['dusage'] == "blogn") echo "checked"; ?>>
										<span class="hotspot" onmouseover="tooltip.show('<?php _e('The text in the textarea above will be displayed', gxtb_fb_lB_lang) ?>');" onmouseout="tooltip.hide();">
											<?php _e('Use the description of this textarea', gxtb_fb_lB_lang) ?>
                                        </span><br />
                                    <input type='Radio' class="radio" Name='dusage' value='blognon' <?php if(isset($this->GBLikeButton['OpenGraph']['dusage']) && $this->GBLikeButton['OpenGraph']['dusage'] == "blognon") echo "checked"; ?>>
										<span class="hotspot" onmouseover="tooltip.show('<?php _e('The Description Tag of your Blog will be used', gxtb_fb_lB_lang) ?>');" onmouseout="tooltip.hide();">
											<?php _e('Deactivate the OpenGraph Description Tag', gxtb_fb_lB_lang) ?>
                                        </span>
								</td>
							</tr>
<tr><td></td></tr>							
						<tr>
                        <td class="gb-table-tipp" colspan="2">                        
<div class="accordionButton"><?php _e('Information', gxtb_fb_lB_lang); ?></div>
<div class="accordionContent">
	<?php _e('You&prime;ll find examples here: <a href="http://developers.facebook.com/docs/opengraph" target="_blank">http://developers.facebook.com/docs/opengraph</a>', gxtb_fb_lB_lang) ?><br /><br />
    <?php _e('<b>Important:</b> You can put GB-Shortcodes into this boxes! This Shortcodes will then work as php-Code in the Background.', gxtb_fb_lB_lang) ?><br /><br />
	<?php _e('<b>GB-Meta-Shortcodes:</b>  Site-Name => <b>$binfo</b> || Page-Title => <b>$ptitle</b> || Page-URL => <b>$plink</b>', gxtb_fb_lB_lang) ?><br /><br />
	<?php _e('<b>Example:</b> If you use: Page-Title => $ptitle || If a visitor visits a page or post of your blog the title of this page/post will be the content of this meta-tag dynamically. The same will happen with the $plink-GB-Shortocde.', gxtb_fb_lB_lang) ?>
</div>
						</td>
                    </tr>
<?php }
function tab3() {
	$this->GBLikeButton = get_option('GBLikeButton');
?>
	<tr>
		<td valign="top" width="20%">							
									<?php _e('Image', gxtb_fb_lB_lang) ?>: (<?php _e('required', gxtb_fb_lB_lang) ?>)
								</td>
								<td valign="top" colspan="5">
									<input type="text" onchange="gxtb_image_src()" onselect="gxtb_image_src()" onfocus="gxtb_image_src()" id="gxtb_fb_lB_meta_image" name="image" value="<?php if (isset($this->GBLikeButton['OpenGraph']['image']) && $this->GBLikeButton['OpenGraph']['image'] != "") {echo $this->GBLikeButton['OpenGraph']['image'];} else {echo "";} ?>" size="35"/> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('Complete URL of your Blog-Image which will appear on facebook if somebody posts his like-action on his wall.<br><b>Example:</b> if you use an facebook-app and post it on your wall there is always a little image on the left side of this post. And the same will happen with your image.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();"><br />
<small>(<?php _e('Supported Images: PNG, JPEG/JPG and GIF', gxtb_fb_lB_lang) ?>)</small> 
								</td>
							</tr>
							<tr>
								<td valign="top">							
									<?php _e('Default Image visible on', gxtb_fb_lB_lang) ?>
 								</td>
								<td valign="bottom">                         
									<input type="checkbox" class="checkbox" name="frontpage_default" <?php if (isset($this->GBLikeButton['OpenGraph']['frontpage_default']) && $this->GBLikeButton['OpenGraph']['frontpage_default']) echo("checked"); ?> onmouseover="tooltip.show('<?php _e('If you acivate this Option the default image will appear on this type of page.', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();" value="1"/> <?php _e('Frontpage', gxtb_fb_lB_lang ) ?>                             
									<input type="checkbox" class="checkbox" name="page_default" <?php if (isset($this->GBLikeButton['OpenGraph']['page_default']) && $this->GBLikeButton['OpenGraph']['page_default']) echo("checked"); ?> onmouseover="tooltip.show('<?php _e('If you acivate this Option the default image will appear on this type of page.', gxtb_fb_lB_lang ); ?> <?php _e(' If you deactive the default image on the Edit-Page the default image will not appear even though you have checked it here!', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();" value="1"/> <?php _e('Page', gxtb_fb_lB_lang ) ?>                             
									<input type="checkbox" class="checkbox" name="post_default" <?php if (isset($this->GBLikeButton['OpenGraph']['post_default']) && $this->GBLikeButton['OpenGraph']['post_default']) echo("checked"); ?> onmouseover="tooltip.show('<?php _e('If you acivate this Option the default image will appear on this type of page.', gxtb_fb_lB_lang ); ?> <?php _e(' If you deactive the default image on the Edit-Page the default image will not appear even though you have checked it here!', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();" value="1"/> <?php _e('Post', gxtb_fb_lB_lang ) ?>                             
									<input type="checkbox" class="checkbox" name="category_default" <?php if (isset($this->GBLikeButton['OpenGraph']['category_default']) && $this->GBLikeButton['OpenGraph']['category_default']) echo("checked"); ?> onmouseover="tooltip.show('<?php _e('If you acivate this Option the default image will appear on this type of page.', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();" value="1"/> <?php _e('Category', gxtb_fb_lB_lang ) ?>                             
									<input type="checkbox" class="checkbox" name="archive_default" <?php if (isset($this->GBLikeButton['OpenGraph']['archive_default']) && $this->GBLikeButton['OpenGraph']['archive_default']) echo("checked"); ?> onmouseover="tooltip.show('<?php _e('If you acivate this Option the default image will appear on this type of page.', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();" value="1"/> <?php _e('Archive', gxtb_fb_lB_lang ) ?><br />
<br />
<b><i><?php _e('Important', gxtb_fb_lB_lang) ?>:</b> <?php _e('It is not possible to define a specific image for each post on the &quot;Blogpage&quot; (where the several posts are listed). It is only possible if you visit the Post/Page itself. Instead the default image below will be available on &quot;Overview pages&quot; only.', gxtb_fb_lB_lang) ?></i>
                    			</td>
							</tr>
                            
							<tr>
								<td valign="top" colspan="1">							
									<?php _e('Preview', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="top" colspan="4">
                                
                                <table class="gxtb_img_preview">
                                    <tr>
                                   		<td><table><tr><td align="center" valign="middle">
                                             <div id="gxtb_img_preview_div">
											 <?php if(isset($this->GBLikeButton['OpenGraph']['image']) && $this->GBLikeButton['OpenGraph']['image'] != "") {
												 echo '<a href="' . $this->GBLikeButton['OpenGraph']['image'] . '" class="preview" title="' . $this->GBLikeButton['OpenGraph']['image'] . '"><img id="gxtb_fb_lB_meta_image_preview" src="' . $this->GBLikeButton['OpenGraph']['image'] . '" class="thumb" alt="Image"></a>';  } else {echo _e('No Image set!', gxtb_fb_lB_lang); } ?>
											</div>
                                            <tr><td>
											<?php echo '<a class="button-primary" href="javascript:gxtb_image_src()">Update Preview</a>'; ?>
                                            </td></tr></table>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td class="gb-table-tipp">
                                    		<center><small>(<?php _e('real image-output may vary because this is only a thumbnail-preview.', gxtb_fb_lB_lang) ?>)</small></center>
                                    	</td>
                                    </tr>
                                </table>
                                    
								</td>
							</tr>	

							<tr>
							 <td class="gb-table-tipp" colspan="2">
<div class="accordionButton" id="meta_infohelp"><?php _e('Important Information and Help', gxtb_fb_lB_lang ); ?></div>
<div class="accordionContent">
									<?php _e("The image must be at least 50px by 50px and have a maximum aspect ratio of 3:1. Facebook supports PNG, JPEG and GIF formats.", gxtb_fb_lB_lang ); ?>
                                    <br />
                                    <?php _e('Square images work best, but you are allowed to use images up to three times as wide as they are tall.') ?>
                                    <br><br /><i>(<?php _e('Official Facebook-Description') ?>)</i>
</div>                                						
								</td>
							</tr>
							<tr>
								<td valign="top"></td>
								<td valign="top" colspan="3">&nbsp;
								</td>
							</tr>
<?php }
############################################ ADITIONAL CONTENT ############################################
## Aditional Meta-Tags
function tab4() {
	$this->GBLikeButton = get_option('GBLikeButton');
?>
						<!-- Additional-Meta-Tags -->
							<tr>
								<td valign="bottom" width="20%">
									<?php _e('Postal-Code', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="plz" value="<?php if (isset($this->GBLikeButton['OpenGraph']['plz']) && $this->GBLikeButton['OpenGraph']['plz'] != "") {echo $this->GBLikeButton['OpenGraph']['plz'];} else {echo "";} ?>" />
								</td>
								
								<td valign="bottom">
									<?php _e('E-Mail', gxtb_fb_lB_lang) ?>:						
								</td>
								<td valign="bottom">
									<input type="text" name="mail" value="<?php if (isset($this->GBLikeButton['OpenGraph']['mail']) && $this->GBLikeButton['OpenGraph']['mail'] != "") {echo  $this->GBLikeButton['OpenGraph']['mail'];} else {echo "";} ?>" />
								</td>
							</tr>							
							<tr>
								<td valign="bottom">							
									<?php _e('Street-Address', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="street" value="<?php if (isset($this->GBLikeButton['OpenGraph']['street']) && $this->GBLikeButton['OpenGraph']['street'] != "") {echo $this->GBLikeButton['OpenGraph']['street'];} else {echo "";} ?>" />
								</td>


								<td valign="bottom">
									<?php _e('Phone-Number', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="phone" value="<?php if (isset($this->GBLikeButton['OpenGraph']['phone']) && $this->GBLikeButton['OpenGraph']['phone'] != "") {echo $this->GBLikeButton['OpenGraph']['phone'];} else {echo "";} ?>" />
								</td>
							</tr>					
							<tr>
								<td valign="bottom">							
									<?php _e('Locality', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="locality" value="<?php if (isset($this->GBLikeButton['OpenGraph']['locality']) && $this->GBLikeButton['OpenGraph']['locality'] != "") {echo $this->GBLikeButton['OpenGraph']['locality'];} else {echo "";} ?>" />
								</td>

								<td valign="bottom">							
									<?php _e('Fax-Number', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="fax" value="<?php if (isset($this->GBLikeButton['OpenGraph']['fax']) && $this->GBLikeButton['OpenGraph']['fax'] != "") {echo $this->GBLikeButton['OpenGraph']['fax'];} else {echo "";} ?>" />
								</td>
							</tr>							
							<tr>
								<td valign="bottom">							
									<?php _e('Region', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="region" value="<?php if (isset($this->GBLikeButton['OpenGraph']['region']) && $this->GBLikeButton['OpenGraph']['region'] != "") {echo $this->GBLikeButton['OpenGraph']['region'];} else {echo "";} ?>" />
								</td>
							</tr>							
							<tr>
								<td valign="bottom">							
									<?php _e('Country', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="country" value="<?php if (isset($this->GBLikeButton['OpenGraph']['country']) && $this->GBLikeButton['OpenGraph']['country'] != "") {echo $this->GBLikeButton['OpenGraph']['country'];} else {echo "";} ?>" />
								</td>
							</tr>							
							<tr>
								<td valign="bottom">							
									<?php _e('Latitude', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="latitude" value="<?php if (isset($this->GBLikeButton['OpenGraph']['latitude']) && $this->GBLikeButton['OpenGraph']['latitude'] != "") {echo $this->GBLikeButton['OpenGraph']['latitude'];} else {echo "";} ?>" />
								</td>
								<td valign="bottom">							
									<?php _e('Longitude', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="longitude" value="<?php if (isset($this->GBLikeButton['OpenGraph']['longitude']) && $this->GBLikeButton['OpenGraph']['longitude'] != "") {echo $this->GBLikeButton['OpenGraph']['longitude'];} else {echo "";} ?>" />
								</td>
							</tr>
<?php
} // end function
function getJava() { ?>			
<script type="text/javascript">
function appID() {
	var div = document.getElementById("gxtb_fb_lB_meta_appid_div");
	var jdk = document.getElementById("gxtb_fb_lB_jdk");
	
	if(jdk.checked == true) {
		div.innerHTML =	"<b><?php _e('AppID: (required)', gxtb_fb_lB_lang) ?></b>";

		gxtb_generator_elements_disable();
	} else {
		div.innerHTML = "<?php _e('AppID', gxtb_fb_lB_lang) ?>:";
		
		gxtb_generator_elements_enable();
	}
}
</script>
<?php
	
} // end function
} // end class
} // end if-class
