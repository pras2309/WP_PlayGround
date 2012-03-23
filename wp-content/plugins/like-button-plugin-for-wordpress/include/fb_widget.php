<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.3.1] - GB-FB-Widget [v1.5.2 - OPEN RELEASE] - OFFEN: 1x + option auf neuen Standard bringen + Optionen in GBLikeButtonWidget umspeichern (neuer Standard) + ZEILE 201 + XFBML Like Widget Output
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

if (!class_exists('class gxtb_fb_lB_WidgetClass')) {	
class gxtb_fb_lB_WidgetClass {
	
	var $GBLikeButtonWidget;

function gxtb_fb_lB_WidgetClass() {
	
	$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');
	
	add_action('plugins_loaded', array( $this, 'GBLikeButton_WidgetAdd' ));
	
	$mypluginoptionpageslug = 'widgets.php';
	if (strpos($_SERVER['REQUEST_URI'],$mypluginoptionpageslug)) { $ismypluginoptionpage = 'true'; } else { $ismypluginoptionpage = 'false'; }
		 
	if ( $ismypluginoptionpage == 'true' ) { 
		#add_action('admin_head', array(&$this, 'gxtb_fb_lB_widget_header'));
		wp_enqueue_script('gb-generator');
		wp_enqueue_style('gb-widget');
		wp_enqueue_style('gb-tooltips');
	}
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    LIKE WIDGET (Output)	 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget($args) {
	
	$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');
	extract($args);
	echo $before_widget;
	echo $before_title; 
	
	if ($this->GBLikeButtonWidget['LikeButton']['title'] != "")
		echo $this->GBLikeButtonWidget['LikeButton']['title'];
	else
		echo "Facebook-Like-Button";
	
	echo $after_title;
	$this -> gxtb_fb_lB_Content();
	echo $after_widget;
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########		    LIKE Widget			 ###########
###########				CONTENT			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_Content() {
	
$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');

	if($this->GBLikeButtonWidget['LikeButton']['dynamic']) {
		
		global $post, $wp_query;
		
		if(is_single()){
			$permalink = get_permalink($post->ID);
		}elseif(is_page()){
			$permalink = get_page_link($post->ID);
		}elseif(is_home()) {
			$permalink = get_bloginfo('url');
		}else {
			$permalink = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		}
	} else {
		$permalink = $this->GBLikeButtonWidget['LikeButton']['url'];
	}

	if ($this->GBLikeButtonWidget['LikeButton']['width'] == "") {
		$width = "450";
	} else{
		$width = $this->GBLikeButtonWidget['LikeButton']['width'];
	}
	
	if ($this->GBLikeButtonWidget['LikeButton']['height'] == "") {
		$height = "150";
	} else{
		$height = $this->GBLikeButtonWidget['LikeButton']['height'];
	}

	if ($this->GBLikeButtonWidget['LikeButton']['frameborder'] == "") {
		$frameborder = "0";
	} else{
		$frameborder = $this->GBLikeButtonWidget['LikeButton']['frameborder'];
	}
	
	if ($this->GBLikeButtonWidget['LikeButton']['borderstyle'] == "") {
		$borderstyle = "none";
	} else{
		$borderstyle = $this->GBLikeButtonWidget['LikeButton']['borderstyle'];
	}
		
	if ($this->GBLikeButtonWidget['LikeButton']['trans']) {
		$trans = "true";
	} else{
		$trans = "false";
	}	
	
	if ($this->GBLikeButtonWidget['LikeButton']['scrolling']) {
		$scrolling = "yes";
	} else{
		$scrolling = "no";
	}
	
	if(!isset($this->GBLikeButtonWidget['LikeButton']['language']) || $this->GBLikeButtonWidget['LikeButton']['language'] == "") {
	 $this->GBLikeButtonWidget['LikeButton']['language'] = "en_US";
	}
	
	 if($this->GBLikeButtonWidget['LikeButton']['font'] != "") {
		 
		 switch ($this->GBLikeButtonWidget['LikeButton']['font']) {
			 case "luciada grande":
			 	$font = "lucida+grande";
			 break;
			 
			 case "segoe ui":
			 	$font = "segoe+ui";
			 break;
			 
			 case "trebuchet ms":
			 	$font = "trebuchet+ms";
			 break;
			 
			 default:
			 	$font = $this->GBLikeButtonWidget['LikeButton']['font'];
			 break;
		 }
		 
		$font = 'font=' . $font . '&amp;';
	} else {
		$font = '';	
	}
	
	  // generiert die FB-Insights-Analyse (REF)
	  $ref = "";
	  
	  if( isset( $this->GBLikeButtonWidget['LikeButton']['ref'] ) && !empty( $this->GBLikeButtonWidget['LikeButton']['ref'] ) ) {
		  $ref = '&amp;ref='. $this->GBLikeButtonWidget['LikeButton']['ref'];
	  }

?>
<?php echo '<!-- using ' . gxtb_fb_lB_name . '-Like-Button-Sidebar-Widget [v' . gxtb_fb_lB_version . '] | by Stefan Natter (http://www.gb-world.net) -->'; ?>
<?php if( isset( $this->GBLikeButtonWidget['LikeButton']['css'] ) && !empty( $this->GBLikeButtonWidget['LikeButton']['css'] ) ) {
			echo '<div class="'. $this->GBLikeButtonWidget['LikeButton']['css'] . '">';
		}
?><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode($permalink); ?>&layout=<?php echo $this->GBLikeButtonWidget['LikeButton']['layout']; ?>&amp;show_faces=<?php echo $this->GBLikeButtonWidget['LikeButton']['faces']; ?>&amp;width=<?php echo $width; ?>&amp;action=<?php echo $this->GBLikeButtonWidget['LikeButton']['verb']; ?>&amp;<?php echo $font; ?>colorscheme=<?php echo $this->GBLikeButtonWidget['LikeButton']['color']; ?><?php echo "&amp;height=" . $height; ?><?php echo $ref; ?><?php echo '&amp;locale='. $this->GBLikeButtonWidget['LikeButton']['language']; ?>" scrolling="<?php echo $scrolling; ?>" frameborder="<?php echo $frameborder; ?>" allowTransparency="<?php echo $trans; ?>" style="border:<?php echo $borderstyle; ?>; overflow:<?php echo $this->GBLikeButtonWidget['LikeButton']['overflow']; ?>; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px"></iframe>
<?php if( isset( $this->GBLikeButtonWidget['LikeButton']['css'] ) && !empty( $this->GBLikeButtonWidget['LikeButton']['css'] ) ) {
			echo '</div>';
		}
echo '<!-- using ' . gxtb_fb_lB_name . '-Like-Button-Sidebar-Widget [v' . gxtb_fb_lB_version . '] | by Stefan Natter (http://www.gb-world.net) -->';
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########		    LIKE-Widget			 ###########
###########				CONTROL			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_control() {
$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');
?>
<div class="gb-widget">
    <p><label><?php _e('Title', 'gb_like_button'); ?> <b>(<?php _e('required', 'gb_like_button'); ?>)</b><br />
    <input name="gxtb_fb_lB_widget_title" type="text" value="<?php echo $this->GBLikeButtonWidget['LikeButton']['title']; ?>" />
    </label></p>

    <p><label><?php _e('URL', 'gb_like_button'); ?> <b>(<?php _e('required', 'gb_like_button'); ?>)</b><br />
    <input name="gxtb_fb_lB_widget_url" type="text" value="<?php echo $this->GBLikeButtonWidget['LikeButton']['url']; ?>" />
    </label></p>
    	
	<p><b><?php _e('Changes since 10th of September 2010:', 'gb_like_button'); ?></b><br />
	<?php _e('You can now also like your Facebook Pages and Application. Just enter the URL to your Facebook Page or Application (for example: <a href="http://www.facebook.com/GBWorldnet" target="_blank">http://www.facebook.com/GBWorldnet</a>)', 'gb_like_button'); ?></p>

<p><label><?php _e('Dynamic Links', 'gb_like_button'); ?><br />
<input name="gxtb_fb_lB_widget_dynamic" type="checkbox" class="checkbox" <?php if ($this->GBLikeButtonWidget['LikeButton']['dynamic']) echo("checked"); ?>/>  <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<u><?php _e('Activated', 'gb_like_button'); ?>:</u> <?php _e('Every Post/Page has its own Like-Button. Which means for every page on your side there will be a unique Like-Button.', 'gb_like_button'); ?> <?php _e('(recommended)', 'gb_like_button'); ?><br /><u><?php _e('Deactivated', 'gb_like_button'); ?>:</u> <?php _e('Every Post/Page has the same Like-Button. Which means if you click on it, it looks like you like/recommend every post even if you have not read it before.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();">
</label></p>

    <p><label><?php _e('Language', 'gb_like_button'); ?><br />
    <?php $fblikes_locales = GBLikeButton_Language();
echo '<select name="gxtb_fb_lB_widget_language" id="gxtb_fb_lB_widget_language">'; # onchange="gxtb_generator()"
foreach($fblikes_locales as $locale => $language) { 
	if ( (isset($this->GBLikeButtonWidget['LikeButton']['language']) && $locale == $this->GBLikeButtonWidget['LikeButton']['language']) || ((!isset($this->GBLikeButtonWidget['LikeButton']['language']) || $this->GBLikeButtonWidget['LikeButton']['language'] == "") && $locale == "en_US" )) {
        $select .= '<option value="' . htmlentities($locale) .'" selected="selected">'. htmlentities($language) .'</option>';
    } else {
       $select .= '<option value="' . htmlentities($locale) .'">'. htmlentities($language) .'</option>';
    }
}
echo $select;
echo '</select>';
?>
    </label></p>


    <p><label><?php _e('Layout Style', 'gb_like_button'); ?><br />
    <SELECT NAME="gxtb_fb_lB_widget_layout">
    <?php
    $i = array( "standard", "button_count", "box_count" );
      foreach($i as $variable) {
        if($variable == $this->GBLikeButtonWidget['LikeButton']['layout']) {
            echo '<OPTION selected>' . $variable .'</OPTION>';
        } else {
            echo '<OPTION>' . $variable .'</OPTION>';
        }
    }
    ?>
    </SELECT>
    </label></p>

    <p><label><?php _e('Show Faces?', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_faces" type="checkbox" class="checkbox" <?php if ($this->GBLikeButtonWidget['LikeButton']['faces']) echo("checked"); ?>  />
    </label></p>

    <p><label><?php _e('Width', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_width" type="text" value="<?php echo $this->GBLikeButtonWidget['LikeButton']['width']; ?>" size="4" maxlength="4"/>px
    </label></p>

    <p><label><?php _e('Height', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_height" type="text" value="<?php echo $this->GBLikeButtonWidget['LikeButton']['height']; ?>" size="4" maxlength="4"/>px
    </label></p>

    <p><label><?php _e('Verb to display', 'gb_like_button'); ?><br />
    <SELECT NAME="gxtb_fb_lB_widget_verb">
    <?php
    $i = array( "like", "recommend" );
      foreach($i as $variable) {
        if($variable == $this->GBLikeButtonWidget['LikeButton']['verb']) {
            echo '<OPTION selected>' . $variable .'</OPTION>';
        } else {
            echo '<OPTION>' . $variable .'</OPTION>';
        }
    }
    ?>
    </SELECT>
    </label></p>
    
    <p><label><?php _e('Color Scheme', 'gb_like_button'); ?><br />
    <SELECT NAME="gxtb_fb_lB_widget_color">
    <?php
    $i = array( "light", "dark", "evil" );
      foreach($i as $variable) {
        if($variable == $this->GBLikeButtonWidget['LikeButton']['color']) {
            echo '<OPTION selected>' . $variable .'</OPTION>';
        } else {
            echo '<OPTION>' . $variable .'</OPTION>';
        }
    }
    ?>
    </SELECT>
    </label></p>

      <p><label><?php _e('Font', 'gb_like_button'); ?><br />
              <SELECT NAME="gxtb_fb_lB_widget_font">
              <?php
              $i = array( "" ,"arial", "luciada grande", "segoe ui", "tahoma", "trebuchet ms", "verdana" );
                foreach($i as $variable) {
                  if($variable == $this->GBLikeButtonWidget['LikeButton']['font']) {
                      echo '<OPTION selected>' . $variable .'</OPTION>';
                  } else {
                      echo '<OPTION>' . $variable .'</OPTION>';
                  }
              }
              ?>
      </SELECT>
	</label></p>

          <p><label><?php _e('Scrolling', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_scrolling" type="checkbox" class="checkbox" <?php if ($this->GBLikeButtonWidget['LikeButton']['scrolling']) echo("checked"); ?>  />
			</label></p>

          <p><label><?php _e('Frameborder', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_frameborder" type="text" value="<?php if ($this->GBLikeButtonWidget['LikeButton']['frameborder'] != "") {echo $this->GBLikeButtonWidget['LikeButton']['frameborder'];} else {echo "";} ?>" size="4" maxlength="4"/>px
			</label></p>

          <p><label><?php _e('Style (of the Border)', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_borderstyle" type="text" value="<?php if ($this->GBLikeButtonWidget['LikeButton']['borderstyle'] != "") {echo $this->GBLikeButtonWidget['LikeButton']['borderstyle'];} else {echo "";} ?>" size="20" maxlength="20"/><br />
					<?php _e('Example: none or solid', 'gb_like_button'); ?>
			</label></p>

          <p><label><?php _e('Overflow', 'gb_like_button'); ?></label><br />
					<select name="gxtb_fb_lB_widget_overflow">
					<?php
					$i = array( "hidden", "scroll");
					  foreach($i as $variable) {
						if($variable == $this->GBLikeButtonWidget['LikeButton']['overflow']) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</select>
             </p>

          <p><label><?php _e('Allow Transparency', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_trans" type="checkbox" class="checkbox" <?php if ($this->GBLikeButtonWidget['LikeButton']['trans']) echo("checked"); ?>  />
		  </label></p>
		  
		 <p><label><?php _e('CSS-Design', 'gb_like_button'); ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('Add some CSS-Styling into this textbox like: visability:block;border:none;', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"><br />
					<input name="gxtb_fb_lB_widget_css" type="text" value="<?php if ($this->GBLikeButtonWidget['LikeButton']['css'] != "") {echo $this->GBLikeButtonWidget['LikeButton']['css'];} else {echo "";} ?>" />
		</label></p>
		
		<p><label><?php _e('Facebook-Insights', 'gb_like_button'); ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('This new Attribute will give you some new kind of information about the effectiveness of your like-button. Read more in the Plugin-FAQ or on the official Facebook Insights page.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"><br />
		<input name="gxtb_fb_lB_widget_ref" type="text" value="<?php if ($this->GBLikeButtonWidget['LikeButton']['ref'] != "") {echo $this->GBLikeButtonWidget['LikeButton']['ref'];} else {echo "";} ?>" size="15" maxlength="50"/>
		</label></p>
</div>
<?php
   // Saves the Widget-Options
   if (isset($_POST['gxtb_fb_lB_widget_url']) || isset($_POST['gxtb_fb_lB_widget_title']) ){
	   
	   $area = "LikeButton";
	   $keycode = "gxtb_fb_lB_widget_";
	   
	   foreach ($this->GBLikeButtonWidget[$area] as $key => $value) { 
	   	
		switch($key) {
			case "dynamic":
			case "faces":
			case "scrolling":
			case "trans":
				   	$this->GBLikeButtonWidget[$area][$key] = ( isset($_POST[$keycode . $key]) ) ? esc_attr($_POST[$keycode . $key]):0;
			break;
			
			case "language":
				   	$this->GBLikeButtonWidget[$area][$key] = ( isset($_POST[$keycode . $key]) ) ? esc_attr($_POST[$keycode . $key]):"en_US";
			break;
			
			default:
				   	$this->GBLikeButtonWidget[$area][$key] = ( isset($_POST[$keycode . $key]) ) ? esc_attr($_POST[$keycode . $key]):"";
			break;	
		}
	   }	   
	   
	  update_option('GBLikeButtonWidget', $this->GBLikeButtonWidget);
  }

}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    RECOMMENDATION WIDGET    ###########
###########			Output				 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_rec($args) { # OFFEN: Umbau auf neue Optionen #
	
	$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');
	extract($args);
	echo $before_widget;
	echo $before_title; 
	
	if ($this->GBLikeButtonWidget['Recommendation']['title'] != "")
		echo $this->GBLikeButtonWidget['Recommendation']['title'];
	else
		echo "Facebook-Recommendations";
	
	echo $after_title;
	$this -> gxtb_fb_lB_widget_rec1();
	echo $after_widget;
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    RECOMMENDATION			 ###########
###########			WIDGET				 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_rec1() {
$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');

	if ($this->GBLikeButtonWidget['Recommendation']['site'] == "") {
		global $wp_version;
		$site = (version_compare( $wp_version, '3.0', '>=' )) ? get_home_url() : get_bloginfo('siteurl');
	} else{
		$site = $this->GBLikeButtonWidget['Recommendation']['site'];
	}
	
	if ($this->GBLikeButtonWidget['Recommendation']['width'] == "") {
		$width = "450";
	} else{
		$width = $this->GBLikeButtonWidget['Recommendation']['width'];
	}
	
	if ($this->GBLikeButtonWidget['Recommendation']['height'] == "") {
		$height = "150";
	} else{
		$height = $this->GBLikeButtonWidget['Recommendation']['height'];
	}
	
	if ($this->GBLikeButtonWidget['Recommendation']['header']) {
		$header = "true";
	} else{
		$header = "false";
	}

	$border_style = ($this->GBLikeButtonWidget['Recommendation']['border_style'] != "") ? $this->GBLikeButtonWidget['Recommendation']['border_style']:"none";
	$border_color = ($this->GBLikeButtonWidget['Recommendation']['border_color'] != "") ? "&amp;border_color=" . $this->GBLikeButtonWidget['Recommendation']['border_color']:"";
		
	if($this->GBLikeButtonWidget['Recommendation']['font'] != "") {
		 
		 switch ($this->GBLikeButtonWidget['Recommendation']['font']) {
			 case "luciada grande":
			 	$font = "lucida+grande";
			 break;
			 
			 case "segoe ui":
			 	$font = "segoe+ui";
			 break;
			 
			 case "trebuchet ms":
			 	$font = "trebuchet+ms";
			 break;
			 
			 default:
			 	$font = $this->GBLikeButtonWidget['Recommendation']['font'];
			 break;
		 }
		 
		$font = 'font=' . $font . '&amp;';
	} else {
		$font = '';	
	}
	
	$scrolling = ($this->GBLikeButtonWidget['Recommendation']['scrolling'] == 1) ? "yes":"no";
	$trans = ($this->GBLikeButtonWidget['Recommendation']['trans'] == 1) ? "true":"false";
	$ref = ($this->GBLikeButtonWidget['Recommendation']['ref'] != "") ? "&amp;ref=" . $this->GBLikeButtonWidget['Recommendation']['ref']:"";

?>
<?php echo '<!-- using ' . gxtb_fb_lB_name . '-Recommendation-Sidebar-Widget [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->'; ?>
<?php if( isset( $this->GBLikeButtonWidget['Recommendation']['css'] ) && !empty( $this->GBLikeButtonWidget['Recommendation']['css'] ) ) {
			echo '<div class="'. $this->GBLikeButtonWidget['Recommendation']['css'] . '">';
		}
?><iframe src="http://www.facebook.com/plugins/recommendations.php?site=<?php echo urlencode($site); ?>&amp;width=<?php echo $width; ?>&amp;height=<?php echo $height; ?>&amp;header=<?php echo $header; ?>&amp;colorscheme=<?php echo $this->GBLikeButtonWidget['Recommendation']['colorscheme']; ?><?php echo $border_color; ?><?php echo $ref; ?>" scrolling="<?php echo $scrolling; ?>" frameborder="<?php echo $this->GBLikeButtonWidget['Recommendation']['frameborder']; ?>" style="border:<?php echo $border_style; ?>; overflow:<?php echo $this->GBLikeButtonWidget['Recommendation']['overflow']; ?>; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;" allowTransparency="<?php echo $trans; ?>"></iframe>
<?php if( isset( $this->GBLikeButtonWidget['Recommendation']['css'] ) && !empty( $this->GBLikeButtonWidget['Recommendation']['css'] ) ) {
			echo '</div>';
		}
?>
<?php echo '<!-- using ' . gxtb_fb_lB_name . '-Recommendation-Sidebar-Widget [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->';	
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########		RECOMMENDATION-Widget	 ###########
###########				CONTROL			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_control_rec() {
$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');
?>
<div class="gb-widget">

    <p><label><?php _e('Title', 'gb_like_button'); ?> <b>(<?php _e('required', 'gb_like_button'); ?>)</b><br />
    <input name="gxtb_fb_lB_widget_rec_title" type="text" value="<?php echo $this->GBLikeButtonWidget['Recommendation']['title']; ?>" />
    </label></p>

    <p><label><?php _e('Site', 'gb_like_button'); ?> <b>(<?php _e('required', 'gb_like_button'); ?>)</b><br />
    <input name="gxtb_fb_lB_widget_rec_site" type="text" value="<?php echo $this->GBLikeButtonWidget['Recommendation']['site']; ?>" />
    </label></p>

    <p><label><?php _e('Show Header?', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_rec_header" type="checkbox" class="checkbox" <?php if ($this->GBLikeButtonWidget['Recommendation']['header']) echo("checked"); ?>  />
    </label></p>

    <p><label><?php _e('Width', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_rec_width" type="text" value="<?php echo $this->GBLikeButtonWidget['Recommendation']['width']; ?>" size="4" maxlength="4"/>px
    </label></p>

    <p><label><?php _e('Height', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_rec_height" type="text" value="<?php echo $this->GBLikeButtonWidget['Recommendation']['height']; ?>" size="4" maxlength="4"/>px
    </label></p>
    
    <p><label><?php _e('Color Scheme', 'gb_like_button'); ?><br />
    <SELECT NAME="gxtb_fb_lB_widget_rec_colorscheme">
    <?php
    $i = array( "light", "dark" );
      foreach($i as $variable) {
        if($variable == $this->GBLikeButtonWidget['Recommendation']['colorscheme']) {
            echo '<OPTION selected>' . $variable .'</OPTION>';
        } else {
            echo '<OPTION>' . $variable .'</OPTION>';
        }
    }
    ?>
    </SELECT>
    </label></p>

      <p><label><?php _e('Font', 'gb_like_button'); ?><br />
              <SELECT NAME="gxtb_fb_lB_widget_rec_font">
              <?php
              $i = array( "" ,"arial", "luciada grande", "segoe ui", "tahoma", "trebuchet ms", "verdana" );
                foreach($i as $variable) {
                  if($variable == $this->GBLikeButtonWidget['Recommendation']['font']) {
                      echo '<OPTION selected>' . $variable .'</OPTION>';
                  } else {
                      echo '<OPTION>' . $variable .'</OPTION>';
                  }
              }
              ?>
      </SELECT>
	</label></p>

          <p><label><?php _e('Allow Transparency', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_rec_trans" type="checkbox" class="checkbox" <?php if ($this->GBLikeButtonWidget['Recommendation']['trans']) echo("checked"); ?>  />
		  </label></p>

          <p><label><?php _e('Scrolling', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_rec_scrolling" type="checkbox" class="checkbox" <?php if ($this->GBLikeButtonWidget['Recommendation']['scrolling']) echo("checked"); ?>  />
			</label></p>

          <p><label><?php _e('Frameborder', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_rec_frameborder" type="text" value="<?php if ($this->GBLikeButtonWidget['Recommendation']['frameborder'] != "") {echo $this->GBLikeButtonWidget['Recommendation']['frameborder'];} else {echo "";} ?>" size="4" maxlength="4"/>px
			</label></p>

    <p><label><?php _e('Border-Style', 'gb_like_button'); ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('For Example: none or solid - Please do not enter the ;-symbol. This will be added automatically. But if you add two attributes you have to seperate the first two but do not enter it at the end of this statemente.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"><br />
		 <input name="gxtb_fb_lB_widget_rec_border_style" type="text" value="<?php echo $this->GBLikeButtonWidget['Recommendation']['border_style']; ?>"/>
	</label></p>
    
    <p><label><?php _e('Border-Color', 'gb_like_button'); ?><br />
		 <input name="gxtb_fb_lB_widget_rec_border_color" type="text" value="<?php echo $this->GBLikeButtonWidget['Recommendation']['border_color']; ?>"/>
	</label></p>

          <p><label><?php _e('Overflow', 'gb_like_button'); ?></label><br />
					<select name="gxtb_fb_lB_widget_rec_overflow">
					<?php
					$i = array( "hidden", "scroll");
					  foreach($i as $variable) {
						if($variable == $this->GBLikeButtonWidget['Recommendation']['overflow']) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</select>
             </p>

	<p><label><?php _e('CSS-Design', 'gb_like_button'); ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('If you enter something into this breaks this will work as a style-attribute within the iframe-Output.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"><br />
		<input name="gxtb_fb_lB_widget_rec_css" type="text" value="<?php if ($this->GBLikeButtonWidget['Recommendation']['css'] != "") {echo $this->GBLikeButtonWidget['Recommendation']['css'];} else {echo "";} ?>" />
	</label></p>    

	<p><label><?php _e('Facebook-Insights', 'gb_like_button'); ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('This new Attribute will give you some new kind of information about the effectiveness of your like-button. Read more in the Plugin-FAQ or on the official Facebook Insights page.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"><br />
		<input name="gxtb_fb_lB_widget_rec_ref" type="text" value="<?php if ($this->GBLikeButtonWidget['Recommendation']['ref'] != "") {echo $this->GBLikeButtonWidget['Recommendation']['ref'];} else {echo "";} ?>" />
	</label></p>

</div>
<?php
	
   // Saves the Widget-Options
   if (isset($_POST['gxtb_fb_lB_widget_rec_title']) || isset($_POST['gxtb_fb_lB_widget_rec_site'])){
	      
	$area = "Recommendation";
	$keycode = "gxtb_fb_lB_widget_rec_";
	   
	foreach ($this->GBLikeButtonWidget[$area] as $key => $value) { 
	   	
		switch($key) {
			case "header":
			case "trans":
			case "scrolling":
				   	$this->GBLikeButtonWidget[$area][$key] = ( isset($_POST[$keycode . $key]) ) ? esc_attr($_POST[$keycode . $key]):0;
			break;
			
			default:
				   	$this->GBLikeButtonWidget[$area][$key] = ( isset($_POST[$keycode . $key]) ) ? esc_attr($_POST[$keycode . $key]):"";
			break;	
		}
	}
	   
	  update_option('GBLikeButtonWidget', $this->GBLikeButtonWidget);
  }
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    ACTIVITY FEED WIDGET     ###########
###########			Output				 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_act($args) {
	
	$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');
	extract($args);
	echo $before_widget;
	echo $before_title; 
	
	if ($this->GBLikeButtonWidget['ActivityFeed']['title'] != "")
		echo $this->GBLikeButtonWidget['ActivityFeed']['title'];
	else
		echo "Facebook-Activity-Feed";
	
	echo $after_title;
	$this -> gxtb_fb_lB_widget_actoutput();
	echo $after_widget;
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    ACTIVITY FEED			 ###########
###########			WIDGET				 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_actoutput() {
$this->GBLikeButtonWidget = get_option('GBLikeButtonWidget');

	if ($this->GBLikeButtonWidget['ActivityFeed']['site'] == "") {
		global $wp_version;
		$site = (version_compare( $wp_version, '3.0', '>=' )) ? get_home_url() : get_bloginfo('siteurl');
	} else{
		$site = $this->GBLikeButtonWidget['ActivityFeed']['site'];
	}
	
	$width = ($this->GBLikeButtonWidget['ActivityFeed']['width'] == "") ? "450":$this->GBLikeButtonWidget['ActivityFeed']['width'];
	$height = ($this->GBLikeButtonWidget['ActivityFeed']['height'] == "") ? "150":$this->GBLikeButtonWidget['ActivityFeed']['height'];
	$header = ($this->GBLikeButtonWidget['ActivityFeed']['header'] == 1) ? "true":"false";
	$colorscheme = (isset($this->GBLikeButtonWidget['ActivityFeed']['colorscheme'])) ? $this->GBLikeButtonWidget['ActivityFeed']['colorscheme']:"light";
	if($this->GBLikeButtonWidget['ActivityFeed']['font'] != "") {
		 
		 switch ($this->GBLikeButtonWidget['ActivityFeed']['font']) {
			 case "luciada grande":
			 	$font = "lucida+grande";
			 break;
			 
			 case "segoe ui":
			 	$font = "segoe+ui";
			 break;
			 
			 case "trebuchet ms":
			 	$font = "trebuchet+ms";
			 break;
			 
			 default:
			 	$font = $this->GBLikeButtonWidget['ActivityFeed']['font'];
			 break;
		 }
		$font = 'font=' . $font . '&amp;';
	} else {
		$font = '';	
	}
	$border_style = ($this->GBLikeButtonWidget['ActivityFeed']['border_style'] != "" ) ? $this->GBLikeButtonWidget['ActivityFeed']['border_style']:"none";
	$border_color = ($this->GBLikeButtonWidget['ActivityFeed']['border_style'] != "") ? "&amp;border_color=" . $this->GBLikeButtonWidget['ActivityFeed']['border_color']:"";
	$scrolling = ($this->GBLikeButtonWidget['ActivityFeed']['scrolling'] == 1) ? "yes":"no";
	$frameborder = ($this->GBLikeButtonWidget['ActivityFeed']['frameborder'] != "") ? $this->GBLikeButtonWidget['ActivityFeed']['frameborder']:"";
	$overflow = (isset($this->GBLikeButtonWidget['ActivityFeed']['overflow'])) ? $this->GBLikeButtonWidget['ActivityFeed']['overflow']:"hidden";
	$trans = ($this->GBLikeButtonWidget['ActivityFeed']['trans'] == 1) ? "true":"false";
	$recommendations = ($this->GBLikeButtonWidget['ActivityFeed']['recommendations'] == 1) ? "&amp;recommendations=true":"&amp;recommendations=false";
	$filter = (isset($this->GBLikeButtonWidget['ActivityFeed']['filter'])) ? "&amp;filter=" . $this->GBLikeButtonWidget['ActivityFeed']['filter']:"";
	$ref = ($this->GBLikeButtonWidget['ActivityFeed']['ref'] != "") ? "&amp;ref=" . $this->GBLikeButtonWidget['ActivityFeed']['ref']:"";
		
?>
<?php echo '<!-- using ' . gxtb_fb_lB_name . '-Activity-Feed-Sidebar-Widget [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->'; ?>
<?php if( isset( $this->GBLikeButtonWidget['ActivityFeed']['css'] ) && !empty( $this->GBLikeButtonWidget['ActivityFeed']['css'] ) ) {
			echo '<div class="'. $this->GBLikeButtonWidget['ActivityFeed']['css'] . '">';
		}
?><iframe src="http://www.facebook.com/plugins/activity.php?site=<?php echo urlencode($site); ?>&amp;width=<?php echo $width; ?>&amp;height=<?php echo $height; ?>&amp;header=<?php echo $header; ?>&amp;colorscheme=<?php echo $colorscheme; ?><?php echo $border_color; ?><?php echo $ref; ?><?php echo $filter; ?>" scrolling="<?php echo $scrolling; ?>" frameborder="<?php echo $frameborder; ?>" style="border:<?php echo $border_style; ?>; overflow:<?php echo $overflow; ?>; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;" allowTransparency="<?php echo $trans; ?>"></iframe>
<?php if( isset( $gxtb_fb_lB_data['act_css'] ) && !empty( $gxtb_fb_lB_data['act_css'] ) ) {
			echo '</div>';
		}
?>
<?php echo '<!-- using ' . gxtb_fb_lB_name . '-Actitivy-Feed-Sidebar-Widget [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->';	
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########		ACTIVITY FEED-Widget	 ###########
###########				CONTROL			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_control_act() {
$GBLikeButtonWidget = get_option('GBLikeButtonWidget');
?>
<div class="gb-widget">

    <p><label><?php _e('Title', 'gb_like_button'); ?> <b>(<?php _e('required', 'gb_like_button'); ?>)</b><br />
    <input name="gxtb_fb_lB_widget_act_title" type="text" value="<?php echo $this->GBLikeButtonWidget['ActivityFeed']['title']; ?>" />
    </label></p>

    <p><label><?php _e('Site', 'gb_like_button'); ?> <b>(<?php _e('required', 'gb_like_button'); ?>)</b><br />
    <input name="gxtb_fb_lB_widget_act_site" type="text" value="<?php echo $this->GBLikeButtonWidget['ActivityFeed']['site']; ?>" />
    </label></p>

    <p><label><?php _e('Show Recommendations?', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_act_recommendations" type="checkbox" class="checkbox" <?php if ($this->GBLikeButtonWidget['ActivityFeed']['recommendations']) echo("checked"); ?>  />
    </label></p>

    <p><label><?php _e('Filter', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_act_filter" type="text" value="<?php echo $this->GBLikeButtonWidget['ActivityFeed']['filter']; ?>" size="auto" maxlength="200"/> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/images/help_tooltip.png" onmouseover="tooltip.show('<?php _e('More Information about this filter on: http://developers.facebook.com/docs/reference/plugins/activity/', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();">
    </label><br />
    <small><b>filter</b> - allows you to filter which URLs are shown in the plugin. The plugin will only include URLs which contain the filter string in the first two path parameters of the URL. If nothing in the first two path parameters of the URL matches the filter, the URL will not be included. For example, if the 'site' parameter is set to 'www.example.com' and the 'filter' parameter was set to '/section1/section2' then only pages which matched 'http://www.example.com/section1/section2/*' would be included in the activity feed section of this plugin. The filter parameter does not apply to any recommendations which may appear in this plugin (see above); Recommendations are based only on 'site' parameter. (by <a href="http://developers.facebook.com/docs/reference/plugins/activity/" target="_new">Facebook.com</a>)</small></p>

    <p><label><?php _e('Show Header?', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_act_header" type="checkbox" class="checkbox" <?php if ($this->GBLikeButtonWidget['ActivityFeed']['header']) echo("checked"); ?>  />
    </label></p>

    <p><label><?php _e('Width', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_act_width" type="text" value="<?php echo $this->GBLikeButtonWidget['ActivityFeed']['width']; ?>" size="4" maxlength="4"/>px
    </label></p>

    <p><label><?php _e('Height', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_act_height" type="text" value="<?php echo $this->GBLikeButtonWidget['ActivityFeed']['height']; ?>" size="4" maxlength="4"/>px
    </label></p>
    
    <p><label><?php _e('Color Scheme', 'gb_like_button'); ?><br />
    <SELECT NAME="gxtb_fb_lB_widget_act_colorscheme">
    <?php
    $i = array( "light", "dark" );
      foreach($i as $variable) {
        if($variable == $this->GBLikeButtonWidget['ActivityFeed']['colorscheme']) {
            echo '<OPTION selected>' . $variable .'</OPTION>';
        } else {
            echo '<OPTION>' . $variable .'</OPTION>';
        }
    }
    ?>
    </SELECT>
    </label></p>

      <p><label><?php _e('Font', 'gb_like_button'); ?><br />
              <SELECT NAME="gxtb_fb_lB_widget_act_font">
              <?php
              $i = array( "" ,"arial", "luciada grande", "segoe ui", "tahoma", "trebuchet ms", "verdana" );
                foreach($i as $variable) {
                  if($variable == $this->GBLikeButtonWidget['ActivityFeed']['font']) {
                      echo '<OPTION selected>' . $variable .'</OPTION>';
                  } else {
                      echo '<OPTION>' . $variable .'</OPTION>';
                  }
              }
              ?>
      </SELECT>
	</label></p>

          <p><label><?php _e('Allow Transparency', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_act_trans" type="checkbox" class="checkbox" <?php if ($this->GBLikeButtonWidget['ActivityFeed']['trans']) echo("checked"); ?>  />
		  </label></p>

          <p><label><?php _e('Scrolling', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_act_scrolling" type="checkbox" class="checkbox" <?php if ($this->GBLikeButtonWidget['ActivityFeed']['scrolling']) echo("checked"); ?>  />
			</label></p>

          <p><label><?php _e('Frameborder', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_act_frameborder" type="text" value="<?php if ($this->GBLikeButtonWidget['ActivityFeed']['frameborder'] != "") {echo $this->GBLikeButtonWidget['ActivityFeed']['frameborder'];} else {echo "";} ?>" size="4" maxlength="4"/>px
			</label></p>

    <p><label><?php _e('Border-Style', 'gb_like_button'); ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('For Example: none or solid - Please do not enter the ;-symbol. This will be added automatically. But if you add two attributes you have to seperate the first two but do not enter it at the end of this statemente.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"><br />
		 <input name="gxtb_fb_lB_widget_act_border_style" type="text" value="<?php echo $this->GBLikeButtonWidget['ActivityFeed']['border_style']; ?>"/>
	</label></p>
    
    <p><label><?php _e('Border-Color', 'gb_like_button'); ?><br />
		 <input name="gxtb_fb_lB_widget_act_border_color" type="text" value="<?php echo $this->GBLikeButtonWidget['ActivityFeed']['border_color']; ?>"/>
	</label></p>

          <p><label><?php _e('Overflow', 'gb_like_button'); ?></label><br />
					<select name="gxtb_fb_lB_widget_act_overflow">
					<?php
					$i = array( "hidden", "scroll");
					  foreach($i as $variable) {
						if($variable == $this->GBLikeButtonWidget['ActivityFeed']['overflow']) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</select>
             </p>

	<p><label><?php _e('CSS-Design', 'gb_like_button'); ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('If you enter something into this breaks this will work as a style-attribute within the iframe-Output.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"><br />
		<input name="gxtb_fb_lB_widget_act_css" type="text" value="<?php if ($this->GBLikeButtonWidget['ActivityFeed']['css'] != "") {echo $this->GBLikeButtonWidget['ActivityFeed']['css'];} else {echo "";} ?>" />
	</label></p>    

	<p><label><?php _e('Facebook-Insights', 'gb_like_button'); ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/images/help_tooltip.png"  onmouseover="tooltip.show('<?php _e('This new Attribute will give you some new kind of information about the effectiveness of your like-button. Read more in the Plugin-FAQ or on the official Facebook Insights page.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"><br />
		<input name="gxtb_fb_lB_widget_act_ref" type="text" value="<?php if ($this->GBLikeButtonWidget['ActivityFeed']['ref'] != "") {echo $this->GBLikeButtonWidget['ActivityFeed']['ref'];} else {echo "";} ?>" />
	</label></p>

</div><?php
	
   // Saves the Widget-Options
   if (isset($_POST['gxtb_fb_lB_widget_act_title']) || isset($_POST['gxtb_fb_lB_widget_act_site'])){
	      
	$area = "ActivityFeed";
	$keycode = "gxtb_fb_lB_widget_act_";
	   
	foreach ($this->GBLikeButtonWidget[$area] as $key => $value) { 
	   	
		switch($key) {
			case "recommendations":
			case "header":
			case "trans":
			case "scrolling":
				   	$this->GBLikeButtonWidget[$area][$key] = ( isset($_POST[$keycode . $key]) ) ? esc_attr($_POST[$keycode . $key]):0;
			break;
			
			default:
				   	$this->GBLikeButtonWidget[$area][$key] = ( isset($_POST[$keycode . $key]) ) ? esc_attr($_POST[$keycode . $key]):"";
			break;	
		}
	}
	   
	  update_option('GBLikeButtonWidget', $this->GBLikeButtonWidget);
  }
}



####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    REGISTER WIDGET 		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function GBLikeButton_WidgetAdd()
{
	global $wp_version;	
	if ( version_compare( $wp_version, '2.8', '>=' ) ) {

		## Like-Button ##
		$widget_ops = array("classname" => "Facebook-Like-Button-Generator", "description" => __( "This Widget adds the Like-Button to your Sidebar.", 'gb_like_button'));
		wp_register_sidebar_widget(__('Facebook-Like-Button-Generator', 'gb_like_button'), __("Facebook-Like-Button-Generator", 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget' ), $widget_ops, 300, 400);
		wp_register_widget_control(__('Facebook-Like-Button-Generator', 'gb_like_button'), __('Facebook-Like-Button-Generator', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_control' ), 300, 440);
		
		## Recommendations ##
		$widget_ops = array("classname" => "Facebook-Recommendations", "description" => __( "This Widget adds the Recommendation-Box to your Sidebar.", 'gb_like_button'));
		wp_register_sidebar_widget(__('Facebook-Recommendations', 'gb_like_button'), __("Facebook-Recommendations", 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_rec' ), $widget_ops, 300, 400);
		wp_register_widget_control(__('Facebook-Recommendations', 'gb_like_button'), __('Facebook-Recommendations', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_control_rec' ), 300, 440);
		
		# Activity Feed #
		$widget_ops = array("classname" => "Facebook-Activity-Feed", "description" => __( "This Widget adds the Activity-Feed-Box to your Sidebar.", 'gb_like_button'));
		wp_register_sidebar_widget(__('Facebook-Activity-Feed', 'gb_like_button'), __("Facebook-Activity-Feed", 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_act' ), $widget_ops, 300, 400);
		wp_register_widget_control(__('Facebook-Activity-Feed', 'gb_like_button'), __('Facebook-Activity-Feed', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_control_act' ), 300, 440);
			
	} elseif ( version_compare( $wp_version, '2.8', '<' ) ) {	
	
		## Like-Button ##
		register_sidebar_widget(__('Facebook-Like-Button-Generator', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget' ) );
		register_widget_control(__('Facebook-Like-Button-Generator', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_control' ), 300, 440);

		## Recommendations ##
		register_sidebar_widget(__('Facebook-Recommendations', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_rec' ) );
		register_widget_control(__('Facebook-Recommendations', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_control_rec' ), 300, 440);

		## Activity Feed ##
		register_sidebar_widget(__('Facebook-Activity-Feed', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_act' ) );
		register_widget_control(__('Facebook-Activity-Feed', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_control_act' ), 300, 440);
		
	}
  
} // end function

} // end class 
} // end if-class ?>