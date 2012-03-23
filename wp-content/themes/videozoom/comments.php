<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if (have_comments()) { ?>
<div class="box">
  <div id="commentspost"><a name="commentspost"></a>
  <h2 class="title sep"><?php comment_type_count();?> Comments</h2>
	<ol class="normalComments"><?php wp_list_comments('type=comment&avatar_size=55');?></ol>
	
	<div class="navigation">
		<p>
			<?php previous_comments_link('Previous Comments') ?>
			<?php next_comments_link('Next Comments') ?>
		</p>
	</div>
	
	 	<?php if ($wpzoom_trackbacks == 'Show') { ?>
	<h3><span>Trackbacks</span></h3> 
		<ol class="trackblist">
		
		   <?php //Displays trackbacks only
			foreach ($comments as $comment) : ?>
				<?php $comment_type = get_comment_type(); ?>

				<?php if($comment_type != 'comment') { ?>
				<li><?php comment_author_link() ?></li>
			<?php }
			endforeach; ?>

		</ol>
	 
	
	<?php } ?>
		
	</div><!-- end #commentspost -->
	
	

<?php if ('closed' == $post->comment_status) : ?>
</div>
<?php endif; ?>
	
 <?php } 
 else { // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) { ?>
		<!-- If comments are open, but there are no comments. -->
<div class="box">
<div id="commentspost">
	<h2 class="title">0 Comments</h2>
  <p>You can be the first one to leave a comment.</p>
</div>
	 <?php } else { // comments are closed ?>
		<!-- If comments are closed. -->
	<?php } ?>
<?php } ?>

<?php if ('open' == $post->comment_status) : ?>


<div id="respond">

<h2 class="title"><?php comment_form_title( 'Leave a Comment', 'Leave a Reply to %s' ); ?></h2>
<div class="sep">&nbsp;</div>
<div class="cleaner">&nbsp;</div>
<div class="cancel-comment-reply"><p><?php cancel_comment_reply_link(); ?></p></div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>
<div id="formLabels">
<div class="column">
<label for="author">Name <?php if ($req) echo "(required)"; ?>:</label>
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /><br />
</div>

<div class="column">
<label for="email">E-Mail <?php if ($req) echo "(required)"; ?>:</label>
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /><br />
</div>

<div class="column last">
<label for="url">Website:</label>
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /><br />
</div>
</div>
<?php endif; ?>
<div id="formContent">
<textarea name="comment" id="comment" tabindex="4" cols="140" rows="8"></textarea><br />
<input name="submit" type="submit" id="submit" value="Submit Comment" />
<!--<p><strong>XHTML:</strong> You can use these tags: <br /><code><?php echo allowed_tags(); ?></code></p>-->
</div>
<div class="cleaner">&nbsp;</div>
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; // If registration required and not logged in ?>
</div>
</div>

 
	
<?php endif; // if you delete this the sky will fall on your head ?>