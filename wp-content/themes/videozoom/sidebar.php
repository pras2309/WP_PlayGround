<?php 
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
} 
?>
<?php if (strlen($wpzoom_ad_side_imgpath) > 1 && $wpzoom_ad_side_select == 'Yes' && $wpzoom_ad_side_pos == 'Before') { echo '<div class="banner">'.stripslashes($wpzoom_ad_side_imgpath)."</div>"; }?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?> <?php endif; ?>
<?php if (strlen($wpzoom_ad_side_imgpath) > 1 && $wpzoom_ad_side_select == 'Yes' && $wpzoom_ad_side_pos == 'After') { echo '<div class="banner">'.stripslashes($wpzoom_ad_side_imgpath)."</div>"; }?>
<div class="cleaner">&nbsp;</div>