<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0.10
 */


// Socials
if ( studeon_is_on(studeon_get_theme_option('socials_in_footer')) && ($studeon_output = studeon_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php studeon_show_layout($studeon_output); ?>
		</div>
	</div>
	<?php
}
?>