<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.4.5] - GB-EXPORT [v1.0 FINAL]
+	by Stefan Natter (http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       DATA-EXPORT			 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if(isset($_POST['GBLikeButton_Options']) && isset($_POST['GBLikeButtonWidget_Options'])) {
$Button = $_POST['GBLikeButton_Options'];
$Widget = $_POST['GBLikeButtonWidget_Options'];
$datetime = date("d/m/y : H:i:s", time());
header('Content-disposition: attachment; filename=likebutton_settings.txt');
header('Content-type: text/plain');
echo "####################################################
####################################################
#######---Like-Button-Plugin-For-Wordpress---#######
####################################################
####################### by gb-world.net ############
####################################################
\r\nOption-Export from {$_SERVER['HTTP_HOST']} [{$datetime}] \r\n\r\n{$Button} \r\n\r\n####################################################\r\n\r\n{$Widget}";
#mkdir('../export', 0777);
#$fp = fopen("../export/likebutton_settings.txt", "w" )or die("Can't create file.");
#fwrite($fp, $content);
#fclose($fp);
} ?>