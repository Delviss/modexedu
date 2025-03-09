<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

$studeon_link = get_permalink();
$studeon_post_format = get_post_format();
$studeon_post_format = empty($studeon_post_format) ? 'standard' : str_replace('post-format-', '', $studeon_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($studeon_post_format) ); ?>><?php
	studeon_show_post_featured(array(
		'thumb_size' => studeon_get_thumb_size( 'big' ),
		'show_no_image' => true,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">' . studeon_get_post_categories('') . '</div>'
							. '<h6 class="post_title entry-title"><a href="' . esc_url($studeon_link) . '">' . wp_kses( get_the_title(),'studeon_kses_content' ) . '</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="' . esc_url($studeon_link) . '">' . studeon_get_date() . '</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>