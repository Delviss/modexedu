<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0.14
 */
$studeon_header_video = studeon_get_header_video();
if (!empty($studeon_header_video) && !studeon_is_from_uploads($studeon_header_video)) {
	global $wp_embed;
	if (is_object($wp_embed))
		$studeon_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($studeon_header_video) . '[/embed]' ));
	$studeon_embed_video = studeon_make_video_autoplay($studeon_embed_video);
	?><div id="background_video"><?php studeon_show_layout($studeon_embed_video); ?></div><?php
}
?>