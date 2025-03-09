<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0.10
 */

$studeon_footer_scheme =  studeon_is_inherit(studeon_get_theme_option('footer_scheme')) ? studeon_get_theme_option('color_scheme') : studeon_get_theme_option('footer_scheme');
$studeon_footer_id = str_replace('footer-custom-', '', studeon_get_theme_option("footer_style"));
if ((int) $studeon_footer_id == 0) {
    $studeon_footer_id = studeon_get_post_id(array(
            'name' => $studeon_footer_id,
            'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
        )
    );
} else {
    $studeon_footer_id = apply_filters('trx_addons_filter_get_translated_layout', $studeon_footer_id);
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($studeon_footer_id); ?> scheme_<?php echo esc_attr($studeon_footer_scheme); ?>">
	<?php
    // Custom footer's layout
    do_action('studeon_action_show_layout', $studeon_footer_id);
	?>
</footer><!-- /.footer_wrap -->
