<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-Settings-Page [v0.3.2 - FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       Plugin-Settings		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net ##############
####################################################
if (!class_exists('gxtb_gb_settings')) {
include_once( dirname(dirname(__FILE__)) . '/include/gb_cleaner.php' );
class gxtb_gb_settings extends GBCleaner {
	
	var $gxtb_fb_lB_Settings;
	var $gxtb_fb_lB_Cleaner;
	var $GBCleaner;
	var $GBWidgetCleaner;
	var $pagehook;
	
function gxtb_gb_settings($pagehook) {

$this->pagehook = $pagehook;
	
		include('gb_plugin.php');	
		$this->gxtb_fb_lB_Settings = new gxtb_fb_lB_Settings;
		$this->GBCleaner = new GBCleaner();
		$this->GBWidgetCleaner = new GBLikeButtonWidgetCleaner();
		
		global $screen_layout_columns, $wp_version;
		$screen_layout_columns = 2;

		add_meta_box('gb_fb_tools',  __('Like-Button-Plugin-For-Wordpress Tools', gxtb_fb_lB_lang), array(&$this, 'gb_tools'), $this->pagehook, 'first', 'core');
		if ( version_compare( $wp_version, '3.0', '>=' ) ) {
			add_meta_box('gb_fb_plugin',  __('Plugin-Settings', gxtb_fb_lB_lang), array(&$this, 'gb_plugin'), $this->pagehook, 'first', 'core');
		}		
		add_meta_box('gb_fb_functions',  __('Plugin-Functions', gxtb_fb_lB_lang), array(&$this, 'gb_functions'), $this->pagehook, 'first', 'core');
		add_meta_box('gb_fb_editor',  __('Editor-Settings - more available soon', gxtb_fb_lB_lang), array(&$this, 'gb_editor'), $this->pagehook, 'first', 'core');
		add_meta_box('gb_fb_additional',  __('Additional Functions', gxtb_fb_lB_lang), array(&$this, 'gb_additional'), $this->pagehook, 'first', 'core');
		
		if ( isset( $_POST['gxtb_run_cleaner']) && $_POST['gxtb_run_cleaner'] == 1 ) {
			if(!get_option('GBLikeButton')) { $this->GBCleaner->GBCleanerAdd(); } else {$this->GBCleaner->GBCleanerUpdate(); $this->GBCleaner->GBCleanerNewAndModify(false);}
		}
		if (isset( $_POST['gxtb_reset']) && $_POST['gxtb_reset'] == 1) {
			$this->GBCleaner->GBCleanerReset();
		}
		#if (isset( $_POST['gxtb_delete'] ) && $_POST['gxtb_delete'] == 1) {
		#	$this->GBCleaner->GBCleanerReset();
		#}		
		if (isset( $_POST['gxtb_run_widgetcleaner']) && $_POST['gxtb_run_widgetcleaner'] == 1) {
			$this->GBWidgetCleaner->WidgetCleaner_Update(true);
		}
		
		if (isset( $_POST['gxtb_widgetreset']) && $_POST['gxtb_widgetreset'] == 1) {
			$this->GBWidgetCleaner->GBWidgetCleaner_Reset();
		}
				
#########################################################
		include('gb_admin_sidebar.php');
#########################################################	
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<form method="post" class="formlyWrapper-Base" action="<?php echo admin_url( 'admin.php?page=fb-like-settings' ); ?>" name="settingpage" id="settingpage" class="settingpage">
<?php gb_admin_header::gb_admin_title(); ?> 
<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
		<div id="poststuff" class="metabox-holder" style="width: 100%;">
				<!-- Sidebar -->
				<div id="side-info-column" class="inner-sidebar">
					<?php
					    do_meta_boxes($this->pagehook, 'additional_fb', "");
						do_meta_boxes($this->pagehook, 'additional_support', "");
						do_meta_boxes($this->pagehook, 'additional_development', "");
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
function gb_tools() {
		$this->gxtb_fb_lB_Settings -> gxtb_fb_lB_Tools();
	}
function gb_plugin() {
		$this->gxtb_fb_lB_Settings -> gxtb_fb_lB_Setting();
	}
function gb_functions() {
		$this->gxtb_fb_lB_Settings -> gxtb_fb_lB_Functions();
	}
function gb_editor() {
		$this->gxtb_fb_lB_Settings -> gxtb_fb_lB_EditorSettings();
	}
function gb_additional() {
		$this->gxtb_fb_lB_Settings -> gxtb_fb_lB_Additional();
	}
} // end class
} // end if-class
?>