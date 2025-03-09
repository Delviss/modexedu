<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

$studeon_post_id    = get_the_ID();
$studeon_post_date  = studeon_get_date();
$studeon_post_title = get_the_title();
$studeon_post_link  = get_permalink();
$studeon_post_author_id   = get_the_author_meta('ID');
$studeon_post_author_name = get_the_author_meta('display_name');
$studeon_post_author_url  = get_author_posts_url($studeon_post_author_id, '');

$studeon_args = get_query_var('studeon_args_widgets_posts');
$studeon_show_date = isset($studeon_args['show_date']) ? (int) $studeon_args['show_date'] : 1;
$studeon_show_image = isset($studeon_args['show_image']) ? (int) $studeon_args['show_image'] : 1;
$studeon_show_author = isset($studeon_args['show_author']) ? (int) $studeon_args['show_author'] : 1;
$studeon_show_counters = isset($studeon_args['show_counters']) ? (int) $studeon_args['show_counters'] : 1;
$studeon_show_categories = isset($studeon_args['show_categories']) ? (int) $studeon_args['show_categories'] : 1;

$studeon_output = studeon_storage_get('studeon_output_widgets_posts');

$studeon_post_counters_output = '';
if ( $studeon_show_counters ) {
	$studeon_post_counters_output = '<span class="post_info_item post_info_counters">'
								. studeon_get_post_counters('comments')
							. '</span>';
}


$studeon_output .= '<article class="post_item with_thumb">';

if ($studeon_show_image) {
	$studeon_post_thumb = get_the_post_thumbnail($studeon_post_id, studeon_get_thumb_size('tiny'), array(
		'alt' => the_title_attribute( array( 'echo' => false ) )
	));
	if ($studeon_post_thumb) $studeon_output .= '<div class="post_thumb">' . ($studeon_post_link ? '<a href="' . esc_url($studeon_post_link) . '">' : '') . ($studeon_post_thumb) . ($studeon_post_link ? '</a>' : '') . '</div>';
}

$studeon_output .= '<div class="post_content">'
			. ($studeon_show_categories 
					? '<div class="post_categories">'
						. studeon_get_post_categories()
						. $studeon_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($studeon_post_link ? '<a href="' . esc_url($studeon_post_link) . '">' : '') . ($studeon_post_title) . ($studeon_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('studeon_filter_get_post_info', 
								'<div class="post_info">'
									. ($studeon_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($studeon_post_link ? '<a href="' . esc_url($studeon_post_link) . '" class="post_info_date">' : '') 
											. esc_html($studeon_post_date) 
											. ($studeon_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($studeon_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'studeon') . ' ' 
											. ($studeon_post_link ? '<a href="' . esc_url($studeon_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($studeon_post_author_name) 
											. ($studeon_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$studeon_show_categories && $studeon_post_counters_output
										? $studeon_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
studeon_storage_set('studeon_output_widgets_posts', $studeon_output);
?>