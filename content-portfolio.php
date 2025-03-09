<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

$studeon_blog_style = explode('_', studeon_get_theme_option('blog_style'));
$studeon_columns = empty($studeon_blog_style[1]) ? 2 : max(2, $studeon_blog_style[1]);
$studeon_post_format = get_post_format();
$studeon_post_format = empty($studeon_post_format) ? 'standard' : str_replace('post-format-', '', $studeon_post_format);
$studeon_animation = studeon_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($studeon_columns).' post_format_'.esc_attr($studeon_post_format) ); ?>
	<?php echo (!studeon_is_off($studeon_animation) ? ' data-animation="'.esc_attr(studeon_get_animation_classes($studeon_animation)).'"' : ''); ?>
	>

	<?php
	$studeon_image_hover = studeon_get_theme_option('image_hover');
	// Featured image
	studeon_show_post_featured(array(
		'thumb_size' => studeon_get_thumb_size(strpos(studeon_get_theme_option('body_style'), 'full')!==false || $studeon_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $studeon_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $studeon_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>