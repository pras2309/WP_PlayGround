<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-General-Page [v1.0 - FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       Like-Button-General	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('GBLikeButtonGeneral')) {
class GBLikeButtonGeneral {
	
	var $GBLikeButton;
	var $pagehook;
	var $GBSettingsContent;
		
function GBLikeButtonGeneral($pagehook) {

	$this->pagehook = $pagehook;
		
	$this->GBLikeButton = get_option('GBLikeButton');
	$this->GBSettingsContent = new GBSettingsContent();
	
	global $screen_layout_columns;
	$screen_layout_columns = 2;
	
	include('gb_admin_sidebar.php');
	add_meta_box('gb_fb_settings', __('FB-Button-Settings', gxtb_fb_lB_lang), array(&$this, 'GBLikeButtonGeneralSettings'), $this->pagehook, 'first', 'core');
	add_meta_box('gb_fb_generator', __('Like-Button-Generator', gxtb_fb_lB_lang), array(&$this, 'GBLikeButtonGeneralGenerator'), $this->pagehook, 'normal', 'core');
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<form method="post" class="formlyWrapper-Base" action="<?php echo admin_url( 'admin.php?page=fb-like-general' ); ?>" name="settingpage" id="settingpage" class="settingpage">
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
							<?php do_meta_boxes($this->pagehook, 'normal', ""); ?>					
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
} // end function

function GBLikeButtonGeneralSettings() {
$this->GBLikeButton = get_option('GBLikeButton');
?>
<table class="form-table" border="0" id="gb-table">
	<tbody>
		<tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('FB-Button-Settings', gxtb_fb_lB_lang); ?>
				</strong>
			</td>		
            <td width="80%" valign="bottom">
			<!-- Tabs-Menue -->
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs ui-widget ui-corner-all" id="tabs_general">
			<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
				<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active ui-state-focus">
					<a href="#general" class="ui-state-default ui-corner-top">
						<?php _e('General Settings', gxtb_fb_lB_lang); ?>
					</a>
				</li>
				<li class="ui-state-default ui-corner-top">
					<a href="#position" class="ui-state-default ui-corner-top">
						<?php _e('Position Settings', gxtb_fb_lB_lang); ?>
					</a>
				</li><?php /*
				<li class="ui-state-default ui-corner-top">
					<a href="#special" class="ui-state-default ui-corner-top">
						<?php _e('Special Settings', gxtb_fb_lB_lang); ?>
					</a>
				</li> */ ?>
			</ul>
			<!-- /Tabs-Menue -->
			
			<!-- Tabs-Content -->
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="general"><table class="form-table">
					<?php $this->GBSettingsContent -> tab1(); ?>
			</table></div>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="position"><table class="form-table">
					<?php $this->GBSettingsContent -> tab2(); ?>
			</table></div><?php /*
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="special"><table class="form-table">
					<?php $this->GBSettingsContent -> tab3(); ?>
			</table></div> */ ?>

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
<?php
} // end function

function GBLikeButtonGeneralGenerator() {
	$GBGeneratorContent = new GBGeneratorContent();
?>
<table class="form-table" border="0" id="gb-table-generator">
		        <tbody>
           			<tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Generator', gxtb_fb_lB_lang); ?>
							</strong>
						</td>
                        <td width="80%" valign="bottom">
								<!-- Tabs -->
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs ui-widget ui-corner-all" id="tabs_generator">
			<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
				<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active ui-state-focus"><a href="#generator" class="ui-state-default ui-corner-top"><?php _e('General Settings', gxtb_fb_lB_lang); ?></a></li>
				<li class="ui-state-default ui-corner-top"><a href="#design" class="ui-state-default ui-corner-top"><?php _e('Design', gxtb_fb_lB_lang); ?></a></li>
				<li class="ui-state-default ui-corner-top iframetab"><a href="#iframe" class="ui-state-default ui-corner-top"><?php _e('iFrame Settings', gxtb_fb_lB_lang); ?></a></li>
			</ul>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="generator">
			<table class="form-table">
			<?php $GBGeneratorContent->tab1(); ?>
			</table>
			
			</div>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="design"><table class="form-table">
            <?php $GBGeneratorContent->tab2(); ?>
			</table></div>
			
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="iframe"><table class="form-table">
            <?php $GBGeneratorContent->tab3(); ?>
			</table>
				
			</div>

		</div>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
			<?php $GBGeneratorContent->preview(); ?>
					
			</tbody>
</table>
<?php
} // end function
} // end class

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      SETTINGS-CONTENT		 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################
if(!class_exists('GBSettingsContent')) {
class GBSettingsContent {
var $GBLikeButton;
function GBSettingsContent() {
	$this->GBLikeButton = get_option('GBLikeButton');
}
############################################################################### 
#################################### TAB 1 #################################### 
############################################################################### 
function tab1() {
	$this->GBLikeButton = get_option('GBLikeButton');
?>
                   <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('Like-Button Usage', gxtb_fb_lB_lang) ?></strong></td>
                        <td width="80%" valign="bottom">
                            <input type='radio' class="radio" name='general_jdk' id="gxtb_fb_lB_jdk" onchange="post_focus();" value='1' <?php if(isset($this->GBLikeButton['General']['jdk']) && $this->GBLikeButton['General']['jdk'] == 1) { echo "checked"; } ?>> <span id="general_jdk_desc"><?php _e('XFBML', gxtb_fb_lB_lang) ?></span> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('For some additional functions of the Like-Button you have to use XFBML. Read more at the FAQ.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();"><br />
                            <input type='radio' class="radio" name='general_jdk' id='gxtb_fb_lB_jdkOFF' onchange="post_focus();" value='0' <?php if(isset($this->GBLikeButton['General']['jdk']) && $this->GBLikeButton['General']['jdk'] == 0) { echo "checked"; } ?>> <?php _e('iFrame', gxtb_fb_lB_lang) ?>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
							<small>
								<?php echo sprintf('<b class="note">%s:</b> %s <a href="http://developers.facebook.com/setup/" target="_blank">%s</a> %s. %s <a href="'.admin_url().'admin.php?page=fb-like-opengraph#app_id">%s</a>.',
								__('Notice', gxtb_fb_lB_lang),
								__('You must have a valid  if you want to use XFBML', gxtb_fb_lB_lang),
								__('App-ID', gxtb_fb_lB_lang),
								__('if you want to use XFBML', gxtb_fb_lB_lang),
								__('Enter the valid App-ID on the', gxtb_fb_lB_lang),
								__('OpenGraph-Page', gxtb_fb_lB_lang)
								); ?>
							</small>
						</td>
                    </tr>
					<tr class="xfbml_mod">
						 <td width="20%" rowspan="2" valign="top" id="xfbml_mod1" class="gb-table-header" style="display:table-cell;"><strong><?php _e('XFBML-Modification', gxtb_fb_lB_lang) ?></strong></td>
						 <td width="80%" valign="bottom" id="xfbml_mod2" style="display:table-cell;">
								<?php
								echo "<div class='gxtb_image'>";
								echo "<center><img style='max-width:350px;' src='". plugins_url() ."/like-button-plugin-for-wordpress/screenshot-2.png' width='400px'></img></center><br>";
								_e('You have to enter this two attributes to the &lt;head&gt;-tag in your &quot;Template-header.php&quot;-file.', gxtb_fb_lB_lang);
								echo " (<b><small>" . __('your file', gxtb_fb_lB_lang) . ": <u><a href='" .  get_bloginfo('template_url') . "/header.php" . "'>" . get_bloginfo('template_url') . "/header.php</a>)</u></small></b>";
								echo "<br><br><b>";
								echo "<pre style='padding-left:15px;'>xmlns:og=&quot;http://ogp.me/ns#&quot;";
								echo "<br>";
								echo "xmlns:fb=&quot;http://www.facebook.com/2008/fbml&quot;</pre>";
								echo "</b><br>";
								_e('If you do not do this the Open-Graph-Protocol will not work with all its functions.', gxtb_fb_lB_lang);
								echo "</div>"; 
								?>
						</td>
					</tr>
					<tr class="xfbml_mod">
                        <td class="gb-table-tipp">
						</td>
                    </tr>
<?php if(isset($_GET['page']) && $_GET['page'] != "fb-like-button") { ?>                    
                    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('Post-Specific Button <small>(Dynamic Buttons)</small>', gxtb_fb_lB_lang) ?></strong></td>
                        <td width="80%" valign="middle">
					<input name="general_dynamic" type="checkbox" class="checkbox" <?php if (isset($this->GBLikeButton['General']['dynamic']) && $this->GBLikeButton['General']['dynamic']) echo("checked"); ?> value="1"/> 
                    <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('Read the instructions below please. This is an important option.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						<small>
			<u><?php _e('Activated', gxtb_fb_lB_lang); ?>:</u> <?php _e('Every Post/Page has its own Like-Button. Which means for every page on your side there will be a unique Like-Button.', gxtb_fb_lB_lang); ?> <?php _e('(recommended)', gxtb_fb_lB_lang); ?><br />
				<u><?php _e('Deactivated', gxtb_fb_lB_lang); ?>:</u> <?php _e('Every Post/Page has the same Like-Button. Which means if you click on it, it looks like you like/recommend every post even if you have not read it before.', gxtb_fb_lB_lang); ?>
            		</small>
						</td>
                    </tr>
<?php } // end if page ?>				
                    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('Language', gxtb_fb_lB_lang); ?></strong></td>
                        <td width="80%" valign="middle">
<?php 
$fblikes_locales = GBLikeButton_Language();
$select = "";
echo '<select name="general_language" id="general_language" onchange="gxtb_generator()">';
foreach($fblikes_locales as $locale => $language) { 
	if ( (isset($this->GBLikeButton['General']['language']) && $locale == $this->GBLikeButton['General']['language']) || ((!isset($this->GBLikeButton['General']['language']) || $this->GBLikeButton['General']['language'] == "") && $locale == "en_US" )) {
       $select .= '<option value="' . htmlentities($locale) .'" selected="selected">'. htmlentities($language) .'</option>';
    } else {
       $select .= '<option value="' . htmlentities($locale) .'">'. htmlentities($language) .'</option>';
    }
}
echo $select;
echo '</select>';
?><img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('Choose your preferred language for your Like-Button.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						<small><?php _e('<b>Default:</b> en_US', gxtb_fb_lB_lang); ?></small>
						</td>
                    </tr>			
<?php }
############################################################################### 
#################################### TAB 2 #################################### 
############################################################################### 
function tab2() {
	$this->GBLikeButton = get_option('GBLikeButton');
?>
                    <tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header"><strong><?php _e('Like-Button-Position', gxtb_fb_lB_lang) ?></strong></td>
                        <td width="80%" valign="middle">
                        <?php echo '
<div class="ui-widget" id="fade_position" style="display:none;"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
				<strong>'.__("Important", gxtb_fb_lB_lang).':</strong> '. __('You have to choose either one of this two options. Otherwise the Button will always appear at the bottom of the Content.', gxtb_fb_lB_lang) .'</p></div><br></div>'; ?>              
						<span id="general_sposition"><input type="checkbox" class="checkbox gblikebutton_position" name="general_position_before" <?php if (isset($this->GBLikeButton['General']['position_before']) && $this->GBLikeButton['General']['position_before']) echo("checked"); ?>  value="1" /> <?php _e('Before the Content', gxtb_fb_lB_lang)?><br />
						<input type="checkbox" class="checkbox gblikebutton_position" name="general_position_after" <?php if (isset($this->GBLikeButton['General']['position_after']) && $this->GBLikeButton['General']['position_after']) echo("checked"); ?>  value="1" /> <?php _e('After the Content', gxtb_fb_lB_lang)?></span>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp"><small><?php _e('Choose the position of your Like-Button.', gxtb_fb_lB_lang) ?></small></td>
                    </tr>
 <?php if(isset($_GET['page']) && $_GET['page'] != "fb-like-button") { ?>
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header"><strong><?php _e('Add the Like-Button in the Footer', gxtb_fb_lB_lang) ?></strong> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('This may not work with all themes. Report any bugs with your themes in our forum or bugtracker please. thanks.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();"></td>
                        <td width="80%" valign="bottom">
                         <input type="checkbox" class="checkbox" name="general_addfooter_activate" <?php if (isset($this->GBLikeButton['General']['addfooter_activate']) && $this->GBLikeButton['General']['addfooter_activate']) echo("checked"); ?>  value="1" />
                             <select name="general_addfooter">
                                  <option <?php if(isset($this->GBLikeButton['General']['addfooter']) && $this->GBLikeButton['General']['addfooter'] == __('Before the Footer', gxtb_fb_lB_lang)) echo "selected"; ?> ><?php _e('Before the Footer', gxtb_fb_lB_lang) ?></option>
                                  <option <?php if(isset($this->GBLikeButton['General']['addfooter']) && $this->GBLikeButton['General']['addfooter'] == __('After the Footer', gxtb_fb_lB_lang)) echo "selected"; ?> ><?php _e('After the Footer', gxtb_fb_lB_lang) ?></option>
   							 </select>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp"><small><?php _e('Activate this option if you want to activate the Like-Button for your Blog', gxtb_fb_lB_lang) ?></small></td>
                    </tr>
<?php } // end if page ?>                  
					 <tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header"><strong><?php _e('Show the Like-Button on every', gxtb_fb_lB_lang) ?></strong></td>
                        <td width="80%" valign="bottom">
						
						<table border="1" cellspacing="0" cellpadding="0">
							<tr>
								<td valign="bottom"><span id="general_appearance">
									<input type="checkbox" class="checkbox" name="general_frontpage" <?php if (isset($this->GBLikeButton['General']['frontpage']) && $this->GBLikeButton['General']['frontpage']) echo("checked"); ?>  value="1" /> <?php _e('Front-Page', gxtb_fb_lB_lang) ?></span>
								</td>
							</tr>                         
							<tr>
								<td valign="bottom">							
                        			<input type="checkbox" class="checkbox" name="general_page" <?php if (isset($this->GBLikeButton['General']['page']) && $this->GBLikeButton['General']['page']) echo("checked"); ?>  value="1" /> <?php _e('Page', gxtb_fb_lB_lang) ?>
								</td
><?php if(isset($_GET['page']) && $_GET['page'] != "fb-like-button") { ?>                               
								<td valign="bottom">
								<?php _e('Exclude IDs', gxtb_fb_lB_lang) ?>: <input name="general_page_exclude" type="text" value="<?php if (isset($this->GBLikeButton['General']['page_exclude']) && $this->GBLikeButton['General']['page_exclude'] != "") { echo stripslashes($this->GBLikeButton['General']['page_exclude']); } else {echo "";} ?>" size="10" /> <small><?php _e('Example', gxtb_fb_lB_lang) ?>: <?php _e('1,84', gxtb_fb_lB_lang) ?></small>
								</td>
<?php } // end if page ?>  
							</tr>
							<tr>
								<td valign="bottom">							
									<input type="checkbox" class="checkbox" name="general_post" <?php if (isset($this->GBLikeButton['General']['post']) && $this->GBLikeButton['General']['post']) echo("checked"); ?> value="1"  /> <?php _e('Post', gxtb_fb_lB_lang) ?>
								</td>
<?php if(isset($_GET['page']) && $_GET['page'] != "fb-like-button") { ?> 
								<td valign="bottom">
								<?php _e('Exclude IDs', gxtb_fb_lB_lang) ?>: <input name="general_post_exclude" type="text" value="<?php if (isset($this->GBLikeButton['General']['post_exclude']) && $this->GBLikeButton['General']['post_exclude'] != "") { echo stripslashes($this->GBLikeButton['General']['post_exclude']); } else {echo "";} ?>" size="10" /> <small><?php _e('Example', gxtb_fb_lB_lang) ?>: <?php _e('55,56', gxtb_fb_lB_lang) ?></small>
								</td>
<?php } // end if page ?>  
							</tr>
							<tr>
								<td valign="bottom">							
									<input type="checkbox" class="checkbox" name="general_category" <?php if (isset($this->GBLikeButton['General']['category']) && $this->GBLikeButton['General']['category']) echo("checked"); ?> value="1" /> <?php _e('Category', gxtb_fb_lB_lang) ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('Some themes have problems to display our generated Like-Button on this kind of Site. Please report this in our Forum if you have a problem with your current theme. We will then try to help you to fix that problem.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
								</td>
<?php if(isset($_GET['page']) && $_GET['page'] != "fb-like-button") { ?> 
								<td valign="bottom">
								<?php _e('Exclude IDs', gxtb_fb_lB_lang) ?>: <input name="general_category_exclude" type="text" value="<?php if (isset($this->GBLikeButton['General']['category_exclude']) && $this->GBLikeButton['General']['category_exclude'] != "") { echo stripslashes($this->GBLikeButton['General']['category_exclude']); } else {echo "";} ?>" size="10" /> <small><?php _e('Example', gxtb_fb_lB_lang) ?>: <?php _e('22,36', gxtb_fb_lB_lang) ?></small>
								</td>
<?php } // end if page ?>  
							</tr>
							<tr>
								<td valign="bottom">							
									<input type="checkbox" class="checkbox" name="general_archiv" <?php if (isset($this->GBLikeButton['General']['archiv']) && $this->GBLikeButton['General']['archiv']) echo("checked"); ?>  value="1" /> <?php _e('Archive', gxtb_fb_lB_lang) ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('Some themes have problems to display our generated Like-Button on this kind of Site. Please report this in our Forum if you have a problem with your current theme. We will then try to help you to fix that problem.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
								</td>
<?php if(isset($_GET['page']) && $_GET['page'] != "fb-like-button") { ?> 
								<td valign="bottom">
								<?php _e('Exclude IDs', gxtb_fb_lB_lang) ?>: <input name="general_archiv_exclude" type="text" value="<?php if (isset($this->GBLikeButton['General']['archiv_exclude']) && $this->GBLikeButton['General']['archiv_exclude'] != "") { echo stripslashes($this->GBLikeButton['General']['archiv_exclude']); } else {echo "";} ?>" size="10"/> <small><?php _e('Example', gxtb_fb_lB_lang) ?>: <?php _e('3,83', gxtb_fb_lB_lang) ?></small>
								</td>
<?php } // end if page ?>  
							</tr>
						</table>	
							
                         </td>
                    </tr>
					 
                    <tr>
                        <td class="gb-table-tipp"><small><?php _e('Activate this option if you want to activate the Like-Button on every post, page and others.', gxtb_fb_lB_lang) ?></small></td>
                    </tr>	                    
<?php }

############################################################################### 
#################################### TAB 3 #################################### 
############################################################################### 

function tab3() {
	$this->GBLikeButton = get_option('GBLikeButton');
?>
                   <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('Shortcode-Only', gxtb_fb_lB_lang) ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<input type="checkbox" class="checkbox" name="general_shortcode" id="general_shortcode" <?php if (isset($this->GBLikeButton['General']['shortcode']) && $this->GBLikeButton['General']['shortcode']) {echo("checked"); } ?> value="1"/> 
                             <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('If you activate this option it is possible to use the Shortcode only and you do not have to set a position of the like button because no like button will appear except you use the shortcode.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
							<small><b>
								<?php _e('only the Shortcode will work if you activate this option (ShortCode-Only-Modus)! Notice: The SideBar-Widget will work beside the Shortcode-Only-Modus!', gxtb_fb_lB_lang) ?><br />
							</b></small>
						</td>
                    </tr>	
<?php
} // end function
} // end class
} // end if-class

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      GENERATOR-CONTENT		 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################

if(!class_exists('GBGeneratorContent')) {
class GBGeneratorContent {
var $GBLikeButton;

function preview() { ?>
	<tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header-preview"><br />
							<strong>
<p><?php _e('Preview', gxtb_fb_lB_lang); ?></b> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('It will show a preview of a iFrame-Like-Button or the XFBML-Like-Button. If XFBML is enabled it will maybe act a little bit different like the output on the Frontend.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();"></p>
<?php if(isset($_GET['page']) && $_GET['page'] != "fb-like-button") { ?>
<p><?php echo sprintf( '%s <a href="%sadmin.php?page=fb-like-general#design">%s</a>.',  __('Do not forget to set the height and width of your Like Button under the', gxtb_fb_lB_lang), get_admin_url(),  __('Design-Tab', gxtb_fb_lB_lang)); ?></p>
<?php } ?>
							</strong>
						</td>
                        <td width="80%" valign="bottom"><br />
							<div id="gxtb_fb_lB_preview"></div>
							<script type="text/javascript"> gxtb_generator(); </script>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
<?php }

function tab1() {
	$this->GBLikeButton = get_option('GBLikeButton'); ?>
<?php if(isset($_GET['page']) && $_GET['page'] != "fb-like-button") { ?>
<tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Wordpress-Domain-URL', gxtb_fb_lB_lang); ?><br />
                               <small><?php _e('if you deactive the Post-Specific-Button this will be the URL to "like"', gxtb_fb_lB_lang); ?></small>
							</strong>
						</td>
                        <td width="80%" valign="bottom">
							<input name="gxtb_fb_lB_generator_url" id="gxtb_fb_lB_generator_url" type="text" onchange="gxtb_generator()" value="<?php if(isset($this->GBLikeButton['Generator']['url']) && $this->GBLikeButton['Generator']['url'] != "") {echo $this->GBLikeButton['Generator']['url'];} else {echo home_url();} ?>" size="30"/><br />
							<small>
								<?php echo sprintf( '%s: <a href="http://www.gb-world.net">%s</a>.',  __('Example', gxtb_fb_lB_lang), __('GB-World.net', gxtb_fb_lB_lang)); ?>
								<br /><br /><b><?php _e('Changes since 10th of September 2010:', gxtb_fb_lB_lang); ?></b><br />
								<?php _e('You can now also like your Facebook Pages and Application. Just enter the URL to your Facebook Page or Application (for example: <a href="http://www.facebook.com/gbworldnet" target="_blank">http://www.facebook.com/gbworldnet</a>)', gxtb_fb_lB_lang); ?><br />
                                <?php _e('If you like to add <b>dynamic Like-Buttons</b> you have to enter your <b>domain-url</b> if you would like to use this URL as the Like-Button source for <b>every Button</b> you can enter every URL you want.', gxtb_fb_lB_lang); ?>
							</small>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
<?php } ?>
					<tr class="xfbml_mod">
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Send Button', gxtb_fb_lB_lang); ?><br />
                                <small><?php _e('Only works if you use the XFBML-Button!', gxtb_fb_lB_lang); ?></small>
							</strong>
						</td>
                        <td width="80%" valign="bottom">
						<input name="gxtb_fb_lB_generator_send" id="gxtb_fb_lB_generator_send" type="checkbox" class="checkbox" onchange="gxtb_generator()" <?php if ( isset($this->GBLikeButton['Generator']['send']) && $this->GBLikeButton['Generator']['send']) echo("checked"); ?>  value="1"/>
							
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>

					<tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Layout Style', gxtb_fb_lB_lang); ?>
								<br /><br />
								<?php _e('Show Faces?', gxtb_fb_lB_lang); ?>
							</strong>
						</td>
                        <td width="80%" valign="bottom">
							<SELECT NAME="gxtb_fb_lB_generator_layout" id="gxtb_fb_lB_generator_layout" onchange="gxtb_generator()">
								<?php
								$i = array( "standard", "button_count", "box_count" );
								  foreach($i as $variable) {
									if($variable == $this->GBLikeButton['Generator']['layout'] && isset($this->GBLikeButton['Generator']['layout'])) {
										echo '<OPTION selected>' . $variable .'</OPTION>';
									} else {
										echo '<OPTION>' . $variable .'</OPTION>';
									}
								}
								?>
							</SELECT>
							<br /><br />
						<input name="gxtb_fb_lB_generator_faces" id="gxtb_fb_lB_generator_faces" type="checkbox" class="checkbox" onchange="gxtb_generator()" <?php if ( isset($this->GBLikeButton['Generator']['faces']) && $this->GBLikeButton['Generator']['faces']) echo("checked"); ?>  value="1"/> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('&quot;ShowFaces&quot; only shows the faces of your friends that have liked the same page/object. It will not show the faces of non-friends who have liked the object/page.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
							
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					<tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Verb to display', gxtb_fb_lB_lang); ?>
							</strong>
						</td>
                        <td width="80%" valign="top">
					<SELECT NAME="gxtb_fb_lB_generator_verb" id="gxtb_fb_lB_generator_verb" onchange="gxtb_generator()">
					<?php
					$i = array( "like", "recommend" );
					  foreach($i as $variable) {
						if($variable == $this->GBLikeButton['Generator']['verb'] && isset($this->GBLikeButton['Generator']['verb']) ) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</SELECT>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
<?php }
function tab2() {
	$this->GBLikeButton = get_option('GBLikeButton');
?>
	<tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Width', gxtb_fb_lB_lang); ?>
								<br />
								<?php _e('Height', gxtb_fb_lB_lang); ?>
							</strong>
						</td>
                        <td width="80%" valign="top">
						<input name="gxtb_fb_lB_generator_width" id="gxtb_fb_lB_generator_width" type="text" onchange="gxtb_generator()" value="<?php if (isset($this->GBLikeButton['Generator']['width']) && $this->GBLikeButton['Generator']['width'] != "") {echo $this->GBLikeButton['Generator']['width'];} else {echo "";} ?>" size="4" maxlength="4"/> px <small>(<?php _e('Default', gxtb_fb_lB_lang); ?>: 250 px)</small>
							<br />
							<input name="gxtb_fb_lB_generator_height" id="gxtb_fb_lB_generator_height" type="text" onchange="gxtb_generator()" value="<?php if (isset($this->GBLikeButton['Generator']['height']) && $this->GBLikeButton['Generator']['height'] != "") {echo $this->GBLikeButton['Generator']['height'];} else {echo "";} ?>" size="4" maxlength="4"/> px <small>(<?php _e('Default', gxtb_fb_lB_lang); ?>: 100 px)</small>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					 <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Like-Button-Design', gxtb_fb_lB_lang); ?>
							</strong>
						</td>
                        <td width="80%" valign="top">
					<p><label><?php _e('Color Scheme', gxtb_fb_lB_lang); ?><br />
					<SELECT NAME="gxtb_fb_lB_generator_color" id="gxtb_fb_lB_generator_color" onchange="gxtb_generator()">
					<?php
					$i = array( "light", "dark" );
					  foreach($i as $variable) {
						if($variable == $this->GBLikeButton['Generator']['color'] && isset($this->GBLikeButton['Generator']['color'])) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</SELECT>
			</label></p>
            
			<p><label><?php _e('Font', gxtb_fb_lB_lang); ?><br />
					<SELECT NAME="gxtb_fb_lB_generator_font" id="gxtb_fb_lB_generator_font" onchange="gxtb_generator()">
					<?php
					$i = array( "" ,"arial", "luciada grande", "segoe ui", "tahoma", "trebuchet ms", "verdana" );
					  foreach($i as $variable) {
						if($variable == $this->GBLikeButton['Generator']['font'] && isset($this->GBLikeButton['Generator']['font'])) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</SELECT>
			</label></p>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
<?php }
function tab3() {
	$this->GBLikeButton = get_option('GBLikeButton');
	?>
<tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Like-Button-Design', gxtb_fb_lB_lang); ?>
							</strong>
						</td>
                        <td width="80%" valign="top">
<!-- BEGIN generator-settings for the iframe -->
<div id="xtraIframe" style="visibility:visible">          
          <p><label><?php _e('Scrolling', gxtb_fb_lB_lang); ?><br />
					<input name="gxtb_fb_lB_generator_scrolling" id="gxtb_fb_lB_generator_scrolling" <?php if($this->GBLikeButton['General']['jdk']) { echo "disabled"; }?> type="checkbox" class="checkbox" onchange="gxtb_generator()" <?php if ($this->GBLikeButton['Generator']['scrolling']) echo("checked"); ?>  value="1"/>
			</label></p>

          <p><label><?php _e('Frameborder', gxtb_fb_lB_lang); ?><br />
					<input name="gxtb_fb_lB_generator_frameborder" id="gxtb_fb_lB_generator_frameborder" <?php if($this->GBLikeButton['General']['jdk']) { echo "disabled"; }?>  type="text" onchange="gxtb_generator()" value="<?php if ($this->GBLikeButton['Generator']['frameborder'] != "") {echo $this->GBLikeButton['Generator']['frameborder'];} else {echo "";} ?>" size="4" maxlength="4"/>px
			</label></p>

          <p><label><?php _e('Style (of the Border)', gxtb_fb_lB_lang); ?><br />
					<input name="gxtb_fb_lB_generator_borderstyle" id="gxtb_fb_lB_generator_borderstyle" <?php if($this->GBLikeButton['General']['jdk']) { echo "disabled"; }?>  type="text" onchange="gxtb_generator()" value="<?php if ($this->GBLikeButton['Generator']['borderstyle'] != "") {echo $this->GBLikeButton['Generator']['borderstyle'];} else {echo "";} ?>" size="20" maxlength="20"/><br />
					<?php _e('Example: none or solid', gxtb_fb_lB_lang); ?>
			</label></p>

          <p><label><?php _e('Overflow', gxtb_fb_lB_lang); ?></label><br />
					<select name="gxtb_fb_lB_generator_overflow" id="gxtb_fb_lB_generator_overflow" <?php if($this->GBLikeButton['General']['jdk']) { echo "disabled"; }?>  onchange="gxtb_generator()">
					<?php
					$i = array( "hidden", "scroll");
					  foreach($i as $variable) {
						if($variable == $this->GBLikeButton['Generator']['overflow']) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</select>
             </p>

          <p><label><?php _e('Allow Transparency', gxtb_fb_lB_lang); ?><br />
					<input name="gxtb_fb_lB_generator_trans" id="gxtb_fb_lB_generator_trans" <?php if($this->GBLikeButton['General']['jdk']) { echo "disabled"; }?>  type="checkbox" class="checkbox" onchange="gxtb_generator()" <?php if ($this->GBLikeButton['Generator']['trans']) echo("checked"); ?> value="1" />
			</label></p>
</div>
<div id="iframe_info" style="visibility:visible"><small>
	<?php if ($this->GBLikeButton['General']['jdk']) { _e('You do not need this disabled options if you use the XFBML (Java-SDK).', gxtb_fb_lB_lang); } ?></small>
</div>
<!-- END generator-settings for the iframe -->
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
<?php }
} // end class
} // end if-class
} // end if-class
?>