<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-QuickInstall-Page [v0.5 - FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	   ADMIN-PAGE-QuickInstall	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('GBLikeButtonQuickInstall')) {
class GBLikeButtonQuickInstall {
	
	var $GBLikeButton;
	var $pagehook;
	
function GBLikeButtonQuickInstall($pagehook) {

		$this->pagehook = $pagehook;
	
		global $screen_layout_columns;
		$screen_layout_columns = 2;
		
		include_once('gb_general.php'); 
		include_once('gb_design.php');
		include_once('gb_meta.php');
		include('gb_admin_sidebar.php');

		add_meta_box('gb_fb_button', __('FB-Button-Settings', gxtb_fb_lB_lang), array(&$this, 'GBButtonSettings'), $this->pagehook, 'first', 'core');
		add_meta_box('gb_fb_generator', __('Like-Button-Generator', gxtb_fb_lB_lang), array(&$this, 'GBGenerator'), $this->pagehook, 'second', 'core');
		add_meta_box('gb_fb_design', __('FB-Button-Design', gxtb_fb_lB_lang), array(&$this, 'GBButtonDesign'), $this->pagehook, 'third', 'core');
		add_meta_box('gb_fb_opengraph', __('FB-Open Graph Protocol', gxtb_fb_lB_lang), array(&$this, 'GBOpenGraph'), $this->pagehook, 'fourth', 'core');			
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<form method="post" class="formlyWrapper-Base" action="<?php echo admin_url( 'admin.php?page=fb-like-button' ); ?>" name="settingpage" id="settingpage" class="settingpage">
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
							<?php do_meta_boxes($this->pagehook, 'second', ""); ?>
							<?php do_meta_boxes($this->pagehook, 'third', ""); ?>
							<?php do_meta_boxes($this->pagehook, 'fourth', ""); ?>
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

function GBButtonSettings() {
	$GBSettingsContent = new GBSettingsContent(); ?>
	<table class="form-table">
		<?php $GBSettingsContent->tab1(); ?>
		<?php $GBSettingsContent->tab2(); ?>
	</table>
<?php }
function GBGenerator() {
$this->GBLikeButton = get_option('GBLikeButton');
	$GBGeneratorContent = new GBGeneratorContent();
?>
	<table class="form-table">
		<?php $GBGeneratorContent->tab1(); ?>
		<?php $GBGeneratorContent->tab2(); ?>
        <?php $GBGeneratorContent->preview(); ?>
	</table>
<?php } // end function
function GBButtonDesign() {
	$this->GBLikeButton = get_option('GBLikeButton');
	$GBDesignContent = new GBDesignContent();
?>
	<table class="form-table">
		<?php $GBDesignContent->tab1(); ?>
	</table>
<?php } // end function
function GBOpenGraph() {
	$this->GBLikeButton = get_option('GBLikeButton');
	$GBMetaContent = new gxtb_gb_metacontent();
?>
	<table class="form-table">
		<?php $GBMetaContent->tab1(); ?>
		<?php $GBMetaContent->tab2(); ?>
		<?php $GBMetaContent->tab3(); ?>
	</table>

<?php } // end function
} // end class
} // end if-class
?>