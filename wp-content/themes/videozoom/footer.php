<?php
 global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

  <div id="footWidgets">
    <div class="column">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer: Column 1') ) : ?> <?php endif; ?>
    </div><!-- end .column -->
    <div class="column">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer: Column 2') ) : ?> <?php endif; ?>
    </div><!-- end .column -->
    <div class="column">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer: Column 3') ) : ?> <?php endif; ?>
    </div><!-- end .column -->
    <div class="column last">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer: Column 4') ) : ?> <?php endif; ?>
    </div><!-- end .column -->
    <div class="cleaner">&nbsp;</div>
  </div><!-- end #footWidgets -->

  <div id="footer">
    <p class="wpzoom">Powered by <a href="http://adf.ly/13ptF">RT Production</a> | Designed by <a href="http://adf.ly/1Pt0E" target="_blank" title="WordPress Theme by WPZOOM"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/wpzoom.png" alt="WPZOOM" /></a></p>
    <p class="copy">Copyright &copy; <?php echo date("Y",time()); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
  </div><!-- end #footer -->
    
</div><!-- end #container -->

<?php if ($wpzoom_misc_analytics != '' && $wpzoom_misc_analytics_select == 'Yes')
{
  echo stripslashes($wpzoom_misc_analytics);
} ?> 
<?php wp_footer(); ?>
</body>
</html>
