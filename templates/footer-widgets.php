<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0.10
 */

// Footer sidebar
$studeon_footer_name = studeon_get_theme_option('footer_widgets');
$studeon_footer_present = !studeon_is_off($studeon_footer_name) && is_active_sidebar($studeon_footer_name);
if ($studeon_footer_present) { 
	studeon_storage_set('current_sidebar', 'footer');
	$studeon_footer_wide = studeon_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($studeon_footer_name) ) {
		dynamic_sidebar($studeon_footer_name);
	}
	$studeon_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($studeon_out)) {
		$studeon_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $studeon_out);
		$studeon_need_columns = true;
		if ($studeon_need_columns) {
			$studeon_columns = max(0, (int) studeon_get_theme_option('footer_columns'));
			if ($studeon_columns == 0) $studeon_columns = min(6, max(1, substr_count($studeon_out, '<aside ')));
			if ($studeon_columns > 1)
				$studeon_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($studeon_columns).' widget ', $studeon_out);
			else
				$studeon_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($studeon_footer_wide) ? ' footer_fullwidth' : ''; ?>">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$studeon_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($studeon_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'studeon_action_before_sidebar' );
				studeon_show_layout($studeon_out);
				do_action( 'studeon_action_after_sidebar' );
				if ($studeon_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$studeon_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>