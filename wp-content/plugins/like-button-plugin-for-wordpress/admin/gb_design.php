<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-Design-Page [v0.2 - FINAL]
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
if (!class_exists('gxtb_gb_design')) {
class gxtb_gb_design {
	
	var $GBLikeButton;
	var $pagehook;
	
function gxtb_gb_design($pagehook) {

		$this->pagehook = $pagehook;
	
		global $screen_layout_columns;
		$screen_layout_columns = 2;

		add_meta_box('gb_fb_design', __('FB-Button-Design', gxtb_fb_lB_lang), array(&$this, 'gb_design'), $this->pagehook, 'first', 'core');			
		include('gb_admin_sidebar.php');
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<form method="post" class="formlyWrapper-Base" action="<?php echo admin_url( 'admin.php?page=fb-like-design' ); ?>" name="settingpage" id="settingpage" class="settingpage">
<?php gb_admin_header::gb_admin_title();?> 
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

function gb_design() {
	$GBDesignContent = new GBDesignContent();
?>

<table class="form-table" border="0" id="gb-table">
	<tbody>
    	<tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('FB-Button-CSS', gxtb_fb_lB_lang ); ?>
				</strong>
			</td>		
            <td width="80%" valign="bottom">
			<!-- Tabs-Menue -->
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs ui-widget ui-corner-all" id="tabs_css">
			<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
				<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active ui-state-focus">
					<a href="#design" class="ui-state-default ui-corner-top">
						<?php _e('CSS-Design', gxtb_fb_lB_lang ); ?>
					</a>
				</li>
			</ul>
			<!-- /Tabs-Menue -->
            			
			<!-- Tabs-Content -->
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="design">	<table class="form-table">
<?php $GBDesignContent -> tab1(); ?>
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
<?php	
} // end function
} // end class
} // end if-class
if (!class_exists('GBDesignContent')) {
class GBDesignContent {
	function tab1() {
		$this->GBLikeButton = get_option('GBLikeButton');
?>
                    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('CSS-Class', gxtb_fb_lB_lang ); ?></strong></td>
                        <td width="80%" valign="middle">
							<input name="design_css" id="design_css" type="text" value="<?php if (isset($this->GBLikeButton['Design']['css']) && $this->GBLikeButton['Design']['css'] != "") {echo $this->GBLikeButton['Design']['css'];} else {echo "";} ?>" size="20" maxlength="50"/>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
							<small>
								<?php _e('Now it is possible to design your like-button like you want. If you enter something into this box it will work as a css-class and you can design it like you want in your css-file. You must configurate this css-class in the css-file and not here.', gxtb_fb_lB_lang ); ?><br />
								<u><?php _e('Example:', gxtb_fb_lB_lang ); ?></u><br />
								.classname { property:value; }
            				</small>
						</td>
                    </tr>
<?php if(isset($_GET['page']) && $_GET['page'] != "fb-like-button") { ?>				
					<!--<tr><td colspan="2"><HR SIZE=1></td></tr>-->
					
                    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('CSS-Design', gxtb_fb_lB_lang ); ?></strong></td>
                        <td width="80%" valign="middle">
							<textarea name="design_cssbox" rows="3" style="width:60%"><?php if (isset($this->GBLikeButton['Design']['cssbox']) && $this->GBLikeButton['Design']['cssbox'] != "") {echo $this->GBLikeButton['Design']['cssbox'];} else {echo "";} ?></textarea>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
							<small>
								<?php _e('You can also enter some css-stuff right here.', gxtb_fb_lB_lang ); ?><br />
								<u><?php _e('Example:', gxtb_fb_lB_lang ); ?></u><br />
								visabilty:block; border:none; padding-left:15px;
            				</small>
						</td>
                    </tr>
					
					<!--<tr><td colspan="2"><HR SIZE=1></td></tr>-->
<? } ?>					
                    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php echo sprintf('%s<br /><small>(&lt;br /&gt;)</small>', __('breaks', gxtb_fb_lB_lang )); ?></strong></td>
                        <td width="80%" valign="middle">
                             <select name="design_br_before" size="1"><?php						 
							 	  for($count = 0; $count <= 5; $count++)
								  { ?>
									<option <?php if(isset($this->GBLikeButton['Design']['br_before']) && $this->GBLikeButton['Design']['br_before'] == $count) echo "selected"; ?>><?php echo $count; ?></option>
								  <?php }

							 	?>
   							 </select> <?php _e('before the Like-Button', gxtb_fb_lB_lang ); ?>
							 <br />
							 <select name="design_br_after" size="1"><?php						 
							 	  for($count = 0; $count <= 5; $count++)
								  { ?>
									<option <?php if(isset($this->GBLikeButton['Design']['br_after']) && $this->GBLikeButton['Design']['br_after'] == $count) echo "selected"; ?>><?php echo $count; ?></option>
								  <?php }

							 	?>
   							 </select> <?php _e('after the Like-Button', gxtb_fb_lB_lang ); ?>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
							<small>
								<?php _e('You can choose how many breaks you wanna have before or after the Like Button. You can choose breaks here or define the margin and padding within the css-file.', gxtb_fb_lB_lang ); ?>
            				</small>
						</td>
                    </tr>
	
	<?php } // end function
} // end class
} // end if-class
?>