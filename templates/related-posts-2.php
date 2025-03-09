<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

$studeon_link = get_permalink();
$studeon_post_format = get_post_format();
$studeon_post_format = empty($studeon_post_format) ? 'standard' : str_replace('post-format-', '', $studeon_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($studeon_post_format) ); ?>><?php
	studeon_show_post_featured(array(
		'thumb_size' => studeon_get_thumb_size( 'big' ),
		'show_no_image' => true,
		'hover' => '',
		'singular' => false
		)
	);
	?><div class="post_header entry-header"><?php
		// Post categories
		$cats = get_post_type()=='post' ? get_the_category_list('') : apply_filters('studeon_filter_get_post_categories', '');
		if (!empty($cats)) {
			?>
			<div class="post_categories"><?php studeon_show_layout($cats); ?></div>
			<?php
		}
		?>
		<h4 class="post_title entry-title"><a href="<?php echo esc_url($studeon_link); ?>"><?php echo the_title(); ?></a></h4>
		<?php
			if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
				?><span class="post_date"><a href="<?php echo esc_url($studeon_link); ?>"><?php echo studeon_get_date(); ?></a></span><span class="post_author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">by <?php echo get_the_author(); ?></a></span><?php
			}
		?>
	</div>
</div>