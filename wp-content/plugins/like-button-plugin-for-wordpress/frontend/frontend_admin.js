// ####################################################### \\

// @Author: Stefan Natter
// Version 0.1
// http://www.gb-world.net
// for the WP-Plugin: Like-Button-Plugin-For-Wordpress by Stefan Natter
// compressed with: http://dean.edwards.name/packer/

// ####################################################### \\

<!-- ======================== SCRIPT ======================== -->

function gb_adminbar(imagePath){var pathLength=imagePath.length;var lastDot=imagePath.lastIndexOf(".");var fileType=imagePath.substring(lastDot,pathLength);if((fileType==".gif")||(fileType==".jpg")||(fileType==".png")||(fileType==".GIF")||(fileType==".JPG")||(fileType==".PNG")){return true}else{alert("Image-Type "+fileType+". Error! Facebook only supports the following Image-Types: The image must be at least 50px by 50px and have a maximum aspect ratio of 3:1. We support PNG, JPEG and GIF formats. (by Facebook)");}}