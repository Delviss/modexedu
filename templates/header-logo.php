<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

$studeon_args = get_query_var('studeon_logo_args');

// Site logo
$studeon_logo_image  = studeon_get_logo_image(isset($studeon_args['type']) ? $studeon_args['type'] : '');
$studeon_logo_text   = studeon_is_on(studeon_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$studeon_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($studeon_logo_image) || !empty($studeon_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($studeon_logo_image)) {
			$studeon_attr = studeon_getimagesize($studeon_logo_image);
			echo '<img src="'.esc_url($studeon_logo_image).'" alt="'. esc_attr(basename($studeon_logo_image)).'"'.(!empty($studeon_attr[3]) ? sprintf(' %s', $studeon_attr[3]) : '').'>' ;
		} else {
			studeon_show_layout(studeon_prepare_macros($studeon_logo_text), '<span class="logo_text">', '</span>');
			studeon_show_layout(studeon_prepare_macros($studeon_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>