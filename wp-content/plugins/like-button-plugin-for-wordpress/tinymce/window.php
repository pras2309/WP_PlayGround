<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.4] - GB-TinyMCE-Button-Window-Design [v1.0]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  		TINYMCE-BUTTON		 ###########
###########		    			         ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

// look up for the path
require_once('tinymce-config.php');
global $wpdb;

# Infos: http://blog.netprofit.de/wordpress-tinymce-editor-anpassen-erweitern.html

// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here", gxtb_fb_lB_lang));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo gxtb_fb_lB_name; echo " [v"; echo gxtb_fb_lB_version; echo "]"; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript">
	function init() {
		tinyMCEPopup.resizeToInnerSize();
	}
	
	function insert_gbLinks() {
		
		var tagtext = "";
		var tagcontent = "";
		var rss = document.getElementById('rss_panel');
		var rss2 = document.getElementById('rss_panel2');
		
		// who is active ?
		if (rss.className.indexOf('current') != -1 || rss2.className.indexOf('current') != -1) {
			
			var gb_url = document.getElementById('gb_url').value;
			//var gb_action = document.getElementById('gb_action');
			var gb_width = document.getElementById('gb_width').value;
			var gb_height = document.getElementById('gb_height').value;
			var gb_style = document.getElementById('gb_style').value;
			var gb_layout = document.gblikebutton_postform.gb_layout.value;
						
			if (gb_url != '')
				tagcontent += " url=" + gb_url;
				
			if (document.gblikebutton_postform.gb_xfbml.selectedIndex == 1) {
				tagcontent += ' xfbml=true';
			} else if (document.gblikebutton_postform.gb_xfbml.selectedIndex == 2) {	
				tagcontent += ' xfbml=false';
			}
			
			if (document.gblikebutton_postform.gb_action.selectedIndex == 1) {
				tagcontent += " action=like";
			} else if (document.gblikebutton_postform.gb_action.selectedIndex == 2) {
				tagcontent += " action=recommend";
			}
			
			if(gb_layout != "-") { tagcontent += " layout=" + gb_layout; }
				
			if (gb_width != '')
				tagcontent += " width=" + gb_width;
				
			if (gb_height != '')
				tagcontent += " height=" + gb_height;
				
			if( gb_style != "")
				tagcontent += ' style=' + gb_style;
				
			if( document.getElementById('gb_class').value != "")
				tagcontent += ' class=' + document.getElementById('gb_class').value;
				
			//if( gb_xfbml != "")
				//tagcontent += ' xfbml=' + gb_xfbml;
				
			if (document.gblikebutton_postform.gb_div.selectedIndex == 1) {
				tagcontent += ' div=true';
			} else if (document.gblikebutton_postform.gb_div.selectedIndex == 2) {
				tagcontent += ' div=false';
			}
							
			tagtext = "[like" + tagcontent + "]";
				
			//tagtext = "[like]";
			//tinyMCEPopup.close();	
		}
		
		if(window.tinyMCE) {
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
			//Peforms a clean up of the current editor HTML. 
			//tinyMCEPopup.editor.execCommand('mceCleanup');
			//Repaints the editor. Sometimes the browser has graphic glitches. 
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
		
		return;
	}
	</script>
	<base target="_self" />
    
<?php load_plugin_textdomain( gxtb_fb_lB_lang, FALSE, gxtb_fb_lB_URLPATH .'/languages' ); ?>
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('gb_url').focus();" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="gblikebutton_postform" action="#">
	<div class="tabs" style="height:100%">
		<ul>
			<li id="rss_tab" class="current"><span><a href="javascript:mcTabs.displayTab('rss_tab','rss_panel');" onmousedown="return false;"><?php _e("Generator", gxtb_fb_lB_lang); ?></a></span></li>
			<li id="rss_tab2"><span><a href="javascript:mcTabs.displayTab('rss_tab2','rss_panel2');" onmousedown="return false;"><?php _e("Preview", gxtb_fb_lB_lang); ?></a></span></li>
		</ul>
	</div>
	
	<div class="panel_wrapper" style="height:100%">
		<!-- rss panel -->
		<div id="rss_panel" class="panel current" style="height:100%">
		<br />
		<table border="0" cellpadding="4" cellspacing="0" height="100%">
        <tr>
        	<td nowrap="nowrap"><label for="gb_xfbml"><?php _e("Like-Button Usage", gxtb_fb_lB_lang); ?></label></td>
        	<td>
            <SELECT NAME="gb_xfbml">
				<?php
                $i = array( "-", "XFBML", "iFrame" );
                  foreach($i as $variable) {
                      if ($variable == $i[0])
                        echo '<OPTION SELECTED>' . $variable .'</OPTION>';
                      else
                        echo '<OPTION>' . $variable .'</OPTION>';
                    }
                ?>
            </SELECT>
            </td>
         </tr>
         <tr>
            <td nowrap="nowrap"><label for="gb_url"><?php _e("Like-URL", gxtb_fb_lB_lang); ?></label></td>
            <td><input type="text" id="gb_url" name="gb_url" style="width: 190px" onchange="javascript:generate();" /><br />
				<?php _e("If you do not enter a URL the Like-Button will be dynamic.", gxtb_fb_lB_lang); ?>
            </td>
         </tr>
         <tr>
            <td nowrap="nowrap"><label for="gb_action"><?php _e("Action", gxtb_fb_lB_lang); ?></label></td>
            <td>
            <SELECT NAME="gb_action" onchange="javascript:generate();">
				<?php
                $i = array( "-", "like", "recommend" );
                  foreach($i as $variable) {
                      if ($variable == $i[0])
                        echo '<OPTION SELECTED>' . $variable .'</OPTION>';
                      else
                        echo '<OPTION>' . $variable .'</OPTION>';
                    }
                ?>
            </SELECT>
         </td></tr>
         <tr>
            <td nowrap="nowrap"><label for="gb_layout"><?php _e("Layout", gxtb_fb_lB_lang); ?></label></td>
            <td>
            <SELECT NAME="gb_layout" id="gb_layout" onchange="javascript:generate();">
				<?php
                $i = array( "-", "standard", "button_count", "box_count" );
                  foreach($i as $variable) {
                    if($variable == $i[0]) {
                        echo '<OPTION selected>' . $variable .'</OPTION>';
                    } else {
                        echo '<OPTION>' . $variable .'</OPTION>';
                    }
                }
                ?>
			</SELECT>
          </td></tr>
         <tr>
            <td nowrap="nowrap"><label for="gb_class"><?php _e("CSS-Class", gxtb_fb_lB_lang); ?></label></td>
            <td><input type="text" id="gb_class" name="gb_class" style="width: 190px" />
            </td>
         </tr>
        <tr>
        	<td nowrap="nowrap"><label for="gb_div"><?php _e("div-wrapping", gxtb_fb_lB_lang); ?></label></td>
        	<td>
            <SELECT NAME="gb_div">
				<?php
                $i = array( "-", __("yes", gxtb_fb_lB_lang), __("no", gxtb_fb_lB_lang) );
                  foreach($i as $variable) {
                      if ($variable == $i[0])
                        echo '<OPTION value="1" SELECTED>' . $variable .'</OPTION>';
                      else
                        echo '<OPTION value="0">' . $variable .'</OPTION>';
                    }
                ?>
            </SELECT>
            </td>
         </tr>				
         <tr>
            <td nowrap="nowrap"><label for="gb_width"><?php _e("Width", gxtb_fb_lB_lang); ?></label></td>
            <td><input type="text" id="gb_width" name="gb_width" size="4" maxlength="4" onchange="javascript:generate();" />px</td>
         </tr>
         <tr>
            <td nowrap="nowrap"><label for="gb_height"><?php _e("Height", gxtb_fb_lB_lang); ?></label></td>
            <td><input type="text" id="gb_height" name="gb_height" size="4" maxlength="4" onchange="javascript:generate();" />px</td>
         </tr>
         <tr>
            <td nowrap="nowrap"><label for="gb_style"><?php _e("Style", gxtb_fb_lB_lang); ?></label></td>
            <td>
            	<input type="text" id="gb_style" name="gb_style" style="width: 190px" onchange="javascript:generate();" /><br />
				(<?php _e("For example: border:solid;float:left;", gxtb_fb_lB_lang); ?>)</td>
         </tr>
            <td nowrap="nowrap" colspan="3">
				<label for="rsstag">
					<b><?php _e("Example", gxtb_fb_lB_lang); ?>:</b>
						<br />
					<small><?php _e("[like url=http://www.gb-world.net action=recommend width=250 height=100 style=border:none]", gxtb_fb_lB_lang); ?></small>
                    	<br /><br />
					<?php _e("If you keep the textbox emtpy it will only insert [like].", gxtb_fb_lB_lang); ?>
						<br />
					<?php _e("The Button will use the Like-Button-Settings you defined the Option Page.", gxtb_fb_lB_lang); ?>
				</label>
			</td>
          </tr>
        </table>
		</div>
		<!-- end rss panel -->
		
		<!-- rss panel -->
		<div id="rss_panel2" class="panel"style="height:100%">
		<br />
		<b><?php _e("Notice", gxtb_fb_lB_lang); ?>:</b> <?php _e("Currently this Preview only helps you to see how many likes this post allready has. The final design can variaty from this preview! Will be availabe within the next updates.", gxtb_fb_lB_lang); ?>
		<br /><br />
			<div id="gb_like"style="height:100%">
				<iframe src="http://www.facebook.com/plugins/like.php?href=http://www.facebook.com/GBWorldnet&amp;layout=standard&amp;show_faces=true&amp;width=250&amp;action=like&amp;colorscheme=light&amp;height=100" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:100px;" allowTransparency="true"></iframe>
			</div>
		</div>
		
<script type="text/javascript">
function generate() {
	
			var gb_url = document.getElementById('gb_url').value;
	
			if(gb_url == "") {
				gb_url = "<?php echo get_bloginfo('url'); ?>";
			}
			
			var like = document.getElementById('gb_like');
			//var gb_action = document.getElementById('gb_action');
			var gb_action = "like";
			var gb_width = document.getElementById('gb_width').value;
			var gb_height = document.getElementById('gb_height').value;
			var gb_layout = document.gblikebutton_postform.gb_layout.value;
			var gb_style = '';
			
			if(document.getElementById('gb_style').value != "")
				gb_style = 'style="' + document.getElementById('gb_style').value + ';"';
			
			if (document.gblikebutton_postform.gb_action.selectedIndex == 0) {
				gb_action = "like";
			} else {
				gb_action = "recommend";
			}
			if (gb_width == '')
				gb_width = 250;
				
			if (gb_height == '')
				gb_height = 100;
			
			like.innerHTML = '<div' + gb_style + '><iframe src="http://www.facebook.com/plugins/like.php?href='+ gb_url +'&amp;layout='+ gb_layout +'&amp;show_faces=true&amp;width='+ gb_width +'&amp;action='+ gb_action +'&amp;colorscheme=light&amp;height='+ gb_height +'" scrolling="no" frameborder="0" style="'+ gb_style +' width:'+ gb_width +'px; height:'+ gb_height +'px;" allowTransparency="true"></iframe></div>';
}
</script>
<!-- end rss panel -->
		
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", gxtb_fb_lB_lang); ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="<?php _e("Insert", gxtb_fb_lB_lang); ?>" onclick="insert_gbLinks();" />
		</div>
	</div>
</form>
</body>
</html>
<?php

?>
