<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0.10
 */

// Footer menu
$studeon_menu_footer = studeon_get_nav_menu('menu_footer','',1);
if (!empty($studeon_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php studeon_show_layout($studeon_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>