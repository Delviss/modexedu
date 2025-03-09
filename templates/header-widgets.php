<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

// Header sidebar
$studeon_header_name = studeon_get_theme_option('header_widgets');
$studeon_header_present = !studeon_is_off($studeon_header_name) && is_active_sidebar($studeon_header_name);
if ($studeon_header_present) { 
	studeon_storage_set('current_sidebar', 'header');
	$studeon_header_wide = studeon_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($studeon_header_name) ) {
		dynamic_sidebar($studeon_header_name);
	}
	$studeon_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($studeon_widgets_output)) {
		$studeon_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $studeon_widgets_output);
		$studeon_need_columns = strpos($studeon_widgets_output, 'columns_wrap')===false;
		if ($studeon_need_columns) {
			$studeon_columns = max(0, (int) studeon_get_theme_option('header_columns'));
			if ($studeon_columns == 0) $studeon_columns = min(6, max(1, substr_count($studeon_widgets_output, '<aside ')));
			if ($studeon_columns > 1)
				$studeon_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($studeon_columns).' widget ', $studeon_widgets_output);
			else
				$studeon_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($studeon_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$studeon_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($studeon_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'studeon_action_before_sidebar' );
				studeon_show_layout($studeon_widgets_output);
				do_action( 'studeon_action_after_sidebar' );
				if ($studeon_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$studeon_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>