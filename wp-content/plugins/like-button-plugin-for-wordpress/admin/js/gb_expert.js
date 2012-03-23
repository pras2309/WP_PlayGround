// ####################################################### \\
// @Author: Stefan Natter
// Version 0.1
// http://www.gb-world.net
// for the WP-Plugin: Like-Button-Plugin-For-Wordpress by Stefan Natter
// ####################################################### \\
<!-- ======================== SCRIPT ======================== -->
var GBLikeButton=jQuery.noConflict();

 GBLikeButton(document).ready(function(){
	GBLikeButton("#gbexpert_side").click(function () {
		//GBLikeButton("#blogspecificbutton").show();
		GBLikeButton("#expert_besidebutton").val(GBLikeButton("#expert_besidebutton").val() + GBLikeButton("#blogspecificbutton").html());
	});
	GBLikeButton("#gbexpert_button_like").click(function () {
		//GBLikeButton("#blogspecificbutton").show();
		GBLikeButton("#expert_besidebutton").val(GBLikeButton("#expert_besidebutton").val() + GBLikeButton("#socialbutton_like").html());
	
	});
	GBLikeButton("#gbexpert_button_tweet").click(function () {
		//GBLikeButton("#blogspecificbutton").show();
		GBLikeButton("#expert_besidebutton").val(GBLikeButton("#expert_besidebutton").val() + '<span class="gb_socialspeed gb_twitter_js"><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="GBWorldnet" data-lang="de">Tweet</a></span>');
	
	});
	GBLikeButton("#gbexpert_button_digg").click(function () {
		//GBLikeButton("#blogspecificbutton").show();
		GBLikeButton("#expert_besidebutton").val(GBLikeButton("#expert_besidebutton").val() + '<span class="gb_socialspeed gb_digg_js"><a class="DiggThisButton DiggCompact"></a></span>');
	
	});
	GBLikeButton("#gbexpert_button_stumpleupon").click(function () {
		//GBLikeButton("#blogspecificbutton").show();
		GBLikeButton("#expert_besidebutton").val(GBLikeButton("#expert_besidebutton").val() + '<span class="gb_socialspeed gb_stumbleupon"></span>');
	
	});
	GBLikeButton("#gbexpert_button_plusone").click(function () {
		//GBLikeButton("#blogspecificbutton").show();
		GBLikeButton("#expert_besidebutton").val(GBLikeButton("#expert_besidebutton").val() + '<span class="gb_socialspeed gb_plusone_js"><g:plusone size="medium"></g:plusone></span');
	
	});
	/* 
	GBLikeButton("#stumbleupon").click(function () {
		GBLikeButton("#expert_besidebutton").append('<span style="margin:0 10px 0 0;" class="stumbleupon" src="' . urlencode(get_permalink( $id )) .'"></span>');
	});

	GBLikeButton("#follow").click(function () {
		GBLikeButton("#expert_besidebutton").append('&lt;a href="http://twitter.com/YOURNAME" class="twitter-follow-button" data-show-count="false">Follow @YOURNAME&lt;/a>');
	});

	GBLikeButton("#tweet").click(function () {
		GBLikeButton("#expert_besidebutton").append('&lt;a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet&lt;/a>&lt;script type="text/javascript" src="http://platform.twitter.com/widgets.js">&lt;/script>');
	}); */

});