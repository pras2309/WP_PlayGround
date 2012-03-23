<?php // Do not delete these lines
/* if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME'])) {
		die ('Please do not load this page directly. Thanks!');
} else { */
header("content-type: application/x-javascript");
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.4.1]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
?>
<?php
	$blogtxt = "website and blog are designed to represent an entire site, an og:type tag with types website  or blog should usually only appear on the root of a domain."; 
	$articletxt = "Use article for any URL that represents transient content - such as a news article, blog post, photo, video, etc. Do not use website  for this purpose.";
?>
function gxtb_blogtype() {

 var div = document.getElementById("gxtb_fb_lB_meta_type_div");
 var img = document.getElementById("gxtb_fb_lB_meta_type_img");	
 var element = document.getElementById("gxtb_fb_lB_meta_type");
 var index = element.options[element.selectedIndex].value;
 
 if (index == "blog" || index == "website") {
 
	img.style.visibility = "visible";
	img.setAttribute("onmouseover", "tooltip.show('<?php echo $blogtxt; ?>');");
    
    } else if (index == "article" ) {

	img.style.visibility = "visible";
	img.setAttribute("onmouseover", "tooltip.show('<?php echo $articletxt; ?>');");
        
    } else {
    
    img.style.visibility = "hidden";
    
    }
}
<?php #} ?>