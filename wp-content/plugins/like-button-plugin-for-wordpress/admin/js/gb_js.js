// ####################################################### \\

// @Author: Stefan Natter
// Version 1.2
// http://www.gb-world.net
// for the WP-Plugin: Like-Button-Plugin-For-Wordpress by Stefan Natter
// ####################################################### \\
<!-- ======================== SCRIPT ======================== -->
function submitenter(myfield, e) {
    var keycode;
    if (window.event) keycode = window.event.keyCode;
    else if (e) keycode = e.which;
    else return true;
    if (keycode == 13) {
        myfield.form.submit();
        return false
    } else return true
}
function post_focus() {
if( GBLikeButton('#xfbml_mod1').length > 0 &&  GBLikeButton('#xfbml_mod2').length > 0) {
	
    var elem1 = document.getElementById("xfbml_mod1");
    var elem2 = document.getElementById("xfbml_mod2");
    if (document.getElementById('gxtb_fb_lB_jdk').checked == true) {
        GBLikeButton('li.iframetab').hide();
        GBLikeButton('tr.xfbml_mod').show()
		gxtb_generator();
    } else if (document.getElementById('gxtb_fb_lB_jdkOFF').checked == true) {
        GBLikeButton('li.iframetab').show();
        GBLikeButton('tr.xfbml_mod').hide()
		gxtb_generator();
    }
}
}