<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0.10
 */

// Logo
if (studeon_is_on(studeon_get_theme_option('logo_in_footer'))) {
	$studeon_logo_image = '';
	if (studeon_get_retina_multiplier(2) > 1)
		$studeon_logo_image = studeon_get_theme_option( 'logo_footer_retina' );
	if (empty($studeon_logo_image)) 
		$studeon_logo_image = studeon_get_theme_option( 'logo_footer' );
	$studeon_logo_text   = get_bloginfo( 'name' );
	if (!empty($studeon_logo_image) || !empty($studeon_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($studeon_logo_image)) {
					$studeon_attr = studeon_getimagesize($studeon_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($studeon_logo_image).'" class="logo_footer_image" alt="'. esc_attr(basename($studeon_logo_image)).'"'.(!empty($studeon_attr[3]) ? sprintf(' %s', $studeon_attr[3]) : '').'></a>' ;
				} else if (!empty($studeon_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($studeon_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>