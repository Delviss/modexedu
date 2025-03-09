<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

$studeon_sidebar_position = studeon_get_theme_option('sidebar_position');
if (studeon_sidebar_present()) {
	ob_start();
	$studeon_sidebar_name = studeon_get_theme_option('sidebar_widgets');
	studeon_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($studeon_sidebar_name) ) {
		dynamic_sidebar($studeon_sidebar_name);
	}
	$studeon_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($studeon_out)) {
		?>
		<div class="sidebar <?php echo esc_attr($studeon_sidebar_position); ?> widget_area<?php if (!studeon_is_inherit(studeon_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(studeon_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'studeon_action_before_sidebar' );
				studeon_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $studeon_out));
				do_action( 'studeon_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>