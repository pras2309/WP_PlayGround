<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-Admin-Header [v0.5 - FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       GB-World-Header  	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('gb_admin_header')) {
class gb_admin_header {
public static function gb_admin_head() {
echo '

<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->
';
if($_GET['page']=="fb-like-faq"){ ?>
<style type="text/css">
	@media (max-width: 1640px) {ol.gb-faq, ul.gb-faq { max-width:450px;} /* optimized ul/ol for smartphones and smaller screens (FAQ-Page) */}
	@media (max-width: 1400px) {ol.gb-faq, ul.gb-faq { max-width:350px;} /* optimized ul/ol for smartphones and smaller screens (FAQ-Page) */}
</style>
<?php } ?><style type="text/css">
/* http://developme.wordpress.com/2010/02/07/simple-easy-loading-overlay/ */
.progress-indicator{top:0;right:0;width:100%;height:100%;position:fixed;text-align:center;filter:progid:DXImageTransform.Microsoft.Alpha(opacity=50);-moz-opacity:0.5;-khtml-opacity:0.5;opacity:0.5;z-index:1000;background-color:#FFF}
.progress-indicator img{padding-top:25%}
img#toparrow{position:fixed;right:10px;bottom:10px;border:0}
.accordionButton{background:#fff url("<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/accordion/togglerc.gif" ?>") center right no-repeat;border:1px solid #ddd;margin-bottom:5px;padding:5px 15px}
.accordionContent{border:1px solid #ddd;margin-bottom:5px;padding:5px 15px}
.on{background:#fff url("<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/accordion/togglero.gif" ?>") center right no-repeat;border:1px solid #ddd}
.over{color:#c00;background:url("<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/accordion/bg-input.jpg" ?>") repeat-x scroll left top #FFF;border:1px solid #ccc}
</style>
<script type="text/javascript">
var GBLikeButton=jQuery.noConflict();
<?php if(isset($_POST['fbsubmit'])){ ?>
GBLikeButton(window).load(function() {
if(GBLikeButton(".gbfade").length > 0) {
 GBLikeButton(".gbfade").delay(5500).fadeOut(1000);
}	 
});
<?php } else { ?>
GBLikeButton(window).load(function() {
if(GBLikeButton(".gbfade").length > 0) {
 GBLikeButton(".gbfade").delay(15500).fadeOut(1000);
}	 
});
<?php } ?>
GBLikeButton('div.gb_loading').live('click', function () { GBLikeButton('div.gb_loading').fadeOut(); });
GBLikeButton(document).ready(function(){
	GBLikeButton('div.gb_loading').fadeOut(1000);
	GBLikeButton.getScript("http://js.gb-world.net/wordpress/like-button-plugin-for-wordpress/info.js");	
<?php if($_GET['page']=="fb-like-expert"){ ?>		
	GBLikeButton('a.gbtools_export').click(function() {
		GBLikeButton('a.gbtools_export').html('<?php _e("Export started...", gxtb_fb_lB_lang); ?>');
		window.setTimeout(function () {
			GBLikeButton('a.gbtools_export').html('<?php _e("Export finished...", gxtb_fb_lB_lang); ?>');
		    GBLikeButton('form.gb_expertform').attr('action', '<?php echo plugins_url() ."/like-button-plugin-for-wordpress/include/fb_export.php" ?>');
			GBLikeButton("#GBLikeButton_Options").val('exported \r\n' + GBLikeButton("#GBLikeButton_Options").val());
			GBLikeButton("form.gb_expertform").trigger("submit")
			window.setTimeout(function () {
				GBLikeButton('a.gbtools_export').html('<?php _e("Export", gxtb_fb_lB_lang); ?>');
			}, 2500);
		    GBLikeButton('form.gb_expertform').attr('action', '<?php echo admin_url( 'admin.php?page=fb-like-expert' ); ?>');
		}, 1500);
	});
	
	  GBLikeButton("span.gbtools_import").click( function() {
			GBLikeButton("div #fade_import").fadeIn(500).delay(3000).fadeOut(500);
	  });
<?php } ?>		
<?php if($_GET['page']=="fb-like-faq"){ echo 'SyntaxHighlighter.all();'; echo "GBLikeButton('span').GBSocialSpeed();";} ?>
//GBLikeButton('#settingpage').formly();
//Thumbs("img.thumb").thumbs();Thumbs("img.thumb").thumbsImg();GBLikeButton("img.thumb").thumbs();
<?php if($_GET['page']=="fb-like-button" || $_GET['page']=="fb-like-opengraph"){ echo "GBLikeButton('.thumb').thumbs('destroy');GBLikeButton('.thumb').thumbs();imagePreview();"; } ?>
GBLikeButton("a.fancylink").fancybox();GBLikeButton("a.fancylink_iframe").fancybox({'width':'75%','height':'75%','autoScale':false,'transitionIn':'none','transitionOut':'none','type':'iframe'});
<?php if($_GET['page']=="fb-like-general" || $_GET['page']=="fb-like-opengraph"){ echo "GBLikeButton('#tabs_general').tabs();GBLikeButton('#tabs_generator').tabs();"; } ?>
<?php if($_GET['page']=="fb-like-design"){ echo "GBLikeButton('#tabs_css').tabs();"; } ?>
<?php if($_GET['page']=="fb-like-expert"){ echo "GBLikeButton('#tabs_expert').tabs();"; } ?>
GBLikeButton('#dialog_link, ul#icons li').hover(function(){$(this).addClass('ui-state-hover')},function(){$(this).removeClass('ui-state-hover')});<?php if($_GET['page']=="fb-like-general" || $_GET['page']=="fb-like-button") {echo'post_focus();';} ?>
<?php if( $_GET['page']=="fb-like-button" || $_GET['page']=="fb-like-general") { ?>
var before = true;
var after = true;
		GBLikeButton(".gblikebutton_position").click( function() {
			if (!GBLikeButton('input[name=general_position_before]').is(':checked') && !GBLikeButton('input[name=general_position_after]').is(':checked')) {
				GBLikeButton("#fade_position").fadeIn(500);
				GBLikeButton(this).attr('checked', 'checked');
				GBLikeButton("#fade_position").delay(4000).fadeOut(500);
			} else { GBLikeButton("#fade_position").fadeOut(500); }
	      });
<?php } ?>
<?php if( $_GET['page']=="fb-like-settings") { ?>
        GBLikeButton("input[type=radio]").click( function() {
			
			var checked = 0;
			var unchecked = 0;

			GBLikeButton("input[type=radio]").each( function() { 
			
					if (GBLikeButton(this).is(':checked') && GBLikeButton(this).val() == 1) {
						checked++;					
					} else if ( GBLikeButton(this).is(':checked') && GBLikeButton(this).val() == 0){		
						unchecked++;			
					}
				 } 
			);
			
			if(checked > 0) { 
				GBLikeButton("input:submit[name='fbsubmit']").attr('value','<?php echo sprintf('%s', __("Execute the Tool", gxtb_fb_lB_lang)); ?>');
				GBLikeButton("input:submit[name='fbsubmit']").width(220);
				GBLikeButton("#fade_gbcleaner").fadeIn(500);
			} else { 
				GBLikeButton("input:submit[name='fbsubmit']").attr('value','<?php _e("Save Changes", gxtb_fb_lB_lang); ?>');
				GBLikeButton("input:submit[name='fbsubmit']").width(100);
				GBLikeButton("#fade_gbcleaner").fadeOut(500);	
			}
			
      });


	GBLikeButton("input[name=pluginsetting_w3c]").click( function() {
		if (GBLikeButton(this).is(':checked')) {
			GBLikeButton("#fade_w3c").fadeIn(500);
		} else {
			GBLikeButton("#fade_w3c").fadeOut(500);				
		}
	  });
		  	  
var $alert=GBLikeButton('#alert');if($alert.length){var alerttimer=window.setTimeout(function(){$alert.trigger('click')},6000);$alert.animate({height:$alert.css('line-height')||'50px'},200).click(function(){window.clearTimeout(alerttimer);$alert.animate({height:'0'},200)})}	}); </script>
<style type="text/css">
#alert{overflow:hidden;width:100%;text-align:center;position:absolute;font-size:13.5px!important;top:0;left:0;z-index:100;background-color:#000;height:0;color:#FFF;font:20px/40px arial, sans-serif;opacity:.7;filter:alpha(opacity=70);-moz-opacity:.7;-khtml-opacity:.7;}
</style>
<?php  #http://briancray.com/2009/05/06/twitter-style-alert-jquery-cs-php/
	ini_set('session.save_handler', 'files');
	
	$text = __("Currently you can not change all Editor-Settings but they will be available soon!", gxtb_fb_lB_lang);
	$themessage = get_magic_quotes_gpc() ?
		stripslashes(trim($text)) :
		trim($text);
	
	$_SESSION['gbmessage'] = $themessage;

} else { echo '});</script>'; }?>
<script type="text/javascript">
/* <![CDATA[ */
    (function() {
        var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';
        t.parentNode.insertBefore(s, t);
    })();
/* ]]> */
</script>
<?php
echo '
<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by Stefan Natter (http://www.gb-world.net) -->
';
?>
<?php ## Beta ajaxurl ##
global $wp_version;
if ( version_compare( $wp_version, '2.7.999', '>' ) ) {
?>
<script type="text/javascript">
var ajaxurl = ajaxurl;
</script>
<?php
} else {
?>
<script type="text/javascript">
var ajaxurl = "<?php echo get_bloginfo( 'wpurl') . '/wp-admin/admin-ajax.php'; ?>";
</script>
<?php } // end if
if(!empty($_SESSION['gbmessage']))
	{
		echo '<div id="alert">' . $_SESSION['gbmessage'] . '</div>';
		unset($_SESSION['gbmessage']);
	}
} // end function
public static function gb_admin_title() { ?>
<?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
<?php wp_nonce_field('fb-like-button'); ?>
<div style="position:relative;">
<?php if(isset($_GET['page']) && in_array($_GET['page'], array("fb-like-button", "fb-like-settings"))) { ?>
<a href="<?php echo admin_url( 'admin.php?page='.$_GET['page'] ); ?>&fbguide=true"><img style="display:block;position:absolute;top:5px;right:40px" src="<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/help.png?v=1"; ?>" onmouseover="tooltip.show('<?php _e('If you need a little help or you want to see our Guider through the Plugin you have to click on this Button!', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();"/></a>
<?php } ?>
<a href="http://facebook.com/GBWorldnet" target="_blank"><img style="display:block;position:absolute;top:5px;right:10px" src="<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/facebook.png?v=1"; ?>"/></a><br />
</div>
<h2><a name="header"></a><span id="gbheader"><?php echo gxtb_fb_lB_name;?></span> <a href="http://facebook.com/GBWorldnet" target="_blank"><img id="fblikebuttonimage" src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/fb_like.png" onmouseover="tooltip.show('<?php _e('Facebook-Button: all rights reserved by Facebook.com - this is only a modified variant of the button for this plugin.', gxtb_fb_lB_lang ); ?>');" onmouseout="tooltip.hide();"/></a></h2><hr />
<div id="gb-info" class="gb-info" style="display:none;"><div class="ui-widget"><div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong><span id="gb-info-title"></span></strong> <span id="gb-info-content"></span></p></div></div></div>
<?php include( 'gb_save.php' ); ?>
<div class="progress-indicator gb_loading" id="gb_loading">
   <img src="<?php echo plugins_url() ."/like-button-plugin-for-wordpress/images/loading.gif?v=1"; ?>"/>
</div>
<?php 
	global $GBMessage;
	$GBMessage->GBMessage_Init();
	$GBMessage->GBMessage_Output();
?>
<?php }
} // end class
} // end if-class
/* 
Offen:
+ Ausbau auf eigene JS-Klasse der jQuery-Zeilen
*/
?>